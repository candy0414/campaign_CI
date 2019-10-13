<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    include(APPPATH.'/libraries/RESTClient.php');
    define("cAPI_KEY", "269aa7657e0f642c67a9243dbf9503db131270a5f526ed9ef3cdaced609da635");
    define("cAPI_URL", "https://api.microworkers.com");
            
    
    class VerifyTasks extends CI_Controller {


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

                

                // if($this->getStatusAPI($value->campaign_id, $client) != "RUNNING") continue;

                $tasks = $this->getTasksAPI($value->campaign_id, $client);

                if(sizeof($tasks->{'tasks'}) == 0) continue;

                $workers = [];

                foreach ($tasks->{'tasks'} as $task) {

                    // echo $task[0];
                    $taskInfo = $this->getTaskInfoAPI($task[0], $client);
                    $proof = $taskInfo->{'task_details'}->{'proof'};

                    if(strpos($proof, $value->v_code) !== false) {
                        echo "success";
                        $this->rateTaskAPI($value->campaign_id, $task[0], $client, 1);
                    }else{
                        $this->rateTaskAPI($value->campaign_id, $task[0], $client, 0);
                        $worker_id = $taskInfo->{'task_details'}->{'worker_id'};
                        array_push($workers, $worker_id);
                    }
                }
                // print_r($workers);
                $this->excludeWorkersAPI($workers, $client);
            }
        }

        public function getTasksAPI($campaign_id, $client) {

            $client->setUrl(cAPI_URL . "/campaign_b/list_tasks/" . $campaign_id);
            $client->setMethod("GET");
            $client->execute();
            $response = $client->getLastResponse();
            $client->resetClient();
            return json_decode($response);

        }

        public function getTaskInfoAPI($task_id, $client) {
            $client->setUrl(cAPI_URL . "/campaign_b/get_task_info/" . $task_id);
            $client->setMethod("GET");
            $client->execute();
            $response = $client->getLastResponse();
            $client->resetClient();
            return json_decode($response);
        }

        public function rateTaskAPI($campaign_id, $task_id, $client, $flag) {

            $client->setUrl(cAPI_URL . "/campaign_b/rate_task/".$campaign_id);
            $client->setMethod("PUT");

            if($flag){
                $client->setData(
                    array('id_task' => $task_id, 'rating' => 'OK', 'comment' => '')
                );
            }else{
                $client->setData(
                    array('id_task' => $task_id, 'rating' => 'NOK', 'comment' => 'This task has not include the verification code')
                );
            }
            

            $client->execute();
            $response = $client->getLastResponse();
            $client->resetClient();
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

        public function excludeWorkersAPI($workers, $client) {

            
            $client->setUrl(cAPI_URL . "/employer/exclude_list");
            $client->setMethod("POST");
            $client->setData(
                array(
                    'worker'=>$workers
                )
            );
            $client->execute();
            $response = $client->getLastResponse();
            $client->resetClient();
            echo $response;
        }
    }
?>
 