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
									<video class="materialboxed" width="728" height="415" align="left" style="margin-top: 0px;border: 0px;display: inline-block;padding: 0px;" controls autoplay preload  oncontextmenu="return false" class="responsive-video">
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
											<img style="margin-left: 20px;" class="activator" src="/img/chat.png">
											<br>
											<p style="margin-top: 60px;"><span class="card-title activator grey-text text-darken-4">Chat<i class="material-icons right">more_vert</i></span></p>
										</div>
										<div class="card-reveal">
											<span class="card-title grey-text text-darken-4">Chat<i class="material-icons right">close</i></span>
											<br>
											<li class="divider"></li>
											<br>
												@foreach($messages as $message)
													@if($upload->id == $message->upload_id)
														<div class="row">
															<div class="direct-chat-msg left">
																<img class="direct-chat-img" src="{{asset('avatars/'.$message->user->image)}}" style="width: 32px;height: 32px;border-radius: 50%;margin-right: 10px;">
																<div class="direct-chat-text">
																	{!!$message->message!!}
																	<div class="direct-chat-info clearfix">
																		<span class="direct-chat-name pull-left"><i class="fa fa-user-o" aria-hidden="true"></i> {!!$message->user->name!!}</span>
																		<span class="direct-chat-timestamp pull-right"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ date('F nS, Y - g:iA' , strtotime($message->created_at)) }}</span>
																	</div>
																</div>
															</div>
														</div>
													@endif
												@endforeach
												<div class="row">
													<form method="POST" action="{{route('messages.store', $upload->id)}}" id="message">
														<input type="hidden" name="_token" value="{!! csrf_token() !!}">
														<input name="user_id" value="{{Auth::user()->id}}" hidden required>
														<textarea required name="message" class="materialize-textarea"></textarea>
														<button class="waves-effect waves-light btn blue" type="submit"><i class="material-icons left">send</i>enviar</button>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
								<p style="font-size: 40px;" class="text-center">{{$upload->title}}</p> 
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
@endsection
