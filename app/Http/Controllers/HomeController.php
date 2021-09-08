<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use userpermission;
use Log;
use DB;
use Session;
use JasperPHP; 
use PHPJasper;
use DataTables;
use App;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('dashboard');
    }

    public function term(Request $request){
        $jsondata = $request->input('jsondata');    
         $param = $request->input('param'); 
        $cond = ' ';
         if($param !='A' && $param !='') {
            $cond = ' where vt_applicationtype_id =  "'.$param.'"';
         }
         
        $term = DB::select("select vt_termtype_id,vt_valbase_id, vt_id, vt_name name, vt_createby createby,  DATE_FORMAT(vt_createdate, '%d/%m/%Y') createdate, vt_updateby updateby, applntype.tdi_value applntype, 
          DATE_FORMAT(vt_updatedate, '%d/%m/%Y')  updatedate, ifnull(basket_count,0) basket_count, ifnull(property_count,0) property_count,DATE_FORMAT(vt_termDate, '%d/%m/%Y') termDate, DATE_FORMAT(now(), '%d/%m/%Y') enforceDate,  vt_applicationtype_id,DATE_FORMAT(vt_transferDate, '%d/%m/%Y') vt_transferDate, vt_transferby,
           termstage.tdi_desc termstage, vt_approvalstatus_id,ap_basket_count, valbase.tdi_value valbase, (select count(vd_approvalstatus_id) bil
from cm_appln_valdetl
inner join cm_objection_decision on vd_id = de_vd_id
inner join  cm_appln_val on va_id = vd_va_id
where va_vt_id = vt_id and vd_approvalstatus_id <> '12' and va_approvalstatus_id in ('08','09','10','11','12') ) objectDe_count 
          from cm_appln_valterm
          left join (select va_vt_id, count(*) ap_basket_count from cm_appln_val where va_approvalstatus_id = '11' group by va_vt_id) approve on approve.va_vt_id = vt_id
          left join (select va_vt_id, count(*) basket_count from cm_appln_val group by va_vt_id) cm_appln_val on cm_appln_val.va_vt_id = vt_id
          left join (select va_vt_id, count(vd_id) property_count from cm_appln_valdetl inner join cm_appln_val on va_id = vd_va_id
          group by va_vt_id) cm_appln_valdetl on cm_appln_valdetl.va_vt_id = vt_id 
          left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
          on applntype.tdi_key = vt_applicationtype_id
          left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
          on termstage.tdi_key = vt_approvalstatus_id 
        left join (select *  from tbdefitems where tdi_td_name = 'VALUATIONBASE') valbase
        on valbase.tdi_key = vt_valbase_id ".$cond."  order by vt_termDate desc");
        $basket_count=DB::select('select  count(*) basket_count from cm_appln_val');
        $property_count=DB::select('select  count(vd_id) property_count from cm_appln_valdetl inner join cm_appln_val on va_id = vd_va_id');
        $applntype = DB::select('select * from tbdefitems where tdi_td_name = "APPLICATIONTYPE"');
        $valbase = DB::select('select * from tbdefitems where tdi_td_name = "VALUATIONBASE" ');

        App::setlocale(session()->get('locale'));
        
        return view("group.term")->with(array('term'=> $term,'basket_count'=> $basket_count,'property_count'=> $property_count,'applntype'=> $applntype,'valbase'=> $valbase, 'param' => $param,));
    }

    public function valterm(Request $request){
        $jsondata = $request->input('jsondata');    
         $param = $request->input('param'); 
        

         $termcondition = "";
       

        // $cond = ' ';
        if($param !='A' && $param !='') {
          $termcondition =  ' where vt_applicationtype_id =  "'.$param.'"';
        }

        if(userpermission::checkaccess('515') == "false"){
          if ($termcondition =="") {
           $termcondition = " where vt_approvalstatus_id in ('01','02') ";
          } else {
             $termcondition = $termcondition." and vt_approvalstatus_id in ('01','02') ";
          }
        }
         
        $term = DB::select("select vt_valbase_id, vt_id, vt_name name, vt_createby createby,  DATE_FORMAT(vt_createdate, '%d/%m/%Y') createdate, vt_updateby updateby, applntype.tdi_value applntype, 
          DATE_FORMAT(vt_updatedate, '%d/%m/%Y')  updatedate, ifnull(basket_count,0) basket_count, ifnull(property_count,0) property_count,DATE_FORMAT(vt_termDate, '%d/%m/%Y') termDate, DATE_FORMAT(now(), '%d/%m/%Y') enforceDate,  vt_applicationtype_id,DATE_FORMAT(vt_transferDate, '%d/%m/%Y') vt_transferDate, vt_transferby,
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
        left join (select *  from tbdefitems where tdi_td_name = 'VALUATIONBASE') valbase
        on valbase.tdi_key = vt_valbase_id ".$termcondition."  order by vt_termDate desc");
        $basket_count=DB::select('select  count(*) basket_count from cm_appln_val');
        $property_count=DB::select('select  count(vd_id) property_count from cm_appln_valdetl inner join cm_appln_val on va_id = vd_va_id');
            $applntype = DB::select('select * from tbdefitems where tdi_td_name = "APPLICATIONTYPE"');
            $valbase = DB::select('select * from tbdefitems where tdi_td_name = "VALUATIONBASE" ');

        App::setlocale(session()->get('locale'));
        
        return view("group.valterm")->with(array('term'=> $term,'basket_count'=> $basket_count,'property_count'=> $property_count,'applntype'=> $applntype,'valbase'=> $valbase, 'param' => $param,));
    }
    
    public function termTransaction(Request $request) {
        $jsondata = $request->input('jsondata');
        $name=Auth::user()->name;
        Log::info("call proc_cmapplnvaltem_trn('".$jsondata."','".$name."')"); 
        $response=DB::select("call proc_cmapplnvaltem_trn('".$jsondata."','".$name."')");
        return redirect('term');
    }

public function valbasket(Request $request){
        $id = $request->input('id');

       //$id = str_replace($id, 'A', '');
       $id = str_replace("A", "", $id);
       Log::info(' '.$id);
        $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "18" ');
        $termcondition = "";
        if(userpermission::checkaccess('515') == "false"){
          $termcondition = " where vt_approvalstatus_id in ('01','02') ";

        }
        if($id==''){
          $id=0;
        }
      /*  $termfilter = DB::select("select vt_id termid, vt_name term, applntype.tdi_value applntype, 
                termstage.tdi_desc termstage
                from cm_appln_valterm
                left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
                on applntype.tdi_key = vt_applicationtype_id
                left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
                on termstage.tdi_key = vt_approvalstatus_id ". $termcondition ." order by vt_termDate desc");*/
        $term = DB::select("select vt_valbase_id, vt_id termid, vt_name term, applntype.tdi_value applntype, 
                termstage.tdi_desc termstage from cm_appln_valterm 
                left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
                on applntype.tdi_key = vt_applicationtype_id
                left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
                on termstage.tdi_key = vt_approvalstatus_id 
                 where vt_approvalstatus_id = '01' and vt_id = ".$id." order by vt_termDate desc");
        
        $group = DB::select("select approval.tdi_desc approval,va_approvalstatus_id, va_id id, va_name l_group, va_vt_id termid, vt_name termaname, va_createby createby, DATE_FORMAT(va_createdate, '%d/%m/%Y') createdate, 
va_updateby updateby, DATE_FORMAT(va_updatedate, '%d/%m/%Y') updatedate, ifnull(propertycount,0) propertycount,ifnull(inspropertyccount,0) inspropertyccount , applntype.tdi_value applntype,
vt_applicationtype_id, ob_desc, ifnull(notiscount,0) notiscount , ifnull(objectioincount,0) objectioincount , ifnull(decisioncount,0) decisioncount , ifnull(valcount,0)  valcount
from cm_appln_val 
inner join cm_appln_valterm  on va_vt_id = vt_id
left join (select count(*) propertycount,vd_va_id from cm_appln_valdetl group by vd_va_id ) propcount on propcount.vd_va_id = va_id
left join (select count(*) inspropertyccount ,vd_va_id from cm_appln_valdetl where vd_approvalstatus_id in ('06','07','08','09','10','11','12') 
group by vd_va_id ) insprop on insprop.vd_va_id = va_id
left join (select count(*) valcount ,vd_va_id from cm_appln_valdetl where vd_approvalstatus_id in ('08','09','10','11','12')  
group by vd_va_id ) valprop on valprop.vd_va_id = va_id
left join (SELECT * FROM tbdefitems where tdi_td_name = 'BASKETSTAGE') approval on approval.tdi_key = va_approvalstatus_id 
left join (SELECT * FROM tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype on applntype.tdi_key = vt_applicationtype_id 
left join cm_objection on ob_vt_id = vt_id 
left join (select count(*) notiscount,vd_va_id  from cm_objection_notis 
inner join cm_appln_valdetl on vd_id = no_vd_id group by vd_va_id ) notis on notis.vd_va_id = va_id
left join (select count(*) objectioincount,vd_va_id  from cm_objection_objectionlist 
inner join cm_appln_valdetl on vd_id = ol_vd_id group by vd_va_id ) objection on objection.vd_va_id = va_id
left join (select count(*) decisioncount,vd_va_id  from cm_objection_decision 
inner join cm_appln_valdetl on vd_id = de_vd_id group by vd_va_id ) decision on decision.vd_va_id = va_id
        where  va_vt_id = ".$id."
        order by va_id desc");

        $termtype = DB::select("select * from cm_appln_valterm  where vt_valbase_id = 2 and vt_id = REPLACE(ifnull(".$id.",0),'A','') limit 1");
        

        $tonebasket = DB::select("select tollist_id, concat(tollis_enforceyear,' - ',tollis_desc) tonebasket from cm_toneoflistbasket where tollis_activeind_id = 1");
        $tonetaxbasket = DB::select("select trlist_id, concat(trlist_enforceyear,' - ',trlist_desc) tonetaxbasket from cm_taxratelistbasket where trlist_activeind_id = 1");

        $propcount = DB::select('select  count(*) totproperty_count from cm_appln_valdetl 
        inner join cm_appln_val on va_id = vd_va_id where  va_vt_id = '.$id.' ');

        $bldgcount = DB::select('select  count(*) bldgcount from cm_appln_bldg
          inner join cm_appln_valdetl  on ab_vd_id = vd_id 
          inner join cm_appln_val on va_id = vd_va_id where  va_vt_id = '.$id.' ');


        $inspropcount = DB::select('select  count(*) inscount from cm_appln_valdetl 
        inner join cm_appln_val on va_id = vd_va_id
        where vd_approvalstatus_id in ("06","07","08","09","10","11","12") and  va_vt_id = '.$id.'');

        $valpropcount = DB::select('select  count(*) valcount from cm_appln_valdetl 
        inner join cm_appln_val on va_id = vd_va_id where vd_approvalstatus_id in ("08","09","10","11","12") and  va_vt_id = '.$id.'');

        App::setlocale(session()->get('locale'));
        
        return view("group.valbasket")->with(array('term'=> $term,'group'=> $group,'tonebasket'=>$tonebasket,'tonetaxbasket'=>$tonetaxbasket,'propcount'=>$propcount,'bldgcount'=>$bldgcount,'inspropcount'=>$inspropcount,'valpropcount'=>$valpropcount, 'id' => $id, 'termtype' => $termtype));
    }
    

     public function group(Request $request){
        $param = $request->input('param');
       // Log::info( DB::statement('call json_procedure( )'));
        $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "18" ');
        $termcondition = "";
        if(userpermission::checkaccess('515') == "false"){
          $termcondition = " where vt_approvalstatus_id in ('01','02') ";

        }
        $termfilter = DB::select("select vt_id termid, vt_name term, applntype.tdi_value applntype, 
                termstage.tdi_desc termstage
                from cm_appln_valterm
                left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
                on applntype.tdi_key = vt_applicationtype_id
                left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
                on termstage.tdi_key = vt_approvalstatus_id ". $termcondition ." order by vt_termDate desc");
        $term = DB::select("select vt_valbase_id, vt_id termid, vt_name term, applntype.tdi_value applntype, 
                termstage.tdi_desc termstage from cm_appln_valterm 
                left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
                on applntype.tdi_key = vt_applicationtype_id
                left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
                on termstage.tdi_key = vt_approvalstatus_id 
                 where vt_approvalstatus_id = '01' order by vt_termDate desc");
        $group = DB::select("select approval.tdi_desc approval,va_approvalstatus_id, va_id id, va_name l_group, va_vt_id termid, vt_name termaname, va_createby createby, DATE_FORMAT(va_createdate, '%d/%m/%Y') createdate, 
        va_updateby updateby, DATE_FORMAT(va_updatedate, '%d/%m/%Y') updatedate, ifnull(propertycount,0) propertycount,0 inspropertyccount , applntype.tdi_value applntype,
         vt_applicationtype_id, ob_desc, ifnull(notiscount,0) notiscount , ifnull(objectioincount,0) objectioincount , ifnull(decisioncount,0) decisioncount , 0  valcount
        from cm_appln_val 
        inner join cm_appln_valterm  on va_vt_id = vt_id
        left join (select count(*) propertycount,vd_va_id from cm_appln_valdetl group by vd_va_id ) propcount on propcount.vd_va_id = va_id
        left join (SELECT * FROM tbdefitems where tdi_td_name = 'BASKETSTAGE') approval on approval.tdi_key = va_approvalstatus_id 
        left join (SELECT * FROM tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype on applntype.tdi_key = vt_applicationtype_id 
        left join cm_objection on ob_vt_id = vt_id 
        left join (select count(*) notiscount,vd_va_id  from cm_objection_notis 
        inner join cm_appln_valdetl on vd_id = no_vd_id group by vd_va_id ) notis on notis.vd_va_id = va_id
        left join (select count(*) objectioincount,vd_va_id  from cm_objection_objectionlist 
        inner join cm_appln_valdetl on vd_id = ol_vd_id group by vd_va_id ) objection on objection.vd_va_id = va_id
        left join (select count(*) decisioncount,vd_va_id  from cm_objection_decision 
        inner join cm_appln_valdetl on vd_id = de_vd_id group by vd_va_id ) decision on decision.vd_va_id = va_id
        where  va_vt_id = ifnull('".$param."',0) 
        order by va_id desc");

        $termtype = DB::select("select * from cm_appln_valterm  where vt_valbase_id = 2 and vt_id = ifnull('".$param."',0)  limit 1");
        

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

        App::setlocale(session()->get('locale'));
        
        return view("group.basket")->with(array('term'=> $term,'group'=> $group,'tonebasket'=>$tonebasket,'tonetaxbasket'=>$tonetaxbasket,'propcount'=>$propcount,'bldgcount'=>$bldgcount,'inspropcount'=>$inspropcount,'valpropcount'=>$valpropcount,'termfilter' => $termfilter, 'param' => $param, 'termtype' => $termtype));
    }

    public function groupTransaction(Request $request) {
        $jsondata = $request->input('jsondata');
        $id = $request->input('id');
        $name=Auth::user()->name;
        Log::info("call proc_cmapplnval_trn('".$jsondata."','".$name."')"); 
        $response=DB::select("call proc_cmapplnval_trn('".$jsondata."','".$name."')");
        //return redirect()->route('codemaintenancedetail', ['name' => '$td_name']);
        return Redirect::route('valbasket', ['id' => $id]);//('group')->with('param','100048');
       // return redirect('group')->with('param','100048');
    }
    
    public function generateReportTes()
    {        
             //$jasper = new JasperPHP;

            // Compile a JRXML to Jasper
            JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/inspection.jrxml'))->execute();
$output = base_path('/report/Test');
            // Process a Jasper file to PDF and RTF (you can use directly the .jrxml)
            JasperPHP::process(base_path('/vendor/cossou/jasperphp/examples/inspection.jasper'),
               'C:\Users\suresh\Desktop',
                array("pdf", "rtf"),
                array("propid" => "7.1") )->execute();


           // return view('welcome');

    }

    public function generateReport()
    {        
             //$jasper = new JasperPHP;

            // Compile a JRXML to Jasper
            JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/inspection.jrxml'))->execute();
/*

C:\wamp\www\cama\vendor\cossou\jasperphp\src\JasperStarter\bin>jasperstarter --locale en_US process "C:\wamp\www\cama\vendor\cossou\jasperphp\examples\inspection.jasper" -o "C:\wamp\www\cama\vendor\cossou\jasperphp\examples" -f pdf -P propid="100005" -t generic -u root -H 127.0.0.1 -n cama --db-port 3306 --db-url "jdbc:mysql://localhost:3306/cama?autoReconnect=true&useSSL=false" --db-driver com.mysql.jdbc.Driver


 JasperPHP::process(
         base_path('/vendor/cossou/jasperphp/examples/hello_world.jasper'),
        false,
        array("pdf"),
        array("php_version" => '100005'),
      $db_connection)->execute();*/
   
/*$map =  new Java("java.util.HashMap");
foreach ($array as $key=>$value){
    $map->put($key,$value);
}*/

$post= collect(['1212']);

$keyed = $post->mapWithKeys(function ($item) {

            return ['propid' => $item];
        });

/*DB::statement("CREATE TEMPORARY TABLE IF NOT EXISTS tempQuery(            query TEXT
           
        )");


DB::statement("insert into tempQuery values(select * from )");
*/
      Log::info(JasperPHP::process(
            base_path('/vendor/cossou/jasperphp/examples/inspection.jasper'),
                false,
                array("pdf"),
            [ 'propid' =>  [
         '164827',
        '164834'
    ]],
             array(
              'driver' => 'generic',
              'username' => 'root',
              'jdbc_driver' => 'com.mysql.jdbc.Driver',
              'jdbc_url' => "jdbc:mysql://localhost:3306/cama?autoReconnect=true&useSSL=false"
            ))->execute());

       $headers = array(
              'Content-Type: application/pdf',
            );

    return;

    }

    public function newCollection(array $models = [])
    {
        return new CustomCollection($models);
    }

     public function propertyAddress(Request $request) {
        $search=DB::select(' select sd_key, sd_label, sd_keymainfield,
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "18" ');
        
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }

        App::setlocale(session()->get('locale'));
        
         return view("codemaintenance.ownershiptransfer.propertyaddress")->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    
    }

   
     public function addressLogTables(Request $request){
        Log::info('Test');
        ini_set('memory_limit', '2056M');
       // $baskedid = $request->input('id');
        $maxRow = 30;

        $account = $request->input('account');
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
                $filterquery  = ' and '. $filterquery ;
            }
            Log::info($filterquery);

        }
      $property = DB::select("select * FROM cm_masterlist_log 
      inner join (select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE') state on state_id = mal_state_id
      inner join (select tdi_key subzone_id,tdi_parent_name zone, tdi_value subzone from tbdefitems where tdi_td_name = 'SUBZONE') subzone on subzone_id = mal_subzone_id 
      inner join (select tdi_key ,tdi_parent_name , tdi_value  from tbdefitems where tdi_td_name = 'OWNERSHIPSTAGE') tstatus on tdi_key = ota_transtocenterstatus_id 
      where mal_accno = ".$account  );
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }


    public function ownerDetail(Request $request) {
      $prop_id = $request->input('prop_id');  
        $master = DB::select('select  mal_id,  mal_accno,mal_fileno,  mal_subzone_id, subzone.tdi_parent_key zone_id, subzone.tdi_parent_name zone, subzone.tdi_value subzone, district.tdi_value district,
        mal_district_id, mal_addr_ln1,mal_addr_ln2,mal_addr_ln3,mal_addr_ln4, mal_postcode, mal_city, mal_state_id,
        ma_fileno, ma_addr_ln1, ma_addr_ln2, ma_addr_ln3, ma_addr_ln4, ma_postcode, ma_city, ma_state_id
        from  cm_masterlist_log 
        inner join cm_masterlist on ma_accno = mal_accno
        left join (select tdi_key, tdi_value,tdi_parent_key, tdi_parent_name from tbdefitems where tdi_td_name = "SUBZONE") subzone on subzone.tdi_key = mal_subzone_id
        left join (select tdi_key, tdi_value,tdi_parent_key, tdi_parent_name from tbdefitems where tdi_td_name = "DISTRICT") district on district.tdi_key = mal_district_id
        where mal_id = ifnull("'.$prop_id.'",0)');

          $district= DB::table('tbdefitems')->where('tdi_td_name', 'DISTRICT')->get(); 
          $state=DB::table('tbdefitems')->where('tdi_td_name', 'STATE')->get();
          $zone=DB::table('tbdefitems')->where('tdi_td_name', 'ZONE')->get();
          $subzone=DB::table('tbdefitems')->where('tdi_td_name', 'SUBZONE')->get();

        App::setlocale(session()->get('locale'));
        
         return view("codemaintenance.ownershiptransfer.ownerdetail")->with(array('district'=>$district, 'state'=>$state, 'zone'=>$zone, 'subzone'=>$subzone, 'master'=>$master));
    
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
      $property = DB::select('select ma_id,ma_accno, `cm_masterlist`.`ma_fileno`,ma_city, ma_postcode,
   `tbdefitems_subzone`.`tdi_parent_name` zone, `tbdefitems_subzone`.`tdi_value` subzone, ma_addr_ln3,
   `cm_masterlist`.`ma_addr_ln1`,`cm_masterlist`.`ma_addr_ln2`, owntype.tdi_value owntype, 
   `cm_owner`.`TO_OWNNAME`, `cm_owner`.`TO_OWNNO`,
   `cm_masterlist`.`ma_id`,
        `cm_masterlist`.`ma_pb_id`        
    FROM `cm_masterlist` 
    JOIN `cm_owner` ON `ma_id` = `TO_MA_ID`
    LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
    LEFT JOIN `tbdefitems` as owntype on `TO_OWNTYPE_ID` = `owntype`.`tdi_key` and owntype.tdi_td_name = "OWNTYPE"
     '.$filterquery .' limit 100');
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    public function propertyLot(Request $request) {
         $search=DB::select(' select sd_key, sd_label, sd_keymainfield,
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "18" ');
        
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
        $lotcode=DB::table('tbdefitems')->where('tdi_td_name', 'LOTCODE')->get();
          $titiletype=DB::table('tbdefitems')->where('tdi_td_name', 'TITLETYPE')->get();
          $tnttype=DB::table('tbdefitems')->where('tdi_td_name', 'TENURETYPE')->get();

        App::setlocale(session()->get('locale'));
        
         return view("codemaintenance.ownershiptransfer.propertylot")->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist)->with('lotcode',$lotcode)->with('titiletype',$titiletype)->with('tnttype',$tnttype);
    }

    public function propertyLotDetail(Request $request) {
      $prop_id = $request->input('prop_id');  
         $lotlist = DB::select('select distinct DATE_FORMAT(lo_startdate, "%d/%m/%Y") lo_startdate1, DATE_FORMAT(lo_expireddate, "%d/%m/%Y") lo_expireddate1,cm_lot.*, lotcode.tdi_value lotcode, roadtype.tdi_value roadtype, titletype.tdi_value titletype
        , unitsize.tdi_value unitsize, concat(lotcode.tdi_value,lo_no) lotnumber, concat(titletype.tdi_value,lo_titleno) titlenumber, landuse.tdi_value landuse, tentype.tdi_value tentype
         from cm_lot  inner join cm_masterlist on ma_id = lo_ma_id
         left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE") lotcode on lotcode.tdi_key = lo_lotcode_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADTYPE") roadtype on roadtype.tdi_key = lo_roadtype_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE") titletype on titletype.tdi_key = lo_titletype_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SIZEUNIT") unitsize on unitsize.tdi_key = lo_sizeunit_id
        left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDUSE") landuse on  lo_landuse_id = landuse.tdi_key
        left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "TENURETYPE") tentype on  lo_tenuretype_id = tentype.tdi_key 
 where ma_accno = ifnull("'.$prop_id.'",0)');
          return response()->json(array('lotlist'=> $lotlist), 200);
    
    }

    public function lotDetail(Request $request) {
      $prop_id = $request->input('prop_id');  
        $master = DB::select('select *
        from cm_lot  
        inner join cm_masterlist on ma_id = lo_ma_id
        left join cm_lot_log on log_lot_id = lot_id
        where log_id = ifnull("'.$prop_id.'",0)');
         Log::info($prop_id);
          $lotcode=DB::table('tbdefitems')->where('tdi_td_name', 'LOTCODE')->get();
          $titiletype=DB::table('tbdefitems')->where('tdi_td_name', 'TITLETYPE')->get();
          $tnttype=DB::table('tbdefitems')->where('tdi_td_name', 'TENURETYPE')->get();

        App::setlocale(session()->get('locale'));
        
         return view("codemaintenance.ownershiptransfer.popup.propertylotdetail")->with(array('lotcode'=>$lotcode, 'master'=>$master, 'titiletype'=>$titiletype, 'tnttype'=>$tnttype, 'prop_id'=>$prop_id));
    
    }

    public function propertyinfotrn(Request $request) {
      $name=Auth::user()->name;
          
            $module = $request->input('module');  
            $jsondata = $request->input('jsondata');  
            if($module == 'lottrn'){
              Log::info("call proc_cmlot_trn('".$jsondata."','".$name."')"); 
              $transfer=DB::select("call proc_cmlot_trn('".$jsondata."','".$name."')");   
            } else {
              Log::info("call proc_cmmasterlist_trn('".$jsondata."','".$name."','3')"); 
              $transfer=DB::select("call proc_cmmasterlist_trn('".$jsondata."','".$name."','3')");   
            }
            
            
       
        //$msg = true;
        //return redirect('propertyaddress');//
        return response()->json(array('msg'=> 'true'), 200);
    }
     
    public function plan(Request $request) {
      $name=Auth::user()->name;
        $plan = DB::select("select cm_plan.*, plan_cccdate, plan_valuationdate, plan.tdi_value status,DATE_FORMAT(plan_createdate,  '%d/%m/%Y') plan_createdate1,DATE_FORMAT(plan_updatedate,  '%d/%m/%Y') plan_updatedate1,
          plan_plandate,  appln.tdi_value appln, zone.tdi_value zone from cm_plan left join 
          tbdefitems zone on zone.tdi_key = plan_zon_id  and zone.tdi_td_name = 'ZONE'
          left join tbdefitems appln on appln.tdi_key = plan_planapplicationtype  and appln.tdi_td_name = 'PLANAPPLICATIONTYPE'
          left join tbdefitems plan on plan.tdi_key = plan_planstatus_id  and plan.tdi_td_name = 'PLANREG'
        ");


         $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "27" ');

        $zone = DB::select("select tdi_key, tdi_value from tbdefitems where tdi_td_name = 'ZONE'");
            $applntype = DB::select('select * from tbdefitems where tdi_td_name = "PLANAPPLICATIONTYPE"');

        App::setlocale(session()->get('locale'));
        
        return view('group.plan')->with(array( 'applntype'=>$applntype, 'zone'=>$zone, 'plan'=>$plan, 'search'=>$search));
    }


    public function plantrn(Request $request) {
      $name=Auth::user()->name;
        
            $jsondata = $request->input('jsondata');  
               
                Log::info("call proc_cmplan_trn('".$jsondata."','".$name."')"); 
            $transfer=DB::select("call proc_cmplan_trn('".$jsondata."','".$name."')");   
       
        //$msg = true;
        return redirect('plan');//return response()->json(array('msg'=> 'true'), 200);
    }


     public function lotdetailtrn(Request $request) {
      $name=Auth::user()->name;
        
            $jsondata = $request->input('jsondata');  
               
              $ownerdata = json_decode($jsondata,TRUE);
             // Log::info($test['ownaplntype']);
              /*
               try {
                    // Validate the value...
                      DB::connection('oracle')->table('pemilik_sb')->insert([
                           'id' => $ownerdata['accno'],'LOTID' => $ownerdata['lotype'] .' '.  $ownerdata['lotnum']
                      ]);

                      $status = 'ST';
                      Log::info('S');

                  } catch (Exception $e) {
                      $status = 'FT';
                      Log::info('F');
                     // return false;
                  }
                */
                Log::info("call proc_cmlot_trn('".$jsondata."','".$name."')"); 
            $transfer=DB::select("call proc_cmlot_trn('".$jsondata."','".$name."')");   
       
        //$msg = true;
            return response()->json(array('msg'=> 'true'), 200);
        //return redirect('propertylotdetail');
    }

    public function ownerRegister(Request $request) {
        $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "14" ');
      $group = DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "USERGROUP"');
        $ownregister = DB::select('select otar_id, otar_accno, otar_ownertransgroup_id, grouptb.tdi_value colgroup, statustb.tdi_value colstatus, otar_createby, 
owntype.tdi_value owntype, otar_ownertranstype_id,
DATE_FORMAT(otar_createdate, "%d/%m/%Y") otar_createdate  
FROM cm_ownertrans_applnreg 
inner join tbdefitems grouptb on  grouptb.tdi_key = otar_ownertransgroup_id  and grouptb.tdi_td_name = "USERGROUP"
inner join tbdefitems statustb on otar_ownertransstatus_id = statustb.tdi_key and statustb.tdi_td_name = "OWNERSHIPSTAGE"
inner join tbdefitems owntype on otar_ownertranstype_id = owntype.tdi_key and owntype.tdi_td_name = "OWNERSHIPTRANSTYPE"
 where otar_ownertransstatus_id in (1,2,4) and otar_ownertranstype_id in (1,2)');

        App::setlocale(session()->get('locale'));
        
        return view("ownershiptransfer.ownerregister")->with(array('search' => $search, 'group' => $group, 'ownregister' => $ownregister));
    
    }

    public function ownerRegisterTRN(Request $request) {
      $name=Auth::user()->name;
      
      $jsondata = $request->input('jsondata');  
         
      Log::info("call proc_ownertransapplnreg_trn('".$jsondata."','".$name."')"); 
      $transfer=DB::select("call proc_ownertransapplnreg_trn('".$jsondata."','".$name."')");   
       
        //$msg = true;
        return redirect('ownerregister');//return response()->json(array('msg'=> 'true'), 200);
    }

    public function ownerTransfer(Request $request) {
            $page = $request->input('page');  
            $param = $request->input('param');  
            if($param != ''){
              $condition = ' and otar_ownertransgroup_id = '.$param;
            } else {
              $condition = '';
            }
           
            $owner = DB::select('select grouptb.tdi_key, grouptb.tdi_value  from  tbdefitems grouptb 
              where grouptb.tdi_td_name = "USERGROUP" ');

     // $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname, " - ", usr_position) tbuser, usr_position FROM tbuser');
            $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser, usr_id usr_position FROM tbuser');
            if($page == '2'){
               $search=DB::select(' select sd_key, sd_label, 
                        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
                      then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
                      from tbsearchdetail mtb where sd_se_id = "19" ');
              $ownertransfer=DB::select('select DATE_FORMAT(otar_createdate, "%d/%m/%Y")   otar_createdate1, cm_ownertrans_applnreg.*, cm_masterlist.*,cm_owner.*, owntype.tdi_value owntype, 
                  state.tdi_value state, grouptb.tdi_value colgroup, statustb.tdi_value colstatus,
                  transtype.tdi_value transtype, otar_ownertranstype_id
                  from cm_masterlist 
                  inner join cm_owner on to_ma_id = ma_id
                  inner join cm_ownertrans_applnreg on otar_accno = ma_accno
                  left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE") owntype on owntype.tdi_key = to_owntype_id
                  left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = TO_STATE_ID
                  left join (select tdi_key, tdi_value,tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone 
                  on subzone.tdi_key = ma_subzone_id
                  inner join tbdefitems grouptb on  grouptb.tdi_key = otar_ownertransgroup_id  and grouptb.tdi_td_name = "USERGROUP"
                  inner join tbdefitems statustb on otar_ownertransstatus_id = statustb.tdi_key and statustb.tdi_td_name = "OWNERSHIPSTAGE" 
                  inner join tbdefitems transtype on otar_ownertranstype_id = transtype.tdi_key and transtype.tdi_td_name = "OWNERSHIPTRANSTYPE"
                  where otar_ownertransstatus_id in (1,2,4,5,6) and otar_ownertranstype_id = 3 
                  ');

                App::setlocale(session()->get('locale'));
        
                return view("ownershiptransfer.owneraddresstransfer")->with(array('search' => $search, 'page' => $page, 'ownertransfer' => $ownertransfer,'owner' => $owner,'param' => $param));
            } else {
                 $search=DB::select(' select sd_key, sd_label, 
                        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
                      then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
                      from tbsearchdetail mtb where sd_se_id = "18" ');
                $ownertransfer=DB::select('select DATE_FORMAT(otar_createdate, "%d/%m/%Y")   otar_createdate1, cm_ownertrans_applnreg.*, cm_masterlist.*,cm_owner.*, owntype.tdi_value owntype, 
                  state.tdi_value state, grouptb.tdi_value colgroup, statustb.tdi_value colstatus,
                  transtype.tdi_value transtype, otar_ownertranstype_id
                  from cm_masterlist 
                  inner join cm_owner on to_ma_id = ma_id
                  inner join cm_ownertrans_applnreg on otar_accno = ma_accno
                  left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE") owntype on owntype.tdi_key = to_owntype_id
                  left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = TO_STATE_ID
                  left join (select tdi_key, tdi_value,tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone 
                  on subzone.tdi_key = ma_subzone_id
                  inner join tbdefitems grouptb on  grouptb.tdi_key = otar_ownertransgroup_id  and grouptb.tdi_td_name = "USERGROUP"
                  inner join tbdefitems statustb on otar_ownertransstatus_id = statustb.tdi_key and statustb.tdi_td_name = "OWNERSHIPSTAGE"
                  inner join tbdefitems transtype on otar_ownertranstype_id = transtype.tdi_key and transtype.tdi_td_name = "OWNERSHIPTRANSTYPE"
                  where otar_ownertransstatus_id in (1,2,3,4,5,6) and otar_ownertranstype_id in (1,2)
                  '.$condition.' order by otar_id desc');

        App::setlocale(session()->get('locale'));
        
                return view("ownershiptransfer.ownertransfer")->with(array('search' => $search, 'page' => $page, 'ownertransfer' => $ownertransfer,'owner' => $owner,'param' => $param,'userlist' => $userlist));
            }
        
        
    }


    public function ownerTransferApproval(Request $request) {
          
            $param = $request->input('param');  
            if($param != ''){
              $condition = ' and otar_ownertransgroup_id = '.$param;
            } else {
              $condition = '';
            }
           
                  
                  $owner = DB::select('select grouptb.tdi_key, grouptb.tdi_value  from  tbdefitems grouptb 
          where grouptb.tdi_td_name = "USERGROUP" ');
       

             $search=DB::select(' select sd_key, sd_label, 
                    case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
                  then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
                  from tbsearchdetail mtb where sd_se_id = "18" ');
            $ownertransfer=DB::select('select DATE_FORMAT(otar_createdate, "%d/%m/%Y")   otar_createdate1, cm_ownertrans_applnreg.*, cm_masterlist.*,cm_owner.*, owntype.tdi_value owntype, state.tdi_value state, grouptb.tdi_value colgroup, statustb.tdi_value colstatus, transtype.tdi_value transtype
              from cm_masterlist 
              inner join cm_owner on to_ma_id = ma_id
              inner join cm_ownertrans_applnreg on otar_accno = ma_accno
              left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE") owntype on owntype.tdi_key = to_owntype_id
              left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = TO_STATE_ID
              left join (select tdi_key, tdi_value,tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone 
              on subzone.tdi_key = ma_subzone_id
              inner join tbdefitems grouptb on  grouptb.tdi_key = otar_ownertransgroup_id  and grouptb.tdi_td_name = "USERGROUP"
              inner join tbdefitems statustb on otar_ownertransstatus_id = statustb.tdi_key and statustb.tdi_td_name = "OWNERSHIPSTAGE" 
              inner join tbdefitems transtype on otar_ownertranstype_id = transtype.tdi_key and transtype.tdi_td_name = "OWNERSHIPTRANSTYPE"
              where otar_ownertransstatus_id in (4,5) and otar_ownertranstype_id in (1,2)
              '.$condition);

            App::setlocale(session()->get('locale'));
    
            return view("ownershiptransfer.ownertransferapproval")->with(array('search' => $search,  'ownertransfer' => $ownertransfer,'owner' => $owner,'param' => $param));
        
        
        
    }

    public function ownerTransferProcess(Request $request) {
      $account = $request->input('account');
      $page = $request->input('page');
        $owntype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE"');
        $race=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "RACE"');
        $citizen=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "CITIZEN"');
          $state=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE"'); 
          if ( $page == 2){
             $owndetail=DB::select('select date_format(otar_createdate,"%d/%m/%Y") otar_createdate, cm_masterlist.*,cm_owner.*, owntype.tdi_value owntype, state.tdi_value state
        from cm_masterlist 
        inner join cm_owner on to_ma_id = ma_id
        left join cm_ownertrans_applnreg on otar_accno = ma_accno
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE") owntype on owntype.tdi_key = to_owntype_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = TO_STATE_ID
        left join (select tdi_key, tdi_value,tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone 
        on subzone.tdi_key = ma_subzone_id
        where otar_id = '.$account.'   limit 1');
          } else {
        $owndetail=DB::select('select date_format(otar_createdate,"%d/%m/%Y") otar_createdate, cm_masterlist.*,cm_owner.*, owntype.tdi_value owntype, state.tdi_value state
        from cm_masterlist 
        inner join cm_owner on to_ma_id = ma_id
        inner join cm_ownertrans_applnreg on otar_accno = ma_accno
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE") owntype on owntype.tdi_key = to_owntype_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = TO_STATE_ID
        left join (select tdi_key, tdi_value,tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone 
        on subzone.tdi_key = ma_subzone_id
        where otar_id = '.$account.'   limit 1');
      }

      $newowndetail=DB::select('select date_format(otar_createdate,"%d/%m/%Y") otar_createdate, cm_masterlist.*,cm_ownertrans_appln.*, 
        owntype.tdi_value owntype, state.tdi_value state, date_format(ota_applydate,"%d/%m/%Y") applydate, date_format(ota_recievedate,"%d/%m/%Y") recievedate,
        date_format(ota_transactiondate,"%d/%m/%Y") transactiondate
        from cm_masterlist 
        left join cm_ownertrans_applnreg on otar_accno = ma_accno
        left join cm_ownertrans_appln on ota_otar_id = otar_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE") owntype on owntype.tdi_key = ota_owntype_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = ota_state_id
        left join (select tdi_key, tdi_value,tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone 
        on subzone.tdi_key = ma_subzone_id
        where otar_id = '.$account.'   limit 1');

      $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname, " - ", usr_position) tbuser, usr_position FROM tbuser');

        App::setlocale(session()->get('locale'));
        
        return view("ownershiptransfer.ownertransferprocess")->with(array('state'=>$state,'owntype'=>$owntype, 'race'=>$race,'userlist' => $userlist, 'citizen'=>$citizen, 'owndetail'=>$owndetail, 'account'=>$account, 'page'=>$page, 'newowndetail'=>$newowndetail));
    
    }

    public function ownerTransferDelete(Request $request) {
        $name=Auth::user()->name;
          
        $account = $request->input('account');
        $groupid = $request->input('groupid'); 
           
        Log::info("call proc_ownertransapplnreg_trn('".$jsondata."','".$name."')"); 
        $transfer=DB::select("call proc_ownertransapplnreg_trn('".$jsondata."','".$name."')");   
       
        //$msg = true;
        return redirect('ownerregister');//return response()->json(array('msg'=> 'true'), 200);
      
      }

    public function ownerTransferTRN(Request $request) {
      $name=Auth::user()->name;
        
      $jsondata = $request->input('jsondata'); 

      $approval = $request->input('approval');
      $account = $request->input('account');

      $reasoncount = $request->input('reasoncount'); 
      $ownerdata = json_decode($jsondata,TRUE);
     // Log::info($test['ownaplntype']);
     /*  $status = 'NT';
      if ($reasoncount < 1) {
       try {
            // Validate        
              $status = 'ST';
              Log::info('S');

          } catch (Exception $e) {
              $status = 'FT';
              Log::info('F');
             // return false;
          }
      }*/


 /*   if($approval == 'No')           {
      Log::info("call proc_ownertransfer_trn('".$jsondata."','".$name."','".$status."')"); 
     $transfer=DB::select("call proc_ownertransfer_trn('".$jsondata."','".$name."','".$status."')");   
       } else {
*/
      Log::info("call proc_ownertransferupdate_trn('".$jsondata."','".$name."',".$account.")"); 
     $transfer=DB::select("call proc_ownertransferupdate_trn('".$jsondata."','".$name."',".$account.")");   
    //   }

        //$msg = true;
        //return redirect('ownerregister');//
          return response()->json(array('msg'=> 'true'), 200);
    }

 public function ownerTransferretryTRN(Request $request) {
      $name=Auth::user()->name;
        
      $otaid = $request->input('otaid'); 

      Log::info("call proc_ownertransferretry_trn('".$otaid."','','')"); 
      $transfer=DB::select("call proc_ownertransferretry_trn('".$otaid."','','')");   
       
        //$msg = true;
        //return redirect('ownerregister');//
          return response()->json(array('msg'=> 'true'), 200);
    }
     public function transferLogTables(Request $request){
        Log::info('Test');
        ini_set('memory_limit', '2056M');
       // $baskedid = $request->input('id');
        $maxRow = 30;

        $account = $request->input('account');
        
      $property = DB::select('select ownstatus.tdi_value ownstatus, ttype.tdi_value ttype, tstatus.tdi_value transstauts, date_format(otar_updatedate,"%d/%m/%Y") otar_updatedate, date_format(otar_createdate,"%d/%m/%Y") otar_createdate, cm_ownertrans_appln.*, cm_masterlist.*,cm_owner.*, owntype.tdi_value owntype, state.tdi_value state, ownrace.tdi_value ownrace
        from cm_masterlist 
        inner join cm_owner on to_ma_id = ma_id
        inner join cm_ownertrans_appln on ota_ownno = TO_OWNNO
        inner join cm_ownertrans_applnreg on otar_accno = ma_accno
        inner join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE") owntype on owntype.tdi_key = ota_owntype_id
        inner join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "RACE") ownrace on ownrace.tdi_key = ota_race_id
        inner join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = TO_STATE_ID
        inner join (select tdi_key, tdi_value,tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone 
        on subzone.tdi_key = ma_subzone_id
        inner join (select tdi_key, tdi_value,tdi_parent_key from tbdefitems where tdi_td_name = "OWNERSHIPSTAGE") tstatus 
        on tstatus.tdi_key = ota_transtocenterstatus_id
        inner join (select tdi_key, tdi_value,tdi_parent_key from tbdefitems where tdi_td_name = "TRANSFERAPPLNTYPE") ttype  
        on ttype.tdi_key = ota_transferapplntype_id
        inner join (select tdi_key, tdi_value,tdi_parent_key from tbdefitems where tdi_td_name = "TRANSFERAPPLNTYPESTATUS") ownstatus 
        on ownstatus.tdi_key = ota_transferapplntypestatus_id
        where ma_accno = '.$account);
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    public function ownerLog(Request $request){
     
                 $search=DB::select(' select sd_key, sd_label, 
                        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
                      then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
                      from tbsearchdetail mtb where sd_se_id = "18" ');
    /*  $log = DB::select('select  date_format(ota_transtocenterdate,"%d/%m/%Y") ota_transtocenterdate, cm_ownertrans_applnreg.*, ownstatus.tdi_value ownstatus, ttype.tdi_value ttype, tstatus.tdi_value transstauts, date_format(otar_updatedate,"%d/%m/%Y") otar_updatedate, date_format(otar_createdate,"%d/%m/%Y") otar_createdate, cm_ownertrans_appln.*, cm_masterlist.*,cm_owner.*, owntype.tdi_value owntype, state.tdi_value state, ownrace.tdi_value ownrace
        from cm_masterlist 
        inner join cm_owner on to_ma_id = ma_id
        inner join cm_ownertrans_appln on ota_ownno = TO_OWNNO and ota_transferapplntype_id = 1
        inner join cm_ownertrans_applnreg on otar_accno = ma_accno
        left join tbdefitems owntype on owntype.tdi_key = ota_owntype_id and owntype.tdi_td_name = "OWNTYPE"
        left join tbdefitems ownrace on ownrace.tdi_key = ota_race_id and ownrace.tdi_td_name = "RACE"
        left join tbdefitems state on state.tdi_key = TO_STATE_ID and state.tdi_td_name = "STATE"
        left join tbdefitems subzone 
        on subzone.tdi_key = ma_subzone_id and subzone.tdi_td_name = "SUBZONE"
        left join tbdefitems tstatus 
        on tstatus.tdi_key = ota_transtocenterstatus_id and tstatus.tdi_td_name = "OWNERSHIPSTAGE"
        left join tbdefitems ttype  
        on ttype.tdi_key = ota_transferapplntype_id and ttype.tdi_td_name = "TRANSFERTYPE"
        left join tbdefitems ownstatus 
        on ownstatus.tdi_key = ota_transferapplntypestatus_id and ownstatus.tdi_td_name = "OWNERSHIPSTATUS"
        
       ');*/
      $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser, usr_id usr_position FROM tbuser');

        App::setlocale(session()->get('locale'));
        
         return view("ownershiptransfer.ownerlog")->with(array( 'userlist'=>$userlist, 'search'=>$search));
    }


    public function ownerLogTables(Request $request){
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
                $filterquery  = ' and '. $filterquery ;
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
      $property = DB::select('select tstatus.tdi_value logstatus, date_format(ota_transtocenterdate,"%d/%m/%Y") ota_transtocenterdate1, cm_ownertrans_applnreg.*, ownstatus.tdi_value ownstatus, 
      ttype.tdi_value ttype, tstatus.tdi_key ttypekey, tstatus.tdi_value transstauts, date_format(otar_updatedate,"%d/%m/%Y") otar_updatedate, 
      date_format(otar_createdate,"%d/%m/%Y") otar_createdate, cm_ownertrans_appln.*, cm_masterlist.*,cm_owner.*, owntype.tdi_value owntype, 
      state.tdi_value state, ownrace.tdi_value ownrace
      from cm_masterlist
      inner join cm_ownertrans_applnreg on otar_accno = ma_accno
      left join cm_ownertrans_appln on  ota_otar_id = otar_id 
      left join cm_owner on TO_MA_ID = ma_id
      left join tbdefitems owntype on owntype.tdi_key = ota_owntype_id and owntype.tdi_td_name = "OWNTYPE"
      left join tbdefitems ownrace on ownrace.tdi_key = ota_race_id and ownrace.tdi_td_name = "RACE"
      left join tbdefitems state on state.tdi_key = TO_STATE_ID and state.tdi_td_name = "STATE"
      left join tbdefitems subzone
      on subzone.tdi_key = ma_subzone_id and subzone.tdi_td_name = "SUBZONE"
      left join tbdefitems tstatus 
      on tstatus.tdi_key = otar_ownertransstatus_id and tstatus.tdi_td_name = "OWNERSHIPSTAGE"
      left join tbdefitems ttype  
      on ttype.tdi_key = otar_ownertranstype_id and ttype.tdi_td_name = "TRANSFERAPPLNTYPE"
      left join tbdefitems ownstatus 
      on ownstatus.tdi_key = ota_transferapplntypestatus_id and ownstatus.tdi_td_name = "OWNERSHIPSTATUS"  
      where ota_transferapplntype_id is not null and otar_ownertransstatus_id in (3,4,5,6,7) 
     '.$filterquery .'  order by ota_id desc');
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }


    public function addressLog(Request $request){
      $page = $request->input('page');
     $search=DB::select(' select sd_key, sd_label, 
            case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
          then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
          from tbsearchdetail mtb where sd_se_id = "0" ');
    /*  $log = DB::select('select  date_format(ota_transtocenterdate,"%d/%m/%Y") ota_transtocenterdate, cm_ownertrans_applnreg.*, ownstatus.tdi_value ownstatus, ttype.tdi_value ttype, tstatus.tdi_value transstauts, date_format(otar_updatedate,"%d/%m/%Y") otar_updatedate, date_format(otar_createdate,"%d/%m/%Y") otar_createdate, cm_ownertrans_appln.*, cm_masterlist.*,cm_owner.*, owntype.tdi_value owntype, state.tdi_value state, ownrace.tdi_value ownrace
        from cm_masterlist 
        inner join cm_owner on to_ma_id = ma_id
        inner join cm_ownertrans_appln on ota_ownno = TO_OWNNO and ota_transferapplntype_id = 1
        inner join cm_ownertrans_applnreg on otar_accno = ma_accno
        left join tbdefitems owntype on owntype.tdi_key = ota_owntype_id and owntype.tdi_td_name = "OWNTYPE"
        left join tbdefitems ownrace on ownrace.tdi_key = ota_race_id and ownrace.tdi_td_name = "RACE"
        left join tbdefitems state on state.tdi_key = TO_STATE_ID and state.tdi_td_name = "STATE"
        left join tbdefitems subzone 
        on subzone.tdi_key = ma_subzone_id and subzone.tdi_td_name = "SUBZONE"
        left join tbdefitems tstatus 
        on tstatus.tdi_key = ota_transtocenterstatus_id and tstatus.tdi_td_name = "OWNERSHIPSTAGE"
        left join tbdefitems ttype  
        on ttype.tdi_key = ota_transferapplntype_id and ttype.tdi_td_name = "TRANSFERTYPE"
        left join tbdefitems ownstatus 
        on ownstatus.tdi_key = ota_transferapplntypestatus_id and ownstatus.tdi_td_name = "OWNERSHIPSTATUS"
        
       ');*/
      $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname, " - ", usr_position) tbuser, usr_position FROM tbuser');

        App::setlocale(session()->get('locale'));
        if($page == '1'){
             return view("codemaintenance.ownershiptransfer.addresslog")->with(array( 'userlist'=>$userlist, 'search'=>$search, 'page'=>$page));
        } else {
          return view("codemaintenance.ownershiptransfer.lotlog")->with(array( 'userlist'=>$userlist, 'search'=>$search, 'page'=>$page));
        }
    }
        
        





    public function propAddressLogTables(Request $request){
        Log::info('Test');
        ini_set('memory_limit', '2056M');
       // $baskedid = $request->input('id');
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
                $filterquery  = ' and '. $filterquery ;
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
        if($page =='1') {
          $property = DB::select("select * FROM cm_masterlist_log 
          inner join (select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE') state on state_id = mal_state_id
          inner join (select tdi_key subzone_id,tdi_parent_name zone, tdi_value subzone from tbdefitems where tdi_td_name = 'SUBZONE') subzone 
          on subzone_id = mal_subzone_id 
          inner join (select tdi_key ,tdi_parent_name , tdi_value  tstatus from tbdefitems where tdi_td_name = 'OWNERSHIPSTAGE') tstatus 
          on tdi_key = mal_approvalstatus_id
          where mal_approvalstatus_id in ('5','6','7','8') ");
        } else {
           $property = DB::select('select cm_lot_log.*, lotcode.tdi_value lotcode, roadtype.tdi_value roadtype, titletype.tdi_value titletype
            , unitsize.tdi_value unitsize, concat(lotcode.tdi_value,log_no) lotnumber, concat(titletype.tdi_value, LOG_TITLENO) titlenumber, 
            landuse.tdi_value landuse, tentype.tdi_value tentype, tstatus, ma_accno
            from cm_lot_log
            inner join cm_lot on lot_id = log_lot_id
            inner join cm_masterlist on ma_id = lo_ma_id
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE") lotcode on lotcode.tdi_key = LOG_LOTCODE_ID
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADTYPE") roadtype on roadtype.tdi_key = LO_ROADTYPE_ID
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE") titletype on titletype.tdi_key = LOG_TITLETYPE_ID
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SIZEUNIT") unitsize on unitsize.tdi_key = LO_SIZEUNIT_ID
            left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDUSE") landuse on  LO_LANDUSE_ID = landuse.tdi_key
            left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "TENURETYPE") tentype on  LOG_TENURETYPE_ID = tentype.tdi_key 
            left join (select tdi_key ,tdi_parent_name , tdi_value tstatus from tbdefitems where tdi_td_name = "OWNERSHIPSTAGE") tstatus 
            on tstatus.tdi_key = log_approvalstatus_id');
        }

       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

public function owneradddresTables(Request $request){
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
      $property = DB::select('select  cm_masterlist.*,cm_owner.*, owntype.tdi_value owntype, state.tdi_value state
      from cm_masterlist 
      inner join cm_owner on to_ma_id = ma_id
      left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE") owntype on owntype.tdi_key = to_owntype_id
      left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = TO_STATE_ID
      left join (select tdi_key, tdi_value,tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone 
      on subzone.tdi_key = ma_subzone_id 
     '.$filterquery .' ');
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }




    public function generateOwnershipreport(Request $request) {
      $type = $request->input('type');
      $accountnumber = $request->input('accountnumber');
      $tittle = $request->input('tittle');
      $name = $request->input('name');
      if($type == 'Successs'){
        $jasper_path = base_path('/reports/ownertransfers.jasper');
        $dowload_path = base_path('/reports/ownertransfers.pdf');
        $filename = 'OnwerTransferSuccess.pdf';
      } else {
        $jasper_path = base_path('/reports/ownertransferF.jasper');
        $dowload_path = base_path('/reports/ownertransferF.pdf');
        $filename = 'OnwerTransferFailure.pdf';
      }
          
              // Compile a JRXML to Jasper
           //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();
          
          $filter = ' otar_id = '. $accountnumber;
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
                        'jdbc_url' => "jdbc:mysql://".env('DB_HOST','').":".env('DB_PORT','')."/".env('DB_DATABASE','')."?autoReconnect=true&useSSL=false"
                  ))->execute();

          $headers = array(
              'Content-Type: application/pdf',
          );

          return response()->download($dowload_path, $filename, $headers);
      }

public function generateRemisireport(Request $request) {
      $type = $request->input('type');
      $accountnumber = $request->input('accountnumber');
      $tittle = $request->input('title');
      $name = $request->input('username');
      if($type == 'type1'){
        $jasper_path = base_path('/reports/remisi.jasper');
        $dowload_path = base_path('/reports/remisi.pdf');
        $filename = 'remisi.pdf';
      } else {
        $jasper_path = base_path('/reports/remisiInspection.jasper');
        $dowload_path = base_path('/reports/remisiInspection.pdf');
        $filename = 'remisiInspection.pdf';
      }
          
              // Compile a JRXML to Jasper
           //  JasperPHP::compile(base_path('/vendor/cossou/jasperphp/examples/valuation.jrxml'))->execute();
          
      Log::info($type);
      Log::info($accountnumber);
      Log::info($name);
 
          $filter = ' rg_id = '. $accountnumber;

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
      
 public function deactive(Request $request){
       $isfilter = $request->input('filter');
        $baskedid = $request->input('id');
        $param = $request->input('param');
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
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid, sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = 32 ');

        $basket = DB::select('select va_approvalstatus_id FROM cm_appln_val  ');
            $applntype = DB::select("select da_name
    from cm_appln_deactive  where da_id = ".$baskedid);
        foreach ($basket as $rec) {    
            $approvestatus = $rec->va_approvalstatus_id;
        }
        $applicationtype = "";
        $viewparambasket = "";
        $viewparamterm = "";
        $termid = "";
        $viewparambasketstatus = "";
        foreach ($applntype as $rec) {    
           
            $viewparambasket = $rec->da_name;
           
        }

         $reason = DB::select("select tdi_key , tdi_value  from tbdefitems where tdi_td_name = 'DEACTIVEDREASON' ");

        App::setlocale(session()->get('locale'));
        
      return view('group.deleteproperty')->with('search',$search)->with('id',$baskedid)->with('approvestatus',$approvestatus)->with('applicationtype',$applicationtype)->with('viewparambasket',$viewparambasket)->with('viewparamterm',$viewparamterm)->with('viewparambasketstatus',$viewparambasketstatus)->with('termid',$termid)->with('reason',$reason)->with('param',$param);
    }

       public function deletepropertyTables(Request $request){
         Log::info('Test F');
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
      
       $property = DB::select('select dad_id,`vd_approvalstatus_id`, `vd_id`, `vd_va_id`, `ma_id`, `ma_pb_id`, `ma_fileno`, `ma_accno`, `vd_accno`,da_approved,
        `tbdefitems_subzone`.`tdi_parent_name` `zone`, `tbdefitems_subzone`.`tdi_value` `subzone`, `ma_addr_ln1`, 
        `tbdefitems_ishasbuilding`.`tdi_value` `isbldg`, `tbdefitems_bldgtype`.`tdi_value` `bldgtype`, `tbdefitems_bldgtype`.`tdi_parent_name` `bldgcategory`,bldgsotery.tdi_value bldgsotery, 
        `vt_approvednt`, `vt_approvedtax`,  `vt_proposedrate`, `vt_note`, propertstatus.tdi_desc propertstatus, dad_desc, reason.tdi_value reason
        FROM `cm_appln_valdetl`
        INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
        inner join cm_appln_deactivedetl on dad_ma_id = ma_id
        inner join cm_appln_deactive on da_id = dad_da_id
        LEFT JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
        inner join (select MAX(vd_id) exsistid from cm_appln_valdetl
        inner join cm_appln_val on va_id = vd_va_id
        inner join cm_appln_valterm on vt_id = va_vt_id
        where vt_approvalstatus_id = "05" group by vd_ma_id) exsitsproperty on exsitsproperty.exsistid = vd_id
        LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
        LEFT JOIN `tbdefitems_ishasbuilding` ON `cm_appln_valdetl`.`vd_ishasbuilding` = `tbdefitems_ishasbuilding`.`tdi_key`
        LEFT JOIN `tbdefitems_bldgtype` ON `tbdefitems_bldgtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id` 
        left join (select *  from tbdefitems where tdi_td_name = "PROPERTYSTAGE") propertstatus
        on propertstatus.tdi_key = vd_approvalstatus_id 
        left join (select *  from tbdefitems where tdi_td_name = "DEACTIVEDREASON") reason
        on reason.tdi_key = dad_reason_id 
        left join (select *  from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgsotery
        on bldgsotery.tdi_key = vd_bldgstorey_id where  dad_da_id ='. $baskedid.' '. $filterquery);
        
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    /**
    *
    */
    public function deleteProperty(Request $request){
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

         $reason = DB::select("select tdi_key , tdi_value  from tbdefitems where tdi_td_name = 'DEACTIVEDREASON' ");
        
       $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_id and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid ,sd_keymainfield 
        from tbsearchdetail mtb where sd_se_id = "22" order by sd_id ');

        App::setlocale(session()->get('locale'));
        
        return view('group.newdeleteproperty')->with('search',$search)->with('id',$basketid)->with('basket_id',$basket_id)->with('reason',$reason);
    }

    public function accessDenied(Request $request){
        $moduleid = $request->input('id');
         $detail = UserAcessController::accessDetail($moduleid);
            return view('denied')->with('detail',$detail);
    }


    public function dataSearch(Redirect $request){

        App::setlocale(session()->get('locale'));
        
       if(userpermission::checkaccess('21')=="false"){
            $detail = UserAcessController::accessDetail('21');

            return view('denied')->with('detail',$detail);
        }
        
      $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_id and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid ,sd_keymainfield 
        from tbsearchdetail mtb where sd_se_id = "22" order by sd_sort ');
        
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
        App::setlocale(session()->get('locale'));
      return view('dataenquiry.datasearch')->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }


    public function dataSearchTables(Request $request){
        Log::info('Test');
        ini_set('memory_limit', '2056M');
        ini_set('max_execution_time', '200');
       // $baskedid = $request->input('id');max_execution_time = 30     ; 
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
      $property = DB::select('
      select 
      `cm_appln_valdetl`.`vd_accno`, `cm_masterlist`.`ma_fileno`,`SUBZONE`.`tdi_parent_name` zone, `SUBZONE`.`tdi_value` subzone,`cm_masterlist`.`ma_addr_ln1`,`cm_masterlist`.`ma_addr_ln2`, `cm_masterlist`.`ma_addr_ln3`,
      `cm_masterlist`.`ma_addr_ln4`, ma_postcode, ma_city, ma_postcode, STATE.tdi_value state, OWNTYPE.tdi_value owntype, to_ownname  TO_OWNNAME,  TO_OWNNO TO_OWNNO,   0 bldgcount, `cm_appln_valdetl`.`vd_approvalstatus_id`, 
      `cm_appln_valdetl`.`vd_id`, `cm_appln_valdetl`.`vd_va_id`, `cm_masterlist`.`ma_id`, `cm_masterlist`.`ma_pb_id`, `ISHASBUILDING`.`tdi_value` isbldg,`BULDINGTYPE`.`tdi_parent_name` bldgcategory, `BULDINGTYPE`.`tdi_value` bldgtype,
      `BUILDINGSTOREY`.`tdi_value` bldgsotery,`vt_approvednt`, `vt_approvedtax`,  `vt_proposedrate`, `vt_note`,vt_adjustment , DATE_FORMAT(vt_termDate, "%d/%m/%Y") as vt_termDate,LOTCODE.tdi_value lotcode,al_no
      from cm_appln_valdetl
      inner join cm_appln_val on va_id = vd_va_id
      inner join cm_appln_valterm on vt_id = va_vt_id
      inner join cm_masterlist on vd_ma_id = ma_id
      inner join cm_appln_lot on al_vd_id = vd_id
      inner join cm_owner on to_ma_id = ma_id
      inner join cm_appln_val_tax on vt_vd_id = vd_id
      left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") SUBZONE on SUBZONE.tdi_key = ma_subzone_id
      left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "LOTCODE") LOTCODE on LOTCODE.tdi_key = al_lotcode_id
      left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "STATE") STATE on STATE.tdi_key = ma_state_id
      left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "STATE") OWNSTATE on OWNSTATE.tdi_key = TO_STATE_ID
      left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "OWNTYPE") OWNTYPE on OWNTYPE.tdi_key = TO_OWNTYPE_ID
      left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "ISHASBUILDING") ISHASBUILDING on ISHASBUILDING.tdi_key = vd_ishasbuilding
      left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") BULDINGTYPE on BULDINGTYPE.tdi_key = vd_bldgtype_id
      left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BUILDINGSTOREY") BUILDINGSTOREY on BUILDINGSTOREY.tdi_key = vd_bldgstorey_id
      inner join (select max(vt_termDate) termdate,  vd_ma_id, vd_accno as accountno from cm_appln_valdetl
      inner join cm_appln_val on va_id = vd_va_id
      inner join cm_appln_valterm on vt_id = va_vt_id
      where  vt_id  IN (select vt_id from cm_appln_valterm where vt_approvalstatus_id = "05") 
      and vd_accno NOT IN (select cm_appln_deactivedetl.dad_accno from cm_appln_deactivedetl inner join  cm_appln_deactive on cm_appln_deactivedetl.dad_da_id = cm_appln_deactive.da_id 
      inner join cm_appln_valterm on cm_appln_deactive.da_vt_id = cm_appln_valterm.vt_id where vt_id IN (select vt_id from cm_appln_valterm where vt_approvalstatus_id = "05") )
      group by vd_ma_id, vd_accno) active_term on active_term.termdate = vt_termDate and active_term.accountno = cm_appln_valdetl.vd_accno 
     '.$filterquery);
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }


    public function datasearchTab(Request $request){
      App::setlocale(session()->get('locale'));
      
       if(userpermission::checkaccess('212')=="false"){
            $detail = UserAcessController::accessDetail('212');
            return view('denied')->with('detail',$detail);
        }
        App::setlocale(session()->get('locale'));
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
on subzone.tdi_key = ma_subzone_id  where vd_id = ifnull("'.$prop_id.'",0)');
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
                (select tdi_key tenanttype_id, tdi_value tenanttype from tbdefitems where tdi_td_name = 'TENANTTYPE') tenanttype
                where te_state_id = state_id and te_citizen_id = citizen_id and te_race_id = race_id
                and te_activeind_id = activeind_id and te_applntype_id = applntype_id
                and te_type_id = tenanttype_id and at_te_id =  te_id and at_vd_id = ifnull(".$prop_id.",0) ");
               
             $attachment = DB::select("
            select at_name, at_fileextention,
            at_path,at_oringinalfilename,at_id,at_attachtype_id,at_filename,at_detail,at_createby,at_createdate, attachment.tdi_value attachment from cm_attachment left join 
            (select tdi_key, tdi_value from tbdefitems where tdi_td_name = 'ATTACHMENTTYPE') attachment on attachment.tdi_key =  at_attachtype_id  where at_linkid = ifnull(".$prop_id.",0) ");

              $parameter = DB::select("select ap_id,ap_bldgstatus_id,ap_propertycategory_id,ap_propertytype_id,ap_propertylevel_id  FROM cm_appln_parameter where ap_vd_id  = ifnull(".$prop_id.",0) ");

               $config=DB::select("select GROUP_CONCAT(config_value SEPARATOR  ':') serveradd from tbconfig where config_name in ('host','port') ");
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }





         $valterm=DB::select("select concat(vt_name,'', DATE_FORMAT(vt_createdate, '%d%m%Y')) termfoldername, vd_accno accountnumber, va_vt_id,
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
                $termid = $rec->va_vt_id;
                $viewparamterm = "( ".$rec->applntype." ) ".$rec->vt_name." - ".$rec->termstage ;
                if($rec->vd_approvalstatus_id == "07" || $rec->vd_approvalstatus_id == "08"|| $rec->vd_approvalstatus_id == "09"){
                    $iseditable = 1;
                } else {
                    $iseditable = 0;
                }
            }

            $valmaster = DB::select('select subzone.tdi_value subzone, subzone.tdi_parent_name zone, ap_bldgstatus_id, proptype.tdi_value proptype, 
                proptype.tdi_parent_name propcategorty
                from cm_appln_valdetl, cm_appln_parameter 
                left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = "BULDINGTYPE") proptype
                on proptype.tdi_key = ap_propertytype_id,
                cm_masterlist 
                left join (select tdi_key, tdi_value,tdi_parent_name from tbdefitems where tdi_td_name = "SUBZONE") subzone
                on subzone.`tdi_key` = ma_subzone_id
                where ap_vd_id  = vd_id and ma_id = vd_ma_id and vd_id = '.$prop_id);

            $vallot = DB::select('select DATE_FORMAT(vl_startdate, "%d/%m/%Y") vl_startdate1, DATE_FORMAT(vl_expireddate, "%d/%m/%Y") vl_expireddate1,cm_appln_val_lot.*, lotcode.tdi_value lotcode, roadtype.tdi_value roadtype, titletype.tdi_value titletype
        , unitsize.tdi_value unitsize, concat(lotcode.tdi_value,vl_no) lotnumber, concat(titletype.tdi_value,vl_titleno) titlenumber, landuse.tdi_value landuse, tentype.tdi_value tentype
         from cm_appln_val_lot left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE") lotcode on lotcode.tdi_key = vl_lotcode_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADTYPE") roadtype on roadtype.tdi_key = vl_roadtype_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE") titletype on titletype.tdi_key = vl_titletype_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SIZEUNIT") unitsize on unitsize.tdi_key = vl_sizeunit_id
        left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDUSE") landuse on  vl_landuse_id = landuse.tdi_key
        left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "TENURETYPE") tentype on  vl_tenuretype_id = tentype.tdi_key 
         where vl_vd_id = ifnull("'.$prop_id.'",0)');
            
            $valbldg = DB::select(' select DATE_FORMAT(vb_cccdate, "%d/%m/%Y") vb_cccdate1, DATE_FORMAT(vb_occupieddate, "%d/%m/%Y") vb_occupieddate1,
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
            
              $valbldgar = DB::select('select cm_appln_val_bldgarea.*, vb_id, arlvel.tdi_value arlvel, arcate.tdi_value arcate
        , artype.tdi_value artype, aruse.tdi_value aruse from cm_appln_val_bldgarea  left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREATYPE") artype on artype.tdi_key = cm_appln_val_bldgarea.vba_AREATYPE_ID
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREACATEGORY") arcate on  arcate.tdi_key = vba_AREACATEGORY_ID
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREALEVEL") arlvel on  arlvel.tdi_key = vba_AREALEVEL_ID 
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAUSE") aruse on aruse.tdi_key = vba_areause_id 
        , cm_appln_val_bldg where vba_vb_id = vb_id and vb_vd_id = ifnull("'.$prop_id.'",0)');

               $allowance = DB::select('select *, vb_id, allowancetype.tdi_value allowancetype,allowancetype.tdi_parent_name allowancecategory, allowancemethod.tdi_value allowancemethod 
from cm_appln_val_bldgallowances
    left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = "ALLOWANCECALMETHOD") allowancemethod on  allowancemethod.tdi_key = vbal_calcmethod_id 
    left join (select tdi_key, tdi_value,tdi_parent_name from tbdefitems where tdi_td_name = "ALLOWANCETYPE") allowancetype on allowancetype.tdi_key = vbal_allowancetype_id 
     , cm_appln_val_bldg where vbal_vb_id = vb_id and vb_vd_id = ifnull("'.$prop_id.'",0)');           

             $tax = DB::select('select `vt_id`, `vt_vd_id`,  `vt_grossvalue`, `vt_valuedescretion`, `vt_proposednt`, `vt_proposedrate`, `vt_calculatedrate`,  
`vt_proposedtax`, `vt_approvednt`,  `vt_approvedrate`, `vt_adjustment`,  `vt_approvedtax`,  `vt_note`,
`vt_createby`,  `vt_createdate`,  `vt_updateby`,  `vt_updatedate`
FROM `cm_appln_val_tax` where vt_vd_id = ifnull("'.$prop_id.'",0)');

              $lotarea = DB::select('select * from cm_appln_val_lotarea, cm_appln_val_lot where vla_vt_id = vl_id and vl_vd_id = ifnull("'.$prop_id.'",0)');

            
       $lotdetail = DB::select('select * from cm_appln_val_lotarea where vla_vt_id =  ifnull("'.$prop_id.'",0)');

       $additional = DB::select('select * from cm_appln_val_additional where vad_vd_id =  ifnull("'.$prop_id.'",0)');

        
        App::setlocale(session()->get('locale'));

            return view("dataenquiry.datasearchdetail")->with('district', $district)->with('state', $state)->with('zone', $zone)->with('subzone', $subzone)->with(array('bldgstruct'=>$bldgstruct,'bldgstore'=>$bldgstore,'ishasbuilding'=>$ishasbuilding, 'landuse'=>$landuse, 'master'=> $master, 'lotlist'=> $lotlist, 'ownerlist'=>$ownerlist, 'building'=> $building,'lotcode'=> $lotcode, 'titiletype'=>$titiletype, 'unitsize'=> $unitsize, 'landcond'=>$landcond,'landpos' => $landpos,'roadtype'=> $roadtype, 'roadcaty'=>$roadcaty, 'tnttype'=> $tnttype, 'owntype'=>$owntype,'race' => $race,'citizen'=> $citizen, 'bldgcond'=>$bldgcond, 'bldgpos'=> $bldgpos, 'bldgstructure'=>$bldgstruct,'rooftype'=> $rooftype, 'walltype'=>$walltype, 'fltype'=> $fltype, 'arlvl'=>$arlvl,'arcaty' => $arcaty, 'artype'=> $artype, 'aruse'=>$aruse,'arzone' => $arzone,'ceiling' => $ceiling,'bldgcate' => $bldgcate,'bldgtype' => $bldgtype,'count' => $count, 'bldgardetail' => $bldgardetail,'ratepayer' => $ratepayer, 'tenant' => $tenant,'prop_id' => $prop_id,'pb'=> $pb,'parameter' => $parameter,'attachment'=>$attachment,'attachtype' => $attachtype, 'termname' => $termname, 'accountnumber' => $accountnumber,'serverhost' => $serverhost, 'ownerd' => $owner, 'viewparambasket' => $viewparambasket, 'viewparambasketstatus' => $viewparambasketstatus, 'viewparamterm' => $viewparamterm, 'termid' => $termid,
                'iseditable' => $iseditable, 'applntype' => $applntype, 'lot'=>$vallot,'bldg'=>$valbldg,'valmaster' => $valmaster,'tax' => $tax,'lotdetail' => $lotdetail,'lotarea' => $lotarea,'bldgar' => $valbldgar,'allowance' => $allowance,'prop_id' => $prop_id,'additional' => $additional, 'viewparambasket' => $viewparambasket, 'viewparambasketstatus' => $viewparambasketstatus, 'viewparamterm' => $viewparamterm, 'termid' => $termid, 'accountnumber' => $accountnumber,
                'iseditable' => $iseditable,'pb'=>$pb));
    }

    public function deactivateBakset(Request $request){
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
        if(userpermission::checkaccess('515') == "false"){
          $termcondition = " where vt_approvalstatus_id = '01' ";

        }
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
        return view("group.deactivate.basket")->with(array('term'=> $term,'group'=> $group,'tonebasket'=>$tonebasket,'tonetaxbasket'=>$tonetaxbasket,'propcount'=>$propcount,'bldgcount'=>$bldgcount,'inspropcount'=>$inspropcount,'valpropcount'=>$valpropcount,'termfilter' => $termfilter, 'param' => $param));
    }

    public function groupDeactiveTransaction(Request $request) {
        $jsondata = $request->input('jsondata');
        $param = $request->input('param');
        $name=Auth::user()->name;
        Log::info("call proc_cmapplndeactive_trn('".$jsondata."','".$name."')"); 
        $response=DB::select("call proc_cmapplndeactive_trn('".$jsondata."','".$name."')");
       // return redirect('deactive'); 
        return Redirect::route('deactive', ['param' => $param]);//('group')->with('param','100048');
    }

    public function termSearch(Request $request){
        $jsondata = $request->input('jsondata');    
         $param = $request->input('param'); 
        $cond = ' ';
         if($param !='A' && $param !='') {
            $cond = ' where vt_applicationtype_id =  "'.$param.'"';
         }
         
        $term = DB::select("select vt_valbase_id, vt_id, vt_name name, vt_createby createby,  DATE_FORMAT(vt_createdate, '%d/%m/%Y') createdate, vt_updateby updateby, applntype.tdi_value applntype, 
          DATE_FORMAT(vt_updatedate, '%d/%m/%Y')  updatedate, ifnull(basket_count,0) basket_count, ifnull(property_count,0) property_count,DATE_FORMAT(vt_termDate, '%d/%m/%Y') termDate, DATE_FORMAT(now(), '%d/%m/%Y') enforceDate,  vt_applicationtype_id,DATE_FORMAT(vt_transferDate, '%d/%m/%Y') vt_transferDate, vt_transferby,
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
        left join (select *  from tbdefitems where tdi_td_name = 'VALUATIONBASE') valbase
        on valbase.tdi_key = vt_valbase_id ".$cond."  order by vt_termDate desc");
        $basket_count=DB::select('select  count(*) basket_count from cm_appln_val');
        $property_count=DB::select('select  count(vd_id) property_count from cm_appln_valdetl inner join cm_appln_val on va_id = vd_va_id');
            $applntype = DB::select('select * from tbdefitems where tdi_td_name = "APPLICATIONTYPE"');
            $valbase = DB::select('select * from tbdefitems where tdi_td_name = "VALUATIONBASE" ');

        App::setlocale(session()->get('locale'));
        
        return view("termsearch.valterm")->with(array('term'=> $term,'basket_count'=> $basket_count,'property_count'=> $property_count,'applntype'=> $applntype,'valbase'=> $valbase, 'param' => $param,));
    }

    public function termBasket(Request $request){
        $id = $request->input('id');
       // Log::info( DB::statement('call json_procedure( )'));
        $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "18" ');
        $termcondition = "";
        if(userpermission::checkaccess('515') == "false"){
          $termcondition = " where vt_approvalstatus_id in ('01','02') ";

        }
        $termfilter = DB::select("select vt_id termid, vt_name term, applntype.tdi_value applntype, 
                termstage.tdi_desc termstage
                from cm_appln_valterm
                left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
                on applntype.tdi_key = vt_applicationtype_id
                left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
                on termstage.tdi_key = vt_approvalstatus_id ". $termcondition ." order by vt_termDate desc");
        $term = DB::select("select vt_valbase_id, vt_id termid, vt_name term, applntype.tdi_value applntype, 
                termstage.tdi_desc termstage from cm_appln_valterm 
                left join (select *  from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype
                on applntype.tdi_key = vt_applicationtype_id
                left join (select *  from tbdefitems where tdi_td_name = 'TERMSTAGE') termstage
                on termstage.tdi_key = vt_approvalstatus_id 
                 where vt_approvalstatus_id = '01' and vt_id =".$id." order by vt_termDate desc");
        $group = DB::select("select approval.tdi_desc approval,va_approvalstatus_id, va_id id, va_name l_group, va_vt_id termid, vt_name termaname, va_createby createby, DATE_FORMAT(va_createdate, '%d/%m/%Y') createdate, 
        va_updateby updateby, DATE_FORMAT(va_updatedate, '%d/%m/%Y') updatedate, ifnull(propertycount,0) propertycount,ifnull(inspropertyccount,0) inspropertyccount , applntype.tdi_value applntype,
         vt_applicationtype_id, ob_desc, ifnull(notiscount,0) notiscount , ifnull(objectioincount,0) objectioincount , ifnull(decisioncount,0) decisioncount , ifnull(valcount,0)  valcount
        from cm_appln_val 
        inner join cm_appln_valterm  on va_vt_id = vt_id
        left join (select count(*) propertycount,vd_va_id from cm_appln_valdetl group by vd_va_id ) propcount on propcount.vd_va_id = va_id
        left join (select count(*) inspropertyccount ,vd_va_id from cm_appln_valdetl where vd_approvalstatus_id in ('06','07','08','09','10','11','12') 
        group by vd_va_id ) insprop on insprop.vd_va_id = va_id
        left join (select count(*) valcount ,vd_va_id from cm_appln_valdetl where vd_approvalstatus_id in ('08','09','10','11','12')  
        group by vd_va_id ) valprop on valprop.vd_va_id = va_id
        left join (SELECT * FROM tbdefitems where tdi_td_name = 'BASKETSTAGE') approval on approval.tdi_key = va_approvalstatus_id 
        left join (SELECT * FROM tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype on applntype.tdi_key = vt_applicationtype_id 
        left join cm_objection on ob_vt_id = vt_id 
        left join (select count(*) notiscount,vd_va_id  from cm_objection_notis 
        inner join cm_appln_valdetl on vd_id = no_vd_id group by vd_va_id ) notis on notis.vd_va_id = va_id
        left join (select count(*) objectioincount,vd_va_id  from cm_objection_objectionlist 
        inner join cm_appln_valdetl on vd_id = ol_vd_id group by vd_va_id ) objection on objection.vd_va_id = va_id
        left join (select count(*) decisioncount,vd_va_id  from cm_objection_decision 
        inner join cm_appln_valdetl on vd_id = de_vd_id group by vd_va_id ) decision on decision.vd_va_id = va_id
        where  va_vt_id = ifnull('".$id."',0) 
        order by va_id desc");

        $termtype = DB::select("select * from cm_appln_valterm  where vt_valbase_id = 2 and vt_id = ifnull('".$id."',0)  limit 1");
        

        $tonebasket = DB::select("select tollist_id, concat(tollis_enforceyear,' - ',tollis_desc) tonebasket from cm_toneoflistbasket where tollis_activeind_id = 1");
        $tonetaxbasket = DB::select("select trlist_id, concat(trlist_enforceyear,' - ',trlist_desc) tonetaxbasket from cm_taxratelistbasket where trlist_activeind_id = 1");

        $propcount = DB::select('select  count(*) totproperty_count from cm_appln_valdetl 
        inner join cm_appln_val on va_id = vd_va_id where  va_vt_id = ifnull("'.$id.'",0)');

        $bldgcount = DB::select('select  count(*) bldgcount from cm_appln_bldg
          inner join cm_appln_valdetl  on ab_vd_id = vd_id 
          inner join cm_appln_val on va_id = vd_va_id where  va_vt_id = ifnull("'.$id.'",0) ');


        $inspropcount = DB::select('select  count(*) inscount from cm_appln_valdetl 
        inner join cm_appln_val on va_id = vd_va_id
        where vd_approvalstatus_id in ("06","07","08","09","10","11","12") and  va_vt_id = ifnull("'.$id.'",0)');

        $valpropcount = DB::select('select  count(*) valcount from cm_appln_valdetl 
        inner join cm_appln_val on va_id = vd_va_id where vd_approvalstatus_id in ("08","09","10","11","12") and  va_vt_id = ifnull("'.$id.'",0)');

        App::setlocale(session()->get('locale'));
        
        return view("termsearch.basket")->with(array('term'=> $term,'group'=> $group,'tonebasket'=>$tonebasket,'tonetaxbasket'=>$tonetaxbasket,'propcount'=>$propcount,'bldgcount'=>$bldgcount,'inspropcount'=>$inspropcount,'valpropcount'=>$valpropcount,'termfilter' => $termfilter, 'id' => $id, 'termtype' => $termtype));
    }


    


    public function accountSearch(Request $request){    
        
      $isfilter = $request->input('filter');
      $basketid = $request->input('id');
      $basket_id = $request->input('basket_id');
      $type = $request->input('type');        
    
      $search=DB::select(' select sd_key, sd_label,  sd_keymainfield ,
        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid 
        from tbsearchdetail mtb where sd_se_id = 39 ');
        App::setlocale(session()->get('locale'));
      return view('ownershiptransfer.popup.accountsearch')->with('search',$search)->with('totalcount','0');
    }


    public function accountSearchData(Request $request){
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
    // $property = DB::select('select * from property where vd_approvalstatus_id = "13" '.$filterquery);
       $property = DB::select('select ma_subzone_id,ma_id, ma_pb_id,  ma_accno,  zone.tdi_value zone, subzone.tdi_value subzone,
          ma_addr_ln1, isbldg.tdi_value isbldg
        from cm_masterlist
        inner join tbdefitems subzone
        on ma_subzone_id = subzone.tdi_key and subzone.tdi_td_name = "SUBZONE"
        inner join tbdefitems  zone
        on subzone.tdi_parent_key = zone.tdi_key and zone.tdi_td_name = "ZONE"
        inner join tbdefitems isbldg
        on ma_ishasbuilding_id = isbldg.tdi_key and isbldg.tdi_td_name = "ISHASBUILDING"  '. $filterquery);
        
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    public function updateAttachment(Request $request) {
        $jsondata = $request->input('attachmentdata');
        $prop_id = $request->input('prop_id');
        $name=Auth::user()->name;
       // Log::info("select fn_attachment('".$jsondata."','".$name."',".$prop_id.") from dual"); 
        $response=DB::select("select fn_attachment('".$jsondata."','".$name."',".$prop_id.") from dual");
        
        //return response()->json(array('prop_id'=> $prop_id), 200);
        return Redirect::route('datasearchdetail', ['prop_id' => $prop_id]);
    }

    public function termAttachment(Request $request){
        $prop_id = $request->input('prop_id');
        $year = $request->input('year');


            $attachtype=DB::table('tbdefitems')->where('tdi_td_name', 'ATTACHMENTTYPE')->get();
      $attachment = DB::select("
            select at_name, at_fileextention,
            at_path,at_oringinalfilename,at_id,at_attachtype_id,at_filename,at_detail,at_createby,at_createdate, attachment.tdi_value attachment from cm_attachment left join 
            (select tdi_key, tdi_value from tbdefitems where tdi_td_name = 'ATTACHMENTTYPE') attachment on attachment.tdi_key =  at_attachtype_id  where at_linkid = ifnull(".$prop_id.",0) ");
      
        App::setlocale(session()->get('locale'));
       return view('termsearch.popup.attachment')->with(array('attachment'=>$attachment,
        'attachtype'=>$attachtype,'prop_id'=>$prop_id,'year'=>$year));
    }

     public function officialSearch(Request $request) {
        $search=DB::select(' select sd_key, sd_label, sd_keymainfield,
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "18" ');
        
        
        $userlist=DB::select('select usr_id, concat(usr_firstname, " " ,usr_lastname, " - ", usr_position) tbuser, concat(usr_firstname, " " ,usr_lastname) usr_name , usr_position FROM tbuser');
        $group = DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "USERGROUP"');
        App::setlocale(session()->get('locale'));
        
         return view("officialsearch.property")->with('search',$search)->with('group',$group)->with('userlist',$userlist);
    
    }

    public function officialSearchData(Request $request){
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
    // $property = DB::select('select * from property where vd_approvalstatus_id = "13" '.$filterquery);
       $property = DB::select('select cm_officialsearch.*, `vd_approvalstatus_id`, `vd_id`, `vd_va_id`, `ma_id`, `ma_pb_id`, `ma_fileno`, `ma_accno`, `vd_accno`,
        `tbdefitems_subzone`.`tdi_parent_name` `zone`, `tbdefitems_subzone`.`tdi_value` `subzone`,
        `tbdefitems_bldgtype`.`tdi_value` `bldgtype`, 
        `tbdefitems_bldgtype`.`tdi_parent_name` `bldgcategory`,
        bldgsotery.tdi_value bldgsotery, 
        `tbdefitems_ishasbuilding`.`tdi_value`  propertstatus, 
        approval.tdi_value approvalstatus,
        state.tdi_value state, ugroup.tdi_value ugroup,
        os_termdate, DATE_FORMAT(os_createdate, "%d/%m/%Y") as os_createdate_frmt  
        FROM cm_officialsearch
        inner join `cm_appln_valdetl` on vd_id = os_vd_id
        inner join `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
        left join `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
        left join `tbdefitems_bldgtype` ON `tbdefitems_bldgtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id` 
        left join (select *  from tbdefitems where tdi_td_name = "PROPERTYSTAGE") propertstatus
        on propertstatus.tdi_key = vd_approvalstatus_id 
        left join (select *  from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgsotery
        on bldgsotery.tdi_key = vd_bldgstorey_id 
        LEFT JOIN `tbdefitems_ishasbuilding` ON `cm_appln_valdetl`.`vd_ishasbuilding` = `tbdefitems_ishasbuilding`.`tdi_key`
        left join (select *  from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval
        on approval.tdi_key = os_officialsearchstatus_id 
        left join (select *  from tbdefitems where tdi_td_name = "STATE") state
        on state.tdi_key = os_state 
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "USERGROUP") ugroup
        on ugroup.tdi_key = os_applngroup_id    '. $filterquery);
        
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    public function addApplication(Request $request){
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
       
        
        $search=DB::select(' select sd_key, sd_label, 
        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid, sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = 18 ');
        $state = DB::select("select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE'");

        $group = DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "USERGROUP"');
        App::setlocale(session()->get('locale'));
        return view('officialsearch.addapplication')->with('state',$state)->with('search',$search)->with('id',$basketid)->with('basket_id',$basket_id)->with('group',$group);
    }


    public function addRemisi(Request $request){
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
       
        
        $search=DB::select(' select sd_key, sd_label, 
        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid, sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = 18 ');
        $state = DB::select("select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE'");
        App::setlocale(session()->get('locale'));
        return view('remisi.addapplication')->with('state',$state)->with('search',$search)->with('id',$basketid)->with('basket_id',$basket_id);
    }

    public function updateApplication(Request $request){
        $id = $request->input('id');
       
        
        $search=DB::select(' select sd_key, sd_label, 
        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid, sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = 18 ');

        $state = DB::select("select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE'");

         $property = DB::select('select cm_officialsearch.*, `vd_approvalstatus_id`, `vd_id`, `vd_va_id`, `ma_id`, `ma_pb_id`, `ma_fileno`, `ma_accno`, `vd_accno`,
        `tbdefitems_subzone`.`tdi_parent_name` `zone`, `tbdefitems_subzone`.`tdi_value` `subzone`,
        `tbdefitems_bldgtype`.`tdi_value` `bldgtype`, 
        `tbdefitems_bldgtype`.`tdi_parent_name` `bldgcategory`,
        bldgsotery.tdi_value bldgsotery, 
        `tbdefitems_ishasbuilding`.`tdi_value`  propertstatus, 
        approval.tdi_value approvalstatus,
        state.tdi_value state,
        os_termdate, os_createdate,os_createby
        FROM cm_officialsearch
        inner join `cm_appln_valdetl` on vd_id = os_vd_id
        inner join `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
        left join `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
        left join `tbdefitems_bldgtype` ON `tbdefitems_bldgtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id` 
        left join (select *  from tbdefitems where tdi_td_name = "PROPERTYSTAGE") propertstatus
        on propertstatus.tdi_key = vd_approvalstatus_id 
        left join (select *  from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgsotery
        on bldgsotery.tdi_key = vd_bldgstorey_id 
        LEFT JOIN `tbdefitems_ishasbuilding` ON `cm_appln_valdetl`.`vd_ishasbuilding` = `tbdefitems_ishasbuilding`.`tdi_key`
        left join (select *  from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval
        on approval.tdi_key = os_officialsearchstatus_id 
        left join (select *  from tbdefitems where tdi_td_name = "STATE") state
        on state.tdi_key = os_state    where os_id = '. $id);

        $group = DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "USERGROUP"');
        App::setlocale(session()->get('locale'));
        return view('officialsearch.application')->with('state',$state)->with('search',$search)->with('id',$id)->with('property',$property)->with('group',$group);
    }

     public function  searchPropertyAddress(Request $request){
        $isfilter = $request->input('filter');
        $basketid = $request->input('id');
        $basket_id = $request->input('basket_id');
        $type = $request->input('type');
        $page = $request->input('page');

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
        
        return view('codemaintenance.ownershiptransfer.popup.search')->with('search',$search)->with('id',$basketid)->with('basket_id',$basket_id)->with('page',$page);
    }

     public function searchPropertyAddressData(Request $request){
        Log::info('Testvv');
        ini_set('memory_limit', '2056M');
       // $baskedid = $request->input('id');
        $maxRow = 30;

        $account = $request->input('account');
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
                $filterquery  = ' and '. $filterquery ;
            }
            Log::info($filterquery);

        }
      $property = DB::select("select * FROM cm_masterlist_log 
      inner join (select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE') state on state_id = mal_state_id
      inner join (select tdi_key subzone_id,tdi_parent_name zone, tdi_value subzone from tbdefitems where tdi_td_name = 'SUBZONE') subzone on subzone_id = mal_subzone_id 
      left join (select tdi_key ,tdi_parent_name , tdi_value tstatus from tbdefitems where tdi_td_name = 'OWNERSHIPSTAGE') tstatus 
      on tdi_key = mal_approvalstatus_id where mal_approvalstatus_id <> '7'
       ".$filterquery  );
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    public function propertyLotData(Request $request){
        Log::info('Testvv');
        ini_set('memory_limit', '2056M');
       // $baskedid = $request->input('id');
        $maxRow = 30;

        $account = $request->input('account');
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
                $filterquery  = ' and '. $filterquery ;
            }
            Log::info($filterquery);

        }
      $property = DB::select('select cm_lot.*, lotcode.tdi_value lotcode, roadtype.tdi_value roadtype, titletype.tdi_value titletype
      , unitsize.tdi_value unitsize, concat(lotcode.tdi_value, " ",lo_no) lotnumber, concat(titletype.tdi_value, " ", LO_TITLENO) titlenumber, 
      landuse.tdi_value landuse, tentype.tdi_value tentype, tstatus, ma_accno, log_approvalstatus_id, log_id
      from cm_lot
      inner join cm_masterlist on ma_id = lo_ma_id
      inner join cm_lot_log on lot_id = log_lot_id
      left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE") lotcode on lotcode.tdi_key = LO_LOTCODE_ID
      left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADTYPE") roadtype on roadtype.tdi_key = LO_ROADTYPE_ID
      left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE") titletype on titletype.tdi_key = LO_TITLETYPE_ID
      left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SIZEUNIT") unitsize on unitsize.tdi_key = LO_SIZEUNIT_ID
      left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDUSE") landuse on  LO_LANDUSE_ID = landuse.tdi_key
      left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "TENURETYPE") tentype on  LO_TENURETYPE_ID = tentype.tdi_key 
      left join (select tdi_key ,tdi_parent_name , tdi_value tstatus from tbdefitems where tdi_td_name = "OWNERSHIPSTAGE") tstatus 
      on tstatus.tdi_key = log_approvalstatus_id  where log_approvalstatus_id <> "7" 
       '.$filterquery  );
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

     public function addApplicationData(Request $request){        
        $jsondata = $request->input('jsondata');
        $basketid = $request->input('id');
        //$accounts = implode(",",$accounts);
        $name=Auth::user()->name;
        //$sql = 'call proc_grabdata("'.$accounts.'",1)';
        Log::info("call proc_cmofficialsearch('".$jsondata."',".$basketid.",'".$name."')");
        $search=DB::select("call proc_cmofficialsearch('".$jsondata."',".$basketid.",'".$name."')"); 
        
        return response()->json(array('data'=> 'true'), 200);
    }


    public function remisiSearchData(Request $request){
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
    // $property = DB::select('select * from property where vd_approvalstatus_id = "13" '.$filterquery);
       $property = DB::select('select cm_remisi_reg.*, `vd_approvalstatus_id`, `vd_id`, `vd_va_id`, `ma_id`, `ma_pb_id`, `ma_fileno`, `ma_accno`, `vd_accno`,
        `tbdefitems_subzone`.`tdi_parent_name` `zone`, `tbdefitems_subzone`.`tdi_value` `subzone`,
        `tbdefitems_bldgtype`.`tdi_value` `bldgtype`, 
        `tbdefitems_bldgtype`.`tdi_parent_name` `bldgcategory`,
        bldgsotery.tdi_value bldgsotery, 
        `tbdefitems_ishasbuilding`.`tdi_value`  propertstatus, 
        approval.tdi_value approvalstatus,
        state.tdi_value state, format(`rg_bldgvalue`,2)  bldgvalue, format(`rg_landvalue`,2)  landvalue,
         DATE_FORMAT(rg_createat, "%d/%m/%Y") as rg_createat_frmt, DATE_FORMAT(rg_desiofficerdate, "%d/%m/%Y") as rg_desiofficerdate_frmt   
        FROM cm_remisi_reg
        inner join `cm_masterlist` ON ma_accno = rg_accno
        inner join `cm_appln_valdetl` on`cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
        left join `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
        left join `tbdefitems_bldgtype` ON `tbdefitems_bldgtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id` 
        left join (select *  from tbdefitems where tdi_td_name = "PROPERTYSTAGE") propertstatus
        on propertstatus.tdi_key = vd_approvalstatus_id 
        left join (select *  from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgsotery
        on bldgsotery.tdi_key = vd_bldgstorey_id 
        LEFT JOIN `tbdefitems_ishasbuilding` ON `cm_appln_valdetl`.`vd_ishasbuilding` = `tbdefitems_ishasbuilding`.`tdi_key`
        left join (select *  from tbdefitems where tdi_td_name = "REMISISTAGE") approval
        on approval.tdi_key = rg_remisistatus_id 
        left join (select *  from tbdefitems where tdi_td_name = "STATE") state
        on state.tdi_key = rg_applntstate_id '. $filterquery.' order by rg_id desc');
        
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }


    public function  remisiDetail(Request $request){
        $id = $request->input('id');

        $master = DB::select('select ma_ishasbuilding_id, ma_id, ma_pb_id,  ma_accno,ma_fileno,subzone.tdi_value subzone, subzone.tdi_parent_name zone, 
 ma_subzone_id,subzone.tdi_parent_key zone_id, ma_district_id, ma_addr_ln1,ma_addr_ln2,ma_addr_ln3,ma_addr_ln4, ma_city, ma_state_id, ma_postcode, 
 to_telno, to_ownname, to_ownno, TO_ADDR_LN1,TO_ADDR_LN2,TO_ADDR_LN3,TO_ADDR_LN4,TO_POSTCODE, TO_STATE_ID, TO_CITY, cm_remisi_reg.*, format(`rg_bldgvalue`,2)  bldgvalue, format(`rg_landvalue`,2)  landvalue
from  cm_remisi_reg  inner join cm_masterlist on ma_accno = rg_accno
inner join cm_owner on to_ma_id = ma_id
left join (select tdi_key, tdi_value,tdi_parent_key,tdi_parent_name from tbdefitems where tdi_td_name = "SUBZONE") subzone 
on subzone.tdi_key = ma_subzone_id  where rg_id = ifnull("'.$id.'",0)');


      $insdata = DB::select('select * from cm_remisi_inspection 
      inner join (select usr_name, concat(usr_firstname, " " ,usr_lastname) officername FROM tbuser) tbuser  on usr_name = ri_insofficer 
      inner join (SELECT * FROM tbdefitems where tdi_td_name = "INVESTIGATIONTYPE") insttype on  tdi_key =ri_instype_id
      where ri_rg_id = ifnull("'.$id.'",0)');
          
      $term=DB::select("
select concat(DATE_FORMAT(vt_termDate, '%d/%m/%Y'),'-' ,vt_name) term, DATE_FORMAT(vt_termDate, '%d/%m/%Y') vt_termDate 
from cm_appln_valterm
where vt_termDate >= (select vt_termDate from cm_appln_valdetl inner join cm_appln_val on vd_va_id = va_id
 inner join cm_appln_valterm on vt_id = va_vt_id
 inner join cm_remisi_reg on rg_accno = vd_accno
 where rg_id =".$id.") and vt_applicationtype_id = 'K' ");

      $remisistatus=DB::select('select rg_remisistatus_id  FROM cm_remisi_reg where rg_id = ifnull("'.$id.'",0)');
        foreach ($remisistatus as $obj) {    
           $remisistatus = $obj->rg_remisistatus_id;
        }
          

        $state=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE"'); 
        $instype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "INVESTIGATIONTYPE"'); 

        $userlist=DB::select('select usr_name, concat(usr_firstname, " " ,usr_lastname) name FROM tbuser');

        App::setlocale(session()->get('locale'));


        return view('remisi.tab.tab')->with('id',$id)->with('master',$master)->with('state',$state)->with('instype',$instype)->with('remisistatus',$remisistatus)->with('userlist',$userlist)->with('insdata',$insdata)->with('term',$term);
    }


    public function remisiTRN(Request $request) {
      $name=Auth::user()->name;
        
      $jsondata = $request->input('jsondata'); 
      $insdata = $request->input('instabledata'); 

      Log::info("call proc_cmremisi_trn('".$jsondata."','".$insdata."','".$name."')"); 
      $transfer=DB::select("call proc_cmremisi_trn('".$jsondata."','".$insdata."','".$name."')");   
  
      return response()->json(array('msg'=> 'true'), 200);
    }

    public function  remisi(Request $request){
       
        $userlist=DB::select('select usr_id, concat(usr_firstname, " " ,usr_lastname, " - ", usr_position) tbuser, concat(usr_firstname, " " ,usr_lastname) usr_name , usr_position FROM tbuser');
        App::setlocale(session()->get('locale'));


        return view('remisi.remisi')->with(array( 'userlist'=>$userlist));
    }
    
    
}




