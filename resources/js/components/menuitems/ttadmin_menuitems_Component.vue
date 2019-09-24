<template>
<div class="btn-group" role="group" style="display:inline-flex;">
  <div class="dropdown">
    <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
      Projects
    </button>
    <div class="dropdown-menu ">
      <a class="dropdown-item" href="#"><img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Projects</a>
      <a class="dropdown-item" href="#"><img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Hours</a>
      <a class="dropdown-item" href="#"><img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Hours Transfer</a>      
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
      
      <a class="dropdown-item" href="#" ><img itemprop="image" class="mobile" src="images/diamond4.svg" alt="Users" style="height: 16px;margin-right:30px;">User Management</a>
    </div>
  </div>
  
  
  <div class="dropdown">
    <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
      Configuration
    </button>
    <div class="dropdown-menu">
      
      <a class="dropdown-item" href="#" ><img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">Department</a>
      <a class="dropdown-item" href="#" ><img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">Practice Area</a>
      <a class="dropdown-item" href="#"><img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">Report Recipient</a>
      <a class="dropdown-item" href="#" role="button"><img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">User Authorization</a>
      <a class="dropdown-item" href="#" role="button"><img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">Payee</a>
      <a class="dropdown-item" href="#" role="button"><img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">Company</a>
    </div>
  </div>  
</div>
</template>