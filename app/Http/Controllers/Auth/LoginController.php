<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    //protected $redirectTo = '/api/project/index';//20190926 16:22
    protected $redirectTo = '/login';
    /**
     * Create a new controller instance.
     * G#mkHgyhd665%jf$
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
  /*
    public function authenticate(Request $request)
    {
        $credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            //additional authentication condition
            //$this->signin($credentials->User);
            return redirect()->intended('dashboard');
        }
    }
*/
/*
private function signin($user_email) {
        $result=$this->model->checkUserAccess($Username);
            if(empty($result) || count($result)==0){
            $message = $Username.' user doesn\'t exist in system;';
            $partpagepath='views/login/showmessage.php';
            require_once('views/login/login.php');
            exit;
            }else
            {
                $access = $result[0]['access'];
                if($access==='0'){
                    $message= $Username. 'user has no access for system.';
                    $partpagepath='views/login/showmessage.php';
                    require_once('views/login/login.php');  
                    exit;
                }
            }
            
        $validuser =$this->model->getUserInfo($Username,$Password);
        if($this->model->userStatus=='UserValid'){
            $authorises=$this->adminModel->getAllUsertypeAuthorises($_SESSION['logineduser']);
            if(empty($authorises)){
                    $message='user is not authorized';
                    $partpagepath='views/login/showmessage.php';
                    require_once('views/login/login.php');
            }                  
            else{
            $_SESSION['userauthorises']=$authorises;
            $topaccess=$authorises[count($authorises)-1];
            $_SESSION['usertype']=$topaccess['user_type_id'];
            $_SESSION['lockdate']=$this->settingmodel->getLockoffData()[0][0];
            $this->fireController($topaccess['user_entrymodel'],$topaccess['user_entrymethod']);
            }
        }else{
            $message=$this->model->userStatus;
            $partpagepath='views/login/showmessage.php';
            require_once('views/login/login.php');
        }
    }
*/
}
