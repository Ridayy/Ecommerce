<?php
    class Category extends CI_Model {
        public function add($category){
            $this->db->insert('categories', $category);
        }

        public function total_categories(){
            $query = $this->db->get('categories');
            return count($query->result());
        }

        public function get_category_by_id($id){
            return $this->db->get_where('categories', array('cat_id'=>$id))->row_array();
        }

        public function get_categories(){
            return $this->db->get('categories')->result_array();
        }

        public function edit_category($id, $data){
            $this->db->where('cat_id', $id);
            $this->db->update('categories', $data);
        }

        public function delete_category($id){
            $this->db->where('cat_id', $id);
            $this->db->delete('categories');
            if ($this->db->affected_rows() == '1')
                return true;
            return false;  
        }

        public function check_category_in_products($id){
            $this->db->where('product_cat', $id);
            $this->db->from('products');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
              return true;
            }
            return false; 
        }
    }

?>