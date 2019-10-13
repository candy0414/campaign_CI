<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style_manage_campaigns.css"/>
	<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/manage_campaigns_action.js"></script>
</head>
<body>
	<div class="container">
		<h2>Listed below are your campaigns</h2>
		<a href="<?php $this->session->unset_userdata('c_name');
            $this->session->unset_userdata('keywords');
            $this->session->unset_userdata('site_url');
            $this->session->unset_userdata('page_title');
            $this->session->unset_userdata('v_url');
            $this->session->unset_userdata('v_page_name');
            $this->session->unset_userdata('target_location');
            $this->session->unset_userdata('bid');
            $this->session->unset_userdata('speed');
            $this->session->unset_userdata('positions');
            $this->session->unset_userdata('target_per_day');
            $this->session->unset_userdata('search_engine');?>add_campaign"><button id="addnew" class="" style="float: right; color: black">Add New</button></a>
		<a href="../client_management"><button id="addnew" class="" style="float: right; color: black">Back</button></a>
		<table style="margin-top: 70px" class="table table-bordered">
			<thead>
				<tr>
					<th>Number</th>
					<th>Campaign Name</th>
					<th>Progress</th>
					<th>Speed</th>
					<th>Attempts</th>
					<th>Status</th>
					<th>Estimated time of completion</th>
					<th>View Details</th>
					<th>Actions</th>
					<th>Report</th>
				</tr>
			</thead>
			<tbody>
				<?php
					include(APPPATH.'/libraries/RESTClient.php');
		            define("cAPI_KEY", "269aa7657e0f642c67a9243dbf9503db131270a5f526ed9ef3cdaced609da635");
		            define("cAPI_URL", "https://api.microworkers.com");
		            $client = new RESTClient();

					function getCampaignAPI($campaign_id, $client) {

			            $client->setApiKey(cAPI_KEY);
			            $client->setUrl(cAPI_URL . "/campaign_b/get_info/".$campaign_id);
			            $client->setMethod("GET");
			            $client->execute();
			            $response = $client->getLastResponse();
			            $client->resetClient();
			            return json_decode($response);
			        }
					for($i=0;$i<sizeof($campaigns); $i++){
						$row = $campaigns[$i];
						$response = getCampaignAPI($row->campaign_id, $client);
						

						if($response->{'status'} == "ERROR" ) {

							$conn = new mysqli('localhost', 'root', 'b5x?ch#kob?fl?oM', 'db_campaign');
							if($conn) {
								$sql = "DELETE FROM campaign WHERE id='".$row->id."'";
            					$query = $conn->query($sql);
							}
							$conn->close();
						}
						else{
							echo "<tr>";
							echo "<td>".($i+1)."</td>";
							echo "<td>".$row->c_name."</td>";
							echo "<td>".$response->{'tasks_ok'}." / ".$response->{'available_positions'}."</td>";
							echo "<td>".$row->speed."</td>";
							echo "<td>".$attempts[$i]."</td>";
					        echo "<td class='campaign_status'>".$response->{'campaign_status'}."</td>";

					        $estimated = round($row->target_per_day/$response->{'available_positions'}, 2);
							echo "<td>".$estimated."</td>";
							echo "<td><button class='view_campaign' data-name='".$row->c_name."' data-id='".$row->id."'>View Campaign</button></td>";
							echo "<td>
								<button class='edit_campaign' data-name='".$row->c_name."' data-id='".$row->id."'>Edit</button><button class='delete_campaign' data-name='".$row->c_name."' data-id='".$row->id."'>Delete</button><button class='pause_campaign' data-id='".$row->campaign_id."' ";
								// if($response->{'campaign_status'} == 'FINISHED' || $response->{'campaign_status'} == 'STOPPED' || $response->{'campaign_status'} == 'PENDING_REVIEW' || $response->{'campaign_status'} == 'BLOCKED') {
								// 	echo "disabled>Pause</button>";
									
								// }
								if($response->{'campaign_status'} != 'PAUSED' && $response->{'campaign_status'} != 'RUNNING') {
									echo "disabled>Pause</button>";
									
								}
								if($response->{'campaign_status'} == 'PAUSED') {
									echo "style='display: none'>Pause</button><button class='resume_campaign' data-id='".$row->campaign_id."'>Resume</button>";
								}
								if($response->{'campaign_status'} == 'RUNNING') {
									echo ">Pause</button>";
								}
								echo "<button class='stop_campaign' data-id='".$row->campaign_id."' data-c_id='".$row->id."' ";
								if($response->{'campaign_status'} != 'RUNNING' && $response->{'campaign_status'} != 'PENDING_REVIEW') {
									echo "disabled";
								}
								if($response->{'campaign_status'} == 'RUNNING') {
									echo "data-flag='RUNNING' ";
								}
								if($response->{'campaign_status'} == 'PENDING_REVIEW') {
									echo "data-flag='PENDING_REVIEW' ";
								}
								echo ">Stop</button></td>";
							echo "<td><button class='view_report' data-name = '".$row->c_name."' data-value = '".$row->client."' data-id='".$row->id."'>View Report</button></td>";
						}
						
						echo "</tr>";
						
					}
				?>
			</tbody>
		</table>
	</div>

</body>
</html>