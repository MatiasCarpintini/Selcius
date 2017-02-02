@extends('main')

<?php $titleTag = htmlspecialchars($category->name); ?>
@section('title', "| Category $titleTag")

@section('content')

@if(Auth::guest())

@else
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<p class="text-center" style="font-size: 30px; font-family: 'Quicksand', sans-serif;"> Todos los artículos que se encuentran el la categoría: <i class="fa fa-puzzle-piece"></i> {{$category->name}} ({{$category->articulos->count()}})</p>
<br>
<div class="row">
	@foreach($articulos as $articulo)
        @if($category->id == $articulo->category_id)
        <article>
            <div class="col-md-4">
                <a href="{{route('articulo.single', $articulo->slug)}}"><div class="card hoverable">
                    <div class="card-image">
                        <img class="responsive-img" src="{{asset('images/'.$articulo->image)}}">
                        <span class="card-title"><p>{{$articulo->title}}</p></span>
                    </div>
                    <div class="card-content">
                        <p style="color: black;">{{substr(strip_tags($articulo->body), 0, 150)}}{{strlen(strip_tags($articulo->body)) > 150 ? '...' : ""}}</9p>
                    </div>
                </div></a>
            </div>
        </article>
        @endif
	@endforeach
</div>
@endif

@endsection
