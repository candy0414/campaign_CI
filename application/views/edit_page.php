<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/css/semantic.min.css"/> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/style_change_defaults.css">
<!-- <script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo base_url();?>assets/js/semantic.min.js"></script> -->
<title></title>
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

<form class="myForm" method="post" enctype="application/x-www-form-urlencoded" action="<?php echo base_url();?>edit/saveCampaign/<?php echo $campaign[0]->id;?>" target="_self">
<h1>Edit Campaign</h1><br/>

<p>
<label>Name of Campaign
	<!-- <q style="width:30em" data-tip="Only $-_.+!*'()[]& are allowed"> -->
<input type="text" name="c_name" pattern="[^'\x22@`~#%^{}=|\x5c?/,<>:;]+" title="Only $-_.+!*'()[]& are allowed" value="<?php echo $campaign[0]->c_name?>" required>
</label></q>
</p><br/>

<p>
<label>Keywords to use for Search
<input type="text" name="keywords" value="<?php echo $campaign[0]->keywords?>" required>
</label> 
</p><br/>

<p>
<label>Site Url
<input type="url" name="site_url" value="<?php echo $campaign[0]->site_url?>" required>
</label>
</p><br/>

<p>
<label>Page Title to search for in Results
<input type="text" name="page_title" value="<?php echo $campaign[0]->page_title?>" required>
</label> 
</p><br/>

<p>
<label>URL of Verification Site
<input type="url" name="v_url" value="<?php echo $campaign[0]->v_url?>" required>
</label> 
</p><br/>

<p>
<label>Name of Verification Page
<input type="text" name="v_page_name" value="<?php echo $campaign[0]->v_page_name?>" required>
</label> 
</p><br/>

<p>
<label>Target Location
<select id="select_location" name="target_location" disabled>
	<?php
		$location = ["United States", "Canada", "Australia"];
		foreach ($location as $key => $value) {
		 	echo '<option ';
		 	if($campaign[0]->target_location == $value) {
		 		echo 'selected';
		 	}
		 	echo '>'.$value.'</option>';
		 }

	?>
</select>
</label> 
</p><br/>

<p>
<label>Bid
<input type="number" step="0.01" min="0.06" name="bid" value="<?php echo $campaign[0]->bid?>" required>
</label> 
</p><br/>

<p>
<label>Speed
<input type="number" name="speed" min="1" max="1000" value="<?php echo $campaign[0]->speed?>" required>
</label> 
</p><br/>

<p>
<label>Positions
<input type="number" name="positions" min="30" max="1000" value="<?php echo $campaign[0]->positions?>" required>
</label> 
</p><br/>

<p>
<label>Target per day
<input type="number" name="target_per_day" min="1" max="1000" value="<?php echo $campaign[0]->target_per_day?>" required>
</label> 
</p><br/>

<p>
<label style="float: left; margin-left:11em" class="radio-inline">Select Search Engine
	<?php
		echo "<input style='width:3em; float:initial;' type='radio' name='search_engine' value='google' ";
		if($campaign[0]->search_engine == 'google') echo "checked";
		echo ">Google";
	?>
</label> 
<label style="float: left" class="radio-inline">
	<?php
		echo "<input style='width:3em; float:initial;' type='radio' name='search_engine' value='yahoo' ";
		if($campaign[0]->search_engine == 'yahoo') echo "checked";
		echo ">Yahoo"; 
	?>
</label> 
<label style="float: left" class="radio-inline">
	<?php
		echo "<input style='width:3em; float:initial;' type='radio' name='search_engine' value='bing' ";
		if($campaign[0]->search_engine == 'bing') echo "checked";
		echo ">Bing"; 
	?>
</label>
</p><br/><br>




<p style="display: none">
<label>client name
<input type="text" name="client" value="<?php echo $campaign[0]->client;?>" required>
</label> 
</p>

<p><a href="/view_campaign"><button style="float: right">Submit</button></a></p>

</form>

<div class="myForm" style="margin-top: -85px">
	<a href="<?php echo base_url();?>edit/copy"><button style="float:right; margin-right:-180px" id="copy">New Campaign</button></a>
</div>

</body>
</html>