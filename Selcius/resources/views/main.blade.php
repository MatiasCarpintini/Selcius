<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials._head')
  </head>

  <body>
  <style media="screen">
      body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
        }

        main {
        flex: 1 0 auto;
    }
    </style>
    @include('partials._nav')
    <main>
        <div class="container">

          @include('partials._messages')

          @yield('content')


        </div> <!-- end of .container -->
    </main>
    @include('partials._footer')
    @include('partials._javascript')

    @yield('scripts')
  </body>
</html>
