<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Log;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DataTables;
use userpermission;
use App;

class InspectionController extends Controller
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

   /* public function checkaccess($module){

        $msg = "false";
        
        $name=Auth::user()->name;

        $permission = DB::select(DB::raw("select mod_id, mod_name,usr_name from tbuser, tbrole, tbmodule, tbaccess where usr_role_id = rol_id 
            and acc_role_id = rol_id and acc_module_id = mod_id and usr_name = :uf and mod_id = :up"), 
            array(":uf" => $name, ":up" => $module));
        //Log::info($permission);
        foreach ($permission as $obj) {            
            $msg = "true";                   
        }
        Log::info($msg);
        return $msg;
    }*/

    /**
    *
    */
    public function newProperty(Request $request){    
        
        $isfilter = $request->input('filter');
        $basketid = $request->input('id');
        $basket_id = $request->input('basket_id');
        $type = $request->input('type');
        
		
    	$search=DB::select(' select sd_key, sd_label, 
        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid 
        from tbsearchdetail mtb where sd_se_id = 13 ');
        App::setlocale(session()->get('locale'));
    	return view('inspection.newproperty')->with('search',$search)->with('id',$basketid)->with('basket_id',$basket_id);
    }


    public function newPropertyData(Request $request){
        Log::info('Test F');
        ini_set('max_execution_time', '360');
        ini_set('memory_limit', '2056M');
        $baskedid = $request->input('id');
        $maxRow = 30;

        $isfilter = $request->input('filter');
        $filterquery = '';
        if($isfilter == 'true'){
            $input = $request->input();
            $condition = $input['condition'];
            $value = $input['value'];
            $logic = $input['logic'];
            $fieldcolumn = $input['field'];

             foreach ($input['field'] as $fieldindex => $field) {
                if ($fieldcolumn[$fieldindex] == "tdi_key") {
                    $fieldcolumn[$fieldindex] = 'tbdefitems_subzone.tdi_key';
                }/*
                if ($fieldcolumn[$fieldindex] == "vt_id") {
                    $fieldcolumn[$fieldindex] = '';
                }*/
                if($value[$fieldindex] != ""){
                    if($fieldindex == count($input['field']) - 1) {
                        if($fieldcolumn[$fieldindex] != ""){
                            $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' "'.$value[$fieldindex].'"';
                         }
                    } else {
                        if($fieldcolumn[$fieldindex] != ""){
                           $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' "'.$value[$fieldindex].'" '.$logic[$fieldindex];    
                        }   
                    }
                }               
            }
            if($filterquery != ''){
                $filterquery  = ' AND '. $filterquery ;
            }
            Log::info($filterquery);

        }
       // str_replace('tdi_key', 'tbdefitems_subzone.tdi_key', $filterquery);
        Log::info($filterquery);
        /* $property = DB::table('cm_appln_valdetl')->join('cm_masterlist', 'vd_ma_id', '=', 'ma_id')->leftJoin('cm_appln_val_tax', 'vd_id', '=', 'vt_vd_id')->leftJoin('tbdefitems_ishasbuilding', 'vd_ishasbuilding', '=', 'tbdefitems_ishasbuilding.tdi_key')->leftJoin('tbdefitems_bldgtype', 'vd_bldgtype_id', '=', 'tbdefitems_bldgtype.tdi_key')->leftJoin('tbdefitems_bldgstorey', 'vd_bldgstorey_id', '=', 'tbdefitems_bldgstorey.tdi_key')->select( 'vd_approvalstatus_id','vd_id', 'vd_va_id','ma_id', 'ma_pb_id', 'ma_fileno', 'ma_accno',
        'ma_addr_ln1', 'tbdefitems_ishasbuilding.tdi_value' ,
        'tbdefitems_bldgtype.tdi_value', 'tbdefitems_bldgstorey.tdi_value', 'tbdefitems_bldgtype.tdi_parent_name as bldgcategory',
        'vt_approvednt', 'vt_approvedtax', 'vt_proposedrate', 'vt_note')->where('vd_va_id', '=', $baskedid)->paginate(15);      */     
    // $property = DB::select('select * from property where vd_approvalstatus_id = "13" '.$filterquery);
       $property = DB::select('select BL_BLDGTYPE_ID,ma_subzone_id,ma_id, ma_pb_id,  ma_accno,  zone.tdi_value zone, subzone.tdi_value subzone,
         to_ownname, ma_addr_ln1, isbldg.tdi_value isbldg
        from cm_masterlist
        inner join cm_propbasket on PB_ID = ma_pb_id
        left join cm_bldg on BL_MA_ID = ma_id and BL_ISMAINBLDG_ID = "Y"
        left join cm_owner on to_ma_id = ma_id  
        inner join tbdefitems subzone
        on ma_subzone_id = subzone.tdi_key and subzone.tdi_td_name = "SUBZONE"
        inner join tbdefitems  zone
        on subzone.tdi_parent_key = zone.tdi_key and zone.tdi_td_name = "ZONE"
        inner join tbdefitems isbldg
        on ma_ishasbuilding_id = isbldg.tdi_key and isbldg.tdi_td_name = "ISHASBUILDING" where ma_pb_id =   '.$baskedid.' '. $filterquery);
        
        $propertyDetails = Datatables::collection($property)->make(true);
        App::setlocale(session()->get('locale'));
        return $propertyDetails;
    }

    public function grabBasket(Request $request){
        $insbasket_id = $request->input('insbasket_id');
        $aptype = $request->input('aptype');
        $basket = DB::select("select pb_id, pb_name, pb_approvedby, DATE_FORMAT(pb_approvedate, '%d/%m/%Y') pb_approvedate, (select count(*) from cm_masterlist where ma_pb_id = pb_id) propcnt from cm_propbasket where PB_APPROVALSTATUS_ID = '03' and 
            PB_APPLICATIONTYPE_ID = '".$aptype."'");
        App::setlocale(session()->get('locale'));
        return view('inspection.grab.basket')->with(array('id'=>$insbasket_id,'basket'=>$basket));
    }

    public function grappdata(Request $request){
    	$input = $request->input();
    	$accounts = $input['accounts'];
        $reason = $request->input('reason');
        $desc = $request->input('desc');
        $basketid = $request->input('id');
        $type = $request->input('type');
        $name=Auth::user()->name;
    	//$sql = 'call proc_grabdata("'.$accounts.'",1)';
        if($type=='addpropbasket'){

            Log::info("call proc_grabbasketdata('".$accounts."',".$basketid.",'".$name."','".$type."','".$reason."','".$desc."',@p_newprop)");
            $search=DB::select("call proc_grabbasketdata('".$accounts."',".$basketid.",'".$name."','".$type."','".$reason."','".$desc."',@p_newprop)"); 
            $result=DB::select("select @p_newprop");

        } else {
            $accounts = implode(",",$accounts);

            Log::info("call proc_grabdata('',".$basketid.",'".$name."','".$type."','".$reason."','".$desc."',@p_newprop)");
            $search=DB::select("call proc_grabdata('',".$basketid.",'".$name."','".$type."','".$reason."','".$desc."',@p_newprop)"); 
            $result=DB::select("select @p_newprop");

        }

        Log::info($result);
        $data = array();
        foreach ($result as $obj) {
           $data[] = (array)$obj;  
           #or first convert it and then change its properties using 
           #an array syntax, it's up to you
        }
        foreach ($data as $obj1) {
        $count = $obj1['@p_newprop'];
           #or first convert it and then change its properties using 
           #an array syntax, it's up to you
        }
    	return response()->json(array('data'=> 'true','newcount'=> $count), 200);
    }


    public function existspropertymaintenancetrn(Request $request){
        $input = $request->input();
        $accounts = $input['accounts'];
        $reason = $request->input('reason');
        $desc = $request->input('desc');
        $basketid = $request->input('id');
        $type = $request->input('type');
       // $accounts = implode(",",$accounts);
        $name=Auth::user()->name;
        //$sql = 'call proc_grabdata("'.$accounts.'",1)';
        Log::info("call proc_existspropertymaintenance('".$accounts."',".$basketid.",'".$name."')");
        $search=DB::select("call proc_existspropertymaintenance('".$accounts."',".$basketid.",'".$name."')"); 
       // $result=DB::select("select @p_newprop");
       // Log::info($result);
        $count=0;
       /* $data = array();
        foreach ($result as $obj) {
           $data[] = (array)$obj;  
           #or first convert it and then change its properties using 
           #an array syntax, it's up to you
        }
        foreach ($data as $obj1) {
        $count = $obj1['@p_newprop'];
           #or first convert it and then change its properties using 
           #an array syntax, it's up to you
        }*/
        return response()->json(array('data'=> 'true','newcount'=> $count), 200);
    }

   public function grapnewdata(Request $request){
        $input = $request->input();
        $accounts = $input['accounts'];
        $reason = $request->input('reason');
        $desc = $request->input('desc');
        $basketid = $request->input('id');
        $type = $request->input('type');
        //$accounts = implode(",",$accounts);
        $name=Auth::user()->name;
        //$sql = 'call proc_grabdata("'.$accounts.'",1)';
        Log::info("call proc_inspectiongrap('".$accounts."',".$basketid.",'".$name."','".$type."','".$reason."','".$desc."',@p_newprop)");
        $search=DB::select("call proc_inspectiongrap('".$accounts."',".$basketid.",'".$name."','".$type."','".$reason."','".$desc."',@p_newprop)"); 
        $result=DB::select("select @p_newprop");
        Log::info($result);
        $data = array();
        foreach ($result as $obj) {
           $data[] = (array)$obj;  
           #or first convert it and then change its properties using 
           #an array syntax, it's up to you
        }
        foreach ($data as $obj1) {
        $count = $obj1['@p_newprop'];
           #or first convert it and then change its properties using 
           #an array syntax, it's up to you
        }
        return response()->json(array('data'=> 'true','newcount'=> $count), 200);
    }

    /**
    *
    */
    public function exsitsProperty(Request $request){
        $isfilter = $request->input('filter');
        $basketid = $request->input('id');
        $basket_id = $request->input('basket_id');
        $type = $request->input('type');
        $filterquery = '';
        if($isfilter == 'true'){
            $input = $request->input();
            $condition = $input['condition'];
            $value = $input['value'];
            $logic = $input['logic'];
            $fieldcolumn = $input['field'];

             foreach ($input['field'] as $fieldindex => $field) {
                
                if($value[$fieldindex] != ""){
                    if($fieldindex == count($input['field']) - 1) {
                        if($fieldcolumn[$fieldindex] != ""){
                            $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' "'.$value[$fieldindex].'"';
                         }
                    } else {
                        if($fieldcolumn[$fieldindex] != ""){
                           $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' "'.$value[$fieldindex].'" '.$logic[$fieldindex];    
                        }   
                    }
                }               
            }
            if($filterquery != ''){
                $filterquery  = ' AND '. $filterquery ;
            }
            Log::info($filterquery);

        }
        $condition = '';
        if ($type ==2 ){
            // $condition = ' AND PB_APPROVED = 12';
        }
        Log::info($filterquery.''.$condition);
       /* $property = DB::select('select `vd_approvalstatus_id`, `vd_id`, `vd_va_id`, `ma_id`, `ma_pb_id`, `ma_fileno`, `ma_accno`, `vd_accno`,
        `tbdefitems_subzone`.`tdi_parent_name` `zone`, `tbdefitems_subzone`.`tdi_value` `subzone`, `ma_addr_ln1`, 
        `tbdefitems_ishasbuilding`.`tdi_value` `isbldg`, `tbdefitems_bldgtype`.`tdi_value` `bldgtype`, `tbdefitems_bldgtype`.`tdi_parent_name` `bldgcategory`,bldgsotery.tdi_value bldgsotery, 
        `vt_approvednt`, `vt_approvedtax`,  `vt_proposedrate`, `vt_note`, propertstatus.tdi_desc propertstatus
        FROM `cm_appln_valdetl`
        INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
        LEFT JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
        LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
        LEFT JOIN `tbdefitems_ishasbuilding` ON `cm_appln_valdetl`.`vd_ishasbuilding` = `tbdefitems_ishasbuilding`.`tdi_key`
        LEFT JOIN `tbdefitems_bldgtype` ON `tbdefitems_bldgtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id` 
        left join (select *  from tbdefitems where tdi_td_name = "PROPERTYSTAGE") propertstatus
        on propertstatus.tdi_key = vd_approvalstatus_id 
        left join (select *  from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgsotery
        on bldgsotery.tdi_key = vd_bldgstorey_id where vd_id in (select MAX(vd_id) from cm_appln_valdetl group by vd_ma_id)  '. $filterquery.''.$condition);*/
        
        $search=DB::select(' select sd_key, sd_label, 
        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid, sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = 18 ');
        App::setlocale(session()->get('locale'));
        return view('inspection.grab.exsitsproperty')->with('search',$search)->with('id',$basketid)->with('basket_id',$basket_id);
    }

    /**
    *
    */
    public function exsitsPropertyMaintanace(Request $request){
        $isfilter = $request->input('filter');
        $basketid = $request->input('id');
        $basket_id = $request->input('basket_id');
        $type = $request->input('type');
        $filterquery = '';
        if($isfilter == 'true'){
            $input = $request->input();
            $condition = $input['condition'];
            $value = $input['value'];
            $logic = $input['logic'];
            $fieldcolumn = $input['field'];

             foreach ($input['field'] as $fieldindex => $field) {
                
                if($value[$fieldindex] != ""){
                    if($fieldindex == count($input['field']) - 1) {
                        if($fieldcolumn[$fieldindex] != ""){
                            $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' "'.$value[$fieldindex].'"';
                         }
                    } else {
                        if($fieldcolumn[$fieldindex] != ""){
                           $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' "'.$value[$fieldindex].'" '.$logic[$fieldindex];    
                        }   
                    }
                }               
            }
            if($filterquery != ''){
                $filterquery  = ' AND '. $filterquery ;
            }
            Log::info($filterquery);

        }
        $condition = '';
        if ($type ==2 ){
            // $condition = ' AND PB_APPROVED = 12';
        }
        Log::info($filterquery.''.$condition);
       /* $property = DB::select('select `vd_approvalstatus_id`, `vd_id`, `vd_va_id`, `ma_id`, `ma_pb_id`, `ma_fileno`, `ma_accno`, `vd_accno`,
        `tbdefitems_subzone`.`tdi_parent_name` `zone`, `tbdefitems_subzone`.`tdi_value` `subzone`, `ma_addr_ln1`, 
        `tbdefitems_ishasbuilding`.`tdi_value` `isbldg`, `tbdefitems_bldgtype`.`tdi_value` `bldgtype`, `tbdefitems_bldgtype`.`tdi_parent_name` `bldgcategory`,bldgsotery.tdi_value bldgsotery, 
        `vt_approvednt`, `vt_approvedtax`,  `vt_proposedrate`, `vt_note`, propertstatus.tdi_desc propertstatus
        FROM `cm_appln_valdetl`
        INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
        LEFT JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
        LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
        LEFT JOIN `tbdefitems_ishasbuilding` ON `cm_appln_valdetl`.`vd_ishasbuilding` = `tbdefitems_ishasbuilding`.`tdi_key`
        LEFT JOIN `tbdefitems_bldgtype` ON `tbdefitems_bldgtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id` 
        left join (select *  from tbdefitems where tdi_td_name = "PROPERTYSTAGE") propertstatus
        on propertstatus.tdi_key = vd_approvalstatus_id 
        left join (select *  from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgsotery
        on bldgsotery.tdi_key = vd_bldgstorey_id where vd_id in (select MAX(vd_id) from cm_appln_valdetl group by vd_ma_id)  '. $filterquery.''.$condition);*/
        
        $search=DB::select(' select sd_key, sd_label, 
        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid, sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = 18 ');
        App::setlocale(session()->get('locale'));
        return view('existspropertyregister.grab.property')->with('search',$search)->with('id',$basketid)->with('basket_id',$basket_id);
    }

    public function existPropertyMaintenanceTables(Request $request){
        Log::info('Test F');
        ini_set('memory_limit', '2056M');
       // $baskedid = $request->input('id');
        $maxRow = 30;

        $isfilter = $request->input('filter');
        $filterquery = '';
        if($isfilter == 'true'){
            $input = $request->input();
            $condition = $input['condition'];
            $value = $input['value'];
            $logic = $input['logic'];
            $fieldcolumn = $input['field'];

             foreach ($input['field'] as $fieldindex => $field) {
                if ($fieldcolumn[$fieldindex] == "tdi_key") {
                    $fieldcolumn[$fieldindex] = 'tbdefitems_subzone.tdi_key';
                }/*
                if ($fieldcolumn[$fieldindex] == "vt_id") {
                    $fieldcolumn[$fieldindex] = '';
                }*/
                if($value[$fieldindex] != ""){
                    if($fieldindex == count($input['field']) - 1) {
                        if($fieldcolumn[$fieldindex] != ""){
                            $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' "'.$value[$fieldindex].'"';
                         }
                    } else {
                        if($fieldcolumn[$fieldindex] != ""){
                           $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' "'.$value[$fieldindex].'" '.$logic[$fieldindex];    
                        }   
                    }
                }               
            }
            if($filterquery != ''){
                $filterquery  = ' AND '. $filterquery ;
            }
            Log::info($filterquery);

        }
       // str_replace('tdi_key', 'tbdefitems_subzone.tdi_key', $filterquery);
        Log::info($filterquery);
        /* $property = DB::table('cm_appln_valdetl')->join('cm_masterlist', 'vd_ma_id', '=', 'ma_id')->leftJoin('cm_appln_val_tax', 'vd_id', '=', 'vt_vd_id')->leftJoin('tbdefitems_ishasbuilding', 'vd_ishasbuilding', '=', 'tbdefitems_ishasbuilding.tdi_key')->leftJoin('tbdefitems_bldgtype', 'vd_bldgtype_id', '=', 'tbdefitems_bldgtype.tdi_key')->leftJoin('tbdefitems_bldgstorey', 'vd_bldgstorey_id', '=', 'tbdefitems_bldgstorey.tdi_key')->select( 'vd_approvalstatus_id','vd_id', 'vd_va_id','ma_id', 'ma_pb_id', 'ma_fileno', 'ma_accno',
        'ma_addr_ln1', 'tbdefitems_ishasbuilding.tdi_value' ,
        'tbdefitems_bldgtype.tdi_value', 'tbdefitems_bldgstorey.tdi_value', 'tbdefitems_bldgtype.tdi_parent_name as bldgcategory',
        'vt_approvednt', 'vt_approvedtax', 'vt_proposedrate', 'vt_note')->where('vd_va_id', '=', $baskedid)->paginate(15);      */     
    // $property = DB::select('select * from property where vd_approvalstatus_id = "13" '.$filterquery);
       
       $property = DB::select('select `vd_approvalstatus_id`, `vd_id`, `vd_va_id`, `ma_id`, `ma_pb_id`, `ma_fileno`, `ma_accno`, `vd_accno`,
            `tbdefitems_subzone`.`tdi_parent_name` `zone`, `tbdefitems_subzone`.`tdi_value` `subzone`, `ma_addr_ln1`, 
            `tbdefitems_ishasbuilding`.`tdi_value` `isbldg`, `tbdefitems_bldgtype`.`tdi_value` `bldgtype`, `tbdefitems_bldgtype`.`tdi_parent_name` `bldgcategory`,bldgsotery.tdi_value bldgsotery, 
            `vt_approvednt`, `vt_approvedtax`,  `vt_proposedrate`, `vt_note`, propertstatus.tdi_desc propertstatus, vt_name, termstatus.tdi_desc  termstatus
            FROM cm_masterlist
            INNER JOIN `cm_appln_valdetl` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
            INNER JOIN cm_appln_val ON va_id = vd_va_id
            INNER JOIN cm_appln_valterm ON vt_id = va_vt_id
            LEFT JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
            LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
            LEFT JOIN `tbdefitems_ishasbuilding` ON `cm_appln_valdetl`.`vd_ishasbuilding` = `tbdefitems_ishasbuilding`.`tdi_key`
            LEFT JOIN `tbdefitems_bldgtype` ON `tbdefitems_bldgtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id` 
            left join (select *  from tbdefitems where tdi_td_name = "PROPERTYSTAGE") propertstatus
            on propertstatus.tdi_key = vd_approvalstatus_id 
            left join (select *  from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgsotery
            on bldgsotery.tdi_key = vd_bldgstorey_id 
            left join (select *  from tbdefitems where tdi_td_name = "TERMSTAGE") termstatus
            on termstatus.tdi_key = vt_approvalstatus_id 
            where vd_id in (select MAX(vd_id) from cm_appln_valdetl group by vd_ma_id) 
             '. $filterquery);
        
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    public function existPropertyTables(Request $request){
        Log::info('Test F');
        ini_set('memory_limit', '2056M');
       // $baskedid = $request->input('id');
        $maxRow = 30;

        $isfilter = $request->input('filter');
        $filterquery = '';
        if($isfilter == 'true'){
            $input = $request->input();
            $condition = $input['condition'];
            $value = $input['value'];
            $logic = $input['logic'];
            $fieldcolumn = $input['field'];

             foreach ($input['field'] as $fieldindex => $field) {
                if ($fieldcolumn[$fieldindex] == "tdi_key") {
                    $fieldcolumn[$fieldindex] = 'tbdefitems_subzone.tdi_key';
                }/*
                if ($fieldcolumn[$fieldindex] == "vt_id") {
                    $fieldcolumn[$fieldindex] = '';
                }*/
                if($value[$fieldindex] != ""){
                    if($fieldindex == count($input['field']) - 1) {
                        if($fieldcolumn[$fieldindex] != ""){
                            $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' "'.$value[$fieldindex].'"';
                         }
                    } else {
                        if($fieldcolumn[$fieldindex] != ""){
                           $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' "'.$value[$fieldindex].'" '.$logic[$fieldindex];    
                        }   
                    }
                }               
            }
            if($filterquery != ''){
                $filterquery  = ' AND '. $filterquery ;
            }
            Log::info($filterquery);

        }
       // str_replace('tdi_key', 'tbdefitems_subzone.tdi_key', $filterquery);
        Log::info($filterquery);
        /* $property = DB::table('cm_appln_valdetl')->join('cm_masterlist', 'vd_ma_id', '=', 'ma_id')->leftJoin('cm_appln_val_tax', 'vd_id', '=', 'vt_vd_id')->leftJoin('tbdefitems_ishasbuilding', 'vd_ishasbuilding', '=', 'tbdefitems_ishasbuilding.tdi_key')->leftJoin('tbdefitems_bldgtype', 'vd_bldgtype_id', '=', 'tbdefitems_bldgtype.tdi_key')->leftJoin('tbdefitems_bldgstorey', 'vd_bldgstorey_id', '=', 'tbdefitems_bldgstorey.tdi_key')->select( 'vd_approvalstatus_id','vd_id', 'vd_va_id','ma_id', 'ma_pb_id', 'ma_fileno', 'ma_accno',
        'ma_addr_ln1', 'tbdefitems_ishasbuilding.tdi_value' ,
        'tbdefitems_bldgtype.tdi_value', 'tbdefitems_bldgstorey.tdi_value', 'tbdefitems_bldgtype.tdi_parent_name as bldgcategory',
        'vt_approvednt', 'vt_approvedtax', 'vt_proposedrate', 'vt_note')->where('vd_va_id', '=', $baskedid)->paginate(15);      */     
    // $property = DB::select('select * from property where vd_approvalstatus_id = "13" '.$filterquery);
        Log::info('select `vd_approvalstatus_id`, `vd_id`, `vd_va_id`, `ma_id`, `ma_pb_id`, `ma_fileno`, `ma_accno`, `vd_accno`,
        `tbdefitems_subzone`.`tdi_parent_name` `zone`, `tbdefitems_subzone`.`tdi_value` `subzone`, `ma_addr_ln1`, 
        `tbdefitems_ishasbuilding`.`tdi_value` `isbldg`, `tbdefitems_bldgtype`.`tdi_value` `bldgtype`, `tbdefitems_bldgtype`.`tdi_parent_name` `bldgcategory`,bldgsotery.tdi_value bldgsotery, 
        `vt_approvednt`, `vt_approvedtax`,  `vt_proposedrate`, `vt_note`, propertstatus.tdi_desc propertstatus
        FROM `cm_appln_valdetl`
        INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
        LEFT JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
        LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
        LEFT JOIN `tbdefitems_ishasbuilding` ON `cm_appln_valdetl`.`vd_ishasbuilding` = `tbdefitems_ishasbuilding`.`tdi_key`
        LEFT JOIN `tbdefitems_bldgtype` ON `tbdefitems_bldgtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id` 
        left join (select *  from tbdefitems where tdi_td_name = "PROPERTYSTAGE") propertstatus
        on propertstatus.tdi_key = vd_approvalstatus_id 
        left join (select *  from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgsotery
        on bldgsotery.tdi_key = vd_bldgstorey_id where vd_id in (select MAX(vd_id) from cm_appln_valdetl group by vd_ma_id)  '. $filterquery);
       $property = DB::select('select `vd_approvalstatus_id`, `vd_id`, `vd_va_id`, `ma_id`, `ma_pb_id`, `ma_fileno`, `ma_accno`, `vd_accno`,
        `tbdefitems_subzone`.`tdi_parent_name` `zone`, `tbdefitems_subzone`.`tdi_value` `subzone`, `ma_addr_ln1`,  `ma_addr_ln2`, 
        `tbdefitems_ishasbuilding`.`tdi_value` `isbldg`, `tbdefitems_bldgtype`.`tdi_value` `bldgtype`, `tbdefitems_bldgtype`.`tdi_parent_name` `bldgcategory`,bldgsotery.tdi_value bldgsotery, 
        `vt_approvednt`, `vt_approvedtax`,  `vt_proposedrate`, `vt_note`, propertstatus.tdi_desc propertstatus
        FROM `cm_appln_valdetl`
        INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
        LEFT JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
        LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
        LEFT JOIN `tbdefitems_ishasbuilding` ON `cm_appln_valdetl`.`vd_ishasbuilding` = `tbdefitems_ishasbuilding`.`tdi_key`
        LEFT JOIN `tbdefitems_bldgtype` ON `tbdefitems_bldgtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id` 
        left join (select *  from tbdefitems where tdi_td_name = "PROPERTYSTAGE") propertstatus
        on propertstatus.tdi_key = vd_approvalstatus_id 
        left join (select *  from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgsotery
        on bldgsotery.tdi_key = vd_bldgstorey_id where vd_id in (select MAX(vd_id) from cm_appln_valdetl group by vd_ma_id)  '. $filterquery);
        
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    public function grabExistsBasket(Request $request){
        $id = $request->input('id');
        $aptype = $request->input('aptype');
        $basket = DB::select("select * from cm_appln_val 
        inner join cm_appln_valterm on vt_id = va_vt_id
        where vt_approvalstatus_id = '05' and va_approvalstatus_id = '11' and vt_applicationtype_id = '".$aptype."' order by va_createdate desc");

        App::setlocale(session()->get('locale'));
        return view('inspection.grab.exsitsbasket')->with(array('id'=>$id,'basket'=>$basket));
    }

    public function grapExistsdata(Request $request){
        $input = $request->input();
        $accounts = $input['accounts'];
        $basketid = $request->input('id');
        $type = $request->input('type');
        $accounts = implode(",",$accounts);
        $name=Auth::user()->name;
        //$sql = 'call proc_grabdata("'.$accounts.'",1)';
        Log::info("call proc_grabdata('".$accounts."',".$basketid.",'".$name."','".$type."',@p_newprop)");
        $search=DB::select("call proc_grabdata('".$accounts."',".$basketid.",'".$name."','".$type."',@p_newprop)"); 
        $result=DB::select("select @p_newprop");
        Log::info($result);
        $data = array();
        foreach ($result as $obj) {
           $data[] = (array)$obj;  
           #or first convert it and then change its properties using 
           #an array syntax, it's up to you
        }
        foreach ($data as $obj1) {
        $count = $obj1['@p_newprop'];
           #or first convert it and then change its properties using 
           #an array syntax, it's up to you
        }
        return response()->json(array('data'=> 'true','newcount'=> $count), 200);
    }

    /**
    *
    */
    public function property(Request $request) { 
       if(userpermission::checkaccess('514')=="false"){
            $detail = UserAcessController::accessDetail('514');
            return view('denied')->with('detail',$detail);
        }   
        $isfilter = $request->input('filter');
        $baskedid = $request->input('id');
      //  $termid = $request->input('termid');

        $filterquery = '';
        if($isfilter == 'true'){
            $input = $request->input();
            $condition = $input['condition'];
            $value = $input['value'];
            $logic = $input['logic'];
            $fieldcolumn = $input['field'];

            foreach ($input['field'] as $fieldindex => $field) {
                
                if($value[$fieldindex] != ""){
                    if($fieldindex == count($input['field']) - 1) {
                        $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' '.$value[$fieldindex]; 

                    } else {
                        $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' '.$value[$fieldindex].' '.$logic[$fieldindex];       
                    }
                }
            }
            if($filterquery != ''){
                $filterquery  = ' WHERE '. $filterquery ;
            }
            Log::info($filterquery);

        }
 
    	$search=DB::select(' select sd_key, sd_label, 
        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid ,sd_keymainfield 
        from tbsearchdetail mtb where sd_se_id = 18 order by sd_sort asc ');

        $basket = DB::select('select va_approvalstatus_id FROM cm_appln_val where va_id = '.$baskedid);
            $applntype = DB::select("select vt_id,vt_applicationtype_id, va_name,  approval.tdi_desc approval, vt_name, termstage.tdi_desc termstage,
        applntype.tdi_value applntype
        from cm_appln_val 
        inner join cm_appln_valterm on vt_id = va_vt_id
        left join (SELECT * FROM tbdefitems where tdi_td_name = 'BASKETSTAGE') approval on approval.tdi_key = va_approvalstatus_id 
        left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage on termstage.tdi_key = vt_approvalstatus_id 
        left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype on applntype.tdi_key = vt_applicationtype_id where va_id = ".$baskedid);
        foreach ($basket as $rec) {    
            $approvestatus = $rec->va_approvalstatus_id;
        }
        $applicationtype = "";
        $viewparambasket = "";
        $viewparamterm = "";
        $viewparambasketstatus = "";
        foreach ($applntype as $rec) {    
            $applicationtype = $rec->vt_applicationtype_id;
            $viewparambasket = $rec->va_name;
            $viewparambasketstatus = $rec->approval;
            $termid = $rec->vt_id;
            $viewparamterm = "( ".$rec->applntype." ) ".$rec->vt_name." - ".$rec->termstage ;
        }
        App::setlocale(session()->get('locale'));
    	return view('inspection.property')->with('search',$search)->with('id',$baskedid)->with('approvestatus',$approvestatus)->with('applicationtype',$applicationtype)->with('viewparambasket',$viewparambasket)->with('viewparamterm',$viewparamterm)->with('viewparambasketstatus',$viewparambasketstatus)->with('termid',$termid);
    }

    public function propertyTablesIns(Request $request){
        ini_set('memory_limit', '2056M');
        $baskedid = $request->input('id');
        $maxRow = 30;


        $isfilter = $request->input('filter');
        $filterquery = '';
        if($isfilter == 'true'){
            $input = $request->input();
            $condition = $input['condition'];
            $value = $input['value'];
            $logic = $input['logic'];
            $fieldcolumn = $input['field'];

             foreach ($input['field'] as $fieldindex => $field) {
                if ($fieldcolumn[$fieldindex] == "tdi_key") {
                    $fieldcolumn[$fieldindex] = 'tbdefitems_subzone.tdi_key';
                }
                
                if($value[$fieldindex] != "") {
                    if($fieldindex == count($input['field']) - 1) {
                        if($fieldcolumn[$fieldindex] != ""){
                            $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' "'.$value[$fieldindex].'"';
                         }
                    } else {
                        if($fieldcolumn[$fieldindex] != ""){
                           $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' "'.$value[$fieldindex].'" '.$logic[$fieldindex];    
                        }   
                    }
                }        
            }
            if($filterquery != ''){
                $filterquery  = ' AND '. $filterquery ;
            }
            Log::info($filterquery);

        }
        
        Log::info($filterquery); 
          
        $property = DB::select('select `vd_approvalstatus_id`, `vd_id`, `vd_va_id`, `ma_id`, `ma_pb_id`, `ma_fileno`, `ma_accno`, `vd_accno`,
`tbdefitems_subzone`.`tdi_parent_name` `zone`, `tbdefitems_subzone`.`tdi_value` `subzone`, `ma_addr_ln1`, 
`tbdefitems_ishasbuilding`.`tdi_value` `isbldg`, `tbdefitems_bldgtype`.`tdi_value` `bldgtype`, `tbdefitems_bldgtype`.`tdi_parent_name` `bldgcategory`,bldgsotery.tdi_value bldgsotery, 
format(`vt_approvednt`,2) vt_approvednt, format(`vt_approvedtax`,2) `vt_approvedtax`,  format(`vt_proposedrate`,2) `vt_proposedrate`, `vt_note`,
 propertstatus.tdi_desc propertstatus, ma_addr_ln1, ma_addr_ln2, ma_addr_ln3, ma_addr_ln4, ma_city,ma_postcode,state.tdi_value state,
 format(vl_roundnetlandvalue,2) landvalue, format(vb_roundnetnt,2) bldgvalue
FROM `cm_appln_valdetl`
INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
INNER JOIN `cm_owner` ON `TO_MA_ID` = `ma_id`
LEFT JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
left join (select sum(vl_roundnetlandvalue) vl_roundnetlandvalue, vl_vd_id from cm_appln_val_lot group by vl_vd_id) land_value on land_value.vl_vd_id = `cm_appln_valdetl`.`vd_id`
left join (select sum(vb_roundnetnt) vb_roundnetnt, vb_vd_id from cm_appln_val_bldg group by vb_vd_id) bldg_value on bldg_value.vb_vd_id = `cm_appln_valdetl`.`vd_id`
LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
LEFT JOIN `tbdefitems_ishasbuilding` ON `cm_appln_valdetl`.`vd_ishasbuilding` = `tbdefitems_ishasbuilding`.`tdi_key`
LEFT JOIN `tbdefitems_bldgtype` ON `tbdefitems_bldgtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id` 
left join (select *  from tbdefitems where tdi_td_name = "PROPERTYSTAGE") propertstatus
on propertstatus.tdi_key = vd_approvalstatus_id 
left join (select *  from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgsotery
on bldgsotery.tdi_key = vd_bldgstorey_id 
left join (select *  from tbdefitems where tdi_td_name = "STATE") state
on state.tdi_key = ma_state_id   where vd_va_id = ifnull("'.$baskedid.'",0) '.$filterquery);
        
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    public function propertyTables(Request $request){
        ini_set('memory_limit', '2056M');
        $baskedid = $request->input('id');
        $maxRow = 30;


        $isfilter = $request->input('filter');
        $filterquery = '';
        if($isfilter == 'true'){
            $input = $request->input();
            $condition = $input['condition'];
            $value = $input['value'];
            $logic = $input['logic'];
            $fieldcolumn = $input['field'];

             foreach ($input['field'] as $fieldindex => $field) {
                if ($fieldcolumn[$fieldindex] == "tdi_key") {
                    $fieldcolumn[$fieldindex] = 'tbdefitems_subzone.tdi_key';
                }/*
                if ($fieldcolumn[$fieldindex] == "vt_id") {
                    $fieldcolumn[$fieldindex] = '';
                }*/
                if($value[$fieldindex] != ""){
                    if($fieldindex == count($input['field']) - 1) {
                        if($fieldcolumn[$fieldindex] != ""){
                            $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' "'.$value[$fieldindex].'"';
                         }
                    } else {
                        if($fieldcolumn[$fieldindex] != ""){
                           $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' "'.$value[$fieldindex].'" '.$logic[$fieldindex];    
                        }   
                    }
                }               
            }
            if($filterquery != ''){
                $filterquery  = ' Where '. $filterquery ;
            }
            Log::info($filterquery);

        }
       // str_replace('tdi_key', 'tbdefitems_subzone.tdi_key', $filterquery);
        Log::info($filterquery); 
        /* $property = DB::table('cm_appln_valdetl')->join('cm_masterlist', 'vd_ma_id', '=', 'ma_id')->leftJoin('cm_appln_val_tax', 'vd_id', '=', 'vt_vd_id')->leftJoin('tbdefitems_ishasbuilding', 'vd_ishasbuilding', '=', 'tbdefitems_ishasbuilding.tdi_key')->leftJoin('tbdefitems_bldgtype', 'vd_bldgtype_id', '=', 'tbdefitems_bldgtype.tdi_key')->leftJoin('tbdefitems_bldgstorey', 'vd_bldgstorey_id', '=', 'tbdefitems_bldgstorey.tdi_key')->select( 'vd_approvalstatus_id','vd_id', 'vd_va_id','ma_id', 'ma_pb_id', 'ma_fileno', 'ma_accno',
        'ma_addr_ln1', 'tbdefitems_ishasbuilding.tdi_value' ,
        'tbdefitems_bldgtype.tdi_value', 'tbdefitems_bldgstorey.tdi_value', 'tbdefitems_bldgtype.tdi_parent_name as bldgcategory',
        'vt_approvednt', 'vt_approvedtax', 'vt_proposedrate', 'vt_note')->where('vd_va_id', '=', $baskedid)->paginate(15);      */     
            $property = DB::select('select `vd_approvalstatus_id`, `vd_id`, `vd_va_id`, `ma_id`, `ma_pb_id`, `ma_fileno`, `ma_accno`, `vd_accno`,
                `tbdefitems_subzone`.`tdi_parent_name` `zone`, `tbdefitems_subzone`.`tdi_value` `subzone`,
                `tbdefitems_bldgtype`.`tdi_value` `bldgtype`, 
                `tbdefitems_bldgtype`.`tdi_parent_name` `bldgcategory`,
                bldgsotery.tdi_value bldgsotery, 
                 propertstatus.tdi_desc propertstatus
                FROM cm_officialsearch
                inner join `cm_appln_valdetl` on vd_id = os_vd_id
                inner join `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
                left join `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
                left join `tbdefitems_bldgtype` ON `tbdefitems_bldgtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id` 
                left join (select *  from tbdefitems where tdi_td_name = "PROPERTYSTAGE") propertstatus
                on propertstatus.tdi_key = vd_approvalstatus_id 
                left join (select *  from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgsotery
                on bldgsotery.tdi_key = vd_bldgstorey_id    '.$filterquery);
               // Log::info('Test');

        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    public function inspectionDetailTab(Request $request){
           // set_time_limit(0);
            $prop_id = $request->input('prop_id');  
            $pb = $request->input('pb');  
            $district= DB::table('tbdefitems')->where('tdi_td_name', 'DISTRICT')->get(); 
            $state=DB::table('tbdefitems')->where('tdi_td_name', 'STATE')->get();
            $zone=DB::table('tbdefitems')->where('tdi_td_name', 'ZONE')->get();
            $subzone=DB::table('tbdefitems')->where('tdi_td_name', 'SUBZONE')->get();
            $ishasbuilding=DB::table('tbdefitems')->where('tdi_td_name', 'ISHASBUILDING')->get();
            $lotcode=DB::table('tbdefitems')->where('tdi_td_name', 'LOTCODE')->get();
            $bldgcate=DB::table('tbdefitems')->where('tdi_td_name', 'BULDINGCATEGORY')->get();
            $bldgtype=DB::table('tbdefitems')->where('tdi_td_name', 'BULDINGTYPE')->get();
            $titiletype=DB::table('tbdefitems')->where('tdi_td_name', 'TITLETYPE')->get();
            $unitsize=DB::table('tbdefitems')->where('tdi_td_name', 'SIZEUNIT')->get();
            $landcond=DB::table('tbdefitems')->where('tdi_td_name', 'LANDCONDITION')->get();
            $landpos=DB::table('tbdefitems')->where('tdi_td_name', 'LANDPOSISION')->get();
            $landuse=DB::table('tbdefitems')->where('tdi_td_name', 'LANDUSE')->get();
            $roadtype=DB::table('tbdefitems')->where('tdi_td_name', 'ROADTYPE')->get();
            $roadcaty=DB::table('tbdefitems')->where('tdi_td_name', 'ROADCATEGORY')->get();
            $tnttype=DB::table('tbdefitems')->where('tdi_td_name', 'TENURETYPE')->get();
            $owntype=DB::table('tbdefitems')->where('tdi_td_name', 'OWNTYPE')->get();
            $race=DB::table('tbdefitems')->where('tdi_td_name', 'RACE')->get();
            $citizen=DB::table('tbdefitems')->where('tdi_td_name', 'CITIZEN')->get();
            $bldgcond=DB::table('tbdefitems')->where('tdi_td_name', 'BLDGCONDN')->get();
            $bldgpos=DB::table('tbdefitems')->where('tdi_td_name', 'BLDGPOSITION')->get();
            $bldgstruct=DB::table('tbdefitems')->where('tdi_td_name', 'BLDGSTRUCTURE')->get();
            $bldgstore=DB::table('tbdefitems')->where('tdi_td_name', 'BUILDINGSTOREY')->get();
            $rooftype=DB::table('tbdefitems')->where('tdi_td_name', 'ROOFTYPE')->get();
            $walltype=DB::table('tbdefitems')->where('tdi_td_name', 'WALLTYPE')->get();
            $fltype=DB::table('tbdefitems')->where('tdi_td_name', 'FLOORTYPE')->get();
            
            $arcaty=DB::table('tbdefitems')->where('tdi_td_name', 'AREACATEGORY')->get();
            $ceiling=DB::table('tbdefitems')->where('tdi_td_name', 'CEILINGTYPE')->get();
            $artype=DB::table('tbdefitems')->where('tdi_td_name', 'AREATYPE')->get();
            $aruse=DB::table('tbdefitems')->where('tdi_td_name', 'AREAUSE')->get();
            $arzone=DB::table('tbdefitems')->where('tdi_td_name', 'AREAZONE')->get();
            $attachtype=DB::table('tbdefitems')->where('tdi_td_name', 'ATTACHMENTTYPE')->get();


            $term=DB::select("select concat(vt_name,'', DATE_FORMAT(vt_createdate, '%d%m%Y')) termfoldername, vd_accno accountnumber, va_vt_id, vt_applicationtype_id,
                vt_name , applntype.tdi_value applntype, termstage.tdi_desc termstage, va_name, approval.tdi_desc approval, vd_approvalstatus_id
                FROM cm_appln_valterm inner join cm_appln_val on va_vt_id = vt_id inner join cm_appln_valdetl on vd_va_id = va_id  
                left join (SELECT * FROM tbdefitems where tdi_td_name = 'BASKETSTAGE') approval on approval.tdi_key = va_approvalstatus_id 
                left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
                on applntype.tdi_key = vt_applicationtype_id
                left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
                on termstage.tdi_key = vt_approvalstatus_id 
                 where vd_id = ".$prop_id);
             $iseditable = 1;
           
            foreach ($term as $rec) {
                $termname = $rec->termfoldername;
                $accountnumber = $rec->accountnumber;
                $viewparambasket = $rec->va_name;
                $viewparambasketstatus = $rec->approval;
                $propertystatus = $rec->vd_approvalstatus_id;
                $applntype = $rec->vt_applicationtype_id;
                $termid = $rec->va_vt_id;
                $viewparamterm = "( ".$rec->applntype." ) ".$rec->vt_name." - ".$rec->termstage ;
                if($rec->vd_approvalstatus_id == "04" || $rec->vd_approvalstatus_id == "05"){
                    $iseditable = 1;
                } else {
                    $iseditable = 0;
                }
            }

            $owner = DB::select('select cm_owner.*, owntype.tdi_value owntype, state.tdi_value state
            from  cm_appln_valdetl  inner join cm_masterlist on ma_id = vd_ma_id
            inner join cm_owner on to_ma_id = ma_id
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE") owntype on owntype.tdi_key = to_owntype_id
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = TO_STATE_ID
            left join (select tdi_key, tdi_value,tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone 
            on subzone.tdi_key = ma_subzone_id where vd_id = ifnull("'.$prop_id.'",0)');

        Log::info($owner);

            $master = DB::select('select ma_ishasbuilding_id, ma_id, ma_pb_id,  ma_accno,ma_fileno,subzone.tdi_value subzone, subzone.tdi_parent_name zone,  ma_subzone_id,subzone.tdi_parent_key zone_id, ma_district_id, ma_addr_ln1,ma_addr_ln2,ma_addr_ln3,ma_addr_ln4, ma_city, ma_state_id, ma_postcode 
            from  cm_appln_valdetl  inner join cm_masterlist on ma_id = vd_ma_id
            left join (select tdi_key, tdi_value,tdi_parent_key,tdi_parent_name from tbdefitems where tdi_td_name = "SUBZONE") subzone 
            on subzone.tdi_key = ma_subzone_id where vd_id = ifnull("'.$prop_id.'",0)');
            //$master = DB::table('cm_masterlist')->where('ma_id', $prop_id)->first();
            //$building = DB::select('select * from cm_bldg where bl_ma_id = ifnull("'.$prop_id.'",0)');
            $building = DB::select('select DATE_FORMAT(ab_cccdate, "%d/%m/%Y") ab_cccdate1, DATE_FORMAT(ab_occupieddate, "%d/%m/%Y") ab_occupieddate1,cm_appln_bldg.*, bldgtype.tdi_value bldgtype, tdi_parent_name
                 bldgcategory, tdi_parent_key bldgcategory_id, bldgstorey.tdi_value bldgstorey, 
                bldgstr.tdi_value bldgstr
                , rootype.tdi_value rootype
                 from cm_appln_bldg left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype 
                 on bldgtype.tdi_key = AB_BLDGTYPE_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey
                on bldgstorey.tdi_key = AB_BLDGSTOREY_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGSTRUCTURE") bldgstr
                on bldgstr.tdi_key = AB_BLDGSTRUCTURE_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROOFTYPE") rootype  
                on rootype.tdi_key = AB_ROOFTYPE_ID where ab_vd_id = ifnull("'.$prop_id.'",0)');

            //$lotlist = DB::select('select * from cm_lot where lo_ma_id = ifnull("'.$prop_id.'",0)');
            $lotlist = DB::select('select DATE_FORMAT(al_startdate, "%d/%m/%Y") al_startdate1, DATE_FORMAT(al_expireddate, "%d/%m/%Y") al_expireddate1,cm_appln_lot.*, lotcode.tdi_value lotcode, roadtype.tdi_value roadtype, titletype.tdi_value titletype
                , unitsize.tdi_value unitsize, concat(lotcode.tdi_value,al_no) lotnumber, concat(titletype.tdi_value,al_titleno) titlenumber, landuse.tdi_value landuse, tentype.tdi_value tentype
                 from cm_appln_lot left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE") lotcode on lotcode.tdi_key = al_lotcode_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADTYPE") roadtype on roadtype.tdi_key = al_roadtype_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE") titletype on titletype.tdi_key = al_titletype_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SIZEUNIT") unitsize on unitsize.tdi_key = al_sizeunit_id
                left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDUSE") landuse on  al_landuse_id = landuse.tdi_key
                left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "TENURETYPE") tentype on  al_tenuretype_id = tentype.tdi_key 
                 where al_vd_id = ifnull("'.$prop_id.'",0)');

            //$ownerlist = DB::select('select * from cm_owner where to_ma_id = ifnull("'.$prop_id.'",0)');
            $ownerlist = DB::select('select cm_owner.*, owntype.tdi_value owntype, state.tdi_value state
             from cm_owner left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE") owntype on owntype.tdi_key = to_owntype_id
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = TO_STATE_ID
             where  TO_MA_ID = ifnull("'.$prop_id.'",0)');

           $bldgardetail = DB::select('select  cm_appln_bldgarea.*, cm_appln_bldg.ab_bldg_no, vd_accno, arzone.tdi_value arzone, arlvel.tdi_value arlvel, arcate.tdi_value arcate, floortype.tdi_value floortype
            , artype.tdi_value artype, aruse.tdi_value aruse, ceilingtype.tdi_value ceilingtype, walltype.tdi_value walltype
            from cm_appln_valdetl join  cm_appln_bldg on ab_vd_id = vd_id join cm_appln_bldgarea on aba_ab_id = ab_id 
            left join tbdefitems artype on artype.tdi_key = cm_appln_bldgarea.ABA_AREATYPE_ID and  artype.tdi_td_name = "AREATYPE"
            left join tbdefitems arcate on arcate.tdi_key = cm_appln_bldgarea.ABA_AREACATEGORY_ID  and arcate.tdi_td_name = "AREACATEGORY"
            left join tbdefitems arlvel on arlvel.tdi_key = cm_appln_bldgarea.ABA_AREALEVEL_ID and arlvel.tdi_td_name = "AREALEVEL" 
            left join tbdefitems arzone on arzone.tdi_key = cm_appln_bldgarea.ABA_AREAZONE_ID and arzone.tdi_td_name = "AREAZONE"
            left join tbdefitems floortype on floortype.tdi_key = cm_appln_bldgarea.ABA_FLOORTYPE_ID and floortype.tdi_td_name = "FLOORTYPE"
            left join tbdefitems aruse on aruse.tdi_key = cm_appln_bldgarea.aba_areause_id  and aruse.tdi_td_name = "AREAUSE"
            left join tbdefitems ceilingtype on ceilingtype.tdi_key = cm_appln_bldgarea.ABA_CEILINGTYPE_ID and ceilingtype.tdi_td_name = "CEILINGTYPE"
            left join tbdefitems walltype on walltype.tdi_key = cm_appln_bldgarea.aba_walltype_id  and walltype.tdi_td_name = "WALLTYPE" 
                where ab_vd_id = ifnull("'.$prop_id.'",0)');
            $count = count($master);

            $ratepayer = DB::select("select arp_id,`rp_id`, `rp_applntype_id`, applntype, `rp_type_id`, ratepayertype, `rp_no`, `rp_name`, `rp_addr_ln1`,
                    `rp_addr_ln2`, `rp_addr_ln3`, `rp_addr_ln4`,  `rp_postcode`,  `rp_state_id`, state,
                    `rp_citizen_id`, citizen,  `rp_race_id`, race, 
                    `rp_activeind_id`, activeind,  `rp_updateby`,  DATE_FORMAT(rp_updatedate, '%d/%m/%Y') rp_updatedate,rp_phone_no, rp_email_addr 
                FROM `cm_ratepayer`,cm_appln_ratepayer , (select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE') state,
                (select tdi_key citizen_id, tdi_value citizen from tbdefitems where tdi_td_name = 'CITIZEN') citizen,
                (select tdi_key race_id, tdi_value race from tbdefitems where tdi_td_name = 'RACE') race,
                (select tdi_key activeind_id, tdi_value activeind from tbdefitems where tdi_td_name = 'ACTIVEIND') activeind,
                (select tdi_key applntype_id, tdi_value applntype from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype,
                (select tdi_key ratepayertype_id, tdi_value ratepayertype from tbdefitems where tdi_td_name = 'RATEPAYERTYPE') ratepayertype
                where rp_state_id = state_id and rp_citizen_id = citizen_id and rp_race_id = race_id
                and rp_activeind_id = activeind_id and rp_applntype_id = applntype_id
                and rp_type_id = ratepayertype_id and rp_id = arp_rp_id  and arp_vd_id = ifnull(".$prop_id.",0) ");

               $tenant = DB::select("select at_id,`te_id`, `te_applntype_id`, applntype, `te_type_id`, tenanttype, `te_no`, `te_name`, `te_addr_ln1`,
                `te_addr_ln2`, `te_addr_ln3`, `te_addr_ln4`,  `te_postcode`,  `te_state_id`, state,
                `te_citizen_id`, citizen,  `te_race_id`, race, 
                `te_activeind_id`, activeind,  `te_updateby`,  `te_updatedate`, te_phone_no, te_email_addr
                FROM cm_appln_tenant,`cm_tenant`, (select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE') state,
                (select tdi_key citizen_id, tdi_value citizen from tbdefitems where tdi_td_name = 'CITIZEN') citizen,
                (select tdi_key race_id, tdi_value race from tbdefitems where tdi_td_name = 'RACE') race,
                (select tdi_key activeind_id, tdi_value activeind from tbdefitems where tdi_td_name = 'ACTIVEIND') activeind,
                (select tdi_key applntype_id, tdi_value applntype from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype,
                (select tdi_key tenanttype_id, tdi_value tenanttype from tbdefitems where tdi_td_name = 'TENURETYPE1') tenanttype
                where te_state_id = state_id and te_citizen_id = citizen_id and te_race_id = race_id
                and te_activeind_id = activeind_id and te_applntype_id = applntype_id
                and te_type_id = tenanttype_id and at_te_id =  te_id and at_vd_id = ifnull(".$prop_id.",0) ");
               
             $attachment = DB::select("
            select at_oringinalfilename,at_id,at_path,at_attachtype_id,at_filename,at_detail,at_createby,at_createdate, attachment.tdi_value attachment from cm_attachment left join 
            (select tdi_key, tdi_value from tbdefitems where tdi_td_name = 'ATTACHMENTTYPE') attachment on attachment.tdi_key =  at_attachtype_id  where at_linkid = ifnull(".$prop_id.",0) ");

              $parameter = DB::select("select ap_id,ap_bldgstatus_id,ap_propertycategory_id,ap_propertytype_id,ap_propertylevel_id  FROM cm_appln_parameter where ap_vd_id  = ifnull(".$prop_id.",0) ");

               $config=DB::select("select GROUP_CONCAT(config_value SEPARATOR  ':') serveradd from tbconfig  where config_name in ('host', 'port')");
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
        foreach ($building as $rec) {    
           $category = $rec->bldgcategory;
        }
$arlvl=DB::table('tbdefitems')->where('tdi_td_name', 'AREALEVEL')->where('tdi_parent_name', $category)->orderBy('tdi_sort')->get();
App::setlocale(session()->get('locale'));
            return view("inspection.bldg")->with('district', $district)->with('state', $state)->with('zone', $zone)->with('subzone', $subzone)->with(array('bldgstruct'=>$bldgstruct,'bldgstore'=>$bldgstore,'ishasbuilding'=>$ishasbuilding, 'landuse'=>$landuse, 'master'=> $master, 'lotlist'=> $lotlist, 'ownerlist'=>$ownerlist, 'building'=> $building,'lotcode'=> $lotcode, 'titiletype'=>$titiletype, 'unitsize'=> $unitsize, 'landcond'=>$landcond,'landpos' => $landpos,'roadtype'=> $roadtype, 'roadcaty'=>$roadcaty, 'tnttype'=> $tnttype, 'owntype'=>$owntype,'race' => $race,'citizen'=> $citizen, 'bldgcond'=>$bldgcond, 'bldgpos'=> $bldgpos, 'bldgstructure'=>$bldgstruct,'rooftype'=> $rooftype, 'walltype'=>$walltype, 'fltype'=> $fltype, 'arlvl'=>$arlvl,'arcaty' => $arcaty, 'artype'=> $artype, 'aruse'=>$aruse,'arzone' => $arzone,'ceiling' => $ceiling,'bldgcate' => $bldgcate,'bldgtype' => $bldgtype,'count' => $count, 'bldgardetail' => $bldgardetail,'ratepayer' => $ratepayer, 'tenant' => $tenant,'prop_id' => $prop_id,'pb'=> $pb,'parameter' => $parameter,'attachment'=>$attachment,'attachtype' => $attachtype, 'termname' => $termname, 'accountnumber' => $accountnumber,'serverhost' => $serverhost, 'ownerd' => $owner, 'viewparambasket' => $viewparambasket, 'viewparambasketstatus' => $viewparambasketstatus, 'viewparamterm' => $viewparamterm, 'termid' => $termid,
                'iseditable' => $iseditable, 'applntype' => $applntype));
    }

    public function inspectionTab(Request $request){
           // set_time_limit(0);
    	 	$prop_id = $request->input('prop_id');  
    	 	$pb = $request->input('pb');  
        	$district= DB::table('tbdefitems')->where('tdi_td_name', 'DISTRICT')->get(); 
        	$state=DB::table('tbdefitems')->where('tdi_td_name', 'STATE')->get();
        	$zone=DB::table('tbdefitems')->where('tdi_td_name', 'ZONE')->get();
        	$subzone=DB::table('tbdefitems')->where('tdi_td_name', 'SUBZONE')->get();
            $ishasbuilding=DB::table('tbdefitems')->where('tdi_td_name', 'ISHASBUILDING')->get();
        	$lotcode=DB::table('tbdefitems')->where('tdi_td_name', 'LOTCODE')->get();
            $bldgcate=DB::table('tbdefitems')->where('tdi_td_name', 'BULDINGCATEGORY')->get();
            $bldgtype=DB::table('tbdefitems')->where('tdi_td_name', 'BULDINGTYPE')->get();
        	$titiletype=DB::table('tbdefitems')->where('tdi_td_name', 'TITLETYPE')->get();
        	$unitsize=DB::table('tbdefitems')->where('tdi_td_name', 'SIZEUNIT')->get();
        	$landcond=DB::table('tbdefitems')->where('tdi_td_name', 'LANDCONDITION')->get();
        	$landpos=DB::table('tbdefitems')->where('tdi_td_name', 'LANDPOSISION')->get();
            $landuse=DB::table('tbdefitems')->where('tdi_td_name', 'LANDUSE')->get();
        	$roadtype=DB::table('tbdefitems')->where('tdi_td_name', 'ROADTYPE')->get();
        	$roadcaty=DB::table('tbdefitems')->where('tdi_td_name', 'ROADCATEGORY')->get();
        	$tnttype=DB::table('tbdefitems')->where('tdi_td_name', 'TENURETYPE')->get();
        	$owntype=DB::table('tbdefitems')->where('tdi_td_name', 'OWNTYPE')->get();
        	$race=DB::table('tbdefitems')->where('tdi_td_name', 'RACE')->get();
        	$citizen=DB::table('tbdefitems')->where('tdi_td_name', 'CITIZEN')->get();
        	$bldgcond=DB::table('tbdefitems')->where('tdi_td_name', 'BLDGCONDN')->get();
        	$bldgpos=DB::table('tbdefitems')->where('tdi_td_name', 'BLDGPOSITION')->get();
        	$bldgstruct=DB::table('tbdefitems')->where('tdi_td_name', 'BLDGSTRUCTURE')->get();
        	$bldgstore=DB::table('tbdefitems')->where('tdi_td_name', 'BUILDINGSTOREY')->get();
        	$rooftype=DB::table('tbdefitems')->where('tdi_td_name', 'ROOFTYPE')->get();
        	$walltype=DB::table('tbdefitems')->where('tdi_td_name', 'WALLTYPE')->get();
        	$fltype=DB::table('tbdefitems')->where('tdi_td_name', 'FLOORTYPE')->get();
        	$arlvl=DB::table('tbdefitems')->where('tdi_td_name', 'AREALEVEL')->get();
        	$arcaty=DB::table('tbdefitems')->where('tdi_td_name', 'AREACATEGORY')->get();
        	$ceiling=DB::table('tbdefitems')->where('tdi_td_name', 'CEILINGTYPE')->get();
        	$artype=DB::table('tbdefitems')->where('tdi_td_name', 'AREATYPE')->get();
        	$aruse=DB::table('tbdefitems')->where('tdi_td_name', 'AREAUSE')->get();
        	$arzone=DB::table('tbdefitems')->where('tdi_td_name', 'AREAZONE')->get();
            $attachtype=DB::table('tbdefitems')->where('tdi_td_name', 'ATTACHMENTTYPE')->get();
            $mbldg=DB::table('tbdefitems')->where('tdi_td_name', 'ISMAINBLDG')->get();
            $status=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ACTIVEIND" order by tdi_sort ');


            $term=DB::select("select concat(vt_name,'', DATE_FORMAT(vt_createdate, '%d%m%Y')) termfoldername, vd_accno accountnumber, va_vt_id, vt_applicationtype_id,
                vt_name , applntype.tdi_value applntype, termstage.tdi_desc termstage, va_name, approval.tdi_desc approval, vd_approvalstatus_id
                FROM cm_appln_valterm inner join cm_appln_val on va_vt_id = vt_id inner join cm_appln_valdetl on vd_va_id = va_id  
                left join (SELECT * FROM tbdefitems where tdi_td_name = 'BASKETSTAGE') approval on approval.tdi_key = va_approvalstatus_id 
                left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
                on applntype.tdi_key = vt_applicationtype_id
                left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
                on termstage.tdi_key = vt_approvalstatus_id 
                 where vd_id = ".$prop_id);
             $iseditable = 1;
           
            foreach ($term as $rec) {
                $termname = $rec->termfoldername;
                $accountnumber = $rec->accountnumber;
                $viewparambasket = $rec->va_name;
                $viewparambasketstatus = $rec->approval;
                $propertystatus = $rec->vd_approvalstatus_id;
                $applntype = $rec->vt_applicationtype_id;
                $termid = $rec->va_vt_id;
                $viewparamterm = "( ".$rec->applntype." ) ".$rec->vt_name." - ".$rec->termstage ;
                if($rec->vd_approvalstatus_id == "04" || $rec->vd_approvalstatus_id == "05"){
                    $iseditable = 1;
                } else {
                    $iseditable = 0;
                }
            }

            $owner = DB::select('select cm_owner.*, owntype.tdi_value owntype, state.tdi_value state
from  cm_appln_valdetl  inner join cm_masterlist on ma_id = vd_ma_id
inner join cm_owner on to_ma_id = ma_id
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE") owntype on owntype.tdi_key = to_owntype_id
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = TO_STATE_ID
left join (select tdi_key, tdi_value,tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone 
on subzone.tdi_key = ma_subzone_id where vd_id = ifnull("'.$prop_id.'",0)');

        Log::info($owner);

        	$master = DB::select('select ma_ishasbuilding_id, ma_id, ma_pb_id,  ma_accno,ma_fileno,  ma_subzone_id,subzone.tdi_parent_key zone_id, ma_district_id, ma_addr_ln1,ma_addr_ln2,ma_addr_ln3,ma_addr_ln4, ma_city, ma_state_id, ma_postcode 
from  cm_appln_valdetl  inner join cm_masterlist on ma_id = vd_ma_id
left join (select tdi_key, tdi_value,tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone 
on subzone.tdi_key = ma_subzone_id where vd_id = ifnull("'.$prop_id.'",0)');
            //$master = DB::table('cm_masterlist')->where('ma_id', $prop_id)->first();
        	//$building = DB::select('select * from cm_bldg where bl_ma_id = ifnull("'.$prop_id.'",0)');
            $building = DB::select('select ifnull(DATE_FORMAT(ab_cccdate, "%d/%m/%Y"),ab_cccdate) ab_cccdate1, ifnull(DATE_FORMAT(ab_occupieddate, "%d/%m/%Y"),ab_occupieddate) ab_occupieddate1,cm_appln_bldg.*, bldgtype.tdi_value bldgtype, tdi_parent_name
                 bldgcategory, tdi_parent_key bldgcategory_id, bldgstorey.tdi_value bldgstorey, 
                bldgstr.tdi_value bldgstr
                , rootype.tdi_value rootype, astatus.tdi_value astatus
                 from cm_appln_bldg left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype 
                 on bldgtype.tdi_key = AB_BLDGTYPE_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey
                on bldgstorey.tdi_key = AB_BLDGSTOREY_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGSTRUCTURE") bldgstr
                on bldgstr.tdi_key = AB_BLDGSTRUCTURE_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROOFTYPE") rootype  
                on rootype.tdi_key = AB_ROOFTYPE_ID 
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ISMAINBLDG") astatus  
                on astatus.tdi_key = ab_ismainbldg_id where ab_vd_id = ifnull("'.$prop_id.'",0)');

        	//$lotlist = DB::select('select * from cm_lot where lo_ma_id = ifnull("'.$prop_id.'",0)');
            $lotlist = DB::select('select DATE_FORMAT(al_startdate, "%d/%m/%Y") al_startdate1, DATE_FORMAT(al_expireddate, "%d/%m/%Y") al_expireddate1,cm_appln_lot.*, lotcode.tdi_value lotcode, roadtype.tdi_value roadtype, titletype.tdi_value titletype
                , unitsize.tdi_value unitsize, concat(lotcode.tdi_value,al_no) lotnumber, concat(titletype.tdi_value,al_titleno) titlenumber, landuse.tdi_value landuse, tentype.tdi_value tentype
                 from cm_appln_lot left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE") lotcode on lotcode.tdi_key = al_lotcode_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADTYPE") roadtype on roadtype.tdi_key = al_roadtype_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE") titletype on titletype.tdi_key = al_titletype_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SIZEUNIT") unitsize on unitsize.tdi_key = al_sizeunit_id
                left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDUSE") landuse on  al_landuse_id = landuse.tdi_key
                left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "TENURETYPE") tentype on  al_tenuretype_id = tentype.tdi_key 
                 where al_vd_id = ifnull("'.$prop_id.'",0)');

        	//$ownerlist = DB::select('select * from cm_owner where to_ma_id = ifnull("'.$prop_id.'",0)');
            $ownerlist = DB::select('select cm_owner.*, owntype.tdi_value owntype, state.tdi_value state
             from cm_owner left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE") owntype on owntype.tdi_key = to_owntype_id
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = TO_STATE_ID
             where  TO_MA_ID = ifnull("'.$prop_id.'",0)');

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
                where ab_vd_id = ifnull("'.$prop_id.'",0)');
            $count = count($master);

            $ratepayer = DB::select("select arp_id,`rp_id`, `rp_applntype_id`, applntype, `rp_type_id`, ratepayertype, `rp_no`, `rp_name`, `rp_addr_ln1`,
                    `rp_addr_ln2`, `rp_addr_ln3`, `rp_addr_ln4`,  `rp_postcode`,  `rp_state_id`, state,
                    `rp_citizen_id`, citizen,  `rp_race_id`, race, 
                    `rp_activeind_id`, activeind,  `rp_updateby`,  DATE_FORMAT(rp_updatedate, '%d/%m/%Y') rp_updatedate,rp_phone_no, rp_email_addr 
                FROM `cm_ratepayer`,cm_appln_ratepayer , (select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE') state,
                (select tdi_key citizen_id, tdi_value citizen from tbdefitems where tdi_td_name = 'CITIZEN') citizen,
                (select tdi_key race_id, tdi_value race from tbdefitems where tdi_td_name = 'RACE') race,
                (select tdi_key activeind_id, tdi_value activeind from tbdefitems where tdi_td_name = 'ACTIVEIND') activeind,
                (select tdi_key applntype_id, tdi_value applntype from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype,
                (select tdi_key ratepayertype_id, tdi_value ratepayertype from tbdefitems where tdi_td_name = 'RATEPAYERTYPE') ratepayertype
                where rp_state_id = state_id and rp_citizen_id = citizen_id and rp_race_id = race_id
                and rp_activeind_id = activeind_id and rp_applntype_id = applntype_id
                and rp_type_id = ratepayertype_id and rp_id = arp_rp_id  and arp_vd_id = ifnull(".$prop_id.",0) ");

               $tenant = DB::select("select at_id,`te_id`, `te_applntype_id`, applntype, `te_type_id`, tenanttype, `te_no`, `te_name`, `te_addr_ln1`,
                `te_addr_ln2`, `te_addr_ln3`, `te_addr_ln4`,  `te_postcode`,  `te_state_id`, state,
                `te_citizen_id`, citizen,  `te_race_id`, race, 
                `te_activeind_id`, activeind,  `te_updateby`,  `te_updatedate`, te_phone_no, te_email_addr
                FROM cm_appln_tenant,`cm_tenant`, (select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE') state,
                (select tdi_key citizen_id, tdi_value citizen from tbdefitems where tdi_td_name = 'CITIZEN') citizen,
                (select tdi_key race_id, tdi_value race from tbdefitems where tdi_td_name = 'RACE') race,
                (select tdi_key activeind_id, tdi_value activeind from tbdefitems where tdi_td_name = 'ACTIVEIND') activeind,
                (select tdi_key applntype_id, tdi_value applntype from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype,
                (select tdi_key tenanttype_id, tdi_value tenanttype from tbdefitems where tdi_td_name = 'TENURETYPE1') tenanttype
                where te_state_id = state_id and te_citizen_id = citizen_id and te_race_id = race_id
                and te_activeind_id = activeind_id and te_applntype_id = applntype_id
                and te_type_id = tenanttype_id and at_te_id =  te_id and at_vd_id = ifnull(".$prop_id.",0) ");
               
             $attachment = DB::select("
            select at_name,at_fileextention ,at_oringinalfilename,at_id,at_path,at_attachtype_id,at_filename,at_detail,at_createby,at_createdate, attachment.tdi_value attachment from cm_attachment left join 
            (select tdi_key, tdi_value from tbdefitems where tdi_td_name = 'ATTACHMENTTYPE') attachment on attachment.tdi_key =  at_attachtype_id  where at_linkid = ifnull(".$prop_id.",0) ");

              $parameter = DB::select("select ap_id,ap_bldgstatus_id,ap_propertycategory_id,ap_propertytype_id,ap_propertylevel_id  FROM cm_appln_parameter where ap_vd_id  = ifnull(".$prop_id.",0) ");

              $config=DB::select("select GROUP_CONCAT(config_value SEPARATOR  ':') serveradd from tbconfig  where config_name in ('host', 'port')");
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }

        App::setlocale(session()->get('locale'));

        return view("inspection.tab")->with('district', $district)->with('state', $state)->with('zone', $zone)->with('subzone', $subzone)->with(array('bldgstruct'=>$bldgstruct,'bldgstore'=>$bldgstore,'ishasbuilding'=>$ishasbuilding, 'landuse'=>$landuse, 'master'=> $master, 'lotlist'=> $lotlist, 'ownerlist'=>$ownerlist, 'building'=> $building,'lotcode'=> $lotcode, 'titiletype'=>$titiletype, 'unitsize'=> $unitsize, 'landcond'=>$landcond,'landpos' => $landpos,'roadtype'=> $roadtype, 'roadcaty'=>$roadcaty, 'tnttype'=> $tnttype, 'owntype'=>$owntype,'race' => $race,'citizen'=> $citizen, 'bldgcond'=>$bldgcond, 'bldgpos'=> $bldgpos, 'bldgstructure'=>$bldgstruct,'rooftype'=> $rooftype, 'walltype'=>$walltype, 'fltype'=> $fltype, 'arlvl'=>$arlvl,'arcaty' => $arcaty, 'artype'=> $artype, 'aruse'=>$aruse,'arzone' => $arzone,'ceiling' => $ceiling,'bldgcate' => $bldgcate,'bldgtype' => $bldgtype,'count' => $count, 'bldgardetail' => $bldgardetail,'ratepayer' => $ratepayer, 'tenant' => $tenant,'prop_id' => $prop_id,'pb'=> $pb,'parameter' => $parameter,'attachment'=>$attachment,'attachtype' => $attachtype, 'termname' => $termname, 'accountnumber' => $accountnumber,'serverhost' => $serverhost, 'ownerd' => $owner, 'viewparambasket' => $viewparambasket, 'viewparambasketstatus' => $viewparambasketstatus, 'viewparamterm' => $viewparamterm, 'termid' => $termid,
                'iseditable' => $iseditable, 'applntype' => $applntype, 'status' => $status, 'mbldg' => $mbldg));
    }

    public function ratepayerSearch(Request $request){
    	$isfilter = $request->input('filter');
        $basketid = $request->input('id');
        $filterquery = '';
        if($isfilter == 'true'){
	        $input = $request->input();
	        $condition = $input['condition'];
	        $value = $input['value'];
	        $logic = $input['logic'];
	        $fieldcolumn = $input['field'];
	            

	         foreach ($input['field'] as $fieldindex => $field) {
	            
	            if($value[$fieldindex] != ""){
	                if($fieldindex == count($input['field']) - 1) {
	                    $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' '.$value[$fieldindex]; 

	                } else {
	                    $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' '.$value[$fieldindex].' '.$logic[$fieldindex];       
	                }
	            }
	            
	        }
	        if($filterquery != ''){
	        	$filterquery  = ' WHERE '. $filterquery ;
	    	}
	    }

        Log::info($filterquery);

        $state = DB::select("select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE'");
        $citizen = DB::select("select tdi_key citizen_id, tdi_value citizen from tbdefitems where tdi_td_name = 'CITIZEN'");
        $race = DB::select("select tdi_key race_id, tdi_value race from tbdefitems where tdi_td_name = 'RACE'");
        $activeind = DB::select("select tdi_key activeind_id, tdi_value activeind from tbdefitems where tdi_td_name = 'ACTIVEIND'");       
        $applntype = DB::select("select tdi_key applntype_id, tdi_value applntype from tbdefitems where tdi_td_name = 'APPLICATIONTYPE'"); 
        $ratepayertype = DB::select("select tdi_key ratepayertype_id, tdi_value ratepayertype from tbdefitems where tdi_td_name = 'RATEPAYERTYPE' ");
        $property = DB::select("select `rp_id`, `rp_applntype_id`, applntype, `rp_type_id`, ratepayertype, `rp_no`, `rp_name`, `rp_addr_ln1`,
                `rp_addr_ln2`, `rp_addr_ln3`, `rp_addr_ln4`,  `rp_postcode`,  `rp_state_id`, state,
                `rp_citizen_id`, citizen,  `rp_race_id`, race, 
                `rp_activeind_id`, activeind,  `rp_updateby`,  `rp_updatedate`,rp_phone_no, rp_email_addr 
            FROM `cm_ratepayer`, (select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE') state,
            (select tdi_key citizen_id, tdi_value citizen from tbdefitems where tdi_td_name = 'CITIZEN') citizen,
            (select tdi_key race_id, tdi_value race from tbdefitems where tdi_td_name = 'RACE') race,
            (select tdi_key activeind_id, tdi_value activeind from tbdefitems where tdi_td_name = 'ACTIVEIND') activeind,
            (select tdi_key applntype_id, tdi_value applntype from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype,
            (select tdi_key ratepayertype_id, tdi_value ratepayertype from tbdefitems where tdi_td_name = 'RATEPAYERTYPE') ratepayertype
            where rp_state_id = state_id and rp_citizen_id = citizen_id and rp_race_id = race_id
            and rp_activeind_id = activeind_id and rp_applntype_id = applntype_id
            and rp_type_id = ratepayertype_id ". $filterquery);
		//Log::info($property);
    	$search=DB::select(' select sd_key, sd_label, 
        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid 
        from tbsearchdetail mtb where sd_se_id = 1333 ');
        App::setlocale(session()->get('locale'));
    	return view('searchpopup.ratepayer')->with(array('state'=> $state,'citizen'=> $citizen,'race'=> $race,'activeind'=> $activeind, 'applntype' => $applntype, 'ratepayertype' => $ratepayertype,'search'=>$search,'id'=>3,'property'=>$property));
    }

    public function tenantSearch(Request $request){
    	$isfilter = $request->input('filter');
        $basketid = $request->input('id');
        $filterquery = '';
        if($isfilter == 'true'){
	        $input = $request->input();
	        $condition = $input['condition'];
	        $value = $input['value'];
	        $logic = $input['logic'];
	        $fieldcolumn = $input['field'];

	        foreach ($input['field'] as $fieldindex => $field) {
	            
	            if($value[$fieldindex] != ""){
	                if($fieldindex == count($input['field']) - 1) {
	                    $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' '.$value[$fieldindex]; 

	                } else {
	                    $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' '.$value[$fieldindex].' '.$logic[$fieldindex];       
	                }
	            }
	            
	        }
	        if($filterquery != ''){
	        	$filterquery  = ' WHERE '. $filterquery ;
	    	}
	    }

        $property = DB::select("select `te_id`, `te_applntype_id`, applntype, `te_type_id`, tenanttype, `te_no`, `te_name`, `te_addr_ln1`,
                `te_addr_ln2`, `te_addr_ln3`, `te_addr_ln4`,  `te_postcode`,  `te_state_id`, state,
                `te_citizen_id`, citizen,  `te_race_id`, race, 
                `te_activeind_id`, activeind,  `te_updateby`,  `te_updatedate`, te_phone_no, te_email_addr
            FROM `cm_tenant`, (select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE') state,
            (select tdi_key citizen_id, tdi_value citizen from tbdefitems where tdi_td_name = 'CITIZEN') citizen,
            (select tdi_key race_id, tdi_value race from tbdefitems where tdi_td_name = 'RACE') race,
            (select tdi_key activeind_id, tdi_value activeind from tbdefitems where tdi_td_name = 'ACTIVEIND') activeind,
            (select tdi_key applntype_id, tdi_value applntype from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype,
            (select tdi_key tenanttype_id, tdi_value tenanttype from tbdefitems where tdi_td_name = 'TENURETYPE1') tenanttype
            where te_state_id = state_id and te_citizen_id = citizen_id and te_race_id = race_id
            and te_activeind_id = activeind_id and te_applntype_id = applntype_id
            and te_type_id = tenanttype_id ". $filterquery);
        
    	$search=DB::select(' select sd_key, sd_label, 
        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid 
        from tbsearchdetail mtb where sd_se_id = 13333 ');
        $state = DB::select("select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE'");
        $citizen = DB::select("select tdi_key citizen_id, tdi_value citizen from tbdefitems where tdi_td_name = 'CITIZEN'");
        $race = DB::select("select tdi_key race_id, tdi_value race from tbdefitems where tdi_td_name = 'RACE'");
        $activeind = DB::select("select tdi_key activeind_id, tdi_value activeind from tbdefitems where tdi_td_name = 'ACTIVEIND'");       
        $applntype = DB::select("select tdi_key applntype_id, tdi_value applntype from tbdefitems where tdi_td_name = 'APPLICATIONTYPE'"); 
        $tenanttype = DB::select("select tdi_key tenanttype_id, tdi_value tenanttype from tbdefitems where tdi_td_name = 'RATEPAYERTYPE' ");
        App::setlocale(session()->get('locale'));
    	return view('searchpopup.tenant')->with('search',$search)->with('property',$property)->with('id',3)->with(array('state'=> $state,'citizen'=> $citizen,'race'=> $race,'activeind'=> $activeind, 'applntype' => $applntype, 'tenanttype' => $tenanttype));
    }

     public function updateInspection(Request $request){
        $name=Auth::user()->name;
        
            $masterdata = $request->input('masterdata');  
            $lotdata = $request->input('lotdata');  
            $ratepayerdata = $request->input('ratepayerdata');  
            $tenantdata = $request->input('tenantdata'); 
            $bldgdata = $request->input('bldgdata');   
            $bldgardata = $request->input('bldgardata');  
            $ownerdata = $request->input('ownerdata');  
            $pb = $request->input('pb');  
            $attachmentdata = $request->input('attachmentdata');  




             $prop = $request->input('prop_id');
             
               
                Log::info("call proc_inspection_update('".$masterdata."',
                '".$lotdata."','".$bldgdata."','".$bldgardata."','".$tenantdata."','".$ratepayerdata."','".$name."',".$prop.",".$pb.",'".$attachmentdata."')"); 
            $register=DB::select("call proc_inspection_update('".$masterdata."',
                '".$lotdata."','".$bldgdata."','".$bldgardata."','".$tenantdata."','".$ratepayerdata."','".$name."',".$prop.",".$pb.",'".$attachmentdata."')");   
       
        //$msg = true;
        return response()->json(array('msg'=> 'true'), 200);
    }

    public function termAttachment(Request $request){
           // set_time_limit(0);
            $prop_id = $request->input('prop_id');  
            $pb = $request->input('pb');  
            $district= DB::table('tbdefitems')->where('tdi_td_name', 'DISTRICT')->get(); 
            $state=DB::table('tbdefitems')->where('tdi_td_name', 'STATE')->get();
            $zone=DB::table('tbdefitems')->where('tdi_td_name', 'ZONE')->get();
            $subzone=DB::table('tbdefitems')->where('tdi_td_name', 'SUBZONE')->get();
            $ishasbuilding=DB::table('tbdefitems')->where('tdi_td_name', 'ISHASBUILDING')->get();
            $lotcode=DB::table('tbdefitems')->where('tdi_td_name', 'LOTCODE')->get();
            $bldgcate=DB::table('tbdefitems')->where('tdi_td_name', 'BULDINGCATEGORY')->get();
            $bldgtype=DB::table('tbdefitems')->where('tdi_td_name', 'BULDINGTYPE')->get();
            $titiletype=DB::table('tbdefitems')->where('tdi_td_name', 'TITLETYPE')->get();
            $unitsize=DB::table('tbdefitems')->where('tdi_td_name', 'SIZEUNIT')->get();
            $landcond=DB::table('tbdefitems')->where('tdi_td_name', 'LANDCONDITION')->get();
            $landpos=DB::table('tbdefitems')->where('tdi_td_name', 'LANDPOSISION')->get();
            $landuse=DB::table('tbdefitems')->where('tdi_td_name', 'LANDUSE')->get();
            $roadtype=DB::table('tbdefitems')->where('tdi_td_name', 'ROADTYPE')->get();
            $roadcaty=DB::table('tbdefitems')->where('tdi_td_name', 'ROADCATEGORY')->get();
            $tnttype=DB::table('tbdefitems')->where('tdi_td_name', 'TENURETYPE')->get();
            $owntype=DB::table('tbdefitems')->where('tdi_td_name', 'OWNTYPE')->get();
            $race=DB::table('tbdefitems')->where('tdi_td_name', 'RACE')->get();
            $citizen=DB::table('tbdefitems')->where('tdi_td_name', 'CITIZEN')->get();
            $bldgcond=DB::table('tbdefitems')->where('tdi_td_name', 'BLDGCONDN')->get();
            $bldgpos=DB::table('tbdefitems')->where('tdi_td_name', 'BLDGPOSITION')->get();
            $bldgstruct=DB::table('tbdefitems')->where('tdi_td_name', 'BLDGSTRUCTURE')->get();
            $bldgstore=DB::table('tbdefitems')->where('tdi_td_name', 'BUILDINGSTOREY')->get();
            $rooftype=DB::table('tbdefitems')->where('tdi_td_name', 'ROOFTYPE')->get();
            $walltype=DB::table('tbdefitems')->where('tdi_td_name', 'WALLTYPE')->get();
            $fltype=DB::table('tbdefitems')->where('tdi_td_name', 'FLOORTYPE')->get();
            
            $arcaty=DB::table('tbdefitems')->where('tdi_td_name', 'AREACATEGORY')->get();
            $ceiling=DB::table('tbdefitems')->where('tdi_td_name', 'CEILINGTYPE')->get();
            $artype=DB::table('tbdefitems')->where('tdi_td_name', 'AREATYPE')->get();
            $aruse=DB::table('tbdefitems')->where('tdi_td_name', 'AREAUSE')->get();
            $arzone=DB::table('tbdefitems')->where('tdi_td_name', 'AREAZONE')->get();
            $attachtype=DB::table('tbdefitems')->where('tdi_td_name', 'ATTACHMENTTYPE')->get();


            $term=DB::select("select concat(vt_name,'', DATE_FORMAT(vt_createdate, '%d%m%Y')) termfoldername, vd_accno accountnumber, va_vt_id, vt_applicationtype_id,
                vt_name , applntype.tdi_value applntype, termstage.tdi_desc termstage, va_name, approval.tdi_desc approval, vd_approvalstatus_id
                FROM cm_appln_valterm inner join cm_appln_val on va_vt_id = vt_id inner join cm_appln_valdetl on vd_va_id = va_id  
                left join (SELECT * FROM tbdefitems where tdi_td_name = 'BASKETSTAGE') approval on approval.tdi_key = va_approvalstatus_id 
                left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
                on applntype.tdi_key = vt_applicationtype_id
                left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
                on termstage.tdi_key = vt_approvalstatus_id 
                 where vd_id = ".$prop_id);
             $iseditable = 1;
           
            foreach ($term as $rec) {
                $termname = $rec->termfoldername;
                $accountnumber = $rec->accountnumber;
                $viewparambasket = $rec->va_name;
                $viewparambasketstatus = $rec->approval;
                $propertystatus = $rec->vd_approvalstatus_id;
                $applntype = $rec->vt_applicationtype_id;
                $termid = $rec->va_vt_id;
                $viewparamterm = "( ".$rec->applntype." ) ".$rec->vt_name." - ".$rec->termstage ;
                if($rec->vd_approvalstatus_id == "04" || $rec->vd_approvalstatus_id == "05"){
                    $iseditable = 1;
                } else {
                    $iseditable = 0;
                }
            }

            $owner = DB::select('select cm_owner.*, owntype.tdi_value owntype, state.tdi_value state
from  cm_appln_valdetl  inner join cm_masterlist on ma_id = vd_ma_id
inner join cm_owner on to_ma_id = ma_id
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE") owntype on owntype.tdi_key = to_owntype_id
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = TO_STATE_ID
left join (select tdi_key, tdi_value,tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone 
on subzone.tdi_key = ma_subzone_id where vd_id = ifnull("'.$prop_id.'",0)');

        Log::info($owner);

            $master = DB::select('select ma_ishasbuilding_id, ma_id, ma_pb_id,  ma_accno,ma_fileno,subzone.tdi_value subzone, subzone.tdi_parent_name zone,  ma_subzone_id,subzone.tdi_parent_key zone_id, ma_district_id, ma_addr_ln1,ma_addr_ln2,ma_addr_ln3,ma_addr_ln4, ma_city, ma_state_id, ma_postcode 
from  cm_appln_valdetl  inner join cm_masterlist on ma_id = vd_ma_id
left join (select tdi_key, tdi_value,tdi_parent_key,tdi_parent_name from tbdefitems where tdi_td_name = "SUBZONE") subzone 
on subzone.tdi_key = ma_subzone_id where vd_id = ifnull("'.$prop_id.'",0)');
            //$master = DB::table('cm_masterlist')->where('ma_id', $prop_id)->first();
            //$building = DB::select('select * from cm_bldg where bl_ma_id = ifnull("'.$prop_id.'",0)');
            $building = DB::select('select DATE_FORMAT(ab_cccdate, "%d/%m/%Y") ab_cccdate1, DATE_FORMAT(ab_occupieddate, "%d/%m/%Y") ab_occupieddate1,cm_appln_bldg.*, bldgtype.tdi_value bldgtype, tdi_parent_name
                 bldgcategory, tdi_parent_key bldgcategory_id, bldgstorey.tdi_value bldgstorey, 
                bldgstr.tdi_value bldgstr
                , rootype.tdi_value rootype
                 from cm_appln_bldg left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype 
                 on bldgtype.tdi_key = AB_BLDGTYPE_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey
                on bldgstorey.tdi_key = AB_BLDGSTOREY_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGSTRUCTURE") bldgstr
                on bldgstr.tdi_key = AB_BLDGSTRUCTURE_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROOFTYPE") rootype  
                on rootype.tdi_key = AB_ROOFTYPE_ID where ab_vd_id = ifnull("'.$prop_id.'",0)');

            //$lotlist = DB::select('select * from cm_lot where lo_ma_id = ifnull("'.$prop_id.'",0)');
            $lotlist = DB::select('select DATE_FORMAT(al_startdate, "%d/%m/%Y") al_startdate1, DATE_FORMAT(al_expireddate, "%d/%m/%Y") al_expireddate1,cm_appln_lot.*, lotcode.tdi_value lotcode, roadtype.tdi_value roadtype, titletype.tdi_value titletype
                , unitsize.tdi_value unitsize, concat(lotcode.tdi_value,al_no) lotnumber, concat(titletype.tdi_value,al_titleno) titlenumber, landuse.tdi_value landuse, tentype.tdi_value tentype
                 from cm_appln_lot left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE") lotcode on lotcode.tdi_key = al_lotcode_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADTYPE") roadtype on roadtype.tdi_key = al_roadtype_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE") titletype on titletype.tdi_key = al_titletype_id
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SIZEUNIT") unitsize on unitsize.tdi_key = al_sizeunit_id
                left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDUSE") landuse on  al_landuse_id = landuse.tdi_key
                left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "TENURETYPE") tentype on  al_tenuretype_id = tentype.tdi_key 
                 where al_vd_id = ifnull("'.$prop_id.'",0)');

            //$ownerlist = DB::select('select * from cm_owner where to_ma_id = ifnull("'.$prop_id.'",0)');
            $ownerlist = DB::select('select cm_owner.*, owntype.tdi_value owntype, state.tdi_value state
             from cm_owner left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE") owntype on owntype.tdi_key = to_owntype_id
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = TO_STATE_ID
             where  TO_MA_ID = ifnull("'.$prop_id.'",0)');

           $bldgardetail = DB::select('select  cm_appln_bldgarea.*, cm_appln_bldg.ab_bldg_no, vd_accno, arzone.tdi_value arzone, arlvel.tdi_value arlvel, arcate.tdi_value arcate, floortype.tdi_value floortype
, artype.tdi_value artype, aruse.tdi_value aruse, ceilingtype.tdi_value ceilingtype, walltype.tdi_value walltype
from cm_appln_valdetl join  cm_appln_bldg on ab_vd_id = vd_id join cm_appln_bldgarea on aba_ab_id = ab_id 
left join tbdefitems artype on artype.tdi_key = cm_appln_bldgarea.ABA_AREATYPE_ID and  artype.tdi_td_name = "AREATYPE"
left join tbdefitems arcate on arcate.tdi_key = cm_appln_bldgarea.ABA_AREACATEGORY_ID  and arcate.tdi_td_name = "AREACATEGORY"
left join tbdefitems arlvel on arlvel.tdi_key = cm_appln_bldgarea.ABA_AREALEVEL_ID and arlvel.tdi_td_name = "AREALEVEL" 
left join tbdefitems arzone on arzone.tdi_key = cm_appln_bldgarea.ABA_AREAZONE_ID and arzone.tdi_td_name = "AREAZONE"
left join tbdefitems floortype on floortype.tdi_key = cm_appln_bldgarea.ABA_FLOORTYPE_ID and floortype.tdi_td_name = "FLOORTYPE"
left join tbdefitems aruse on aruse.tdi_key = cm_appln_bldgarea.aba_areause_id  and aruse.tdi_td_name = "AREAUSE"
left join tbdefitems ceilingtype on ceilingtype.tdi_key = cm_appln_bldgarea.ABA_CEILINGTYPE_ID and ceilingtype.tdi_td_name = "CEILINGTYPE"
left join tbdefitems walltype on walltype.tdi_key = cm_appln_bldgarea.aba_walltype_id  and walltype.tdi_td_name = "WALLTYPE" 
                where ab_vd_id = ifnull("'.$prop_id.'",0)');
            $count = count($master);

            $ratepayer = DB::select("select arp_id,`rp_id`, `rp_applntype_id`, applntype, `rp_type_id`, ratepayertype, `rp_no`, `rp_name`, `rp_addr_ln1`,
                    `rp_addr_ln2`, `rp_addr_ln3`, `rp_addr_ln4`,  `rp_postcode`,  `rp_state_id`, state,
                    `rp_citizen_id`, citizen,  `rp_race_id`, race, 
                    `rp_activeind_id`, activeind,  `rp_updateby`,  DATE_FORMAT(rp_updatedate, '%d/%m/%Y') rp_updatedate,rp_phone_no, rp_email_addr 
                FROM `cm_ratepayer`,cm_appln_ratepayer , (select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE') state,
                (select tdi_key citizen_id, tdi_value citizen from tbdefitems where tdi_td_name = 'CITIZEN') citizen,
                (select tdi_key race_id, tdi_value race from tbdefitems where tdi_td_name = 'RACE') race,
                (select tdi_key activeind_id, tdi_value activeind from tbdefitems where tdi_td_name = 'ACTIVEIND') activeind,
                (select tdi_key applntype_id, tdi_value applntype from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype,
                (select tdi_key ratepayertype_id, tdi_value ratepayertype from tbdefitems where tdi_td_name = 'RATEPAYERTYPE') ratepayertype
                where rp_state_id = state_id and rp_citizen_id = citizen_id and rp_race_id = race_id
                and rp_activeind_id = activeind_id and rp_applntype_id = applntype_id
                and rp_type_id = ratepayertype_id and rp_id = arp_rp_id  and arp_vd_id = ifnull(".$prop_id.",0) ");

               $tenant = DB::select("select at_id,`te_id`, `te_applntype_id`, applntype, `te_type_id`, tenanttype, `te_no`, `te_name`, `te_addr_ln1`,
                `te_addr_ln2`, `te_addr_ln3`, `te_addr_ln4`,  `te_postcode`,  `te_state_id`, state,
                `te_citizen_id`, citizen,  `te_race_id`, race, 
                `te_activeind_id`, activeind,  `te_updateby`,  `te_updatedate`, te_phone_no, te_email_addr
                FROM cm_appln_tenant,`cm_tenant`, (select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE') state,
                (select tdi_key citizen_id, tdi_value citizen from tbdefitems where tdi_td_name = 'CITIZEN') citizen,
                (select tdi_key race_id, tdi_value race from tbdefitems where tdi_td_name = 'RACE') race,
                (select tdi_key activeind_id, tdi_value activeind from tbdefitems where tdi_td_name = 'ACTIVEIND') activeind,
                (select tdi_key applntype_id, tdi_value applntype from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype,
                (select tdi_key tenanttype_id, tdi_value tenanttype from tbdefitems where tdi_td_name = 'TENURETYPE1') tenanttype
                where te_state_id = state_id and te_citizen_id = citizen_id and te_race_id = race_id
                and te_activeind_id = activeind_id and te_applntype_id = applntype_id
                and te_type_id = tenanttype_id and at_te_id =  te_id and at_vd_id = ifnull(".$prop_id.",0) ");
               
             $attachment = DB::select("
            select at_oringinalfilename,at_id,at_path,at_attachtype_id,at_filename,at_detail,at_createby,at_createdate, attachment.tdi_value attachment from cm_attachment left join 
            (select tdi_key, tdi_value from tbdefitems where tdi_td_name = 'ATTACHMENTTYPE') attachment on attachment.tdi_key =  at_attachtype_id  where at_linkid = ifnull(".$prop_id.",0) ");

              $parameter = DB::select("select ap_id,ap_bldgstatus_id,ap_propertycategory_id,ap_propertytype_id,ap_propertylevel_id  FROM cm_appln_parameter where ap_vd_id  = ifnull(".$prop_id.",0) ");

               $config=DB::select("select GROUP_CONCAT(config_value SEPARATOR  ':') serveradd from tbconfig  where config_name in ('host', 'port')");
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
        foreach ($building as $rec) {    
           $category = $rec->bldgcategory;
        }
$arlvl=DB::table('tbdefitems')->where('tdi_td_name', 'AREALEVEL')->where('tdi_parent_name', $category)->orderBy('tdi_sort')->get();
        App::setlocale(session()->get('locale'));

            return view("termsearch.attachment")->with('district', $district)->with('state', $state)->with('zone', $zone)->with('subzone', $subzone)->with(array('bldgstruct'=>$bldgstruct,'bldgstore'=>$bldgstore,'ishasbuilding'=>$ishasbuilding, 'landuse'=>$landuse, 'master'=> $master, 'lotlist'=> $lotlist, 'ownerlist'=>$ownerlist, 'building'=> $building,'lotcode'=> $lotcode, 'titiletype'=>$titiletype, 'unitsize'=> $unitsize, 'landcond'=>$landcond,'landpos' => $landpos,'roadtype'=> $roadtype, 'roadcaty'=>$roadcaty, 'tnttype'=> $tnttype, 'owntype'=>$owntype,'race' => $race,'citizen'=> $citizen, 'bldgcond'=>$bldgcond, 'bldgpos'=> $bldgpos, 'bldgstructure'=>$bldgstruct,'rooftype'=> $rooftype, 'walltype'=>$walltype, 'fltype'=> $fltype, 'arlvl'=>$arlvl,'arcaty' => $arcaty, 'artype'=> $artype, 'aruse'=>$aruse,'arzone' => $arzone,'ceiling' => $ceiling,'bldgcate' => $bldgcate,'bldgtype' => $bldgtype,'count' => $count, 'bldgardetail' => $bldgardetail,'ratepayer' => $ratepayer, 'tenant' => $tenant,'prop_id' => $prop_id,'pb'=> $pb,'parameter' => $parameter,'attachment'=>$attachment,'attachtype' => $attachtype, 'termname' => $termname, 'accountnumber' => $accountnumber,'serverhost' => $serverhost, 'ownerd' => $owner, 'viewparambasket' => $viewparambasket, 'viewparambasketstatus' => $viewparambasketstatus, 'viewparamterm' => $viewparamterm, 'termid' => $termid,
                'iseditable' => $iseditable, 'applntype' => $applntype));
    }

}