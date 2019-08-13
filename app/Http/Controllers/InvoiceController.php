<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //
    /* 
    old perl code decides route based on parameters' value and number; 
    
    generateinvoices, fromdate and todate have real value;
    generateinvoices, sage50;
    [1]logon, get method
    [2]check in userid and password
    [3] date by month/    date by from and to,
    [4]pick projects
    [5]pick users
    {given a date range, user type, then get all users matched given criteria}

    
    */
    public function checkLogin(){
        my $login = @{$q->{param}->{'ttid'}}[0];
        my $pw = @{$q->{param}->{'ttpassword'}}[0];
        my ($hashedpw,$hashedpw2);
        my $dbstoredpw;
        my $rank; #if superuser then rank = 4; else rank = 1
        my $rdurl = "atin.cgi";
            
        my $statement="SELECT PASSWORD('$pw')pswd,old_password('$pw')oldpswd";
        my $sth = $dbh->prepare($statement) or die $DBI::errstr;

        $sth->execute();
                

    
        while ( my @row = $sth->fetchrow_array ) 
                {
                    $hashedpw = @row[0]; #here is the hashed pw that was inserted
                    $hashedpw2 = @row[1];
                } 
        #get the password in the database
        my $statement2="SELECT user_code, user_rank FROM users where user_username='$login'";
        my $sth2 = $dbh->prepare($statement2);
        $sth2->execute();
        
        while ( my @row2 = $sth2->fetchrow_array ) 
                {
                    $dbstoredpw = @row2[0]; #here is the hashed pw
                    $rank = @row2[1]; #here is the person's rank
                } 
            

        if ((($dbstoredpw eq $hashedpw) || ($dbstoredpw eq $hashedpw2)) && ($rank eq "4")) #only let them in if they are superadmin
            {
                $q->{param}->{loginattempt => 0};
                #&personInformation($login);
                &personInformation();
            }
            
        else 
            {
                print "Wrong Login or Password, Redirecting to login page";
                print "<html><head><meta http-equiv='refresh' content='1;URL=http://autoinvoice.mdina.ca'></head></html>";
            }
    }
    public function generateInvoices(){
        $q->{param}->{contractorlist => 0}; #reset the POST for generation of invoices
		my $people = $q->{param}->{'check_list'};
		my $date_selection = $q->{param}->{'date_selection'};
		my $date_selection_var = @{$date_selection}[0];
		my $type_of_report = shift; #0 if generate invoices; 1 if sage50; 2 if payment summary
		my $date_selection_var = shift;
		my $s_date = shift; #used if start date is passed
		my $e_date = shift; #used if end date is passed
		my $notaninvoice = shift; #used if this is a range
		#print STDERR "\n GENERATE INVOICES s_date = $s_date";
		#print STDERR "\n GENERATE INVOICES e_date = $e_date";
		my $first_name;
		my $last_name;
		my $address;
		my $city;
		my $province;
		my $postal_code;
		my $tax_number;
		my $tax_rate;
		my $other_tax_number;
		my $other_tax_rate;
		my $country;
		my $billing_name;
		my $email_address;
		my $email_options; #used to specify who to email the invoice to.
		my $health_plan_opt_in;
		my $health_plan_deduction = 0;
		my $rrsp_opt_in;
		my $rrsp_deduction = 0;
		my $currency;
		my $typeofperson;
		my $billaddress;
		my $number_of_invoices = @{$people};
		
		foreach my $user_id (@{$people})
			{
				$invoice_iterator++;
				$email_options = @{$q->{param}->{$user_id}}[0]; #grab the email options
				my $statement="SELECT user_name, user_lastname, user_street, user_city, user_prov, user_zip, user_tax, user_tax_number, user_tax_other, user_tax_other_number, user_country, 
				user_billing_name, user_email, user_health_plan_opt_in, user_health_plan_deduction, user_rrsp_opt_in, user_rrsp_deduction, user_currency, user_typeofperson,res.bill_address 
                FROM users u inner join resource_employment_status res on res.resource_employment_status_id = u.user_resource_status_id where user_id='$user_id'";
				my $sth = $dbh->prepare($statement);
				$sth->execute();
				
				while ( my @row = $sth->fetchrow_array ) 
					{
						$first_name = @row[0]; #firstname
						$last_name = @row[1]; #lastname
						$address = @row[2]; #street
						$city = @row[3]; #city
						$province = @row[4]; #province
						$postal_code = @row[5]; #postal/zip
						$tax_rate = @row[6]; #tax rate
						$tax_number = @row[7]; #tax number
						$other_tax_rate = @row[8]; #other tax rate
						$other_tax_number = @row[9]; #other tax number
						$country = @row[10]; #country
						$billing_name = @row[11]; #billing name
						$email_address = @row[12]; #email address
						$health_plan_opt_in = @row[13]; #are they in a health plan?
						$health_plan_deduction = @row[14]; #what should be deducted for health
						$rrsp_opt_in = @row[15]; #are they participating in RRSP deduction?
						$rrsp_deduction = @row[16]; #what should be deducted for RRSP?
						$currency = @row[17]; #what is the user's currency
						$typeofperson = @row[18]; #Are they an employee, lump-sum, hourly employee or contractor (default)
						$billaddress = @row[19]; #bill address
					} 
					
				my $personhasharrays; 
				if ($date_selection_var ne '')
					{
						$personhasharrays = &getProjects($user_id, $date_selection_var);
					}
					
				elsif (($s_date ne '') && ($e_date ne ''))
					{
						$personhasharrays = &getProjectsSelected($user_id, $s_date, $e_date);
					}
				
				#print STDERR "\nProjects: $date_selection_var";
				#print STDERR Dumper ($personhasharrays);
				&generateInvoiceHTMLForEmail($user_id, $first_name, $last_name, $address, $city, $province, $postal_code, $country, 
				$tax_rate, $tax_number, $other_tax_rate, $other_tax_number, $personhasharrays, $billing_name, $email_address, $email_options,
				$date_selection_var, $health_plan_opt_in, $health_plan_deduction, $rrsp_opt_in, $rrsp_deduction, $currency, $notaninvoice,
				$s_date, $e_date, $type_of_report, $number_of_invoices, $typeofperson,$billaddress);
			}

    }
}

