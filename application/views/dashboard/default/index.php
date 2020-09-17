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
    <!-- Js -->
</head>

<body>
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
