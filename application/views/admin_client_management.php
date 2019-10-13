<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title></title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/semantic.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style_client_management.css"/>
    <script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
    <!-- <script src="assets/js/bootstrap.min.js"></script> -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/semantic.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/client_action.js"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4" style="padding-top:10px">
                <h4 style="text-align: center">Select Client</h4>
            </div>
            <div class="col-md-4" style="text-align: center">
                <select id="select_client" name="select_client" class="ui fluid search dropdown">
                    <option value="">select client</option>
                    <?php
                        for($i = 0; $i < sizeof($clients) ; $i++) {
                            $row = $clients[$i];
                            echo "<option value='".$row->name."'>".$row->name."</option>";
                        }
                    ?>
                </select>
            </div>
            <center class="col-md-4">
                <button id="manage_campaign" class="" style="padding: 7px">Manage Campaigns</button>
            </center>
        </div>
        <div class="row" style="margin-top:100px">
            <center class="col-md-4">
                <a href="add_client"><button id="add_client" class="" style="padding: 7px; color: black;">Add Client</button></a>
            </center>
            <center class="col-md-4">
                <button id="delete_client" class="" style="padding: 7px; color: black;">Delete Client</button>
            </center>
            <center class="col-md-4">
                <a href="change_defaults"><button class="" style="padding: 7px; color: black">Change Defaults</button></a>
            </center>
        </div>
    </div>
</body>
</html>
