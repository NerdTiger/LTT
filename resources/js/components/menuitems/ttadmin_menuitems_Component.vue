<template>
<div class="btn-group" role="group" style="display:inline-flex;">
  <div class="dropdown">
    <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
      Projects
    </button>
    <div class="dropdown-menu ">
      <router-link :to="{ name: 'projectlist' }" class="dropdown-item">
        <img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">
        Projects
      </router-link>
      <router-link :to="{ name: 'entrylist' }" class="dropdown-item">
        <img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Hours      
      </router-link>
      <router-link :to="{ name: 'userlist' }" class="dropdown-item">
      <img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Hours Transfer
      </router-link>
      
    </div>
  </div>
  <div class="dropdown">
    <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
      Reports
    </button>
    <div class="dropdown-menu ">
    
    <a class="dropdown-item" href="#" onclick="loadreport_CMReportforAdmin();"><img itemprop="image" class="mobile" src="images/diamond5.svg"  style="height: 16px;margin-right:30px;">CM Bonus</a>
      <router-link :to="{ name: 'project/index' }" class="dropdown-item">
        <img itemprop="image" class="mobile" src="images/diamond5.svg"  style="height: 16px;margin-right:30px;">Total Cost By Project
      </router-link>
      <router-link :to="{ name: 'project/index' }" class="dropdown-item">
        <img itemprop="image" class="mobile" src="images/diamond5.svg"  style="height: 16px;margin-right:30px;">Total Billing By Project
      </router-link>
      <router-link :to="{ name: 'project/index' }" class="dropdown-item">
        <img itemprop="image" class="mobile" src="images/diamond5.svg" style="height: 16px;margin-right:30px;">Hours Transfer Report      
      </router-link>
      <router-link :to="{ name: 'project/index' }" class="dropdown-item">
        <img itemprop="image" class="mobile" src="images/diamond5.svg" style="height: 16px;margin-right:30px;">Hours Transfer Cost Report      
      </router-link>
    </div>
  </div>
  <div class="dropdown">
    <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
      Users
    </button>
    <div class="dropdown-menu ">
      <router-link :to="{ name: 'project/index' }" class="dropdown-item">
        <img itemprop="image" class="mobile" src="images/diamond4.svg" alt="Users" style="height: 16px;margin-right:30px;">User Management
      </router-link>
    </div>
  </div>
  
  
  <div class="dropdown">
    <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
      Configuration
    </button>
    <div class="dropdown-menu">
      <router-link :to="{ name: 'projectlistcomponent' }" class="dropdown-item">
        <img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">Department
      </router-link>
      <router-link :to="{ name: 'project/index' }" class="dropdown-item">
        <img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">Practice Area
      </router-link>
      <router-link :to="{ name: 'project/index' }" class="dropdown-item">
        <img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">Report Recipient
      </router-link>
      <router-link :to="{ name: 'project/index' }" class="dropdown-item">
        <img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">User Authorization
      </router-link>
      <router-link :to="{ name: 'project/index' }" class="dropdown-item">
        <img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">Payee
      </router-link>
      <router-link :to="{ name: 'project/index' }" class="dropdown-item">
        <img itemprop="image" class="mobile" src="images/diamond4.svg" alt="" style="height: 16px;margin-right:30px;">Company
      </router-link>
    </div>
  </div>  
</div>
</template>