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
                  <div class="media-left">
                      <a href="{{route('auth.profiles', $answer->user->id)}}">
                          <img class="media-object img-circle"src="{{asset('avatars/'.$answer->user->image)}}">
                      </a>
                  </div>
                  <div class="media-body">
                      <div class="clearfix">
                          <p style="font-size: 40px;" class="media-heading pull-left">{{$answer->user->name}}
                          </p>
                          <span class="time pull-right"><i class="fa fa-clock-o"></i> {{date('F nS, Y - g:iA', strtotime($answer->created_at))}}</span>
                      </div>
                      <p>{{$answer->answer}}</p>
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
                <div class="media-left">
                  <img src="{{asset('avatars/'.Auth::user()->image)}}" class="circle">
                </div>
              <div class="media-body">  
                <form action="{{route('answers.store', $foro->id)}}" method="POST" id="comment-save">
                {{csrf_field()}}
                  <textarea class="materialize-textarea" style="margin-top: 35px;" name="answer" cols="40" rows="10"></textarea>
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

<!--<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Maitree|Oxygen" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="box box-default">
            <div class="box-header with-border">
                <p style="font-size: 30px;font-family: 'Raleway', sans-serif;">{!!$foro->title!!}</p>
            </div> 
            <div class="box-body">
                <p style="font-size: 17px;font-family: 'Raleway', sans-serif;">{{$foro->body}}</p>
            </div><hr>
            <div class="author-info">
                <p class="author-time">
                    @foreach($users as $user)
                        @if($foro->user_id == $user->id)
                            @if(Auth::user()->id == $foro->user->id)
                                <a style="float:right;" class="btn-floating btn-large waves-effect waves-light green" href="{{route('foros.edit', $foro->id)}}"><i class="material-icons">edit</i></a>
                                {!!Form::open(['route' => ['foros.destroy', $foro->id], 'method' => 'delete'])!!}
                                    <button type="submit" class="btn-floating btn-large waves-effect waves-light red" style="float:right;"><i class="material-icons">delete</i></button>
                                {!!Form::close()!!}
                                <img class="materialboxed" src="{{asset('avatars/'.$foro->user->image)}}" style=";margin-left:40px;width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;" class="user-image"> 
                                <i class="fa fa-calendar"> </i> {{ date('F nS, Y - g:iA' ,strtotime($foro->created_at)) }} - {{ date('F nS, Y - g:iA' ,strtotime($foro->updated_at)) }}
                                @else
                                <img src="{{asset('avatars/'.$foro->user->image)}}" style=";margin-left:40px;width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;" class="user-image"> 
                                <i class="fa fa-calendar"> </i> {{ date('F nS, Y - g:iA' ,strtotime($foro->created_at)) }} - {{ date('F nS, Y - g:iA' ,strtotime($foro->updated_at)) }}
                            @endif
                        @endif
                    @endforeach
                </p>
                <br>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-heading panel-default">
            <p align="right" style="font-family: 'Oxygen', sans-serif;"><i class="fa fa-comments-o" align="right"> </i> {{$foro->answers->count()}} Respuestas </p>
            @if($foro->answers->count() == 0)

                @else
                <hr>
            @endif
            <ul class="timeline">
            @foreach($users as $user)
                @foreach($answers as $answer)
                    @if($answer->user_id == $user->id)
                    <li>
                        <img class="materialboxed" src="{{asset('avatars/'.$answer->user->image)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-left: 12px;">
                        <div class="timeline-item">
                            <h3 class="timeline-header"><a href="#">{{$answer->user->name}}</a><span align="right" style="float: right;" class="time author-time"><i class="fa fa-calendar"></i> {{ date('F nS, Y - g:iA' ,strtotime($answer->created_at)) }}</span></h3>

                            <div class="timeline-body" style="font-family: 'Comfortaa', cursive;', sans-serif;font-size: 16px;">
                                {!!$answer->answer!!}
                            </div>
                            @if($answer->user_id == Auth::user()->id)
                            <div class="timeline-footer">
                                {!!Form::open(['route' => ['answers.destroy', $answer->id], 'method' => 'DELETE'])!!}
                                <button type="submit" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">delete</i></button>
                                <a href="{{route('answers.edit', $answer->id)}}" class="btn-floating btn-large waves-effect waves-light green"><i class="material-icons">edit</i></a>
                                {!!Form::close()!!}
                            </div>
                            @endif
                        </div>
                    </li>
                    @endif
                @endforeach
            @endforeach
            <li>
                <i class="fa fa-commenting-o bg-blue"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header"><a href="#">Participa en los comentarios</a></h3>

                    <div class="timeline-body" style="font-family: 'Comfortaa', cursive;', sans-serif;font-size: 16px;">
                        {!!Form::open(['route' => ['answers.store', $foro->id],'method' => 'POST'])!!}
                        
                        <div class="row">
                            <form class="col-md-8 col-md-offset-1">
                            <div class="row">
                                <div class="input-field col-md-10 col-md-offset-1">
                                <i class="material-icons prefix">mode_edit</i>
                                <textarea id="icon_prefix2" name="answer" class="materialize-textarea"></textarea>
                                <label for="icon_prefix2"></label>
                                </div>
                            </div>
                            </form>
                        </div>
        
                        {{Form::text('user_id', Auth::user()->id,['class' => 'form-control', 'hidden'])}}
                    </div>
                    
                    <div class="timeline-footer">
                        <button class="btn waves-effect waves-light blue" type="submit" name="action">Submit
                            <i class="material-icons right">send</i>
                        </button>
                        {!!Form::close()!!}
                    </div>
                    
                </div>
            </li>
            </ul>
        </div>
    </div>
</div>-->
@endif

@endsection