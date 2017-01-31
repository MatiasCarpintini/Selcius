@extends('main')
@section('head')
@section('title', '| Olvidé mi contraseña')

@section('content')
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="box">
				<div class="box-header" align="center"><img src="{{asset('img/password.png')}}" widht="256" height="256"><p style="font-family: 'Quicksand', sans-serif;font-size: 40px;" class="text-center">¿Forgot your password?</p></div>
					<form action="{{url('password/email')}}" method="POST">
					{{csrf_field()}}
					<div class="input-field col s12">
						<a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Enviaremos un correo electrónico sobre cómo reestablecer tu contraseña a la dirección de correo electrónico asociada a tu cuenta."><input required placeholder="Email" id="email" type="email" name="email" class="validate"> </a>
					</div>
					</form>

				</div>
			</div>
		</div>
	</div>
@endsection