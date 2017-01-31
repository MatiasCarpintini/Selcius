<!DOCTYPE html>
<html lang="es">
<head>
<title>Selcius | Register</title>
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
      <form class="login-form" role="form" method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}
        <div class="row">
        </div>
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix"><i class="material-icons">account_circle</i></i>
                <input placeholder="Full Name" type="text" name="name" placeholder="name" required=""  autofocus="">
            </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">mail_outline</i>
            <input type="email" name="email" placeholder="Email" required>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">lock_outline</i>
            <input required type="password" placeholder="Password" name="password">
          </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">lock_outline</i>
                <input type="password" placeholder="Password Confirmation" name="password_confirmation">
            </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button class="btn waves-effect waves-light col s12" type="submit">Register</button>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="{{url('/login')}}">Login!</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
  </body>
</div>

</html>
