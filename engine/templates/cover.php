<?php 
$page_type = 'index-page';
ob_start();
include 'templates/header.php'; ?>

<section class="row-2 cover-page">
        <?=$lang[$lang_slug]['cover_page_text'] ?>
</section>

<?php 
include 'templates/footer.php';
$cover = ob_get_clean();
file_put_contents($published_directory . $lang_path . 'index.html', $cover);
?>