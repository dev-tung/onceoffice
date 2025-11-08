<?php
if (!function_exists('dump')) {
    function dump(...$vars) {
        echo '<pre>';
        foreach ($vars as $v) {
            var_dump($v);
        }
        echo '</pre>';
    }
}

if (!function_exists('dd')) {
    function dd(...$vars) {
        dump(...$vars);
        die(1);
    }
}


if (!function_exists('filterQuanKey')) {
    /**
     * Sinh ra key filter_quan-{taxonomy}
     */
    function filterQuanKey($taxonomy) {
        return 'filter_quan-' . sanitize_key($taxonomy);
    }
}

if (!function_exists('taxonomyQuanKey')) {
    /**
     * Sinh ra taxonomy pa_quan-{taxonomy}
     */
    function taxonomyQuanKey($taxonomy) {
        return 'pa_quan-' . sanitize_key($taxonomy);
    }
}

if (!function_exists('quanLink')) {
    /**
     * Sinh ra taxonomy pa_quan-{taxonomy}
     */
    function quanLink($taxonomy, $slug) {
        // Key động cho filter_quan
        $filterQuanKey = filterQuanKey($taxonomy);

        // Gán giá trị quận hiện tại
        $_GET[$filterQuanKey] = $slug;

        // Tạo URL
        return add_query_arg($_GET, get_term_link( get_queried_object_id() ));
    }
}

if (!function_exists('submenuQuanLink')) {
    function submenuQuanLink($taxonomy, $slug) {
        // Tạo key động filter_quan-ha-noi
        $filterQuanKey = "filter_quan-{$taxonomy}";

        // Lấy term object theo slug
        $term = get_term_by('slug', $taxonomy, 'product_cat'); // <-- thay 'product_cat' bằng taxonomy thực tế của bạn

        if (!$term || is_wp_error($term)) {
            return '#'; // tránh lỗi
        }

        // Base URL = link của term (vd: /ha-noi)
        $base_url = get_term_link($term);

        // Trả về link: /ha-noi/?filter_quan-ha-noi=ba-dinh
        return esc_url(add_query_arg($filterQuanKey, $slug, $base_url));
    }
}



if (!function_exists('filterHangKey')) {
    /**
     * Sinh ra key filter_hang-{taxonomy}
     */
    function filterHangKey($taxonomy) {
        return 'filter_hang';
    }
}

if (!function_exists('hangLink')) {
    /**
     * Sinh ra taxonomy pa_quan-{taxonomy}
     */
    function hangLink($taxonomy, $slug) {
        $filterHangKey = filterHangKey($taxonomy);

        // Chỉ giữ lại filter_hang, không mang theo các query khác
        $query = [];
        $query[$filterHangKey] = $slug;

        // Lấy term hiện tại
        $term = get_queried_object();

        if ($term && !is_wp_error($term)) {
            $base_url = get_term_link($term);
            return add_query_arg($query, $base_url);
        }

        return '';
    }
}