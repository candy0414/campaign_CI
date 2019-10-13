<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class client_management extends CI_Controller {

        public function __construct() {

            parent::__construct();
            $this->load->helper('url');
            $this->load->model('Load_Model');
        }
        public function manage_campaigns(){
            redirect(''.$_POST["clientname"].'/manage_campaigns');
            echo $_POST["clientname"].'/manage_campaigns';
        }

        public function deleteClient($clientname) {
            $clientname = rawurldecode($clientname);
            $this->Load_Model->deleteClient($clientname);
        }

        public function index(){
            // $this->session->unset_userdata('c_id');
            if($this->session->userdata('admin_mask')){
                $data["clients"] = $this->Load_Model->getClients();
                $this->load->view('admin_client_management', $data);
            }else{
                redirect('admin');
            }

        }
    }
?>
