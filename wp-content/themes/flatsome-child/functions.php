<?php
function admin_menus() {
	remove_menu_page( 'edit-tags.php' );
}
add_action( 'admin_menu', 'admin_menus' );
function remove_submenu_items() {
	remove_submenu_page( 'edit.php', 'edit-tags.php' );
}
add_action( 'admin_init', 'remove_submenu_items' );

add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

function woo_add_custom_general_fields() {
	global $woocommerce, $post;
	woocommerce_wp_text_input(
		array(
			'id' => '_gia_hien_thi',
			'label' => __( 'Giá hiển thị', 'woocommerce' ),
			'placeholder' => 'Giá hiển thị',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: $23 - $28/ m2 (Chỉ dùng để hiển thị ra ngoài, không sử dụng để lọc tìm kiếm, nếu muốn lọc tìm kiếm hãy nhập giá chính xác ở trường trên!)', 'woocommerce' )
		)
	);
	echo '<div class="options_group"><h2 style="font-weight: bold;">THÔNG SỐ TOÀ NHÀ</h2>';
	woocommerce_wp_text_input(
		array(
			'id' => '_vi_tri',
			'label' => __( 'Vị trí', 'woocommerce' ),
			'placeholder' => 'Vị trí',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: 29 Liễu Giai, Ba Đình, Hà Nội', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_chieu_cao_tang',
			'label' => __( 'Chiều cao tầng', 'woocommerce' ),
			'placeholder' => 'Chiều cao tầng',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Gồm 02 tòa tháp cao 37 tầng nằm chung trên khối đế 5 tầng, 1 tầng trệt và 03 tầng hầm', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_chieu_cao_tran',
			'label' => __( 'Chiều cao trần', 'woocommerce' ),
			'placeholder' => 'Chiều cao trần',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: 2.7 m', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_dien_tich_san',
			'label' => __( 'Diện tích sàn', 'woocommerce' ),
			'placeholder' => 'Diện tích sàn',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: 1200m2 - 1340m2', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_do_xe',
			'label' => __( 'Đỗ xe', 'woocommerce' ),
			'placeholder' => 'Đỗ xe',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Diện tích 3 tầng hầm', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_thang_may',
			'label' => __( 'Thang máy', 'woocommerce' ),
			'placeholder' => 'Thang máy',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: 32 thang máy tốc độ cao; mỗi tháp 16 thang máy', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_dieu_hoa',
			'label' => __( 'Điều hòa', 'woocommerce' ),
			'placeholder' => 'Điều hòa',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Điều hòa trung tâm hiện đại', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_dien_du_phong',
			'label' => __( 'Điện dự phòng', 'woocommerce' ),
			'placeholder' => 'Điện dự phòng',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Máy phát điện đáp ứng 100% công suất', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_gio_lam_viec',
			'label' => __( 'Giờ làm việc', 'woocommerce' ),
			'placeholder' => 'Giờ làm việc',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: 8h00 - 18h00 thứ 2 đến thứ 6, 8h00 - 12h00 thứ 7', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_huong_toa_nha',
			'label' => __( 'Hướng tòa nhà', 'woocommerce' ),
			'placeholder' => 'Hướng tòa nhà',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Tây Nam', 'woocommerce' )
		)
	);
	echo '</div>';

	echo '<div class="options_group"><h2 style="font-weight: bold;">CHI TIẾT GIÁ THUÊ VÀ DIỆN TÍCH</h2>';
	woocommerce_wp_text_input(
		array(
			'id' => '_gia_thue_gop',
			'label' => __( 'Giá thuê gộp (Giá thuê + Phí dịch vụ)', 'woocommerce' ),
			'placeholder' => 'Giá thuê gộp (Giá thuê + Phí dịch vụ)',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Từ 42 usd/m2/tháng (dự kiến)', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_gia_thue',
			'label' => __( 'Giá thuê', 'woocommerce' ),
			'placeholder' => 'Giá thuê',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Từ 35 usd/m2/tháng (dự kiến)', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_phi_dich_vu',
			'label' => __( 'Phí dịch vụ', 'woocommerce' ),
			'placeholder' => 'Phí dịch vụ',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: 7 usd/m2 (dự kiến)  ', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_dien_tich_cho_thue_tieu_chuan',
			'label' => __( 'Diện tích cho thuê tiêu chuẩn', 'woocommerce' ),
			'placeholder' => 'Diện tích cho thuê tiêu chuẩn',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Linh hoạt chia thành các diện tích: 90m2, 120m2, 143m2, 180m2, 233m2, 500m2, 1000m2, 2000m2', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_tien_dien_dieu_hoa',
			'label' => __( 'Tiền điện điều hòa', 'woocommerce' ),
			'placeholder' => 'Tiền điện điều hòa',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Đã bao gồm trong phí dịch vụ', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_do_xe_may',
			'label' => __( 'Đỗ xe máy', 'woocommerce' ),
			'placeholder' => 'Đỗ xe máy',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: 10 usd/xe máy/tháng  ', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_do_o_to',
			'label' => __( 'Đỗ ô tô', 'woocommerce' ),
			'placeholder' => 'Đỗ ô tô',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: 100 usd/xe/tháng  ', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_tien_dien_trong_van_phong',
			'label' => __( 'Tiền điện trong văn phòng', 'woocommerce' ),
			'placeholder' => 'Tiền điện trong văn phòng',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Tính thực tế tiêu thụ theo đồng hồ ', 'woocommerce' )
		)
	);
	echo '</div>';
}