public function getProjectsSelected() #get projects for people that they worked on in the date range
	{
		#print STDERR "\ngetProjectsSelected";
		my $user_id = shift;
		my $s_date = shift;
		my $e_date = shift;
		#my $month_selected = shift;
		#clear the arrays for a new person	
		@personprojects = (); #previous month
		@personjobids = (); #previous month job_ids worked on
		@projecthours = (); #previous month
		@projecttitles = (); #previous month
		@projectcode = (); #previous month
		@projectcost = (); #previous month
		@projecttype = ();#previous month
                                    @practicearea = (); #previous month
		my @projectcontainer = (); #used to hold all hashes of project information
		
		my $counter = 0;
		my $invoice_total = 0;
		my $begdate = $s_date;
		#print STDERR "\nMonth selected: $begdate";
		my @newdate1 = split("-",$begdate); #yyyy-mm-dd
		my $year = @newdate1[0];
		my $month = @newdate1[1];
		my $enddate = $e_date;
		
				my $statement="SELECT 
        SUM(te.entry_hours)projecthours, p.project_title , p.project_number , 
        pr.project_resource_sales_beacon_rate cost,ifnull(pp.practice_area_name,' ') practice_area_name,
        p.project_renewal,p.project_type 
        FROM time_entry te
        INNER JOIN project_resource pr on te.entry_project_resource_id=pr.project_resource_id
        INNER JOIN project p ON p.project_id=pr.project_resource_project_id
        INNER JOIN users u on u.user_id = pr.project_resource_resource_id
        LEFT JOIN practice_area pp on pp.practice_area_id=p.project_practice_area_id 
        WHERE u.user_id=$user_id and entry_date >= '$begdate' and entry_date <= '$enddate' and te.entry_deleted=0
        group by p.project_number, p.project_renewal,te.entry_project_resource_id";
        
        #print STDERR "\nThe job statement is: $statement";
        #print "\nThe job statement is: $statement";
		my $sth = $dbh->prepare($statement);
		$sth->execute();
		while (my @row2 = $sth->fetchrow_array) #add job_ids to array
			{
				
					push(@projecthours, @row2[0]);
					push(@projecttitles, @row2[1]);
					push(@projectcode, @row2[2].'.'.sprintf("%02d",@row2[5]));
					push(@projectcost, @row2[3]);
					push(@practicearea, @row2[4]);
					push(@projecttype, @row2[6]); 
				
		
			}
			#return a hash containing all of the arrays for the invoicer
			my %personhash = (
				'projectcode' => \@projectcode,
				'projecttitle' => \@projecttitles,
				'projecthours' => \@projecthours,					
				'projectcost' => \@projectcost,	
                'practicearea' => \@practicearea,
                'projecttype' => \@projecttype
				);

		$dbh->disconnect;
		
		return \%personhash;
	}