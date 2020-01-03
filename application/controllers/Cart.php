<?php 

class Cart extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('product');
    }
    /**
     * add - Adds product to cart via its id
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function add($id){
       $row = $this->product->get_product($id);
    
       if(!isset($_SESSION['product_'. $id])){
            $_SESSION['product_'. $id] = 0;
       }

       if($row['quantity'] != $_SESSION['product_'. $id]){

        $_SESSION['product_'. $id] += 1;
        if($_SESSION['product_'. $id] == 1){
            $this->session->set_flashdata('checkout_msg', "Added to cart!");
        }else {
            $this->session->set_flashdata('checkout_msg', "Quantity increased");
        }
        

       }else {
        $this->session->set_flashdata('checkout_msg', "Sorry, We have only ".$row['quantity']." products available");
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
                $this->cart_items();
                $this->session->set_flashdata('checkout_msg', "Quantity reduced");
            }
            
        }
        redirect(base_url(). 'pages/checkout');
     }

     public function delete($id){
      
        if(isset($_SESSION['product_'. $id])){
            unset($_SESSION['product_'. $id]);
            $this->session->set_flashdata('checkout_msg', "Product Removed");
            $this->cart_items();
            $_SESSION['products'] = $this->product->get_cart_products($_SESSION['items']);
        }
        redirect(base_url(). 'pages/checkout');
     }

    private function cart_items(){
        $_SESSION['items'] = array(); //ids
        $_SESSION['total_quantity'] = array();
        $orders = array();

        foreach ($_SESSION as $name => $value) {
           
            if(substr($name, 0, 8) == "product_"){
                array_push($_SESSION['items'], substr($name, 8));
                $orders[substr($name, 8)] = $value;
                array_push($_SESSION['total_quantity'], $value);
            } 
        }
        $_SESSION['orders_json'] = json_encode($orders, JSON_FORCE_OBJECT);
    }

    
}

?>