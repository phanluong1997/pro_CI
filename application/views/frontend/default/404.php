<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo site_url(); ?><?php echo isset($url)?$url:'';?>" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="upload/system/thumb/<?php echo $data_index['system']['thumb'];?>">
	<meta id="ctl00_key" name="keywords" content="<?php echo $data_index['system']['meta_keyword'];?>" />
	<meta id="ctl00_Des" name="description" content="<?php echo $data_index['system']['meta_description'];?>" />
</head>
<body>
	<div class="page_404">
		<h1>404</h1>
		<p>Trang này không tồn tại.Vui lòng kiểm tra lại</p>
		<a href="<?php echo base_url();?>"><i class="fas fa-long-arrow-alt-right"></i> Quay về trang chủ</a>
	</div>
	<a href="#" id="back-to-top" title="Back to top">&uarr;</a>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
	<link rel="stylesheet" type="text/css" href="public/css/404.css">
</body>
</html>