@extends('master')

@section('login')
@parent

	
		<form action='atin.cgi' method='post' name='autoinvoicer' id='autoinvoicer'>
                
		Please login with your TimeTracker ID and Password
		<br>
		<br>Name: <input type='text' name='ttid'>
		<br>Password: <input type='password' name='ttpassword'>
		<input type='hidden' name='loginattempt' value='1'>
		<br><input type='submit' value='Login'>
		</form>


@endsection

