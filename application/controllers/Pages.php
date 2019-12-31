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