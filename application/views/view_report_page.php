<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style_view_report.css"/>
	<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <!-- <script src="<?php echo base_url();?>assets/js/manage_campaigns_action.js"></script> -->
</head>
<body>
	<div class="container">
		<h2>Completed Employee Instances:</h2>
		<a href="../campaigns"><button class="" style="float: right; color: black">Back</button></a>
		<br><br><br>
		<div style="height: 650px; overflow: auto">
		<table style="margin-top: 0px;" class="table table-bordered">
			<thead>
				<tr>
					<th>Attempts</th>
					<th>Campaign Name</th>
					<th>Website URL</th>
					<th>IP Address</th>
					<th>IP Location</th>
					<th>Browser UA</th>
					<th>Timestamp</th>
				</tr>
			</thead>
			<tbody style="height: 100px; overflow: auto">
				<?php
					for($i=0;$i<sizeof($reports); $i++){
						$row = $reports[$i];
						echo "<tr>";
						echo "<td>".($i+1)."</td>";
						echo "<td>".$c_name."</td>";
						echo "<td>".$row->website_url."</td>";
						echo "<td>".$row->IP_address."</td>";
						echo "<td>".$row->IP_location."</td>";
						echo "<td>".$row->browser_UA."</td>";
						echo "<td>".$row->timestamp."</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
		</div>
	</div>

</body>
</html>