function woo_add_custom_general_fields_save( $post_id ) {
	$woocommerce_text_field = $_POST['_gia_hien_thi'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_gia_hien_thi', esc_attr( $woocommerce_text_field ) );

	$woocommerce_text_field = $_POST['_vi_tri'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_vi_tri', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_chieu_cao_tang'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_chieu_cao_tang', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_chieu_cao_tran'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_chieu_cao_tran', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_dien_tich_san'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_dien_tich_san', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_do_xe'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_do_xe', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_thang_may'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_thang_may', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_dieu_hoa'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_dieu_hoa', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_dien_du_phong'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_dien_du_phong', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_gio_lam_viec'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_gio_lam_viec', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_huong_toa_nha'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_huong_toa_nha', esc_attr( $woocommerce_text_field ) );

	$woocommerce_text_field = $_POST['_gia_thue_gop'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_gia_thue_gop', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_gia_thue'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_gia_thue', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_phi_dich_vu'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_phi_dich_vu', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_dien_tich_cho_thue_tieu_chuan'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_dien_tich_cho_thue_tieu_chuan', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_tien_dien_dieu_hoa'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_tien_dien_dieu_hoa', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_do_xe_may'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_do_xe_may', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_do_o_to'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_do_o_to', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_tien_dien_trong_van_phong'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_tien_dien_trong_van_phong', esc_attr( $woocommerce_text_field ) );
}

if ( isset( $_GET['taxonomy'] ) ) {
	if ( strpos( $_GET['taxonomy'], 'pa_' ) !== false ) {
		add_action( $_GET['taxonomy'] . "_edit_form_fields", 'add_form_fields_example', 10, 2 );
	}
}
function add_form_fields_example( $term, $taxonomy ) {
	?>
	<tr valign="top">
		<th scope="row">Description</th>
		<td>
			<?php wp_editor( html_entity_decode( $term->description ), 'description', array( 'media_buttons' => true ) ); ?>
			<script>
				jQuery(window).ready(function () {
					jQuery('label[for=description]').parent().parent().remove();
				});
			</script>
		</td>
	</tr>
	<?php
}

/*if(isset($_GET['taxonomy'])){
add_action( $_GET['taxonomy'].'_add_form_fields', 'misha_add_term_fields' );
}

function misha_add_term_fields( $taxonomy ) {

	echo '<div class="form-field">
	<label for="misha-text">Text Field</label>
	<input type="text" name="misha-text" id="misha-text" />
	<p>Field description may go here.</p>
	</div>';

}
if(isset($_GET['taxonomy'])){
add_action( $_GET['taxonomy'].'_edit_form_fields', 'misha_edit_term_fields', 10, 2 );
}

function misha_edit_term_fields( $term, $taxonomy ) {

	$value = get_term_meta( $term->term_id, 'misha-text', true );

	echo '<tr class="form-field">
	<th>
		<label for="misha-text">Text Field</label>
	</th>
	<td>
		<input name="misha-text" id="misha-text" type="text" value="' . esc_attr( $value ) .'" />
		<p class="description">Field description may go here.</p>
	</td>
	</tr>';

}

if(isset($_GET['taxonomy'])){
add_action( 'created_term', 'misha_save_term_fields' );
add_action( 'edited_term', 'misha_save_term_fields' );
}

function misha_save_term_fields( $term_id ) {

	update_term_meta(
		$term_id,
		'misha-text',
		sanitize_text_field( $_POST[ 'misha-text' ] )
	);

}*/

/*if(isset($_GET['taxonomy'])){
add_action( $_GET['taxonomy'].'_add_form_fields', 'misha_edit_term_fields', 10, 2 );
}

function misha_add_term_fields( $taxonomy ) {

	echo '<div class="form-field">
	<label for="description2">Text Field</label>
	<textarea name="description2" id="description2"></textarea>
	</div>';

}

if(isset($_GET['taxonomy'])){
add_action( $_GET['taxonomy'].'_edit_form_fields', 'misha_edit_term_fields', 10, 2 );
}
function misha_edit_term_fields( $term, $taxonomy ) {
	?>
	<tr valign="top">
		<th scope="row">Description 2</th>
		<td>
			<?php wp_editor(html_entity_decode($term->description2), 'description2', array('media_buttons' => true)); ?>
			<script>
				jQuery(window).ready(function(){
					jQuery('label[for=description2]').parent().parent().remove();
				});
			</script>
		</td>
	</tr>
	<?php
}

if(isset($_GET['taxonomy'])){
add_action( 'create_'.$_GET['taxonomy'], 'misha_save_term_fields', 10, 2 );
add_action( 'edited_'.$_GET['taxonomy'], 'misha_save_term_fields', 10, 2 );
}
function misha_save_term_fields( $term_id ) {
	update_term_meta(
		$term_id,
		'description2',
		sanitize_text_field( $_POST[ 'description2' ] )
	);

}*/

add_action( 'admin_head', 'my_custom_css_admin_head' );

function my_custom_css_admin_head() {
	echo '<style>
    #flatsome-notice{
        display:none !important;
    }
    #posts-filter table thead tr #title{
        width: 35%;
    }
    #posts-filter table thead tr #post_views{
        width: 9%;
    }
    .col.cols.panel.flatsome-panel .notice.notice-warning.notice-alt.inline{
        opacity: 0;
        visibility: hidden;
        height: 0;
        margin: 0;
        padding: 0;
    }
    .flatsome-registration-form > p, #dashboard_php_nag, .menu-icon-plugins .update-plugins, .menu-icon-dashboard .update-plugins, #toplevel_page_Wordfence .update-plugins, .update-message, #wpfooter, #wp-admin-bar-wp-logo, #login h1{
        display: none !important;
    }
    .flatsome-registration-form > p.flatsome-registration-form__code{
        display: block !important;
    }
    li#wp-admin-bar-flatsome-activate{
    	display: none;
    }
