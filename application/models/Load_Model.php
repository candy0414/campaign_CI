<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Load_Model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->db = $this->load->database("default", true);
        }
        
        public function validate(){
            // grab user input
            $username = $this->security->xss_clean($this->input->post('username'));
            $password = $this->security->xss_clean($this->input->post('password'));
            
            // Prep the query
            $sql = "SELECT * FROM admin WHERE username='".$username."' AND password='".$password."'";
            $query = $this->db->query($sql);


            // Let's check if there are any results
            if($query->num_rows() == 1)
            {
                // If there is a user, then create session data
                $row = $query->row();
                $data = array(
                        'userid' => $row->id,
                        'username' => $row->username,
                        'validated' => true
                        );
                $this->session->set_userdata('admin', $row->id);

                return true;
            }
            // If the previous process did not validate
            // then return false.
            return false;
        }
        public function addclient(){
            $email = $this->security->xss_clean($this->input->post('email'));
            $name = $this->security->xss_clean($this->input->post('name'));
            $sql = "INSERT INTO client (name, email) VALUES ('".$name."', '".$email."')";
            $query = $this->db->query($sql);
            return;
        }
        public function getCampaigns($client){
            $sql = "SELECT * FROM campaign WHERE client='".$client."' AND admin='".$this->session->userdata('admin')."'";
            $query = $this->db->query($sql);
            return $query->result();
        }
        public function getAllCampaigns() {
            $sql = "SELECT * FROM campaign";
            $query = $this->db->query($sql);
            return $query->result();
        }
        public function getClientEmail($clientname) {
            $sql = "SELECT * FROM client WHERE name='".$clientname."'";
            $query = $this->db->query($sql);
            return $query->result();
        }
        public function changeSpeed($newSpeed, $c_id) {
            $sql = "UPDATE campaign SET speed='".$newSpeed."' WHERE id='".$c_id."'";
            $query = $this->db->query($sql);
            return;
        }
        public function addCampaign($employee_url, $v_code, $campaign_id){
            $page_title = $this->security->xss_clean($this->input->post('page_title'));
            $v_url = $this->security->xss_clean($this->input->post('v_url'));
            $c_name = $this->security->xss_clean($this->input->post('c_name'));
            $v_page_name = $this->security->xss_clean($this->input->post('v_page_name'));
            $keywords = $this->security->xss_clean($this->input->post('keywords'));
            $search_engine = $this->security->xss_clean($this->input->post('search_engine'));
            $site_url = $this->security->xss_clean($this->input->post('site_url'));
            $client = $this->security->xss_clean($this->input->post('client'));
            $target_location = $this->security->xss_clean($this->input->post('target_location'));
            $bid = $this->security->xss_clean($this->input->post('bid'));
            $speed = $this->security->xss_clean($this->input->post('speed'));
            $positions = $this->security->xss_clean($this->input->post('positions'));
            $target_per_day = $this->security->xss_clean($this->input->post('target_per_day'));

            $sql = "INSERT INTO campaign (c_name, page_title, v_url, v_page_name, keywords, search_engine, site_url, client, employee_url, v_code, target_location, bid, speed, positions, target_per_day, campaign_id, admin) VALUES ('".$c_name."','".$page_title."','".$v_url."','".$v_page_name."','".$keywords."','".$search_engine."','".$site_url."','".$client."','".$employee_url."', '".$v_code."', '".$target_location."', '".$bid."', '".$speed."', '".$positions."', '".$target_per_day."', '".$campaign_id."', '".$this->session->userdata('admin')."')";
            $query = $this->db->query($sql);
            $sql = "SELECT * FROM campaign WHERE employee_url='".$employee_url."'";
            $query = $this->db->query($sql);
            return $query->result();
        }
        public function getReports($c_id){
            // $sql = "SELECT * FROM report WHERE c_id='SE'";
            $sql = "SELECT * FROM report WHERE c_id='".$c_id."'";
            $query = $this->db->query($sql);
            return $query->result();
        }
        public function getCampaign($c_id){
            $sql = "SELECT * FROM campaign WHERE id='".$c_id."'";
            $query = $this->db->query($sql);
            return $query->result();
        }
        public function getDefaults(){
            $sql = "SELECT * FROM defaults";
            $query = $this->db->query($sql);
            return $query->result();
        }
        public function saveCampaign($campaignId){
            $page_title = $this->security->xss_clean($this->input->post('page_title'));
            $v_url = $this->security->xss_clean($this->input->post('v_url'));
            $c_name = $this->security->xss_clean($this->input->post('c_name'));
            $v_page_name = $this->security->xss_clean($this->input->post('v_page_name'));
            $keywords = $this->security->xss_clean($this->input->post('keywords'));
            $search_engine = $this->security->xss_clean($this->input->post('search_engine'));
            $site_url = $this->security->xss_clean($this->input->post('site_url'));
            // $target_location = $this->security->xss_clean($this->input->post('target_location'));
            $bid = $this->security->xss_clean($this->input->post('bid'));
            $speed = $this->security->xss_clean($this->input->post('speed'));
            $positions = $this->security->xss_clean($this->input->post('positions'));
            $target_per_day = $this->security->xss_clean($this->input->post('target_per_day'));

            $sql = "UPDATE campaign SET page_title='".$page_title."', v_url='".$v_url."', c_name='".$c_name."', v_page_name='".$v_page_name."', keywords='".$keywords."', search_engine='".$search_engine."', site_url='".$site_url."', bid='".$bid."', speed='".$speed."', positions='".$positions."', target_per_day='".$target_per_day."' WHERE id=".$campaignId."";
            $query = $this->db->query($sql);
            return;
        }
        public function saveDefaults($defaultId){
            $default_text1 = $this->security->xss_clean($this->input->post('default_text1'));
            $default_text2 = $this->security->xss_clean($this->input->post('default_text2'));
            $default_employee_password = $this->security->xss_clean($this->input->post('default_employee_password'));
            $default_target_location = $this->security->xss_clean($this->input->post('default_target_location'));
            $default_bid = $this->security->xss_clean($this->input->post('default_bid'));
            $default_speed = $this->security->xss_clean($this->input->post('default_speed'));
            $default_positions = $this->security->xss_clean($this->input->post('default_positions'));
            $default_target_per_day = $this->security->xss_clean($this->input->post('default_target_per_day'));

            $sql = "UPDATE defaults SET default_text1='".$default_text1."', default_text2='".$default_text2."', default_employee_password='".$default_employee_password."', default_target_location='".$default_target_location."', default_bid='".$default_bid."', default_speed='".$default_speed."', default_positions='".$default_positions."', default_target_per_day='".$default_target_per_day."' WHERE id=".$defaultId."";
            $query = $this->db->query($sql);
            return;
        }

        public function getClients() {
            $sql = "SELECT * FROM client";
            $query = $this->db->query($sql);
            return $query->result();
        }

        public function deleteClient($name){
            $sql = "DELETE FROM client WHERE name='".$name."'";
            $query = $this->db->query($sql);
            return;
        }

        public function deleteCampaign($c_id){
            
            $sql = "DELETE FROM campaign WHERE id='".$c_id."'";
            $query = $this->db->query($sql);
            return;
        }
    }

?>