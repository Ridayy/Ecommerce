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

    public function logout(){
        unset($_SESSION['admin']);
        redirect(base_url());
    }
}

?>