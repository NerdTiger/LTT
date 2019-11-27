<!doctype html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sales Beacon Resource Invoice Verification Login</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


        <!-- <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" /> -->
        <script src="https://timetracker.salesbeacon.com/java/date_picker.js" language="javascript"></script>
        <img src='https://timetracker.salesbeacon.com/images/mdina_logo_time_tracking.jpg'>
        <meta name="csrf-token" value="{{ csrf_token() }}" />
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
            .accessbutton{
            border-radius:.25em;
            background-color:#33b5e5 ;

            }

        </style>
<!-- <script src="{{ asset('js/app.js') }}"></script>         -->
        <!-- <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script> -->


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


        <script type="text/javascript">
        
        function selectAllMailRecipients(thisitem) 
        {
            if(thisitem.value==='Resource Only'){
            var ttt=$('[propid="invoicetoContractorOnly"]');
            ttt.each(function(i,e){
            e.checked=true;
                });
            }
            if(thisitem.value==='Sales Beacon Only'){
            var ttt=$('[propid="invoicetoSalesBeaconOnly"]');
            ttt.each(function(i,e){
            e.checked=true;
                });
            }
            if(thisitem.value==='Both'){
            var ttt=$('[propid="invoicetoBoth"]');
            ttt.each(function(i,e){
            e.checked=true;
                });
            }
        }	
        function selectAllUsers() 
        {
            //console.log(thisitem.value);
            var ttt=$('[name="check_list[]"]');
            ttt.each(function(i,e){
            e.checked=true;
                });

        }	

		</script>        
    </head>
    <body>
        <div id="app">

            <div class="content">                    
                <div style='padding-left:15px;display:block' id = 'monthrange' name = 'monthrange'>
                    <div class="container">
                        <div class="row">
                        <div class="col-3 col-sm-left" >Generate a Monthly Report</div>
                            <div class="col-3 col-sm-left" >
                            <a href="{{ route('index_rangedate') }}" class="btn btn-default accessbutton">Generate a Date Rage report  </a>
                            </b><br />
                            </div>
                            <div class="col-9 col-sm-left" >

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-8 col-sm-left" >
                                <form action="{{ route('listusers_monthly') }}" method='post' >
                                    @csrf
                                    <select name='usertypeselect1[]' class="selectpicker" multiple data-live-search="true">
                                    <option value='0'></option>

                                        @foreach($resource_types as $resource_type)
                                        @if (isset($usertypeselect1)&& array_search($resource_type->resource_status,$usertypeselect1))
                                        <option value="{{$resource_type->resource_status}}" selected>{{$resource_type->resource_status}} </option>
                                        
                                        @else
                                        <option value="{{$resource_type->resource_status}}" >{{$resource_type->resource_status}} </option>
                                        @endif
                                        
                                    @endforeach
                                    </select>


                                    


                                    <b>Select Month:</b>
                                    <select name='date_selection' id='monthselect'>
                                    <option value='0'>Select Month</option>
                                    @foreach($months as $month)
                                    @if (isset($date_selection) && $date_selection===$month)
                                    <!-- <option value='$monthstring' SELECTED>$monthstring</option> -->
                                        <option value='{{$month}}' selected >{{$month}}</option>
                                        @else
                                        <option value='{{$month}}' >{{$month}}</option>
                                        @endif
                                    
                                    @endforeach
                                    </select>
                                    <!-- <input type='button' class="btn btn-primary " onclick='if(document.getElementById("monthselect").value != ""){$("[name=multi_usertypes]").val($(".filter-option-inner-inner").text());this.form.submit();}' value='Filter'> -->
                                    <input type='button' class="btn btn-primary " onclick='if(document.getElementById("monthselect").value != "" && ($(".selectpicker option:selected").length>0)){this.form.submit();}' value='Filter'>
                                </form>
                            </div>
                            <div class="col-4 col-sm-left" >
                            </div>
                        </div>
                    </div>
                </div>
                <div name='contractorlist' id='contractorlist'>
                    <form action="{{ route('generateinvoice_monthly') }}" method='post' name='contractor' id='contractor'>
                    @csrf

                        @if(isset($date_selection))
                        <input type='hidden' name ='date_selection' value='{{$date_selection}}'>
                        
                        @endif
                        @if(isset($usertypeselect1)) 
                        <!-- <input type='hidden' name ='usertypeselect1' value='{{$usertypeselect1}}'> -->
                        @endif

                        @if(isset($user_rows))
                        <div class="container">
                            
                            <div class="row">
                                <div class="col-5 col-sm-left" >Generate Invoice Mail to</div>
                                <div class="col-7">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-3 col-sm-left" >
                                            Resource Only<input type="radio" name="mail_option_all" onclick="selectAllMailRecipients(this)" value="Resource Only"> 
                                            </div>
                                            <div class="col-4">
                                            Sales Beacon Only<input type="radio" name="mail_option_all" onclick="selectAllMailRecipients(this)" value="Sales Beacon Only"> 
                                            </div>
                                            <div class="col-2">
                                            Both<input type="radio" checked name="mail_option_all" onclick="selectAllMailRecipients(this)" value="Both"> 
                                            </div>
                                            <div class="col-3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                                
                        <br/><br/><br/>
                        <div class="container">                            
                        @foreach($user_rows as $user_row)
                            <div class="row">
                                <div class="col-3 col-sm-left">
                                <input type='checkbox' name='check_list[]' id='{{$user_row->user_id}}' value='{{$user_row->user_id}}${{$user_row->user_name}}${{$user_row->user_lastname}}${{$user_row->user_email}}'>{{$user_row->user_name}} {{$user_row->user_lastname}}
                                </div>
                                <div class="col-2">
                                {{$user_row->resource_status}}
                                </div>
                                <div class="col-7">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-3 col-sm-left" >
                                            Resource Only<input type="radio" propid="invoicetoContractorOnly" name="mail_option_{{$user_row->user_id}}" value="Resource Only"> 
                                            </div>
                                            <div class="col-4">
                                            Sales Beacon Only<input type="radio" propid="invoicetoSalesBeaconOnly" name="mail_option_{{$user_row->user_id}}" value="Sales Beacon Only"> 
                                            </div>
                                            <div class="col-2">
                                            Both<input type="radio" checked propid="invoicetoBoth" name="mail_option_{{$user_row->user_id}}" value="Both"> 
                                            </div>
                                            <div class="col-3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        <br>
                        <div class="container">
                            <div class="row">
                                <div class="col-1 col-sm-left">
                                <input type='button' id='Check_All' value='Check All' name='Check_All' onclick='selectAllUsers()'>
                                </div>
                                <div class="col-1 col-sm-left">
                                <div class="row"><input type='submit' value='Generate' onclick="if($('[name=\'check_list[]\']:checked').length=='0') return false;";></div>
                                </div>
                                <div class="col-2">
                                <input type='checkbox' name='summary_report' >Summary Report
                                </div>
                                <div class="col-8 col-sm-left">
                                

                                </div>
                            </div>
                        </div>
                        
                        
                        </div>
                        @endif
                        
                        
                        </form>               
                </div>
            </div>
        </div>
    </body>
</html>
