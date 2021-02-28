<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use DB;
use Session;
use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DataTables;
use Storage;

class FileManagerController extends Controller
{
    
	  /**
       * Create a new controller instance.
       *
       * @return void
    **/
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function filemanager(Request $request){
        /* $term = $request->input('term');
            $term=DB::select('select fd_path, fd_name from cm_filestructurel where fd_term = '.$term);
            foreach ($term as $obj) {    
                $path = $obj->fd_path;  
                $name = $obj->fd_name;
            }
        */
         $search=DB::select(' select sd_key, sd_label, 
          case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid  , sd_keymainfield
        from tbsearchdetail mtb where sd_se_id = "23" order by sd_sort');
       // $config=DB::select('select config_value serveradd, GROUP_CONCAT(config_value SEPARATOR  ':') fileserver  from tbconfig where config_name = "host" ');
         
               $config=DB::select("select GROUP_CONCAT(config_value SEPARATOR  ':') serveradd from tbconfig  where config_name in ('host', 'port')");
            $attachtype=DB::table('tbdefitems')->where('tdi_td_name', 'ATTACHMENTTYPE')->get();

        foreach ($config as $obj) {    
           $serverhost = $obj->serveradd;
        }
        
        App::setlocale(session()->get('locale'));
        
        return view("dms.dms")->with('search',$search)->with('serverhost',$serverhost)->with('attachtype',$attachtype);
        
        // return view("filemanager.fm")->with('serverhost',$serverhost)->with('search',$search);
    }


     public function dmsSearchTables(Request $request){
        
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
            $dmstype = 2;
            Log::info($fieldcolumn);
           
            Log::info($dmstype);
             $dmstype = 0;
             foreach ($input['field'] as $fieldindex => $field) {
                if ($fieldcolumn[$fieldindex] == "tdi_key") {
                    $fieldcolumn[$fieldindex] = 'tbdefitems_subzone.tdi_key';
                }/*
                if ($fieldcolumn[$fieldindex] == "vt_id") {
                    $fieldcolumn[$fieldindex] = '';
                }*/

                


                 if( $fieldcolumn[$fieldindex] != 'attachtype'){
                  

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
                 
                  } else {
                        if($value[$fieldindex] == 0){
                          $dmstype = 1;
                       } else {
                          $dmstype = 2;
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
        if($dmstype == 2) {
            $property = DB::select("select vt_valbase_id, vt_id, vt_name name, vt_createby createby,  DATE_FORMAT(vt_createdate, '%d/%m/%Y') createdate, vt_updateby updateby, applntype.tdi_value applntype, 
                DATE_FORMAT(vt_updatedate, '%d/%m/%Y')  updatedate, ifnull(basket_count,0) basket_count, ifnull(property_count,0) property_count,DATE_FORMAT(vt_termDate, '%d/%m/%Y') termDate, DATE_FORMAT(now(), '%d/%m/%Y') enforceDate,  vt_applicationtype_id,
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
              on valbase.tdi_key = vt_valbase_id 
           ".$filterquery);

        } else{

           $property = DB::select('select vt_name, vt_termDate ,`cm_appln_valdetl`.`vd_accno`,
`tbdefitems_subzone`.`tdi_parent_name` zone, `tbdefitems_subzone`.`tdi_value` subzone,
`cm_appln_valdetl`.`vd_approvalstatus_id`, `cm_appln_valdetl`.`vd_id`, `cm_appln_valdetl`.`vd_va_id`, `cm_masterlist`.`ma_id`, `tbdefitems_bldgtype`.`tdi_value` `bldgtype`, `tbdefitems_ishasbuilding`.`tdi_value` `isbldg`,
`cm_masterlist`.`ma_pb_id`        , `tbdefitems_bldgtype`.`tdi_parent_name` `bldgcategory`,bldgsotery.tdi_value bldgsotery
FROM `cm_appln_valdetl`
JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
join cm_appln_val on va_id = vd_va_id
join cm_appln_valterm on vt_id = va_vt_id
LEFT JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
left join (select *  from tbdefitems where tdi_td_name = "PROPERTYSTAGE") propertstatus
on propertstatus.tdi_key = vd_approvalstatus_id 
left join (select *  from tbdefitems where tdi_td_name = "BUILDINGSTOREY") bldgsotery
on bldgsotery.tdi_key = vd_bldgstorey_id 
LEFT JOIN `tbdefitems_ishasbuilding` ON `cm_appln_valdetl`.`vd_ishasbuilding` = `tbdefitems_ishasbuilding`.`tdi_key`
LEFT JOIN `tbdefitems_bldgtype` ON `tbdefitems_bldgtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id`
     '.$filterquery);
        }
       // Log::info('select * from property where vd_approvalstatus_id = "13" '+$filterquery);
        $propertyDetails = Datatables::collection($property)->make(true);
   
        return $propertyDetails;
    }

    public function filemanagertrn(Request $request){
        $type = $request->input('type');
        $data = $request->input('data');
        $data_removed = $request->input('data_removed');
        $filename = $request->input('filename');
        $description = $request->input('desc');
        $propid = $request->input('propid');
       
        $data = str_replace('/', ' ', $data);
        $data = str_replace('\\', ' ', $data);
        $sql = "call proc_filmanager('".$data."','".$data_removed."','".$type."','".$filename."','".$description."',".$propid.")";

        Log::info($sql);
        $register=DB::select($sql);
        
        return view("filemanager.fm")->with('message',"success");
    }

    
    public function getFilelist(Request $request){
       // $type = $request->input('type');
        $id = $request->input('id');
     
        $result=DB::select("select at_id,at_name filename,at_path path, at_filename,
        at_createby, DATE_FORMAT(at_createdate, '%d/%m/%Y') 
at_createdate,
at_updateby, DATE_FORMAT(at_updatedate, '%d/%m/%Y') 
at_updatedate  from cm_attachment where at_linkid = ".$id);
        
       return response()->json(array('result'=> $result,'msg'=> "true"),200);
    }



    public function upload(Request $request){
       // $type = $request->input('type');
        $id = $request->input('id');
        $file = $request->file('path');
        $name = $request->input('name');
        $ext = $request->input('ext');
        $zone = $request->input('zone');
        $accnumber = $request->input('accnumber');
        $subzone = $request->input('subzone');
        
        $filepath ="cama/individual/".$zone."/".$subzone."/".$accnumber."/";
        Log::info($filepath);
        $exists = Storage::disk('local')->exists($filepath);
        if ($exists == ''){
            Storage::makeDirectory($filepath);
        }

        if(!empty($file)){
            $storepath = Storage::putFileAs(
                'cama/individual', $request->file('path'), $zone.'/'.$subzone.'/'.$accnumber.'/'.$name.'.'.$ext
            );

        }

        Log::info($storepath);
        
       return response()->json(array('msg'=> true,'storepath'=>$storepath),200);
    }

    public function download(Request $request){

        $id = $request->input('id');

        $attachment=DB::select(' select at_name, at_path,at_fileextention from cm_attachment  where at_id = '.$id);
        $headers = array();
        foreach ($attachment as $obj) {    
           $path = $obj->at_path; 
           $filename = $obj->at_name.'.'.$obj->at_fileextention;
           return Storage::download($path, $filename, $headers);
        }

        //return redirect('filemanager');
    }

    public function fileDelete(Request $request){
        $id = $request->input('id');
        $page = $request->input('page');

        $attachment=DB::select(' select at_name, at_path,at_fileextention from cm_attachment  where at_id = '.$id);
        $headers = array();
        foreach ($attachment as $obj) {    
           $path = $obj->at_path; 
           $filename = $obj->at_name;
           Log::info($path.'/'.$filename);
           Storage::delete($path);

        }


        if($page == 1){
          $username=Auth::user()->name;

          $proc=DB::select("call pro_termattachment_trn(".$id.",'','','','','','',2,'".$username."')");
        }

      // Log::info("");

         return response()->json(array('msg'=> true),200);
    }

    public function termUpload(Request $request){
       // $type = $request->input('type');
        $id = $request->input('id');
        $file = $request->file('path');
        $name = $request->input('name');
        $ext = $request->input('ext');
        $year = $request->input('year');
        $desc = $request->input('desc');
        $attachtype = $request->input('attachtype');
        $orgfilename = $request->input('orgfilename');
        
        $filepath ="cama/term/".$year."/".$id."/";
        Log::info($filepath);
        $exists = Storage::disk('local')->exists($filepath);
        if ($exists == ''){
            Storage::makeDirectory($filepath);
        }

        if(!empty($file)){
            $storepath = Storage::putFileAs(
                'cama/term', $request->file('path'), $year.'/'.$id.'/'.$name.'.'.$ext
            );

        }
$username=Auth::user()->name;

        Log::info("call pro_termattachment_trn(".$id.",'".$storepath."','".$name."','".$orgfilename."','".$desc."','".$ext."','".$attachtype."',1,'".$username."')");
        $proc=DB::select("call pro_termattachment_trn(".$id.",'".$storepath."','".$name."','".$orgfilename."','".$desc."','".$ext."','".$attachtype."',1,'".$username."')");

        
       return response()->json(array('msg'=> true,'storepath'=>$storepath),200);
    }
        

}

