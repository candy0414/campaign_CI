<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class admin extends CI_Controller {
        
        public function __construct() {

            parent::__construct();
            $this->load->helper('url');
            $this->load->model('Load_Model');
            $this->load->library('session');
        }

        public function process(){
            // Validate the user can login
            $result = $this->Load_Model->validate();
            // Now we verify the result
            if(! $result){
                // If user did not validate, then show them login page again
                $msg = '<font color=red>Invalid username and/or password.</font><br />';
                redirect('admin');
            }else{
                // If user did validate, 
                // Send them to members area
                $this->session->set_userdata('admin_mask', true);
                redirect('client_management');
            }
        }

        public function index($msg = NULL){
            // Load our view to be displayed
            // to the user
            $data['msg'] = $msg;
            $this->load->view('adminlogin', $data);
        }
    }
?>
