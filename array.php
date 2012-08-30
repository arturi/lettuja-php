<?php
function parse_post_array($arg) {
		global $site_url;
		global $lang_path;
		$post_data = array();
		global $post_data;
		global $lang_slug;
		$post_data['rss'] = '';
	
		$fileContent = file_get_contents($arg);
		$fileName = basename($arg,'.md');
		 	  
		$meta_and_body = explode("\n\n", $fileContent, 2);
		$meta_data = explode("\n", $meta_and_body[0]);
		
		foreach ($meta_data as $meta_data_item) {
			$meta_data_item = explode(":", $meta_data_item, 2);
			
			$key_name = strtolower($meta_data_item[0]);
			$key_value = trim($meta_data_item[1]);
			
			if ($key_name == 'title') {
				$post_data['title'] = $key_value;
			} elseif ($key_name == 'tags') {
				$post_data['tags'] = $key_value;
			} elseif ($key_name == 'rss') {
				$post_data['rss'] = trim($key_value);
			} elseif ($key_name == 'date') {
				$post_data['date_source'] = $key_value;
			}
	
		}
	
}

$posts = array();

$file_names_array = glob("array/*.md");
	
	foreach ($file_names_array as $file_name) {
		parse_post_array($file_name);
		
		$posts[] = array('date' => $post_data['date_source'], 'name' => basename($file_name,'.md'));
	}
	
	function sortByDate($a, $b) {
	    return $a['date'] - $b['date'];
	}
	
	usort($posts, 'sortByDate');
	$posts = array_reverse($posts);
	
//	print_r($posts);

	foreach ($posts as $post) {
		$date_timestamp = strtotime($post['date']);
		echo strftime("%e %B %G", $date_timestamp).'<br>';
	}
	
?>