</style>';
}
function my_login_logo() { ?>
	<style type="text/css">
		#login h1 a,
		.login h1 a {
			background-image: url(<?php echo home_url( '/wp-content/uploads/2020/11/logo-wonder-vuong-2.png' ) ?>);
			height: 120px;
			width: auto;
			background-size: auto 100%;
			background-repeat: no-repeat;
			padding-bottom: 0;
			pointer-events: none;
			margin: 0;
		}

		#loginform {
			margin-top: 0;
		}
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


// 1) Định nghĩa class mới kế thừa và override phương thức
class WC_Widget_Custom_Layered_Nav extends WC_Widget_Layered_Nav {

	// Ghi đè phương thức layered_nav_list()
	protected function layered_nav_list( $terms, $taxonomy, $query_type ) {
		echo '<ul class="woocommerce-widget-layered-nav-list" taxonomy="' . esc_attr( $taxonomy ) . '">';

		$term_counts = $this->get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy, $query_type );
		$_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
		$found = false;
		$base_link = $this->get_current_page_url();

		foreach ( $terms as $term ) {
			$current_values = isset( $_chosen_attributes[ $taxonomy ]['terms'] ) ? $_chosen_attributes[ $taxonomy ]['terms'] : array();
			$option_is_set = in_array( $term->slug, $current_values, true );
			$count = isset( $term_counts[ $term->term_id ] ) ? $term_counts[ $term->term_id ] : 0;

			// Bỏ qua term chính đang xem
			if ( $this->get_current_term_id() === $term->term_id ) {
				continue;
			}

			// Luôn show ra, bỏ điều kiện count > 0
			$found = true;

			$filter_name = 'filter_' . wc_attribute_taxonomy_slug( $taxonomy );
			$current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( wp_unslash( $_GET[ $filter_name ] ) ) ) : array();
			$current_filter = array_map( 'sanitize_title', $current_filter );

