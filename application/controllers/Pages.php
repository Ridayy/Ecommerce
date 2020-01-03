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