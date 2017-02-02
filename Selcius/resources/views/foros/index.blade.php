@extends('main')
@section('title', '| Foros')

@section('content')
@if(Auth::guest())

@else
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<div class="row">
  @foreach($foros as $foro)
    <div class="card">
      <div class="card-content">
      <p style="font-family: 'Quicksand', sans-serif;font-size: 40px;">
        <a href="{{route('auth.profiles', $foro->user->id)}}">
          <img src="{{asset('avatars/'.$foro->user->image)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;" class="responsive-img">
        </a>
        <a href="{{route('foros.show', $foro->slug)}}">{{$foro->title}}</a>
      </p>
      <br>
      <li class="divider"></li>
      <br>
      <p>{!!substr(strip_tags($foro->body), 0, 355)!!}{!!strlen(strip_tags($foro->body)) > 355 ? '...' : ""!!}</p>
      <p align="right"><i class="fa fa-clock-o"></i> {{date('F nS, Y - g:iA', strtotime($foro->created_at))}} - <i class="fa fa-comments-o"></i> {{$foro->answers->count()}}</p>
      </div>
    </div>
  @endforeach
</div>
<div class="fixed-action-btn horizontal click-to-toggle">
  <a class="btn-floating btn-large waves-effect waves-light blue" href="{{route('foros.create')}}"><i class="material-icons">add</i></a>
</div>

@endif
@endsection