			if ( ! in_array( $term->slug, $current_filter, true ) ) {
				$current_filter[] = $term->slug;
			}

			$link = remove_query_arg( $filter_name, $base_link );

			foreach ( $current_filter as $key => $value ) {
				if ( $value === $this->get_current_term_slug() ) {
					unset( $current_filter[ $key ] );
				}
				if ( $option_is_set && $value === $term->slug ) {
					unset( $current_filter[ $key ] );
				}
			}

			if ( ! empty( $current_filter ) ) {
				asort( $current_filter );
				$link = add_query_arg( $filter_name, implode( ',', $current_filter ), $link );

				if ( 'or' === $query_type && ! ( 1 === count( $current_filter ) && $option_is_set ) ) {
					$link = add_query_arg( 'query_type_' . wc_attribute_taxonomy_slug( $taxonomy ), 'or', $link );
				}
				$link = str_replace( '%2C', ',', $link );
			}

			// Tạo HTML như bạn muốn
			$link = apply_filters( 'woocommerce_layered_nav_link', $link, $term, $taxonomy );
			$term_html = '<a rel="nofollow" href="' . esc_url( $link ) . '" slug="' . esc_attr( $term->slug ) . '">'
				. esc_html( $term->name )
				. '</a> '
				. apply_filters( 'woocommerce_layered_nav_count',
					'<span class="count">(' . absint( $count ) . ')</span>',
					$count,
					$term
				);

			echo '<li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term '
				. ( $option_is_set ? 'woocommerce-widget-layered-nav-list__item--chosen chosen' : '' )
				. '">';
			echo apply_filters( 'woocommerce_layered_nav_term_html', $term_html, $term, $link, $count );
			echo '</li>';
		}

		echo '</ul>';

		return $found;
	}
}

// 2) Hủy đăng ký widget cũ và đăng ký widget mới ngay sau khi WooCommerce load widget
add_action( 'widgets_init', function () {
	unregister_widget( 'WC_Widget_Layered_Nav' );
	register_widget( 'WC_Widget_Custom_Layered_Nav' );
}, 15 );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_script( 'jquery-ui-slider' );
	wp_enqueue_style( 'jquery-ui-css', '//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css' );
} );

// Thêm field cho Product Category - Add form
function add_product_cat_attribute_field() {
	?>
	<div class="form-field">
		<label for="attribute_taxonomy">Thuộc tính quận/huyện</label>
		<select name="attribute_taxonomy" id="attribute_taxonomy">
			<option value="">Chọn thuộc tính</option>
			<?php
			$attribute_taxonomies = wc_get_attribute_taxonomies();
			foreach ( $attribute_taxonomies as $taxonomy ) {
				echo '<option value="pa_' . esc_attr( $taxonomy->attribute_name ) . '">'
					. esc_html( $taxonomy->attribute_label ) . '</option>';
			}
			?>
		</select>
		<p class="description">Chọn thuộc tính quận/huyện cho danh mục này</p>
	</div>
	<?php
}

// Thêm field cho Product Category - Edit form (style form-table)
function edit_product_cat_attribute_field( $term, $taxonomy ) {
	$selected_attribute = get_term_meta( $term->term_id, 'district_attribute_taxonomy', true );
	?>
	<tr class="form-field">
		<th scope="row">
			<label for="attribute_taxonomy">Thuộc tính quận/huyện</label>
		</th>
		<td>
			<select name="attribute_taxonomy" id="attribute_taxonomy">
				<option value="">Chọn thuộc tính</option>
				<?php
				$attribute_taxonomies = wc_get_attribute_taxonomies();
				foreach ( $attribute_taxonomies as $taxonomy_item ) {
					$taxonomy_name = 'pa_' . $taxonomy_item->attribute_name;
					$selected = selected( $selected_attribute, $taxonomy_name, false );
					echo '<option value="' . esc_attr( $taxonomy_name ) . '" ' . $selected . '>'
						. esc_html( $taxonomy_item->attribute_label ) . '</option>';
				}
				?>
			</select>
			<p class="description">Chọn thuộc tính quận/huyện cho danh mục này</p>
		</td>
	</tr>
	<?php
}

