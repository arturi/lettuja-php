<?php

//parse_post_array($sorted_post_list_limited[0]);

$atom_feed = '<?xml version="1.0" encoding="utf-8"?>';
$atom_feed .= '<feed xmlns="http://www.w3.org/2005/Atom">';
$atom_feed .= '<title>'.${$lang_array}['blog_header'].'</title>';
$atom_feed .= '<link href="'.$site_url.'/feed.xml" rel="self" />';
$atom_feed .= '<link href="'.$site_url.'" />';
$atom_feed .= '<updated>'.$post_data['timestamp'].'</updated>';
$atom_feed .= '<id>'.$site_url.'</id>';
$atom_feed .= '<author><name>'.${$lang_array}['author_name'].'</name></author>';

foreach ($sorted_post_list_limited as $item) {
	parse_post_array($item['path']);
	
	if ($post_data['rss'] !== 'no') {
	
	$atom_feed .= '<entry>';
	$atom_feed .= '<title type="html">'.$post_data['title'].'</title>';
	$atom_feed .= '<link href="'.$post_data['url'].'"/>';
	$atom_feed .= '<updated>'.$post_data['atom_date'].'</updated>';
	$atom_feed .= '<id>'.$post_data['url'].'</id>';
	$atom_feed .= '<content type="html">'.$post_data['body_parsed'].'</content>';
	$atom_feed .= '</entry>';	
	
	}
 }

$atom_feed .= '</feed>';

file_put_contents($published_directory.$lang_path.'feed.xml', $atom_feed);

?>


