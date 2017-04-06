	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<li class="sidebar-search">
					<div class="input-group custom-search-form">
						<input type="text" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
				</li>
				<!----------------------- Amb ------------------------------------------>
				<?php if($this->session->userdata('user_type') == $this->config->item('user_level_amb')){ ?>
				<li>
					<a href="#"><i class="fa fa-sitemap fa-fw"></i>Manage User<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('amb_path'); ?>manage_company">Manage Company</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('amb_path'); ?>add_super_admin">Add Super Admin</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('amb_path'); ?>active_inactive">Active/DeActive</a></li>
					</ul>
				</li>
				<?php } ?>
				<!----------------------- SuperAdmin ------------------------------------------>
				<?php if($this->session->userdata('user_type') == $this->config->item('user_level_super_admin')){ ?>
				<li>
					<a href="#"><i class="fa fa-sitemap fa-fw"></i>Manage User<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('super_admin_path'); ?>manage_company">Manage Company</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('super_admin_path'); ?>add_admin">Add Admin</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('super_admin_path'); ?>active_inactive">Active/DeActive</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('super_admin_path'); ?>transaction_history">Transaction History</a></li>
					</ul>
				</li>
				<?php } ?>
				<!----------------------- Admin --------------------------------------->
				<?php if($this->session->userdata('user_type') == $this->config->item('user_level_admin')){ ?>
				<li>
					<a href="#"><i class="fa fa-sitemap fa-fw"></i>Manage User<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('admin_path'); ?>manage_company">Manage Company</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('admin_path'); ?>add_sub_admin_user">Add SubAdmin/User</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('admin_path'); ?>active_inactive">Active/DeActive</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('admin_path'); ?>exchange_user">Exchange User</a></li>
					</ul>
				</li>
				<li>
					<a href="#"><i class="fa fa-sitemap fa-fw"></i>Manage PDF<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('avatar_path'); ?>add_avatar">Upload PDF</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('avatar_path'); ?>download_avatar">Download PDF</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('avatar_path'); ?>view_avatar">View Data</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('avatar_path'); ?>delete_avatar">Delete Data</a></li>
					</ul>
				</li>
				<?php } ?>
				<!----------------------- SubAdmin --------------------------------------->
				<?php if($this->session->userdata('user_type') == $this->config->item('user_level_sub_admin')){ ?>
				<li>
					<a href="#"><i class="fa fa-sitemap fa-fw"></i>Manage User<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('sub_admin_path'); ?>manage_company">Manage Company</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('sub_admin_path'); ?>add_user">Add User</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('sub_admin_path'); ?>active_inactive">Active/DeActive</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('sub_admin_path'); ?>exchange_user">Exchange User</a></li>
					</ul>
				</li>
				<li>
					<a href="#"><i class="fa fa-sitemap fa-fw"></i>Manage PDF<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('avatar_path'); ?>add_avatar">Upload PDF</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('avatar_path'); ?>download_avatar">Download PDF</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('avatar_path'); ?>view_avatar">View Data</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('avatar_path'); ?>delete_avatar">Delete Data</a></li>
					</ul>
				</li>
				<?php } ?>
				<!----------------------- User --------------------------------------->
				<?php if($this->session->userdata('user_type') == $this->config->item('user_level_user')){ ?>
				<li>
					<a href="#"><i class="fa fa-sitemap fa-fw"></i>Manage PDF<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('avatar_path'); ?>download_avatar">Download PDF</a></li>
						<li><a href="<?php echo base_url(); ?><?php echo $this->config->item('avatar_path'); ?>view_avatar">View Data</a></li>
					</ul>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>