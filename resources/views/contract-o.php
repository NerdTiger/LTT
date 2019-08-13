printContractorSelectionSpecifc() #used for a range of dates if passed
	{
		$q->{param}->{loginattempt => 0};
		my $people = shift;
		my $date_selection_default; #default date if the var below is not given
		my $date_selection_var = shift; #has a date been passed?
		my $s_date = '';
		my $e_date = '';
		#grab the date if passed
		if ($date_selection_var == 1)
			{
				$s_date = shift;
				$e_date = shift;
			}
		else
			{
				$s_date = '';
				$e_date = '';
			}


							
		
	#print STDERR Dumper($people);
		my $f_name;
		my $l_name;
		my ($user_id,$user_type);
		my $select_usertype;
		print "\n<html>";
		print "\n<head>";
		print "<link href=\"https://timetracker.salesbeacon.com/css/mdina-worx.css\" rel=\"stylesheet\" type=\"text/css\" />";
		print <<EOF1;
		<SCRIPT LANGUAGE="JavaScript">
		function checkAllProjects() //checks & unchecks elements in a DIV: contractorlist
			{
				var collection = document.getElementById('contractorlist').getElementsByTagName('input');
				//alert(collection.length);
				for (var x=0; x<collection.length; x++) 
					{
						if (collection[x].type.toUpperCase()=='CHECKBOX')
							{
								if (collection[x].checked == true)//if it is checked, uncheck-it
									{
										collection[x].checked = false;
										//document.contractor.Check_All.value="Check All";
										document.getElementById('Check_All').value="Check All";
									}
									
								else //if it is not checked, check it
									{
										collection[x].checked = true;
										//document.contractor.Check_All.value="UnCheck All";
										document.getElementById('Check_All').value="Uncheck All";
									}
							}
					}
			}	

		</script>
EOF1

		print "\n</head>";
		print "\n<title>Sales Beacon Resource Invoice Verification Login</title>";
		print "\n<body>";
		print "\n<script src=\"https://timetracker.salesbeacon.com/java/date_picker.js\" language=\"javascript\"></script>";
		print "\n<img src='https://timetracker.salesbeacon.com/images/mdina_logo_time_tracking.jpg'>";
		print "\n<br>";
		
				
		
		if (($s_date eq '') || ($e_date eq '')) #if either start date or end date are blank just show the regular screen
			{
				&personInformation();
=pod
				print "\n<form action='/cgibin/temp/atin.cgi' method='post' name='month' id='month'>";
				print "\n<b><a href='#' id='showrangetext' name='showrangetext' onClick='document.getElementById(\"showrangetext\").style.display=\"none\"; document.getElementById(\"monthrange\").style.display=\"none\"; document.getElementById(\"showrange\").style.display=\"block\"'>Click here to generate an interm report</a></b><br />";
				print "\n<div id='showrange' name='showrange' style='display:none'>";
				print "\n<b><a href='#' id='showmonthtext' name='showmonthtext' onClick='document.getElementById(\"showrange\").style.display=\"none\"; document.getElementById(\"monthrange\").style.display=\"block\"; document.getElementById(\"showrangetext\").style.display=\"block\"'>Click here to generate an monthly report</a></b><br />";
				print "\n<b><p>From:</b> <input type=\"text\" onclick=\"displayDatePicker('FromDate');\" value=\"Start Date\" maxlength=\"12\" size=\"10\" name=\"FromDate\"> 
					<b>To:</b> <input type=\"text\" onclick=\"displayDatePicker('ToDate');\" value=\"End Date\" maxlength=\"12\" size=\"10\" name=\"ToDate\"></p>";
				print "\n</div>";
				print "\n</form>";
=cut
			}
			
		else #e_date and #s_date had a value passed
			{
			

				
				print "\n<form action='atin.cgi' method='post' name='month' id='month'>";
				
				
				#print "\n<b><a href='#' id='showrangetext' name='showrangetext' onClick='document.getElementById(\"showrangetext\").style.display=\"none\"; document.getElementById(\"monthrange\").style.display=\"none\"; document.getElementById(\"showrange\").style.display=\"block\"'>Click here to generate an interm report</a></b><br />";
				print "\n<h3><b>Range Report for $s_date to $e_date</b></h3>";
				
				
				

				print "\n<div id='showrange' name='showrange' style='display:none'>";
				print "\n<b><a href='#' id='showmonthtext' name='showmonthtext' onClick='document.getElementById(\"showrange\").style.display=\"none\"; document.getElementById(\"monthrange\").style.display=\"block\"; document.getElementById(\"showrangetext\").style.display=\"block\"'>Click here to generate a Monthly Report</a></b><br />";
				print "\n<b><p>From:</b> <input type=\"text\" onclick=\"displayDatePicker('FromDate');\" value=\"Start Date\" maxlength=\"12\" size=\"10\" name=\"FromDate\"> 
					<b>To:</b> <input type=\"text\" onclick=\"displayDatePicker('ToDate');\" value=\"End Date\" maxlength=\"12\" size=\"10\" name=\"ToDate\"></p>";
				print "\n</div>";

				print "\n</form>";
			}	
		
		print "\n<div name='contractorlist' id='contractorlist'>";
		print "\n<form action='atin.cgi' method='post' name='contractor' id='contractor'>";
		#print "\n<form action='/cgibin/temp/atin.cgi' method='post' name='contractor' id='contractor'>";
		
		print "\n<table>";	

		foreach my $user_username (@{$people})
			{
			

				my $statement="SELECT user_name, user_lastname, user_id,res.resource_status FROM users u
				INNER JOIN resource_employment_status res on u.`user_resource_status_id`=res.`resource_employment_status_id`
				where user_username='$user_username'";
				my $sth = $dbh->prepare($statement);
				$sth->execute();
				
				while (my @row = $sth->fetchrow_array) 
						{
							$f_name = @row[0];
							$l_name = @row[1];
							$user_id = @row[2];
							$user_type = @row[3];
						} 
				$dbh->disconnect();
				print "\n<tr>";
				print "\n<td>";
				print "\n<input type='checkbox' name='check_list' id='$user_id' value='$user_id'>$f_name $l_name </input>";	
				print "\n</td><td>$user_type</td>";
				print "\n<td>";
				print "\n<select name='$user_id'>";
					print "\n<option value='mdinacontractor'>Generate Invoice Mail to Sales Beacon/Contractor</option>";
					print "\n<option value='contractor'>Generate Invoice Mail to Contractor Only</option>";
					print "\n<option value='mdina'>Generate Invoice Mail to Sales Beacon Only</option>";
				print "\n</select>";
				print "\n</td>";
				print "\n</tr>";
			}
		
		print "\n</table>";
		print "\n<br><input type='button' id='Check_All' value='Check All' name='Check_All' onclick='checkAllProjects()'>";
		print "\n<input type='hidden' name='generateinvoices' value='1'>";
=pod
		#pass the date selection variable if present
		if ($date_selection eq "")
			{
				$date_selection_default = &getMonths('1');
				print "\n<input type='hidden' name='date_selection' value='$date_selection_default'>";
			}
		else
			{
				print "\n<input type='hidden' name='date_selection' value='$date_selection'>";
			}
=cut
		print "\n<br /><br /><b>What would you like to do?
				<select name=Sage50_export>
					<option value='0'>Email Invoices</option>
					<option value='1' disabled>Generate Sage50 Import (Unavailable Option For Date Range)</option>
					<option value='2'>Generate Payment Summary</option>
				</select>";
		print "\n<input type='hidden' name='FromDate' value='$s_date'><input type='hidden' name='ToDate' value='$e_date'><input type='hidden' name='notaninvoice' value='1'>";
		print "\n<br /><input type='submit' value='Generate'>";
		print "\n</form>";
		print "\n</div>";
		print "\n</body>";
		print "\n</html>"; 
	}