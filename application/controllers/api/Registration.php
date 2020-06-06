<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require (APPPATH.'libraries/REST_Controller.php');
header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Methods: POST, GET");
class Registration extends REST_Controller 
{

	public function __construct(){
		parent::__construct();
        $this->load->model('api/student_model');
		$this->load->helper(array('authorization','jwt'));
	}
	
	// register student
    function index_post()
    {
        $post_data=json_decode(file_get_contents("php://input"));
        if (isset($post_data->student_name) and isset($post_data->branch_id) and isset($post_data->student_mobile) and isset($post_data->student_email) and isset($post_data->password) and isset($post_data->address)) 
        {
            $student_data=array(
                'branch_id_100_150'=>$post_data->branch_id,
                'name_150'=>$post_data->student_name,
                'gender_150'=>$post_data->gender,
                'mobile_150'=>$post_data->student_mobile,
                'password_150'=>password_hash($post_data->password, PASSWORD_DEFAULT),
                'email_150'=>$post_data->student_email,
                'address_150'=>$post_data->address
            );
            $valid_mobile=$valid_email=FALSE;
            if (!empty($this->student_model->is_email_exist($post_data->student_email))) 
            {
                $this->response(array(
                    'status' =>0,
                    'message'=>'Email is already in used!'
                ), parent::HTTP_NOT_FOUND);
            }else{$valid_email=TRUE; }

            if (!empty($this->student_model->is_mobile_exist($post_data->student_mobile))) 
            {
                $this->response(array(
                    'status' =>0,
                    'message'=>'Mobile number is already in used!'
                ), parent::HTTP_NOT_FOUND);
            }else{ $valid_mobile=TRUE; }

            if ($valid_mobile && $valid_email) 
            {
                if ($this->student_model->insert_student($student_data)) {
                    $this->response(array(
                        'status' =>1,
                        'message'=>'Student Registered Successfully!'
                    ), parent::HTTP_OK);
                }else{
                    $this->response(array(
                        'status' =>0,
                        'message'=>'Registration Failed'
                    ), parent::HTTP_NOT_FOUND);
                }  
            }
        }else{
            $this->response(array(
                'status' =>0,
                'message'=>'All Fields are Required!'
            ), parent::HTTP_NOT_FOUND);
        }
    }
}
