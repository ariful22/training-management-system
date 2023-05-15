
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Dashboard - TMS</title>



	<?php include 'includes_top.php';?>

</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="<?php echo base_url("dashboard")?>"><b>TMS</b></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?php echo base_url("dashboard")?>">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Student Database</span>
          </a>
        </li>
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Students">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMember" data-parent="#exampleAccordion">
            <i class="fa fa-users"></i>
            <span class="nav-link-text">Add / Edit</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMember">
            <li>
              <a href="<?php echo base_url("Batch")?>">Batch Name</a>
            </li>
			<li>
              <a href="<?php echo base_url("courses")?>">Course Name</a>
            </li>
			<li>
              <a href="<?php echo base_url("students")?>">Student Info</a>
            </li>
			<li>
              <a href="<?php echo base_url("Finance")?>">Account Info</a>
            </li>
			<li>
              <a href="<?php echo base_url("trainer")?>">Trainer List</a>
            </li>
			<li>
              <a href="<?php echo base_url("admin/income")?>">Payment Info</a>
            </li>
			<li>
              <a href="<?php echo base_url("admin/teacher_payment")?>">Teacher Payment</a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
    </nav>


	<?php include $page_name.'.php';?>
    <?php include 'modal.php';?>
    <?php include 'includes_bottom.php';?>

</body>
</html>
