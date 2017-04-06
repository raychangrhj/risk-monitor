<?php 
	$this->load->view('common/header');
	$this->load->view('common/sidebar');
	$this->load->library('profile/profile_lib');
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Transaction History</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Date</th>
							<th>Time</th>
							<th>Admin</th>
							<th>Credits</th>
						</tr>
					</thead>
					<tbody>
						<?php
						for($i=0; $i<count($transaction_history); $i++){
						?>
						<tr>
							<td><?php echo $transaction_history[$i]->date ?></td>
							<td><?php echo $transaction_history[$i]->time ?></td>
							<td><?php echo $transaction_history[$i]->admin_name ?></td>
							<td><?php echo $transaction_history[$i]->credits ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('common/footer'); ?>
