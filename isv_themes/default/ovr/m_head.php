﻿<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="IsVipi OSSN">
    <title><?php siteTitle($p) ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- core CSS -->
    <link href="<?php echo ISVIPI_STYLE_URL . 'default/css/bootstrap.min.css' ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="<?php echo ISVIPI_STYLE_URL . 'default/css/home.css' ?>" rel="stylesheet">
    <link href="<?php echo ISVIPI_STYLE_URL . 'default/css/home-blue.css' ?>" rel="stylesheet">
    <?php if($p === "profile" || $p === "home" || $p === "post"){?>
    	<link href="<?php echo ISVIPI_STYLE_URL . 'plugins/lightbox/featherlight.css' ?>" rel="stylesheet">
        <?php if(isset($PAGE[2]) && $PAGE[2] ==="photos"){?>
        	<link href="<?php echo ISVIPI_STYLE_URL . 'plugins/upload/css/jquery.filer.css' ?>" rel="stylesheet">
            <link href="<?php echo ISVIPI_STYLE_URL . 'plugins/upload/css/themes/jquery.filer-dragdropbox-theme.css' ?>" rel="stylesheet">
        <?php } ?>
    <?php } ?>
    <?php 
		//load only on feeds page
		if($PAGE[0] == "home" || $PAGE[0] == "feeds"){
	
	?>
        <link rel="stylesheet" href="<?php echo ISVIPI_STYLE_URL . 'plugins/link-preview/liveurl.css' ?>"/>
    <?php } ?>
    <script src="<?php echo ISVIPI_STYLE_URL . 'default/js/jquery.js' ?>"></script>
    <script src="<?php echo ISVIPI_STYLE_URL.'plugins/formsubmit/form.submit.min.js'?>"></script>
    <script src="<?php echo ISVIPI_STYLE_URL.'plugins/timer/jquery.timer.js'?>"></script>
    <script> var site_url = '<?php echo $isv_siteDetails['s_url'] ?>'; </script>
    <script>
	function load_user_notices(){
		$("#notifications").timer({
			delay: 20000, //poll every 30 sec (30000)
			repeat: true,
			url: site_url +'/notices/'
		});
	}
	</script>
    
    <link rel="shortcut icon" href="<?php echo ISVIPI_STYLE_URL .'site/imgs/'.$isv_siteSettings['favicon']?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
