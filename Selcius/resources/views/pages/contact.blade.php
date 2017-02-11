@extends('main')
@section('title', '| Contacto')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <p style="font-size: 35px;font-family: 'Quicksand', sans-serif;" class="text-center">Contáctenos</p>
        <form action="{{ url('contact') }}" method="POST">
            {{ csrf_field() }}
            <div class="input-field">
                <i class="prefix material-icons">mail</i>
                <label for="email">Email</label>
                <input class="validate" type="email" id="email" required name="email">
            </div>
            <div class="input-field">
                <i class="fa fa-question-circle prefix"></i>
                <label for="subject">Asunto</label>
                <input id="subject" required type="text" name="subject">
            </div>
            <div class="input-field">
                <i class="prefix material-icons">comment</i>
                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" required name="message" class="materialize-textarea"></textarea>
            </div><br>
            <button class="btn waves-effect waves-light blue" type="submit" name="action">enviar
                <i class="material-icons right">send</i>
            </button>
        </form>
    </div>
</div>
@endsection