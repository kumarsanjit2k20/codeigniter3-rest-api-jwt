<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {

    function __construct(){
        parent::__construct();
       
    }

	public function insert_student($student_data)
    {     
        $result=$this->db->insert('150_students', $student_data);
        return $result;

    }
    public function get_all_students()
    {
        $this->db->select("t150.id_150,
                            t100.name_100 as branch_name,
                            t150.name_150,
                            t150.gender_150,
                            t150.mobile_150,
                            t150.email_150,
                            t150.address_150,
                            t150.status_150,
                            t150.created_on_150");
        $this->db->from('150_students as t150');
        $this->db->join('100_branches as t100', "t150.branch_id_100_150=t100.id_100", 'left');
        $this->db->order_by('name_150', 'ASC');
        $query=$this->db->get();
        return $query->result();
    }
    public function is_email_exist($email, $stu_id=''){
        /*
        $this->db->select('id_150');
        $this->db->from('150_students');
        $this->db->where('email_150', $email);
        return $this->db->get()->row(); 
        */
        $sql_frm="SELECT id_150 FROM 150_students WHERE 1=1 AND email_150='$email'";  
        if (!empty($stu_id)) 
        {
            $sql_frm=$sql_frm." AND id_150<>$stu_id";
        } 
        $result=$this->db->query($sql_frm)->row();
        return $result;
    }
    public function is_mobile_exist($phone, $stu_id=''){
        /*
        $this->db->select('id_150');
        $this->db->from('150_students');
        $this->db->where('mobile_150', $phone);
        return $this->db->get()->row(); 
        */
        $sql_frm="SELECT id_150 FROM 150_students WHERE 1=1 AND mobile_150='$phone'";  
        if (!empty($stu_id)) 
        {
            $sql_frm=$sql_frm." AND id_150<>$stu_id";
        } 
        $result=$this->db->query($sql_frm)->row();
        return $result;
    }

    public function update_student_details($student_data, $stu_id)
    {
        $this->db->select('id_150');
        $this->db->from('150_students');
        $this->db->where('id_150', $stu_id);
        $student=$this->db->get()->row();
        if(!empty($student)){
            $this->db->where('id_150', $stu_id);
            return $this->db->update('150_students', $student_data);
        }
        return FALSE;
        
    }
    public function delete_student_details($student_id)
    {
        $this->db->select('id_150');
        $this->db->from('150_students');
        $this->db->where('id_150', $student_id);
        $student=$this->db->get()->row();
        if(!empty($student))
        {
            $this->db->where('id_150', $student_id);
            return $this->db->delete('150_students');
        }
        return FALSE;
    }

    public function verify_student($email){
        $this->db->select('id_150');
        $this->db->from('150_students');
        $this->db->where('email_150', $email);
        $student=$this->db->get()->row();
        if(!empty($student))
        {
            $this->db->select("t150.id_150 as student_id,
                            t100.name_100 as branch_name,
                            t150.name_150,
                            t150.gender_150,
                            t150.mobile_150,
                            t150.email_150,
                            t150.address_150,
                            t150.status_150,
                            t150.password_150,
                            t150.created_on_150");
            $this->db->from('150_students as t150');
            $this->db->where('t150.id_150', $student->id_150);
            $this->db->join('100_branches as t100', "t150.branch_id_100_150=t100.id_100", 'left');
            $this->db->order_by('name_150', 'ASC');
            $query=$this->db->get();
            return $query->result();
        }
        return FALSE;
    }
}
