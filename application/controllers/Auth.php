<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('user');
    }

    public function login(){
        $this->form_validation->set_rules("email", "Email", "trim|required");
        $this->form_validation->set_rules('password', 'Password', 'required');
        if($this->form_validation->run() == TRUE){
            if($this->user->check_user($_POST['email'], md5($_POST['password'])) == ''){
                $this->session->set_flashdata('failure', 'Invalid Credentials');
                redirect(base_url().'auth/login');
            }else {
                $_SESSION['user_id'] = $this->user->get_userid($_POST['email']);
                redirect(base_url().'products/index');
            }
        }else {
            $this->load->view('auth/login');
        }
    }

    public function register(){
    
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email|callback_check_email");
        $this->form_validation->set_rules("name", "Name", "trim|required|alpha|max_length[30]|min_length[3]");
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');


        if($this->form_validation->run() == FALSE){
            $this->load->view('auth/register');
        }
        else {
            // form validated successfully
            $user = array();

            // $user['name'] = $this->input->post('name');
            $user['name'] = $_POST['name'];
            $user['email'] = $_POST['email'];
            $user['password'] = md5($_POST['password']);

            $this->user->add_user($user);
            $this->session->set_flashdata('success', 'Account created successfully. You can log in now');
            redirect(base_url().'auth/login');
        }
       
     }


     function check_email($email){
        if ($this->user->check_email($email) == false) {
          return true;
        } else {
          $this->form_validation->set_message('check_email', 'This email already exist!');
          return false;
        }
    }

    public function logout(){
        session_destroy();
        redirect(base_url());
    }
}