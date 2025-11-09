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

    public function index() {
        $filterQuanKey = 'filter_district';

        // --- Lấy bộ lọc từ GET ---
        $filters = [
            'locations' => [], // quận + phường
            'ranks'     => [],
            'min_price' => !empty($_GET['min_price']) ? (float) $_GET['min_price'] : 0,
            'max_price' => !empty($_GET['max_price']) ? (float) $_GET['max_price'] : 100,
        ];

        // Lọc quận/phường
        if (!empty($_GET[$filterQuanKey])) {
            $filters['locations'] = array_map('sanitize_text_field', explode(',', $_GET[$filterQuanKey]));
        }

        // Lọc hạng
        if (!empty($_GET['filter_rank'])) {
            $filters['ranks'] = array_map('sanitize_text_field', explode(',', $_GET['filter_rank']));
        }

        // --- Gọi Service, truyền bộ lọc ---
        $data = $this->service->index($filters);

        // --- Selected để view hiển thị lại tick ---
        $selectedDistricts = $filters['locations'];
        $selectedRanks     = $filters['ranks'];

        return $this->render('product/index', [
            'data' => $data,
            'filterQuanKey' => $filterQuanKey,
            'selectedDistricts' => $selectedDistricts,
            'selectedRanks' => $selectedRanks,
            'minPrice' => $filters['min_price'],
            'maxPrice' => $filters['max_price'],
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