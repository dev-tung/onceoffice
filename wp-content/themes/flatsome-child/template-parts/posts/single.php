<?php if ( have_posts() ) : ?>

<?php /* Start the Loop */ ?>

<?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="article-inner <?php flatsome_blog_article_classes(); ?>">
		<?php
			if(flatsome_option('blog_post_style') == 'default' || flatsome_option('blog_post_style') == 'inline'){
				get_template_part('template-parts/posts/partials/entry-header', flatsome_option('blog_posts_header_style') );
			}
		?>
		<?php get_template_part( 'template-parts/posts/content', 'single' ); ?>
	</div>
</article>

<?php endwhile; ?>

<?php else : ?>

	<?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>

<?php 
$categories = get_the_category($post->ID);
if ($categories) {
	$category_ids = array();
	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
	$args=array(
		'category__in'   => $category_ids,
		'post__not_in'   => array($post->ID), //Bỏ qua bài viết hiện tại
		'posts_per_page' => 5, // Số bài viết bạn muốn hiển thị.
		'ignore_sticky_posts'=> 1,
		'no_found_rows'   => true //Bỏ qua load phân trang tăng hiệu suât query
	);
	$my_query = new wp_query($args);
	if($my_query->have_posts()) {
		echo '<div class="related-news">';
		echo '<h3>Xem các bài viết tương tự</h3>';
		echo '<ul class="related-news-list">';
		while ($my_query->have_posts()) { 
			$my_query->the_post(); 
		?>
			<li>
				<h5><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
			</li>
		<?php }
		echo '</ul>';
		echo '</div>'; 
	} 
} ?>