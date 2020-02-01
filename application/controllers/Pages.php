<?php

class Pages extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('category');
        $this->load->model('product');
        $this->load->model('faq');
        $this->load->model('slide');
    }

    public function index(){
        $data = [
            'categories' => $this->category->get_categories(),
            'products' => $this->product->get_recent_products(),
            'slides' => $this->slide->get_home_slides(),
        ];


        $titles = array();

        $values =  $this->slide->get_home_titles();

        foreach($values as $value){
            array_push($titles, $value['slide_title']);
        }

       $data['titles'] =  implode(",", $titles);
        

        $this->load->view('pages/home', $data);
    }

    public function shop(){
        $data = [
            'categories' => $this->category->get_categories(),
            'products' => $this->product->get_products(),
            
        ];
        
        $this->load->view('pages/shop', $data);
    }

    public function new(){
        $data = [
            'categories' => $this->category->get_categories(),
            'products' => $this->product->get_new(),
            'slides' => $this->slide->get_shop_slides(),
            'num_slides' => count($this->slide->get_shop_slides())
        ];
            
        $this->load->view('pages/new', $data);
    }

    public function search(){
        if(isset($_POST['query'])){
            $keywords = explode(" ", $_POST['query']);
            $search_results = $this->product->get_search_results($keywords);

            $search_div = "";

            foreach($search_results as $result){
                $url = base_url(). 'products/show/'.$result['id'];
                $product_image = base_url(). $result['product_image'];
                $desc = $result['product_description'];
                $search_div .= "<div class='results_display'>
                                 <a href='$url'>
                                    <div class='product_image'>
                                        <img src='$product_image' />
                                    </div>
                                    <div class='live_search_text'>
                                        $desc
                                    </div>
                                 </a>
                               </div>";
            }

            echo $search_div."";

        }


        if(isset($_GET['q'])){
            $keywords = explode(" ", $_GET['q']);
            $search_results = $this->product->search_all($keywords);
            $data = [
                'categories' => $this->category->get_categories(),
                'search_results' => $search_results
            ];
            $this->load->view('pages/search_all', $data);
        }


    }

    public function contact(){
        
        $this->form_validation->set_rules("name", "Name", "trim|required|alpha|max_length[30]|min_length[3]");
        $this->form_validation->set_rules("subject", "Subject", "trim|required");
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
        $this->form_validation->set_rules("message", "Message", "trim|required");
        $this->form_validation->set_rules('mobile', 'Mobile Number ', 'required|regex_match[/^[0-9]{11}$/]');


        if($this->form_validation->run() == FALSE){
            $this->load->view('pages/contact');
        }
        else {
            // form validated successfully
            $mail = array();

            $mail['name'] = $_POST['name'];
            $mail['email'] = $_POST['email'];
            $mail['subject'] = $_POST['subject'];
            $mail['mobile'] = $_POST['mobile'];
            $mail['message'] = $_POST['message'];
           

            if($this->sendMessage($mail)){
                $this->session->set_flashdata('success', 'Message sent successfully');
            }else {
                $this->session->set_flashdata('failure', 'Your Message was not sent');
            }
            redirect(base_url().'pages/contact');
        }
    }

    public function track(){
        $this->form_validation->set_rules("order_id", "Order ID", "trim|required|numeric");
        if($this->form_validation->run() == FALSE){
           
            $this->load->view('pages/track');
        }else {
            $data = array();
           
            $this->load->model('order');
            $result = $this->order->get_order_by_id($_POST['order_id']);

            if($result == ''){
                $data['status'] = 'none';
            }else {
                $data['status'] = $result['status'];
            }
            
           
            $this->load->view('pages/track', $data);
        }
        
    }

    public function checkout(){
        if(!isset($_SESSION['user_id'])){
            redirect(base_url().'pages/shop');
        }else {
            $this->load->view('pages/checkout');
        }
    }

    public function payment(){
        if(!isset($_SESSION['user_id']) && !isset($_SESSION['products'])){
            redirect(base_url().'pages/shop');
        }else {
           
            $this->form_validation->set_rules('phone', 'Mobile Number ', 'required|regex_match[/^[0-9]{11}$/]');
            $this->form_validation->set_rules("address", "Shipping Address", "trim|required");
            $this->form_validation->set_rules("city", "City", "trim|required|alpha");
            $this->form_validation->set_rules("state", "State", "trim|required|alpha");
            
            


            if($this->form_validation->run() == FALSE){
                $this->load->view('pages/payment');
            }
            else {
                // form validated successfully
                $customer = array();

                $customer['city'] = $_POST['city'];
                $customer['state'] = $_POST['state'];
                $customer['phone'] = $_POST['phone'];
                $customer['address'] = $_POST['address'];
                
                $_SESSION['details_taken'] = true;

                $this->load->view('pages/review', $customer);
            }
        }
    }

    public function faqs(){
        $data = array();

        $data['questions'] = $this->faq->get_questions();

        $this->load->view('pages/faqs', $data);
    }

    public function confirm(){
        $this->load->view('pages/confirm');
    }

    public function thankyou(){
        $this->load->view('pages/thankyou');
    }

    public function destroy(){
        session_destroy();
    }

    private function sendMessage($mail){
        $to = "ridaarif20@gmail.com";
        $from_name = $mail['name'];
        $subject = $mail['subject'];
        $email = $mail['email'];
        $message = $mail['message'];

        $headers = "From: ".$email;

        return mail($to, $subject, $message, $headers);

    }
}

?>