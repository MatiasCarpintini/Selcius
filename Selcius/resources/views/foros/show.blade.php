@extends('main')
<?php $titleTag = htmlspecialchars($foro->title); ?>
@section('title', "| $titleTag")

@section('content')
@if(Auth::guest())

@else
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<div class="row">
  <div class="col-md-13">
    <div class="card">
      <div class="card-content">
        <p style="margin-left: 10px;font-size: 40px;font-family: 'Quicksand', sans-serif;">{{$foro->title}}</p>
        <br>
        <p>{!!$foro->body!!}</p>
        <hr style="color: #0099CC;">
        <p style=""><a href="{{route('auth.profiles', $foro->user->id)}}"><img src="{{asset('avatars/'.$foro->user->image)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;"> {{$foro->user->name}} </a> <b style="font-family: 'Quicksand', sans-serif;float: right;margin-top: 7px;"><i class="fa fa-clock-o"></i> {{date('F nS, Y - g:iA', strtotime($foro->created_at))}}</b>
        </p>
      </div>
    </div>
    <br>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
      <p style="font-size: 30px;font-family: 'Fredoka One', sans-serif;color: #33b5e5;" align="center"> {{ $foro->answers()->count() }} Respuesta/s</p>
      <br>
      @if($foro->answers->count() == 0)

      @else
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="converstation">
            @foreach($foro->answers as $answer)
              <div class="media">
                  <div class="media-body">
                      <div class="clearfix">
                          <a href="{{route('auth.profiles', $answer->user->id)}}"><p style="font-size: 40px;" class="media-heading pull-left"><img style="width:52px;height: 52px;border-radius: 50%;margin-right: 10px;" src="{{asset('avatars/'.$answer->user->image)}}">{{$answer->user->name}}
                          </p></a>
                      </div>
                      <p>{{$answer->answer}}</p>
                      <span class="time pull-right"><i class="fa fa-clock-o"></i> {{date('F nS, Y - g:iA', strtotime($answer->created_at))}}</span>
                      @if(Auth::guest())

                      @else
                      @if(Auth::user()->id == $answer->user->id)
                        {{Form::open(['route' => ['answers.destroy', $answer->id], 'method' => "DELETE"])}}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn-floating btn-large waves-effect waves-light red" type="submit"><i class="material-icons">delete</i></button>
                        <a class="btn-floating btn-large waves-effect waves-light blue" href="{{route('answers.edit', $answer->id)}}"><i class="material-icons">mode_edit</i></a>
                        {{Form::open()}}
                      @else
                      @endif
                    @endif
                  </div>
              </div>
              <br>
            @endforeach
          </div>
      </div>
    </div>
    @endif
    <div class="row">
      <div class="converstation">
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
              <div class="media">
              <div class="media-body">
                <form action="{{route('answers.store', $foro->id)}}" method="POST" id="comment-save">
                {{csrf_field()}}
                <p> <img src="{{asset('avatars/'.Auth::user()->image)}}" style="width:42px;height: 42px;border-radius: 50%;margin-right: 10px;margin-left: 20px;" class="circle"> {{Auth::user()->name}}</p>
                  <textarea class="materialize-textarea" style="margin-left:20px;" name="answer" cols="40" rows="10"></textarea>
                  <input name="user_id" value="{{Auth::user()->id}}" hidden></input>
                  <button type="submit" style="margin-left: 20px;margin-top: 10px;" class="waves-effect waves-red btn blue"> <i class="material-icons left">send</i>submit</button>
                </form>
              </div>
            </div>
          @endif
      </div>
    </div>
  </div>
  </div>
</div>

@endif

@endsection
