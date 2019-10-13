<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class report extends CI_Controller {

        public function __construct() {

            parent::__construct();
            $this->load->helper('url');
            $this->load->model('Load_Model');
        }
        public function index($CampaignName){
            if($this->session->userdata('admin_mask')){
                $CampaignName = rawurldecode($CampaignName);
                $c_id = $this->session->userdata('c_id');
                $data["reports"] = $this->Load_Model->getReports($c_id);
                $data["c_name"] = $CampaignName;
                $this->load->view('view_report_page', $data);
            }else{
                redirect('admin');
            }
        }
    }
?>
