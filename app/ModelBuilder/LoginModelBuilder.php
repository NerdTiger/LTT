<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('connection/MySQLiAccess.php');
require_once('helper/mailModel.php');

class LoginModel extends MailModel{
    public $userStatus;
    function getSiteInfo(){
        $rows=DB::table('system_messages')->where('message_type',1)->get();
        if(isset($rows)&& count($rows)>0)return $rows[0][2];
        else return '';
    }
    function checkUserAccess($userLoginName){
        $rows=DB::table('user_accessable')->select('access')->where('user_loginname',$userLoginName)->get();
        return rows;
    }
    function getUserInfo($userLoginName,$pswd){
        $db_version = mysqli_get_server_version($this->db);
        if($db_version<50705)
        $query = "SELECT user_id, user_name, user_code, user_rank, user_email,user_active, user_lastname, user_last_hours_update, PASSWORD('$pswd')pswd,OLD_PASSWORD('$pswd')oldpswd,current_date() ";
        else $query = "SELECT user_id, user_name, user_code, user_rank, user_email,user_active, user_lastname, user_last_hours_update, PASSWORD('$pswd')pswd,current_date() ";
        
        $result=DB::table('users')->where('user_username',$userLoginName)->select($query)->get();

        if(empty($result)){
            $this->userStatus = 'Not Exist';return null;
        }
        else{
            $row = $result[0];
            if($row[5]!='1'){
                $this->userStatus = 'Inactive';return null;
            }
            else{
                if(($db_version<50705 && $row[2]!=$row[8] && $row[2]!=$row[9]) || ($db_version>=50705 && $row[2]!=$row[8]))                
                {
                    $this->userStatus = 'Wrong password';
                    return null;
                }else{
                    $this->userStatus = 'UserValid';
                    $_SESSION['logineduser']=$row[0];
                    $_SESSION['logedin']=1;
                    $_SESSION['loginusername']=$row[1].' '.$row[6];
                    $_SESSION['user_rank'] = $row[3];
                    return $row;

                }
            }
        }
    }
    public function getLockdate(){
        $result=DB::table('options')->where('option_name','lock_date')->select('option_name, option_value')->get()->orderBy('role_id');
        if(empty($result)){return '';}
        else{    return $result[0][1];}
    }
    public function generate_send_temp_password($email){
        // Create a new, random password.
        $p = substr ( md5(uniqid(rand(),1)), 3, 10);
        $update_user=DB::table('users')
        ->where('user_mail', $email)
        ->update([
            'user_code' => 'PASSWORD("'.$p.'")',
        ]);
        if(count($users)>0){
            $body = "Your password to log into TimeTracker has been temporarily changed.<br><br>Temp Password: " . $p 
                    . "<br><br>Please login using this password and your username. At that time you may change your password using <a href='https://".$_SERVER[SERVER_NAME]."/time-tracker/FC_dispatcher.php?controller=login&action=changepassword'> CHANGE PASSWORD</a>.";
            $subject='Reset time tracker password';
            $tos=array($users[0]=>$email);
            $from='admin@salesbeacon.com';   
            parent::$mail_sender->send($tos, $from, $subject, $body, $cc=null, $attachment=null, $important=null);
            parent::$mail_sender->mailserver->clearAllRecipients();
            }
        else{
            $message='The email entered does not exist in the system.'; 
            $partpagepath='views/login/showmessage.php';
            require_once('views/login/login.php');
        }
    }
}
