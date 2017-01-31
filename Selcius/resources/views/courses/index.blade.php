@extends('main')
@section('title', '| Cursos')
@section('content')
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nixie+One|Varela+Round" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Archivo+Black" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
<div class="row">
  @foreach($cursos as $curso)
      <div class="col-md-6">
        <div class="card">
          <div class="card-image waves-effect waves-block waves-light embed-responsive embed-responsive-16by9">
            <iframe width="560" height="315"  align="left"  src="http://www.youtube.com/embed/{{$curso->video}}?theme=light&showinfo=0" frameborder="0"></iframe>
          </div>
          <div class="card-content">
          <span class="card-title activator grey-text text-darken-4"><p><a href="{{route('courses.single', $curso->slug)}}"><p style="font-family: 'Varela Round', sans-serif;font-size: 40px;"><img src="{{asset('images/'.$curso->icono)}}" class="circle"> {!!$curso->title!!}
              @if($curso->level == 1)
              <label class="badge red" style="margin-top: 7px;">PREMIUM</label>
              @else
              <label class="badge blue" style="margin-top: 7px;">GRATIS</label>
              @endif
            </a><i class="material-icons right">more_vert</i></p></span>
          </div>
          <div class="card-reveal">
            <span class="card-title activator grey-text text-darken-4"><p><a href="{{route('courses.single', $curso->slug)}}"><p style="font-family: 'Varela Round', sans-serif;font-size: 40px;"><img src="{{asset('images/'.$curso->icono)}}" class="circle"> {!!$curso->title!!}
              @if($curso->level == 1)
              <label class="badge red" style="margin-top: 7px;">PREMIUM</label>
              @else
              <label class="badge blue" style="margin-top: 7px;">GRATIS</label>
              @endif
            </a><i class="material-icons right">close</i></p></span>
            <li class="divider"></li><br>
            <p>{!!$curso->description!!}</p>
            <p align="right"><i class="material-icons">access_time</i> {{date('D d, F.  (e) ', strtotime($curso->created_at))}}</p>
            <li class="divider"></li>
            <br>
            <section>
            <p align="left" style="font-family: 'Noto Sans', sans-serif;"><a href="{{route('auth.profiles', $curso->user->id)}}"><img src="{{asset('avatars/'.$curso->user->image)}}" style="width: 54px;height: 54px;border-radius: 50%;margin-right: 10px;">
            By  {!!$curso->user->name!!} </a></p>
            </section>
          </div>
        </div>
      </div>
  @endforeach
</div>

<div class="text-center">
  {!! $cursos->links(); !!}
</div>
@endsection

