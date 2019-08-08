<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <link rel="shortcut icon" href="<?= base_url() ?>images/icono.ico">        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Instituto Superior Jujuy </title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {            
               $("#log_username").focus();
            } );
        </script>
    </head>
    <body class="sidebar-fixed header-fixed">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card p-4">
                        <?= form_open('login/autenticar') ?>

                        <div class="card-header text-center text-uppercase h4 font-weight-light">
                            Ingreso al Sistema
                        </div>
                        <img class="image-logo" src="<?php echo base_url(); ?>media/images/ISJ1.jpg" alt="logo">
                        <div class="card-body py-5">
                            <label class="form-control-label">Usuario</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="log_username" id="log_username">
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Contrase&ntilde;a</label>
                                <input type="password" class="form-control" name="log_pass">
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    <button  type="submit" class="btn btn-primary px-5">Iniciar sesi&oacute;n</button>
                                </div>

                            </div>
                        </div>
                        <?= form_close() ?>                       
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
