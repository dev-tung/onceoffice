<?php
namespace DevTung\MVC\Controllers;

use DevTung\MVC\Services\ProductService;
use DevTung\MVC\Models\ProductModel;

class ProductController extends BaseController {

    private $service;
    private $model;

    public function __construct() {
        $this->service = new ProductService();
        $this->model   = new ProductModel();

        add_shortcode('dt_product_index',  [$this, 'index']);
        add_shortcode('dt_product_search', [$this, 'search']);
        add_shortcode('dt_product_detail', [$this, 'detail']);
    }

    public function index(){
        $formData = $this->service->formData();

        return $this->render('product/index', [
            'formData' => $formData
        ]);
    }

    public function detail(){
        $productID   = get_the_ID();
        $slideImages = $this->model->slideImages($productID);

        return $this->render('product/detail', [
            'slideImages' => $slideImages
        ]);
    }
    
}