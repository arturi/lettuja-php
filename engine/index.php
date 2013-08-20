<?php
ini_set('display_errors', 'On');
$time_start = microtime(true);

require_once "markdown.php";
require_once "settings.php";
require_once "functions.php";

//loop through all directories and put them into array as language slugs, like 'en' or 'ru'
$languages = glob($content_directory.'/*', GLOB_ONLYDIR);

foreach ($languages as $language) {
    $lang_slug = basename($language, $content_directory);
    
    // $lang_array is a name of language array, constructed from the name 'lang_' and the actual lang slug at the end. used in templates.
    $lang_array = 'lang_'.$lang_slug;
    
    if (!is_dir($published_directory)) {
        mkdir($published_directory);
    }
    
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
    $sorted_post_list = array();
    
    foreach (glob($language.'/*.md') as $post_file) {
        get_post_metadata($post_file);
        //        $file_names[] = [ 'path' => $post_file, 'slug' => basename($post_file, '.md'), 'modified' => strftime("%e.%m.%G", filemtime($post_file)), 'title' => $post_metadata['title'] ];
        $sorted_post_list[] = $post_metadata;
    }
    
    //sort posts by timestamp and display in reverse chronological order
    usort($sorted_post_list, 'sortByTimestamp');
    $sorted_post_list = array_reverse($sorted_post_list);
    
    //limit the number of posts on the main page
    $sorted_post_list_limited = array_slice($sorted_post_list, 0, $main_page_posts_limit);
    
    include 'templates/single.php';
    include 'templates/main.php';
    include 'templates/cover.php';
    
    include 'templates/archive.php';
    include 'templates/feed.php';
    
    recurse_copy($media_directory, $published_directory . '/media');
    recurse_copy($assets_directory, $published_directory . '/assets');
    
    echo $lang_slug.' pages have been generated'."<br>";
}

$time_end = microtime(true);
$time = $time_end - $time_start;

echo "<br> Lettuja has baked all your content in $time seconds\n";
?>