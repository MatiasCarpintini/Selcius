<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials._head')
  </head>
  
  <body>
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
