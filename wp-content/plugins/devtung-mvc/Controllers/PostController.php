<?php
namespace DevTung\MVC\Controllers;
use DevTung\MVC\Models\PostModel;

class PostController extends BaseController {

    private $post;

    public function __construct() {
        $this->post = new PostModel;
        add_shortcode('dt_post_category', [$this, 'category']);
    }
    
    public function index(){
        $data = $this->post->index(); 
        return $this->render('product/index');
    }

    public function category(){
        $data = $this->post->category(); 
        // dd($data);
        return $this->render('post/category', $data);
    }
}