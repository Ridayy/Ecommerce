<?php
    class Order extends CI_Model {
        public function add($order){
            $this->db->insert('orders', $order);
            $insert_id = $this->db->insert_id();

            return  $insert_id;
        }

        public function total_orders(){
            $query = $this->db->get('orders');
            return $query->result();
        }


        public function confirm($id){
            $this->db->set('status', 'confirmed');
            $this->db->where('order_id', $id);   
            $this->db->update('orders');
        }

        public function get_all(){
            $this->db->select('*');
            $this->db->from('orders as o');
            $this->db->join('users as u', 'o.user_id = u.id');
            $this->db->order_by('order_id', 'desc');
            return $this->db->get()->result_array();
        }

        public function get_pending(){
            $this->db->select('*');
            $this->db->from('orders as o');
            $this->db->join('users as u', 'o.user_id = u.id AND status = "pending"');
            $this->db->order_by('order_id', 'desc');
            return $this->db->get()->result_array();
        }


        public function get_confirmed(){
            $this->db->select('*');
            $this->db->from('orders as o');
            $this->db->join('users as u', 'o.user_id = u.id AND status = "confirmed"');
            $this->db->order_by('order_id', 'desc');
            return $this->db->get()->result_array();
        }

        public function set_completed($id){
            $this->db->set('status', 'completed');
            $this->db->where('order_id', $id);   
            $this->db->update('orders');
            if ($this->db->affected_rows() == '1')
                return true;
            return false; 
        }

        public function get_completed(){
            $this->db->select('*');
            $this->db->from('orders as o');
            $this->db->join('users as u', 'o.user_id = u.id AND status = "completed"');
            $this->db->order_by('order_id', 'desc');
            return $this->db->get()->result_array();
        }


        public function delete_order($id){
            $this->db->where('order_id', $id);
            $this->db->delete('orders');
            if ($this->db->affected_rows() == '1')
                return true;
            return false;  
        }

        public function get_user($id){
            $row = $this->db->get_where('orders', array('order_id'=> $id))->row_array();
            return $row['user_id'];
        }

        // public function get_product($id){
        //     $this->db->select('*');
        //     $this->db->from('products as p');
        //     $this->db->join('categories as c', 'p.product_cat = c.cat_id AND id ='.$id.' AND quantity != 0');

        //     return $this->db->get()->row_array();
        // }
        // public function get_products(){
        //     $this->db->select('*');
        //     $this->db->from('products as p');
        //     $this->db->join('categories as c', 'p.product_cat = c.cat_id AND quantity != 0');

        //    return $this->db->get()->result_array();
 
        // }


        // public function get_recent_products(){
        //     $this->db->select('*');
        //     $this->db->from('products as p');
        //     $this->db->join('categories as c', 'p.product_cat = c.cat_id');
        //     $this->db->order_by('id', 'desc');
        //     $this->db->limit(8);

        //    return $this->db->get()->result_array();
 
        // }

        // public function edit_product($id, $data){
        //     $this->db->where('id', $id);
        //     $this->db->update('products', $data);
        // }

        
       

        // public function get_cart_products($ids){
        //     if(empty($ids)) {
        //         return array();
        //     }
        //     $this->db->select('*');
        //     $this->db->where_in('id', $ids);
        //     return $this->db->get('products')->result_array();
        // }
        

        // public function reduce_quantity($id, $value){
        //     $this->db->set('quantity', $value);
        //     $this->db->where('id', $id);   
        //     $this->db->update('products');
        // }
    }
?>