<?php

class Admin extends CI_Model {
  public function check_admin($email, $password){
    return $this->db->get_where('admins', array('email' => $email, 'password' => $password))->row_array();
  }
}

?>