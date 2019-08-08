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
        <link rel="stylesheet" href="<?php echo base_url(); ?>media/vendor/simple-line-icons/css/simple-line-icons.css">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>media/css/styles.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>media/css/principal.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>media/css/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>media/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>media/css/jquery.dataTables_themeroller.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="<?= base_url(); ?>media/js/jquery.js"></script>
        <script src="<?= base_url(); ?>media/js/jquery-ui.js"></script>
        <script src="<?= base_url(); ?>media/js/jquery.maskedinput.js"></script>
        <script src="<?= base_url(); ?>media/js/jquery.dataTables.js"></script>
        <script src="<?= base_url(); ?>media/js/jquery.validate.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="<?php echo base_url(); ?>media/js/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>media/js/carbon.js"></script>     
        <script src="<?php echo base_url(); ?>media/js/validate/validate.js"></script>        
    </head>
    <body class="sidebar-fixed header-fixed">
        <div class="page-wrapper">
            <?php $this->load->view("template/header"); ?>
            <div class="main-container">
                <?php $this->load->view('template/sidebard'); ?>
                <div class="content">
                    <div class="container-fluid">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
            
        </div>         
    </body>
</html>