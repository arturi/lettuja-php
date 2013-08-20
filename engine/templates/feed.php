<? 
$dom = new DOMDocument('1.0', 'UTF-8');
$root = $dom->createElement('rss');
$root->setAttribute('version', '2.0');
$channel = $dom->createElement('channel');

$title_node = $dom->createElement('title');
$title_node->appendChild($dom->createTextNode($lang[$lang_slug]['blog_header']));
$channel->appendChild($title_node);

$link_node = $dom->createElement('link');
$link_node->appendChild($dom->createTextNode($site_url));
$channel->appendChild($link_node);

$desc_node = $dom->createElement('description');
$desc_node->appendChild($dom->createTextNode($lang[$lang_slug]['blog_description']));
$channel->appendChild($desc_node);

foreach($sorted_post_list_limited as $item) {
	get_post_content($item['path']);

    if (isset($item['rss']) || $item['type'] == 'page' || $item['type'] == 'custom') {
             continue; 
      	}
	
    $item_node = $dom->createElement('item');

    $title_node = $dom->createElement('title');
    $title_node->appendChild($dom->createTextNode($item['title']));
    $item_node->appendChild($title_node);
    
    $link_node = $dom->createElement('link');
    $link_node->appendChild($dom->createTextNode($item['url']));
    $item_node->appendChild($link_node);
    
    $guid = $dom->createElement('guid');
    $guid->setAttribute('isPermaLink', 'false');
    $guid->appendChild($dom->createTextNode($item['url']));
    $item_node->appendChild($guid);

    $date_node = $dom->createElement('pubDate');
    $date_node->appendChild($dom->createTextNode($item['atom_date']));
    $item_node->appendChild($date_node);
    
    $desc = $dom->createElement('description');
    $desc->appendChild($dom->createTextNode($post_content['body_parsed']));
    $item_node->appendChild($desc);
    
    $channel->appendChild($item_node);
}

$root->appendChild($channel);
$dom->appendChild($root);
file_put_contents($published_directory.$lang_path.'blog-feed.xml', $dom->saveXML());
?>