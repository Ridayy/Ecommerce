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

    public function change(){
       if(isset($_POST['pic'])){
           $this->user->change_profile_pic($_POST['pic'], $_SESSION['user_id']);
          echo 'success';
       }
    }

    public function upload(){
        $this->load->view('users/upload_profile_pic.php');
    }

    public function show(){
       if(!isset($_SESSION['user_id'])){
           redirect(base_url());
       }else {
        $user_id = $_SESSION['user_id'];
        $data = array();

        $row = $this->user->get_user($user_id);

        $data['name'] = $row['name'];
        $data['email'] = $row['email'];
        $data['num_orders'] = $row['num_orders'];
        $data['profile_pic'] = $row['profile_pic'];  
        $data['created_at'] = $row['created_at']; 

        $this->load->view('users/dashboard', $data);
       }
    }

    public function orders(){
        if(!isset($_SESSION['user_id'])){
            redirect(base_url());
        }else {

         $this->load->model('order');   

        

         $user_id = $_SESSION['user_id'];
         $row = $this->order->get_user_orders($user_id);

         $data = array();
            
         $data['orders'] = $row;

         $this->load->view('users/orders', $data);
        
        }

      
    }

    public function addresses(){
        if(!isset($_SESSION['user_id'])){
            redirect(base_url());
        }else {

         $this->load->model('order');   

        

         $user_id = $_SESSION['user_id'];
         $row = $this->order->get_user_orders($user_id);

         $data = array();
            
         $data['orders'] = $row;

         $this->load->view('users/addresses', $data);
        
    }
}

    public function settings(){
        if(!isset($_SESSION['user_id'])){
            redirect(base_url());
        }else {
            // $this->form_validation->set_rules("file_to_upload", "User Image", "callback_image_upload");
            $this->form_validation->set_rules("new_email", "New Email", "trim|required|valid_email|callback_check_email");
            $this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_check_password');
            $this->form_validation->set_rules('new_password', 'New Password', 'required');
           
            $data = array();

            $user_id = $_SESSION['user_id'];
            $row = $this->user->get_user($user_id);
    
            $data['name'] = $row['name'];
            $data['email'] = $row['email'];
            $data['num_orders'] = $row['num_orders'];
            $data['profile_pic'] = $row['profile_pic'];  
            $data['created_at'] = $row['created_at']; 
                
            if($this->form_validation->run() == FALSE){
                $this->load->view('users/settings', $data);
            }else {
                $user = [
                    'email' => $_POST['new_email'],
                    'password' => md5($_POST['new_password'])
                ];
                $this->user->edit_user($user);
                $this->session->set_flashdata('success', 'Details Updated Successfully!');
                $this->load->view('users/settings', $data);
            }

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

function check_password($password){
    if ($this->user->check_password($password)) {
      return true;
    } else {
      $this->form_validation->set_message('check_password', 'Invalid Old Password!');
      return false;
    }
}

    public function add_order($user_id){
        $this->user->add_order($user_id);
    }
}