<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<<meta name="autor" content="Edwin José Pérez Altamirano" />
	<meta name="generator" content="Laravel 5.7" />
	<meta name="description" content="Esta aplicación fue programada en PHP utilizando laravel en su version 5.7. Correo de contacto edwinjosealtamirano@gmail.com" />
	<!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
	<title>@yield('title','Sistema de Reservaciones | FAREM-Estelí')</title>
	<link rel="icon" href="../../favicon.ico">

	<title>Bootstrap Buisness Template</title>

	@include('complementos.style')

</head>

<body>


	<!-- menu -->
	@include('complementos.menu')

	@yield('content')  


	@include('complementos.script')
	@stack('script')



</body>
</html>
