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
                        <img src="{{asset('images/'.$articulo->image)}}">
                        <span class="card-title"><p>{{$articulo->title}}</p></span>
                    </div>
                    <div class="card-content">
                        <p style="color: black;">{{substr(strip_tags($articulo->body), 0, 150)}}{{strlen(strip_tags($articulo->body)) > 150 ? '...' : ""}}</9p>
                    </div>
                </div></a>
            </div>
        </article>
	@endforeach
</div>
@endif
@endsection