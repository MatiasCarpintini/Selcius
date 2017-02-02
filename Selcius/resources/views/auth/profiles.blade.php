@extends('main')
<?php $titleTag = htmlspecialchars($user->name); ?>
@section('title', "| $titleTag")

@section('content')
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    <div class="card">
        <div class="card-image">
        <br>
        <p class="text-center" style="font-size: 40px;font-family: 'Fredoka One', cursive;"><img src="{{asset('avatars/'.$user->image)}}" style="width: 64px;height: 64px;border-radius: 50%;" class="profile-user-img responsive-img img-circle">{{$user->name}}@if($user->level == 2) <i class="fa fa-bolt" aria-hidden="true" ></i> @else @if($user->stripe_active == 1)  <i class="fa fa-diamond" style="color: #CC0000;" aria-hidden="true"></i> @endif @endif</p>
        </div>
        <li class="divider"></li>
        <div class="card-content">
        <link href="https://fonts.googleapis.com/css?family=Spinnaker" rel="stylesheet">
        <p style="font-family: 'Spinnaker', sans-serif;font-size: 20px;" align="center">{{$user->description}}</p>
        <br>
        <li class="divider"></li>
        <br>
        <div class="row" align="center">
          @if($user->facebook != "")
          <a href="https://www.facebook.com{{Auth::user()->facebook}}" class="btn-floating btn-large waves-effect waves-light" style="background-color: #3b5998;"><i class="fa fa-facebook" style="color:white;"></i></a>
          @endif
          @if($user->twitter != "")
          <a href="https://www.twitter.com{{Auth::user()->twitter}}" class="btn-floating btn-large waves-effect waves-light" style="background-color: #00aced;"><i class="fa fa-twitter" style="color:white;"></i></a>
          @endif
          @if($user->github != "")
          <a href="https://www.github.com{{Auth::user()->github}}" class="btn-floating btn-large waves-effect waves-light" style="background-color: #303030;"><i class="fa fa-github" style="color:white;"></i></a>
          @endif
          @if($user->linkedin != "")
          <a href="https://www.linkedin.com{{Auth::user()->linkedin}}" class="btn-floating btn-large waves-effect waves-light" style="background-color: #0077b5;"><i class="fa fa-linkedin" style="color:white;"></i></a>
          @endif
          @if($user->youtube != "")
          <a href="https://www.youtube.com{{Auth::user()->youtube}}" class="btn-floating btn-large waves-effect waves-light" style="background-color: #cd201f;"><i class="fa fa-youtube-play" style="color:white;"></i></a>
          @endif
          @if($user->website != "")
          <a href="{{Auth::user()->website}}" class="btn-floating btn-large waves-effect waves-light" style="background-color: #00C851;"><i class="fa fa-link" style="color:white;"></i></a>
          @endif
        </div>
        </div>
    </div>

@endsection
