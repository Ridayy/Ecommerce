<?php 

class Orders extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('order');
    }
   
    public function place(){
        if(!isset($_SESSION['details_taken'])){
            redirect(base_url());
        }
        else {
            $order = array();
            $order['city'] = $_POST['city'];
            $order['state'] = $_POST['state'];
            $order['phone'] = $_POST['phone'];
            $order['address'] = $_POST['address'];
            $order['amount'] = $_POST['amount'];
            $order['user_id'] = $_SESSION['user_id'];
            $order['product_summary'] = $_SESSION['orders_json'];
            $order['status'] = 'pending';

            $order_id = $this->order->add($order);
            if($this->send_email($_SESSION['user_email'], $order_id)){
                $this->session->set_flashdata('email_success', $_SESSION['user_email']);
            }else {
                $this->session->set_flashdata('email_failure', $_SESSION['user_email']);
            }
            $_SESSION['order_set'] = true;
            $this->remove_all();
            redirect(base_url().'pages/confirm');
        }  
    }


    private function send_email($user_email, $order_id){
        $url = 'https://api.elasticemail.com/v2/email/send';
        $confirm_url = 'http://localhost/ecommerce/orders/confirm/'.$order_id;
        
        $success = false;

        $email = $user_email;

        try{
                $post = array('from' => 'me@ridaarif.com',
                'fromName' => 'The Mountain',
                'apikey' => '8cab7c59-4dc4-4971-9a6f-522bb74d7e64',
                'subject' => 'Order Confirmation',
                'to' => $email,
                'bodyHtml' => 'Confirm your order by clicking on the link below<br>'.$confirm_url,
                'isTransactional' => false);
            
                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_URL => $url,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $post,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HEADER => false,
                    CURLOPT_SSL_VERIFYPEER => false
                ));
            
                $result=curl_exec ($ch);
                curl_close ($ch);
            
                if(json_decode($result,true)["success"]){
                    $success = true;
                }	
        }
        catch(Exception $ex){
            
        }

        return $success;
    }

 

    public function get_pending(){
        if(!isset($_SESSION['admin'])){
            redirect(base_url());
        }
        $data = array();
        $data['orders'] = $this->order->get_pending();
        $this->load->view('admins/pending', $data);
    }

    public function get_confirmed(){
        if(!isset($_SESSION['admin'])){
            redirect(base_url());
        }
        $data = array();
        $data['orders'] = $this->order->get_confirmed();
        $this->load->view('admins/confirmed', $data);
    }

    public function set_completed($id){
        if(!isset($_SESSION['admin'])){
            redirect(base_url());
        }
       
        if($this->order->set_completed($id)){
            $this->session->set_flashdata('success', "Successfully Completed");
        }else {
            $this->session->set_flashdata('failure', "Operation was not successful");
        }
        redirect(base_url(). 'orders/get_confirmed');
    }

    public function get_completed(){
        if(!isset($_SESSION['admin'])){
            redirect(base_url());
        }
        $data = array();
        $data['orders'] = $this->order->get_completed();
        $this->load->view('admins/completed', $data);
    }

    public function delete($id){
        if(!isset($_SESSION['admin'])){
            redirect(base_url());
        }
        if($this->order->delete_order($id)){
            $this->session->set_flashdata('success', "Order Deleted Successfully");
        }else {
            $this->session->set_flashdata('failure', "Delete Operation was not successul");
        }

        if(isset($_GET['page'])){
            redirect(base_url(). 'orders/get_'.$_GET['page']);
        }else {
            redirect(base_url(). 'orders/get_pending');
        }
        
        
    }



    public function confirm($id){
      $this->order->confirm($id);
      $this->load->model('user');
    
      // get user id from order id bcs user might not be logged in
      $this->user->add_order($this->order->get_user($id));

      $this->session->set_flashdata('order_id', $id);
      $_SESSION['thankyou'] = true;
      redirect(base_url(). 'pages/thankyou');
    }

    private function remove_all(){
        if(isset($_SESSION['items']) && isset($_SESSION['total_quantity']) && isset( $_SESSION['products'])){
            unset($_SESSION['items'], $_SESSION['total_quantity'], $_SESSION['products'], $_SESSION['details_taken'], $_SESSION['orders_json']);
            foreach ($_SESSION as $name => $value) {
           
                if(substr($name, 0, 8) == "product_"){
                    unset($_SESSION[$name]);
                } 
    
            }
        }
    }
}

?>