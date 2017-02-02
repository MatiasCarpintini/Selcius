@extends('main')
@section('title', "| $tag->name Tag")

@section('content')
@if(Auth::guest())

@else
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<p class="text-center" style="font-size: 30px; font-family: 'Quicksand', sans-serif;"> Todos los artículos que están usando el Tag: <i class="fa fa-tag"></i> {{$tag->name}} ({{$tag->articulos->count()}})</p>
<br>
<div class="row">
	@foreach($tag->articulos as $articulo)
        <article>
            <div class="col-md-4">
                <a href="{{route('articulo.single', $articulo->slug)}}"><div class="card hoverable">
                    <div class="card-image">
                        <img src="{{asset('images/'.$articulo->image)}}" class="responsive-img">
                        <span class="card-title"><p>{{$articulo->title}}</p></span>
                    </div>
                    <div class="card-content">
                        <p><img src="{{asset('avatars/'.$articulo->user->image)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;" class="responsive-img"> By <a href="{{'auth.profiles', $articulo->user->id}}"> {!!$articulo->user->name!!} </a></p>
                    </div>
                </div></a>
            </div>
        </article>
	@endforeach
</div>
@endif
@endsection
