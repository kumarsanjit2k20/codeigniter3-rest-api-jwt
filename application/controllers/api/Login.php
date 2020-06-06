<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require (APPPATH.'libraries/REST_Controller.php');
header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Methods: POST, GET");
class Login extends REST_Controller 
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('authorization','jwt'));
	}
	
	
    // student login 
    function login_post(){
        $post_data=json_decode(file_get_contents("php://input"));
        if (isset($post_data->student_email) and isset($post_data->password)) 
        {
            $input_email=$post_data->student_email;
            $input_password=$post_data->password;
            $student_details=$this->student_model->verify_student($input_email);
            if (!empty($student_details)) 
            {

                if (password_verify($input_password, $student_details[0]->password_150)) 
                {
                    $jwt_token = authorization::generateToken((array)$student_details); // here we type casting object form to array form 
                    $this->response(array(
                        'status' =>1,
                        'message'=>'Student Login Successfully!',
                        'login_token'=>$jwt_token
                    ), parent::HTTP_OK);
                }
                else{
                    $this->response(array(
                        'status' =>0,
                        'message'=>'Invalid Credentials'
                    ), parent::HTTP_NOT_FOUND);
                }
            }
            else
            { 
                $this->response(array(
                    'status' =>0,
                    'message'=>'Email does not exist!'
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
