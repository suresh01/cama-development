<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Log;
use DB;
use Session;
use DataTables;
use JasperPHP; 
use App;

 
class ReportController extends Controller
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

    public function inspectionForm(Redirect $request){
    	$search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  , sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = "14" ');
        
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
    	return view('report.inspectionform')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }

    public function propertyTables(Request $request){
        Log::info('Test');
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
        /* $property = DB::table('cm_appln_valdetl')->join('cm_masternZlist', 'vd_ma_id', '=', 'ma_id')->leftJoin('cm_appln_val_tax', 'vd_id', '=', 'vt_vd_id')->leftJoin('tbdefitems_ishasbuilding', 'vd_ishasbuilding', '=', 'tbdefitems_ishasbuilding.tdi_key')->leftJoin('tbdefitems_bldgtype', 'vd_bldgtype_id', '=', 'tbdefitems_bldgtype.tdi_key')->leftJoin('tbdefitems_bldgstorey', 'vd_bldgstorey_id', '=', 'tbdefitems_bldgstorey.tdi_key')->select( 'vd_approvalstatus_id','vd_id', 'vd_va_id','ma_id', 'ma_pb_id', 'ma_fileno', 'ma_accno',
        'ma_addr_ln1', 'tbdefitems_ishasbuilding.tdi_value' ,
        'tbdefitems_bldgtype.tdi_value', 'tbdefitems_bldgstorey.tdi_value', 'tbdefitems_bldgtype.tdi_parent_name as bldgcategory',
        'vt_approvednt', 'vt_approvedtax', 'vt_proposedrate', 'vt_note')->where('vd_va_id', '=', $baskedid)->paginate(15);      */     
    // $property = DB::select('select * from property where vd_approvalstatus_id = "13" '.$filterquery);
      $property = DB::select('select `cm_appln_valdetl`.`vd_accno`,`cm_masterlist`.`ma_fileno`,
   `tbdefitems_subzone`.`tdi_parent_name` zone, `tbdefitems_subzone`.`tdi_value` subzone,
   `cm_masterlist`.`ma_addr_ln1`,`cm_masterlist`.`ma_addr_ln2`, owntype.tdi_value owntype, 
   `cm_owner`.`TO_OWNNAME`, (select count(*) from cm_appln_bldg where ab_vd_id = vd_id) bldgcount,
  `cm_appln_valdetl`.`vd_approvalstatus_id`, `cm_appln_valdetl`.`vd_id`, `cm_appln_valdetl`.`vd_va_id`, `cm_masterlist`.`ma_id`,
        `cm_masterlist`.`ma_pb_id`        
    FROM `cm_appln_valdetl`
    JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
    JOIN `cm_owner` ON `ma_id` = `TO_MA_ID`
    join cm_appln_val on va_id = vd_va_id
    LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
    LEFT JOIN `tbdefitems` as owntype on `TO_OWNTYPE_ID` = `owntype`.`tdi_key` and owntype.tdi_td_name = "OWNTYPE"
    where vd_approvalstatus_id in ("07","08","09","10","11") '.$filterquery);
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }


    public function valuationForm(Redirect $request){
        $search=DB::select(' select sd_key, sd_label, 
        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid   , sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = 15 ');

        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser, usr_position, usr_id FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }

        return view('report.valuationform')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }

    public function getUserdetail(Request $request){
        $userid = $request->input('id');

       // $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select usr_position FROM tbuser where usr_id = '.$userid);
        foreach ($userlist as $obj) {    
           $userposition = $obj->usr_position;
        }
        return response()->json(array('userposition'=> $userposition), 200);
    }



    public function valuationTables(Request $request){
        Log::info('Test');
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
      $property = DB::select('select `cm_appln_valdetl`.`vd_accno`,`cm_masterlist`.`ma_fileno`,va_name, vt_name, format(vt_approvednt,2) vt_approvednt, format(vt_approvedrate,2) vt_approvedrate, format(vt_approvedtax,2) vt_approvedtax,
  vd_valmethod_id,
  `cm_appln_valdetl`.`vd_approvalstatus_id`, `cm_appln_valdetl`.`vd_id`, `cm_appln_valdetl`.`vd_va_id`, `cm_masterlist`.`ma_id`,
        `cm_masterlist`.`ma_pb_id`
    FROM `cm_appln_valdetl`
    JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
    join cm_appln_val on va_id = vd_va_id
    join cm_appln_valterm on vt_id = va_vt_id
    join cm_appln_val_tax on vt_vd_id = vd_id   
    LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
    where vd_approvalstatus_id in ("10","11","14") '.$filterquery);
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

  /*  public function generateInspectionForm(Request $request)
    {   

             //$jasper = new JasperPHP;
      /*  $response = file_get_contents('http://example.com/send-sms?from=12345&to=67890&message=hello%20there');
    echo $response;
        $account = $request->input('accounts');
        $inspector = $request->input('inspector');
        $insdate = $request->input('insdate');
        $approvedby = $request->input('approvedby');
        $approveddate = $request->input('approveddate');
        Log::info($account);
       $input = $request->input();
            $account1 = $input['accounts'];
        Log::info($account1);
            // Compile a JRXML to Jasper
         //   JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/inspection.jrxml'))->execute();

      
        $filter = 'vd_id in ('. $account.')';
      JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/inspection.jasper'),
                false,
                array("pdf"),
                array("propid" => $filter,"inspectorname" => $inspector,"inspectordate" => $insdate,"insapprover" => $approvedby,"insapprovedate" => $approveddate,"logo" => 'D:\project\CAMA-2\img\logo.jpeg'),
            array(
              'driver' => 'generic',
              'username' => env('DB_USERNAME',''),
              'password' => env('DB_PASSWORD',''),
              'jdbc_driver' => 'com.mysql.jdbc.Driver',
              'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
            ))->execute();

       $headers = array(
              'Content-Type: application/pdf',
            );*/
          //  $xml = file_get_contents("http://localhost:8002/generateinspectionform?");
       /* return response()->download(base_path('/vendor/cossou/jasperphp/examples/inspection.pdf'), 'inspectionform.pdf', $headers);

    }*/



    public function group(Request $request){
       // Log::info( DB::statement('call json_procedure( )'));
         $page = $request->input('page');
         $id = 0;
         if($page == 1){
            $id = 16;
         } else if($page == 2){
            $id = 17;
         } else if($page == 3){
            $id = 17;
         } 
       $search=DB::select(' select sd_key, sd_label, 
        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid, sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = '.$id);

        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }

        if($page == 1){
             return view("report.valuationdatabasket")->with('search',$search)->with('serverhost',$serverhost)->with('msearchid',$id)->with('page',$page);
         } else {
           return view("report.valuationdata")->with('search',$search)->with('serverhost',$serverhost)->with('msearchid',$id)->with('page',$page);
         }

       
    }

     public function valuationDataTable(Request $request){
        
        ini_set('memory_limit', '2056M');
        $baskedid = $request->input('id');
        $maxRow = 30;
         $isfilter = $request->input('filter');
         $page = $request->input('page');
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
        $statuscond ="";

        if($page == 3){
          $statuscond = 'vt_approvalstatus_id = "05"' ;
       
        
     
        $group = DB::select("select vt_id as id, vt_termtype_id,vt_valbase_id, vt_id, vt_name name, vt_createby createby,  DATE_FORMAT(vt_createdate, '%d/%m/%Y') createdate, vt_updateby updateby, applntype.tdi_value applntype, 
          DATE_FORMAT(vt_updatedate, '%d/%m/%Y')  updatedate, ifnull(propertycount,0) propertycount,DATE_FORMAT(vt_termDate, '%d/%m/%Y') termDate, 
          DATE_FORMAT(now(), '%d/%m/%Y') enforceDate,  vt_applicationtype_id,DATE_FORMAT(vt_transferDate, '%d/%m/%Y') vt_transferDate, vt_transferby,
          termstage.tdi_desc termstage, vt_approvalstatus_id,ap_basket_count, valbase.tdi_value valbase 
          from cm_appln_valterm
          inner join ( select count(*) propertycount, max(vt_termDate) termdate from cm_appln_valterm
          inner JOIN (select va_vt_id termid from `cm_masterlist`
          inner join cm_appln_valdetl on vd_ma_id = ma_id
          inner join cm_appln_val on va_id = vd_va_id
          inner join cm_appln_valterm on vt_id = va_vt_id
          inner join v_activeterm on accno = vd_accno and v_activeterm.termdate = vt_termDate
          left join cm_appln_deactivedetl on dad_accno = ma_accno where dad_id is null) cm_masterlist 
          ON termid = vt_id ) termcount on termdate <= vt_termDate 
          left join (select va_vt_id, count(*) ap_basket_count from cm_appln_val where va_approvalstatus_id = '11' group by va_vt_id) approve on approve.va_vt_id = vt_id
          left join (select va_vt_id, count(*) basket_count from cm_appln_val group by va_vt_id) cm_appln_val on cm_appln_val.va_vt_id = vt_id
          left join (select va_vt_id, count(vd_id) property_count from cm_appln_valdetl inner join cm_appln_val on va_id = vd_va_id
          group by va_vt_id) cm_appln_valdetl on cm_appln_valdetl.va_vt_id = vt_id 
          left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
          on applntype.tdi_key = vt_applicationtype_id
          left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
          on termstage.tdi_key = vt_approvalstatus_id 
          left join (select *  from tbdefitems where tdi_td_name = 'VALUATIONBASE') valbase on valbase.tdi_key = vt_valbase_id
          where ".$statuscond." ".$filterquery."
             order by vt_id
        ");


      } else if($page == 2){
          $statuscond = 'vt_approvalstatus_id = vt_approvalstatus_id' ;

           $group = DB::select("select vt_id as id, vt_termtype_id,vt_valbase_id, vt_id, vt_name name, vt_createby createby,  DATE_FORMAT(vt_createdate, '%d/%m/%Y') createdate, vt_updateby updateby, applntype.tdi_value applntype, 
DATE_FORMAT(vt_updatedate, '%d/%m/%Y')  updatedate, ifnull(basket_count,0) basket_count, ifnull(property_count,0) propertycount,DATE_FORMAT(vt_termDate, '%d/%m/%Y') termDate, DATE_FORMAT(now(), '%d/%m/%Y') enforceDate,  vt_applicationtype_id,DATE_FORMAT(vt_transferDate, '%d/%m/%Y') vt_transferDate, vt_transferby,
termstage.tdi_desc termstage, vt_approvalstatus_id,ap_basket_count, valbase.tdi_value valbase 
from cm_appln_valterm
left join (select va_vt_id, count(*) ap_basket_count from cm_appln_val where va_approvalstatus_id = '11' group by va_vt_id) approve on approve.va_vt_id = vt_id
left join (select va_vt_id, count(*) basket_count from cm_appln_val group by va_vt_id) cm_appln_val on cm_appln_val.va_vt_id = vt_id
left join (select va_vt_id, count(vd_id) property_count from cm_appln_valdetl inner join cm_appln_val on va_id = vd_va_id
group by va_vt_id) cm_appln_valdetl on cm_appln_valdetl.va_vt_id = vt_id 
left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
on applntype.tdi_key = vt_applicationtype_id
left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
on termstage.tdi_key = vt_approvalstatus_id 
left join (select *  from tbdefitems where tdi_td_name = 'VALUATIONBASE') valbase on valbase.tdi_key = vt_valbase_id
          where ".$statuscond." ".$filterquery."
             order by vt_id
        ");
        } 
        $propertyDetails = Datatables::collection($group)->make(true);
   
        return $propertyDetails;
    }

    
     public function basketTables(Request $request){
        
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
        
      Log::info("select approval.tdi_value status,va_approvalstatus_id, va_id id, va_name l_group, va_vt_id termid, vt_name termaname, va_createby createby, DATE_FORMAT(va_createdate, '%d/%m/%Y') createdate, 
            va_updateby updateby, DATE_FORMAT(va_updatedate, '%d/%m/%Y') updatedate, propertycount,inspropertyccount
            from cm_appln_val left join (SELECT * FROM tbdefitems where tdi_td_name = 'APROVALSTATUS') approval on approval.tdi_key = va_approvalstatus_id join cm_appln_valterm  on va_vt_id = vt_id
            left join (select count(*) propertycount,vd_va_id from cm_appln_valdetl group by vd_va_id ) propcount on propcount.vd_va_id = va_id
            left join (select count(*) inspropertyccount ,vd_va_id from cm_appln_valdetl where vd_approvalstatus_id in ('13') 
            group by vd_va_id ) insprop on insprop.vd_va_id = va_id where va_approvalstatus_id = '11' ".$filterquery."
             order by va_id
        ");
        $group = DB::select("select approval.tdi_desc status,va_approvalstatus_id, va_id id, va_name l_group, va_vt_id termid,DATE_FORMAT(vt_termDate, '%d/%m/%Y') termdate,  vt_name termaname, va_createby createby, DATE_FORMAT(va_createdate, '%d/%m/%Y') createdate, 
            va_updateby updateby, DATE_FORMAT(va_updatedate, '%d/%m/%Y') updatedate, propertycount,inspropertyccount
            from cm_appln_val left join (SELECT * FROM tbdefitems where tdi_td_name = 'BASKETSTAGE') approval on approval.tdi_key = va_approvalstatus_id join cm_appln_valterm  on va_vt_id = vt_id
            left join (select count(*) propertycount,vd_va_id from cm_appln_valdetl group by vd_va_id ) propcount on propcount.vd_va_id = va_id
            left join (select count(*) inspropertyccount ,vd_va_id from cm_appln_valdetl where vd_approvalstatus_id in ('10','11','12') 
            group by vd_va_id ) insprop on insprop.vd_va_id = va_id where va_approvalstatus_id in ('06','07','08','09','10','11')  ".$filterquery."
             order by va_id
        ");
        $propertyDetails = Datatables::collection($group)->make(true);
   
        return $propertyDetails;
    }

    public function generateValuationData(Request $request)
    {        
             //$jasper = new JasperPHP;

        $account = $request->input('accounts');
        $title = $request->input('title');
        $page = $request->input('page');
        if($page == '3'){
          $filter = " vt_termDate <='". $account."'";
        } else if($page == '2'){
          $filter = ' va_vt_id in ('. $account.')';
        } else{
          $filter = ' vd_va_id in ('. $account.')';
        }
       
      /* $input = $request->input();
            $account1 = $input['accounts'];
        Log::info($account1);*/
            // Compile a JRXML to Jasper
        //    JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuationdata.jrxml'))->execute();
         Log::info(JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/valuationdata_active.jasper'),
                false,
                array("pdf"),               
                array("basketid" => $filter,'title'=>$title),
            array(
              'driver' => 'generic',
              'username' => env('DB_USERNAME',''),
              'password' => env('DB_PASSWORD',''),
              'jdbc_driver' => 'com.mysql.jdbc.Driver',
              'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?useSSL=false"
            ))->output());


      JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/valuationdata_active.jasper'),
                false,
                array("pdf"),               
                array("basketid" => $filter,'title'=>$title),
            array(
              'driver' => 'generic',
              'username' => env('DB_USERNAME',''),
              'password' => env('DB_PASSWORD',''),
              'jdbc_driver' => 'com.mysql.jdbc.Driver',
              'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?useSSL=false"
            ))->execute();

       $headers = array(
              'Content-Type: application/pdf',
            );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/valuationdata_active.pdf'), 'valuationdata_until_term.pdf', $headers);

    }

    public function generateValuationForm(Request $request)
    {        
        //$jasper = new JasperPHP;        
        $account = $request->input('accounts');
        Log::info($account);
        $input = $request->input();
            $account1 = $input['accounts'];
        Log::info($account1);
            // Compile a JRXML to Jasper
         //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();

        
        $filter = 'vd_id in ('. $account.')';
        JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/valuation.jasper'),
                false,
                array("pdf"),
                array("propid" => $filter),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->execute();

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/valuation.pdf'), 'valuation.pdf', $headers);

    }

    public function generateAgenda(Request $request)
    {        
        //$jasper = new JasperPHP;        
        $account = $request->input('accounts');
        Log::info($account);
        $input = $request->input();
            $account1 = $input['accounts'];
        Log::info($account1);
            // Compile a JRXML to Jasper
         //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();
        
        $filter = 'ag_id in ('. $account.')';
        JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/agenda.jasper'),
                false,
                array("pdf"),
                array("basketid" => $filter),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->execute();

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/agenda.pdf'), 'agenda.pdf', $headers);

    }

     public function generateNotis(Request $request)
    {        
        //$jasper = new JasperPHP;        
        $account = $request->input('accounts');
        Log::info($account);
        $input = $request->input();
            $account1 = $input['accounts'];
        Log::info($account1);
            // Compile a JRXML to Jasper
         //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();
        
        $filter = 'vd_id in ('. $account.')';
        JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/type1notis.jasper'),
                false,
                array("pdf"),
                array("propid" => $filter),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->execute();

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/type1notis.pdf'), 'Notice.pdf', $headers);

    }

    public function generateNotis2(Request $request)
    {        
        //$jasper = new JasperPHP;        
        $account = $request->input('accounts');
        Log::info($account);
        $input = $request->input();
            $account1 = $input['accounts'];
        Log::info($account1);
        $inspector = $request->input('inspector');
            // Compile a JRXML to Jasper
         //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();
        
        $filter = 'vd_id in ('. $account.')';
        JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/type2notis.jasper'),
                false,
                array("pdf"),
                array("propid" => $filter,'user'=>$inspector),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->execute();

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/type2notis.pdf'), 'Rejection Notice.pdf', $headers);

    }

    public function generateObjection1(Request $request)
    {        
        //$jasper = new JasperPHP;        
        $account = $request->input('accounts');
        Log::info($account);
        $input = $request->input();
            $account1 = $input['accounts'];
        Log::info($account1);
        $meetingroom = $request->input('meetingroom');
        $user = $request->input('user');
            // Compile a JRXML to Jasper
         //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();
        
        $filter = 'ol_vd_id  in ('. $account.')';
        JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/invitationletter.jasper'),
                false,
                array("pdf"),
                array("propid" => $filter,'meetingroom' => $meetingroom,'user' => $user),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->execute();

         /*Log::info( JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/objection1.jasper'),
                false,
                array("pdf"),
                array("propid" => $filter,'meetingroom' => $meetingroom,'user' => $user),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->output());*/

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/invitationletter.pdf'), 'Objection Invitation Letter.pdf', $headers);

    }

    public function generateObjection2(Request $request)
    {        
        //$jasper = new JasperPHP;        
        $account = $request->input('accounts');
        Log::info($account);
        $input = $request->input();
            $account1 = $input['accounts'];
        Log::info($account1);
            // Compile a JRXML to Jasper
         //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();
        
        $filter = 'ol_vd_id in ('. $account.')';
        JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/objectionlist.jasper'),
                false,
                array("pdf"),
                array("basketid" => $filter),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->execute();

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/objectionlist.pdf'), 'objectionlist.pdf', $headers);

    }

    public function generateResult(Request $request)
    {        
        //$jasper = new JasperPHP;        
        $account = $request->input('accounts');
        Log::info($account);
        $input = $request->input();
            $account1 = $input['accounts'];
        Log::info($account1);
        $user = $request->input('user');
            // Compile a JRXML to Jasper
         //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();
        
        $filter = 'vd_id in ('. $account.')';
        JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/result.jasper'),
                false,
                array("pdf"),
                array("propid" => $filter,'user' => $user),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->execute();

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/result.pdf'), 'result.pdf', $headers);

    }


    public function zoneSummary(Redirect $request){
      $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "21" ');
       //Log::info( DB::select("call proc_repo_summary_zonepropstatus(100042)"));
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
      return view('report.statistical.summaryzonebldg')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }

    public function zonesummaryTables(Request $request){
        Log::info('Test');
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
                    $termid =  $value[$fieldindex];
                }               
            }
            if($filterquery != ''){
                $filterquery  = ' where '. $filterquery ;
            }
            Log::info($filterquery);

        }
       // str_replace('tdi_key', 'tbdefitems_subzone.tdi_key', $filterquery);
        Log::info($filterquery);
        /* $property = DB::table('cm_appln_valdetl')->join('cm_masternZlist', 'vd_ma_id', '=', 'ma_id')->leftJoin('cm_appln_val_tax', 'vd_id', '=', 'vt_vd_id')->leftJoin('tbdefitems_ishasbuilding', 'vd_ishasbuilding', '=', 'tbdefitems_ishasbuilding.tdi_key')->leftJoin('tbdefitems_bldgtype', 'vd_bldgtype_id', '=', 'tbdefitems_bldgtype.tdi_key')->leftJoin('tbdefitems_bldgstorey', 'vd_bldgstorey_id', '=', 'tbdefitems_bldgstorey.tdi_key')->select( 'vd_approvalstatus_id','vd_id', 'vd_va_id','ma_id', 'ma_pb_id', 'ma_fileno', 'ma_accno',
        'ma_addr_ln1', 'tbdefitems_ishasbuilding.tdi_value' ,
        'tbdefitems_bldgtype.tdi_value', 'tbdefitems_bldgstorey.tdi_value', 'tbdefitems_bldgtype.tdi_parent_name as bldgcategory',
        'vt_approvednt', 'vt_approvedtax', 'vt_proposedrate', 'vt_note')->where('vd_va_id', '=', $baskedid)->paginate(15);      */     
    // $property = DB::select('select * from property where vd_approvalstatus_id = "13" '.$filterquery);
        $property = DB::select("call proc_repo_summary_zonepropstatus(".$termid.",'')");
     /* $property = DB::select('select `cm_appln_valdetl`.`vd_accno`,`cm_masterlist`.`ma_fileno`,
   `tbdefitems_subzone`.`tdi_parent_name` zone, `tbdefitems_subzone`.`tdi_value` subzone,
   `cm_masterlist`.`ma_addr_ln1`,`cm_masterlist`.`ma_addr_ln2`, owntype.tdi_value owntype, 
   `cm_owner`.`TO_OWNNAME`, (select count(*) from cm_appln_bldg where ab_vd_id = vd_id) bldgcount,
  `cm_appln_valdetl`.`vd_approvalstatus_id`, `cm_appln_valdetl`.`vd_id`, `cm_appln_valdetl`.`vd_va_id`, `cm_masterlist`.`ma_id`,
        `cm_masterlist`.`ma_pb_id`        
    FROM `cm_appln_valdetl`
    JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
    JOIN `cm_owner` ON `ma_id` = `TO_MA_ID`
    join cm_appln_val on va_id = vd_va_id
    LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
    LEFT JOIN `tbdefitems` as owntype on `TO_OWNTYPE_ID` = `owntype`.`tdi_key` and owntype.tdi_td_name = "OWNTYPE"
    where vd_approvalstatus_id in ("08","09","10","13","14") '.$filterquery);*/
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    public function subzoneSummary(Redirect $request){
      $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "21" ');
       //Log::info( DB::select("call proc_repo_summary_zonepropstatus(100042)"));
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
      return view('report.statistical.summaryzone')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }

    public function subzonesummaryTables(Request $request){
        Log::info('Test');
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


                    $termid =  $value[$fieldindex];
                }               
            }
            if($filterquery != ''){
                $filterquery  = ' where '. $filterquery ;
            }
           // Log::info($filterquery);

        }
       // str_replace('tdi_key', 'tbdefitems_subzone.tdi_key', $filterquery);
        Log::info($termid);
        /* $property = DB::table('cm_appln_valdetl')->join('cm_masternZlist', 'vd_ma_id', '=', 'ma_id')->leftJoin('cm_appln_val_tax', 'vd_id', '=', 'vt_vd_id')->leftJoin('tbdefitems_ishasbuilding', 'vd_ishasbuilding', '=', 'tbdefitems_ishasbuilding.tdi_key')->leftJoin('tbdefitems_bldgtype', 'vd_bldgtype_id', '=', 'tbdefitems_bldgtype.tdi_key')->leftJoin('tbdefitems_bldgstorey', 'vd_bldgstorey_id', '=', 'tbdefitems_bldgstorey.tdi_key')->select( 'vd_approvalstatus_id','vd_id', 'vd_va_id','ma_id', 'ma_pb_id', 'ma_fileno', 'ma_accno',
        'ma_addr_ln1', 'tbdefitems_ishasbuilding.tdi_value' ,
        'tbdefitems_bldgtype.tdi_value', 'tbdefitems_bldgstorey.tdi_value', 'tbdefitems_bldgtype.tdi_parent_name as bldgcategory',
        'vt_approvednt', 'vt_approvedtax', 'vt_proposedrate', 'vt_note')->where('vd_va_id', '=', $baskedid)->paginate(15);      */     
    // $property = DB::select('select * from property where vd_approvalstatus_id = "13" '.$filterquery);
        $property = DB::select("call proc_repo_summary_zone(".$termid.",'')");
     /* $property = DB::select('select `cm_appln_valdetl`.`vd_accno`,`cm_masterlist`.`ma_fileno`,
   `tbdefitems_subzone`.`tdi_parent_name` zone, `tbdefitems_subzone`.`tdi_value` subzone,
   `cm_masterlist`.`ma_addr_ln1`,`cm_masterlist`.`ma_addr_ln2`, owntype.tdi_value owntype, 
   `cm_owner`.`TO_OWNNAME`, (select count(*) from cm_appln_bldg where ab_vd_id = vd_id) bldgcount,
  `cm_appln_valdetl`.`vd_approvalstatus_id`, `cm_appln_valdetl`.`vd_id`, `cm_appln_valdetl`.`vd_va_id`, `cm_masterlist`.`ma_id`,
        `cm_masterlist`.`ma_pb_id`        
    FROM `cm_appln_valdetl`
    JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
    JOIN `cm_owner` ON `ma_id` = `TO_MA_ID`
    join cm_appln_val on va_id = vd_va_id
    LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
    LEFT JOIN `tbdefitems` as owntype on `TO_OWNTYPE_ID` = `owntype`.`tdi_key` and owntype.tdi_td_name = "OWNTYPE"
    where vd_approvalstatus_id in ("08","09","10","13","14") '.$filterquery);*/
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }


    public function racSummary(Redirect $request){
      $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "21" ');
       //Log::info( DB::select("call proc_repo_summary_zonepropstatus(100042)"));
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
      return view('report.statistical.racesummary')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }

    public function racesummaryTables(Request $request){
        Log::info('Test');
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
                    $termid =  $value[$fieldindex];
                }               
            }
            if($filterquery != ''){
                $filterquery  = ' where '. $filterquery ;
            }
            Log::info($filterquery);

        }
       // str_replace('tdi_key', 'tbdefitems_subzone.tdi_key', $filterquery);
        Log::info($filterquery);
        /* $property = DB::table('cm_appln_valdetl')->join('cm_masternZlist', 'vd_ma_id', '=', 'ma_id')->leftJoin('cm_appln_val_tax', 'vd_id', '=', 'vt_vd_id')->leftJoin('tbdefitems_ishasbuilding', 'vd_ishasbuilding', '=', 'tbdefitems_ishasbuilding.tdi_key')->leftJoin('tbdefitems_bldgtype', 'vd_bldgtype_id', '=', 'tbdefitems_bldgtype.tdi_key')->leftJoin('tbdefitems_bldgstorey', 'vd_bldgstorey_id', '=', 'tbdefitems_bldgstorey.tdi_key')->select( 'vd_approvalstatus_id','vd_id', 'vd_va_id','ma_id', 'ma_pb_id', 'ma_fileno', 'ma_accno',
        'ma_addr_ln1', 'tbdefitems_ishasbuilding.tdi_value' ,
        'tbdefitems_bldgtype.tdi_value', 'tbdefitems_bldgstorey.tdi_value', 'tbdefitems_bldgtype.tdi_parent_name as bldgcategory',
        'vt_approvednt', 'vt_approvedtax', 'vt_proposedrate', 'vt_note')->where('vd_va_id', '=', $baskedid)->paginate(15);      */     
    // $property = DB::select('select * from property where vd_approvalstatus_id = "13" '.$filterquery);
        $property = DB::select("call proc_repo_summary_racepropstatus(".$termid.")");
     /* $property = DB::select('select `cm_appln_valdetl`.`vd_accno`,`cm_masterlist`.`ma_fileno`,
   `tbdefitems_subzone`.`tdi_parent_name` zone, `tbdefitems_subzone`.`tdi_value` subzone,
   `cm_masterlist`.`ma_addr_ln1`,`cm_masterlist`.`ma_addr_ln2`, owntype.tdi_value owntype, 
   `cm_owner`.`TO_OWNNAME`, (select count(*) from cm_appln_bldg where ab_vd_id = vd_id) bldgcount,
  `cm_appln_valdetl`.`vd_approvalstatus_id`, `cm_appln_valdetl`.`vd_id`, `cm_appln_valdetl`.`vd_va_id`, `cm_masterlist`.`ma_id`,
        `cm_masterlist`.`ma_pb_id`        
    FROM `cm_appln_valdetl`
    JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
    JOIN `cm_owner` ON `ma_id` = `TO_MA_ID`
    join cm_appln_val on va_id = vd_va_id
    LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
    LEFT JOIN `tbdefitems` as owntype on `TO_OWNTYPE_ID` = `owntype`.`tdi_key` and owntype.tdi_td_name = "OWNTYPE"
    where vd_approvalstatus_id in ("08","09","10","13","14") '.$filterquery);*/
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    public function generateSummaryZone(Request $request)
    {
        //$jasper = new JasperPHP;        

        $termid = $request->input('termid');
        $title = $request->input('title');
        $subzone_id = $request->input('subzone_id');
Log::info($subzone_id);
 $filter = '';
      if($subzone_id != ''){
      
       $filter = ' `tbdefitems_subzone`.`tdi_key` in ('. $subzone_id.')';
     } 
        
       // $account = $request->input('accounts');
        //Log::info($account);
        //$input = $request->input();
       //     $account1 = $input['accounts'];
     //   Log::info($account1);
        //$user = $request->input('user');
            // Compile a JRXML to Jasper
         //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();
        
      //  $filter = 'vd_id in ('. $account.')';
     JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/summaryzone.jasper'),
                false,
                array("pdf"),
                 array("termid" => $termid,"title" => $title,"subzone" => $filter ),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->execute();

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/summaryzone.pdf'), 'summaryzone.pdf', $headers);

    }

    public function generateSummaryBLDG(Request $request)
    {        
        //$jasper = new JasperPHP;        
       // $account = $request->input('accounts');
        //Log::info($account);
        //$input = $request->input();
       //     $account1 = $input['accounts'];
     //   Log::info($account1);
        //$user = $request->input('user');
            // Compile a JRXML to Jasper
         //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();
        
      //  $filter = 'vd_id in ('. $account.')';

        $termid = $request->input('termid');
        $title = $request->input('title');
         $subzone_id = $request->input('subzone_id');
Log::info($subzone_id);
Log::info($termid);
 $filter = '';
      if($subzone_id != ''){
      
       $filter = ' `subzone`.`tdi_key` in ('. $subzone_id.')';
     } 
        

     JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/summarbldg.jasper'),
                false,
                array("pdf"),
                 array("termid" => $termid,"title" => $title ,"subzone" => $filter ),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->execute();

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/summarbldg.pdf'), 'summarbldg.pdf', $headers);

    }

    public function generateSummaryRace(Request $request)
    {        
        //$jasper = new JasperPHP;        
       // $account = $request->input('accounts');
        //Log::info($account);
        //$input = $request->input();
       //     $account1 = $input['accounts'];
     //   Log::info($account1);
        //$user = $request->input('user');
            // Compile a JRXML to Jasper
         //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();
        
      //  $filter = 'vd_id in ('. $account.')';

      $termid = $request->input('termid');
      $title = $request->input('title');

     JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/summaryrace1.jasper'),
                false,
                array("pdf"),
                 array("termid" => $termid,"title" => $title ),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->output();

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/summaryrace1.pdf'), 'summaryrace.pdf', $headers);

    }


    public function subzoneCollection(Redirect $request){
      $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "21" ');
       //Log::info( DB::select("call proc_repo_summary_zonepropstatus(100042)"));
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
      return view('report.collection.summaryzone')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }

    public function subzoneCollectionTables(Request $request){
        Log::info('Test');
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
                    $termid =  $value[$fieldindex];
                }               
            }
            if($filterquery != ''){
                $filterquery  = ' where '. $filterquery ;
            }
            Log::info($filterquery);

        }
       // str_replace('tdi_key', 'tbdefitems_subzone.tdi_key', $filterquery);
        Log::info($filterquery);

        $property = DB::select("call proc_repo_summary_zone(".$termid.",'')");

        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    public function bldgCollection(Redirect $request){
      $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "21" ');
       //Log::info( DB::select("call proc_repo_summary_zonepropstatus(100042)"));
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
      return view('report.collection.bldgcollection')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }

    public function bldgCollectionTables(Request $request){
        Log::info('Test');
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

                    $termid =  $value[$fieldindex];
                }               
            }
            if($filterquery != ''){
                $filterquery  = ' where '. $filterquery ;
            }
            Log::info($filterquery);
        }
       // str_replace('tdi_key', 'tbdefitems_subzone.tdi_key', $filterquery);
        Log::info($filterquery);

        $property = DB::select("call proc_repo_collection_zoneandbldgcategory(".$termid.")");

        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }


    public function generateCollectionZone(Request $request)
    {        
        //$jasper = new JasperPHP;        
       // $account = $request->input('accounts');
        //Log::info($account);
        //$input = $request->input();
       //     $account1 = $input['accounts'];
     //   Log::info($account1);
        //$user = $request->input('user');
            // Compile a JRXML to Jasper
         //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();
        
      //  $filter = 'vd_id in ('. $account.')';
      $termid = $request->input('termid');
      $title = $request->input('title');
     JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/collectionzone.jasper'),
                false,
                array("pdf"),
                 array("termid" => $termid,"title" => $title ),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->execute();

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/collectionzone.pdf'), 'collectionzone.pdf', $headers);

    }


    public function generateCollectionBLDG(Request $request)
    {        
        //$jasper = new JasperPHP;        
       // $account = $request->input('accounts');
        //Log::info($account);
        //$input = $request->input();
       //     $account1 = $input['accounts'];
     //   Log::info($account1);
        //$user = $request->input('user');
            // Compile a JRXML to Jasper
         //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();
        
      //  $filter = 'vd_id in ('. $account.')';
      $termid = $request->input('termid');
      $title = $request->input('title');
     JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/collectionbldg.jasper'),
                false,
                array("pdf"),
                 array("termid" => $termid,"title" => $title ),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->execute();

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/collectionbldg.pdf'), 'collectionbldg.pdf', $headers);

    }


    public function exportExcel(Redirect $request){
      $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  ,sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = "21" ');
       //Log::info( DB::select("call proc_repo_summary_zonepropstatus(100042)"));
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
      return view('report.exportexcel')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }

    public function exportExcelTables(Request $request){
        Log::info('Test');
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

                    $termid =  $value[$fieldindex];
                }               
            }
            if($filterquery != ''){
                $filterquery  = ' where '. $filterquery ;
            }
            Log::info($filterquery);
        }
       // str_replace('tdi_key', 'tbdefitems_subzone.tdi_key', $filterquery);
        Log::info($filterquery);

        $property = DB::select('
 select ma_accno, subzone.tdi_parent_key , bldgstorey.tdi_value bldgstorey, subzone.tdi_parent_name zone, subzone.tdi_value subzone, subzone.tdi_key, vt_termDate,
    bldgstatus.tdi_value bldgstatus, bldgstatus.tdi_key, proptype.tdi_parent_name bldgcategory, proptype.tdi_value bldgtype,
     vt_approvednt, vt_approvedrate, vt_proposednt, vt_approvedtax,
    vt_proposedrate, ma_addr_ln1, ma_addr_ln2, ma_addr_ln3, ma_addr_ln4, ma_postcode, propstate.tdi_value, to_addr_ln1,to_addr_ln2,
    to_addr_ln3, to_addr_ln4, to_postcode, ownstate.tdi_value
         from cm_appln_valterm 
        inner join cm_appln_val on va_vt_id = cm_appln_valterm.vt_id
        inner join cm_appln_valdetl on vd_va_id = va_id
        inner join cm_masterlist on ma_id = vd_ma_id
        inner join cm_appln_val_tax on vt_vd_id = vd_id
        inner join cm_owner on to_ma_id = cm_masterlist.ma_id
        inner join cm_appln_lot on al_vd_id = vd_id
        left join tbdefitems  subzone
        on subzone.`tdi_key` = ma_subzone_id and  subzone.tdi_td_name = "SUBZONE"
        left join tbdefitems proptype
        on proptype.tdi_key = vd_bldgtype_id and proptype.tdi_td_name = "BULDINGTYPE"
        left join tbdefitems bldgstatus
        on bldgstatus.tdi_key = vd_ishasbuilding and bldgstatus.tdi_td_name = "ISHASBUILDING"
    left join tbdefitems bldgstorey
    on bldgstorey.tdi_key = vd_bldgstorey_id and bldgstorey.tdi_td_name = "BUILDINGSTOREY"
        left join tbdefitems propstate
        on propstate.tdi_key = ma_state_id and propstate.tdi_td_name = "STATE"
        left join tbdefitems ownstate
        on ownstate.tdi_key = TO_STATE_ID and ownstate.tdi_td_name = "STATE" '.$filterquery.'  limit 1000');

        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }



    public function districtCollection(Redirect $request){
      $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "21" ');
       //Log::info( DB::select("call proc_repo_summary_zonepropstatus(100042)"));
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
      return view('report.collection.districtcollection')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }

    public function districtCollectionTables(Request $request){
        Log::info('Test');
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

                    $termid =  $value[$fieldindex];
                }               
            }
            if($filterquery != ''){
                $filterquery  = ' where '. $filterquery ;
            }
            Log::info($filterquery);
        }
       // str_replace('tdi_key', 'tbdefitems_subzone.tdi_key', $filterquery);
        Log::info($filterquery);

        $property = DB::select("call proc_repo_summary_district(".$termid.")");

        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }


    public function generateCollectionDIS(Request $request)
    {        
        //$jasper = new JasperPHP;        
       // $account = $request->input('accounts');
        //Log::info($account);
        //$input = $request->input();
       //     $account1 = $input['accounts'];
     //   Log::info($account1);
        //$user = $request->input('user');
            // Compile a JRXML to Jasper
         //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();
        
      //  $filter = 'vd_id in ('. $account.')';
      $termid = $request->input('termid');
      $title = $request->input('title');
     JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/summrydistrict.jasper'),
                false,
                array("pdf"),
                 array("termid" => $termid,"title" => $title ),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->execute();

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/summrydistrict.pdf'), 'summrydistrict.pdf', $headers);

    }

    public function borangC(Redirect $request){
      $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "14" ');

      $ratepayertype = DB::select("select * from tbdefitems where tdi_td_name = 'RATEPAYERTYPE'");
      $term = DB::select("select vt_id termid, vt_name term, applntype.tdi_value applntype, 
                termstage.tdi_desc termstage from cm_appln_valterm 
                left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
                on applntype.tdi_key = vt_applicationtype_id
                left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
                on termstage.tdi_key = vt_approvalstatus_id 
                order by vt_termDate desc");
        
        $ratepayer=DB::select('select  distinct te_id,te_name from cm_tenant  inner join cm_appln_tenant on at_te_id = te_id ');
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
      return view('report.borangc')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist)->with('ratepayertype',$ratepayertype)->with('term',$term)->with('ratepayer',$ratepayer);
    }


    public function generateBorangc(Request $request)
    {        
       
      $reportname = DB::select(" select * FROM tbconfig where config_name = 'CMKLOCALAUTHORITIESNAME' ");
      $reportstate = DB::select(" select * FROM tbconfig where config_name = 'CMKLOCALAUTHORITIESSTATE' ");
        //Log::info($permission);
      $temreportname = '';
      $temreportstate = '';
        foreach ($reportname as $obj) {            
          $temreportname = $obj->config_value;             
        }
        foreach ($reportstate as $obj) {            
          $temreportstate = $obj->config_value;                   
        }


      $termid = $request->input('termid');
      $ratepayertype = $request->input('ratepayertypeid');
      $ratepayer = $request->input('ratepayername');
      Log::info($termid);
      Log::info($ratepayertype);
      Log::info($ratepayer);
     JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/borangc.jasper'),
                false,
                array("pdf"),
                 array("name" => $temreportname,"state" => $temreportstate ,"termid" => $termid ,"ratepayertype" => $ratepayertype ,"ratepayer" => $ratepayer ),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->execute();

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/borangc.pdf'), 'borangc.pdf', $headers);

    }


    public function borangB(Redirect $request){
      $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "14" ');

      $ratepayertype = DB::select("select * from tbdefitems where tdi_td_name = 'RATEPAYERTYPE' AND tdi_key in 
      (SELECT DISTINCT rp_type_id FROM cm_ratepayer, cm_appln_ratepayer, cm_appln_valdetl, cm_appln_val
      WHERE ARP_RP_ID = rp_id AND
      vd_id = ARP_VD_ID AND 
      va_id = vd_va_id AND
      va_vt_id = 100052)");
      $term = DB::select("select vt_id termid, vt_name term, applntype.tdi_value applntype, 
                termstage.tdi_desc termstage from cm_appln_valterm 
                left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
                on applntype.tdi_key = vt_applicationtype_id
                left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
                on termstage.tdi_key = vt_approvalstatus_id 
                order by vt_termDate desc");
        
        $ratepayer=DB::select('select distinct te_id,te_name from cm_tenant  inner join cm_appln_tenant on at_te_id = te_id ');
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
      return view('report.borangb')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist)->with('ratepayertype',$ratepayertype)->with('term',$term)->with('ratepayer',$ratepayer);
    }

    public function generateBorangB(Request $request)
    {        
       
      $reportname = DB::select(" select * FROM tbconfig where config_name = 'CMKLOCALAUTHORITIESNAME' ");
      $reportstate = DB::select(" select * FROM tbconfig where config_name = 'CMKLOCALAUTHORITIESSTATE' ");
        //Log::info($permission);
      $temreportname = '';
      $temreportstate = '';
        foreach ($reportname as $obj) {            
          $temreportname = $obj->config_value;             
        }
        foreach ($reportstate as $obj) {            
          $temreportstate = $obj->config_value;                   
        }


      $termid = $request->input('termid');
      $ratepayertype = $request->input('ratepayertypeid');
      $ratepayer = $request->input('ratepayername');
      
      Log::info($termid);
      Log::info($ratepayertype);
      Log::info($ratepayer);
     JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/borangb.jasper'),
                false,
                array("pdf"),
                 array("name" => $temreportname,"state" => $temreportstate ,"termid" => $termid ,"ratepayertype" => $ratepayertype ,"ratepayer" => $ratepayer ),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->execute();

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/borangb.pdf'), 'borangb.pdf', $headers);

    }
 public function statistical(Redirect $request){
      $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  , sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = "16" ');
        
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
      return view('report.pivotreport')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }
 public function statisticalTables(Request $request){
        Log::info('Test');
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
                $filterquery  = ' Where '. $filterquery ;
            }
            Log::info($filterquery);

        }
       // str_replace('tdi_key', 'tbdefitems_subzone.tdi_key', $filterquery);
        Log::info($filterquery);
        /* $property = DB::table('cm_appln_valdetl')->join('cm_masternZlist', 'vd_ma_id', '=', 'ma_id')->leftJoin('cm_appln_val_tax', 'vd_id', '=', 'vt_vd_id')->leftJoin('tbdefitems_ishasbuilding', 'vd_ishasbuilding', '=', 'tbdefitems_ishasbuilding.tdi_key')->leftJoin('tbdefitems_bldgtype', 'vd_bldgtype_id', '=', 'tbdefitems_bldgtype.tdi_key')->leftJoin('tbdefitems_bldgstorey', 'vd_bldgstorey_id', '=', 'tbdefitems_bldgstorey.tdi_key')->select( 'vd_approvalstatus_id','vd_id', 'vd_va_id','ma_id', 'ma_pb_id', 'ma_fileno', 'ma_accno', 
        'ma_addr_ln1', 'tbdefitems_ishasbuilding.tdi_value' ,
        'tbdefitems_bldgtype.tdi_value', 'tbdefitems_bldgstorey.tdi_value', 'tbdefitems_bldgtype.tdi_parent_name as bldgcategory',
        'vt_approvednt', 'vt_approvedtax', 'vt_proposedrate', 'vt_note')->where('vd_va_id', '=', $baskedid)->paginate(15);      */     
    // $property = DB::select('select * from property where vd_approvalstatus_id = "13" '.$filterquery);
      $property = DB::select('select dumm1,dumm2,tax1,tax2,Zone,subzone,
bldgcategory,bldgtype,count(*) propcount,
 round(max(vt_approvedrate),3) vt_approvedrate,round(sum(vt_approvednt),3) vt_approvednt,round(sum(rm),3) rm
 from (select va_id, va_vt_id,0 dumm1,0 dumm2,(vt_approvednt * vt_approvedrate)/100 rm,0 tax1,0 tax2,
tbdefitems_subzone.tdi_parent_name Zone,tbdefitems_subzone.tdi_value subzone,
tbdefitems_bldgtype.tdi_parent_name bldgcategory,tbdefitems_bldgtype.tdi_value bldgtype,
vt_approvedrate,vt_approvednt
FROM `cm_appln_valdetl` inner join cm_appln_val on va_id = vd_va_id inner join cm_appln_valterm 
on va_vt_id = vt_id 
INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
INNER JOIN cm_owner ON TO_MA_ID = MA_ID 
INNER JOIN `tbdefitems_ishasbuilding` ON `cm_appln_valdetl`.`vd_ishasbuilding` = `tbdefitems_ishasbuilding`.`tdi_key`
INNER JOIN `tbdefitems_bldgtype` ON `tbdefitems_bldgtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id` 
INNER JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
INNER JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key` ) temp '.$filterquery.' group by dumm1,dumm2,tax1,tax2,Zone,subzone,
bldgcategory,bldgtype ');
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    public function generateNewOwner(Request $request)
    {        
        //$jasper = new JasperPHP;        
        $account = $request->input('basketid');        
        $date = $request->input('s_date');
        
        $filter = ' vd_va_id  = '. $account;
        JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/newowner.jasper'),
                false,
                array("pdf"),
                array("basket_id" => $filter),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true"
                ))->execute();

       /*  Log::info( JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/newowner.jasper'),
                false,
                array("pdf"),
                array("basket_id" => $filter,'selection_date' => $date),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->output());*/

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/vendor/cossou/jasperphp/examples/newowner.pdf'), 'notis penyata pemilik.pdf', $headers);

    }


    public function generateInspectionForm(Request $request)
    {        
        //$jasper = new JasperPHP;        
        $account = $request->input('accounts');
        $inspector = $request->input('inspector');
        $insdate = $request->input('insdate');
        $approvedby = $request->input('approvedby');
        $approveddate = $request->input('approveddate');
        Log::info($account);
        $input = $request->input();
        $account1 = $input['accounts'];
        Log::info($account1);
        $filter = 'vd_id in ('. $account.')';
            
            
            JasperPHP::process(
                base_path('/vendor/cossou/jasperphp/examples/inspection.jasper'),
                  false,
                    array("pdf"),
                    array("propid" => $filter,"inspectorname" => $inspector,"inspectordate" => $insdate,"insapprover" => $approvedby,"insapprovedate" => $approveddate,"logo" =>  base_path('/public/images/logo.jpeg')),
                array(
                  'driver' => 'generic',
                  'username' => env('DB_USERNAME',''),
                  'password' => env('DB_PASSWORD',''),
                  'jdbc_driver' => 'com.mysql.jdbc.Driver',
                  'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?useSSL=false"
                ))->execute();

             Log::info('3');
           $headers = array(
                  'Content-Type: application/pdf',
                );
           $output_path = base_path('/vendor/cossou/jasperphp/examples/inspection.pdf'  );
       
        return response()->download($output_path, 'inspectionform.pdf', $headers);

    }


    public function generateValuationR5(Request $request)
    {        
        //$jasper = new JasperPHP;        
        $account = $request->input('accounts');
        
        $tittle = $request->input('tittle');
        $name = $request->input('name');
        Log::info($account);
        $input = $request->input();
        $account1 = $input['accounts'];
        Log::info($account1);
        $filter = 'vd_id in ('. $account.')';            
            
        JasperPHP::process(
        base_path('/vendor/cossou/jasperphp/examples/valuationform.jasper'),
          false,
            array("pdf"),
            array("propid" => $filter,"valuer" => $name,"valuertitle" => $tittle,"logo" =>  base_path('/public/images/logo.jpeg')),
        array(
          'driver' => 'generic',
          'username' => env('DB_USERNAME',''),
          'password' => env('DB_PASSWORD',''),
          'jdbc_driver' => 'com.mysql.jdbc.Driver',
          'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?useSSL=false"
        ))->execute();

        Log::info('3');
        $headers = array(
          'Content-Type: application/pdf',
        );
        $output_path = base_path('/vendor/cossou/jasperphp/examples/valuationform.pdf'  );
       
        return response()->download($output_path, 'valuationform.pdf', $headers);

    }
}