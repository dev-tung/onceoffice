<?php
/*
Template name: Page - Full Width
*/
get_header(); ?>

<?php do_action( 'flatsome_before_page' ); $test = get_the_content(); ?>

<?php if ($test == '[quan-tam]') { ?>
	<?php echo do_shortcode('[block id="tieu-de-trang-quan-tam"]'); ?>
<div class="section-building building-rank category-page-row">
	<div class="container">
		<div class="row list-building col_kqtim kqtim_btn_care">
			<?php
				$products_array = array();
				if(isset($_COOKIE["btn_care"])){
					if($_COOKIE["btn_care"]){
						$products = explode(',', $_COOKIE["btn_care"]);
						foreach ($products as $key => $product) {
							$products_info = get_post( $product );

							$product_info = get_post_meta( $product );
							$price_info = '';
							if(isset($product_info['_price'][0])) {
								$price_info = get_woocommerce_currency_symbol().$product_info['_price'][0];
							}
							$vitri = '';
							if(isset($product_info['_vi_tri'][0])) {
								$vitri = $product_info['_vi_tri'][0];
							}

							$giahienthi = '';
							if(isset($product_info['_gia_hien_thi'][0])) {
								$giahienthi = $product_info['_gia_hien_thi'][0];
							}

							$products_array[] = array(
								'product_id' => $product,
								'name' => $products_info->post_title,
								'href' => get_permalink( $product ),
								'image' => wp_get_attachment_image_src( get_post_thumbnail_id( $product ), 'woocommerce_thumbnail' )[0],
								'vitri' => $vitri,
								'price' => $giahienthi
							);
						}
					}
				}
			?>
			<div class="products">
				<?php if($products_array) { ?>
				<?php foreach ($products_array as $key => $product) { ?>
			    <div class="col large-4 small-12 non_padding_bottom">
			        <div class="building-item">
			            <div class="thumb">
			                <a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>">
			                    <img src="<?php echo $product['image']; ?>" class="img-responsive thumb-blog lazyloaded" alt="<?php echo $product['name']; ?>" />
			                </a>
			            </div>
			            <div class="content">
			                <h3><a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>" class="name"><?php echo $product['name']; ?></a></h3>
			                <span class="vitri"><?php echo $product['vitri']; ?></span>
			                <div class="meta">
			                    <span class="price"><?php echo $product['price']; ?></span>
			                    <span class="btn-care quan_tam js-btn-care" type="button" data-id="<?php echo $product['product_id']; ?>">
			                        <span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> Quan tâm </span>
			                </div>
			            </div>
			        </div>
			    </div>
			    <?php } ?>
				<?php } else { ?>
					<div class="col large-12 small-12 non_padding_bottom" style="max-width: 100%;-ms-flex-preferred-size: 100%;flex-basis: 100%;">
						<span>Hiện chưa có sản phẩn nào bạn quan tâm!</span>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('body').find('.section').each(function(index, el) {
			if($(this).hasClass('title')){
				var h1 = $(this).find('h1').html().replace('{value}', $('#masthead .btn-list-care .count-care').html());
				$(this).find('h1').html(h1);
			}
		});
		
	});
</script>
<?php } else { ?>
<div id="content" role="main" class="content-area">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>
		
		<?php endwhile; // end of the loop. ?>
		
</div>
<?php } ?>
<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>
