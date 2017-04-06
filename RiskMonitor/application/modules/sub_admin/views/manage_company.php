<?php 
	$this->load->view('common/header');
	$this->load->view('common/sidebar');
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Manage Company</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
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
			<div class="panel panel-default">
				<div class="panel-heading">Companies are Shown Below</div>
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<input type='hidden' id='base_url' value="<?php echo base_url(); ?>" />
						<input type='hidden' id='user_type' value="<?php echo $this->session->userdata('user_type'); ?>" />
						<table class="table table-striped table-bordered table-hover">
							<button class='add_company'>Add New Company</button>
							<thead>
								<tr>
									<th>Company Name</th>
									<th>Address</th>
									<th width="100">VAT</th>
									<th width="80">ZipCode</th>
									<th width="150">Website</th>
									<th width="100" />
								</tr>
							</thead>
							<tbody>
								<?php
								$company_list=$this->session->userdata('company_list');
								for($i=0; $i<count($company_list); $i++){
								?>
								<tr id="table_row_<?php echo $i; ?>">
									<td><div id="company_name_<?php echo $company_list[$i]->id; ?>"><?php echo $company_list[$i]->company_name; ?></div></td>
									<td><div id="address_<?php echo $company_list[$i]->id; ?>"><?php echo $company_list[$i]->address; ?></div></td>
									<td><div id="vat_<?php echo $company_list[$i]->id; ?>"><?php echo $company_list[$i]->vat; ?></div></td>
									<td><div id="zip_code_<?php echo $company_list[$i]->id; ?>"><?php echo $company_list[$i]->zip_code; ?></div></td>
									<td><div id="website_<?php echo $company_list[$i]->id; ?>"><?php echo $company_list[$i]->website; ?></div></td>
									<td class="right">
										<button class="update_company" data-id="<?php echo $company_list[$i]->id; ?>" >
											<a><i class="fa fa-pencil-square-o"></i></a>
										</button>
										<button class="delete_company" data-id="<?php echo $company_list[$i]->id; ?>" row_no="<?php echo $i; ?>" >
											<a class="deleteicon deletecompany"><i class="fa fa-times"></i></a>
										</button>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('common/footer'); ?>
