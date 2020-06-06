<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require(APPPATH'.libraries/REST_Controller.php');

class User_model extends CI_Model {
    // protected $CI;
    function __construct(){
        parent::__construct();
       
    }

	function get_user_data($user_id)
    {
        $sql_user="SELECT 
                    t100.id_100, 
                    t100.usertype_ourtag_90_100, 
                    t100.display_name_100, 
                    t100.name_100, 
                    t100.email_100, 
                    t100.mobile_100, 
                    t100.profile_image_100, 
                    t100.login_username_100, 
                    t100.active_yn_100 
                FROM 100_admin_user t100
                WHERE t100.active_yn_100='yes'
                AND t100.id_100='$user_id'";     
        $result=$this->db->query($sql_user)->result();
        return $result;

    }
    function get_all()
    {
        $sql_user="SELECT 
                    t100.id_100, 
                    t100.usertype_ourtag_90_100, 
                    t100.display_name_100, 
                    t100.name_100, 
                    t100.email_100, 
                    t100.mobile_100, 
                    t100.profile_image_100, 
                    t100.login_username_100, 
                    t100.active_yn_100 
                FROM 100_admin_user t100
                WHERE t100.active_yn_100='yes'
                ";
        if (!empty($user_id)) {
            $sql_user= $sql_user." AND t100.id_100='$user_id'";       # code...
        }       
        $result=$this->db->query($sql_user)->result();
        return $result;
    }
}
