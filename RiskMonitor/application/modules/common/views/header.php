<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RiskMonitor</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>application/modules/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>application/modules/assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="<?php echo base_url(); ?>application/modules/assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url(); ?>application/modules/assets/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="<?php echo base_url(); ?>application/modules/assets/dist/css/timeline.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>application/modules/assets/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url(); ?>application/modules/assets/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>application/modules/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>application/modules/assets/dist/css/customcss.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/modules/assets/dist/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/modules/assets/dist/css/bootstrap-select.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/modules/assets/dist/css/sweetalert.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/modules/assets/dist/css/bootstrap2-toggle.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/modules/assets/dist/css/passwordstrengthstyle.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/modules/assets/dist/css/bootstrap-multiselect.css" type="text/css">
	<!-- jQuery Sweet CSS -->
    <link href="<?php echo base_url(); ?>application/modules/assets/jquery.sweet-modal/css/jquery.sweet-modal.min.css" rel="stylesheet">
	<!--<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo base_url(); ?>">Welcome To The Technology Era</a>
				<div class="navbar-brand">
					<?php
					/*
					echo "user_type[" . $this->session->userdata('user_type') . "]";
					echo " , user_name[ " . $this->session->userdata('user_name') . "]";
					echo " , profile_access_type[ " . $this->session->userdata('profile_access_type') . "]";
					echo " , profile_setting_user_id[ " . $this->session->userdata('profile_setting_user_id') . "]";
					echo " , profile_setting_user_type[ " . $this->session->userdata('profile_setting_user_type') . "]";
					*/
					?>
				</div>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>
						<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url(); ?><?php echo $this->config->item('profile_path'); ?>view_profile"><i class="fa fa-user fa-fw"></i>User Profile</a></li>
                        <li><a href="#"><i class="fa fa-sign-out fa-fw"></i>Settings</a></li>
                        <li class="divider"></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('login_path'); ?>logout"><i class="fa fa-sign-out fa-fw"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>