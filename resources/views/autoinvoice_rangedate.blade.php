<!doctype html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sales Beacon Resource Invoice Verification Login</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://timetracker.salesbeacon.com/css/mdina-worx.css" rel="stylesheet" type="text/css" />
        <!-- <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" /> -->
        <SCRIPT LANGUAGE="JavaScript">
		function checkAllProjects() //checks & unchecks elements in a DIV: contractorlist
			{
				var collection = document.getElementById('contractorlist').getElementsByTagName('input');
				//alert(collection.length);
				for (var x=0; x<collection.length; x++) 
					{
						if (collection[x].type.toUpperCase()=='CHECKBOX')
							{
								if (collection[x].checked == true)//if it is checked, uncheck-it
									{
										collection[x].checked = false;
										//document.contractor.Check_All.value="Check All
										document.getElementById('Check_All').value="Check All
									}
									
								else //if it is not checked, check it
									{
										collection[x].checked = true;
										//document.contractor.Check_All.value="UnCheck All
										document.getElementById('Check_All').value="Uncheck All
									}
							}
					}
			}	

		</script>
        <script src="https://timetracker.salesbeacon.com/java/date_picker.js" language="javascript"></script>
        <img src='https://timetracker.salesbeacon.com/images/mdina_logo_time_tracking.jpg'>
        <!-- <meta name="csrf-token" value="{{ csrf_token() }}" /> -->
        
                <!-- Styles -->
                <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

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
            .col-sm-left{
                text-align:left;
                padding-left:0;
            }
        </style>
    </head>
    <body>
        <div id="app">
        
                <div class="content">
                
                <div id='showrange' name='showrange' style='display:block'>
                <b>
                <a href="{{ route('index_monthly') }}"> Click here to generate a Monthly Report</a>
               
                <form action="{{ route('listusers_rangedate') }}" method='post' >
                @csrf
                </b><br />
                <b><p>
                <select name='usertypeselect1'>
                <option value='0'></option>
                    @foreach($resource_types as $resource_type)
                        @if (isset($usertypeselect1)&& $usertypeselect1===$resource_type->resource_status)
                        <option value="{{$resource_type->resource_status}}" selected>{{$resource_type->resource_status}} </option>
                        
                        @else
                        <option value="{{$resource_type->resource_status}}" >{{$resource_type->resource_status}} </option>
                        @endif
                    @endforeach
                    </select>    
                @if(isset($start_date) && isset($end_date))
                From:</b> <input type="text" onclick="displayDatePicker('FromDate');" value="{{$start_date}}" maxlength="12" size="10" name="FromDate"> 
                <b>To:</b> <input type="text" onclick="displayDatePicker('ToDate');" value="{{$end_date}}" maxlength="12" size="10" name="ToDate">
                @else
                    From:</b> 
                <input type="text" onclick="displayDatePicker('FromDate');" value="Start Date" maxlength="12" size="10" name="FromDate"> 
                <b>
                To:</b> 
                <input type="text" onclick="displayDatePicker('ToDate');" value="End Date" maxlength="12" size="10" name="ToDate">
                @endif
                    <input type='submit' onclick='document.getElementById("monthselect").value=""' value='Apply Range Filter'></p>
                    <br /><font color = 'red'>Please click "Apply Range Filter" to make your range selection</font>
                    </form>
                    </div>
            
                </p>
            
            <div name='contractorlist' id='contractorlist'>
                <form action="{{ route('generateinvoice_rangedate') }}" method='post' name='contractor' id='contractor'>
                @csrf

                    @if(isset($start_date))
                    <input type='hidden' name ='FromDate' value='{{$start_date}}'>
                    @endif
                    @if(isset($end_date))
                    <input type='hidden' name ='ToDate' value='{{$end_date}}'>
                    @endif

                    @if(isset($usertypeselect1)) 
                    <input type='hidden' name ='usertypeselect1' value='{{$usertypeselect1}}'>
                    @endif

                    @if(isset($user_rows))
                    <div class="container">
                        <div class="row">Generate Invoice Mail to</div>
                        <div class="row">
                            <div class="col-2 col-sm-left" >
                            Contractor Only<input type="radio" name="invoiceto" value="Contractor Only"> 
                            </div>
                            <div class="col-2">
                            Sales Beacon Only<input type="radio" name="invoiceto" value="Sales Beacon Only"> 
                            </div>
                            <div class="col-2">
                            Both<input type="radio" name="invoiceto" value="Both"> 
                            </div>
                            <div class="col-6"></div>
                        </div>
                    </div>
                    <br/>                    <br/><br/>
                    <div class="container">
                        
                    @foreach($user_rows as $user_row)
                        <div class="row">
                            <div class="col-4">
                            <input type='checkbox' name='check_list[]' id='{{$user_row->user_id}}' value='{{$user_row->user_id}}-{{$user_row->user_name}}-{{$user_row->user_lastname}}-{{$user_row->user_email}}'>{{$user_row->user_name}} {{$user_row->user_lastname}}
                            </div>
                            <div class="col-1">
                            {{$user_row->resource_status}}
                            </div>
                            <div class="col-10"></div>
                        </div>
                    @endforeach
                    <div class="row"><input type='submit' value='Generate'></div>
                    </div>
                    @endif
                    
                    <br>
                    <!-- <input type='button' id='Check_All' value='Check All' name='Check_All' onclick='checkAllProjects()'> -->
                    </form>               
            </div>

                    

            </div>
  
        </div>
    </body>
</html>
