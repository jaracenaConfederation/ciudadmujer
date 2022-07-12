<!DOCTYPE html>
<html>
    <head>
        <title>Laravel Bootstrap Datepicker</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

        {{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}

        {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>--}}
        <!--   ----------------------------------------- -->

        <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
        <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

    </head>
    <body>
            <div class="container">
                <div class="row">
                    <div class='col-sm-6'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker5'>
                                <input type='text' class="form-control" />
                                <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker5').datetimepicker({


                            });
                        });
                    </script>
                </div>
            </div>


            <div class="container">
                <div class='col-md-5'>
                    <div class="form-group">
                        <div class='input-group date' id='fecha1'>
                            <input type='text' class="form-control " />
                            <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                        </div>
                    </div>
                </div>

                <div class='col-md-5'>
                    <div class="form-group">
                        <div class='input-group date' id='fecha2'>
                            <input type='text' class="form-control "   />
                            <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                        </div>
                    </div>
                </div>
            </div>


            <script type="text/javascript">
                    $(function () {

                    $('#fecha1').datetimepicker({
                        useCurrent: false,
                        format: 'DD-MM-YYYY',
                        locale:'es',
                    });

                    $('#fecha2').datetimepicker({
                        useCurrent: false,
                        format: 'DD-MM-YYYY',
                        locale: 'es',
                    });
                    $("#fecha1").on("dp.change", function (e) {
                        $('#fecha2').data("DateTimePicker").minDate(e.date);
                    });
                    $("#fecha2").on("dp.change", function (e) {
                        $('#fecha1').data("DateTimePicker").maxDate(e.date);
                    });
                });
            </script>

    </body>

</html>