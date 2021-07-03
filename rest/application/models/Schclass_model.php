<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class  Schclass_model extends CI_Model {


    public function __construct() {
  
        parent::__construct();

    }

  

    public function insert_class($data){
        $this->db->insert('sch_class',$data);
        return $this->db->insert_id();
    }

   

    public function get_all_class(){
        $this->db->select();
        $this->db->from('sch_class');
        $query = $this->db->get();
        // echo $this->db->last_query();
        if($query->num_rows() > 0) {
            return $query->result();
        } else { 
            return FALSE;
        } 

    }
 

     public function update_class($data){
        $this->db->where('code',$data['code']);

        $res = $this->db->update('sch_class',$data);  
        return $res;
    }
    public function delete_class($code){
        $this->db->where('code',$code);

        $res = $this->db->delete('students');  
        return $res;
    }
/** 
* Methods for students entity
* Author : Esar
**/


   public function insert_std($data){
        $this->db->insert('students',$data);
        return $this->db->insert_id();
    }

   

    public function get_all_students(){
        $this->db->select();
        $this->db->from('sch_class');
        $query = $this->db->get();
        // echo $this->db->last_query();
        if($query->num_rows() > 0) {
            return $query->result();
        } else { 
            return FALSE;
        } 

    }
 

     public function update_std($data){
        $this->db->where('code',$data['code']);

        $res = $this->db->update('students',$data);  
        return $res;
    }
    public function delete_std($code){
        $this->db->where('code',$code);

        $res = $this->db->delete('students');  
        return $res;
    }




}