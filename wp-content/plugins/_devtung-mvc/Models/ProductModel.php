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

}
