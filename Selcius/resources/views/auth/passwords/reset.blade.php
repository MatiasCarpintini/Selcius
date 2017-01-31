<!DOCTYPE html>
<html lang="es">
<head>
<title>Selcius | Restablecer contraseña</title>
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
		@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif
	  <p style="font-family: 'Quicksand', sans-serif;font-size: 40px;" align="center" class="text-center">Reset a Password</p>
  	  <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
        {{ csrf_field() }}
		<input type="hidden" name="token" value="{{ $token }}">
        <div class="row">
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">mail_outline</i>
            <input value="{{$email}}" class="validate" type="email" name="email" placeholder="Email" required>
          </div>
        </div>
		<div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">lock_outline</i>
            <input required type="password" placeholder="New Password" name="password">
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">lock_outline</i>
            <input required type="password" placeholder="Password Confirmation" name="password_confirmation">
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button class="btn waves-effect waves-light col s12" type="submit">Restablecer</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  </body>
</div>

</html>
