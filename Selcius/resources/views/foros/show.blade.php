@extends('main')
<?php $titleTag = htmlspecialchars($foro->title); ?>
@section('title', "| $titleTag")
@section('content')
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<div class="row">
  <div class="col-md-13">
    <div class="card">
      <div class="card-content">
        <p style="margin-left: 10px;font-size: 40px;font-family: 'Quicksand', sans-serif;">{{$foro->title}}</p>
        <br>
        <p>{!!$foro->body!!}</p>
        <hr style="color: #0099CC;">
        <p style=""><a href="{{route('auth.profiles', $foro->user->id)}}"><img src="{{asset('avatars/'.$foro->user->image)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;" class="responsive-img"> {{$foro->user->name}} </a> <b style="font-family: 'Quicksand', sans-serif;float: right;margin-top: 7px;"><i class="fa fa-clock-o"></i> {{date('F nS, Y - g:iA', strtotime($foro->created_at))}}</b>
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
      <p style="font-size: 30px;font-family: 'Fredoka One', sans-serif;color: #33b5e5;" align="center"> Respuesta/s</p>
      <br>
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="converstation">
            <comments>
              @foreach($foro->answers as $answer)
              <div class="row">
              <div class="panel panel-default">
                <div class="media" style="margin: 1.3rem;">
                    <div class="media-body">
                        <div class="clearfix">
                            <a href="{{route('auth.profiles', $answer->user->id)}}">
                                <p style="font-size: 25px;" class="media-heading pull-left">
                                    <img class="responsive-img" style="width: 52px;height: 52px;border-radius: 50%;" src="{{asset('avatars/'.$answer->user->image)}}"> {{$answer->user->name}}
                                </p>
                            </a>
                        </div>
                        <p style="margin-left: 52px;" id="answer">{!!$answer->answer!!}</p>
                        <br>
                        <p>
                        <?php if(Auth::check()&&Auth::user()->id == $answer->user->id): ?>
                          {{Form::open(['route' => ['answers.destroy', $answer->id], 'method' => "DELETE"])}}
                            <button class="waves-effect waves-teal btn-flat" align="left" type="submit"><i class="fa fa-trash-o"></i></button> 
                            <a href="{{route('answers.edit', $answer->id)}}" class="waves-effect waves-teal btn-flat" align="left"><i class="fa fa-pencil"></i></a>
                          {{Form::close()}}
                        <?php endif ?> 
                        <span class="time pull-right"><i class="fa fa-clock-o"></i> {{date('F nS, Y - g:iA', strtotime($answer->created_at))}}</span></p>
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
                <a disabled style="margin-left: 20px;margin-top: 10px;" class="waves-effect waves-red btn blue" onclick="Materialize.toast('Para participar de los comentarios debes Iniciar Sesión/Registrarte.', 4000)"><i class="material-icons left">send</i>enviar</a>
              </div>
              <div class="media" align="center">
                <p style="font-family: 'Baloo Thambi', cursive;font-size: 35px;"><a href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> login </a> / <a href="{{route('register')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> register </a></p>
              </div>
            </div>
              @else
              <div class="media">
                <div class="media-body">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <textarea id="chat_message" class="materialize-textarea" style="margin-left: 20px;" name="answer" cols="40" rows="10"></textarea>
                    <button id="send" type="submit" style="margin-left: 20px;margin-top: 10px;" class="waves-effect waves-red btn blue"> <i class="material-icons left">send</i>submit</button>
                </div>
              </div>
          @endif
      </div>
    </div>
  </div>
  </div>
</div>
<script type="text/javascript">
  //POST COMMENTS
  var url_post = "{{route('answers.store', $foro->id)}}";

  $("#send").click(function() {
    $.ajax({
    type: 'post',
    url: url_post,
    data: {
      '_token': $('input[name=_token]').val(),
      'answer': $('textarea[name=answer]').val()
    },
    success: function(data) {
      if ((data.errors)) {
      $('.error').removeClass('hidden');
      $('.error').text(data.errors.answer);
      } else {
      $('.error').remove();
      $('comments').append(
        "<div class='row'><div class='panel panel-default'><div class='media' style='margin: 1.3rem;'><div class='media-body'><div class='clearfix'><a href='{{route('auth.profiles', $answer->user->id)}}'><p style='font-size: 25px;' class='media-heading pull-left'><img class='responsive-img' style='width: 52px;height: 52px;border-radius: 50%;' src='{{asset('avatars/'.$answer->user->image)}}'> {{$answer->user->name}}</p></a></div><p style='margin-left: 52px;' id='answer'>"+ data.answer +"</p><br><p><span class='time pull-right'><i class='fa fa-clock-o'></i> {{date('F nS, Y - g:iA', strtotime($answer->created_at))}}</span></p></div></div><br></div></div>"
        );
      $('#chat_message').val('');
      }
    },
    });
    $('#answer').val('');
  });
</script>
@endsection
