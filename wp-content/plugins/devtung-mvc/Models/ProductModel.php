<?php
namespace DevTung\MVC\Models;

defined('ABSPATH') || exit;

class ProductModel {
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

    protected static function formatProducts($products) {
        $data = [];
        foreach ($products as $p) {
            if (!$p instanceof \WC_Product) continue;

            $data[] = [
                'id'        => $p->get_id(),
                'name'      => $p->get_name(),
                'price'     => wc_price($p->get_price()),
                'link'      => $p->get_permalink(),
                'thumbnail' => wp_get_attachment_image_url($p->get_image_id(), 'medium'),
            ];
        }
        return $data;
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