add_action( 'product_cat_add_form_fields', 'add_product_cat_attribute_field' );
add_action( 'product_cat_edit_form_fields', 'edit_product_cat_attribute_field', 10, 2 );

// Lưu giá trị
function save_product_cat_attribute_field( $term_id ) {
	if ( isset( $_POST['attribute_taxonomy'] ) ) {
		update_term_meta( $term_id, 'district_attribute_taxonomy',
			sanitize_text_field( $_POST['attribute_taxonomy'] ) );
	}
}
add_action( 'created_product_cat', 'save_product_cat_attribute_field' );
add_action( 'edited_product_cat', 'save_product_cat_attribute_field' );

// AJAX handler for autocomplete search
add_action( 'wp_ajax_autocomplete_search', 'handle_autocomplete_search' );
add_action( 'wp_ajax_nopriv_autocomplete_search', 'handle_autocomplete_search' );

function handle_autocomplete_search() {
	// Verify nonce
	if ( ! wp_verify_nonce( $_POST['nonce'], 'autocomplete_search_nonce' ) ) {
		wp_die( 'Security check failed' );
	}

	$search_term = sanitize_text_field( $_POST['search_term'] );
	$category = sanitize_text_field( $_POST['category'] );
	$district_taxonomy = sanitize_text_field( $_POST['district_taxonomy'] );

	if ( strlen( $search_term ) < 2 ) {
		wp_send_json_error( 'Từ khóa quá ngắn' );
	}

	$results = array();

	// Helper function to highlight search term
	function highlight_search_term( $text, $search_term ) {
		if ( empty( $search_term ) ) {
			return $text;
		}

		// Escape special regex characters in search term
		$escaped_term = preg_quote( $search_term, '/' );

		// Replace search term with bold version (case insensitive)
		return preg_replace( '/(' . $escaped_term . ')/iu', '<strong>$1</strong>', $text );
	}

	// Search products by name
	$product_args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page' => 5,
		's' => $search_term,
	);

	// Add category filter if specified
	if ( ! empty( $category ) ) {
		$product_args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => $category,
			)
		);
	}

	$products = get_posts( $product_args );

	foreach ( $products as $product ) {
		$vitri = get_post_meta( $product->ID, '_vi_tri', true );
		$description = ! empty( $vitri ) ? $vitri : '';

		// Highlight search term in product title
		$highlighted_title = highlight_search_term( $product->post_title, $search_term );

		// Highlight search term in description (position)
		$highlighted_description = highlight_search_term( $description, $search_term );

		$results[] = array(
			'type' => 'product',
			'value' => $product->post_title,
			'label' => $highlighted_title,
			'description' => $highlighted_description,
			'link' => get_permalink( $product->ID ),
			'is_link' => true,
		);
	}

	// Search streets based on district_taxonomy
	if ( ! empty( $district_taxonomy ) ) {
		// Tạo street taxonomy từ district taxonomy
		// pa_quan-ha-noi -> pa_duong-ha-noi
		// pa_quan-ho-chi-minh -> pa_duong-ho-chi-minh

		$street_taxonomy = '';
		if ( $district_taxonomy === 'pa_quan-ha-noi' ) {
			$street_taxonomy = 'pa_duong-ha-noi';
			$location_name = 'Hà Nội';
		} elseif ( $district_taxonomy === 'pa_quan-ho-chi-minh' ) {
			$street_taxonomy = 'pa_duong-ho-chi-minh';
			$location_name = 'TP. Hồ Chí Minh';
		} else {
			// Fallback pattern: thay 'quan' thành 'duong'
			$street_taxonomy = str_replace( 'quan-', 'duong-', $district_taxonomy );
			$location_name = 'Việt Nam';
		}

		if ( ! empty( $street_taxonomy ) ) {
			$streets = get_terms( array(
				'taxonomy' => $street_taxonomy,
				'hide_empty' => false,
				'name__like' => $search_term,
				'number' => 5,
			) );

			if ( ! is_wp_error( $streets ) && ! empty( $streets ) ) {
				foreach ( $streets as $street ) {
					// Highlight search term in street name
					$highlighted_street_name = highlight_search_term( $street->name, $search_term );

					$results[] = array(
						'type' => 'street',
						'value' => $street->name,
						'label' => $highlighted_street_name,
						'description' => 'Đường tại ' . $location_name,
						'link' => '',
						'is_link' => false,
					);
				}
			}
		}
	}

	// Limit total results
	$results = array_slice( $results, 0, 10 );

	if ( empty( $results ) ) {
		wp_send_json_error( 'No results found' );
	}

	wp_send_json_success( $results );
}

