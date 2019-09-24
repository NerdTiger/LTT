<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\ModelBuilder;
use Tests\GenerateMetaData;

use Illuminate\Support\Facades\DB;


class EntryModelTest extends TestCase
{
    private function preparedate_getRemaininghoursforProjectResourceAssignment(){
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

        $testdata_project = factory(\App\Models\Project::class)->create([
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
        $project_resource_project_id=$testdata_project['project_id'];
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

        $test_data_project_resource = factory(\App\Models\ProjectResource::class)->create(    
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
        $entry_project_resource_id=$test_data_project_resource['project_resource_id'];
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

            $entry_date='2019-07-30';
            $entry_hours=null;
            
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
            $entry_date='2019-07-31';
            $entry_hours='6';
            
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

        return $entry_project_resource_id;
    }
    private function prepredata_getEntriesbyPRid(){
        return $this->preparedate_getRemaininghoursforProjectResourceAssignment();
    }
    public function preparedata_getEntriesbyUserid(){
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

        $testdata_project = factory(\App\Models\Project::class)->create([
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
        $project_resource_project_id=$testdata_project['project_id'];
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

        $test_data_project_resource = factory(\App\Models\ProjectResource::class)->create(    
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
        $entry_project_resource_id=$test_data_project_resource['project_resource_id'];
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

            $entry_date='2019-07-30';
            $entry_hours=null;
            
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
            $entry_date='2019-07-31';
            $entry_hours='6';
            
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

        return $project_resource_resource_id;
    }    
    /*
    public function test_getRemaininghoursforProjectResourceAssignment(){
        DB::table('time_entry')->truncate();  
        DB::table('project_resource')->truncate();  
        DB::table('project')->truncate();
        $project_resource_id=0;
        $pr_id=$this->preparedate_getRemaininghoursforProjectResourceAssignment();
        dump($pr_id);
        $pro_builder = new \App\ModelBuilder\EntryModelBuilder();
        $val=$pro_builder->getRemaininghoursforProjectResourceAssignment($pr_id);
        //dump($val);
        $this->assertTrue($val==32);
        DB::table('time_entry')->truncate();  
        DB::table('project_resource')->truncate();  
        DB::table('project')->truncate();
    }    
    
    public function test_getEntriesbyPRid(){
        DB::table('time_entry')->truncate();  
        DB::table('project_resource')->truncate();  
        DB::table('project')->truncate();
        $project_resource_id=0;
        $pr_id=$this->prepredata_getEntriesbyPRid();
        dump($pr_id);
        $pro_builder = new \App\ModelBuilder\EntryModelBuilder();
        $val=$pro_builder->getEntriesbyPRid($pr_id);
        //dump($val);
        $this->assertTrue(count($val)==3);
        DB::table('time_entry')->truncate();  
        DB::table('project_resource')->truncate();  
        DB::table('project')->truncate();
    }
    */
    
    
    public function test_getEntriesbyUserid(){
        DB::table('time_entry')->truncate();  
        DB::table('project_resource')->truncate();  
        DB::table('project')->truncate();
        $project_resource_id=0;
        $user_id=$this->prepredata_getEntriesbyUserid();
        dump($pr_id);
        $pro_builder = new \App\ModelBuilder\EntryModelBuilder();
        $val=$pro_builder->getEntriesbyUserid($user_id);
        //dump($val);
        $this->assertTrue(count($val)==3);
        DB::table('time_entry')->truncate();  
        DB::table('project_resource')->truncate();  
        DB::table('project')->truncate();
    }

}