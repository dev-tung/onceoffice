<?php
$display_type = get_term_meta( get_queried_object_id(), 'display_type', true );
$slug = '';
$slugs = get_term( get_queried_object_id() );
$parent = get_queried_object_id();

if ( ! $slugs->errors ) {
	$slug = $slugs->slug;
}
$filter_ = '';

if ( $display_type == 'both' ) {
	echo '<div class="display_type_both">';
	do_action( 'woocommerce_archive_description' );
	echo '</div>';
}
foreach ( $_GET as $key => $value ) {
	if ( strpos( $key, 'filter_' ) !== false ) {
		$values = explode( ',', $value );
		$taxonomy = 'pa_' . str_replace( 'filter_', '', $key );
	}
}
if ( isset( $values ) ) {
	if ( $values ) {
		foreach ( $values as $key => $value ) {
			$term = get_term_by( 'slug', $value, $taxonomy );
			if ( $term ) {
				$description_term = $term->description;
				$name_term = $term->name;
				$filter_ = $term->slug;
			}
		}
	}
}

$actual_link = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_links = explode( '?', $actual_link );

$actual_links2 = explode( '/', $actual_links[0] );

$flatsomechild = explode( '/', get_stylesheet_directory_uri() );
$count_flatsomechild = ( count( $flatsomechild ) - 3 );
$tenmien = '';
for ( $i = 0; $i < $count_flatsomechild; $i++ ) {
	$tenmien .= $flatsomechild[ $i ] . '/';
}
/*print_r($actual_links2);
print_r('<br>');*/
$flag_category = 0;
$actual_temp = '';
if ( isset( $actual_links2[ $count_flatsomechild + 1 ] ) ) {
	if ( $actual_links2[ $count_flatsomechild + 1 ] ) {
		$slug = $actual_links2[ $count_flatsomechild ];
		$actual_temp = $actual_links[0];
		$actual_links[0] = $tenmien . $actual_links2[ $count_flatsomechild ];
		$flag_category = 1;

		$term_parent = get_term( get_queried_object_id() );
		$parent = $term_parent->parent;
	}
}
/*print_r($slug);
print_r('<br>');
print_r($actual_links[0]);*/

$categories = array();
$categories_info = get_term_children( $parent, 'product_cat' );

if ( $categories_info ) {
	/*echo '<ul>';*/
	foreach ( $categories_info as $category ) {
		$term = get_term( $category, 'product_cat' );

		/*echo '<li>';
		echo '<a href="'.get_term_link($term).'" >';
		echo $term->name;
		echo '</a>';
		echo '</li>';*/

		$args = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => '9',
			'tax_query' => array(
				array(
					'taxonomy' => 'product_cat',
					'field' => 'term_id', //This is optional, as it defaults to 'term_id'
					'terms' => $category,
					'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
				),
			)
		);

		$products = array();
		$products_info = new WP_Query( $args );
		foreach ( $products_info->posts as $key => $post ) {
			//print_r($post);

			$product_info = get_post_meta( $post->ID );
			$price_info = '';
			if ( isset( $product_info['_price'][0] ) ) {
				$price_info = get_woocommerce_currency_symbol() . $product_info['_price'][0];
			}
			$vitri = '';
			if ( isset( $product_info['_vi_tri'][0] ) ) {
				$vitri = $product_info['_vi_tri'][0];
			}

			$giahienthi = '';
			if ( isset( $product_info['_gia_hien_thi'][0] ) ) {
				$giahienthi = $product_info['_gia_hien_thi'][0];
			}

			$products[] = array(
				'product_id' => $post->ID,
				'name' => $post->post_title,
				'href' => get_permalink( $post->ID ),
				'image' => wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'woocommerce_thumbnail' )[0],
				'vitri' => $vitri,
				'price' => $giahienthi
			);
		}

		$categories[] = array(
			'category_id' => $category,
			'name' => $term->name,
			'href' => get_term_link( $term ),
			'products' => $products
		);
	}
	/*echo '</ul>';*/
}

