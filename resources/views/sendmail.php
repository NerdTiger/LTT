my $contractor_email_address = shift;
		my $invoicehtmlstring = shift;
		my $email_options = shift;
		my $first_name = shift;
		my $last_name = shift;
		my $invoice_date = shift;
		my $notaninvoice = shift;
		my $s_date = shift;
		my $e_date = shift;
		my $date = $invoice_date; #&getDateStamp();
		my @values = split('-', $date);
		#$values[1]--; #previous month
		my $msg;
		my $mdinacontractorstring = "$contractor_email_address" . ", accounting\@salesbeacon.com";
		my $subject_string;
		
		if ($notaninvoice eq '1')
			{
				$subject_string = "Sales Beacon TimeTracker hours and payment notification report for $first_name $last_name for $s_date - $e_date";
			}
		
		else 
			{
				$subject_string = "Monthly Automated Invoice $values[1]-$values[0] for $first_name $last_name";
			}
		
		if ($email_options eq "mdinacontractor") #EMAIL BOTH MDINA AND CONTRACTOR (DEFAULT)
			{
				$msg = MIME::Lite->new
					(
						Subject => "$subject_string",
						From    => 'Sales Beacon <ttinvoicing@salesbeacon.com>',
						To      => $mdinacontractorstring,
						#To      => 'amccrack@cisco.com',
						#Cc      => 'accounting@salesbeacon.com',
						Type    => 'text/html',
						Data    => $invoicehtmlstring	
					);
			}
		
		if ($email_options eq "contractor") #email only CONTRACTOR
			{
				$msg = MIME::Lite->new
					(
						Subject => "$subject_string",
						From    => 'Sales Beacon <ttinvoicing@salesbeacon.com>',
						To      => $contractor_email_address,
						Type    => 'text/html',
						Data    => $invoicehtmlstring	
					);
			}
		
		if ($email_options eq "mdina") #email only Sales Beacon
			{
				$msg = MIME::Lite->new
					(
						Subject => "$subject_string",
						From    => 'Sales Beacon <ttinvoicing@salesbeacon.com>',
						To      => 'accounting@salesbeacon.com',
						Type    => 'text/html',
						Data    => $invoicehtmlstring	
					);
			}
		
		$msg->send(); #email per the specification of options
		print "\nINVOICE FOR: $contractor_email_address SENT<br />";
