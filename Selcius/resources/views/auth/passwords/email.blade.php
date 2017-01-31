<!DOCTYPE html>
<html lang="es">
<head>
<title>Selcius | Olvidé mi contraseña</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <style>
html,
body {
    height: 100%;
}
html {
    display: table;
    margin: auto;
}
body {
    display: table-cell;
    vertical-align: middle;
    background: #4ECDC4;
}

#login-page {
   width: 500px;
}

.card {
     position: absolute;
     left: 50%;
     top: 50%;
     -moz-transform: translate(-50%, -50%)
     -webkit-transform: translate(-50%, -50%)
     -ms-transform: translate(-50%, -50%)
     -o-transform: translate(-50%, -50%)
     transform: translate(-50%, -50%);
}
</style>
<body ng-app="mainModule" ng-controller="mainController">
<div id="login-page" class="row">
    <div class="col s12 z-depth-6 card-panel">
		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
		@if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
		<div class="box-header" align="center"><p style="font-family: 'Nunito', sans-serif;font-size: 40px;" class="text-center">¿Forgot your password?</p></div>
		<p style="font-family: 'Nunito', sans-serif;font-size: 15px;margin-left: 30px;color: #FF8800;">* Enviaremos un correo electrónico sobre cómo reestablecer tu contraseña a la dirección de correo electrónico asociada a tu cuenta.</p>
  		  <form role="form" method="POST" action="{{ url('/password/email') }}">
  		  	{{csrf_field()}}
  		  	<div class="input-field col s12">
				<i class="material-icons prefix">mail_outline</i>
  			  <input autofocus="" required placeholder="Email" type="email" name="email" class="validate">
  		  	</div>
  		</form>
    </div>
  </div>
  </body>
</div>

</html>
