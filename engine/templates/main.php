<?php ob_start();
$page_type = 'main';
include 'templates/header.php';
?>

<section class="row-1">
    
    <? foreach($sorted_post_list_limited as $item): ?>
        <? get_post_content($item['path']); ?>
        
        <? if ($item['type'] == 'page' || $item['type'] == 'custom'): ?>
            <? continue; ?>
        <? endif; ?>
        
        <article class="post">
            <? if ( isset($item['link']) ): ?>
                <header class="post-header link">
                    <h2><a href="<?= $item['link'] ?>"><?= $item['title'] ?></a> <a href="<?= $item['url'] ?>" class="arrow">→</a></h2>
                </header>
            <? else: ?>
                <header class="post-header text">
                    <h2><a href="<?=$item['url'] ?>"><? echo $item['title'] ?></a></h2>
                </header>
            <? endif; ?>
            
            <div class="post-inner">
                <? if ( isset($post_cut[1]) ) {
                echo $post_content['body_before_cut'];
                echo "<a class=\"read-more\" href=\"" . $item["url"] . "\">" . $lang[$lang_slug]["read_more"] . " →</a>";
    
                } else {
                    echo $post_content['body_parsed'];
                } ?>
            </div>
            
        </article>
    
    <? endforeach; ?>
    
        <div class="archive-link"><a href="<?= $site_url.$lang_path.'archive' ?>">→</a></div>
</section>


<?php 
include 'templates/footer.php';
$mainpage = ob_get_clean();

$mainpage_directory = $published_directory . $lang_path. 'blog';

	if (!is_dir($mainpage_directory)) {
    	mkdir($mainpage_directory, 0755, TRUE);
    }

file_put_contents($mainpage_directory . '/index.html', $mainpage);
?>