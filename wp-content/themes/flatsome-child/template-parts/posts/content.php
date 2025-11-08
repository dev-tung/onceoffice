<div class="entry-content">
	<?php if ( flatsome_option('blog_show_excerpt') || is_search())  { ?>
	<div class="entry-summary">
		<?php $excerpt      = get_the_excerpt();
			$excerpt_more = apply_filters( 'excerpt_more', ' [...]' );
			echo flatsome_string_limit_words( $excerpt, 40 ) . $excerpt_more; ?>
		<div class="text-<?php echo get_theme_mod( 'blog_posts_title_align', 'center' );?>">
			<a class="more-link button primary is-outline is-smaller" href="<?php echo get_the_permalink(); ?>"><?php _e('Xem thêm <i class="fa fa-angle-right ml-1"></i>', 'flatsome'); ?></a>
		</div>
	</div>
	<?php } else { ?>
	<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'flatsome' ) ); ?>
	<?php
		wp_link_pages();
	?>
<?php }; ?>

</div>