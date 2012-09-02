<? foreach ($sorted_post_list as $item) {
	get_post_content($item['path']);
	
ob_start(); 
$page_type = 'single';
include 'templates/header.php'; ?>
    
<section class="posts">
	<article>
		<header>
			<h2><?php echo $item['title'] ?></h2>
			<time datetime="<?=$item['iso_timestamp'] ?>"><?php echo $item['date'] ?></time>
		</header>
		<?php echo $post_content['body_parsed'] ?>
	</article>
</section>

<? include 'templates/footer.php';

$single_post = ob_get_clean();
file_put_contents($published_directory.$lang_path.$item['slug'].'.html', $single_post); 

	}
?>