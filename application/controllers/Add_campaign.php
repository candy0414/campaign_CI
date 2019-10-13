<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class add_campaign extends CI_Controller {

        public function __construct() {

            parent::__construct();
            $this->load->helper('url');
            $this->load->model('Load_Model');
        }

        public function addCampaign(){
            
            $generated_url = $this->randomURL();

            $result = $this->addCampaignAPI($generated_url);
            $status = $result->{'status'};
            if($status == "ERROR"){
                return;
            }

            $campaign_id = $result->{'campaign_id'};
            $success_code = $this->randomCode();
            $newCampaign = $this->Load_Model->addCampaign($generated_url, $success_code, $campaign_id);
            // redirect(''.$this->input->post("client").'/campaigns');
            $this->session->set_userdata('c_id', $newCampaign[0]->id);
            redirect(''.$this->input->post("client").'/'.$this->input->post("c_name").'/view_campaign');
        }

        public function index($clientname){
            if($this->session->userdata('admin_mask')){
                $clientname = rawurldecode($clientname);
                $data["client"] = $clientname;
                $data["defaults"] = $this->Load_Model->getDefaults();
                $this->load->view('add_campaign_page', $data);               
            }else{
                redirect('admin');
            }

        }

        public function randomURL() {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 20; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }
        public function randomCode(){
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 16; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }

        public function addCampaignAPI($generated_url) {
            include(APPPATH.'/libraries/RESTClient.php');
            define("cAPI_KEY", "269aa7657e0f642c67a9243dbf9503db131270a5f526ed9ef3cdaced609da635");
            define("cAPI_URL", "https://api.microworkers.com");

            $defaults = $this->Load_Model->getDefaults();
            $text1 = $defaults[0]->default_text1;
            $text2 = $defaults[0]->default_text2;
            $password = $defaults[0]->default_employee_password;

            $text1 = str_replace("{{Employee URL}}", base_url().$generated_url."/login", $text1);
            $text1 = str_replace("{{password for Employee}}", $password, $text1);

            $country_code = array(
                "United States"=>"US",
                "Canada"=>"CA",
                "Australia"=>"AU"
            );
            $client = new RESTClient();
            $client->setApiKey(cAPI_KEY);
            $client->setUrl(cAPI_URL . "/campaign_b/new_campaign");
            $client->setMethod("POST");
            $client->setData(
              array(
                "title"=>$this->security->xss_clean($this->input->post('c_name')),
                "zone"=>"west1", // [asia1|caribbean1|europe1|europe2|int|west1]
                "selected_countries"=>$country_code[$this->security->xss_clean($this->input->post('target_location'))], // [CC1 CC2 CC3...]
                "category"=>"1001",
                "file_proof"=> 0,
                "minutes_to_finish"=>"3",
                "available_positions"=>$this->security->xss_clean($this->input->post('positions')),
                "payment_per_task"=>$this->security->xss_clean($this->input->post('bid')),
                "speed"=>$this->security->xss_clean($this->input->post('speed')),
                "required_work"=>$text1,
                "required_proof"=>$text2,
                "ttr"=>"7",
                "auto_rate"=>"NO",
                "qt_required"=> 0
              )
            );
            $client->execute();
            $response = $client->getLastResponse();
            $client->resetClient();
            $response = json_decode($response);

            return $response;

        }
    }
?>
