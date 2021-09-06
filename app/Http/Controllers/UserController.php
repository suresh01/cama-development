<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Log;
use DB;
use Session;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegisteration;
use App\Mail\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Category;
use userpermission;
use App;

class UserController extends Controller
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

    public function languageSetup(Request $request){
        $lang = $request->input('lang'); // passed from the form
        Log::info('Test');
Log::info($lang);
       // App::setlocale('en');
        session()->put('locale', $lang); 

       // app()->setLocale('en'); 
       /* Session::put('locale', $locale);

        app()->setLocale(Session::get('locale'));*/
 //Log::info("End");


        return redirect('dashboard');
    }

    function dashboard(){

        $module=DB::select('select * from tbmodule');  
        //$users = DB::connection('oracle')->select('select * from TB_AGAMA_WORK');      
        //Log::info($users);
        App::setlocale(session()->get('locale'));
        //return view('module')->with('module',$module);
        //$pdo = DB::connection('oracle')->getPdo();
       // $store = DB::connection('oracle')->select('select * from PEMILIK_SB');
       // $result = DB::connection('oracle')->update(" update PEMILIK_SB SET NAMA = 'TEST' WHERE ID = '315116007368'");
       //  dd($costcenter);
        // Log::info($store);
       //  return view('outlets.create',['names' => $brands, 'storenames' => $data,'costcenter' => $costcenter ]);

        return view('dashboard')->with('module',$module);
    }

    //
    function index(Request $request){
	    $name = $request->input('username');
	    $pass = $request->input('password');
        $lang = $request->input('lang');
	    $errors ="";
	    //$query=DB::select("select user_name from tbuser where user_name = 'admin'");

	    $params = [
            'user_name' => $name,
         ];

	    //$query=DB::addBindingsToStatement("select user_name from tbuser",$bindings);
        //$data=DB::select('select * from tbuser');

        $userlogin = DB::select(DB::raw("select * from tbuser WHERE usr_name = :uf and usr_pass = :up"), 
            array(":uf" => $name, ":up" => $pass));        
        /*
    	    $query = DB::table('tbuser');
    	    $query->where('user_name', "=" ,$name)->get();       	    
       		$userlogin = DB::select($query->toSql(),$params);
    	    Log::info($query->toSql());*/

		foreach ($userlogin as $user) {    
            Session::put('username', $name);  
           
    	    //if($user->user_name == "admin") {
    	    return redirect('dashboard'); 
                
    	    //} 
        }
        
        $err_msg ="username or password incorrect";
        App::setlocale(session()->get('locale'));
        return view("index")->with('errors', 'true')->with('err_msg', $err_msg);
    }


    public function user(){     
       if(userpermission::checkaccess('711')=="false"){
            $detail = UserAcessController::accessDetail('711');
            return view('denied')->with('detail',$detail);
        }   
       /* if($this->checkaccess('711') == "false"){
            return view('denied');
        }*/
        $role=DB::select('select * from tbrole');	
        $user=DB::select('select * from tbuser, tbrole where usr_role_id = rol_id ');
        $name=Auth::user()->email;
        $access_previlige = DB::select(DB::raw("select mod_id, mod_name from tbuser, tbrole, tbmodule, tbaccess where usr_role_id = rol_id and acc_role_id = rol_id and acc_module_id = mod_id and usr_name = :uf"),
            array(":uf" => $name));
        //Log::info($access_previlige);
        //Log::info($role);
        App::setlocale(session()->get('locale'));
        return view('user')->with('role',$role)->with('user',$user)->with('access_previlige',$access_previlige);
    }

    /*
     *
     */
    public function usertrn(Request $request){  
       if(userpermission::checkaccess('711')=="false"){
            $detail = UserAcessController::accessDetail('711');
            return view('denied')->with('detail',$detail);
        }   
         $name = $request->input('username');
         $address = $request->input('address');
         $position = $request->input('position');
         $position2 = $request->input('position2');
         $role = $request->input('role');
         $phone = $request->input('phoneno');
         $operation = $request->input('operation');
         $userid = $request->input('userid');
         $status = $request->input('status');
         $mail = $request->input('mail');
         $firstname = $request->input('fname');
         $lastname = $request->input('lname');
         $reserved = $request->input('reserved');
         $nokp = $request->input('nokp');

         /*$usernamevalid=DB::select('select * from tbuser where usr_name = :un',
            array(":un" => $name));
         $flag = "";
         foreach ($usernamevalid as $user) {            
            
         }*/

         //Log::info($reserved);

        $msg = "true";

        $user=DB::select('select * from tbuser where usr_name = :un',
            array(":un" => $name));
        
        foreach ($user as $var) {            
            $msg = "false";
        }

        $random_pass = '1234';//str_random(8);
        $message = '';

        if($operation == 3){
            
            $user=DB::select('call proc_tbuser_trn("'.$request->input('delusername').'","","","",0,"'.$position.'"
                    ,"'.$position2.'","'.$phone.'",0,0,0,'.$operation.','.$userid.',"'.$mail.'","'.$firstname.'","'.$lastname.'")');
            $message = 'User deleted successfully';
        } else {
            $request->validate([
                'username' => 'required|string',
                'role' => 'required|string',
                'position' => 'required|string',
                'phoneno' => 'required|string',
                'address' => 'required|string',
                'mail' => 'required|email',
                'status' => 'required',
                'fname' => 'required',
                'lname' => 'required',
            ]);
        }
        
        if($operation == 1) {
            if($msg == "true") {      

                $pass = Hash::make($random_pass);
                $user=DB::select('call proc_tbuser_trn("'.$name.'","'.$address.'","'.$pass.'","'.$nokp.'",'.$role.',"'.$position.'"
                    ,"'.$position2.'","'.$phone.'",0,'.$status.','.$reserved.','.$operation.','.$userid.',"'.$mail.'","'.$firstname.'","'.$lastname.'")');

                User::create([
                    'name' => $name,
                    'email' => $name,
                    'password' => $pass,
                ]);

               // Mail::to($mail)->send(new UserRegisteration($random_pass));
                $message = 'User added successfully';
            }
        }  else if($operation == 2) {
            $user=DB::select('call proc_tbuser_trn("'.$name.'","'.$address.'","","'.$nokp.'",'.$role.',"'.$position.'"
                    ,"'.$position2.'","'.$phone.'",0,'.$status.','.$reserved.','.$operation.','.$userid.',"'.$mail.'","'.$firstname.'","'.$lastname.'")');
            $message = 'User updated successfully';
        }
        
        session(['not_msg' => $message]);

        return redirect('user');

    }

    public function role(Request $request){     
       if(userpermission::checkaccess('712')=="false"){
            $detail = UserAcessController::accessDetail('712');
            return view('denied')->with('detail',$detail);
        }     
        $role=DB::select('select * from tbrole');
        App::setlocale(session()->get('locale'));
        return view('role')->with('role',$role);
    }

    /*
     *
     */
    public function roletrn(Request $request){  
       if(userpermission::checkaccess('712')=="false"){
            $detail = UserAcessController::accessDetail('712');
            return view('denied')->with('detail',$detail);
        }   

        $role = $request->input('rolename');
        $description = $request->input('description');
        $access = $request->input('access');
        $operation = $request->input('operation');
        $user_id = 0;
        $role_id =  $request->input('role_id');

        $request->validate([
            'rolename' => 'required',
            'description' => 'required|max:255',
            'access' => 'required',
        ]);

        /*$params = [
        'p_rolename' => $role, 
        'p_description' => $description,
        'p_access'    => $access,
        'p_operation'    => $operation, 
        'p_user_id' => $user_id,
        'p_role_id' => $role_id,
        ];*/

        /*$user=DB::select('call proc_tbrole_trn(:p_role,:p_desc,:p_acc,:p_operation,:p_userid,:p_roleid)',
            ['p_role' => $role],['p_desc' => $description],['p_acc' => $access],['p_operation' => $operation],['p_userid' => $user_id],['p_roleid' => $role_id]);*/

        // $user=DB::select('call proc_tbrole_trn("'.$role.'","'.$description.'",'.$access.','.$operation.','.$user_id.','.$role_id.')');
        $dbh = DB::connection()->getPdo();
        $sth = $dbh->prepare('call proc_tbrole_trn("'.$role.'","'.$description.'",'.$access.','.$operation.','.$user_id.','.$role_id.')');
        $sth->execute();
        $message = '';
        if($operation == 1) {
            $message = 'Role added successfully';
        } else {
            $message = 'Role updated successfully';
        }
        session(['not_msg' => $message]);
        return redirect('role');//Redirect::route('role',['message'=>$message]);

    }

    public function module(){
          
       if(userpermission::checkaccess('713')=="false"){
            $detail = UserAcessController::accessDetail('713');
            return view('denied')->with('detail',$detail);
        }   
 
        ini_set('memory_limit', '2056M');
        $module=DB::select('select * from tbmodule');        

        App::setlocale(session()->get('locale'));
        return view('module')->with('module',$module);
    }

    /*
     *
     */
    public function moduletrn(Request $request){

       if(userpermission::checkaccess('713')=="false"){
            $detail = UserAcessController::accessDetail('713');
            return view('denied')->with('detail',$detail);
        }   

         $name = $request->input('modulename');
         $description = $request->input('description');
         $parent = $request->input('parent');
         $permission = $request->input('status');
         $operation = $request->input('operation');
         $module_id = $request->input('module_id');

         $request->validate([
            'module_id' => 'required',
            'modulename' => 'required',
            'description' => 'required',
            'parent' => 'required',
            'status' => 'required',
        ]);

         /*$params = [
            'p_name' => $name, 
            'p_description' => $description,
            'p_parent'    => $parent,
            'p_permission'=> $permission, 
            'p_operation' => $operation,
            'p_module_id' => $module_id,
         ];*/
        //$user=DB::executeProcedure('proc_tbmodule_trn',$params);
         $user=DB::select('call proc_tbmodule_trn("'.$name.'","'.$description.'",'.$parent.','.$permission.','.$operation.','.$module_id.')');
        $message = '';
        if($operation == 1) {
            $message = 'Module added successfully';
        } else {
            $message = 'Module updated successfully';
        }       
        session(['not_msg' => $message]);
        return redirect('module');
    }

   

    public function access(){
       if(userpermission::checkaccess('714')=="false"){
            $detail = UserAcessController::accessDetail('714');
            return view('denied')->with('detail',$detail);
        }   
        
        $parentmoudle = DB::select(DB::raw("select * from tbmodule WHERE mod_parent = :mp"), 
            array(":mp" => 0));
        $module=DB::select('select * from tbmodule');
        $access=DB::select('select * from tbaccess');	
        $accessv=DB::select('select * from tbaccess_v');
        $roles=DB::select('select * from tbrole');  
        $categories = Category::where('mod_parent', '=', 0)->get();
        $allCategories = Category::pluck('mod_name','mod_id')->all();    
        //Log::info($accessv);     
        App::setlocale(session()->get('locale'));
        return view('newaccess',compact('categories','allCategories'))->with('access',$access)->with('accessv',$accessv)
        ->with('module',$module)->with('role',$roles)->with('parentmoudle',$parentmoudle);
    }

    public function getaccessajax(Request $request){
        $module_id = $request->input('module_id');
         $accessls = DB::select(DB::raw("select rol_id from tbaccess_v WHERE mod_id = :mp"), 
            array(":mp" => $module_id));    
$roles = '';
         foreach ($accessls as $rec) {    
            $roles = $rec->rol_id;
                
            //} 
        }
        //Log::info($accessv);     
        return response()->json(array('roles'=> $roles), 200);
    }

    /*
     *
     */
    /*public function accesstrn(Request $request){
         $module_id = $request->input('module_id');
         $role_id = $request->input('s_role_id');
         $readonly = $request->input('readonly');
         $hide = $request->input('hide');
         $operation = $request->input('operation');
         $access_id = $request->input('access_id');
         $readonly = 0;
         $hide = 0;
         $access_id = 0;

         $params = [
            'p_module_id' => $module_id, 
            'p_role_id' => $role_id,
            'p_readonly'    => $readonly,
            'p_hide'    => $hide, 
            'p_operation' => $operation,
            'p_access_id' => $access_id,
         ];
        Log::info('call proc_tbaccess_trn('.$module_id.',"'.$role_id.'",'.$readonly.','.$hide.','.$operation.','.$access_id.')');  
        //$user=DB::executeProcedure('proc_tbaccess_trn',$params);
         $user=DB::select('call proc_tbaccess_trn('.$module_id.',"'.$role_id.'",'.$readonly.','.$hide.','.$operation.','.$access_id.')');

        return redirect('access');
    }*/

    public function accesstrn(Request $request){

       if(userpermission::checkaccess('714')=="false"){
            $detail = UserAcessController::accessDetail('714');
            return view('denied')->with('detail',$detail);
        }   

          
        $module_id = $request->input('module_id');
         $role_id = $request->input('s_role_id');
         $readonly = $request->input('readonly');
         $hide = $request->input('hide');
         $operation = $request->input('operation');
         $access_id = $request->input('access_id');
         $readonly = 0;
         $hide = 0;
         $access_id = 0;
         $msg = "false"; 
        
    Log::info('call proc_tbaccess_trn('.$module_id.')');

     Log::info('Tested');

        $user=DB::select('call proc_tbaccess_trn('.$module_id.',"'.$role_id.'",'.$readonly.','.$hide.','.$operation.','.$access_id.')');
        $msg = "true";   

        return response()->json(array('msg'=> $msg), 200);
    }

    public function getaccess(Request $request){
        $msg = "false";
        $module_name = "";
        $module = $request->input('module');
        $name=Auth::user()->name;

        $permission = DB::select(DB::raw("select mod_id, mod_name,usr_name from tbuser, tbrole, tbmodule, tbaccess where usr_role_id = rol_id 
            and acc_role_id = rol_id and acc_module_id = mod_id and usr_name = :uf and mod_id = :up"), 
            array(":uf" => $name, ":up" => $module));
        //Log::info($permission);
        foreach ($permission as $obj) {            
            $msg = "true";                    
           // $msg = "true";                   
        }

        return response()->json(array('msg'=> $msg), 200);
    }


    public function resetpassword(Request $request){  
       if(userpermission::checkaccess('711')=="false"){
            $detail = UserAcessController::accessDetail('711');
            return view('denied')->with('detail',$detail);
        }   
            
        $msg = "true";
        $username = $request->input('username');
        $password = '1234';//str_random(8);
        $mail = $request->input('mail');
        
        //Log::info($params);
        //$user=DB::executeProcedure('proc_tbuser_trn',$params);
        $user=DB::select('call proc_tbuser_trn("'.$username.'","","'. Hash::make($password).'","",0,"","",0,0,0,0,4,0,"","","")');
        //Mail::to($mail)->send(new PasswordReset($password ));
        return response()->json(array('msg'=> $msg), 200);
    }

     public function getValidUser(Request $request){
        $msg = "true";
        $username = $request->input('username');


        $user=DB::select('select * from tbuser where usr_name = :un',
            array(":un" => $username));
        
        foreach ($user as $var) {            
            $msg = "false";
        }

        return response()->json(array('msg'=> $msg), 200);
    }

    public function valuationdata(Request $request){
        $data = DB::select("select (2*rownum)-1 id,a_bangunan_work.bangunan_nobangunan, tb_jenisbangunan_work.jenisbangunan_nama, maklumatluasutama_work.luasutama_jenisaras_id, maklumatluasutama_work.luasutama_tot_nlfa 
            from cama.maklumatluasutama_work, cama.a_bangunan_work, cama.tb_jenisbangunan_work
            where a_bangunan_work.bangunan_idx = maklumatluasutama_work.luasutama_bangunan_idx 
            and a_bangunan_work.bangunan_jenisbangunan = tb_jenisbangunan_work.jenisbangunan_id order by a_bangunan_work.bangunan_nobangunan");  
        return response()->json(array('data'=> $data), 200);
    }

    public function search() {  
       if(userpermission::checkaccess('73')=="false"){
            $detail = UserAcessController::accessDetail('73');
            return view('denied')->with('detail',$detail);
        }   

        ini_set('memory_limit', '2056M');
        $search=DB::select('select * from tbsearch');
        $module=DB::select('select * from tbmodule');
      //  $categories = Category::where('mod_parent', '=', 0)->get();
      //  $allCategories = Category::pluck('mod_name','mod_id')->all();
       // return view('categoryTreeview',compact('categories','allCategories'));
        App::setlocale(session()->get('locale'));
        return view('search/search')->with('tsearch',$search)->with('module',$module);
    }

    /*
     *
     */
    public function searchtrn(Request $request){  
       if(userpermission::checkaccess('73')=="false"){
            $detail = UserAcessController::accessDetail('73');
            return view('denied')->with('detail',$detail);
        }   

        $search_name = $request->input('search_name');
        $search_query = $request->input('search_query');
        $description = $request->input('description');
        $operation = $request->input('operation');
        $se_id = $request->input('se_id');
        $mod_id = $request->input('mod_id');
         
        //Log::info( $params);   
        //$user=DB::executeProcedure('proc_tbaccess_trn',$params);
        $user=DB::select('call proc_tbsearch_trn("'.$search_name.'","'.$search_query.'","'.$description.'",'.$operation.','.$se_id.','.$mod_id.')');

        return redirect('search');
    }

    public function searchdetail(Request $request){
        $se_id = $request->input('se_id');
        $transaction = $request->input('transaction');
        if($transaction == 'proc'){
             $operation = $request->input('operation');
             $key_name = $request->input('key_name');
             $key_type = $request->input('key_type');
             $table_name = $request->input('table_name');
             $table_field_name = $request->input('table_field_name');
             $def_source = $request->input('def_source');
             $def_keyid = $request->input('def_keyid');
             $def_keyname = $request->input('def_keyname');
             $def_filterkey = $request->input('def_filterkey');
             $def_fieldid = $request->input('def_fieldid');
             $custom = $request->input('custom');
             $custom_include = $request->input('custom_include');
             $se_id = $request->input('se_id');
             $sd_id = $request->input('sd_id');
             $label_name = $request->input('label_name');

            //Log::info( $params);  
            //$user=DB::executeProcedure('proc_tbaccess_trn',$params);
             $user=DB::select('call proc_tbsearchdetail__trn('.$se_id.',"'.$key_name.'",'.$key_type.',"'.$table_name.'"
                ,"'.$table_field_name.'","'.$def_source.'","'.$def_keyid.'","'.$def_keyname.'","'.$def_filterkey.'","'.$def_fieldid.'",'.$custom.','.$custom_include.','.$operation.','.$sd_id.',"'.$label_name.'")');
        }
        $searchdetail=DB::select('select * from tbsearchdetail where sd_se_id = :se_id', 
            array(":se_id" => $se_id));
        
        $keytype = DB::select('select * from tbsearchkeytype');
        App::setlocale(session()->get('locale'));
        return view('search/searchdetail')->with('tsearchdetail',$searchdetail)->with('keytype',$keytype)->with('se_id',$se_id);
    }

    /*
     *
     */
    public function searchdetailtrn(Request $request){
         $operation = $request->input('operation');
         $key_name = $request->input('key_name');
         $key_type = $request->input('key_type');
         $table_name = $request->input('table_name');
         $table_field_name = $request->input('table_field_name');
         $def_source = $request->input('def_source');
         $def_keyid = $request->input('def_keyid');
         $def_keyname = $request->input('def_keyname');
         $def_filterkey = $request->input('def_filterkey');
         $def_fieldid = $request->input('def_fieldid');
         $custom = $request->input('custom');
         $custom_include = $request->input('custom_include');
         $se_id = $request->input('se_id');

        //Log::info( $params);  
        //$user=DB::executeProcedure('proc_tbaccess_trn',$params);
         $user=DB::select('call proc_tbsearchdetail__trn('.$se_id.',"'.$key_name.'",'.$key_type.',"'.$table_name.'"
            ,"'.$table_field_name.'","'.$def_source.'","'.$def_keyid.'","'.$def_keyname.'","'.$def_filterkey.'","'.$def_fieldid.'",'.$custom.','.$custom_include.','.$operation.',0)');

        return redirect('searchdetail')->with('se_id',$se_id);
    }

    public function sa() {
        $search=DB::select('select * from tbsearchdetail');
        return view('search/sample')->with('tsearch',$search);
    }

    public function profile() {
        $name=Auth::user()->email;
        Log::info( $name);
        //Log::info( );
        //Log::info(Auth::logoutOtherDevices(Auth::user()->password));
        $user=DB::select('select * from tbuser where usr_name = :un',
            array(":un" => $name));
        //$search=DB::select('select * from tbsearchdetail');
        App::setlocale(session()->get('locale'));
        return view('profile')->with('profile',$user);
    }

    /*public function changePassword(Request $request){
        $request->validate([
            'module_id' => 'required',
            'modulename' => 'required',
            'description' => 'required',
            'parent' => 'required',
            'status' => 'required',
        ]);

        return redirect("profile");
    }*/


    public function changePassword(Request $request){
        
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        
        if(strcmp($request->get('current-password'), $request->get('password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        if(strcmp($request->get('confirm_password'), $request->get('password')) != 0){
            // password and confirm password are not same
            return redirect()->back()->with("error","New Password and Confirm password are not same.");
        }
        
        $validatedData = $request->validate([
            'current-password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
        ]);
        
        $name=Auth::user()->name;
        $pass=bcrypt($request->get('password'));

        //Change Password
        /*$user = Auth::user();
        $user->password = bcrypt($request->get('password'));
        $user->save();*/
        $user=DB::select('call proc_tbuser_trn("'.$name.'","","'.$pass.'","",0,""
                        ,"","",0,0,0,4,0,"","","")');
        request()->user()->fill([
            'password' => Hash::make($request->get('password'))
        ])->save();
        request()->session()->flash('message', 'Password changed successfully !');


        //session(['msg_pwd' => 'Password changed successfully !']);
        //Session::put('msg_pwd', 'Password changed successfully !');
        return redirect("profile")->with('passwordchange', 'true')->with("message","Password changed successfully !");

    }

    public function codeMaintenance() {
       if(userpermission::checkaccess('31')=="false"){
            $detail = UserAcessController::accessDetail('31');
            return view('denied')->with('detail',$detail);
        }
        ini_set('max_execution_time', '360');
        ini_set('memory_limit', '2056M');
       // Log::info(1 );
        //Log::info(Auth::logoutOtherDevices(Auth::user()->password));
        $result=DB::select('select pd_name, pd_parent, pd_desc,pd_search_mod,pd_tdi_value_lenght, (select count(*) from tbpardef t where t.pd_parent = tbpardef.pd_name) childcount, 
(select count(tdi_key) from tbdefitems where tdi_td_name = pd_name) itemcount from tbpardef  order by pd_name');
        $searchmodule = DB::select('select se_id, se_name from tbsearch');
        App::setlocale(session()->get('locale'));
       // Log::info(2);
        //$search=DB::select('select * from tbsearchdetail');
        App::setlocale(session()->get('locale'));
        return view('codemaintenance')->with(array('searchmodule' => $searchmodule, 'codemaintenance' =>$result));
    }

    public function codeMaintenancetrn(Request $request) {
       if(userpermission::checkaccess('31')=="false"){
            $detail = UserAcessController::accessDetail('31');
            return view('denied')->with('detail',$detail);
        }
         $pd_name = $request->input('pd_name');
         $pd_parent = $request->input('pd_parent');
         $pd_desc = $request->input('pd_desc');
         $pd_lenght = $request->input('pd_lenght');
         $search_module = $request->input('search_module');
         $operation = $request->input('operation');

          $name=Auth::user()->name;
        //Log::info( $params);  
        //$user=DB::executeProcedure('proc_tbaccess_trn',$params);
         $user=DB::select('call proc_tbpardef_trn("'.$pd_name.'","'.$pd_desc.'","'.$pd_parent.'",'.$search_module.','.$pd_lenght.'
            ,"'.$name.'",'.$operation.')');
        if($operation == 1) {
            $message = 'Parameter added successfully';
        } else if($operation == 2) {
            $message = 'Parameter updated successfully';
        }   else if($operation == 3) {
            $message = 'Parameter deleted successfully';
        } 
        App::setlocale(session()->get('locale'));
        session(['not_msg' => $message]);
        return redirect('codemaintenance');
    }

    public function codemaintenancedetail(Request $request){
       if(userpermission::checkaccess('3112')=="false"){
            $detail = UserAcessController::accessDetail('3112');
            return view('denied')->with('detail',$detail);
        }
        $td_name = $request->input('name');
        $transaction = $request->input('transaction');
        $isfilter = $request->input('filter');
        $id = $request->input('id');
        $page = $request->input('page');

        $cond = '';
        if($id != ''){
            $cond =' and tdi_parent_key ='.$id;
            $parend=DB::select("select pd_name, pd_parent FROM tbpardef where pd_parent = '".$td_name."' ");

            foreach ($parend as $obj) {   
                if($obj->pd_parent != 'Root') {
                   $td_name = $obj->pd_name;
                } 

                           
            }
        }

        if($page != ''){
             $td_name = $page;
        }


        $name=Auth::user()->name;
        if( $transaction == 'proc'){
            $operation = $request->input('operation');
            $key_name = $request->input('parameterkey');
            $value = $request->input('parametervalue');
            $desc = $request->input('desc');
            $sort = $request->input('sort');
            $parent = $request->input('parent');

            if($operation == 1) {
                $message = 'Parameter added successfully';
            } else if($operation == 2) {
                $message = 'Parameter updated successfully';
            } else if($operation == 3) {
                $message = 'Parameter deleted successfully';
            } 
            session(['not_msg' => $message]);
            //Log::info( $params);  
            //$user=DB::executeProcedure('proc_tbaccess_trn',$params);
             $user=DB::select('CALL `proc_tbdefitems_trn`("'.$td_name.'", "'.$key_name.'", "'.$value.'", "'.$desc.'","'.$parent.'", '.$sort.', "'.$name.'", '.$operation.')');
        }

        if($isfilter == 'true'){
            $input = $request->input();
            $condition = $input['condition'];
            $value = $input['value'];
            $logic = $input['logic'];
            $fieldcolumn = $input['field'];
            $filterquery = '';
            
            foreach ($input['field'] as $fieldindex => $field) {
                //$columnquery = DB::select('select sd_definitionkeyid,sd_keymainfield, sd_definitionkeyname,sd_custom, sd_custominclude FROM tbsearchdetail where sd_key = "'.$field.'"');
                
                if($value[$fieldindex] != ""){
                    if($fieldindex == count($input['field']) - 1) {
                        $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' "'.$value[$fieldindex].'"'; 

                    } else {
                        $filterquery = $filterquery. ' '.$fieldcolumn[$fieldindex].' '.$condition[$fieldindex].' "'.$value[$fieldindex].'" '.$logic[$fieldindex];       
                    }
                }
                
            }

           

            if($filterquery != ''){
                 /*Log::info('select tdi_td_name,tdi_key,tdi_value,tdi_parent_name,tdi_parent_key,tdi_desc, tdi_updateat, tdi_updateby,tdi_sort from tbdefitems
                where tdi_td_name = "'.$td_name.'"  and '.' '.$filterquery.' order by tdi_parent_key,tdi_sort');*/
                $codedetail=DB::select('select tdi_td_name,tdi_key,tdi_value,tdi_parent_name,tdi_parent_key,tdi_desc, tdi_updateat, tdi_updateby,tdi_sort,
                (select count(*) from tbpardef t where t.pd_parent = tdi_td_name) childcount from tbdefitems
                where tdi_td_name = :td_name '.$cond.'  and '.' '.$filterquery.' order by tdi_parent_key,tdi_sort', 
                array(":td_name" => $td_name)); 
                /*Log::info( 'select tdi_td_name,tdi_key,tdi_value,tdi_parent_name,tdi_parent_key,tdi_desc, tdi_updateat, tdi_updateby,tdi_sort from tbdefitems
                where tdi_td_name = :td_name  and '.' '.$filterquery.' order by tdi_parent_key,tdi_sort'); */ 
            } else {
                $codedetail=DB::select('select tdi_td_name,tdi_key,tdi_value,tdi_parent_name,tdi_parent_key,tdi_desc, tdi_updateat, tdi_updateby,tdi_sort, (select count(*) from tbpardef t where t.pd_parent = tdi_td_name) childcount from tbdefitems
                where tdi_td_name = :td_name  '.$cond.'   order by tdi_parent_key,tdi_sort ', 
                array(":td_name" => $td_name));
            }
            
        } else {
            $codedetail=DB::select('select tdi_td_name,tdi_key,tdi_value,tdi_parent_name,tdi_parent_key,tdi_desc, tdi_updateat, tdi_updateby,tdi_sort, (select count(*) from tbpardef t where t.pd_parent = tdi_td_name) childcount from tbdefitems
                where tdi_td_name = :td_name  '.$cond.'   order by tdi_parent_key,tdi_sort', 
                array(":td_name" => $td_name));

        }

        //$lastusedcode = DB::select('select max(tdi_key) tdi_key, tdi_td_name from tbdefitems where tdi_td_name ="'.$td_name.'" group by tdi_td_name');
        $par ='';
        if($id != ''){
            $par = 'tdi_parent_key ="'.$id.'" and ';
        }
        $lastusedcode = DB::select('select max(tdi_key) tdi_key, tdi_td_name from tbdefitems where '.$par.' tdi_td_name ="'.$td_name.'" group by tdi_td_name');
Log::info('---'.$id.'---');

Log::info('select max(tdi_key) tdi_key, tdi_td_name from tbdefitems where '.$par.' tdi_td_name ="'.$td_name.'" group by tdi_td_name');
        $childparent = DB::select('select tdi_key, tdi_value from tbdefitems where tdi_td_name = (select pd_parent from tbpardef where pd_name = :pd_name  ) order by tdi_sort', 
                array(":pd_name" => $td_name));

        $search=DB::select(' select sd_key, sd_label, 
        case when (select count(*) from tbsearchdetail temp where temp.sd_definitionfilterkey =  mtb.sd_key and temp.sd_se_id =  mtb.sd_se_id) > 0 
        then sd_definitionfieldid when sd_definitionsource = "" then sd_keymainfield  else sd_definitionkeyid end as sd_definitionkeyid 
        from tbsearchdetail mtb where sd_se_id = (SELECT pd_search_mod FROM tbpardef where pd_name ="'.$td_name.'")');
         $lastcode ="";
        foreach ($lastusedcode as $rec) {            
            $lastcode = $rec->tdi_key;
        }     

        //$tsearch =DB::select($column);

        $isparent=DB::select('select pd_parent,pd_tdi_value_lenght as length from tbpardef where pd_name = :td_name', 
            array(":td_name" => $td_name));

        App::setlocale(session()->get('locale'));


        return view('codemaintenancedetail')->with('codedetail',$codedetail)->with('name',$td_name)->with('isparent',$isparent)->with('search',$search)->with('childparent',$childparent)->with('lastcode',$lastcode)->with('id',$id);
    }

    public function codemaintenancedetailtrn(Request $request){
        $td_name = $request->input('name');
        $transaction = $request->input('transaction');
        $isfilter = $request->input('filter');

        $name=Auth::user()->name;
        if( $transaction == 'proc'){
             $operation = $request->input('operation');
             $key_name = $request->input('parameterkey');
             $value = $request->input('parametervalue');
             $desc = $request->input('desc');
             $sort = $request->input('sort');
             $parent = $request->input('parent');

             if($operation == 1) {
                $message = 'Parameter added successfully';
            } else if($operation == 2) {
                $message = 'Parameter updated successfully';
            }   else if($operation == 3) {
                $message = 'Parameter deleted successfully';
            } 
            session(['not_msg' => $message]);
            //Log::info( $params);  ;
            //$user=DB::executeProcedure('proc_tbaccess_trn',$params);
             $user=DB::select('CALL `proc_tbdefitems_trn`("'.$td_name.'", "'.$key_name.'", "'.$value.'", "'.$desc.'","'.$parent.'", '.$sort.', "'.$name.'", '.$operation.')');
        }

        App::setlocale(session()->get('locale'));
        return redirect()->route('codemaintenancedetail', ['name' => $td_name]);
    }


    public function getFilterData(Request $request){
        $msg = "true";
        $id = $request->input('id');
        $searchid = $request->input('searchid');
        $filter = $request->input('filter');
        $type = $request->input('type');
        $parentvalue = $request->input('parentvalue');
        $condition = "";
         $parentid = $request->input('parentid');
        if($filter == "true"){
           
            if ($id == 'Basket'){          
               Log::info( " and va_vt_id = '".$parentid."'");
            } else {
                $condition = " and tdi_parent_key = '".$parentid."'";
            }            
        }
        
       
        if($searchid == ''){
            $searchid = '0';
        }

        Log::info('select sd_key, sd_definitionsource, sd_definitionkeyid,sd_keymainfield, sd_definitionkeyname,sd_custom, sd_custominclude,sd_definitionfilterkey,(select ifnull(sd_label,"") from tbsearchdetail t where t.sd_key = mtb.sd_definitionfilterkey and sd_se_id = ifnull('.$searchid.',"0")) parent_label FROM tbsearchdetail mtb where  sd_se_id = '.$searchid.' and sd_label =   "'.$id.'"');
        $parent = "";
        $query=DB::select('select sd_key, sd_definitionsource, sd_definitionkeyid,sd_keymainfield, sd_definitionkeyname,sd_custom, sd_custominclude,sd_definitionfilterkey,(select ifnull(sd_label,"") from tbsearchdetail t where t.sd_key = mtb.sd_definitionfilterkey and sd_se_id = ifnull('.$searchid.',"0")) parent_label FROM tbsearchdetail mtb where   sd_se_id = 14 and sd_label =  :sd_id ', 
            array(":sd_id" => $id));
        $valuequery  = "";
        foreach ($query as $rec) {
            if($rec->sd_definitionsource != ""){
                $msg = "false";
                if($rec->sd_custominclude == "0"){
                    $column = 'concat('.$rec->sd_definitionkeyid.',"-",'.$rec->sd_definitionkeyname.') sd_definitionkeyname ';
                   
                } else {
                    $column = $rec->sd_definitionkeyname . ' sd_definitionkeyname ';
                }
                if($rec->sd_custom == "1") {
                    if($rec->sd_keymainfield != '-'){
                         $valuequery  = 'select '.$rec->sd_definitionkeyid.' tdi_key,'.$column.' from '.$rec->sd_definitionsource.' where '.$rec->sd_keymainfield.' = "'.$rec->sd_key.'" '.$condition;
                    } else {
                         $valuequery  = 'select '.$rec->sd_definitionkeyid.' tdi_key,'.$column.' from '.$rec->sd_definitionsource;
                    }
                   
                    Log::info( $valuequery);
                } else {
                    $valuequery = $rec->sd_definitionsource.' where '.$rec->sd_keymainfield.' = "'.$rec->sd_key.'" '.$condition;
                }
                $parent = $rec->parent_label;
            }
        } 
           if ($id == 'Basket'){
             Log::info($valuequery.' where va_vt_id = '.$parentid);
                $result=DB::select($valuequery.' where va_vt_id = '.$parentid);
            } else {
                 $result=DB::select($valuequery );
              
            }


       
        Log::info($valuequery );
        return response()->json(array('result'=> $result,'parent'=> $parent,'msg'=> $msg),200);
    }


    public function getCustomFilterData(Request $request){
        $msg = "true";
        $id = $request->input('id');
        $searchid = $request->input('searchid');
        $filter = $request->input('filter');
        $type = $request->input('type');
        $parentvalue = $request->input('parentvalue');
        $condition = "";
         $parentid = $request->input('parentid');
        if($filter == "true"){
           
            /*if ($id == 'Basket'){          
               Log::info( " and va_vt_id = '".$parentid."'");
            } else {
                // $condition = " and tdi_parent_key = '".$parentid."'";
            }     */       
        }
       
        if($searchid == ''){
            $searchid = '0';
        }
    
/*Log::info("select case  when sd_definitionfilterkey = '' then 0
            when  sd_definitionfilterkey = 'parent' then 0
            when  sd_definitionfilterkey = null then 0 else 1 end as newcol  from tbsearchdetail where sd_se_id =  ".$searchid."
            and sd_label = '".$id."'");*/
           $isparent =  DB::select("select case  when sd_definitionfilterkey = '' then 0
            when  sd_definitionfilterkey = 'parent' then 0
            when  sd_definitionfilterkey = null then 0 else 1 end as newcol, sd_keymaintable, sd_definitionfieldid  from tbsearchdetail where sd_se_id =  ".$searchid."
            and sd_keymainfield = '".$id."'");
           
            foreach ($isparent as $rec) {
                if ($rec->sd_keymaintable == 'tbdefitems') {
                    if($rec->newcol == 1){
                        $condition = " where tdi_parent_key = '".$parentid."'";
                         /// return false; tbdefitems
                    }
                } else {
                    if($rec->newcol == 1){
                        $condition = " where ".$rec->sd_definitionfieldid." = '".$parentid."'";
                         /// return false; tbdefitems
                    }
                }
            }
        //Log::info('select sd_key, sd_definitionsource, sd_definitionkeyid,sd_keymainfield, sd_definitionkeyname,sd_custom, sd_custominclude,sd_definitionfilterkey,(select ifnull(sd_label,"") from tbsearchdetail t where t.sd_key = mtb.sd_definitionfilterkey and sd_se_id = ifnull('.$searchid.',"0")) parent_label FROM tbsearchdetail mtb where  sd_se_id = '.$searchid.' and sd_label =   "'.$id.'"');
        $parent = "";
        $query=DB::select('select sd_key, sd_definitionsource, sd_definitionkeyid,sd_keymainfield, sd_keymaintable, sd_definitionfieldid, sd_definitionkeyname,sd_custom, sd_custominclude,sd_definitionfilterkey,(select ifnull(sd_label,"") from tbsearchdetail t where t.sd_id = mtb.sd_definitionfilterkey and sd_se_id = ifnull('.$searchid.',"0")) parent_label FROM tbsearchdetail mtb where   sd_se_id = '.$searchid.' and sd_keymainfield =  :sd_id ', 
            array(":sd_id" => $id));
        $valuequery  = "";
        foreach ($query as $rec) {
            if($rec->sd_definitionsource != ""){
                $msg = "false";
                $parent = $rec->parent_label;
                /* if ($sd_definitionfilterkey == 'parent') {
                    $keyid= 
                 } else {

                }*/
                // 
                if($rec->sd_custominclude == "1"){
                    $column = 'concat('.$rec->sd_definitionkeyid.',"-",'.$rec->sd_definitionkeyname.') sd_definitionkeyname ';
                   
                } else {
                    $column = $rec->sd_definitionkeyname . ' sd_definitionkeyname ';
                }


                if($rec->sd_custom == "0") {
                    if($rec->sd_keymainfield != '-'){

                         $valuequery  = 'select '.$rec->sd_definitionkeyid.' tdi_key,'.$column.' from '.$rec->sd_definitionsource.'  '.$condition ;

                         if ($rec->sd_keymaintable == 'tbdefitems') {
                            $valuequery = $valuequery.' order by tdi_sort ';
                         }

                        // $valuequery  = 'select '.$rec->sd_definitionkeyid.' tdi_key,'.$column.' from '.$rec->sd_definitionsource.' where '.$rec->sd_keymainfield.' = "'.$rec->sd_key.'" '.$condition ."   order by tdi_sort";

                    } /*else {
                         $valuequery  = 'select '.$rec->sd_definitionkeyid.' tdi_key,'.$column.' from '.$rec->sd_definitionsource ."  order by tdi_sort";
                    } */
                   
                    Log::info( $valuequery);
                } else {

                    $valuequery = $rec->sd_definitionsource;

                  //    $valuequery = $rec->sd_definitionsource;
                }
                
            }
        } 

         Log::info($valuequery);
         //Log::info($valuequery. " and tdi_parent_key = '".$parentid."'");
         $result= "";
           /*if ($id == 'Basket'){
             //Log::info($valuequery.' where va_vt_id = '.$parentid);
                $result=DB::select($valuequery.' where va_vt_id = '.$parentid);
            } else {
                //Log::info($valuequery);
                if ($valuequery != "") {
                    $result=DB::select($valuequery);
                }
              
            }*/

             if ($valuequery != "") {
                    $result=DB::select($valuequery);
                }
              


       
        //Log::info($valuequery );
        return response()->json(array('result'=> $result,'parent'=> $parent,'msg'=> $msg),200);
    }


    public function getCustomFilter(Request $request){
        $msg = "true";
        $id = $request->input('id');
        $searchid = $request->input('searchid');
        $filter = $request->input('filter');
        $type = $request->input('type');
        $parentvalue = $request->input('parentvalue');
        $condition = "";
         $parentid = $request->input('parentid');
        if($filter == "true"){
           
            if ($id == 'Basket'){          
               Log::info( " and va_vt_id = '".$parentid."'");
            } else {
                $condition = " and tdi_parent_key = '".$parentid."'";
            }            
        }
       
        if($searchid == ''){
            $searchid = '0';
        }

        Log::info('select sd_key, sd_definitionsource, sd_definitionkeyid,sd_keymainfield, sd_definitionkeyname,sd_custom, sd_custominclude,sd_definitionfilterkey,(select ifnull(sd_label,"") from tbsearchdetail t where t.sd_key = mtb.sd_definitionfilterkey and sd_se_id = ifnull('.$searchid.',"0")) parent_label FROM tbsearchdetail mtb where  sd_se_id = '.$searchid.' and sd_keymainfield =   "'.$id.'"');
        $parent = "";
        $query=DB::select('select sd_key, sd_definitionsource, sd_definitionkeyid,sd_keymainfield, sd_definitionfieldid, sd_definitionkeyname,sd_custom, sd_custominclude,sd_definitionfilterkey,(select ifnull(sd_label,"") from tbsearchdetail t where t.sd_id = mtb.sd_definitionfilterkey and sd_se_id = ifnull('.$searchid.',"0")) parent_label FROM tbsearchdetail mtb where   sd_se_id = '.$searchid.' and sd_keymainfield =  :sd_id ', 
            array(":sd_id" => $id));
        $valuequery  = "";
        foreach ($query as $rec) {
            if($rec->sd_definitionsource != ""){
                $msg = "false";
                $parent = $rec->parent_label;
                /* if ($sd_definitionfilterkey == 'parent') {
                    $keyid= 
                 } else {

                }*/
               
                if($rec->sd_custominclude == "0"){
                    $column = 'concat('.$rec->sd_definitionkeyid.',"-",'.$rec->sd_definitionkeyname.') sd_definitionkeyname ';
                   
                } else {
                    $column = $rec->sd_definitionkeyname . ' sd_definitionkeyname ';
                }
                if($rec->sd_custom == "1") {
                    if($rec->sd_keymainfield != '-'){
                         $valuequery  = 'select '.$rec->sd_definitionkeyid.' tdi_key,'.$column.' from '.$rec->sd_definitionsource.' where '.$rec->sd_keymainfield.' = "'.$rec->sd_key.'" '.$condition;
                    } else {
                         $valuequery  = 'select '.$rec->sd_definitionkeyid.' tdi_key,'.$column.' from '.$rec->sd_definitionsource;
                    }
                   
                    Log::info( $valuequery);
                } else {
                    $valuequery = $rec->sd_definitionsource.' where '.$rec->sd_keymainfield.' = "'.$rec->sd_key.'" '.$condition;
                }
                
            }
        } 
           if ($id == 'Basket'){
             Log::info($valuequery.' where va_vt_id = '.$parentid);
                $result=DB::select($valuequery.' where va_vt_id = '.$parentid);
            } else {
                Log::info($valuequery);
                 $result=DB::select($valuequery);
              
            }


       
        Log::info($valuequery);
        return response()->json(array('result'=> $result,'parent'=> $parent,'msg'=> $msg),200);
    }





    public function getParameter(Request $request){
        $msg = "true";
        $parameter = $request->input('parameter');
        $query=DB::select('select * from tbpardef where pd_name =  :pd_name ', 
            array(":pd_name" => $parameter));
        
        foreach ($query as $rec) {
            $msg = "false";
        }     
        
        return response()->json(array('msg'=> $msg), 200);
    }

    public function getChildParameter(Request $request){
        $msg = "true";
        $paramkey = $request->input('paramkey');
        $param = $request->input('param');
        $aquery = DB::select('select tdi_key from tbdefitems where tdi_key = "'.$paramkey.'" and tdi_td_name = "'.$param.'"');
        
        foreach ($aquery as $rec) {
            $msg = "false";
        }     
        //Log::info($aquery);
        //Log::info('select tdi_key from tbdefitems where tdi_key = '.$paramkey.' and tdi_td_name = "'.$param.'"');
        return response()->json(array('msg'=> $msg), 200);
    }

    public function applyfilter(Request $request){
        
        $input = $request->input();
        $condition = $input['condition'];
        $value = $input['value'];
        $logic = $input['logic'];
        $query = '';
        
        foreach ($input['field'] as $fieldindex => $field) {
            //$columnquery = DB::select('select sd_definitionkeyid,sd_keymainfield, sd_definitionkeyname,sd_custom, sd_custominclude FROM tbsearchdetail where sd_key = "'.$field.'"');
            if($fieldindex == count($input['field']) - 1)
                $query = $query. ' TDI_VALUE '.$condition[$fieldindex].' '.$value[$fieldindex]; 
            else
                $query = $query. ' TDI_VALUE '.$condition[$fieldindex].' '.$value[$fieldindex].' '.$logic[$fieldindex];       
        }
        Log::info('WHERE '. $query);
        //Log::info(count($input['value']));
        //$array_of_item_ids = $input['field'];
        //Log::info( $array_of_item_ids);
        return redirect('codemaintenance');
    }

    public function table(Request $request){

        $page = $request->input('type');
        $maxRow = $request->input('maxrow');
        $name = $request->input('name');
        App::setlocale(session()->get('locale'));
        if($page == 'table'){
            if ($name == 'master') {
                return view("propertyregister.table")->with('maxRow', $maxRow);
            } else if ($name == 'lot') {
                return view("propertyregister.lot")->with('maxRow', $maxRow);
            } else if ($name == 'owner') {
                return view("propertyregister.owner")->with('maxRow', $maxRow);
            } else if ($name == 'bldg') {
                return view("propertyregister.building")->with('maxRow', $maxRow);
            } else if ($name == 'bldgar') {
                return view("propertyregister.buildingarea")->with('maxRow', $maxRow);
            }
        } else {
            return view("propertyregister.tab");
        }
        
    }

        public function propertyRegister(){
        $maxRow = 30;
        return view("propertyregister.property")->with('maxRow', $maxRow);
    }

    public function getLastCode(Request $request){
        $param = $request->input('param');
        $name = $request->input('name');

        $lastusedcode = DB::select('select max(tdi_key) tdi_key, tdi_td_name from tbdefitems where tdi_parent_key ="'.$param.'" and tdi_td_name ="'.$name.'" group by tdi_td_name');
        Log::info($lastusedcode );
        foreach ($lastusedcode as $rec) {            
            $lastcode = $rec->tdi_key;
        } 
        return response()->json(array('lastcode'=> $lastcode,'msg'=> 'true'),200);
    }

    public function dataTransfer(Request $request){
        $param_value = $request->input('param_value');
        $module = $request->input('module');
        $param = $request->input('param');
        $param_str = $request->input('param_str');
        $param_status = $request->input('param_status');
        $type = $request->input('type');
        $name=Auth::user()->name;
        //$param = $request->input('param');
        Log::info($module);
        //$register=DB::select("call proc_approvepropreg(".$param_value.",   '".$name."', '".$module."')"); 
        $propertycnt = 0;
        //$trn_date = new DateTime();
       
        if($module == 'propertyaddress'){
            $ownerdetail = DB::select('select * from cm_masterlist_log 
            inner join (select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = "STATE") state on state_id = mal_state_id
             where mal_id ='.$param_value.' ');
            Log::info($ownerdetail );
            foreach ($ownerdetail as $rec) {            
                //$lastcode = $rec->tdi_key;
                $result = DB::connection('oracle')->update("
                update PEMILIK_SB SET  
                NO_RUMAH = '".$rec->mal_addr_ln1."',
                JALAN = '".$rec->mal_addr_ln2."',  
                TEMPAT = '".$rec->mal_addr_ln3."',  
                KAWASAN = '".$rec->mal_addr_ln4."',  
                BANDAR = '".$rec->mal_postcode." ".$rec->mal_city."',
                NEGERI = '".$rec->state."', 
                TKH_UPDATE = SYSDATE, 
                USER_UPDATE = 'CAMA' 
                WHERE ID = '".$rec->mal_accno."'");
            } 
        } else if($module == 'propertylotaddress'){
            $ownerdetail = DB::select('select ma_accno, trim(lotcode.tdi_value) as lotcode, log_no, log_altno from cm_lot_log      
            inner join cm_lot on LOT_ID =    log_lot_id        
            inner join cm_masterlist on LO_MA_ID =    ma_id
            left join tbdefitems lotcode on lotcode.tdi_key = log_lotcode_id and lotcode.tdi_td_name = "LOTCODE"  
            where log_id ='.$param_value);
            Log::info($ownerdetail );
            foreach ($ownerdetail as $rec) {            
                //$lastcode = $rec->tdi_key;
                $result = DB::connection('oracle')->update("
                UPDATE PEMILIK_SB SET  
                LOTID = '".$rec->log_no."',
                LOT_LAMA = '".$rec->log_altno."',
                KOD_LOT = '".$rec->lotcode."',
                TKH_UPDATE = SYSDATE  , 
                USER_UPDATE = 'CAMA' 
                WHERE ID = '".$rec->ma_accno."'");
            } 
        } else {
        
            $ownerdetail = DB::select('select * from cm_ownertrans_appln inner join cm_ownertrans_applnreg on otar_id = ota_otar_id
            inner join (select tdi_key state_id, tdi_value state from tbdefitems where tdi_td_name = "STATE") state on state_id = ota_state_id
             where ota_otar_id ='.$param_value.' ');
            Log::info($ownerdetail );
            foreach ($ownerdetail as $rec) {            
                //$lastcode = $rec->tdi_key;
                $result = DB::connection('oracle')->update("
                update PEMILIK_SB SET 
                NAMA = '".$rec->ota_ownname."', 
                NO_RUM_POS = '".$rec->ota_addr_ln1."',
                JALAN_POS = '".$rec->ota_addr_ln2."',  
                TEMPAT_POS = '".$rec->ota_addr_ln3."',  
                KAWASAN_POS = '".$rec->ota_addr_ln4."',  
                BANDAR_POS = '".$rec->ota_postcode." ".$rec->ota_city."',
                NEGERI_POS = '".$rec->state."', 
                KP = '".$rec->ota_ownno."', 
                NO_TEL = '".$rec->ota_phoneno."', 
                TKH_UPDATE = SYSDATE , 
                USER_UPDATE = 'CAMA' 
                WHERE ID = '".$rec->otar_accno."'");
            } 
        
        }



       // $result = DB::connection('oracle')->update(" update PEMILIK_SB SET NAMA = 'TEST' WHERE ID = '315116007368'");

        Log::info("call proc_approvepropreg('".$param_value."',    '".$name."','".$module."', '".$param."', '".$param_str."', '".$param_status."')"); 
        $register=DB::select("call proc_approvepropreg(".$param_value.",   '".$name."', '".$module."', '".$param."', '".$param_str."', '".$param_status."')");

        //}
      //  Log::info("call proc_approvepropreg('".$param_value."',    '".$name."','".$module."')"); 

        
        return response()->json(array('checkdigit'=> 'succsess','propertycnt'=>$propertycnt), 200);
    }


    
    
} 