
function showTab(n) {

    var x = document.getElementsByClassName("tab");
    
    x[n].style.display = "block";
    //... and fix thahahe Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n >= (x.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Submit";
      /*  if($('#assignresourcebutton').length==0){
      var assignbutton=document.createElement('button');
      assignbutton.innerHTML='Assign Resource';
      assignbutton.id="assignresourcebutton";
          assignbutton.onclick=function(){
          assignbutton.innerHTML='Next';
          nextPrev(1);
          return false;
      }
          document.getElementById("nextBtn").parentNode.appendChild(assignbutton);
      }*/
      if (n == (x.length - 1)) {
          $('#assignresourcebutton').css('display','none');
      }else{
          $('#assignresourcebutton').css('display','block');
      }
      
    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
      $('#assignresourcebutton').css('display','none');
    }
    
    fixStepIndicator(n)
  }
  
  function nextPrev(n) {
      
    var x = document.getElementsByClassName("tab");
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
      // ... the form gets submitted:
      saveform();
      return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
  }
  
  function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
      // If a field is empty...
      if (y[i].value == "") {
        // add an "invalid" class to the field:
        y[i].className += " invalid";
        // and set the current valid status to false
        valid = false;
      }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
      document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
  }
  
  function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
  }
  
  function saveform(){
      var form = $("#addprojectForm");
      var url = form.attr('action');
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  },
  data: form.serialize(),
  error:function(err){alert(err.responseText);}
  });  
      
  }
  
  function loadprojectlist(){
      var url = "FC_dispatcher.php?controller=project&action=loadprojectlist";
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  },
  error:function(err){alert(err.responseText);}
  });  
      
  }
  
  
  
  function addPOnumbersforproject(thiselement){
      var url = "FC_dispatcher.php?controller=project&action=addPOnumbersforproject";
      //if projectnumber invalid, return false;
      projectid=$("form").find("input[name='project_id']").val();
      projectnumber=$("form").find("input[name='project_number']").val();
      projectrenewal=$("form").find("input[name='project_renewal']").val();
      projectaction=$("input[name='project_action']").val();
  
       if(typeof projectid === 'undefined' || projectid == 0)return false;
      //var data='project_id='+projectid;
      var data={
          "project_id":projectid,
          "project_number":projectnumber,
          "project_renewal":projectrenewal,
          "project_action":projectaction
  
          
      };
      
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
      document.getElementById("addresourceandposcontainer").innerHTML=result;
      $("#addresourceandposcontainer").dialog({
          autoOpen: true,
          modal: true,
          width:400,
          closeText:'X',
          resizable: false,
          bgiframe:true,
          title:'add PO',
          close: function (event, ui) {
            $("#addresourceandposcontainer form").remove();
            $(this).dialog('destroy');}
      });
  },
  data:data,
  error:function(err){alert(err.responseText);}
  });  
  }
  
  function checkuncheckallresourceforproject(checked){
      $("#resourcelistcontainer input").not("#allcheck").prop('checked',checked);
  }
  function checkuncheckallPOforproject(checked){
      $("#POnumberlistcontainer input").not("#allcheckPOs").prop('checked',checked);
  }
  function removeresourceforproject(){
     var prid=[];
     $("#resourcelistcontainer input:checked").not("#allcheck").each(function(i,val){
          prid.push($(this).next().val());
      });
      
      
       var url = "FC_dispatcher.php?controller=project&action=removeresourceforproject";
  
      projectid=$("input[name='project_id']").val();
      projecttype=$("[name='project_type']").val();
      projectaction=$("[name='project_action']").val();
       if(typeof projectid === 'undefined' || projectid == 0)return false;
      
      data={
          "project_id":projectid,
          prid:prid,
          "project_action":projectaction,
      };
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  //alert(result);
  document.getElementById("resourcelistcontainer").innerHTML=result;
  },
  data:data,
  error:function(err){alert(err.responseText);}
  });  
  
  }
  function assignresourceforproject(thiselement){ 
      var url = "FC_dispatcher.php?controller=project&action=assignresourceforproject";
      //if projectnumber invalid, return false;
      projectid=$("[name='project_id']").val();
      projecttype=$("[name='project_type']").val();
      projectnumber=$("[name='project_number']").val();
      projectrenewal=$("[name='project_renewal']").val();
      projectaction=$("[name='project_action']").val();
      project_original_hours=$("[name='project_original_hours']").val();
      console.log('assignresourceforproject');
      
      if(typeof projectid === 'undefined' || projectid == 0)return false;
      console.log(projectid);
      
      var data={
          "project_id":projectid,
          "project_number":projectnumber,
          "project_renewal":projectrenewal,
          "projecttype":projecttype,
          "project_action":projectaction,
          "project_original_hours":project_original_hours
      };
      
      
      // AJAX Code To Submit Form.
      $.ajax({
      type: "POST",
      dataType: "text",
      url: url,
      cache: false,
      success: function(result){
      document.getElementById("addresourceandposcontainer").innerHTML=result;
      bindcombox();
      
      var orig_hour=0,remaininghours = 0;

      var orisource=$('input[name="orisource"]').val();
      if(orisource=='ed') {

        remaininghours=$('input[name="project_remaining_hours"]').val();
    
      $("label[name='tmp_project_remaining_hours']").text(Number(remaininghours));
    }
        else   {
            orig_hour=getlocalvar('ori-hours');

        var sum_allocated_hours = $('input[name="project_sum_allocated_hours"]').val();
        //console.log(Number(orig_hour));console.log(Number(sum_allocated_hours));
      $("label[name='tmp_project_remaining_hours']").text(Number(orig_hour)-Number(sum_allocated_hours));
        }
  
      
      $("#addresourceandposcontainer").dialog({
          autoOpen: true,
          modal: true,
          width:400,
          closeText:'X',
          resizable: false,
          bgiframe:true,
          title:'assign resource',
          close: function (event, ui) {
            $("#addresourceandposcontainer form").remove();
            $(this).dialog('destroy');}
      });
      
      },
      data:data,
      error:function(err){alert(err.responseText);}
      });  
  }
  function loadproject(thisitem){
  
      project_id=$(thisitem).parent().parent().find("input[name='project_id']").val();
      projecttype=$(thisitem).parent().parent().find("input[name='project_type']").val();
      if(typeof project_id === 'undefined' || project_id == 0)return false;
      var url = "FC_dispatcher.php?controller=project&action=loadproject";
      var data='project_id='+project_id;
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  //alert(result);
  document.getElementById("maineditarea").innerHTML=result;
  
  },
  data:data,
  error: function (xhr, ajaxOptions, thrownError) {
             console.log(xhr.status);
             console.log(xhr.responseText);
             console.log(thrownError);
         }
  });  
      
  }
  function viewproject(){
      //alert($(thisitem).parent().parent().children("input[name='project_id']").length);
      projectid=$("form").find("input[name='project_id']").val();
      
      if(typeof projectid === 'undefined' || projectid == 0)return false;
      
      var url = "FC_dispatcher.php?controller=project&action=loadproject";
      var data='project_id='+projectid;
      
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  //alert(result);
  document.getElementById("maineditarea").innerHTML=result;
  
  },
  data:data,
  error:function(xhr, ajaxOptions, thrownError){
      console.log(xhr);
      console.log(ajaxOptions);
      console.log(thrownError);
  
  
  }
  });  
      
  }
  function searchproject(){
      //console.log(window.location.href);
      //alert(window.location.href);
      
      projectnumber=$("#textbox_searchprojectbyprojectnumber").val();
      projectrenewal=$("#textbox_searchprojectbyprojectrenewal").val();
      projecttitle=$("#textbox_searchprojectbyprojecttitle").val();
      projectuser=$("#textbox_searchprojectbyuser").val();
      projectpo=$("#textbox_searchprojectbypo").val();
      projectstartfrom=$("#textbox_searchprojectbyprojectstartfrom").val();
      projectstartto=$("#textbox_searchprojectbyprojectstartto").val();

      var url = window.location.href+"/project/searchproject";
      var data=
      {
      "projectnumber":projectnumber,
      "projectrenewal":projectrenewal,
      "projecttitle":projecttitle,
      "projectuser":projectuser,
      "projectpo":projectpo,
      "projectstartfrom":projectstartfrom,
      "projectstartto":projectstartto
      };
  
  // AJAX Code To Submit Form.
  $.ajax(	{
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  },
  data: data,
  error:function(err){alert(err.responseText);}
  });  
  
 //console.log('sdfhdsfhskjfalsdfhla');
  }
  
  
  function savePONumber(){
      var form = $("#addPONumberforprojectForm");
      var url = form.attr('action');
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  context: $(this),
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("POnumberlistcontainer").innerHTML=result;
  
  $("#addresourceandposcontainer form").remove();
  $("#addresourceandposcontainer").dialog( "close" );
  
  },
  data: form.serialize(),
  error:function(err){alert(err.responseText);}
  });  
      
  }
  
  
  function saveresourceassign(){
    const errorMessage='Resource is required.';  
    var selecteduser= $('input[name="project_resource_resource_id"]').val();
    console.log(selecteduser);
    if(selecteduser == 0){
        console.log(errorMessage);
        $('#resourceselecterror').text(errorMessage);
        
        return false;
    
    }
      var form = $("#assignresourceforprojectForm");
      var url = form.attr('action');
    var rt= $('input[name="project_resource_sb_rate"]').val();

    


  
  console.log(rt);
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  context: $(this),
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("resourcelistcontainer").innerHTML=result;
  
  //$("input[name='renew_project_remaining_originalhours']").val(ori_hour);
  
  $("#addresourceandposcontainer form").remove();
  $("#addresourceandposcontainer").dialog("close" );
  console.log('display none');
  
  },
  data: form.serialize(),
  error:function(err){alert(err.responseText);}
  });  
      
  }
  function saveresourceedit(){
      var form = $("#editresourceforprojectForm");
      var url = form.attr('action');
  console.log('saveresourceedit');
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  context: $(this),
  url: url,
  cache: false,
  success: function(result){
  document.getElementById("resourcelistcontainer").innerHTML=result;
  //$("#addresourceandposcontainer").html(''); 20190531 1553
  //$("#addresourceandposcontainer").dialog("destroy");20190531 1553
  $("#addresourceandposcontainer form").remove();
  console.log("#addresourceandposcontainer form");
  $("#addresourceandposcontainer").dialog( "close" );
  console.log("#addresourceandposcontainer close");
  
  },
  data: form.serialize(),
  error:function(err){alert(err.responseText);}
  });  
      
  }
  function loadentriesforuser(){
  
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: "FC_dispatcher.php?controller=entry&action=loadentriesforuser",
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  
  },
  error:function(err){alert(err.responseText);}
  });    
  }
  function saveentryhourbyAdmin(thisitem){
     $(thisitem).attr("disabled", true);
      locOffDate=$("input[name='lockoffdate']").val();
      entryDate=$("input[name='time_entry_date']").val();
    
      if(Date.parse(locOffDate)>=Date.parse(entryDate)){
          proceed = window.confirm('input date is older than lockedoff, proceed?')
          if(proceed == false )return false;
      }
  
      
      var form = $("#addhoursForm");
      var url = form.attr('action');
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  
  },
  data: form.serialize(),
  error:function(err){alert(err.responseText);}
  });
  }
  function saveentryhour(thisitem){
      $(thisitem).attr("disabled", true);
      locOffDate=$("input[name='lockoffdate']").val();
      entryDate=$("input[name='time_entry_date']").val();
    
      if(Date.parse(locOffDate)>=Date.parse(entryDate)){
          lockoffDateReminder();
          //alert("It is not allowed to register hours prior to lock-off date.");
          return false;
      }
  
  
      var form = $("#addhoursForm");
      var url = form.attr('action');
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  
  },
  data: form.serialize(),
  error:function(err){alert(err.responseText);}
  });  
  }
  function saveentryhour_phone(thisitem){
         $(thisitem).attr("disabled", true);
      locOffDate=$("input[name='lockoffdate']").val();
      entryDate=$("input[name='time_entry_date']").val();
    
      if(Date.parse(locOffDate)>=Date.parse(entryDate)){
          lockoffDateReminder();
  
          return false;
      }
  
  
      var form = $("#addhoursForm_phone");
      var url = form.attr('action');
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  
  },
  data: form.serialize(),
  error:function(err){alert(err.responseText);}
  });  
  }
  function listHourforProjectUser(thisitem){
      projectid=$(thisitem).parent().parent().find("input[name='project_id']").val();   
      entry_project_resource=$(thisitem).parent().parent().find("input[name='project_resource_id']").val();   
      if(typeof projectid === 'undefined' || projectid == 0)return false;
      userid=$("#user_id").val();
      
      if(typeof userid === 'undefined' || userid == 0)return false;
  
      var url = "FC_dispatcher.php?controller=entry&action=listHourforProjectUser";
      var data=
      {
      "project_id":projectid,
      "userid":userid,
      "entry_project_resource":entry_project_resource
      };
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  
  },
  data: data,
  error:function(err){alert(err.responseText);}
  });  
  }
  
  function listHourforProjectClientManager(thisitem){
      projectid=$(thisitem).parent().parent().find("input[name='project_id']").val();   
      resource_id=$(thisitem).parent().parent().find("input[name='resource_id']").val();   
      
      //entry_project_resource=$(thisitem).parent().parent().find("input[name='project_resource_id']").val();   
      if(typeof projectid === 'undefined' || projectid == 0)return false;
      //userid=$("#user_id").val();
      
      //if(typeof userid === 'undefined' || userid == 0)return false;
  
      var url = "FC_dispatcher.php?controller=entry&action=listHourforProjectClientManager";
      var data=
      {
      "project_id":projectid,
      "resource_id":resource_id
      };
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  },
  data: data,
  error:function(err){alert(err.responseText);}
  });  
  }
  
  function listHourforProject(thisitem){
      projectid=$(thisitem).parent().parent().find("input[name='project_id']").val();   
      //entry_project_resource=$(thisitem).parent().parent().find("input[name='project_resource_id']").val();   
      if(typeof projectid === 'undefined' || projectid == 0)return false;
      //userid=$("#user_id").val();
      
      //if(typeof userid === 'undefined' || userid == 0)return false;
  
      var url = "FC_dispatcher.php?controller=entry&action=listHourforProject";
      var data=
      {
      "project_id":projectid
      
      };
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  },
  data: data,
  error:function(err){alert(err.responseText);}
  });  
  }
  function listHourforUser(thisitem){
      projectid=$(thisitem).parent().parent().find("input[name='project_id']").val();   
      entry_project_resource=$(thisitem).parent().parent().find("input[name='project_resource_id']").val();   
      if(typeof projectid === 'undefined' || projectid == 0)return false;
      userid=$("#user_id").val();
      
      if(typeof userid === 'undefined' || userid == 0)return false;
  
      var url = "FC_dispatcher.php?controller=entry&action=listHourforUser";
      var data=
      {
      "project_id":projectid,
      "userid":userid,
      "entry_project_resource":entry_project_resource
      };
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  },
  data: data,
  error:function(err){alert(err.responseText);}
  });  
  }
  function addHourforProject(thisitem){
      projectid=$(thisitem).parent().parent().find("input[name='project_id']").val();   
      project_number=$(thisitem).parent().parent().find("input[name='project_number']").val();   
          project_name=$(thisitem).parent().parent().find("input[name='project_name']").val();   
      project_renewal=$(thisitem).parent().parent().find("input[name='project_renewal']").val();   
  
      project_resource_remaininghours=$(thisitem).parent().parent().find("input[name='project_resource_remaininghours']").val();   
      entry_project_resource=$(thisitem).parent().parent().find("input[name='project_resource_id']").val();   
      if(typeof projectid === 'undefined' || projectid == 0)return false;
      userid=$("#user_id").val();
      
      if(typeof userid === 'undefined' || userid == 0)return false;
  
      var url = "FC_dispatcher.php?controller=entry&action=addHourforProject";
      var data=
      {
      "project_id":projectid,
      "project_number":project_number,
      "project_name":project_name,
      "project_renewal":project_renewal,
      "userid":userid,
      "entry_project_resource":entry_project_resource,
      "project_resource_remaininghours":project_resource_remaininghours
      };
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  //alert(result);
  document.getElementById("maineditarea").innerHTML=result;
  },
  data: data,
  error:function(err){alert(err.responseText);}
  });  
  }
  
  
  function loadaddproject(){
  var url = "FC_dispatcher.php?controller=project&action=loadaddproject";
      
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  //alert(result);
  document.getElementById("maineditarea").innerHTML=result;
  
  displayfirsttab();
  bindcombox();
  },
  
  error:function(xhr, ajaxOptions, thrownError){
      console.log(xhr);
      console.log(ajaxOptions);
      console.log(thrownError);
  }
  });
  
  displayfirsttab();
  }
  //resource assign page js
   function chooseresourcename (thisitem,e){
  $("input[name='project_resource_id']").val(thisitem.id);
  $("#dropdownMenuButton_project_resource_name").text($(thisitem).text());
  e.preventDefault();
  };
  function chooseprojectlead(thisitem,e){
  $("input[name='project_resource_project_lead']").val(thisitem.id);
  $("#dropdownMenuButton_projectlead").text($(thisitem).text());
  e.preventDefault();
  };
  
  
  function choosebonustype(thisitem,e){
  
    $("input[name='project_resource_is_bonus']").val(thisitem.id);
    $("#dropdownMenuButton_isbonus").text($(thisitem).text());
    
    //loadaddprojectByType();
    e.preventDefault();
    };
  function chooseprojecttype(thisitem,e){
  
  $("input[name='project_type']").val(thisitem.id);
  $("#dropdownMenuButton_projecttype").text($(thisitem).text());
  
  if($(thisitem).text()=='Internal'){
      //$("[class='hideforinternalproject']").css('display','none');
      $(".hideforinternalproject").css('display','none');
      
  }else
  {
     $("[class='hideforinternalproject']").css('display','block');
  }
  e.preventDefault();
  };
  
  function chooseprojecttype2(thisitem,e){
  
  $("input[name='project_type']").val(thisitem.id);
  $("#dropdownMenuButton_projecttype").text($(thisitem).text());
  
  loadaddprojectByType();
  
  e.preventDefault();
  
  
  };
  function chooseprojecttype3(thisitem,e){
  
  $("input[name='project_type']").val(thisitem.id);
  $("#dropdownMenuButton_projecttype").text($(thisitem).text());
  
  
  e.preventDefault();
  
  
  };
  function loadaddingexternalproject(){
      var url = "FC_dispatcher.php?controller=project&action=loadaddproject";
      
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  //alert(result);
  document.getElementById("maineditarea").innerHTML=result;
  displayfirsttab();
  bindcombox();
  },
  
  error:function(err){alert(err.responseText);}
  });
  
  displayfirsttab();
  }
  
  
  
  function addHourforProjectbyAdmin(thisitem){
      projectid=$(thisitem).parent().parent().find("input[name='project_id']").val();   
      project_number=$(thisitem).parent().parent().find("input[name='project_number']").val();   
      project_name=$(thisitem).parent().parent().find("input[name='project_name']").val();   
      project_renewal=$(thisitem).parent().parent().find("input[name='project_renewal']").val();   
      project_type = $(thisitem).parent().parent().find("input[name='project_type']").val();   
      project_resource_remaininghours=$(thisitem).parent().parent().find("input[name='project_resource_remaininghours']").val();   
      //entry_project_resource=$(thisitem).parent().parent().find("input[name='project_resource_id']").val();   
      if(typeof projectid === 'undefined' || projectid == 0)return false;
      
      
      
  
      var url = "FC_dispatcher.php?controller=project&action=addHourforProjectbyAdmin";
      var data=
      {
      "project_id":projectid,
      "project_number":project_number,
      "project_renewal":project_renewal,
      "project_name":project_name,
      "project_type":project_type,
      "project_resource_remaininghours":project_resource_remaininghours
      };
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  },
  data: data,
  error:function(err){alert(err.responseText);}
  });  
  
  }
  
  
  
  function addHourforProjectbyClientManager(thisitem){
      projectid=$(thisitem).parent().parent().find("input[name='project_id']").val();   
      project_number=$(thisitem).parent().parent().find("input[name='project_number']").val();   
      project_name=$(thisitem).parent().parent().find("input[name='project_name']").val();   
      project_clientmanager_id=$(thisitem).parent().parent().find("input[name='project_clientmanager_id']").val();   
      resource_id=$(thisitem).parent().parent().find("input[name='resource_id']").val();   
      resource_name=$(thisitem).parent().parent().find("input[name='resource_name']").val();   
      project_resource_id=$(thisitem).parent().parent().find("input[name='project_resource_id']").val();  
       project_resource_remaininghours=$(thisitem).parent().parent().find("input[name='project_resource_remaininghours']").val();  
      
      //entry_project_resource=$(thisitem).parent().parent().find("input[name='project_resource_id']").val();   
      if(typeof projectid === 'undefined' || projectid == 0)return false;
      
      
      
  
      var url = "FC_dispatcher.php?controller=project&action=addHourforProjectbyClientManager";
      var data=
      {
      "project_id":projectid,
      "project_number":project_number,
      "project_name":project_name,
      "project_clientmanager_id":project_clientmanager_id,
      "resource_id":resource_id,
      "resource_name":resource_name,
      "project_resource_remaininghours":project_resource_remaininghours,
      "project_resource_id":project_resource_id
      };
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  },
  data: data,
  error:function(err){alert(err.responseText);}
  });  
  
  }
  
  
  
  
  function loadaddprojectByType(){
  
      var url = "FC_dispatcher.php?controller=project&action=loadaddprojectByType";
          var form = $("Form");
      //var url = form.attr('action');
  
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  //alert(result);
  document.getElementById("maineditarea").innerHTML=result;
  displayfirsttab();
  bindcombox();
  },
  data: form.serialize(),
  error:function(err){alert(err.responseText);}
  });
  
  displayfirsttab();
  }
  
  function chooseclientmanager (thisitem,e){
  $("input[name='project_resource_project_client_manager']").val(thisitem.id);
  $("#dropdownMenuButton_projectclientmanager").text($(thisitem).text());
  e.preventDefault();
  };
  function chooseprojectfunctionalarea (thisitem,e){
  $("input[name='project_functional_area']").val(thisitem.id);
  $("#dropdownMenuButton_projectfunctionalarea").text($(thisitem).text());
  e.preventDefault();
  };
  
  
  function chooseprojectcompany(thisitem,e){
  $("input[name='project_company']").val(thisitem.id);
  $("input[name='project_company_name']").val($(thisitem).text());
  $("#dropdownMenuButton_project_company").text($(thisitem).text());
  e.preventDefault();
  };
  function chooseprojectpayee(thisitem,e){
  $("input[name='project_payee']").val(thisitem.id);
  $("input[name='project_payee_name']").val($(thisitem).text());
  $("#dropdownMenuButton_project_payee").text($(thisitem).text());
  e.preventDefault();
  };
  
  function chooseprojectdepartment(thisitem,e){
  $("input[name='project_department']").val(thisitem.id);
  $("#dropdownMenuButton_projectdepartment").text($(thisitem).text());
  e.preventDefault();
  };
  function chooseprojectdepartmentmanager(thisitem,e){
  $("input[name='project_departmentmanager']").val(thisitem.id);
  $("#dropdownMenuButton_projectdepartmentmanager").text($(thisitem).text());
  e.preventDefault();
  };
  function chooseprojectinternalprojecttype(thisitem,e){
  $("input[name='project_internalprojecttype']").val(thisitem.id);
  $("#dropdownMenuButton_projectinternalprojecttype").text($(thisitem).text());
  e.preventDefault();
  };
  
  
  function chooseprojectpracticearea (thisitem,e){
  //jQuery("#dropdown_projectpracticearea [class='dropdown-item']").click(function(e){
  $("input[name='project_practice_area']").val(thisitem.id);
  $("input[name='project_practice_area_name']").val($(thisitem).text());
  $("#dropdownMenuButton_projectpracticearea").text($(thisitem).text());
  e.preventDefault();
  };
  function chooserole (thisitem,e){
      $("input[name='project_resource_role']").val(thisitem.id);
      $("#dropdownMenuButton_respurcerole").text($(thisitem).text());
      e.preventDefault();
      };
  function chooseprojectcurrency(thisitem,e){
  
  $("input[name='project_currency']").val($(thisitem).text());
  $("#dropdownMenuButton_projectcurrency").text($(thisitem).text());
  e.preventDefault();
  };
  function chooseprojectPOtype(thisitem,e){
  
  $("input[name='purchase_order_type_id']").val(thisitem.id);
  $("#dropdownMenuButton_purchase_order_type").text($(thisitem).text());
  e.preventDefault();
  };
  
  function chooseprojectsalesbeaconcompany(thisitem,e){
  
  $("input[name='project_salesbeacon_company']").val(thisitem.id);
  $("input[name='project_salesbeacon_company_name']").val($(thisitem).text());
  $("#dropdownMenuButton_project_salesbeacon_company").text($(thisitem).text());
  e.preventDefault();
  };
  
  
  function chooselocation(thisitem,e){
  
  $("input[name='project_location']").val(thisitem.id);
  $("input[name='project_location_name']").val($(thisitem).text());
  $("#dropdownMenuButton_project_location").text($(thisitem).text());
  e.preventDefault();
  };
  
  
  function chooseprojectciscoratecard(thisitem,e){
  
  $("input[name='project_cisco_rate_card']").val(thisitem.id);
  $("#dropdownMenuButton_project_ciscoratecard").text($(thisitem).text());
  e.preventDefault();
  };
  
  
  function chooseprojectstatus(thisitem,e){
  
  $("input[name='project_status']").val(thisitem.id);
  $("#dropdownMenuButton_projectstatus").text($(thisitem).text());
  e.preventDefault();
  };
  
  
  function chooseprojectscheduled(thisitem,e){
  
  $("input[name='project_scheduled']").val(thisitem.id);
  $("#dropdownMenuButton_project_scheduled").text($(thisitem).text());
  e.preventDefault();
  };
  function chooseresourcetoaddhourbyadmin(thisitem,e,lefthours){
  $("input[name='entry_project_resource']").val(thisitem.id);
  $("#dropdownMenuButton_project_resource_name").text($(thisitem).text());
  $("div[name='project_remaining_hours']").text(lefthours);
  
  $('form').find("button[name='save']").prop('disabled', false);
  
  e.preventDefault();
  }
  
  var currentTab = 0; // Current tab is set to be the first tab (0)
  function displayfirsttab(){
  currentTab = 0;
  showTab(currentTab); // Display the crurrent tab
  }
  
  function hoursThisMonth(){
  
  
      var url = "FC_dispatcher.php?controller=entry&action=hoursThisMonth";
      //var url = form.attr('action');
  
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "GET",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  //alert(result);
  document.getElementById("maineditarea").innerHTML=result;
  displayfirsttab();
  
  },
  
  error:function(err){alert(err.responseText);}
  });
  }
  
  function deleteentryforAdmin(thisitem){
      if(!confirm('are you sure to delete?'))return false;;
      var url = "FC_dispatcher.php?controller=entry&action=deleteEntryforAdmin";
      entryid=$(thisitem).parent().parent().find("input[name='entry_id']").val();
       if(typeof entryid === 'undefined' || entryid == 0)return false;
      var data='entryid='+entryid;
      
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  },
  data:data,
  error:function(err){alert(err.responseText);}
  });  
  }
  
  function deleteentry(thisitem){
      
      if(!confirm('are you sure to delete?'))return false;;
      var url = "FC_dispatcher.php?controller=entry&action=deleteentry";
      entryid=$(thisitem).parent().parent().find("input[name='entry_id']").val();
       if(typeof entryid === 'undefined' || entryid == 0)return false;
      var data='entryid='+entryid;
      
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  },
  data:data,
  error:function(err){alert(err.responseText);}
  });  
  }
  function maketextboxeditable(itself){
      console.log('201905301031');
      canceltextboxedita($('.editedrow').children().next().children().next());
      $('.editedrow').removeClass('editedrow');
      //alert($('.editedrow').length);
      $(itself).parent().parent().addClass("editedrow");
      $(itself).parent().parent().parent().find(':text').not('[name="project_number"],[name="project_renewal"]').attr('readonly',false);
      $(itself).parent().css('visibility','hidden');
      $(itself).parent().next().css('display','contents');
      
      
  }
  function makeTextboxEditableforAdminEntry(itself){
      canceltextboxedita($('.editedrow').children().next().children().next());
      $('.editedrow').removeClass('editedrow');
      //alert($('.editedrow').length);
      $(itself).parent().parent().addClass("editedrow");
      $(itself).parent().parent().parent().find(':text').not('[name="project_number"],[name="project_renewal"]').attr('readonly',false);
      $(itself).parent().css('visibility','hidden');
      $(itself).parent().next().css('display','contents');
      
      
  }
  function canceltextboxedita(itself){
      $(itself).parent().parent().parent().find(':text').attr('readonly',true);
      $(itself).parent().css('display','none');
      $(itself).parent().prev().css('visibility','visible');
  }
  
      
      function saveentryforAdmin (thisitem){
      entryDate=$(thisitem).parent().parent().parent().find("div.popup input").val();
      locOffDate=$("input[name='lockoffdate']").val();
      if(Date.parse(locOffDate)>=Date.parse(entryDate)){
          proceed = window.confirm('input date is older than lockedoff, proceed?')
          if(proceed == false )return false;
      }
  
      
      var url = "FC_dispatcher.php?controller=entry&action=editEntryforAdmin";
      entryid=$(thisitem).parent().parent().parent().find("input[name='entry_id']").val();
      entry_details=$(thisitem).parent().parent().parent().find("input[name='entry_details']").val();
      entry_date=$(thisitem).parent().parent().parent().find("input[name^='entry_date']").val();
      entry_hour=$(thisitem).parent().parent().parent().find("input[name='entry_hour']").val();
      
       if(typeof entryid === 'undefined' || entryid == 0)return false;
      var data='entryid='+entryid;
      data+='&entry_date='+entry_date;
      data+='&entry_hour='+entry_hour;
      data+='&entry_details='+entry_details;
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  },
  data:data,
  error:function(err){alert(err.responseText);}
  });  
  }
  
  function saveentry(thisitem){    
         entryDate=$(thisitem).parent().parent().parent().find("div.popup input").val();
          locOffDate=$("input[name='lockoffdate']").val();
      if(Date.parse(locOffDate)>=Date.parse(entryDate)){
          lockoffDateReminder();
  
          return false;
      }
  
      
      var url = "FC_dispatcher.php?controller=entry&action=editentry";
      entryid=$(thisitem).parent().parent().parent().find("input[name='entry_id']").val();
      entry_details=$(thisitem).parent().parent().parent().find("input[name='entry_details']").val();
      entry_date=$(thisitem).parent().parent().parent().find("input[name^='entry_date']").val();
      entry_hour=$(thisitem).parent().parent().parent().find("input[name='entry_hour']").val();
      
       if(typeof entryid === 'undefined' || entryid == 0)return false;
      var data='entryid='+entryid;
      data+='&entry_date='+entry_date;
      data+='&entry_hour='+entry_hour;
      data+='&entry_details='+entry_details;
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  
  document.getElementById("maineditarea").innerHTML=result;
  },
  data:data,
  error:function(err){alert(err.responseText);}
  });  
  }
  function bindcombox(){
      console.log('combobox is functional');
      $('.combobox').combobox();
  };
  
  
  
  function lockoffDateReminder(){
      var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
    
  }
  
  function renewProject(thisitem){
   //alert($(thisitem).parent().parent().children("input[name='project_id']").length);
      projectid=$(thisitem).parent().parent().find("input[name='project_id']").val();
      projecttype=$(thisitem).parent().parent().find("input[name='project_type']").val();
      
      if(typeof projectid === 'undefined' || projectid == 0)return false;
      
      var url = "FC_dispatcher.php?controller=project&action=renewProject";
  
          var data=
      {
      "project_id":projectid
      };
      
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  //alert(result);
  document.getElementById("maineditarea").innerHTML=result;
  displayfirsttab();
  bindcombox();
  },
  data:data,
  error:function(err){
      console.log(err);
  }
  });  
         
  }
  
  
  function checkRemainingHours(thisitem){
      
      project_resource_hours_old=$('form').find("input[name='project_resource_hours_old']").val();
      project_remaining_hours=$('form').find("input[name='project_remaining_hours']").val();
      input_hours=$(thisitem).val();
      //alert(project_resource_hours_old);alert(project_remaining_hours);alert(input_hours);
      if(isNaN(input_hours)){
          $(thisitem).val(0);
      }
      //alert(Number(project_resource_hours_old)+Number(project_remaining_hours));
      //alert(Number(project_resource_hours_old)+Number(project_remaining_hours)-Number(input_hours));
      num=Number(project_resource_hours_old)+Number(project_remaining_hours)-Number(input_hours);
      if(num<0){    
          
          $(thisitem).val(0);
          $('form').find("button[name='saveeditresource']").prop('disabled', true);
      
      }else {
          $(thisitem).val(input_hours);
      $('form').find("button[name='saveeditresource']").prop('disabled', false);}
  
     }
     
     function checkRemainingHoursforResource(thisitem){
      if(!new RegExp('(^[0-9]{1,}$|[0-9]{1,}.(5|0)$)').test($(thisitem).val())){
          $(thisitem).val(0);
          return;
      }
      //if(!new RegExp('(^[0-9]{1,}$|[0-9]{1,}.(5|0)$)').test(this.value)){alert('only numbers are allow or .5 is the minimum unit');this.value=0;}
      resource_allocated_hours=$('form').find("div[name='project_remaining_hours']").text();
      input_hours=$(thisitem).val();
      if(isNaN(input_hours)){
          $(thisitem).val(0);
      }
      
      if((resource_allocated_hours-input_hours)<0){    
          
          $(thisitem).val(0);
      
      }
   }
   function checkRemainingHours(thisitem){
      
      project_resource_hours_old=$('form').find("input[name='project_resource_hours_old']").val();
      project_remaining_hours=$('form').find("input[name='project_remaining_hours']").val();
      input_hours=$(thisitem).val();
      //alert(project_resource_hours_old);alert(project_remaining_hours);alert(input_hours);
      if(isNaN(input_hours)){
          $(thisitem).val(0);
      }
      //alert(Number(project_resource_hours_old)+Number(project_remaining_hours));
      //alert(Number(project_resource_hours_old)+Number(project_remaining_hours)-Number(input_hours));
      num=Number(project_resource_hours_old)+Number(project_remaining_hours)-Number(input_hours);
      if(num<0){    
          
          $(thisitem).val(0);
          $('form').find("button[name='saveeditresource']").prop('disabled', true);
      
      }else {
          $(thisitem).val(input_hours);
      $('form').find("button[name='saveeditresource']").prop('disabled', false);}
  
     }
     
     
   function checkRemainingHoursforResourceforEdit(thisitem){
      if(!new RegExp('(^[0-9]{1,}$|[0-9]{1,}.(5|0)$)').test($(thisitem).val())){
          $(thisitem).val(0);
          return;
      }
      //if(!new RegExp('(^[0-9]{1,}$|[0-9]{1,}.(5|0)$)').test(this.value)){alert('only numbers are allow or .5 is the minimum unit');this.value=0;}
      resource_remaining_hours=$(thisitem).parent().parent().find("input[name='project_remaining_hours']").val();
      input_hours=$(thisitem).val();
      if(isNaN(input_hours)){
          $(thisitem).val(0);
      }
      
      if((resource_remaining_hours-input_hours)<0){    
          
          $(thisitem).val(0);
      
      }
  
     ;}
  
      function editPos(thisitem){
         var url = "FC_dispatcher.php?controller=project&action=editposforproject";
         project_id=$("form").find("input[name='project_id']").val();
          projecttype=$("[name='project_type']").val();
          project_purchase_order_id=$(thisitem).parent().parent().find("input[name='project_purchase_order_id']").val();
          projectnumber=$("form").find("input[name='project_number']").val();
          projectrenewal=$("form").find("input[name='project_renewal']").val();
          projectaction=$("input[name='project_action']").val();
       if(typeof project_purchase_order_id === 'undefined' || project_purchase_order_id == 0)return false;
      var data={
          "project_id":project_id,
          "project_purchase_order_id":project_purchase_order_id,
          "project_number":projectnumber,
          "project_type":projecttype,
          "project_renewal":projectrenewal,
          "project_action":projectaction
  
      }
      
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
      document.getElementById("addresourceandposcontainer").innerHTML=result;
      $("#addresourceandposcontainer").dialog({
          autoOpen: true,
          modal: true,
          width:400,
          closeText:'X',
          resizable: false,
          bgiframe:true,
          title:'edit PO',
          close: function (event, ui) {
            $("#addresourceandposcontainer form").remove();
            $(this).dialog('destroy');}
      });
  //bindcombox();
  },
  data:data,
  error:function(err){alert(err.responseText);}
  });    
       
   }
   function editResourceAssign(thisitem){
     var url = "FC_dispatcher.php?controller=project&action=editresourceforproject";
      project_resource_id=$(thisitem).parent().parent().find("input[name='project_resource_id']").val();
      project_id=$("form").find("input[name='project_id']").val();
      projectaction=$("[name='project_action']").val();
      projecttype=$("[name='project_type']").val();
      project_original_hours=$("[name='project_original_hours']").val();
       if(typeof project_resource_id === 'undefined' || project_resource_id == 0)return false;
      //var data='projectid='+projectid+'&projecttype='+projecttype;
      var data={
          "project_id":project_id,
          "project_resource_id":project_resource_id,
          "project_action":projectaction,
          "project_type":projecttype,
          "project_original_hours":project_original_hours
      }
      
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
      document.getElementById("addresourceandposcontainer").innerHTML=result;
      bindcombox();


      var orig_hour=0,remaininghours = 0;
      
      var orisource=$('input[name="orisource"]').val();
      if(orisource=='ed') {
        console.log('view routine');
        remaininghours=$('input[name="project_remaining_hours"]').val();
    
      $("label[name='tmp_project_remaining_hours']").text(Number(remaininghours));
    }
        else   {
            console.log('add or renew routine');
            orig_hour=getlocalvar('ori-hours');

        var sum_allocated_hours = $('input[name="project_sum_allocated_hours"]').val();
        console.log(Number(orig_hour));
        console.log(Number(sum_allocated_hours));
      $("label[name='tmp_project_remaining_hours']").text(Number(orig_hour)-Number(sum_allocated_hours));
        }



      $("#addresourceandposcontainer").dialog({
          autoOpen: true,
          modal: true,
          width:400,
          closeText:'X',
          resizable: false,
          bgiframe:true,
          title:'edit resource',
          close: function (event, ui) {
            $("#addresourceandposcontainer form").remove();
            $(this).dialog('destroy');
        
        }
      });
  
  
  },
  data:data,
  error:function(xhr, ajaxOptions, thrownError){
      console.log(xhr);
      console.log(ajaxOptions);
      console.log(thrownError);
  
  }
  });    
       
   }
   function removePOforproject(thisitem){
    
     var poid=[];
     $("#POnumberlistcontainer input:checked").not("#allcheckPOs").each(function(i,val){
          poid.push($(this).next().val());
      });
      
      
       var url = "FC_dispatcher.php?controller=project&action=removePOforproject";
  
      projectid=$("input[name='project_id']").val();
      projectaction=$("input[name='project_action']").val();
      
       if(typeof projectid === 'undefined' || projectid == 0)return false;
      
      data={
          "project_id":projectid,
          poid:poid,
          "project_action":projectaction
      };
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  //alert(result);
  document.getElementById("POnumberlistcontainer").innerHTML=result;
  
  },
  data:data,
  error:function(err){alert(err.responseText);}
  });        
       
   }
   
  function  editProject(){
       var url = "FC_dispatcher.php?controller=project&action=editProject";
  
      projectid=$("input[name='project_id']").val();
      projectnumber=$("input[name='project_number']").val();
      projectrenewal=$("input[name='project_renewal']").val();
      
      
       if(typeof projectid === 'undefined' || projectid == 0)return false;
      
      data={
          "project_id":projectid
      };
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  //alert(result);
  document.getElementById("maineditarea").innerHTML=result;
  $(document).attr("title", "Edit Project "+projectnumber+"."+projectrenewal);
  
  
  $('.combobox').combobox();
  
  
  },
  data:data,
  error:function(err){alert(err.responseText);}
  });     
       
   }
  function saveProjectEdit(thisitem){
      
      var form = $("#editprojectForm");
      var url = form.attr('action');
  
  
  // AJAX Code To Submit Form.
  $.ajax(	{
  type: "POST",
  dataType: "text",
  url: url,
  cache: false,
  success: function(result){
  //alert(result);
  document.getElementById("maineditarea").innerHTML=result;
  
  bindcombox();
  },
  data: form.serialize(),
  error:function(err){alert(err.responseText);}
  });
      
  }   
     
  function checkRemainingHoursforResource_p(thisitem){
      if(!new RegExp('(^[0-9]{1,}$|[0-9]{1,}.(5|0)$)').test($(thisitem).val())){
          $(thisitem).val(0);
          return;
      }
      //if(!new RegExp('(^[0-9]{1,}$|[0-9]{1,}.(5|0)$)').test(this.value)){alert('only numbers are allow or .5 is the minimum unit');this.value=0;}
      resource_allocated_hours=$('form').find("div[name='p_project_remaining_hours']").text();
      input_hours=$(thisitem).val();
      if(isNaN(input_hours)){
          $(thisitem).val(0);
      }
      
      if((resource_allocated_hours-input_hours)<0){    
          
          $(thisitem).val(0);
      
      }
   }
   function halfhourCheck(thisitem){
        val=$(thisitem).val();
       if(!new RegExp('(^[0-9]{1,}$|[0-9]{1,}.(5|0)$)').test(val)){
           alert('only multiples of 1/2 hour can be entered(examples: 0.5, 2.5, 1.0, 3)');
           $(thisitem).val('');
       }
   }
   
  function close_dialog(){
    $("#addresourceandposcontainer").dialog( "close" );   
    $("#addresourceandposcontainer form").remove();
      
  }
  function payeelistchange(itself){
  
      //var userid=$(itself).val();
      var payeeName=$("select[name='payeelist']")[0].value;
  console.log(payeeName);
  }
  
  
  function calculateremaininghours9(item){
    console.log('calculateremaininghours9');  
     //for view
     newvalue=$(item).val();
      var oldvalue= $('input[name="project_resource_hours_old"]').val();
      var remaininghours = $('input[name="project_remaining_hours"]').val();
      //var sum_allocated_hours = $('input[name="project_sum_allocated_hours"]').val();
      
      var allocatablehours=Number(remaininghours)+Number(oldvalue);
      console.log(oldvalue);
      console.log(remaininghours);
      console.log(allocatablehours);
  
     var ret = (allocatablehours-Number(newvalue)).toFixed(1);
     console.log(ret);
     if(ret>=0)   $('label[name="tmp_project_remaining_hours"]').text(ret);
     else {$(item).val(0);
        $('label[name="tmp_project_remaining_hours"]').text(Number(remaininghours));
     }
  
  }
  function calculateremaininghours8(item){
    console.log('calculateremaininghours8');  
     //for renew
     newvalue=$(item).val();
    var oldvalue= $('input[name="project_resource_hours_old"]').val();
    var sum_allocated_hours = $('input[name="project_sum_allocated_hours"]').val();
    
    var ori_hour=getlocalvar('ori-hours');

    var allocatablehours=Number(ori_hour)-Number(sum_allocated_hours)+Number(oldvalue);
    console.log(oldvalue);
    console.log(ori_hour);
    console.log(sum_allocated_hours);
    console.log(allocatablehours);

   var ret = (allocatablehours-Number(newvalue)).toFixed(1);
   console.log(ret);
   if(ret>=0)   $('label[name="tmp_project_remaining_hours"]').text(ret);
   else {$(item).val(0);
    $('label[name="tmp_project_remaining_hours"]').text(Number(ori_hour)-Number(sum_allocated_hours));
}
    

}
  function getlocalvar(var_name){
    console.log('var_value');
    var var_value =  localStorage.getItem(var_name);
    console.log(var_value);
    return var_value;
}


function changeresource(){
    $('input[name=project_resource_resource_id]').val($(':selected').attr('value'));
    $('input[name=project_resource_user_role]').val($(':selected').attr('jobrole'));
    $('input[name=project_resource_sb_rate]').val($(':selected').attr('usercost'));
}