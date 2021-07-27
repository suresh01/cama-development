<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use DB;
use Session;
use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ValutionController extends Controller
{
    
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        App::setlocale(session()->get('locale'));
    }
    
    public function approve(Request $request){
        $param_value = $request->input('param_value');
        $param = $request->input('param');
        $name=Auth::user()->name;
        //$param = $request->input('param');
        Log::info("call proc_approvepropreg('".$param_value."',    '".$name."''valuation', '".$param."')"); 
        $register=DB::select("call proc_approvepropreg(".$param_value.",   '".$name."', 'valuation', '".$param."')"); 
        
        return response()->json(array('checkdigit'=> 'succsess'), 200);
    }

    public function valuationDetail(Request $request){
        $prop_id = $request->input('prop_id');
        $pb = $request->input('pb');
        $name=Auth::user()->name;

         $term=DB::select("select vt_valbase_id, concat(vt_name,'', DATE_FORMAT(vt_createdate, '%d%m%Y')) termfoldername, vd_accno accountnumber, va_vt_id,
                vt_name , applntype.tdi_value applntype, termstage.tdi_desc termstage, va_name, approval.tdi_desc approval, vd_approvalstatus_id
                FROM cm_appln_valterm inner join cm_appln_val on va_vt_id = vt_id inner join cm_appln_valdetl on vd_va_id = va_id  
                left join (SELECT * FROM tbdefitems where tdi_td_name = 'BASKETSTAGE') approval on approval.tdi_key = va_approvalstatus_id 
                left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
                on applntype.tdi_key = vt_applicationtype_id
                left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
                on termstage.tdi_key = vt_approvalstatus_id 
                 where vd_id = ".$prop_id);
            $iseditable = 1;

          /* $termtype=DB::select( "select 1 from cm_appln_valterm 
        inner join cm_appln_val on va_vt_id = vt_id
        inner join cm_appln_valdetl on  vd_va_id = va_id where vt_valbase_id = 2 and vd_id = ".$prop_id." limit 1"); 
*/
            foreach ($term as $rec) {
                $termname = $rec->termfoldername;
                $accountnumber = $rec->accountnumber;
                $viewparambasket = $rec->va_name;
                $viewparambasketstatus = $rec->approval;
                $propertystatus = $rec->vd_approvalstatus_id;
                $termid = $rec->va_vt_id;
                $termtype = $rec->vt_valbase_id;
                $applntype = $rec->applntype;
                $viewparamterm = "( ".$rec->applntype." ) ".$rec->vt_name." - ".$rec->termstage ;
                $manualpropstatus = $rec->vd_approvalstatus_id;
                if($rec->vd_approvalstatus_id == "07" || $rec->vd_approvalstatus_id == "08"|| $rec->vd_approvalstatus_id == "09"){
                    $iseditable = 1;
                } else {
                    $iseditable = 0;
                }
            }

            if ($manualpropstatus == "07") {
               // $register=DB::select("call proc_manaual_valuation_process(".$prop_id.", 10001, 10010,   '".$name."',  0, 0, @p_result)"); 
                 $iseditable = 0;
            }

            Log::info($applntype);

            $master = DB::select('select subzone.tdi_value subzone, subzone.tdi_parent_name zone, ap_bldgstatus_id, proptype.tdi_value proptype, 
                proptype.tdi_parent_name propcategorty,  bldgstatus.tdi_value bldgstatus, bldgstorey.tdi_value  bldgstorey
                from cm_appln_valdetl, cm_appln_parameter 
left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = "BULDINGTYPE") proptype
on proptype.tdi_key = ap_propertytype_id
left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = "ISHASBUILDING") bldgstatus
on bldgstatus.tdi_key = ap_bldgstatus_id
left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey
on bldgstorey.tdi_key = ap_propertylevel_id,
                cm_masterlist 
                left join (select tdi_key, tdi_value,tdi_parent_name from tbdefitems where tdi_td_name = "SUBZONE") subzone
                on subzone.`tdi_key` = ma_subzone_id
                where ap_vd_id  = vd_id and ma_id = vd_ma_id and vd_id = '.$prop_id);
            $bldgtype = '';
            foreach ($master as $rec) {
                $bldgtype = $rec->ap_bldgstatus_id;
            }

            $lot = DB::select('select DATE_FORMAT(vl_startdate, "%d/%m/%Y") vl_startdate1, DATE_FORMAT(vl_expireddate, "%d/%m/%Y") vl_expireddate1,cm_appln_val_lot.*, lotcode.tdi_value lotcode, roadtype.tdi_value roadtype, titletype.tdi_value titletype
        , unitsize.tdi_value unitsize, concat(lotcode.tdi_value,vl_no) lotnumber, concat(titletype.tdi_value,vl_titleno) titlenumber, landuse.tdi_value landuse, tentype.tdi_value tentype
         from cm_appln_val_lot left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE") lotcode on lotcode.tdi_key = vl_lotcode_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADTYPE") roadtype on roadtype.tdi_key = vl_roadtype_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE") titletype on titletype.tdi_key = vl_titletype_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SIZEUNIT") unitsize on unitsize.tdi_key = vl_sizeunit_id
        left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDUSE") landuse on  vl_landuse_id = landuse.tdi_key
        left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "TENURETYPE") tentype on  vl_tenuretype_id = tentype.tdi_key 
         where vl_vd_id = ifnull("'.$prop_id.'",0)');
        Log::info($lot );
            $bldg = DB::select(' select DATE_FORMAT(vb_cccdate, "%d/%m/%Y") vb_cccdate1, DATE_FORMAT(vb_occupieddate, "%d/%m/%Y") vb_occupieddate1,
                 cm_appln_val_bldg.*, bldgtype.tdi_value bldgtype, tdi_parent_name
                 bldgcategory, tdi_parent_key bldgcategory_id, bldgstorey.tdi_value bldgstorey, 
                bldgstr.tdi_value bldgstr,bldgcondn.tdi_value bldgcondn,bldgposition.tdi_value bldgposition,walltype.tdi_value walltype
                , rooftype.tdi_value rooftype, floortype.tdi_value floortype
                 from cm_appln_val_bldg left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype 
                 on bldgtype.tdi_key = vb_BLDGTYPE_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey
                on bldgstorey.tdi_key = vb_BLDGSTOREY_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGSTRUCTURE") bldgstr
                on bldgstr.tdi_key = vb_BLDGSTRUCTURE_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGCONDN") bldgcondn  
                on bldgcondn.tdi_key = vb_bldgcondn_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGPOSITION") bldgposition  
                on bldgposition.tdi_key = vb_bldgposition_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROOFTYPE") rooftype  
                on rooftype.tdi_key = vb_rooftype_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "WALLTYPE") walltype  
                on walltype.tdi_key = vb_walltype_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "FLOORTYPE") floortype  
                on floortype.tdi_key = vb_floortype_id
                where vb_vd_id = ifnull("'.$prop_id.'",0)');
            
              $bldgar = DB::select('select cm_appln_val_bldgarea.*,
            vb_id,
            arlvel.tdi_value arlvel, 
            arlvel.tdi_sort arlvelsort, 
            arcate.tdi_value arcate, 
            arcate.tdi_sort arcatesort, 
            artype.tdi_value artype, 
            artype.tdi_sort artypesort,
            aruse.tdi_value aruse 
            from cm_appln_val_bldgarea  
            left join (select tdi_key, tdi_value, tdi_sort from tbdefitems where tdi_td_name = "AREATYPE") artype on artype.tdi_key = cm_appln_val_bldgarea.vba_AREATYPE_ID
            left join (select tdi_key, tdi_value, tdi_sort from tbdefitems where tdi_td_name = "AREACATEGORY") arcate on  arcate.tdi_key = vba_AREACATEGORY_ID
            left join (select tdi_key, tdi_value, tdi_sort from tbdefitems where tdi_td_name = "AREALEVEL") arlvel on  arlvel.tdi_key = vba_AREALEVEL_ID 
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAUSE") aruse on aruse.tdi_key = vba_areause_id,
            cm_appln_val_bldg 
            where vba_vb_id = vb_id and vb_vd_id = ifnull("'.$prop_id.'",0)
            order by  artype.tdi_sort, arlvel.tdi_sort ');

               $allowance = DB::select('select *, vb_id, allowancetype.tdi_value allowancetype,allowancetype.tdi_parent_name allowancecategory, allowancemethod.tdi_value allowancemethod 
            from cm_appln_val_bldgallowances
            left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = "ALLOWANCECALMETHOD") allowancemethod on  allowancemethod.tdi_key = vbal_calcmethod_id 
            left join (select tdi_key, tdi_value,tdi_parent_name from tbdefitems where tdi_td_name = "ALLOWANCETYPE") allowancetype on allowancetype.tdi_key = vbal_allowancetype_id 
             , cm_appln_val_bldg where vbal_vb_id = vb_id and vb_vd_id = ifnull("'.$prop_id.'",0)');           
            
             $tax = DB::select('select `vt_id`, `vt_vd_id`, vt_derivedrate, vt_derivedvalue, `vt_grossvalue`, `vt_valuedescretion`, `vt_proposednt`, `vt_proposedrate`, `vt_calculatedrate`,  
`vt_proposedtax`, `vt_approvednt`,  `vt_approvedrate`, `vt_adjustment`,  `vt_approvedtax`,  `vt_note`,
`vt_createby`,  `vt_createdate`,  `vt_updateby`,  `vt_updatedate`
FROM `cm_appln_val_tax` where vt_vd_id = ifnull("'.$prop_id.'",0)');

              $lotarea = DB::select('select * from cm_appln_val_lotarea, cm_appln_val_lot where vla_vt_id = vl_id and vl_vd_id = ifnull("'.$prop_id.'",0) order by vla_id asc ');

            
       $lotdetail = DB::select('select * from cm_appln_val_lotarea where vla_vt_id =  ifnull("'.$prop_id.'",0)');

       $additional = DB::select('select * from cm_appln_val_additional where vad_vd_id =  ifnull("'.$prop_id.'",0)');


        App::setlocale(session()->get('locale'));
       
        if ($termtype ==2){
           if  ($bldgtype ==0){
                return view('valuation.type2valuationdetaillot')->with(array('lot'=>$lot,'bldg'=>$bldg,'master' => $master,'tax' => $tax,'lotdetail' => $lotdetail,'lotarea' => $lotarea,'bldgar' => $bldgar,'allowance' => $allowance,'prop_id' => $prop_id,'additional' => $additional, 'viewparambasket' => $viewparambasket, 'viewparambasketstatus' => $viewparambasketstatus, 'viewparamterm' => $viewparamterm, 'termid' => $termid, 'accountnumber' => $accountnumber,
                    'iseditable' => $iseditable,'pb'=>$pb,'termtype'=>$termtype));
           } else {

            return view('valuation.type2valuationdetailbldg')->with(array('lot'=>$lot,'bldg'=>$bldg,'master' => $master,'tax' => $tax,'lotdetail' => $lotdetail,'lotarea' => $lotarea,'bldgar' => $bldgar,'allowance' => $allowance,'prop_id' => $prop_id,'additional' => $additional, 'viewparambasket' => $viewparambasket, 'viewparambasketstatus' => $viewparambasketstatus, 'viewparamterm' => $viewparamterm, 'termid' => $termid, 'accountnumber' => $accountnumber,
                    'iseditable' => $iseditable,'pb'=>$pb));
           }

        } else {
             return view('valuation.type1valuationdetail')->with(array('lot'=>$lot,'bldg'=>$bldg,'master' => $master,'tax' => $tax,'lotdetail' => $lotdetail,'lotarea' => $lotarea,'bldgar' => $bldgar,'allowance' => $allowance,'prop_id' => $prop_id,'additional' => $additional, 'viewparambasket' => $viewparambasket, 'viewparambasketstatus' => $viewparambasketstatus, 'viewparamterm' => $viewparamterm, 'termid' => $termid, 'accountnumber' => $accountnumber,
                    'iseditable' => $iseditable,'pb'=>$pb));
           
        }
        
    }

    public function manualValuationProcess(Request $request){
        $prop_id = $request->input('prop_id');
        $pb = $request->input('pb');
        $name=Auth::user()->name;

         $term=DB::select("select vt_valbase_id, concat(vt_name,'', DATE_FORMAT(vt_createdate, '%d%m%Y')) termfoldername, vd_accno accountnumber, va_vt_id,
                vt_name , applntype.tdi_value applntype, termstage.tdi_desc termstage, va_name, approval.tdi_desc approval, vd_approvalstatus_id
                FROM cm_appln_valterm inner join cm_appln_val on va_vt_id = vt_id inner join cm_appln_valdetl on vd_va_id = va_id  
                left join (SELECT * FROM tbdefitems where tdi_td_name = 'BASKETSTAGE') approval on approval.tdi_key = va_approvalstatus_id 
                left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
                on applntype.tdi_key = vt_applicationtype_id
                left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
                on termstage.tdi_key = vt_approvalstatus_id 
                 where vd_id = ".$prop_id);
            $iseditable = 1;

          /* $termtype=DB::select( "select 1 from cm_appln_valterm 
        inner join cm_appln_val on va_vt_id = vt_id
        inner join cm_appln_valdetl on  vd_va_id = va_id where vt_valbase_id = 2 and vd_id = ".$prop_id." limit 1"); 
*/
            foreach ($term as $rec) {
                $termname = $rec->termfoldername;
                $accountnumber = $rec->accountnumber;
                $viewparambasket = $rec->va_name;
                $viewparambasketstatus = $rec->approval;
                $propertystatus = $rec->vd_approvalstatus_id;
                $termid = $rec->va_vt_id;
                $termtype = $rec->vt_valbase_id;
                $applntype = $rec->applntype;
                $viewparamterm = "( ".$rec->applntype." ) ".$rec->vt_name." - ".$rec->termstage ;
                $manualpropstatus = $rec->vd_approvalstatus_id;
                if($rec->vd_approvalstatus_id == "07" || $rec->vd_approvalstatus_id == "08"|| $rec->vd_approvalstatus_id == "09"){
                    $iseditable = 1;
                } else {
                    $iseditable = 0;
                }
            }

            if ($manualpropstatus == "07") {
               // $register=DB::select("call proc_manaual_valuation_process(".$prop_id.", 10001, 10010,   '".$name."',  0, 0, @p_result)"); 
                 $iseditable = 0;
            }

            Log::info($applntype);

            $master = DB::select('select subzone.tdi_value subzone, subzone.tdi_parent_name zone, ap_bldgstatus_id, proptype.tdi_value proptype, 
                proptype.tdi_parent_name propcategorty,  bldgstatus.tdi_value bldgstatus, bldgstorey.tdi_value  bldgstorey
                from cm_appln_valdetl, cm_appln_parameter 
left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = "BULDINGTYPE") proptype
on proptype.tdi_key = ap_propertytype_id
left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = "ISHASBUILDING") bldgstatus
on bldgstatus.tdi_key = ap_bldgstatus_id
left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey
on bldgstorey.tdi_key = ap_propertylevel_id,
                cm_masterlist 
                left join (select tdi_key, tdi_value,tdi_parent_name from tbdefitems where tdi_td_name = "SUBZONE") subzone
                on subzone.`tdi_key` = ma_subzone_id
                where ap_vd_id  = vd_id and ma_id = vd_ma_id and vd_id = '.$prop_id);
            $bldgtype = '';
            foreach ($master as $rec) {
                $bldgtype = $rec->ap_bldgstatus_id;
            }

            
            $lot = DB::select('select DATE_FORMAT(vl_startdate, "%d/%m/%Y") vl_startdate1, DATE_FORMAT(vl_expireddate, "%d/%m/%Y") vl_expireddate1,cm_appln_val_lot.*, lotcode.tdi_value lotcode, roadtype.tdi_value roadtype, titletype.tdi_value titletype
        , unitsize.tdi_value unitsize, concat(lotcode.tdi_value,vl_no) lotnumber, concat(titletype.tdi_value,vl_titleno) titlenumber, landuse.tdi_value landuse, tentype.tdi_value tentype
         from cm_appln_val_lot left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE") lotcode on lotcode.tdi_key = vl_lotcode_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADTYPE") roadtype on roadtype.tdi_key = vl_roadtype_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE") titletype on titletype.tdi_key = vl_titletype_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SIZEUNIT") unitsize on unitsize.tdi_key = vl_sizeunit_id
        left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDUSE") landuse on  vl_landuse_id = landuse.tdi_key
        left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "TENURETYPE") tentype on  vl_tenuretype_id = tentype.tdi_key 
         where vl_vd_id = ifnull("'.$prop_id.'",0)');
        Log::info($lot );
            $bldg = DB::select(' select DATE_FORMAT(vb_cccdate, "%d/%m/%Y") vb_cccdate1, DATE_FORMAT(vb_occupieddate, "%d/%m/%Y") vb_occupieddate1,
                 cm_appln_val_bldg.*, bldgtype.tdi_value bldgtype, tdi_parent_name
                 bldgcategory, tdi_parent_key bldgcategory_id, bldgstorey.tdi_value bldgstorey, 
                bldgstr.tdi_value bldgstr,bldgcondn.tdi_value bldgcondn,bldgposition.tdi_value bldgposition,walltype.tdi_value walltype
                , rooftype.tdi_value rooftype, floortype.tdi_value floortype
                 from cm_appln_val_bldg left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype 
                 on bldgtype.tdi_key = vb_BLDGTYPE_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey
                on bldgstorey.tdi_key = vb_BLDGSTOREY_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGSTRUCTURE") bldgstr
                on bldgstr.tdi_key = vb_BLDGSTRUCTURE_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGCONDN") bldgcondn  
                on bldgcondn.tdi_key = vb_bldgcondn_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGPOSITION") bldgposition  
                on bldgposition.tdi_key = vb_bldgposition_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROOFTYPE") rooftype  
                on rooftype.tdi_key = vb_rooftype_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "WALLTYPE") walltype  
                on walltype.tdi_key = vb_walltype_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "FLOORTYPE") floortype  
                on floortype.tdi_key = vb_floortype_id
                where vb_vd_id = ifnull("'.$prop_id.'",0)');
            
              $bldgar = DB::select('select cm_appln_val_bldgarea.*,
            vb_id,
            arlvel.tdi_value arlvel, 
            arlvel.tdi_sort arlvelsort, 
            arcate.tdi_value arcate, 
            arcate.tdi_sort arcatesort, 
            artype.tdi_value artype, 
            artype.tdi_sort artypesort,
            aruse.tdi_value aruse 
            from cm_appln_val_bldgarea  
            left join (select tdi_key, tdi_value, tdi_sort from tbdefitems where tdi_td_name = "AREATYPE") artype on artype.tdi_key = cm_appln_val_bldgarea.vba_AREATYPE_ID
            left join (select tdi_key, tdi_value, tdi_sort from tbdefitems where tdi_td_name = "AREACATEGORY") arcate on  arcate.tdi_key = vba_AREACATEGORY_ID
            left join (select tdi_key, tdi_value, tdi_sort from tbdefitems where tdi_td_name = "AREALEVEL") arlvel on  arlvel.tdi_key = vba_AREALEVEL_ID 
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAUSE") aruse on aruse.tdi_key = vba_areause_id,
            cm_appln_val_bldg 
            where vba_vb_id = vb_id and vb_vd_id = ifnull("'.$prop_id.'",0)
            order by  artype.tdi_sort, arlvel.tdi_sort ');

               $allowance = DB::select('select *, vb_id, allowancetype.tdi_value allowancetype,allowancetype.tdi_parent_name allowancecategory, allowancemethod.tdi_value allowancemethod 
            from cm_appln_val_bldgallowances
            left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = "ALLOWANCECALMETHOD") allowancemethod on  allowancemethod.tdi_key = vbal_calcmethod_id 
            left join (select tdi_key, tdi_value,tdi_parent_name from tbdefitems where tdi_td_name = "ALLOWANCETYPE") allowancetype on allowancetype.tdi_key = vbal_allowancetype_id 
             , cm_appln_val_bldg where vbal_vb_id = vb_id and vb_vd_id = ifnull("'.$prop_id.'",0)');           
            
             $tax = DB::select('select `vt_id`, `vt_vd_id`, vt_derivedrate, vt_derivedvalue, `vt_grossvalue`, `vt_valuedescretion`, `vt_proposednt`, `vt_proposedrate`, `vt_calculatedrate`,  
`vt_proposedtax`, `vt_approvednt`,  `vt_approvedrate`, `vt_adjustment`,  `vt_approvedtax`,  `vt_note`,
`vt_createby`,  `vt_createdate`,  `vt_updateby`,  `vt_updatedate`
FROM `cm_appln_val_tax` where vt_vd_id = ifnull("'.$prop_id.'",0)');

              $lotarea = DB::select('select * from cm_appln_val_lotarea, cm_appln_val_lot where vla_vt_id = vl_id and vl_vd_id = ifnull("'.$prop_id.'",0) order by vla_id asc ');


        App::setlocale(session()->get('locale'));

        return view('valuation.manual.manualvaluationdetail')->with(array('lot'=>$lot,'bldg'=>$bldg,'master' => $master,'prop_id' => $prop_id, 'viewparambasket' => $viewparambasket, 'viewparambasketstatus' => $viewparambasketstatus, 'viewparamterm' => $viewparamterm, 'termid' => $termid, 'accountnumber' => $accountnumber,
                    'iseditable' => $iseditable,'pb'=>$pb,'lotarea' => $lotarea,'bldgar' => $bldgar,'tax' => $tax));
    }

    public function landDetail(Request $request){
        $id = $request->input('id');
        //$page  = $request->input('page');


            $lotdetail = DB::select('select DATEDIFF(vl_startdate,vl_expireddate) duration, landposition.tdi_value landposition, DATE_FORMAT(vl_startdate, "%d/%m/%Y") vl_startdate1, DATE_FORMAT(vl_expireddate, "%d/%m/%Y") vl_expireddate1,cm_appln_val_lot.*, lotcode.tdi_value lotcode, roadtype.tdi_value roadtype, titletype.tdi_value titletype
            , unitsize.tdi_value unitsize, concat(lotcode.tdi_value,vl_no) lotnumber, concat(titletype.tdi_value,vl_titleno) titlenumber, landuse.tdi_value landuse, tentype.tdi_value tentype
             from cm_appln_val_lot left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE") lotcode on lotcode.tdi_key = vl_lotcode_id
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADTYPE") roadtype on roadtype.tdi_key = vl_roadtype_id
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE") titletype on titletype.tdi_key = vl_titletype_id
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SIZEUNIT") unitsize on unitsize.tdi_key = vl_sizeunit_id
            left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDUSE") landuse on  vl_landuse_id = landuse.tdi_key
            left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "TENURETYPE") tentype on  vl_tenuretype_id = tentype.tdi_key 
            left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDPOSITION") landposition on  vl_landposision_id = landposition.tdi_key 
            where vl_id = ifnull("'.$id.'",0)');
     
        $lot = DB::select('select * from cm_appln_val_lotarea where vla_vt_id =  ifnull("'.$id.'",0)');
        
        App::setlocale(session()->get('locale'));
        return view('valuation.popup.landarea')->with(array('lot'=>$lot,'lotdetail'=>$lotdetail,'id'=>$id));
    }

    public function bldgDetail(Request $request){
        $id = $request->input('id');
        
        $bldgar = DB::select('select cm_appln_val_bldgarea.*, arlvel.tdi_value arlvel, arcate.tdi_value arcate
        , artype.tdi_value artype, aruse.tdi_value aruse from cm_appln_val_bldgarea  left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREATYPE") artype on artype.tdi_key = cm_appln_val_bldgarea.vba_AREATYPE_ID
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREACATEGORY") arcate on  arcate.tdi_key = vba_AREACATEGORY_ID
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREALEVEL") arlvel on  arlvel.tdi_key = vba_AREALEVEL_ID 
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAUSE") aruse on aruse.tdi_key = vba_areause_id 
                 where vba_vb_id = ifnull("'.$id.'",0)');

        $allowancecategory = DB::select(" select * from tbdefitems WHERE tdi_td_name = 'ALLOWANCECATEGORY';");
        
        $calcmethod = DB::select("select * from tbdefitems WHERE tdi_td_name = 'ALLOWANCECALMETHOD'");
        
        $bldg = DB::select(' select DATE_FORMAT(vb_cccdate, "%d/%m/%Y") vb_cccdate1, DATE_FORMAT(vb_occupieddate, "%d/%m/%Y") vb_occupieddate1,
                 cm_appln_val_bldg.*, bldgtype.tdi_value bldgtype, tdi_parent_name
                 bldgcategory, tdi_parent_key bldgcategory_id, bldgstorey.tdi_value bldgstorey, 
                bldgstr.tdi_value bldgstr,bldgcondn.tdi_value bldgcondn,bldgposition.tdi_value bldgposition,walltype.tdi_value walltype
                , rooftype.tdi_value rooftype, floortype.tdi_value floortype
                 from cm_appln_val_bldg left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype 
                 on bldgtype.tdi_key = vb_BLDGTYPE_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey
                on bldgstorey.tdi_key = vb_BLDGSTOREY_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGSTRUCTURE") bldgstr
                on bldgstr.tdi_key = vb_BLDGSTRUCTURE_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGCONDN") bldgcondn  
                on bldgcondn.tdi_key = vb_bldgcondn_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGPOSITION") bldgposition  
                on bldgposition.tdi_key = vb_bldgposition_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROOFTYPE") rooftype  
                on rooftype.tdi_key = vb_rooftype_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "WALLTYPE") walltype  
                on walltype.tdi_key = vb_walltype_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "FLOORTYPE") floortype  
                on floortype.tdi_key = vb_floortype_id
                where vb_id = ifnull("'.$id.'",0)');
        
        $allowance = DB::select('select *, allowancetype.tdi_value allowancetype,allowancetype.tdi_parent_name allowancecategory, allowancemethod.tdi_value allowancemethod from cm_appln_val_bldgallowances
        left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = "ALLOWANCECALMETHOD") allowancemethod on  allowancemethod.tdi_key = vbal_calcmethod_id 
        left join (select tdi_key, tdi_value,tdi_parent_name from tbdefitems where tdi_td_name = "ALLOWANCETYPE") allowancetype on allowancetype.tdi_key = vbal_allowancetype_id 
                 where vbal_vb_id = ifnull("'.$id.'",0)');           
        
        App::setlocale(session()->get('locale'));

        return view('valuation.popup.bldgdetail')->with(array('bldgar'=>$bldgar,'allowance'=>$allowance,'bldg'=>$bldg,'id'=>$id,'allowancecategory'=>$allowancecategory,'calcmethod'=>$calcmethod));
    }

    public function validateProperty(Request $request){
        $tonebasket_id = $request->input('tonebasket_id');
        $tonetaxbasket_id = $request->input('tonetaxbasket_id');
        $valuatuion_id = $request->input('valuatuion_id');
        $drivedrate = $request->input('drivedrate');
       // $drivedvalue = $request->input('drivedvalue');
            
        $bldgar = DB::select('select subzone.tdi_parent_name zone,  subzone.tdi_value subzone, ma_subzone_id, 
bldgtype.tdi_parent_name bldgcategory, 
bldgtype.tdi_value bldgtype, ab_bldgtype_id, bldgstorey.tdi_value bldgstorey,
ab_bldgstorey_id,   
 artype.tdi_value artype, aba_areatype_id, arlvl.tdi_value arlvl, aba_arealevel_id,  arcate.tdi_value arcate,aba_areacategory_id ,
  aruse.tdi_value aruse, aba_areause_id, vt_valbase_id, approvalstatus
from cm_appln_bldg inner join cm_appln_valdetl on  ab_vd_id = vd_id 
inner join cm_masterlist on  ma_id = vd_ma_id 
inner join cm_appln_val on va_id = vd_va_id 
inner join cm_appln_valterm on vt_id = va_vt_id
 inner join cm_appln_bldgarea
  on aba_ab_id = ab_id
  inner join tbdefitems subzone on subzone.tdi_key = ma_subzone_id and subzone.tdi_td_name = "SUBZONE"
  inner join tbdefitems bldgtype on bldgtype.tdi_key = ab_bldgtype_id and bldgtype.tdi_td_name = "BULDINGTYPE"
  inner join tbdefitems bldgstorey on bldgstorey.tdi_key = ab_bldgstorey_id and bldgstorey.tdi_td_name = "BUILDINGSTOREY"
  inner join tbdefitems arlvl on arlvl.tdi_key = aba_arealevel_id and arlvl.tdi_td_name = "AREALEVEL"
  inner join tbdefitems artype on artype.tdi_key = aba_areatype_id and artype.tdi_td_name = "AREATYPE"
  inner join tbdefitems arcate on arcate.tdi_key = aba_areacategory_id and arcate.tdi_td_name = "AREACATEGORY"
  inner join tbdefitems aruse on aruse.tdi_key = aba_areause_id and aruse.tdi_td_name = "AREAUSE" 
left join cm_tone_building on (tbldg_tone_id   = '.$tonebasket_id.') AND (tbldg_subzon_id    = ma_subzone_id) and (tbldg_proptype_id        = ab_bldgtype_id) AND (tbldg_propstorey_id = ab_bldgstorey_id)
AND (tbldg_areatype_id     = aba_areatype_id) AND (tbldg_arealevel_id    = aba_arealevel_id)
AND (tbldg_areacategory_id     = aba_areacategory_id) AND (tbldg_areause_id    = aba_areause_id)
left join (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval 
on approval_id = tbldg_approvalbldgstatus_id
   where ((SELECT tbldg_value
FROM cm_tone_building
            WHERE (tbldg_tone_id   = '.$tonebasket_id.')
            AND (tbldg_subzon_id    = ma_subzone_id)
            AND (tbldg_proptype_id        = ab_bldgtype_id)
            AND (tbldg_propstorey_id = ab_bldgstorey_id)
            AND (tbldg_areatype_id     = aba_areatype_id)
            AND (tbldg_arealevel_id    = aba_arealevel_id)
            AND (tbldg_areacategory_id     = aba_areacategory_id)
            AND (tbldg_areause_id    = aba_areause_id)
            AND (tbldg_approvalbldgstatus_id = 3)) IS NULL) and vd_va_id = '.$valuatuion_id.' group by subzone.tdi_parent_name, bldgtype.tdi_parent_name , subzone.tdi_value,  ma_subzone_id, bldgtype.tdi_value , ab_bldgtype_id, bldgstorey.tdi_value ,
ab_bldgstorey_id,  
 artype.tdi_value , aba_areatype_id, arlvl.tdi_value , aba_arealevel_id,  arcate.tdi_value ,aba_areacategory_id ,
  aruse.tdi_value , aba_areause_id, approvalstatus');

      /*  $bldgallowance = DB::select('select distinct ab_bldgposition_id,  bldgcategory.tdi_parent_key
            from cm_appln_valdetl, cm_masterlist, cm_appln_bldg left join 
            ( select tdi_parent_key,tdi_key  from tbdefitems where tdi_td_name = "BULDINGTYPE"
                  ) bldgcategory   on bldgcategory.tdi_key = ab_bldgtype_id
            where ab_vd_id = vd_id and  ma_id = vd_ma_id and vd_va_id = '.$valuatuion_id.'
            and (SELECT tallo_value
            FROM cm_tone_bldg_allowances
            WHERE (tallo_tone_id   = '.$tonebasket_id.')
            AND (tallo_buldingcategory_id    = bldgcategory.tdi_parent_key)
            AND (tallo_allowancetype_id        = ab_bldgposition_id)) IS NULL'); // not required*/

         $depreciation = DB::select('select distinct ab_bldgcondn_id, bldgcond.tdi_value bldgcond, approvalstatus
            from cm_appln_valdetl, cm_masterlist, cm_appln_bldg
  inner join tbdefitems bldgcond on bldgcond.tdi_key = ab_bldgcondn_id and bldgcond.tdi_td_name = "BLDGCONDN"
  left join cm_tone_bldg_depreciation on (tdepre_tone_id   = '.$tonebasket_id.')         AND (tdepre_bldgcondn_id    = ab_bldgcondn_id)
  left join (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval 
  on approval_id = tdepre_approvaltdeprestatus_id
            where ab_vd_id = vd_id and  ma_id = vd_ma_id and vd_va_id = '.$valuatuion_id.'
            and (SELECT tdepre_value
            FROM cm_tone_bldg_depreciation
            WHERE (tdepre_tone_id   = '.$tonebasket_id.')
            AND (tdepre_bldgcondn_id    = ab_bldgcondn_id)
            AND (tdepre_approvaltdeprestatus_id = 3)) IS NULL');

        $land = DB::select('select subzone.tdi_parent_name zone,  ma_subzone_id, subzone.tdi_value subzone, ap_bldgstatus_id, bldgstatus.tdi_value bldgstatus, ap_propertycategory_id,bldgcate.tdi_value bldgcate, approvalstatus,
 ap_propertytype_id, bldgtype.tdi_value bldgtype, ap_propertylevel_id, bldglevel.tdi_value bldglevel
            from cm_appln_valdetl inner join cm_appln_lot on al_vd_id = vd_id 
            inner join cm_appln_parameter on ap_vd_id  = vd_id 
            inner join cm_masterlist on ma_id = vd_ma_id
            inner join tbdefitems subzone on subzone.tdi_key = ma_subzone_id and subzone.tdi_td_name = "SUBZONE" 
            inner join tbdefitems bldgstatus on bldgstatus.tdi_key = ap_bldgstatus_id and bldgstatus.tdi_td_name = "ISHASBUILDING"
            inner join tbdefitems bldgcate on bldgcate.tdi_key = ap_propertycategory_id and bldgcate.tdi_td_name = "BULDINGCATEGORY"
            inner join tbdefitems bldgtype on bldgtype.tdi_key = ap_propertytype_id and bldgtype.tdi_td_name = "BULDINGTYPE"
            inner join tbdefitems bldglevel on bldglevel.tdi_key = ap_propertylevel_id and bldglevel.tdi_td_name = "BUILDINGSTOREY"
            left join cm_tone_land on (tland_tone_id   = '.$tonebasket_id.')
            AND (tland_ishasbuilding_id    = ap_bldgstatus_id)
            AND (tland_subzon_id        = ma_subzone_id)
            AND (tland_proptype_id = ap_propertytype_id)
            AND (tland_propstorey_id = ap_propertylevel_id)
left join (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval 
on approval_id = tland_approvaltlandstatus_id
            where ((SELECT tland_value
            FROM cm_tone_land
            WHERE (tland_tone_id   = '.$tonebasket_id.')
            AND (tland_ishasbuilding_id    = ap_bldgstatus_id)
            AND (tland_subzon_id        = ma_subzone_id)
            AND (tland_proptype_id = ap_propertytype_id)
            AND (tland_propstorey_id = ap_propertylevel_id)
            AND (tland_approvaltlandstatus_id = 3)) IS NULL ) and vd_va_id = '.$valuatuion_id.'
            group by subzone.tdi_parent_name, ma_subzone_id, subzone.tdi_value, ap_bldgstatus_id, bldgstatus.tdi_value, ap_propertycategory_id,bldgcate.tdi_value,
 ap_propertytype_id, bldgtype.tdi_value, ap_propertylevel_id, bldglevel.tdi_value, approvalstatus');

        $landstandard = DB::select('select distinct subzone.tdi_parent_name zone, ma_subzone_id, subzone.tdi_value subzone,  ap_propertytype_id, bldgtype.tdi_parent_name bldgcategory,
 bldgtype.tdi_value bldgtype, ap_propertylevel_id, bldglevel.tdi_value bldglevel, approvalstatus
 from cm_appln_valdetl
 inner join  cm_appln_lot on al_vd_id = vd_id 
 inner join cm_appln_parameter on ap_vd_id  = vd_id
 inner join cm_masterlist on  ma_id = vd_ma_id 
 inner join tbdefitems bldgtype on bldgtype.tdi_key = ap_propertytype_id and bldgtype.tdi_td_name = "BULDINGTYPE"
 inner join tbdefitems bldglevel on  bldglevel.tdi_key = ap_propertylevel_id and bldglevel.tdi_td_name = "BUILDINGSTOREY"
 inner join tbdefitems subzone on subzone.tdi_key = ma_subzone_id and subzone.tdi_td_name = "SUBZONE" 
left join cm_tone_land_standart on (tstand_tone_id   = '.$tonebasket_id.')
AND (tstand_subzon_id    = ma_subzone_id)
AND (tstand_proptype_id        = ap_propertytype_id)
AND (tstand_propstorey_id = ap_propertylevel_id)
left join (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval 
on approval_id = tstand_approvaltstandstatus_id
where  vd_va_id = '.$valuatuion_id.' 
and (SELECT tstand_standartarea
FROM cm_tone_land_standart
WHERE (tstand_tone_id   = '.$tonebasket_id.')
AND (tstand_subzon_id    = ma_subzone_id)
AND (tstand_proptype_id        = ap_propertytype_id)
AND (tstand_propstorey_id = ap_propertylevel_id)
AND (tstand_approvaltstandstatus_id = 3)) IS NULL');

        $tax = DB::select('
            select zone.tdi_parent_name zone, zone.tdi_parent_key, bldgstatus.tdi_value bldgstatus, ap_bldgstatus_id, 
            proptype.tdi_value proptype,  proptype.tdi_parent_name bldgcategory, ap_propertytype_id, 
            approvalstatus
            from cm_appln_valdetl inner join cm_appln_parameter on  ap_vd_id  = vd_id
            inner join cm_masterlist on ma_id = vd_ma_id 
                left join tbdefitems  zone
                on zone.tdi_key = ma_subzone_id and zone.tdi_td_name = "SUBZONE"
                inner join tbdefitems bldgstatus on bldgstatus.tdi_key = ap_bldgstatus_id and bldgstatus.tdi_td_name = "ISHASBUILDING"
                inner join tbdefitems proptype on proptype.tdi_key = ap_propertytype_id and proptype.tdi_td_name = "BULDINGTYPE" 
                left join cm_tone_taxrate on (trate_trlist_id   = '.$tonetaxbasket_id.')
                AND (trate_zon_id    = zone.tdi_parent_key)
                AND (trate_ishasbuilding_id        = ap_bldgstatus_id)
                AND (trate_proptype_id        = ap_propertytype_id)
                left join (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval 
                on approval_id = trate_approvaltratestatus_id 
                where vd_va_id = '.$valuatuion_id.'
                and (SELECT trate_value
                FROM cm_tone_taxrate
                WHERE (trate_trlist_id   = '.$tonetaxbasket_id.')
                AND (trate_zon_id    = zone.tdi_parent_key)
                AND (trate_ishasbuilding_id        = ap_bldgstatus_id)
                AND (trate_proptype_id        = ap_propertytype_id)
            AND (trate_approvaltratestatus_id = 3)) IS NULL group by   zone.tdi_parent_name , zone.tdi_parent_key, bldgstatus.tdi_value , ap_bldgstatus_id, 
            proptype.tdi_value , ap_propertytype_id, proptype.tdi_parent_name, approvalstatus ');
        $valautioncount =  DB::select("select * from cm_appln_valdetl where  vd_va_id = ".$valuatuion_id." and  vd_approvalstatus_id in ('06','07') ");
        $valpropcount = count($valautioncount);
       $bldgarcnt = count($bldgar);
       $depreciationcnt = count($depreciation);
       $landcnt = count($land);
       $landstandardcnt = count($landstandard);
       $taxcnt = count($tax);
        

        App::setlocale(session()->get('locale'));

       if ($bldgarcnt == 0 && $depreciationcnt == 0  && $landcnt == 0 && $landstandardcnt == 0 && $taxcnt == 0) {    
            $valuationbasket = DB::select('select va_id,va_name, va_vt_id termid, vt_name termaname,  
ifnull(propertycount,0) propertycount, applntype.tdi_value applntype
from cm_appln_val 
inner join cm_appln_valterm  on va_vt_id = vt_id
left join (select count(*) propertycount,vd_va_id from cm_appln_valdetl group by vd_va_id ) propcount on propcount.vd_va_id = va_id
left join (SELECT * FROM tbdefitems where tdi_td_name = "APPLICATIONTYPE") applntype on applntype.tdi_key = vt_applicationtype_id where  va_id = '.$valuatuion_id);  
            $tonebasket = DB::select('select tollist_id,tollis_year, tollis_enforceyear,tollis_desc from  cm_toneoflistbasket where tollist_id = '.$tonebasket_id);    
            $tonetaxbasket = DB::select('select * from  cm_taxratelistbasket where trlist_id = '.$tonetaxbasket_id);    
            return view('valuation.valuationpass')->with(array('valuationbasket'=>$valuationbasket,'tonebasket'=>$tonebasket,'tonetaxbasket'=>$tonetaxbasket,'drivedrate'=>$drivedrate,'valuatuion_id'=>$valuatuion_id,'valpropcount' => $valpropcount));
       } else {

            $bldgcate=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGCATEGORY"');
            $bldgtype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGTYPE"');
            $bldgstore=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY"');
            $hasbldg=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ISHASBUILDING"');
            $arlvl=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREALEVEL"');
            $arcaty=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREACATEGORY"');
            $artype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREATYPE"');
            $aruse=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAUSE"');
            $zone=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ZONE"');
            $subzone=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SUBZONE"');
            $transtype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TRANSACTIONTYPE"');
            $bldgcond=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGCONDN"');
            return view('valuation.valuationfail')->with(array('bldgar'=>$bldgar,'depreciation'=>$depreciation,'land'=>$land,'landstandard'=>$landstandard,'tax'=>$tax, 'bldgtype'=> $bldgtype,'bldgstore'=> $bldgstore,'arlvl'=> $arlvl ,'artype'=> $artype,'arcaty'=> $arcaty,'aruse'=> $aruse,'zone'=> $zone,'subzone'=> $subzone,'bldgcate'=> $bldgcate,'tonetaxbasket_id'=>$tonetaxbasket_id,'tonebasket_id'=>$tonebasket_id,'hasbldg'=> $hasbldg,'bldgcond'=> $bldgcond,'transtype'=> $transtype));
       }
    }

    public function massValuation(Request $request){
        DB::beginTransaction();
        $valuationbasket_id = $request->input('valuationbasket_id');
        $tonebasket_id = $request->input('tonebasket_id');
        $tonetaxbasket_id = $request->input('tonetaxbasket_id');
        $drivedvalue = 0;
        $drivedrate = $request->input('drivedrate');
        $name=Auth::user()->name;
        Log::info('BAsket  id '.$valuationbasket_id);
        Log::info("call proc_valuation_process(".$valuationbasket_id.", ".$tonebasket_id.", ".$tonetaxbasket_id.", '".$name."', '".$drivedvalue."', '".$drivedrate."',@p_result)");
        $lot = DB::select("call proc_valuation_process(".$valuationbasket_id.", ".$tonebasket_id.", ".$tonetaxbasket_id.", '".$name."', '".$drivedvalue."', '".$drivedrate."',@p_result)"); 
        $result=DB::select("select @p_result");
        $data = array();
        foreach ($result as $obj) {
           $data[] = (array)$obj;  
           #or first convert it and then change its properties using 
           #an array syntax, it's up to you
        }
        foreach ($data as $obj1) {
        $response = $obj1['@p_result'];
           #or first convert it and then change its properties using 
           #an array syntax, it's up to you
        }
        DB::commit();
        return response()->json(array('response'=> $response), 200);
    }

    public function manualValuation(Request $request){
        $prop_id = $request->input('prop_id');
        $lot_param = $request->input('lotdata');
        $bldg_param = $request->input('bldgdata');
        $lotarea_param = $request->input('lotareadata');
        $additional_param = $request->input('additionaldata');
        $bldgarea_param = $request->input('bldgareadata');
        $bldgallowance_param = $request->input('bldgallowancedata');
        $taxdata = $request->input('taxdata');
        $name=Auth::user()->name;

        DB::connection()->getPdo()->quote("'");
        //Log::info($taxdata);
        Log::info("call proc_manaualvaluation( '".$lot_param."', '".$bldg_param."', '".$lotarea_param."','".$additional_param."', '".$bldgarea_param."', '".$bldgallowance_param."',  '".$taxdata."', '".$name."',".$prop_id.")");
        $response = DB::select("call proc_manaualvaluation( '".$lot_param."', '".$bldg_param."', '".$lotarea_param."', '".$additional_param."', '".$bldgarea_param."', '".$bldgallowance_param."', '".$taxdata."', '".$name."',".$prop_id.")"); 
        
        return response()->json(array('response'=> $response), 200);
    }

    public function manualValuationV2(Request $request){
        $prop_id = $request->input('prop_id');
        $lot_param = $request->input('lotdata');
        $bldg_param = $request->input('bldgdata');
        $lotarea_param = $request->input('lotareadata');
        $additional_param = $request->input('additionaldata');
        $bldgarea_param = $request->input('bldgareadata');
        $bldgallowance_param = $request->input('bldgallowancedata');
        $taxdata = $request->input('taxdata');
        $name=Auth::user()->name;
        
        DB::connection()->getPdo()->quote("'");
        //Log::info($taxdata);
        Log::info("call proc_manaualvaluation_v2( '".$lot_param."', '".$bldg_param."', '".$lotarea_param."','".$additional_param."', '".$bldgarea_param."', '".$bldgallowance_param."',  '".$taxdata."', '".$name."',".$prop_id.")");
        $response = DB::select("call proc_manaualvaluation_v2( '".$lot_param."', '".$bldg_param."', '".$lotarea_param."', '".$additional_param."', '".$bldgarea_param."', '".$bldgallowance_param."', '".$taxdata."', '".$name."',".$prop_id.")"); 
        
        return response()->json(array('response'=> $response), 200);
    }


    public function manualValuation2(Request $request){
        $prop_id = $request->input('prop_id');
        $bldgarea_param = $request->input('bldgareadata');
        $name=Auth::user()->name;
        //Log::info($taxdata);
        Log::info("call proc_manaualbldg(  '".$bldgarea_param."', '".$name."',".$prop_id.")");
        $response = DB::select("call proc_manaualbldg(  '".$bldgarea_param."', '".$name."',".$prop_id.")"); 
        
        return response()->json(array('response'=> $response), 200);
    }

    

    public function resetValuation(Request $request){
        $id = $request->input('id');
        $name=Auth::user()->name;
        Log::info($id);
        
        $response = DB::select("call proc_resetmass( ".$id.",'B')"); 
        
        return response()->json(array('response'=> $response), 200);
    }


    public function manualLand(Request $request){
        $id = $request->input('id');
        
        $lot = DB::select('select DATE_FORMAT(al_startdate, "%d/%m/%Y") al_startdate1, DATE_FORMAT(al_expireddate, "%d/%m/%Y") al_expireddate1,cm_appln_lot.*, lotcode.tdi_value lotcode, roadtype.tdi_value roadtype, titletype.tdi_value titletype
        , unitsize.tdi_value unitsize, concat(lotcode.tdi_value,al_no) lotnumber, concat(titletype.tdi_value,al_titleno) titlenumber, landuse.tdi_value landuse, tentype.tdi_value tentype
         from cm_appln_lot left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE") lotcode on lotcode.tdi_key = al_lotcode_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADTYPE") roadtype on roadtype.tdi_key = al_roadtype_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE") titletype on titletype.tdi_key = al_titletype_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SIZEUNIT") unitsize on unitsize.tdi_key = al_sizeunit_id
        left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDUSE") landuse on  al_landuse_id = landuse.tdi_key
        left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "TENURETYPE") tentype on  al_tenuretype_id = tentype.tdi_key
        inner join  cm_appln_valdetl on  al_vd_id = vd_id
        where vd_id = '.$id.' and  vd_approvalstatus_id in ("06","07")');


        $building = DB::select('select DATE_FORMAT(ab_cccdate, "%d/%m/%Y") ab_cccdate1, DATE_FORMAT(ab_occupieddate, "%d/%m/%Y") ab_occupieddate1,cm_appln_bldg.*, bldgtype.tdi_value bldgtype, tdi_parent_name
        bldgcategory, tdi_parent_key bldgcategory_id, bldgstorey.tdi_value bldgstorey, 
        bldgstr.tdi_value bldgstr
        , rootype.tdi_value rootype, ab_id
        from cm_appln_bldg left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype 
        on bldgtype.tdi_key = AB_BLDGTYPE_ID
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey
        on bldgstorey.tdi_key = AB_BLDGSTOREY_ID
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGSTRUCTURE") bldgstr
        on bldgstr.tdi_key = AB_BLDGSTRUCTURE_ID
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROOFTYPE") rootype  
        on rootype.tdi_key = AB_ROOFTYPE_ID where ab_vd_id = ifnull("'.$id.'",0)');



        $bldgardetail = DB::select('select  cm_appln_bldgarea.*, cm_appln_bldg.ab_bldg_no, vd_accno, arzone.tdi_value arzone, arlvel.tdi_value arlvel, arcate.tdi_value arcate, floortype.tdi_value floortype
        , artype.tdi_value artype, aruse.tdi_value aruse, ceilingtype.tdi_value ceilingtype, walltype.tdi_value walltype
        from cm_appln_valdetl join  cm_appln_bldg on ab_vd_id = vd_id join cm_appln_bldgarea on aba_ab_id = ab_id 
        join tbdefitems artype on artype.tdi_key = cm_appln_bldgarea.ABA_AREATYPE_ID and  artype.tdi_td_name = "AREATYPE"
        join tbdefitems arcate on arcate.tdi_key = cm_appln_bldgarea.ABA_AREACATEGORY_ID  and arcate.tdi_td_name = "AREACATEGORY"
        left join tbdefitems arlvel on arlvel.tdi_key = cm_appln_bldgarea.ABA_AREALEVEL_ID and arlvel.tdi_td_name = "AREALEVEL" 
        left join tbdefitems arzone on arzone.tdi_key = cm_appln_bldgarea.ABA_AREAZONE_ID and arzone.tdi_td_name = "AREAZONE"
        left join tbdefitems floortype on floortype.tdi_key = cm_appln_bldgarea.ABA_FLOORTYPE_ID and floortype.tdi_td_name = "FLOORTYPE"
        left join tbdefitems aruse on aruse.tdi_key = cm_appln_bldgarea.aba_areause_id  and aruse.tdi_td_name = "AREAUSE"
        left join tbdefitems ceilingtype on ceilingtype.tdi_key = cm_appln_bldgarea.ABA_CEILINGTYPE_ID and ceilingtype.tdi_td_name = "CEILINGTYPE"
        left join tbdefitems walltype on walltype.tdi_key = cm_appln_bldgarea.aba_walltype_id  and walltype.tdi_td_name = "WALLTYPE" 
        where ab_vd_id = ifnull("'.$id.'",0)');
        
        App::setlocale(session()->get('locale'));
        
        return view("valuation.manual.lot")->with(array('lot'=> $lot,'id'=>$id,'building'=>$building,'bldgardetail'=>$bldgardetail));
    }


    public function landStarndard(Request $request){
        $id = $request->input('id');

        $lotdetail = DB::select('select DATEDIFF(al_startdate,al_expireddate) duration, landposition.tdi_value landposition, DATE_FORMAT(al_startdate, "%d/%m/%Y") al_startdate1, 
            DATE_FORMAT(al_expireddate, "%d/%m/%Y") al_expireddate1,cm_appln_lot.*, lotcode.tdi_value lotcode, roadtype.tdi_value roadtype,
             titletype.tdi_value titletype
            , unitsize.tdi_value unitsize, concat(lotcode.tdi_value,al_no) lotnumber, concat(titletype.tdi_value,al_titleno) titlenumber,
             landuse.tdi_value landuse, tentype.tdi_value tentype
             from cm_appln_lot
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE") lotcode on lotcode.tdi_key = al_lotcode_id
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADTYPE") roadtype on roadtype.tdi_key = al_roadtype_id
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE") titletype on titletype.tdi_key = al_titletype_id
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SIZEUNIT") unitsize on unitsize.tdi_key = al_sizeunit_id
            left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDUSE") landuse on  al_landuse_id = landuse.tdi_key
            left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "TENURETYPE") tentype on  al_tenuretype_id = tentype.tdi_key 
            left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDPOSITION") landposition on  al_landposision_id = landposition.tdi_key 
            where al_vd_id = ifnull("'.$id.'",0)');
        
        App::setlocale(session()->get('locale'));
        
        return view("valuation.manual.lotdetail")->with(array('id'=>$id,'lotdetail'=>$lotdetail));
    }

     public function bldgDetailManaual(Request $request){
        $id = $request->input('id');
        
        $bldgar = DB::select('select  cm_appln_bldgarea.*, cm_appln_bldg.ab_bldg_no, vd_accno, arzone.tdi_value arzone, arlvel.tdi_value arlvel, arcate.tdi_value arcate, floortype.tdi_value floortype
            , artype.tdi_value artype, aruse.tdi_value aruse, ceilingtype.tdi_value ceilingtype, walltype.tdi_value walltype
            from cm_appln_valdetl join  cm_appln_bldg on ab_vd_id = vd_id join cm_appln_bldgarea on aba_ab_id = ab_id 
            join tbdefitems artype on artype.tdi_key = cm_appln_bldgarea.ABA_AREATYPE_ID and  artype.tdi_td_name = "AREATYPE"
            join tbdefitems arcate on arcate.tdi_key = cm_appln_bldgarea.ABA_AREACATEGORY_ID  and arcate.tdi_td_name = "AREACATEGORY"
            left join tbdefitems arlvel on arlvel.tdi_key = cm_appln_bldgarea.ABA_AREALEVEL_ID and arlvel.tdi_td_name = "AREALEVEL" 
            left join tbdefitems arzone on arzone.tdi_key = cm_appln_bldgarea.ABA_AREAZONE_ID and arzone.tdi_td_name = "AREAZONE"
            left join tbdefitems floortype on floortype.tdi_key = cm_appln_bldgarea.ABA_FLOORTYPE_ID and floortype.tdi_td_name = "FLOORTYPE"
            left join tbdefitems aruse on aruse.tdi_key = cm_appln_bldgarea.aba_areause_id  and aruse.tdi_td_name = "AREAUSE"
            left join tbdefitems ceilingtype on ceilingtype.tdi_key = cm_appln_bldgarea.ABA_CEILINGTYPE_ID and ceilingtype.tdi_td_name = "CEILINGTYPE"
            left join tbdefitems walltype on walltype.tdi_key = cm_appln_bldgarea.aba_walltype_id  and walltype.tdi_td_name = "WALLTYPE"
            where ab_id = ifnull("'.$id.'",0)');

        $allowancecategory = DB::select(" select * from tbdefitems WHERE tdi_td_name = 'ALLOWANCECATEGORY';");
        
        $calcmethod = DB::select("select * from tbdefitems WHERE tdi_td_name = 'ALLOWANCECALMETHOD'");
        
        
        App::setlocale(session()->get('locale'));
        
        return view('valuation.manual.bldgdetail')->with(array('bldgar'=>$bldgar, 'id'=>$id,'allowancecategory'=>$allowancecategory,'calcmethod'=>$calcmethod));
    }

    public function manaualValuationProcess(Request $request){
        $prop_id = $request->input('prop_id');
        $lot_param = $request->input('lotdata');
        $bldg_param = $request->input('bldgdata');
        $lotarea_param = $request->input('lotareadata');
        $additional_param = $request->input('additionaldata');
        $bldgarea_param = $request->input('bldgareadata');
        $bldgallowance_param = $request->input('bldgallowancedata');
        $taxdata = $request->input('taxdata');
        $name=Auth::user()->name;
        //Log::info($taxdata);
        Log::info("call proc_manaualvaluation_v2( '".$lot_param."', '".$bldg_param."', '".$lotarea_param."','".$additional_param."', '".$bldgarea_param."', '".$bldgallowance_param."',  '".$taxdata."', '".$name."',".$prop_id.")");
        $response = DB::select("call proc_manaualvaluation_v2( '".$lot_param."', '".$bldg_param."', '".$lotarea_param."', '".$additional_param."', '".$bldgarea_param."', '".$bldgallowance_param."', '".$taxdata."', '".$name."',".$prop_id.")"); 
        
        return response()->json(array('response'=> $response), 200);
    }
}
