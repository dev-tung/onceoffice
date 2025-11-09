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
public static function index($filters = []) {
    $districts = [];
    $wards     = [];
    $ranks     = [];

    // --- Lấy terms
    $terms = ProductCategoryModel::getAllWithType();

    // --- Gom nhóm
    foreach ($terms as $term) {
        switch ($term['type']) {
            case 'district':
                $districts[$term['id']] = [
                    'id'       => $term['id'],
                    'name'     => $term['name'],
                    'slug'     => $term['slug'],
                    'wards'    => [],
                    'products' => [],
                ];
                break;

            case 'ward':
                $wards[$term['id']] = [
                    'id'        => $term['id'],
                    'name'      => $term['name'],
                    'slug'      => $term['slug'],
                    'parent_id' => $term['parent'],
                ];
                break;

            case 'rank':
                $ranks[] = [
                    'id'   => $term['id'],
                    'name' => $term['name'],
                    'slug' => $term['slug'],
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

    // --- Lấy sản phẩm theo filter ---
    foreach ($districts as $district_id => &$district) {
        $products = ProductModel::getByDistrict($district_id);

        // --- Lọc theo filter locations (quận/phường)
        if (!empty($filters['locations'])) {
            $products = array_filter($products, function($p) use ($filters) {
                return in_array($p['district_slug'], $filters['locations']) 
                    || in_array($p['ward_slug'], $filters['locations']);
            });
        }

        // --- Lọc theo hạng ---
        if (!empty($filters['ranks'])) {
            $products = array_filter($products, function($p) use ($filters) {
                return in_array($p['rank_slug'], $filters['ranks']);
            });
        }

        // --- Lọc theo giá ---
        $products = array_filter($products, function($p) use ($filters) {
            return $p['price'] >= $filters['min_price'] && $p['price'] <= $filters['max_price'];
        });

        $district['products'] = array_values($products);
    }

    return [
        'districts' => array_values($districts),
        'ranks'     => array_values($ranks),
    ];
}


    

}
