<?php
/**
 * Plugin Name: MVC Building Search
 */

if ( ! defined( 'ABSPATH' ) ) exit;
require_once __DIR__ . '/helpers.php';

require_once __DIR__ . '/controllers/Controller.php';
require_once __DIR__ . '/controllers/BuildingController.php';

require_once __DIR__ . '/models/BuildingModel.php';

function buildingsearch_init() {
    $controller = new \Building\Controllers\BuildingController();
    $controller->register_hooks();
}
add_action('plugins_loaded', 'buildingsearch_init');
