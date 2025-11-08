<?php
$display_type = get_term_meta( get_queried_object_id(), 'display_type', false );

$parent = get_queried_object_id();

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

$flag_category = 0;
$actual_temp = '';
if ( isset( $actual_links2[ $count_flatsomechild + 1 ] ) ) {
	if ( $actual_links2[ $count_flatsomechild + 1 ] ) {
		$actual_temp = $actual_links[0];
		$actual_links[0] = $tenmien . $actual_links2[ $count_flatsomechild ];
		$flag_category = 1;

		$term_parent = get_term( get_queried_object_id() );
		$parent = $term_parent->parent;
	}
}

$categories = array();
$categories_info = get_term_children( $parent, 'product_cat' );

if ( $categories_info ) {
	/*echo '<ul>';*/
	foreach ( $categories_info as $category ) {
		$term = get_term( $category, 'product_cat' );

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
	// Xử lý filter parameters
	$additional_tax_query = array();
	$additional_meta_query = array();
	$has_search = false;

	// Kiểm tra search term
	$search_term = '';
	if ( ! empty( $_GET['s'] ) ) {
		$search_term = sanitize_text_field( $_GET['s'] );
		$has_search = true;
	}

	// Xử lý attribute filters
	foreach ( $_GET as $key => $value ) {
		if ( strpos( $key, 'filter_' ) === 0 && ! empty( $value ) ) {
			$taxonomy = 'pa_' . str_replace( 'filter_', '', $key );
			$values = array_map( 'trim', explode( ',', $value ) );
			$values = array_filter( $values ); // Remove empty values

			if ( ! empty( $values ) ) {
				$additional_tax_query[] = array(
					'taxonomy' => $taxonomy,
					'field' => 'slug',
					'terms' => $values,
					'operator' => 'IN',
				);
			}
		}
	}

	// Xử lý price filters
	if ( ! empty( $_GET['min_price'] ) || ! empty( $_GET['max_price'] ) ) {
		$min_price = ! empty( $_GET['min_price'] ) ? floatval( $_GET['min_price'] ) : 0;
		$max_price = ! empty( $_GET['max_price'] ) ? floatval( $_GET['max_price'] ) : 999999;

		$additional_meta_query[] = array(
			'key' => '_price',
			'value' => array( $min_price, $max_price ),
			'compare' => 'BETWEEN',
			'type' => 'NUMERIC'
		);
	}

	// Nếu có search term hoặc filter, kiểm tra có danh mục con không
	if ( $has_search || ! empty( $additional_tax_query ) || ! empty( $additional_meta_query ) ) {
		$parent_id = get_queried_object_id();
		$child_categories = get_term_children( $parent_id, 'product_cat' );

		if ( $child_categories && ! is_wp_error( $child_categories ) ) {
			// Có danh mục con - nhóm kết quả theo từng danh mục con
			$has_result = false;
			echo '<div class="section-building building-rank">';
			foreach ( $child_categories as $child_cat_id ) {
				$term = get_term( $child_cat_id, 'product_cat' );
				if ( ! $term || is_wp_error( $term ) )
					continue;

				$args = array(
					'post_type' => 'product',
					'post_status' => 'publish',
					'posts_per_page' => 9, // Giới hạn 9 sản phẩm mỗi danh mục con khi tìm kiếm
					'paged' => 1, // Luôn lấy trang đầu tiên cho mỗi danh mục con khi tìm kiếm
					'tax_query' => array_merge(
						array(
							array(
								'taxonomy' => 'product_cat',
								'field' => 'term_id',
								'terms' => $child_cat_id,
							)
						),
						$additional_tax_query
					),
				);
				if ( $has_search ) {
					$args['s'] = $search_term;
				}
				if ( ! empty( $additional_meta_query ) ) {
					$args['meta_query'] = $additional_meta_query;
				}

				$query = new WP_Query( $args );
				if ( $query->have_posts() ) {
					$has_result = true;
					// Tạo link Xem thêm giữ lại các param filter/search và thay product_cat bằng slug danh mục con
					$term_link = get_term_link( $term );
					$params = $_GET;
					$params['product_cat'] = $term->slug;
					$query_str = http_build_query( $params );
					$full_link = $term_link . ( $query_str ? ( strpos( $term_link, '?' ) === false ? '?' : '&' ) . $query_str : '' );
					echo '<div class="sec-building-top">';
					echo '<h3 class="heading">' . esc_html( $term->name ) . '</h3>';
					echo '<a class="readmore" href="' . esc_url( $full_link ) . '">Xem thêm <i class="fa fa-angle-right"></i></a>';
					echo '</div>';
					echo '<div class="row list-building">';
					while ( $query->have_posts() ) {
						$query->the_post();
						global $post;
						$product_info = get_post_meta( $post->ID );
						$vitri = isset( $product_info['_vi_tri'][0] ) ? $product_info['_vi_tri'][0] : '';
						$giahienthi = isset( $product_info['_gia_hien_thi'][0] ) ? $product_info['_gia_hien_thi'][0] : '';
						if ( empty( $giahienthi ) && isset( $product_info['_price'][0] ) ) {
							$giahienthi = get_woocommerce_currency_symbol() . $product_info['_price'][0];
						}
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'woocommerce_thumbnail' );
						$image_url = $image ? $image[0] : '';
						echo '<div class="col large-4 small-12 non_padding_bottom">';
						echo '<div class="building-item">';
						echo '<div class="thumb">';
						echo '<a href="' . get_permalink( $post->ID ) . '" title="' . esc_attr( get_the_title() ) . '">';
						echo '<img src="' . esc_url( $image_url ) . '" class="img-responsive thumb-blog lazyloaded" alt="' . esc_attr( get_the_title() ) . '" />';
						echo '</a>';
						echo '</div>';
						echo '<div class="content">';
						echo '<h3><a href="' . get_permalink( $post->ID ) . '" title="' . esc_attr( get_the_title() ) . '" class="name">' . get_the_title() . '</a></h3>';
						echo '<span class="vitri">' . esc_html( $vitri ) . '</span>';
						echo '<div class="meta">';
						echo '<span class="price">' . esc_html( $giahienthi ) . '</span>';
						echo '<span class="btn-care quan_tam js-btn-care" type="button" data-id="' . esc_attr( $post->ID ) . '"><span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> Quan tâm </span>';
						echo '</div>';
						echo '</div>';
						echo '</div>';
						echo '</div>';
					}
					echo '</div>';
					// Không hiển thị phân trang khi tìm kiếm/filter, chỉ lấy tối đa 9 sản phẩm
					wp_reset_postdata();
				}
			}
			if ( ! $has_result ) {
				do_action( 'woocommerce_no_products_found' );
			}
			echo '</div>';
		} else {
			// Không có danh mục con - hiển thị kết quả có phân trang trong danh mục hiện tại
			$current_term = get_queried_object();
			$current_slug = $current_term ? $current_term->slug : '';

			// Lấy tham số phân trang
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

			$args = array(
				'post_type' => 'product',
				'post_status' => 'publish',
				'posts_per_page' => 9,
				'paged' => $paged,
				'tax_query' => array_merge(
					array(
						array(
							'taxonomy' => 'product_cat',
							'field' => 'slug',
							'terms' => $current_slug,
						)
					),
					$additional_tax_query
				),
			);

			if ( $has_search ) {
				$args['s'] = $search_term;
			}
			if ( ! empty( $additional_meta_query ) ) {
				$args['meta_query'] = $additional_meta_query;
			}

			$query = new WP_Query( $args );

			echo '<div class="section-building building-rank">';
			if ( $query->have_posts() ) {
				echo '<div class="row list-building">';
				while ( $query->have_posts() ) {
					$query->the_post();
					global $post;

					$product_info = get_post_meta( $post->ID );
					$vitri = isset( $product_info['_vi_tri'][0] ) ? $product_info['_vi_tri'][0] : '';
					$giahienthi = isset( $product_info['_gia_hien_thi'][0] ) ? $product_info['_gia_hien_thi'][0] : '';

					if ( empty( $giahienthi ) && isset( $product_info['_price'][0] ) ) {
						$giahienthi = get_woocommerce_currency_symbol() . $product_info['_price'][0];
					}

					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'woocommerce_thumbnail' );
					$image_url = $image ? $image[0] : '';

					echo '<div class="col large-4 small-12 non_padding_bottom">';
					echo '<div class="building-item">';
					echo '<div class="thumb">';
					echo '<a href="' . get_permalink( $post->ID ) . '" title="' . esc_attr( get_the_title() ) . '">';
					echo '<img src="' . esc_url( $image_url ) . '" class="img-responsive thumb-blog lazyloaded" alt="' . esc_attr( get_the_title() ) . '" />';
					echo '</a>';
					echo '</div>';
					echo '<div class="content">';
					echo '<h3><a href="' . get_permalink( $post->ID ) . '" title="' . esc_attr( get_the_title() ) . '" class="name">' . get_the_title() . '</a></h3>';
					echo '<span class="vitri">' . esc_html( $vitri ) . '</span>';
					echo '<div class="meta">';
					echo '<span class="price">' . esc_html( $giahienthi ) . '</span>';
					echo '<span class="btn-care quan_tam js-btn-care" type="button" data-id="' . esc_attr( $post->ID ) . '"><span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> Quan tâm </span>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
				}
				echo '</div>';

				// Hiển thị phân trang
				$total_pages = $query->max_num_pages;
				if ( $total_pages > 1 ) {
					$current_page = max( 1, $paged );

					// Build query string từ $_GET (trừ paged)
					$params = $_GET;
					unset( $params['paged'] );
					$query_string = ! empty( $params ) ? '?' . http_build_query( $params ) : '';

					echo '<nav class="woocommerce-pagination">';
					echo '<ul class="page-numbers nav-pagination links text-center">';

					// Previous button
					if ( $current_page > 1 ) {
						$prev_page = $current_page - 1;
						$prev_url = ( $prev_page == 1 ) ?
							get_term_link( get_queried_object_id() ) . $query_string :
							get_term_link( get_queried_object_id() ) . 'page/' . $prev_page . '/' . $query_string;
						echo '<li><a class="prev page-number" href="' . esc_url( $prev_url ) . '"><i class="icon-angle-left"></i></a></li>';
					}

					// Page numbers
					$start_page = max( 1, $current_page - 2 );
					$end_page = min( $total_pages, $current_page + 2 );

					// First page link if needed
					if ( $start_page > 1 ) {
						$first_url = get_term_link( get_queried_object_id() ) . $query_string;
						echo '<li><a class="page-number" href="' . esc_url( $first_url ) . '">1</a></li>';
						if ( $start_page > 2 ) {
							echo '<li><span class="page-number dots">…</span></li>';
						}
					}

					// Page range
					for ( $i = $start_page; $i <= $end_page; $i++ ) {
						if ( $i == 1 ) {
							$page_url = get_term_link( get_queried_object_id() ) . $query_string;
						} else {
							$page_url = get_term_link( get_queried_object_id() ) . 'page/' . $i . '/' . $query_string;
						}

						if ( $i == $current_page ) {
							echo '<li><span aria-current="page" class="page-number current">' . $i . '</span></li>';
						} else {
							echo '<li><a class="page-number" href="' . esc_url( $page_url ) . '">' . $i . '</a></li>';
						}
					}

					// Last page link if needed
					if ( $end_page < $total_pages ) {
						if ( $end_page < $total_pages - 1 ) {
							echo '<li><span class="page-number dots">…</span></li>';
						}
						$last_url = get_term_link( get_queried_object_id() ) . 'page/' . $total_pages . '/' . $query_string;
						echo '<li><a class="page-number" href="' . esc_url( $last_url ) . '">' . $total_pages . '</a></li>';
					}

					// Next button
					if ( $current_page < $total_pages ) {
						$next_page = $current_page + 1;
						$next_url = get_term_link( get_queried_object_id() ) . 'page/' . $next_page . '/' . $query_string;
						echo '<li><a class="next page-number" href="' . esc_url( $next_url ) . '"><i class="icon-angle-right"></i></a></li>';
					}

					echo '</ul>';
					echo '</nav>';
				}

			} else {
				do_action( 'woocommerce_no_products_found' );
			}
			echo '</div>';
			wp_reset_postdata();
		}
		// Kết thúc khối if search/filter
	} else {
		// Sử dụng query mặc định khi không có filter
		if ( fl_woocommerce_version_check( '3.4.0' ) ? woocommerce_product_loop() : have_posts() ) {

			/**
			 * Hook: woocommerce_before_shop_loop.
			 */
			do_action( 'woocommerce_before_shop_loop' );

			woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action( 'woocommerce_shop_loop' );

					wc_get_template_part( 'content', 'product' );
				}
			}

			woocommerce_product_loop_end();

			/**
			 * Hook: woocommerce_after_shop_loop.
			 */
			do_action( 'woocommerce_after_shop_loop' );
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 */
			do_action( 'woocommerce_no_products_found' );
		}
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

	// Xử lý custom query cho search và filter
	$args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page' => get_option( 'posts_per_page' ), // Sử dụng setting WP thay vì hard-code 40
		'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1, // Thêm paged parameter
		'tax_query' => array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'term_id',
				'terms' => get_queried_object_id(),
				'operator' => 'IN'
			),
		)
	);

	// Thêm search term nếu có
	if ( ! empty( $_GET['s'] ) ) {
		$args['s'] = sanitize_text_field( $_GET['s'] );
	}

	// Thêm attribute filters
	foreach ( $_GET as $key => $value ) {
		if ( strpos( $key, 'filter_' ) === 0 && ! empty( $value ) ) {
			$taxonomy = 'pa_' . str_replace( 'filter_', '', $key );
			$values = array_map( 'trim', explode( ',', $value ) );
			$values = array_filter( $values );

			if ( ! empty( $values ) ) {
				$args['tax_query'][] = array(
					'taxonomy' => $taxonomy,
					'field' => 'slug',
					'terms' => $values,
					'operator' => 'IN',
				);

				// Set relation if multiple tax queries
				if ( count( $args['tax_query'] ) > 1 ) {
					$args['tax_query']['relation'] = 'AND';
				}
			}
		}
	}

	// Thêm price filters
	if ( ! empty( $_GET['min_price'] ) || ! empty( $_GET['max_price'] ) ) {
		$min_price = ! empty( $_GET['min_price'] ) ? floatval( $_GET['min_price'] ) : 0;
		$max_price = ! empty( $_GET['max_price'] ) ? floatval( $_GET['max_price'] ) : 999999;

		$args['meta_query'] = array(
			array(
				'key' => '_price',
				'value' => array( $min_price, $max_price ),
				'compare' => 'BETWEEN',
				'type' => 'NUMERIC'
			)
		);
	}

	$products2 = array();
	$products_info = new WP_Query( $args );

	foreach ( $products_info->posts as $key => $post ) {
		$product_info = get_post_meta( $post->ID );
		$vitri = isset( $product_info['_vi_tri'][0] ) ? $product_info['_vi_tri'][0] : '';
		$price_display = isset( $product_info['_gia_hien_thi'][0] ) ? $product_info['_gia_hien_thi'][0] : '';

		// Fallback to regular price if display price is empty
		if ( empty( $price_display ) && isset( $product_info['_price'][0] ) ) {
			$price_display = get_woocommerce_currency_symbol() . $product_info['_price'][0];
		}

		$products2[] = array(
			'product_id' => $post->ID,
			'name' => $post->post_title,
			'href' => get_permalink( $post->ID ),
			'image' => wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'woocommerce_thumbnail' )[0],
			'vitri' => $vitri,
			'price' => $price_display
		);
	}

	wp_reset_postdata();
	?>

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
					<span>Hiện chưa có sản phẩm trong danh mục này!</span>
				</div>
			<?php } ?>
		</div>

		<?php
		// Thêm phân trang
		$total_pages = $products_info->max_num_pages;
		if ( $total_pages > 1 ) {
			$current_page = max( 1, get_query_var( 'paged' ) );

			// Sử dụng WordPress pagination format chuẩn
			$current_url = home_url( $_SERVER['REQUEST_URI'] );

			// Remove existing page info from URL
			$current_url = preg_replace( '/\/page\/\d+\//', '/', $current_url );
			$current_url = remove_query_arg( 'paged', $current_url );

			// Ensure URL ends with /
			if ( substr( $current_url, -1 ) !== '/' ) {
				$current_url .= '/';
			}

			echo '<nav class="woocommerce-pagination">';
			echo '<ul class="page-numbers nav-pagination links text-center">';

			// Previous button
			if ( $current_page > 1 ) {
				$prev_page = $current_page - 1;
				if ( $prev_page == 1 ) {
					$prev_url = $current_url;
				} else {
					$prev_url = $current_url . 'page/' . $prev_page . '/';
				}
				echo '<li><a class="prev page-number" href="' . esc_url( $prev_url ) . '"><i class="icon-angle-left"></i></a></li>';
			}

			// Page numbers
			$start_page = max( 1, $current_page - 2 );
			$end_page = min( $total_pages, $current_page + 2 );

			// First page link if needed
			if ( $start_page > 1 ) {
				echo '<li><a class="page-number" href="' . esc_url( $current_url ) . '">1</a></li>';
				if ( $start_page > 2 ) {
					echo '<li><span class="page-number dots">…</span></li>';
				}
			}

			// Page range
			for ( $i = $start_page; $i <= $end_page; $i++ ) {
				if ( $i == 1 ) {
					$page_url = $current_url;
				} else {
					$page_url = $current_url . 'page/' . $i . '/';
				}

				if ( $i == $current_page ) {
					echo '<li><span aria-current="page" class="page-number current">' . $i . '</span></li>';
				} else {
					echo '<li><a class="page-number" href="' . esc_url( $page_url ) . '">' . $i . '</a></li>';
				}
			}

			// Last page link if needed
			if ( $end_page < $total_pages ) {
				if ( $end_page < $total_pages - 1 ) {
					echo '<li><span class="page-number dots">…</span></li>';
				}
				$last_url = $current_url . 'page/' . $total_pages . '/';
				echo '<li><a class="page-number" href="' . esc_url( $last_url ) . '">' . $total_pages . '</a></li>';
			}

			// Next button
			if ( $current_page < $total_pages ) {
				$next_url = $current_url . 'page/' . ( $current_page + 1 ) . '/';
				echo '<li><a class="next page-number" href="' . esc_url( $next_url ) . '"><i class="icon-angle-right"></i></a></li>';
			}

			echo '</ul>';
			echo '</nav>';
		}
		?>
	</div>
