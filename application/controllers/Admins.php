<?php

class Admins extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('admin');
    }

    public function index(){

        if(isset( $_SESSION['admin'])){
            $this->load->view('admins/dashboard');
        }else {
            $this->form_validation->set_rules("email", "Email", "trim|required");
            $this->form_validation->set_rules('password', 'Password', 'required');

            if($this->form_validation->run() == TRUE){
                if($this->admin->check_admin($_POST['email'], md5($_POST['password'])) == ''){
                    $this->session->set_flashdata('failure', 'Invalid Credentials');
                    redirect(base_url().'admins/index');
                }else {
                    $_SESSION['admin'] = true;
                    redirect(base_url().'admins/dashboard');
                }
            }else {
                $this->load->view('admins/index');
            }
        }

        
    }

    public function dashboard() {
        if(!isset( $_SESSION['admin'])){
            redirect(base_url());
        }else {
            $this->load->view('admins/dashboard');
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

    public function logout(){
        unset($_SESSION['admin']);
        redirect(base_url());
    }
}

?>