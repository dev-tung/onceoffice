<?php
namespace DevTung\MVC\Services;

use DevTung\MVC\Models\ProductCategoryModel;
use DevTung\MVC\Models\ProductModel;

class ProductService {

    public static function formData() {
        // 1. Ô tìm kiếm
        $formData['searchTerm'] = !empty($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

        // 2. Dropdown Khu vực
        $formData['districts'] = ProductCategoryModel::getDistrictsWithWards();
        // dd($formData['districts']);

        // Lấy danh sách quận đã chọn
        $formData['selectedDistricts'] = [];

        $segments = dt_get_url_segments(); // ví dụ: ['cho-thue-van-phong-ha-noi', 'hoan-kiem']

        // Nếu URL có segment thứ 2 (vd: /cho-thue-van-phong-ha-noi/hoan-kiem)
        if (!empty($segments[1])) {
            $formData['selectedDistricts'] = [$segments[1]];
        }
        // Nếu không có segment thứ 2, thì lấy từ query string filter_location
        elseif (!empty($_GET['filter_location'])) {
            $districts = explode(',', sanitize_text_field($_GET['filter_location']));
            $formData['selectedDistricts'] = array_filter(array_map('trim', $districts));
        }
        
        // 3. Dropdown Giá
        $formData['minPrice'] = isset($_GET['min_price']) ? intval($_GET['min_price']) : 0;
        $formData['maxPrice'] = isset($_GET['max_price']) ? intval($_GET['max_price']) : 100;

        // 4. Dropdown Hạng
        $formData['ranks'] = ProductCategoryModel::getByType('rank');
        
        // Lấy danh sách ranks đã chọn từ URL
        $formData['selectedRanks'] = [];
        if (!empty($_GET['filter_rank'])) {
            $ranks = explode(',', sanitize_text_field($_GET['filter_rank']));
            $formData['selectedRanks'] = array_filter(array_map('trim', $ranks));
        }

        return $formData;
    }

    public static function districtData(){
        return ProductCategoryModel::getDistrictData();
    }

    public static function getBuildingWithFilter($formData){
        return ProductModel::getBuildingWithFilter($formData);
    }
    

}
