<?php
    class Slide extends CI_Model {
        public function add($slide){
            $this->db->insert('slides', $slide);
        }

        public function get_slides(){
            return $this->db->get('slides')->result_array();
        }

        public function add_to_home($id){
            $this->db->where('id', $id)->update("slides", array('location' => 'home'));
            if ($this->db->affected_rows() == '1')
                return true;
            return false;  
        }

        public function add_to_shop($id){
            $this->db->where('id', $id)->update("slides", array('location' => 'shop'));
            if ($this->db->affected_rows() == '1')
                return true;
            return false;  
        }

        public function get_home_slides(){
            return $this->db->order_by('id', 'desc')->get_where('slides', array('location'=>'home'))->result_array();
        }

        public function get_shop_slides(){
            return $this->db->order_by('id', 'desc')->get_where('slides', array('location'=>'shop'))->result_array();
        }

        public function get_slide_by_id($id){
            return $this->db->get_where('slides', array('id' => $id))->row_array();
        }

        public function edit($id, $title){
            $this->db->where('id', $id)->update("slides", array('slide_title' => $title));
            if ($this->db->affected_rows() == '1')
                return true;
            return false;  
        }

        public function remove_slide($id){
            $this->db->where('id', $id)->update("slides", array('location' => ''));
            if ($this->db->affected_rows() == '1')
                return true;
            return false;  
        }

        public function delete_slide($id){
            $this->db->where('id', $id);
            $this->db->delete('slides');
            if ($this->db->affected_rows() == '1')
                return true;
            return false;  
        }

        public function get_home_titles(){
            $this->db->select('slide_title'); 
            $this->db->from('slides');   
            $this->db->where('location', 'home');
            return $this->db->get()->result_array();
        }
    }
?>