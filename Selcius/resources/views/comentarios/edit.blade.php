<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
@extends('main')
@section('title', '| Editar comentario')
@section('content')
<div class="row">
@if(Auth::user()->id != $comentario->user_id)

@if(Auth::user()->level >= 2)
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-info">
            <div class="box-header with-border">
            <p align="right"><img class="responsive-img" src="{{asset('avatars/'.$comentario->user->image)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;">By <a href="{{'auth.profiles', $comentario->user->id}}">{{$comentario->user->name}} </a></p>
                <p style="font-size: 16px;font-family: 'Comfortaa', cursive;">Editar Comentario</p>
            </div>
            <div class="box-body">
                {!!Form::model($comentario, ['route' => ['comentarios.update', $comentario->id], 'method' => 'PUT'])!!}
                    {{Form::textarea('comentario', null,['class' => 'materialize-textarea', 'rows' => '10', 'required'])}}
                    <br>
                    <button class="btn waves-effect waves-light blue" type="submit" name="action">enviar
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
                <p align="right"><img class="responsive-img" src="{{asset('avatars/'.$comentario->user->image)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;">By {{$comentario->user->name}}</p>
                <p style="font-size: 16px;font-family: 'Comfortaa', cursive;">Editar Comentario</p>
            </div>
            <div class="box-body">
                {!!Form::model($comentario, ['route' => ['comentarios.update', $comentario->id], 'method' => 'PUT'])!!}
                    {{Form::textarea('comentario', null, ['class' => 'form-control', 'rows' => '10', 'required'])}}
                    <br>
                    <button class="btn waves-effect waves-light blue" type="submit" name="action">enviar
                        <i class="material-icons right">send</i>
                    </button>
                {!!Form::open()!!}
            </div>
        </div>
    </div>
</div>
@endif
</div>
@endsection
