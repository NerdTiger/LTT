<html>
		<head>
		<link href=\"https://timetracker.salesbeacon.com/css/mdina-worx.css\" rel=\"stylesheet\" type=\"text/css\" />

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
										//document.contractor.Check_All.value="Check All
										document.getElementById('Check_All').value="Check All
									}
									
								else //if it is not checked, check it
									{
										collection[x].checked = true;
										//document.contractor.Check_All.value="UnCheck All
										document.getElementById('Check_All').value="Uncheck All
									}
							}
					}
			}	

		</script>
EOF1

		</head>
		<title>Sales Beacon Resource Invoice Verification Login</title>
		<body>
		<script src=\"https://timetracker.salesbeacon.com/java/date_picker.js\" language=\"javascript\"></script>
		<img src='https://timetracker.salesbeacon.com/images/mdina_logo_time_tracking.jpg'>
		<br>
		
		<form action='atin.cgi' method='post' name='month' id='month'>
		if (($date_selection ne 'Select Month') && ($date_selection ne ''))#month selected
			{
				; #don't print the switch to range option
			}
		
		else 
			{
				<b><a href='#' id='showrangetext' name='showrangetext' onClick='document.getElementById(\"showrangetext\").style.display=\"none\ document.getElementById(\"monthrange\").style.display=\"none\ document.getElementById(\"showrange\").style.display=\"block\ document.getElementById(\"contractorlist\").style.display=\"none\"'>Click here to generate a Date Rage report</a></b><br />
			}
		<div id='showrange' name='showrange' style='display:none'>
		<b><a href='#' id='showmonthtext' name='showmonthtext' onClick='document.getElementById(\"showrange\").style.display=\"none\ document.getElementById(\"monthrange\").style.display=\"block\ document.getElementById(\"showrangetext\").style.display=\"block\"'>Click here to generate a Monthly Report</a></b><br />
		
		<b><p>From:</b> <input type=\"text\" onclick=\"displayDatePicker('FromDate');\" value=\"Start Date\" maxlength=\"12\" size=\"10\" name=\"FromDate\"> 
				<b>To:</b> <input type=\"text\" onclick=\"displayDatePicker('ToDate');\" value=\"End Date\" maxlength=\"12\" size=\"10\" name=\"ToDate\"> 
				
		#my $usertypeselectstatement="SELECT distinct user_typeofperson FROM users WHERE user_typeofperson NOT IN ('Employee','Lump Sum Contract','null') ORDER BY user_typeofperson
		my $usertypeselectstatement="select distinct resource_status from resource_employment_status order by resource_status;
		my $sthusertypeselect = $dbh->prepare($usertypeselectstatement);
		$sthusertypeselect->execute();
		<select name='usertypeselect2'>
		<option value='0'></option>
		while (my @row = $sthusertypeselect->fetchrow_array) 
				{
        		#push(@usertypelist, @row[0]);
        		if($usertypeselect eq @row[0]){
        		<option value='@row[0]' selected>@row[0]</option>}
        		else {<option value='@row[0]' >@row[0]</option>}
	    	}
		#$dbh->disconnect();
						
		</select>
				
				<input type='submit' onclick='document.getElementById(\"monthselect\").value=\"\' value='Apply Range Filter'></p>
		<br /><font color = 'red'>Please click \"Apply Range Filter\" to make your range selection</font>
		</div>
		
		    
		<p><div style='padding-left:15px;' id = 'monthrange' name = 'monthrange'>
		#my $usertypeselectstatement="SELECT distinct user_typeofperson FROM users WHERE user_typeofperson NOT IN ('Employee','Lump Sum Contract','null') ORDER BY user_typeofperson
		my $usertypeselectstatement="select distinct resource_status from resource_employment_status order by resource_status;
		my $sthusertypeselect = $dbh->prepare($usertypeselectstatement);
		$sthusertypeselect->execute();
		<select name='usertypeselect1'>
		<option value='0'></option>
		while (my @row = $sthusertypeselect->fetchrow_array) 
				{
        		#push(@usertypelist, @row[0]);
        		if($usertypeselect eq @row[0]){
        		<option value='@row[0]' selected>@row[0]</option>}
        		else {<option value='@row[0]' >@row[0]</option>}
	    	}
		#$dbh->disconnect();
						
		</select>
		<b>Select Month:</b><select name='date_selection' id='monthselect'>
		my $monthstring;		
		<option value='$monthstring'>Select Month</option>
		for (my $i=1; $i<=8; $i++)
			{
				$monthstring = &getMonths($i);
				if ($monthstring eq $date_selection) #if the date was passed, when reloaded it should show selection
					{
						<option value='$monthstring' SELECTED>$monthstring</option>
					}
		
				else
					{
						<option value='$monthstring'>$monthstring</option>
					}
			}
			
		</select><input type='button' onclick='if(document.getElementById(\"monthselect\").value != \"\"){this.form.submit();}' value='Filter'>
		</div>
		</p>
		</form>
		
		<div name='contractorlist' id='contractorlist'>
		<form action='atin.cgi' method='post' name='contractor' id='contractor'>

		<table>	

		foreach my $user_username (@{$people})
			{
				
				my $statement="SELECT user_name, user_lastname,user_id,res.resource_status FROM users u
				INNER JOIN resource_employment_status res on u.`user_resource_status_id`=res.resource_employment_status_id 
				where u.user_username='$user_username'
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
				<tr>
				<td>
				if ($date_selection_var != 1)
					{
						<input type='checkbox' name='check_list' id='$user_id' value='$user_id' disabled>$f_name $l_name</input>	
						</td><td>$u_type</td>
						<td>
						<select name='$user_id' disabled>
							<option value='mdinacontractor'>Generate Invoice Mail to Sales Beacon/Contractor</option>
							<option value='contractor'>Generate Invoice Mail to Resource Only</option>
							<option value='mdina'>Generate Invoice Mail to Sales Beacon Only</option>
						</select>
						</td>
						</tr>
					}
				
				else
					{
						<input type='checkbox' name='check_list' id='$user_id' value='$user_id'>$f_name $l_name</input>
						</td><td>$u_type</td>
						<td>
						<select name='$user_id'>
							<option value='mdinacontractor'>Generate Invoice Mail to Sales Beacon/Contractor</option>
							<option value='contractor'>Generate Invoice Mail to Resource Only</option>
							<option value='mdina'>Generate Invoice Mail to Sales Beacon Only</option>
						</select>
						</td>
						</tr>
					}				
			}
		
		</table>
		if ($date_selection_var ne '1')
			{
				<br><input type='button' id='Check_All' value='Check All' name='Check_All' onclick='checkAllProjects()' disabled>
				
			}
			
		else
			{
				<br><input type='button' id='Check_All' value='Check All' name='Check_All' onclick='checkAllProjects()'>
			}
		
		<input type='hidden' name='generateinvoices' value='1'>
		#pass the date selection variable if present
		if ($date_selection eq "")
			{
				$date_selection_default = &getMonths('1');
				<input type='hidden' name='date_selection' value='$date_selection_default'>
			}
		else
			{
				<input type='hidden' name='date_selection' value='$date_selection'>
			}
		
		if ($date_selection_var ne '1')
			{
				<br /><br /><b>What would you like to do?
				<select name=Sage50_export disabled>
					<option value='0'>Email Invoices</option>
					<option value='1' disabled>Generate Sage50 Import</option>
					<option value='2'>Generate Payment Summary</option>
				</select>
				<br /><input type='hidden' name='notaninvoice' value='0'><input type='submit' value='Generate' disabled>
			}
		
		else
			{
				<br /><br /><b>What would you like to do?
						<select name=Sage50_export>
							<option value='0'>Email Invoices</option>
							<option value='1' disabled>Generate Sage50 Import</option>
							<option value='2'>Generate Payment Summary</option>
						</select>
				<br /><input type='hidden' name='notaninvoice' value='0'><input type='submit' value='Generate'>
			}
			
		</form>
		</div>
		</body>
		</html> 