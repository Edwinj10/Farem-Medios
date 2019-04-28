@extends('layouts.principal')

@section('content')
<br>    <br>   
<div class="container">
    <section class="product-sec" id="product">
        <div class="row justify-content-center">
            <div class="col-md-8" align="center">
                <div class="card">
                    <div class="heading">{{ __('Register') }}</div>

                    {!!Form::open(['route'=>'register', 'method'=>'POST', 'files' =>true, 'class'=>'form-horizontal'])!!}
                    {{ csrf_field() }}
                    <div class="card-body">
                     

                     <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre y Apellido') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                        <div class="col-md-6">
                            <input id="apellido" type="text" class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}" name="apellido" value="{{ old('apellido') }}" required autofocus>

                            @if ($errors->has('apellido'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('apellido') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <!-- <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label> -->

                        <div class="col-md-6">
                            <input id="estado" type="hidden" class="form-control{{ $errors->has('estado') ? ' is-invalid' : '' }}" name="estado" value="Espera" required autofocus>

                            @if ($errors->has('estado'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('estado') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                        <div class="file">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Foto de Perfil</label>
                            <div class="col-md-6">  
                                <input type="file" id="addfotoarea" name="foto" class="form-control">
                                <div class="col-md-4">  
                                    <output id="list"></output>
                                </div>
                                @if ($errors->has('foto'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('foto') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div> -->

                    <div class="form-group row">
                     <!--  <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label> -->

                     <div class="col-md-6">
                        <input id="tipo" type="hidden" class="form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}" name="tipo" value="Usuario" required autofocus>

                        @if ($errors->has('tipo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tipo') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</section>
</div>
@endsection
