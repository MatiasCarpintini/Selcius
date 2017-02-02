@extends('main')
@section('title', '| Artículos')
@section('content')

<div class="row">
	@foreach($articulos as $articulo)
	<article>
		<div class="col-md-4">
			<a href="{{route('articulo.single', $articulo->slug)}}"><div class="card hoverable">
				<div class="card-image">
					<img class="responsive-img" src="{{asset('images/'.$articulo->image)}}">
					<span class="card-title"><p>{{$articulo->title}}</p></span>
				</div>
				<div class="card-content">
					<p><img class="responsive-img" src="{{asset('avatars/'.$articulo->user->image)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;"> By <a href="{{'auth.profiles', $articulo->user->id}}"> {!!$articulo->user->name!!} </a></p>
				</div>
			</div></a>
		</div>
	</article>
	@endforeach
</div>
<div class="row">
	<div class="col-md-12">
		<div class="text-center">
			{!! $articulos->links() !!}
		</div>
	</div>
</div>

@endsection
