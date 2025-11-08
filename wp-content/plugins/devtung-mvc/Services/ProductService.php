<?php
namespace DevTung\MVC\Services;

use DevTung\MVC\Models\ProductCategoryModel;
use DevTung\MVC\Models\ProductModel;

class ProductService {

    /**
     * Trả về mảng gồm districts, wards, roads
     * - wards có parent_id là district_id
     * - roads cũng có parent_id là district_id
     */
    public static function index() {
        $districts = [];
        $wards     = [];
        $ranks     = [];

        // Lấy toàn bộ terms (district, ward, rank)
        $terms = ProductCategoryModel::getAllWithType();

        // --- Gom nhóm ban đầu ---
        foreach ($terms as $term) {
            switch ($term['type']) {
                case 'district':
                    $districts[$term['id']] = [
                        'id'       => $term['id'],
                        'name'     => $term['name'],
                        'slug'     => $term['slug'],
                        'wards'    => [],  // sẽ gắn sau
                        'products' => [],  // sẽ gắn sau
                    ];
                    break;

                case 'ward':
                    $wards[$term['id']] = [
                        'id'        => $term['id'],
                        'name'      => $term['name'],
                        'slug'      => $term['slug'],
                        'parent_id' => $term['parent'], // cha là district
                    ];
                    break;

                case 'rank':
                    $ranks[] = [
                        'id'        => $term['id'],
                        'name'      => $term['name'],
                        'slug'      => $term['slug'],
                        'parent_id' => $term['parent'],
                    ];
                    break;
            }
        }

        // --- Gắn phường vào quận ---
        foreach ($wards as $ward) {
            $district_id = $ward['parent_id'];
            if (isset($districts[$district_id])) {
                $districts[$district_id]['wards'][] = [
                    'id'   => $ward['id'],
                    'name' => $ward['name'],
                    'slug' => $ward['slug'],
                ];
            }
        }

        // --- Gắn sản phẩm vào quận ---
        foreach ($districts as $district_id => &$district) {
            $products = ProductModel::getByDistrict($district_id);

            // Giả sử trả về danh sách như [{id, name, price, thumbnail, ...}]
            $district['products'] = $products ?: [];
        }

        // --- Trả dữ liệu ---
        return [
            'districts' => array_values($districts),
            'ranks'     => array_values($ranks),
        ];
    }

    

}
