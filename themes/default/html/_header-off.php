<!DOCTYPE html>
<head>
    <title><?php echo (isset($D->page_title)?$D->page_title:$K->SITE_TITLE); ?></title>
	<meta http-equiv="cleartype" content="on">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo $K->SITE_URL ?>" />
    <link href="<?php echo getImageTheme('favicon.ico')?>" rel="shortcut icon" />
    <style>
        .back{ background-color:#314F85; font-family: tahoma,verdana,arial,sans-serif; color:#FFF; }
        .space-logo{ text-align:center; margin-top:100px; }
        .space-message1{ text-align:center; font-size:30px; margin-top:50px; }
        .space-message2{ text-align:center; font-size:18px; margin-top:30px; }
    </style>
    <?php require_once('_analytics.php');?>
</head>
<body class="back">
<div id="wrapper">