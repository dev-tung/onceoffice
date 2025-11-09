<?php
/**
 * Plugin Name: DevTung MVC
 * Description: Plugin MVC tái sử dụng cho WordPress/WooCommerce
 * Version: 1.0.0
 * Author: Dev Tung
 * Text Domain: devtung-mvc
 */

if (!defined('ABSPATH')) exit;

class DevTungMVC {

    private static $instance = null;
    private $folders = ['Controllers', 'Models', 'Helpers', 'Services'];

    private function __construct() {
        // Load tất cả file class
        $this->autoload_files();

        // Đăng ký CSS/JS
        add_action('wp_enqueue_scripts', [$this, 'autoload_assets'], 9999);

        // Khởi tạo controller
        add_action('plugins_loaded', [$this, 'init_controllers']);
    }

    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function autoload_files() {
        foreach ($this->folders as $folder) {
            $path = __DIR__ . '/' . $folder;
            if (is_dir($path)) {
                foreach (glob($path . '/*.php') as $file) {
                    require_once $file;
                }
            }
        }
    }

    public function autoload_assets() {
        $plugin_url = plugin_dir_url(__FILE__);
        $version = '1.0.0';

        // --- Load all CSS normally ---
        $css_files = glob(__DIR__ . '/assets/css/*.css');
        foreach ($css_files as $file) {
            $handle = 'dt-' . basename($file, '.css');
            wp_enqueue_style($handle, $plugin_url . 'assets/css/' . basename($file), [], $version);
        }

        // --- Load JS after all other scripts ---
        add_action('wp_enqueue_scripts', function() use ($plugin_url, $version) {
            $js_files = glob(__DIR__ . '/assets/js/*.js');

            if (!empty($js_files)) {
                foreach ($js_files as $file) {
                    $handle = 'dt-' . basename($file, '.js');
                    wp_enqueue_script($handle, $plugin_url . 'assets/js/' . basename($file), ['jquery'], $version, true);
                }
            }
        }, 9999); // VERY high priority → runs after all other enqueue functions
    }

    public function init_controllers() {
        $controllers = [
            \DevTung\MVC\Controllers\ProductController::class,
            \DevTung\MVC\Controllers\ComponentController::class,
            \DevTung\MVC\Controllers\PostController::class
        ];

        foreach ($controllers as $controller) {
            if (class_exists($controller)) {
                new $controller();
            }
        }
    }
}

// Khởi tạo plugin
DevTungMVC::instance();
