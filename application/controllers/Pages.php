<?php

class Pages extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('category');
        $this->load->model('product');
    }

    public function index(){
        $data = [
            'categories' => $this->category->get_categories(),
            'products' => $this->product->get_recent_products()
        ];

        $this->load->view('pages/home', $data);
    }

    public function shop(){
        $data = [
            'categories' => $this->category->get_categories(),
            'products' => $this->product->get_products()
        ];
        
        $this->load->view('pages/shop', $data);
    }

    public function contact(){
        $this->load->view('pages/contact');
    }
}

?>