function goiSP() {
	if ( fl_woocommerce_version_check( '3.4.0' ) ? woocommerce_product_loop() : have_posts() ) {

		/**
		 * Hook: woocommerce_before_shop_loop.
		 *
		 * @hooked wc_print_notices - 10
		 * @hooked woocommerce_result_count - 20 (FL removed)
		 * @hooked woocommerce_catalog_ordering - 30 (FL removed)
		 */
		do_action( 'woocommerce_before_shop_loop' );

		woocommerce_product_loop_start();

		if ( wc_get_loop_prop( 'total' ) ) {
			while ( have_posts() ) {
				the_post();

				/**
				 * Hook: woocommerce_shop_loop.
				 *
				 * @hooked WC_Structured_Data::generate_product_data() - 10
				 */
				do_action( 'woocommerce_shop_loop' );

				wc_get_template_part( 'content', 'product' );
			}
		}

		woocommerce_product_loop_end();

		/**
		 * Hook: woocommerce_after_shop_loop.
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action( 'woocommerce_after_shop_loop' );
	} else {
		/**
		 * Hook: woocommerce_no_products_found.
		 *
		 * @hooked wc_no_products_found - 10
		 */
		do_action( 'woocommerce_no_products_found' );
	}
}

function goiSP_danhmuccon( $flag_category, $categories, $actual_temp ) {

	if ( $flag_category == 1 && $categories ) {
		echo '<div class="search-filter js-search-filter"><div class="search-fixed"><div id="filter-form" class="collapse in js-form-collapse"><div class="form-search"><div class="search-field quan"><ul class="list-filter quan_filter">';
		foreach ( $categories as $key => $category ) {
			$a_class = '';
			if ( $actual_temp == $category['href'] ) {
				$a_class = 'active';
			}
			echo '<li> <a href="' . $category['href'] . '" class="btn-filter js-btn-quan-filter ' . $a_class . '">' . $category['name'] . '</a></li>';
		}

		echo '</ul></div></div></div></div></div>';
	}

	goiSP();


	$display_type = get_term_meta( get_queried_object_id(), 'display_type', true );
	if ( $display_type == '' ) {
		echo '<div class="display_type_none">';
		do_action( 'woocommerce_archive_description' );
		echo '</div>';
	}
} ?>

