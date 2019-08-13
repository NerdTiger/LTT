<?php

namespace App\ModelBuilder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;



 
class ProjectModelBuilder {
 
    public function getProjectList(){
        
        $projects=DB::table('project')
        ->leftjoin('project_resource','project.project_id','project_resource.project_resource_project_id')
        ->leftjoin('time_entry','time_entry.entry_project_resource_id','project_resource.project_resource_id')
        ->join('project_status','project_status.project_status_id','project.project_status')
        ->groupBy('project_id', 'project_start', 'project_number', 'project_title', 'project_renewal', 'project_type', 'project_payee',  'project.project_status', 
        'project_end')        
        ->selectRaw('project_id, project_start, project_number, project_title, project_renewal, project_type, project_payee,  project.project_status, 
        project_end,
        sum(project_resource_hours)as allocatedhours, sum(entry_hours) as loggedhours') 
        ->get(); 
        return $projects;
        
    }

    public function getProjectListForUser($userid){
    $projects=DB::table(DB::raw('project_resource as pr'))
    ->rightjoin(DB::raw('users as u'),'pr.project_resource_resource_id','=','u.user_id')
    ->leftjoin(DB::raw('time_entry as te'),'pr.project_resource_id','te.entry_project_resource_id')
    ->join(DB::raw('project as p'),'p.project_id','pr.project_resource_project_id')
    ->join(DB::raw('project_status as ps'),'ps.project_status_id','p.project_status')
    ->where('u.user_id',$userid) 
    ->groupBy('p.project_id','pr.project_resource_id')        
    ->selectRaw('project_resource_id,user_id,concat(u.user_name,"",user_lastname)username,p.project_id,p.project_number,p.project_renewal,
    p.project_title project_name,ps.project_status,p.`project_type`,pr.project_resource_hours,pr.project_resource_comment,
    sum(te.entry_hours)loggedhours ,p.project_title,p.project_start,p.project_end,sum(te.entry_hours) hours,pr.project_resource_sales_beacon_rate,pr.project_resource_is_bonus') 
    ->orderBy('p.project_id','desc')
    ->get(); 
    return $projects;

    }
    
    public function getProjectListForClientManager($userid){
        $query=
        DB::table('project_resource as pr')
        ->rightjoin('users as u','pr.project_resource_project_client_manager_id','u.user_id')
        ->rightjoin('users as u2','pr.project_resource_resource_id','u2.user_id')
        ->leftjoin('time_entry as te','pr.project_resource_id','te.entry_project_resource_id')
        ->join('project as p','p.project_id','pr.project_resource_project_id')
        ->join('project_status as ps','ps.project_status_id','p.project_status')
        ->where([
            ['u.user_id', $userid],
            ['p.project_status','1'],
            ['pr.project_resource_active','1'],
        ])
        ->groupBy('pr.project_resource_id','p.project_id','u2.user_id')        
        ->selectRaw('project_resource_id,u2.user_id,concat(u.user_name," ",u.user_lastname)clientmanager,pr.project_resource_resource_id,
        concat(u2.user_name," ",u2.user_lastname)username,p.project_id,p.project_number,p.project_renewal,p.project_title,
        p.project_start,p.project_end,p.project_type,ps.project_status,
            sum(te.entry_hours) hours,pr.project_resource_hours,
        pr.project_resource_sales_beacon_rate') 
        ->orderBy('p.project_id','desc');
        //$sql = str_replace_array('?', $query->getBindings(), $query->toSql()); 
        //dd($sql);
        $projects = $query->get();
        return $projects;

    }
    
    public function getprojectbyid($projectid){
        $query=DB::table('project')
        ->leftjoin('practice_area as pa','pa.practice_area_id','project_practice_area_id')
        ->leftjoin('functional_area  as fa','fa.functional_area_id','project_functional_area_id')
        ->leftjoin('users  as u','u.user_id','project_submitter')
        ->leftjoin('project_status as st','st.project_status_id','project.project_status')
        ->leftjoin('currency as c','c.currency_type','project_currency')
        ->leftjoin('location as l','l.location_id','project_location')
        ->leftjoin('sales_beacon_company as sbc','sbc.sales_beacon_company_id','project_salesbeacon_company')
        ->leftjoin('project_company as cp','cp.project_company_id','project_company')
        ->leftjoin('project_payee as py','py.project_payee_id','project_payee')
        ->leftjoin('project_internal as pi','pi.project_id','project.project_id')
        ->leftjoin('internal_project_type as ipt','ipt.internal_project_type_id','pi.project_internal_project_type_id')
        ->leftjoin('departments as dp','dp.department_id','pi.project_sb_department_id')
        ->leftjoin('users as dm','dm.user_id','pi.project_department_manager_id')
        ->where('project.project_id',$projectid)
        ->selectRaw('`project`.`project_id`,
        `project`.`project_year`,
        concat(u.`user_name`," ",u.user_lastname) username,
        `project`.`project_created_date`,
        `project`.`project_priority`,
        `project`.`project_renewal`,
        `project`.`project_number`,
        `project`.`project_title`,
    l.`location_id`,    
    l.`location_abbr`,
    fa.functional_area_id,
        fa.functional_area_name,
        `project`.`project_division`,
        `project`.`project_budget`,
        `project`.`project_commission`,
        `project`.`project_bonus`,
        `project`.`project_cisco_rate_card`,
        `project`.`project_company`,
        cp.`project_company_name`,
    sbc.`sales_beacon_company_id`,    
    sbc.`sales_beacon_company`,
        `project`.`project_sponsor`,
        `project`.`project_sponsor_title`,
        `project`.`project_start`,
        `project`.`project_end`,
        `project`.`project_original_hours`,
        pa.practice_area_id,
        pa.practice_area_name,
        c.`currency_type`,
        `project`.`project_payee`,
        py.`project_payee_name`,
        st.`project_status_id`,
        st.`project_status`,
        `project`.`project_notes`,
        `project`.`project_type`,
        pi.project_internal_id,
        pi.project_internal_project_type_id,
        ipt.internal_project_type_name,
        pi.project_sb_department_id,
        dp.department_name,
        pi.project_department_manager_id,
        concat(dm.user_name," ",dm.user_lastname) department_manager') ;

        $projects=$query->get();
        return $projects;
    }
    
  public function getCurrencies(){
    $currencies = DB::table('currency')
    ->orderBy('currency_id')
    ->get();
  return $currencies;  
  }
    public function getSBCompanies(){
        $sbcompanies = DB::table('sales_beacon_company')
        ->orderBy('sales_beacon_company_id')
        ->get();
      return $sbcompanies;  
    }
    
    public function getPONumbersbyprojectid($projectid)
    {
        
        $query=DB::table('project_purchase_order as pon')
        ->leftjoin('purchase_order_type as pot','pot.purchase_order_type_id','pon.purchase_order_type_id')
        ->join('project as p','p.project_id','pon.project_id')
        ->where('pon.project_id',$projectid)
        ->selectRaw('pon.project_purchase_order_id,p.project_number projectnumber,pon.*,pot.purchase_order_type') ;
        //$sql = str_replace_array('?', $query->getBindings(), $query->toSql()); 
        //dd($sql);
        $PONumbers=$query->get(); 
        return $PONumbers;
    }
    
    public function getPONumbersbyprojectid_toT($projectid)
    {

        $PONumbers=DB::table('t_project_purchase_order as pon')
        ->leftjoin('purchase_order_type as pot','pot.purchase_order_type_id','pon.purchase_order_type_id')
        ->join('project as p','p.project_id','pon.project_id')
        ->where('pon.project_id',$projectid)
        ->selectRaw('pon.project_purchase_order_id,p.project_number projectnumber,pon.*,pot.purchase_order_type') 
        ->get(); 
        return $PONumbers;
    }
    
    public function getresourcesbyprojectid($projectid)
    {
        $query=
        DB::table('project_resource as pr')
        ->leftjoin('time_entry as te','pr.project_resource_id','te.entry_project_resource_id')
        ->leftjoin('users as u','u.user_id','pr.project_resource_resource_id')
        ->leftjoin('users as u2','u2.user_id','pr.project_resource_project_client_manager_id')
        ->where('project_resource_project_id',$projectid) 
        ->groupBy('pr.project_resource_id')        
        ->selectRaw('pr.project_resource_id,concat(u.user_name," ",u.user_lastname) username,
        concat(u2.user_name," ",u2.user_lastname) clientmanager,pr.project_resource_project_client_manager_id,
        pr.project_resource_jobrole role_name,
        pr.project_resource_title,
        pr.project_resource_comment comment,
        pr.project_resource_sales_beacon_rate sbrate,
        pr.project_resource_client_rate clientrate,
        pr.project_resource_hours hours,
        pr.project_resource_active active,
        pr.project_resource_is_bonus isBonus,
        sum(te.entry_hours) loggedhours') ;
        //$sql = str_replace_array('?', $query->getBindings(), $query->toSql()); 
        //dd($sql);

        $projects=$query->get(); 
        return $projects;
    }
    
    public function getresourcesbyprojectid_toT($projectid)
    {
        $query=
        DB::table('t_project_resource as pr')
        ->leftjoin('time_entry as te','pr.project_resource_id','te.entry_project_resource_id')
        ->leftjoin('users  as u','u.user_id','pr.project_resource_resource_id')
        ->leftjoin('users as u2','u2.user_id','pr.project_resource_project_client_manager_id')
        ->where('project_resource_project_id',$projectid) 
        ->groupBy('pr.project_resource_id')        
        ->selectRaw('pr.project_resource_id,concat(u.user_name," ",u.user_lastname) username,
        concat(u2.user_name," ",u2.user_lastname) clientmanager,pr.project_resource_project_client_manager_id,
        pr.project_resource_jobrole role_name,
        pr.project_resource_title,
        pr.project_resource_comment comment,
        pr.project_resource_sales_beacon_rate sbrate,
        pr.project_resource_client_rate clientrate,
        pr.project_resource_hours hours,
        pr.project_resource_active active,
        pr.project_resource_is_bonus isBonus,
        sum(te.entry_hours) loggedhours'); 
        //$sql = str_replace_array('?', $query->getBindings(), $query->toSql()); 
        //dd($sql);

        $projects=$query->get(); 
        return $projects;
    }     
    public function getprojectbyid_toT($projectid){
    $query=DB::table('t_project as project')
    ->leftjoin('practice_area as pa','pa.practice_area_id','project_practice_area_id')
    ->leftjoin('functional_area  as fa','fa.functional_area_id','project_functional_area_id')
    ->leftjoin('users  as u','u.user_id','project_submitter')
    ->leftjoin('project_status as st','st.project_status_id','project.project_status')
    ->leftjoin('currency as c','c.currency_type','project_currency')
    ->leftjoin('location as l','l.location_id','project_location')
    ->leftjoin('sales_beacon_company as sbc','sbc.sales_beacon_company_id','project_salesbeacon_company')
    ->leftjoin('project_company as cp','cp.project_company_id','project_company')
    ->leftjoin('project_payee as py','py.project_payee_id','project_payee')
    ->leftjoin('t_project_internal as pi','pi.project_id','project.project_id')
    ->leftjoin('internal_project_type as ipt','ipt.internal_project_type_id','pi.project_internal_project_type_id')
    ->leftjoin('departments as dp','dp.department_id','pi.project_sb_department_id')
    ->leftjoin('users as dm','dm.user_id','pi.project_department_manager_id')
    ->where('project.project_id',$projectid)
    ->selectRaw('`project`.`project_id`,
    `project`.`project_year`,
    concat(u.`user_name`," ",u.user_lastname) username,
    `project`.`project_created_date`,
    `project`.`project_priority`,
    `project`.`project_renewal`,
    `project`.`project_number`,
    `project`.`project_title`,
    l.`location_id`,    
    l.`location_abbr`,
    fa.functional_area_id,
    fa.functional_area_name,
    `project`.`project_division`,
    `project`.`project_budget`,
    `project`.`project_commission`,
    `project`.`project_bonus`,
    `project`.`project_cisco_rate_card`,
    `project`.`project_company`,
    cp.`project_company_name`,
    sbc.`sales_beacon_company_id`,    
    sbc.`sales_beacon_company`,
    `project`.`project_sponsor`,
    `project`.`project_sponsor_title`,
    `project`.`project_start`,
    `project`.`project_end`,
    `project`.`project_original_hours`,
    pa.practice_area_id,
    pa.practice_area_name,
    c.`currency_type`,
    `project`.`project_payee`,
    py.`project_payee_name`,
    st.`project_status_id`,
    st.`project_status`,
    `project`.`project_notes`,
    `project`.`project_type`,
    pi.project_internal_id,
    pi.project_internal_project_type_id,
    ipt.internal_project_type_name,
    pi.project_sb_department_id,
    dp.department_name,
    pi.project_department_manager_id,
    concat(dm.user_name," ",dm.user_lastname) department_manager') ;
    //$sql = str_replace_array('?', $query->getBindings(), $query->toSql()); 
    //dd($sql);
    $project=$query->get(); 
    return $project;
    }


    public function getProjectStatus(){
        $projectStatuses= DB::table('project_status')
        ->orderBy('project_status_id')
        ->get();
        return $projectStatuses;

    } 
    public function getlocations(){
        $locations= DB::table('location')
        ->orderBy('location_id')
        ->get();
        return $locations;
    }
    public function getprojectpayees(){
        
        $projectPayees= $projectcompanies=$internalProjectTypes= DB::table('project_payee')
        ->where('project_payee_active','1') 
        ->orderBy('project_payee_id')
        ->get();
             
        return $projectPayees;
    }
    public function getprojectcompanies(){
        $projectcompanies=$internalProjectTypes= DB::table('project_company')
        ->where('project_company_active','1') 
        ->orderBy('project_company_id')
        ->get();
      return $projectcompanies;
    }        
public function getInternalProjectTypes(){
        $internalProjectTypes= DB::table('internal_project_type')
        ->orderBy('internal_project_type_id')
        ->get();
      return $internalProjectTypes;
}



public function getDepartmentManagers(){
        $managers= DB::table('users')
        ->selectRaw("user_id,concat(user_name,'',user_lastname)user_name") 
        ->where('user_active','1') 
        ->orderBy('user_id')
        ->get(); 
      return $managers;  
}
public function getDepartments(){
    $departments = DB::table('departments')
    ->orderBy('department_id')
    ->get();
  return $departments;  
}
public function generateRenewNumber($project_number){
    $query=DB::table('project')
    ->selectRaw('max(project_renewal) project_renewal') 
    ->where('project_number',$project_number);
    $maxnumbers= $query->first(); 
    if(empty($maxnumbers) )return -1;
    else{
        $newProjectRenewNumber=$maxnumbers->project_renewal;
        return $newProjectRenewNumber+1;
    }
}
public function getPos($project_id){
    $query=DB::table('project_purchase_order')
    ->selectRaw('purchase_order,purchase_order_value') 
    ->where('project_id',$project_id);
    $sql = str_replace_array('?', $query->getBindings(), $query->toSql()); 
    dd($sql);
    $rows= $query->get(); 
    return $row;
}

public function deleteProjectPOs($poids){
    $statement='delete from project_purchase_order where project_purchase_order_id in ('.$poids.')';
    ExecuteSQLStatement($this->db,$statement);

    $query=DB::table('project')
    ->selectRaw('max(project_renewal) project_renewal') 
    ->where('project_number',$project_number);
    $maxnumbers= $query->first(); 
    if(empty($maxnumbers) )return -1;
    else{
        $newProjectRenewNumber=$maxnumbers->project_renewal;
        return $newProjectRenewNumber+1;
    }

}
public function getInfoforProjectResource($project_resource_id){
    $statement='SELECT p.project_type,p.project_number,p.project_renewal,pr.project_resource_id,concat(u.user_name," ",u.user_lastname) username,
     concat(u2.user_name," ",u2.user_lastname) clientmanager,pr.project_resource_project_client_manager_id,
     pr.project_resource_jobrole,
pr.project_resource_title,
pr.project_resource_project_lead,
pr.project_resource_comment comment,
pr.project_resource_sales_beacon_rate sbrate,
pr.project_resource_client_rate clientrate,
pr.project_resource_hours hours,
pr.project_resource_require_schedule,
pr.project_resource_active,
pr.project_resource_is_bonus,
sum(CASE
            WHEN te.entry_deleted=0 THEN te.entry_hours
            ELSE 0.0
        END) loggedhours
FROM project_resource pr
inner join project p on p.project_id=pr.project_resource_project_id 
LEFT JOIN `time_entry` te on pr.project_resource_id= te.entry_project_resource_id
left join users u on u.user_id=pr.project_resource_resource_id
left join users u2 on u2.user_id =pr.project_resource_project_client_manager_id
WHERE  pr.project_resource_id ='.$project_resource_id;

    return ExecuteSQLQueryStatement($this->db,$statement);

    $query=DB::table('project')
    ->selectRaw('max(project_renewal) project_renewal') 
    ->where('project_number',$project_number);
    $maxnumbers= $query->first(); 
    if(empty($maxnumbers) )return -1;
    else{
        $newProjectRenewNumber=$maxnumbers->project_renewal;
        return $newProjectRenewNumber+1;
    }



}
public function getInfoforProjectResource_toT($project_resource_id){
    $statement='SELECT p.project_type,p.project_number,p.project_renewal,pr.project_resource_id,concat(u.user_name," ",u.user_lastname) username,
     concat(u2.user_name," ",u2.user_lastname) clientmanager,pr.project_resource_project_client_manager_id,
pr.project_resource_jobrole,
pr.project_resource_title,
pr.project_resource_project_lead,
pr.project_resource_comment comment,
pr.project_resource_sales_beacon_rate sbrate,
pr.project_resource_client_rate clientrate,
pr.project_resource_hours hours,
pr.project_resource_require_schedule,
pr.project_resource_active,
pr.project_resource_is_bonus,
sum(CASE
WHEN te.entry_deleted=0 THEN te.entry_hours
ELSE 0.0
END) loggedhours
FROM t_project_resource pr
inner join t_project p on p.project_id=pr.project_resource_project_id 
LEFT JOIN `time_entry` te on pr.project_resource_id= te.entry_project_resource_id
left join users u on u.user_id=pr.project_resource_resource_id
left join users u2 on u2.user_id =pr.project_resource_project_client_manager_id
WHERE  pr.project_resource_id ='.$project_resource_id;
    return ExecuteSQLQueryStatement($this->db,$statement);

    $query=DB::table('project')
    ->selectRaw('max(project_renewal) project_renewal') 
    ->where('project_number',$project_number);
    $maxnumbers= $query->first(); 
    if(empty($maxnumbers) )return -1;
    else{
        $newProjectRenewNumber=$maxnumbers->project_renewal;
        return $newProjectRenewNumber+1;
    }

}
/*
public function RenewProject($projectid){
    $project=DB::table('project as p1')
    ->join('project pas 2 ','p1.project_number','p2.project_number')
    ->where('p1.project_id',$projectid) 
    ->groupBy('p2.project_number')        
    ->selectRaw('p1.`project_year`,
    p1.`project_submitter`,
    now(),
    p1.`project_priority`,
    MAX(p2.`project_renewal`)+1,
    p1.`project_number`,
    p1.`project_title`,
    p1.`project_location`,
    p1.`project_functional_area_id`,
    p1.`project_division`,
    p1.`project_budget`,
    p1.`project_commission`,
    p1.`project_bonus`,
    p1.`project_cisco_rate_card`,
    p1.`project_company`,
    p1.`project_salesbeacon_company`,
    p1.`project_sponsor`,
    p1.`project_sponsor_title`,
    p1.`project_start`,
    p1.`project_end`,
    0,
    p1.`project_practice_area_id`,
    p1.`project_currency`,
    p1.`project_payee`,
    p1.`project_status`,
    p1.`project_notes`,
    p1.`project_type`,
    p1.`project_active`') 
    ->get(); 
if(empty($project))return;

    //copy ptoject basic info
    $newprojectID=DB::table('t_project')->insert(
        [
            `project_year`=> $project->project_year, 
            `project_submitter`=> $project->project_submitter, 
            `project_created_date`=> $project->project_created_date, 
            `project_priority`=> $project->project_priority, 
            `project_renewal`=> $project->project_renewal, 
            `project_number`=> $project->project_number, 
            `project_title`=> $project->project_title, 
            `project_location`=> $project->project_location, 
            `project_functional_area_id`=> $project->project_functional_area_id, 
            `project_division`=> $project->project_division, 
            `project_budget`=> $project->project_budget, 
            `project_commission`=> $project_commission, 
            `project_bonus`=> $project->project_bonus, 
            `project_cisco_rate_card`=> $project->project_cisco_rate_card, 
            `project_company`=> $project->project_company, 
            `project_salesbeacon_company`=> $project->project_salesbeacon_company, 
            `project_sponsor`=> $project->project_sponsor, 
            `project_sponsor_title`=> $project->project_sponsor_title, 
            `project_start`=> $project->project_start, 
            `project_end`=> $project->project_end, 
            `project_original_hours`=> $project->project_original_hours, 
            `project_practice_area_id`=> $project->project_practice_area_id, 
            `project_currency`=> $project->project_currency, 
            `project_payee`=> $project->project_payee, 
            `project_status`=> $project->project_status, 
            `project_notes`=> $project->project_notes, 
            `project_type`=> $project->project_type

        ]
    );


if($newprojectID>0){

$internalProject=DB::table('project_internal')
->where('project_id',$projectid) 
->selectRaw('project_sb_department_id,
project_department_manager_id
project_internal_project_type_id')
->get();

$newprojectID=DB::table('t_project_internal')->insert(
    [
        'project_id'=>$newprojectID,
        'project_sb_department_id'=>$internalProject->project_sb_department_id,
        'project_department_manager_id'=>$internalProject->project_department_manager_id,
        'project_internal_project_type_id'=>$internalProject->project_internal_project_type_id
    ]);

$project_purchase_order=DB::table('project_purchase_order')
->where('project_id',$projectid) 
->selectRaw('`purchase_order`,
`description`,
`purchase_order_type_id`,
`purchase_order_hours`,
`purchase_order_value`')
->get();

$newprojectID=DB::table('t_project_internal')->insert(
    
    [
        'project_id'=>$newprojectID,
        'purchase_order'=>$project_purchase_order->purchase_order,
        'description'=>$project_purchase_order->description,
        'purchase_order_type_id'=>$project_purchase_order->purchase_order_type_id,
        'purchase_order_hours'=>$project_purchase_order->purchase_order_hours,
        'purchase_order_value'=>$project_purchase_order->purchase_order_value
    ]);

    
    $project_resources=DB::table('project_resource')
    ->where('project_resource_project_id',$projectid) 
    ->selectRaw(
        'project_resource_project_lead,
        project_resource_resource_id,
        project_resource_project_client_manager_id,
        project_resource_jobrole,
        project_resource_title,
        project_resource_sales_beacon_rate,
        project_resource_client_rate,
        project_resource_require_schedule,
        project_resource_comment,
        project_resource_active,
        project_resource_is_bonus')
    ->get();
    
    foreach($project_resources as $project_resource){
        $project_resource->project_resource_project_id=$newprojectID;

        $project_resource->project_resource_hours=0;

    }
    DB::table('t_project_resource')->insert($project_resources);
    return $newprojectID;
}
}      
public function deleteProjectPOs_toT($poids){
        $statement='delete from t_project_purchase_order where project_purchase_order_id in ('.$poids.')';
        ExecuteSQLStatement($this->db,$statement);
    }
    public function deleteProjectResources($prids){
        $statement='delete from project_resource where project_resource_id in ('.$prids.')';
        ExecuteSQLStatement($this->db,$statement);
    }    
public function deleteProjectResources_toT($prids){
        $statement='delete from t_project_resource where project_resource_id in ('.$prids.')';
        ExecuteSQLStatement($this->db,$statement);
    }
public function savePONumbers_toT(){
        
        $project_purchase_order_id = (isset($_POST['project_purchase_order_id']) && $_POST['project_purchase_order_id']!='')?$_POST['project_purchase_order_id']:null;
        $purchase_order = (isset($_POST['purchase_order']) && $_POST['purchase_order']!='')?$_POST['purchase_order']:null;
        $project_id = (isset($_POST['project_id']) && $_POST['project_id']!='')?$_POST['project_id']:'0';
        $description = (isset($_POST['description']) && $_POST['description']!='')?$_POST['description']:null;
        $purchase_order_type_id= (isset($_POST['purchase_order_type_id']) && $_POST['purchase_order_type_id']!='')?$_POST['purchase_order_type_id']:'0';
        $purchase_order_hours= (isset($_POST['purchase_order_hours']) && $_POST['purchase_order_hours']!='')?$_POST['purchase_order_hours']:'0';
        $purchase_order_value= (isset($_POST['purchase_order_value']) && $_POST['purchase_order_value']!='')?$_POST['purchase_order_value']:'0';
        
        //$query_statement='SELECT * FROM `project_purchase_order` WHERE `project_id`='.$project_id.' AND `purchase_order` = '.$purchase_order;
        //$existingPos= ExecuteSQLQueryStatement($this->db, $query_statement);
        if(isset($project_purchase_order_id) && $project_purchase_order_id>0){
            //update
            $update_statement='UPDATE `t_project_purchase_order` SET '
            . '`purchase_order` =  "'.$purchase_order.'", '
            . '`description` =  "'.$description.'", '
            . '`purchase_order_type_id` =  '.$purchase_order_type_id.', '
            . '`purchase_order_hours` =  '.$purchase_order_hours.', '
            . '`purchase_order_value` =  '.$purchase_order_value
            .' WHERE  `project_purchase_order_id` ='.$project_purchase_order_id;
            ExecuteSQLStatement($this->db, $update_statement);
            
        }else{
        
         $statement = 'INSERT INTO `t_project_purchase_order`(
    `project_id`,
    `purchase_order`,
    `description`,    
    `purchase_order_type_id`,
    `purchase_order_hours`,
    `purchase_order_value`)
VALUES
    ( '.$project_id.',
        '.(isset($purchase_order)?'"'.$purchase_order.'",':' null,')
        .(isset($description)?'"'.$description.'",':' null,').$purchase_order_type_id.',
        '.$purchase_order_hours.',
        '.$purchase_order_value.');';
         ExecuteInsertStatement($this->db, $statement);
        }
    }
public function saveProjectResourceAssign_toT($project_resource_project){
    //project_numner is unique of business
    $project_resource_id = (isset($_POST['project_resource_id']) && $_POST['project_resource_id']!='')?$_POST['project_resource_id']:0;
    $project_resource_project_lead=(isset($_POST['project_resource_project_lead']) && $_POST['project_resource_project_lead']!='')? $_POST['project_resource_project_lead'] : 0;
    $project_resource_project_client_manager=(isset($_POST['project_resource_project_client_manager']) && $_POST['project_resource_project_client_manager']!='')? $_POST['project_resource_project_client_manager'] : 0;
    $project_resource_role=(isset($_POST['project_resource_user_role']) && $_POST['project_resource_user_role']!='')? $_POST['project_resource_user_role'] : '';
    $project_resource_title=(isset($_POST['project_resource_title']) && $_POST['project_resource_title']!='')? $_POST['project_resource_title'] : 0;
    $project_resource_sb_rate=(isset($_POST['project_resource_sb_rate']) && $_POST['project_resource_sb_rate']!='')? $_POST['project_resource_sb_rate'] : "0.0";
    $project_resource_client_rate=(isset($_POST['project_resource_client_rate']) && $_POST['project_resource_client_rate']!='')? $_POST['project_resource_client_rate'] : "0.0";
    $project_resource_hours=(isset($_POST['project_resource_hours']) && $_POST['project_resource_hours']!='')? $_POST['project_resource_hours'] : "0";
    $project_resource_require_schedule=(isset($_POST['project_scheduled']) && $_POST['project_scheduled']!='')? $_POST['project_scheduled'] : "1";
    
    $project_resource_comment =(isset($_POST['project_resource_comment']) && $_POST['project_resource_comment']!='')? $_POST['project_resource_comment'] : "";
    $project_resource_is_bonus =(isset($_POST['project_resource_is_bonus']) && $_POST['project_resource_is_bonus']!='')? $_POST['project_resource_is_bonus'] : "0";
    $statement = 'INSERT INTO `t_project_resource`(
`project_resource_resource_id`,
`project_resource_project_lead`,
`project_resource_project_id`,    
`project_resource_project_client_manager_id`,
`project_resource_jobrole`,
`project_resource_title`,
`project_resource_sales_beacon_rate`,
`project_resource_client_rate`,
`project_resource_hours`,
`project_resource_require_schedule`,
`project_resource_comment`,
`project_resource_active`,   
`project_resource_is_bonus`)
VALUES
(
    '.$project_resource_id.',
    '.$project_resource_project_lead.',
    '.$project_resource_project.',
    '.$project_resource_project_client_manager.',
    "'.$project_resource_role.'",
    "'.$project_resource_title.'",
    '.$project_resource_sb_rate.',
    '.$project_resource_client_rate.',
    '.$project_resource_hours.','
     .$project_resource_require_schedule.',"'
     .$project_resource_comment
     .'",1,'.$project_resource_is_bonus.');';
     
     $project_resource_id = ExecuteInsertStatement($this->db, $statement);
         
    }
    
public function  saveProjectResourceEdit_toT(){
    $project_resource_id = (isset($_POST['project_resource_id']) && $_POST['project_resource_id']!='')?$_POST['project_resource_id']:0;
        $project_resource_project_lead=(isset($_POST['project_resource_project_lead']) && $_POST['project_resource_project_lead']!='')? $_POST['project_resource_project_lead'] : 0;
        $project_resource_role=(isset($_POST['project_resource_user_role']) && $_POST['project_resource_user_role']!='')? $_POST['project_resource_user_role'] : 0;
        $project_resource_title=(isset($_POST['project_resource_title']) && $_POST['project_resource_title']!='')? $_POST['project_resource_title'] : 0;
        $project_resource_sb_rate=(isset($_POST['project_resource_sales_beacon_rate']) && $_POST['project_resource_sales_beacon_rate']!='')? $_POST['project_resource_sales_beacon_rate'] : "0.0";
        $project_resource_client_manager=(isset($_POST['project_resource_client_manager']) && $_POST['project_resource_client_manager']!='')? $_POST['project_resource_client_manager'] : "0";
        $project_resource_client_rate=(isset($_POST['project_resource_client_rate']) && $_POST['project_resource_client_rate']!='')? $_POST['project_resource_client_rate'] : "0.0";
        $project_resource_hours=(isset($_POST['project_resource_hours']) && $_POST['project_resource_hours']!='')? $_POST['project_resource_hours'] : "0";
        $project_resource_comment=(isset($_POST['project_resource_comment']) && $_POST['project_resource_comment']!='')? $_POST['project_resource_comment'] : "";
        $project_resource_require_schedule=(isset($_POST['project_scheduled']) && $_POST['project_scheduled']!='')? $_POST['project_scheduled'] : "1";
        $project_resource_active=(isset($_POST['project_resource_active']) && $_POST['project_resource_active']!='')? $_POST['project_resource_active'] : "0";
        $project_resource_is_bonus =(isset($_POST['project_resource_is_bonus']) && $_POST['project_resource_is_bonus']!='')? $_POST['project_resource_is_bonus'] : "0";
         $statement = 'UPDATE `t_project_resource`
    SET 
    `project_resource_project_lead`='.$project_resource_project_lead.',
    `project_resource_title`="'.$project_resource_title.'",
    `project_resource_sales_beacon_rate`='.$project_resource_sb_rate.',
    `project_resource_client_rate`='.$project_resource_client_rate.',
    `project_resource_project_client_manager_id`='.$project_resource_client_manager.',    
     `project_resource_comment`="'.$project_resource_comment.'",       
    `project_resource_hours`='.$project_resource_hours.',
     `project_resource_active`='.$project_resource_active.',
     `project_resource_is_bonus`='.$project_resource_is_bonus.',
    `project_resource_require_schedule`='.$project_resource_require_schedule.'  WHERE project_resource_id ='.$project_resource_id ;
         
         $project_resource_id = ExecuteInsertStatement($this->db, $statement);
    }

public function copy_resource_from_temporary($projectid,$newprojectid){
    $query_statement='INSERT INTO `project_resource`
(`project_resource_project_lead`,
`project_resource_project_id`,
`project_resource_resource_id`,
`project_resource_project_client_manager_id`,
`project_resource_jobrole`,
`project_resource_title`,
`project_resource_sales_beacon_rate`,
`project_resource_client_rate`,
`project_resource_hours`,
`project_resource_require_schedule`,
`project_resource_comment`,
`project_resource_active`,
`project_resource_is_bonus`)
SELECT `project_resource_project_lead`,'.$newprojectid.
',`project_resource_resource_id`,
`project_resource_project_client_manager_id`,
`project_resource_jobrole`,
`project_resource_title`,
`project_resource_sales_beacon_rate`,
`project_resource_client_rate`,
`project_resource_hours`,
`project_resource_require_schedule`,

`project_resource_comment`,
`project_resource_active`,
`project_resource_is_bonus`
FROM `t_project_resource`
WHERE project_resource_project_id= '.$projectid;
    ExecuteSQLStatement($this->db, $query_statement);
} 
public function copy_po_from_temporary($projectid,$newprojectid){
    $query_statement='INSERT INTO `project_purchase_order`
(`project_id`,
`purchase_order`,
`description`,
`purchase_order_type_id`,
`purchase_order_hours`,
`purchase_order_value`)
SELECT '.$newprojectid.',
`purchase_order`,
`description`,
`purchase_order_type_id`,
`purchase_order_hours`,
`purchase_order_value`
FROM `t_project_purchase_order`
WHERE `project_id`= '.$projectid;
    ExecuteSQLStatement($this->db, $query_statement);
} 
public function copy_project_from_temporary($projectid){
    $query_statement='INSERT INTO `project`
(
`project_year`,
`project_submitter`,
`project_created_date`,
`project_priority`,
`project_renewal`,
`project_number`,
`project_title`,
`project_location`,
`project_functional_area_id`,
`project_division`,
`project_budget`,
`project_commission`,
`project_bonus`,
`project_cisco_rate_card`,
`project_company`,
`project_salesbeacon_company`,
`project_sponsor`,
`project_sponsor_title`,
`project_start`,
`project_end`,
`project_original_hours`,
`project_practice_area_id`,
`project_currency`,
`project_payee`,
`project_status`,
`project_notes`,
`project_type`,
`project_active`)
SELECT `project_year`,
`project_submitter`,
`project_created_date`,
`project_priority`,
`project_renewal`,
`project_number`,
`project_title`,
`project_location`,
`project_functional_area_id`,
`project_division`,
`project_budget`,
`project_commission`,
`project_bonus`,
`project_cisco_rate_card`,
`project_company`,
`project_salesbeacon_company`,
`project_sponsor`,
`project_sponsor_title`,
`project_start`,
`project_end`,
`project_original_hours`,
`project_practice_area_id`,
`project_currency`,
`project_payee`,
`project_status`,
`project_notes`,
`project_type`,
`project_active`
FROM `t_project`
WHERE `project_id`='.$projectid;
    $pro_id=ExecuteInsertStatement($this->db, $query_statement);
    $log_author = $_SESSION['logineduser'];
    $this->eventlogModel->logEventAddProject($pro_id, $log_author);
    return $pro_id;
         
    
} 
public function copy_projectinternal_from_temporary($projectid,$newprojectid){
$statement=
'INSERT INTO `project_internal`
(
`project_id`,
`project_sb_department_id`,
`project_department_manager_id`,
`project_internal_project_type_id`)
SELECT 
    '.$newprojectid.',
    `project_sb_department_id`,
    `project_department_manager_id`,
    `project_internal_project_type_id`
FROM `t_project_internal` 
WHERE `project_id`= '.$projectid;    
    ExecuteSQLStatement($this->db, $statement);       
    
}
public function update_project_internal($newprojectid=0,$project_internalprojecttype = 0,$project_departmentmanager=0,$project_department=0){
            $updateaddditionalinternalfieldsstatement='UPDATE `project_internal`
            SET  `project_sb_department_id`=?,
            `project_department_manager_id`=?,
            `project_internal_project_type_id`=? 
            where project_id= ?;';
            if ($statement = mysqli_prepare($this->db, $updateaddditionalinternalfieldsstatement)) 
            {
                mysqli_stmt_bind_param($statement,"iiii", $project_department,$project_departmentmanager,$project_internalprojecttype,$newprojectid);
                mysqli_stmt_execute($statement);
                mysqli_stmt_close($statement);
            }     
    
}

public function getActiveProjectList(){
    $query_statement = 'SELECT t.project_id, t.`project_start`, project_title, `project_number`,`project_renewal`, `project_type`, `project_payee`, project_resource_id, project_status, project_end, sum(loggedhours) loggedhours, sum(project_resource_hours) allocatedhours 
                      FROM ( SELECT distinct project_id, project_start, `project_number`, project_title, `project_renewal`, `project_type`, project_payee, pr.project_resource_id, ps.project_status, 
                             project_end, pr.project_resource_hours, sum(CASE WHEN te.entry_deleted=0 THEN te.entry_hours ELSE 0.0 END) loggedhours
                             FROM project p                                 
                             LEFT JOIN `project_resource` pr on p.project_id = pr.project_resource_project_id
                             LEFT JOIN `time_entry` te on pr.project_resource_id= te.entry_project_resource_id                                 
                             INNER JOIN project_status ps on ps.project_status_id = p.project_status
                             WHERE p.`project_active` = 1 
                             GROUP BY project_id,project_resource_id) t                         
                      GROUP BY project_id 
                      ORDER BY project_number desc, project_renewal desc';

    return ExecuteSQLQueryStatement($this->db, $query_statement);
}
public function filterProject($searchCondition)
    {
        
        $projectnumber=$searchCondition["projectnumber"];
        $projectrenewal=$searchCondition["projectrenewal"];        
        $projecttitle=$searchCondition["projecttitle"];
        $projectuser=$searchCondition["projectuser"];
        $projectpo=$searchCondition["projectpo"];
        $projectstartfrom=$searchCondition["projectstartfrom"];
        $projectstartto=$searchCondition["projectstartto"];

        $querystatement='SELECT t.project_id,t.`project_start`, `project_number`,project_name 
, `project_renewal`, `project_title`, `project_payee`, `project_resource_id`
,`project_status`,`project_end`
,sum(loggedhours) loggedhours
,sum(project_resource_hours) allocatedhours FROM( 
SELECT distinct `project`.`project_id`
, `project_start`, `project_number`,project.project_title project_name
, `project_renewal`, `project_title`, `project_payee`, pr.project_resource_id
, ps.`project_status`
, `project_end`
,pr.project_resource_hours
,sum( CASE WHEN te.entry_deleted=0 THEN te.entry_hours ELSE 0.0 END) loggedhours
from `project` LEFT JOIN `project_resource` pr on `project`.project_id = pr.project_resource_project_id
LEFT JOIN `time_entry` te on pr.project_resource_id= te.entry_project_resource_id 
INNER JOIN project_status ps on ps.project_status_id = project.project_status 
LEFT JOIN users u on u.user_id=pr.project_resource_resource_id
LEFT JOIN  project_purchase_order po on po.project_id = project.project_id';
        
        $param_type = '';
        $a_params = array();
         if(isset($projectnumber)& $projectnumber!==''){
             //$queryconditionstatement_projectnumber=' WHERE project_number like "%'.$projectnumber.'%"';
             $queryconditionstatement_projectnumber=' project_number =?';
             $params_type.='i';
         }
         else {
             $queryconditionstatement_projectnumber='';
             
         }
        if(isset($queryconditionstatement_projectnumber)& $queryconditionstatement_projectnumber!==''){
         if(isset($queryconditionstatement)& $queryconditionstatement!==''){
             $queryconditionstatement.=' AND '.$queryconditionstatement_projectnumber;
         }
         else{
             $queryconditionstatement.=' WHERE '.$queryconditionstatement_projectnumber;
         }

        }
        if(isset($projectrenewal)& $projectrenewal!==''){
            $queryconditionstatement_projectrenewal=' project_renewal =?';
            $params_type.='i';
        }
        else {
            $queryconditionstatement_projectrenewal='';
            
        }
       if(isset($queryconditionstatement_projectrenewal)& $queryconditionstatement_projectrenewal!==''){
        if(isset($queryconditionstatement)& $queryconditionstatement!==''){
            $queryconditionstatement.=' AND '.$queryconditionstatement_projectrenewal;
        }
        else{
            $queryconditionstatement.=' WHERE '.$queryconditionstatement_projectrenewal;
        }

       }
        
         if(isset($projecttitle)& $projecttitle!==''){
                 $queryconditionstatement_projecttitle=' project_title like ?';
                 $params_type.='s';
         }else{
             $queryconditionstatement_projecttitle='';
         }
         if(isset($queryconditionstatement_projecttitle)& $queryconditionstatement_projecttitle!==''){
            if(isset($queryconditionstatement)& $queryconditionstatement!==''){

                $queryconditionstatement.=' AND '.$queryconditionstatement_projecttitle;
            }
            else{
                $queryconditionstatement.=' WHERE '.$queryconditionstatement_projecttitle;
            }
             
         }
         
         if(isset($projectuser)& $projectuser!==''){
                 $queryconditionstatement_projectuser=' concat(u.user_name," ",u.user_lastname) like ?';
                 $params_type.='s';
         }else{
             $queryconditionstatement_projectuser='';
         }
         if(isset($queryconditionstatement_projectuser)& $queryconditionstatement_projectuser!==''){
            if(isset($queryconditionstatement)& $queryconditionstatement!==''){

                $queryconditionstatement.=' AND '.$queryconditionstatement_projectuser;
            }
            else{
                $queryconditionstatement.=' WHERE '.$queryconditionstatement_projectuser;
            }
             
         }
         
         if(isset($projectpo)& $projectpo!==''){
                 $queryconditionstatement_projectpo=' po.purchase_order like ?';
                 $params_type.='s';
         }else{
             $queryconditionstatement_projectpo='';
         }
         if(isset($queryconditionstatement_projectpo)& $queryconditionstatement_projectpo!==''){
            if(isset($queryconditionstatement)& $queryconditionstatement!==''){

                $queryconditionstatement.=' AND '.$queryconditionstatement_projectpo;
            }
            else{
                $queryconditionstatement.=' WHERE '.$queryconditionstatement_projectpo;
            }
             
         }
         
         if(isset($projectstartfrom)& $projectstartfrom!==''){
                 $queryconditionstatement_projectstartfrom=' project_start >= ?';
                 $params_type.='s';
         }else{
             $queryconditionstatement_projectstartfrom='';
         }
         if(isset($queryconditionstatement_projectstartfrom)& $queryconditionstatement_projectstartfrom!==''){
            if(isset($queryconditionstatement)& $queryconditionstatement!==''){

                $queryconditionstatement.=' AND '.$queryconditionstatement_projectstartfrom;
            }
            else{
                $queryconditionstatement.=' WHERE '.$queryconditionstatement_projectstartfrom;
            }
             
         }
         
         if(isset($projectstartto)& $projectstartto!==''){
                 $queryconditionstatement_projectstartto=' project_start <= ?';
                 $params_type.='s';
         }else{
             $queryconditionstatement_projectstartto='';
         }
         
         if(isset($queryconditionstatement_projectstartto)& $queryconditionstatement_projectstartto!==''){
            if(isset($queryconditionstatement)& $queryconditionstatement!==''){
                $queryconditionstatement.=' AND '.$queryconditionstatement_projectstartto;
            }
            else{
                $queryconditionstatement.=' WHERE '.$queryconditionstatement_projectstartto;
            }
             
         }
         
        $projects=[];
        $querystatement.=$queryconditionstatement;
    
        $querystatement.=' group by project_id,project_resource_id) t
        group by project_id
        order by project_renewal';
        //echo $querystatement;
        if($statement = mysqli_prepare($this->db, $querystatement)) 
	{
            $a_params[] = & $statement ;
            $a_params[] = & $params_type;
            if(isset($projectnumber)& $projectnumber!==''){
                $a_params[] = & $projectnumber;
            }
            if(isset($projectrenewal)& $projectrenewal!==''){
                $a_params[] = & $projectrenewal;
            }
            if(isset($projecttitle)& $projecttitle!==''){
                $paramtitle="%{$projecttitle}%";
                $a_params[] = & $paramtitle;
            }
            if(isset($projectuser)& $projectuser!==''){
                $paramuser="%{$projectuser}%";
                $a_params[] = & $paramuser;
                
            }
            if(isset($projectpo)& $projectpo!==''){
                $parampo="%{$projectpo}%";
                $a_params[] = & $parampo;
            }
            if(isset($projectstartfrom)& $projectstartfrom!==''){
                $paramstartfrom="{$projectstartfrom}";
                $a_params[] = & $paramstartfrom;
            }
            if(isset($projectstartto)& $projectstartto!==''){
                $paramstartto="{$projectstartto}";
                $a_params[] = & $paramstartto;
            }
            

            call_user_func_array("mysqli_stmt_bind_param",$a_params);
            //mysqli_stmt_bind_param($statement,"i", $projectnumber);
           $b=mysqli_stmt_execute($statement);
           if(!$b){echo mysqli_error($this->db);}
           $b= mysqli_stmt_bind_result($statement, $project_id,$project_start,$project_number,$project_name,$project_renewal,$project_title,$project_payee,$project_resource_id,$project_status,$project_end,$loggedhours,$allocatedhours);
           if(!$b){echo mysqli_error($this->db);}
            while (mysqli_stmt_fetch($statement)) {
                array_push($projects, array("project_id" => $project_id, 
                    "project_start" => $project_start,
                    "project_number" => $project_number,
                    "project_name" => $project_name,
                    "project_renewal" => $project_renewal,
                    "project_title" => $project_title,
                    "project_payee" => $project_payee,
                    "project_resource_id" => $project_resource_id,
                    "project_status" => $project_status,
                    "project_end" => $project_end,
                    "loggedhours" => $loggedhours,
                    "allocatedhours" => $allocatedhours
                    ));
            }
            //mysqli_stmt_store_result($statement);
            //$count = mysqli_stmt_num_rows($statement);
            //$err= mysqli_error($this->db);
            mysqli_stmt_close($statement);
        
        }
        return $projects;
    }
    public function getAssignedUsersofProjectforClientManager($project_id,$clientManager){
        $querystatement='
       SELECT distinct project_resource_id pr_id  ,concat(users.user_name," ",users.user_lastname) user_name FROM project_resource
       inner join users on users.user_id = project_resource.project_resource_resource_id
       where project_resource_project_id='.$project_id . ' AND project_resource_active=1  AND project_resource_project_client_manager_id= '.$clientManager;

       return ExecuteSQLQueryStatement($this->db, $querystatement);
   }
   public function getAssignedUsersofProject($project_id){
       $querystatement='
SELECT distinct project_resource_id pr_id  ,concat(users.user_name," ",users.user_lastname) user_name,project_resource_comment,
(project_resource_hours-sum(CASE WHEN te.entry_deleted=0 THEN te.entry_hours ELSE 0.0 END)) remainghours
FROM project_resource
left join time_entry te on te.entry_project_resource_id = project_resource_id
inner join users on users.user_id = project_resource.project_resource_resource_id
where project_resource_project_id ='.$project_id.' AND project_resource_active=1  group by project_resource.project_resource_id';
//echo $querystatement;
       return ExecuteSQLQueryStatement($this->db, $querystatement);
       
   }
   
public function getPOTypes(){
    $query_statement = 'select * from purchase_order_type order by purchase_order_type_id';
    return ExecuteSQLQueryStatement($this->db, $query_statement);
}
public function getTotalHoursAssignedforProject($project_id){
    $query_statement='select (sum(ifnull(project_resource_hours,0))) remainghours 
from project_resource pr
right join project p on p.project_id = pr.project_resource_project_id
where p.project_id='.$project_id.' and pr.project_resource_is_bonus =0';
//echo $query_statement;
    $totalHours = ExecuteSQLQueryStatement($this->db, $query_statement);
    if(isset($totalHours) && count($totalHours)>0) 
    {
        if($totalHours[0]['remainghours']==null || $totalHours[0]['remainghours']==='0')return 0;
        else return $totalHours[0]['remainghours']; 
    
    }else return  0;
    
}
public function getTotalHoursAssignedforProject_T($project_id){
    $query_statement='select (sum(ifnull(project_resource_hours,0))) remainghours 
    from t_project_resource pr
    right join t_project p on p.project_id = pr.project_resource_project_id
    where p.project_id='.$project_id .' and pr.project_resource_is_bonus =0';
    $totalHours = ExecuteSQLQueryStatement($this->db, $query_statement);
    if(isset($totalHours) && count($totalHours)>0) 
    {
        if($totalHours[0]['remainghours']==null || $totalHours[0]['remainghours']==='0')return 0;
        else return $totalHours[0]['remainghours']; 
    
    }else return  0;
    
} 
public function newProject($projectnumber){
    $statement = 'INSERT INTO `t_project`
(
`project_renewal`,
`project_number`
)
VALUES(1,"'.$projectnumber.'")' ;

$newprojectID=ExecuteInsertStatement($this->db, $statement);  
return $newprojectID;
}


public function saveNewProject(){
    //project_numner is unique of business
    $project_number = isset($_POST[project_number])? $_POST['project_number'] : '';
    $project_year=isset($_POST[project_year])? $_POST['project_year'] : date('Y');
    if($project_number=='')return;
    $query_statement='SELECT * FROM `project` WHERE project_number="'.$project_number.'"';
    
    $existingProject= ExecuteSQLQueryStatement($this->db, $query_statement);
    if(isset($existingProject) && count($existingProject)>0){
        //update
    }else
    {
    $project_submitter=(isset($_POST[project_submitter]) && $_POST[project_submitter]!='')? $_POST['project_submitter'] : $_SESSION['logineduser'];
    $project_created_date=date('Y-m-d H:i:s');
    $project_priority=(isset($_POST[project_priority]) && $_POST[project_priority]!='')? $_POST['project_priority'] : '0';
    $project_renewal=(isset($_POST[project_renewal]) && $_POST[project_renewal]!='')? $_POST['project_renewal'] : '1';
    $project_title=(isset($_POST[project_title]) && $_POST[project_title]!='')? $_POST['project_title'] : null;
    //$project_country=(isset($_POST[project_country]) && $_POST[project_country]!='')? $_POST['project_country'] : null;
    //$project_prov=(isset($_POST[project_prov]) && $_POST[project_prov]!='')? $_POST['project_prov'] : null;
    $project_location=(isset($_POST[project_location]) && $_POST[project_location]!='')? $_POST['project_location'] : '0';
    $project_functional_area=(isset($_POST[project_functional_area]) && $_POST[project_functional_area]!='')? $_POST['project_functional_area'] : '0';
    $project_division=(isset($_POST[project_division]) && $_POST[project_division]!='')? $_POST['project_division'] : null;
    $project_budget=(isset($_POST[project_budget]) && $_POST[project_budget]!='')? $_POST['project_budget'] : '0';        
    $project_commission=(isset($_POST[project_commission]) && $_POST[project_commission]!='')? $_POST['project_commission'] : '0';
    $project_bonus=(isset($_POST[project_bonus]) && $_POST[project_bonus]!='')? $_POST['project_bonus'] : '0';
    $project_cisco_rate_card=(isset($_POST[project_cisco_rate_card]) && $_POST[project_cisco_rate_card]!='')? $_POST['project_cisco_rate_card'] : '1';
    $project_company=(isset($_POST[project_company]) && $_POST[project_company]!='')? $_POST['project_company'] : null;
    $project_salesbeacon_company=(isset($_POST[project_salesbeacon_company]) && $_POST[project_salesbeacon_company]!='')? $_POST['project_salesbeacon_company'] : '0';
    $project_sponsor=(isset($_POST[project_sponsor]) && $_POST[project_sponsor]!='')? $_POST['project_sponsor'] : null;
    $project_sponsor_title=(isset($_POST[project_sponsor_title]) && $_POST[project_sponsor_title]!='')? $_POST['project_sponsor_title'] : null;
    $project_start=(isset($_POST[project_start]) && $_POST[project_start]!='')? $_POST['project_start'] : date('Y-m-d');
    $project_end=(isset($_POST[project_end]) && $_POST[project_end]!='')? $_POST['project_end'] : date('Y-m-d');
    $project_original_hours=(isset($_POST[project_original_hours]) && $_POST[project_original_hours]!='')? $_POST['project_original_hours'] : '0';
    //$project_po_number=(isset($_POST[project_po_number]) && $_POST[project_po_number]!='')? $_POST['project_po_number'] : null;
    //$project_po_type=(isset($_POST[project_po_type]) && $_POST[project_po_type]!='')? $_POST['project_po_type'] : null;
    $project_practice_area=(isset($_POST[project_practice_area]) && $_POST[project_practice_area]!='')? $_POST['project_practice_area'] : '0';
    $project_currency=(isset($_POST[project_currency]) && $_POST[project_currency]!='')? $_POST['project_currency'] : 'CAD';
    $project_payee=(isset($_POST[project_payee]) && $_POST[project_payee]!='')? $_POST['project_payee'] : null;
    $project_status=(isset($_POST[project_status]) && $_POST[project_status]!='')? $_POST['project_status'] : '1';
    $project_notes=(isset($_POST[project_notes]) && $_POST[project_notes]!='')? $_POST['project_notes'] : null;
    $project_type=(isset($_POST[project_type]) && $_POST[project_type]!='')? $_POST['project_type'] : '0'; 
    
    
    
     
     $statement = 'INSERT INTO `project`(
`project_year`,
`project_submitter`,
`project_created_date`,
`project_priority`,
`project_renewal`,
`project_number`,
`project_title`,
`project_location`,
`project_functional_area_id`,
`project_division`,
`project_budget`,
`project_commission`,
`project_bonus`,
`project_cisco_rate_card`,
`project_company`,
`project_salesbeacon_company`,
`project_sponsor`,
`project_sponsor_title`,
`project_start`,
`project_end`,
`project_original_hours`,
`project_practice_area_id`,
`project_currency`,
`project_payee`,
`project_status`,
`project_notes`,
`project_type`)
VALUES
('.$project_year.',
    '.$project_submitter.',
    "'.$project_created_date.'",
    '.$project_priority.',
    '.$project_renewal.','
    .(isset($project_number)?$project_number.',':' null,')        
    .(isset($project_title)?'"'.$project_title.'",':' null,')
    .$project_location.','    
    .$project_functional_area.','    
    .(isset($project_division)?'"'.$project_division.'",':' null,')
    .$project_budget.','    
    .$project_commission.','    
    .$project_bonus.','    
    .$project_cisco_rate_card.','    
    .(isset($project_company)?'"'.$project_company.'",':' null,')
    .$project_salesbeacon_company.','    
    .(isset($project_sponsor)?'"'.$project_sponsor.'",':' null,')
    .(isset($project_sponsor_title)?'"'.$project_sponsor_title.'",':' null,')
    .(isset($project_start)?'"'.$project_start.'",':' null,')
    .(isset($project_end)?'"'.$project_end.'",':' null,')
    .$project_original_hours.','    
    //.$project_po_number.','    
    //.$project_po_type.','    
    .$project_practice_area.',"'     
    .$project_currency.'",'    
    .(isset($project_payee)?'"'.$project_payee.'",':' null,')
    .$project_status.','    
    .(isset($project_notes)?'"'.$project_notes.'",':' null,')
    .$project_type.');';
     
     //'here to stop attaching';
     $projectID=ExecuteInsertStatement($this->db, $statement);        
     if($projectID>0){
     if($project_type==='1'){
         $project_internalprojecttype=(isset($_POST['project_internalprojecttype']) && $_POST['project_internalprojecttype']!='')? $_POST['project_internalprojecttype'] : '0'; 
         $project_departmentmanager=(isset($_POST['project_departmentmanager']) && $_POST['project_departmentmanager']!='')? $_POST['project_departmentmanager'] : '0'; 
         $project_department=(isset($_POST['project_department']) && $_POST['project_department']!='')? $_POST['project_department'] : '0'; 
        $insertaddditionalinternalfieldsstatement='INSERT INTO `project_internal`
        (`project_id`,
        `project_sb_department_id`,
        `project_department_manager_id`,
        `project_internal_project_type_id`)
        VALUES
        (?,?,?,?);';

        if ($statement = mysqli_prepare($this->db, $insertaddditionalinternalfieldsstatement)) 
        {
            mysqli_stmt_bind_param($statement,"iiii", $projectID,$project_department,$project_departmentmanager,$project_internalprojecttype);

            mysqli_stmt_execute($statement);
            mysqli_stmt_insert_id($statement);
            mysqli_stmt_close($statement);

        }     
     }    
     $log_author = $_SESSION['logineduser'];
     $this->eventlogModel->logEventAddProject($projectID, $log_author);
     $this->storeLatestProjectNumber($project_number);
     
     }
     return $projectID;
    }        
}
public function savePONumbers(){
        
    $project_purchase_order_id = (isset($_POST['project_purchase_order_id']) && $_POST['project_purchase_order_id']!='')?$_POST['project_purchase_order_id']:null;
    $purchase_order = (isset($_POST['purchase_order']) && $_POST['purchase_order']!='')?$_POST['purchase_order']:null;
    $project_id = (isset($_POST['project_id']) && $_POST['project_id']!='')?$_POST['project_id']:'0';
    $description = (isset($_POST['description']) && $_POST['description']!='')?$_POST['description']:null;
    $purchase_order_type_id= (isset($_POST['purchase_order_type_id']) && $_POST['purchase_order_type_id']!='')?$_POST['purchase_order_type_id']:'0';
    $purchase_order_hours= (isset($_POST['purchase_order_hours']) && $_POST['purchase_order_hours']!='')?$_POST['purchase_order_hours']:'0';
    $purchase_order_value= (isset($_POST['purchase_order_value']) && $_POST['purchase_order_value']!='')?$_POST['purchase_order_value']:'0';
    
    //$query_statement='SELECT * FROM `project_purchase_order` WHERE `project_id`='.$project_id.' AND `purchase_order` = '.$purchase_order;
    //$existingPos= ExecuteSQLQueryStatement($this->db, $query_statement);
    if(isset($project_purchase_order_id) && $project_purchase_order_id>0){

        DB::table('project_purchase_order')
        ->where('project_purchase_order_id',$project_purchase_order_id)
        ->update(
            [
            'purchase_order' =>$purchase_order, 
            'description' =>$description,
            'purchase_order_type_id' =>$purchase_order_type_id,
            'purchase_order_hours' =>$purchase_order_hours,
            'purchase_order_value' =>$purchase_order_value
            ]
        );
        
    $log_comments='PO ID: '.$project_purchase_order_id.' is updated.';
    $log_author = $_SESSION['logineduser'];
    $this->eventlogModel->logEventEditPo($project_purchase_order_id, $log_author) ;

    }else{
        $newprojectID=DB::table('project_purchase_order')
        ->where('project_purchase_order_id',$project_purchase_order_id)
        ->update(
            [
            'purchase_order' =>$purchase_order, 
            'description' =>$description,
            'purchase_order_type_id' =>$purchase_order_type_id,
            'purchase_order_hours' =>$purchase_order_hours,
            'purchase_order_value' =>$purchase_order_value
            ]
        );
    
     $statement = 'INSERT INTO `project_purchase_order`(
`project_id`,
`purchase_order`,
`description`,    
`purchase_order_type_id`,
`purchase_order_hours`,
`purchase_order_value`)
VALUES
( '.$project_id.',
    '.(isset($purchase_order)?'"'.$purchase_order.'",':' null,')
    .(isset($description)?'"'.$description.'",':' null,').$purchase_order_type_id.',
    '.$purchase_order_hours.',
    '.$purchase_order_value.');';
     
     
     
     ExecuteInsertStatement($this->db, $statement);
    $log_comments='Project ID: '.$project_id.' PO Number: '.$purchase_order;
    $log_author = $_SESSION['logineduser'];
    $this->eventlogModel->logEventAssignPONumber($project_id,$purchase_order, $log_author) ;
    }
}
public function saveProjectEdit($updateProject){

    DB::table('project')
    ->where('project_id', $updateProject['project_id'])
    ->update([
        'project_submitter' => $updateProject['project_submitter'],
        'project_title' => $updateProject['project_title'],
        'project_location' => $updateProject['project_location'],
        'project_functional_area_id' => $updateProject['project_functional_area'],
        'project_division' => $updateProject['project_division'],
        'project_budget' => $updateProject['project_budget'],
        'project_cisco_rate_card' => $updateProject['project_cisco_rate_card'],
        'project_company' => $updateProject['project_company'],
        'project_salesbeacon_company' => $updateProject['project_salesbeacon_company'],
        'project_sponsor' => $updateProject['project_sponsor'],
        'project_sponsor_title' => $updateProject['project_sponsor_title'],
        'project_start' => $updateProject['project_start'],
        'project_end' => $updateProject['project_end'],
        'project_original_hours' => $updateProject['project_original_hours'],
        'project_practice_area_id' => $updateProject['project_practice_area'],
        'project_currency' => $updateProject['project_currency'],
        'project_payee' => $updateProject['project_payee'],
        'project_status' => $updateProject['project_status'],
        'project_notes' => $updateProject['project_notes'],
        'project_commission' => $updateProject['project_commission'],
        'project_bonus' => $updateProject['project_bonus'],
        'project_type' => $updateProject['project_type']
    ]);




          if($updateProject['project_type']==='1'){
             $project_internalprojecttype = $updateProject['project_internalprojecttype'];
             //$project_departmentmanager=$updateProject['project_departmentmanager'];
             //$project_department=$updateProject['project_department'];
             //$project_internal_id=$updateProject['project_internal_id'];
         if($project_internal_id==='0'){

            $newprojectID=DB::table('project_internal')->insert(
                [
                    `project_id`=> $updateProject['project_id'], 
                    `project_sb_department_id`=> $updateProject['project_department'], 
                    `project_department_manager_id`=> $updateProject['project_departmentmanager'], 
                    `project_internal_project_type_id`=> $updateProject['project_internal_id']
                ]
            );
             
             
         }else{
            $newprojectID=DB::table('project_internal')
            ->where('project_internal_id',$project_internal_id)
            ->update(
                [
                    `project_id`=> $updateProject['project_id'], 
                    `project_sb_department_id`=> $updateProject['project_department'], 
                    `project_department_manager_id`=> $updateProject['project_departmentmanager'], 
                    `project_internal_project_type_id`=> $updateProject['project_internal_id']
                ]
            );

          }
         }
          $log_author = $_SESSION['logineduser'];
          $this->eventlogModel->logEventEditProject($updateProject['project_id'], $log_author);
         
         
     }
     public function saveProjectResourceAssign($project_resource_project){
        

       
        $newprojectID=DB::table('project_resource')->insert(
            [
                'project_resource_resource_id'=> $project->project_resource_id,
                'project_resource_project_lead'=> $project->project_resource_project_lead,
                'project_resource_project_id'=> $project->project_resource_project,
                'project_resource_project_client_manager_id'=> $project->project_resource_project_client_manager,
                'project_resource_jobrole'=> $project->project_resource_role,
                'project_resource_title'=> $project->project_resource_title,
                'project_resource_sales_beacon_rate'=> $project->project_resource_sb_rate,
                'project_resource_client_rate'=> $project->project_resource_client_rate,
                'project_resource_hours'=> $project->project_resource_hours,
                'project_resource_require_schedule'=> $project->project_resource_require_schedule,
                'project_resource_comment'=> $project->project_resource_comment,
                'project_resource_active'=> 1,
                'project_resource_is_bonus'=> $project->project_resource_is_bonus]
        );



       $log_author = $_SESSION['logineduser'];
       $this->eventlogModel->logEventAssignResource($project_resource_project,$project_resource_id, $log_author);
    }
    public function saveProjectResourceEdit($project_resource){
      
        DB::table('project_resource')
            ->where('project_resource_id', $project_resource->project_resource_id)
            ->update([
                ['project_resource_project_lead' => $project_resource->project_resource_project_lead],
                ['project_resource_title' => $project_resource->project_resource_title],
                ['project_resource_sales_beacon_rate' => $project_resource->project_resource_sb_rate],
                ['project_resource_client_rate' => $project_resource->project_resource_client_rate],
                ['project_resource_project_client_manager_id' => $project_resource->project_resource_client_manager],
                ['project_resource_comment' => $project_resource->project_resource_comment],
                ['project_resource_hours' => $project_resource->project_resource_hours],
                ['project_resource_active' => $project_resource->project_resource_active],
                ['project_resource_is_bonus' => $project_resource->project_resource_is_bonus],
                ['project_resource_require_schedule' => $project_resource->project_resource_require_schedule]
            
            ]);

        $log_author = $_SESSION['logineduser'];
        $this->eventlogModel->logEventAssignResource($project_resource_project,$project_resource_id, $log_author);  
        
        
    }
    public function generateProjectNumber(){
        $lastprojectnumbers = DB::table('options')
        ->where('option_name','lastprojectnumber')
        ->get();
        if(empty($lastprojectnumbers) || count($lastprojectnumbers)==0)return -1;
        else{
        $lastProjectNumber=$lastprojectnumbers[0]['option_value'];
            return $lastProjectNumber+1;
        }
       
    }   

*/
}