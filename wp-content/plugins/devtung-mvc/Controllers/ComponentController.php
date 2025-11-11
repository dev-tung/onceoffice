<?php
namespace DevTung\MVC\Controllers;

use DevTung\MVC\Services\ComponentService;

class ComponentController extends BaseController {

    private $service;

    public function __construct() {
        $this->service = new ComponentService();
        add_shortcode('dt_component_submenu', [$this, 'submenu']);
        add_shortcode('dt_component_submenumobile', [$this, 'submenumobile']);
    }

    public function submenu(){
        $data = $this->service->submenu();
        return $this->render('components/submenu', $data);
    }
    
    public function submenumobile(){
        $data = $this->service->submenu();
        return $this->render('components/submenumobile', $data);
    }
}