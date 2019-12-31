<?php
    class Product extends CI_Model {
        public function add($product){
            $this->db->insert('products', $product);
        }

        public function get_product($id){
            $this->db->select('*');
            $this->db->from('products as p');
            $this->db->join('categories as c', 'p.product_cat = c.cat_id AND id ='.$id.' AND quantity != 0');

            return $this->db->get()->row_array();
        }
        public function get_products(){
            $this->db->select('*');
            $this->db->from('products as p');
            $this->db->join('categories as c', 'p.product_cat = c.cat_id AND quantity != 0');

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

        public function get_cart_products($ids){
            if(empty($ids)) {
                return array();
            }
            $this->db->select('*');
            $this->db->where_in('id', $ids);
            return $this->db->get('products')->result_array();
        }
        

        public function reduce_quantity($id, $value){
            $this->db->set('quantity', $value);
            $this->db->where('id', $id);   
            $this->db->update('products');
        }
    }
?>