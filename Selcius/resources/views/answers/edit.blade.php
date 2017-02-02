<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
@extends('main')
@section('title', '| Edición de Comentarios')
@section('content')
<div class="row">
@if(Auth::user()->id != $answer->user_id)

@if(Auth::user()->level >= 2)
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-info">
            <div class="box-header with-border">
            <p align="right"><img class="responsive-img" src="{{asset('avatars/'.$answer->user->image)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;">By <a href="{{'auth.profiles', $answer->user->id}}"> {{$answer->user->name}}</a> </p>
                <p style="font-size: 16px;font-family: 'Comfortaa', cursive;">Editar Comentario</p>
            </div>
            <div class="box-body">
                {!!Form::model($answer, ['route' => ['answers.update', $answer->id], 'method' => 'PUT'])!!}
                    {{Form::textarea('answer', null,['class' => 'materialize-textarea', 'rows' => '10', 'required'])}}
                    <br>
                    <button class="btn waves-effect waves-light blue" type="submit" name="action">Submit
                        <i class="material-icons right">send</i>
                    </button>
                {!!Form::open()!!}
            </div>
        </div>
    </div>
</div>
@endif
@else


<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-info">
            <div class="box-header with-border">
                <p align="right"><img src="{{asset('avatars/'.$answer->user->image)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;" class="responsive-img">By {{$answer->user->name}}</p>
                <p style="font-size: 16px;font-family: 'Comfortaa', cursive;">Editar Comentario</p>
            </div>
            <div class="box-body">
                {!!Form::model($answer, ['route' => ['answers.update', $answer->id], 'method' => 'PUT'])!!}
                    {{Form::textarea('answer', null, ['class' => 'form-control', 'rows' => '10', 'required'])}}
                    <br>
                    <button class="btn waves-effect waves-light blue" type="submit" name="action">Submit
                        <i class="material-icons right">send</i>
                    </button>
                {!!Form::open()!!}
            </div>
        </div>
    </div>
</div>
@endif
@endsection
