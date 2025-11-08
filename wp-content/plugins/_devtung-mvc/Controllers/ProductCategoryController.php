<?php
namespace DevTung\MVC\Controllers;

use DevTung\MVC\Services\ProductCategoryService;

class ProductCategoryController extends BaseController {

    private $service;

    public function __construct() {
        $this->service = new ProductCategoryService();
        add_shortcode('dt_product_category_index', [$this, 'index']);
    }

    public function index(){
        $data = $this->service->index();
        // dd($data);
        return $this->render('product_category/index');
    }
    
}