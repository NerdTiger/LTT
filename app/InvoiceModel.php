<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceModel extends Model
{
    public function getProjects() #get projects for people that they worked on in the month
	{
		my $user_id = shift;
		my $month_selected = shift;
		#clear the arrays for a new person	
		@personprojects = (); #previous month
		@personjobids = (); #previous month job_ids worked on
		@projecthours = (); #previous month
		@projecttitles = (); #previous month
        @practicearea = (); #previous month
		@projectcode = (); #previous month
		@projectcost = (); #previous month
		@projecttype = ();#previous month
		my @projectcontainer = (); #used to hold all hashes of project information
		
		my $counter = 0;
		my $invoice_total = 0;
		my $begdate = $month_selected;
		#print STDERR "\nMonth selected: $begdate";
		my @newdate1 = split("-",$begdate); #yyyy-mm-dd
		my $year = @newdate1[0];
		my $month = @newdate1[1];
		my $enddate = "$year" . "-" . "$month" . "-" . "31";
		
		my $statement="SELECT 
        SUM(te.entry_hours)projecthours, p.project_title , p.project_number , 
        pr.project_resource_sales_beacon_rate cost,ifnull(pp.practice_area_name,' ') practice_area_name,
        p.project_renewal,p.project_type
        FROM time_entry te
        INNER JOIN project_resource pr on te.entry_project_resource_id=pr.project_resource_id
        INNER JOIN project p ON p.project_id=pr.project_resource_project_id
        INNER JOIN users u on u.user_id = pr.project_resource_resource_id
        LEFT JOIN practice_area pp on pp.practice_area_id=p.project_practice_area_id
        WHERE u.user_id=$user_id and entry_date >= '$begdate' and entry_date <= '$enddate' and entry_deleted=0
        group by p.project_number, p.project_renewal,te.entry_project_resource_id";
        
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
}
