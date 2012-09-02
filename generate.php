<h3>Это будущий статичный блог</h3>

<?php
$time_start = microtime(true);

include_once "markdown.php";
include_once "variables.php";
include_once "functions.php";

//loop through all directories and put them into array as language slugs, like 'en' or 'ru'
$dir_names = glob($content_directory.'/*', GLOB_ONLYDIR);
foreach ($dir_names as $dir_name) {

$lang_slug = basename($dir_name, $content_directory);

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
		
		//get metadata like title and date from each file
		foreach ($file_names as $file_name) {
			get_post_metadata($file_name);
			
			//put each metadata item into $meta_array
			foreach ($post_metadata as $metadata_item => $metadata_item_value) {
				 $meta_array[$metadata_item] = $metadata_item_value;
			}
			
			//put each $meta_array into sorted_post_list array
			$sorted_post_list[] = $meta_array;
			
//			$sorted_post_list[] = array('timestamp' => $post_metadata['timestamp'], 'raw_date' => $post_metadata['raw_date'], 'date' => $post_metadata['date'], 'date_modified' => $post_metadata['date_modified'], 'path' => $post_metadata['path'], 'url' => $post_metadata['url'], 'slug' => $post_metadata['slug'], 'title' => $post_metadata['title']);

			}
		
		
	usort($sorted_post_list, 'sortByTimestamp');
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