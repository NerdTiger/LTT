<?php

namespace App\ModelBuilder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


 
class EntryModelBuilder {
    public function sumFilteredEntries($user,$projectnumber,$projecttitle,$entry_date_from,$entry_date_to,$projectrenewal){
        $condition=[];
        $max_renewal=DB::table('time_entry as te')
        ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
        ->join('project as p','p.project_id','pr.project_resource_project_id')
        ->join('users as u','u.user_id','pr.project_resource_resource_id')
        ->selectRaw('sum(te.entry_hours) sumsincelastlockoff')
        ->where('te.entry_deleted',0); 
        if(isset($user)& $user!==''){
            array_push($condition,'[u.user_name','like','%'.$user.'%]');
            array_push($condition,'[u.user_lastname','like','%'.$user.'%]');
        }
        if(isset($projectnumber)& $projectnumber!==''){
            array_push($condition,'[p.project_number','like','%'.$$projectnumber.'%]');
        }
        if(isset($projectrenewal)& $projectrenewal!==''){
            array_push($condition,'[p.project_renewal','like','%'.$$projectrenewal.'%]');
        }else{
            $val=DB::table('project')->where('project_number=',$projectnumber)->max('project_renewal'); 
        }
        if(isset($projecttitle)& $projecttitle!==''){
            array_push($condition,'[p.project_title','like','%'.$$projecttitle.'%]');
        }
        if(isset($entry_date_from)& $entry_date_from!==''){
            array_push($condition,'["te.entry_date",">",'.$entry_date_from.']');
        }
        if(isset($entry_date_to)& $entry_date_to!==''){
            array_push($condition,'["te.entry_date",">",'.$entry_date_to.']');
        }       
    }
    public function sumFilteredEntriesByUser($user,$projectnumber,$projecttitle,$entry_date_from,$entry_date_to,$projectrenewal){
        $user=$_SESSION['logineduser'];
        $condition=[];
        $max_renewal=DB::table('time_entry as te')
        ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
        ->join('project as p','p.project_id','pr.project_resource_project_id')
        ->join('users as u','u.user_id','pr.project_resource_resource_id')
        ->selectRaw('sum(te.entry_hours) sumsincelastlockoff')
        ->where('te.entry_deleted',0); 
        if(isset($user)& $user!==''){
            array_push($condition,'[u.user_name',''.$user.']');

        }if(isset($projectnumber)& $projectnumber!==''){
            array_push($condition,'[p.project_number','like','%'.$$projectnumber.'%]');
        }
        if(isset($projectrenewal)& $projectrenewal!==''){
            array_push($condition,'[p.project_renewal','like','%'.$$projectrenewal.'%]');
        }else{
            $val=DB::table('project')->where('project_number=',$projectnumber)->max('project_renewal'); 
        }
        if(isset($projecttitle)& $projecttitle!==''){
            array_push($condition,'[p.project_title','like','%'.$$projecttitle.'%]');
        }
        if(isset($entry_date_from)& $entry_date_from!==''){
            array_push($condition,'["te.entry_date",">",'.$entry_date_from.']');
        }
        if(isset($entry_date_to)& $entry_date_to!==''){
            array_push($condition,'["te.entry_date",">",'.$entry_date_to.']');
        }
    }
    public function filterEntryByUser($user,$projectnumber,$projecttitle,$entry_date_from,$entry_date_to,$projectrenewal){
        $user=$_SESSION['logineduser'];
        $max_renewal=DB::table('time_entry as te')
        ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
        ->join('project as p','p.project_id','pr.project_resource_project_id')
        ->join('users as u','u.user_id','pr.project_resource_resource_id')
        ->selectRaw('sum(te.entry_hours) sumsincelastlockoff')
        ->where('te.entry_deleted',0)
        ->where('te.entry_deleted',0)
        ->where('te.entry_deleted',0)
        ->where('te.entry_deleted',0);
        $remainghours = DB::table('time_entry as te')
        ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
        ->select('te.entry_project_resource_id,', DB::raw('(pr.project_resource_hours-sum(CASE
        WHEN te.entry_deleted=0 THEN te.entry_hours
        ELSE 0.0
        END))  as remainghours'))
        ->groupBy('pr.project_resource_id');

        $max_project_renewal=DB::table('project')->where('project_number',$projectnumber)->max('project_renewal');


        $users = DB::table('users')
        ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
        ->joinSub($remainghours, 'remaing_hours', function ($join) {
        $join->on('te.entry_project_resource_id', '=', 'remaing_hours.entry_project_resource_id');
        })
        ->select('p.project_status,p.project_number,p.project_renewal,pr.project_resource_comment,pr.project_resource_is_bonus,
        concat(u.user_name," ",user_lastname)username,
        t3.remainghours,
        remaing_hours.* ')
        ->where('u.user_id',$user)->where('p.project_number','like',$projectnumber)->where('p.project_renewal',$projectrenewal) 
        ->whereBetween('te.entry_date',$entry_date_from,$entry_date_to)->where('p.project_title','like',$projecttitle)->where('p.project_renewal',$projectrenewal) 
        ->get()->orderBy('entry_date','desc');
        return $users;

        //$_SESSION['entrySearchCondition']= $querystatement;
        
        //return ExecuteSQLQueryStatement($this->db, $querystatement);

    }
    public function filterEntry($user,$projectnumber,$projecttitle,$entry_date_from,$entry_date_to,$projectrenewal){
        $max_renewal=DB::table('time_entry as te')
        ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
        ->join('project as p','p.project_id','pr.project_resource_project_id')
        ->join('users as u','u.user_id','pr.project_resource_resource_id')
        ->selectRaw('sum(te.entry_hours) sumsincelastlockoff')
        ->where('te.entry_deleted',0)
        ->where('te.entry_deleted',0)
        ->where('te.entry_deleted',0)
        ->where('te.entry_deleted',0);
        $remainghours = DB::table('time_entry as te')
        ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
        ->select('te.entry_project_resource_id,', DB::raw('(pr.project_resource_hours-sum(CASE
        WHEN te.entry_deleted=0 THEN te.entry_hours
        ELSE 0.0
        END))  as remainghours'))
        ->groupBy('pr.project_resource_id');

        $max_project_renewal=DB::table('project')->where('project_number',$projectnumber)->max('project_renewal');


        $users = DB::table('users')
        ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
        ->joinSub($remainghours, 'remaing_hours', function ($join) {
        $join->on('te.entry_project_resource_id', '=', 'remaing_hours.entry_project_resource_id');
        })
        ->select('p.project_status,p.project_number,p.project_renewal,pr.project_resource_comment,pr.project_resource_is_bonus,
        concat(u.user_name," ",user_lastname)username,
        t3.remainghours,
        remaing_hours.* ')
        ->where('u.user_id',$user)->where('p.project_number','like',$projectnumber)->where('p.project_renewal',$projectrenewal) 
        ->whereBetween('te.entry_date',$entry_date_from,$entry_date_to)->where('p.project_title','like',$projecttitle)->where('p.project_renewal',$projectrenewal) 
        ->get()->orderBy('entry_date','desc');
        return $users;
    }
    public function filterEntryForClientManager($user,$clientManager,$projectnumber,$projecttitle,$entry_date_from,$entry_date_to,$projectrenewal){
        $max_renewal=DB::table('time_entry as te')
        ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
        ->join('project as p','p.project_id','pr.project_resource_project_id')
        ->join('users as u','u.user_id','pr.project_resource_resource_id')
        ->join('users as u2','u2.user_id','pr.project_resource_project_client_manager_id')
        ->selectRaw('sum(te.entry_hours) sumsincelastlockoff')
        ->where('te.entry_deleted',0)
        ->where('te.entry_deleted',0)
        ->where('te.entry_deleted',0)
        ->where('te.entry_deleted',0);

        $max_project_renewal=DB::table('project')->where('project_number',$projectnumber)->max('project_renewal');


        $users = DB::table('users')
        ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
        ->joinSub($remainghours, 'remaing_hours', function ($join) {
        $join->on('te.entry_project_resource_id', '=', 'remaing_hours.entry_project_resource_id');
        })
        ->select('p.project_status,p.project_number,p.project_renewal,pr.project_resource_comment,pr.project_resource_is_bonus,
        concat(u.user_name," ",user_lastname)username,
        t3.remainghours,
        remaing_hours.* ')
        ->where('u.user_id',$user)->where('p.project_number','like',$projectnumber)->where('p.project_renewal',$projectrenewal) 
        ->whereBetween('te.entry_date',$entry_date_from,$entry_date_to)->where('p.project_title','like',$projecttitle)->where('p.project_renewal',$projectrenewal) 
        ->get()->orderBy('entry_date','desc');
        return $users;
    }

    public function addhoursforprojectPhone() {
        $userid=(isset($_POST['user_id']) && $_POST['user_id']!='')?$_POST['user_id']:'0';
            $time_entry_date= (isset($_POST['time_entry_date_phone']) && $_POST['time_entry_date_phone']!='')?$_POST['time_entry_date_phone']:null;
            $time_entry_hours = (isset($_POST['time_entry_hours_phone']) && $_POST['time_entry_hours_phone']!='')?$_POST['time_entry_hours_phone']:'0.0';
            $entry_timestamp=date('Y-m-d H:i:s');
            $entry_project_resource=(isset($_POST['entry_project_resource']) && $_POST['entry_project_resource']!='')?$_POST['entry_project_resource']:'0';
            $time_entry_details = (isset($_POST['time_entry_details_phone']) && $_POST['time_entry_details_phone']!='')?$_POST['time_entry_details_phone']:null;
            //$entryhour = (isset($_POST['project_id']) && $_POST['project_id']!='')?$_POST['project_id']:'0';
            $newprojectID=DB::table('time_entry')->insert(
                [
                    `entry_date`=> $time_entry_date, 
                    `entry_hours`=> $time_entry_hours, 
                    `entry_project_resource_id`=> $entry_project_resource, 
                    `entry_timestamp`=> $entry_timestamp,
                    `entry_details`=> $time_entry_details,
                    `entry_deleted`=> 0,
                ]
            );
            //$log_author = $_SESSION['logineduser'];
            //$this->eventlogModel->logEventAddEntry($entry_ID, $log_author) ;
            //return $entry_ID;
    }

    public function addhoursforproject() {
        $userid=(isset($_POST['user_id']) && $_POST['user_id']!='')?$_POST['user_id']:'0';
        $time_entry_date= (isset($_POST['time_entry_date']) && $_POST['time_entry_date']!='')?$_POST['time_entry_date']:null;
        $time_entry_hours = (isset($_POST['time_entry_hours']) && $_POST['time_entry_hours']!='')?$_POST['time_entry_hours']:'0.0';
        $entry_timestamp=date('Y-m-d H:i:s');
        $entry_project_resource=(isset($_POST['entry_project_resource']) && $_POST['entry_project_resource']!='')?$_POST['entry_project_resource']:'0';
        $time_entry_details = (isset($_POST['time_entry_details']) && $_POST['time_entry_details']!='')?$_POST['time_entry_details']:null;
        //$entryhour = (isset($_POST['project_id']) && $_POST['project_id']!='')?$_POST['project_id']:'0';

        $newprojectID=DB::table('time_entry')->insert(
            [
                `entry_date`=> $time_entry_date, 
                `entry_hours`=> $time_entry_hours, 
                `entry_project_resource_id`=> $entry_project_resource, 
                `entry_timestamp`=> $entry_timestamp,
                `entry_details`=> $time_entry_details,
                `entry_deleted`=> 0,
            ]
        );
            //$entry_ID=ExecuteInsertStatement($this->db, $statement);
            //$log_author = $_SESSION['logineduser'];
            //$this->eventlogModel->logEventAddEntry($entry_ID, $log_author) ;
            return $entry_ID;
    }
            
    public function deleteentry(){
        $entryid= (isset($_POST['entryid']) && $_POST['entryid']!='')?$_POST['entryid']:0;
        DB::table('TimeEntry')
        ->where('entry_id', $entryid)
        ->update([
            'entry_deleted' => 1,
        ]);
        //$log_author = $_SESSION['logineduser'];
        //$this->eventlogModel->logEventDeleteEntry($entryid, $log_author) ;
    }
            
    public function updateentry(){
                //$userid = (isset($_POST['user_id']) && $_POST['user_id']!='')?$_POST['user_id']:'0';
        //$project_number = (isset($_POST['project_number']) && $_POST['project_number']!='')?$_POST['project_number']:'0';
        $entryid= (isset($_POST['entryid']) && $_POST['entryid']!='')?$_POST['entryid']:0;
        
        $time_entry_date= (isset($_POST['entry_date']) && $_POST['entry_date']!='')?$_POST['entry_date']:null;
        $time_entry_hours = (isset($_POST['entry_hour']) && $_POST['entry_hour']!='')?$_POST['entry_hour']:'0.0';
        $entry_timestamp=date('Y-m-d');
        //$entry_project_resource=(isset($_POST['entry_project_resource']) && $_POST['entry_project_resource']!='')?$_POST['entry_project_resource']:'0';
        $time_entry_details = (isset($_POST['entry_details']) && $_POST['entry_details']!='')?$_POST['entry_details']:null;
        //$entryhour = (isset($_POST['project_id']) && $_POST['project_id']!='')?$_POST['project_id']:'0';


        DB::table('time_entry')
        ->where('entry_id', $entryid)
        ->update([
            'entry_date' => $updateProject['project_submitter'],
            'entry_hours' => $updateProject['project_type'],
            'entry_timestamp' => $updateProject['project_type'],
            'entry_details' => $updateProject['project_type'],
        ]);
        //$log_author = $_SESSION['logineduser'];
        //$this->eventlogModel->logEventEditEntry($entryid, $log_author);
        //return ExecuteSQLStatement($this->db,$statement);
    }
    public function updateentry_phone(){
                //$userid = (isset($_POST['user_id']) && $_POST['user_id']!='')?$_POST['user_id']:'0';
        //$project_number = (isset($_POST['project_number']) && $_POST['project_number']!='')?$_POST['project_number']:'0';
        $entryid= (isset($_POST['entryid']) && $_POST['entryid']!='')?$_POST['entryid']:0;
        
        $time_entry_date= (isset($_POST['entry_date']) && $_POST['entry_date']!='')?$_POST['entry_date']:null;
        $time_entry_hours = (isset($_POST['entry_hour']) && $_POST['entry_hour']!='')?$_POST['entry_hour']:'0.0';
        $entry_timestamp=date('Y-m-d');
        //$entry_project_resource=(isset($_POST['entry_project_resource']) && $_POST['entry_project_resource']!='')?$_POST['entry_project_resource']:'0';
        $time_entry_details = (isset($_POST['entry_details']) && $_POST['entry_details']!='')?$_POST['entry_details']:null;
        //$entryhour = (isset($_POST['project_id']) && $_POST['project_id']!='')?$_POST['project_id']:'0';
        DB::table('time_entry')
        ->where('entry_id', $entryid)
        ->update([
            'entry_date' => $time_entry_date,
            'entry_hours' => $time_entry_hours,
            'entry_timestamp' => $entry_timestamp,
            'entry_details' => $time_entry_details,
        ]);
                
                //$log_author = $_SESSION['logineduser'];
                //$this->eventlogModel->logEventEditEntry($entryid, $log_author);
                //return ExecuteSQLStatement($this->db,$statement);
            }
            
    public function gethoursbyprojectclientmanager($projectid,$clientmanager,$resource_id){
        //no user direct input

        $query=DB::selectRaw('
        SELECT p.project_number,p.project_renewal,pr.project_resource_comment,concat(u.user_name,"",u.user_lastname)username, t3.remainghours, te.* 
        FROM time_entry te 
        inner join ( select te.entry_project_resource_id, (pr.project_resource_hours-sum(ifnull(te.entry_hours,0))) remainghours 
        FROM time_entry te inner join project_resource pr on pr.project_resource_id = te.entry_project_resource_id 
        inner join project p on p.project_id = pr.project_resource_project_id inner join users u on u.user_id = pr.project_resource_resource_id 
        inner join users u2 on u2.user_id = pr.project_resource_project_client_manager_id 
        where p.project_id ='.$projectid.' AND te.entry_deleted=0 AND u2.user_id = '.$clientmanager.' and u.user_id ='.$resource_id.'
        group by pr.project_resource_id )
        t3 on t3.entry_project_resource_id=te.entry_project_resource_id 
        inner join project_resource pr on pr.project_resource_id = te.entry_project_resource_id 
        inner join project p on p.project_id = pr.project_resource_project_id 
        inner join users u on u.user_id = pr.project_resource_resource_id 
        inner join users u2 on u2.user_id = pr.project_resource_project_client_manager_id 
        where p.project_id ='.$projectid.' AND te.entry_deleted=0 AND u2.user_id = '.$clientmanager.' and u.user_id ='.$resource_id.'
        ORDER BY te.entry_id desc;');
        $rows=$query->get();
        return $rows;
                //echo $query_statement;
                //$_SESSION['entrySearchCondition']= $query_statement;
                //return ExecuteSQLQueryStatement($this->db, $query_statement);
            }
            
            public function gethoursbyproject($projectid){

        
                $query=DB::selectRaw('SELECT p.project_status,p.project_number,p.project_renewal,pr.project_resource_comment,concat(u.user_name,"",user_lastname)username,
        t3.remainghours,
        te.* 
        
        FROM time_entry te
        inner join project_resource pr  on pr.project_resource_id = te.entry_project_resource_id
        inner join (select te.entry_project_resource_id,
        (pr.project_resource_hours-sum(ifnull(te.entry_hours,0))) remainghours
        FROM time_entry te
        inner join project_resource pr  on pr.project_resource_id = te.entry_project_resource_id
        where pr.project_resource_project_id='.$projectid
                        .' AND te.entry_deleted=0  
        group by pr.project_resource_id 
        )t3 on t3.entry_project_resource_id=te.entry_project_resource_id
        inner join project p on p.project_id = pr.project_resource_project_id
        inner join users u on u.user_id =  pr.project_resource_resource_id 
        where pr.project_resource_project_id='.$projectid.' AND te.entry_deleted=0  
        ORDER BY te.entry_id desc');
            $rows=$query->get();
            return $rows;
                
                
                //$_SESSION['entrySearchCondition']= $query_statement;
                
                //return ExecuteSQLQueryStatement($this->db, $query_statement);
            }
    public function getHoursbyProjectResource($userId,$projectId){
        $query=DB::selectRaw('SELECT p.project_status,p.project_number,p.project_renewal,pr.project_resource_comment,pr.project_resource_is_bonus,concat(u.user_name,"",user_lastname)username,
        t3.remainghours,
        te.* 
        FROM time_entry te
        inner join project_resource pr  on pr.project_resource_id = te.entry_project_resource_id
        inner join (select te.entry_project_resource_id,
        (pr.project_resource_hours-sum(ifnull(te.entry_hours,0))) remainghours
        FROM time_entry te
        inner join project_resource pr  on pr.project_resource_id = te.entry_project_resource_id
        where pr.project_resource_resource_id ='.$userId
                        .' AND pr.project_resource_project_id='.$projectId
                        .' AND te.entry_deleted=0  
        group by pr.project_resource_id 
        )t3 on t3.entry_project_resource_id=te.entry_project_resource_id
        inner join project p on p.project_id = pr.project_resource_project_id
        inner join users u on u.user_id =  pr.project_resource_resource_id 
        where te.entry_deleted=0
        ORDER BY te.entry_id desc');
        $rows=$query->get();
        return $rows;
    }   
    public function getEntriesSinceLastLockoff(){
        $query=DB::selectRaw('SELECT p.project_status,p.project_number,p.project_renewal,pr.project_resource_comment,pr.project_resource_is_bonus,concat(u.user_name,"",user_lastname)username,
        t3.remainghours,
        te.* 
        
        FROM time_entry te
        inner join project_resource pr  on pr.project_resource_id = te.entry_project_resource_id
        inner join (select te.entry_project_resource_id,
        (pr.project_resource_hours-sum(ifnull(te.entry_hours,0))) remainghours
        FROM time_entry te
        inner join project_resource pr  on pr.project_resource_id = te.entry_project_resource_id
        where te.entry_date >= "'.$_SESSION['lockdate'].'" 
        group by pr.project_resource_id 
        )t3 on t3.entry_project_resource_id=te.entry_project_resource_id
        inner join project p on p.project_id = pr.project_resource_project_id
        inner join users u on u.user_id =  pr.project_resource_resource_id 
        where te.entry_date >= "'.$_SESSION['lockdate'].'" 
        AND te.entry_deleted=0 
        ORDER BY te.entry_id desc');
        $rows=$query->get();
        return $rows;
    }
            
    public function getEntriesforClientManagerSinceLastLockoff($userId){

        $query=DB::selectRaw('SELECT p.project_status,p.project_number,p.project_renewal,pr.project_resource_comment,concat(u.user_name," ",u.user_lastname)username,u.user_id,te.* 
        FROM time_entry te
        inner join project_resource pr  on pr.project_resource_id = te.entry_project_resource_id
        inner join project p on p.project_id = pr.project_resource_project_id
        inner join users u on u.user_id =  pr.project_resource_resource_id 
        inner join users u2 on u2.user_id =  pr.project_resource_project_client_manager_id
        where te.entry_date >= "'.$_SESSION['lockdate'].'" AND te.entry_deleted=0 AND u2.user_id = '.$userId.' AND te.entry_deleted=0 ORDER BY te.entry_id desc');
        $rows=$query->get();
        return $rows;
    }
    public function getEntriesforUserSinceLastLockoff($userId){
        $query=DB::selectRaw('SELECT p.project_status,p.project_number,p.project_renewal,pr.project_resource_comment,pr.project_resource_is_bonus,concat(u.user_name,"",user_lastname)username,te.* FROM time_entry te
        inner join project_resource pr  on pr.project_resource_id = te.entry_project_resource_id
        inner join project p on p.project_id = pr.project_resource_project_id
        inner join users u on u.user_id =  pr.project_resource_resource_id 
        where te.entry_date >= "'.$_SESSION['lockdate'].'" AND te.entry_deleted=0 AND u.user_id = '.$userId.' ORDER BY te.entry_id desc');
        $rows=$query->get();
        return $rows;
    }
    public function getSumofEntriesforUserbyContext(){
        $query=DB::table('time_entry as te')
        ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
        ->join('project as p','p.project_id','pr.project_resource_project_id')
        ->join('users as u','u.user_id','pr.project_resource_resource_id')
        ->selectRaw('p.project_status,p.project_number,p.project_renewal,pr.project_resource_comment,
        concat(u.user_name,"",user_lastname)username,te.*')
        ->where('te.entry_deleted',0);

        $query_statement = $_SESSION['sumstatement'];
        return ExecuteSQLQueryStatement($this->db, $query_statement);
    }

    public function getSumofEntriesforUserSinceLastLockoff($userId){
        $query=DB::selectRaw('
            SELECT 
        sum(te.entry_hours)sumsincelastlockoff 
        FROM time_entry te 
        inner join project_resource pr on pr.project_resource_id = te.entry_project_resource_id 
        inner join users u on u.user_id = pr.project_resource_resource_id 
        where te.entry_date >= "'.$_SESSION['lockdate'].'" AND te.entry_deleted=0 AND u.user_id = '.$userId.'');
        $rows=$query->get();
        return $rows;
    }

    public function getSumofEntriesSinceLastLockoff(){
        $query=DB::table('time_entry as te')
        ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
        ->join('project as p','p.project_id','pr.project_resource_project_id')
        ->join('users as u','u.user_id','pr.project_resource_resource_id')
        ->selectRaw('p.project_status,p.project_number,p.project_renewal,pr.project_resource_comment,
        concat(u.user_name,"",user_lastname)username,te.*')
        ->where('te.entry_deleted',0);
    }
    public function getSumofEntriesforClientManagerSinceLastLockoff($managerId){

        $query=DB::table('time_entry as te')
        ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
        ->join('project as p','p.project_id','pr.project_resource_project_id')
        ->join('users as u','u.user_id','pr.project_resource_resource_id')
        ->selectRaw('p.project_status,p.project_number,p.project_renewal,pr.project_resource_comment,
        concat(u.user_name,"",user_lastname)username,te.*')
        ->where('te.entry_deleted',0);
    }   
    public function getEntriesBySearchCondition(){
        
        //return ExecuteSQLQueryStatement($this->db,$_SESSION['entrySearchCondition']);
    }
    public function getEntriesofThisMonth(){
        $today = date('Y-m-d');
        $firstDayofThisMonth = date('Y-m-d',mktime(0, 0, 0, date("m")  , 1, date("Y")));
            $query=DB::table('time_entry as te')
            ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
            ->join('project as p','p.project_id','pr.project_resource_project_id')
            ->join('users as u','u.user_id','pr.project_resource_resource_id')
            ->selectRaw('p.project_status,p.project_number,p.project_renewal,pr.project_resource_comment,
            concat(u.user_name,"",user_lastname)username,te.*')
            ->where('te.entry_deleted',0)
            ->whereBetween($firstDayofThisMonth,$today)
            ->orderBy('te.entry_id'); 
            //$sql = str_replace_array('?', $query->getBindings(), $query->toSql()); 
            //dd($sql);
        
            return $query->get();//return collection of object;
                //$_SESSION['entrySearchCondition']= $query_statement;
                
            }
    public function getEntriesbyUserid($userid){
        $condition=[
            ['pr.project_resource_id',$project_resource_id],['te.entry_deleted',0]];
        
        $query=DB::table('time_entry as te')
        ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
        ->join('project as p','p.project_id','pr.project_resource_project_id')
        ->join('users as u','u.user_id','pr.project_resource_resource_id')
        ->selectRaw('p.project_status,p.project_number,p.project_renewal,pr.project_resource_comment,
        concat(u.user_name,"",user_lastname)username,te.*')
        ->where($condition)
        ->orderBy('te.entry_id'); 
        //$sql = str_replace_array('?', $query->getBindings(), $query->toSql()); 
        //dd($sql);
        //$_SESSION['entrySearchCondition']= $query_statement;
        return $query->get();
    }
    public function getEntriesbyPRid($project_resource_id){
        $condition=[
            ['pr.project_resource_id',$project_resource_id],['te.entry_deleted',0]
            ];
        
        $query=DB::table('time_entry as te')
        ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
        ->join('project as p','p.project_id','pr.project_resource_project_id')
        ->join('users as u','u.user_id','pr.project_resource_resource_id')
        ->selectRaw('p.project_status,p.project_number,p.project_renewal,pr.project_resource_comment,
        concat(u.user_name,"",user_lastname)username,te.*')
        ->where($condition)
        ->orderBy('te.entry_id'); 
        //$sql = str_replace_array('?', $query->getBindings(), $query->toSql()); 
        //dd($sql);
        return $query->get();//return collection of object;
    }
    public function getRemaininghoursforProjectResourceAssignment($project_resource_id){
        $condition=[
        ['pr.project_resource_id',$project_resource_id],['te.entry_deleted',0]
        ];
        $query=DB::table('time_entry as te')
        ->join('project_resource as pr','pr.project_resource_id','te.entry_project_resource_id')
        ->selectRaw('(pr.project_resource_hours-sum(te.entry_hours)) as remh')
        ->where($condition)
        ->groupBy('pr.project_resource_id'); 
        //$sql = str_replace_array('?', $query->getBindings(), $query->toSql()); 
        //dd($sql);

        $remh=$query->get();//return collection of object;

        if(isset($remh) & $remh[0]->remh>0) 
        {
            return $remh[0]->remh;   
        }else return  -1;
    }       
}
 
