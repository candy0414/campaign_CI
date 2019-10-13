<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class login extends CI_Controller {
        
        public function __construct() {

            parent::__construct();
            $this->load->helper('url');
            $this->load->library('user_agent');
            $this->load->library('session');
            $this->load->model('Employee_Model');
        }

        public function process($employee_url){

            // Validate the user can login
            $result = $this->Employee_Model->validate($employee_url);

            // Now we verify the result
            if(! $result){
                // If user did not validate, then show them login page again

                redirect(''.$employee_url."/login");
            }else{
                // If user did validate, 
                // Send them to members area
                $this->session->set_userdata('employee_mask', true);
                redirect(''.$employee_url."/task");
            }
        }

        public function index($employee_url){

            $result = $this->Employee_Model->ConfirmCountry($employee_url);
            $data["employee_url"] = $employee_url;
            $data["result"] = $result;
            $this->load->view('employee_login', $data);
        }

    }
?>
