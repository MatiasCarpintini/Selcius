<!DOCTYPE html>
<html lang="es">
<head>
<title>Selcius | Editar mi perfil</title>
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
@if(Auth::guest())
@else
@if(Auth::user()->id != $user->id)
@else
<body ng-app="mainModule" ng-controller="mainController">
<div id="login-page" class="row">
    <div class="col s12 z-depth-6 card-panel">
      {!! Form::model($user, ['route' => ['auth.update', $user->id], 'method' => 'PUT', 'files' => true, 'class' => 'login-form']) !!}
        {{ csrf_field() }}
        <div class="row">
        </div>
        <div class="file-field input-field">
          <div class="btn">
            <span><i class="material-icons prefix" style="margin-left:6px;" aria-hidden="true">image</i></span>
            <input type="file" name="featured_image">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input type="text" name="name" value="{{$user->name}}" placeholder="Full Name" autofocus required>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">mail_outline</i>
            <input type="email" name="email" value="{{$user->email}}" placeholder="Email" required>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">comment</i>
            <textarea name="description" class="materialize-textarea" placeholder="Description" cols="30" rows="10">{!!$user->description!!}</textarea>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button class="btn waves-effect waves-light col s12" type="submit">send</button>
          </div>
        </div>
      {!!Form::close()!!}
    </div>
  </div>
  </body>
  @endif
  @endif
</div>

</html>
