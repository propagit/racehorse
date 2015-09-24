<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Race Horse - Admin</title>

<!-- Bootstrap -->
<link href="<?php echo base_url(); ?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<!-- Font Awesome -->
<link href="<?php echo base_url();?>components/fortawesome/font-awesome/v4.4.0/css/font-awesome.css" rel="stylesheet" type="text/css">
<!-- app admin css -->
<link rel="stylesheet" href="<?=base_url();?>assets/css/app.admin.min.css" rel="stylesheet" type="text/css">


<!-- jquery for bootstrap -->
<script src="<?php echo base_url();?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo base_url();?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</head>

<body>


	<div class="container login-block">
    	<div class="row">
        	<div class="col-xs-12">
            	<form method="post" action="<?=base_url()?>admin/auth/validate">
                    <div class="form-group">
                      <input placeholder="Username" type="text" class="form-control" name="username">
                    </div>
                    
                    <div class="form-group">
                      <input placeholder="Password" type="password" class="form-control" name="password">
                    </div>
                    
                    <div class="form-group">
                      <button type="submit" class="btn btn-success pull">Login</button>
                    </div>
                </form>
            </div>
        </div>
    	
    </div>

</body>
</html>