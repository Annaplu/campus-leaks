<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>@yield('title', 'Campus Leaks')</title>

   <!-- CSS -->
   <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
   <link rel="icon" href="{{ asset('images/logo1.png') }}" type="image/png">
   <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Righteous&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
   <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>
<body>

   @include('components.header')

   <main style="padding-top: 100px;">
      @yield('content')
   </main>

   @include('components.footer')

   <!-- Javascript files -->
   <script src="{{ asset('js/jquery.min.js') }}"></script>
   <script src="{{ asset('js/popper.min.js') }}"></script>
   <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('js/jquery-3.0.0.min.js') }}"></script>
   <script src="{{ asset('js/plugin.js') }}"></script>
   <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
   <script src="{{ asset('js/custom.js') }}"></script>
   <script src="{{ asset('js/owl.carousel.js') }}"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

</body>
</html>
