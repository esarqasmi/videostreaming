<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class  Student_model extends CI_Model {


    public function __construct() {
  
        parent::__construct();

    }

  

    public function insertstudent($data){
        $this->db->insert('students',$data);
        return $this->db->insert_id();
    }

   
    public function check_max_limit($class_code){
        $query = $this->db->select('count(std.id) as t_stds,maximum_students')
        ->from('students as std')
        ->join('sch_class as c','c.code = std.class_code','left')
        ->group_by('std.class_code')->get();
        // echo $this->db->last_query();die;
        if($query->num_rows() > 0) {
            return $query->row_array();
        } else { 
            return FALSE;
        } 

    }
   
 

     public function update_student($data){
        $this->db->where('code',$data['code']);

        $res = $this->db->update('students',$data);  
        return $res;
    }
    public function delete_student($code){
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
        $this->db->from('students');
        $query = $this->db->get();
        // echo $this->db->last_query();
        if($query->num_rows() > 0) {
            return $query->result();
        } else { 
            return FALSE;
        } 

    }
 

     public function update_std($data){
        $this->db->where('id',$data['id']);

        $res = $this->db->update('students',$data);  
        return $res;
    }
    public function delete_std($id){
        $this->db->where('id',$id);

        $res = $this->db->delete('students');  
        return $res;
    }




}