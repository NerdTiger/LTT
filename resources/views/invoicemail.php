my $counter = 0;
		my $hourstemp = 0;
		my $ratetemp = 0;
		my $totaltemp = 0;
		my $user_id = shift;
		my $first_name = shift;
		my $last_name = shift;
		my $address = shift;
		my $city = shift;
		my $province = shift;
		my $postal_code = shift;
		my $country = shift;
		my $tax_rate = shift;
		my $tax_rate_percentage = $tax_rate*100 . "%";
		my $tax_number = shift;
		my $other_tax_rate = shift;
		my $other_tax_rate_percentage = $other_tax_rate*100 . "%";
		my $other_tax_number = shift;
		my $personhasharrays = shift;
		my $billing_name = shift;
		my $email_address = shift;
		my $email_options = shift;
		my $invoice_date = shift;# date passed to generate invoice for, should be beginning of month ie. 2011-12-27
		my $health_plan_opt_in = shift;
		my $health_plan_deduction = shift;
		my $rrsp_opt_in = shift;
		my $rrsp_deduction = shift;
		my $currency = shift;
		my $notaninvoice = shift; #used if range info is passed
		my $s_date = shift; #used if range info is passed
		my $e_date = shift; #used if range info is passed
		my $type_of_report = shift; #0 if generate invoices; 1 if sage50; 2 if payment summary
		my $number_of_invoices = shift; #how many invoices are there going to be generated?
		my $typeofperson = shift; #Are they an employee, lump-sum, hourly employee or contractor (default)
		my $billaddress= shift;
		#foreach variables
		my ($tl,$ty);
        my $al;
		my $rt;
		my $hr;
		my $totalcost;
		my $current_date = &getDateStamp();
		#end foreach variables
		

#print  Dumper ($personhasharrays);

#exit;
		#invoice header information
		my $date = $invoice_date; #&getDateStamp(); #used for invoice date of whenever the invoice was generated
		my @values = split('-', $date); #used for period
        my $lastDayPrevMonth =  last_day_last_month();
		my $period_year = @values[0]; #used to make period
		my $period_month = @values[1]; #used to make period
		my $period = "$period_year" . "-" . "$period_month"; # used for the billing period
		
=pod		
		if (($values[1] == 1) || ($values[1] == 01)) #if January
			{
				$period_year = $values[0];
				$period_year--; #decrease the year
				
				$period = $period_year . "-" . "12";
				print STDERR "THE PERIOD is: $period";
			}
		else #not January
			{
				$period_month = $values[1]--; #previous month
				$period_year = $values[0]; #year
			}
