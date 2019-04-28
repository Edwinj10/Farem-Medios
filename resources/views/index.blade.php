@extends ('layouts.principal')
@section ('content')

<!-- bienvenida -->
<div class="jumbotron" id="home">
 <div class="container">
   <div class="row">
     <div class="col-md-6 col-sm-12 content-sec">
      <h1 id="black">Bienvenidos</h1>
      <p id="black">Sistema de Reservación de Medios | FAREM-Estelí |</p>
      <!-- <p><a class="btn btn-tranparent btn-lg" href="#" role="button">Learn more</a></p> -->
    </div>
  </div>
</div>
</div>

@if(Session::has('message'))
 <div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  {{Session::get('message')}}
</div>
@endif

<!-- como usar la pagina -->
<section class="product-sec" id="product">

  <div class="container">

    <div class="row">
      <div class="col-lg-12 col-md-12">
        <h2 class="text-center"><small class="text-green">¿Cómo utilizar la página web correctamente?</small><br /></h2>
      </div>
    </div>

    <div class="row product-block">
     <div class="col-lg-3 col-md-3 col-md-offset-1 col-sm-12">
       <!-- <div class="img-sec"><img src="img/product-01.jpg" class="img-circle img-responsive"></div> -->
     </div>
     <div class="col-lg-7 col-md-7 col-sm-12">
      <div class="content-block">
        <div class="heading">Inicia sesión o regístrate</div>
        <p>Si todavía no tienes una cuenta dentro de la aplicación web, debes crearla hacienda clic en el siguiente enlace donde solo necesitaras llenar algunos datos, cabe mencionar que después de completar los datos, el administrador del sistema debe de aprobar el uso de tu cuenta para poder iniciar sesión.</p>
        <!-- <a href="#" class="btn btn-green">Read more</a> -->
      </div>
    </div>



  </div>

  <div class="row product-block">

   <div class="col-lg-4 col-md-4 col-sm-12 pull-right">
       <!-- <div class="img-sec"><img src="img/product-02.jpg" class="img-circle img-responsive"></div> -->
   </div>
   <div class="col-lg-7 col-md-7 pull-left col-md-offset-1 col-sm-12">
    <div class="content-block">
      <div class="heading">Sistema de reservación de medios</div>
      <p>Esta aplicación web es útil para la reservación de recursos por vía web, esta herramienta da la opción de hacer edición, actualización, agregar, entre otras opciones desde la comodidad del lugar donde se encuentre en el dispositivo que desea hacerlo.</p>
      <!-- <a href="#" class="btn btn-green">Read more</a> -->
    </div>
  </div>



</div>

<!-- <div class="row product-block">
  <div class="col-lg-3 col-md-3 col-md-offset-1 col-sm-12">
   <div class="img-sec"><img src="img/product-03.jpg" class="img-circle img-responsive"></div>
 </div>
 <div class="col-lg-7 col-md-7 col-sm-12">
  <div class="content-block">
    <div class="heading">Product Name Goes here</div>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    <a href="#" class="btn btn-green">Read more</a>
  </div>
</div>



</div> -->


</div> <!-- /container -->

</section>

    






@endsection