@extends('main')
@section('head')
@section('title', '| Olvidé mi contraseña')

@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="box">
			<div class="box-header" align="center"><img src="{{asset('img/key.png')}}" widht="256" height="256"><p style="font-family: 'Quicksand', sans-serif;font-size: 40px;" class="text-center">Reset a Password</p></div>
				{!! Form::open(['url' => 'password/reset', 'method' => "POST"]) !!}
					{{ Form::hidden('token', $token) }}
					<div class="input-field">
						<input  id="email" type="email" class="validate" name="email" value="{{$email}}" placeholder="Email" required>
						<label for="email" data-error="Error" data-success="Success"></label>
					</div>
					<div class="input-field">
						<input class="validate" type="password" name="password" placeholder="Password" required id="password">
					</div>
					<div class="input-field">
						<input type="password" class="validate" name="password_confirmation" placeholder="Confirm Password" required id="confirm_password">
					</div>
					<div class="button">
						<button type="submit" class="waves-effect waves-light light"><span>RESET</span> </button>
					</div>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
</div>
<script>
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
@endsection