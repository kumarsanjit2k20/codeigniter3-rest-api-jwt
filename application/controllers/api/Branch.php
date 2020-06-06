<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require (APPPATH.'libraries/REST_Controller.php');
header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
class Branch extends REST_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('api/branch_model');
	}	

    // POST -- create new branch
	function create_post()
    {

        $post_data=json_decode(file_get_contents("php://input"));
        if (isset($post_data->branch_name))
        {
            $branch_data=array(
                'name_100'=>$post_data->branch_name
            );
            if ($this->branch_model->insert_branch($branch_data)) {
                $this->response(array(
                    'status' =>1,
                    'message'=>'Branch Created Successfully!'
                ), parent::HTTP_OK);
            }else{
                $this->response(array(
                    'status' =>0,
                    'message'=>'Branch Creation Failed'
                ), parent::HTTP_NOT_FOUND);
            }
        }
        else
        {
            $this->response(array(
                'status' =>0,
                'message'=>'Branch Name Should be Needed'
            ), parent::HTTP_NOT_FOUND);
        }
    }
     
    // PUT -- update existing branch
    function update_branch_post()
    {

        $post_data=json_decode(file_get_contents("php://input"));
        if (isset($post_data->branch_id) and isset($post_data->branch_name))
        {
            $branch_data=array(
                'name_100'=>$post_data->branch_name
            );
            if ($this->branch_model->update_branch($branch_data, $branch_id)) {
                $this->response(array(
                    'status' =>1,
                    'message'=>'Branch Updated Successfully!'
                ), parent::HTTP_OK);
            }else{
                $this->response(array(
                    'status' =>0,
                    'message'=>'Branch Updation Failed!'
                ), parent::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        else
        {
            $this->response(array(
                'status' =>0,
                'message'=>'Branch Name is Required!'
            ), parent::HTTP_NOT_FOUND);
        }
    }

    // GET --List All Branchs
    function branch_list_get()
    {
        $branch_list=$this->branch_model->get_all_branches();
        if (count($branch_list)>0) {
            $this->response(array(
                    'status' =>1,
                    'message'=>'List of Branches',
                    'data'=>$branch_list
            ), parent::HTTP_OK);
        }else{
            $this->response(array(
                    'status' =>0,
                    'message'=>'No Records Found!'
            ), parent::HTTP_NOT_FOUND);
        }
         
    }
     
    // DELETE --Delete Single Branch
    function delete_branch_delete()
    {
        $post_data=json_decode(file_get_contents("php://input"));
        if (isset($post_data->branch_id))
        {
            $branch_id=$post_data->branch_id;
            if ($this->branch_model->delete_branch($branch_id)) {
                $this->response(array(
                    'status' =>1,
                    'message'=>'Branch Deleted Successfully!'
                ), parent::HTTP_OK);
            }else{
                $this->response(array(
                    'status' =>0,
                    'message'=>'Branch Deletion Failed'
                ), parent::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        else
        {
            $this->response(array(
                'status' =>0,
                'message'=>'Branch ID Should be Needed'
            ), parent::HTTP_NOT_FOUND);
        }
    }
}
