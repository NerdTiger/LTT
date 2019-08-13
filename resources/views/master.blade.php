@extends('layouts.app')

@section('header')

<div class="container-fluid ">
    <div class="row" id ="row01">
        <div class="col-sm-3" align="left">
            <div class="container" style="padding:1px;">
                <img itemprop="image"  src="images/TT-Logo.png" alt="Logo" style="height: 70%;">
            </div>
        </div>
        <div class="col-sm-7" ></div>
        <div class="col-sm-2" align="right">
        @guest
        @else
        <div class="dropdown">
                
                <div class='menufontstyle'>
                admin

                </div>
                <div class="dropdown-menu dropdown-menu-right">
                
                    <a class="dropdown-item" href="FC_dispatcher.php?controller=login&action=logout"><img itemprop="image" class="mobile" src="images/signout3.svg" alt="Logout" style="height: 16px;margin-right:30px;">Sign Out</a>
                </div>
                
          </div>        
        @endguest

            
        </div>
    </div>   
</div>

@endsection


@guest
<div class="flex-center position-ref full-height">
@section('sec2') 

@endsection

        </div>
@else
@section('sec2') 


<div id="menuitems">
@include('menuitems')

</div>
<div class="container-fliud h-100 flex-grow-1 tableforphone" >
<div  class="row  flex-grow-1" style="width:98%;">
    
    <div  class="col-sm-2 hideforphone" align="left">

@yield('leftsidefunctions')
</div>
<div id="maineditarea" class="col-sm-10 " align="left" >
@yield('main')

</div>

@endsection

</div>
</div>



@endguest



