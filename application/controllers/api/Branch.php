<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require (APPPATH.'libraries/REST_Controller.php');

header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Methods: POST, GET");
class Branch extends REST_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('api/branch_model');
        
	}	

    // create branch
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
     
    // list all branch
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





    /*
    function ci_curl($new_name, $new_email)
	{
    	$username = 'admin';
    	$password = '1234';
    	 
    	$this->load->library('curl');
    	 
    	$this->curl->create('http://localhost/restserver/index.php/example_api/user/id/1/format/json');
    	 
    	// Optional, delete this line if your API is open
    	$this->curl->http_login($username, $password);

    	$this->curl->post(array(
    	    'name' => $new_name,
    	    'email' => $new_email
    	));
	 
    	$result = json_decode($this->curl->execute());

    	if(isset($result->status) && $result->status == 'success')
    	{
    	    echo 'User has been updated.';
    	}
    	 
    	else
    	{
    	    echo 'Something has gone wrong';
    	}
    }
    */
}
