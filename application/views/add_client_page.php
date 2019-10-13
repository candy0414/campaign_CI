<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title></title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style_add_client.css"/>
    <script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/add_client_action.js"></script>

</head>
<body>
    <div  style="width: 40%; margin:auto;">
    <a href="client_management" style="float: right"><button>Back</button></a>
</div>
    <form action="<?php echo base_url();?>add_client/add_client" method="post" target="_self">
        <h1>ADD CLIENT</h1>
        <label>
        <p class="label-txt">CLIENT EMAIL</p>
        <input type="email" class="input" name="email" required>
        <div class="line-box">
          <div class="line"></div>
        </div>
        </label>
        <label>
        <p class="label-txt">CLIENT NAME</p>
        <input type="text" class="input" name="name" pattern="^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$" required>
        <div class="line-box">
          <div class="line"></div>
        </div>
        </label>

        <button type="submit">submit</button>
        
    </form>
</body>
</html>
