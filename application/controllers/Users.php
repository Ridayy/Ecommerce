<?php

class Users extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('user');
    }

    public function delete($id){
        if(!isset($_SESSION['admin'])){
            redirect(base_url());
        }else {
            if($this->user->delete_user($id)) {
                $this->session->set_flashdata('success', 'User deleted successfully!');
            }else {
                $this->session->set_flashdata('failure', 'Delete Operation was not successful!');
            }
            redirect(base_url(). 'admins/users');
        }
    }

    public function show(){
        $user_id = $_SESSION['user_id'];
        $this->load->view('pages/profile');
    }

    public function add_order($user_id){
        $this->user->add_order($user_id);
    }
}