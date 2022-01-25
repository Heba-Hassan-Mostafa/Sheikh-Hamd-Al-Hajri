@section('header')
<meta name="keywords" content="{{ setting()->keywords }}">
<meta name="description" content="{{ setting()->description }}">
<meta name="author" content="{{ setting()->siteName }}">
@endsection
 
 @include('frontend.design.header')

  <body>
    <div class="overlay"></div>
    <header>

     @include('frontend.design.navbar')
    </header>
  
    @yield('content')
    
    <!--start footer-->
  
    
    @include('frontend.design.footer')

  </body>
</html>