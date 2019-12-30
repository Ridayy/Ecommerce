<?php
    class Product extends CI_Model {
        public function add($product){
            $this->db->insert('products', $product);
        }

        public function get_product($id){
            return $this->db->get_where('products', array('id' => $id))->row_array();
        }
        public function get_products(){
            $this->db->select('*');
            $this->db->from('products as p');
            $this->db->join('categories as c', 'p.product_cat = c.cat_id');

           return $this->db->get()->result_array();
 
        }


        public function get_recent_products(){
            $this->db->select('*');
            $this->db->from('products as p');
            $this->db->join('categories as c', 'p.product_cat = c.cat_id');
            $this->db->order_by('id', 'desc');
            $this->db->limit(8);

           return $this->db->get()->result_array();
 
        }

        public function edit_product($id, $data){
            $this->db->where('id', $id);
            $this->db->update('products', $data);
        }

        
        public function delete_product($id){
            $this->db->where('id', $id);
            $this->db->delete('products');
            if ($this->db->affected_rows() == '1')
                return true;
            return false;  
        }
    }
?>