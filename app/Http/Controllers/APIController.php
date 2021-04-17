<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\InvoicesExport;
use Log;
use DB;
use Excel;

class APIController extends Controller
{
     public function getValuationlist(){
            //$prop_id = $request->input('id');
            //$pb = $request->input('pb');
            // $name=Auth::user()->name;
            //Log::info('tt '.$prop_id);
            //Log::info('rrt '.$id);
            $tax = DB::select(' select `tbtaxinterface`.`txi_id`,
            `tbtaxinterface`.`txi_accno`,
            `tbtaxinterface`.`txi_vd_id`,
            `tbtaxinterface`.`txi_vt_id`,
            DATE_FORMAT(`tbtaxinterface`.`txi_termdate`, "%d/%m/%Y") `txi_termdate`,
            `tbtaxinterface`.`txi_proposent`,
            `tbtaxinterface`.`txi_proposerate`,
            `tbtaxinterface`.`txi_calculatedrate`,
            `tbtaxinterface`.`txi_proposetax`,
            `tbtaxinterface`.`txi_finalnt`,
            `tbtaxinterface`.`txi_finalrate`,
            `tbtaxinterface`.`txi_adjustment`,
            `tbtaxinterface`.`txi_finaltax`,
            `tbtaxinterface`.`txi_entrytype_id`,
            `tbtaxinterface`.`txi_entrycount`,
            `tbtaxinterface`.`txi_comment`,
            `tbtaxinterface`.`txi_txistatus_id`
            FROM `cama`.`tbtaxinterface` where txi_txistatus_id ="0"');

             return response()->json($tax, 200);
             
        
    }

    public function getValuation($id){
	        //$prop_id = $request->input('id');
	        //$pb = $request->input('pb');
	        // $name=Auth::user()->name;
        
            //Log::info('tt '.$prop_id);
            Log::info('rrt '.$id);
             $tax = DB::select('select subzone.tdi_value subzone, subzone.tdi_parent_name zone, ap_bldgstatus_id, proptype.tdi_value proptype, 
                proptype.tdi_parent_name propcategorty,  bldgstatus.tdi_value bldgstatus, bldgstorey.tdi_value  bldgstorey,
                `vt_vd_id`, vt_derivedrate, vt_derivedvalue, `vt_grossvalue`, `vt_valuedescretion`, `vt_proposednt`, `vt_proposedrate`, `vt_calculatedrate`,  
`vt_proposedtax`, `vt_approvednt`,  `vt_approvedrate`, `vt_adjustment`,  `vt_approvedtax`,  `vt_note`,
`vt_createby`,  `vt_createdate`,  `vt_updateby`,  `vt_updatedate`
                from cm_appln_valdetl, `cm_appln_val_tax`, cm_appln_parameter 
left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = "BULDINGTYPE") proptype
on proptype.tdi_key = ap_propertytype_id
left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = "ISHASBUILDING") bldgstatus
on bldgstatus.tdi_key = ap_bldgstatus_id
left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey
on bldgstorey.tdi_key = ap_propertylevel_id,
                cm_masterlist 
                left join (select tdi_key, tdi_value,tdi_parent_name from tbdefitems where tdi_td_name = "SUBZONE") subzone
                on subzone.`tdi_key` = ma_subzone_id
                
                where ap_vd_id  = vd_id and ma_id = vd_ma_id and vd_id = vt_vd_id and vd_id = ifnull("'.$id.'",0)');

             return response()->json($tax, 200);
             
        
    }