function add_custom_category_pagination_rules() {
	// Rule cho category pagination với query parameters
	add_rewrite_rule(
		'^([^/]+)/page/([0-9]+)/?(.*)$',
		'index.php?product_cat=$matches[1]&paged=$matches[2]',
		'top'
	);
}

add_action( 'init', 'add_custom_category_pagination_rules' );

// Ensure paged is registered as query var
function add_paged_query_var( $vars ) {
	$vars[] = 'paged';
	return $vars;
}
add_filter( 'query_vars', 'add_paged_query_var' );

// Handle pagination with custom query parameters
function handle_custom_pagination() {
	// Get paged from URL path
	if ( preg_match( '/\/page\/(\d+)\//', $_SERVER['REQUEST_URI'], $matches ) ) {
		$paged = intval( $matches[1] );
		set_query_var( 'paged', $paged );

		// Also set global variable
		global $paged;
		$paged = intval( $matches[1] );
	}
}
add_action( 'wp', 'handle_custom_pagination', 1 );

// Flush rewrite rules một lần (uncomment để chạy, sau đó comment lại)
add_action( 'init', function () {
	flush_rewrite_rules();
} );


// Bỏ query string khi so sánh menu active
add_filter('nav_menu_css_class', function($classes, $item){
    if (!empty($item->url)) {
        // URL hiện tại, bỏ query string và hash
        $current_url = strtok(home_url(add_query_arg([], $_SERVER['REQUEST_URI'])), '?#');

        // URL menu, bỏ query string và hash
        $menu_url = strtok($item->url, '?#');

        // So sánh
        if ($current_url === $menu_url) {
            $classes[] = 'current-menu-item';
        } else {
            // Loại bỏ nhầm active trước đó nếu có
            $classes = array_diff($classes, ['current-menu-item']);
        }
    }
    return $classes;
}, 10, 2);



function enqueue_fancybox(){
    wp_enqueue_style('fancybox-css', 'https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3/dist/jquery.fancybox.min.css', [], '3.5.7');
    wp_enqueue_script('fancybox-js', 'https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3/dist/jquery.fancybox.min.js', ['jquery'], '3.5.7', true);
}
add_action('wp_enqueue_scripts','enqueue_fancybox', 20);

add_action('wp_footer', function(){
?>
<script>
	jQuery(function($){
		$("[data-fancybox='gallery']").fancybox({
		loop: true,
		buttons : [ "zoom", "slideShow", "fullScreen", "thumbs", "close" ],
		thumbs : {
			autoStart : true,
			axis: 'x' // Bắt buộc: dùng horizontal
		}
		});

	});
</script>
<?php
});


function remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
        if ( $script->deps ) { // kiểm tra dependencies
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );


function load_fontawesome() {
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css' );
}
add_action( 'wp_enqueue_scripts', 'load_fontawesome' );


function enqueue_building_assets_swiper() {
    // Swiper
    wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
}
add_action( 'wp_enqueue_scripts', 'enqueue_building_assets_swiper' );

add_action('wp_footer', function(){
?>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		const gallery = document.querySelector("#BuildingGalleryMobile .BuildingGallery");
		if (gallery) {
			new Swiper(gallery, {
				loop: true,
				slidesPerView: 3,
				spaceBetween: 10,
				pagination: {
					el: ".swiper-pagination",
					clickable: true,
				},
				navigation: {
					nextEl: ".swiper-button-next",
					prevEl: ".swiper-button-prev",
				},
			});
		}
	});
</script>
<?php
});
