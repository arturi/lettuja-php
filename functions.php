<?php

function sortByTimestamp($a, $b) {
    return $a['timestamp'] - $b['timestamp'];
}

function get_post_metadata($arg) {
		global $post_metadata;
		global $site_url;
		global $lang_path;
		global $lang_slug;
		global $post_data;
		
		$post_metadata = NULL;
		$post_metadata['raw_date'] = NULL;
	
		$fileContent = file_get_contents($arg);
		
		$post_metadata['slug'] = basename($arg,'.md');
		$post_metadata['url'] = $site_url.$lang_path.$post_metadata['slug'];
		$post_metadata['path'] = $arg;
		$post_metadata['date_modified'] = filemtime($arg);
		 	  
		$meta_and_body = explode("\n\n", $fileContent, 2);
		$meta_data = explode("\n", $meta_and_body[0]);
		
		foreach ($meta_data as $meta_data_item) {
			$meta_data_item = explode(":", $meta_data_item, 2);
			
			$key_name = strtolower($meta_data_item[0]);
			$key_value = trim($meta_data_item[1]);
			
			if ($key_name == 'date') {
				$post_metadata['raw_date'] = $key_value;
			} elseif ($key_name == 'title') {
				$post_metadata['title'] = $key_value;
			} elseif ($key_name == 'tags') {
				$post_metadata['tags'] = $key_value;
			} elseif ($key_name == 'rss') {
				$post_metadata['rss'] = trim($key_value);
			}
				
		$post_metadata['timestamp'] = strtotime($post_metadata['raw_date']);
				
		if ($lang_slug == 'en') {
			// July 2, 2012
			$post_metadata['date'] = strftime("%B %e, %G", $post_metadata['timestamp']); 
		} else {
			// 2 July 2012
			$post_metadata['date'] = strftime("%e %B %G", $post_metadata['timestamp']);
			}
			$post_metadata['atom_date'] = date(DATE_ATOM, $post_metadata['timestamp']);
			$post_metadata['iso_timestamp'] = date('c', $post_metadata['timestamp']);
		}
	
}

function get_post_content($arg) {
		global $post_content;
		global $post_cut;
		
		$post_cut = NULL;
		$post_content = NULL;
	
		$fileContent = file_get_contents($arg);
		$fileName = basename($arg,'.md');
		 	  
		$meta_and_body = explode("\n\n", $fileContent, 2);
		$meta_data = explode("\n", $meta_and_body[0]);
			
		$post_content['body'] = $meta_and_body[1];
		$post_content['body_parsed'] = Markdown($post_content['body']);
		
		$post_cut = explode('<!--more-->', $post_content['body_parsed']);
		$post_content['body_before_cut'] = $post_cut[0];
	
}

?>