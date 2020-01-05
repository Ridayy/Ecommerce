<?php

class Categories extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['admin'])){
            redirect(base_url().'/pages/products');
        }else {
            $this->load->model('category');
        }
    }

    public function add(){

        

        $this->form_validation->set_rules("cat_name", "Category Name", "trim|required");
        if($this->form_validation->run() == TRUE){

           
            $category = array();
            $category['cat_name'] = $_POST['cat_name'];
            $category['cat_class'] = $this->create_class($_POST['cat_name']);
            if($_POST['cat_id'] != ""){
                $this->category->edit_category($_POST['cat_id'], $category);
                $this->session->set_flashdata('success', 'Category updated successfully');
            }else {
                $this->category->add($category);
                $this->session->set_flashdata('success', 'Category added successfully');
            }
           
        }else {
            $this->session->set_flashdata('failure', 'Operation was not successful');
        }

        redirect(base_url(). 'admins/categories');
        
    }


    public function delete($id){
        if($this->category->check_category_in_products($id)){
            $this->session->set_flashdata('failure', 'Delete operation was not successful because some products have this category. Delete those products first.');
        }else {
            if($this->category->delete_category($id)) {
                $this->session->set_flashdata('success', 'Category deleted successfully');
           }else {
                $this->session->set_flashdata('failure', 'Delete operation was not successful');
           }
        }
        

       redirect(base_url(). 'admins/categories');
    }

    public function get_category($id){
        echo json_encode($this->category->get_category_by_id($id));
    }

    private function create_class($name){
        $name = preg_replace('/[ ,]+/', '_', $name);
        return strtolower(preg_replace('/[^A-Za-z0-9_]/', '', $name));
    }
}
?>