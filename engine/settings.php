<?php
date_default_timezone_set('Europe/Moscow');

$dir = dirname(__FILE__);
$content_directory = '../input';
$published_directory = '../output';
$media_directory = '../media';
$assets_directory = '../assets';
$default_language = 'ru';
$main_page_posts_limit = '15';
$site_url = '/lettuja/output';
$reserved_names = array('archive', 'index', 'blog');

$lang['ru'] = array(
    "site_header" => 'Артур Пайкин',
    
    "blog_header" => 'Блог Артура Пайкина',
    
    "author_name" => 'Артур Пайкин',
    
    "blog_description" => '',
    
    "blog" => 'Блог',
    
    "read_more" => 'Читать',
    
    "archive" => 'Архив',
    
    "cover_page_text" => '<p>Меня зовут Артур Пайкин. Я <a href="blog">веду блог</a>, езжу на Стриде, <a href="https://www.facebook.com/thetipicoffee">завариваю кофе в Аэропрессе</a> и путешествую. Занимаюсь <a href="http://unebaguette.com">веб-разработкой и дизайном</a>.</p>

<p>У меня есть <a href="http://instagram.com/arturi">Инстаграм</a>, <a href="http://facebook.com/arturpaikin">Фэйсбук</a> и <a href="http://twitter.com/arturi">Твиттер</a>.</p>

<p>Мне можно написать письмо по адресу <a href="mailto:artur@arturpaikin.com">artur@arturpaikin.com</a>.</p>

<p><a href="'. $site_url . '/en">In English</a></p>'
);

$lang['en'] = array(
    "site_header" => 'Artur Paikin',
    
    "blog_header" => 'Artur Paikin’s blog', 
    
    "author_name" => 'Artur Paikin',
    
    "blog_description" => '',
    
    "blog" => 'Blog',
    
    "read_more" => 'Read',
    
    "archive" => 'Archive',
    
    "cover_page_text" => '<p>My name is Artur Paikin. I blog, ride on Strida, <a href="https://www.facebook.com/thetipicoffee">brew coffee with AeroPress</a> and travel. I am <a href="http://unebaguette.com">a web-developer and designer</a>.</p>

<p>Follow me on <a href="http://instagram.com/arturi">Instagram</a>, <a href="http://facebook.com/arturpaikin">Facebook</a> and <a href="http://twitter.com/arturi">Twitter</a>.</p>

<p>You can email me at <a href="mailto:artur@arturpaikin.com">artur@arturpaikin.com</a>.</p>

<p><a href="' . $site_url . '/">По-русски</a></p>'
    
);

?>