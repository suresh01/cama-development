<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use Log;
use DataTables;
use userpermission;
use App;

class ObjectionController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('dashboard');
    }

    public function objectionapprove(Request $request){
        $param_value = $request->input('param_value');
        $module = $request->input('module');
        $param = $request->input('param');
        $name=Auth::user()->name;
        //$param = $request->input('param');
        
       
        $register=DB::select("call proc_approvepropreg(".$param_value.",   '".$name."', '".$module."', '".$param."')");
   
        Log::info("call proc_approvepropreg('".$param_value."',    '".$name."','".$module."','')"); 

            
        return response()->json(array('checkdigit'=> 'succsess'), 200);
    }

    public static function objectionInfo($id){

      
        $objection = DB::select("select concat(ob_desc, ' ' ,ob_listyear)  objection from cm_objection where ob_id = ".$id);
        //Log::info($permission);
        foreach ($objection as $obj) {            
            $ojectiondetail = $obj->objection;                   
        }
       // Log::info($msg);
        return $ojectiondetail;
    }

    public function basket(Request $request){
        
        $term = DB::select("select vt_id termid, vt_name term from cm_appln_valterm");
        $basket = DB::select("select approval.tdi_value status,va_approvalstatus_id, va_id id, va_name l_group, va_vt_id termid, vt_name termaname, va_createby createby, DATE_FORMAT(va_createdate, '%d/%m/%Y') createdate, 
          va_updateby updateby, DATE_FORMAT(va_updatedate, '%d/%m/%Y') updatedate
          from cm_appln_val left join (SELECT * FROM tbdefitems where tdi_td_name = 'APROVALSTATUS') approval on approval.tdi_key = va_approvalstatus_id join cm_appln_valterm  on va_vt_id = vt_id  where va_approvalstatus_id in (12,13,14)     
           order by va_id  ");
        

        App::setlocale(session()->get('locale'));
        return view("objection.basket")->with(array('term'=> $term,'basket'=> $basket));
    }

    public function agenda(Request $request){
       // Log::info( DB::statement('call json_procedure( )'));        
        $term = DB::select("select vt_id termid, vt_name term from cm_appln_valterm");

        $agenda = DB::select("
select ob_id, vt_id,vt_name,ob_desc,ob_listyear,DATE_FORMAT(ob_meetingdate, '%d/%m/%Y') ob_meetingdate, DATE_FORMAT(ob_notis8date, '%d/%m/%Y') ob_notis8date,
ob_notis8hijridate,DATE_FORMAT(ob_notis9date, '%d/%m/%Y') ob_notis9date,
ob_notis9hijridate, DATE_FORMAT(ob_notis10date, '%d/%m/%Y') ob_notis10date,ob_notis10hijridate, DATE_FORMAT(ob_notis8printdate, '%d/%m/%Y') ob_notis8printdate,
DATE_FORMAT(ob_enforcedate, '%d/%m/%Y') ob_enforcedate  ,DATE_FORMAT(vt_termdate, '%d/%m/%Y') vt_termdate ,DATE_FORMAT(ob_vallistrevdate, '%d/%m/%Y') ob_vallistrevdate ,DATE_FORMAT(ob_noticeobjdate, '%d/%m/%Y') ob_noticeobjdate 
from cm_objection inner join cm_appln_valterm on vt_id = ob_vt_id
           ");    
        App::setlocale(session()->get('locale'));   

        return view("objection.meeting")->with(array('term'=> $term,'agenda'=> $agenda));
    }

    public function agendaTransaction(Request $request) {
        $jsondata = $request->input('jsondata');
        $name=Auth::user()->name;
        Log::info("call proc_cmobjection_trn('".$jsondata."','".$name."')"); 
        $response=DB::select("call proc_cmobjection_trn('".$jsondata."','".$name."')");
        return redirect('meeting');
    }

    public function objectionAgenda(Request $request){
        $id = $request->input('id');
        $term = $request->input('term');
        $objectiondetail = ObjectionController::objectionInfo($id);
        $agenda = DB::select("select ag_id, ag_ob_id, ag_siries, ag_desc, ob_desc, propcount.prop_count propcount, ob_listyear, noticecount.notice_count notice_count,            objtcount.objt_count object_count
            from cm_objection_agenda inner join cm_objection on ob_id = ag_ob_id
            left join (select count(*) prop_count, agd_ag_id from cm_objection_agendadetail group by agd_ag_id) propcount on agd_ag_id = ag_id
            left join (select count(*) notice_count, no_ob_id from cm_objection_notis group by no_ob_id) noticecount on no_ob_id = ob_id
            left join (select count(*) objt_count, ol_ob_id from cm_objection_objectionlist group by ol_ob_id) objtcount on ol_ob_id = ob_id where ag_ob_id =  ".$id);
        $agendacnt = DB::select("select count(*) agenda_count from cm_objection
        inner join cm_objection_agenda on ag_ob_id = ob_id  where ob_id =  ".$id);

        $notiscnt = DB::select("select count(*) notis_count from cm_objection
        inner join cm_objection_notis on no_ob_id = ob_id where ob_id =  ".$id);

        $objectioncnt = DB::select("select count(*) objection_count from cm_objection
        inner join cm_objection_objectionlist on ol_ob_id = ob_id where ob_id =  ".$id);

        $propcnt = DB::select("select count(*) property_count from cm_objection
        inner join cm_objection_agenda on ag_ob_id = ob_id
        inner join cm_objection_agendadetail on agd_ag_id = ag_id where ob_id =  ".$id);
        App::setlocale(session()->get('locale'));
        
        return view('objection.agenda')->with(array('term'=>$term, 'id'=>$id,'agenda' => $agenda,'objectioncnt'=> $objectioncnt,'propcnt'=> $propcnt,'notiscnt'=> $notiscnt,'agendacnt'=> $agendacnt,'objectiondetail'=> $objectiondetail));
    }

    public function objectionproperty(Request $request){
        $baskedid = $request->input('id');
        App::setlocale(session()->get('locale'));
        return view("objection.property")->with('id',$baskedid);
    }

    public function objectionBasket(Request $request){
        $term = $request->input('term');
        $id = $request->input('id');
       /* $basket = DB::select("select vd_id, va_vt_id, vd_accno, ag_siries, va_name, ob_listyear
        from cm_appln_valdetl inner join cm_appln_val on va_id = vd_va_id
        inner join cm_appln_valterm on vt_id = va_vt_id
        left join (select ag_siries,agd_vd_id,ob_listyear from cm_objection_agendadetail 
        inner join cm_objection_agenda on ag_id = agd_ag_id
        inner join cm_objection on ob_id = ag_ob_id) cm_objection_agendadetail on agd_vd_id = vd_id
        where va_approvalstatus_id in ('08','09') and va_vt_id =  ".$term);*/


        $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid   ,sd_keymainfield 
        from tbsearchdetail mtb where sd_se_id = "33" ');

        App::setlocale(session()->get('locale'));
        return view('objection.grab.basket')->with(array('term'=>$term,'id'=>$id, 'search' =>$search ));
    }

    public function objectionBasketTable(Request $request){
        
        ini_set('memory_limit', '2056M');
       // $baskedid = $request->input('id');
        $maxRow = 30;

        $id = $request->input('id');
        $term = $request->input('term');
       
        $isfilter = $request->input('filter');
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
                $filterquery  = ' and '. $filterquery ;
            }
            

        }
       // $filterquery = $term." ". $filterquery;
        
        Log::info("call proc_data_objection_agenda('".$term." ".$filterquery."')");

        $agendadataset = DB::select("call proc_data_objection_agenda('".$term." ".$filterquery."')");
        
        $datasetDetails = Datatables::collection($agendadataset)->make(true);
        
        return $datasetDetails;
    }

    public function grabNotice(Request $request){
        $term = $request->input('term');
        $id = $request->input('id');
        $type = $request->input('type');
        $property = DB::select("select vd_id, va_id, va_vt_id, vd_accno, va_name, vt_name, case when ob_desc is null then 'New Notice' else 'Notice Added' end as ob_desc
        from cm_appln_valdetl inner join cm_appln_val on va_id = vd_va_id
        inner join cm_appln_valterm on vt_id = va_vt_id                           
        left join (select no_vd_id,ob_listyear, ob_desc from cm_objection_notis 
        inner join cm_objection on ob_id = no_ob_id) cm_objection_notice on no_vd_id = vd_id        
        where va_approvalstatus_id in ('08')  and va_vt_id =  ".$term);

        App::setlocale(session()->get('locale'));

        return view('objection.grab.notice')->with(array('term'=>$term,'property'=>$property,'id'=>$id,'type'=>$type));
    }
    

     public function objectionDetail(Request $request){
        $term = $request->input('term');
        $id = $request->input('id');    


        $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid   ,sd_keymainfield 
        from tbsearchdetail mtb where sd_se_id = "34" ');

        App::setlocale(session()->get('locale'));
        return view('objection.popup.property')->with(array('term'=>$term,'search'=>$search,'id'=>$id));
    }

    public function objectionDetailTable(Request $request){
        
        ini_set('memory_limit', '2056M');
       // $baskedid = $request->input('id');
        $maxRow = 30;

        $id = $request->input('id');
       // $term = $request->input('term');
       
        $isfilter = $request->input('filter');
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
                $filterquery  = ' and '. $filterquery ;
            }
            

        }
       // $filterquery = $term." ". $filterquery;

        $basketdataset = DB::select("select  agd_id,ag_siries,agd_vd_id,vd_accno, va_name, ob_listyear from cm_objection_agendadetail 
        inner join cm_objection_agenda on ag_id = agd_ag_id 
        inner join cm_appln_valdetl on vd_id = agd_vd_id
        inner join cm_appln_val on va_id = vd_va_id
        inner join cm_masterlist on ma_id = vd_ma_id
        inner join tbdefitems subzone  on subzone.tdi_key = ma_subzone_id and tdi_td_name = 'SUBZONE'
        inner join cm_objection on ob_id = ag_ob_id where agd_ag_id = ".$id." ".$filterquery);
        
        /*Log::info("call proc_data_objection_agenda('".$term." ".$filterquery."')");

        $agendadataset = DB::select("call proc_data_objection_agenda('".$term." ".$filterquery."')");*/
        
        $datasetDetails = Datatables::collection($basketdataset)->make(true);
        
        return $datasetDetails;
    } 

    public function newNotice(Request $request){
        $id = $request->input('id');
        $term = $request->input('term');
        $objectiondetail = ObjectionController::objectionInfo($id);
        $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid   ,sd_keymainfield 
        from tbsearchdetail mtb where sd_se_id = "31" ');

       //  $property = DB::select('select no_id, no_vd_id, no_accno, ob_desc,ob_listyear FROM cm_objection_notis inner join cm_objection on ob_id = no_ob_id where ob_id = '.$id);
        $agendacnt = DB::select("select count(*) agenda_count from cm_objection
        inner join cm_objection_agenda on ag_ob_id = ob_id  where ob_id =  ".$id);

        $notiscnt = DB::select("select count(*) notis_count from cm_objection
        inner join cm_objection_notis on no_ob_id = ob_id where no_noticetype_id = 0 and ob_id =  ".$id);

        $objectioncnt = DB::select("select count(*) objection_count from cm_objection
        inner join cm_objection_objectionlist on ol_ob_id = ob_id where ob_id =  ".$id);

        $propcnt = DB::select("select count(*) property_count from cm_objection
        inner join cm_objection_agenda on ag_ob_id = ob_id
        inner join cm_objection_agendadetail on agd_ag_id = ag_id where ob_id =  ".$id);

        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
        
        App::setlocale(session()->get('locale'));
        return view('objection.newnotice')->with(array('term'=>$term,'id'=>$id,'objectioncnt'=> $objectioncnt,'propcnt'=> $propcnt,'notiscnt'=> $notiscnt,'agendacnt'=> $agendacnt,'objectiondetail'=> $objectiondetail))->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }


    public function notice(Request $request){
        $id = $request->input('id');
        $term = $request->input('term');
        $objectiondetail = ObjectionController::objectionInfo($id);
        $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid   ,sd_keymainfield 
        from tbsearchdetail mtb where sd_se_id = "31" ');



       //  $property = DB::select('select no_id, no_vd_id, no_accno, ob_desc,ob_listyear FROM cm_objection_notis inner join cm_objection on ob_id = no_ob_id where ob_id = '.$id);
        $agendacnt = DB::select("select count(*) agenda_count from cm_objection
        inner join cm_objection_agenda on ag_ob_id = ob_id  where ob_id =  ".$id);

        $notiscnt = DB::select("select count(*) notis_count from cm_objection
        inner join cm_objection_notis on no_ob_id = ob_id where no_noticetype_id = 1 and ob_id =  ".$id);

        $objectioncnt = DB::select("select count(*) objection_count from cm_objection
        inner join cm_objection_objectionlist on ol_ob_id = ob_id where ob_id =  ".$id);

        $propcnt = DB::select("select count(*) property_count from cm_objection
        inner join cm_objection_agenda on ag_ob_id = ob_id
        inner join cm_objection_agendadetail on agd_ag_id = ag_id where ob_id =  ".$id);

        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
        App::setlocale(session()->get('locale'));
        return view('objection.notice')->with(array('term'=>$term,'id'=>$id,'objectioncnt'=> $objectioncnt,'propcnt'=> $propcnt,'notiscnt'=> $notiscnt,'agendacnt'=> $agendacnt,'objectiondetail'=> $objectiondetail))->with('search',$search)->with('serverhost',$serverhost)->with('userlist',$userlist);
    }

    public function agendatrn(Request $request) {
        $jsondata = $request->input('jsondata');
        $term = $request->input('term');
        $id = $request->input('id');
        $name=Auth::user()->name;
        Log::info("call proc_cmobjection_agenda_trn('".$jsondata."','".$name."')"); 
        $response=DB::select("call proc_cmobjection_agenda_trn('".$jsondata."','".$name."')");
       // return redirect()->route('agenda', ['id' => $id, 'term' => $term]);
        return response()->json(array('data'=> 'succsess'), 200);// return redirect('agenda')->with('id', $id);
    }

    public function agendadetailtrn(Request $request) {
        //$param = $request->input('accounts');
        $input = $request->input();
        $accounts = $input['accounts'];
        $type = $request->input('type');
        //$basketid = $request->input('id');
        //$type = $request->input('type');
        $param = implode(",",$accounts);

        $objectionid = $request->input('id');
       // $id = $request->input('id');
        $name=Auth::user()->name;
        Log::info("call proc_objection_agendadetail_trn('".$param."','".$objectionid."','".$name.",@p_propcount,'".$type."')"); 
        $response=DB::select("call proc_objection_agendadetail_trn('".$param."','".$objectionid."','".$name."',@p_propcount,'".$type."')");
       // return redirect()->route('agenda', ['id' => $id, 'term' => $term]);
        $result=DB::select("select @p_propcount");
        Log::info($result);
        $data = array();
        foreach ($result as $obj) {
           $data[] = (array)$obj;  
           #or first convert it and then change its properties using 
           #an array syntax, it's up to you
        }
        foreach ($data as $obj1) {
        $count = $obj1['@p_propcount'];
           #or first convert it and then change its properties using 
           #an array syntax, it's up to you
        }
        return response()->json(array('data'=> 'succsess','newcount'=> $count), 200);// return redirect('agenda')->with('id', $id);
    }

    public function noticedetailtrn(Request $request) {
        //$param = $request->input('accounts');
        $input = $request->input();
        $accounts = $input['accounts'];
        //$basketid = $request->input('id');
        $type = $request->input('type');
        $noticetype = $request->input('noticetype');
        $param = implode(",",$accounts);

        $objectionid = $request->input('id');
       // $id = $request->input('id');
        $name=Auth::user()->name;
        Log::info("call proc_objection_notice_trn('".$param."','".$objectionid."','".$name.",@p_propcount,'".$type."','".$noticetype."')"); 
        $response=DB::select("call proc_objection_notice_trn('".$param."','".$objectionid."','".$name."',@p_propcount,'".$type."','".$noticetype."')");
        $result=DB::select("select @p_propcount");
        Log::info($result); 
        $data = array();
        foreach ($result as $obj) {
           $data[] = (array)$obj;  
           #or first convert it and then change its properties using 
           #an array syntax, it's up to you
        }
        foreach ($data as $obj1) {
        $count = $obj1['@p_propcount'];
           #or first convert it and then change its properties using 
           #an array syntax, it's up to you
        }
       // return redirect()->route('agenda', ['id' => $id, 'term' => $term]);
        return response()->json(array('data'=> 'succsess','newcount'=> $count), 200);// return redirect('agenda')->with('id', $id);
    }
    

    public function objectionReport(Request $request){
        $term = $request->input('term');
        $id = $request->input('id');
        $objectiondetail = ObjectionController::objectionInfo($id);
        $objectionlist = DB::select("select ol_vd_id, ol_id, ol_ob_id, ol_accno, ol_time, ol_reason, ol_valuerrecommend, subzone.tdi_value subzone, 
        subzone.tdi_parent_name zone, vt_proposednt, vt_proposedrate, vt_proposedtax, vt_approvedtax, vt_approvednt
        from cm_objection_objectionlist
        inner join cm_appln_valdetl on vd_id = ol_vd_id
        inner join cm_appln_val_tax on vt_vd_id = vd_id
        inner join cm_masterlist on ma_id = vd_ma_id
        left join (select tdi_key , tdi_value, tdi_parent_key, tdi_parent_name  from tbdefitems where tdi_td_name = 'SUBZONE')  subzone
        on ma_subzone_id = subzone.tdi_key 
            where ol_ob_id = ".$id);


        $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid   ,sd_keymainfield 
        from tbsearchdetail mtb where sd_se_id = "35" ');

        $meetingroom =DB::select('select tdi_value from tbdefitems where tdi_td_name = "MEETINGROOM"');
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser FROM tbuser');
        $agendacnt = DB::select("select count(*) agenda_count from cm_objection
        inner join cm_objection_agenda on ag_ob_id = ob_id  where ob_id =  ".$id);

        $notiscnt = DB::select("select count(*) notis_count from cm_objection
        inner join cm_objection_notis on no_ob_id = ob_id where ob_id =  ".$id);

        $objectioncnt = DB::select("select count(*) objection_count from cm_objection
        inner join cm_objection_objectionlist on ol_ob_id = ob_id where ob_id =  ".$id);

        $propcnt = DB::select("select count(*) property_count from cm_objection
        inner join cm_objection_agenda on ag_ob_id = ob_id
        inner join cm_objection_agendadetail on agd_ag_id = ag_id where ob_id =  ".$id);
        
        App::setlocale(session()->get('locale'));
        return view('objection.objectionreport')->with(array('term'=>$term,'id'=>$id,'objectionlist'=>$objectionlist,'meetingroom'=>$meetingroom,'userlist'=>$userlist,'objectioncnt'=> $objectioncnt,'propcnt'=> $propcnt,'notiscnt'=> $notiscnt,'agendacnt'=> $agendacnt,'objectiondetail'=> $objectiondetail,'search'=> $search));
    }

    public function objectionReportTable(Request $request){
        
        ini_set('memory_limit', '2056M');
       // $baskedid = $request->input('id');
        $maxRow = 30;

        $id = $request->input('id');
       // $term = $request->input('term');
       
        $isfilter = $request->input('filter');
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
                $filterquery  = ' and '. $filterquery ;
            }
            

        }
       // $filterquery = $term." ". $filterquery;

        $objectionlistdataset = DB::select("select vd_id,ol_vd_id, ol_id, ol_ob_id, ol_accno, ol_time, ol_reason, format(ol_valuerrecommend, 2) ol_valuerrecommend, subzone.tdi_value subzone, 
        subzone.tdi_parent_name zone, format(vt_proposednt, 2) vt_proposednt, format(vt_proposedrate, 2) vt_proposedrate,
 format(vt_proposedtax, 2) vt_proposedtax, format(vt_approvedtax, 2) vt_approvedtax, format(vt_approvednt, 2) vt_approvednt,
 format(vl_roundnetlandvalue,2) landvalue, format(vb_roundnetnt,2) bldgvalue, (vt_approvednt - vt_proposednt) diff,
  (((vt_approvednt - vt_proposednt)/vt_proposednt)*100) percentage
from cm_objection_objectionlist
inner join cm_appln_valdetl on vd_id = ol_vd_id
inner join cm_appln_val_tax on vt_vd_id = vd_id
LEFT JOIN `cm_appln_val_lot` ON vl_vd_id = `cm_appln_valdetl`.`vd_id`
LEFT JOIN `cm_appln_val_bldg` ON vb_vd_id = `cm_appln_valdetl`.`vd_id`
inner join cm_masterlist on ma_id = vd_ma_id
left join (select tdi_key , tdi_value, tdi_parent_key, tdi_parent_name  from tbdefitems where tdi_td_name = 'SUBZONE')  subzone
on ma_subzone_id = subzone.tdi_key
            where ol_ob_id = ".$id." ".$filterquery);
        
        /*Log::info("call proc_data_objection_agenda('".$term." ".$filterquery."')");

        $agendadataset = DB::select("call proc_data_objection_agenda('".$term." ".$filterquery."')");*/
        
        $datasetDetails = Datatables::collection($objectionlistdataset)->make(true);
        
        return $datasetDetails;
    }

    public function objectionReportSearch(Request $request){
        $term = $request->input('term');
        $id = $request->input('id');
        
       /* $property = DB::select("select agd_id, ag_ob_id, agd_vd_id, vd_accno, ag_siries from cm_objection_agendadetail  inner join cm_objection_agenda on
            ag_id = agd_ag_id inner join cm_appln_valdetl on vd_id = agd_vd_id where ag_ob_id =  ".$id);*/

        $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid   ,sd_keymainfield 
        from tbsearchdetail mtb where sd_se_id = "36" ');

         $property = DB::select("select vd_id, va_id, va_vt_id, vd_accno, va_name, vt_name, ob_desc
            from cm_appln_valdetl inner join cm_appln_val on va_id = vd_va_id
            inner join cm_appln_valterm on vt_id = va_vt_id
            left join (select ob_id,ob_desc, ol_vd_id from cm_objection_objectionlist 
            inner join cm_objection on ob_id = ol_ob_id) cm_objection_objectionlist on ol_vd_id = vd_id
            where va_approvalstatus_id in ('08','09') AND va_vt_id = ".$term);

        App::setlocale(session()->get('locale'));
        return view('objection.grab.objectionlist')->with(array('term'=>$term,'id'=>$id,'property'=>$property,'search'=>$search));
    }

    public function objectionReportSearchTable(Request $request){
        ini_set('memory_limit', '2056M');
       // $baskedid = $request->input('id');
        $maxRow = 30;

        $id = $request->input('id');
        $term = $request->input('term');
       
        $isfilter = $request->input('filter');
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
                $filterquery  = ' and '. $filterquery ;
            }
            

        }
       // $filterquery = $term." ". $filterquery;

        $objectionlistdataset = DB::select("select vd_id, va_id, va_vt_id, vd_accno, va_name, vt_name, ob_desc
            from cm_appln_valdetl inner join cm_appln_val on va_id = vd_va_id
            inner join cm_appln_valterm on vt_id = va_vt_id
            inner join cm_masterlist on ma_id = vd_ma_id
            left join (select ob_id,ob_desc, ol_vd_id from cm_objection_objectionlist 
            inner join cm_objection on ob_id = ol_ob_id) cm_objection_objectionlist on ol_vd_id = vd_id
            inner join tbdefitems subzone  on subzone.tdi_key = ma_subzone_id and tdi_td_name = 'SUBZONE'
            where va_approvalstatus_id in ('08','09') AND va_vt_id = ".$term."  ".$filterquery);
        
        /*Log::info("call proc_data_objection_agenda('".$term." ".$filterquery."')");

        $agendadataset = DB::select("call proc_data_objection_agenda('".$term." ".$filterquery."')");*/
        
        $datasetDetails = Datatables::collection($objectionlistdataset)->make(true);
        
        return $datasetDetails;;
    }

    public function objectionReportTrn(Request $request){
        $input = $request->input();
        $accounts = $input['accounts'];
        $objectionid = $request->input('id');
       
        $type = $request->input('type');
        $accounts = implode(",",$accounts);
        $name=Auth::user()->name;
        //$sql = 'call proc_grabdata("'.$accounts.'",1)';

        Log::info("call proc_objection_objectionlist_trn('".$accounts."','".$name."',@p_newprop,'".$type."',".$objectionid.")");
        $search=DB::select("call proc_objection_objectionlist_trn('".$accounts."','".$name."',@p_newprop,'".$type."',".$objectionid.")"); 
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

     public function objectionReporTrn(Request $request){
        $jsondata = $request->input('jsondata');
        $name=Auth::user()->name;
        //$sql = 'call proc_grabdata("'.$accounts.'",1)';

        Log::info("call proc_objection_objectionlist_trn('".$jsondata."','".$name."',@p_newprop,'update',0)");
        $search=DB::select("call proc_objection_objectionlist_trn('".$jsondata."','".$name."',@p_newprop,'update',0)"); 
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

    public function decision(Request $request){
        $term = $request->input('term');
        $id = $request->input('id');
        $objectiondetail = ObjectionController::objectionInfo($id);
        $objectionlist = DB::select(" select vd_id,de_id, de_ob_id, de_accno, ol_time, ol_reason, format(ol_valuerrecommend, 2) ol_valuerrecommend,  va_name,
    vt_approvedrate,vt_adjustment,  vd_accno, vd_id, format(vt_proposednt,2) vt_proposednt, format(vt_proposedrate, 2) vt_proposedrate, format(vt_proposedtax, 2) vt_proposedtax, format(vt_approvedtax, 2) vt_approvedtax, format(vt_approvednt, 2) vt_approvednt, subzone.tdi_value subzone, subzone.tdi_parent_name zone, ap_bldgstatus_id, proptype.tdi_value proptype, 
    proptype.tdi_parent_name propcategorty, vt_valuedescretion, vt_grossvalue, vt_calculatedrate, vt_note,
    format(vl_roundnetlandvalue,2) landvalue, format(vb_roundnetnt,2) bldgvalue, (vt_approvednt - vt_proposednt) diff,
  (((vt_approvednt - vt_proposednt)/vt_proposednt)*100) percentage
    from cm_objection_decision
    inner join cm_appln_valdetl on vd_id = de_vd_id
    inner join cm_appln_val_tax on vt_vd_id = vd_id
    inner join cm_appln_val on va_id = vd_va_id
    inner join cm_masterlist on ma_id = vd_ma_id
    inner join cm_appln_parameter on ap_vd_id  = vd_id 
    LEFT JOIN `cm_appln_val_lot` ON vl_vd_id = `cm_appln_valdetl`.`vd_id`
    LEFT JOIN `cm_appln_val_bldg` ON vb_vd_id = `cm_appln_valdetl`.`vd_id`
    left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = 'BULDINGTYPE') proptype
    on proptype.tdi_key = ap_propertytype_id
    left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'SUBZONE') subzone
    on subzone.`tdi_key` = ma_subzone_id
    left join cm_objection_objectionlist on ol_vd_id = vd_id and ol_ob_id = de_ob_id
                                    where de_ob_id = ".$id);


        $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid   ,sd_keymainfield 
        from tbsearchdetail mtb where sd_se_id = "37" ');

        $agendacnt = DB::select("select count(*) agenda_count from cm_objection
        inner join cm_objection_agenda on ag_ob_id = ob_id  where ob_id =  ".$id);

        $notiscnt = DB::select("select count(*) notis_count from cm_objection
        inner join cm_objection_notis on no_ob_id = ob_id where ob_id =  ".$id);

        $objectioncnt = DB::select("select count(*) objection_count from cm_objection
        inner join cm_objection_objectionlist on ol_ob_id = ob_id where ob_id =  ".$id);

        $propcnt = DB::select("select count(*) property_count from cm_objection
        inner join cm_objection_agenda on ag_ob_id = ob_id
        inner join cm_objection_agendadetail on agd_ag_id = ag_id where ob_id =  ".$id);            
        
        App::setlocale(session()->get('locale'));
        return view('objection.decision')->with(array('term'=>$term,'id'=>$id,'objectionlist'=>$objectionlist,'objectioncnt'=> $objectioncnt,'propcnt'=> $propcnt,'notiscnt'=> $notiscnt,'agendacnt'=> $agendacnt,'objectiondetail'=> $objectiondetail,'search'=> $search,));
    }


    public function decisionCalculation(Request $request){
        $prop_id = $request->input('id');
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
        

      
        return view('objection.valuation.valuation')->with(array('lot'=>$lot,'bldg'=>$bldg,'master' => $master,'tax' => $tax,'lotdetail' => $lotdetail,'lotarea' => $lotarea,'bldgar' => $bldgar,'allowance' => $allowance,'prop_id' => $prop_id,'additional' => $additional, 'viewparambasket' => $viewparambasket, 'viewparambasketstatus' => $viewparambasketstatus, 'viewparamterm' => $viewparamterm, 'termid' => $termid, 'accountnumber' => $accountnumber,
            'iseditable' => $iseditable,'pb'=>$pb));
           
       
        
    }

    public function decisionTable(Request $request){
        Log::info('Test');
        ini_set('memory_limit', '2056M');
       // $baskedid = $request->input('id');
        $maxRow = 30;

        $id = $request->input('id');
       
        $isfilter = $request->input('filter');
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
                $filterquery  = ' and '. $filterquery ;
            }
            Log::info($filterquery);

        }

        $property = DB::select("select de_id, de_ob_id, de_accno, ol_time, ol_reason, format(ol_valuerrecommend, 2) ol_valuerrecommend,  va_name,
    vt_approvedrate,vt_adjustment,  vd_accno, vd_id, format(vt_proposednt,2) vt_proposednt, format(vt_proposedrate, 2) vt_proposedrate, format(vt_proposedtax, 2) vt_proposedtax, format(vt_approvedtax, 2) vt_approvedtax, format(vt_approvednt, 2) vt_approvednt, subzone.tdi_value subzone, subzone.tdi_parent_name zone, ap_bldgstatus_id, proptype.tdi_value proptype, 
    proptype.tdi_parent_name propcategorty, vt_valuedescretion, vt_grossvalue, vt_calculatedrate, vt_note,
    format(vl_roundnetlandvalue,2) landvalue, format(vb_roundnetnt,2) bldgvalue, (vt_approvednt - vt_proposednt) diff,
  format((((vt_approvednt - vt_proposednt)/vt_proposednt)*100),2) percentage
    from cm_objection_decision
    inner join cm_appln_valdetl on vd_id = de_vd_id
    inner join cm_appln_val_tax on vt_vd_id = vd_id
    inner join cm_appln_val on va_id = vd_va_id
    inner join cm_masterlist on ma_id = vd_ma_id
    inner join cm_appln_parameter on ap_vd_id  = vd_id 
    LEFT JOIN `cm_appln_val_lot` ON vl_vd_id = `cm_appln_valdetl`.`vd_id`
    LEFT JOIN `cm_appln_val_bldg` ON vb_vd_id = `cm_appln_valdetl`.`vd_id`
    left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = 'BULDINGTYPE') proptype
    on proptype.tdi_key = ap_propertytype_id
    left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = 'SUBZONE') subzone
    on subzone.`tdi_key` = ma_subzone_id
    left join cm_objection_objectionlist on ol_vd_id = vd_id and ol_ob_id = de_ob_id
                                    where de_ob_id = ".$id." ". $filterquery);
        
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    public function decisionGrab(Request $request){
        $term = $request->input('term');
        $id = $request->input('id');


        $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid   ,sd_keymainfield 
        from tbsearchdetail mtb where sd_se_id = "38" ');

          
         $property = DB::select("select vd_id, va_id, va_vt_id, vd_accno, va_name, vt_name, ob_desc, if(ol_id>0,'Yes',null) objection
            from cm_appln_valdetl inner join cm_appln_val on va_id = vd_va_id
            inner join cm_appln_valterm on vt_id = va_vt_id
            inner join cm_masterlist on ma_id = vd_ma_id
            left join (select ol_id,ob_id,ob_desc, ol_vd_id from cm_objection_objectionlist 
            inner join cm_objection on ob_id = ol_ob_id) cm_objection_objectionlist on ol_vd_id = vd_id
            inner join tbdefitems subzone  on subzone.tdi_key = ma_subzone_id and tdi_td_name = 'SUBZONE'
            where va_approvalstatus_id in ('08','09') and vt_id =".$term." ");

        App::setlocale(session()->get('locale'));
        return view('objection.grab.decision')->with(array('term'=>$term,'id'=>$id,'property'=>$property,'search'=> $search));
    }

    public function decisionGrabTables(Request $request){
        Log::info('Test');
        ini_set('memory_limit', '2056M');
       // $baskedid = $request->input('id');
        $maxRow = 30;

        $id = $request->input('id');
        $term = $request->input('term');
       
        $isfilter = $request->input('filter');
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
                $filterquery  = ' and '. $filterquery ;
            }
            Log::info($filterquery);

        }

        $property = DB::select("select vd_id, va_id, va_vt_id, vd_accno, va_name, vt_name, ob_desc, if(ol_id>0,'Yes',null) objection
            from cm_appln_valdetl inner join cm_appln_val on va_id = vd_va_id
            inner join cm_appln_valterm on vt_id = va_vt_id
            inner join cm_masterlist on ma_id = vd_ma_id
            left join (select ol_id,ob_id,ob_desc, ol_vd_id from cm_objection_objectionlist 
            inner join cm_objection on ob_id = ol_ob_id) cm_objection_objectionlist on ol_vd_id = vd_id
            inner join tbdefitems subzone  on subzone.tdi_key = ma_subzone_id and tdi_td_name = 'SUBZONE'
            where va_approvalstatus_id in ('08','09')  ". $filterquery);
        
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }


    public function decisiongrabtrn(Request $request){
        $input = $request->input();
        $accounts = $input['accounts'];
        $objectionid = $request->input('id');
       
        $type = $request->input('type');
        $accounts = implode(",",$accounts);
        $name=Auth::user()->name;
        //$sql = 'call proc_grabdata("'.$accounts.'",1)';

        Log::info("call proc_objection_decision_trn('".$accounts."','".$name."',@p_newprop,'".$type."',".$objectionid.")");
        $search=DB::select("call proc_objection_decision_trn('".$accounts."','".$name."',@p_newprop,'".$type."',".$objectionid.")"); 
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

    public function result(Request $request){
        $term = $request->input('term');
        $id = $request->input('id');
        $objectiondetail = ObjectionController::objectionInfo($id);
        $objectionlist = DB::select("select de_id,de_vd_id, de_ob_id, de_accno, ol_time, ol_reason, ol_valuerrecommend, vt_approvednt,va_name, vd_approvalstatus_id, propertstatus.tdi_desc propertstatus,
        vt_approvedrate,vt_adjustment, vt_approvedtax, vd_accno, vd_id,vt_proposednt, vt_proposedrate, vt_proposedtax , subzone.tdi_value subzone, subzone.tdi_parent_name zone, ap_bldgstatus_id, proptype.tdi_value proptype, 
        proptype.tdi_parent_name propcategorty, vt_valuedescretion, vt_grossvalue, vt_calculatedrate, vt_note
        from cm_objection_decision
        inner join cm_appln_valdetl on vd_id = de_vd_id
        inner join cm_appln_val_tax on vt_vd_id = vd_id
        inner join cm_appln_val on va_id = vd_va_id
        inner join cm_masterlist on ma_id = vd_ma_id
        inner join cm_appln_parameter on ap_vd_id  = vd_id 
        left join (select tdi_key, tdi_value, tdi_parent_name from tbdefitems where tdi_td_name = 'BULDINGTYPE') proptype
        on proptype.tdi_key = ap_propertytype_id
        left join (select tdi_key, tdi_value,tdi_parent_name from tbdefitems where tdi_td_name = 'SUBZONE') subzone
        on subzone.`tdi_key` = ma_subzone_id
        left join cm_objection_objectionlist on ol_vd_id = vd_id and ol_ob_id = de_ob_id
        left join (select *  from tbdefitems where tdi_td_name = 'PROPERTYSTAGE') propertstatus
        on propertstatus.tdi_key = vd_approvalstatus_id 
        where de_ob_id = ".$id);
        
        $userlist=DB::select('select concat(usr_firstname, " " ,usr_lastname) tbuser, usr_id  FROM tbuser');
        $usr_position=DB::select('select concat(usr_position, " " ,usr_position2) usr_position, usr_id  FROM tbuser');
        $config=DB::select('select config_value serveradd from tbconfig where config_name = "host" ');
        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }

        $agendacnt = DB::select("select count(*) agenda_count from cm_objection
        inner join cm_objection_agenda on ag_ob_id = ob_id  where ob_id =  ".$id);

        $notiscnt = DB::select("select count(*) notis_count from cm_objection
        inner join cm_objection_notis on no_ob_id = ob_id where ob_id =  ".$id);

        $objectioncnt = DB::select("select count(*) objection_count from cm_objection
        inner join cm_objection_objectionlist on ol_ob_id = ob_id where ob_id =  ".$id);

        $propcnt = DB::select("select count(*) property_count from cm_objection
        inner join cm_objection_agenda on ag_ob_id = ob_id
        inner join cm_objection_agendadetail on agd_ag_id = ag_id where ob_id =  ".$id);
        
        App::setlocale(session()->get('locale'));
        
        return view('objection.result')->with(array('term'=>$term,'id'=>$id,'objectionlist'=>$objectionlist,'userlist'=>$userlist,'usr_position'=>$usr_position,'serverhost'=>$serverhost,'objectioncnt'=> $objectioncnt,'propcnt'=> $propcnt,'notiscnt'=> $notiscnt,'agendacnt'=> $agendacnt,'objectiondetail'=> $objectiondetail));
    }

    public function noticeTables(Request $request){
        Log::info('Test');
        ini_set('memory_limit', '2056M');
       // $baskedid = $request->input('id');
        $maxRow = 30;

        $id = $request->input('id');
        $type = $request->input('type');
       
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
        /* $property = DB::table('cm_appln_valdetl')->join('cm_masterlist', 'vd_ma_id', '=', 'ma_id')->leftJoin('cm_appln_val_tax', 'vd_id', '=', 'vt_vd_id')->leftJoin('tbdefitems_ishasbuilding', 'vd_ishasbuilding', '=', 'tbdefitems_ishasbuilding.tdi_key')->leftJoin('tbdefitems_bldgtype', 'vd_bldgtype_id', '=', 'tbdefitems_bldgtype.tdi_key')->leftJoin('tbdefitems_bldgstorey', 'vd_bldgstorey_id', '=', 'tbdefitems_bldgstorey.tdi_key')->select( 'vd_approvalstatus_id','vd_id', 'vd_va_id','ma_id', 'ma_pb_id', 'ma_fileno', 'ma_accno',
        'ma_addr_ln1', 'tbdefitems_ishasbuilding.tdi_value' ,
        'tbdefitems_bldgtype.tdi_value', 'tbdefitems_bldgstorey.tdi_value', 'tbdefitems_bldgtype.tdi_parent_name as bldgcategory',
        'vt_approvednt', 'vt_approvedtax', 'vt_proposedrate', 'vt_note')->where('vd_va_id', '=', $baskedid)->paginate(15);      */     
        
        $property = DB::select('select no_id, no_vd_id, no_accno, ob_desc,ob_listyear, ob_desc, va_name, vt_name
        FROM cm_objection_notis inner join cm_objection on ob_id = no_ob_id
        inner join cm_appln_valdetl on vd_id = no_vd_id
        inner join cm_appln_val on va_id = vd_va_id
        inner join cm_appln_valterm on vt_id = va_vt_id where  no_noticetype_id ='.$type.' and ob_id = '.$id.' '. $filterquery);
        
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

     public function decisionTrn(Request $request){
        $jsondata = $request->input('jsondata');
        $name=Auth::user()->name;
        //$sql = 'call proc_grabdata("'.$accounts.'",1)';
        $objectionid = $request->input('id');
       
        $type = $request->input('type');
       
        //$sql = 'call proc_grabdata("'.$accounts.'",1)';

       
        Log::info("call proc_objection_decision_trn('".$jsondata."','".$name."',@p_newprop,'".$type."',".$objectionid.")");
        $search=DB::select("call proc_objection_decision_trn('".$jsondata."','".$name."',@p_newprop,'".$type."',".$objectionid.")"); 
        
        return response()->json(array('data'=> 'true'), 200);
    }

    public function decisionapprove(Request $request){
        $id = $request->input('id');
        $name=Auth::user()->name;
         Log::info("call proc_objection_decision_trn('','".$name."',@p_newprop,'approve',".$id.")");
        $search=DB::select("call proc_objection_decision_trn('','".$name."',@p_newprop,'approve',".$id.")"); 
        return response()->json(array('data'=> 'true'), 200);
    }
    
    
}
