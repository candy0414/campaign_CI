<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class view_campaign extends CI_Controller {

        public function __construct() {

            parent::__construct();
            $this->load->helper('url');
            $this->load->model('Load_Model');
        }
        public function index($CampaignName){
            if($this->session->userdata('admin_mask')){
                $CampaignName = rawurldecode($CampaignName);
                $c_id = $this->session->userdata('c_id');
                $data["campaign"] = $this->Load_Model->getCampaign($c_id);
                $data["defaults"] = $this->Load_Model->getDefaults();
                $this->load->view('view_campaign_page', $data);
            }else{
                redirect('admin');
            }
        }
    }
?>
