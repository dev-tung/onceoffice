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


    // public static function getBuildingWithFilter($formData) {
    //     return [
    //         [
    //             'ID' => 101,
    //             'post_title' => 'Văn phòng Sunshine',
    //             'permalink' => '#link-101',  // fake permalink
    //             '_vi_tri' => 'Quận 1',
    //             '_gia_hien_thi' => '<strong>1.000$</strong>',
    //             'thumbnail' => 'https://via.placeholder.com/150',
    //         ],
    //         [
    //             'ID' => 102,
    //             'post_title' => 'Văn phòng Sky Tower',
    //             'permalink' => '#link-102',
    //             '_vi_tri' => 'Quận 3',
    //             '_gia_hien_thi' => '<em>1.500$</em>',
    //             'thumbnail' => 'https://via.placeholder.com/150',
    //         ],
    //         [
    //             'ID' => 103,
    //             'post_title' => 'Tòa nhà Green Office',
    //             'permalink' => '#link-103',
    //             '_vi_tri' => 'Quận 7',
    //             '_gia_hien_thi' => '2.000$',
    //             'thumbnail' => 'https://via.placeholder.com/150',
    //         ],
    //     ];
        
    // }

    public static function getBuildingWithFilter($formData = []) {
        $args = [
            'post_type' => 'product', // hoặc post_type building
            'posts_per_page' => -1,
            's' => !empty($formData['searchTerm']) ? $formData['searchTerm'] : '',
        ];

        $taxQuery = [];

        // Lấy slug các term district đã chọn
        if (!empty($formData['selectedDistricts'])) {
            $taxQuery[] = [
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $formData['selectedDistricts'],
                'operator' => 'IN',
                'include_children' => false,
            ];
        }

        // Lấy slug các term rank đã chọn
        if (!empty($formData['selectedRanks'])) {
            $taxQuery[] = [
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $formData['selectedRanks'],
                'operator' => 'IN',
                'include_children' => false,
            ];
        }

        if (!empty($taxQuery)) {
            $args['tax_query'] = $taxQuery;
        }

        // Lọc theo giá nếu có
        if (isset($formData['minPrice']) || isset($formData['maxPrice'])) {
            $minPrice = $formData['minPrice'] ?? 0;
            $maxPrice = $formData['maxPrice'] ?? 1000000;

            $args['meta_query'][] = [
                'key' => '_gia_hien_thi', // lưu giá dạng số
                'value' => [$minPrice, $maxPrice],
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC',
            ];
        }

        $query = new \WP_Query($args);

        $buildings = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $id = get_the_ID();

                // Lấy các term product_cat liên quan
                $terms = get_the_terms($id, 'product_cat') ?: [];

                $district = null;
                $rank = null;

                foreach ($terms as $term) {
                    $type = get_field('product_category_type', 'product_cat_' . $term->term_id);
                    if ($type === 'district') {
                        $district = $term;
                    } elseif ($type === 'rank') {
                        $rank = $term;
                    }
                }

                $buildings[] = [
                    'ID' => $id,
                    'post_title' => get_the_title($id),
                    'permalink' => get_permalink($id),
                    '_vi_tri' => $district ? $district->name : '',
                    '_gia_hien_thi' => get_post_meta($id, '_gia_hien_thi', true),
                    '_rank' => $rank ? $rank->name : '',
                    'thumbnail' => get_the_post_thumbnail_url($id, 'medium') ?: '',
                ];
            }
            wp_reset_postdata();
        }

        return $buildings;
    }
}