<?php } ?>

<div class="row category-page-row">
	<div class="col large-12">
		<form id="custom-search-form" role="search" method="get" class="wl-search-form"
			action="<?php echo get_term_link( get_queried_object_id() ); ?>">
			<div class="row">
				<div class="col large-6 small-12">
					<div class="search-input-wrapper">
						<div class="input-with-icon">
							<span class="search-icon">
								<svg width="28" height="29" viewBox="0 0 28 29" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path d="M24.0002 24.5002L17.6562 18.1562" stroke="#222531" stroke-width="1.25"
										stroke-miterlimit="10" stroke-linecap="square"></path>
									<path
										d="M12 20.5C16.4183 20.5 20 16.9183 20 12.5C20 8.08172 16.4183 4.5 12 4.5C7.58172 4.5 4 8.08172 4 12.5C4 16.9183 7.58172 20.5 12 20.5Z"
										stroke="#222531" stroke-width="1.25" stroke-miterlimit="10"
										stroke-linecap="square">
									</path>
								</svg>
							</span>
							<input type="search" id="search-field" class="form-control" name="s"
								placeholder="Tìm theo tên tòa nhà, tên đường..."
								value="<?php echo get_search_query(); ?>">
						</div>
						<input type="hidden" name="post_type" value="product">
						<input type="hidden" name="product_cat" value="<?php echo get_queried_object()->slug; ?>">
					</div>
				</div>

				<div class="col large-2 small-12">
					<div class="custom-dropdown-wrapper">
						<div class="dropdown-label">Quận</div>
						<div class="custom-dropdown" id="quan-dropdown">
							<div class="dropdown-display" id="quan-display">
								<span class="selected-count">(0) đã chọn</span>
								<i class="fa fa-chevron-down dropdown-arrow"></i>
							</div>
							<div class="dropdown-menu" id="quan-menu">
								<div class="selected-items" id="selected-items"></div>
								<div class="dropdown-options">
									<?php
									$current_category_id = get_queried_object_id();
									$current_category = get_term( $current_category_id, 'product_cat' );

									// Lấy taxonomy từ category meta
									$district_taxonomy = get_term_meta( $current_category_id, 'district_attribute_taxonomy', true );

									// Nếu không có ở category hiện tại, check parent
									if ( ! $district_taxonomy && $current_category && $current_category->parent ) {
										$district_taxonomy = get_term_meta( $current_category->parent, 'district_attribute_taxonomy', true );
									}

									// Fallback về mặc định nếu không tìm thấy
									if ( ! $district_taxonomy ) {
										$district_taxonomy = 'pa_quan-ha-noi';
									}

									// Tạo filter name từ taxonomy (bỏ prefix 'pa_')
									$filter_name = str_replace( 'pa_', 'filter_', $district_taxonomy );

									// Lấy danh sách quận/huyện
									$terms = get_terms( array(
										'taxonomy' => $district_taxonomy,
										'hide_empty' => false,
									) );

									if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
										foreach ( $terms as $term ) {
											echo '<div class="dropdown-option" data-value="' . esc_attr( $term->slug ) . '">';
											echo '<input type="checkbox" id="quan_' . esc_attr( $term->slug ) .
												'" data-filter-name="' . esc_attr( $filter_name ) . '" value="' . esc_attr( $term->slug ) . '">';
											echo '<label for="quan_' . esc_attr( $term->slug ) . '">' .
												esc_html( $term->name ) . '</label>';
											echo '</div>';
										}
									}

									// Add hidden input for filter
									$current_filter_value = isset( $_GET[ $filter_name ] ) ? $_GET[ $filter_name ] : '';
									echo '<input type="hidden" id="current-filter-input" name="' . esc_attr( $filter_name ) . '" value="' . esc_attr( $current_filter_value ) . '">';
									?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col large-2 small-12">
					<div class="price-dropdown-wrapper">
						<div class="dropdown-label">Giá</div>
						<div class="custom-dropdown" id="price-dropdown">
							<div class="dropdown-display" id="price-display">
								<span class="price-range-text">$0 - $100</span>
								<i class="fa fa-chevron-down dropdown-arrow"></i>
							</div>
							<div class="dropdown-menu price-dropdown-menu" id="price-menu">
								<div class="price-controls">
									<div class="price-inputs-row">
										<div class="price-input-group">
											<label>Từ</label>
											<input type="number" id="price-min-input" class="price-input" min="0"
												max="100" value="0">
										</div>
										<div class="price-input-group">
											<label>Đến</label>
											<input type="number" id="price-max-input" class="price-input" min="0"
												max="100" value="100">
										</div>
									</div>
									<div class="price-slider-wrapper">
										<div id="price-range-slider" class="price-slider"></div>
									</div>
									<div class="price-buttons">
										<button type="button" class="btn-price-reset">Đặt lại</button>
										<button type="button" class="btn-price-apply">Áp dụng</button>
									</div>
								</div>
								<input type="hidden" id="min_price" name="min_price"
									value="<?php echo isset( $_GET['min_price'] ) ? $_GET['min_price'] : '0'; ?>">
								<input type="hidden" id="max_price" name="max_price"
									value="<?php echo isset( $_GET['max_price'] ) ? $_GET['max_price'] : '100'; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="col large-2 small-12">
					<div class="search-button-wrapper">
						<button type="submit" class="btn btn-search">
							Tìm kiếm
						</button>
					</div>
				</div>
			</div>
		</form>

		<?php
		/**
		 * Hook: woocommerce_before_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20 (FL removed)
		 * @hooked WC_Structured_Data::generate_website_data() - 30
		 */
		do_action( 'woocommerce_before_main_content' );

		if ( $flag_category == 1 ) {
			if ( $categories ) {
				goiSP_danhmuccon( $flag_category, $categories, $actual_temp );
			}
		} else if ( $flag_category == 0 && ( ! isset( $actual_links[1] ) ) ) { ?>

				<div class=" section-building building-rank">
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
		$('.search-title-building .ux-search-submit').html('Xem chi tiết tòa nhà');

		// Initialize variables
		var selectedItems = [];
		var currentFilterName = '';

		// Get current filter name from first checkbox
		var firstCheckbox = $('.dropdown-option input[type="checkbox"]').first();
		if (firstCheckbox.length) {
			currentFilterName = firstCheckbox.attr('data-filter-name');
		}

		// Initialize from URL parameters
		var urlParams = new URLSearchParams(window.location.search);

		// Initialize quan filter
		if (currentFilterName) {
			var filterValue = urlParams.get(currentFilterName);

			if (filterValue) {
				var filterValues = filterValue.split(',').map(function (item) {
					return item.trim();
				}).filter(function (item) {
					return item.length > 0;
				});

				filterValues.forEach(function (value) {
					var checkbox = $('input[value="' + value + '"]');
					if (checkbox.length) {
						checkbox.prop('checked', true);
						selectedItems.push(value);
						addSelectedItem(value, checkbox.next('label').text());
						// Ẩn item đã chọn khỏi dropdown
						hideDropdownOption(value);
					}
				});
				updateQuanDisplay();
			}
		}

		// AUTOCOMPLETE FUNCTIONALITY FOR SEARCH FIELD
		var searchTimeout;
		var autocompleteContainer = null;

		// Create autocomplete container
		function createAutocompleteContainer() {
			if (!autocompleteContainer) {
				autocompleteContainer = $('<div class="autocomplete-container"></div>');
				$('#search-field').parent().append(autocompleteContainer);
			}
		}

		// Handle search input
		$('#search-field').on('input', function () {
			var searchTerm = $(this).val().trim();

			// Clear previous timeout
			clearTimeout(searchTimeout);

			if (searchTerm.length < 2) {
				hideAutocomplete();
				return;
			}

			// Debounce search
			searchTimeout = setTimeout(function () {
				performAutocompleteSearch(searchTerm);
			}, 300);
		});

		// Hide autocomplete on outside click
		$(document).on('click', function (e) {
			if (!$(e.target).closest('.search-input-wrapper').length) {
				hideAutocomplete();
			}
		});

		// Prevent form submission on Enter if autocomplete is visible
		$('#search-field').on('keydown', function (e) {
			if (e.keyCode === 13 && autocompleteContainer && autocompleteContainer.is(':visible')) {
				e.preventDefault();

				// Select first item if available
				var firstItem = autocompleteContainer.find('.autocomplete-item').first();
				if (firstItem.length) {
					selectAutocompleteItem(firstItem);
				}
			}
		});

		function performAutocompleteSearch(searchTerm) {
			// Get current category and district taxonomy
			var currentCategory = $('input[name="product_cat"]').val();

			// Get district taxonomy from PHP - pass it to JavaScript
			var districtTaxonomy = '<?php echo $district_taxonomy; ?>';

			$.ajax({
				url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
				type: 'POST',
				data: {
					action: 'autocomplete_search',
					search_term: searchTerm,
					category: currentCategory,
					district_taxonomy: districtTaxonomy,
					nonce: '<?php echo wp_create_nonce( 'autocomplete_search_nonce' ); ?>'
				},
				beforeSend: function () {
					showAutocompleteLoader();
				},
				success: function (response) {
					if (response.success) {
						displayAutocompleteResults(response.data);
					} else {
						hideAutocomplete();
					}
				},
				error: function () {
					hideAutocomplete();
				}
			});
		}

		function showAutocompleteLoader() {
			createAutocompleteContainer();
			autocompleteContainer.html('<div class="autocomplete-loader">Đang tìm kiếm...</div>').show();
		}

		function displayAutocompleteResults(results) {
			createAutocompleteContainer();

			if (results.length === 0) {
				autocompleteContainer.html('<div class="autocomplete-no-results">Không tìm thấy kết quả</div>').show();
				return;
			}

			var html = '';
			$.each(results, function (index, item) {
				var itemClass = 'autocomplete-item';
				var itemIcon = '';

				if (item.type === 'product') {
					itemIcon = '<i class="fa fa-building"></i>';
					itemClass += ' autocomplete-product';
				} else if (item.type === 'street') {
					itemIcon = '<i class="fa fa-road"></i>';
					itemClass += ' autocomplete-street';
				}

				html += '<div class="' + itemClass + '" data-value="' + item.value + '" data-type="' + item.type + '" data-link="' + (item.link || '') + '" data-is-link="' + (item.is_link || false) + '">';
				html += itemIcon + '<span class="autocomplete-text">' + item.label + '</span>';
				if (item.description) {
					html += '<span class="autocomplete-description">' + item.description + '</span>';
				}
				html += '</div>';
			});

			autocompleteContainer.html(html).show();

			// Handle item selection
			autocompleteContainer.find('.autocomplete-item').on('click', function () {
				selectAutocompleteItem($(this));
			});
		}

		function selectAutocompleteItem($item) {
			var value = $item.data('value');
			var type = $item.data('type');
			var link = $item.data('link');
			var isLink = $item.data('is-link');

			hideAutocomplete();

			// If item has a link (product), redirect to it
			if (isLink && link) {
				window.location.href = link;
				return;
			}

			// Otherwise, set search value and submit form (for streets)
			$('#search-field').val(value);
			$('#custom-search-form').submit();
		}

		function hideAutocomplete() {
			if (autocompleteContainer) {
				autocompleteContainer.hide().empty();
			}
		}

		// Price range slider - Replace jQuery UI with noUiSlider
		var priceSlider = document.getElementById('price-range-slider');

		// Destroy existing jQuery UI slider if any
		if ($('#price-range-slider').hasClass('ui-slider')) {
			$('#price-range-slider').slider('destroy');
		}

		// Clear any existing noUiSlider
		if (priceSlider.noUiSlider) {
			priceSlider.noUiSlider.destroy();
		}

		// Initialize noUiSlider
		noUiSlider.create(priceSlider, {
			start: [0, 100],
			connect: true,
			range: {
				'min': 0,
				'max': 100
			},
			format: {
				to: function (value) {
					return Math.round(value);
				},
				from: function (value) {
					return Number(value);
				}
			},
			tooltips: false,
			behaviour: 'tap-drag',
			step: 1
		});

		// Update inputs when slider changes
		priceSlider.noUiSlider.on('update', function (values, handle) {
			$('#price-min-input').val(values[0]);
			$('#price-max-input').val(values[1]);
			updatePriceDisplay();
		});

		// Initialize price values from URL or defaults
		var initMinPrice = parseInt(urlParams.get('min_price')) || parseInt($('#min_price').val()) || 0;
		var initMaxPrice = parseInt(urlParams.get('max_price')) || parseInt($('#max_price').val()) || 100;

		// Set initial values
		priceSlider.noUiSlider.set([initMinPrice, initMaxPrice]);
		$('#min_price').val(initMinPrice);
		$('#max_price').val(initMaxPrice);
		updatePriceDisplay();

		// Price input change handlers
		$('#price-min-input').on('input', function () {
			var minVal = parseInt($(this).val()) || 0;
			var maxVal = parseInt($('#price-max-input').val()) || 100;
			if (minVal < maxVal && minVal >= 0 && minVal <= 100) {
				priceSlider.noUiSlider.set([minVal, maxVal]);
				updatePriceDisplay();
			}
		});

		$('#price-max-input').on('input', function () {
			var minVal = parseInt($('#price-min-input').val()) || 0;
			var maxVal = parseInt($(this).val()) || 100;
			if (maxVal > minVal && maxVal >= 0 && maxVal <= 100) {
				priceSlider.noUiSlider.set([minVal, maxVal]);
				updatePriceDisplay();
			}
		});

		function updatePriceDisplay() {
			var minPrice = $('#price-min-input').val();
			var maxPrice = $('#price-max-input').val();
			$('#price-display .price-range-text').text('$' + minPrice + ' - $' + maxPrice);
		}

		// Price dropdown controls
		$('#price-display').click(function (e) {
			e.stopPropagation();
			$('#price-dropdown').toggleClass('open');
			$(this).toggleClass('active');
			$('#quan-dropdown').removeClass('open');
			$('#quan-display').removeClass('active');
		});

		$('.btn-price-reset').click(function () {
			priceSlider.noUiSlider.set([0, 100]);
			updatePriceDisplay();
		});

		$('.btn-price-apply').click(function () {
			var minPrice = $('#price-min-input').val();
			var maxPrice = $('#price-max-input').val();
			$('#min_price').val(minPrice);
			$('#max_price').val(maxPrice);
			$('#price-dropdown').removeClass('open');
			$('#price-display').removeClass('active');
		});

		// Quan dropdown functionality
		$('#quan-display').click(function (e) {
			e.stopPropagation();
			$('#quan-dropdown').toggleClass('open');
			$(this).toggleClass('active');
			$('#price-dropdown').removeClass('open');
			$('#price-display').removeClass('active');
		});

		// Close dropdowns when clicking outside
		$(document).click(function () {
			$('#quan-dropdown').removeClass('open');
			$('#quan-display').removeClass('active');
			$('#price-dropdown').removeClass('open');
			$('#price-display').removeClass('active');
		});

		// Prevent dropdown from closing when clicking inside
		$('#quan-menu, #price-menu').click(function (e) {
			e.stopPropagation();
		});

		// Handle dropdown option click
		$('.dropdown-option').click(function (e) {
			e.stopPropagation();
			var checkbox = $(this).find('input[type="checkbox"]');
			var value = checkbox.val();
			var label = checkbox.next('label').text();

			// Chỉ cho phép chọn (không bỏ chọn từ dropdown)
			if (!checkbox.is(':checked')) {
				checkbox.prop('checked', true);

				if (selectedItems.indexOf(value) === -1) {
					selectedItems.push(value);
					addSelectedItem(value, label);
					// Ẩn item khỏi dropdown sau khi chọn
					hideDropdownOption(value);
				}

				updateQuanDisplay();
			}
		});

		// Hàm ẩn option trong dropdown
		function hideDropdownOption(value) {
			$('.dropdown-option').each(function () {
				var checkbox = $(this).find('input[type="checkbox"]');
				if (checkbox.val() === value) {
					$(this).hide();
				}
			});
		}

		// Hàm hiển thị option trong dropdown
		function showDropdownOption(value) {
			$('.dropdown-option').each(function () {
				var checkbox = $(this).find('input[type="checkbox"]');
				if (checkbox.val() === value) {
					$(this).show();
				}
			});
		}

		function addSelectedItem(value, label) {
			var selectedHtml = '<span class="selected-item" data-value="' + value + '">' +
				label + '<span class="remove-item" onclick="removeItem(\'' + value + '\')">×</span></span>';
			$('#selected-items').append(selectedHtml);
			$('#selected-items').addClass('has-items');
		}

		function removeSelectedItem(value) {
			selectedItems = selectedItems.filter(function (item) {
				return item !== value;
			});
			$('.selected-item[data-value="' + value + '"]').remove();
			$('input[value="' + value + '"]').prop('checked', false);

			// Hiển thị lại item trong dropdown
			showDropdownOption(value);

			if (selectedItems.length === 0) {
				$('#selected-items').removeClass('has-items');
			}
		}

		window.removeItem = function (value) {
			removeSelectedItem(value);
			updateQuanDisplay();
		};

		function updateQuanDisplay() {
			var count = selectedItems.length;
			if (count > 0) {
				$('#quan-display .selected-count').text('(' + count + ') đã chọn');
			} else {
				$('#quan-display .selected-count').text('(0) đã chọn');
			}
		}

		// Handle form submission
		$('#custom-search-form').on('submit', function (e) {

			// Update filter input with selected values - FIX URL PARAMETER ISSUE
			if (currentFilterName) {
				if (selectedItems.length > 0) {
					$('#current-filter-input').val(selectedItems.join(','));
				} else {
					// Remove the filter input completely if no items selected
					$('#current-filter-input').val('');
					$('#current-filter-input').prop('name', ''); // Remove name attribute
				}
			}

			// Update price inputs
			var minPrice = $('#price-min-input').val();
			var maxPrice = $('#price-max-input').val();

			$('#min_price').val(minPrice);
			$('#max_price').val(maxPrice);
		});
	});
</script>