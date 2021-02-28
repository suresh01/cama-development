<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use DB;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = \DB::table('users')->where('email', $request->input('email'))->first();

        if (auth()->guard('web')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {

            $new_sessid   = \Session::getId(); //get new session_id after user sign in

            if($user->session_id != '') {
                $last_session = \Session::getHandler()->read($user->session_id); 

                if ($last_session) {
                   // if($request->input('relogin') == 'true'){
                        if (\Session::getHandler()->destroy($user->session_id)) {
                            
                        }
                 /*   } else {
                        return view('auth.welcome')->with('email',$request->input('email'))->with('password',$request->input('password'));
                    }*/
                }
            }

            \DB::table('users')->where('id', $user->id)->update(['session_id' => $new_sessid]);
            
            $user = auth()->guard('web')->user();
            
            session()->put('locale', $request->input('lang')); 
            //Log::info($request->input('lang')."*****");

            return redirect($this->redirectTo);
        }   
        \Session::put('login_error', 'Your username and password wrong!!');
        return back();

    }

}
