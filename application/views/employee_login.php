<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="referrer" content="no-referrer" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/style_employee_login.css">
<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
<title></title>

</head>
<body>

<form class="myForm" method="post" enctype="application/x-www-form-urlencoded" action="../login/process/<?php echo $employee_url;?>" target="_self">
<h2>Enter your Task's Password as specified by the task:</h2><br>

<p>
<label>Password
<input type="password" name="password" value="" required>
</label>
</p>
<p><button style="float: right">Submit</button></p>
<input type="text" name="result" value="<?php echo $result;?>" style="display: none">
</form>

</body>
<script type="text/javascript">
	var result = $("input[name='result']").val();
	if(! result) {
		alert("This IP Address does not match the targeted geolocation for this campaign");
		$("input[name='password']").prop('disabled', true);
	}
</script>
</html>