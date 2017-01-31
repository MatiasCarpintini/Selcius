@extends('main')
@section('title', '| Editar Perfil')

@section('content')
@if(Auth::guest())
<link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
<div class="media">
  <div class="media-left">
    <i class="fa fa-user fa-5x" style="margin-right: 10px;"></i>
  </div>
  <div class="media-body">
    <textarea class="materialize-textarea" disabled style="margin-top: 10px;" cols="40" rows="10"></textarea>
    <a disabled style="margin-left: 20px;margin-top: 10px;" class="waves-effect waves-red btn blue" onclick="Materialize.toast('Para participar de los comentarios debes Iniciar Sesión/Registrarte.', 4000)"><i class="material-icons left">send</i>submit</a>
  </div>
  <div class="media" align="center">
    <p style="font-family: 'Baloo Thambi', cursive;font-size: 35px;"><a href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> inicia sesión </a> / <a href="{{route('register')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> registrate </a></p>
  </div>
</div>
@else
  @if(Auth::user()->id == $user->id)
    <div class="row">
      <div class="card">
        <div class="card-content">
          <p class="text-center"><i class="fa fa-address-card fa-5x" aria-hidden="true"></i></p>
          {!! Form::model($user, ['route' => ['auth.update', $user->id], 'method' => 'PUT', 'files' => true]) !!}
            <p><img src="{{asset('avatars/'.$user->image)}}" class="profile-user-img img-responsive img-circle" style="width: 64px;height: 64px;border-radius: 50%;margin-right: 10px;" align="left">
              <div class="file-field input-field">
                <div class="btn">
                  <i style="margin-right: 3px;" class="fa fa-camera-retro" aria-hidden="true"> </i>
                  <span> Avatar</span>
                  <input type="file" name="featured_image">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text">
                </div>
              </div>
            </p>
            <br>
            <div class="input-field">
              <i class="fa fa-user prefix" aria-hidden="true"></i>
              <input required type="text" name="name" value="{{$user->name}}" id="name">
              <label for="name">Nombre</label>
            </div>
            <div class="input-field">
              <i class="fa fa-envelope prefix" aria-hidden="true"></i>
              <input required id="email" type="email" name="email" value="{{$user->email}}">
              <label for="email">Email</label>
            </div>
            <div class="input-field">
              <i class="material-icons prefix">mode_edit</i>
              <textarea id="description" name="description" required class="materialize-textarea">{{$user->description}}</textarea>
              <label for="description">Descripción</label>
            </div>
            <button class="waves-effect waves-light btn blue"><i class="material-icons right">send</i>send</button>
          {!!Form::close()!!}
        </div>
      </div>
    </div>
    @else
    
  @endif
@endif
@endsection