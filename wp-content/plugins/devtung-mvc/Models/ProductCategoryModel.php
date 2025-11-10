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



    // Hàm getDistrictsWithWards
    // Dữ liệu mẫu trả ra thế này [
    //     ['id' => 1, 'name' => 'Hoàn Kiếm', 'slug' => 'hoan-kiem', 'wards' => [
    //         ['id' => 101, 'name' => 'Phường Hàng Bạc', 'slug' => 'hang-bac'],
    //         ['id' => 102, 'name' => 'Phường Hàng Trống', 'slug' => 'hang-trong'],
    //     ]],
    //     ['id' => 2, 'name' => 'Ba Đình', 'slug' => 'ba-dinh', 'wards' => [
    //         ['id' => 201, 'name' => 'Phường Cống Vị', 'slug' => 'cong-vi'],
    //         ['id' => 202, 'name' => 'Phường Điện Biên', 'slug' => 'dien-bien'],
    //     ]],
    // ];
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
}
