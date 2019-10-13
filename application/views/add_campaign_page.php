<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/style_change_defaults.css">
<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
<style type="text/css">
	[data-tip] {
	position:relative;
	/*padding-left: 700px;*/

}
[data-tip]:before {
	content:'';
	/* hides the tooltip when not hovered */
	display:none;
	content:'';
	border-left: 5px solid transparent;
	border-right: 5px solid transparent;
	border-bottom: 5px solid #1a1a1a;	
	position:absolute;
	top:30px;
	left:35px;
	z-index:8;
	font-size:0;
	line-height:0;
	width:0;
	height:0;
}
[data-tip]:after {
	display:none;
	content:attr(data-tip);
	position:absolute;
	top:35px;
	left:0px;
	padding:5px 8px;
	background:#1a1a1a;
	color:#fff;
	z-index:9;
	font-size: 0.9em;
	height:18px;
	line-height:18px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	white-space:nowrap;
	word-wrap:normal;
}
[data-tip]:hover:before,
[data-tip]:hover:after {
	display:block;
}
</style>

</head>
<body>

<form class="myForm" method="post" enctype="application/x-www-form-urlencoded" action="<?php echo base_url();?>add_campaign/addCampaign" target="_self">
<h1>Add Campaign</h1><br/>

<p>
<label>Name of Campaign
	<!-- <q style="width:30em" data-tip="Only $-_.+!*'()[]& are allowed"> -->
<!-- <input type="text" name="c_name" pattern="^[A-Za-z0-9 _$-_.+!*()]*[A-Za-z0-9][A-Za-z0-9 _$-_.+!*()]*$" title="Only $-_.+!*'()[]& are allowed" value="<?php echo $this->session->userdata('c_name')?>" required> -->
<input type="text" name="c_name" pattern="[^'\x22@`~#%^{}=|\x5c?/,<>:;]+" title="Only $-_.+!*'()[]& are allowed" value="<?php echo $this->session->userdata('c_name')?>" required>
</label>
<h1 id="c_name" style="display: none"><?php echo $this->session->userdata('c_name')?></h1>
</p><br/>

<p>
<label>Keywords to use for Search
<input type="text" name="keywords" value="<?php echo $this->session->userdata('keywords')?>" required>
</label>
<h1 id="keywords" style="display: none"><?php echo $this->session->userdata('keywords')?></h1>
</p><br/>

<p>
<label>Site Url
<input type="url" name="site_url" value="<?php echo $this->session->userdata('site_url')?>" required>
</label>
<h1 id="site_url" style="display: none"><?php echo $this->session->userdata('site_url')?></h1>
</p><br/>

<p>
<label>Page Title to search for in Results
<input type="text" name="page_title" value="<?php echo $this->session->userdata('page_title')?>" required>
</label>
<h1 id="page_title" style="display: none"><?php echo $this->session->userdata('page_title')?></h1>
</p><br/>

<p>
<label>URL of Verification Site
<input type="url" name="v_url" value="<?php echo $this->session->userdata('v_url')?>" required>
</label> 
<h1 id="v_url" style="display: none"><?php echo $this->session->userdata('v_url')?></h1>
</p><br/>

<p>
<label>Name of Verification Page
<input type="text" name="v_page_name" value="<?php echo $this->session->userdata('v_page_name')?>" required>
</label> 
<h1 id="v_page_name" style="display: none"><?php echo $this->session->userdata('v_page_name')?></h1>
</p><br/>

<p>
<label>Target Location

<select id="select_location" name="target_location">
	<?php

		$location = ["United States", "Canada", "Australia"];
		foreach ($location as $key => $value) {
		 	echo '<option ';

			if($this->session->userdata('target_location') == $value) {
	 			echo 'selected';
	 		} else{
	 			if($defaults[0]->default_target_location == $value) {
	 				echo 'selected';
	 			}
	 		}
		 	echo '>'.$value.'</option>';
		}
	?>
</select>
</label>
</p><br/>

<p>
<label>Bid
<input type="number" step="0.01" min="0.06" name="bid" value="<?php if($this->session->userdata('bid')) echo $this->session->userdata('bid'); else echo $defaults[0]->default_bid;?>" required>
</label>
</p><br/>

<p>
<label>Speed
<input type="number" name="speed" value="<?php if($this->session->userdata('speed')) echo $this->session->userdata('speed'); else echo $defaults[0]->default_speed;?>" min="1" max="1000" required>
</label>
</p><br/>

<p>
<label>Positions
<input type="number" name="positions" min="30" max="1000" value="<?php if($this->session->userdata('positions')) echo $this->session->userdata('positions'); else echo $defaults[0]->default_positions;?>" required>
<h1 id="positions" style="display: none"><?php echo $this->session->userdata('positions')?></h1>
</label> 
</p><br/>

<p>
<label>Target per day
<input type="number" name="target_per_day" min="1" max="1000" value="<?php if($this->session->userdata('target_per_day')) echo $this->session->userdata('target_per_day'); else echo $defaults[0]->default_target_per_day;?>" required>
</label> 
<h1 id="target_per_day" style="display: none"><?php echo $this->session->userdata('target_per_day')?></h1>
</p><br/>

<p>
<label style="float: left; margin-left:11em" class="radio-inline">Select Search Engine
	<?php
		echo "<input style='width:3em; float:initial;' type='radio' name='search_engine' value='google' ";
		if($this->session->userdata('search_engine') == 'google') echo "checked";
		echo ">Google";
	?>
</label> 
<label style="float: left" class="radio-inline">
	<?php
		echo "<input style='width:3em; float:initial;' type='radio' name='search_engine' value='yahoo' ";
		if($this->session->userdata('search_engine') == 'yahoo') echo "checked";
		echo ">Yahoo"; 
	?>
</label> 
<label style="float: left" class="radio-inline">
	<?php
		echo "<input style='width:3em; float:initial;' type='radio' name='search_engine' value='bing' ";
		if($this->session->userdata('search_engine') == 'bing') echo "checked";
		echo ">Bing"; 
	?>
</label>
</p><br/><br>



<p style="display: none">
<label>client name
<input type="text" name="client" value="<?php echo $client;?>" required>
</label> 
</p>

<p><button style="float: right; margin-left: 10px">Submit</button></p>

</form>


</body>
</html>
<script type="text/javascript">
</script>