<style>
    
.nopaddingtablecell_div{
    padding-right:0;
    padding-left:0;
}
</style>

<script type="text/javascript" src="views/reports/js/jquery.table2csv.js"></script>

<script src="views/functionsforbuttons.js"></script>
{{--Session::get('usertype')--}}
@switch(Session::get('usertype'))
@case(1)
<div class="btn-group" role="group" style="display:inline-flex;">
        <div class="dropdown">        
            <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
              Projects
            </button>
            <div class="dropdown-menu ">
              <!--<a class="dropdown-item" href="#" onclick="loadprojectlistforuser();"><img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Projects</a>-->
              <a class="dropdown-item" href="FC_dispatcher.php?controller=project&action=index" ><img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Projects</a>
              <a class="dropdown-item" href="FC_dispatcher.php?controller=entry&action=index" ><img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Hours</a>
              <a class="dropdown-item" href="FC_dispatcher.php?controller=hoursTransfer&action=hoursTransfer" ><img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Hours Transfer</a>
            </div>
        </div>
    
        <div class="dropdown">
            <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
              Reports
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#" ><img itemprop="image" class="mobile" src="images/diamond4.svg" alt="Users" style="height: 16px;margin-right:30px;">Personal Billing Report</a>
            </div>
        </div>  
    </div>
@break
@case(2)
<div class="btn-group" role="group" style="display:inline-flex;">
  <div class="dropdown">
    <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
      Projects
    </button>
    <div class="dropdown-menu ">
      <a class="dropdown-item" href="FC_dispatcher.php?controller=project&action=index"  ><img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Projects</a>
      <a class="dropdown-item" href="FC_dispatcher.php?controller=entry&action=index" ><img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Hours</a>
    </div>
  </div>
  <div class="dropdown">
    <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
      Reports
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#" >
      <a class="dropdown-item" href="#" onclick="loadreport_CMReportforCM();"><img itemprop="image" class="mobile" src="images/diamond5.svg"  style="height: 16px;margin-right:30px;">CM Bonus</a>
      <a class="dropdown-item" href="#" "><img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Hours Transfer Report</a>
    </div>
  </div>  

  </div>
@break
@case(3)
aaa
@break
@case(4)
aaa
@break
@case(5)
<div class="btn-group" role="group" style="display:inline-flex;">
  <div class="dropdown">
    <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
      Projects
    </button>
    <div class="dropdown-menu ">
      <a class="dropdown-item" href="FC_dispatcher.php?controller=project&action=index"><img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Projects</a>
      <a class="dropdown-item" href="FC_dispatcher.php?controller=entry&action=index"><img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Hours</a>
      <a class="dropdown-item" href="FC_dispatcher.php?controller=hoursTransfer&action=hoursTransfer"><img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Hours Transfer</a>      
    </div>
  </div>
  <div class="dropdown">
    <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
      Reports
    </button>
    <div class="dropdown-menu ">
    
    <a class="dropdown-item" href="#" onclick="loadreport_CMReportforAdmin();"><img itemprop="image" class="mobile" src="images/diamond5.svg"  style="height: 16px;margin-right:30px;">CM Bonus</a>
      <a class="dropdown-item" href="#" onclick="loadreport_totalCostByProject();"><img itemprop="image" class="mobile" src="images/diamond5.svg"  style="height: 16px;margin-right:30px;">Total Cost By Project</a>
      <a class="dropdown-item" href="#" onclick="loadreport_totalBillingByProject();"><img itemprop="image" class="mobile" src="images/diamond5.svg"  style="height: 16px;margin-right:30px;">Total Billing By Project</a>
      <a class="dropdown-item" href="#" onclick="loadreport_hoursTransferReport();"><img itemprop="image" class="mobile" src="images/diamond5.svg" style="height: 16px;margin-right:30px;">Hours Transfer Report</a>
      <a class="dropdown-item" href="#" onclick="loadreport_hoursTransferCostReport();"><img itemprop="image" class="mobile" src="images/diamond5.svg" style="height: 16px;margin-right:30px;">Hours Transfer Cost Report</a>
    </div>
  </div>
  <div class="dropdown">
    <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
      Users
    </button>
    <div class="dropdown-menu ">
      
      <a class="dropdown-item" href="FC_dispatcher.php?controller=admin&action=list_user" ><img itemprop="image" class="mobile" src="images/diamond4.svg" alt="Users" style="height: 16px;margin-right:30px;">User Management</a>
    </div>
  </div>
  
  
  <div class="dropdown">
    <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
      Configuration
    </button>
    <div class="dropdown-menu">
      
      <a class="dropdown-item" href="FC_dispatcher.php?controller=admin&action=index_de" ><img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">Department</a>
      <a class="dropdown-item" href="FC_dispatcher.php?controller=admin&action=index_pr" ><img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">Practice Area</a>
      <a class="dropdown-item" href="FC_dispatcher.php?controller=admin&action=index_re"><img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">Report Recipient</a>
      <a class="dropdown-item" href="FC_dispatcher.php?controller=admin&action=index_us" role="button"><img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">User Authorization</a>
      <a class="dropdown-item" href="FC_dispatcher.php?controller=admin&action=index_py" role="button"><img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">Payee</a>
      <a class="dropdown-item" href="FC_dispatcher.php?controller=admin&action=index_cp" role="button"><img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">Company</a>
    </div>
  </div>  
</div>
@break
@case(6)
aaa
@break
@endswitch

        
