<?php
require_once "parser/parser.php";
$this->load->view('common/header');
$this->load->view('common/sidebar');
$this->load->helper('download');
$parser=new Parser();
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Download Avatar</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
			<div class="panel-body" style="overflow-x:auto;">
				<?php
				if($file_name)
				{
					force_download($file_name, file_get_contents($this->config->item('uploads_url') . $file_name));
					$file_name=null;
				}
				?>
			</div>
			<div class="panel-heading" style="overflow-y:scroll;">
				Avatar Contents
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
					echo "<br><a href='" . base_url() . $this->config->item('avatar_path') . "download_avatar/" . $list[$i] . "'>" . $list[$i] . "</a>";
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php
	$this->load->view('common/footer');
?>
