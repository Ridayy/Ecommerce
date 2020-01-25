<?php
    class Review extends CI_Model {
        public function add_review($review){
            $this->db->insert('reviews', $review);
        }

        public function get_all(){
            $this->db->select('*');
            $this->db->from('reviews as r');
            $this->db->join('users as u', 'r.user_id = u.id ');
            $this->db->join('products as p', 'p.id = r.product_id');
            $this->db->order_by('p.id', 'asc');

           return $this->db->get()->result_array();
        }

        public function get_reviews($id){
            $this->db->select('*');
            $this->db->from('reviews as r');
            $this->db->join('users as u', 'r.user_id = u.id AND product_id = '.$id);

           return $this->db->get()->result_array();
        }

        public function calc_avg_rating($id){
            return $this->db->query("SELECT ROUND(AVG(rating), 1) As 'rating' FROM reviews WHERE product_id = ".$id)->row_array();
        }

        public function calc_five_stars($id){
            return $this->db->query("SELECT COUNT(*) As 'five_stars' FROM reviews WHERE product_id = ".$id. " AND rating = 5")->row_array();
        }

        public function calc_four_stars($id){
            return $this->db->query("SELECT COUNT(*) As 'four_stars' FROM reviews WHERE product_id = ".$id. " AND rating = 4")->row_array();
        }

        public function calc_three_stars($id){
            return $this->db->query("SELECT COUNT(*) As 'three_stars' FROM reviews WHERE product_id = ".$id. " AND rating = 3")->row_array();
        }

        public function calc_two_stars($id){
            return $this->db->query("SELECT COUNT(*) As 'two_stars' FROM reviews WHERE product_id = ".$id. " AND rating = 2")->row_array();
        }

        public function calc_one_stars($id){
            return $this->db->query("SELECT COUNT(*) As 'one_stars' FROM reviews WHERE product_id = ".$id. " AND rating = 1")->row_array();
        }


        
        public function num_reviews($id){
            return $this->db->query("SELECT COUNT(*) As 'num_reviews' FROM reviews WHERE product_id = ".$id)->row_array();        
        }

        public function delete_review($id){
            $this->db->where('review_id', $id);
            $this->db->delete('reviews');
            if ($this->db->affected_rows() == '1')
                return true;
            return false; 
        }
    }
?>