printContractorSelection() #this is for specific months but also the first list that will appear when a person logs in. After they select date range, will it go to the "Specific" function of the same name
	{
		$q->{param}->{loginattempt => 0};
		my $people = shift;
		my $date_selection_default; #default date if the var below is not given
		my $date_selection_var = shift;
		my $date_selection;
		#grab the date if passed
		if ($date_selection_var == 1)
			{
				$date_selection = shift;
			}
		else
			{
				$date_selection = '';
			}

		#print STDERR Dumper($people);
		my $f_name;
		my $l_name;
		my ($user_id,$u_type);
		
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
		
		print "\n<form action='atin.cgi' method='post' name='month' id='month'>";
		if (($date_selection ne 'Select Month') && ($date_selection ne ''))#month selected
			{
				; #don't print the switch to range option
			}
		
		else 
			{
				print "\n<b><a href='#' id='showrangetext' name='showrangetext' onClick='document.getElementById(\"showrangetext\").style.display=\"none\"; document.getElementById(\"monthrange\").style.display=\"none\"; document.getElementById(\"showrange\").style.display=\"block\"; document.getElementById(\"contractorlist\").style.display=\"none\"'>Click here to generate a Date Rage report</a></b><br />";
			}
		print "\n<div id='showrange' name='showrange' style='display:none'>";
		print "\n<b><a href='#' id='showmonthtext' name='showmonthtext' onClick='document.getElementById(\"showrange\").style.display=\"none\"; document.getElementById(\"monthrange\").style.display=\"block\"; document.getElementById(\"showrangetext\").style.display=\"block\"'>Click here to generate a Monthly Report</a></b><br />";
		
		print "\n<b><p>From:</b> <input type=\"text\" onclick=\"displayDatePicker('FromDate');\" value=\"Start Date\" maxlength=\"12\" size=\"10\" name=\"FromDate\"> 
				<b>To:</b> <input type=\"text\" onclick=\"displayDatePicker('ToDate');\" value=\"End Date\" maxlength=\"12\" size=\"10\" name=\"ToDate\">"; 
				
		#my $usertypeselectstatement="SELECT distinct user_typeofperson FROM users WHERE user_typeofperson NOT IN ('Employee','Lump Sum Contract','null') ORDER BY user_typeofperson";
		my $usertypeselectstatement="select distinct resource_status from resource_employment_status order by resource_status;";
		my $sthusertypeselect = $dbh->prepare($usertypeselectstatement);
		$sthusertypeselect->execute();
		print "\n<select name='usertypeselect2'>";
		print "\n<option value='0'></option>";
		while (my @row = $sthusertypeselect->fetchrow_array) 
				{
        		#push(@usertypelist, @row[0]);
        		if($usertypeselect eq @row[0]){
        		print "\n<option value='@row[0]' selected>@row[0]</option>";}
        		else {print "\n<option value='@row[0]' >@row[0]</option>";}
	    	}
		#$dbh->disconnect();
						
		print "\n</select>";
				
		print "		<input type='submit' onclick='document.getElementById(\"monthselect\").value=\"\";' value='Apply Range Filter'></p>";
		print "\n<br /><font color = 'red'>Please click \"Apply Range Filter\" to make your range selection</font>";
		print "\n</div>";
		
		    
		print "\n<p><div style='padding-left:15px;' id = 'monthrange' name = 'monthrange'>";
		#my $usertypeselectstatement="SELECT distinct user_typeofperson FROM users WHERE user_typeofperson NOT IN ('Employee','Lump Sum Contract','null') ORDER BY user_typeofperson";
		my $usertypeselectstatement="select distinct resource_status from resource_employment_status order by resource_status;";
		my $sthusertypeselect = $dbh->prepare($usertypeselectstatement);
		$sthusertypeselect->execute();
		print "\n<select name='usertypeselect1'>";
		print "\n<option value='0'></option>";
		while (my @row = $sthusertypeselect->fetchrow_array) 
				{
        		#push(@usertypelist, @row[0]);
        		if($usertypeselect eq @row[0]){
        		print "\n<option value='@row[0]' selected>@row[0]</option>";}
        		else {print "\n<option value='@row[0]' >@row[0]</option>";}
	    	}
		#$dbh->disconnect();
						
		print "\n</select>
		<b>Select Month:</b><select name='date_selection' id='monthselect'>";
		my $monthstring;		
		print "\n<option value='$monthstring'>Select Month</option>";
		for (my $i=1; $i<=8; $i++)
			{
				$monthstring = &getMonths($i);
				if ($monthstring eq $date_selection) #if the date was passed, when reloaded it should show selection
					{
						print "\n<option value='$monthstring' SELECTED>$monthstring</option>";
					}
		
				else
					{
						print "\n<option value='$monthstring'>$monthstring</option>";
					}
			}
			
		print "\n</select><input type='button' onclick='if(document.getElementById(\"monthselect\").value != \"\"){this.form.submit();}' value='Filter'>";
		print "\n</div>";
		print "\n</p>";
		print "\n</form>";
		
		print "\n<div name='contractorlist' id='contractorlist'>";
		print "\n<form action='atin.cgi' method='post' name='contractor' id='contractor'>";

		print "\n<table>";	

		foreach my $user_username (@{$people})
			{
				
				my $statement="SELECT user_name, user_lastname,user_id,res.resource_status FROM users u
				INNER JOIN resource_employment_status res on u.`user_resource_status_id`=res.resource_employment_status_id 
				where u.user_username='$user_username'";
				my $sth = $dbh->prepare($statement);
				$sth->execute();
				
				while (my @row = $sth->fetchrow_array) 
						{
							$f_name = @row[0];
							$l_name = @row[1];
							$u_type = @row[3];
							$user_id = @row[2];
						} 
				$dbh->disconnect();
				print "\n<tr>";
				print "\n<td>";
				if ($date_selection_var != 1)
					{
						print "\n<input type='checkbox' name='check_list' id='$user_id' value='$user_id' disabled>$f_name $l_name</input>";	
						print "\n</td><td>$u_type</td>";
						print "\n<td>";
						print "\n<select name='$user_id' disabled>";
							print "\n<option value='mdinacontractor'>Generate Invoice Mail to Sales Beacon/Contractor</option>";
							print "\n<option value='contractor'>Generate Invoice Mail to Contractor Only</option>";
							print "\n<option value='mdina'>Generate Invoice Mail to Sales Beacon Only</option>";
						print "\n</select>";
						print "\n</td>";
						print "\n</tr>";
					}
				
				else
					{
						print "\n<input type='checkbox' name='check_list' id='$user_id' value='$user_id'>$f_name $l_name</input>";
						print "\n</td><td>$u_type</td>";
						print "\n<td>";
						print "\n<select name='$user_id'>";
							print "\n<option value='mdinacontractor'>Generate Invoice Mail to Sales Beacon/Contractor</option>";
							print "\n<option value='contractor'>Generate Invoice Mail to Contractor Only</option>";
							print "\n<option value='mdina'>Generate Invoice Mail to Sales Beacon Only</option>";
						print "\n</select>";
						print "\n</td>";
						print "\n</tr>";
					}				
			}
		
		print "\n</table>";
		if ($date_selection_var ne '1')
			{
				print "\n<br><input type='button' id='Check_All' value='Check All' name='Check_All' onclick='checkAllProjects()' disabled>";
				
			}
			
		else
			{
				print "\n<br><input type='button' id='Check_All' value='Check All' name='Check_All' onclick='checkAllProjects()'>";
			}
		
		print "\n<input type='hidden' name='generateinvoices' value='1'>";
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
		
		if ($date_selection_var ne '1')
			{
				print "\n<br /><br /><b>What would you like to do?
				<select name=Sage50_export disabled>
					<option value='0'>Email Invoices</option>
					<option value='1' disabled>Generate Sage50 Import</option>
					<option value='2'>Generate Payment Summary</option>
				</select>";
				print "\n<br /><input type='hidden' name='notaninvoice' value='0'><input type='submit' value='Generate' disabled>";
			}
		
		else
			{
				print "\n<br /><br /><b>What would you like to do?
						<select name=Sage50_export>
							<option value='0'>Email Invoices</option>
							<option value='1' disabled>Generate Sage50 Import</option>
							<option value='2'>Generate Payment Summary</option>
						</select>";
				print "\n<br /><input type='hidden' name='notaninvoice' value='0'><input type='submit' value='Generate'>";
			}
			
		print "\n</form>";
		print "\n</div>";
		print "\n</body>";
		print "\n</html>"; 
	}