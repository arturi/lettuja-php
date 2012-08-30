<?php ob_start();
include 'templates/header.php'; ?>

<ul>

<?php foreach ($file_names as $file) {
	parse_post_array($file); ?>
<li>
<a href="<?php echo $post_data['slug'] ?>"><?php echo $post_data['title'] ?></a>
</li>
<?php } ?>

</ul>

<?php 
include 'templates/footer.php';
$archive = ob_get_clean();
file_put_contents($published_directory.$lang_path.'archive.html', $archive);
?>