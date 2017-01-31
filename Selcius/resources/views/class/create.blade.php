@extends('main')
@section('title','| Uploads')

@section('content')
@if(Auth::guest())
<div align="center" class="row">
<img src="/img/electricity.png">
<link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet">
<p style="font-family: 'Nunito Sans', sans-serif;font-size: 25px;">Para acceder a este contenido debes </p>
<p style="font-family: 'Baloo Thambi', cursive;font-size: 35px;"><a href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> inicia sesión </a> / <a href="{{route('register')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> registrate </a></p>
</div>
@else
@if(Auth::user()->level == 2)
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
<div class="row">
	<div class="col-md-13">
		{!!Form::open(['route' => 'class.store', 'method' => 'POST', 'files' => 'true', 'data-parsley-validate' => ""])!!}
			<select class="browser-default" name="curso_id">
				@foreach($cursos as $curso)
					@if($curso->user_id != Auth::user()->id)

					@else
					<option value="{{$curso->id}}">{{$curso->title}}</option>
					@endif
				@endforeach
			</select>
			<div class="input-field">
				<input type="text" name="title" id="title">
				<label for="title">Título</label>
			</div>
			<div class="input-field">
				<input type="text" name="slug" id="slug">
				<label for="slug">Slug</label>
			</div>
			<textarea name="description" id="description" cols="30" rows="10"></textarea>	
			<div class="input-field file-field">
				<div class="btn">
					<span>File</span>
					<input name="featured_file" type="file">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text">
				</div>
			</div>
			<input type="text" value="{{Auth::user()->id}}" name="user_id" hidden>
			<button type="submit" class="waves-effect waves-light btn blue">send<i class="material-icons right">send</i></button>
		{!!Form::close()!!}
	</div>
</div>
@else
<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
<p class="text-center"><i class="fa fa-cloud-upload fa-5x" aria-hidden="true"></i></p>
<p class="text-center" style="font-family: 'Comfortaa', cursive;font-size: 40px;">Uploads</p>
<p class="text-center" style="font-family: 'Comfortaa', cursive;font-size: 40px;">Solo administradores</p>
@endif
@endif
@endsection
