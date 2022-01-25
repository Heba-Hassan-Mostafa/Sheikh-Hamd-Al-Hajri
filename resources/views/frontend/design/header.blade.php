<!DOCTYPE html>
<html dir="{{ direction() }}" lang="{{ lang() }}">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta content="" name="twitter:site">
    <meta content="" name="twitter:creator">
    <meta content="" property="fb:pages">
    <meta content="" property="fb:app_id">
    <meta content="" property="fb:admins">
    <meta name="twitter:card" content="summary">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="msapplication-starturl" content="/">
    <meta name="google-site-verification" content="fC7H8MuhyZ8cj64F2gMZzcAlfgkitiHVRyuFdY2SfnE" />
   
    @yield('header')

    @include('feed::links')
    
   <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GBHXKBN92Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-GBHXKBN92Y');
</script>

    <title> {{ !empty($title) ? $title : trans('frontend/index/index.title') }} </title>


    <link rel="canonical" href="https://hamadalhajri.net/" />




    <link href="{{ asset('frontend/plugins/bootstrap-4.3.1/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/plugins/fontawesome-free-5.10.2-web/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Reem+Kufi&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600;700&amp;display=swap" rel="stylesheet">
    
    <link rel="icon" href="{{ asset('/files/home/images/'.setting()->icon) }}" />
    
    


   @if(lang() == 'en')

   <link href="{{ asset('frontend/css/home-en.css') }}" rel="stylesheet">
   <link href="{{ asset('frontend/css/pagination.css') }}" rel="stylesheet">
   <link href="{{ asset('frontend/css/content-en.css') }}" rel="stylesheet">
  
   <link href="{{ asset('frontend/css/datatables2.min.css') }}" rel="stylesheet">
   <link href="{{ asset('frontend/css/style-datatables-edit-en.css') }}" rel="stylesheet">
   <link href="{{ asset('frontend/css/videos-audios.css') }}" rel="stylesheet">
   <link href="{{ asset('frontend/css/form-en.css') }}" rel="stylesheet">
   <link href="{{ asset('frontend/css/scroll-to-top.css') }}" rel="stylesheet">

   @else 

   <link href="{{ asset('frontend/css/home.css') }}" rel="stylesheet">
   <link href="{{ asset('frontend/css/pagination.css') }}" rel="stylesheet">
   <link href="{{ asset('frontend/css/content.css') }}" rel="stylesheet">
  
   <link href="{{ asset('frontend/css/datatables2.min.css') }}" rel="stylesheet">
   <link href="{{ asset('frontend/css/style-datatables-edit.css') }}" rel="stylesheet">
   <link href="{{ asset('frontend/css/videos-audios.css') }}" rel="stylesheet">
   <link href="{{ asset('frontend/css/form.css') }}" rel="stylesheet">
   <link href="{{ asset('frontend/css/scroll-to-top.css') }}" rel="stylesheet">


    @endif


  </head>