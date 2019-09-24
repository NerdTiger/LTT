<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelBuilder\AdminModelBuilder;
use App\ModelBuilder\SettingModelBuilder;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LoginController extends Controller
{

    private $admin_model_builder;
    private $setting_model_Builder;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->admin_model_builder = new AdminModelBuilder();
        $this->setting_model_builder = new SettingModelBuilder();

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    private function get_authorizes(int $user_id)
    {
        $authorises=$this->admin_model_builder->getAllUsertypeAuthorises($user_id);
        if(empty($authorises)){
            //   $message='user is not authorized';
            //   $partpagepath='views/login/showmessage.php';
            //   require_once('views/login/login.php');
        }                  
        else return $authorises;
    } 
    public function getuserlogininfo() {
        $user_id=501;//
        $tmp_authorises=$this->get_authorizes($user_id);
        $authorises=new ResourceCollection($tmp_authorises);
        //dd($authorises);
        if($authorises==null || $authorises->isEmpty()){
            echo 'error';
        }else{

            $topaccess=$authorises[count($authorises)-1]->user_type_name;
            //var_dump($topaccess);
            // $usertype=$topaccess['user_type_id'];
            $lockdate_row=$this->setting_model_builder->getLockdate();
            //dd($lockdate_row);
            // $request->session()->put('usertype',$this->ut);
            //$authorises=[["user_type_id"=>1,"user_type"=>"User"],["user_type_id"=>5,"user_type"=>"TTAdmin"]];
            $dr= array("login"=>array("loginid"=>100,"loginname"=>"Zhijun Zhang"),
            "authorises"=>$authorises,
            "lockdate_row"=>$lockdate_row,
            "current_user_type"=>$topaccess
            );
        $json_dr=json_encode($dr);
        
        echo $json_dr;
     }
    }


// old code
    public function login() {
        $siteinto= $this->model->getSiteInfo();
        $partpagepath='views/login/signin.php';
        require 'views/login/login.php';
                
     }
     public function logout() {
     unset($_SESSIION);
     
        $siteinto= $this->model->getSiteInfo();
        $partpagepath='views/login/signin.php';
        require 'views/login/login.php';
     }
     private function fireController($controller,$action){
       
     //require_once('controllers/' . $controller . '_controller.php');
     require_once('controllers/' . $controller . '_controller.php');
     switch($controller) {
       case 'login':
           require_once('models/login.php');
         $controller = new LoginController();
       break;
   case 'enduser':
           
         $controller = new EnduserController();
       break;
        
   case 'users':
       require_once('models/user.php');
         $controller = new UsersController();
       break;
   case 'jobs':
      
       require_once('models/jobs.php');
         $controller = new JobController();
      
       break;
     case 'hours':
         require_once('models/hours.php');
         $controller = new HoursController();
         break;
     case 'manage':
         require_once('models/manage.php');
         $controller = new ManageController();
         break;
       case 'settings':
         require_once('models/setting.php');
         $controller = new SettingsController();
         break;
     case 'stats':
         require_once('models/stats.php');
         $controller = new StatsController();
         break;
     case 'slog':
        
         $controller = new SlogController();
         break;      
     case 'posts':
       // we need the model to query the database later in the controller
       require_once('models/post.php');
       $controller = new PostsController();
       break;
     case 'admin':
       // we need the model to query the database later in the controller
       require_once('models/admin.php');
       $controller = new AdminController();
       break;
   case 'management':
       // we need the model to query the database later in the controller
       
       $controller = new ManagementController();
       break;
   case 'clientmanager':
       // we need the model to query the database later in the controller
       
       $controller = new ClientmanagerController();
       break;
    case 'contractmanager':
       // we need the model to query the database later in the controller
       
       $controller = new ContractmanagerController();
       break;
     case 'reports':
       // we need the model to query the database later in the controller
       //require_once('models/admin.php');
       $controller = new ReportsController();
       break;
       case 'invoice':
        
         $controller = new InvoiceController();
         break;      
     case 'usertype':
        
         $controller = new UsertypeController();
         break;   
     case 'project':
        
         $controller = new ProjectController();
         break;   
     }
 
     $controller->{ $action }();
   }

     public function forgetpassword(){
         error_log('forgetpassword');
         require_once('views/login/newforgetpassword.php');
     }
     public function sendmailforpassword(){
         $email = '';
         $email = isset($_POST['email'])? $_POST['email'] : $email ;
         if (!empty($email) && check_email_address($email) == TRUE) {
             $this->model->generate_send_temp_password($email);
             $message='EMail has been sent to you with temparary password';
             $partpagepath='views/login/showmessage.php';
             require_once('views/login/login.php');
     } else { 
             $message='The email entered is not valid.'; 
             $partpagepath='views/login/showmessage.php';
             require_once('views/login/login.php');
     }
 }
 public function changepassword(){
            require 'views/login/resetpassword.php';
        //require 'views/login/login.php';
 
        
     
     
 }
 public function savenewpassword(){
 
     $message=$this->model->save_new_password();
     
            $partpagepath='views/login/showmessage.php';
        require 'views/login/login.php';
 
     
     
 }

}
