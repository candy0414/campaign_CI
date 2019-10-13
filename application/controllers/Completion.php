<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class completion extends CI_Controller {
        
        public function __construct() {

            parent::__construct();
            $this->load->helper('url');
            $this->load->model('Employee_Model');
        }

        public function index($employee_url){
            // echo "came";
            // return;
            if($this->session->userdata('employee_mask')) {
                if($this->session->userdata('complete_mask')) {
                    $data["v_code"] = $this->Employee_Model->getVerifyCode($employee_url);
                    $this->load->view('completion_task_page', $data);
                }else{
                    redirect(''.$employee_url."/task");
                }
                
            }else{
                redirect(''.$employee_url."/login");
            }

        }

    }
?>