    public function generateExcel(){
       
      $data = DB::select('select  vt_name,vt_termDate, va_id, va_name, ma_accno, vd_id, vd_ma_id, subzone.tdi_parent_key,subzone.tdi_parent_name, subzone.tdi_value subzone, subzone.tdi_key, 
        bldgstatus.tdi_value bldgstatus, bldgstatus.tdi_key bldgstatusid, proptype.tdi_parent_name propertycategory, proptype.tdi_value propertytype,vt_grossvalue,vt_proposednt, vt_proposedrate,
        vt_calculatedrate, vt_proposedtax, vt_approvednt, vt_approvedrate,ma_addr_ln1, ma_addr_ln2, ma_addr_ln3, ma_addr_ln4, ma_postcode, propstate.tdi_value, 
        TO_OWNNO, TO_OWNNAME, to_addr_ln1,to_addr_ln2,
        to_addr_ln3, to_addr_ln4, to_postcode, ownstate.tdi_value ownstate, al_no, al_altno, al_size, al_startdate, al_expireddate,al_tenureperiod
         from cm_appln_valterm 
        inner join cm_appln_val on va_vt_id = cm_appln_valterm.vt_id
        inner join cm_appln_valdetl on vd_va_id = va_id
        inner join cm_masterlist on ma_id = vd_ma_id
        inner join cm_appln_val_tax on vt_vd_id = vd_id
        inner join cm_owner on to_ma_id = ma_id
        inner join cm_appln_lot on al_vd_id = vd_id
        left join tbdefitems  subzone
        on subzone.`tdi_key` = ma_subzone_id and  subzone.tdi_td_name = "SUBZONE"
        left join tbdefitems proptype
        on proptype.tdi_key = vd_bldgtype_id and proptype.tdi_td_name = "BULDINGTYPE"
        left join tbdefitems bldgstatus
        on bldgstatus.tdi_key = vd_ishasbuilding and bldgstatus.tdi_td_name = "ISHASBUILDING"
        left join tbdefitems propstate
        on propstate.tdi_key = ma_state_id and propstate.tdi_td_name = "STATE"
        left join tbdefitems ownstate
        on ownstate.tdi_key = TO_STATE_ID and ownstate.tdi_td_name = "STATE" limit 100');

     /*  return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('xlsx');*/

        $headings = [
            'TermName', 
            'TermDate', 
            'va_id', 
             'va_name', 'accountnumber', 'vd_id', 'vd_ma_id', 'zoneid','zone', 'subzone', 'subzoneid', 'bldgstatus',
        'bldgstatusid', 'propertycategory', 'propertytype', 'grossvalue','proposednt', 'proposedrate',
        'calculatedrate', 'proposedtax', 'approvednt', 'approvedrate','propertyaddress1', 'propertyaddress2', 'propertyaddress3', 'propertyaddress4', 'propertypostcode', 'propstate', 
        'OWNNO', 'OWNNAME', 'to_addr_ln1','to_addr_ln2',
        'to_addr_ln3', 'to_addr_ln4', 'to_postcode', 'ownstate', 'al_no', 'al_altno', 'al_size', 'al_startdate', 'al_expireddate','al_tenureperiod'
        ];

        $export = new InvoicesExport($data,$headings);
        return Excel::download($export, 'export.xlsx');
        //$this->export($test, 'flyer_data', $captions, 'xls');
          //return Excel::download($test, 'data.xlsx');
    
    }

    public function testBasket(){
       
      
        $group = DB::select("select va_approvalstatus_id, va_id id, va_name l_group, va_vt_id termid, vt_name termaname, va_createby createby, DATE_FORMAT(va_createdate, '%d/%m/%Y') createdate, 
        va_updateby updateby, DATE_FORMAT(va_updatedate, '%d/%m/%Y') updatedate, 
         vt_applicationtype_id, ob_desc
        from cm_appln_val 
        inner join cm_appln_valterm  on va_vt_id = vt_id
        left join cm_objection on ob_vt_id = vt_id 
        left join (select count(*) notiscount,vd_va_id  from cm_objection_notis 
        inner join cm_appln_valdetl on vd_id = no_vd_id group by vd_va_id ) notis on notis.vd_va_id = va_id
        left join (select count(*) objectioincount,vd_va_id  from cm_objection_objectionlist 
        inner join cm_appln_valdetl on vd_id = ol_vd_id group by vd_va_id ) objection on objection.vd_va_id = va_id
        left join (select count(*) decisioncount,vd_va_id  from cm_objection_decision 
        inner join cm_appln_valdetl on vd_id = de_vd_id group by vd_va_id ) decision on decision.vd_va_id = va_id
        
        order by va_id desc");

      

       
        
        return view("group.basket_test")->with(array('group'=> $group));
    }
}