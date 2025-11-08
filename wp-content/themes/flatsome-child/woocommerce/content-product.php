<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( fl_woocommerce_version_check( '4.4.0' ) ) {
	if ( empty( $product ) || false === wc_get_loop_product_visibility( $product->get_id() ) || ! $product->is_visible() ) {
		return;
	}
} else {
	if ( empty( $product ) || ! $product->is_visible() ) {
		return;
	}
}

// Check stock status.
$out_of_stock = ! $product->is_in_stock();

// Extra post classes.
$classes = array();
$classes[] = 'product-small';
$classes[] = 'col';
$classes[] = 'has-hover';

if ( $out_of_stock )
	$classes[] = 'out-of-stock';

$product_info = get_post_meta( $product->get_id() );

$product_id = $product->get_id();
$name = $post->post_title;
$href = get_permalink( $product->get_id() );
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'woocommerce_thumbnail' )[0];

$price = '';
if ( isset( $product_info['_price'][0] ) ) {
	$price = get_woocommerce_currency_symbol() . $product_info['_price'][0];
}
$vitri = '';
if ( isset( $product_info['_vi_tri'][0] ) ) {
	$vitri = $product_info['_vi_tri'][0];
}
$giahienthi = '';
if ( isset( $product_info['_gia_hien_thi'][0] ) ) {
	$giahienthi = $product_info['_gia_hien_thi'][0];
}
?>

<div class="col large-4 small-12 non_padding_bottom">
	<div class="building-item">
		<div class="thumb">
			<a href="<?php echo $href; ?>" title="<?php echo $name; ?>">
				<img src="<?php echo $image; ?>" class="img-responsive thumb-blog lazyloaded"
					alt="<?php echo $name; ?>" />
			</a>
		</div>
		<div class="content">
			<h3><a href="<?php echo $href; ?>" title="<?php echo $name; ?>" class="name"><?php echo $name; ?></a></h3>
			<span class="vitri"><?php echo $vitri; ?></span>
			<div class="meta">
				<span class="price"><?php echo $giahienthi; ?></span>
				<span class="btn-care quan_tam js-btn-care" type="button" data-id="<?php echo $product_id; ?>">
					<span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><i class="fa fa-thumbs-up"
							aria-hidden="true"></i></span> Quan tâm </span>
			</div>
		</div>
	</div>
</div>