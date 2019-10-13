<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class change_defaults extends CI_Controller {

        public function __construct() {

            parent::__construct();
            $this->load->helper('url');
            $this->load->model('Load_Model');
        }

        public function saveDefaults($defaultId) {

            $this->Load_Model->saveDefaults($defaultId);
            redirect('client_management');
        }

        public function index(){
            if($this->session->userdata('admin_mask')){
                $data["defaults"] = $this->Load_Model->getDefaults();
                $this->load->view('change_defaults_page', $data);
            }else{
                redirect('admin');
            }
        }
    }
?>
