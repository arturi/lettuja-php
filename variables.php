<?php
date_default_timezone_set('Europe/Moscow');

$dir = dirname(__FILE__);
$content_directory = 'content';
$published_directory = 'published';
$default_language = 'ru';
$main_page_posts_limit = '15';
$site_url = 'http://192.168.2.104:8888/lettuja';

$lang_ru = array(
    "blog_header" => 'Артур Пайкин',
    
    "author_name" => 'Артур Пайкин',
    
    "read_more" => 'Читать',
    
    "menu_items" => '<li><a href="1">Путешествия</a></li>
    <li><a href="1">Проекты</a></li>
    <li><a href="2">Инстаграм</a></li>
    <li><a href="3">Твиттер</a></li>
    <li><a href="4">Фэйсбук</a></li>'
);

$lang_en = array(
    "blog_header" => 'Artur Paikin',
    
    "author_name" => 'Артур Пайкин',
    
    "read_more" => 'Read',
    
    "menu_items" => '<li><a href="1">Travel</a></li>
    <li><a href="1">Projects</a></li>
    <li><a href="2">Instagram</a></li>
    <li><a href="3">Twitter</a></li>
    <li><a href="4">Facebook</a></li>'
);

?>