<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class add_client extends CI_Controller {

        public function __construct() {

            parent::__construct();
            $this->load->helper('url');
            $this->load->model('Load_Model');
        }
        public function add_client(){
            $this->Load_Model->addclient();
            redirect('add_client');
        }
        public function index(){
            if($this->session->userdata('admin_mask')) {
                $this->load->view('add_client_page');
            }else{
                redirect('admin');
            }
        }
    }
?>
