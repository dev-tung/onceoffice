<?php
namespace DevTung\MVC\Services;

use DevTung\MVC\Models\ProductCategoryModel;
use DevTung\MVC\Models\ProductModel;

class ComponentService {

    public static function submenu() {

        $districts  = [];
        $wards      = [];
        $roads      = [];
        $ranks      = [];

        // --- Lấy toàn bộ category có type + slug ---
        $terms = ProductCategoryModel::getAllWithType();

        // --- Xây dựng map nhanh để truy xuất cha theo ID ---
        $termMap = [];
        foreach ($terms as $t) {
            $termMap[$t['id']] = $t;
        }

        // --- Hàm đệ quy lấy slug gốc (tổ tiên cao nhất) ---
        $getBaseSlug = function ($termId) use (&$termMap, &$getBaseSlug) {
            if (!isset($termMap[$termId])) return '';
            $term = $termMap[$termId];
            // nếu không có cha hoặc cha = 0 thì chính nó là gốc
            if (empty($term['parent'])) {
                return $term['slug'];
            }
            return $getBaseSlug($term['parent']);
        };

        // --- Gom nhóm theo type ---
        foreach ($terms as $term) {
            switch ($term['type']) {
                case 'district':
                    $baseSlug = '/' . $getBaseSlug($term['id']);
                    $districts[$term['id']] = [
                        'id'     => $term['id'],
                        'name'   => $term['name'],
                        'slug'   => $term['slug'],
                        'link'   => "{$baseSlug}/{$term['slug']}",
                        'wards'  => [],
                        'roads'  => []
                    ];
                    break;

                case 'ward':
                    $wards[$term['id']] = [
                        'id'          => $term['id'],
                        'name'        => $term['name'],
                        'slug'        => $term['slug'],
                        'parent_id'   => $term['parent'],
                        'parent_slug' => null,
                        'link'        => null,
                    ];
                    break;

                case 'road':
                    $roads[$term['id']] = [
                        'id'          => $term['id'],
                        'name'        => $term['name'],
                        'slug'        => $term['slug'],
                        'parent_id'   => $term['parent'],
                        'parent_slug' => null,
                        'link'        => null,
                    ];
                    break;

                case 'rank':
                    $baseSlug = '/' . $getBaseSlug($term['id']);
                    $ranks[] = [
                        'id'        => $term['id'],
                        'name'      => $term['name'],
                        'slug'      => $term['slug'],
                        'parent_id' => $term['parent'],
                        'link'      => "{$baseSlug}/{$term['slug']}",
                    ];
                    break;
            }
        }

        // --- Gắn parent_slug + link cho wards ---
        foreach ($wards as $id => &$ward) {
            if (isset($districts[$ward['parent_id']])) {
                $district = $districts[$ward['parent_id']];
                $baseSlug = dirname($district['link']); // slug cha gốc
                $ward['parent_slug'] = $district['slug'];
                $ward['link'] = "{$baseSlug}/{$district['slug']}/{$ward['slug']}";
            }
        }
        unset($ward);

        // --- Gắn parent_slug + link cho roads ---
        foreach ($roads as $id => &$road) {
            if (isset($wards[$road['parent_id']])) {
                $ward = $wards[$road['parent_id']];
                $baseSlug = dirname(dirname($ward['link'])); // slug gốc cha
                $road['parent_slug'] = $ward['slug'];
                $road['link'] = "{$baseSlug}/{$ward['parent_slug']}/{$road['slug']}";
            }
        }
        unset($road);

        // --- Gắn roads vào wards ---
        foreach ($roads as $road) {
            $ward_id = $road['parent_id'];
            if (isset($wards[$ward_id])) {
                $wards[$ward_id]['roads'][] = [
                    'id'   => $road['id'],
                    'name' => $road['name'],
                    'slug' => $road['slug'],
                    'link' => $road['link'],
                ];
            }
        }

        // --- Gắn wards (và roads trong ward) vào districts ---
        foreach ($wards as $ward) {
            $district_id = $ward['parent_id'];
            if (isset($districts[$district_id])) {
                $districts[$district_id]['wards'][] = [
                    'id'    => $ward['id'],
                    'name'  => $ward['name'],
                    'slug'  => $ward['slug'],
                    'link'  => $ward['link'],
                    'roads' => $ward['roads'] ?? [],
                ];

                // Gắn tất cả roads của ward vào district['roads']
                if (!empty($ward['roads'])) {
                    foreach ($ward['roads'] as $r) {
                        $districts[$district_id]['roads'][] = $r;
                    }
                }
            }
        }

        $buildings = ProductModel::getByCategoryType('highlight');

        // --- Trả dữ liệu về ---
        return [
            'districts'   => array_values($districts),
            'wards'       => array_values($wards),
            'roads'       => array_values($roads),
            'buildings'   => array_values($buildings),
            'ranks'       => array_values($ranks)
        ];
    }
}
