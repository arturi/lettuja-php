<?php 
$page_type = 'archive';
ob_start();
include 'templates/header.php'; ?>

<section class="row-1 post-inner">
    <header class="post-header text">
        <h2><?= $lang[$lang_slug]['archive'] ?></h2>
    </header>
    
    <ul class="archive-list">
        
        <?php foreach ($sorted_post_list as $item): ?>
        
        <? if ($item['type'] == 'page' || $item['type'] == 'custom'): ?>
        
        <? continue; ?>
        
        <? endif; ?>
        
        <li>
            <a href="<?= $site_url . $lang_path . $item['slug'] ?>"><?= $item['title'] ?></a>   <time class="archive-time" datetime="<?=$item['iso_timestamp'] ?>"><?php echo $item['date'] ?></time>
        </li>
        
        <?php endforeach; ?>
        
    </ul>
</section>

<?php 
include 'templates/footer.php';
$archive = ob_get_clean();

$archive_directory = $published_directory . $lang_path . 'archive';

if (!is_dir($archive_directory)) {
    mkdir($archive_directory, 0755, TRUE);
}

file_put_contents($archive_directory . '/index.html', $archive);
?>