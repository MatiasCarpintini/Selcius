@extends('main')
<?php $titleTag = htmlspecialchars($curso->title); ?>

@section('title', "| $titleTag Editar Curso") 

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
@if(Auth::user()->id != $curso->user_id)
<h1 class="text-center">Acceso Denegado!</h1>
@else 
<div class="row">
	<div class="col-md-8">
	{!! Form::model($curso, ['route' => ['cursos.update', $curso->id], 'data-parsley-validate' => '','method' => 'PUT', 'files' => 'true']) !!}	
		<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
		<div class="input-field">
			{{Form::text('title', null, ['id' => 'title'])}}
			<label for="title">Título</label>
		</div>
		<div class="input-field">
			{{Form::text('slug', null, ['id' => 'slug'])}}
			<label for="slug">Slug</label> 
		</div>
		<div class="input-field">
			{{Form::text('level', null, ['id' => 'level'])}}
            <label for="level">Level User</label>
        </div>
		<div class="input-field">
			{{Form::textarea('description', null)}}
		</div>
		<div class="file-field input-field">
			<div class="btn">
				<span>File</span>
				<input name="featured_icono" type="file">
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text">
			</div>
		</div>
		<div class="file-field input-field">
			<div class="btn">
				<span>File</span>
				<input name="featured_image" type="file">
			</div>
				<div class="file-path-wrapper">
				<input class="file-path validate" type="text">
			</div>
		</div>
		<div class="input-field">	
			{{Form::text('video', null, ['id' => 'video'])}}		
			<label for="video">URL Video presentación</label>
		</div>
		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<p><img src="{{asset('avatars/'.$curso->user->image)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;"> By <a href="">{{$curso->user->name}}</a></p>
				</dl>
				<dl class="dl-horizontal">
					<p><i class="fa fa-clock-o"></i> Creado el: {{date('M j, Y h:ia', strtotime($curso->created_at))}}</p>
				</dl>
				<dl class="dl-horizontal">
					<p><i class="fa fa-clock-o"></i> Última Actualización: {{date('M j, Y h:ia',strtotime($curso->updated_at))}}</p>
				</dl>
				<li class="divider"></li><br>
				<div class="row text-center" align="center">
					<a style="float:center; margin-right: 10px;" href="{{route('cursos.show', $curso->id)}}" class="waves-effect waves-light btn blue"><i class="fa fa-arrow-right right"></i> cancelar</a>
					<button type="submit" class="btn waves-effect waves-light green"><i class="fa fa-refresh right"></i> actualizar</button>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
		@endif
	</div>

@endsection