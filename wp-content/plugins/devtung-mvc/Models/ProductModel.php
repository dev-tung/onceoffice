<?php
namespace DevTung\MVC\Models;

defined('ABSPATH') || exit;

class ProductModel {

    /**
     * Lấy danh sách sản phẩm theo slug danh mục
     */
    public static function getByCategorySlug($slug, $limit = -1) {
        $args = [
            'status'   => 'publish',
            'limit'    => $limit,
            'category' => [$slug],
        ];

        $products = wc_get_products($args);
        return self::formatProducts($products);
    }

    /**
     * Lấy danh sách sản phẩm theo type của danh mục (ví dụ: highlight, district, rank)
     */
    public static function getByCategoryType($type, $limit = -1) {
        $terms = get_terms([
            'taxonomy'   => 'product_cat',
            'hide_empty' => false,
            'meta_query' => [
                [
                    'key'     => 'product_category_type',
                    'value'   => $type,
                    'compare' => '=',
                ],
            ],
        ]);

        if (empty($terms) || is_wp_error($terms)) {
            return [];
        }

        $term_ids = wp_list_pluck($terms, 'term_id');

        $product_ids = get_posts([
            'post_type'      => 'product',
            'posts_per_page' => $limit,
            'post_status'    => 'publish',
            'fields'         => 'ids',
            'tax_query'      => [
                [
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $term_ids,
                    'operator' => 'IN',
                ],
            ],
        ]);

        if (empty($product_ids)) {
            return [];
        }

        $products = [];
        foreach ($product_ids as $pid) {
            $prod = wc_get_product($pid);
            if ($prod && $prod->is_visible()) {
                $products[] = [
                    'name' => $prod->get_name(),
                    'link' => $prod->get_permalink(),
                ];
            }
        }

        return $products;
    }

    public static function getByDistrict($district_id, $limit = -1) {
        if (empty($district_id)) {
            return [];
        }

        // Lấy term quận
        $term = get_term($district_id, 'product_cat');
        if (!$term || is_wp_error($term)) {
            return [];
        }

        $district_slug = $term->slug;

        // --- Lấy tất cả phường con của quận này ---
        $ward_terms = get_terms([
            'taxonomy'   => 'product_cat',
            'hide_empty' => false,
            'parent'     => $district_id,
        ]);
        $ward_slugs = wp_list_pluck($ward_terms, 'slug');

        // --- Lấy sản phẩm WooCommerce theo quận hoặc phường ---
        $args = [
            'status'   => 'publish',
            'limit'    => $limit,
            'category' => array_merge([$district_slug], $ward_slugs), // quận + phường
        ];

        $products = wc_get_products($args);

        // --- Format sản phẩm, thêm slug quận/phường/rank ---
        return self::formatProducts($products);
    }

    /**
     * Chuyển sản phẩm WooCommerce sang mảng chuẩn
     */
    protected static function formatProducts($products) {
        $result = [];

        foreach ($products as $product) {
            // Lấy taxonomy term
            $product_terms = wp_get_post_terms($product->get_id(), 'product_cat');
            $district_slug = '';
            $ward_slug     = '';
            $rank_slug     = '';

            foreach ($product_terms as $term) {
                $type = get_field('product_category_type', 'product_cat_' . $term->term_id);

                if ($type === 'district') $district_slug = $term->slug;
                if ($type === 'ward') $ward_slug = $term->slug;
                if ($type === 'rank') $rank_slug = $term->slug;
            }

            $result[] = [
                'id'             => $product->get_id(),
                'name'           => $product->get_name(),
                'price'          => (float) $product->get_price(),
                'thumbnail'      => get_the_post_thumbnail_url($product->get_id(), 'thumbnail'),
                'district_slug'  => $district_slug,
                'ward_slug'      => $ward_slug,
                'rank_slug'      => $rank_slug,
            ];
        }

        return $result;
    }



    function slideImages($post_id, $size = 'large') {
        $urls = [];

        // Lấy ảnh đại diện (featured)
        $featured_id = get_post_thumbnail_id($post_id);
        if ($featured_id) {
            $urls[] = wp_get_attachment_image_url($featured_id, $size);
        }

        // Lấy gallery từ WooCommerce (_product_image_gallery)
        $gallery_ids = get_post_meta($post_id, '_product_image_gallery', true);
        if (!empty($gallery_ids)) {
            $gallery_ids = explode(',', $gallery_ids);
            $gallery_ids = array_map('intval', $gallery_ids);

            foreach ($gallery_ids as $id) {
                $url = wp_get_attachment_image_url($id, $size);
                if ($url) {
                    $urls[] = $url;
                }
            }
        }

        return $urls;
    }
}
