<?php
Class user extends CI_Model
{
   function login($username, $password,$overwrite=false)
   {
     $this -> db -> select('id, name, password,image','email');
     $this -> db -> from('admin');
     if($overwrite==true){
      $this -> db -> where('id', $username);
     }else{
      $this -> db -> where('email', $username);
      $this -> db -> where('password', MD5($password));
     }
     $this -> db -> limit(1);
     $query = $this -> db -> get();
//     echo $this->db->last_query(); exit;
     if($query -> num_rows() == 1)
     {
       $user=$query->row();
       $this->session->set_userdata('KDBhindiAdminSession',$user);
       return $user;
     }
     else
     {
     return false;
     }
   }
   function login_user($username, $password,$overwrite=false)
   {
     $this -> db -> select('id');
     $this -> db -> from('user');
     if($overwrite==true){
      $this -> db -> where('id', $username);
     }else{
      $this -> db -> where('user_name', $username);
      $this -> db -> where('password', MD5($password));
     }	 
     $this -> db -> limit(1);
     $query = $this -> db -> get();
     //echo $this->db->last_query();
     if($query -> num_rows() == 1)
     {
       $user=$query->result_array();
       //print_r($user); exit;
       $updata['last_login'] =date("Y-m-d H:i:s");
       $this->db->where('id',$user[0]['id']);
       $this->db->update('user', $updata);
       $this->session->set_userdata('session_user',$user[0]['id']);
       return $user;
     }
     else
     {
     return false;
     }
   } 
  
} 