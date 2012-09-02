<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <!--<link rel="alternate" type="application/rss+xml" title="RSS" href="<?= $site_url.$lang_path.'feed.xml' ?>" />-->
        <link rel="shortcut icon" href="assets/favicon.png">
        <meta name="viewport" content="width=device-width">
        <!--[if IE]>
        <script src="ie-is-an-idiot.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="<?= $site_url ?>/assets/style.css"/>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>-->
        <title>
        <? if ($page_type == 'main') {
        	echo ${$lang_array}['blog_header'];
        } else {
        echo $item['title'].' — '.${$lang_array}['blog_header']; } ?>
        </title>
    </head>
    <!-- livereload.app stuff -->
    <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')
    </script>
    <!-- -->
    <body>
    
    <header class="top">
    		<img class="avatar" src="<?= $site_url ?>/assets/arthat_square_2x.jpg">
    		
    		<? if ($page_type == 'main'): ?>
    			<h1><?=${$lang_array}['blog_header'] ?></h1>
    		<? else: ?>
    			<h1><a href="<?= $site_url ?>"><?=${$lang_array}['blog_header'] ?></a></h1>
	    	<? endif ?>
    </header>