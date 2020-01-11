<?php

class Admin extends CI_Model {
  public function check_admin($email, $password){
    return $this->db->get_where('admins', array('email' => $email, 'password' => $password))->row_array();
  }

  public function check_email($email){
      $this->db->where('email', $email);
      $this->db->from('admins');
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
        return true;
      }
      return false; 
  }

  public function check_password($email, $password){
    return $this->db->get_where('admins', array('email' => $email, 'password' => md5($password)))->row_array();
  }

  public function update_admin($oldemail, $newemail,  $password){
     $data = [
      'email' => $newemail,
      'password' => md5($password)
     ];
     $this->db->where('email', $oldemail);
     $this->db->update('admins', $data);
  }
}
 
?>