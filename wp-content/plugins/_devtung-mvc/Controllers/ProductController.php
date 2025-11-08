<?php
namespace DevTung\MVC\Controllers;

class ProductController extends BaseController {

    public function __construct() {
        add_shortcode('dt_list_product', function($params) {
            return "HAHAHA";
        });
    }
    
}