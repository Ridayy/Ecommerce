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


    }
?>