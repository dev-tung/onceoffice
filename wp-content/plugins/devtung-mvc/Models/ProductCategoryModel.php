<?php
namespace DevTung\MVC\Models;

class ProductCategoryModel {

    /**
     * Lấy toàn bộ taxonomy product_cat
     */
    public static function getAll() {
        return get_terms([
            'taxonomy'   => 'product_cat',
            'hide_empty' => false,
        ]);
    }

    /**
     * Lấy tất cả dữ liệu location kèm type
     */
    public static function getAllWithType() {
        $terms = self::getAll();
        $data = [];

        foreach ($terms as $term) {
            $data[] = [
                'id'     => $term->term_id,
                'name'   => $term->name,
                'slug'   => $term->slug, 
                'link'   => get_term_link($term->term_id, 'product_cat'), 
                'parent' => $term->parent,
                'type'   => get_field('product_category_type', 'product_cat_' . $term->term_id),
            ];
        }

        return $data;
    }

    /**
     * Lấy danh sách term theo type (vd: district, ward, rank)
     *
     * @param string $type  Loại type muốn lấy (ví dụ: 'district', 'ward', 'rank')
     * @return array
     */
    public static function getByType($type) {
        // Lấy toàn bộ terms có type
        $terms = self::getAllWithType();

        // Lọc theo type mong muốn
        $filtered = array_filter($terms, function($term) use ($type) {
            return isset($term['type']) && $term['type'] === $type;
        });

        // Reset key mảng
        return array_values($filtered);
    }

    public static function getBySlug($slug) {
        $term = get_term_by('slug', $slug, 'product_cat');
        if (!$term) return null;

        // Lấy thêm custom field nếu có (ACF)
        $locationType = get_field('product_category_type', 'product_cat_' . $term->term_id);

        return [
            'id'    => $term->term_id,
            'name'  => $term->name,
            'slug'  => $term->slug,
            'parent'=> $term->parent,
            'type'  => $locationType,
        ];
    }



    /**
     * Lấy danh sách quận kèm phường (wards)
     *
     * Cấu trúc dữ liệu trả về:
     * [
     *   [
     *     'id' => 1,
     *     'name' => 'Hoàn Kiếm',
     *     'slug' => 'hoan-kiem',
     *     'wards' => [
     *       ['id' => 101, 'name' => 'Phường Hàng Bạc', 'slug' => 'hang-bac'],
     *       ['id' => 102, 'name' => 'Phường Hàng Trống', 'slug' => 'hang-trong'],
     *     ],
     *   ],
     *   [
     *     'id' => 2,
     *     'name' => 'Ba Đình',
     *     'slug' => 'ba-dinh',
     *     'wards' => [
     *       ['id' => 201, 'name' => 'Phường Cống Vị', 'slug' => 'cong-vi'],
     *       ['id' => 202, 'name' => 'Phường Điện Biên', 'slug' => 'dien-bien'],
     *     ],
     *   ],
     * ]
     */
    public static function getDistrictsWithWards() {
        function convertToNestedDistricts($flat) {
            $districts = [];
            $wards = [];

            // Lọc ra districts và wards
            foreach ($flat as $item) {
                if ($item['type'] === 'district') {
                    $districts[$item['id']] = [
                        'id' => $item['id'],
                        'name' => $item['name'],
                        'slug' => $item['slug'],
                        'link' => $item['link'],
                        'wards' => [],
                    ];
                } elseif ($item['type'] === 'ward') {
                    $wards[] = $item;
                }
            }

            // Gán wards vào districts dựa vào parent
            foreach ($wards as $ward) {
                $parent_id = $ward['parent']; // parent = district_id
                if (isset($districts[$parent_id])) {
                    $districts[$parent_id]['wards'][] = [
                        'id' => $ward['id'],
                        'name' => $ward['name'],
                        'slug' => $ward['slug'],
                        'link' => $ward['link']
                    ];
                }
            }

            // Reset key mảng để trả về dạng indexed array
            return array_values($districts);
        }

        $result = self::getAllWithType();
        return convertToNestedDistricts($result);
    }   
    
    
    /**
     * Lấy danh sách quận kèm sản phẩm thuộc quận
     * Cấu trúc dữ liệu trả về:
     * [
     *   [
     *     'id' => 1,
     *     'name' => 'Hoàn Kiếm',
     *     'slug' => 'hoan-kiem',
     *     'link' => '/cho-thue-van-phong-ha-noi/hoan-kiem',
     *     'products' => [
     *       [
     *         'id' => 1,
     *         'name' => 'Tòa nhà ABC',
     *         'link' => '/toa-nha-abc',
     *         'thumbnail' => 'https://example.com/img/abc.jpg',
     *         'price' => '25 triệu/tháng',
     *       ],
     *     ],
     *   ],
     * ]
     */
    public static function getDistrictData() {
        // Lấy tất cả terms có type = 'district'
        $terms = self::getAllWithType();
        $districts = array_filter($terms, function($t) {
            return $t['type'] === 'district';
        });
        
        $result = [];

        foreach ($districts as $district) {
            $args = [
                'post_type'      => 'product',
                'posts_per_page' => 4, // Giới hạn số sản phẩm nếu muốn
                'tax_query'      => [
                    [
                        'taxonomy' => 'product_cat',
                        'field'    => 'term_id',
                        'terms'    => $district['id'],
                    ]
                ],
            ];

            $query = new \WP_Query($args);
            $products = [];

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    global $product;

                    $products[] = [
                        'id'        => get_the_ID(),
                        'name'      => get_the_title(),
                        'link'      => get_permalink(),
                        'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
                        'price'     => $product ? $product->get_price_html() : '',
                    ];
                }
                wp_reset_postdata();
            }

            $result[] = [
                'id'       => $district['id'],
                'name'     => $district['name'],
                'slug'     => $district['slug'],
                'link'     => $district['link'],
                'products' => $products,
            ];
        }

        return $result;
    }

    
}
