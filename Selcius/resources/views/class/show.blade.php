@extends('main')
<?php $titleTag = htmlspecialchars($upload->title); ?>

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

@section('title', "| $titleTag")

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
@foreach($cursos as $curso)
	@if($upload->curso_id == $curso->id)
		@if($curso->level <= Auth::user()->stripe_active)
			<meta name="_token" content="{!! csrf_token() !!}" />
			<div class="row">
				<div class="col-md-13">
					<div class="col-md-8">
					<section align="left">
						<video class="materialboxed responsive-video" width="728" height="415" align="left" style="" controls autoplay preload  oncontextmenu="return false">
							<source src="{{asset("videos/$upload->file")}}" type='video/mp4; codecs="avc1.42c00d"'>
							<source src="{{asset("videos/$upload->file")}}" type='video/webm; codecs="vorbis,vp8"'>
							<source src="{{asset("videos/$upload->file")}}" type="video/ogg"/>
						</video>
					</section>
					</div>
					<div class="col-md-4">
						<div class="card">
							<div class="card-image waves-effect waves-block waves-light">
							</div>
							<div class="card-content">
								<p><img style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;" src="{{asset('avatars/'.$upload->user->image)}}"><a href="{{route('auth.profiles', $upload->user->id)}}">{{$upload->user->name}}</a></p>
								<p style="margin-top: 1.3rem;margin-left: 1.3rem;"><i class="fa fa-clock-o"></i> {{date('M j, Y h:ia', strtotime($upload->created_at))}}</p>
								<p style="margin-left: 1.3rem;"><i class="fa fa-link"></i> /{!! $upload->slug !!}</p>
								<br><br><br><br><br><br><br><br><br><br><br><br><br><br>

								<p><span class="card-title activator grey-text text-darken-4">Chat <i style="margin-top: 10px;" class="material-icons right">more_vert</i></span></p>
							</div>
							<div class="card-reveal">
								<span class="card-title grey-text text-darken-4">Chat<i class="material-icons right">close</i></span>
								<br>
								<li class="divider"></li>
								<br>
									<chat>
										@foreach($messages as $message)
											@if($upload->id == $message->upload_id)
												
												<div class="row">
													<div class="direct-chat-msg left">
														<a href="{{route('auth.profiles', $message->user->id)}}"><img class="direct-chat-img responsive-img" src="{{asset('avatars/'.$message->user->image)}}" style="width: 32px;height: 32px;border-radius: 50%;margin-right: 10px;"></a>
														<div class="direct-chat-text">
															{!!$message->message!!}
														</div>
													</div>
												</div>
											@endif
										@endforeach
									</chat>
									<div class="row">
										<input type="hidden" name="_token" value="{!! csrf_token() !!}">
										<textarea required id="chat_message" name="message" class="materialize-textarea"></textarea>
										<button id="send" class="waves-effect waves-light btn blue" type="submit"><i class="material-icons left">send</i>enviar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row"></div>
					<div class="row">
					<p style="font-size: 40px;" class="text-center">{{$upload->title}}</p>
					</div>
					<li class="divider"></li>
					<br>
					<div class="row">
						<div class="col-md-13">
						<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
						<p style="font-family: 'Quicksand', sans-serif;font-size: 20px;">{!!$upload->description!!}</p>
					</div>
						@else
							<link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
							<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
							<div align="center" class="row">
								<img src="/img/premium.png">
								<p style="font-family: 'Baloo Thambi', cursive;font-size: 35px;">CONTENIDO PREMIUM</p>
								<p style="font-family: 'Ubuntu', sans-serif;font-size: 40px;">Elije tu plan</p>
    						<link href="/css/plans.css" rel='stylesheet' type='text/css'/>
								<div style="margin-left: 250px;" class="pricing-plans">
									@if(Auth::user()->stripe_active == 0)
										<div class="wrap">
											<div class="pricing-grid2">
												<div class="price-value two">
													<p><a href="#">STANDARD</a><p>
													<p><span>$ 100.00ARS</span><lable> / month</lable></p>
													<div class="sale-box two">
												</div>

												</div>
												<div class="price-bg">
												<ul>
													<li class="whyt"><a href="#">Artículos </a></li>
													<li><a href="#">Foros </a></li>
													<li class="whyt"><a href="#">Cursos (Todos) </a></li>
												</ul>
												@if(Auth::user()->stripe_active == 1)
												<div class="cart2">
														<a onclick="Materialize.toast('Usted ya posee una membresía!', 4000)">Order</a>
												</div>
												@else
														<div class="cart2">
														<form action="/" method="POST">
														{{ csrf_field() }}
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
																<script
																		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
																		data-key="pk_test_5AdyS9TXjBTjLjjIiABf4dTb"
																		data-amount="10000"
																		data-name="Mensual"
																		data-plan="Mensual"
																		data-description="Suscripción Mensual"
																		data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
																		data-locale="auto">
																</script>
														</form>
														</div>
												@endif
												</div>
											</div>
											<div class="pricing-grid3">
												<div class="price-value three">
													<p><a href="#">PREMIUM</a></p>
													<p><span>$ 1050.00ARS</span><lable> / annual</lable></p>
													<div class="sale-box three">
												</div>

												</div>
												<div class="price-bg">
												<ul>
													<li class="whyt"><a href="#">Artículos </a></li>
													<li><a href="#">Foros </a></li>
													<li class="whyt"><a href="#">Cursos (Todos) </a></li>
												</ul>
														@if(Auth::user()->stripe_active == 1)
																<div class="cart3">
																		<a onclick="Materialize.toast('Antes de actualizar/adquirir tú membresía debés Iniciar Sesión/Registrarte', 4000)">Order</a>
															</div>
														@else
														<div class="cart3">
																<form action="/" method="POST">
																{{ csrf_field() }}
																<input type="hidden" name="_token" value="{{ csrf_token() }}">
																		<script
																				src="https://checkout.stripe.com/checkout.js" class="stripe-button"
																				data-key="pk_test_5AdyS9TXjBTjLjjIiABf4dTb"
																				data-amount="105000"
																				data-name="Anual"
																				data-plan="Anual"
																				data-description="Suscripción Anual"
																				data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
																				data-locale="auto">
																		</script>
																</form>
														</div>
														@endif
												</div>
											</div>
										</div>
									</div>
								@endif
							@endif
						</div>
					</div>
			@endif
		@endforeach
	@endif
	<script type="text/javascript">
	var url = "{{route('messages.store', $upload->id)}}"; 
	$("#send").click(function() {
		$.ajax({
		type: 'post',
		url: url,
		data: {
		  '_token': $('input[name=_token]').val(),
		  'message': $('textarea[name=message]').val()
		},
		success: function(data) {
		  if ((data.errors)) {
			$('.error').removeClass('hidden');
			$('.error').text(data.errors.message);
		  } else {
			$('.error').remove();
			$('chat').append(
				"<div class='row'><div class='direct-chat-msg left'><a href='{{route('auth.profiles', $message->user->id)}}'><img src='{{asset('avatars/'.$message->user->image)}}' style='width: 32px;height: 32px;border-radius: 50%;margin-right: 10px;'></a></div><div class='direct-chat-text' id='message'>" + data.message + "</div></div>"
				);
			$('#chat_message').val(''); 
		  }
		},
		});
		$('#message').val('');
	});
	</script>
@endsection
