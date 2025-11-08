<?php
namespace Building\Controllers;

use Building\Models\BuildingModel;

class BuildingController extends Controller {

    private $model;

    public function __construct() {
        $this->model = new BuildingModel();
    }

    public function register_hooks() {
        add_shortcode('buildingRender', function($params) {
            $callback = $params['callback'] ?? '';
            if ($callback && method_exists($this, $callback)) {
                return $this->{$callback}();
            }
            return '';
        });

        add_shortcode('buildingSubMenu', function($params) {
            return $this->buildingSubMenu();
        });
    }

    public function buildingSubMenu(){
        $taxonomy = 'cho-thue-van-phong-ha-noi';
        $quans    = $this->model->quans($taxonomy);
        $hangs    = $this->model->hangs($taxonomy);

        return $this->render('building-submenu', [
            'quans'    => $quans,
            'taxonomy'        => $taxonomy,
            'hangs'    => $hangs,
        ]);
    }

    public function buildingDetail(){
        $productID   = get_the_ID();
        $slideImages = $this->model->slideImages($productID);

        return $this->render('building-detail', [
            'slideImages' => $slideImages
        ]);
    }

    public function buildingsQuan() {
        $page           = $this->model->page();
        $taxonomy       = $page->slug; // dùng slug làm taxonomy
        $quans          = $this->model->quans($taxonomy);
        $hangs          = $this->model->hangs($taxonomy);
        $buildingsQuan  = $this->model->buildingsQuan($taxonomy, $quans);

        $filterQuanKey  = filterQuanKey($taxonomy); // helper camelCase

        $selectedQuans  = [];
        if (!empty($_GET[$filterQuanKey])) {
            $selectedQuans = array_map('sanitize_text_field', explode(',', $_GET[$filterQuanKey]));
        }

        $selectedHangs = [];
        if (!empty($_GET['filter_hang'])) {
            $selectedHangs = array_map('sanitize_text_field', explode(',', $_GET['filter_hang']));
        }

        return $this->render('building-quan', [
            'page'          => $page,
            'taxonomy'      => $taxonomy,
            'quans'         => $quans,
            'hangs'         => $hangs,
            'buildingsQuan' => $buildingsQuan,
            'filterQuanKey' => $filterQuanKey,
            'selectedQuans' => $selectedQuans,
            'selectedHangs' => $selectedHangs,
        ]);
    }

    public function buildingsResult() {
        $page      = $this->model->page();
        $taxonomy  = $page->slug; // dùng slug làm taxonomy
        $quans     = $this->model->quans($taxonomy);
        $hangs     = $this->model->hangs($taxonomy);
        $buildings = $this->model->buildings($taxonomy);

        $filterQuanKey = filterQuanKey($taxonomy); // helper camelCase

        $selectedQuans = [];
        if (!empty($_GET[$filterQuanKey])) {
            $selectedQuans = array_map('sanitize_text_field', explode(',', $_GET[$filterQuanKey]));
        }

        $selectedHangs = [];
        if (!empty($_GET['filter_hang'])) {
            $selectedHangs = array_map('sanitize_text_field', explode(',', $_GET['filter_hang']));
        }

        // Gắn active menu cho result page
        add_filter('nav_menu_css_class', function($classes, $item) use ($selectedQuans) {
            if (!empty($selectedQuans)) {
                foreach ($selectedQuans as $quanSlug) {
                    if (strpos($item->url, $quanSlug) !== false) {
                        $classes[] = 'current-menu-item';
                    }
                }
            }
            return $classes;
        }, 10, 2);

        return $this->render('building-result', [
            'page'          => $page,
            'taxonomy'      => $taxonomy,
            'quans'         => $quans,
            'hangs'         => $hangs,
            'buildings'     => $buildings,
            'filterQuanKey' => $filterQuanKey,
            'selectedQuans' => $selectedQuans,
            'selectedHangs' => $selectedHangs,
        ]);
    }

}
