<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo site_url(); ?>" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- loginGoogle - OT1 -->
    <meta name="google-signin-client_id" content="44392542747-1m64j0mv7ai4rv53bsvffteg5g997t3p.apps.googleusercontent.com">
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="public/otadmin/images/favicon.png"> -->
    <title><?php echo $title;?></title>
    <!-- Css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="public/dashboard/css/style.css">
    <!-- Latest compiled and minified CSS -->

    <!-- Js -->
    <script src="public/dashboard/js/jquery-3.5.1.min.js"></script>
    <!-- End Js -->

    <!-- script gooogle -OT1 -->
    <script src="https://apis.google.com/js/platform.js?onload=onLoadGoogleCallback" async defer></script>
    <!-- End script gooogle -OT1 -->
</head>
<body>
    <div id="main">
        <!-- end load modal -->
        <?php $this->load->view('dashboard/layout/header'); ?>
        <!-- load modal -->
        <?php $this->load->view('dashboard/modals/loginModal'); ?>
        <?php $this->load->view('dashboard/modals/transferModal'); ?>
        <?php $this->load->view('dashboard/modals/walletModal'); ?>
        
        <?php
            if(isset($template) && !empty($template)){
                $this->load->view($template, isset($data)?$data:NULL);
            }
        ?>
    </div>
    <div id="sidebar">
        <?php $this->load->view('dashboard/layout/sidebar'); ?>
    </div>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="public/dashboard/js/main.js"></script>
</body>
</html>
