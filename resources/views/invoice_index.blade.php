<!doctype html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" /> -->

        
        
        <!-- <meta name="csrf-token" value="{{ csrf_token() }}" /> -->
        
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <div id="app">
    <h1>INVOICE</h1>\n<hr>\n<br />
    <table width='800'>
        <tr><td valign='top'><b>Name:</b> $compound_fields->user_name<br />
        <b>Address:</b> $address\n<br />
        <b>City:</b> $city\n<br />
        <b>Province/State:</b> $province\n<br />
        <b>Country:</b> $country\n<br />
        <b>Postal/Zip:</b> $postal_code\n<br />
        <td valign='top'><b>Invoice Number:</b> $invoicenumber<br />
        <b>Invoice Date:</b> $lastDayPrevMonth<br />
        <b>Invoice Period:</b> $period<br /><br />
        </td>\n</tr>\n</table><br />
        <table width='800' border='1'>
        <tr>\n<td>
        <b><u>Project Code/Project Name</b></u></td>
        <td><b><u>Project Type</b></u></td>
        <td><b><u>Practice Area</b></u></td>
        <td><b><u>Rate \$</b></u></td>
        <td><b><u>Hours Worked</b></u></td>
        <td><b><u>Amount Billed</b></u></td>\n</tr>
        @if(count($row)>0)
        @foreach($projects as $project)
        <tr><td>$cd:$tl</td>
        <td>E/I</td>
        <td>$al</td>
        <td>\$$rt</td>
        <td>$hr</td>
        <td>\$$totalcost</td></tr>
        @endforeach
        </table>
        @endif
        <br /><hr><p><b><font color='blue'>TOTAL HOURS:</b> \ $ttlhrs</font></p>
        <br /><b>Total Work Amount Billed:</b> \$$totaltemp_formatted<br/>

        <div id='totals' style='display:inline'>
            <b>HST/GST/Other:</b> \$$taxes<br />
            <b>Medical Plan Deduction:</b> \$$healthdeductions<br />
            <b>RRSP Contribution Deduction:</b> \$$rrspdeductions<br />
        </div>

        <br /><b><font color='red'>TOTAL DUE:</b> \$$grandtotal</font> <font color='blue'><b>$currency</b></font></p>
        <p><i><center><font style='font-size:10pt'>This invoice was automatically generated from the Sales Beacon TimeTracker system based upon your input of billed time.<br />
        <font color='red'>No confirmation is required, however concerns must be reported by the <b><u>2nd of the month</b></u> as to ensure payment on the next billing cycle.</font><br />
        <b>All adjustments must be reported to <a HREF='mailto:ttinvoicing\@salesbeacon.com'>ttinvoicing\@salesbeacon.com</a></b><br />
        In the absence of reported concerns, the stated amount indicated on this invoice will be paid to you, the contractor.<br /></i></font></center></p>

    </div>

      

<!-- <script src="js/app.js" type="text/javascript"></script> -->
      <script>
          const router = new VueRouter({
  routes: [
    {
      path: '/',
      components: {
        default: Foo,
        a: Bar,
        b: Baz
      }
    }
  ]
});

      </script>
  </body>
</html>
