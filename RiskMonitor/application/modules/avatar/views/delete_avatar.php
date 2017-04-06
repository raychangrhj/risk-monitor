<?php
require_once "parser/parser.php";
$this->load->view('common/header');
$this->load->view('common/sidebar');
$parser=new Parser();
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Delete Avatar</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default" />
			<div class="panel-heading" style="overflow-y:scroll;">
				Avatar Contents
				<input type='hidden' id='base_url' value="<?php echo base_url(); ?>" />
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>PDF File Name</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$user_type=$this->session->userdata('user_type');
						switch($user_type)
						{
							case $this->config->item('user_level_admin'):
								$list=$parser->getListByAdmin($this->session->userdata('user_id'));break;
							case $this->config->item('user_level_sub_admin'):
								$list=$parser->getListBySubAdmin($this->session->userdata('user_id'));break;
							case $this->config->item('user_level_user'):
								$list=$parser->getListByCompany($this->session->userdata('company_id'));break;
						}
						for($i=0;$i<count($list);$i++){
						?>
						<tr id="table_row_<?php echo $i; ?>">
							<td>
								<button class="delete_pdf" row_no="<?php echo $i; ?>" file_name="<?php echo $list[$i]; ?>" >
									<a class="deleteicon deletecompany"><i class="fa fa-times"></i></a>
								</button>
								<?php echo $list[$i]; ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php
	$this->load->view('common/footer');
?>
