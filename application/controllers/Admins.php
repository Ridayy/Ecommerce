<?php

class Admins extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('admin');
    }

    public function index(){

        if(isset( $_SESSION['admin'])){
            $this->load->model('order');
            $this->load->model('product');
            $this->load->model('user');
            $this->load->model('category');

            $data = [
                'total_orders' => count($this->order->total_orders()),
                'total_products' => $this->product->total_products(),
                'total_users' => $this->user->total_users(),
                'total_categories' => $this->category->total_categories(),
                'orders' =>  $this->order->get_all()
            ];

            $this->load->view('admins/dashboard', $data);
        }else {
            $this->form_validation->set_rules("email", "Email", "trim|required");
            $this->form_validation->set_rules('password', 'Password', 'required');

            if($this->form_validation->run() == TRUE){
                if($this->admin->check_admin($_POST['email'], md5($_POST['password'])) == ''){
                    $this->session->set_flashdata('failure', 'Invalid Credentials');
                    redirect(base_url().'admins/index');
                }else {
                    $_SESSION['admin'] = $_POST['email'];
                    redirect(base_url().'admins/dashboard');
                }
            }else {
                $this->load->view('admins/index');
            }
        }

        
    }

    public function change(){
        $this->form_validation->set_rules('new_email', 'New Email', 'trim|required|valid_email');
        $this->form_validation->set_rules("old_password", "Old Password", "trim|required|callback_check_password");
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');


        if($this->form_validation->run() == TRUE){
           $this->admin->update_admin($_SESSION['admin'], $_POST['new_email'], $_POST['new_password']);
           $_SESSION['admin'] = $_POST['new_email'];
        }else {
            echo json_encode($this->form_validation->error_array());
        }
    }

   
    public function check_password($password){
        if($this->admin->check_password($_SESSION['admin'], $password) != ''){
            return true;
        }
        else {
            $this->form_validation->set_message('check_password', 'Invalid Old Password');
            return false;
        }
    }

    public function dashboard() {
        if(!isset( $_SESSION['admin'])){
            redirect(base_url());
        }else {
            $this->load->model('order');
            $this->load->model('product');
            $this->load->model('user');
            $this->load->model('category');

            $data = [
                'total_orders' => count($this->order->total_orders()),
                'total_products' => $this->product->total_products(),
                'total_users' => $this->user->total_users(),
                'total_categories' => $this->category->total_categories(),
                'orders' =>  $this->order->get_all()
            ];
            $this->load->view('admins/dashboard', $data);
        }  
    }

    public function users(){
        if(!isset( $_SESSION['admin'])){
            redirect(base_url());
        }else {
            $this->load->model('user');
            

            $data = [
                'users' =>  $this->user->get_users()
            ];

            $this->load->view('admins/users', $data);
        }  
    }

    public function products(){
        if(!isset( $_SESSION['admin'])){
            redirect(base_url());
        }else {
            $this->load->model('product');
            $data = [
                'products' => $this->product->get_products()
            ];
            $this->load->view('admins/products', $data);
        }  
    }

    public function categories(){
        if(!isset( $_SESSION['admin'])){
            redirect(base_url());
        }else {
            $this->load->model('category');
            $data = [
                'categories' => $this->category->get_categories()
            ];
            $this->load->view('admins/categories', $data);
        }  
    }

    public function faqs(){ 
        if(!isset( $_SESSION['admin'])){
            redirect(base_url());
        }else {
            $this->load->model('faq');
            $data = [
                'questions' => $this->faq->get_questions()
            ];
            $this->load->view('admins/faqs', $data);
        }  
    }

    public function reviews(){
        if(!isset( $_SESSION['admin'])){
            redirect(base_url());
        }else {
            $this->load->model('review');
            $data = [
                'reviews' => $this->review->get_all()
            ];
            $this->load->view('admins/reviews', $data);
        }  
    }

    public function slides(){
        if(!isset( $_SESSION['admin'])){
            redirect(base_url());
        }else {
            $this->load->model('slide');
            $data = [
                'slides' => $this->slide->get_slides()
            ];
            $this->load->view('admins/slides', $data);
        }  
    }

    public function remove($id){
        $this->load->model('slide');
        if(!isset($_SESSION['admin'])){
            redirect(base_url());
        }else {
           if($this->slide->delete_slide($id)) {
                $this->session->set_flashdata('success', 'Slide deleted successfully');
           }else {
            $this->session->set_flashdata('failure', 'Delete operation was not successful');
           }
        }

        redirect(base_url(). 'admins/slides');
    }

    public function edit_title() {
        $this->load->model('slide');
        $this->form_validation->set_rules("edit_title", "Slide Title", "trim|required");
        $this->form_validation->set_rules("slide_id", "Slide ID", "required");

        if($this->form_validation->run() == TRUE){
            $this->slide->edit($_POST['slide_id'], $_POST['edit_title']);
            $this->session->set_flashdata('success', 'Slide updated successfully');
        }else {
         $this->session->set_flashdata('failure', 'Update operation was not successful');
        }

        redirect(base_url().'admins/slides');
        
    }


    public function get_slide($id){
        $this->load->model('slide');
        echo json_encode($this->slide->get_slide_by_id($id));
    }

    public function remove_from_page($id){
        $this->load->model('slide');
        if(!isset($_SESSION['admin'])){
            redirect(base_url());
        }else {
           if($this->slide->remove_slide($id)) {
                $this->session->set_flashdata('success', 'Slide removed from the page');
           }else {
            $this->session->set_flashdata('failure', 'Delete operation was not successful');
           }
        }

        redirect(base_url(). 'admins/slides');
    }



    public function logout(){
        unset($_SESSION['admin']);
        redirect(base_url());
    }

    public function add_slide(){
        $this->load->model('slide');
        $this->form_validation->set_rules('file_to_upload', 'Slide Image', 'callback_image_upload');
        $this->form_validation->set_rules('slide_title', 'Slide Title', 'trim|required');


        if($this->form_validation->run() == TRUE){
            //form validated successfully

            $slide = array();

            if(isset($_SESSION['image'])){
                $slide['slide_img'] = $_SESSION['image'];
                unset($_SESSION['image']);
                $this->session->set_flashdata('success', 'Slide added successfully');
                $slide['slide_title'] = $_POST['slide_title'];
                $this->slide->add($slide);
                echo '';
            }
        }else {
            echo json_encode($this->form_validation->error_array());
        }
    }

    public function add_to_home($id){
        $this->load->model('slide');
        if($this->slide->add_to_home($id)){
            $this->session->set_flashdata('success', 'Slide added successfully to home page');
        }else {
            $this->session->set_flashdata('failure', 'Add operation was not successful');
        }
        redirect(base_url().'admins/slides');
    }

    public function add_to_shop($id){
        $this->load->model('slide');
        if($this->slide->add_to_shop($id)){
            $this->session->set_flashdata('success', 'Slide added successfully to shop page');
        }else {
            $this->session->set_flashdata('failure', 'Add operation was not successful');
        }
        redirect(base_url().'admins/slides');
    }


    public function image_upload($input){
        $upload_ok = true;
        $error_message = "";

        if(isset($_FILES['file_to_upload'])){

            if(empty($_FILES['file_to_upload']['name'])){
                $upload_ok = false;
                $error_message = "Slide image is required";
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
       }else {
            $this->form_validation->set_message("image_upload", "Parameter not set");
            return false;
       }

      
    }
}

?>