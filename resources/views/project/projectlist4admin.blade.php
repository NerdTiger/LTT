
<div style="margin:10px;">
<h3>Projects</h3>   
</div>
@if(count($projects)>0)
<div class="row">
  <div class="col-sm-1 nopaddingtablecell_div tableheader" align="center">
    Project No.
    </div>
  <div class="col-sm-1 nopaddingtablecell_div tableheader" align="center">
  Renewal
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
@foreach($projects as $proj )


<div class="row" >
<div class="col-sm-1 nopaddingtablecell_div" align="left">
 <input type="hidden"  class="form-control" name ="project_id" value="{{$proj->project_id}}">
 <input type="hidden"  class="form-control" name ="project_type" value="{{$proj->project_type}}" >
 <input type="hidden"  class="form-control" name ="project_name" value="{{$proj->project_title}}" >
 <input type="text" readonly name="project_number" class="form-control" value="{{$proj->project_number}}" >
 <input type="hidden"  name ="project_resource_remaininghours" value="n/a">
 </div>
 <div class="col-sm-1 nopaddingtablecell_div" align="left">
 <input type="text" class="form-control" name="project_renewal" readonly value="{{$proj->project_renewal}}">
 </div> {{--sprintf("%02d", $project_renewal)--}}
 <div class="col-sm-1 nopaddingtablecell_div" align="left">
  <input type="text" class="form-control" readonly value="{{$proj->project_status}}">
 </div>

    <div class="col-sm-2 nopaddingtablecell_div" align="left">
 <input type="text" class="form-control" readonly value="{{$proj->project_title}}">
 </div>



 <div class="col-sm-1 nopaddingtablecell_div" align="left">
 <input type="text" class="form-control" readonly value="{{$proj->project_start}}">
 </div>
 <div class="col-sm-1 nopaddingtablecell_div" align="left">
 <input type="text" class="form-control" readonly value="{{$proj->project_end}}">
 </div>
 <div class="col-sm-1 nopaddingtablecell_div" align="left">
 <input type="text" class="form-control" readonly value="{{$proj->loggedhours}}">
 </div>
 <div class="col-xs-1 nopaddingtablecell_div" align="left">
 <input type="text" class="form-control" readonly value="{{$proj->allocatedhours}}">
 </div>
 
 <div  class="col-sm-1 nopaddingtablecell_div" align="left" >
 @if($proj->project_status=='1')
     <a href='#' onclick ="addHourforProjectbyAdmin(this);" ><img border="0" title="Add time entry" src="images/entryhour.png" width="16" height="16"></a>
 @else
   <a href='#' ><img border="0" title="Add time entry" src="images/entryhour-disabled.png" width="16" height="16"></a>
   @endif
     <a href='#'  onclick ="loadproject(this);" ><img border="0" title="View project details" src="images/view-eye.png" width="16" height="16"></a>
     <a href='#'  onclick ="listHourforProject(this);" ><img border="0" title="List project time entries" src="images/listitems.png" width="16" height="16"></a>
     <a href='#'  onclick ="renewProject(this);" ><img border="0" title="Renew Project" src="images/renewProject.png" width="16" height="16"></a>
 </div> 
 
</div>
  
@endforeach  
</div>

    @endif


  




        
