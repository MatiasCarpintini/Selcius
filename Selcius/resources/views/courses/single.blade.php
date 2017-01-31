@extends('main')
<?php $titleTag = htmlspecialchars($curso->title); ?>
@section('title', "| $titleTag")
@section('content')
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<div class="row">
  <div class="col-md-13">
    <section align="left">
      <iframe width="728" height="415" align="left"  src="http://www.youtube.com/embed/{{$curso->video}}?theme=light&showinfo=0" frameborder="0"></iframe>    
    </section>
    <div class="col-md-4">
      <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
          
        </div>
        <div class="card-content">
          <p><img src="{{asset('avatars/'.$curso->user->image)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;"> By <a href="{{route('auth.profiles', $curso->user->id)}}"> {{$curso->user->name}}</a></p>
          <img style="margin-left: 20px;" class="activator" src="/img/video-camera.png">
          <p style="margin-top: 20px;"><span class="card-title activator grey-text text-darken-4">Contenido<i class="material-icons right">more_vert</i></span></p>
        </div>
        <div class="card-reveal">
          <span class="card-title grey-text text-darken-4">Contenido del curso<i class="material-icons right">close</i></span>
          <br>
          <li class="divider"></li>
          <br>
            @foreach($uploads as $upload)
              @if($upload->curso_id != $curso->id)
                @else
                  <p style="font-family: 'Nunito', sans-serif;font-size: 25px;"><a href="{{ route('class.show', $upload->slug) }}">{!!$upload->title!!}</a></p>
              @endif
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
    <p style="font-family: 'Fredoka One', cursive;font-size:40px;" class="text-center"><img style="margin-right: 10px;" src="{{asset('images/'.$curso->icono)}}" class="circle">{{ $curso->title }}</p>
    <p>{!!$curso->description!!}</p>
    <li class="divider"></li>
    <br>
    <p style="font-size: 30px;font-family: 'Fredoka One', sans-serif;color: #33b5e5;" align="center"> {{ $curso->comentarios()->count() }} Comentario/s</p>
    <br>
    @if($curso->comentarios->count() == 0)

    @else
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="converstation">
          @foreach($curso->comentarios as $comentario)
            <div class="media">
                <div class="media-left">
                    <a href="{{route('auth.profiles', $comentario->user->id)}}">
                        <img class="media-object img-circle"src="{{asset('avatars/'.$comentario->user->image)}}">
                    </a>
                </div>
                <div class="media-body">
                    <div class="clearfix">
                        <p style="font-size: 40px;" class="media-heading pull-left">{{$comentario->user->name}}
                        </p>
                        <span class="time pull-right"><i class="fa fa-clock-o"></i> {{date('F nS, Y - g:iA', strtotime($comentario->created_at))}}</span>
                    </div>
                    <p>{{$comentario->comentario}}</p>
                    @if(Auth::guest())

                    @else
                    @if(Auth::user()->id == $comentario->user->id)
                      {{Form::open(['route' => ['comentarios.destroy', $comentario->id], 'method' => "DELETE"])}}
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <button class="btn-floating btn-large waves-effect waves-light red" type="submit"><i class="material-icons">delete</i></button> 
                      <a class="btn-floating btn-large waves-effect waves-light blue" href="{{route('comentarios.edit', $comentario->id)}}"><i class="material-icons">mode_edit</i></a>
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
              <div class="media-left">
                <img src="{{asset('avatars/'.Auth::user()->image)}}" class="circle">
              </div>
            <div class="media-body">  
              <form action="{{route('comentarios.store', $curso->id)}}" method="POST" id="comment-save">
              {{csrf_field()}}
                <textarea class="materialize-textarea" style="margin-top: 35px;" name="comentario" cols="40" rows="10"></textarea>
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
