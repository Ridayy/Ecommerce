<?php

class Categories extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['admin'])){
            redirect(base_url().'/pages/products');
        }
    }

    public function add(){

    }

    public function edit(){

    }

    public function delete(){
        
    }
}
?>