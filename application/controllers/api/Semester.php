<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require (APPPATH.'libraries/REST_Controller.php');

header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Methods: POST, GET");
class Semester extends REST_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('api/semester_model');
        $this->load->helper(array('authorization','jwt'));
    }   
    // create project
    function create_project_post()
    {
        $post_data=json_decode(file_get_contents("php://input"));
        $headers=$this->input->request_headers();
        $token=$headers['Authorization'];

        try
        {
            $student_info=authorization::validateToken($token);
            if ($student_info===FALSE) 
            {
                $this->response(array(
                    'status'=>0,
                    'message'=>'Unauthorized Access!'
                ), parent::HTTP_UNAUTHORIZED);
            }
            else
            {
                $student_id=$student_info->data[0]->student_id;

                if (isset($post_data->title) and isset($post_data->level) and isset($post_data->complete_days) and isset($post_data->semester)) 
                {
                    
                    $project_data=array(
                        'student_id_150_200'=>$student_id,
                        'title_200'=>$post_data->title,
                        'level_200'=>$post_data->level,
                        'description_200'=>isset($post_data->description) ? $post_data->description : '',
                        'complete_days'=>$post_data->complete_days,
                        'semester_200'=>$post_data->semester
                    );
                    if ($this->semester_model->insert_project($project_data)) 
                    {
                        $this->response(array(
                            'status' =>1,
                            'message'=>'Project Created Successfully!'
                        ), parent::HTTP_OK);
                    }
                    else
                    {
                        $this->response(array(
                            'status' =>0,
                            'message'=>'Project Creation Failed'
                        ), parent::HTTP_NOT_FOUND); 
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
        }
        catch(Exception $exep)
        {
            $this->response(array(
                'status'=>0,
                'message'=>$exep->getMessage()
            ), parent::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
     
     // list all projects
    function projects_list_get()
    {
        $semester_data=$this->semester_model->get_all_projects();
        if (count($semester_data)>0) 
        {
            $this->response(array(
                    'status' =>1,
                    'message'=>'List of Semester Projects',
                    'data'=>$semester_data
            ), parent::HTTP_OK);
        }else{
            $this->response(array(
                    'status' =>0,
                    'message'=>'No Records Found!'
            ), parent::HTTP_NOT_FOUND);
        }   
    }

    function list_project_student_wise_get()
    {
        $post_data=json_decode(file_get_contents("php://input"));
        $headers=$this->input->request_headers();
        $token=$headers['Authorization'];
        try
        {
            $student_info=authorization::validateToken($token);
            if ($student_info===FALSE) 
            {
                $this->response(array(
                    'status'=>0,
                    'message'=>'Unauthorized Access!'
                ), parent::HTTP_UNAUTHORIZED);
            }
            else
            {
                $student_id=$student_info->data[0]->student_id;
                $semester_data=$this->semester_model->get_student_all_projects($student_id);
                if (!empty($semester_data)) 
                {
                    $this->response(array(
                            'status' =>1,
                            'message'=>'Project Deleted Successfully!',
                            'data'=>$semester_data
                    ), parent::HTTP_OK);
                }
                else
                {
                    $this->response(array(
                            'status' =>0,
                            'message'=>'No Records Found!'
                    ), parent::HTTP_NOT_FOUND);
                } 
                  
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
    
    // update project details
    function update_project_put()
    {
        
    }

    // delete project details studentwise by jwt token
    function delete_student_project_delete()
    {
        $headers=$this->input->request_headers();
        $token=$headers['Authorization'];
        try
        {
            $student_info=authorization::validateToken($token);
            if ($student_info===FALSE) 
            {
                $this->response(array(
                    'status'=>0,
                    'message'=>'Unauthorized Access!'
                ), parent::HTTP_UNAUTHORIZED);
            }
            else
            {
                $student_id=$student_info->data[0]->student_id;
                if ($this->semester_model->delete_student_projects($student_id)) 
                {
                    $this->response(array(
                            'status' =>1,
                            'message'=>'Semester Projects Deleted Successfully!',
                    ), parent::HTTP_OK);
                }
                else
                {
                    $this->response(array(
                            'status' =>0,
                            'message'=>'No Records Found!'
                    ), parent::HTTP_NOT_FOUND);
                }      
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

    
}
