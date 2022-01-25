@include('frontend.design.header')

<body>
    <div class="overlay"></div>
    <header>
       <!--start first-nav-->
      @include('frontend.design.navbar')
    </header>
     <div class="container">
        <h1 class="error-massage-not-found">404 Error</h1>
     </div>
           <!--start footer-->
    @include('frontend.design.footer')

   
  </body>
</html>