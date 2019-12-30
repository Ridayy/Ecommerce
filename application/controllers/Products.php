<?php 

class Products extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('product');
    }
    public function show($id){
        $data = [
            'product' => $this->product->get_product($id)
        ];
        $this->load->view('products/show', $data);
    }
}

?>