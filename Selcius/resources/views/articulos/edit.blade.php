@extends('main')
<?php $titleTag = htmlspecialchars($articulo->title); ?>

@section('title', "| $titleTag - editar")

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
	{!! Html::style('css/blogtheme.min.css') !!}
	{!! Html::style('css/styles.min.css') !!}
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
@if(Auth::guest())

@else
@if(Auth::user()->id != $articulo->user_id)
@if(Auth::user()->level != 2)
<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
<p class="text-center"><i class="fa fa-newspaper-o fa-5x"></i></p>
<p class="text-center" style="font-family: 'Comfortaa', cursive;font-size: 40px;">Editar Artículo</p>
<p class="text-center" style="font-family: 'Comfortaa', cursive;font-size: 40px;">Solo administradores</p>
@else
<div class="row">
	<!-- GetStarted Form -->
	{!! Form::model($articulo, ['route' => ['articulos.update', $articulo->id], 'method' => 'PUT', 'files' => true]) !!}
	<div class="col-md-8">
		<div class="input-field">
			{{Form::text('title', null, ['id' => 'title', 'required'])}}
			<label for="title">Títle</label>
		</div>
		<div class="input-field">
			{{Form::text('slug', null, ['id' => 'slug', 'required'])}}
			<label for="slug">Slug</label>
		</div>
		<div class="input-field">
			{{ Form::select('category_id', $categories, null, ['class' => 'form-control'])}}
		</div>
		<div class="input-field">
			{{ Form::select('tags[]', $tags, null , ['class' =>	'form-control select2-multi', 'multiple' => 'multiple'] )}}
		</div>
		<div class="file-field input-field">
			<div class="btn">
				<span>File</span>
				<input name="featured-image" type="file">
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text">
			</div>
		</div>
		<div class="input-field">
			{{Form::textarea('body', null, ['id' => 'body', 'required'])}}
			<label for="body"></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="well">
			<dl class="dl-horizontal">
				<p class="font-size: 16px;"><i class="fa fa-clock-o"></i> Creado el {{date('M j, Y h:ia', strtotime($articulo->created_at))}}</p>
			</dl>
			<dl class="dl-horizontal">
				<p class="font-size: 16px;"><i class="fa fa-clock-o"></i> Actualizado el {{date('M j, Y h:ia', strtotime($articulo->updated_at))}}</p>
			</dl>
			<hr>
			<div class="row text-center">
				<a href="{{route('articulos.show', $articulo->id)}}" class="waves-effect waves-light btn red"><i class="fa fa-close left"></i>cancelar</a>
				<button type="submit" class="waves-effect waves-light btn blue"><i class="fa fa-check left"></i>enviar</button>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
	@endif
</div>

@endif
@endif

@endsection
@section('scripts')

	{!! Html::script('js/select2.min.js') !!}
	<script type="text/javascript">

		$('.select2-multi').select2();
		$('.select2-multi').select2().val({!! json_encode($articulo->tags()->getRelatedIds()) !!}).trigger('change');

	</script>

@endsection
