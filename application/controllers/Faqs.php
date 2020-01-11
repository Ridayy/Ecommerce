<?php

class Faqs extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('faq');
    }


    public function add(){
        if(!isset( $_SESSION['admin'])){
            redirect(base_url());
        }else {
            $this->form_validation->set_rules("question_title", "Question", "trim|required");
            $this->form_validation->set_rules("question_answer", "Answer", "trim|required");

            if($this->form_validation->run() == TRUE){

            
                $question = array();
                $question['title'] = $_POST['question_title'];
                $question['answer'] = $_POST['question_answer'];

                if($_POST['question_id'] != ""){
                    $this->faq->edit_question($_POST['question_id'], $question);
                    $this->session->set_flashdata('success', 'Question updated successfully');
                }else {
                    $this->faq->add($question);
                    $this->session->set_flashdata('success', 'Question added successfully');
                }
            
            }else {
                $this->session->set_flashdata('failure', 'Operation was not successful');
            }

            redirect(base_url(). 'admins/faqs');
        }
       
    }
    

    public function get_question($id){
        if(!isset($_SESSION['admin'])){
            redirect(base_url());
        }else {
            echo json_encode($this->faq->get_question_by_id($id));
        }
        
    }

    public function index(){
        $data = array();

        $data['questions'] = $this->faq->get_questions();

        $this->load->view('pages/faqs', $data);
    }

    public function delete($id){
        if(!isset($_SESSION['admin'])){
            redirect(base_url());
        }else {
            if($this->faq->delete_question($id)) {
                $this->session->set_flashdata('success', 'Question deleted successfully');
            }else {
                $this->session->set_flashdata('failure', 'Delete operation was not successful');
            }
      
           redirect(base_url(). 'admins/faqs');
        }
    }
   

}

?>