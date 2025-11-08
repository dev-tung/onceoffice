<?php
namespace DevTung\MVC\Models;

defined('ABSPATH') || exit;

class PostModel {

    public static function index() {
        return [];
    }

    public static function category($limit = 10)
    {
        $category = get_queried_object();

        if (!$category || !isset($category->term_id)) {
            return [];
        }

        // Lấy thông tin cơ bản của category
        $category_data = [
            'id'          => $category->term_id,
            'name'        => $category->name,
            'slug'        => $category->slug,
            'description' => $category->description,
            'link'        => get_category_link($category->term_id),
            'count'       => $category->count,
            // Thumbnail (nếu có plugin/theme hỗ trợ ảnh cho category)
            'thumbnail'   => function_exists('get_term_meta')
                ? get_term_meta($category->term_id, 'thumbnail_id', true)
                : '',
        ];

        if (!empty($category_data['thumbnail'])) {
            $category_data['thumbnail'] = wp_get_attachment_image_url($category_data['thumbnail'], 'medium');
        } else {
            $category_data['thumbnail'] = ''; // fallback
        }

        // Lấy các bài viết trong category đó
        $posts = get_posts([
            'cat'            => $category->term_id, // đúng key phải là 'cat'
            'numberposts'    => $limit,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        $post_data = [];
        foreach ($posts as $p) {
            $post_data[] = [
                'id'        => $p->ID,
                'title'     => get_the_title($p->ID),
                'link'      => get_permalink($p->ID),
                'thumbnail' => get_the_post_thumbnail_url($p->ID, 'medium'),
                'excerpt'   => get_the_excerpt($p->ID),
                'date'      => get_the_date('d/m/Y', $p->ID),
            ];
        }

        // Gộp category + danh sách bài viết
        return [
            'category' => $category_data,
            'posts'    => $post_data,
        ];
    }




}
