<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    include(APPPATH.'/libraries/RESTClient.php');
    define("cAPI_KEY", "269aa7657e0f642c67a9243dbf9503db131270a5f526ed9ef3cdaced609da635");
    define("cAPI_URL", "https://api.microworkers.com");
            
    
    class AdjustSpeed extends CI_Controller {


        public function __construct() {

            parent::__construct();
            $this->load->helper('url');
            $this->load->model('Load_Model');
            
        }

        public function index(){

            $data = $this->Load_Model->getAllCampaigns();
            
            $client = new RESTClient();
            $client->setApiKey(cAPI_KEY);

            foreach ($data as $value) {

                $campaigninfo = $this->getCampaignAPI($value->campaign_id, $client);
                $completions = $campaigninfo->{'tasks_ok'};
                $target_per_day = $value->target_per_day;
                $currentSpeed = $campaigninfo->{'speed'};

                if($completions == $target_per_day) continue;
                if($completions < $target_per_day) {
                    $newSpeed = $this->setSpeedAPI($value->campaign_id, $client, $currentSpeed, 0);
                }
                if($completions > $target_per_day) {
                    $newSpeed = $this->setSpeedAPI($value->campaign_id, $client, $currentSpeed, 1);
                }
                $this->Load_Model->changeSpeed($newSpeed, $value->id);

            }
        }

        public function getCampaignAPI($campaign_id, $client) {

            $client->setUrl(cAPI_URL . "/campaign_b/get_info/" . $campaign_id);
            $client->setMethod("GET");
            $client->execute();
            $response = $client->getLastResponse();
            $client->resetClient();
            return json_decode($response);

        }

        public function setSpeedAPI($campaign_id, $client, $currentSpeed, $flag) {
            $client->setUrl(cAPI_URL . "/campaign_b/set_speed/" . $campaign_id);
            $client->setMethod("PUT");
            if($flag == 0) {
                $newSpeed = $currentSpeed + 200;
                if($newSpeed > 1000) {
                    $newSpeed = 1000;
                }
            }
            if($flag == 1) {
                $newSpeed = $currentSpeed - 200;
                if($newSpeed < 50) {
                    $newSpeed = 50;
                }
            }
            $client->setData(
              array(
                "speed"=>$newSpeed
              )
            );
            $client->execute();
            $response = $client->getLastResponse();
            $client->resetClient();
            return $newSpeed;
        }
    }
?>
 