<?php
function goiSP_danhmuccon_custom( $flag_category, $categories, $actual_temp ) {

	if ( $flag_category == 1 && $categories ) {
		echo '<div class="search-filter js-search-filter"><div class="search-fixed"><div id="filter-form" class="collapse in js-form-collapse"><div class="form-search"><div class="search-field quan"><ul class="list-filter quan_filter">';
		foreach ( $categories as $key => $category ) {
			$a_class = '';
			if ( $actual_temp == $category['href'] ) {
				$a_class = 'active';
			}
			echo '<li> <a href="' . $category['href'] . '" class="btn-filter js-btn-quan-filter ' . $a_class . '">' . $category['name'] . '</a></li>';
		}

		echo '</ul></div></div></div></div></div>';
	}

	$args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts' => 1,
		'posts_per_page' => '40',
		'tax_query' => array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'term_id', //This is optional, as it defaults to 'term_id'
				'terms' => get_queried_object_id(),
				'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
			),
		)
	);

	$products2 = array();
	$products_info = new WP_Query( $args );
	foreach ( $products_info->posts as $key => $post ) {
		$product_info = get_post_meta( $post->ID );
		$products2[] = array(
			'product_id' => $post->ID,
			'name' => $post->post_title,
			'href' => get_permalink( $post->ID ),
			'image' => wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'woocommerce_thumbnail' )[0],
			'vitri' => $product_info['_vi_tri'][0],
			'price' => get_woocommerce_currency_symbol() . $product_info['_price'][0]
		);
	} ?>

	<div class="section-building building-rank">
		<div class="row list-building">
			<?php if ( $products2 ) { ?>
				<?php foreach ( $products2 as $key => $product ) { ?>
					<div class="col large-4 small-12 non_padding_bottom">
						<div class="building-item">
							<div class="thumb">
								<a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>">
									<img src="<?php echo $product['image']; ?>" class="img-responsive thumb-blog lazyloaded"
										alt="<?php echo $product['name']; ?>" />
								</a>
							</div>
							<div class="content">
								<h3><a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>"
										class="name"><?php echo $product['name']; ?></a></h3>
								<span class="vitri"><?php echo $product['vitri']; ?></span>
								<div class="meta">
									<span class="price"><?php echo $product['price']; ?></span>
									<span class="btn-care quan_tam js-btn-care" type="button"
										data-id="<?php echo $product['product_id']; ?>">
										<span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><i class="fa fa-thumbs-up"
												aria-hidden="true"></i></span> Quan tâm </span>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } else { ?>
				<div class="col large-12 small-12 non_padding_bottom">
					<span>Hiện chưa có sản phẩn trong danh mục này!</span>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>

<div class="row category-page-row">
	<div class="col large-3 hide-for-medium <?php flatsome_sidebar_classes(); ?> <?php if ( isset( $_GET['kqtim'] ) ) {
		   if ( $_GET['kqtim'] == 1 ) {
			   echo 'hidden';
		   }
	   } else if ( isset( $_GET['s'] ) ) {
		   echo 'hidden';
	   } ?>">
		<?php flatsome_sticky_column_open( 'category_sticky_sidebar' ); ?>
		<div id="shop-sidebar" class="sidebar-inner col-inner">
			<aside id="nav_menu" class="widget widget_nav_menu">
				<div class="">
					<ul id="menu" class="menu">
						<li id="menu-item" class="menu-item menu-item-type-taxonomy menu-item-object-category <?php if ( ! isset( $actual_links[1] ) ) {
							echo 'current-menu-item';
						} ?>">
							<a href="<?php echo $actual_links[0]; ?>">Tìm theo quận và giá</a>
						</li>
						<li id="menu-item" class="menu-item menu-item-type-taxonomy menu-item-object-category <?php if ( isset( $_GET['tim'] ) ) {
							if ( $_GET['tim'] == 'theoquan' ) {
								echo 'current-menu-item';
							}
						} ?>">
							<a href="<?php echo $actual_links[0]; ?>?tim=theoquan">Tìm theo quận</a>
						</li>
						<li id="menu-item" class="menu-item menu-item-type-taxonomy menu-item-object-category <?php if ( isset( $_GET['tim'] ) ) {
							if ( $_GET['tim'] == 'theoduong' ) {
								echo 'current-menu-item';
							}
						} else if ( isset( $_GET['kqtim'] ) ) {
							if ( $_GET['kqtim'] == 2 ) {
								echo 'current-menu-item';
							}
						} ?>">
							<a href="<?php echo $actual_links[0]; ?>?tim=theoduong">Tìm theo đường</a>
						</li>
						<li id="menu-item" class="menu-item menu-item-type-taxonomy menu-item-object-category <?php if ( isset( $_GET['tim'] ) ) {
							if ( $_GET['tim'] == 'theoten' ) {
								echo 'current-menu-item';
							}
						} else if ( isset( $_GET['s'] ) ) {
							echo 'current-menu-item';
						} ?>">
							<a href="<?php echo $actual_links[0]; ?>?tim=theoten">Tìm theo tên tòa nhà</a>
						</li>
					</ul>
				</div>
			</aside>
			<?php
			if ( is_active_sidebar( 'shop-sidebar' ) ) {
				dynamic_sidebar( 'shop-sidebar' );
			} else {
				echo '<p>You need to assign Widgets to <strong>"Shop Sidebar"</strong> in <a href="' . get_site_url() . '/wp-admin/widgets.php">Appearance > Widgets</a> to show anything here</p>';
			}
			?>
		</div>
		<?php flatsome_sticky_column_close( 'category_sticky_sidebar' ); ?>
	</div>

	<div class="col large-9 <?php if ( isset( $_GET['kqtim'] ) ) {
		if ( $_GET['kqtim'] == 1 ) {
			echo 'col_kqtim';
		}
	} else if ( isset( $_GET['s'] ) ) {
		echo 'col_kqtim';
	} ?>">

		<?php if ( isset( $_GET['tim'] ) ) {
			if ( $_GET['tim'] == 'theoquan' ) {
				echo '<div class="search-filter js-search-filter quan-page"><div class="search-fixed"><div id="filter-form" class="collapse in js-form-collapse"><div class="form-search"><div class="search-field quan"><h3>Chọn 1 quận</h3><ul class="list-filter quan_filter"></ul></div></div></div></div></div>';
			} else if ( $_GET['tim'] == 'theoduong' ) {
				$mang_abcds = array( "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z" );
				echo '<div class="form-search search-duong"><h3 class="search-title">Tìm theo bảng chữ cái</h3><div class="list-duong">';
				foreach ( $mang_abcds as $key => $mang_abcd ) {
					echo '<div class="chucai hidden" chucai="' . $mang_abcd . '"><h3 class="character-title">' . $mang_abcd . '</h3><div class="body_chucai"></div><span class="line-item"></span></div>';
				}
				echo '<div class="chucai hidden" chucai="PH"><h3 class="character-title">PH</h3><div class="body_chucai"></div><span class="line-item"></span></div>';
				echo '</div></div>';
			} else if ( $_GET['tim'] == 'theoten' ) {
				echo '<div class="form-search search-title-building"><h3 class="search-title"></h3><div class="search-suggest"></div></div>';
			}
		} else if ( isset( $_GET['s'] ) ) {

		} else {
			$kqtim = '';
			if ( isset( $_GET['kqtim'] ) ) {
				$kqtim = 'hidden';
			} else if ( isset( $_GET['s'] ) ) {
				$kqtim = 'hidden';
			} else if ( $flag_category == 1 ) {
				$kqtim = 'hidden';
			}
			echo '<div class="search-filter js-search-filter quan-gia-page ' . $kqtim . '"><div class="search-fixed js-search-fixed" style="left: auto; width: auto;"><div id="filter-form" class="collapse in js-form-collapse"><div class="form-search"><form role="search" method="post" id="search-tour-form"> <div class="search-field quan"><h3></h3><div class="list-filter quan_filter row" data-arg="building_quan"><div class="col large-12"></div></div></div><div class="search-field gia"><div class="price-filter" data-base-url="/ha-noi/" data-arg="price_filter"><h3></h3><div class="layout js-data-price" data-min="10" data-max="50" data-currency="$"><div class="layout-slider" style="width: 100%"> <span style="display: inline-block; width: 100%; padding: 0 5px;"></span></span></div></div></div><div class="note"> <i class="fa fa-info"></i> <span class="note-item">Giá hạng A: <span>$25-$50</span></span> <span class="note-item">Giá hạng B: <span>$15-$25</span></span> <span class="note-item">Giá hạng C: <span>$10-$15</span></span></div></div> <div class="btn btn-default tz-search-btn">Tìm văn phòng phù hợp</div></form></div></div></div></div>';
		} ?>

		<?php
		/**
		 * Hook: woocommerce_before_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20 (FL removed)
		 * @hooked WC_Structured_Data::generate_website_data() - 30
		 */
		do_action( 'woocommerce_before_main_content' );

		?>



		<?php
		if ( isset( $_GET['tim'] ) ) {
			if ( $_GET['tim'] == 'theoduong' ) {

			} else if ( $_GET['tim'] == 'theoten' ) {

			} else if ( $flag_category == 1 ) {
				if ( $categories ) {
					goiSP_danhmuccon( $flag_category, $categories, $actual_temp );
				}
			} else {
				goiSP();
			}
		} else if ( $flag_category == 1 ) {
			if ( $categories ) {
				goiSP_danhmuccon( $flag_category, $categories, $actual_temp );
			}
		} else if ( $flag_category == 0 && ( ! isset( $actual_links[1] ) ) ) { ?>

					<div class="section-building building-rank">
				<?php foreach ( $categories as $category ) { ?>
							<div class="sec-building-top">
								<h3 class="heading"><?php echo $category['name']; ?></h3>
								<a class="readmore" href="<?php echo $category['href']; ?>">Xem thêm <i
										class="fa fa-angle-right"></i></a>
							</div>
							<div class="row list-building">
						<?php if ( $category['products'] ) { ?>
							<?php foreach ( $category['products'] as $key => $product ) { ?>
										<div class="col large-4 small-12 non_padding_bottom">
											<div class="building-item">
												<div class="thumb">
													<a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>">
														<img src="<?php echo $product['image']; ?>" class="img-responsive thumb-blog lazyloaded"
															alt="<?php echo $product['name']; ?>" />
													</a>
												</div>
												<div class="content">
													<h3><a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>"
															class="name"><?php echo $product['name']; ?></a></h3>
													<span class="vitri"><?php echo $product['vitri']; ?></span>
													<div class="meta">
														<span class="price"><?php echo $product['price']; ?></span>
														<span class="btn-care quan_tam js-btn-care" type="button"
															data-id="<?php echo $product['product_id']; ?>">
															<span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><i class="fa fa-thumbs-up"
																	aria-hidden="true"></i></span> Quan tâm </span>
													</div>
												</div>
											</div>
										</div>
							<?php } ?>
						<?php } else { ?>
									<div class="col large-12 small-12 non_padding_bottom">
										<span>Hiện chưa có sản phẩn trong danh mục này!</span>
									</div>
						<?php } ?>
							</div>
				<?php } ?>
					</div>

		<?php } else {
			goiSP();
		} ?>

		<?php
		/**
		 * Hook: flatsome_products_after.
		 *
		 * @hooked flatsome_products_footer_content - 10
		 */
		do_action( 'flatsome_products_after' );
		/**
		 * Hook: woocommerce_after_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
		?>
	</div>
</div>
<?php echo do_shortcode( '[block id="lien-he-tu-van-bao-gia"]' ); ?>
<?php echo do_shortcode( '[block id="doi-ngu-tu-van-luon-san-sang"]' ); ?>

<?php if ( isset( $description_term ) ) { ?>
	<?php if ( ( $description_term ) ) { ?>
		<div class="section kinh_nghiem">
			<div class="section-content relative">
				<div class="row">
					<div class="col small-12 large-12">
						<div class="col-inner">
							<h2 class="sec-title">Văn phòng cho thuê tại <?php echo $name_term; ?></h2>
							<div class="tabbed-content tabbed_content_description_term">
								<div class="tab-panels">
									<div class="panel active entry-content">
										<?php echo $description_term; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } else {
		echo do_shortcode( '[block id="thong-tin-kinh-nghiem-thue-van-phong"]' );
	} ?>
<?php } else {
	echo do_shortcode( '[block id="thong-tin-kinh-nghiem-thue-van-phong"]' );
} ?>

<script type="text/javascript">
	jQuery(document).ready(function ($) {

		var pa_quan = 'pa_quan-' + '<?php echo $slug; ?>';
		$('#shop-sidebar').find('.woocommerce-widget-layered-nav-list').each(function (index, el) {
			var taxonomy = $(this).attr('taxonomy');
			var taxonomy_replace = taxonomy.replace('pa_quan-', '');
			var slug_search = '<?php echo $slug; ?>';
			//console.log(slug_search.search(taxonomy_replace));

			if (slug_search.search(taxonomy_replace) >= 0) {
				var widget_title = $(this).parent().find('span.widget-title').html();
				$('.quan-gia-page .quan h3').html(widget_title);

				$(this).find('li').each(function (index2, el) {
					var slug = $(this).find('a').attr('slug');
					var name = $(this).find('a').html();
					$('.quan-gia-page .quan .quan_filter .col').append('<div class="item"><label class="custom-checkbox" id="' + slug + '"><input type="checkbox" name="quan_filter" value="' + slug + '"><span class="checkmark" id="' + slug + '"></span>' + name + '</label></div>');

					var filter_ = '<?php echo $filter_; ?>';
					var class_active = '';
					if (filter_ == slug) {
						class_active = 'active';
					}
					var url = '<?php echo $actual_links[0]; ?>?tim=theoquan&query_type_quan-' + taxonomy_replace + '=or&filter_quan-' + taxonomy_replace + '=' + slug;
					$('.quan-page .quan .quan_filter').append('<li><a href="' + url + '" class="btn-filter js-btn-quan-filter ' + class_active + '">' + name + '</a></li>');
				});
			}
		});

		var pa_duong = 'pa_duong-' + '<?php echo $slug; ?>';
		$('#shop-sidebar').find('.woocommerce-widget-layered-nav-list').each(function (index, el) {
			var taxonomy = $(this).attr('taxonomy');
			var taxonomy_replace = taxonomy.replace('pa_duong-', '');
			var slug_search = '<?php echo $slug; ?>';
			//console.log(slug_search.search(taxonomy_replace));

			if (slug_search.search(taxonomy_replace) >= 0) {
				$(this).find('li').each(function (index2, el) {
					var slug = $(this).find('a').attr('slug');
					var name = $(this).find('a').html();
					var chucai = name.charAt(0);
					if (chucai == 'Đ') {
						chucai = 'D';
					}

					var url = '<?php echo $actual_links[0]; ?>?query_type_duong-' + taxonomy_replace + '=or&filter_duong-' + taxonomy_replace + '=' + slug + '&kqtim=2';
					$('.search-duong .list-duong').find('.chucai').each(function (index, el) {
						if ($(this).attr('chucai') == chucai) {
							$(this).removeClass('hidden');
							$(this).children('.body_chucai').append('<a class="duong-item" href="' + url + '" rel="bookmark">' + name + '</a>');
						}
					});

				});
			}
		});

		var pa_phuong = 'pa_phuong-' + '<?php echo $slug; ?>';
		$('#shop-sidebar').find('.woocommerce-widget-layered-nav-list').each(function (index, el) {
			var taxonomy = $(this).attr('taxonomy');
			var taxonomy_replace = taxonomy.replace('pa_phuong-', '');
			var slug_search = '<?php echo $slug; ?>';
			//console.log(slug_search.search(taxonomy_replace));

			if (slug_search.search(taxonomy_replace) >= 0) {
				$(this).find('li').each(function (index2, el) {
					var slug = $(this).find('a').attr('slug');
					var name = $(this).find('a').html();
					var chucai = 'PH';

					var url = '<?php echo $actual_links[0]; ?>?query_type_phuong-' + taxonomy_replace + '=or&filter_phuong-' + taxonomy_replace + '=' + slug + '&kqtim=2';

					$('.search-duong .list-duong').find('.chucai').each(function (index, el) {
						if ($(this).attr('chucai') == chucai) {
							$(this).removeClass('hidden');
							$(this).children('.body_chucai').append('<a class="duong-item" href="' + url + '" rel="bookmark">' + name + '</a>');
						}
					});

				});
			}
		});

		var html_filter_price = $('.widget_price_filter').html();
		if (html_filter_price) {
			$('.quan-gia-page .gia .layout-slider').html('<aside id="woocommerce_price_filter-12" class="widget woocommerce widget_price_filter">' + html_filter_price + '</aside>');
			var widget_title = $('.widget_price_filter').find('span.widget-title').html();
			$('.quan-gia-page .gia h3').html(widget_title);
		} else {
			$('.quan-gia-page .gia h3').html('Không tìm thấy khoảng giá này phù hợp!');
		}


		$('.form-search .tz-search-btn').click(function (event) {
			var kq_pa_quan = '';
			$('.quan-gia-page .quan .quan_filter').find('input:checked').each(function (index, el) {
				if (index > 0) {
					kq_pa_quan += ',';
				}
				kq_pa_quan += $(this).val();
			});

			var pa_quan = 'pa_quan-' + '<?php echo $slug; ?>';
			$('#shop-sidebar').find('.woocommerce-widget-layered-nav-list').each(function (index, el) {
				var taxonomy = $(this).attr('taxonomy');
				var taxonomy_replace = taxonomy.replace('pa_quan-', '');
				var slug_search = '<?php echo $slug; ?>';
				//console.log(slug_search.search(taxonomy_replace));

				if (slug_search.search(taxonomy_replace) >= 0) {
					var kq_gia = '';
					if ($('.quan-gia-page .gia .layout-slider .price_slider_amount .from').html() && $('.quan-gia-page .gia .layout-slider .price_slider_amount .to').html()) {
						var min_price = $('.quan-gia-page .gia .layout-slider .price_slider_amount .from').html().replace('$', '');
						var max_price = $('.quan-gia-page .gia .layout-slider .price_slider_amount .to').html().replace('$', '');
						kq_gia = '&min_price=' + min_price + '&max_price=' + max_price;
					}
					var url = '<?php echo $actual_links[0]; ?>?query_type_quan-' + taxonomy_replace + '=or&filter_quan-' + taxonomy_replace + '=' + kq_pa_quan + kq_gia + '&kqtim=1';
					window.location.href = url;
				}

			});
		});

		var html_product_search = $('.widget_product_search').html();
		$('.form-search .search-suggest').html('<aside id="woocommerce_product_search-2" class="widget woocommerce widget_product_search">' + html_product_search + '</aside>');
		var widget_title = $('.widget_product_search').find('span.widget-title').html();
		$('.form-search .search-title').html(widget_title);
		$('.search-title-building .ux-search-submit').html('Xem chi tiết tòa nhà');
	});
</script>