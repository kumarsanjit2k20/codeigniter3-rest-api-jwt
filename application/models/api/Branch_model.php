<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch_model extends CI_Model {
    function __construct(){
        parent::__construct();
       
    }

	public function insert_branch($branch_data)
    {     
        $result=$this->db->insert('100_branches', $branch_data);
        return $result;

    }
    public function update_branch($branch_data, $branch_id){
        $this->db->select('id_100');
        $this->db->from('100_branches');
        $this->db->where('id_100', $branch_id);
        $branch=$this->db->get()->row();
        if(!empty($branch)){
            $this->db->where('id_100', $branch_id);
            return $this->db->update('100_branches', $branch_data);
        }
        return FALSE;
    }
    
    public function get_all_branches(){
        $this->db->select("`id_100` as branch_id, `name_100` as branch_name, `status_100` as branch_status, `created_on_100` as branch_created_on");
        $this->db->from('100_branches');
        $query=$this->db->get();
        return $query->result();
    }
    public function delete_branch($branch_id)
    {
        $this->db->select('id_100');
        $this->db->from('100_branches');
        $this->db->where('id_100', $branch_id);
        $branch=$this->db->get()->row();
        if(!empty($branch)){
            $this->db->where('id_100', $branch_id);
            return $this->db->delete('100_branches');
        }
        return FALSE;
    }

}
