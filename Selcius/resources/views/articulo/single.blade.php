@extends('main')
<?php $titleTag = htmlspecialchars($articulo->title); ?>
@section('title', "| $titleTag")

@section('content')
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<div class="row">
  <div class="card">
    <div class="card-image">
      <img src="{{asset('images/'.$articulo->image)}}" class="responsive-img" width="800" height="400">
    </div>
    <div class="card-content">
      <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
      <p class="card-title" style="font-size: 35px;font-family: 'Ubuntu', sans-serif;"> {{$articulo->title}}</p>
      <br>
      <p style="">{!!$articulo->body!!}</p>
      <br>
      <p style="margin-top:10px;margin-left:40px;"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ date('F nS, Y - g:iA' ,strtotime($articulo->created_at)) }}</p>
      <p style="margin-top:10px;margin-left:40px;"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> {{$articulo->category->name}}</p>
      <br>
      <li class="divider"></li>
      <br>
      <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="converstation">
            <div class="media">
                <div class="media-body">
                    <div class="clearfix">
                        <link href="https://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet">
                        <a href="{{route('auth.profiles', $articulo->user->id)}}">
                            <p style="font-size: 35px;font-family: 'Maven Pro', sans-serif;" class="media-heading pull-left" aling="">
                            <img style="width: 52px;height: 52px;border-radius: 50%;margin-left:10px;" class="z-depth-4" src="{{asset('avatars/'.$articulo->user->image)}}"> {{$articulo->user->name}}</p></a>

                    </div>
                    <p style="margin-top:20px;margin-left: 70px;">{!!$articulo->user->description!!}</p>
                </div>
            </div>
        </div>
    </div>
  </div>
    </div>
  </div>
</div>
    <br>
    <p style="font-size: 30px;font-family: 'Fredoka One', sans-serif;color: #33b5e5;" align="center"> {{ $articulo->comments()->count() }} Comentario/s</p>
    <br>
    @if($articulo->comments->count() == 0)

    @else
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="converstation">
          @foreach($articulo->comments as $comment)
            <div class="media">
                <div class="media-body">
                    <div class="clearfix">
                        <a href="{{route('auth.profiles', $comment->user->id)}}">
                            <p style="font-size: 40px;" class="media-heading pull-left">
                                <img style="width: 52px;height: 52px;border-radius: 50%;" src="{{asset('avatars/'.$articulo->user->image)}}"> {{$comment->user->name}}
                            </p>
                        </a>
                    </div>
                    <p>{{$comment->comment}}</p>
                    <span class="time pull-right"><i class="fa fa-clock-o"></i> {{date('F nS, Y - g:iA', strtotime($comment->created_at))}}</span>
                    @if(Auth::guest())

                    @else
                    @if(Auth::user()->id == $comment->user->id)
                      {{Form::open(['route' => ['comments.destroy', $comment->id], 'method' => "DELETE"])}}
                      <button class="btn-floating btn-large waves-effect waves-light red" type="submit"><i class="material-icons">delete</i></button>
                      <a class="btn-floating btn-large waves-effect waves-light blue" href="{{route('comments.edit', $comment->id)}}"><i class="material-icons">mode_edit</i></a>
                      {{Form::close()}}
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
              <form action="{{route('comments.store', $articulo->id)}}" method="POST">
              {{csrf_field()}}
              <p><img src="{{asset('avatars/'.Auth::user()->image)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-left: 20px;">{{Auth::user()->name}}</p>
                <textarea class="materialize-textarea" style="margin-left: 20px;" name="comment" cols="40" rows="10"></textarea>
                <input name="user_id" value="{{Auth::user()->id}}" hidden></input>
                <button type="submit" style="margin-left: 20px;margin-top: 10px;" class="waves-effect waves-red btn blue"> <i class="material-icons left">send</i>submit</button>
              </form>
            </div>
          </div>
        @endif
    </div>
  </div>
</div>
@endsection
