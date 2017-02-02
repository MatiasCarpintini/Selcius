@extends('main')
@section('title', '| Mi Perfil')

@section('content')
@if(Auth::guest())

@else
  <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
   <div class="card">
    <div class="card-image">
    <br>
      <p align="center" style="font-size: 40px;font-family: 'Fredoka One', cursive;"><img src="{{asset('avatars/'.Auth::user()->image)}}" style="width: 64px;height: 64px;border-radius: 50%;" class="profile-user-img responsive-img img-circle">{{Auth::user()->name}}@if(Auth::user()->level == 2) <i class="fa fa-bolt" aria-hidden="true" ></i> @else @if(Auth::user()->stripe_active == 1)  <i class="fa fa-diamond" style="color: #CC0000;" aria-hidden="true"></i> @endif @endif 
      </p>

    <li class="divider"></li>
    <div class="card-content">
      <link href="https://fonts.googleapis.com/css?family=Spinnaker" rel="stylesheet">
      <p style="font-family: 'Spinnaker', sans-serif;font-size: 20px;" class="text-center">{{Auth::user()->description}}</p>
      <br>
      <li class="divider"></li>
      <br>
      <p style="" align="left"><i class="fa fa-envelope" aria-hidden="true"></i> {{Auth::user()->email}} <span style="float: right;"><i class="fa fa-clock-o" aria-hidden="true"></i> {{date('F nS, Y', strtotime(Auth::user()->created_at))}}</span>
      <a data-position="bottom" data-delay="50" data-tooltip="Vista previa" href="{{route('auth.profiles', Auth::user()->id)}}" style="margin-left: 265px;" class="tooltipped btn-floating waves-effect waves-light btn-large blue">
        <i class="large material-icons">visibility</i>
      </a>
      <a data-position="bottom" data-delay="50" data-tooltip="Editar perfil" class="tooltipped btn-floating btn-large red" href="{{route('auth.edit', Auth::user()->id)}}">
        <i class="large material-icons">mode_edit</i>
      </a>
    </div></p>
    </div>
   </div>
@endif
@endsection
