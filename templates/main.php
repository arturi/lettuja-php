<?php ob_start();
$page_type = 'main';
include 'templates/header.php';
?>

<section class="posts">
	<?php foreach($sorted_post_list_limited as $item): ?>
		<? get_post_content($item['path']); ?>

		<article>
			<header>
			<h2><a href="<?=$item['slug'] ?>"><?php echo $item['title'] ?></a></h2>
			<time datetime="<?=$item['iso_timestamp'] ?>"><?php echo $item['date'] ?></time>
		</header>
		<? if (isset($post_cut[1])) {
			 echo $post_content['body_before_cut'];
			 echo '<a class="cut-link" href="'.$item['url'].'">'.${$lang_array}['read_more'].' →</a>';
		} else {
			echo $post_content['body_parsed'];
		} ?>
		</article>
	
	<?php endforeach; ?>
</section>
<a href="<?= $site_url.$lang_path.'archive' ?>"><?= ${$lang_array}['archive']; ?></a>

<?php 
include 'templates/footer.php';
$mainpage = ob_get_clean();
file_put_contents($published_directory.$lang_path.'index.html', $mainpage);
?>