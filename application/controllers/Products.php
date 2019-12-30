<?php 

class Products extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('product');
    }
    public function show($id){

        $this->load->view('products/show', $data);
    }
}

?>