<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DataTables;
use userpermission;
use App;

class PropertyRegisterationController extends Controller
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


    public function table(Request $request){

        $page = $request->input('type');
        $maxRow = $request->input('maxrow');
        $name = $request->input('name');     
        $pb = $request->input('pb_id');      
        $prop_id = $request->input('prop_id'); 


        if($page == 'table'){
            $zone=DB::table('tbdefitems')->where('tdi_td_name', "ZONE")->orderBy('tdi_sort')->pluck('tdi_value');
            $subzone=DB::table('tbdefitems')->where('tdi_td_name', "SUBZONE")->orderBy('tdi_sort')->pluck('tdi_value');
            //$subzone=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SUBZONE"'); 
        	$district=DB::table('tbdefitems')->where('tdi_td_name', "DISTRICT")->orderBy('tdi_sort')->pluck('tdi_value');
            $statedefault=DB::table('tbdefitems')->where('tdi_td_name', "STATEDEFAULT")->orderBy('tdi_sort')->pluck('tdi_value');
        	$bldgcate=DB::table('tbdefitems')->where('tdi_td_name', "BULDINGCATEGORY")->orderBy('tdi_sort')->pluck('tdi_value');
        	$state=DB::table('tbdefitems')->where('tdi_td_name', "STATE")->orderBy('tdi_sort')->pluck('tdi_value');
        	$ishasbuilding=DB::table('tbdefitems')->where('tdi_td_name', "ISHASBUILDING")->orderBy('tdi_sort')->pluck('tdi_value');
        	$lotcode=DB::table('tbdefitems')->where('tdi_td_name', "LOTCODE")->orderBy('tdi_sort')->pluck('tdi_value');
        	$titiletype=DB::table('tbdefitems')->where('tdi_td_name', "TITLETYPE")->orderBy('tdi_sort')->pluck('tdi_value');
        	$unitsize=DB::table('tbdefitems')->where('tdi_td_name', "SIZEUNIT")->orderBy('tdi_sort')->pluck('tdi_value');
        	$landcond=DB::table('tbdefitems')->where('tdi_td_name', "LANDCONDITION")->orderBy('tdi_sort')->pluck('tdi_value');
        	$landpos=DB::table('tbdefitems')->where('tdi_td_name', "LANDPOSISION")->orderBy('tdi_sort')->pluck('tdi_value');
        	$landuse=DB::table('tbdefitems')->where('tdi_td_name', "LANDUSE")->orderBy('tdi_sort')->pluck('tdi_value');
        	$roadtype=DB::table('tbdefitems')->where('tdi_td_name', "ROADTYPE")->orderBy('tdi_sort')->pluck('tdi_value');
        	$roadcaty=DB::table('tbdefitems')->where('tdi_td_name', "ROADCATEGORY")->orderBy('tdi_sort')->pluck('tdi_value');
        	$tnttype=DB::table('tbdefitems')->where('tdi_td_name', "TENURETYPE")->orderBy('tdi_sort')->pluck('tdi_value');
        	$owntype=DB::table('tbdefitems')->where('tdi_td_name', "OWNTYPE")->orderBy('tdi_sort')->pluck('tdi_value');
        	$race=DB::table('tbdefitems')->where('tdi_td_name', "RACE")->orderBy('tdi_sort')->pluck('tdi_value');
        	$citizen=DB::table('tbdefitems')->where('tdi_td_name', "CITIZEN")->orderBy('tdi_sort')->pluck('tdi_value');
        	$bldgcond=DB::table('tbdefitems')->where('tdi_td_name', "BLDGCONDN")->orderBy('tdi_sort')->pluck('tdi_value');
        	$bldgpos=DB::table('tbdefitems')->where('tdi_td_name', "BLDGPOSITION")->orderBy('tdi_sort')->pluck('tdi_value');
        	$bldgstructure=DB::table('tbdefitems')->where('tdi_td_name', "BLDGSTRUCTURE")->orderBy('tdi_sort')->pluck('tdi_value');
        	$bldgtype=DB::table('tbdefitems')->where('tdi_td_name', "BULDINGTYPE")->orderBy('tdi_sort')->pluck('tdi_value');
            $bldgstore=DB::table('tbdefitems')->where('tdi_td_name', "BUILDINGSTOREY")->orderBy('tdi_sort')->pluck('tdi_value');
        	$rooftype=DB::table('tbdefitems')->where('tdi_td_name', "ROOFTYPE")->orderBy('tdi_sort')->pluck('tdi_value');
        	$walltype=DB::table('tbdefitems')->where('tdi_td_name', "WALLTYPE")->orderBy('tdi_sort')->pluck('tdi_value');
        	$fltype=DB::table('tbdefitems')->where('tdi_td_name', "FLOORTYPE")->orderBy('tdi_sort')->pluck('tdi_value');
        	$arlvl=DB::table('tbdefitems')->where('tdi_td_name', "AREALEVEL")->orderBy('tdi_sort')->pluck('tdi_value');
        	$arcaty=DB::table('tbdefitems')->where('tdi_td_name', "AREACATEGORY")->orderBy('tdi_sort')->pluck('tdi_value');
        	$artype=DB::table('tbdefitems')->where('tdi_td_name', "AREATYPE")->orderBy('tdi_sort')->pluck('tdi_value');
        	$aruse=DB::table('tbdefitems')->where('tdi_td_name', "AREAUSE")->orderBy('tdi_sort')->pluck('tdi_value');
        	$arzone=DB::table('tbdefitems')->where('tdi_td_name', "AREAZONE")->orderBy('tdi_sort')->pluck('tdi_value');
        	$ceiling=DB::table('tbdefitems')->where('tdi_td_name', "CEILINGTYPE")->orderBy('tdi_sort')->pluck('tdi_value');
            $activeind=DB::table('tbdefitems')->where('tdi_td_name', "ACTIVEIND")->orderBy('tdi_sort')->pluck('tdi_value');
            $mbldg=DB::table('tbdefitems')->where('tdi_td_name', "ISMAINBLDG")->orderBy('tdi_sort')->pluck('tdi_value');
           // $mbldg=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ISMAINBLDG" order by tdi_sort ');

            App::setlocale(session()->get('locale'));
            return view("propertyregister.newtable")->with(array('maxRow'=> $maxRow, 'district'=>$district, 'state'=> $state, 'bldgcate'=>$bldgcate,'ishasbuilding' => $ishasbuilding,'lotcode'=> $lotcode, 'titiletype'=>$titiletype, 'unitsize'=> $unitsize, 'landcond'=>$landcond,'landpos' => $landpos,'landuse' => $landuse,'roadtype'=> $roadtype, 'roadcaty'=>$roadcaty, 'tnttype'=> $tnttype, 'owntype'=>$owntype,'race' => $race,'citizen'=> $citizen, 'bldgcond'=>$bldgcond, 'bldgpos'=> $bldgpos, 'bldgstructure'=>$bldgstructure,'rooftype'=> $rooftype, 'walltype'=>$walltype, 'fltype'=> $fltype, 'arlvl'=>$arlvl,'arcaty' => $arcaty, 'artype'=> $artype, 'aruse'=>$aruse,'arzone' => $arzone,'ceiling' => $ceiling,'pb' => $pb,'activeind' => $activeind,'zone' => $zone,'subzone' => $subzone,'bldgstore' => $bldgstore,'bldgtype' => $bldgtype, 'statedefault' => $statedefault,'mbldg' => $mbldg ));                      
        } else {

            //$pb = $request->input('pb');  
        	$district=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "DISTRICT" order by tdi_sort ');
        	$state=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE" order by tdi_sort '); 
        	$zone=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ZONE" order by tdi_sort ');
        	$subzone=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SUBZONE" order by tdi_sort '); 
            $ishasbuilding=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name =  "ISHASBUILDING" order by tdi_sort ');
            $statedefault=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATEDEFAULT" order by tdi_sort '); 
            //$statedefault=DB::table('tbdefitems')->where('tdi_td_name', "STATEDEFAULT")->orderBy('tdi_sort')->pluck('tdi_value');       
        	$lotcode=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE" order by tdi_sort ');
            $bldgcate=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGCATEGORY" order by tdi_sort ');
            $bldgtype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGTYPE" order by tdi_sort ');
        	$titiletype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE" order by tdi_sort ');
        	$unitsize=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SIZEUNIT" order by tdi_sort ');
        	$landcond=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDCONDITION" order by tdi_sort ');
        	$landpos=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDPOSISION" order by tdi_sort ');
            $landuse=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDUSE" order by tdi_sort ');
        	$roadtype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADTYPE" order by tdi_sort ');
        	$roadcaty=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADCATEGORY" order by tdi_sort ');
        	$tnttype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TENURETYPE" order by tdi_sort ');
        	$owntype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE" order by tdi_sort ');
        	$race=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "RACE" order by tdi_sort ');
        	$citizen=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "CITIZEN" order by tdi_sort ');
        	$bldgcond=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGCONDN" order by tdi_sort ');
        	$bldgpos=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGPOSITION" order by tdi_sort ');
        	$bldgstruct=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGSTRUCTURE" order by tdi_sort ');
        	$bldgstore=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY" order by tdi_sort ');
        	$rooftype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROOFTYPE" order by tdi_sort ');
        	$walltype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "WALLTYPE" order by tdi_sort ');
        	$fltype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "FLOORTYPE" order by tdi_sort ');
        	$arlvl=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREALEVEL" order by tdi_sort ');
        	$arcaty=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREACATEGORY" order by tdi_sort ');
        	$ceiling=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "CEILINGTYPE" order by tdi_sort ');
        	$artype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREATYPE" order by tdi_sort ');
        	$aruse=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAUSE" order by tdi_sort ');
        	$arzone=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAZONE" order by tdi_sort ');
            $status=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ACTIVEIND" order by tdi_sort ');
            $mbldg=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ISMAINBLDG" order by tdi_sort ');

        	$master = DB::select('select * from cm_masterlist where ma_id = ifnull("'.$prop_id.'",0)');

            $iseditable = 1;
            foreach ($master as $obj) {  
                if($obj->ma_approvalstatus_id == "02"){
                    $iseditable = 1;
                } else {
                    $iseditable = 0;
                }
            }
            
            //$master = DB::table('cm_masterlist')->where('ma_id', $prop_id)->first();
        	//$building = DB::select('select * from cm_bldg where bl_ma_id = ifnull("'.$prop_id.'",0)');
            $building = DB::select('select cm_bldg.*, bldgtype.tdi_value bldgtype, tdi_parent_name
             bldgcategory, tdi_parent_key bldgcategory_id, bldgstorey.tdi_value bldgstorey, 
            bldgstr.tdi_value bldgstr
            , rootype.tdi_value rootype , astatus.tdi_value astatus
             from cm_bldg left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype 
             on bldgtype.tdi_key = BL_BLDGTYPE_ID
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey
            on bldgstorey.tdi_key = BL_BLDGSTOREY_ID
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGSTRUCTURE") bldgstr
            on bldgstr.tdi_key = BL_BLDGSTRUCTURE_ID
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROOFTYPE") rootype  
            on rootype.tdi_key = BL_ROOFTYPE_ID
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ISMAINBLDG") astatus  
            on astatus.tdi_key = bl_ismainbldg_id
            where bl_ma_id = ifnull("'.$prop_id.'",0)');
        	//$lotlist = DB::select('select * from cm_lot where lo_ma_id = ifnull("'.$prop_id.'",0)');
            $lotlist = DB::select('select cm_lot.*, lotcode.tdi_value lotcode, roadtype.tdi_value roadtype, titletype.tdi_value titletype
            , unitsize.tdi_value unitsize, concat(lotcode.tdi_value,cm_lot.LO_NO) lotnumber, concat(titletype.tdi_value,cm_lot.LO_TITLENO) titlenumber, landuse.tdi_value landuse, tentype.tdi_value tentype
             from cm_lot left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE") lotcode on lotcode.tdi_key = LO_LOTCODE_ID
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADTYPE") roadtype on roadtype.tdi_key = LO_ROADTYPE_ID
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE") titletype on titletype.tdi_key = LO_TITLETYPE_ID
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SIZEUNIT") unitsize on unitsize.tdi_key = LO_SIZEUNIT_ID
            left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDUSE") landuse on  LO_LANDUSE_ID = landuse.tdi_key
            left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "TENURETYPE") tentype on  LO_TENURETYPE_ID = tentype.tdi_key 
             where lo_ma_id = ifnull("'.$prop_id.'",0)');
        	//$ownerlist = DB::select('select * from cm_owner where to_ma_id = ifnull("'.$prop_id.'",0)');
            $ownerlist = DB::select('select cm_owner.*, owntype.tdi_value owntype, state.tdi_value state
             from cm_owner left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE") owntype on owntype.tdi_key = to_owntype_id
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = TO_STATE_ID
             where  to_ma_id = ifnull("'.$prop_id.'",0)');

            $bldgardetail = DB::select('select cm_bldgarea.*, cm_bldg.bl_bldg_no, ma_accno, arzone.tdi_value arzone, arlvel.tdi_value arlvel, arcate.tdi_value arcate, floortype.tdi_value floortype
                , artype.tdi_value artype, aruse.tdi_value aruse, ceilingtype.tdi_value ceilingtype
                from  cm_bldg, cm_masterlist, cm_bldgarea left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREATYPE") artype on artype.tdi_key = cm_bldgarea.BA_AREATYPE_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREACATEGORY") arcate on  arcate.tdi_key = BA_AREACATEGORY_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREALEVEL") arlvel on  arlvel.tdi_key = BA_AREALEVEL_ID 
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAZONE") arzone on arzone.tdi_key = BA_AREAZONE_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "FLOORTYPE") floortype on floortype.tdi_key = BA_FLOORTYPE_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAUSE") aruse on aruse.tdi_key = BA_AERAUSE_ID
                left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "CEILINGTYPE") ceilingtype on ceilingtype.tdi_key = BA_CEILINGTYPE_ID
                where ba_bl_id = bl_id
                and bl_ma_id = ma_id
                and bl_ma_id = ifnull("'.$prop_id.'",0)');
            $count = count($master);

            $basket = DB::select('select * from cm_propbasket  where pb_id = ifnull("'.$pb.'",0)');
            //$propertyDetails = Datatables::collection($property)->make(true);
            $basket_name = '';
            $accountnumbber = '';
            
            $prop = DB::select('select * from cm_propbasket inner join 
                cm_masterlist on ma_pb_id = pb_id
                where ma_id = ifnull("'.$prop_id.'",0)');
            //$propertyDetails = Datatables::collection($property)->make(true);
           
            foreach ($basket as $obj) {  
               $basket_name = $obj->PB_NAME;
               $basket_type = $obj->PB_APPLICATIONTYPE_ID;
            }

            Log::info($basket_type." - ddd");
            foreach ($prop as $obj) {  
               $accountnumbber = $obj->ma_accno;
            }

            App::setlocale(session()->get('locale'));

            return view("propertyregister.tab")->with('district', $district)->with('state', $state)->with('statedefault', $statedefault)->with('zone', $zone)->with('subzone', $subzone)->with('pb', $pb)->with(array('bldgstruct'=>$bldgstruct,'bldgstore'=>$bldgstore,'ishasbuilding'=>$ishasbuilding, 'landuse'=>$landuse, 'master'=> $master, 'lotlist'=> $lotlist, 'ownerlist'=>$ownerlist, 'building'=> $building,'lotcode'=> $lotcode, 'titiletype'=>$titiletype, 'unitsize'=> $unitsize, 'landcond'=>$landcond,'landpos' => $landpos,'roadtype'=> $roadtype, 'roadcaty'=>$roadcaty, 'tnttype'=> $tnttype, 'owntype'=>$owntype,'race' => $race,'citizen'=> $citizen, 'bldgcond'=>$bldgcond, 'bldgpos'=> $bldgpos, 'bldgstructure'=>$bldgstruct,'rooftype'=> $rooftype, 'walltype'=>$walltype, 'fltype'=> $fltype, 'arlvl'=>$arlvl,'arcaty' => $arcaty, 'artype'=> $artype, 'aruse'=>$aruse,'arzone' => $arzone,'ceiling' => $ceiling,'bldgcate' => $bldgcate,'bldgtype' => $bldgtype,'count' => $count, 'bldgardetail' => $bldgardetail,'prop_id' => $prop_id,'iseditable' => $iseditable,'pb_id' => $pb,'basket_name' => $basket_name,'accountnumbber' => $accountnumbber,'basket_type' => $basket_type,'status' => $status, 'mbldg' => $mbldg ));
        }
        
    }

    public function maintenancepropertydetail(Request $request){

        $page = $request->input('type');
        $maxRow = $request->input('maxrow');
        $name = $request->input('name');     
        $pb = $request->input('pb_id');      
        $prop_id = $request->input('prop_id');


        //$pb = $request->input('pb');  
        $district=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "DISTRICT" order by tdi_sort ');
        $state=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE" order by tdi_sort '); 
        $zone=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ZONE" order by tdi_sort ');
        $subzone=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SUBZONE" order by tdi_sort '); 
        $ishasbuilding=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name =  "ISHASBUILDING" order by tdi_sort ');

        $lotcode=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE" order by tdi_sort ');
        $bldgcate=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGCATEGORY" order by tdi_sort ');
        $bldgtype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGTYPE" order by tdi_sort ');
        $titiletype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE" order by tdi_sort ');
        $unitsize=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SIZEUNIT" order by tdi_sort ');
        $landcond=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDCONDITION" order by tdi_sort ');
        $landpos=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDPOSISION" order by tdi_sort ');
        $landuse=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDUSE" order by tdi_sort ');
        $roadtype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADTYPE" order by tdi_sort ');
        $roadcaty=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADCATEGORY" order by tdi_sort ');
        $tnttype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TENURETYPE" order by tdi_sort ');
        $owntype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE" order by tdi_sort ');
        $race=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "RACE" order by tdi_sort ');
        $citizen=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "CITIZEN" order by tdi_sort ');
        $bldgcond=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGCONDN" order by tdi_sort ');
        $bldgpos=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGPOSITION" order by tdi_sort ');
        $bldgstruct=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGSTRUCTURE" order by tdi_sort ');
        $bldgstore=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY" order by tdi_sort ');
        $rooftype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROOFTYPE" order by tdi_sort ');
        $walltype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "WALLTYPE" order by tdi_sort ');
        $fltype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "FLOORTYPE" order by tdi_sort ');
        $arlvl=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREALEVEL" order by tdi_sort ');
        $arcaty=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREACATEGORY" order by tdi_sort ');
        $ceiling=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "CEILINGTYPE" order by tdi_sort ');
        $artype=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREATYPE" order by tdi_sort ');
        $aruse=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAUSE" order by tdi_sort ');
        $arzone=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAZONE" order by tdi_sort ');

        $master = DB::select('select * from cm_masterlist where ma_id = ifnull("'.$prop_id.'",0)');

        $iseditable = 1;
        foreach ($master as $obj) {  
            if($obj->ma_approvalstatus_id == "02"){
                $iseditable = 1;
            } else {
                $iseditable = 0;
            }
        }
        
        //$master = DB::table('cm_masterlist')->where('ma_id', $prop_id)->first();
        //$building = DB::select('select * from cm_bldg where bl_ma_id = ifnull("'.$prop_id.'",0)');
        $building = DB::select('select cm_bldg.*, bldgtype.tdi_value bldgtype, tdi_parent_name
         bldgcategory, tdi_parent_key bldgcategory_id, bldgstorey.tdi_value bldgstorey, 
        bldgstr.tdi_value bldgstr
        , rootype.tdi_value rootype
         from cm_bldg left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") bldgtype 
         on bldgtype.tdi_key = BL_BLDGTYPE_ID
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgstorey
        on bldgstorey.tdi_key = BL_BLDGSTOREY_ID
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BLDGSTRUCTURE") bldgstr
        on bldgstr.tdi_key = BL_BLDGSTRUCTURE_ID
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROOFTYPE") rootype  
        on rootype.tdi_key = BL_ROOFTYPE_ID where bl_ma_id = ifnull("'.$prop_id.'",0)');
        //$lotlist = DB::select('select * from cm_lot where lo_ma_id = ifnull("'.$prop_id.'",0)');
        $lotlist = DB::select('select cm_lot.*, lotcode.tdi_value lotcode, roadtype.tdi_value roadtype, titletype.tdi_value titletype
        , unitsize.tdi_value unitsize, concat(lotcode.tdi_value,cm_lot.LO_NO) lotnumber, concat(titletype.tdi_value,cm_lot.LO_TITLENO) titlenumber, landuse.tdi_value landuse, tentype.tdi_value tentype
         from cm_lot left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE") lotcode on lotcode.tdi_key = LO_LOTCODE_ID
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ROADTYPE") roadtype on roadtype.tdi_key = LO_ROADTYPE_ID
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "TITLETYPE") titletype on titletype.tdi_key = LO_TITLETYPE_ID
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SIZEUNIT") unitsize on unitsize.tdi_key = LO_SIZEUNIT_ID
        left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "LANDUSE") landuse on  LO_LANDUSE_ID = landuse.tdi_key
        left join (select  tdi_key, tdi_value from tbdefitems where tdi_td_name = "TENURETYPE") tentype on  LO_TENURETYPE_ID = tentype.tdi_key 
         where lo_ma_id = ifnull("'.$prop_id.'",0)');
        //$ownerlist = DB::select('select * from cm_owner where to_ma_id = ifnull("'.$prop_id.'",0)');
        $ownerlist = DB::select('select cm_owner.*, owntype.tdi_value owntype, state.tdi_value state
         from cm_owner left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "OWNTYPE") owntype on owntype.tdi_key = to_owntype_id
        left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = TO_STATE_ID
         where  to_ma_id = ifnull("'.$prop_id.'",0)');

        $bldgardetail = DB::select('select cm_bldgarea.*, cm_bldg.bl_bldg_no, ma_accno, arzone.tdi_value arzone, arlvel.tdi_value arlvel, arcate.tdi_value arcate, floortype.tdi_value floortype
            , artype.tdi_value artype, aruse.tdi_value aruse, ceilingtype.tdi_value ceilingtype
            from  cm_bldg, cm_masterlist, cm_bldgarea left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREATYPE") artype on artype.tdi_key = cm_bldgarea.BA_AREATYPE_ID
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREACATEGORY") arcate on  arcate.tdi_key = BA_AREACATEGORY_ID
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREALEVEL") arlvel on  arlvel.tdi_key = BA_AREALEVEL_ID 
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAZONE") arzone on arzone.tdi_key = BA_AREAZONE_ID
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "FLOORTYPE") floortype on floortype.tdi_key = BA_FLOORTYPE_ID
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAUSE") aruse on aruse.tdi_key = BA_AERAUSE_ID
            left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "CEILINGTYPE") ceilingtype on ceilingtype.tdi_key = BA_CEILINGTYPE_ID
            where ba_bl_id = bl_id
            and bl_ma_id = ma_id
            and bl_ma_id = ifnull("'.$prop_id.'",0)');
        $count = count($master);

        $basket = DB::select('select * from cm_propbasket  where pb_id = ifnull("'.$pb.'",0)');
        //$propertyDetails = Datatables::collection($property)->make(true);
        $basket_name = '';
        $accountnumbber = '';
        
        $prop = DB::select('select * from cm_propbasket inner join 
            cm_masterlist on ma_pb_id = pb_id
            where ma_id = ifnull("'.$prop_id.'",0)');
        //$propertyDetails = Datatables::collection($property)->make(true);
       
        foreach ($basket as $obj) {  
           $basket_name = $obj->PB_NAME;
        }
        foreach ($prop as $obj) {  
           $accountnumbber = $obj->ma_accno;
        }

        App::setlocale(session()->get('locale'));
            

        return view("existspropertyregister.tab")->with('district', $district)->with('state', $state)->with('zone', $zone)->with('subzone', $subzone)->with('pb', $pb)->with(array('bldgstruct'=>$bldgstruct,'bldgstore'=>$bldgstore,'ishasbuilding'=>$ishasbuilding, 'landuse'=>$landuse, 'master'=> $master, 'lotlist'=> $lotlist, 'ownerlist'=>$ownerlist, 'building'=> $building,'lotcode'=> $lotcode, 'titiletype'=>$titiletype, 'unitsize'=> $unitsize, 'landcond'=>$landcond,'landpos' => $landpos,'roadtype'=> $roadtype, 'roadcaty'=>$roadcaty, 'tnttype'=> $tnttype, 'owntype'=>$owntype,'race' => $race,'citizen'=> $citizen, 'bldgcond'=>$bldgcond, 'bldgpos'=> $bldgpos, 'bldgstructure'=>$bldgstruct,'rooftype'=> $rooftype, 'walltype'=>$walltype, 'fltype'=> $fltype, 'arlvl'=>$arlvl,'arcaty' => $arcaty, 'artype'=> $artype, 'aruse'=>$aruse,'arzone' => $arzone,'ceiling' => $ceiling,'bldgcate' => $bldgcate,'bldgtype' => $bldgtype,'count' => $count, 'bldgardetail' => $bldgardetail,'prop_id' => $prop_id,'iseditable' => $iseditable,'pb_id' => $pb,'basket_name' => $basket_name,'accountnumbber' => $accountnumbber));
        
        
    }

    public function childparam(Request $request){
    	$param_value = $request->input('param_value');
    	$param = $request->input('param');
    	$storey_arr = '';
        $arelvl_arr = '';
        $areuse_arr = '';

    	if($param == 'zone'){
    		$res_arr=DB::table('tbdefitems')->where('tdi_td_name', "ZONE")->where('tdi_parent_name', $param_value)->orderBy('tdi_sort')->pluck('tdi_value');
    	} else if ($param == 'subzone'){
    		$res_arr=DB::table('tbdefitems')->where('tdi_td_name', "SUBZONE")->where('tdi_parent_name', $param_value)->orderBy('tdi_sort')->pluck('tdi_value');
    	} else if ($param == 'bldgtype') {
    		# code...
    		$res_arr=DB::table('tbdefitems')->where('tdi_td_name', "BULDINGTYPE")->where('tdi_parent_name', $param_value)->orderBy('tdi_sort')->pluck('tdi_value');
    		$storey_arr=DB::table('tbdefitems')->where('tdi_td_name', "BUILDINGSTOREY")->where('tdi_parent_name', $param_value)->orderBy('tdi_sort')->pluck('tdi_value');
            $arelvl_arr=DB::table('tbdefitems')->where('tdi_td_name', "AREALEVEL")->where('tdi_parent_name', $param_value)->orderBy('tdi_sort')->pluck('tdi_value');
            $areuse_arr=DB::table('tbdefitems')->where('tdi_td_name', "AREAUSE")->where('tdi_parent_name', $param_value)->orderBy('tdi_sort')->pluck('tdi_value');

    	} else if ($param == 'bldgartype') {
            # code...
            $res_arr=DB::table('tbdefitems')->where('tdi_td_name', "AREAUSE")->where('tdi_parent_name', $param_value)->orderBy('tdi_sort')->pluck('tdi_value');
            $storey_arr=DB::table('tbdefitems')->where('tdi_td_name', "AREALEVEL")->where('tdi_parent_name', $param_value)->orderBy('tdi_sort')->pluck('tdi_value');
        } else if ($param == 'tabBldgar') {
            # code...
            $res_arr=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREALEVEL" and tdi_parent_key in( select tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE" and tdi_key = "'.$param_value.'") order by tdi_sort');
            $storey_arr=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAUSE" and tdi_parent_key in( select tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE" and tdi_key = "'.$param_value.'") order by tdi_sort');
        } else if ($param == 'tabBldgar1') {
            # code...
            $res_arr=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREALEVEL" and tdi_parent_key = "'.$param_value.'" order by tdi_sort');
            $storey_arr=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAUSE" and tdi_parent_key = "'.$param_value.'" order by tdi_sort');
        }else if ($param == 'val') {
            # code...
            $res_arr=DB::select('select * from tbdefitems WHERE tdi_td_name = "ALLOWANCETYPE" and tdi_parent_key = "'.$param_value.'" order by tdi_sort');
        }

    	//Log::info();
    	return response()->json(array('res_arr'=> $res_arr,'storey_arr'=> $storey_arr, 'arelvl_arr' =>$arelvl_arr, 'areuse_arr' => $areuse_arr ), 200);
    }

    public function subCategory(Request $request) {
        $param_value = $request->input('param_value');
        $param_value2 = $request->input('param_value2');
        $param = $request->input('param');
        $res_arr2 = '';
        $res_arr3 = '';
        $res_arr4 = '';

        if($param == 'zone'){
            //$res_arr
            $res_arr=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ZONE" and tdi_parent_key 
                = "'.$param_value.'" order by tdi_sort');
        } else if ($param == 'subzone'){
            $res_arr=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "SUBZONE" and tdi_parent_key 
                = "'.$param_value.'" order by tdi_sort');
        } else if ($param == 'bldgtype') {
            $res_arr=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGTYPE" and tdi_parent_key 
                = "'.$param_value.'" order by tdi_sort');
            $res_arr2=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY" and tdi_parent_key 
                = "'.$param_value.'" order by tdi_sort');
            $res_arr3=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREALEVEL" and tdi_parent_key 
                = "'.$param_value.'" order by tdi_sort');
            $res_arr4=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAUSE" and tdi_parent_key 
                = "'.$param_value.'" order by tdi_sort');
            
        } else if ($param == 'bldgartype') {
            # code...
            $res_arr=DB::table('tbdefitems')->where('tdi_td_name', "AREAUSE")->where('tdi_parent_name', $param_value)->pluck('tdi_value');
            $res_arr2=DB::table('tbdefitems')->where('tdi_td_name', "AREALEVEL")->where('tdi_parent_name', $param_value)->pluck('tdi_value');
        } else if ($param == 'allowance') {
            # code...
            $res_arr=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "ALLOWANCETYPE" and tdi_parent_key 
                = "'.$param_value.'" order by tdi_sort');
        } else if ($param == 'parameter') {
            # code...
            $res_arr=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BULDINGTYPE" and tdi_parent_key 
                = "'.$param_value.'" order by tdi_sort');
            $res_arr2=DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = "BUILDINGSTOREY" and tdi_parent_key 
                = "'.$param_value.'" order by tdi_sort');
        } else if ($param == 'val') {
            # code...
           // Log::info('select tdi_key,tdi_value from tbdefitems WHERE tdi_td_name = "ALLOWANCETYPE" and tdi_parent_key = "'.$param_value.'" ');
            $res_arr=DB::select('select tdi_key,tdi_value from tbdefitems WHERE tdi_td_name = "ALLOWANCETYPE" and tdi_parent_key = "'.$param_value.'" order by tdi_sort');
        } else if ($param == 'borangc') {
            # code...
           // Log::info('select tdi_key,tdi_value from tbdefitems WHERE tdi_td_name = "ALLOWANCETYPE" and tdi_parent_key = "'.$param_value.'" ');
           $res_arr=DB::select("select * from tbdefitems where tdi_td_name = 'RATEPAYERTYPE' AND tdi_key in 
           (SELECT DISTINCT rp_type_id FROM cm_ratepayer, cm_appln_ratepayer, cm_appln_valdetl, cm_appln_val, cm_appln_valterm
           WHERE ARP_RP_ID = rp_id AND
           vd_id = ARP_VD_ID AND 
           va_id = vd_va_id AND 
           vt_id = va_vt_id AND
           vt_termDate <= (select vt_termDate  from cm_appln_valterm where vt_id = ".$param_value." and vt_applicationtype_id ='C') and vt_approvalstatus_id = '05')"); 
        } else if ($param == 'borangc2') {
            # code...
           // Log::info('select tdi_key,tdi_value from tbdefitems WHERE tdi_td_name = "ALLOWANCETYPE" and tdi_parent_key = "'.$param_value.'" ');
           $res_arr=DB::select("select rp_id tdi_key, rp_name tdi_value   
           FROM  cm_ratepayer where rp_id in (select arp_rp_id from  cm_appln_ratepayer, cm_appln_valdetl, cm_appln_val, cm_appln_valterm
                      WHERE 
                      vd_id = ARP_VD_ID and 
                      va_id = vd_va_id and
                      vt_id = va_vt_id and
                      vt_termDate <= (select vt_termDate  from cm_appln_valterm where vt_id = ".$param_value." and vt_applicationtype_id ='C') and vt_approvalstatus_id = '05' and
                      rp_type_id = '".$param_value2."')");
        } else if ($param == 'borangb') {
            # code...
           // Log::info('select tdi_key,tdi_value from tbdefitems WHERE tdi_td_name = "ALLOWANCETYPE" and tdi_parent_key = "'.$param_value.'" ');
            $res_arr=DB::select("select * from tbdefitems where tdi_td_name = 'RATEPAYERTYPE' AND tdi_key in 
            (SELECT DISTINCT rp_type_id FROM cm_ratepayer, cm_appln_ratepayer, cm_appln_valdetl, cm_appln_val
            WHERE ARP_RP_ID = rp_id AND
            vd_id = ARP_VD_ID AND 
            va_id = vd_va_id AND
            va_vt_id =  ".$param_value.")");
        } else if ($param == 'borangb2') {
            # code...
           // Log::info('select tdi_key,tdi_value from tbdefitems WHERE tdi_td_name = "ALLOWANCETYPE" and tdi_parent_key = "'.$param_value.'" ');
            $res_arr=DB::select("select ma_accno tdi_key, CONCAT(te_name, '(', ma_accno, '), ', ma_addr_ln1, ' ', ma_addr_ln2, ' ') tdi_value   FROM cm_tenant, cm_appln_tenant, cm_ratepayer, cm_appln_ratepayer, cm_appln_valdetl, cm_appln_val, cm_masterlist
            WHERE ARP_RP_ID = rp_id and
            vd_id = ARP_VD_ID and 
            va_id = vd_va_id and
            at_vd_id = vd_id and
            at_te_id = te_id and
            vd_ma_id = ma_id and
            va_vt_id = ".$param_value." and
            rp_type_id = '".$param_value2."'");

            
        }

        //Log::info();
        return response()->json(array('res_arr'=> $res_arr,'res_arr2'=> $res_arr2,'res_arr3'=> $res_arr3,'res_arr4'=> $res_arr4), 200);
    }

    public function testExceptopm(Request $request){
          $type = $request->input('type');
$master ='{"aa":"ss '.$type.'"}';
        try {
            Log::info("Start");
            Log::info($master);
            $register=DB::select(" call proc_property_register('".$master."',
'{}',
'{}','{}','{}','admin',4,'','') ");
        } catch (\Illuminate\Database\QueryException $ex) {
            Log::info("Error");
            //Log::info('message : '.$ex);
            Log::info('message : '.$ex->getMessage());
            $msg = false;
            if (strpos($ex->getMessage(), 'Invalid JSON text') !== false ) {
               Log::info('Final : true   '.$msg);
            } else {
                Log::info('Final : false '.$msg);
            }
            //Log::info('Final : '.$msg);
        }
    }

    public function registerproperty(Request $request){
        $type = $request->input('type');
        $master = $request->input('masterdata');
        $lot = $request->input('lotdata');
        $owner = $request->input('ownerdata');
        $bldg = $request->input('bldgdata');
        $bldgar = $request->input('bldgardata');
        $pb = $request->input('pb');
        $name=Auth::user()->name;
        try {

            if($type == 'tab'){
                //$form = $request->input('form');
                $masterdata = $request->input('masterdata');  
                $lotdata = $request->input('lotdata');  
                $ownerdata = $request->input('ownerdata');  
                $bldgdata = $request->input('bldgdata');   
                $bldgardata = $request->input('bldgardata');  


                $prop = $request->input('prop_id');
                 
                $prop = $request->input('pb');
                Log::info("call proc_propreg_single('".$masterdata."',  '".$lotdata."','".$ownerdata."','".$bldgdata."','".$bldgardata."','".$name."',".$prop.",'".$type."','')"); 
                $register=DB::select("call proc_propreg_single('".$masterdata."',
                    '".$lotdata."','".$ownerdata."','".$bldgdata."','".$bldgardata."','".$name."',".$prop.",'".$type."','')");   
            } else {
            	//$msg = false;
                Log::info("call proc_property_register_table('".$master."','".$name."',".$pb.",'','')");
                $register=DB::select("call proc_property_register_table('".$master."','".$name."',".$pb.",'','')");
            }
            $error = "Property Registered successfully!";
         } catch (\Illuminate\Database\QueryException $ex) {
            $error = "Error while create new property";
            if (strpos($ex->getMessage(), 'Invalid JSON text') !== false ) {
                $error = "Error while create new property please remove special character i.e \ and ' then try.";
            }
        }
        //$msg = true;
    	return response()->json(array('msg'=> 'true','text'=> $error), 200);
    }

    public function propertyRegister(Request $request){
    	$pb = $request->input('pb');
        $maxRow = 30;
        //$property = '';           
        $propertydetail = DB::select('select ifnull(property_count,0) bldgcount, ifnull(approperty_count,0) approvecount, ifnull(pending_count,0) pending_count 
            from (select ma_pb_id,count(*) property_count from cm_masterlist 
            inner join cm_bldg on BL_MA_ID = ma_id group by ma_pb_id) propertycount left join
            (select ma_pb_id, count(*) approperty_count from cm_masterlist 
            where ma_approvalstatus_id = "03" group by ma_pb_id) pendingcount on pendingcount.ma_pb_id = propertycount.ma_pb_id
            left join
            (select ma_pb_id, count(*) pending_count from cm_masterlist 
            where ma_approvalstatus_id = "02" group by ma_pb_id) approvedcount on approvedcount.ma_pb_id = propertycount.ma_pb_id
            where propertycount.ma_pb_id = ifnull("'.$pb.'",0)');
        $basket = DB::select('select * from cm_propbasket where pb_id = ifnull("'.$pb.'",0)');
        //$propertyDetails = Datatables::collection($property)->make(true);
        
        foreach ($basket as $obj) {  
           $basket_status = $obj->PB_APPROVALSTATUS_ID;
           $basket_name = $obj->PB_NAME;
           $appln_type = $obj->PB_APPLICATIONTYPE_ID;
        }

        App::setlocale(session()->get('locale'));
            

        return view("propertyregister.property")->with('pb', $pb)->with('maxRow', $maxRow)->with('propertydetail', $propertydetail)->with('basket_status', $basket_status)->with('basket_name', $basket_name)->with('appln_type', $appln_type);
    }

    public function existspropertyRegister(Request $request){
        $pb = $request->input('pb');
        $maxRow = 30;
        //$property = '';           
        $propertydetail = DB::select('select ifnull(property_count,0) bldgcount, ifnull(approperty_count,0) approvecount, ifnull(pending_count,0) pending_count 
            from (select ma_pb_id,count(*) property_count from cm_masterlist 
            inner join cm_bldg on BL_MA_ID = ma_id group by ma_pb_id) propertycount left join
            (select ma_pb_id, count(*) approperty_count from cm_masterlist 
            where ma_approvalstatus_id = "03" group by ma_pb_id) pendingcount on pendingcount.ma_pb_id = propertycount.ma_pb_id
            left join
            (select ma_pb_id, count(*) pending_count from cm_masterlist 
            where ma_approvalstatus_id = "02" group by ma_pb_id) approvedcount on approvedcount.ma_pb_id = propertycount.ma_pb_id
            where propertycount.ma_pb_id = ifnull("'.$pb.'",0)');
        $basket = DB::select('select * from cm_propbasket where pb_id = ifnull("'.$pb.'",0)');
        //$propertyDetails = Datatables::collection($property)->make(true);
        
        foreach ($basket as $obj) {  
           $basket_status = $obj->PB_APPROVALSTATUS_ID;
           $basket_name = $obj->PB_NAME;
        }

        App::setlocale(session()->get('locale'));
            
        return view("existspropertyregister.property")->with('pb', $pb)->with('maxRow', $maxRow)->with('propertydetail', $propertydetail)->with('basket_status', $basket_status)->with('basket_name', $basket_name);
    }

    public function propertyTables(Request $request){
        Log::info('Test');
        $pb = $request->input('pb');
        ini_set('memory_limit', '2056M');
         Log::info($pb);
        $maxRow = 30;
        //$property = '';           
        $property = DB::select('select ma_id, ma_pb_id,  ma_accno,  zone.tdi_value zone, subzone.tdi_value subzone, ma_addr_ln1, ma_addr_ln2, 
        isbldg.tdi_value isbldg, owncount, ma_approvalstatus_id, propstatus.tdi_desc propstatus, applntype.tdi_value applntype
        from cm_masterlist 
        left join 
        (select tdi_key , tdi_value, tdi_parent_key  from tbdefitems where tdi_td_name = "SUBZONE")  subzone
        on ma_subzone_id = subzone.tdi_key 
        left join (select tdi_key , tdi_value  from tbdefitems where tdi_td_name = "ZONE")  zone
        on subzone.tdi_parent_key = zone.tdi_key
        left join (select tdi_key , tdi_value  from tbdefitems where tdi_td_name = "ISHASBUILDING") isbldg
        on ma_ishasbuilding_id = isbldg.tdi_key
        left join (select TO_MA_ID,count(*) as owncount from cm_owner group by TO_MA_ID ) ownertb on TO_MA_ID = ma_id
        left join (select *  from tbdefitems where tdi_td_name = "PROPERTYSTAGE") propstatus
        on propstatus.tdi_key = ma_approvalstatus_id
        left join (select *  from tbdefitems where tdi_td_name = "APPLICATIONTYPE") applntype
        on applntype.tdi_key = ma_applicationtype_id
        where ma_pb_id = '.$pb);

        $propertyDetails = Datatables::collection($property)->make(true);
        return $propertyDetails;
    }

    public function propertybasket(Request $request){   

        if(userpermission::checkaccess('32')=="false"){
            $detail = UserAcessController::accessDetail('32');
            return view('denied')->with('detail',$detail);
        } 

        App::setlocale(session()->get('locale'));
        $param = $request->input('param'); 
         $condition = ' ';   
        /*if ( $param == '01'  ){
            $condition = ' where PB_APPROVED  in ("01","02") ';
        } else */
        $stage = '0';
        if ( $param == '03'  ){
             $condition = ' where PB_APPROVALSTATUS_ID  in ("03") ';
            $stage = '03';
        } else {
             $condition = ' where PB_APPROVALSTATUS_ID  in ("01","02") ';
            $stage = '01';
        }
            $basket=DB::select("select pb_id basket_id, pb_name basketname,  ifnull(propcnt.propcount,0) propcount, applntype.tdi_value applntype, pb_applicationtype_id,
            pb_createby, date_format(pb_createdate,'%d/%m/%Y') createdate, pb_updateby, date_format(pb_updatedate,'%d/%m/%Y') updatedate,
            ifnull(valprop.propcount,0) valpropcount, tbstatus.tdi_desc tdi_status, ifnull(pending_count,0) pending_count, ifnull(approved_count,0) approved_count, PB_APPROVALSTATUS_ID
            from cm_propbasket
            left join (select ma_pb_id, count(*) propcount from cm_masterlist inner join cm_appln_valdetl on ma_id = vd_ma_id group by ma_pb_id)
            valprop on valprop.ma_pb_id = pb_id
            left join (select ma_pb_id, count(*) propcount from cm_masterlist group by ma_pb_id) propcnt
            on propcnt.ma_pb_id = pb_id
            left join (select * from tbdefitems where tdi_td_name = 'BASKETSTAGE') tbstatus on tdi_key = PB_APPROVALSTATUS_ID
            left join (select ma_pb_id, count(*) pending_count from cm_masterlist 
            where ma_approvalstatus_id = '02' group by ma_pb_id) pendingprop on pendingprop.ma_pb_id = pb_id
            left join (select ma_pb_id, count(*) approved_count from cm_masterlist 
            where ma_approvalstatus_id = '03' group by ma_pb_id) approvedprop on approvedprop.ma_pb_id = pb_id
            left join (select * from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype on applntype.tdi_key = PB_APPLICATIONTYPE_ID  ".$condition." and  PB_PROPBASKETTYE_ID = 1
            order by pb_createdate desc ");

            $propertycount =DB::select('select count(*) propcount from cm_masterlist inner join cm_propbasket on PB_ID = ma_pb_id
                 where   PB_PROPBASKETTYE_ID = 1');

            $valproperty =DB::select('select count(*) propcount from cm_masterlist inner join cm_propbasket on PB_ID = ma_pb_id
            inner join cm_appln_valdetl on vd_ma_id = ma_id where   PB_PROPBASKETTYE_ID = 1');

            $applntype = DB::select('select * from tbdefitems where tdi_td_name = "APPLICATIONTYPE"');

        App::setlocale(session()->get('locale'));
            
        return view('propertyregister.basket')->with('basket',$basket)->with('propertycount',$propertycount)->with('applntype',$applntype)->with('valproperty',$valproperty)->with('stage',$stage);
    }

    public function existspropertybasket(Request $request){   

        if(userpermission::checkaccess('32')=="false"){
            $detail = UserAcessController::accessDetail('32');
            return view('denied')->with('detail',$detail);
        } 
        $param = $request->input('param'); 
         $condition = ' ';   
        /*if ( $param == '01'  ){
            $condition = ' where PB_APPROVED  in ("01","02") ';
        } else */
        $stage = '0';
        if ( $param == '03'  ){
             $condition = ' where PB_APPROVALSTATUS_ID  in ("03") ';
            $stage = '03';
        } else {
             $condition = ' where PB_APPROVALSTATUS_ID  in ("01","02") ';
            $stage = '01';
        }
            $basket=DB::select("select pb_id basket_id, pb_name basketname,  ifnull(propcnt.propcount,0) propcount, applntype.tdi_value applntype, pb_applicationtype_id,
            pb_createby, date_format(pb_createdate,'%d/%m/%Y') createdate, pb_updateby, date_format(pb_updatedate,'%d/%m/%Y') updatedate,
            ifnull(valprop.propcount,0) valpropcount, tbstatus.tdi_desc tdi_status, ifnull(pending_count,0) pending_count, ifnull(approved_count,0) approved_count, PB_APPROVALSTATUS_ID
            from cm_propbasket
            left join (select ma_pb_id, count(*) propcount from cm_masterlist inner join cm_appln_valdetl on ma_id = vd_ma_id group by ma_pb_id)
            valprop on valprop.ma_pb_id = pb_id
            left join (select ma_pb_id, count(*) propcount from cm_masterlist group by ma_pb_id) propcnt
            on propcnt.ma_pb_id = pb_id
            left join (select * from tbdefitems where tdi_td_name = 'BASKETSTAGE') tbstatus on tdi_key = PB_APPROVALSTATUS_ID
            left join (select ma_pb_id, count(*) pending_count from cm_masterlist 
            where ma_approvalstatus_id = '02' group by ma_pb_id) pendingprop on pendingprop.ma_pb_id = pb_id
            left join (select ma_pb_id, count(*) approved_count from cm_masterlist 
            where ma_approvalstatus_id = '03' group by ma_pb_id) approvedprop on approvedprop.ma_pb_id = pb_id
            left join (select * from tbdefitems where tdi_td_name = 'APPLICATIONTYPE') applntype on applntype.tdi_key = PB_APPLICATIONTYPE_ID  ".$condition." and  PB_PROPBASKETTYE_ID = 2
            order by pb_createdate desc ");

            $propertycount =DB::select('select count(*) propcount from cm_masterlist inner join cm_propbasket on PB_ID = ma_pb_id
                 where   PB_PROPBASKETTYE_ID = 2');

            $valproperty =DB::select('select count(*) propcount from cm_masterlist inner join cm_propbasket on PB_ID = ma_pb_id
            inner join cm_appln_valdetl on vd_ma_id = ma_id where   PB_PROPBASKETTYE_ID = 2');

            $applntype = DB::select('select * from tbdefitems where tdi_td_name = "APPLICATIONTYPE"');
            
        App::setlocale(session()->get('locale'));
            
        return view('existspropertyregister.basket')->with('basket',$basket)->with('propertycount',$propertycount)->with('applntype',$applntype)->with('valproperty',$valproperty)->with('stage',$stage);
    }

    public function exsitspropertybaskettrn(Request $request){
        $basket = $request->input('basket');
        $basket_id = $request->input('basket_id');
        $applicationtype = $request->input('applicationtype');
        $operation = $request->input('operation');
        if($operation != 3) {
            $request->validate([
                'basket' => 'required',
                'applicationtype' => 'required',
            ]);
        }

        $name=Auth::user()->name;
        Log::info('call proc_cmpropbasket_trn("'.$basket.'","'.$applicationtype.'",'.$operation.','.$basket_id.',"'.$name.'")');
        $dbh = DB::connection()->getPdo();
        $sth = $dbh->prepare('call proc_cmpropbasket_trn("'.$basket.'","'.$applicationtype.'",'.$operation.','.$basket_id.',"'.$name.'","2")');
        $sth->execute();
        $message = '';
        if($operation == 1) {
            $message = 'Basket added successfully';
        } else {
            $message = 'Basket updated successfully';
        }
        //session(['not_msg' => $message]);
        return redirect('existspropertybasket');//Redirect::route('role',['message'=>$message]);

    }

    public function propertybaskettrn(Request $request){
        $basket = $request->input('basket');
        $basket_id = $request->input('basket_id');
        $applicationtype = $request->input('applicationtype');
        $operation = $request->input('operation');
        if($operation != 3) {
            $request->validate([
                'basket' => 'required',
                'applicationtype' => 'required',
            ]);
        }
        $name=Auth::user()->name;
        Log::info('call proc_cmpropbasket_trn("'.$basket.'","'.$applicationtype.'",'.$operation.','.$basket_id.',"'.$name.'")');
        $dbh = DB::connection()->getPdo();
        $sth = $dbh->prepare('call proc_cmpropbasket_trn("'.$basket.'","'.$applicationtype.'",'.$operation.','.$basket_id.',"'.$name.'","1")');
        $sth->execute();
        $message = '';
        if($operation == 1) {
            $message = 'Basket added successfully';
        } else {
            $message = 'Basket updated successfully';
        }
        //session(['not_msg' => $message]);
        return redirect('propertybasket');//Redirect::route('role',['message'=>$message]);

    }


    public function bldgareadetail(Request $request){
        $bldgid = $request->input('bldgid');
        //$bldgdetail = DB::select('select * from cm_bldgarea where ba_bl_id = '.$bldgid);
        $bldgdetail = DB::select('select cm_bldgarea.*, arzone.tdi_value arzone, arlvel.tdi_value arlvel, arcate.tdi_value arcate
        , artype.tdi_value artype
         from cm_bldgarea, (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREATYPE") artype,
        (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREACATEGORY") arcate,
        (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREALEVEL") arlvel,
        (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "AREAZONE") arzone  where arzone.tdi_key = BA_AREAZONE_ID
        and arlvel.tdi_key = BA_AREALEVEL_ID and arcate.tdi_key = BA_AREACATEGORY_ID and artype.tdi_key = BA_AREATYPE_ID and ba_bl_id = '.$bldgid);
        return response()->json(array('bldgdetail'=> $bldgdetail), 200);

    }

    public function validateAccount(Request $request){
        $param_value = $request->input('param_value');
        $TY = $request->input('TY');
        //$param = $request->input('param');PTBL
        $res_arr = 0;
        if($TY =='PTBL'){
            $result=DB::select('select count(*) count from cm_masterlist where ma_accno like "'.$param_value.'%"');
            foreach ($result as $obj) {    
                 $res_arr = $obj->count;
            }
        } else {

            $result=DB::select('select count(*) count from cm_masterlist where ma_accno = "'.$param_value.'"');
            foreach ($result as $obj) {    
                 $res_arr = $obj->count;
            }
        }
        Log::info($param_value);
        Log::info($result);
        return response()->json(array('res_arr'=> $res_arr), 200);
    }

    public function checkDigit(Request $request){
        $param_value = $request->input('param_value');
        //$param = $request->input('param');
        Log::info($param_value);
        $res_arr = 0;
        $accno = $param_value;//"19123456123";
        $a = 0;
        $b = 0;
        $c = 0;
        $d = 0;
        for($i =0; $i<strlen($accno);$i++){
            $a = 86 - $i;
            $b = intval(substr($accno , $i + 1, 1)) * $a;

        Log::info('post '.substr($accno , $i + 1, 1));
            $c = $c + $b;
        }
        Log::info($c);
        $a = intval($c / 9);
        $a = $a * 9;
        $b = $c - $a;
        $d = 9 - $b;
        
        Log::info($b);
        Log::info($d);
        $result=DB::select('select count(*) count from cm_masterlist where ma_accno = "'.$accno."".$d.'"');
        foreach ($result as $obj) {    
             $res_arr = $obj->count;
        }

        Log::info($res_arr);
        return response()->json(array('checkdigit'=> $d,'res_arr'=> $res_arr), 200);
    }
    
    
    public function approve(Request $request){
        $param_value = $request->input('param_value');
        $module = $request->input('module');
        $param = $request->input('param');
        $param_str = $request->input('param_str');
        $param_status = $request->input('param_status');
        $name=Auth::user()->name;
        //$param = $request->input('param');
        Log::info($module);
        //$register=DB::select("call proc_approvepropreg(".$param_value.",   '".$name."', '".$module."')"); 
        $propertycnt = 0;
        if ($module == 'valuation'){
           // $property=DB::select(" select * from cm_appln_valdetl where vd_approvalstatus_id in ('06') and vd_va_id = ".$param_value);
            $propertycnt = 0;
           // if ($propertycnt == 0){
            $register=DB::select("call proc_approvepropreg(".$param_value.",   '".$name."', '".$module."', '".$param."', '".$param_str."', '".$param_status."')");
           // }
        } else {
            Log::info("call proc_approvepropreg('".$param_value."',    '".$name."','".$module."', '".$param."', '".$param_str."', '".$param_status."')"); 
            $register=DB::select("call proc_approvepropreg(".$param_value.",   '".$name."', '".$module."', '".$param."', '".$param_str."', '".$param_status."')");

        }
      //  Log::info("call proc_approvepropreg('".$param_value."',    '".$name."','".$module."')"); 

        
        return response()->json(array('checkdigit'=> 'succsess','propertycnt'=>$propertycnt), 200);
    }


    
}
