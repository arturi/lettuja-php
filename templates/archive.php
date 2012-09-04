<?php ob_start();
include 'templates/header.php'; ?>

<ul class="archive-list">

<?php foreach ($sorted_post_list as $item): ?>
<li>
<a href="<?= $item['slug'] ?>"><?= $item['title'] ?></a><time class="archive-time" datetime="<?=$item['iso_timestamp'] ?>"><?php echo $item['date'] ?></time>
</li>
<?php endforeach; ?>

</ul>

<?php 
include 'templates/footer.php';
$archive = ob_get_clean();
file_put_contents($published_directory.$lang_path.'archive.html', $archive);
?>