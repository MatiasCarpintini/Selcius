@if (Session::has('success'))

	<div class="alert alert-success" role="alert">
		<p><i class="fa fa-check"></i> Exito: {{ Session::get('success') }}</p>
	</div>

@endif

@if (count($errors) > 0)

	<div class="alert alert-danger" role="alert">
		<p><i class="fa fa-times"></i> Error:
		@foreach ($errors->all() as $error)
			{{ $error }}
		@endforeach
		</p>
	</div>

@endif
