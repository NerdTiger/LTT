<?php

namespace Tests;

class GenerateMetaData 
{

    public static function generate_companies(){
        //prepare role data;
        $role_name = 'Sales Beacon Canada';
        $role_id = factory(\App\Models\SalesBeaconCompany::class)->create(
            ['sales_beacon_company' => $role_name]);
        $role_name = 'Sales Beacon USA';
        $role_id = factory(\App\Models\SalesBeaconCompany::class)->create(
            ['sales_beacon_company' => $role_name]);
    }
    public static function generate_currencies(){
        //prepare currency data;
        $role_name = 'CAD';
        $role_id = factory(\App\Models\Currency::class)->create(
            ['currency_type' => $role_name]);
        $role_name = 'USD';
        $role_id = factory(\App\Models\Currency::class)->create(
            ['currency_type' => $role_name]);
    }
    public static function generate_resource_employment_status(){
        //status, working, verified: 2019-07-29 15:07
        //prepare role data;
        $resource_status = 'US Corp To Corp';
        $auto_invoice = true;
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon <br />
        4730 S. Fort Apache Rd., Suite 300<br />
        Las Vegas, NV. <br />
        89147-7947<br />';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);
            
        $resource_status = 'F/T Hourly Employee';
        $auto_invoice = '0';
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon Consulting Inc. <br />
        121 Duke Street. <br />
        Chester, Nova Scotia. <br />
        B0J 1J0<br />
        <b>Email: <A HREF="mailto:ttinvoicing@salesbeacon.com">ttinvoicing@salesbeacon.com</A>';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);

        $resource_status = 'P/T Hourly Employee';
        $auto_invoice = '0';
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon Consulting Inc. <br />
        121 Duke Street. <br />
        Chester, Nova Scotia. <br />
        B0J 1J0<br />
        <b>Email: <A HREF="mailto:ttinvoicing@salesbeacon.com">ttinvoicing@salesbeacon.com</A>';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);

        $resource_status = 'Salary Employee';
        $auto_invoice = '0';
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon Consulting Inc. <br />
        121 Duke Street. <br />
        Chester, Nova Scotia. <br />
        B0J 1J0<br />
        <b>Email: <A HREF="mailto:ttinvoicing@salesbeacon.com">ttinvoicing@salesbeacon.com</A>';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);

        $resource_status = 'US Salary Employee';
        $auto_invoice = '0';
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon <br />
        4730 S. Fort Apache Rd., Suite 300<br />
        Las Vegas, NV. <br />
        89147-7947<br />';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);

        $resource_status = 'Salary + Employee';
        $auto_invoice = '0';
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon Consulting Inc. <br />
        121 Duke Street. <br />
        Chester, Nova Scotia. <br />
        B0J 1J0<br />
        <b>Email: <A HREF="mailto:ttinvoicing@salesbeacon.com">ttinvoicing@salesbeacon.com</A>';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);

        $resource_status = 'US Salary+ Employee';
        $auto_invoice = '0';
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon <br />
        4730 S. Fort Apache Rd., Suite 300<br />
        Las Vegas, NV. <br />
        89147-7947<br />';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);
        $resource_status = 'US F/T Hourly Employee';
        $auto_invoice = '0';
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon <br />
        4730 S. Fort Apache Rd., Suite 300<br />
        Las Vegas, NV. <br />
        89147-7947<br />';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);           

        $resource_status = 'US P/T Hourly Employee';
        $auto_invoice = '0';
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon <br />
        4730 S. Fort Apache Rd., Suite 300<br />
        Las Vegas, NV. <br />
        89147-7947<br />';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);          
        $resource_status = 'Contractor';
        $auto_invoice = '1';
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon Consulting Inc. <br />
        121 Duke Street. <br />
        Chester, Nova Scotia. <br />
        B0J 1J0<br />
        <b>Email: <A HREF="mailto:ttinvoicing@salesbeacon.com">ttinvoicing@salesbeacon.com</A>';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);          
        $resource_status = 'US Contractor';
        $auto_invoice = '1';
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon <br />
        4730 S. Fort Apache Rd., Suite 300<br />
        Las Vegas, NV. <br />
        89147-7947<br />';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);          

        $resource_status = 'Freelance';
        $auto_invoice = '0';
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon Consulting In...';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);          
        $resource_status = 'US Freelance';
        $auto_invoice = '0';
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon <br />
        4730 S. Fort Apache Rd., Suite 300<br />
        Las Vegas, NV. <br />
        89147-7947<br />';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);          
        $resource_status = 'Consultant';
        $auto_invoice = '0';
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon Consulting Inc. <br />
        121 Duke Street. <br />
        Chester, Nova Scotia. <br />
        B0J 1J0<br />
        <b>Email: <A HREF="mailto:ttinvoicing@salesbeacon.com">ttinvoicing@salesbeacon.com</A>';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);          
        $resource_status = 'US Consultant';
        $auto_invoice = '0';
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon <br />
        4730 S. Fort Apache Rd., Suite 300<br />
        Las Vegas, NV. <br />
        89147-7947<br />';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);          
        $resource_status = 'Corp To Corp';
        $auto_invoice = '0';
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon Consulting Inc. <br />
        121 Duke Street. <br />
        Chester, Nova Scotia. <br />
        B0J 1J0<br />
        <b>Email: <A HREF="mailto:ttinvoicing@salesbeacon.com">ttinvoicing@salesbeacon.com</A>';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);          
        $resource_status = 'Temp Hourly Employee';
        $auto_invoice = '0';
        $bill_address = '
        <b>BILL TO:</b>
        <br />
        Sales Beacon Consulting Inc. <br />
        121 Duke Street. <br />
        Chester, Nova Scotia. <br />
        B0J 1J0<br />
        <b>Email: <A HREF="mailto:ttinvoicing@salesbeacon.com">ttinvoicing@salesbeacon.com</A>';
        $role_id = factory(\App\Models\ResourceEmploymentStatus::class)->create(
            [
                'resource_status' => $resource_status,
                'auto_invoice' => $auto_invoice,
                'bill_address' => $bill_address
            ]);                                                                                                                                                            
    }
    public static function generate_user(){
        //status working, verified 2019-07-29 15:16
        //prepare user data;
        $user_name='Zhijun';
        $user_lastname='Zhang';
        $user_active='1';
        $user_username='zzhang';
        $user_cost='25';
        $src_employee_id='101';
        $lastupdate='2019-07-29 09:43:23';
        $user_resource_status_id='4';//Salary Employee
        $user_role_id='1';
        $paytype='employee';
        $client_manager_id='2';

        $projectstatus_test = factory(\App\Models\User1::class)->create(
            [
                'user_name' => $user_name,
                'user_lastname' => $user_lastname,
                'user_active' => $user_active,
                'user_username' => $user_username,
                'user_cost' => $user_cost,
                'src_employee_id' => $src_employee_id,
                'lastupdate' => $lastupdate,
                'user_resource_status_id' => $user_resource_status_id,
                'user_role_id' => $user_role_id,
                'paytype' => $paytype,
                'client_manager_id' => $client_manager_id    
            ]);

        $user_name='Vern';
        $user_lastname='Kennedy';
        $user_active='1';
        $user_username='vkennedy';
        $user_cost='45';
        $src_employee_id='100';
        $lastupdate='2019-07-29 09:43:23';
        $user_resource_status_id='14';//Consultant
        $user_role_id='4';
        $paytype='employee';
        $client_manager_id='0';
        
        $projectstatus_test = factory(\App\Models\User1::class)->create(
            [
                'user_name' => $user_name,
                'user_lastname' => $user_lastname,
                'user_active' => $user_active,
                'user_username' => $user_username,
                'user_cost' => $user_cost,
                'src_employee_id' => $src_employee_id,
                'lastupdate' => $lastupdate,
                'user_resource_status_id' => $user_resource_status_id,
                'user_role_id' => $user_role_id,
                'paytype' => $paytype,
                'client_manager_id' => $client_manager_id    
            ]);
    }
    public static function generate_purchase_order_type(){
        //prepare role data;
        $role_name = 'Travel';
        $role_id = factory(\App\Models\PurchaseOrderType::class)->create(
            ['sales_beacon_company' => $role_name]);
        $role_name = 'Bonus';
        $role_id = factory(\App\Models\PurchaseOrderType::class)->create(
            ['sales_beacon_company' => $role_name]);        
        $role_name = 'Project';
        $role_id = factory(\App\Models\PurchaseOrderType::class)->create(
            ['sales_beacon_company' => $role_name]);        
        $role_name = 'Expenses';
        $role_id = factory(\App\Models\PurchaseOrderType::class)->create(
            ['sales_beacon_company' => $role_name]);        
    }
    public static function generate_user_diversity(){
        //prepare user diversity data;
        $diversity = 'Woman';
        $user_type_id = factory(\App\Models\UserDiversity::class)->create(
            [
                'diversity' => $diversity            
            ]);
        $diversity = 'Non-White';
        $user_type_id = factory(\App\Models\UserDiversity::class)->create(
            [
                'diversity' => $diversity            
            ]);
        $diversity = 'Aboriginal';
        $user_type_id = factory(\App\Models\UserDiversity::class)->create(
            [
                'diversity' => $diversity            
            ]);
        $diversity = 'LGBT';
        $user_type_id = factory(\App\Models\UserDiversity::class)->create(
            [
                'diversity' => $diversity            
            ]);

    }
    public static function generate_user_type(){
        //prepare project status data;
        $user_type_name = 'User';
        $user_entrymodel = 'project';
        $user_entrymethod = 'index';
        $user_type_id = factory(\App\Models\UserType::class)->create(
            [
                'user_type_name' => $user_type_name,
                'user_entrymodel' => $user_entrymodel,
                'user_entrymethod' => $user_entrymethod
            
            ]);


        $user_type_name = 'Client Manager';
        $user_entrymodel = 'project';
        $user_entrymethod = 'index';
        $user_type_id = factory(\App\Models\UserType::class)->create(
            [
                'user_type_name' => $user_type_name,
                'user_entrymodel' => $user_entrymodel,
                'user_entrymethod' => $user_entrymethod
            
            ]);

        $user_type_name = 'Contract Manager';
        $user_entrymodel = 'project';
        $user_entrymethod = 'index';
        $user_type_id = factory(\App\Models\UserType::class)->create(
            [
                'user_type_name' => $user_type_name,
                'user_entrymodel' => $user_entrymodel,
                'user_entrymethod' => $user_entrymethod
            
            ]);

        $user_type_name = 'Management';
        $user_entrymodel = 'project';
        $user_entrymethod = 'index';
        $user_type_id = factory(\App\Models\UserType::class)->create(
            [
                'user_type_name' => $user_type_name,
                'user_entrymodel' => $user_entrymodel,
                'user_entrymethod' => $user_entrymethod
            
            ]);

        $user_type_name = 'TT Admin';
        $user_entrymodel = 'project';
        $user_entrymethod = 'index';
        $user_type_id = factory(\App\Models\UserType::class)->create(
            [
                'user_type_name' => $user_type_name,
                'user_entrymodel' => $user_entrymodel,
                'user_entrymethod' => $user_entrymethod
            
            ]);

        $user_type_name = 'IT Admin';
        $user_entrymodel = 'project';
        $user_entrymethod = 'index';
        $user_type_id = factory(\App\Models\UserType::class)->create(
            [
                'user_type_name' => $user_type_name,
                'user_entrymodel' => $user_entrymodel,
                'user_entrymethod' => $user_entrymethod
            
            ]);
    }
    public static function generate_project_status(){

        //prepare project status data;
        $project_status1 = 'Open';
        $project_status2 = 'On Hold';
        $project_status3 = 'Closed';
        $projectstatus_test = factory(\App\Models\ProjectStatus::class)->create(
            ['project_status' => $project_status1]);
        $projectstatus_test = factory(\App\Models\ProjectStatus::class)->create(
            ['project_status' => $project_status2]);
        $projectstatus_test = factory(\App\Models\ProjectStatus::class)->create(
            ['project_status' => $project_status3]);
    }
    public static function generate_role(){
        //prepare role data;
        $role_name = 'Administrative Staff';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'Business Analyst';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'Channel Consultant';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'Consultant - Specialized';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'Creative Services Consultant';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'Director';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'Executive';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'Graphic Designer';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'IT Support Staff';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'Junior Manager';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'Manager';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'Program Manager';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'Project Coordinator';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'Project Manager';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'Recruiter';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'Sales PaaS Program Manager';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'Sales PaaS Project Coordinator';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);
        $role_name = 'Sales PaaS Project Manager';
        $role_id = factory(\App\Models\Role::class)->create(
            ['role_name' => $role_name]);

    }
    public static function generate_locations(){
        //prepare project status data;
        $location_abbr = 'AB';
        $location_name = 'Alberta';
        $user_type_id = factory(\App\Models\Location::class)->create(
            [
                'location_abbr' => $location_abbr,
                'location_name' => $location_name,
            ]);


        
    }
    public static function generate_projectpayees(){
        //prepare project status data;
        $project_payee_active = '1';
        $project_payee_name = 'test Payee1';
        factory(\App\Models\ProjectPayee::class)->create(
            [
                'project_payee_active' => $project_payee_active,
                'project_payee_name' => $project_payee_name,
            ]);

        $project_payee_active = '1';
        $project_payee_name = 'test Payee2';
         factory(\App\Models\ProjectPayee::class)->create(
            [
                'project_payee_active' => $project_payee_active,
                'project_payee_name' => $project_payee_name,
            ]);
    }
    public static function generate_projectcompanies(){
        //prepare project status data;
        $project_company_active = '1';
        $project_company_name = 'test company 1';
        factory(\App\Models\ProjectCompany::class)->create(
            [
                'project_company_active' => $project_company_active,
                'project_company_name' => $project_company_name,
            ]);

            $project_company_active = '1';
            $project_company_name = 'test company 2';
            factory(\App\Models\ProjectCompany::class)->create(
                [
                    'project_company_active' => $project_company_active,
                    'project_company_name' => $project_company_name,
                ]);
    }    
    public static function generate_internal_project_types(){
        //prepare project status data;
        $internal_project_type_name = 'Bench Project';
        factory(\App\Models\InternalProjectType::class)->create(
            [
                'internal_project_type_name' => $internal_project_type_name,
            ]);
        $internal_project_type_name = 'Community Project';
        factory(\App\Models\InternalProjectType::class)->create(
            [
                'internal_project_type_name' => $internal_project_type_name,
            ]);
    }
    public static function generate_departments(){
        //prepare project status data;
        $department_code = '8600';
        $department_name = 'Executive';
        factory(\App\Models\Department::class)->create(
            [
                'department_code' => $department_code,
                'department_name' => $department_name,
            ]);
        $department_code = '8650';
        $department_name = 'Finance';
        factory(\App\Models\Department::class)->create(
            [
                'department_code' => $department_code,
                'department_name' => $department_name,
            ]);
    }

}