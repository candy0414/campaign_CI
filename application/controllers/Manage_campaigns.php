<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class manage_campaigns extends CI_Controller {

        public function __construct() {

            parent::__construct();
            $this->load->helper('url');
            $this->load->model('Load_Model');
        }

        public function deleteCampaign(){
            $c_id = $_POST['c_id'];
            $this->Load_Model->deleteCampaign($c_id);
        }
        
        public function setC_id() {
            $this->session->set_userdata('c_id', $_POST['c_id']);
        }
        public function index($clientname){
                if($this->session->userdata('admin_mask')){
                $clientname = rawurldecode($clientname);
                $data["campaigns"] = $this->Load_Model->getCampaigns($clientname);
                for($i=0; $i<sizeof($data["campaigns"]); $i++) {
                    $reports = $this->Load_Model->getReports($data["campaigns"][$i]->id);
                    $data["attempts"][$i] = sizeof($reports);
                }
                $this->load->view('manage_campaigns_page', $data);
            }
            else{
                redirect('admin');
            }
        }

        public function pauseCampaignAPI() {
            include(APPPATH.'/libraries/RESTClient.php');
            define("cAPI_KEY", "269aa7657e0f642c67a9243dbf9503db131270a5f526ed9ef3cdaced609da635");
            define("cAPI_URL", "https://api.microworkers.com");
            $client = new RESTClient();
            $client->setApiKey(cAPI_KEY);
            $client->setUrl(cAPI_URL . "/campaign_b/pause/".$this->input->post('campaign_id'));
            $client->setMethod("PUT");
            $client->execute();
            $response = $client->getLastResponse();
            $client->resetClient();
            echo $response;
        }

        public function stopCampaignAPI() {
            include(APPPATH.'/libraries/RESTClient.php');
            define("cAPI_KEY", "269aa7657e0f642c67a9243dbf9503db131270a5f526ed9ef3cdaced609da635");
            define("cAPI_URL", "https://api.microworkers.com");
            $client = new RESTClient();
            $client->setApiKey(cAPI_KEY);
            $client->setUrl(cAPI_URL . "/campaign_b/stop/".$_POST["campaign_id"]);
            $client->setMethod("PUT");
            $client->execute();
            $response = $client->getLastResponse();
            $client->resetClient();
            echo $response;
        }

        public function resumeCampaignAPI() {
            include(APPPATH.'/libraries/RESTClient.php');
            define("cAPI_KEY", "269aa7657e0f642c67a9243dbf9503db131270a5f526ed9ef3cdaced609da635");
            define("cAPI_URL", "https://api.microworkers.com");
            $client = new RESTClient();
            $client->setApiKey(cAPI_KEY);
            $client->setUrl(cAPI_URL . "/campaign_b/resume/".$this->input->post('campaign_id'));
            $client->setMethod("PUT");
            $client->execute();
            $response = $client->getLastResponse();
            $client->resetClient();
            echo $response;
        }
    }
?>
