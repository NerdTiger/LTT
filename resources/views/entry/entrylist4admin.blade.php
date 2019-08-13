
<div style="margin:10px;">
<h3>Entries</h3>   
</div>
@if(count($entries)>0)
<div class="row">
    <div class="col-sm-2 nopaddingtablecell_div tableheader" align="center">
  ID
    </div>
    <div class="col-sm-2 nopaddingtablecell_div tableheader" align="center">
  Date
    </div>
  <div class="col-sm-2 nopaddingtablecell_div tableheader" align="center">
  Date
    </div>
  <div class="col-sm-1 nopaddingtablecell_div tableheader" align="center">Hours</div>
  <!--<div class="col-sm-1 nopaddingtablecell_div tableheader" align="center">Left</div>-->
  <div class="col-sm-2 nopaddingtablecell_div tableheader" align="center">Details</div>
  
  <div class="col-sm-1 nopaddingtablecell_div tableheader" align="center"></div>
</div>
<div id="entrylistcontainer" class="container-fluid" style="height:500px;overflow-y: scroll">
@foreach($entries as $ent )

<div class="row" >
 
 <div class="col-sm-1 nopaddingtablecell_div" align="left">
 <input type="text"  class="form-control" name ="entry_id" value="{{$ent['entry_id']}}" >
  
 </div>
 <div class="col-sm-2 nopaddingtablecell_div" align="left">
 <input type="text" class="form-control" name ="entry_username" readonly value="{{$ent['entry_date']}}">
 </div>
 <div class="col-sm-2 nopaddingtablecell_div" align="left">
 <input type="text" class="form-control" name ="project_resource_comment" readonly value="{{$ent['entry_hours']}}">
 </div>
    
  <div class="col-sm-2 nopaddingtablecell_div" align="left">
 <input type="text" class="form-control" readonly name ="entry_details" value="{{$ent['entry_details']}}">
 </div>

 
 
</div>
  
@endforeach  
</div>

    @endif


  




        
