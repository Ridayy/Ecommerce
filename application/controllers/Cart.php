<?php 

class Cart extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('product');
    }
    public function add($id){
       $row = $this->product->get_product($id);
    
       if(!isset($_SESSION['product_'. $id])){
            $_SESSION['product_'. $id] = 0;
       }

       if($row['quantity'] != $_SESSION['product_'. $id]){

        $_SESSION['product_'. $id] += 1;
        // $this->product->reduce_quantity($id, $row['quantity']--);
        $this->session->set_flashdata('success', "Added to cart!");

       }else {
        $this->session->set_flashdata('failure', "We have only ".$row['quantity']." products available");
       }
       $this->cart_items();
       $_SESSION['products'] = $this->product->get_cart_products($_SESSION['items']);
       
       redirect(base_url(). 'pages/checkout');
    }

    public function remove($id){
      
        if(isset($_SESSION['product_'. $id]) && $_SESSION['product_'. $id] != 0){
            $_SESSION['product_'. $id]--;
            if($_SESSION['product_'. $id] == 0){
                $this->delete($id);
            }else {
                $this->session->set_flashdata('success', "1 item removed");
            }
            
        }
        redirect(base_url(). 'pages/checkout');
     }

     public function delete($id){
      
        if(isset($_SESSION['product_'. $id])){
            unset($_SESSION['product_'. $id]);
            $this->session->set_flashdata('success', "Product Removed");
            $this->cart_items();
            $_SESSION['products'] = $this->product->get_cart_products($_SESSION['items']);
        }
        redirect(base_url(). 'pages/checkout');
     }

    private function cart_items(){
        $_SESSION['items'] = array();
        foreach ($_SESSION as $name => $value) {
           
            if(substr($name, 0, 8) == "product_"){
                array_push($_SESSION['items'], substr($name, 8));
            } 

        }
    }
 
}

?>