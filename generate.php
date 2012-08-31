<h3>Это будущий статичный блог</h3>

<?php
$time_start = microtime(true);

include_once "markdown.php";
include_once "variables.php";

function sortByDate($a, $b) {
    return $a['date'] - $b['date'];
}

function post_sorting_data($arg) {
		$sorting_data = array();
		global $sorting_data;
	
		$fileContent = file_get_contents($arg);
		$sorting_data['slug'] = basename($arg,'.md');
		$sorting_data['path'] = $arg;
		 	  
		$meta_and_body = explode("\n\n", $fileContent, 2);
		$meta_data = explode("\n", $meta_and_body[0]);
		
		foreach ($meta_data as $meta_data_item) {
			$meta_data_item = explode(":", $meta_data_item, 2);
			
			$key_name = strtolower($meta_data_item[0]);
			$key_value = trim($meta_data_item[1]);
			
			if ($key_name == 'date') {
				$sorting_data['raw_date'] = $key_value;
				}
	
		}
	
}

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
			} elseif ($key_name == 'date') {
				$post_data['raw_date'] = $key_value;
			} elseif ($key_name == 'tags') {
				$post_data['tags'] = $key_value;
			} elseif ($key_name == 'rss') {
				$post_data['rss'] = trim($key_value);
			}
	
		}
		
		$post_data['slug'] = basename($arg,".md");
		$post_data['url'] = $site_url.$lang_path.$post_data['slug'];

		$post_data['timestamp'] = strtotime($post_data['raw_date']);
		
		if ($lang_slug == 'en') {
			$post_data['date'] = strftime("%B %e, %G", $post_data['timestamp']); // July 2, 2012
		}else{
			$post_data['date'] = strftime("%e %B %G", $post_data['timestamp']); // 2 July 2012
		}
		
		$post_data['atom_date'] = date(DATE_ATOM, $post_data['timestamp']);
		$post_data['iso_timestamp'] = date('c', $post_data['timestamp']);
		
		$post_data['body'] = $meta_and_body[1];
		$post_data['body_parsed'] = Markdown($post_data['body']);
		
		$post_cut = explode('<!--more-->', $post_data['body_parsed']);
		$post_data['body_before_cut'] = $post_cut[0];
	
}

//loop through all directories and put them into array as language slugs, like 'en' or 'ru'
$dir_names = glob($content_directory.'/*', GLOB_ONLYDIR);
foreach ($dir_names as $dir_name) {

$lang_slug = basename($dir_name, $content_directory.'content/');

// $lang_array is a name of language array, constructed from the name 'lang_' and the actual lang slug at the end. used in templates.
$lang_array = 'lang_'.$lang_slug;
$lang_locale = $lang_slug.'_'.strtoupper($lang_slug);
setlocale(LC_ALL, $lang_locale);

//check if the current language is the default one and set the path accordingly (just / for default language or /en/ for English)
if ($lang_slug == $default_language) {
	$lang_path = '/';
} else {
	$lang_path = '/'.$lang_slug.'/';
	if (!is_dir($published_directory.$lang_path)) {
	     mkdir($published_directory.$lang_path);
	}
}
  

//place all file names into array, then extract date from each post to form another array and then sort it by date 

	$file_names = glob($dir_name.'/*.md');
	$sorted_post_list = null;
		
		foreach ($file_names as $file_name) {
			post_sorting_data($file_name);
			
			$sorted_post_list[] = array('date' => $sorting_data['raw_date'], 'path' => $sorting_data['path']);
		}
		
	usort($sorted_post_list, 'sortByDate');
	$sorted_post_list = array_reverse($sorted_post_list);
	
	
//slice the file_names array to limit the number of posts on the main page

	$sorted_post_list_limited = array_slice($sorted_post_list, 0, $main_page_posts_limit);

	//write single post files
	include 'templates/single.php';

	//write archive.html content
	include 'templates/archive.php';

	//write index.html
	include 'templates/main.php';

	//write feed.xml
	include 'templates/feed.php';
	
	
	echo $lang_slug.' pages have been generated'."<br>";

	
}

$time_end = microtime(true);
$time = $time_end - $time_start;

echo "<br> Lettuja has baked all your content in $time seconds\n";
?>