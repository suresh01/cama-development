<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use DB;
use App;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DataTables;

class CodeMaintenanceController extends Controller
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
    
    public function tenantRegistration(Request $request){
       
        $tenant = DB::select("select `te_id`, `te_applntype_id`, applntype, `te_type_id`, tenanttype, `te_no`, `te_name`, `te_addr_ln1`,
            `te_addr_ln2`, `te_addr_ln3`, `te_addr_ln4`,  `te_postcode`,  `te_state_id`, state,
            `te_citizen_id`, citizen,  `te_race_id`, race, 
            `te_activeind_id`, activeind,  `te_updateby`,  `te_updatedate`, te_phone_no, te_email_addr, te_approvaltestatus_id,approvalstatus
        FROM `cm_tenant`, (select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE') state,
        (select tdi_key citizen_id, tdi_value citizen from tbdefitems where tdi_td_name = 'CITIZEN') citizen,
        (select tdi_key race_id, tdi_value race from tbdefitems where tdi_td_name = 'RACE') race,
        (select tdi_key activeind_id, tdi_value activeind from tbdefitems where tdi_td_name = 'ACTIVEIND') activeind,
        (select tdi_key applntype_id, tdi_value applntype from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype,
        (select tdi_key tenanttype_id, tdi_value tenanttype from tbdefitems where tdi_td_name = 'RATEPAYERTYPE') tenanttype,
        (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = 'GENERALAPPROVAL') approval
        where te_state_id = state_id and te_citizen_id = citizen_id and te_race_id = race_id
        and te_activeind_id = activeind_id and te_applntype_id = applntype_id
        and te_type_id = tenanttype_id and approval_id = te_approvaltestatus_id
        and te_type_id = tenanttype_id");

        $search=DB::select(' select sd_key, sd_label, 
        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "25" ');
        
        $state = DB::select("select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE'");
        $citizen = DB::select("select tdi_key citizen_id, tdi_value citizen from tbdefitems where tdi_td_name = 'CITIZEN'");
        $race = DB::select("select tdi_key race_id, tdi_value race from tbdefitems where tdi_td_name = 'RACE'");
        $activeind = DB::select("select tdi_key activeind_id, tdi_value activeind from tbdefitems where tdi_td_name = 'ACTIVEIND'");       
        $applntype = DB::select("select tdi_key applntype_id, tdi_value applntype from tbdefitems where tdi_td_name = 'APPLICATIONTYPE'"); 
        $tenanttype = DB::select("select tdi_key tenanttype_id, tdi_value tenanttype from tbdefitems where tdi_td_name = 'RATEPAYERTYPE' ");

        App::setlocale(session()->get('locale'));

        return view("codemaintenance.tenantreg")->with(array('tenant'=> $tenant,'state'=> $state,'citizen'=> $citizen,'race'=> $race,'activeind'=> $activeind, 'applntype' => $applntype, 'tenanttype' => $tenanttype,'search'=> $search));
    }

     public function tenantTable(Request $request){
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

         $tenant = DB::select("select `te_id`, `te_applntype_id`, applntype, `te_type_id`, tenanttype, `te_no`, `te_name`, `te_addr_ln1`,
            `te_addr_ln2`, `te_addr_ln3`, `te_addr_ln4`,  `te_postcode`,  `te_state_id`, state,
            `te_citizen_id`, citizen,  `te_race_id`, race, 
            `te_activeind_id`, activeind,  `te_updateby`,  `te_updatedate`, te_phone_no, te_email_addr, te_approvaltestatus_id,approvalstatus
        FROM `cm_tenant`, (select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE') state,
        (select tdi_key citizen_id, tdi_value citizen from tbdefitems where tdi_td_name = 'CITIZEN') citizen,
        (select tdi_key race_id, tdi_value race from tbdefitems where tdi_td_name = 'RACE') race,
        (select tdi_key activeind_id, tdi_value activeind from tbdefitems where tdi_td_name = 'ACTIVEIND') activeind,
        (select tdi_key applntype_id, tdi_value applntype from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype,
        (select tdi_key tenanttype_id, tdi_value tenanttype from tbdefitems where tdi_td_name = 'RATEPAYERTYPE') tenanttype,
        (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = 'GENERALAPPROVAL') approval
        where te_state_id = state_id and te_citizen_id = citizen_id and te_race_id = race_id
        and te_activeind_id = activeind_id and te_applntype_id = applntype_id
        and te_type_id = tenanttype_id and approval_id = te_approvaltestatus_id
        and te_type_id = tenanttype_id "  .$filterquery  );

        $propertyDetails = Datatables::collection($tenant)->make(true);
   
        return $propertyDetails;
    }

    public function tenantRegistrationTransaction(Request $request){
        $jsondata = $request->input('jsondata');
        $type = $request->input('type');
        $name=Auth::user()->name;
        Log::info("call proc_cmtenant_trn('".$jsondata."','".$name."')"); 
        $response=DB::select("call proc_cmtenant_trn('".$jsondata."','".$name."')");
        if ($type == 'insadd'){
            return redirect('tenantSearch');
        }
        return redirect('tenant');
    }

    public function ratepayerRegistration(Request $request){
       
        $ratepayer = DB::select(" select `rp_id`, `rp_applntype_id`, applntype, `rp_type_id`, ratepayertype, `rp_no`, `rp_name`, `rp_addr_ln1`,
    `rp_addr_ln2`, `rp_addr_ln3`, `rp_addr_ln4`,  `rp_postcode`,  `rp_state_id`, state,
    `rp_citizen_id`, citizen,  `rp_race_id`, race, 
    `rp_activeind_id`, activeind,  `rp_updateby`,  `rp_updatedate`,rp_phone_no, rp_email_addr, rp_approvalrpstatus_id, approvalstatus
FROM `cm_ratepayer`, (select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE') state,
(select tdi_key citizen_id, tdi_value citizen from tbdefitems where tdi_td_name = 'CITIZEN') citizen,
(select tdi_key race_id, tdi_value race from tbdefitems where tdi_td_name = 'RACE') race,
(select tdi_key activeind_id, tdi_value activeind from tbdefitems where tdi_td_name = 'ACTIVEIND') activeind,
(select tdi_key applntype_id, tdi_value applntype from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype,
(select tdi_key ratepayertype_id, tdi_value ratepayertype from tbdefitems where tdi_td_name = 'RATEPAYERTYPE') ratepayertype,
        (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = 'GENERALAPPROVAL') approval
where rp_state_id = state_id and rp_citizen_id = citizen_id and rp_race_id = race_id
and rp_activeind_id = activeind_id and rp_applntype_id = applntype_id
and rp_type_id = ratepayertype_id and approval_id = rp_approvalrpstatus_id");
        
        $state = DB::select("select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = 'STATE'");
        $citizen = DB::select("select tdi_key citizen_id, tdi_value citizen from tbdefitems where tdi_td_name = 'CITIZEN'");
        $race = DB::select("select tdi_key race_id, tdi_value race from tbdefitems where tdi_td_name = 'RACE'");
        $activeind = DB::select("select tdi_key activeind_id, tdi_value activeind from tbdefitems where tdi_td_name = 'ACTIVEIND'");       
        $applntype = DB::select("select tdi_key applntype_id, tdi_value applntype from tbdefitems where tdi_td_name = 'APPLICATIONTYPE'"); 
        $ratepayertype = DB::select("select tdi_key ratepayertype_id, tdi_value ratepayertype from tbdefitems where tdi_td_name = 'RATEPAYERTYPE' ");

        App::setlocale(session()->get('locale'));
        
        return view("codemaintenance.ratepayer")->with(array('ratepayer'=> $ratepayer,'state'=> $state,'citizen'=> $citizen,'race'=> $race,'activeind'=> $activeind, 'applntype' => $applntype, 'ratepayertype' => $ratepayertype));
    }

    public function ratepayerRegistrationTransaction(Request $request){
        $jsondata = $request->input('jsondata');
        $type = $request->input('type');
        $name=Auth::user()->name;
        Log::info("call proc_cmratepayer_trn('".$jsondata."','".$name."')"); 
        $response=DB::select("call proc_cmratepayer_trn('".$jsondata."','".$name."')");
        if ($type == 'insadd'){
            return redirect('ratepayersearch');
        }
        return redirect('ratepayer');
    }

    public function getValidRatepayer(Request $request){
        $msg = "true";
        $applnid = $request->input('applnid');
        $typeid = $request->input('typeid');
        $number = $request->input('number');
        $page = $request->input('page');
//Log::info('select * from cm_ratepayer where rp_type_id = "'.$typeid.'" and rp_applntype_id = "'.$applnid.'" and rp_no = "'.$number.'"');
        if($page == "ratepayer"){

       
        $query=DB::select('select * from cm_ratepayer where rp_type_id = "'.$typeid.'" and rp_applntype_id = "'.$applnid.'"
        and rp_no = "'.$number.'"');
        } else {
             $query=DB::select('select * from cm_tenant where te_type_id = "'.$typeid.'" and te_applntype_id = "'.$applnid.'"
        and te_no = "'.$number.'"');
        }


        foreach ($query as $var) {            
            $msg = "false";
        }

        return response()->json(array('msg'=> $msg), 200);
    }

    public function evidentManagement(Request $request){
       
        $transaction = DB::select('select trans_id, trans_transtype_id, transtype.tdi_value transtype, trans_linkid, trans_lotcode_id, lotcode.tdi_value lotcode,trans_lotno, 
trans_titletype_id, titletype.tdi_value titletype, trans_titleno,
trans_transdate, trans_price, trans_duration, trans_addr_ln1, trans_addr_ln2, trans_addr_ln3, trans_addr_ln4, trans_postcode,
trans_city, trans_state_id, state.tdi_value state, trans_approvaltransstatus_id, approvalstatus
   from cm_transaction 
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE") lotcode on lotcode.tdi_key = trans_lotcode_id 
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE") titletype on titletype.tdi_key = trans_titletype_id
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TRANSACTIONTYPE") transtype on transtype.tdi_key = trans_transtype_id
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = trans_state_id
left join (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval on approval_id = trans_approvaltransstatus_id');

        $search=DB::select(' select sd_key, sd_label, 
        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  
        from tbsearchdetail mtb where sd_se_id = "26" ');
        
        $transtype = DB::select("select tdi_key, tdi_value from tbdefitems where tdi_td_name = 'TRANSACTIONTYPE' order by tdi_sort");
        $lotcode = DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE"');
        $titletype = DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE"');
        $state = DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE"');     

        App::setlocale(session()->get('locale'));
        
        return view("codemaintenance.transaction")->with(array('transaction'=> $transaction,'transtype'=> $transtype,'lotcode'=> $lotcode,'titletype'=> $titletype,'state'=> $state,'search'=> $search));
    }

    public function evidentTransaction(Request $request){
        $jsondata = $request->input('jsondata');
        $name=Auth::user()->name;
        Log::info("call proc_transaction_trn('".$jsondata."','".$name."')"); 
        $response=DB::select("call proc_transaction_trn('".$jsondata."','".$name."')");
        
        App::setlocale(session()->get('locale'));
        
        return redirect('evidentmgmt');
    }

    public function evidentDetail(Request $request){
        $accno = $request->input('accno');       
        $data=DB::select('select lo_lotcode_id, lo_no, lo_titletype_id, lo_titleno, ma_postcode, ma_addr_ln1,ma_addr_ln2,ma_addr_ln3,ma_addr_ln4, ma_city, ma_state_id 
from cm_masterlist inner join cm_lot
 on ma_id = LO_MA_ID  where ma_accno = '.$accno);

        return response()->json(array('detail',$data), 200);
    }


    public function toneBasket(Request $request){
       
        $basket = DB::select("select `tollist_id`, `tollis_year`, `tollis_enforceyear`, `tollis_desc`, `tollis_activeind_id`, status.tdi_value actstatus, `tollis_createby`, `tollis_createdate`,
`tollis_updateby`, DATE_FORMAT(`tollis_updatedate`, '%d/%m/%Y') `tollis_updatedate`, tollis_approvaltollisstatus_id, approvalstatus
FROM `cm_toneoflistbasket` 
left join (SELECT tdi_key, tdi_value FROM cama.tbdefitems where tdi_td_name = 'ACTIVEIND') status on `tollis_activeind_id` = status.tdi_key
left join (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = 'ACTIVEIND') approval on approval_id = tollis_approvaltollisstatus_id");
        
        $status = DB::select("select tdi_key, tdi_value FROM cama.tbdefitems where tdi_td_name = 'ACTIVEIND'");    

        App::setlocale(session()->get('locale'));
        
        return view("tol.basket")->with(array('basket'=> $basket,'status'=> $status));
    }

    public function toneBasketTransaction(Request $request){
        $jsondata = $request->input('jsondata');
        $name=Auth::user()->name;
        Log::info("call proc_tonebasket_trn('".$jsondata."','".$name."')"); 
        $response=DB::select("call proc_tonebasket_trn('".$jsondata."','".$name."')");
        return redirect('tonebasket');
    }

     public function taxBasket(Request $request){
       
        $basket = DB::select("select `trlist_id`, `trlist_year`, `trlist_enforceyear`, `trlist_desc`, `trlist_activeind_id`, status.tdi_value actstatus, `trlist_createby`, `trlist_createdate`,
`trlist_updateby`, DATE_FORMAT(`trlist_updatedate`, '%d/%m/%Y') `trlist_updatedate` FROM `cm_taxratelistbasket` 
left join (SELECT tdi_key, tdi_value FROM cama.tbdefitems where tdi_td_name = 'ACTIVEIND') status on `trlist_activeind_id` = status.tdi_key");
        
        $status = DB::select("select tdi_key, tdi_value FROM cama.tbdefitems where tdi_td_name = 'ACTIVEIND'");    

        App::setlocale(session()->get('locale'));
        
        return view("tol.ratebasket")->with(array('basket'=> $basket,'status'=> $status));
    }

    public function rateBasketTransaction(Request $request){
        $jsondata = $request->input('jsondata');
        $name=Auth::user()->name;
        Log::info("call proc_tonetaxbasket_trn('".$jsondata."','".$name."')"); 
        $response=DB::select("call proc_tonetaxbasket_trn('".$jsondata."','".$name."')");
        return redirect('ratebasket');
    }

    public function toneBLDG(Request $request){
       
        $bldg = DB::select('select `tbldg_id`, tollis_year,   `tbldg_tone_id`, subzone.tdi_parent_key zoneid,  subzone.tdi_parent_name zone,  `tbldg_subzon_id`, 
        subzone.tdi_value subzone,bldgtype.tdi_parent_key propcategory, bldgtype.tdi_parent_name category, `tbldg_proptype_id`, bldgtype.tdi_value bldgtype,   `tbldg_propstorey_id`,
        bldgstorey.tdi_value bldgstorey, `tbldg_areatype_id`, artype.tdi_value artype,   `tbldg_arealevel_id`,  arlvel.tdi_value arlvl,  `tbldg_areacategory_id`,  arcate.tdi_value arcategory,
           `tbldg_areause_id`, aruse.tdi_value aruse,
            `tbldg_value`,    `tbldg_createby`,    `tbldg_createdate`,   `tbldg_udpateby`,   trnstype.tdi_value trnstype,  tbldg_transtype_id, DATE_FORMAT(`tbldg_updatedate`, "%d/%m/%Y") tbldg_updatedate 
            , tbldg_approvalbldgstatus_id, approvalstatus
        FROM cm_toneoflistbasket, `cm_tone_building`
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey on bldgstorey.tdi_key = tbldg_propstorey_id
        left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype on bldgtype.tdi_key = tbldg_proptype_id 
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREATYPE") artype on artype.tdi_key = tbldg_areatype_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREACATEGORY") arcate on arcate.tdi_key = tbldg_areacategory_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREALEVEL") arlvel on arlvel.tdi_key = tbldg_arealevel_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAUSE") aruse on aruse.tdi_key = tbldg_areause_id
        left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone on subzone.tdi_key = tbldg_subzon_id
        left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "TRANSACTIONTYPE") trnstype on trnstype.tdi_key = tbldg_transtype_id
        left join (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval on approval_id = tbldg_approvalbldgstatus_id
        where tollist_id = tbldg_tone_id');

        $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid , sd_keymaintable , sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = "24" ');

        $totalcount = DB::table('cm_tone_building')->count('tbldg_id');

        $bldgcate=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGCATEGORY"');
        $bldgtype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGTYPE"');
        $bldgstore=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY"');
        $arlvl=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREALEVEL"');
        $arcaty=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREACATEGORY"');
        $artype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREATYPE"');
        $aruse=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAUSE"');
        $zone=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ZONE"');
        $subzone=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SUBZONE"'); 
        $trnstype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TRANSACTIONTYPE"'); 
        $basket=DB::select('select tollist_id, tollis_year, tollis_desc from cm_toneoflistbasket '); 
        
        App::setlocale(session()->get('locale'));
                    
        return view("tol.bldg")->with(array('bldg'=> $bldg,'bldgtype'=> $bldgtype,'bldgstore'=> $bldgstore,'arlvl'=> $arlvl ,'artype'=> $artype,'arcaty'=> $arcaty,'aruse'=> $aruse,'zone'=> $zone,'subzone'=> $subzone,'basket' => $basket,'bldgcate'=> $bldgcate,'trnstype'=> $trnstype,'search'=> $search,'totalcount'=> $totalcount));
    }




    public function tonebldgTable(Request $request){
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
                /*
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

         $bldg = DB::select('select `tbldg_id`, tollis_year,   `tbldg_tone_id`, subzone.tdi_parent_key zoneid,  subzone.tdi_parent_name zone,  `tbldg_subzon_id`, 
subzone.tdi_value subzone,bldgtype.tdi_parent_key propcategory, bldgtype.tdi_parent_name category, `tbldg_proptype_id`, bldgtype.tdi_value bldgtype,   `tbldg_propstorey_id`,
bldgstorey.tdi_value bldgstorey, `tbldg_areatype_id`, artype.tdi_value artype,   `tbldg_arealevel_id`,  arlvel.tdi_value arlvl,  `tbldg_areacategory_id`,  arcate.tdi_value arcategory,
   `tbldg_areause_id`, aruse.tdi_value aruse,
    `tbldg_value`,    `tbldg_createby`,    `tbldg_createdate`,   `tbldg_udpateby`,   trnstype.tdi_value trnstype,  tbldg_transtype_id, DATE_FORMAT(`tbldg_updatedate`, "%d/%m/%Y") tbldg_updatedate 
    , tbldg_approvalbldgstatus_id, approvalstatus
FROM cm_toneoflistbasket, `cm_tone_building`
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey on bldgstorey.tdi_key = tbldg_propstorey_id
left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype on bldgtype.tdi_key = tbldg_proptype_id 
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREATYPE") artype on artype.tdi_key = tbldg_areatype_id
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREACATEGORY") arcate on arcate.tdi_key = tbldg_areacategory_id
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREALEVEL") arlvel on arlvel.tdi_key = tbldg_arealevel_id
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAUSE") aruse on aruse.tdi_key = tbldg_areause_id
left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone on subzone.tdi_key = tbldg_subzon_id
left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "TRANSACTIONTYPE") trnstype on trnstype.tdi_key = tbldg_transtype_id
left join (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval on approval_id = tbldg_approvalbldgstatus_id
where tollist_id = tbldg_tone_id '  .$filterquery. ' 
ORDER BY 
CASE
WHEN tbldg_approvalbldgstatus_id = "1" THEN 1
WHEN tbldg_approvalbldgstatus_id = "2" THEN 2
WHEN tbldg_approvalbldgstatus_id = "5" THEN 3
WHEN tbldg_approvalbldgstatus_id = "4" THEN 4
 WHEN tbldg_approvalbldgstatus_id = "3" THEN 5
 WHEN tbldg_approvalbldgstatus_id = "6" THEN 5
END ASC, tbldg_updatedate'
  );

    /*  $property = DB::select('select ma_id,ma_accno, `cm_masterlist`.`ma_fileno`,ma_city, ma_postcode,
   `tbdefitems_subzone`.`tdi_parent_name` zone, `tbdefitems_subzone`.`tdi_value` subzone, ma_addr_ln3,
   `cm_masterlist`.`ma_addr_ln1`,`cm_masterlist`.`ma_addr_ln2`, owntype.tdi_value owntype, 
   `cm_owner`.`TO_OWNNAME`, `cm_owner`.`TO_OWNNO`,
   `cm_masterlist`.`ma_id`,
        `cm_masterlist`.`ma_pb_id`        
    FROM `cm_masterlist` 
    JOIN `cm_owner` ON `ma_id` = `TO_MA_ID`
    LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
    LEFT JOIN `tbdefitems` as owntype on `TO_OWNTYPE_ID` = `owntype`.`tdi_key` and owntype.tdi_td_name = "OWNTYPE"
     '.$filterquery .' limit 100');*/
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($bldg)->make(true);
   
        return $propertyDetails;
    }

     public function toneBLDGTransaction(Request $request){
        $jsondata = $request->input('jsondata');
        $name=Auth::user()->name;
        Log::info("call proc_tonebldg_trn('".$jsondata."','".$name."')"); 
        $response=DB::select("call proc_tonebldg_trn('".$jsondata."','".$name."')");
        return redirect('tonebldg');
    }


    public function toneLand(Request $request){
       
        $land = DB::select('select `tland_id`,`tland_tone_id`, tollis_year,   subzone.tdi_parent_key zoneid, subzone.tdi_parent_name zone,  `tland_ishasbuilding_id`,  hasbldg.tdi_value hasbldg,bldgtype.tdi_parent_key propcategory,  `tland_subzon_id`,   subzone.tdi_value subzone,
 `tland_proptype_id`,  bldgtype.tdi_value bldgtype, bldgtype.tdi_parent_name category,
`tland_propstorey_id`,    bldgstorey.tdi_value bldgstorey, `tland_value`,    `tland_createby`,    `tland_createdate`,    `tland_updateby`,
 DATE_FORMAT(`tland_updatedate`, "%d/%m/%Y") tland_updatedate, tland_approvaltlandstatus_id, approvalstatus
 from cm_toneoflistbasket, `cm_tone_land`
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ISHASBUILDING") hasbldg  on hasbldg.tdi_key = tland_ishasbuilding_id
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey on bldgstorey.tdi_key = tland_propstorey_id
left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype on bldgtype.tdi_key = tland_proptype_id 
left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone on subzone.tdi_key = tland_subzon_id
left join (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval on approval_id = tland_approvaltlandstatus_id
where tollist_id = tland_tone_id');

        $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  , sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = "28" ');

        $totalcount = DB::table('cm_tone_land')->count();

        $bldgtype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGTYPE"');
        $bldgstore=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY"');
        $hasbldg=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ISHASBUILDING"');
        $zone=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ZONE"');
        $subzone=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SUBZONE"'); 
        $basket=DB::select('select tollist_id, tollis_year, tollis_desc from cm_toneoflistbasket '); 
        $bldgcate=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGCATEGORY"');
        
        App::setlocale(session()->get('locale'));
        
            
        return view("tol.land")->with(array('land'=> $land,'bldgtype'=> $bldgtype,'bldgstore'=> $bldgstore,'bldgstore'=> $bldgstore ,'zone'=> $zone,'subzone'=> $subzone,'basket' => $basket,'hasbldg' => $hasbldg,'bldgcate' => $bldgcate,'search'=> $search, 'totalcount' => $totalcount));
    }


     public function tonelandTable(Request $request){
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

        $bldg = DB::select('select `tland_id`,`tland_tone_id`, tollis_year,   subzone.tdi_parent_key zoneid, subzone.tdi_parent_name zone,  `tland_ishasbuilding_id`,  hasbldg.tdi_value hasbldg,bldgtype.tdi_parent_key propcategory,  `tland_subzon_id`,   subzone.tdi_value subzone,
 `tland_proptype_id`,  bldgtype.tdi_value bldgtype, bldgtype.tdi_parent_name category,
`tland_propstorey_id`,    bldgstorey.tdi_value bldgstorey, `tland_value`,    `tland_createby`,    `tland_createdate`,    `tland_updateby`,
 DATE_FORMAT(`tland_updatedate`, "%d/%m/%Y") tland_updatedate, tland_approvaltlandstatus_id, approvalstatus
 from cm_toneoflistbasket, `cm_tone_land`
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ISHASBUILDING") hasbldg  on hasbldg.tdi_key = tland_ishasbuilding_id
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey on bldgstorey.tdi_key = tland_propstorey_id
left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype on bldgtype.tdi_key = tland_proptype_id 
left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone on subzone.tdi_key = tland_subzon_id
left join (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval on approval_id = tland_approvaltlandstatus_id
where tollist_id = tland_tone_id'  .$filterquery . '
ORDER BY 
CASE
WHEN tland_approvaltlandstatus_id = "1" THEN 1
WHEN tland_approvaltlandstatus_id = "2" THEN 2
WHEN tland_approvaltlandstatus_id = "5" THEN 3
WHEN tland_approvaltlandstatus_id = "4" THEN 4
 WHEN tland_approvaltlandstatus_id = "3" THEN 5
 WHEN tland_approvaltlandstatus_id = "6" THEN 5
END ASC, tland_updatedate
'  );

    /*  $property = DB::select('select ma_id,ma_accno, `cm_masterlist`.`ma_fileno`,ma_city, ma_postcode,
   `tbdefitems_subzone`.`tdi_parent_name` zone, `tbdefitems_subzone`.`tdi_value` subzone, ma_addr_ln3,
   `cm_masterlist`.`ma_addr_ln1`,`cm_masterlist`.`ma_addr_ln2`, owntype.tdi_value owntype, 
   `cm_owner`.`TO_OWNNAME`, `cm_owner`.`TO_OWNNO`,
   `cm_masterlist`.`ma_id`,
        `cm_masterlist`.`ma_pb_id`        
    FROM `cm_masterlist` 
    JOIN `cm_owner` ON `ma_id` = `TO_MA_ID`
    LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
    LEFT JOIN `tbdefitems` as owntype on `TO_OWNTYPE_ID` = `owntype`.`tdi_key` and owntype.tdi_td_name = "OWNTYPE"
     '.$filterquery .' limit 100');*/
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($bldg)->make(true);
   
        return $propertyDetails;
    }

    public function toneLandTransaction(Request $request){
        $jsondata = $request->input('jsondata');
        $name=Auth::user()->name;
        Log::info("call proc_toneland_trn('".$jsondata."','".$name."')"); 
        $response=DB::select("call proc_toneland_trn('".$jsondata."','".$name."')");
        return redirect('toneland');
    }


    public function toneAllowance(Request $request){
       
        $allowance = DB::select('select `tallo_id`, tollis_year,   `tallo_tone_id`, alltype.tdi_parent_key allcategory, alltype.tdi_parent_name allcategoryname,  `tallo_allowancetype_id`,alltype.tdi_value alltype,  `tallo_buldingcategory_id`, bldgate.tdi_value bldgate,
    `tallo_value`,    `tallo_factor`,    `tallo_createby`,    `tallo_createdate`,   `tallo_updateby`,    DATE_FORMAT(`tallo_updatedate`, "%d/%m/%Y") `tallo_updatedate`
    , approvalstatus, tallo_approvaltallostatus_id
    FROM cm_toneoflistbasket,`cm_tone_bldg_allowances`
    left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGCATEGORY") bldgate on bldgate.tdi_key = tallo_buldingcategory_id
    left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "ALLOWANCETYPE") alltype
    on alltype.tdi_key = tallo_allowancetype_id 
    left join (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval on approval_id = tallo_approvaltallostatus_id
    where tollist_id = tallo_tone_id');

        $bldgcate=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGCATEGORY"');
        $basket=DB::select('select tollist_id, tollis_year, tollis_desc from cm_toneoflistbasket '); 
        $allowancecate=DB::select('select * from tbdefitems where tdi_td_name = "ALLOWANCECATEGORY"');
        $allowancetype=DB::select('select * from tbdefitems where tdi_td_name = "ALLOWANCETYPE" '); 
        
        App::setlocale(session()->get('locale'));
        
        return view("tol.allowance")->with(array('allowance'=> $allowance,'bldgcate'=> $bldgcate,'basket' => $basket,'allowancecate' => $allowancecate,'allowancetype' => $allowancetype));
    }

    public function toneAllowanceTransaction(Request $request){
        $jsondata = $request->input('jsondata');
        $name=Auth::user()->name;
        Log::info("call proc_toneallowance_trn('".$jsondata."','".$name."')"); 
        $response=DB::select("call proc_toneallowance_trn('".$jsondata."','".$name."')");
        return redirect('toneallowance');
    }


    public function toneDepreciation(Request $request){
        
        $result = DB::select('select `tdepre_id`,  tollis_year,  `tdepre_tone_id`,    `tdepre_bldgcondn_id`,  bldgcond.tdi_value bldgcond, `tdepre_value`,    `tdepre_createby`,
    `tdepre_createdate`,    `tdepre_updateby`,   DATE_FORMAT(`tdepre_updatedate`, "%d/%m/%Y") `tdepre_updatedate`, tdepre_approvaltdeprestatus_id, approvalstatus
FROM cm_toneoflistbasket
inner join `cm_tone_bldg_depreciation` on  tollist_id = tdepre_tone_id
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGCONDN") bldgcond on bldgcond.tdi_key = tdepre_bldgcondn_id
left join (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval on approval_id = tdepre_approvaltdeprestatus_id');

        $bldgcond=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGCONDN"'); 
        $basket=DB::select('select tollist_id, tollis_year, tollis_desc from cm_toneoflistbasket '); 
        
        App::setlocale(session()->get('locale'));
        
        return view("tol.depreciation")->with(array('result'=> $result,'bldgcond'=> $bldgcond,'basket' => $basket));
    }

    public function toneDepreciationTransaction(Request $request){
        $jsondata = $request->input('jsondata');
        $name=Auth::user()->name;
        Log::info("call proc_tonedepreciation_trn('".$jsondata."','".$name."')"); 
        $response=DB::select("call proc_tonedepreciation_trn('".$jsondata."','".$name."')");
        return redirect('tonedepreciation');
    }

    public function tonelandstandart(Request $request){
       
        $result = DB::select('select `tstand_id`, tollis_year,   `tstand_tone_id`, subzone.tdi_parent_key zoneid,  subzone.tdi_parent_name zone, 
 `tstand_subzon_id`,  subzone.tdi_value  subzone,  `tstand_proptype_id`,
bldgtype.tdi_value  bldgtype,bldgtype.tdi_parent_key propcategory, bldgtype.tdi_parent_name category,
    `tstand_propstorey_id`,   bldgstorey.tdi_value  bldgstorey, `tstand_standartarea`,    `tstand_nextarea`,   `tstand_maxlevel`,
    `tstand_createby`,    `tstand_createdate`,    `tstand_updateby`,   DATE_FORMAT(`tstand_updatedate`, "%d/%m/%Y")  `tstand_updatedate`
FROM cm_toneoflistbasket, `cm_tone_land_standart`
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey on bldgstorey.tdi_key = tstand_propstorey_id
left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype on bldgtype.tdi_key = tstand_proptype_id 
left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone on subzone.tdi_key = tstand_subzon_id
where tollist_id = tstand_tone_id');

        $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  , sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = "29" ');

        $totalcount = DB::table('cm_tone_land_standart')->count();

        
        $bldgcate=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGCATEGORY"');
        $bldgtype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGTYPE"');
        $bldgstore=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY"');
        $zone=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ZONE"');
        $subzone=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SUBZONE"'); 
        $basket=DB::select('select tollist_id, tollis_year, tollis_desc from cm_toneoflistbasket '); 
        
        App::setlocale(session()->get('locale'));
        
        return view("tol.landstandart")->with(array('result'=> $result,'bldgtype'=> $bldgtype,'bldgcate'=> $bldgcate,'bldgstore'=> $bldgstore,'zone'=> $zone,'subzone'=> $subzone,'basket' => $basket,'search'=> $search,'totalcount'=> $totalcount));
    }


     public function tonelandsdTable(Request $request){
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

         $bldg = DB::select('select `tstand_id`, tollis_year,   `tstand_tone_id`, subzone.tdi_parent_key zoneid,  subzone.tdi_parent_name zone, 
 `tstand_subzon_id`,  subzone.tdi_value  subzone,  `tstand_proptype_id`,
bldgtype.tdi_value  bldgtype,bldgtype.tdi_parent_key propcategory, bldgtype.tdi_parent_name category,
    `tstand_propstorey_id`,   bldgstorey.tdi_value  bldgstorey, `tstand_standartarea`,    `tstand_nextarea`,   `tstand_maxlevel`,
    `tstand_createby`,    `tstand_createdate`,    `tstand_updateby`,   DATE_FORMAT(`tstand_updatedate`, "%d/%m/%Y")  `tstand_updatedate`
    , approvalstatus, tstand_approvaltstandstatus_id
FROM cm_toneoflistbasket, `cm_tone_land_standart`
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey on bldgstorey.tdi_key = tstand_propstorey_id
left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype on bldgtype.tdi_key = tstand_proptype_id 
left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") subzone on subzone.tdi_key = tstand_subzon_id
left join (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval on approval_id = tstand_approvaltstandstatus_id
where tollist_id = tstand_tone_id '  .$filterquery . '
ORDER BY 
CASE
WHEN tstand_approvaltstandstatus_id = "1" THEN 1
WHEN tstand_approvaltstandstatus_id = "2" THEN 2
WHEN tstand_approvaltstandstatus_id = "5" THEN 3
WHEN tstand_approvaltstandstatus_id = "4" THEN 4
 WHEN tstand_approvaltstandstatus_id = "3" THEN 5
 WHEN tstand_approvaltstandstatus_id = "6" THEN 5
END ASC, tstand_updatedate'  );

    /*  $property = DB::select('select ma_id,ma_accno, `cm_masterlist`.`ma_fileno`,ma_city, ma_postcode,
   `tbdefitems_subzone`.`tdi_parent_name` zone, `tbdefitems_subzone`.`tdi_value` subzone, ma_addr_ln3,
   `cm_masterlist`.`ma_addr_ln1`,`cm_masterlist`.`ma_addr_ln2`, owntype.tdi_value owntype, 
   `cm_owner`.`TO_OWNNAME`, `cm_owner`.`TO_OWNNO`,
   `cm_masterlist`.`ma_id`,
        `cm_masterlist`.`ma_pb_id`        
    FROM `cm_masterlist` 
    JOIN `cm_owner` ON `ma_id` = `TO_MA_ID`
    LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
    LEFT JOIN `tbdefitems` as owntype on `TO_OWNTYPE_ID` = `owntype`.`tdi_key` and owntype.tdi_td_name = "OWNTYPE"
     '.$filterquery .' limit 100');*/
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($bldg)->make(true);
   
        return $propertyDetails;
    }

    public function tonelandstandartTransaction(Request $request){
        $jsondata = $request->input('jsondata');
        $name=Auth::user()->name;
        Log::info("call proc_tonelandstandart_trn('".$jsondata."','".$name."')"); 
        $response=DB::select("call proc_tonelandstandart_trn('".$jsondata."','".$name."')");
        return redirect('tonelandstandart');
    }


     public function taxrate(Request $request){
        
        $taxrate = DB::select('select `trate_id`,    `trate_trlist_id`, trlist_year,   `trate_zon_id`, zone.tdi_value zone,   `trate_ishasbuilding_id`, hasbldg.tdi_value hasbldg,
                `trate_proptype_id`,  bldgtype.tdi_value bldgtype, bldgtype.tdi_parent_key propcategory, bldgtype.tdi_parent_name category,  `trate_value`,    `trate_createby`,    `trate_createdate`,
                `trate_updateby`,    DATE_FORMAT(`trate_updatedate`, "%d/%m/%Y") `trate_updatedate`, trate_approvaltratestatus_id, approvalstatus
            FROM cm_taxratelistbasket, `cm_tone_taxrate` 
            left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype on bldgtype.tdi_key = trate_proptype_id 
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ZONE") zone on zone.tdi_key = trate_zon_id
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ISHASBUILDING") hasbldg on hasbldg.tdi_key = trate_ishasbuilding_id
left join (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval on approval_id = trate_approvaltratestatus_id
            where trlist_id = trate_trlist_id
            ');

        $search=DB::select(' select sd_key, sd_label,  
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid , sd_keymaintable, sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = "30" ');

        $totalcount = DB::table('cm_tone_land_standart')->count();

        $bldgtype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGTYPE"');
        $zone=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ZONE"');
        $hasbldg=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ISHASBUILDING"');
        $basket=DB::select('select trlist_id, trlist_year,trlist_desc from cm_taxratelistbasket '); 
        $bldgcate=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGCATEGORY"');
        
        App::setlocale(session()->get('locale'));
        
        return view("tol.taxrate")->with(array('taxrate'=> $taxrate,'bldgtype'=> $bldgtype,'zone'=> $zone,'hasbldg'=> $hasbldg,'basket' => $basket,'bldgcate' => $bldgcate,'search'=> $search,'totalcount'=> $totalcount));
    }


     public function tonetaxTable(Request $request){
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

         $bldg = DB::select('select `trate_id`,    `trate_trlist_id`, trlist_year,   `trate_zon_id`, zone.tdi_value zone,   `trate_ishasbuilding_id`, hasbldg.tdi_value hasbldg,
                `trate_proptype_id`,  bldgtype.tdi_value bldgtype, bldgtype.tdi_parent_key propcategory, bldgtype.tdi_parent_name category,  `trate_value`,    `trate_createby`,    `trate_createdate`,
                `trate_updateby`,    DATE_FORMAT(`trate_updatedate`, "%d/%m/%Y") `trate_updatedate`, trate_approvaltratestatus_id, approvalstatus
            FROM cm_taxratelistbasket, `cm_tone_taxrate` 
            left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype on bldgtype.tdi_key = trate_proptype_id 
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ZONE") zone on zone.tdi_key = trate_zon_id
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ISHASBUILDING") hasbldg on hasbldg.tdi_key = trate_ishasbuilding_id
left join (select tdi_key approval_id, tdi_value approvalstatus from tbdefitems where tdi_td_name = "GENERALAPPROVAL") approval on approval_id = trate_approvaltratestatus_id
            where trlist_id = trate_trlist_id
            '  .$filterquery . '
            ORDER BY 
            CASE
                WHEN trate_approvaltratestatus_id = "1" THEN 1
                WHEN trate_approvaltratestatus_id = "2" THEN 2
                WHEN trate_approvaltratestatus_id = "5" THEN 3
                WHEN trate_approvaltratestatus_id = "4" THEN 4
                WHEN trate_approvaltratestatus_id = "3" THEN 5
                WHEN trate_approvaltratestatus_id = "6" THEN 5
            END ASC, trate_updatedate'  );

    /*  $property = DB::select('select ma_id,ma_accno, `cm_masterlist`.`ma_fileno`,ma_city, ma_postcode,
   `tbdefitems_subzone`.`tdi_parent_name` zone, `tbdefitems_subzone`.`tdi_value` subzone, ma_addr_ln3,
   `cm_masterlist`.`ma_addr_ln1`,`cm_masterlist`.`ma_addr_ln2`, owntype.tdi_value owntype, 
   `cm_owner`.`TO_OWNNAME`, `cm_owner`.`TO_OWNNO`,
   `cm_masterlist`.`ma_id`,
        `cm_masterlist`.`ma_pb_id`        
    FROM `cm_masterlist` 
    JOIN `cm_owner` ON `ma_id` = `TO_MA_ID`
    LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
    LEFT JOIN `tbdefitems` as owntype on `TO_OWNTYPE_ID` = `owntype`.`tdi_key` and owntype.tdi_td_name = "OWNTYPE"
     '.$filterquery .' limit 100');*/
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($bldg)->make(true);
   
        return $propertyDetails;
    }

    public function taxrateTransaction(Request $request){
        $jsondata = $request->input('jsondata');
        $name=Auth::user()->name;
        Log::info("call proc_tonetaxrate_trn('".$jsondata."','".$name."')"); 
        $response=DB::select("call proc_tonetaxrate_trn('".$jsondata."','".$name."')");
        return redirect('taxrate');
    }
}

