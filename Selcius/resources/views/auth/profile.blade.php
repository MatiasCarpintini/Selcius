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
      <p style="margin: 1.0rem;">
          <i class="fa fa-envelope" aria-hidden="true"></i> {{Auth::user()->email}} <span style="float: right;"><i class="fa fa-clock-o" aria-hidden="true"></i> {{date('F nS, Y', strtotime(Auth::user()->created_at))}}</span>
      </p>

    <li class="divider"></li>
    <div class="card-content">
      <link href="https://fonts.googleapis.com/css?family=Spinnaker" rel="stylesheet">
      <p style="font-family: 'Spinnaker', sans-serif;font-size: 20px;" class="text-center">{{Auth::user()->description}}</p>
      <br>
      <li class="divider"></li>
      <br>
      <div class="row" align="center">
        @if(Auth::user()->facebook != "")
        <a href="https://www.facebook.com{{Auth::user()->facebook}}" class="btn-floating btn-large waves-effect waves-light" style="background-color: #3b5998;"><i class="fa fa-facebook" style="color:white;"></i></a>
        @endif
        @if(Auth::user()->twitter != "")
        <a href="https://www.twitter.com{{Auth::user()->twitter}}" class="btn-floating btn-large waves-effect waves-light" style="background-color: #00aced;"><i class="fa fa-twitter" style="color:white;"></i></a>
        @endif
        @if(Auth::user()->github != "")
        <a href="https://www.github.com{{Auth::user()->github}}" class="btn-floating btn-large waves-effect waves-light" style="background-color: #303030;"><i class="fa fa-github" style="color:white;"></i></a>
        @endif
        @if(Auth::user()->linkedin != "")
        <a href="https://www.linkedin.com{{Auth::user()->linkedin}}" class="btn-floating btn-large waves-effect waves-light" style="background-color: #0077b5;"><i class="fa fa-linkedin" style="color:white;"></i></a>
        @endif
        @if(Auth::user()->youtube != "")
        <a href="https://www.youtube.com{{Auth::user()->youtube}}" class="btn-floating btn-large waves-effect waves-light" style="background-color: #cd201f;"><i class="fa fa-youtube-play" style="color:white;"></i></a>
        @endif
        @if(Auth::user()->website != "")
        <a href="{{Auth::user()->website}}" class="btn-floating btn-large waves-effect waves-light" style="background-color: #00C851;"><i class="fa fa-link" style="color:white;"></i></a>
        @endif
      </div>
    </div>
    </div>
   </div>
   <div class="fixed-action-btn toolbar">
    <a class="btn-floating btn-large red">
      <i class="large material-icons">menu</i>
    </a>
    <ul>
      <li><a class="waves-effect waves-light" href="{{route('auth.profiles', Auth::user()->id)}}"><i class="material-icons">visibility</i></a></li>

      <li><a href="{{route('auth.edit', Auth::user()->id)}}" class="waves-effect waves-light"><i class="material-icons">mode_edit</i></a></li>
    </ul>
  </div>
@endif
@endsection
