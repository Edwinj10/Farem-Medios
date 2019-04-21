<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link href="/lumino/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('../css/bootstrap-select.min.css')}}">
	<link href="/lumino/css/font-awesome.min.css" rel="stylesheet">
	<link href="/lumino/css/datepicker3.css" rel="stylesheet">
	<link href="/lumino/css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
					<a class="navbar-brand" href="/"><span>FAREM  </span>Admin</a>

				</div>
			</div>
		</nav>
		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
			<div class="profile-sidebar">
				<div class="profile-userpic">
					<img src="/imagenes/usuarios/{{ Auth::user()->foto }}" class="img-responsive" alt="">
				</div>
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">{{ Auth::user()->name }} {{ Auth::user()->apellido }}</div>
					<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="divider"></div>
			@if (Auth::user()->tipo == "Administrador" ||  Auth::user()->tipo == "SuperAdmin") 
			<ul class="nav menu">
				<li class="parent active "><a data-toggle="collapse" href="#sub-item-1">
					<em class="fa fa-users">&nbsp;</em> Usuarios <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					
					<li><a class="" href="/usuarios">
						<span class="fa fa-arrow-right">&nbsp;</span> Listar
					</a></li>
				</ul>
			</li>
			
		</ul>

		<ul class="nav menu">
			<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-laptop">&nbsp;</em> Medios <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
			</a>
			<ul class="children collapse" id="sub-item-2">
				
				<li><a class="" href="/medios">
					<span class="fa fa-arrow-right">&nbsp;</span> Listar
				</a></li>
				<!-- <li><a class="" href="/ingresos">
					<span class="fa fa-arrow-right">&nbsp;</span> Ingresos
				</a></li> -->
			</ul>
		</li>
		
	</ul>
	<ul class="nav menu">

		<li class="parent "><a data-toggle="collapse" href="#sub-item-5">
			<em class="fa fa-book">&nbsp;</em> Periodos <span data-toggle="collapse" href="#sub-item-5" class="icon pull-right"><em class="fa fa-plus"></em></span>
		</a>
		<ul class="children collapse" id="sub-item-5">
			<li><a class="" href="/periodos">
				<span class="fa fa-arrow-right">&nbsp;</span> Listar
			</a></li>
		</ul>
	</li>
</ul>
<ul class="nav menu">
	
	<li class="parent "><a data-toggle="collapse" href="#sub-item-3">
		<em class="fa fa-book">&nbsp;</em> Reservaciones <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span>
	</a>
	<ul class="children collapse" id="sub-item-3">
		<li><a class="" href="/reservaciones">
			<span class="fa fa-arrow-right">&nbsp;</span> Listar
		</a></li>
	</ul>
</li>
</ul>
@else

<ul class="nav menu">
	
	<li class="parent "><a data-toggle="collapse" href="#sub-item-3">
		<em class="fa fa-book">&nbsp;</em> Reservaciones <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span>
	</a>
	<ul class="children collapse" id="sub-item-3">
		<li><a class="" href="/reservaciones2">
			<span class="fa fa-arrow-right">&nbsp;</span> Listar
		</a></li>
	</ul>
</li>
</ul>


@endif  

<ul class="nav menu">
	<li><a class="dropdown-item" href="{{ route('logout') }}"
		onclick="event.preventDefault();
		document.getElementById('logout-form').submit();">
		{{ __('Logout') }}
	</a>

	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		@csrf
	</form>
</li>
</ul>


</div>

</div>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="/">
				<em class="fa fa-home"></em>
			</a></li>
			<li class="active">Panel de Administracion</li>
		</ol>
	</div>
	@yield('content') 
</div>



<script src="/lumino/js/jquery-1.11.1.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="/lumino/js/bootstrap.min.js"></script>
<script src="/js/precargar.js"></script>
<link rel="stylesheet" type="text/css" href="/lumino/js/jquery.alertable.css">
<script type="text/javascript" src="/lumino/js/jquery.alertable.js"></script>
<script type="text/javascript" src="/js/jquery.form.js"></script>
<script src="/lumino/js/chart.min.js"></script>
<script src="/lumino/js/chart-data.js"></script>
<script src="/lumino/js/easypiechart.js"></script>
<script src="/lumino/js/easypiechart-data.js"></script>
<script src="/lumino/js/bootstrap-datepicker.js"></script>
<script src="/lumino/js/custom.js"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>


{!!Html::script('/js/tabla.js')!!}
@stack('scripts')



</body>
</html>