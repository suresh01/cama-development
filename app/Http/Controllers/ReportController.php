<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Exports\InvoicesExport;
use Log;
use DB;
use Session;
use DataTables;
use JasperPHP; 
use App;
use Excel;

 
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
        App::setlocale(session()->get('locale'));
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
    where vd_approvalstatus_id in ("07","08","09","10","11","12") '.$filterquery);
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

        App::setlocale(session()->get('locale'));

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
    where vd_approvalstatus_id in ("10","11","12","14") '.$filterquery);
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

        App::setlocale(session()->get('locale'));

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
        $filterqueryvtid = '';
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
                if ($fieldcolumn[$fieldindex] == "vt_id") {
                    $filterqueryvtid =' '.$value[$fieldindex].'';
                }
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
          $statuscond = 'vt_approvalstatus_id = vt_approvalstatus_id' ;
       
        //$statuscond = 'vt_approvalstatus_id = "05"' ;
        
     
        $group = DB::select("select maxTermId id, maxAppTermType, maxTermName name, DATE_FORMAT(termDate, '%d/%m/%Y') termDate, maxEnforceDate enforceDate, count(vd_accno) propertycount
from cm_appln_valdetl
inner join cm_appln_val on va_id = vd_va_id
inner join cm_appln_valterm on vt_id = va_vt_id
inner join cm_masterlist on vd_ma_id = ma_id
left join (select vt_id maxTermId,vt_applicationtype_id maxAppTermType, vt_name maxTermName,  DATE_FORMAT(vt_termDate, '%d/%m/%Y') maxTermDate,  DATE_FORMAT(vt_approvalstatusdate, '%d/%m/%Y') maxEnforceDate FROM cm_appln_valterm) maxTerm on maxTerm.maxTermId = ".$filterqueryvtid."
inner join (select max(vt_termDate) termdate,  vd_ma_id, vd_accno as accountno from cm_appln_valdetl
inner join cm_appln_val on va_id = vd_va_id
inner join cm_appln_valterm on vt_id = va_vt_id
where  vt_termDate <=(select vt_termDate from cm_appln_valterm where vt_id = ".$filterqueryvtid.") and vt_applicationtype_id = (select vt_applicationtype_id from cm_appln_valterm where vt_id = ".$filterqueryvtid.")
and vd_accno NOT IN (select cm_appln_deactivedetl.dad_accno from cm_appln_deactivedetl inner join  cm_appln_deactive on cm_appln_deactivedetl.dad_da_id = cm_appln_deactive.da_id 
inner join cm_appln_valterm on cm_appln_deactive.da_vt_id = cm_appln_valterm.vt_id where vt_termDate <=(select vt_termDate from cm_appln_valterm where vt_id = ".$filterqueryvtid.") and vt_applicationtype_id = (select vt_applicationtype_id from cm_appln_valterm where vt_id = ".$filterqueryvtid."))
group by vd_ma_id) active_term on active_term.termdate = vt_termDate and active_term.accountno = cm_appln_valdetl.vd_accno");


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
        } else if($page == 0){
          $statuscond = 'vt_approvalstatus_id = vt_approvalstatus_id' ;
       
        //$statuscond = 'vt_approvalstatus_id = "05"' ;
        
     
        $group = DB::select("select get_activeterm_count(vt_termDate,'0','') propertycount, 
vt_id as id, vt_termDate, vt_termtype_id,vt_valbase_id, vt_id, vt_name name, vt_createby createby,  DATE_FORMAT(vt_createdate, '%d/%m/%Y') createdate, vt_updateby updateby, 
DATE_FORMAT(vt_updatedate, '%d/%m/%Y')  updatedate, DATE_FORMAT(vt_termDate, '%d/%m/%Y') termDate, 
DATE_FORMAT(now(), '%d/%m/%Y') enforceDate,  vt_applicationtype_id,DATE_FORMAT(vt_transferDate, '%d/%m/%Y') vt_transferDate, vt_transferby,
vt_approvalstatus_id
from  cm_appln_valterm 
          where ".$statuscond." ".$filterquery."
             order by vt_id
        ");


      }  else if($page ==1){
          $statuscond = 'vt_approvalstatus_id = vt_approvalstatus_id' ;
       
        //$statuscond = 'vt_approvalstatus_id = "05"' ;
        
     
        $group = DB::select("select get_activeterm_count(vt_termDate,'1','') propertycount, 
vt_id as id, vt_termDate, vt_termtype_id,vt_valbase_id, vt_id, vt_name name, vt_createby createby,  DATE_FORMAT(vt_createdate, '%d/%m/%Y') createdate, vt_updateby updateby, 
DATE_FORMAT(vt_updatedate, '%d/%m/%Y')  updatedate, DATE_FORMAT(vt_termDate, '%d/%m/%Y') termDate, 
DATE_FORMAT(now(), '%d/%m/%Y') enforceDate,  vt_applicationtype_id,DATE_FORMAT(vt_transferDate, '%d/%m/%Y') vt_transferDate, vt_transferby,
vt_approvalstatus_id
from  cm_appln_valterm 
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
        $account = $request->input('accounts');
        $title = $request->input('title');
        $page = $request->input('page');
        ini_set('max_execution_time', '360');
        ini_set('memory_limit', '2056M');

        $report_name = "";

        //DATE_FORMAT(vt_termDate, "%d/%m/%Y") <= '01/01/2021'
        if($page == '3'){
          $filter = ' "'.$account.'"';
          $report_name = "valuationdata_active2";
        } else if($page == '2'){
          $filter = ' va_vt_id in ('. $account.')';
          $report_name = "valuationdata_term";
        } else{
          $filter = ' vd_va_id in ('. $account.')';
          $report_name = "valuationdata_term";
        }
       
        
            Log::info(JasperPHP::process(
            base_path('/reports/'.$report_name.'.jasper'),
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
            base_path('/reports/'.$report_name.'.jasper'),
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

        return response()->download(base_path('/reports/'.$report_name.'.pdf'), 'valuationdata.pdf', $headers);

    }

    public function generateValuationForm(Request $request)
    {        
        //$jasper = new JasperPHP;        
        $account = $request->input('accounts');
        Log::info($account);
        $input = $request->input();
            $account1 = $input['accounts'];
        $filter = 'vd_id in ('. $account.')';
        Log::info( JasperPHP::process(
            base_path('/report/valuation.jasper'),
                false,
                array("pdf"),
                array("propid" => $filter),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->output());
            // Compile a JRXML to Jasper
         //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();

        
        JasperPHP::process(
            base_path('/report/valuation.jasper'),
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

        return response()->download(base_path('/report/valuation.pdf'), 'valuation.pdf', $headers);

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
            base_path('/reports/agenda.jasper'),
                false,
                array("pdf"),
                array("basketid" => $filter),
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

        return response()->download(base_path('/reports/agenda.pdf'), 'agenda.pdf', $headers);

    }

     public function generateNotis(Request $request)
    {        
        //$jasper = new JasperPHP;        
        $account = $request->input('accounts');
        $type = $request->input('type');
        Log::info($account);
        $input = $request->input();
            $account1 = $input['accounts'];
        Log::info($account1);
            // Compile a JRXML to Jasper
         //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();
        $reportname ="";
        if($type == '1'){
            $reportname ="notis141a";
            $filter = 'vd_id in ('. $account.')';
        JasperPHP::process(
            base_path('/reports/'.$reportname.'.jasper'),
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
        } else if($type == '2'){
            $reportname ="notis141b";
            $filter = 'vd_id in ('. $account.')';
        JasperPHP::process(
            base_path('/reports/'.$reportname.'.jasper'),
                false,
                array("pdf"),
                array("propid" => $filter,"logo" =>  base_path('/public/images/logo.jpeg')),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                ))->execute();
        } else if($type == '3'){
            $reportname ="notis144a";
            $filter = 'vd_id in ('. $account.')';
        JasperPHP::process(
            base_path('/reports/'.$reportname.'.jasper'),
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
        } else if($type == '4'){
            $reportname ="notis144b";
            $filter = 'vd_id in ('. $account.')';
        JasperPHP::process(
            base_path('/reports/'.$reportname.'.jasper'),
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
        }
        
       

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(base_path('/reports/'.$reportname.'.pdf'), 'Notice.pdf', $headers);

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
Log::info(JasperPHP::process(
            base_path('/reports/type2notis.jasper'),
                false,
                array("pdf"),
                array("propid" => $filter,'user'=>$inspector),
                array(
                      'driver' => 'generic',
                      'username' => env('DB_USERNAME',''),
                      'password' => env('DB_PASSWORD',''),
                      'jdbc_driver' => 'com.mysql.jdbc.Driver',
                      'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?useSSL=false"
                ))->output());

        JasperPHP::process(
            base_path('/reports/type2notis.jasper'),
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

        return response()->download(base_path('/reports/type2notis.pdf'), 'Rejection Notice.pdf', $headers);

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
            base_path('/reports/invitationletter.jasper'),
                false,
                array("pdf"),
                array("propid" => $filter,'meetingroom' => $meetingroom,'user' => $user,"letterhead" =>  base_path('/reports/images/invitationlatter.jpg')),
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

        return response()->download(base_path('/reports/invitationletter.pdf'), 'Objection Invitation Letter.pdf', $headers);

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
            base_path('/reports/objectionlist.jasper'),
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

        return response()->download(base_path('/reports/objectionlist.pdf'), 'objectionlist.pdf', $headers);

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
            base_path('/reports/result.jasper'),
                false,
                array("pdf"),
                array("propid" => $filter,'user' => $user),
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

        return response()->download(base_path('/reports/result.pdf'), 'result.pdf', $headers);

    }


    public function zoneSummary(Redirect $request){
      $search=DB::select(' select sd_key, sd_label, sd_keymainfield,
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "21" ');
       //Log::info( DB::select("call proc_repo_summary_zonepropstatus(100042)"));
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }

        App::setlocale(session()->get('locale'));

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
      $search=DB::select(' select sd_key, sd_label, sd_keymainfield,
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "21" ');
       //Log::info( DB::select("call proc_repo_summary_zonepropstatus(100042)"));
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }

        App::setlocale(session()->get('locale'));

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
      $search=DB::select(' select sd_key, sd_label, sd_keymainfield,
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "21" ');
       //Log::info( DB::select("call proc_repo_summary_zonepropstatus(100042)"));
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }

        App::setlocale(session()->get('locale'));

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
            base_path('/reports/summaryzone.jasper'),
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

        return response()->download(base_path('/reports/summaryzone.pdf'), 'summaryzone.pdf', $headers);

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
        Log::info('subzon'.$subzone_id);
        Log::info('term'.$termid);
 $filter = '';
      if($subzone_id != ''){
      
       $filter = ' `subzone`.`tdi_key` in ('. $subzone_id.')';
     } 
        

     JasperPHP::process(
            base_path('/reports/summarbldg.jasper'),
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

        return response()->download(base_path('/reports/summarbldg.pdf'), 'summarbldg.pdf', $headers);

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
            base_path('/reports/summaryrace1.jasper'),
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

        return response()->download(base_path('/reports/summaryrace1.pdf'), 'summaryrace.pdf', $headers);

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

        App::setlocale(session()->get('locale'));

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

        App::setlocale(session()->get('locale'));

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
            base_path('/reports/collectionzone.jasper'),
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

        return response()->download(base_path('/reports/collectionzone.pdf'), 'collectionzone.pdf', $headers);

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
            base_path('/reports/collectionbldg.jasper'),
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

        return response()->download(base_path('/reports/collectionbldg.pdf'), 'collectionbldg.pdf', $headers);

    }


    public function exportExcel(Redirect $request){
      $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  ,sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = "17" ');
       //Log::info( DB::select("call proc_repo_summary_zonepropstatus(100042)"));
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }

        App::setlocale(session()->get('locale'));

      return view('report.exportexcel')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }

    public function exportExcelTables(Request $request){
        Log::info('Test');
        ini_set('memory_limit', '2056M');
        ini_set('max_execution_time', '200');
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

        $property = DB::select("select get_activeterm_count(vt_termDate,'','1') propertycount, 
vt_id as id, vt_termDate, vt_termtype_id,vt_valbase_id, vt_id, vt_name name, vt_createby createby,  DATE_FORMAT(vt_createdate, '%d/%m/%Y') createdate, vt_updateby updateby, 
DATE_FORMAT(vt_updatedate, '%d/%m/%Y')  updatedate, DATE_FORMAT(vt_termDate, '%d/%m/%Y') termDate, 
DATE_FORMAT(now(), '%d/%m/%Y') enforceDate,  vt_applicationtype_id,DATE_FORMAT(vt_transferDate, '%d/%m/%Y') vt_transferDate, vt_transferby,
vt_approvalstatus_id
from  cm_appln_valterm ".$filterquery);

        $propertyDetails = Datatables::collection($property)->make(true);
        
        return $propertyDetails;
    }

    public function generateExcel(Request $request){
        $termid = $request->input('termid');
        ini_set('memory_limit', '2056M');
        ini_set('max_execution_time', '5000');
        $data = DB::select('select  vt_name,vt_termDate, va_id, va_name, ma_accno, vd_id, vd_ma_id, subzone.tdi_parent_key,subzone.tdi_parent_name, subzone.tdi_value subzone, subzone.tdi_key, 
        bldgstatus.tdi_value bldgstatus, bldgstatus.tdi_key bldgstatusid, proptype.tdi_parent_name propertycategory, proptype.tdi_value propertytype,vt_grossvalue,vt_proposednt, vt_proposedrate,
        vt_calculatedrate, vt_proposedtax, vt_approvednt, vt_approvedrate,ma_addr_ln1 ma_address1, ma_addr_ln2 ma_address2, ma_addr_ln3 ma_address3, ma_addr_ln4 ma_address4, ma_postcode, propstate.tdi_value, 
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
        on ownstate.tdi_key = TO_STATE_ID and ownstate.tdi_td_name = "STATE" 
        inner join (select max(vt_termDate) termdate,  vd_ma_id as va_maid, vd_accno as accountno from cm_appln_valdetl
        inner join cm_appln_val on va_id = vd_va_id
        inner join cm_appln_valterm on vt_id = va_vt_id
        where  cm_appln_valterm.vt_id  IN (select vt_id from cm_appln_valterm where vt_approvalstatus_id = "05") 
        and vd_accno NOT IN (select cm_appln_deactivedetl.dad_accno from cm_appln_deactivedetl inner join  cm_appln_deactive on cm_appln_deactivedetl.dad_da_id = cm_appln_deactive.da_id 
        inner join cm_appln_valterm on cm_appln_deactive.da_vt_id = cm_appln_valterm.vt_id where vt_id IN (select vt_id from cm_appln_valterm where vt_approvalstatus_id = "05") )
        group by vd_ma_id, vd_accno) active_term on active_term.termdate = vt_termDate and active_term.accountno = cm_appln_valdetl.vd_accno where cm_appln_valterm.vt_id <= '.$termid.'
         limit 7032 ');

        //Log::info($data);

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

    public function exportCsv(Request $request)
    {
       $fileName = 'tasks.csv';
       $termid = $request->input('termid');
        ini_set('memory_limit', '2056M');
        ini_set('max_execution_time', '5000');
        $data = DB::select('select  vt_name,vt_termDate, va_id, va_name, ma_accno,vd_id, vd_ma_id, subzone.tdi_parent_key zoneid,subzone.tdi_parent_name zone, subzone.tdi_value subzone, subzone.tdi_key subzoneid, 
        bldgstatus.tdi_value bldgstatus, bldgstatus.tdi_key bldgstatusid, proptype.tdi_parent_name propertycategory, proptype.tdi_value propertytype,vt_grossvalue,vt_proposednt, vt_proposedrate,
        vt_calculatedrate, vt_proposedtax, vt_approvednt, vt_approvedrate,ma_addr_ln1 ma_address1, ma_addr_ln2 ma_address2, ma_addr_ln3 ma_address3, ma_addr_ln4 ma_address4, ma_postcode, propstate.tdi_value propstate, 
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
        on ownstate.tdi_key = TO_STATE_ID and ownstate.tdi_td_name = "STATE" 
        inner join (select max(vt_termDate) termdate,  vd_ma_id as va_maid, vd_accno as accountno from cm_appln_valdetl
        inner join cm_appln_val on va_id = vd_va_id
        inner join cm_appln_valterm on vt_id = va_vt_id
        where  cm_appln_valterm.vt_id  IN (select vt_id from cm_appln_valterm where vt_approvalstatus_id = "05") 
        and vd_accno NOT IN (select cm_appln_deactivedetl.dad_accno from cm_appln_deactivedetl inner join  cm_appln_deactive on cm_appln_deactivedetl.dad_da_id = cm_appln_deactive.da_id 
        inner join cm_appln_valterm on cm_appln_deactive.da_vt_id = cm_appln_valterm.vt_id where vt_id IN (select vt_id from cm_appln_valterm where vt_approvalstatus_id = "05") )
        group by vd_ma_id, vd_accno) active_term on active_term.termdate = vt_termDate and active_term.accountno = cm_appln_valdetl.vd_accno where cm_appln_valterm.vt_id <= '.$termid.'
          ');

            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array('TermName', 
            'TermDate', 
            'va_id', 
             'va_name', 'accountnumber', 'vd_id', 'vd_ma_id', 'zoneid','zone', 'subzone', 'subzoneid', 'bldgstatus',
        'bldgstatusid', 'propertycategory', 'propertytype', 'grossvalue','proposednt', 'proposedrate',
        'calculatedrate', 'proposedtax', 'approvednt', 'approvedrate','propertyaddress1', 'propertyaddress2', 'propertyaddress3', 'propertyaddress4', 'propertypostcode', 'propstate', 
        'OWNNO', 'OWNNAME', 'to_addr_ln1','to_addr_ln2',
        'to_addr_ln3', 'to_addr_ln4', 'to_postcode', 'ownstate', 'al_no', 'al_altno', 'al_size', 'al_startdate', 'al_expireddate','al_tenureperiod');

            $callback = function() use($data, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($data as $rec) {
                    $row['TermName']  = $rec->vt_name;
                    $row['va_id']    = $rec->va_id;
                    $row['va_name']    = $rec->va_name;
                    $row['accountnumber']  = $rec->ma_accno;
                    $row['vd_id']  = $rec->vd_id;

                    $row['vd_ma_id']  = $rec->vd_ma_id;
                    $row['zoneid']    = $rec->zoneid;
                    $row['zone']    = $rec->zone;
                    $row['subzone']  = $rec->subzone;
                    $row['subzoneid']  = $rec->subzoneid;
                    $row['bldgstatus']  = $rec->bldgstatus;
                    $row['bldgstatusid']    = $rec->bldgstatusid;
                    $row['propertycategory']    = $rec->propertycategory;
                    $row['propertytype']  = $rec->propertytype;
                    $row['grossvalue']  = $rec->vt_grossvalue;
                    $row['proposednt']  = $rec->vt_proposednt;
                    $row['proposedrate']    = $rec->vt_proposedrate;
                    $row['calculatedrate']    = $rec->vt_calculatedrate;
                    $row['proposedtax']  = $rec->vt_proposedtax;
                    $row['approvednt']  = $rec->vt_approvednt;
                    $row['approvedrate']  = $rec->vt_approvedrate;
                    $row['propertyaddress1']    = $rec->ma_address1;
                    $row['propertyaddress2']    = $rec->ma_address2;
                    $row['propertyaddress3']  = $rec->ma_address3;
                    $row['propertyaddress4']  = $rec->ma_address4;
                    $row['propertypostcode']  = $rec->ma_postcode;
                    $row['propstate']    = $rec->propstate;
                    $row['OWNNO']    = $rec->TO_OWNNO;
                    $row['OWNNAME']  = $rec->TO_OWNNAME;
                    $row['to_addr_ln1']  = $rec->to_addr_ln1;
                    $row['to_addr_ln2']  = $rec->to_addr_ln2;
                    $row['to_addr_ln3']    = $rec->to_addr_ln3;
                    $row['to_addr_ln4']    = $rec->to_addr_ln4;
                    $row['to_postcode']  = $rec->to_postcode;
                    $row['ownstate']  = $rec->ownstate;
                    $row['al_no']    = $rec->al_no;
                    $row['al_altno']    = $rec->al_altno;
                    $row['al_size']  = $rec->al_size;
                    $row['al_startdate']  = $rec->al_startdate;
                    $row['al_expireddate']  = $rec->al_expireddate;
                    $row['al_tenureperiod']    = $rec->al_tenureperiod;

                    fputcsv($file, array($row['TermName'], $row['va_id'], $row['va_name'], $row['accountnumber'], $row['vd_id'], $row['vd_ma_id'], $row['zoneid'] ,$row['zone'] ,
                      $row['subzone'], $row['subzoneid'],  $row['bldgstatus'],  $row['bldgstatusid'],  $row['propertycategory'] , $row['propertytype'],  $row['grossvalue'],
                      $row['proposednt'],  $row['proposedrate'],  $row['calculatedrate'],  $row['proposedtax'],  $row['approvednt'],  $row['approvedrate'],  $row['propertyaddress1'],
                      $row['propertyaddress2'],  $row['propertyaddress3'],  $row['propertyaddress4'],  $row['propertypostcode'],  $row['propstate'],  $row['OWNNO'],
                      $row['OWNNAME'],  $row['to_addr_ln1'],  $row['to_addr_ln2'],  $row['to_addr_ln3'],  $row['to_addr_ln4'],  $row['to_postcode'],  $row['ownstate'],
                      $row['al_no'],  $row['al_altno'],  $row['al_size'],  $row['al_startdate'],  $row['al_expireddate'],  $row['al_tenureperiod'] ));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
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

        App::setlocale(session()->get('locale'));
        
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
            base_path('/reports/summrydistrict.jasper'),
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

        return response()->download(base_path('/reports/summrydistrict.pdf'), 'summrydistrict.pdf', $headers);

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
                where vt_applicationtype_id = 'C' and vt_approvalstatus_id = '05'
                order by vt_termDate desc");
        
        $ratepayer=DB::select('select  distinct te_id,te_name from cm_tenant  inner join cm_appln_tenant on at_te_id = te_id ');
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }

        App::setlocale(session()->get('locale'));
        
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
            base_path('/reports/borangc.jasper'),
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

        return response()->download(base_path('/reports/borangc.pdf'), 'borangc.pdf', $headers);

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
                where vt_applicationtype_id = 'C'
                order by vt_termDate desc");
        
        $ratepayer=DB::select('select distinct te_id,te_name from cm_tenant  inner join cm_appln_tenant on at_te_id = te_id ');
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }

        App::setlocale(session()->get('locale'));
        
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
            base_path('/reports/borangb.jasper'),
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

        return response()->download(base_path('/reports/borangb.pdf'), 'borangb.pdf', $headers);

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

        App::setlocale(session()->get('locale'));
        
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
            base_path('/reports/newowner.jasper'),
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

        return response()->download(base_path('/reports/newowner.pdf'), 'notis penyata pemilik.pdf', $headers);

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
                base_path('/reports/inspection.jasper'),
                  false,
                    array("pdf"),
                    array("propid" => $filter,"inspectorname" => $inspector,"inspectordate" => $insdate,"insapprover" => $approvedby,"insapprovedate" => $approveddate,"logo" =>  base_path('/public/images/logo.jpeg'),"SUBREPORT_DIR" => base_path('/reports/')),
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
           $output_path = base_path('/reports/inspection.pdf'  );
       
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
        base_path('/reports/valuationform.jasper'),
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
        $output_path = base_path('/reports/valuationform.pdf'  );
       
        return response()->download($output_path, 'valuationform.pdf', $headers);

    }

    public function r4cover(Redirect $request){
      $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  , sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = "14" ');
        
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }

        App::setlocale(session()->get('locale'));
        
      return view('report.r4cover')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }

    public function r4coverDataTables(Request $request){
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
      $property = DB::select('select vd_id, `cm_appln_valdetl`.`vd_accno`,`cm_masterlist`.`ma_fileno`,
concat(`tbdefitems_subzone`.`tdi_parent_name`, "/" , `tbdefitems_subzone`.`tdi_value`) subzone,
`cm_masterlist`.`ma_addr_ln1`,`cm_masterlist`.`ma_addr_ln2`, ma_addr_ln3, ma_addr_ln4, ma_city, ma_postcode, concat(`lotcode`.`tdi_value` , "-",al_no, "/", al_altno) lot_detail,
`cm_appln_valdetl`.`vd_approvalstatus_id`, `cm_appln_valdetl`.`vd_id`, `cm_appln_valdetl`.`vd_va_id`, `cm_masterlist`.`ma_id`,
`cm_masterlist`.`ma_pb_id` 
FROM `cm_appln_valdetl`
JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
join cm_appln_val on va_id = vd_va_id
join cm_appln_lot on al_vd_id = vd_id
LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
left join tbdefitems as lotcode on lotcode.tdi_key = al_lotcode_id and lotcode.tdi_td_name = "LOTCODE"
where vd_approvalstatus_id in ("07","08","09","10","11","12") '.$filterquery);
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }



    public function defunctReport(Request $request){
        $param = $request->input('param');
        if($param =='All') {
          $param ='da_vt_id';
        } else if($param ==''){
          $param ='0';
        }
       // Log::info( DB::statement('call json_procedure( )'));
        $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "18" ');
       $termcondition = "";
        
        $termfilter = DB::select("select vt_id termid, vt_name term, applntype.tdi_value applntype, 
                termstage.tdi_desc termstage
                from cm_appln_valterm
                left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
                on applntype.tdi_key = vt_applicationtype_id
                left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
                on termstage.tdi_key = vt_approvalstatus_id ". $termcondition ." order by vt_termDate desc");
        $term = DB::select("select vt_id termid, vt_name term, applntype.tdi_value applntype, 
                termstage.tdi_desc termstage from cm_appln_valterm 
                left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
                on applntype.tdi_key = vt_applicationtype_id
                left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
                on termstage.tdi_key = vt_approvalstatus_id 
                 where vt_approvalstatus_id = '01' order by vt_termDate desc");
        $group = DB::select("select da_approved,da_id, da_vt_id, applntype.tdi_value tdi_value, vt_name, da_name, DATE_FORMAT(da_createddate, '%d/%m/%Y') da_createddate, da_createdby,
          DATE_FORMAT(da_updateddate, '%d/%m/%Y') da_updateddate, da_updateby, (select count(*) from cm_appln_deactivedetl where
          dad_da_id = da_id) porpcount
          from cm_appln_deactive
          inner join cm_appln_valterm on vt_id = da_vt_id 
          left join tbdefitems applntype on applntype.tdi_key = vt_applicationtype_id and applntype.tdi_td_name = 'APPLICATIONTYPE'
                  where  da_vt_id = ".$param."
                  order by da_id desc");
        $tonebasket = DB::select("select tollist_id, concat(tollis_enforceyear,' - ',tollis_desc) tonebasket from cm_toneoflistbasket where tollis_activeind_id = 1");
        $tonetaxbasket = DB::select("select trlist_id, concat(trlist_enforceyear,' - ',trlist_desc) tonetaxbasket from cm_taxratelistbasket where trlist_activeind_id = 1");

        $propcount = DB::select('select  count(*) totproperty_count from cm_appln_valdetl 
        inner join cm_appln_val on va_id = vd_va_id where  va_vt_id = ifnull("'.$param.'",0)');

        $bldgcount = DB::select('select  count(*) bldgcount from cm_appln_bldg
          inner join cm_appln_valdetl  on ab_vd_id = vd_id 
          inner join cm_appln_val on va_id = vd_va_id where  va_vt_id = ifnull("'.$param.'",0) ');


        $inspropcount = DB::select('select  count(*) inscount from cm_appln_valdetl 
        inner join cm_appln_val on va_id = vd_va_id
        where vd_approvalstatus_id in ("06","07","08","09","10","11","12") and  va_vt_id = ifnull("'.$param.'",0)');

        $valpropcount = DB::select('select  count(*) valcount from cm_appln_valdetl 
        inner join cm_appln_val on va_id = vd_va_id where vd_approvalstatus_id in ("08","09","10","11","12") and  va_vt_id = ifnull("'.$param.'",0)');
        if($param =='da_vt_id') {
          $param ='All';
        } 
        App::setlocale(session()->get('locale'));
        return view("report.deactivereport")->with(array('term'=> $term,'group'=> $group,'tonebasket'=>$tonebasket,'tonetaxbasket'=>$tonetaxbasket,'propcount'=>$propcount,'bldgcount'=>$bldgcount,'inspropcount'=>$inspropcount,'valpropcount'=>$valpropcount,'termfilter' => $termfilter, 'param' => $param));
    }



    public function generateR4Cover(Request $request)
    {        
             //$jasper = new JasperPHP;
        $account = $request->input('accounts');
        
        $filter = " vd_id in (". $account.")";
        
       
      /* $input = $request->input();
            $account1 = $input['accounts'];
        Log::info($account1);*/
            // Compile a JRXML to Jasper
        //    JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuationdata.jrxml'))->execute();
         Log::info(JasperPHP::process(
            base_path('/reports/r4cover.jasper'),
                false,
                array("pdf"),               
                array("param_condition" => $filter,"logo" =>  base_path('/public/images/logo.jpeg')),
            array(
              'driver' => 'generic',
              'username' => env('DB_USERNAME',''),
              'password' => env('DB_PASSWORD',''),
              'jdbc_driver' => 'com.mysql.jdbc.Driver',
              'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?useSSL=false"
            ))->output());

      JasperPHP::process(
            base_path('/reports/r4cover.jasper'),
                false,
                array("pdf"),               
                array("param_condition" => $filter,"background" =>  base_path('/reports/images/r4cover_bg.jpg')),
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

        return response()->download(base_path('/reports/r4cover.pdf'), 'r4cover.pdf', $headers);

    }

    public function generateOwnerTypeA(Request $request)
    {        
             //$jasper = new JasperPHP;
        $account = $request->input('accounts');
        $prntdate = $request->input('prntdate');
        
        $filter = " vd_id in (". $account.")";
        
       Log::info($filter);
      /* $input = $request->input();
            $account1 = $input['accounts'];
        Log::info($account1);*/
            // Compile a JRXML to Jasper
        //    JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuationdata.jrxml'))->execute();
         Log::info(JasperPHP::process(
            base_path('/reports/ownernoticea.jasper'),
                false,
                array("pdf"),
                array("propid" => $filter,"p_date" =>  $prntdate),               
                //array("param_condition" => $filter,"background" =>  base_path('/public/images/onwertypea.jpg')),

            array(
              'driver' => 'generic',
              'username' => env('DB_USERNAME',''),
              'password' => env('DB_PASSWORD',''),
              'jdbc_driver' => 'com.mysql.jdbc.Driver',
              'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?useSSL=false"
            ))->output());

      JasperPHP::process(
            base_path('/reports/ownernoticea.jasper'),
                false,
                array("pdf"),    
                array("propid" => $filter,"p_date" =>  $prntdate),             
                //array("param_condition" => $filter,"background" =>  base_path('/reports/images/onwertypea.jpg')),
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

        return response()->download(base_path('/reports/onwertypea.pdf'), 'Onwer Type A.pdf', $headers);

    }

     public function ownerNotice(Redirect $request){
      $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  , sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = "14" ');
        
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }

        App::setlocale(session()->get('locale'));
        
      return view('report.ownernotice')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }

    public function ownerNoticeDataTables(Request $request){
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
      $property = DB::select('select vd_id, to_ownname, to_ownno, `cm_appln_valdetl`.`vd_accno`,`cm_masterlist`.`ma_fileno`,
concat(`tbdefitems_subzone`.`tdi_parent_name`, "/" , `tbdefitems_subzone`.`tdi_value`) subzone,
`cm_masterlist`.`ma_addr_ln1`,`cm_masterlist`.`ma_addr_ln2`, ma_addr_ln3, ma_addr_ln4, ma_city, ma_postcode, concat(`lotcode`.`tdi_value` , "-",al_no, "/", al_altno) lot_detail,
`cm_appln_valdetl`.`vd_approvalstatus_id`, `cm_appln_valdetl`.`vd_id`, `cm_appln_valdetl`.`vd_va_id`, `cm_masterlist`.`ma_id`,
`cm_masterlist`.`ma_pb_id`
FROM `cm_appln_valdetl`
inner join `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
inner join cm_owner on to_ma_id = ma_id
inner join cm_appln_val on va_id = vd_va_id
inner join cm_appln_lot on al_vd_id = vd_id
LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
left join tbdefitems as lotcode on lotcode.tdi_key = al_lotcode_id and lotcode.tdi_td_name = "LOTCODE" '.$filterquery);
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    public function generateOwnerTypeB(Request $request)
    {        
             //$jasper = new JasperPHP;
        $account = $request->input('accounts');
        $prntdate = $request->input('prntdate');
        
        $filter = " vd_id in (". $account.")";
        
       
      /* $input = $request->input();
            $account1 = $input['accounts'];
        Log::info($account1);*/
            // Compile a JRXML to Jasper
        //    JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuationdata.jrxml'))->execute();
         Log::info(JasperPHP::process(
            base_path('/reports/ownernoticeb.jasper'),
                false,
                array("pdf"),               
                array("propid" => $filter,"p_date" =>  $prntdate),
            array(
              'driver' => 'generic',
              'username' => env('DB_USERNAME',''),
              'password' => env('DB_PASSWORD',''),
              'jdbc_driver' => 'com.mysql.jdbc.Driver',
              'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?useSSL=false"
            ))->output());

      JasperPHP::process(
            base_path('/reports/ownernoticeb.jasper'),
                false,
                array("pdf"),               
                array("propid" => $filter,"p_date" =>  $prntdate),
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

        return response()->download(base_path('/reports/ownernoticeb.pdf'), 'Onwer Notice Type B.pdf', $headers);

    }

    public function ownerTransferList(Redirect $request){
      $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  , sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = "40" ');
        
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }

        App::setlocale(session()->get('locale'));
        
      return view('report.ownershiptransferlist')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }

    public function ownerTransferListData(Request $request){
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
                $filterquery  = ' WHERE '. $filterquery ;
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
      $property = DB::select("select otar_id, otar_accno, grouptb.tdi_value, otar_ownertransgroup_id, date_format(otar_createdate,'%d/%m/%Y') otar_createdate, otar_createby, 'TRANSFER',
date_format(ota_createdate,'%d/%m/%Y')  ota_createdate, ota_createby, DATEDIFF(otar_createdate, ota_createdate) + 1 days  
from cm_ownertrans_applnreg 
inner join cm_ownertrans_appln on ota_otar_id = otar_id
inner join tbdefitems grouptb on  grouptb.tdi_key = otar_ownertransgroup_id  and grouptb.tdi_td_name = 'USERGROUP' ".$filterquery);
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }



    public function generateOwnerTransferList(Request $request)
    {        
             //$jasper = new JasperPHP;
        $account = $request->input('accounts');
        //$prntdate = $request->input('prntdate');
        
        $filter = " otar_id in (". $account.")";
        
       
      /* $input = $request->input();
            $account1 = $input['accounts'];
        Log::info($account1);*/
            // Compile a JRXML to Jasper
        //    JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuationdata.jrxml'))->execute();
         Log::info(JasperPHP::process(
            base_path('/reports/ownershiptransferlist.jasper'),
                false,
                array("pdf"),               
                array("basketid" => $filter),
            array(
              'driver' => 'generic',
              'username' => env('DB_USERNAME',''),
              'password' => env('DB_PASSWORD',''),
              'jdbc_driver' => 'com.mysql.jdbc.Driver',
              'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?useSSL=false"
            ))->output());

      JasperPHP::process(
            base_path('/reports/ownershiptransferlist.jasper'),
                false,
                array("pdf"),               
                array("basketid" => $filter),
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

        return response()->download(base_path('/reports/ownershiptransferlist.pdf'), 'Onwership Transfer List.pdf', $headers);

    }

     public function pivotReport(Request $request){
       // Log::info( DB::statement('call json_procedure( )'));
         $page = $request->input('page');
       
        
       $search=DB::select(' select sd_key, sd_label, 
        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid, sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = 17');

     


        App::setlocale(session()->get('locale'));
        
        
        return view("report.statistical.pivot")->with('search',$search)->with('page',$page);
        

       
    }

    public function generatePivotReport(Request $request)
    {        
        $account = $request->input('accounts');
        $title = $request->input('title');
        $page = $request->input('page');
        ini_set('max_execution_time', '360');
        ini_set('memory_limit', '2056M');

        $report_name = "";

       
       
        
            Log::info(JasperPHP::process(
            base_path('/reports/summarbldg.jasper'),
                false,
                array("pdf"),               
                 array("termid" => $account,"title" => $title ,"bldgstatu" => $page ),
            array(
              'driver' => 'generic',
              'username' => env('DB_USERNAME',''),
              'password' => env('DB_PASSWORD',''),
              'jdbc_driver' => 'com.mysql.jdbc.Driver',
              'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?useSSL=false"
            ))->output());


      JasperPHP::process(
            base_path('/reports/summarbldg.jasper'),
                false,
                array("pdf"),               
                 array("termid" => $account,"title" => $title ,"bldgstatu" => $page ),
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

        return response()->download(base_path('/reports/summarbldg.pdf'), 'Summary Report.pdf', $headers);

    }


    public function officialSearchReport(Request $request)
    {        
      $type = $request->input('type');
      $accountnumber = $request->input('accountnumber');
      $tittle = $request->input('title');
      $name = $request->input('username');
      if($type == 'Successs'){
        $jasper_path = base_path('/reports/officialsearch.jasper');
        $dowload_path = base_path('/reports/officialsearch.pdf');
        $filename = 'Official Search.pdf';
      }
          
              // Compile a JRXML to Jasper
           //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();
          
      //Log::info($type);
      //Log::info($accountnumber);
      //Log::info($name);
 
          $filter = ' os_id = '. $accountnumber;

          JasperPHP::process(
             $jasper_path,
                  false,
                  array("pdf"),
                  array("propid" => $filter,'user'=>$name),
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

          return response()->download($dowload_path, $filename, $headers);

    }

    public function generateDeactive(Request $request)
    {        
             //$jasper = new JasperPHP;
        $title = $request->input('title');
        $termid = $request->input('termid');
        if($termid == 'All'){
          $filter = " da_vt_id = da_vt_id";
        } else {
          $filter = " da_vt_id = ". $termid;
        }
        
        
       
      /* $input = $request->input();
            $account1 = $input['accounts'];
        Log::info($account1);*/
            // Compile a JRXML to Jasper
        //    JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuationdata.jrxml'))->execute();
         Log::info(JasperPHP::process(
            base_path('/reports/deactiveproperty.jasper'),
                false,
                array("pdf"),               
                array("basketid" => $filter,"title" => $title),
            array(
              'driver' => 'generic',
              'username' => env('DB_USERNAME',''),
              'password' => env('DB_PASSWORD',''),
              'jdbc_driver' => 'com.mysql.jdbc.Driver',
              'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?useSSL=false"
            ))->output());

      JasperPHP::process(
            base_path('/reports/deactiveproperty.jasper'),
                false,
                array("pdf"),               
                array("basketid" => $filter,"title" => $title),
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

        return response()->download(base_path('/reports/deactiveproperty.pdf'), 'Deactive List.pdf', $headers);

    }

    public function ExportDataEnqueryCSV(Request $request){

        ini_set('memory_limit', '2056M');
        ini_set('max_execution_time', '200');
       // $baskedid = $request->input('id');max_execution_time = 30     ; 
        $maxRow = 30;
        $fileName = 'ExportCarianCSV.csv';
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
            //Log::info($filterquery);

        }
       // str_replace('tdi_key', 'tbdefitems_subzone.tdi_key', $filterquery);

    //    Log::info("
    //     select 
    //     vd_accno 'NoHarta', ma_fileno 'NoFail', SUBZONE.tdi_parent_name 'Mukim', SUBZONE.tdi_value 'TamanKawasan', ma_addr_ln1 'NoBgn', ma_addr_ln2 'NamaJalan', ma_addr_ln3 'NamaKawasan',
    //     ma_addr_ln4 'NamaTempat', ma_postcode 'Poskod', ma_city 'Bandar', STATE.tdi_value 'Negeri', OWNTYPE.tdi_value 'JenisIdPemilik', TO_OWNNO 'NomborPemilik', to_ownname  'NamaPemilik',  
    //     ISHASBUILDING.tdi_value 'StatusHarta', BULDINGTYPE.tdi_parent_name 'KategoriHarta', BULDINGTYPE.tdi_value 'JenisHarta', BUILDINGSTOREY.tdi_value 'TingkatHarta', LOTCODE.tdi_value 'KodLot',
    //     al_no 'NoLot', DATE_FORMAT(vt_termDate, '%d/%m/%Y') as 'TarikhKK', vt_approvednt 'NTLulus', vt_proposedrate 'KadarLulus', vt_adjustment 'Pelarasan', vt_approvedtax 'CukaiLulus', vt_note 'NotaPenilaian'   
    //     from cm_appln_valdetl
    //     inner join cm_appln_val on va_id = vd_va_id
    //     inner join cm_appln_valterm on vt_id = va_vt_id
    //     inner join cm_masterlist on vd_ma_id = ma_id
    //     inner join cm_appln_lot on al_vd_id = vd_id
    //     inner join cm_owner on to_ma_id = ma_id
    //     inner join cm_appln_val_tax on vt_vd_id = vd_id
    //     left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'SUBZONE') SUBZONE on SUBZONE.tdi_key = ma_subzone_id
    //     left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'LOTCODE') LOTCODE on LOTCODE.tdi_key = al_lotcode_id
    //     left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'STATE') STATE on STATE.tdi_key = ma_state_id
    //     left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'STATE') OWNSTATE on OWNSTATE.tdi_key = TO_STATE_ID
    //     left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'OWNTYPE') OWNTYPE on OWNTYPE.tdi_key = TO_OWNTYPE_ID
    //     left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'ISHASBUILDING') ISHASBUILDING on ISHASBUILDING.tdi_key = vd_ishasbuilding
    //     left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'BULDINGTYPE') BULDINGTYPE on BULDINGTYPE.tdi_key = vd_bldgtype_id
    //     left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'BUILDINGSTOREY') BUILDINGSTOREY on BUILDINGSTOREY.tdi_key = vd_bldgstorey_id
    //     inner join (select max(vt_termDate) termdate,  vd_ma_id, vd_accno as accountno from cm_appln_valdetl
    //     inner join cm_appln_val on va_id = vd_va_id
    //     inner join cm_appln_valterm on vt_id = va_vt_id
    //     where  vt_id  IN (select vt_id from cm_appln_valterm where vt_approvalstatus_id = '05') 
    //     and vd_accno NOT IN (select cm_appln_deactivedetl.dad_accno from cm_appln_deactivedetl inner join  cm_appln_deactive on cm_appln_deactivedetl.dad_da_id = cm_appln_deactive.da_id 
    //     inner join cm_appln_valterm on cm_appln_deactive.da_vt_id = cm_appln_valterm.vt_id where vt_id IN (select vt_id from cm_appln_valterm where vt_approvalstatus_id = '05') )
    //     group by vd_ma_id, vd_accno) active_term on active_term.termdate = vt_termDate and active_term.accountno = cm_appln_valdetl.vd_accno 
    //     ".$filterquery);

       
       


        $property = DB::select("
        select 
        vd_accno 'NoHarta', ma_fileno 'NoFail', SUBZONE.tdi_parent_name 'Mukim', SUBZONE.tdi_value 'TamanKawasan', ma_addr_ln1 'NoBgn', ma_addr_ln2 'NamaJalan', ma_addr_ln3 'NamaKawasan',
        ma_addr_ln4 'NamaTempat', ma_postcode 'Poskod', ma_city 'Bandar', STATE.tdi_value 'Negeri', OWNTYPE.tdi_value 'JenisIdPemilik', TO_OWNNO 'NomborPemilik', to_ownname  'NamaPemilik',  
        ISHASBUILDING.tdi_value 'StatusHarta', BULDINGTYPE.tdi_parent_name 'KategoriHarta', BULDINGTYPE.tdi_value 'JenisHarta', BUILDINGSTOREY.tdi_value 'TingkatHarta', LOTCODE.tdi_value 'KodLot',
        al_no 'NoLot', DATE_FORMAT(vt_termDate, '%d/%m/%Y') as 'TarikhKK', vt_approvednt 'NTLulus', vt_proposedrate 'KadarLulus', vt_adjustment 'Pelarasan', vt_approvedtax 'CukaiLulus', vt_note 'NotaPenilaian'   
        from cm_appln_valdetl
        inner join cm_appln_val on va_id = vd_va_id
        inner join cm_appln_valterm on vt_id = va_vt_id
        inner join cm_masterlist on vd_ma_id = ma_id
        inner join cm_appln_lot on al_vd_id = vd_id
        inner join cm_owner on to_ma_id = ma_id
        inner join cm_appln_val_tax on vt_vd_id = vd_id
        left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'SUBZONE') SUBZONE on SUBZONE.tdi_key = ma_subzone_id
        left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'LOTCODE') LOTCODE on LOTCODE.tdi_key = al_lotcode_id
        left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'STATE') STATE on STATE.tdi_key = ma_state_id
        left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'STATE') OWNSTATE on OWNSTATE.tdi_key = TO_STATE_ID
        left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'OWNTYPE') OWNTYPE on OWNTYPE.tdi_key = TO_OWNTYPE_ID
        left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'ISHASBUILDING') ISHASBUILDING on ISHASBUILDING.tdi_key = vd_ishasbuilding
        left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'BULDINGTYPE') BULDINGTYPE on BULDINGTYPE.tdi_key = vd_bldgtype_id
        left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'BUILDINGSTOREY') BUILDINGSTOREY on BUILDINGSTOREY.tdi_key = vd_bldgstorey_id
        inner join (select max(vt_termDate) termdate,  vd_ma_id, vd_accno as accountno from cm_appln_valdetl
        inner join cm_appln_val on va_id = vd_va_id
        inner join cm_appln_valterm on vt_id = va_vt_id
        where  vt_id  IN (select vt_id from cm_appln_valterm where vt_approvalstatus_id = '05') 
        and vd_accno NOT IN (select cm_appln_deactivedetl.dad_accno from cm_appln_deactivedetl inner join  cm_appln_deactive on cm_appln_deactivedetl.dad_da_id = cm_appln_deactive.da_id 
        inner join cm_appln_valterm on cm_appln_deactive.da_vt_id = cm_appln_valterm.vt_id where vt_id IN (select vt_id from cm_appln_valterm where vt_approvalstatus_id = '05') )
        group by vd_ma_id, vd_accno) active_term on active_term.termdate = vt_termDate and active_term.accountno = cm_appln_valdetl.vd_accno 
        ".$filterquery);

    $headers = array(
                    "Content-type"        => "text/csv",
                    "Content-Disposition" => "attachment; filename=$fileName",
                    "Pragma"              => "no-cache",
                    "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                    "Expires"             => "0"
                );

    $columns = array('No Harta', 'No Fail', 'Mukim', 'Taman/Kawasan', 'No Bgn', 'Nama Jalan', 'Nama Kawasan', 'Nama Tempat', 'Poskod', 'Bandar', 'Negeri', 'Jenis Id Pemilik', 
                    'Nombor Pemilik', 'Nama Pemilik', 'Status Harta', 'Kategori Harta', 'Jenis Harta', 'Tingkat Harta', 'Kod Lot', 'No Lot', 'Tarikh KK', 'NT Lulus',
                    'Kadar Lulus', 'Pelarasan', 'Cukai Lulus', 'Nota Penilaian');

            $callback = function() use($property, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($property as $rec) {
                    $row['NoHarta']  = $rec->NoHarta; 
                    $row['NoFail']  = $rec->NoFail;
                    $row['Mukim']  = $rec->Mukim;
                    $row['TamanKawasan']  = $rec->TamanKawasan;
                    $row['NoBgn']  = $rec->NoBgn;
                    $row['NamaJalan']  = $rec->NamaJalan; 
                    $row['NamaKawasan']  = $rec->NamaKawasan;
                    $row['NamaTempat']  = $rec->NamaTempat; 
                    $row['Poskod']  = $rec->Poskod;
                    $row['Bandar']  = $rec->Bandar; 
                    $row['Negeri']  = $rec->Negeri; 
                    $row['JenisIdPemilik']  = $rec->JenisIdPemilik; 
                    $row['NomborPemilik']  = $rec->NomborPemilik; 
                    $row['NamaPemilik']  = $rec->NamaPemilik;  
                    $row['StatusHarta']  = $rec->StatusHarta;
                    $row['KategoriHarta']  = $rec->KategoriHarta; 
                    $row['JenisHarta']  = $rec->JenisHarta;
                    $row['TingkatHarta']  = $rec->TingkatHarta;
                    $row['KodLot']  = $rec->KodLot;
                    $row['NoLot']  = $rec->NoLot;
                    $row['TarikhKK']  = $rec->TarikhKK;
                    $row['NTLulus']  = $rec->NTLulus;
                    $row['KadarLulus']  = $rec->KadarLulus; 
                    $row['Pelarasan']  = $rec->Pelarasan; 
                    $row['CukaiLulus']  = $rec->CukaiLulus; 
                    $row['NotaPenilaian']  = $rec->NotaPenilaian;  


                    fputcsv($file, array(
                        $row['NoHarta'], $row['NoFail'], $row['Mukim'], $row['TamanKawasan'], $row['NoBgn'], $row['NamaJalan'], $row['NamaKawasan'], $row['NamaTempat'], $row['Poskod'], 
                        $row['Bandar'], $row['Negeri'], $row['JenisIdPemilik'], $row['NomborPemilik'], $row['NamaPemilik'], $row['StatusHarta'], $row['KategoriHarta'], $row['JenisHarta'], 
                        $row['TingkatHarta'], $row['KodLot'], $row['NoLot'], $row['TarikhKK'], $row['NTLulus'], $row['KadarLulus'],  $row['Pelarasan'],  $row['CukaiLulus'], $row['NotaPenilaian']
                    ));
                }

                fclose($file);
            };
//dd($filterquery);
            return response()->stream($callback, 200, $headers);
    }
} 