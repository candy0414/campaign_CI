<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="referrer" content="no-referrer" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/style_task_page.css">
<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/task_page_action.js"></script>
<title></title>

</head>
<body>

<!-- <form class="myForm" method="post" enctype="application/x-www-form-urlencoded" action="../login/process/<?php echo $employee_url;?>" target="_self"> -->
<div class="myForm">
	<h2>Employees Search and Click System</h2><br>
	<p>Note you popup blocker must be turned off in order to complete these searches. Please turn off all popup blocking settings before performing this task.</p>
	<br/>

	<p>
		<label>1) Type the bolded keyword into the keyword field below<br/><br/>
			<img src="../task/txt2img/?txt=<?php echo $campaign[0]->keywords; ?>" border="0">
			<input type="text" name="realKeywords" value="<?php echo $campaign[0]->keywords;?>" style="display: none">
		</label>
	</p>
</div>
<div class="myForm" style="margin: -80px auto">
	<p>
		<label>2) Click the  search button<br/><br/>
			<input type="text" name="keywords" value="" placeholder="Please input keyword" required>
			<button id="searchButton" style="float: right">Submit</button>
			<input type="text" name="search_engine" value="<?php echo $campaign[0]->search_engine;?>" style="display: none">
		</label>
	</p>
</div>
<div id="from3" class="myForm" style="display: none">
	<p>
	<label>3) Find the results with the page title "<?php echo $campaign[0]->page_title;?>" listed below and click on the site. You may need to scroll through multiple pages of results.<br/><br/>
	</label>
	</p>
	<p>
	<label>4) Please copy and paste the URL for "<?php echo $campaign[0]->page_title;?>" result below. Do not close the search results windows until you complete all of these steps.<br/><br/>
	<input type="url" name="site_url" value="" placeholder="Page URL" required>
	<input type="url" name="real_site_url" value="<?php echo $campaign[0]->site_url;?>" style="display: none">
	<button id="submitUrl"  style="float: right">Submit</button>
	</label>
	</p>
</div>
<div  class="myForm" style="margin: -80px auto"><label id="some_div"></label></div>
<div id="from5" class="myForm" style="display: none;">
	<p>
		<label>5) Go to the "<?php echo $campaign[0]->v_page_name;?>" Page<br/><br/><br/>6) Copy "<?php echo $campaign[0]->v_page_name;?>" Page URL into the URL into the verification form and click verify
		</label><br/>
		<label>7) After step5 is complete you will receive a task code to prove completion of task and enter into Employee.com to get paid:<br/><br/>
			<input type="url" name="VerifyUrl" value="" placeholder="Verify URL" required>
			<input type="url" name="realVerifyUrl" value="<?php echo $campaign[0]->v_url;?>" style="display: none">
			<input type="url" name="employee_url" value="<?php echo $employee_url;?>" style="display: none">
			<button id="submit_v_url" style="float: right">Submit</button>
		</label>
	</p>
</div>
<!-- </form> -->

</body>
</html>