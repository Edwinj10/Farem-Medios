<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>Bootstrap Buisness Template</title>

  @include('complementos.style')

</head>

<body>


<!-- menu -->
@include('complementos.menu')

@yield('content')  

@include('complementos.footer')
@include('complementos.script')
@stack('script')



</body>
</html>
