<!DOCTYPE html>
<html>

<head>
    <title>Training Management System</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/login.css');?>"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
       <!--<div id="logo" align="center"><img src="<?php echo base_url();?>public/images/logo.png" style="width: 100px;"></div>-->

	<div id="login">
		<?php echo form_open('login') ?>
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
</body>

</html>