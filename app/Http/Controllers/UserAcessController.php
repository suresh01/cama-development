<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Log;
use DB;
use App;

class UserAcessController extends Controller
{
    // 
    public static function checkaccess($module){

        $msg = "false";
        
        $name=Auth::user()->name;

        $permission = DB::select(DB::raw("select mod_id, mod_name,usr_name from tbuser, tbrole, tbmodule, tbaccess where usr_role_id = rol_id 
            and acc_role_id = rol_id and acc_module_id = mod_id and usr_name = :uf and mod_id = :up"), 
            array(":uf" => $name, ":up" => $module));
        //Log::info($permission);
        foreach ($permission as $obj) {            
            $msg = "true";                   
        }
       // Log::info($msg);
        return $msg;
    }

    public static function accessDetail($module){
        
       // $msg = "false";
        
        //$name=Auth::user()->name;

        $detail = DB::select("select mod_id moduleid, mod_name name from tbmodule where mod_id = '".$module."'");
        //Log::info($permission);
        
        //Log::info($msg);
        return $detail;
    }
}
