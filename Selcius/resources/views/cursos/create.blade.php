@extends('main')
@section('title', '| Nuevo Curso')
@section('stylesheets')

    {!! Html::style('css/parsley.css') !!}
    {!! Html::style('css/select2.min.css') !!}

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

@endsection

@section('content')
@if(Auth::user()->level == 2)
<div class="row">
    {!! Form::open(['route' => 'cursos.store','data-parsley-validate' => '','method' => "POST", 'files' => true])!!}
        <div class="input-field">
            <input type="text" name="title" required id="title">
            <label for="title">Título</label>
        </div>
        <div class="input-field">
            <input type="text" name="slug" required maxlenght="255" minleght="5" id="slug">
            <label for="slug">Slug</label>
        </div>
        <div class="input-field">
            <input type="text" name="level" id="level" required placeholder="Level 1 = Premium Users, Level 2 =  Normal Users">
            <label for="level">Level User</label>
        </div>
        <div class="input-field">
            <select class="browser-default" name="section_id">
                @foreach($sections as $section)
                    <option value='{{$section->id}}'>{{$section->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="file-field input-field">
            <div class="btn">
                <span>Icono</span>
                <input type="file" name="featured_icono">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
            </div>
        </div>
        <div class="file-field input-field">
            <div class="btn">
                <span>Banner</span>
                <input type="file" name="featured_image">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
            </div>
        </div>
        <div class="input-field">
            <input type="text" name="video" id="video" required>
            <label for="video">Video Presentación (URL)</label>
        </div>
        <div class="input-field">
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
        </div>
        <br>
        <button class="waves-effect waves-light btn blue" type="submit"><i class="material-icons right">send</i>send</button>

        {!! Form::close()!!}
</div>
@endsection
@else

@endif
@section('scripts')

	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}
	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>

@endsection
