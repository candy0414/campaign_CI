<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class task extends CI_Controller {
        
        public function __construct() {

            parent::__construct();
            $this->load->helper('url');
            $this->load->library('user_agent');
            $this->load->library('session');
            $this->load->model('Employee_Model');
        }

        public function process($employee_url){

            // Validate the user can login
            $result = $this->Employee_Model->validate();
            // Now we verify the result
            if(! $result){
                // If user did not validate, then show them login page again
                redirect(''.$employee_url."/login");
            }else{
                // If user did validate, 
                // Send them to members area
                redirect(''.$employee_url."/task");
            }
        }

        public function goSearch($keywords, $search_engine){
            if($search_engine == 'yahoo') {
                redirect("http://search.".$search_engine.".com/search?p=".$keywords."");
            }else{
                redirect("http://www.".$search_engine.".com/search?q=".$keywords."");
            }

        }

        public function index($employee_url){

            if($this->session->userdata('employee_mask')){
                $data['campaign'] = $this->Employee_Model->getCampaign($employee_url);
                $data["employee_url"] = $employee_url;
                $this->load->view('task_page', $data);
            }else{
                redirect(''.$employee_url."/login");
            }
 
        }

        public function txt2img() {
            if(!isset($_GET['txt']))
            { 
            return;
            }

            header ("Content-type: image/png");
            $text = $_GET['txt'];                                            
            $fontSize   = 20;
            $width  = ImageFontWidth($fontSize) * strlen($text) * 3;
            $height = ImageFontHeight($fontSize) * 3;

            $im = @imagecreate ($width,$height);
            $background_color = imagecolorallocate ($im, 211, 211, 211); //white background
            $text_color = imagecolorallocate ($im, 0, 0,0);//black text
            $xPosition = (($width/2)-((imagefontwidth($fontSize)*strlen($text))/2));
            $yPosition = (($height/2)-(imagefontheight($fontSize)/2));
            imagestring ($im, $fontSize, $xPosition, $yPosition,  $text, $text_color);
            imagepng ($im);
        }

        public function updateReport($employee_url) {
            $this->session->set_userdata('complete_mask', true);
            $site_url = $_POST["site_url"];
            $this->Employee_Model->updateReport($site_url);
        }
    }
?>
