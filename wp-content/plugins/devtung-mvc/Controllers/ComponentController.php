<?php
namespace DevTung\MVC\Controllers;

use DevTung\MVC\Services\ComponentService;

class ComponentController extends BaseController {

    private $service;

    public function __construct() {
        $this->service = new ComponentService();
        add_shortcode('dt_component_submenu', [$this, 'submenu']);
    }

    public function submenu(){
        $data = $this->service->submenu();
        return $this->render('components/submenu', $data);
    }
    
}