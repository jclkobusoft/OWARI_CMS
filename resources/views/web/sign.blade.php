@extends('web.plantilla.base')          
@section('contenido')

    <!-- Start My Account Area -->
    <section class="my-account-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="login-form mb-30">
                        <h2>Inciar sesión</h2>

                        <form>
                            <div class="form-group">
                                <label>Email o What's App</label>
                                <input type="text" class="form-control" placeholder="Email o What's app">
                            </div>

                            <div class="form-group">
                                <label>Contraseña</label>
                                <input type="text" class="form-control" placeholder="Contraseña">
                            </div>

                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkme">
                                        <label class="form-check-label" for="checkme">Recordarme</label>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 lost-your-password">
                                    <a href="#" class="lost-your-password">¿Olvidates tu password?</a>
                                </div>
                            </div>

                            <button type="submit">Iniciar Sesión</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="register-form">
                        <h2>Registrate</h2>

                        <form>
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="Email">
                            </div>

                            <div class="form-group">
                                <label>Telefono o What's App</label>
                                <input type="text" class="form-control" placeholder="Telefono o What's App">
                            </div>

                            <div class="form-group">
                                <label>Contraseña</label>
                                <input type="text" class="form-control" placeholder="Contraseña">
                            </div>

                            <button type="submit">Registrar ahora</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End My Account Area -->
    @stop