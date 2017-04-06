<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Risk Monitor Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>application/modules/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>application/modules/assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>application/modules/assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>application/modules/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>application/modules/assets/dist/css/customcss.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                 	<?php if($this->session->flashdata('sucess_message')) { ?>
                    	<div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('sucess_message'); ?>
                    	</div>
                    <?php } ?>
                    <?php if($this->session->flashdata('error_msg')) { ?>
                    	<div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('error_msg'); ?>
                    	</div>
                    <?php } ?>
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo base_url(); ?><?php echo $this->config->item('login_path'); ?>login/login_verify">
							<div class="form-group">
								<label for="username">User Name <span class="text-danger">*</span></label>
								<input class="form-control" id="username" placeholder="Enter User Name" name="user_name" maxlength="20" required value="<?php echo set_value('user_name');?><?php echo $this->session->flashdata('username'); ?>" type="text" />
								<div class="help-block form-error"><?php echo form_error('user_name'); ?></div>
							</div>
							<div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input class="form-control" id="password" placeholder="Enter Password" name="password" required type="password" maxlength="20" value="" />
                                <div class="help-block form-error"><?php echo form_error('password'); ?></div>
							</div>
							<button type="submit" class="btn btn-lg btn-success btn-block">Sign In</button>
							<?php if($this->session->flashdata('login_error')) { ?>
								<p class="help-block form-error"><?php echo $this->session->flashdata('login_error'); ?></p>
							<?php } ?>
							<div class="navbar-header">
								<center><a href="#">Forgot password </a></center>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>application/modules/assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>application/modules/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>application/modules/assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>application/modules/assets/dist/js/sb-admin-2.js"></script>

</body>

</html>
