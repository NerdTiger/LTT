// ProjectListComponent.vue

<template>
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card card-default">
			<div class="card-header">project list Component</div>
			<div class="card-body">
				<!-- {{projects}} -->
				<div class="container-fliud h-100 flex-grow-1 tableforphone" >
					<div  class="row  flex-grow-1" style="width:98%;">
						<div  class="col-sm-2 hideforphone" align="left">
							  <div style="margin-top: 5px;margin-left: 4px;">
								  <ul class="nav flex-column">
									<li class="nav-item">
									  <input type="button" value="Add" onclick="loadaddproject();">
									</li>
									<li class="nav-item">
									  <input type="button" value="List" onclick="loadprojectlist();">
									</li>
								  </ul>
							  </div>
							<div style="margin-top: 50px;margin-left: 4px;">
								<input type="hidden" name="project_status" >
								Project Status:
								<div class="dropdown" id="dropdown_projectstatus">
									<button  class="btn btn-secondary dropdown-toggle whitebackgroundcolorfordropdown" type="button" id="dropdownMenuButton_projectstatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									</button>
									<div class="dropdown-menu whitebackgroundcolorfordropdown" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" onclick="chooseprojectstatus(this,event);" id=0></a>
										<a class="dropdown-item" onclick="chooseprojectstatus(this,event);" id=1>Open</a>
										<a class="dropdown-item" onclick="chooseprojectstatus(this,event);" id=2>OnHold</a>
										<a class="dropdown-item" onclick="chooseprojectstatus(this,event);" id=3>Closed</a>
									</div>
								</div>
								Project Number:<input type="text" id="textbox_searchprojectbyprojectnumber">
								Project Renewal:<input type="text" id="textbox_searchprojectbyprojectrenewal">
								Project Name:<input type="text" id="textbox_searchprojectbyprojecttitle">
								User Name:<input type="text" id="textbox_searchprojectbyuser">
								PO No. :<input type="text" id="textbox_searchprojectbypo">
								Start Date On or After: <input type="text" name ="projectstartfrom" onclick="displayDatePicker('projectstartfrom');" id="textbox_searchprojectbyprojectstartfrom">
								Start Date Before:<input type="text" name ="projectstartto" onclick="displayDatePicker('projectstartto');" id="textbox_searchprojectbyprojectstartto">
								<input type="button" value="Search" onclick="searchproject();">
							</div>
						</div>
						<div id="maineditarea" class="col-sm-10 " align="left" >
							<div style="margin:10px;">
								<h3>Projects</h3>   
							</div>  
							<div class="row">
								<div class="col-sm-1 nopaddingtablecell_div tableheader" align="center">
									Project No.
								</div>
								<div class="col-sm-1 nopaddingtablecell_div tableheader" align="center">
									Renewal
								</div>
								<div class="col-sm-1 nopaddingtablecell_div tableheader" align="center">
									Type
								</div>   
								<div class="col-sm-1 nopaddingtablecell_div tableheader" align="center">
									Status    
								</div>
								<div class="col-sm-2 nopaddingtablecell_div tableheader" align="center">
									Title
								</div>
								<div class="col-sm-1 nopaddingtablecell_div tableheader" align="center">Start Date</div>
								<div class="col-sm-1 nopaddingtablecell_div tableheader" align="center">End Date</div>
								<div class="col-xs-1 nopaddingtablecell_div tableheader" align="center">Logged Hours</div>
								<div class="col-xs-1 nopaddingtablecell_div tableheader" align="center">Hours Allocated</div>
								<div class="col-sm-1 nopaddingtablecell_div tableheader" align="center"></div>
							</div>
							<div id="projectlistcontainer" class="container-fluid" style="height:500px;overflow-y: scroll">
								<div class="row" v-for="project in projects" :key="project.project_id">
									<div class="col-sm-1 nopaddingtablecell_div" align="left">
										<input type="hidden"   name ="project_id" v-model="project.project_id">
										<input type="hidden"   name ="project_type" v-model="project.project_type">
										<input type="hidden"   name ="project_name" v-model="project.project_name">
										<input type="text" readonly name="project_number"  v-model="project.project_number">
										<input type="hidden"  name ="project_resource_remaininghours" v-model="project.project_resource_remaininghours">
									</div>
									<div class="col-sm-1 nopaddingtablecell_div" align="left">
										<input type="text"  name="project_renewal" readonly v-model="project.project_renewal">
									</div>
									<div class="col-sm-1 nopaddingtablecell_div" align="left">
										<input type="text"  readonly value="'Internal/External'">
									</div>
									<div class="col-sm-1 nopaddingtablecell_div" align="left">
										<input type="text"  readonly v-model="project.project_status">
									</div>
									<div class="col-sm-2 nopaddingtablecell_div" align="left">
										<input type="text"  readonly v-model="project.project_title">
									</div>
									<div class="col-sm-1 nopaddingtablecell_div" align="left">
										<input type="text"  readonly v-model="project.project_start">
									</div>
									<div class="col-sm-1 nopaddingtablecell_div" align="left">
										<input type="text"  readonly v-model="project.project_end">
									</div>
									<div class="col-sm-1 nopaddingtablecell_div" align="left">
										<input type="text"  readonly v-model="project.hours">
									</div>
									<div class="col-xs-1 nopaddingtablecell_div" align="left">
										<input type="text"  readonly v-model="project.project_resource_hours">
									</div>
									<div  class="col-sm-1 nopaddingtablecell_div" align="left" >
										<div v-if="project.project_status=='Open'">
											<a href='#' onclick ="addHourforProjectbyAdmin(this);" ><img border="0" title="Add time entry" src="images/entryhour.png" width="16" height="16"></a>
										</div>
										<div v-if="project.project_status!='Open'">
											<a href='#' ><img border="0" title="Add time entry" src="images/entryhour-disabled.png" width="16" height="16"></a>
										</div>     
										<a href='#'  onclick ="loadproject(this);" ><img border="0" title="View project details" src="images/view-eye.png" width="16" height="16"></a>
										<a href='#'  onclick ="listHourforProject(this);" ><img border="0" title="List project time entries" src="images/listitems.png" width="16" height="16"></a>
										<a href='#'  onclick ="renewProject(this);" ><img border="0" title="Renew Project" src="images/renewProject.png" width="16" height="16"></a>
									</div>  
								</div>
						  </div>
						</div>
					</div>
				</div>  
		  </div>
		</div>
	</div>
</div>
</template>


<script>


  export default {

      data() {
        return {
          projects: [],
          name_str:""
        }
      },
      created() {
      let uri = '/api/project/listproject';
       this.axios.get(uri).then(response => {
         this.projects = response.data;
         console.log(this.projects.length);
      });
      
    }
  }
</script>