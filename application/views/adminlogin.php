<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="description" content="cv">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1">

    <base target="_blank">

    <title></title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/style.css"/>
    <script src="<?php echo base_url();?>/assets/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url();?>/assets/js/bootstrap.js"></script>
    <!-- <script src="assets/js/bootstrap.min.js"></script> -->
    
    <style>
    </style>
</head>

<body>

    <div class="container">
        <br/>
        <br/>
        <br/>
        <br/>
        <center><b id="login-name">ADMIN LOGIN</b></center>
        
        <div class="row">       
            <div class="col-md-6 col-md-offset-3" id="login">
                <?php if(! is_null($msg)) echo $msg;?>
                <form action = "<?php echo base_url();?>admin/process" method="post" target="_self">
                    <div class="form-group">
                        <label class="user"> UserName  </label>
                        <div class="input-group">
                            <span class="input-group-addon" id="iconn"> <i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" id="username" name="username" placeholder="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="user"> Password </label>
                        <div class="input-group">
                            <span class="input-group-addon" id="iconn1"> <i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder=" Enter Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="login" style="border-radius:0px;">
                        <input type="reset" class="btn btn-danger" value="reset" style="border-radius:0px;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>