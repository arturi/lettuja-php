<? foreach ($sorted_post_list as $item) {
    get_post_content($item['path']);
    
    if (isset($item['type']) && $item['type'] == 'custom') {
        $page_type = 'custom';
        
        ob_start(); 
        include 'templates/header.php';
        echo $post_content['body_parsed'];
        include 'templates/footer.php';
        $single_post = ob_get_clean();
        
    } elseif (isset($item['type']) && $item['type'] == 'page') {
        $page_type = 'page';
        
        ob_start(); 
        include 'templates/header.php'; ?>
<section class="single-page row-1">
    <article>
        <header>
            <h2><?php echo $item['title'] ?></h2>
        </header>
        <?php echo $post_content['body_parsed'] ?>
    </article>
</section>
<? include 'templates/footer.php';
        $single_post = ob_get_clean();
        
    } else {
        $page_type = 'single';
        
        ob_start();
        include 'templates/header.php'; ?>

<section class="row-1">
    <article class="post">
        <? if ( isset($item['link']) ): ?>
        <header class="post-header link">
            <h2><a href="<?= $item['link'] ?>"><?= $item['title'] ?></a> <a href="<?= $item['url'] ?>" class="arrow">→</a></h2>
            <time datetime="<?=$item['iso_timestamp'] ?>" class="post-timestamp"><?php echo $item['date'] ?></time>
        </header>
        <? else: ?>
        <header class="post-header text">
            <h2><a href="<?=$item['url'] ?>"><? echo $item['title'] ?></a></h2>
            <time datetime="<?=$item['iso_timestamp'] ?>" class="post-timestamp"><?php echo $item['date'] ?></time>
        </header>
        <? endif; ?>
        
        <div class="post-inner">
            <?php echo $post_content['body_parsed'] ?>
        </div>    
        
    </article>
</section>

<? include 'templates/footer.php';
        $single_post = ob_get_clean();
    }
    
    if (!in_array($item['slug'], $reserved_names)) {
        $single_page_directory = $published_directory . $lang_path. $item['slug'];
        
        if (!is_dir($single_page_directory)) {
            mkdir($single_page_directory, 0755, TRUE);
        }
        
        file_put_contents($single_page_directory . '/index.html', $single_post);
        
    } else {
        echo '<br>invalid filename: ' . $item['slug'] . '<br>';
    }
    
}
?>