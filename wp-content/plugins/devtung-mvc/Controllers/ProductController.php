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

        // SEARCH FORM
        $formData = $this->service->formData();

        // TAGS
        $tagData  = $formData['districts'];

        // Lặp từng district
        $districtData = $this->service->districtData();

        // Render index or search page
        if(  
            !empty( $formData['searchTerm'] )
            || !empty( $formData['selectedDistricts'] )
            || $formData['minPrice'] > 0
            || $formData['maxPrice'] < 100
            || !empty( $formData['selectedRanks'] )
        ){

            $buildings = ProductService::getBuildingWithFilter($formData);
            return $this->render('product/search', [
                'formData' => $formData,
                'buildings' => $buildings
            ]);
        }

        return $this->render('product/index', [
            'formData' => $formData,
            'tagData'  => $tagData,
            'districtData' => $districtData
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