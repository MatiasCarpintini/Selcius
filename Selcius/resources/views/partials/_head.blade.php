
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="_token" content="{{ csrf_token() }}">

<title>Selcius @yield('title')</title>
<!--Fonts-->
<!--Chars-->

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<!--Charts-->

<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>

<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="/css/styles.scss">

<!--EndFonts-->

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">


  <!-- Bootstrap 3.3.6 -->
  <!-- Font Awesome -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">


  <!-- Include Editor style. -->
  <link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.5/css/froala_editor.min.css' rel='stylesheet' type='text/css' />

  <link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.5/css/froala_style.min.css' rel='stylesheet' type='text/css' />

  <!-- Include Editor Plugins style. -->
  <link rel="stylesheet" href="/css/plugins/char_counter.css">
  <link rel="stylesheet" href="/css/plugins/code_view.css">
  <link rel="stylesheet" href="/css/plugins/colors.css">
  <link rel="stylesheet" href="/css/plugins/emoticons.css">
  <link rel="stylesheet" href="/css/plugins/file.css">
  <link rel="stylesheet" href="/css/plugins/fullscreen.css">
  <link rel="stylesheet" href="/css/plugins/image.css">
  <link rel="stylesheet" href="/css/plugins/image_manager.css">
  <link rel="stylesheet" href="/css/plugins/line_breaker.css">
  <link rel="stylesheet" href="/css/plugins/quick_insert.css">
  <link rel="stylesheet" href="/css/plugins/table.css">
  <link rel="stylesheet" href="/css/plugins/video.css">
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="/css/materialize.min.css" href="/css/materialize.min.css" rel="stylesheet">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

    <script type="css/styles.js"></script>
    <link rel="stylesheet" type="css/styles.css" href="css/styles.css">

<link rel="stylesheet" type="css/materialize.css" href="
https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.css">
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css"  media="screen,projection"/>
{{Html::style('css/styles.css')}}
{{Html::style('css/styles.min.css')}}
{{Html::style('css/icons.css')}}

@yield('stylesheets')

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
