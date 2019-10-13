<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    include(APPPATH.'/libraries/RESTClient.php');
    define("cAPI_KEY", "269aa7657e0f642c67a9243dbf9503db131270a5f526ed9ef3cdaced609da635");
    define("cAPI_URL", "https://ttv.microworkers.com/api/v2/basic-campaigns/");
            
    
    class SendEmail extends CI_Controller {


        public function __construct() {

            parent::__construct();
            $this->load->helper('url');
            // $this->load->config('email');
            
            $this->load->model('Load_Model');
            
        }

        public function index(){

            $config = Array(
              'protocol' => 'smtp',
              'smtp_host' => 'dev.deviatelabs.com',
              'smtp_port' => 465,
              'smtp_user' => 'notifications@deviatetools.com', // change it to yours
              'smtp_pass' => ',]CPRI.Wa#XG', // change it to yours
              'mailtype' => 'html',
              'charset' => 'iso-8859-1',
              'wordwrap' => TRUE,
              'smtp_crypto' => 'ssl'
            );

            $this->load->library('email');
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            

            $data = $this->Load_Model->getAllCampaigns();
            

            $client = new RESTClient();
            $client->setApiKey(cAPI_KEY);

            foreach ($data as $value) {
                $status = $this->getStatusAPI($value->campaign_id, $client);

                if($status == "FINISHED") {
                    $clientname = $value->client;
                    $clientinfo = $this->Load_Model->getClientEmail($clientname);
                    $clientEmail = $clientinfo[0]->email;
                    $this->email->from('notifications@deviatetools.com');
                    $this->email->to($clientEmail);
                    $this->email->subject("Notification from Campaign");

                    $campaigninfo = $this->getCampaignAPI($value->campaign_id, $client);
                    $created_datetime9 = $campaigninfo->{'created_datetime9'};
                    $finished_datetime9 = $campaigninfo->{'finished_datetime9'};
                    $bid = $value->bid;
                    $completions = $campaigninfo->{'tasks_ok'};

                    $reports = $this->Load_Model->getReports($value->id);
                    $attempts = sizeof($reports);

                    $this->email->message("Created_datetime: ".$created_datetime9.", Finished_datetime: ".$finished_datetime9.", Bid: ".$bid.", Completions:".$completions.", Attempts: ".$attempts."");
                    
                    if($this->email->send()) {
                    }else{
                        show_error($this->email->print_debugger());
                    }
                }
            }
        }

        public function getStatusAPI($campaign_id, $client) {
            
            
            $client->setUrl("https://api.microworkers.com/campaign_b/get_status/".$campaign_id);
            $client->setMethod("GET");
            $client->execute();
            $response = $client->getLastResponse();
            $client->resetClient();
            $response = json_decode($response);
            return $response->{'campaign_status'};
        }

        public function getCampaignAPI($campaign_id, $client) {

            $client->setUrl("https://api.microworkers.com/campaign_b/get_info/".$campaign_id);
            $client->setMethod("GET");
            $client->execute();
            $response = $client->getLastResponse();
            $client->resetClient();
            return json_decode($response);

        }
    }
?>
 