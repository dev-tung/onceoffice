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
        $data = $this->service->index();

        //dd($data);

        $filterQuanKey = 'filter_district';

        $selectedDistricts  = [];
        if (!empty($_GET['filter_district'])) {
            $selectedDistricts = array_map('sanitize_text_field', explode(',', $_GET[$filterQuanKey]));
        }

        $selectedRanks = [];
        if (!empty($_GET['filter_rank'])) {
            $selectedRanks = array_map('sanitize_text_field', explode(',', $_GET['filter_rank']));
        }

        return $this->render('product/index', [
            'data'          => $data,
            'filterQuanKey' => $filterQuanKey,
            'selectedDistricts' => $selectedDistricts,
            'selectedRanks' => $selectedRanks,
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