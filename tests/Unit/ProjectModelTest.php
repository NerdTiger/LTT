<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\ModelBuilder;
use Tests\GenerateMetaData;

use Illuminate\Support\Facades\DB;


class ProjectModelTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    /*private function reset_db(){
        //reset database
        
        $response = $this->get('/');

    }*/
        
    private function generate_project_purchase_order($project_id){
        $pos=[];
        $project_id=$project_id;
        $purchase_order_type_id=1;
        $purchase_order_hours='0';
        $purchase_order='test number';
        $description='unit test';
        $purchase_order_value='101';
        $project_purchase_order = factory(\App\Models\ProjectPurchaseOrder::class)->create(    
            [
                'project_id' => $project_id,
                'purchase_order_type_id' => $purchase_order_type_id,
                'purchase_order'=>$purchase_order,
                'description'=>$description,
                'purchase_order_hours' => $purchase_order_hours,
                'purchase_order_value' => $purchase_order_value,
            ]);
        array_push($pos,$project_purchase_order);    
        $project_id=$project_id;
        $purchase_order_type_id=2;
        $purchase_order='test number';
        $description='unit test';
        $purchase_order_hours='0';
        $purchase_order_value='102';
        $project_purchase_order = factory(\App\Models\ProjectPurchaseOrder::class)->create(    
            [
                'project_id' => $project_id,
                'purchase_order_type_id' => $purchase_order_type_id,
                'purchase_order'=>$purchase_order,
                'description'=>$description,
                'purchase_order_hours' => $purchase_order_hours,
                'purchase_order_value' => $purchase_order_value,
            ]);
        array_push($pos,$project_purchase_order);    
        $project_id=$project_id;
        $purchase_order_type_id=3;
        $purchase_order='test number';
        $description='unit test';
        $purchase_order_hours='0';
        $purchase_order_value='103';
        $project_purchase_order = factory(\App\Models\ProjectPurchaseOrder::class)->create(    
            [
                'project_id' => $project_id,
                'purchase_order_type_id' => $purchase_order_type_id,
                'purchase_order'=>$purchase_order,
                'description'=>$description,
                'purchase_order_hours' => $purchase_order_hours,
                'purchase_order_value' => $purchase_order_value,
            ]);
        array_push($pos,$project_purchase_order);       
        $project_id=$project_id;
        $purchase_order_type_id=4;
        $purchase_order='test number';
        $description='unit test';
        $purchase_order_hours='0';
        $purchase_order_value='104';
        $project_purchase_order = factory(\App\Models\ProjectPurchaseOrder::class)->create(    
            [
                'project_id' => $project_id,
                'purchase_order_type_id' => $purchase_order_type_id,
                'purchase_order'=>$purchase_order,
                'description'=>$description,
                'purchase_order_hours' => $purchase_order_hours,
                'purchase_order_value' => $purchase_order_value,
            ]);
        array_push($pos,$project_purchase_order); 
        return $pos;       
        }
        private function generate_project_purchase_order_toT($project_id){
            $pos=[];
        $project_id=$project_id;
        $purchase_order_type_id=1;
        $purchase_order_hours='0';
        $purchase_order='test number';
        $description='unit test';
        $purchase_order_value='100';
        $project_purchase_order = factory(\App\Models\TProjectPurchaseOrder::class)->create(    
            [
                'project_id' => $project_id,
                'purchase_order_type_id' => $purchase_order_type_id,
                'purchase_order'=>$purchase_order,
                'description'=>$description,
                'purchase_order_hours' => $purchase_order_hours,
                'purchase_order_value' => $purchase_order_value,
            ]);
        array_push($pos,$project_purchase_order);    
        $project_id=$project_id;
        $purchase_order_type_id=2;
        $purchase_order='test number';
        $description='unit test';
        $purchase_order_hours='0';
        $purchase_order_value='200';
        $project_purchase_order = factory(\App\Models\TProjectPurchaseOrder::class)->create(    
            [
                'project_id' => $project_id,
                'purchase_order_type_id' => $purchase_order_type_id,
                'purchase_order'=>$purchase_order,
                'description'=>$description,
                'purchase_order_hours' => $purchase_order_hours,
                'purchase_order_value' => $purchase_order_value,
            ]);
        array_push($pos,$project_purchase_order);    
        $project_id=$project_id;
        $purchase_order_type_id=3;
        $purchase_order='test number';
        $description='unit test';
        $purchase_order_hours='0';
        $purchase_order_value='300';
        $project_purchase_order = factory(\App\Models\TProjectPurchaseOrder::class)->create(    
            [
                'project_id' => $project_id,
                'purchase_order_type_id' => $purchase_order_type_id,
                'purchase_order'=>$purchase_order,
                'description'=>$description,
                'purchase_order_hours' => $purchase_order_hours,
                'purchase_order_value' => $purchase_order_value,
            ]);
        array_push($pos,$project_purchase_order);       
        $project_id=$project_id;
        $purchase_order_type_id=4;
        $purchase_order='test number';
        $description='unit test';
        $purchase_order_hours='0';
        $purchase_order_value='400';
        $project_purchase_order = factory(\App\Models\TProjectPurchaseOrder::class)->create(    
            [
                'project_id' => $project_id,
                'purchase_order_type_id' => $purchase_order_type_id,
                'purchase_order'=>$purchase_order,
                'description'=>$description,
                'purchase_order_hours' => $purchase_order_hours,
                'purchase_order_value' => $purchase_order_value,
            ]);
        array_push($pos,$project_purchase_order); 
        return $pos;     
    }

    private function generate_project(){
        //working, 2019-07-29 15:36 verified;
        $project_year = 2019;
        $project_submitter = 430;
        $project_priority = 0;
        $project_renewal = 1;
        $project_number = 15000;
        $project_title="test";
        $project_location = 2;
        $project_functional_area_id = 3;
        $project_budget = 20000;
        $project_commission = 1000;
        $project_bonus = 3000;
        $project_cisco_rate_card = 0;
        $project_company = 2;
        $project_original_hours = 400;
        $project_practice_area_id = 4;
        $project_payee = 2;
        $project_status = 1;
        $project_type = 0;
        $project_active = 1;
        $project_remaining_hours = 400;

        $project = factory(\App\Models\Project::class)->create(    
         [
            'project_year' => $project_year,
            'project_submitter' => $project_submitter,
            'project_priority' => $project_priority,
            'project_renewal' => $project_renewal,
            'project_number' => $project_number,
            'project_title' => $project_title,
            'project_location' => $project_location,
            'project_functional_area_id' => $project_functional_area_id,
            'project_budget' => $project_budget,
            'project_commission' => $project_commission,
            'project_bonus' => $project_bonus,
            'project_cisco_rate_card' => $project_cisco_rate_card,
            'project_company' => $project_company,
            'project_original_hours' => $project_original_hours,
            'project_practice_area_id' => $project_practice_area_id,
            'project_payee' => $project_payee,
            'project_status' => $project_status,
            'project_type' => $project_type,
            'project_active' => $project_active,
            'project_remaining_hours' => $project_remaining_hours
        ]);
        return $project;
    }
    private function generate_internal_project(){
        //working, 2019-07-29 15:36 verified;
        $project_year = 2019;
        $project_submitter = 430;
        $project_priority = 0;
        $project_renewal = 1;
        $project_number = 15000;
        $project_title="test";
        $project_location = 2;
        $project_functional_area_id = 3;
        $project_budget = 20000;
        $project_commission = 1000;
        $project_bonus = 3000;
        $project_cisco_rate_card = 0;
        $project_company = 2;
        $project_original_hours = 400;
        $project_practice_area_id = 4;
        $project_payee = 2;
        $project_status = 1;
        $project_type = 0;
        $project_active = 1;
        $project_remaining_hours = 400;

        $project = factory(\App\Models\Project::class)->create(    
         [
            'project_year' => $project_year,
            'project_submitter' => $project_submitter,
            'project_priority' => $project_priority,
            'project_renewal' => $project_renewal,
            'project_number' => $project_number,
            'project_title' => $project_title,
            'project_location' => $project_location,
            'project_functional_area_id' => $project_functional_area_id,
            'project_budget' => $project_budget,
            'project_commission' => $project_commission,
            'project_bonus' => $project_bonus,
            'project_cisco_rate_card' => $project_cisco_rate_card,
            'project_company' => $project_company,
            'project_original_hours' => $project_original_hours,
            'project_practice_area_id' => $project_practice_area_id,
            'project_payee' => $project_payee,
            'project_status' => $project_status,
            'project_type' => $project_type,
            'project_active' => $project_active,
            'project_remaining_hours' => $project_remaining_hours
        ]);
        $project_sb_department_id=1;
        $project_department_manager_id=3;
        $project_internal_project_type_id=2;
        $project_internal = factory(\App\Models\ProjectInternal::class)->create(    
            [
               'project_id' => $project['project_id'],
               'project_sb_department_id' => $project_sb_department_id,
               'project_department_manager_id' => $project_department_manager_id,
               'project_internal_project_type_id' => $project_internal_project_type_id,
               ]);
               
        return $project;
    }
    private function generate_project_toT(){
        //working, 2019-07-29 15:36 verified;
        $project_year = 2019;
        $project_submitter = 430;
        $project_priority = 0;
        $project_renewal = 1;
        $project_number = 15000;
        $project_location = 2;
        $project_functional_area_id = 3;
        $project_budget = 20000;
        $project_commission = 1000;
        $project_bonus = 3000;
        $project_cisco_rate_card = 0;
        $project_company = 2;
        $project_original_hours = 400;
        $project_practice_area_id = 4;
        $project_payee = 2;
        $project_status = 1;
        $project_type = 0;
        $project_active = 1;
        $project_remaining_hours = 400;

        $project = factory(\App\Models\TProject::class)->create(    
         [
            'project_year' => $project_year,
            'project_submitter' => $project_submitter,
            'project_priority' => $project_priority,
            'project_renewal' => $project_renewal,
            'project_number' => $project_location,
            'project_location' => $project_location,
            'project_functional_area_id' => $project_functional_area_id,
            'project_budget' => $project_budget,
            'project_commission' => $project_commission,
            'project_bonus' => $project_bonus,
            'project_cisco_rate_card' => $project_cisco_rate_card,
            'project_company' => $project_company,
            'project_original_hours' => $project_original_hours,
            'project_practice_area_id' => $project_practice_area_id,
            'project_payee' => $project_payee,
            'project_status' => $project_status,
            'project_type' => $project_type,
            'project_active' => $project_active,
            'project_remaining_hours' => $project_remaining_hours
        ]);
        return $project;
    }
    
    private function generate_project_assign($project_id){        
        $project_resource_project_lead='0';
        $project_resource_project_id=$project_id;
        $project_resource_resource_id='1';
        $project_resource_project_client_manager_id='2';
        $project_resource_role_id='9';//IT Support Staff
        $project_resource_title='sample tite';
        $project_resource_sales_beacon_rate='35';
        $project_resource_client_rate='80';
        $project_resource_hours='40';
        $project_resource_require_schedule='0';
        $project_resource_comment='sample comments';
        $project_resource_active='1';
        $project_resource_jobrole='';
        $project_resource_is_bonus='0';

        $pr = factory(\App\Models\ProjectResource::class)->create(    
            [
                'project_resource_project_lead' => $project_resource_project_lead,
                'project_resource_project_id' => $project_resource_project_id,
                'project_resource_resource_id' => $project_resource_resource_id,
                'project_resource_project_client_manager_id' => $project_resource_project_client_manager_id,
                'project_resource_role_id' => $project_resource_role_id,
                'project_resource_title' => $project_resource_title,
                'project_resource_sales_beacon_rate' => $project_resource_sales_beacon_rate,
                'project_resource_client_rate' => $project_resource_client_rate,
                'project_resource_hours' => $project_resource_hours,
                'project_resource_client_rate' => $project_resource_client_rate,
                'project_resource_require_schedule' => $project_resource_require_schedule,
                'project_resource_comment' => $project_resource_comment,
                'project_resource_active' => $project_resource_active,
                'project_resource_jobrole' => $project_resource_jobrole,
                'project_resource_is_bonus' => $project_resource_is_bonus,

            ]);
            return $pr;
    }
    private function generate_project_assign_toT($project_id){        
        $project_resource_project_lead='0';
        $project_resource_project_id=$project_id;
        $project_resource_resource_id='1';
        $project_resource_project_client_manager_id='2';
        $project_resource_role_id='9';//IT Support Staff
        $project_resource_title='sample tite';
        $project_resource_sales_beacon_rate='35';
        $project_resource_client_rate='80';
        $project_resource_hours='40';
        $project_resource_require_schedule='0';
        $project_resource_comment='sample comments';
        $project_resource_active='1';
        $project_resource_jobrole='';
        $project_resource_is_bonus='0';
        $project_id = factory(\App\Models\TProjectResource::class)->create(    
            [
                'project_resource_project_lead' => $project_resource_project_lead,
                'project_resource_project_id' => $project_resource_project_id,
                'project_resource_resource_id' => $project_resource_resource_id,
                'project_resource_project_client_manager_id' => $project_resource_project_client_manager_id,
                'project_resource_role_id' => $project_resource_role_id,
                'project_resource_title' => $project_resource_title,
                'project_resource_sales_beacon_rate' => $project_resource_sales_beacon_rate,
                'project_resource_client_rate' => $project_resource_client_rate,
                'project_resource_hours' => $project_resource_hours,
                'project_resource_client_rate' => $project_resource_client_rate,
                'project_resource_require_schedule' => $project_resource_require_schedule,
                'project_resource_comment' => $project_resource_comment,
                'project_resource_active' => $project_resource_active,
                'project_resource_jobrole' => $project_resource_jobrole,
                'project_resource_is_bonus' => $project_resource_is_bonus,

            ]);
    }
    private function generate_entry_deleted(){
        $project_year = 2019;
        $project_submitter = 430;
        $project_priority = 0;
        $project_renewal = 1;
        $project_number = 15000;
        $project_location = 2;
        $project_functional_area_id = 3;
        $project_budget = 20000;
        $project_commission = 1000;
        $project_bonus = 3000;
        $project_cisco_rate_card = 0;
        $project_company = 2;
        $project_original_hours = 400;
        $project_practice_area_id = 4;
        $project_payee = 2;
        $project_status = 1;
        $project_type = 0;
        $project_active = 1;
        $project_remaining_hours = 400;

        $project_id = factory(\App\Models\Project::class)->create([
            'project_year' => $project_year,
            'project_submitter' => $project_submitter,
            'project_priority' => $project_priority,
            'project_renewal' => $project_renewal,
            'project_number' => $project_location,
            'project_location' => $project_location,
            'project_functional_area_id' => $project_functional_area_id,
            'project_budget' => $project_budget,
            'project_commission' => $project_commission,
            'project_bonus' => $project_bonus,
            'project_cisco_rate_card' => $project_cisco_rate_card,
            'project_company' => $project_company,
            'project_original_hours' => $project_original_hours,
            'project_practice_area_id' => $project_practice_area_id,
            'project_payee' => $project_payee,
            'project_status' => $project_status,
            'project_type' => $project_type,
            'project_active' => $project_active,
            'project_remaining_hours' => $project_remaining_hours
        ]);
    
        $project_resource_project_lead='0';
        $project_resource_project_id=$project_id;
        $project_resource_resource_id='1';
        $project_resource_project_client_manager_id='2';
        $project_resource_role_id='9';//IT Support Staff
        $project_resource_title='sample tite';
        $project_resource_sales_beacon_rate='35';
        $project_resource_client_rate='80';
        $project_resource_hours='40';
        $project_resource_require_schedule='0';
        $project_resource_comment='sample comments';
        $project_resource_active='1';
        $project_resource_jobrole='';
        $project_resource_is_bonus='0';

        $project_resource_id = factory(\App\Models\ProjectResource::class)->create(    
            [
                'project_resource_project_lead' => $project_resource_project_lead,
                'project_resource_project_id' => $project_resource_project_id,
                'project_resource_resource_id' => $project_resource_resource_id,
                'project_resource_project_client_manager_id' => $project_resource_project_client_manager_id,
                'project_resource_role_id' => $project_resource_role_id,
                'project_resource_title' => $project_resource_title,
                'project_resource_sales_beacon_rate' => $project_resource_sales_beacon_rate,
                'project_resource_client_rate' => $project_resource_client_rate,
                'project_resource_hours' => $project_resource_hours,
                'project_resource_client_rate' => $project_resource_client_rate,
                'project_resource_require_schedule' => $project_resource_require_schedule,
                'project_resource_comment' => $project_resource_comment,
                'project_resource_active' => $project_resource_active,
                'project_resource_jobrole' => $project_resource_jobrole,
                'project_resource_is_bonus' => $project_resource_is_bonus,

            ]);
        $entry_date='2019-07-28';
        $entry_hours='3';
        $entry_project_resource_id=$project_resource_id;
        $entry_timestamp=date('Y-m-d');
        $entry_details='sample details-deleted';
        $entry_deleted='1';

        $project_id = factory(\App\Models\TimeEntry::class)->create([
            'entry_date'=>$entry_date,
            'entry_hours'=>$entry_hours,
            'entry_project_resource_id'=>$entry_project_resource_id,
            'entry_timestamp'=>$entry_timestamp,
            'entry_details'=>$entry_details,
            'entry_deleted'=>$entry_deleted]);
        
        
    }
    private function generate_entry(){
        $project_year = 2019;
        $project_submitter = 430;
        $project_priority = 0;
        $project_renewal = 1;
        $project_number = 15000;
        $project_location = 2;
        $project_functional_area_id = 3;
        $project_budget = 20000;
        $project_commission = 1000;
        $project_bonus = 3000;
        $project_cisco_rate_card = 0;
        $project_company = 2;
        $project_original_hours = 400;
        $project_practice_area_id = 4;
        $project_payee = 2;
        $project_status = 1;
        $project_type = 0;
        $project_active = 1;
        $project_remaining_hours = 400;

        $project_id = factory(\App\Models\Project::class)->create([
            'project_year' => $project_year,
            'project_submitter' => $project_submitter,
            'project_priority' => $project_priority,
            'project_renewal' => $project_renewal,
            'project_number' => $project_location,
            'project_location' => $project_location,
            'project_functional_area_id' => $project_functional_area_id,
            'project_budget' => $project_budget,
            'project_commission' => $project_commission,
            'project_bonus' => $project_bonus,
            'project_cisco_rate_card' => $project_cisco_rate_card,
            'project_company' => $project_company,
            'project_original_hours' => $project_original_hours,
            'project_practice_area_id' => $project_practice_area_id,
            'project_payee' => $project_payee,
            'project_status' => $project_status,
            'project_type' => $project_type,
            'project_active' => $project_active,
            'project_remaining_hours' => $project_remaining_hours
        ]);
    
        $project_resource_project_lead='0';
        $project_resource_project_id=$project_id;
        $project_resource_resource_id='1';
        $project_resource_project_client_manager_id='2';
        $project_resource_role_id='9';//IT Support Staff
        $project_resource_title='sample tite';
        $project_resource_sales_beacon_rate='35';
        $project_resource_client_rate='80';
        $project_resource_hours='40';
        $project_resource_require_schedule='0';
        $project_resource_comment='sample comments';
        $project_resource_active='1';
        $project_resource_jobrole='';
        $project_resource_is_bonus='0';

        $project_resource_id = factory(\App\Models\ProjectResource::class)->create(    
            [
                'project_resource_project_lead' => $project_resource_project_lead,
                'project_resource_project_id' => $project_resource_project_id,
                'project_resource_resource_id' => $project_resource_resource_id,
                'project_resource_project_client_manager_id' => $project_resource_project_client_manager_id,
                'project_resource_role_id' => $project_resource_role_id,
                'project_resource_title' => $project_resource_title,
                'project_resource_sales_beacon_rate' => $project_resource_sales_beacon_rate,
                'project_resource_client_rate' => $project_resource_client_rate,
                'project_resource_hours' => $project_resource_hours,
                'project_resource_client_rate' => $project_resource_client_rate,
                'project_resource_require_schedule' => $project_resource_require_schedule,
                'project_resource_comment' => $project_resource_comment,
                'project_resource_active' => $project_resource_active,
                'project_resource_jobrole' => $project_resource_jobrole,
                'project_resource_is_bonus' => $project_resource_is_bonus,

            ]);
        
        
        $entry_date='2019-07-29';
        $entry_hours='2';
        $entry_project_resource_id=$project_resource_id;
        $entry_timestamp=date('Y-m-d');
        $entry_details='sample details';
        $entry_deleted='0';

        $project_id = factory(\App\Models\TimeEntry::class)->create([
            'entry_date'=>$entry_date,
            'entry_hours'=>$entry_hours,
            'entry_project_resource_id'=>$entry_project_resource_id,
            'entry_timestamp'=>$entry_timestamp,
            'entry_details'=>$entry_details,
            'entry_deleted'=>$entry_deleted]);
    }
    
    
    /*
    public function test_getProjectList(){
        $this->generate_project_status();    
        $this->generate_entry_deleted();    
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getProjectList();
        print count($val);
        $this->assertTrue(count($val)==1);        
    }
    
    
    public function test_getProjectListForUser()
    {
        $this->generate_user();
        $this->generate_project_status();    
        $this->generate_entry_deleted();    
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getProjectListForUser('1');
        print count($val);
        $this->assertTrue(count($val)==1);
    }
    
    public function test_getProjectListForClientManager()
    {
        //$this->generate_user();
        $this->generate_project_status();    
        $this->generate_entry();    
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getProjectListForClientManager('2');
        print count($val);
        $this->assertTrue(count($val)==1);
    }

    
    public function test_getprojectbyid()
    {
        $this->generate_project();    
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getprojectbyid('1');
        //print count($val);
        $this->assertTrue(count($val)==1);
    }
    
    public function test_getCurrencies(){
        $this->generate_currencies();
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getCurrencies();
        //print count($val);
        $this->assertTrue(count($val)>1);
    }
    public function test_getSBCompanies(){
        $this->generate_companies();
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getCompanies();
        //print count($val);
        $this->assertTrue(count($val)>1);
        
    }
    
    public function test_getresourcesbyprojectid(){
        //clear resource
        $projects=DB::table('project_resource')->truncate();
        //clear project;
        $projects=DB::table('project')->truncate();
        //prpare project
        $project = $this->generate_project();
        //print $project['project_id']; php array element
        //prepare resource;
        $this->generate_project_assign($project['project_id']);
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getresourcesbyprojectid($project['project_id']);
        //print count($val);
        $this->assertTrue(count($val)==1);
        $projects=DB::table('project')->truncate();
        $projects=DB::table('project_resource')->truncate();
    }
    
    public function test_getresourcesbyprojectid_toT(){
    //clear resource
        $projects=DB::table('t_project_resource')->truncate();
        //clear project;
        $projects=DB::table('t_project')->truncate();
        //prpare project
        $project = $this->generate_project();
        //print $project['project_id']; php array element
        //prepare resource;
        $this->generate_project_assign_toT($project['project_id']);
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getresourcesbyprojectid_toT($project['project_id']);
        //print count($val);
        $this->assertTrue(count($val)==1);
        $projects=DB::table('t_project')->truncate();
        $projects=DB::table('t_project_resource')->truncate();        
    }
    
    public function test_getPONumbersbyprojectid(){
        //clear project_purchase_order
        DB::table('project_purchase_order')->truncate();
        //clear project;
        DB::table('project')->truncate();
        
        //prpare project
        $project = $this->generate_project();
        //print $project['project_id']; php array element
        //prepare purchase_order_type
        $projectpurcaseorders = $this->generate_project_purchase_order($project['project_id']);
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getPONumbersbyprojectid($project['project_id']);
        //print count($val);
        $this->assertTrue(count($val)==4);
        DB::table('project')->truncate();
        DB::table('project_purchase_order')->truncate();         
    }
    
    
    public function test_getPONumbersbyprojectid_toT(){
        //clear project_purchase_order
        DB::table('t_project_purchase_order')->truncate();
        //clear project;
        DB::table('t_project')->truncate();
        //prpare project
        $project = $this->generate_project();
        //print $project['project_id']; php array element
        //prepare purchase_order_type
        $projectpurcaseorders = $this->generate_project_purchase_order_toT($project['project_id']);
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getPONumbersbyprojectid_toT($project['project_id']);
        //print count($val);
        $this->assertTrue(count($val)==4);
        DB::table('t_project')->truncate();
        DB::table('t_project_purchase_order')->truncate();         
    }
    
    public function test_getprojectbyid_toT()
    {
        DB::table('t_project')->truncate();
        $this->generate_project_toT();    
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getprojectbyid_toT('1');
        //print count($val);
        $this->assertTrue(count($val)==1);
        DB::table('t_project')->truncate();
    }

public function test_getlocations(){
    DB::table('location')->truncate();
    GenerateMetaData::generate_locations();    
    $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
    $val =$pro_builder->getlocations();
    //print count($val);
    $this->assertTrue(count($val)==1);
    DB::table('location')->truncate();        
}

    public function test_getProjectStatus(){
        DB::table('project_status')->truncate();
        GenerateMetaData::generate_project_status();    
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getProjectStatus();
        //print count($val);
        $this->assertTrue(count($val)==3);
        DB::table('project_status')->truncate();        
    }
    public function test_getprojectpayees(){
        DB::table('project_payee')->truncate();
        GenerateMetaData::generate_projectpayees();    
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getprojectpayees();
        //print count($val);
        $this->assertTrue(count($val)==2);
        DB::table('project_payee')->truncate();        
    }
    
    public function test_getprojectcompanies(){
        DB::table('project_company')->truncate();
        GenerateMetaData::generate_projectcompanies();    
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getprojectcompanies();
        //print count($val);
        $this->assertTrue(count($val)==2);
        DB::table('project_company')->truncate();        
    }
    
    public function test_getInternalProjectTypes(){
        DB::table('internal_project_type')->truncate();
        GenerateMetaData::generate_internal_project_types();    
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getInternalProjectTypes();
        //print count($val);
        $this->assertTrue(count($val)==2);
        DB::table('internal_project_type')->truncate();        
    }
    
    public function test_getInternalProjectTypes(){
        DB::table('internal_project_type')->truncate();
        GenerateMetaData::generate_internal_project_types();    
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getInternalProjectTypes();
        //print count($val);
        $this->assertTrue(count($val)==2);
        DB::table('internal_project_type')->truncate();        
    }
    
    public function test_getDepartments(){
        DB::table('departments')->truncate();
        GenerateMetaData::generate_departments();    
        $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
        $val =$pro_builder->getDepartments();
        //print count($val);
        $this->assertTrue(count($val)==2);
        DB::table('departments')->truncate();        
    }

public function test_getDepartmentManagers(){
    DB::table('users')->truncate();
    GenerateMetaData::generate_user();    
    $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
    $val =$pro_builder->getDepartmentManagers();
    //print count($val);
    $this->assertTrue(count($val)==2);
    DB::table('users')->truncate();        
}

public function test_generateRenewNumber(){
    DB::table('project')->truncate();
    $project=$this->generate_project();    
    $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
    $val =$pro_builder->generateRenewNumber($project['project_number']);
    $this->assertTrue($val==2);
    //DB::table('project')->truncate();        
}

public function test_getPos(){
    //clear project_purchase_order
    DB::table('project_purchase_order')->truncate();
    //clear project;
    DB::table('project')->truncate();

    $project=$this->generate_project();    
    $projectpurcaseorders = $this->generate_project_purchase_order($project['project_id']);
    $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
    $val =$pro_builder->getPos($project['project_id']);
    $this->assertTrue(count($val)==4);
    DB::table('project')->truncate();
    DB::table('project_purchase_order')->truncate();         

}

public function test_deleteProjectPOs(){
    //clear project_purchase_order
    DB::table('project_purchase_order')->truncate();
    //clear project;
    DB::table('project')->truncate();
    $project=$this->generate_project();    
    $projectpurcaseorders = $this->generate_project_purchase_order($project['project_id']);
    $pos = [];
    foreach($projectpurcaseorders as $po){
        //dump($po->project_purchase_order_id);
        array_push($pos,$po->project_purchase_order_id);
    }
    
    $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
    $pro_builder->deleteProjectPOs($pos);
    
    $this->assertTrue(0==0);
    DB::table('project')->truncate();
    //DB::table('project_purchase_order')->truncate();         

}

public function test_deleteProjectPOs_toT(){
    //clear project_purchase_order
    DB::table('t_project_purchase_order')->truncate();
    //clear project;
    DB::table('t_project')->truncate();
    $project=$this->generate_project_toT();    
    $projectpurcaseorders = $this->generate_project_purchase_order_toT($project['project_id']);
    $pos = [];
    foreach($projectpurcaseorders as $po){
        //dump($po->project_purchase_order_id);
        array_push($pos,$po->project_purchase_order_id);
    }
    
    $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
    $pro_builder->deleteProjectPOs_toT($pos);
    
    $this->assertTrue(0==0);
    DB::table('project')->truncate();
    DB::table('project_purchase_order')->truncate();         

}

public function test_savePONumbers(){
    //clear project_purchase_order
    DB::table('project_purchase_order')->truncate();
    //clear project;
    DB::table('project')->truncate();
    $project=$this->generate_project();    
    //$projectpurcaseorders = $this->generate_project_purchase_order_toT($project['project_id']);
    $project_purchase_order_id=0;
    $project_id=$project['project_id'];
    $purchase_order_type_id=1;
    $purchase_order_hours='0';
    $purchase_order='test number';
    $description='unit test';
    $purchase_order_value='101';

    $po=[
        'project_purchase_order_id'=>$project_purchase_order_id,
        'purchase_order'=>$purchase_order,
        'project_id'=>$project_id,
        'description'=>$description,
        'purchase_order_type_id'=>$purchase_order_type_id,
        'purchase_order_hours'=>$purchase_order_hours,
        'purchase_order_value'=>$purchase_order_value,
    ];
    $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
    $newpo=$pro_builder->savePONumbers($po);
    
    $this->assertTrue(isset($newpo));
    DB::table('project')->truncate();
    DB::table('project_purchase_order')->truncate();
}

public function test_savePONumbers_toT(){
    //clear project_purchase_order
    DB::table('t_project_purchase_order')->truncate();
    //clear project;
    DB::table('t_project')->truncate();
    $project=$this->generate_project();    
    
    $project_purchase_order_id=0;
    $project_id=$project['project_id'];
    $purchase_order_type_id=1;
    $purchase_order_hours='0';
    $purchase_order='test number';
    $description='unit test';
    $purchase_order_value='101';

    $po=[
        'project_purchase_order_id'=>$project_purchase_order_id,
        'purchase_order'=>$purchase_order,
        'project_id'=>$project_id,
        'description'=>$description,
        'purchase_order_type_id'=>$purchase_order_type_id,
        'purchase_order_hours'=>$purchase_order_hours,
        'purchase_order_value'=>$purchase_order_value,
    ];
    $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
    $po=$pro_builder->savePONumbers_toT($po);
    
    $this->assertTrue(isset($po));
    DB::table('t_project')->truncate();
    DB::table('t_project_purchase_order')->truncate();
}

public function test_getInfoforProjectResource(){
    //clear project_purchase_order
    DB::table('project_resource')->truncate();
    //clear project;
    DB::table('project')->truncate();

    $project=$this->generate_project();    
    $pr = $this->generate_project_assign($project['project_id']);
    //dump($pr);
    $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
    
    $val =$pro_builder->getInfoforProjectResource($pr['project_resource_id']);
    $this->assertTrue(isset($val));
    DB::table('project')->truncate();
    DB::table('project_resource')->truncate();           
}

public function test_getInfoforProjectResource_toT(){
    //clear project_purchase_order
    DB::table('t_project_resource')->truncate();
    //clear project;
    DB::table('t_project')->truncate();

    $project=$this->generate_project();    
    $pr = $this->generate_project_assign_toT($project['project_id']);
    //dump($pr);
    $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
    
    $val =$pro_builder->getInfoforProjectResource_toT($pr['project_resource_id']);
    $this->assertTrue(isset($val));
    DB::table('t_project_resource')->truncate();           
    DB::table('t_project')->truncate();
}

public function test_saveProjectResourceAssign(){
//clear project_resource
DB::table('project_resource')->truncate();
//clear project;
DB::table('project')->truncate();
$project=$this->generate_project();    

$project_resource_project_lead='0';
$project_resource_project_id=$project['project_id'];
$project_resource_resource_id='1';
$project_resource_project_client_manager_id='2';
$project_resource_role_id='9';//IT Support Staff
$project_resource_title='sample tite';
$project_resource_sales_beacon_rate='35';
$project_resource_client_rate='80';
$project_resource_hours='40';
$project_resource_require_schedule='0';
$project_resource_comment='sample comments';
$project_resource_active='1';
$project_resource_jobrole='';
$project_resource_is_bonus='0';

$pr=[
    'project_resource_project_lead' => $project_resource_project_lead,
    'project_resource_project_id' => $project_resource_project_id,
    'project_resource_resource_id' => $project_resource_resource_id,
    'project_resource_project_client_manager_id' => $project_resource_project_client_manager_id,
    'project_resource_role_id' => $project_resource_role_id,
    'project_resource_title' => $project_resource_title,
    'project_resource_sales_beacon_rate' => $project_resource_sales_beacon_rate,
    'project_resource_client_rate' => $project_resource_client_rate,
    'project_resource_hours' => $project_resource_hours,
    'project_resource_client_rate' => $project_resource_client_rate,
    'project_resource_require_schedule' => $project_resource_require_schedule,
    'project_resource_comment' => $project_resource_comment,
    'project_resource_active' => $project_resource_active,
    'project_resource_jobrole' => $project_resource_jobrole,
    'project_resource_is_bonus' => $project_resource_is_bonus,
];
$pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
$newpr=$pro_builder->saveProjectResourceAssign($pr);

$this->assertTrue(isset($newpr));
DB::table('project')->truncate();
DB::table('project_resource')->truncate();    

}

public function test_saveProjectResourceAssign_toT(){
//clear project_resource
DB::table('t_project_resource')->truncate();
//clear project;
DB::table('t_project')->truncate();
$project=$this->generate_project();    

$project_resource_project_lead='0';
$project_resource_project_id=$project['project_id'];
$project_resource_resource_id='1';
$project_resource_project_client_manager_id='2';
$project_resource_role_id='9';//IT Support Staff
$project_resource_title='sample tite';
$project_resource_sales_beacon_rate='35';
$project_resource_client_rate='80';
$project_resource_hours='40';
$project_resource_require_schedule='0';
$project_resource_comment='sample comments';
$project_resource_active='1';
$project_resource_jobrole='';
$project_resource_is_bonus='0';

$pr=[
    'project_resource_project_lead' => $project_resource_project_lead,
    'project_resource_project_id' => $project_resource_project_id,
    'project_resource_resource_id' => $project_resource_resource_id,
    'project_resource_project_client_manager_id' => $project_resource_project_client_manager_id,
    'project_resource_role_id' => $project_resource_role_id,
    'project_resource_title' => $project_resource_title,
    'project_resource_sales_beacon_rate' => $project_resource_sales_beacon_rate,
    'project_resource_client_rate' => $project_resource_client_rate,
    'project_resource_hours' => $project_resource_hours,
    'project_resource_client_rate' => $project_resource_client_rate,
    'project_resource_require_schedule' => $project_resource_require_schedule,
    'project_resource_comment' => $project_resource_comment,
    'project_resource_active' => $project_resource_active,
    'project_resource_jobrole' => $project_resource_jobrole,
    'project_resource_is_bonus' => $project_resource_is_bonus,
];
$pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
$newpr=$pro_builder->saveProjectResourceAssign_toT($pr);

$this->assertTrue(isset($newpr));
DB::table('t_project')->truncate();
DB::table('t_project_resource')->truncate();
}

public function test_saveProjectResourceEdit(){
//clear project_resource
DB::table('project_resource')->truncate();
//clear project;
DB::table('project')->truncate();
$project=$this->generate_project();    

$project_resource=$this->generate_project_assign($project['project_id']);
$project_resource_id=$project_resource['project_resource_id'];

$project_resource_project_lead='0';
$project_resource_project_id=$project['project_id'];
$project_resource_resource_id='1';
$project_resource_project_client_manager_id='2';
$project_resource_role_id='9';//IT Support Staff
$project_resource_title='sample tite';
$project_resource_sales_beacon_rate='35';
$project_resource_client_rate='80';
$project_resource_hours='40';
$project_resource_require_schedule='0';
$project_resource_comment='sample comments';
$project_resource_active='1';
$project_resource_is_bonus='0';

$pr=[
    'project_resource_id' => $project_resource_id,
    'project_resource_project_lead' => $project_resource_project_lead,
    'project_resource_title' => $project_resource_title,
    'project_resource_sales_beacon_rate' => $project_resource_sales_beacon_rate,
    'project_resource_client_rate' => $project_resource_client_rate,
    'project_resource_project_client_manager_id' => $project_resource_project_client_manager_id,
    'project_resource_comment' => $project_resource_comment,
    'project_resource_hours' => $project_resource_hours,
    'project_resource_active' => $project_resource_active,
    'project_resource_is_bonus' => $project_resource_is_bonus,
    'project_resource_require_schedule' => $project_resource_require_schedule,
    'project_resource_role_id' => $project_resource_role_id,
];
$pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
$newpr=$pro_builder->saveProjectResourceEdit($pr);

$this->assertTrue(isset($newpr));
DB::table('project')->truncate();
DB::table('project_resource')->truncate();      
}
public function test_saveProjectResourceEdit_toT(){
//clear project_resource
DB::table('project_resource')->truncate();
//clear project;
DB::table('project')->truncate();
$project=$this->generate_project();    

$project_resource=$this->generate_project_assign($project['project_id']);
$project_resource_id=$project_resource['project_resource_id'];
$project_resource_project_lead='0';
$project_resource_project_id=$project['project_id'];
$project_resource_resource_id='1';
$project_resource_project_client_manager_id='2';
$project_resource_role_id='9';//IT Support Staff
$project_resource_title='sample tite';
$project_resource_sales_beacon_rate='35';
$project_resource_client_rate='80';
$project_resource_hours='40';
$project_resource_require_schedule='0';
$project_resource_comment='sample comments';
$project_resource_active='1';
$project_resource_is_bonus='0';

$pr=[
    'project_resource_id' => $project_resource_id,
    'project_resource_project_lead' => $project_resource_project_lead,
    'project_resource_title' => $project_resource_title,
    'project_resource_sales_beacon_rate' => $project_resource_sales_beacon_rate,
    'project_resource_client_rate' => $project_resource_client_rate,
    'project_resource_project_client_manager_id' => $project_resource_project_client_manager_id,
    'project_resource_comment' => $project_resource_comment,
    'project_resource_hours' => $project_resource_hours,
    'project_resource_active' => $project_resource_active,
    'project_resource_is_bonus' => $project_resource_is_bonus,
    'project_resource_require_schedule' => $project_resource_require_schedule,
    'project_resource_role_id' => $project_resource_role_id,
];
$pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
$newpr=$pro_builder->saveProjectResourceEdit_toT($pr);

$this->assertTrue(isset($newpr));
DB::table('project')->truncate();
DB::table('project_resource')->truncate();  
}    
public function test_RenewProject(){
    //prepare project
    $project=$this->generate_internal_project();
    //prepare resource;
    $project_resource=$this->generate_project_assign($project['project_id']);
    //prepare pos
    $project_purcase_orders = $this->generate_project_purchase_order($project['project_id']);


    $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
    $newproject=$pro_builder->RenewProject($project['project_id']);
    $this->assertTrue(isset($newproject));
    dump($newproject);

    DB::table('project')->truncate();
    DB::table('project_internal')->truncate();
    DB::table('project_resource')->truncate();  
    DB::table('project_purchase_order')->truncate();  
    DB::table('t_project')->truncate();
    DB::table('t_project_internal')->truncate();
    DB::table('t_project_resource')->truncate();  
    DB::table('t_project_purchase_order')->truncate();  
}
*/
public function test_copy_resource_from_temporary(){
    //prepare project
    $project=$this->generate_internal_project();
    //prepare resource;
    $project_resource=$this->generate_project_assign($project['project_id']);
    //prepare pos
    $project_purcase_orders = $this->copy_resource_from_temporary($project['project_id']);


    $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
    $newproject=$pro_builder->RenewProject($project['project_id']);
    $this->assertTrue(isset($newproject));
    dump($newproject);

    DB::table('project')->truncate();
    DB::table('project_internal')->truncate();
    DB::table('project_resource')->truncate();  
    DB::table('project_purchase_order')->truncate();  

}
public function test_copy_po_from_temporary(){
    //prepare project
    $project=$this->generate_internal_project();
    //prepare resource;
    $project_resource=$this->generate_project_assign($project['project_id']);
    //prepare pos
    $project_purcase_orders = $this->copy_po_from_temporary($project['project_id']);


    $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
    $newproject=$pro_builder->RenewProject($project['project_id']);
    $this->assertTrue(isset($newproject));
    dump($newproject);

    DB::table('project')->truncate();
    DB::table('project_internal')->truncate();
    DB::table('project_resource')->truncate();  
    DB::table('project_purchase_order')->truncate();  

}
public function test_copy_project_from_temporary(){
//prepare project
$project=$this->generate_internal_project();
//prepare resource;
$project_resource=$this->generate_project_assign($project['project_id']);
//prepare pos
$project_purcase_orders = $this->copy_project_from_temporary($project['project_id']);


$pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
$newproject=$pro_builder->RenewProject($project['project_id']);
$this->assertTrue(isset($newproject));
dump($newproject);

DB::table('project')->truncate();
DB::table('project_internal')->truncate();
DB::table('project_resource')->truncate();  
DB::table('project_purchase_order')->truncate();  
}
public function test_copy_projectinternal_from_temporary(){
    //prepare project
    $project=$this->generate_internal_project();
    //prepare resource;
    $project_resource=$this->generate_project_assign($project['project_id']);
    //prepare pos
    $project_purcase_orders = $this->copy_projectinternal_from_temporary($project['project_id']);


    $pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
    $newproject=$pro_builder->RenewProject($project['project_id']);
    $this->assertTrue(isset($newproject));
    dump($newproject);

    DB::table('project')->truncate();
    DB::table('project_internal')->truncate();
    DB::table('project_resource')->truncate();  
    DB::table('project_purchase_order')->truncate();  
}
public function test_generateProjectNumber(){
//prepare project
$project=$this->generate_internal_project();
//prepare resource;
$project_resource=$this->generate_project_assign($project['project_id']);
//prepare pos
$project_purcase_orders = $this->generateProjectNumber();


$pro_builder = new \App\ModelBuilder\ProjectModelBuilder();
$newproject=$pro_builder->RenewProject($project['project_id']);
$this->assertTrue(isset($newproject));
dump($newproject);

DB::table('project')->truncate();
DB::table('project_internal')->truncate();
DB::table('project_resource')->truncate();  
DB::table('project_purchase_order')->truncate();  
}    

    /*
public function test_copy_projectinternal_from_temporary(){}    
public function test_copy_projectinternal_from_temporary(){}
public function test_RenewProject(){}
public function test_copy_resource_from_temporary(){}
public function test_copy_po_from_temporary(){}
public function test_copy_project_from_temporary(){}
public function test_copy_projectinternal_from_temporary(){}
public function test_copy_projectinternal_from_temporary(){}    
public function test_copy_projectinternal_from_temporary(){}
public function test_RenewProject(){}
public function test_copy_resource_from_temporary(){}
public function test_copy_po_from_temporary(){}
public function test_copy_project_from_temporary(){}
public function test_copy_projectinternal_from_temporary(){}
public function test_copy_projectinternal_from_temporary(){}    
public function test_copy_projectinternal_from_temporary(){}
public function test_RenewProject(){}
public function test_copy_resource_from_temporary(){}
public function test_copy_po_from_temporary(){}
public function test_copy_project_from_temporary(){}
public function test_copy_projectinternal_from_temporary(){}
public function test_copy_projectinternal_from_temporary(){}    
public function test_copy_projectinternal_from_temporary(){}
*/
}
