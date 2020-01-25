<?php 

class Reviews extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('review');
    }

    public function add(){
        $this->form_validation->set_rules("rating", "Rating", "required");
        $this->form_validation->set_rules("review_area", "Review", "trim|required");
        $this->form_validation->set_rules("productId", "Product ID", "required");

        if($this->form_validation->run() == FALSE){
            echo json_encode($this->form_validation->error_array());
        }else {
            $review = array();

            $review['review_text'] = $_POST['review_area'];
            $review['rating'] = $_POST['rating'];
            $review['user_id'] = $_SESSION['user_id'];
            $review['product_id'] = $_POST['productId'];

            $this->review->add_review($review);

            echo '';
        }

    }  

    public function delete($id){
        if(!isset($_SESSION['admin'])){
            redirect(base_url());
        }else {
            if($this->review->delete_review($id)) {
                $this->session->set_flashdata('success', 'Review deleted successfully');
           }else {
                $this->session->set_flashdata('failure', 'Delete operation was not successful');
           }
           redirect(base_url(). 'admins/reviews');
        }
    }

}