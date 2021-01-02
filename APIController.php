<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use DB;

class APIController extends Controller
{
     public function getValuationlist($id){
            //$prop_id = $request->input('id');
            //$pb = $request->input('pb');
            // $name=Auth::user()->name;
            //Log::info('tt '.$prop_id);
            Log::info('rrt '.$id);
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
            FROM `cama`.`tbtaxinterface` ');

             return response()->json($tax, 200);
             
        
    }

    public function getValuation($id){
        //$prop_id = $request->input('id');
        //$pb = $request->input('pb');
       // $name=Auth::user()->name;
        
            //Log::info('tt '.$prop_id);
            Log::info('rrt '.$id);
             $tax = DB::select('select `vt_id`, `vt_vd_id`, vt_derivedrate, vt_derivedvalue, `vt_grossvalue`, `vt_valuedescretion`, `vt_proposednt`, `vt_proposedrate`, `vt_calculatedrate`,  
`vt_proposedtax`, `vt_approvednt`,  `vt_approvedrate`, `vt_adjustment`,  `vt_approvedtax`,  `vt_note`,
`vt_createby`,  `vt_createdate`,  `vt_updateby`,  `vt_updatedate`
FROM `cm_appln_val_tax` where vt_vd_id = ifnull("'.$id.'",0)');

             return response()->json($tax, 200);
             
        
    }

}