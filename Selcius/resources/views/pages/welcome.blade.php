@extends('main')

@section('content')
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nixie+One|Varela+Round" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Archivo+Black" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
<div class="row">
    <link href="css/plans.css" rel='stylesheet' type='text/css'/>
<script type="application/x-javascript">
  addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<div class="pricing-plans">
    @if(Auth::guest())
    <div class="wrap">
      <div class="pricing-grids">
      <div class="pricing-grid1">
        <div class="price-value">
            <p><a href="#"> BASIC</a></p>
            <p><span>FREE</span></p>
            <div class="sale-box">
        </div>

        </div>
        <div class="price-bg">
        <ul>
          <li class="whyt"><a href="#">Artículos </a></li>
          <li><a href="#">Foros </a></li>
          <li class="whyt"><a href="#">Cursos (Gratis) </a></li>
        </ul>
        <div class="cart1">
          <a class="popup-with-zoom-anim" href="{{url('auth/register')}}">Register</a>
        </div>
        </div>
      </div>
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
        <div class="cart2">
          <a onclick="Materialize.toast('Antes de actualizar/adquirir tú membresía debes Iniciar Sesión/Registrarte', 4000)">Order</a>
        </div>
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
        <div class="cart3">
          <a onclick="Materialize.toast('Antes de actualizar/adquirir tú membresía debés Iniciar Sesión/Registrarte', 4000)">Order</a>
        </div>
        </div>
      </div>

    </div>
    </div>
    @else
    @if(Auth::user()->stripe_active == 0)
    <div class="wrap">
      <div class="pricing-grids">
      <div class="pricing-grid1">
        <div class="price-value">
            <p><a href="#"> BASIC</a></p>
            <p><span>GRATIS</span></p>
            <div class="sale-box">
        </div>

        </div>
        <div class="price-bg">
        <ul>
          <li class="whyt"><a href="#">Artículos </a></li>
          <li><a href="#">Foros </a></li>
          <li class="whyt"><a href="#">Cursos (Gratis) </a></li>
        </ul>
        <div class="cart1">
          <a class="popup-with-zoom-anim" onclick="Materialize.toast('Ya has iniciado Sesión!', 4000)">Register</a>
        </div>
        </div>
      </div>
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
<br>
<!--Cursos-->
@foreach($cursos as $curso)
  <div class="row">
    <article>
      <div class="col-md-13">
        <div class="col-md-6">
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="responsive-video" width="560" height="315" style="padding-right: 20px;" align="left" src="http://www.youtube.com/embed/{{$curso->video}}?theme=light&showinfo=0" frameborder="0"></iframe>
          </div>
        </div>
          <section aling="right">

            <a href="{{route('courses.single', $curso->slug)}}"><p style="font-family: 'Varela Round', sans-serif;font-size: 40px;"><img src="{{asset('images/'.$curso->icono)}}" class="circle"> {!!$curso->title!!}
              @if($curso->level == 1)
              <label class="badge red" style="margin-top: 7px;">PREMIUM</label>
              @else
              <label class="badge blue" style="margin-top: 7px;">GRATIS</label>
              @endif
            </p></a>
            <p>{!!substr(strip_tags($curso->description), 0, 355)!!}{!!strlen(strip_tags($curso->description)) > 355 ? '...' : ""!!}</p>
            <p style="font-family: 'Noto Sans', sans-serif;"> <i class="material-icons">access_time</i> {{date('D d, F.  (e) ', strtotime($curso->created_at))}}</p>
            <li class="divider"></li>
            <br>
            <p style="font-family: 'Noto Sans', sans-serif;"><a href="{{route('auth.profiles', $curso->user->id)}}" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Tutor del curso"><img src="{{asset('avatars/'.$curso->user->image)}}" style="width: 54px;height: 54px;border-radius: 50%;margin-right: 10px;" class="responsive-img">{!!$curso->user->name!!} </a></p>
          </section>
      </div>
      </article>
  </div>
@endforeach
<div class="row">
  <p align="center">
    <a href="{{route('courses.index')}}" style="font-family: 'Archivo Black', sans-serif;font-size: 30px;">Cursos</a>
  </p>
</div>
<!--Cursos-->

<li class="divider"></li>
<br>

<!--Artículos-->
<div class="row">
  @foreach($articulos as $articulo)
  <div class="col-md-6">
    <div class="card radius shadowDepth1">
      <div class="card__image border-tlr-radius">
        <img src="{{asset('images/'.$articulo->image)}}" alt="image" class="border-tlr-radius responsive-img">
      </div>

      <div class="card__content card__padding">
        <div class="card__share">
          <a class="share-toggle share-icon" href="{{route('articulo.single', $articulo->slug)}}"><i class="material-icons"></i></a>
        </div>

        <article class="card__article">
            <p style="font-size: 30px;">{!!$articulo->title!!}</p>
        </article>
      <div class="card__meta">
        <span style="font-family: 'Noto Sans', sans-serif;"><i style="margin-right: 3px;" class="fa fa-puzzle-piece"></i> {{$articulo->category->name}}
        <i style="margin-left: 10px;padding-right: 3px;" class="fa fa-clock-o"></i> {{date('F nS, Y', strtotime($articulo->created_at))}}
        <i align="right" style="margin-left: 10px;" class="fa fa-comments"></i> {{ $articulo->comments()->count() }}</span>
      </div>

    </div>


    <li class="divider"></li>
    <br>


    <div class="card__action">

      <div class="card__author">
          <div class="card__author-content">
            <p style="font-family: 'Noto Sans', sans-serif;color: #33b5e5;"><img src="{{asset('avatars/'.$articulo->user->image)}}" style="width: 54px;height: 54px;border-radius: 50%;margin-right: 10px;" class="responsive-img"><a href="{{route('auth.profiles', $articulo->user->id)}}">{!!$articulo->user->name!!} </a> </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
<div class="row">
  <p align="center">
    <a href="{{route('articulo.index')}}" style="font-family: 'Archivo Black', sans-serif;font-size: 30px;">Artículos</a>
  </p>
</div>
<!--Artículos-->
@endsection
