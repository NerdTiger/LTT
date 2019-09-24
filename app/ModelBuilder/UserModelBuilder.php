<?php
namespace App\ModelBuilder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserModel {
    public function getUser($userId) {
        return DB::table('users')->where('user_id',$user_id)->first(); 
    }   
    public function getALlUsers_I(){
        $query=DB::selectRaw("select users.user_id,concat(users.user_name,' ',users.user_lastname) username,r.role_name,users.user_cost,concat(u2.user_name,' ',u2.user_lastname) clientmanagername,u2.user_id clientmanagerid,r.role_id, users.paytype
            from users
            left join users u2 on users.client_manager_id = u2.user_id
            left join role r on users.user_role_id = r.role_id
            where users.user_active=1 order by concat(users.user_name,' ',users.user_lastname);");
            $rows=$query->get();
            return $rows;
    }
    public function getALlUsersN(){
        $query=DB::selectRaw('select user_id,user_name,user_lastname from users where user_active=1 order by concat(user_name,\' \',user_lastname);');
        $rows=$query->get();
        return $rows;        
    }
    public function getalluserdiversities(){
            return DB::table('user_diversity')->get()->orderBy('id'); 
        }
        
    public function getuserrolesbyrole($roleid){
        $query=DB::selectRaw('select u.user_name,u.user_lastname,r.role_title,ur.role_cost,ur.role_rate,ur.user_role_id from user_roles ur
        inner join users u on ur.user_id = u.user_id
        inner join roles r on r.role_id = ur.role_id
        order by u.user_name,u.user_lastname;');
        $rows=$query->get();
        return $rows;
    }
    public function getuserrolesbyuser($userid){
        $query=DB::selectRaw('select u.user_name,u.user_lastname,r.role_title,ur.role_cost,ur.role_rate,ur.user_role_id,ur.role_id from user_roles ur
        inner join users u on ur.user_id = u.user_id
        inner join roles r on r.role_id = ur.role_id
        where ur.user_id='.$userid.'
        order by u.user_name,u.user_lastname;');
        $rows=$query->get();
        return $rows;
    }
    public function getuserrolesbyusername($username){
        $query=DB::selectRaw('select u.user_name,u.user_lastname,r.role_title,ur.role_cost,ur.role_rate,ur.user_role_id from user_roles ur
        inner join users u on ur.user_id = u.user_id
        inner join roles r on r.role_id = ur.role_id '
            .' where (user_name like "%'.$username.'%" or user_lastname like "%'.$username.'%")'
        .'order by r.role_title;');
        $rows=$query->get();
        return $rows;
    }
    public function gealluserteams(){
        $query=DB::selectRaw('select u.user_name,u.user_lastname,r.role_title,t.team_title,tr.user_role_id
        from team_users tr
        inner join user_roles ur on tr.user_role_id = ur.user_role_id
        inner join teams t on t.team_id = tr.team_id
        inner join users u on u.user_id=ur.user_id
        inner join roles r on r.role_id=ur.role_id
        order by u.user_name,u.user_lastname;');
        $rows=$query->get();
        return $rows;
    }
    public function getalluserroles(){
        $query=DB::selectRaw('select user_role_id,concat(r.role_title,\'[\',user_name,\'  \',user_lastname,\']\')userrole
        from user_roles ur #on tr.user_role_id = ur.user_role_id
        inner join users u on u.user_id=ur.user_id
        inner join roles r on r.role_id=ur.role_id
        order by u.user_name,u.user_lastname;');
        $rows=$query->get();
        return $rows;
    }
    public function getmainrolebyuserid($entry_user){
        $query=DB::selectRaw('SELECT r.role_id
        FROM `user_roles_main` urm
        INNER JOIN user_roles ur on urm.user_role_id = ur.user_role_id
        INNER JOIN roles r on ur.role_id = r.role_id
        where urm.user_id='.$entry_user);
        $rows=$query->get();
        return $rows;
    }
    public function getteams(){
        $query=DB::selectRaw('select * from teams order by team_title;');
        $rows=$query->get();
        return $rows;    
    }
    public function gealluserroles(){
        $query=DB::selectRaw('select u.user_name,u.user_lastname,r.role_title,ur.role_cost,ur.role_rate,ur.user_role_id from user_roles ur
        inner join users u on ur.user_id = u.user_id
        inner join roles r on r.role_id = ur.role_id
        order by u.user_name,u.user_lastname;');
        $rows=$query->get();
        return $rows;
    }
    public function getusers(){
        $query=DB::selectRaw('select user_id,user_name,user_lastname from users order by user_id;');
        $rows=$query->get();
        return $rows;
    }
    public function getnewrolesforuser($userid){
        $query=DB::selectRaw('select r.*,users.user_name,users.user_lastname,roles.role_title,pcodes.pcode_title 
                from rates r 
        inner join users on users.user_id = r.user_id
        inner join roles on roles.role_id=r.role_id
        inner join pcodes on pcodes.pcode_id = r.pcode_id
        where r.user_id='.$userid);
        $rows=$query->get();
        return $rows;
    }
    public function getjobsforuser($userid){
        $query=DB::selectRaw('select job_id,job_user,job_pcode,j.job_user_role,p.pcode_code,p.pcode_title from jobs j
        inner join pcodes p on j.job_pcode=p.pcode_id 
        where job_user='.$userid.'
        order by j.job_id desc');
        $rows=$query->get();
        return $rows;
    }
    public function getuserroleforjob($jobid){
        $query=DB::selectRaw('select user_roles.user_role_id id,pcodes.pcode_code,roles.role_title,pcodes.pcode_title,user_roles.role_cost,user_roles.role_rate,jobs.job_id 
        from user_roles 
        inner join roles on user_roles.role_id=roles.role_id
        inner join jobs on (jobs.job_user=user_roles.user_id and jobs.job_user_role=roles.role_id)
        inner join pcodes on pcodes.pcode_id=jobs.job_pcode
        where job_id='.$jobid.' order by id desc');
        $rows=$query->get();
        return $rows;
    }
    public function getrateforjob($jobid){
        $query=DB::selectRaw('select rates.rate_id id,rates.rate_name,
        pcodes.pcode_code,roles.role_title,pcodes.pcode_title  
        from rates  inner join roles on roles.role_id=rates.role_id 
        inner join jobs on (jobs.job_id=rates.job_id )
        inner join pcodes on pcodes.pcode_id=jobs.job_pcode 
        where jobs.job_id='.$jobid.' and newjob=0 
        union all 
        select rates.rate_id id,rates.rate_name,
        pcodes.pcode_code,roles.role_title,pcodes.pcode_title  
        from rates  inner join roles on roles.role_id=rates.role_id 
        inner join jobs on (jobs.job_user=rates.user_id and jobs.job_user_role=rates.rate_id)
        inner join pcodes on pcodes.pcode_id=jobs.job_pcode 
        where jobs.job_id='.$jobid.'  and newjob=1 
        order by id desc');
        $rows=$query->get();
        return $rows;
    }
    public function getsubratesforjob($jobid){
        $query=DB::selectRaw('
            select user_rates.user_rate_id id,user_rates.startdate,user_rates.enddate,user_rates.role_cost,user_rates.role_rate
            from user_rates 
            inner join rates on user_rates.rate_id=rates.rate_id
            inner join jobs on (jobs.job_id=rates.job_id )
            where jobs.job_id='.$jobid.' and  newjob=0 
            union all 
            select user_rates.user_rate_id id,user_rates.startdate,user_rates.enddate,user_rates.role_cost,user_rates.role_rate
            from user_rates 
            inner join rates on user_rates.rate_id=rates.rate_id
            inner join jobs on (jobs.job_user=rates.user_id and jobs.job_user_role=rates.rate_id)
            where jobs.job_id='.$jobid.'  and newjob=1 
            order by id');
        $rows=$query->get();
        return $rows;
    }
    public function get_user_detailed_information($user_id){
        $query=DB::table('users')
        ->where('user_id',$user_id)
        ->select('SELECT `users`.`user_id`,
        `users`.`user_name`,
        `users`.`user_lastname`,
        `users`.`user_position`,
        `users`.`user_cell`,
        `users`.`user_home`,
        `users`.`user_work`,
        `users`.`user_email`,
        `users`.`user_website`,
        `users`.`user_company`,
        `users`.`user_comments`,
        `users`.`user_picture`,
        `users`.`user_role`,
        `users`.`user_agency`,
        `users`.`user_agent`,
        `users`.`user_registered`,
        `users`.`user_active`,
        `users`.`user_updated`,
        `users`.`user_group`,
        `users`.`user_author`,
        `users`.`user_street`,
        `users`.`user_city`,
        `users`.`user_prov`,
        `users`.`user_zip`,
        `users`.`user_country`,
        `users`.`user_currency`,
        `users`.`user_username`,
        `users`.`user_rate`,
        `users`.`user_code`,
        `users`.`user_rank`,
        `users`.`user_lastlogged`,
        `users`.`user_lastloggedout`,
        `users`.`user_online`,
        `users`.`user_ip`,
        `users`.`user_lasturl`,
        `users`.`user_cost`,
        `users`.`user_available_date`,
        `users`.`user_future_weekly_hrs`,
        `users`.`user_max_weekly_hrs`,
        `users`.`user_min_weekly_hrs`,
        `users`.`user_estimate_hrs`,
        `users`.`user_available_now`,
        `users`.`user_tax`,
        `users`.`user_tax_number`,
        `users`.`user_tax_other`,
        `users`.`user_tax_other_number`,
        `users`.`user_billing_name`,
        `users`.`user_health_plan_opt_in`,
        `users`.`user_health_plan_deduction`,
        `users`.`user_rrsp_opt_in`,
        `users`.`user_rrsp_deduction`,
        `users`.`user_last_hours_update`,
        `users`.`user_photo`,
        `users`.`user_bios`,
        `users`.`user_interests`,
        `users`.`user_title`,
        `users`.`user_preferred_email`,
        `users`.`user_preferred_phone`,
        `users`.`user_skill_1`,
        `users`.`user_skill_2`,
        `users`.`user_skill_3`,
        `users`.`user_skill_4`,
        `users`.`user_skill_5`,
        `users`.`user_max_hours_per_week`,
        `users`.`user_kudos_1`,
        `users`.`user_kudos_2`,
        `users`.`user_kudos_3`,
        `users`.`user_kudos_4`,
        `users`.`user_kudos_5`,
        `users`.`user_timezone_utc_offset`,
        `users`.`user_skill1`,
        `users`.`user_skill2`,
        `users`.`user_skill3`,
        `users`.`user_skill4`,
        `users`.`user_skill5`,
        `users`.`img`,
        `users`.`user_bios`,
        `users`.`user_preferredEmail`,
        `users`.`user_preferredPhone`,
        `users`.`user_kudo1`,
        `users`.`user_kudo2`,
        `users`.`user_kudo3`,
        `users`.`user_kudo4`,
        `users`.`user_kudo5`,
        `users`.`user_timezone`,
        `users`.`users_mdina_start_year`,
        `users`.`users_cisco_access`,
        `users`.`cisco_skill1`,
        `users`.`cisco_skill2`,
        `users`.`cisco_skill3`,
        `users`.`cisco_skill4`,
        `users`.`cisco_skill5`,
        `users`.`user_personalInterest`,
        `users`.`user_role1`,
        `users`.`user_role2`,
        `users`.`user_role3`,
        `users`.`user_role4`,
        `users`.`user_showdirectory`,
        `users`.`user_typeofperson`,
        `users`.`diversity_id`,
        `ud`.`diversity`,
        `users`.`src_employee_id`,
        `users`.`lastupdate`,
        `users`.`user_resource_status_id`,
        `res`.`resource_status`,
        `role`.role_name,
        concat(u5.user_name," ",u5.user_lastname) clientmanager,
        u5.user_id
        FROM `users` 
        left join resource_employment_status res on res.resource_employment_status_id=user_resource_status_id
        left join `role` on users.user_role_id = role.role_id
        left join `users` u5 on users.client_manager_id = u5.user_id
        left join user_diversity ud on ud.id=users.diversity_id where users.user_id=?');
        $rows=$query->get();
        return $rows;
    }
    public function get_active_user_list(){
        $query=DB::selectRaw('SELECT 
        `users`.`user_id`,
        `users`.`user_name`,
        `users`.`user_lastname`,
        `res`.`resource_status`
        FROM `users` 
        LEFT JOIN resource_employment_status res ON res.resource_employment_status_id = user_resource_status_id
        WHERE user_active=1  ORDER BY user_name, user_lastname ');
        $rows=$query->get();
        return $rows;
    }
    public function load_all_user(){
        $query=DB::selectRaw('SELECT 
        `users`.`user_id`,
        `users`.`user_name`,
        `users`.`user_lastname`,
        `res`.`resource_status`
        FROM `users` 
        LEFT JOIN resource_employment_status res ON res.resource_employment_status_id = user_resource_status_id
        ORDER BY user_name, user_lastname');
        $rows=$query->get();
        return $rows;
    }    
    public function get_resource_status(){
        $query=DB::select('SELECT 
        `resource_employment_status_id`,
        `resource_status`
        FROM `resource_employment_status` 
        ORDER BY `resource_employment_status_id`');
        $rows=$query->get();
        return $rows;  
    }
    public function search_user($user_names,$resource_types){
        if((isset($user_names) && count($user_names)>0 && $user_names[0]!='' && $user_names[0]!='None selected') && 
            (isset($resource_types) && count($resource_types)>0 && $resource_types[0]!='' && $resource_types[0]!='None selected')) 
        {
            $trimed_user_names=[];
            foreach ($user_names as $key => $val) $trimed_user_names[$key] = trim($user_names[$key]);
            $trimed_resource_types=[];
            foreach ($resource_types as $key => $val) $trimed_resource_types[$key] = trim($resource_types[$key]);
            $param_users = implode(",", array_fill(0, count($trimed_user_names), "?"));
            $param_resource_types = implode(",", array_fill(0, count($trimed_resource_types), "?"));
            
            $query=DB::table('users as u')
            ->leftJoin('resource_employment_status as res','res.resource_employment_status_id','u.user_resource_status_id')
            ->select('u.user_id,u.user_name,u.user_lastname,res.resource_status')
            ->whereIn($param_users)->whereIn($param_resource_types)
            ->orderBy('user_name,user_lastname'); 
        }
        elseif((isset($user_names) && count($user_names)>0 && $user_names[0]!='' && $user_names[0]!='None selected') && 
                    (empty($resource_types) || count($resource_types)==0 || $resource_types[0]=='' || $resource_types[0]=='None selected') ) 
        {
            $param_users = implode(",", array_fill(0, count($user_names), "?"));
            $paramtype=str_repeat("s", count($user_names)); 
            $paramtype.='i';
            $query=DB::table('users as u')
            ->leftJoin('resource_employment_status as res','res.resource_employment_status_id','u.user_resource_status_id')
            ->select('u.user_id,u.user_name,u.user_lastname,res.resource_status')
            ->whereIn($param_users)
            ->orderBy('user_name,user_lastname'); 
        } else
        if((isset($resource_types) && count($resource_types)>0 && $resource_types[0]!='' && $resource_types[0]=='None selected')
        && (empty($user_names) || count($user_names)==0 || $user_names[0]=='' || $user_names[0]=='None selected')) {
        $trimed_resource_types=[];
        foreach ($resource_types as $key => $val) $trimed_resource_types[$key] = trim($resource_types[$key]);
        $param_resource_types = implode(",", array_fill(0, count($trimed_resource_types), "?"));

        $query=DB::table('users as u')
        ->leftJoin('resource_employment_status as res','res.resource_employment_status_id','u.user_resource_status_id')
        ->select('u.user_id,u.user_name,u.user_lastname,res.resource_status')
        ->whereIn($param_resource_types)
        ->orderBy('user_name,user_lastname'); 
        }else
        {
            $query=DB::table('users as u')
            ->leftJoin('resource_employment_status as res','res.resource_employment_status_id','u.user_resource_status_id')
            ->select('u.user_id,u.user_name,u.user_lastname,res.resource_status')
            ->orderBy('user_name,user_lastname');
        }
    }
    function save_user(){
        $trimmed_fields=[];
        $user_id=trim(isset($_POST['user_id'])?$_POST['user_id']:'0');
        $user_loginname=trim(isset($_POST['user_username'])?$_POST['user_username']:'');
        $user_src_employee_id=trim(isset($_POST['user_src_employee_id'])?$_POST['user_src_employee_id']:'0');
        if(empty($user_id) || $user_id==='0' || empty($user_src_employee_id) || $user_src_employee_id==='0'){
            $trimmed_fields2[]=trim(isset($_POST['user_name'])?$_POST['user_name']:'');
            $trimmed_fields2[]=trim(isset($_POST['user_lastname'])?$_POST['user_lastname']:'');
            $trimmed_fields2[]=trim(isset($_POST['user_username'])?$_POST['user_username']:'');
            $trimmed_fields2[]=trim(isset($_POST['user_cell'])?$_POST['user_cell']:'');
            $trimmed_fields2[]=trim(isset($_POST['user_home'])?$_POST['user_home']:'');
            $trimmed_fields2[]=trim(isset($_POST['user_work'])?$_POST['user_work']:'');
            $trimmed_fields2[]=trim(isset($_POST['user_email'])?$_POST['user_email']:'');
            $trimmed_fields2[]=trim(isset($_POST['user_company'])?$_POST['user_company']:'');        
            $trimmed_fields2[]=trim(isset($_POST['user_street'])?$_POST['user_street']:'');
            $trimmed_fields2[]=trim(isset($_POST['user_city'])?$_POST['user_city']:'');
            $trimmed_fields2[]=trim(isset($_POST['user_prov'])?$_POST['user_prov']:'');
            $trimmed_fields2[]=trim(isset($_POST['user_zip'])?$_POST['user_zip']:'');
            $trimmed_fields2[]=trim(isset($_POST['user_title'])?$_POST['user_title']:'');
            $trimmed_fields2[]=trim(isset($_POST['user_preferred_email'])?$_POST['user_preferred_email']:'');
            $trimmed_fields2[]=trim(isset($_POST['user_preferred_phone'])?$_POST['user_preferred_phone']:'');
        }
        $trimmed_fields[]=trim(isset($_POST['user_resource_status'])?$_POST['user_resource_status']:'0');
        $trimmed_fields[]=trim(isset($_POST['user_website'])?$_POST['user_website']:'');
        $trimmed_fields[]=trim(isset($_POST['user_diversity_id'])?$_POST['user_diversity_id']:'0');
        $trimmed_fields[]=trim(isset($_POST['user_comments'])?$_POST['user_comments']:'');
        $trimmed_fields[]=trim(isset($_POST['user_role_id'])?$_POST['user_role_id']:'0');
        //user_role_id
        $trimmed_fields[]=trim(isset($_POST['user_agency'])?$_POST['user_agency']:0);
        $trimmed_fields[]=trim(isset($_POST['user_agent'])?$_POST['user_agent']:0);
        $trimmed_fields[]=trim(isset($_POST['user_active'])?$_POST['user_active']:0);
        $trimmed_fields[]=trim(isset($_POST['user_group'])?$_POST['user_group']:0);
        $trimmed_fields[]=trim(isset($_POST['user_author'])?$_POST['user_author']:0);
        $trimmed_fields[]=trim(isset($_POST['user_country'])?$_POST['user_country']:'Canada');
        $trimmed_fields[]=trim(isset($_POST['user_currency'])?$_POST['user_currency']:'CAD');
        $trimmed_fields[]=trim(isset($_POST['user_future_weekly_hrs'])?$_POST['user_future_weekly_hrs']:0);
        $trimmed_fields[]=trim(isset($_POST['user_max_weekly_hrs'])?$_POST['user_max_weekly_hrs']:0);
        $trimmed_fields[]=trim(isset($_POST['user_min_weekly_hrs'])?$_POST['user_min_weekly_hrs']:0);
        $trimmed_fields[]=trim(isset($_POST['user_estimate_hrs'])?$_POST['user_estimate_hrs']:0);
        $trimmed_fields[]=trim(isset($_POST['user_tax'])?$_POST['user_tax']:'0.0');
        $trimmed_fields[]=trim(isset($_POST['user_tax_number'])?$_POST['user_tax_number']:'');
        $trimmed_fields[]=trim(isset($_POST['user_tax_other'])?$_POST['user_tax_other']:'0.0');
        $trimmed_fields[]=trim(isset($_POST['user_tax_other_number'])?$_POST['user_tax_other_number']:'');
        $trimmed_fields[]=trim(isset($_POST['user_billing_name'])?$_POST['user_billing_name']:'');
        $trimmed_fields[]=trim(isset($_POST['user_health_plan_opt_in'])?$_POST['user_health_plan_opt_in']:0);
        $trimmed_fields[]=trim(isset($_POST['user_health_plan_deduction'])?$_POST['user_health_plan_deduction']:'0.0');
        $trimmed_fields[]=trim(isset($_POST['user_rrsp_opt_in'])?$_POST['user_rrsp_opt_in']:0);
        $trimmed_fields[]=trim(isset($_POST['user_rrsp_deduction'])?$_POST['user_rrsp_deduction']:'0.0');
        $trimmed_fields[]=trim(isset($_POST['user_interests'])?$_POST['user_interests']:'');
        $trimmed_fields[]=trim(isset($_POST['user_skill_1'])?$_POST['user_skill_1']:'');
        $trimmed_fields[]=trim(isset($_POST['user_skill_2'])?$_POST['user_skill_2']:'');
        $trimmed_fields[]=trim(isset($_POST['user_skill_3'])?$_POST['user_skill_3']:'');
        $trimmed_fields[]=trim(isset($_POST['user_skill_4'])?$_POST['user_skill_4']:'');
        $trimmed_fields[]=trim(isset($_POST['user_skill_5'])?$_POST['user_skill_5']:'');
        $trimmed_fields[]=trim(isset($_POST['user_kudos_1'])?$_POST['user_kudos_1']:'');
        $trimmed_fields[]=trim(isset($_POST['user_kudos_2'])?$_POST['user_kudos_2']:'');
        $trimmed_fields[]=trim(isset($_POST['user_kudos_3'])?$_POST['user_kudos_3']:'');
        $trimmed_fields[]=trim(isset($_POST['user_kudos_4'])?$_POST['user_kudos_4']:'');
        $trimmed_fields[]=trim(isset($_POST['user_kudos_5'])?$_POST['user_kudos_5']:'');
        $trimmed_fields[]=trim(isset($_POST['user_timezone_utc_offset'])?$_POST['user_timezone_utc_offset']:0);
        $trimmed_fields[]=trim(isset($_POST['user_skill1'])?$_POST['user_skill1']:'');
        $trimmed_fields[]=trim(isset($_POST['user_skill2'])?$_POST['user_skill2']:'');        
        $trimmed_fields[]=trim(isset($_POST['user_skill3'])?$_POST['user_skill3']:'');
        $trimmed_fields[]=trim(isset($_POST['user_skill4'])?$_POST['user_skill4']:'');
        $trimmed_fields[]=trim(isset($_POST['user_skill5'])?$_POST['user_skill5']:'');
        $trimmed_fields[]=trim(isset($_POST['user_bios'])?$_POST['user_bios']:'');
        $trimmed_fields[]=trim(isset($_POST['user_kudo1'])?$_POST['user_kudo1']:'');
        $trimmed_fields[]=trim(isset($_POST['user_kudo2'])?$_POST['user_kudo2']:'');
        $trimmed_fields[]=trim(isset($_POST['user_kudo3'])?$_POST['user_kudo3']:'');
        $trimmed_fields[]=trim(isset($_POST['user_kudo4'])?$_POST['user_kudo4']:'');
        $trimmed_fields[]=trim(isset($_POST['user_kudo5'])?$_POST['user_kudo5']:'');
        $trimmed_fields[]=trim(isset($_POST['user_timezone'])?$_POST['user_timezone']:0);
        $trimmed_fields[]=trim(isset($_POST['users_mdina_start_year'])?$_POST['users_mdina_start_year']:2000);
        $trimmed_fields[]=trim(isset($_POST['users_cisco_access'])?$_POST['users_cisco_access']:1);
        $trimmed_fields[]=trim(isset($_POST['cisco_skill1'])?$_POST['cisco_skill1']:'');
        $trimmed_fields[]=trim(isset($_POST['cisco_skill2'])?$_POST['cisco_skill2']:'');
        $trimmed_fields[]=trim(isset($_POST['cisco_skill3'])?$_POST['cisco_skill3']:'');
        $trimmed_fields[]=trim(isset($_POST['cisco_skill4'])?$_POST['cisco_skill4']:'');
        $trimmed_fields[]=trim(isset($_POST['cisco_skill5'])?$_POST['cisco_skill5']:'');
        $trimmed_fields[]=trim(isset($_POST['user_personalInterest'])?$_POST['user_personalInterest']:'');
        $trimmed_fields[]=trim(isset($_POST['user_role1'])?$_POST['user_role1']:'');
        $trimmed_fields[]=trim(isset($_POST['user_role2'])?$_POST['user_role2']:'');
        $trimmed_fields[]=trim(isset($_POST['user_role3'])?$_POST['user_role3']:'');
        $trimmed_fields[]=trim(isset($_POST['user_role4'])?$_POST['user_role4']:'');
        $trimmed_fields[]=trim(isset($_POST['user_cost'])?$_POST['user_cost']:'');
        $trimmed_fields[]=trim(isset($_POST['client_manager_id'])?$_POST['client_manager_id']:'');
        if($user_id>'0')$trimmed_fields[]=trim(isset($_POST['user_id'])?$_POST['user_id']:'0');
        if($user_id<='0'){ 
            if(empty($user_src_employee_id) || $user_src_employee_id==='0'){
                $counter=0;
                $newprojectID=DB::table('project_internal')->insert(
                    [				
                        'user_resource_status_id' => $trimmed_fields[$counter++],
                        'user_website' => $trimmed_fields[$counter++],
                        'diversity_id' => $trimmed_fields[$counter++],
                        'user_comments' => $trimmed_fields[$counter++],
                        'user_role_id' => $trimmed_fields[$counter++],
                        'user_agency' => $trimmed_fields[$counter++],
                        'user_agent' => $trimmed_fields[$counter++],
                        'user_active' => $trimmed_fields[$counter++],
                        'user_group' => $trimmed_fields[$counter++],
                        'user_author' => $trimmed_fields[$counter++],
                        'user_country' => $trimmed_fields[$counter++],
                        'user_currency' => $trimmed_fields[$counter++],
                        'user_future_weekly_hrs' => $trimmed_fields[$counter++],
                        'user_max_weekly_hrs' => $trimmed_fields[$counter++],
                        'user_min_weekly_hrs' => $trimmed_fields[$counter++],
                        'user_estimate_hrs' => $trimmed_fields[$counter++],
                        'user_tax' => $trimmed_fields[$counter++],
                        'user_tax_number' => $trimmed_fields[$counter++],
                        'user_tax_other' => $trimmed_fields[$counter++],
                        'user_tax_other_number' => $trimmed_fields[$counter++],
                        'user_billing_name' => $trimmed_fields[$counter++],
                        'user_health_plan_opt_in' => $trimmed_fields[$counter++],
                        'user_health_plan_deduction' => $trimmed_fields[$counter++],
                        'user_rrsp_opt_in' => $trimmed_fields[$counter++],
                        'user_rrsp_deduction' => $trimmed_fields[$counter++],
                        'user_interests' => $trimmed_fields[$counter++],
                        'user_skill_1' => $trimmed_fields[$counter++],
                        'user_skill_2' => $trimmed_fields[$counter++],
                        'user_skill_3' => $trimmed_fields[$counter++],
                        'user_skill_4' => $trimmed_fields[$counter++],
                        'user_skill_5' => $trimmed_fields[$counter++],
                        'user_kudos_1' => $trimmed_fields[$counter++],
                        'user_kudos_2' => $trimmed_fields[$counter++],
                        'user_kudos_3' => $trimmed_fields[$counter++],
                        'user_kudos_4' => $trimmed_fields[$counter++],
                        'user_kudos_5' => $trimmed_fields[$counter++],
                        'user_timezone_utc_offset' => $trimmed_fields[$counter++],
                        'user_skill1' => $trimmed_fields[$counter++],
                        'user_skill2' => $trimmed_fields[$counter++],
                        'user_skill3' => $trimmed_fields[$counter++],
                        'user_skill4' => $trimmed_fields[$counter++],
                        'user_skill5' => $trimmed_fields[$counter++],
                        'user_bios' => $trimmed_fields[$counter++],
                        'user_kudo1' => $trimmed_fields[$counter++],
                        'user_kudo2' => $trimmed_fields[$counter++],
                        'user_kudo3' => $trimmed_fields[$counter++],
                        'user_kudo4' => $trimmed_fields[$counter++],
                        'user_kudo5' => $trimmed_fields[$counter++],
                        'user_timezone' => $trimmed_fields[$counter++],
                        'users_mdina_start_year' => $trimmed_fields[$counter++],
                        'users_cisco_access' => $trimmed_fields[$counter++],
                        'cisco_skill1' => $trimmed_fields[$counter++],
                        'cisco_skill2' => $trimmed_fields[$counter++],
                        'cisco_skill3' => $trimmed_fields[$counter++],
                        'cisco_skill4' => $trimmed_fields[$counter++],
                        'cisco_skill5' => $trimmed_fields[$counter++],
                        'user_personalInterest' => $trimmed_fields[$counter++],
                        'user_role1' => $trimmed_fields[$counter++],
                        'user_role2' => $trimmed_fields[$counter++],
                        'user_role3' => $trimmed_fields[$counter++],
                        'user_role4' => $trimmed_fields[$counter++],
                        'user_cost' => $trimmed_fields[$counter++],
                        'client_manager_id' => $trimmed_fields[$counter++],
                    ]);
                    }else{}
            }else{
            DB::table('users')
            ->where('user_id', $user_id)
            ->update([				
                'user_resource_status_id' => $trimmed_fields[$counter++],
                'user_website' => $trimmed_fields[$counter++],
                'diversity_id' => $trimmed_fields[$counter++],
                'user_comments' => $trimmed_fields[$counter++],
                'user_role_id' => $trimmed_fields[$counter++],
                'user_agency' => $trimmed_fields[$counter++],
                'user_agent' => $trimmed_fields[$counter++],
                'user_active' => $trimmed_fields[$counter++],
                'user_group' => $trimmed_fields[$counter++],
                'user_author' => $trimmed_fields[$counter++],
                'user_country' => $trimmed_fields[$counter++],
                'user_currency' => $trimmed_fields[$counter++],
                'user_future_weekly_hrs' => $trimmed_fields[$counter++],
                'user_max_weekly_hrs' => $trimmed_fields[$counter++],
                'user_min_weekly_hrs' => $trimmed_fields[$counter++],
                'user_estimate_hrs' => $trimmed_fields[$counter++],
                'user_tax' => $trimmed_fields[$counter++],
                'user_tax_number' => $trimmed_fields[$counter++],
                'user_tax_other' => $trimmed_fields[$counter++],
                'user_tax_other_number' => $trimmed_fields[$counter++],
                'user_billing_name' => $trimmed_fields[$counter++],
                'user_health_plan_opt_in' => $trimmed_fields[$counter++],
                'user_health_plan_deduction' => $trimmed_fields[$counter++],
                'user_rrsp_opt_in' => $trimmed_fields[$counter++],
                'user_rrsp_deduction' => $trimmed_fields[$counter++],
                'user_interests' => $trimmed_fields[$counter++],
                'user_skill_1' => $trimmed_fields[$counter++],
                'user_skill_2' => $trimmed_fields[$counter++],
                'user_skill_3' => $trimmed_fields[$counter++],
                'user_skill_4' => $trimmed_fields[$counter++],
                'user_skill_5' => $trimmed_fields[$counter++],
                'user_kudos_1' => $trimmed_fields[$counter++],
                'user_kudos_2' => $trimmed_fields[$counter++],
                'user_kudos_3' => $trimmed_fields[$counter++],
                'user_kudos_4' => $trimmed_fields[$counter++],
                'user_kudos_5' => $trimmed_fields[$counter++],
                'user_timezone_utc_offset' => $trimmed_fields[$counter++],
                'user_skill1' => $trimmed_fields[$counter++],
                'user_skill2' => $trimmed_fields[$counter++],
                'user_skill3' => $trimmed_fields[$counter++],
                'user_skill4' => $trimmed_fields[$counter++],
                'user_skill5' => $trimmed_fields[$counter++],
                'user_bios' => $trimmed_fields[$counter++],
                'user_kudo1' => $trimmed_fields[$counter++],
                'user_kudo2' => $trimmed_fields[$counter++],
                'user_kudo3' => $trimmed_fields[$counter++],
                'user_kudo4' => $trimmed_fields[$counter++],
                'user_kudo5' => $trimmed_fields[$counter++],
                'user_timezone' => $trimmed_fields[$counter++],
                'users_mdina_start_year' => $trimmed_fields[$counter++],
                'users_cisco_access' => $trimmed_fields[$counter++],
                'cisco_skill1' => $trimmed_fields[$counter++],
                'cisco_skill2' => $trimmed_fields[$counter++],
                'cisco_skill3' => $trimmed_fields[$counter++],
                'cisco_skill4' => $trimmed_fields[$counter++],
                'cisco_skill5' => $trimmed_fields[$counter++],
                'user_personalInterest' => $trimmed_fields[$counter++],
                'user_role1' => $trimmed_fields[$counter++],
                'user_role2' => $trimmed_fields[$counter++],
                'user_role3' => $trimmed_fields[$counter++],
                'user_role4' => $trimmed_fields[$counter++],
                'user_cost' => $trimmed_fields[$counter++],
                'client_manager_id' => $trimmed_fields[$counter++],
            ]);
        
        }
        if($user_id>0){
            $new_user_type_authorize=DB::table('user_type_authorize')->insert(
                [
                    `user_id`=> $user_id, 
                    `user_type_id`=> 128, 
                    `setupdate`=> 'CURRENT_TIMESTAMP', 
                ]
            );

            $new_user_accessable=DB::table('user_accessable')->insert(
                [
                    `user_loginname`=> $userloginname, 
                    `access`=> 1, 
                ]
            );
            $auth_id=$new_user_type_authorize['auth_id'];
            $access_id=$new_user_accessable['access_id'];

            if($user_id<=0 || $auth_id<=0 ||$access_id <=0){
            }
            else{
                error_log('failed adding user '.$firstName.' '.$lastName.' '.$employmentHistoryStatus);
            }
        }
    }
}
?>