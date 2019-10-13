<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/style_change_defaults.css">
<title></title>

</head>
<body>

<form class="myForm" method="post" enctype="application/x-www-form-urlencoded" action="change_defaults/saveDefaults/<?php echo $defaults[0]->id;?>" target="_self">
<h1>Change Defaults</h1><br>

<p>
<label>Default Text1
<textarea name="default_text1" maxlength="500">
<?php echo $defaults[0]->default_text1;?>
</textarea>
</label>
</p><br><br><br>

<p>
<label>Default Text2
<textarea name="default_text2" maxlength="500">
<?php echo $defaults[0]->default_text2;?>
</textarea>
</label>
</p><br><br><br>

<p>
<label>Default Employee Password
<input type="text" name="default_employee_password" value="<?php echo $defaults[0]->default_employee_password;?>" required>
</label> 
</p>

<p>
<label>Default Target Location
<select id="select_location" name="default_target_location">
	<?php
		$location = ["United States", "Canada", "Australia"];
		foreach ($location as $key => $value) {
		 	echo '<option ';
		 	if($defaults[0]->default_target_location == $value) {
		 		echo 'selected';
		 	}
		 	echo '>'.$value.'</option>';
		 }

	?>
</select>
</label> 
</p>

<p>
<label>Default Bid
<input type="number" name="default_bid" step="0.01" min="0.06" value="<?php echo $defaults[0]->default_bid;?>" required>
</label> 
</p>

<p>
<label>Default Speed
<input type="number" name="default_speed" min="1" max="1000" value="<?php echo $defaults[0]->default_speed;?>" required>
</label> 
</p>

<p>
<label>Default Positions
<input type="number" name="default_positions" min="30" max="1000" value="<?php echo $defaults[0]->default_positions;?>" required>
</label> 
</p>

<p>
<label>Default Target per day
<input type="number" name="default_target_per_day" value="<?php echo $defaults[0]->default_target_per_day;?>" required>
</label> 
</p>

<p><button style="float:right">Submit</button></p>

</form>

</body>
</html>