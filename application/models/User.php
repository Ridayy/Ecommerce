<?php
    class User extends CI_Model {
        public function add_user($user){
            $this->db->insert('users', $user);
        }

        public function total_users(){
            $query = $this->db->get('users');
            return count($query->result());
        }

        public function get_users(){
            return $this->db->get('users')->result_array();
        }

        public function get_userid($email){
            $row = $this->db->get_where('users', array('email'=> $email))->row_array();
            return $row['id'];
        }

        public function get_name($id){
            $row = $this->db->get_where('users', array('id'=> $id))->row_array();
            return $row['name'];
        }

        public function check_email($email){
            $this->db->where('email', $email);
            $this->db->from('users');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
              return true;
            }
            return false; 
        }

        public function check_user($email, $password){
            return $this->db->get_where('users', array('email'=> $email, 'password' => $password))->row_array();
        }

        public function add_order($id){
            $this->db->set('num_orders', 'num_orders + 1', FALSE);
            $this->db->where('id', $id);   
            $this->db->update('users');
        }

        public function delete_user($id){
            $this->db->where('id', $id);
            $this->db->delete('users');
            if ($this->db->affected_rows() == '1')
                return true;
            return false; 
        }
    }

?>