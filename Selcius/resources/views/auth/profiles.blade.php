@extends('main')
<?php $titleTag = htmlspecialchars($user->name); ?>
@section('title', "| $titleTag")

@section('content')
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    <div class="card">
        <div class="card-image">
        <br>
        <p align="center" style="font-size: 40px;font-family: 'Fredoka One', cursive;"><img src="{{asset('avatars/'.$user->image)}}" style="width: 64px;height: 64px;border-radius: 50%;" class="profile-user-img responsive-img img-circle">{{$user->name}}@if($user->level == 2) <i class="fa fa-bolt" aria-hidden="true" ></i> @else @if($user->stripe_active == 1)  <i class="fa fa-diamond" style="color: #CC0000;" aria-hidden="true"></i> @endif @endif</p>
        </div>
        <li class="divider"></li>
        <div class="card-content">
        <link href="https://fonts.googleapis.com/css?family=Spinnaker" rel="stylesheet">
        <p style="font-family: 'Spinnaker', sans-serif;font-size: 20px;" class="text-center">{{$user->description}}</p>
        <br>
        <li class="divider"></li>
        <br>
        <p style="" align="left"><i class="fa fa-envelope" aria-hidden="true"></i> {{$user->email}} <span style="float: right;"><i class="fa fa-clock-o" aria-hidden="true"></i> {{date('F nS, Y', strtotime(Auth::user()->created_at))}}</span></p>
        </div>
    </div>

@endsection
