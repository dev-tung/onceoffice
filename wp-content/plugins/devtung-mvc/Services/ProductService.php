<?php
namespace DevTung\MVC\Services;

use DevTung\MVC\Models\ProductCategoryModel;
use DevTung\MVC\Models\ProductModel;

class ProductService {
    
    public static function formData() {
        // 1. Ô tìm kiếm
        $formData['searchTerm'] = !empty($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

        // 2. Dropdown Khu vực
        $formData['districts'] = [
            [
                'id' => 1,
                'name' => 'Hoàn Kiếm',
                'slug' => 'hoan-kiem',
                'wards' => [
                    ['id' => 101, 'name' => 'Phường Hàng Bạc', 'slug' => 'hang-bac'],
                    ['id' => 102, 'name' => 'Phường Hàng Trống', 'slug' => 'hang-trong'],
                ],
            ],
            [
                'id' => 2,
                'name' => 'Ba Đình',
                'slug' => 'ba-dinh',
                'wards' => [
                    ['id' => 201, 'name' => 'Phường Cống Vị', 'slug' => 'cong-vi'],
                    ['id' => 202, 'name' => 'Phường Điện Biên', 'slug' => 'dien-bien'],
                ],
            ],
        ];

        // Lấy danh sách districts đã chọn từ URL
        $formData['selectedDistricts'] = [];
        if (!empty($_GET['filter_location'])) {
            $districts = explode(',', sanitize_text_field($_GET['filter_location']));
            // Loại bỏ rỗng, trim khoảng trắng
            $formData['selectedDistricts'] = array_filter(array_map('trim', $districts));
        }
        
        // 3. Dropdown Giá
        $formData['minPrice'] = isset($_GET['min_price']) ? intval($_GET['min_price']) : 0;
        $formData['maxPrice'] = isset($_GET['max_price']) ? intval($_GET['max_price']) : 100;

        // 3. Dropdown Hạng
        $formData['ranks'] = [
            ['name' => 'Hạng A', 'slug' => 'hang-a'],
            ['name' => 'Hạng B', 'slug' => 'hang-b'],
            ['name' => 'Hạng C', 'slug' => 'hang-c'],
        ];
        
        // Lấy danh sách ranks đã chọn từ URL
        $formData['selectedRanks'] = [];
        if (!empty($_GET['filter_rank'])) {
            $ranks = explode(',', sanitize_text_field($_GET['filter_rank']));
            $formData['selectedRanks'] = array_filter(array_map('trim', $ranks));
        }

        return $formData;
    }

    

}
