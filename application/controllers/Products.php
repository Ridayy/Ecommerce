<?php 

class Products extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('product');
        $this->load->model('category');
    }
    public function show($id){
        $data = [
            'product' => $this->product->get_product($id)
        ];
        $this->load->view('products/show', $data);
    }


    public function create(){
        if(!isset($_SESSION['admin'])){
            redirect(base_url());
        }else {

            $data = [
                'categories' => $this->category->get_categories()
            ];

            $this->form_validation->set_rules("file_to_upload", "Product Image", "callback_image_upload");
            $this->form_validation->set_rules("product_desc", "Product Summary", "trim|required");
            $this->form_validation->set_rules('category', 'Product Category', 'required');
            $this->form_validation->set_rules('product_brand', 'Product Brand', 'trim|required');
            $this->form_validation->set_rules('product_price', 'Product Price', 'trim|required|numeric');
            $this->form_validation->set_rules('product_discount', 'Product Discount', 'trim|required|numeric');
            $this->form_validation->set_rules('product_quantity', 'Product Quantity', 'trim|required|numeric');
            $this->form_validation->set_rules('product_desc_detailed', 'Detailed Description', 'trim|required');

                
            if($this->form_validation->run() == FALSE){
                $this->load->view('products/create', $data);
            }
            else {
                // form validated successfully
                $product = array();
                if(isset($_SESSION['image'])){
                    $product['product_image'] = $_SESSION['image'];
                    unset($_SESSION['image']);
                }

                $product['product_description'] = $_POST['product_desc'];
                $product['product_cat'] = $_POST['category'];
                $product['product_price'] = $_POST['product_price'];
                $product['brand'] = $_POST['product_brand'];
                $product['discount'] = $_POST['product_discount'];
                $product['quantity'] = $_POST['product_quantity'];
                $product['product_desc_detailed'] = $_POST['product_desc_detailed'];

                $this->product->add($product);

                $this->session->set_flashdata('add_success', 'Product added successfully');

                redirect(base_url().'admins/products');
            }
         }
     }


    public function edit($id){
        if(!isset($_SESSION['admin'])){
            redirect(base_url());
        }else {
            $data = [
                'product' => $this->product->get_product($id),
                'categories' => $this->category->get_categories()
            ];

            $this->form_validation->set_rules("file_to_upload", "Product Image", "callback_image_upload");
            $this->form_validation->set_rules("product_desc", "Product Summary", "trim|required");
            $this->form_validation->set_rules('category', 'Product Category', 'required');
            $this->form_validation->set_rules('product_brand', 'Product Brand', 'trim|required');
            $this->form_validation->set_rules('product_price', 'Product Price', 'trim|required|numeric');
            $this->form_validation->set_rules('product_discount', 'Product Discount', 'trim|required|numeric');
            $this->form_validation->set_rules('product_quantity', 'Product Quantity', 'trim|required|numeric');
            $this->form_validation->set_rules('product_desc_detailed', 'Detailed Description', 'trim|required');

                
            if($this->form_validation->run() == FALSE){
                $this->load->view('products/edit', $data);
            }
            else {
                // form validated successfully
                $product = array();
                if(isset($_SESSION['image'])){
                    $product['product_image'] = $_SESSION['image'];
                    unset($_SESSION['image']);
                }

                $product['product_description'] = $_POST['product_desc'];
                $product['product_cat'] = $_POST['category'];
                $product['product_price'] = $_POST['product_price'];
                $product['brand'] = $_POST['product_brand'];
                $product['discount'] = $_POST['product_discount'];
                $product['quantity'] = $_POST['product_quantity'];
                $product['product_desc_detailed'] = $_POST['product_desc_detailed'];

                $this->product->edit_product($id, $product);

                $this->session->set_flashdata('edit_success', 'Product edited successfully');

                redirect(base_url().'admins/products');
            }
       }
    }

    public function image_upload($input){
        $upload_ok = true;
        $error_message = "";

        if(isset($_FILES['file_to_upload'])){

            if(empty($_FILES['file_to_upload']['name']) && isset($_POST['create_form'])){
                $upload_ok = false;
                $error_message = "Product image is required";
                $this->form_validation->set_message("image_upload", $error_message);
                return $upload_ok;
            }


            $image_name = $_FILES['file_to_upload']['name'];
            
            if($image_name != ""){
                $root =  dirname(dirname(dirname(__FILE__)));
                $target_dir = $root."/";
                $image = "assets/img/products/".uniqid().basename($image_name);
                $image_path = $target_dir.$image;
                
                $image_file_type = pathinfo($image_name, PATHINFO_EXTENSION);

                if($_FILES['file_to_upload']['size'] > 1000000){
                    $error_message = "Sorry, image is too large";
                    $upload_ok = false;
                }

                if(strtolower($image_file_type) != "jpeg" && strtolower($image_file_type) != "png" && strtolower($image_file_type) != "jpg"){
                    $error_message = "Sorry, image is too large";
                    $upload_ok = false;
                }

                if($upload_ok){
                    if(move_uploaded_file($_FILES['file_to_upload']['tmp_name'], $image_path)){
        
                    }else {
                        $error_message = "Sorry, image was not uploaded due to some reason";
                        $upload_ok = false;
                    }
                }

                if($upload_ok){
                    $_SESSION['image'] = $image;
                }else {
                    $this->form_validation->set_message("file_to_upload", $error_message);
                }

                return $upload_ok;
            }   
       }


       return $upload_ok;
    }

    public function delete($id){
        if(!isset($_SESSION['admin'])){
            redirect(base_url());
        }else {
           if($this->product->delete_product($id)) {
                $this->session->set_flashdata('delete_success', 'Product deleted successfully');
           }else {
            $this->session->set_flashdata('delete_failure', 'Delete operation was not successful');
           }
        }

        redirect(base_url(). 'admins/products');
    }

}

?>