=cut
		
		my $invoicenumber;
		my $invoicehtmlstring;
		
		if ($notaninvoice eq '1')
			{
				$invoicenumber = "Not an Invoice";
				$invoicehtmlstring = "\n<html>\n<body>\n<h1>PAYMENT REPORT</h1>\n<hr>\n<br /><table width='800'>";
			}
	
		else
			{
				$invoicenumber = "$user_id" . "-" . "$period_year" . "$period_month";
				$invoicehtmlstring = "\n<html>\n<body>\n<h1>INVOICE</h1>\n<hr>\n<br /><table width='800'>";
			}
	
		#populate arrays with hash info
		my @projectcost;
		
		my $projectcostref = $personhasharrays->{projectcost};
		foreach my $cost(@{$projectcostref})
			{
				push(@projectcost, $cost);
			}
			
		my @projecthours;
		my $projecthoursref = $personhasharrays->{projecthours};
		foreach my $hours(@{$projecthoursref})
			{
				push(@projecthours, $hours);
			}
			
		my @projectcode;
		my $projectcoderef = $personhasharrays->{projectcode};
		foreach my $code(@{$projectcoderef})
			{
				push(@projectcode, $code);
			}

		my @projType;
		my $projecttyperef = $personhasharrays->{projecttype};
		foreach my $type(@{$projecttyperef})
			{
				push(@projType, $type);
			}

				
		my @projecttitle;
		my $projecttitleref = $personhasharrays->{projecttitle};
		foreach my $title(@{$projecttitleref})
			{
				push(@projecttitle, $title);
			}
                                    my @practicearea;
		my $practicearearef = $personhasharrays->{practicearea};
		foreach my $area(@{$practicearearef})
			{
				push(@practicearea, $area);
			}

			
		#for the project table, add health plan deductions if they exist
		$health_plan_deduction = (0 - $health_plan_deduction);
		#$health_plan_deduction = sprintf ("%0.2f", $health_plan_deduction);
		if ((($health_plan_opt_in == 1)) && ($notaninvoice == 0))
			{
				push(@projectcost, $health_plan_deduction);
				push(@projecthours, '1');
				push(@projectcode, 'MED');
				push(@projecttitle, 'Sales Beacon Contractor Health Plan Deduction');
			}
			
		#for the project table, add RRSP plan deductions if they exist
		$rrsp_deduction = (0 - $rrsp_deduction);
		#$health_plan_deduction = sprintf ("%0.2f", $health_plan_deduction);
		if ($rrsp_opt_in == 1)
			{
				push(@projectcost, $rrsp_deduction);
				push(@projecthours, '1');
				push(@projectcode, 'RRSP');
				push(@projecttitle, 'Sales Beacon Contractor RRSP Plan Deduction');
			}
	
		#heading
		if ($billing_name eq "")
			{
				$invoicehtmlstring .= "\n<tr>\n<td valign='top'><b>Name:</b> $first_name $last_name\n<br />"; 
			}
		else
			{
				$invoicehtmlstring .= "\n<tr>\n<td valign='top'><b>Name:</b> $billing_name\n<br />"; 
			}
		$invoicehtmlstring .= "\n<b>Address:</b> $address\n<br />";
		$invoicehtmlstring .= "\n<b>City:</b> $city\n<br />";
		$invoicehtmlstring .= "\n<b>Province/State:</b> $province\n<br />";
		$invoicehtmlstring .= "\n<b>Country:</b> $country\n<br />";
		$invoicehtmlstring .= "\n<b>Postal/Zip:</b> $postal_code\n<br />";
		
		if ($notaninvoice ne '1')
			{
		$invoicehtmlstring .= "\n<b>HST/GST Number:</b> $tax_number\n<br />";
		$invoicehtmlstring .= "\n<b>HST/GST Rate:</b> $tax_rate_percentage\n<br />";
		$invoicehtmlstring .= "\n<b>Other Tax Number:</b> $other_tax_number<br />";
		$invoicehtmlstring .= "\n<b>Other Tax Rate:</b> $other_tax_rate_percentage\n</td>";
			}
		
		if ($notaninvoice eq '1')
			{
				$invoicehtmlstring .= "\n<td valign='top'><b>Invoice Number:</b> $invoicenumber<br />";
				$invoicehtmlstring .= "\n<b>Report Run Date:</b> $current_date<br />";
				$invoicehtmlstring .= "\n<b>Report Period:</b> $s_date to $e_date<br /><br />";
			}
		else
			{
				$invoicehtmlstring .= "\n<td valign='top'><b>Invoice Number:</b> $invoicenumber<br />";
				$invoicehtmlstring .= "\n<b>Invoice Date:</b> $lastDayPrevMonth<br />";
				$invoicehtmlstring .= "\n<b>Invoice Period:</b> $period<br /><br />";
			}
		
		if ($notaninvoice ne '1')
			{
			$invoicehtmlstring .=$billaddress;

			}
		$invoicehtmlstring .= "\n</td>\n</tr>\n</table><br />";
		#end the heading
		#projects table
		$invoicehtmlstring .= "\n<table width='800' border='1'>";
		$invoicehtmlstring .= "\n<tr>\n<td>";
		$invoicehtmlstring .= "\n<b><u>Project Code/Project Name</b></u></td>\n";
		$invoicehtmlstring .= "\n<td><b><u>Project Type</b></u></td>\n";
		$invoicehtmlstring .= "\n<td><b><u>Practice Area</b></u></td>\n";
		$invoicehtmlstring .= "\n<td><b><u>Rate \$</b></u></td>\n";
		$invoicehtmlstring .= "\n<td><b><u>Hours Worked</b></u></td>\n";
		$invoicehtmlstring .= "\n<td><b><u>Amount Billed</b></u></td>\n</tr>\n";
		my $ttlhrs = 0;	
		foreach my $cd (@projectcode) #print out project details
			{
				$invoicehtmlstring .= "\n<tr>";
				$invoicehtmlstring .= "\n<td>$cd:";
				
				$tl = $projecttitle[$counter];
				$invoicehtmlstring .= " $tl</td>";

                $ty = @projType[$counter];
                if($ty=='0'){$invoicehtmlstring .= "\n<td>E</td>";}
                else 				{$invoicehtmlstring .= "\n<td>I</td>"};
				
                $al = $practicearea[$counter];
				$invoicehtmlstring .= "\n<td>$al</td>";
				

				$rt = $projectcost[$counter];
				$invoicehtmlstring .= "\n<td>\$$rt</td>";
				$ratetemp = $rt;
				
				$hr = $projecthours[$counter];
				$invoicehtmlstring .= "\n<td>$hr</td>";
				$hourstemp = $hr;
				if(($cd ne 'RRSP') && ($cd ne 'MED')){$ttlhrs+=$hr;}
	
				#print cost per line item
				$totalcost = $hourstemp*$ratetemp;
				$totaltemp = $totaltemp + $totalcost ;#increment overall totals counter
				$invoicehtmlstring .= "\n<td>\$$totalcost</td></tr>";
				$counter++;
			}# close primary foreach
		
		#close table
		$invoicehtmlstring .= "\n</table>";
		
		#if health plan, (add back to show [negative of negative]) subtract the health cost from work/hst
		if ((($health_plan_opt_in == 1) && ($notaninvoice == 0)))
			{
				$totaltemp = $totaltemp - $health_plan_deduction;
			}
			
		#if RRSP, (add back to show [negative of negative]) subtract the health cost from work/hst
		if ((($rrsp_opt_in == 1) && ($notaninvoice == 0)))
			{
				$totaltemp = $totaltemp - $rrsp_deduction;
			}
		
		my $totaltemp_formatted = $totaltemp;
		$totaltemp_formatted =~ s/(^[-+]?\d+?(?=(?>(?:\d{3})+)(?!\d))|\G\d{3}(?=\d))/$1,/g;
                $invoicehtmlstring .= "\n<br /><hr><p><b><font color='blue'>TOTAL HOURS:</b> \ $ttlhrs</font></p>";
		#$invoicehtmlstring .= "\n<br /><hr><p><b>Total Work Amount Billed:</b> \$$totaltemp_formatted<br />";
                $invoicehtmlstring .= "\n<br /><b>Total Work Amount Billed:</b> \$$totaltemp_formatted<br/>";
		my $taxes1 = $tax_rate * $totaltemp;
		
		#TAX OF TAX is the way that tax 2 works
		my $taxes2 =  $other_tax_rate * ($totaltemp + $taxes1);
		my $taxes = $taxes1 + $taxes2;
		$taxes=sprintf("%.2f", $taxes);
		my $healthdeductions = $health_plan_deduction;
		my $rrspdeductions = $rrsp_deduction;
		my $grandtotal = $taxes + $totaltemp + $healthdeductions + $rrspdeductions;
		$taxes =~ s/(^[-+]?\d+?(?=(?>(?:\d{3})+)(?!\d))|\G\d{3}(?=\d))/$1,/g;
		#$healthdeductions = ~ s/(^[-+]?\d+?(?=(?>(?:\d{3})+)(?!\d))|\G\d{3}(?=\d))/$1,/g;
		$grandtotal =~ s/(^[-+]?\d+?(?=(?>(?:\d{3})+)(?!\d))|\G\d{3}(?=\d))/$1,/g;
		if ($notaninvoice eq '1')
			{
				$invoicehtmlstring .= "<div id='totals' style='display:none'>";
				$invoicehtmlstring .= "\n<b>HST/GST/Other:</b> \$$taxes<br />";
				$invoicehtmlstring .= "\n<b>Medical Plan Deduction:</b> \$$healthdeductions<br />";
				$invoicehtmlstring .= "\n<b>RRSP Contribution Deduction:</b> \$$rrspdeductions<br /></div>";
			}
			
		else
			{
				$invoicehtmlstring .= "<div id='totals' style='display:inline'>";
				$invoicehtmlstring .= "\n<b>HST/GST/Other:</b> \$$taxes<br />";
				$invoicehtmlstring .= "\n<b>Medical Plan Deduction:</b> \$$healthdeductions<br />";
				$invoicehtmlstring .= "\n<b>RRSP Contribution Deduction:</b> \$$rrspdeductions<br /></div>";
			}
		
		if ($notaninvoice eq '1')
			{
				$invoicehtmlstring .= "\n<b><font color='red'>WORK TOTAL (no taxes/deductions):</b> \$$totaltemp_formatted</font> <font color='blue'><b>$currency</b></font></p>";
				$invoicehtmlstring .= "\n<i><center><font style='font-size:10pt'>This report was automatically generated from the Sales Beacon TimeTracker system based upon your input of billed time.";
				$invoicehtmlstring .= "\n<br /><b>All adjustments must be reported to <a HREF='mailto:ttinvoicing\@salesbeacon.com'>ttinvoicing\@salesbeacon.com</a></b><br />";
				$invoicehtmlstring .= "\nIn the absence of reported concerns, the stated amount indicated on this report will be paid to you. This is not a pay stub.<br /></i></font></center></p>";
				$invoicehtmlstring .= "\n</body>\n</html>";
			}
		
		else 
			{
                                
                                
				$invoicehtmlstring .= "\n<br /><b><font color='red'>TOTAL DUE:</b> \$$grandtotal</font> <font color='blue'><b>$currency</b></font></p>";
				$invoicehtmlstring .= "\n<p><i><center><font style='font-size:10pt'>This invoice was automatically generated from the Sales Beacon TimeTracker system based upon your input of billed time.<br />";
				$invoicehtmlstring .= "\n<font color='red'>No confirmation is required, however concerns must be reported by the <b><u>2nd of the month</b></u> as to ensure payment on the next billing cycle.</font><br />";
				$invoicehtmlstring .= "\n<b>All adjustments must be reported to <a HREF='mailto:ttinvoicing\@salesbeacon.com'>ttinvoicing\@salesbeacon.com</a></b><br />";
				$invoicehtmlstring .= "\nIn the absence of reported concerns, the stated amount indicated on this invoice will be paid to you, the contractor.<br /></i></font></center></p>";
				$invoicehtmlstring .= "\n</body>\n</html>";
			}
		
		# print $invoicehtmlstring;
		# exit; #JPR

		#build the Payment Summary Totals (incrementally) if requested in the selection option
		if ($type_of_report eq '2')
			{
				if ($currency eq 'CAD')
					{
						$CAD_Summary = $CAD_Summary + $totaltemp;
					}
				
				elsif ($currency eq 'USD')
					{
						$USD_Summary = $USD_Summary + $totaltemp;
					}
				
				#if they are not some form of employee, add the taxes on
				if (($typeofperson ne 'Hourly Employee') && ($typeofperson ne 'Employee'))
					{
						$GSTHST_Summary = $GSTHST_Summary + $taxes1;
						$othertaxes_Summary = $othertaxes_Summary + $taxes2;
					}
				#print "\nNumber of invoices: $number_of_invoices : Iterator: $invoice_iterator";
				if ($invoice_iterator == $number_of_invoices)
					{
						&sendPaymentSummaryEmail($s_date, $e_date, $date);
					}
				#call method to generate emailed summary
			}
		
		else #not just a payment summary report, email the invoices - clear to do this
			{
				#email the invoice to the appropriate parties.
				#&sendInvoiceEmail($email_address, $invoicehtmlstring, $email_options, $first_name, $last_name, $invoice_date, $notaninvoice, $s_date, $e_date);
				print $invoicehtmlstring;
				
			}
