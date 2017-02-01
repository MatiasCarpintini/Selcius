@extends('main')
@section('title', '| Dashboard')
@section('content')
@if(Auth::guest())

@else
	@if(Auth::user()->level == 2)
	{!! $chart->render() !!}
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<div class="card">
		<div class="card-content">
			<p style="font-size: 40px;font-family: 'Lato', sans-serif;" class="text-center">
			<a style="margin-left: 5px;margin-right: 5px;"> {{$users->count()}} <i class="fa fa-user" aria-hidden="true"></i> </a>
			<a href="{{route('articulos.index')}}">{{$articulos->count()}} <i class="fa fa-newspaper-o"  style="margin-right: 5px;" aria-hidden="true"></i> </a>
			<a href="{{route('cursos.index')}}">{{$cursos->count()}} <i class="fa fa-book" style="margin-right: 5px;" aria-hidden="true"></i> </a>
			<a href="{{route('foros.index')}}">{{$foros->count()}} <i class="fa fa-users" aria-hidden="true"></i> </a>
			</p>
			<br>
			<li class="divider"></li>
			<br>
			<table class="bordered">
				<thead>
					<th>#</th>
					<th>Avatar</th>
					<th>Nombre</th>
					<th>Email</th>
					<th>Level</th>
					<th>Created at</th>
					<th>Updated at</th>
					<th>Stripe Active</th>
					<th>Stripe Plan</th>
				</thead>
				<tbody>
					@foreach($users as $user)

						<tr>
							<th>{{$user->id}}</th>
							<th><a href="{{route('auth.profiles', $user->id)}}"><img src="{{asset('avatars/'.$user->image)}}" class="circle img-circle user-image" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;"></a></th>
							<th>{{$user->name}}</th>
							<th>{{$user->email}}</th>
							<th>{{$user->level}}</th>
							<th>{{date('M j, Y h:ia', strtotime($user->created_at))}}</th>
							<th>{{date('M j, Y h:ia', strtotime($user->updated_at))}}</th>
							<th>{{$user->stripe_active}}</th>
							<th>{{$user->stripe_plan}}</th>
						</tr>

					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@else
	<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
	<p class="text-center"><i class="fa fa-tachometer fa-5x" aria-hidden="true"></i></p>
	<p class="text-center" style="font-family: 'Comfortaa', cursive;font-size: 40px;">Dashboard</p>
	<p class="text-center" style="font-family: 'Comfortaa', cursive;font-size: 40px;">Solo administradores</p>
	@endif
@endif
@endsection
