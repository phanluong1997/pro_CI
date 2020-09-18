<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo site_url(); ?>" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="public/otadmin/images/favicon.png">
    <title><?php echo $title;?></title>
    <!-- Css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="public/dashboard/css/style.css">
    <!-- Js -->
</head>

<body>
    <div id="main">
        <header id="header">
            <div class="header-pc">
                <div class="logo">
                    <a href="" class="logo-icon router-link-active">
                        <img src="https://bc.game/img/mainlogo.5b57169a.svg" alt="" class="main-logo">
                    </a>
                </div>
                <div class="nav">
                    <ul>
                        <li><a href="">Home</a></li>
                        <li><a href="">Game</a></li>
                        <li><a href="">Bonus</a></li>
                    </ul>
                </div>
                
                <div class="right">
                    <button type="button" class="xbutton head-button xbutton-gray xbadge-wrap">
                        <i class="fas fa-wallet" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="xbutton head-button xbutton-gray xbadge-wrap">
                        <i class="fa fa-bell" aria-hidden="true"></i>
                    </button>
                    <a class="xbutton login-button">
                        <span class="login-icon">
                            <i class="fas fa-user-alt" aria-hidden="true"></i>
                        </span>
                        <span class="login-label">SIGN IN</span>
                    </a>
                </div>
            </div>
            <div class="sub-header">
                <div class="sub-header-wrap">
                    <div id="broadcast">
                        <img src="https://bc.game/img/horn.ec3d01d0.svg" alt="" class="hron-img">
                        <div class="msg">
                            <div class="text">WELCOME <i>Betepoonimma</i> JOIN THE GAME</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <div id="sidebar">
        <div class="content">
        </div>
    </div>
    <!-- /#wrapper -->
    <div id="wrapper">
        <?php $this->load->view('dashboard/layout/header'); ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php
                    if(isset($template) && !empty($template)){
                        $this->load->view($template, isset($data)?$data:NULL);
                    }
                ?>
            </div>
            <?php $this->load->view('dashboard/layout/footer'); ?>
        </div>
    </div>
    <!-- /#wrapper -->
</body>

</html>
