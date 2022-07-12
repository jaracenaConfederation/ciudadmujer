@extends('layout.homeindexly')

@section('contenido')

        <div class="row col-lg-6 col-lg-offset-3">
            <div class="span12">
                <form class="form-horizontal" action="#" method="GET">
                    <fieldset>
                        <div id="legend">
                            <legend class="text-center">Bienvenido, por favor ingrese usuario y contraseña</legend>
                        </div>
                        <div class="control-group ">

                                    <!-- Username -->
                                    <label class="control-label "  for="username">Usuario</label>
                                    <div class="controls">
                                        <input type="text" id="username" name="username" placeholder="" class="input-xlarge ">
                                    </div>
                        </div>
                        <div class="control-group">

                                <!-- Password-->
                                <label class="control-label " for="password">Contraseña</label>
                                <div class="controls">
                                    <input type="password" id="password" name="password" placeholder="" class="input-xlarge ">
                                </div>
                        </div>
                        <div class="control-group">
                            <!-- Button -->
                            <br>
                            <div class="controls">
                                <button class="btn btn-success">Ingresar al Sistema</button>
                            </div>
                            <div class="controls">
                                <a href="#" class="btn btn-link">¿Olvido su contraseña?</a>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    <script>
            $('#menuprincipal').hide();

    </script>
@endsection