<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TMS Login</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('public/css/bootstrap.min.css');?>" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="<?php echo base_url('public/css/login.css');?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:300,400,700" rel="stylesheet">  
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>

<body>
<div id="login">
		<h2 align="center">Admin Login</h2>
		<?php echo form_open('admin_login') ?>
			<div id="container">
				<div align="center" style="color:red"><?php echo validation_errors(); ?></div>
				
				<div id="login_form">
					<div class="input-group">
						<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-user"></span></span>
						<input class="form-control" placeholder="<?php echo $this->lang->line('login_username')?>" name="username" type="username" size=20 autofocus></input>
					</div>
					
					<div class="input-group">
						<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-lock"></span></span>
						<input class="form-control" placeholder="<?php echo $this->lang->line('login_password')?>" name="password" type="password" size=20></input>
					</div>
					
					<input class="btn btn-primary btn-block" type="submit" name="loginButton" value="Go"/>
				</div>
			</div>
		<?php echo form_close(); ?>
		
		<h1>Powered By Freelancerlab <?php //echo $this->config->item('application_version'); ?></h1>
	</div>
  

    
    <script type="text/javascript" src="<?php echo base_url('public/js/jquery-3.2.1.min.js');?>"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url('public/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="js/script.js"></script>
</body>

</html>
		
