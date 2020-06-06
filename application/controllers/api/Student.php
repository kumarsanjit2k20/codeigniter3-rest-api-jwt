<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require (APPPATH.'libraries/REST_Controller.php');
header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Methods: POST, GET");
class Student extends REST_Controller 
{

	public function __construct()
    {
        parent::__construct();
        $this->load->model('api/student_model');
        $this->load->helper(array('authorization','jwt'));
    }   

        
    // list of students
    function students_list_get()
    {

        $headers=$this->input->request_headers();
        $token=$headers['Authorization'];
        try
        {
            $student_data=authorization::validateToken($token);
            if ($student_data===FALSE) 
            {
                $this->response(array(
                    'status'=>0,
                    'message'=>'Unauthorized Access!'
                ), parent::HTTP_UNAUTHORIZED);
            }
            else{
                // $student_list=$this->student_model->get_all_students();
                // if (count($student_list)>0) {
                    $this->response(array(
                            'status' =>1,
                            'message'=>'List of Students',
                            'data'=>$student_data
                    ), parent::HTTP_OK);


                // $this->response(array(
                //     'status' =>1,
                //     'message'=>'Students Details',
                //     'student_data'=>$student_data
                // ), parent::HTTP_OK);
            }
        }
        catch(Exception $exep)
        {
            $this->response(array(
                'status'=>0,
                'message'=>$exep->getMessage()
            ), parent::HTTP_INTERNAL_SERVER_ERROR);
        }



        /*
       $student_list=$this->student_model->get_all_students();
        if (count($student_list)>0) {
            $this->response(array(
                    'status' =>1,
                    'message'=>'List of Students',
                    'data'=>$student_list
            ), parent::HTTP_OK);
        }else{
            $this->response(array(
                    'status' =>0,
                    'message'=>'No Records Found!'
            ), parent::HTTP_NOT_FOUND);
        }
         */
    }

    // update student details
    function update_details_put(){
        $post_data=json_decode(file_get_contents("php://input"));
        if (isset($post_data->student_id) and isset($post_data->student_name) and isset($post_data->branch_id) and isset($post_data->student_mobile) and isset($post_data->student_email) and isset($post_data->address)) 
        {
            $student_data=array(
                'branch_id_100_150'=>$post_data->branch_id,
                'name_150'=>$post_data->student_name,
                'gender_150'=>$post_data->gender,
                'mobile_150'=>$post_data->student_mobile,
                'email_150'=>$post_data->student_email,
                'address_150'=>$post_data->address
            );

            $valid_mobile=$valid_email=FALSE;
            if (!empty($this->student_model->is_email_exist($post_data->student_email, $post_data->student_id))) 
            {
                $this->response(array(
                    'status' =>0,
                    'message'=>'Email is already in used!'
                ), parent::HTTP_NOT_FOUND);
            }else{ $valid_email=TRUE; }

            if (!empty($this->student_model->is_mobile_exist($post_data->student_mobile, $post_data->student_id))) 
            {
                $this->response(array(
                    'status' =>0,
                    'message'=>'Mobile number is already in used!'
                ), parent::HTTP_NOT_FOUND);
            }else{ $valid_mobile=TRUE; }

            if ($valid_mobile && $valid_email) 
            {
                if ($this->student_model->update_student_details($student_data, $post_data->student_id)) {
                    $this->response(array(
                        'status' =>1,
                        'message'=>'Student Details Updated Successfully!'
                    ), parent::HTTP_OK);
                }else{
                    $this->response(array(
                        'status' =>0,
                        'message'=>'Failed to Update '
                    ), parent::HTTP_NOT_FOUND);
                }  
            }
        }
        else
        {
            $this->response(array(
                'status' =>0,
                'message'=>'All Fields are Required!'
            ), parent::HTTP_NOT_FOUND);
        }
    }
     

    // validate jwt generated token method
    function student_details_get()
    {
        $headers=$this->input->request_headers();
        $token=$headers['Authorization'];
        try
        {
            $student_data=authorization::validateToken($token);
            if ($student_data===FALSE) 
            {
                $this->response(array(
                    'status'=>0,
                    'message'=>'Unauthorized Access!'
                ), parent::HTTP_UNAUTHORIZED);
            }
            else{
                $this->response(array(
                    'status' =>1,
                    'message'=>'Students Details',
                    'student_data'=>$student_data
                ), parent::HTTP_OK);
            }
        }
        catch(Exception $exep)
        {
            $this->response(array(
                'status'=>0,
                'message'=>$exep->getMessage()
            ), parent::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // delete student details
    function delete_student_delete()
    {
        $post_data=json_decode(file_get_contents("php://input"));
        if (isset($post_data->student_id))
        {
            $stu_id=$post_data->student_id;
            if ($this->student_model->delete_student_details($stu_id)) 
            {
                $this->response(array(
                    'status' =>1,
                    'message'=>'Student Record Deleted Successfully!'
                ), parent::HTTP_OK);
            }else{
                $this->response(array(
                    'status' =>0,
                    'message'=>'Student Deletion Failed'
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
