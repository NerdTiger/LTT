@extends('master')

    @section('leftsidefunctions')

@switch(Session::get('usertype'))
@case(3)
<div style="margin-top: 5px;margin-left: 4px;">
<ul class="nav flex-column">
  <li class="nav-item">
    <input type="button" value="List" onclick="loadprojectlist();">
  </li>
</ul>
</div>
<div style="margin-top: 50px;margin-left: 4px;">
    Project Number:<input type="text" id="textbox_searchprojectbyprojectnumber">
    Project Renewal:<input type="text" id="textbox_searchprojectbyprojectrenewal">
    Project Name:<input type="text" id="textbox_searchprojectbyprojecttitle">
    User Name:<input type="text" id="textbox_searchprojectbyuser">
    PO No. :<input type="text" id="textbox_searchprojectbyPO">
    Start Date On or After: <input type="text" name ="projectstartfrom" onclick="displayDatePicker('projectstartfrom');" id="textbox_searchprojectbyprojectstartfrom">
    Start Date Before:<input type="text" name ="projectstartto" onclick="displayDatePicker('projectstartto');" id="textbox_searchprojectbyprojectstartto">
      <input type="button" value="Search" onclick="searchproject();">
</div>
@break 
       @case(5)
       {{Session::get('usertype')}}
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
    Project Number:<input type="text" id="textbox_searchprojectbyprojectnumber">
    Project Renewal:<input type="text" id="textbox_searchprojectbyprojectrenewal">
    Project Name:<input type="text" id="textbox_searchprojectbyprojecttitle">
    User Name:<input type="text" id="textbox_searchprojectbyuser">
    PO No. :<input type="text" id="textbox_searchprojectbypo">
    Start Date On or After: <input type="text" name ="projectstartfrom" onclick="displayDatePicker('projectstartfrom');" id="textbox_searchprojectbyprojectstartfrom">
    Start Date Before:<input type="text" name ="projectstartto" onclick="displayDatePicker('projectstartto');" id="textbox_searchprojectbyprojectstartto">
      <input type="button" value="Search" onclick="searchproject();">
</div>
@break

@endswitch
@endsection

    
    
@section('main')
    
    @include('project.projectlist4admin')    
    

        
@endsection
        





