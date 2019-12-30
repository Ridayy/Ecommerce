<?php
    class Category extends CI_Model {
        public function add($category){
            $this->db->insert('categories', $category);
        }

        public function get_category($id){
            return $this->db->get_where('categories', array('id'=>$id))->row_array();
        }

        public function get_categories(){
            return $this->db->get('categories')->result_array();
        }
    }

?>