<!doctype html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Auto Invoice</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
       
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
    <h1>INVOICE</h1>
    <hr><br/>
    <table width='800'>
        <tr>
        <?php if(isset($invoice_data['user_info']->billing_name) && $invoice_data['user_info']->billing_name!='') ?>
        <td valign='top'><b>Name:</b> <?php echo $invoice_data['user_info']->billing_name ?><br />
        <?php else ?>
        <td valign='top'><b>Name:</b> <?php echo $invoice_data['user_info']->user_name   .' '.  $invoice_data['user_info']->user_lastname ?><br />
        <?php endif ?>
        <b>Address:</b> <?php echo $invoice_data['user_info']->user_street ?><br />
        <b>City:</b> <?php echo $invoice_data['user_info']->user_city ?><br />
        <b>Province/State:</b> <?php echo $invoice_data['user_info']->user_prov ?><br />
        <b>Country:</b> <?php echo $invoice_data['user_info']->user_country ?><br />
        <b>Postal/Zip:</b> <?php echo $invoice_data['user_info']->user_zip ?><br />
        <b>HST/GST Number:</b><?php echo $invoice_data['user_info']->user_tax_number ?><br />
        <b>HST/GST Rate:</b> <?php echo $invoice_data['user_info']->user_tax %?><br />
        <b>Other Tax Number:</b> <?php echo $invoice_data['user_info']->user_tax_other_number ?><br />
        <b>Other Tax Rate:</b> <?php echo $invoice_data['user_info']->user_tax_other %?></td>

        <td valign='top'>
            <b>Invoice Number:</b> <?php echo $invoice_data['invoice_info']['invoice_number'] ?><br />
            <b>Invoice Date:</b> <?php echo $invoice_data['invoice_info']['invoice_date'] ?><br />
            <b>Invoice Period:</b> <?php echo $invoice_data['invoice_info']['invoice_period'] ?><br /><br />
            <?php echo $invoice_data['user_info']->bill_address ?>
        </td>
        </tr>
        </table>
        <br />
        <table width='800' border='1'>
        <tr><td>
        <b><u>Project Code/Project Name</b></u></td>
        <td><b><u>Project Type</b></u></td>
        <td><b><u>Practice Area</b></u></td>
        <td><b><u>Rate $</b></u></td>
        <td><b><u>Hours Worked</b></u></td>
        <td><b><u>Amount Billed</b></u></td></tr>
        <?php if(count($invoice_data['project_rows'])>0) {
        foreach($invoice_data['project_rows'] as $project) { ?>
        <tr>
        <td><?php echo $project->project_number .':'.$project->project_title ?></td>
        
        <?php if(isset($project->project_type) && $project->project_type=='1') { ?>
        <td>I</td>
        <?php } else { ?>
        <td>E</td>
        <?php } ?>
        <td><?php echo $project->practice_area_name ?></td>
        <td>$<?php echo $project->cost ?></td>
        <td><?php echo number_format($project->projecthours,1) ?></td>
        <td>$<?php echo number_format($project->projecthours*$project->cost,2) ?></td>
        </tr>
        <?php } ?>
        </table>
        <?php } ?>
        <br /><hr><p><b><font color='blue'>TOTAL HOURS:</b> <?php echo number_format($invoice_data['total_data']['ttlhrs'],2) ?></font></p>
        <br /><b>Total Work Amount Billed:</b> $<?php echo number_format($invoice_data['total_data']['totaltemp_formatted'],2) ?><br/>

        <div id='totals' style='display:inline'>
            <b>HST/GST/Other:</b> $<?php echo number_format($invoice_data['total_data']['taxes'],2) ?><br />
            <b>Medical Plan Deduction:</b> $<?php echo number_format($invoice_data['total_data']['healthdeductions'],2) ?><br />
            <b>RRSP Contribution Deduction:</b> $<?php echo number_format($invoice_data['total_data']['rrspdeductions'],2) ?><br />
        </div>

        <br /><b><font color='red'>TOTAL DUE:</b> $<?php echo number_format($invoice_data['total_data']['grandtotal'],2) ?></font> <font color='blue'><b><?php echo $invoice_data['user_info']->user_currency ?></b></font></p>
        <p><i><center><font style='font-size:10pt'>This invoice was automatically generated from the Sales Beacon TimeTracker system based upon your input of billed time.<br />
        <font color='red'>No confirmation is required, however concerns must be reported by the <b><u>2nd of the month</b></u> as to ensure payment on the next billing cycle.</font><br />
        <b>All adjustments must be reported to <a HREF='mailto:ttinvoicing@salesbeacon.com'>ttinvoicing@salesbeacon.com</a></b><br />
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
