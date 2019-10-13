<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/style_change_defaults.css">
<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/view_campaign_action.js"></script>
<title></title>

</head>
<body>

<form class="myForm" style="margin-bottom: 0px" enctype="application/x-www-form-urlencoded">
<h1>View Campaign</h1><br>
<p>
<label>Campaign Name
<input type="text" name="c_name" value="<?php echo $campaign[0]->c_name;?>">
</label> 
</p><br/>

<p>
<label>Employee URL
<input type="text" name="employee_url" value="<?php echo base_url();?><?php echo $campaign[0]->employee_url;?>/login">
</label> 
</p><br/>

<p>
<input type="text" name="employee_url" value="<?php echo base_url();?><?php echo $campaign[0]->employee_url;?>/login" style="display: none;">
<label>Default Text1
<textarea name="defaultText1" maxlength="500">
<?php
// echo "1.".base_url().$campaign[0]->employee_url."/login&#13;&#10;";
// echo "2. Enter the password ".$defaults[0]->default_employee_password."&#13;&#10;";
// echo "3. Follow the instructions on screen for the search keyword displayed&#13;&#10;";
// echo "Note:Make sure pop-up blokcer is off.&#13;&#10;";
// echo "4.A code will appear when you have completed the search, this is the proof needed for a successful job.";
echo $defaults[0]->default_text1;
?>
</textarea>
</label>
</p><br><br><br><br><br>

<p>
<label>Default Text2
<textarea name="defaultText2" maxlength="500">
<?php
echo $defaults[0]->default_text2;
?>
</textarea>
</label>
</p><br><br><br><br>

<p>
<label>Default Employee Password
<input type="text" name="defaultEmployeePassword" value="<?php echo $defaults[0]->default_employee_password;?>">
</label> 
</p>

</form>

<div class="myForm" style="margin-top: 0px">
	<a href="edit"><button style="float:right; margin-left:10px">Edit</button></a>
	<a href="../campaigns"><button style="float:right; margin-left: 50px">Back</button></a>
</div>



</body>
</html>