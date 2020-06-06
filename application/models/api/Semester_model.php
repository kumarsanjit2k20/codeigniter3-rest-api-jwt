<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require(APPPATH'.libraries/REST_Controller.php');

class Semester_model extends CI_Model {
    // protected $CI;
    function __construct(){
        parent::__construct();
       
    }

	function insert_project($project_data)
    {
        $result=$this->db->insert('200_semester_projects', $project_data);
        return $result;
    }

    public function update_project($project_data, $project_id){
        $sql_del="SELECT id_200 FROM 200_semester_projects 
        WHERE student_id_150_200='$project_id'";
        $result=$this->db->query($sql_del)->result_array();
        if (count($result)>0) 
        {
            return $this->db->update('200_semester_projects', $project_data);
        }
        else
        {
            return FALSE;
        }
    }

    public function get_all_projects()
    {
        $sql_frm_projects="SELECT
                            t200.id_200 as project_id,
                            t200.student_id_150_200 as student_id,
                            t150.name_150 as student_name,
                            t100.name_100 as branch_name,
                            t200.title_200 as title,
                            t200.level_200 as level,
                            t200.description_200 as description,
                            t200.complete_days as complete_days,
                            t200.semester_200 as semester,
                            t200.status_200 as project_status,
                            t200.created_on
                        FROM
                            200_semester_projects t200
                        LEFT JOIN 150_students t150 ON t200.student_id_150_200=t150.id_150
                        LEFT JOIN 100_branches t100 ON t150.branch_id_100_150=t100.id_100
                        WHERE
                            1=1
                        ORDER BY t200.id_200 DESC";
        $result=$this->db->query($sql_frm_projects)->result();
        return $result;                           
    }

    public function get_student_all_projects($stu_id)
    {
        $sql_frm_projects="SELECT
                            t200.id_200 as project_id,
                            t200.student_id_150_200 as student_id,
                            t150.name_150 as student_name,
                            t100.name_100 as branch_name,
                            t200.title_200 as title,
                            t200.level_200 as level,
                            t200.description_200 as description,
                            t200.complete_days as complete_days,
                            t200.semester_200 as semester,
                            t200.status_200 as project_status,
                            t200.created_on
                        FROM
                            200_semester_projects t200
                        LEFT JOIN 150_students t150 ON t200.student_id_150_200=t150.id_150
                        LEFT JOIN 100_branches t100 ON t150.branch_id_100_150=t100.id_100
                        WHERE
                            1=1
                        AND t200.student_id_150_200='$stu_id'
                        ORDER BY t200.id_200 DESC";
        $result=$this->db->query($sql_frm_projects)->result();
        return $result;
    }
    public function delete_student_projects($stu_id)
    {
        $sql_del="DELETE FROM 200_semester_projects WHERE student_id_150_200='$stu_id'";
        $this->db->query($sql_del);
        if ($this->db->affected_rows()) 
        {
           return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}
