<?php

namespace App\ModelBuilder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Helper\UsertypeHelper;


//require_once('models/modelhelper/usertypeHelper.php');
  class AdminModelBuilder {

    public function getRoles(){
        $rows=DB::table('role')->get()->orderBy('role_id');
        return $rows;
    }
    public function getTitles(){
        $rows=DB::table('title')->get()->orderBy('title_id');
        return $rows;
    }
    public function get_resource_employment_status(){
        $rows=DB::table('resource_employment_status')->select('resource_employment_status,resource_employment_status_id,
        resource_status')->get()->orderBy('resource_employment_status_id');
        return $rows;
    }
    public function getdepartments(){
        $rows=DB::table('departments')->get()->orderBy('department_id');
        return $rows;
    }
    public function getactivepracticeareas(){
        $rows=DB::table('practice_area')->where('practice_area_active',1)->get()->orderBy('practice_area_id');
        return $rows;
    }
    public function getpracticearea(){
        $rows=DB::table('practice_area')->get()->orderBy('practice_area_id');
        return $rows;
    }
    public function getfunctionalarea(){
        $rows=DB::table('functional_area')->get()->orderBy('functional_area_id');
        return $rows;
    }
    public function getcompanies(){
        $rows=DB::table('project_company')->get()->orderBy('project_company_id');
        return $rows;
    }
    public function getpayees(){
        $rows=DB::table('project_payee')->get()->orderBy('project_payee_id');
        return $rows;
    }
    public function getAllUsertypeAuthorises($user_id){
        if($user_id==0)return null;
        
        $query=DB::table('user_type_authorize')->where('user_id',$user_id)->select('user_id','user_type_id')->orderBy('user_type_id');
        $rows=$query->get();

        
        if($rows->isEmpty())return null;
        else{

        $uts=UsertypeHelper::number2Usertypes($rows->first()->user_type_id);   
        //$uts_str=implode( ", ", $uts );
        //dd($uts);
        
        $user_row = \App\Models\TT_User::where('user_id',$user_id)->
        select('user_id',DB::Raw('concat(user_name," ",user_lastname) username'))->first();
        if(Empty($user_row)){
            return null; 
        }
        else{
            //dd($uts);
            $query=\App\Models\UserType::whereIn('user_type_id',$uts)
            ->select('user_type_id','user_type_name');
        $user_type_rows=$query ->get();
        //dd(array_values($uts));

        return $user_type_rows;
    
        }
        
        }
    }
    public function getAllUsertypes(){
        $rows=DB::table('user_type')->get()->orderBy('user_type_id');
        return $rows;
    }
    public function savedepartment($department){
        if($department['departmentid']==0){
            $newprojectID=DB::table('departments')->insert(
                [
                    `department_code`=> $department['departmentcode'], 
                    `department_name`=> $department['departmentname'],
                ]
            );
        }
        else{
            DB::table('departments')
            ->where('department_id', $department['departmentid'])
            ->update([
                `department_code`=> $department['departmentcode'], 
                `department_name`=> $department['departmentname'],
        ]);
        }
    }
    public function savepracticearea($practicearea){
        if($practicearea['practiceareaid']==0){
            $newprojectID=DB::table('practice_area')->insert(
                [
                    `practice_area_name`=> $practicearea['practiceareaname'], 
                    `practice_area_active`=> $practicearea['practiceareaactive'],
                ]
            );

        }
        else{
            DB::table('practice_area')
            ->where('practice_area_id', practicearea['practiceareaid'])
            ->update([
                `practice_area_name`=> $practicearea['practiceareaname'], 
                `practice_area_active`=> $practicearea['practiceareaactive'],
        ]);
        }
    }
    public function saveusertypes($usertypes){
        $n=UsertypeHelper::usertypes2Number($usertypes['usertype']);
        $rows=DB::table('user_type_authorize')
        ->select('user_type_auth_id,
        user_id,
        user_type_id,
        setupdate')
        ->where('user_id',$usertypes['userid'])
        ->get()->orderBy('role_id');
        if(isset($rows) && count($rows)>0){
            DB::table('user_type_authorize')
            ->where('user_id', $usertypes['userid'])
            ->update([
                'user_type_id' => $n,
                'setupdate' => 'now()'
            ]);
        }
        else{
                $newprojectID=DB::table('project_internal')->insert(
                    [
                        'user_id' => $usertypes['userid'],
                        'user_type_id' => $n,
                        'setupdate' => 'now()'
                    ]
                );
        }  
    }
    public function savepayee($payee){
        if($payee['payeeid']==0){
            $newprojectID=DB::table('project_payee')->insert(
                [
                    `project_payee_name`=> $payee['payeename'], 
                    `project_company_project_payee_activeactive`=> $payee['payeeactive'],
                ]
            );

        }
        else{
            DB::table('project_payee')
            ->where('project_payee_id', $payee['payeeid'])
            ->update([
                `project_payee_name`=> $payee['payeename'], 
                `project_company_project_payee_activeactive`=> $payee['payeeactive'],
        ]);
        }
    }
    public function savecompany($company){
        if($company['companyid']==0){
            $newprojectID=DB::table('project_company')->insert(
                [
                    `project_company_name`=> $company['companyname'], 
                    `project_company_active`=> $company['companyactive'],
                ]
            );

        }
        else{
            DB::table('project_company')
            ->where('project_company_id', $company['companyid'])
            ->update([
                `project_company_name`=> $company['companyname'], 
                `project_company_active`=> $company['companyactive'],
            ]);
        }
    }    
}
?>
