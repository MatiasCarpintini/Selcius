@extends('main')

<?php $titleTag = htmlspecialchars($section->name); ?>
@section('title', "| Section $titleTag")

@section('content')

@if(Auth::guest())

@else
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<p class="text-center" style="font-size: 30px; font-family: 'Quicksand', sans-serif;"> Todos los cursos que se encuentran en la sección: <img src="{{asset('images/'.$section->icono)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;"> {{$section->name}} ({{$section->cursos->count()}})</p>
<br>
<div class="row">
	@foreach($cursos as $curso)
        @if($section->id == $curso->section_id)
        <article>
            <div class="col-md-4">
                <a href="{{route('courses.single', $curso->slug)}}"><div class="card hoverable">
                    <div class="card-content">
                        <p style="font-size: 20px;font-family: 'Quicksand', sans-serif;"><img src="{{asset('images/'.$curso->icono)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;">{{$curso->title}}</p>
                        <p style="color: black;">{{substr(strip_tags($curso->description), 0, 150)}}{{strlen(strip_tags($curso->description)) > 150 ? '...' : ""}}</p>
                    </div>
                </div></a>
            </div>
        </article>
        @endif
	@endforeach
</div>
@endif

@endsection