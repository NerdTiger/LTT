    <template>

    <div class="btn-group" role="group" style="display:inline-flex;">
  
    <div class="dropdown">
    <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
      Projects
    </button>
    <div class="dropdown-menu ">
      <router-link :to="{ name: 'project/index' }" class="dropdown-item">
        <img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Projects
      </router-link>
      <router-link :to="{ name: 'project/index' }" class="dropdown-item">
        <img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Hours
      </router-link>
    </div>
  </div>
  <div class="dropdown">
    <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
      Reports
    </button>
    <div class="dropdown-menu">
      <router-link :to="{ name: 'project/index' }" class="dropdown-item">
        <img itemprop="image" class="mobile" src="images/diamond5.svg"  style="height: 16px;margin-right:30px;">CM Bonus
      </router-link>
      <router-link :to="{ name: 'project/index' }" class="dropdown-item">
      <img itemprop="image" class="mobile" src="images/diamond5.svg" alt="Users" style="height: 16px;margin-right:30px;">Hours Transfer Report
      </router-link>
    </div>
  </div>  
<br />
  </div>
  
    </template>