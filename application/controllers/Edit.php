<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class edit extends CI_Controller {

        public function __construct() {

            parent::__construct();
            $this->load->helper('url');
            $this->load->model('Load_Model');
        }
        public function saveCampaign($campaignId){
            $this->Load_Model->saveCampaign($campaignId);
            redirect(''.$this->input->post("client").'/campaigns');

        }
        public function index($campaignName){
            if($this->session->userdata('admin_mask')){
                $campaignName = rawurldecode($campaignName);
                $c_id = $this->session->userdata('c_id');
                $data["campaign"] = $this->Load_Model->getCampaign($c_id);
                $this->load->view('edit_page', $data);
            }else{
                redirect('admin');
            }
        }
        public function copy(){
            $c_id = $this->session->userdata('c_id');
            $data = $this->Load_Model->getCampaign($c_id);
            $this->session->set_userdata('c_name', $data[0]->c_name);
            $this->session->set_userdata('keywords', $data[0]->keywords);
            $this->session->set_userdata('site_url', $data[0]->site_url);
            $this->session->set_userdata('page_title', $data[0]->page_title);
            $this->session->set_userdata('v_url', $data[0]->v_url);
            $this->session->set_userdata('v_page_name', $data[0]->v_page_name);
            $this->session->set_userdata('target_location', $data[0]->target_location);
            $this->session->set_userdata('bid', $data[0]->bid);
            $this->session->set_userdata('speed', $data[0]->speed);
            $this->session->set_userdata('positions', $data[0]->positions);
            $this->session->set_userdata('target_per_day', $data[0]->target_per_day);
            $this->session->set_userdata('search_engine', $data[0]->search_engine);

            redirect(''.$data[0]->client.'/add_campaign');
        }
    }
?>
