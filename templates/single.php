<? foreach ($file_names as $file) {
	parse_post_array($file);
	
ob_start(); 
$page_type = 'single';
include 'templates/header.php'; ?>
    
<section class="posts">
	<article>
		<header>
			<h2><?php echo $post_data['title'] ?></h2>
			<time datetime="<?=$post_data['iso_timestamp'] ?>"><?php echo $post_data['date'] ?></time>
		</header>
		<?php echo $post_data['body_parsed'] ?>
	</article>
</section>

<? include 'templates/footer.php';

$single_post = ob_get_clean();
file_put_contents($published_directory.$lang_path.$post_data['slug'].'.html', $single_post); 

	}
?>