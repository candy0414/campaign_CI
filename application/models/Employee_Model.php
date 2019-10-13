<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    
    
    class Employee_Model extends CI_Model{

        function __construct(){
            parent::__construct();
            $this->db = $this->load->database("default", true);
        }
        
        public function ConfirmCountry($employee_url) {

            $sql = "SELECT campaign_id FROM campaign WHERE employee_url='".$employee_url."'";
            $query = $this->db->query($sql);
            $campaign_id = $query->result();
            // print_r($campaign_id[0]->campaign_id);

            include(APPPATH.'/libraries/RESTClient.php');
            define("cAPI_KEY", "269aa7657e0f642c67a9243dbf9503db131270a5f526ed9ef3cdaced609da635");
            define("cAPI_URL", "https://api.microworkers.com");
            $client = new RESTClient();
            $client->setApiKey(cAPI_KEY);
            $client->setUrl(cAPI_URL . "/campaign_b/get_info/".$campaign_id[0]->campaign_id);
            $client->setMethod("GET");
            $client->execute();
            $response = $client->getLastResponse();
            $client->resetClient();
            $response = json_decode($response);
            // print_r($response->{'targeted_countries'});

            $IP_address = $this->input->ip_address();

            //ipinfo grabs the ip of the person requesting
            // $getloc = json_decode(file_get_contents("http://ipinfo.io/".$IP_address));
            $getloc = json_decode(file_get_contents("https://api.ipstack.com/"."$IP_address"."?access_key=015a99b81f8a083ab33533c1cbed335b"));
            if($getloc->{'country_code'} == $response->{'targeted_countries'}) return true;
            return false;
        }

        public function validate($employee_url){  
            // $IP_address = $this->input->ip_address();

            // //ipinfo grabs the ip of the person requesting
            // $getloc = json_decode(file_get_contents("http://ipinfo.io/".$IP_address));
            // if($getloc->country != "US") return false;

            // grab user input
            $password = $this->security->xss_clean($this->input->post('password'));
            
            // Prep the query
            $sql = "SELECT * FROM defaults WHERE default_employee_password='".$password."'";
            $query = $this->db->query($sql);
            
            // Let's check if there are any results
            if($query->num_rows() == 1)
            {
                // If there is a user, then create session data
                $row = $query->row();                
                $IP_address = $this->input->ip_address();
                $getloc = json_decode(file_get_contents("https://api.ipstack.com/".$IP_address."?access_key=015a99b81f8a083ab33533c1cbed335b"));
                $IP_location = $getloc->{"country_name"};
                $browser_UA = $this->agent->agent_string();
                $sql = "SELECT * FROM campaign WHERE employee_url='".$employee_url."'";
                $query = $this->db->query($sql);
                $row = $query->result();
                $website_url = $row[0]->site_url;
                $c_id = $row[0]->id;
                // $timestamp = date('Y-m-d H:i:s');
                $date = new DateTime();
                $starttime = $date->format('Y-m-d H:i:s');
                $starttime .= " / ";

                $this->session->set_userdata('ip', $IP_address);
                $this->session->set_userdata('starttime', $starttime);

                $sql = "INSERT INTO `report` (website_url, IP_address, IP_location, `browser_UA`, `timestamp`, c_id) VALUES ('".$website_url."', '".$IP_address."', '".$IP_location."', '".$browser_UA."', '".$starttime."', '".$c_id."')";
                $query = $this->db->query($sql);

                // $this->session->set_userdata($data);
                return true;


            }
            // If the previous process did not validate
            // then return false.
            return false;
        }

        public function validateEmployeeUrl($employee_url){
           
            // Prep the query
            $sql = "SELECT * FROM campaign WHERE employee_url='".$employee_url."'";
            $query = $this->db->query($sql);
            return $query->result();
            // Let's check if there are any results
            if($query->num_rows() >= 1)
            {
                // If there is a user, then create session data
                $row = $query->row();
                // $this->session->set_userdata($data);

                return true;

            }
            // If the previous process did not validate
            // then return false.
            return false;
        }
        
        public function getCampaign($employee_url){
            $sql = "SELECT * FROM campaign WHERE employee_url='".$employee_url."'";
            $query = $this->db->query($sql);
            return $query->result();
        }

        public function getVerifyCode($employee_url) {

            
            
            $sql = "SELECT v_code FROM campaign WHERE employee_url='".$employee_url."'";
            $query = $this->db->query($sql);
            return $query->result();
        }

        public function updateReport($site_url) {
            $date = new DateTime();
            $endtime = $date->format('Y-m-d H:i:s');

            $starttime = $this->session->userdata('starttime');
            $IP_address = $this->session->userdata('ip');

            $timestamp = $starttime;
            $timestamp .= $endtime;

            $sql = "UPDATE report SET `timestamp`='".$timestamp."', website_url='".$site_url."' WHERE IP_address='".$IP_address."' AND `timestamp`='".$starttime."'";
            $query = $this->db->query($sql);
            return;
        }
    }

?>