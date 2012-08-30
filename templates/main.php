<?php ob_start();
$page_type = 'main';
include 'templates/header.php';
?>

<section class="posts">
	<?php foreach($mainpage_array as $file): ?>
		<? parse_post_array($file); ?>

		<article>
			<header>
			<h2><a href="<?=$post_data['slug'] ?>"><?php echo $post_data['title'] ?></a></h2>
			<time datetime="<?=$post_data['iso_timestamp'] ?>"><?php echo $post_data['date'] ?></time>
		</header>
		<? if ($post_data['body_before_cut'] !== NULL) {
			 echo $post_data['body_before_cut'];
			 echo '<a class="cut-link" href="'.$post_data['url'].'">'.${$lang_array}['read_more'].' →</a>';
		} else {
			echo $post_data['body_parsed'];
		} ?>
		</article>
	
	<?php endforeach; ?>
</section>

<?php 
include 'templates/footer.php';
$mainpage = ob_get_clean();
file_put_contents($published_directory.$lang_path.'index.html', $mainpage);
?>