<?php
    class Faq extends CI_Model {
        public function add($question){
            $this->db->insert('faqs', $question);
        }

        public function total_questions(){
            $query = $this->db->get('faqs');
            return count($query->result());
        }

        public function get_question_by_id($id){
            return $this->db->get_where('faqs', array('id'=>$id))->row_array();
        }

        public function get_questions(){
            return $this->db->get('faqs')->result_array();
        }

        public function edit_question($id, $data){
            $this->db->where('id', $id);
            $this->db->update('faqs', $data);
        }

        public function delete_question($id){
            $this->db->where('id', $id);
            $this->db->delete('faqs');
            if ($this->db->affected_rows() == '1')
                return true;
            return false;  
        }

       
    }

?>