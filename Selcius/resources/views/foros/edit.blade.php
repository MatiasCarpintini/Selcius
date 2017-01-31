@extends('main')
<?php $titleTag = htmlspecialchars($foro->title); ?>

@section('title', "| $titleTag Edit")

@section('content')

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: "textarea",
            skin: "lightgray",
            plugins: "link code, emoticons, insertdatetime, layer, lists, pagebreak, print, searchreplace, table,textcolor colorpicker, contextmenu, image",
            toolbar: "emoticons, insertdatetime, pagebreak, print, searchreplace, table, forecolor backcolor, image imagetools",
            imagetools_toolbar: "rotateleft rotateright | flipv fliph | editimage imageoptions",
            imagetools_proxy: 'proxy.php',
            menubar: true,
            contextmenu: "link image inserttable | cell row column deletetable",
            textcolor_map: [
            "000000", "Black",
            "993300", "Burnt orange",
            "333300", "Dark olive",
            "003300", "Dark green",
            "003366", "Dark azure",
            "000080", "Navy Blue",
            "333399", "Indigo",
            "333333", "Very dark gray",
            "800000", "Maroon",
            "FF6600", "Orange",
            "808000", "Olive",
            "008000", "Green",
            "008080", "Teal",
            "0000FF", "Blue",
            "666699", "Grayish blue",
            "808080", "Gray",
            "FF0000", "Red",
            "FF9900", "Amber",
            "99CC00", "Yellow green",
            "339966", "Sea green",
            "33CCCC", "Turquoise",
            "3366FF", "Royal blue",
            "800080", "Purple",
            "999999", "Medium gray",
            "FF00FF", "Magenta",
            "FFCC00", "Gold",
            "FFFF00", "Yellow",
            "00FF00", "Lime",
            "00FFFF", "Aqua",
            "00CCFF", "Sky blue",
            "993366", "Red violet",
            "FFFFFF", "White",
            "FF99CC", "Pink",
            "FFCC99", "Peach",
            "FFFF99", "Light yellow",
            "CCFFCC", "Pale green",
            "CCFFFF", "Pale cyan",
            "99CCFF", "Light sky blue",
            "CC99FF", "Plum"
            ]
        });
    </script>
@if(Auth::user()->id != $foro->user_id)

@else
<div class="row">
    {!! Form::model($foro, ['route' => ['foros.update', $foro->id],'method' => "PUT"]) !!}
        <div class="input-field">
            {{Form::text('title', null, ['id' => 'title'])}}
            <label for="title">Título</label>
        </div>
        <div class="input-field">
            {{Form::text('slug', null, ['id' => 'slug'])}}
            <label for="slug">Slug</label>
        </div>
        <div class="input-field">
            <textarea name="body" cols="30" rows="10">{!!$foro->body!!}</textarea>
        </div>
        <br>    
        <button class="btn waves-effect waves-light blue"><i class="material-icons right">send</i>send</button>
    {!! Form::close() !!}
</div>
@endif
@endsection