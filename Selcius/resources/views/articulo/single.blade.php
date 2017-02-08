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
      <img src="{{asset('images/'.$articulo->image)}}" class="responsive-img materialboxed" width="800" height="400">
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
                            <img class="responsive-img" style="width: 52px;height: 52px;border-radius: 50%;margin-left:10px;" class="z-depth-4" src="{{asset('avatars/'.$articulo->user->image)}}"> {{$articulo->user->name}}</p></a>
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
    <p style="font-size: 30px;font-family: 'Fredoka One', sans-serif;color: #33b5e5;" align="center"> Comentario/s</p>
    <br>
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="converstation">
          <comments>
          @foreach($articulo->comments as $comment)
          <div class="row">
          <div class="panel panel-default">
            <div class="media" style="margin: 1.3rem;">
                <div class="media-body">
                    <div class="clearfix">
                        <a href="{{route('auth.profiles', $comment->user->id)}}">
                            <p style="font-size: 25px;" class="media-heading pull-left">
                                <img class="responsive-img" style="width: 52px;height: 52px;border-radius: 50%;" src="{{asset('avatars/'.$comment->user->image)}}"> {{$comment->user->name}}
                            </p>
                        </a>
                    </div>
                    <p style="margin-left: 52px;" id="comment">{{$comment->comment}}</p>
                    <br>
                    <p>
                    <?php if(Auth::check()&&Auth::user()->id == $comment->user->id): ?>
                      {{Form::open(['route' => ['comments.destroy', $comment->id], 'method' => "DELETE"])}}
                        <button class="waves-effect waves-teal btn-flat" align="left" type="submit"><i class="fa fa-trash-o"></i></button> 
                        <a href="{{route('comments.edit', $comment->id)}}" class="waves-effect waves-teal btn-flat" align="left"><i class="fa fa-pencil"></i></a>
                      {{Form::close()}}
                    <?php endif ?> 
                    <span class="time pull-right"><i class="fa fa-clock-o"></i> {{date('F nS, Y - g:iA', strtotime($comment->created_at))}}</span></p>
                </div>
            </div>
            <br>
            </div>
          </div>
          @endforeach
          </comments>
        </div>
    </div>
  </div>
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
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <textarea id="chat_message" class="materialize-textarea" style="margin-left: 20px;" name="comment" cols="40" rows="10"></textarea>
                <button id="send" type="submit" style="margin-left: 20px;margin-top: 10px;" class="waves-effect waves-red btn blue"> <i class="material-icons left">send</i>submit</button>
            </div>
          </div>
        @endif
    </div>
  </div>
</div>
<script type="text/javascript">
  //POST COMMENTS
  var url_post = "{{route('comments.store', $articulo->id)}}";

  $("#send").click(function() {
    $.ajax({
    type: 'post',
    url: url_post,
    data: {
      '_token': $('input[name=_token]').val(),
      'comment': $('textarea[name=comment]').val()
    },
    success: function(data) {
      if ((data.errors)) {
      $('.error').removeClass('hidden');
      $('.error').text(data.errors.comment);
      } else {
      $('.error').remove();
      $('comments').append(
        "<div class='row'><div class='panel panel-default'><div class='media' style='margin: 1.3rem;'><div class='media-body'><div class='clearfix'><a href='{{route('auth.profiles', $comment->user->id)}}'><p style='font-size: 25px;' class='media-heading pull-left'><img class='responsive-img' style='width: 52px;height: 52px;border-radius: 50%;' src='{{asset('avatars/'.$comment->user->image)}}'> {{$comment->user->name}}</p></a></div><p style='margin-left: 52px;'>" + data.comment + "</p><br><p><span class='time pull-right'><i class='fa fa-clock-o'></i> {{date('F nS, Y - g:iA', strtotime($comment->created_at))}}</span></p></div></div><br></div></div>"
        );
      $('#chat_message').val('');
      }
    },
    });
    $('#comment').val('');
  });
</script>
@endsection
