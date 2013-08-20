<!DOCTYPE html>
<html lang="<?= $lang_slug ?>">
<head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel="alternate" type="application/rss+xml" title="RSS" href="<?= $site_url.$lang_path.'blog-feed.xml' ?>">
        <link rel="icon" type="image/png" href="<?= $site_url ?>/assets/favicon.png">
        <!--[if IE lt 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="<?= $site_url ?>/assets/style.css"/>        
        <title><? if ($page_type == 'archive') {
	       	echo $lang[$lang_slug]['archive'].' — '.$lang[$lang_slug]['blog_header'];
	       	} elseif ($page_type == 'main') {
	       		echo $lang[$lang_slug]['blog_header'];
	       	} elseif ($page_type == 'page' | $page_type == 'custom') {
	       		echo $item['title'].' — '.$lang[$lang_slug]['site_header'];
	       	} elseif ($page_type == 'single') {
	       	   echo $item['title'].' — '.$lang[$lang_slug]['blog_header']; 
            } else {
                echo $lang[$lang_slug]['site_header'];
            }
	       ?></title>
    </head>
    <body <? if ($page_type == 'index-page') {echo 'class="index-page"';} ?> >
    
    <? if ($page_type !== 'custom'): ?>
        
        <header class="top-bar row-1">
            <h1 class="thumbnail"><?= $lang[$lang_slug]['site_header']; ?></h1>
            <? if ($page_type == 'main'): ?>
                <nav class="top-nav-menu"><a href="<?= $site_url.$lang_path ?>"><?= $lang[$lang_slug]['site_header'] ?></a> → <?= $lang[$lang_slug]['blog'] ?></nav>
    		<? elseif ($page_type == 'single' | $page_type == 'archive'): ?>
                <nav class="top-nav-menu"><a href="<?= $site_url.$lang_path ?>"><?= $lang[$lang_slug]['site_header'] ?></a> → <a href="<?=$site_url.$lang_path.'blog' ?>"><?=$lang[$lang_slug]['blog'] ?></a></nav>
            <? elseif ($item['slug'] == 'index'): ?>
                <nav class="top-nav-menu"><?= $lang[$lang_slug]['site_header'] ?></nav>
    		<? else: ?>
                <nav class="top-nav-menu"><a href="<?= $site_url.$lang_path ?>"><?=$lang[$lang_slug]['site_header'] ?></a></nav>
	    	<? endif; ?>
        </header>

    <? endif; ?>