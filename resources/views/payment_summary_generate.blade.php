<!doctype html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Payment Summary</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <!-- Styles -->
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

            td{padding:0px;
            margin:0px;}
        </style>
    </head>
    <body>
        <div id="app">
            <h1>Payment Summary</h1>
            <hr><br/>
            <div class="content">
                <div style='padding-left:15px;display:block' id = 'monthrange' name = 'monthrange'>
                    <table width='800' border='1'>
                        <tr>
                            <td colspan="2">Invoice Date:{{$invoice_date}}</td>
                            <td colspan="6"></td>
                        </tr>
                        <tr>
                            <td colspan="6"></td>
                            <td  colspan="2">Period:{{$invoice_period}}</td>
                        </tr>

                            @if (isset($CAD_users)&& count($CAD_users)>0)
                        <tr>
                            <td></td>
                            <td>Work amount billed</td>
                            <td>HST/GST</td>
                            <td>Subtotal</td>
                            <td>Deduction Medical Plan</td>
                            <td>Deduction RRSP</td>
                            <td>Total</td>
                            <td>Currency</td>
                        </tr>
                            @foreach($CAD_users as $CAD_user)
                        <tr>        
                            <td>
                            @if(isset($CAD_user['user_billing_name']) && $CAD_user['user_billing_name']!='')
                            {{$CAD_user['user_billing_name']}}
                            @else{{$CAD_user['user_name']}}
                            @endif
                            </td>
                            <td>{{number_format($CAD_user['billedwork'],2)}}</td>
                            <td>{{number_format($CAD_user['user_tax'],2)}}</td>
                            <td>{{number_format($CAD_user['subtotal'],2)}}</td>
                            <td>{{number_format($CAD_user['user_health_plan_deduction'],2)}}</td>
                            <td>{{number_format($CAD_user['user_rrsp_deduction'],2)}}</td>
                            <td>{{number_format($CAD_user['user_total'],2)}}</td>
                            <td>{{$CAD_user['user_currency']}}</td>
                        </tr>
                            @endforeach
                            <tr>        
                            <td><br/></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>        
                        <td></td>
                        <td>{{number_format($total_info_CADUsers['total_billedwork_CADUsers'],2)}}</td>
                        <td>{{number_format($total_info_CADUsers['total_GST_CADUsers'],2)}}</td>
                        <td>{{number_format($total_info_CADUsers['total_subtotal_CADUsers'],2)}}</td>
                        <td>{{number_format($total_info_CADUsers['total_meddeduction_CADUsers'],2)}}</td>
                        <td>{{number_format($total_info_CADUsers['total_rrspdeduction_CADUsers'],2)}}</td>
                        <td>{{number_format($total_info_CADUsers['total_CADUsers'],2)}}</td>
                        <td>{{$total_info_CADUsers['currency']}}</td>
                        </tr>
                            @endif

                            @if (isset($USD_users)&& count($USD_users)>0)
                        <tr>
                            <td></td>
                            <td>Work amount billed</td>
                            <td>HST/GST</td>
                            <td>Subtotal</td>
                            <td>Deduction Medical Plan</td>
                            <td>Deduction RRSP</td>
                            <td>Total</td>
                            <td>Currency</td>
                        </tr>
                            @foreach($USD_users as $USD_user)
                        <tr>        
                            <td>
                            @if(isset($USD_user['user_billing_name']) && $USD_user['user_billing_name']!='')
                            {{$USD_user['user_billing_name']}}
                            @else{{$USD_user['user_name']}}
                            @endif

                            </td>
                            <td>{{number_format($USD_user['billedwork'],2)}}</td>
                            <td>{{number_format($USD_user['user_tax'],2)}}</td>
                            <td>{{number_format($USD_user['subtotal'],2)}}</td>
                            <td>{{number_format($USD_user['user_health_plan_deduction'],2)}}</td>
                            <td>{{number_format($USD_user['user_rrsp_deduction'],2)}}</td>
                            <td>{{number_format($USD_user['user_total'],2)}}</td>
                            <td>{{$USD_user['user_currency']}}</td>
                        </tr>
                            @endforeach
                            <tr>        
                            <td><br/></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>        
                        <td></td>
                        <td>{{number_format($total_info_USDUsers['total_billedwork_USDUsers'],2)}}</td>
                        <td>{{number_format($total_info_USDUsers['total_GST_USDUsers'],2)}}</td>
                        <td>{{number_format($total_info_USDUsers['total_subtotal_USDUsers'],2)}}</td>
                        <td>{{number_format($total_info_USDUsers['total_meddeduction_USDUsers'],2)}}</td>
                        <td>{{number_format($total_info_USDUsers['total_rrspdeduction_USDUsers'],2)}}</td>
                        <td>{{number_format($total_info_USDUsers['total_USDUsers'],2)}}</td>
                        <td>{{$total_info_USDUsers['currency']}}</td>
                        </tr>
                            @endif
                    </table>
                    <br/><br/><br/><br/><br/>
                </div>
            </div>
        </div>   
    </body>
</html>
