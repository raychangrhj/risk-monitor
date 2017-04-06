$(document).ready(function() {
	$(function() {
		$('.active_de').bootstrapToggle({
		  on: 'Active',
		  off: 'DeActive',
		  size: 'large',
		  height: 18,
		  width: 70,
		});
	});
	$('.active_de').change(function(){
	var thiss = $(this);
	var reseller_id = $(this).attr('data-id');
	var base_url = $('#baseurl').val();
	if(this.checked) 
	{
		var status = 1;
		var msgtxt = "You are going to Active the reseller";
	}
	else{
		var status = 0;
		var msgtxt = "You are going to DeActive the reseller";
	}
	
	swal({
		title: "Are you sure?",
		text: msgtxt,
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#DD6B55',
		confirmButtonText: 'Yes!',
		cancelButtonText: "No",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm){
    if (isConfirm){
		$.ajax({
			type: "POST",
			url: base_url+"reseller/change_reseller_status",
			data: "reseller_id="+reseller_id+"&status="+status,
			//dataType: "json",
			success: function(msg)
				{	
					if(msg==1)
					{
						swal("Success", "Status has been changed!", "success");
					}
					else{
						swal("Oops...", "Something went wrong!", "error");
					}
				}
			});
      
    } else {
		if(status == 0){
			$(thiss).prop('checked', true).change();
		}
		else{
			$(thiss).prop('checked', false).change();
		}
      	swal("Cancelled", "You have cancelled the opretaion", "error");
    }
	});	
    });
	
	$('#resellermail').blur(function() {
		var email = $(this).val();
		if(email == ''){
			return false;	
		}
		$('.email_exists_loader').show();
		var level_id = $('#level_id').val();
		var base_url = $('#baseurl').val();
		var user_id = $('#user_id').val();
		
		$.ajax({
			type: "POST",
			url: base_url+"reseller/check_email_exists",
			data: "level_id="+level_id+"&email="+email+"&user_id="+user_id,
			//dataType: "json",
			success: function(msg)
				{	
					if(msg==1)
					{
						$('#resellermail').after('<span class="help-block form-error">Email Already Exists.</span>');
						$('.email_exists_loader').hide();
					}
					else{
						$('.email_exists_loader').hide();
					}
				}
			});
	});
	$('.deletereseller').click(function(){
	var reseller_id = $(this).attr('data-id');
	var redirect_bit = $(this).attr('data-redirect');
	
	var base_url = $('#baseurl').val();
	
	swal({
		title: "Are you sure?",
		text: "You will not be able to recover!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#DD6B55',
		confirmButtonText: 'Yes, delete it!',
		cancelButtonText: "No, cancel plx!",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm){
    if (isConfirm){
			$.ajax({
			type: "POST",
			url: base_url+"reseller/delete_reseller",
			data: "reseller_id="+reseller_id,
			//dataType: "json",
			success: function(msg)
				{	
					if(msg==1)
					{
						if(redirect_bit == 1){
							swal("Deleted!", "Reseller has been deleted!", "success");
							setTimeout(function(){
							  window.location.replace(base_url+"reseller/active_resellers");
							}, 2000);

							
						}
						else
						{
							$( "#row-"+reseller_id ).fadeOut( "slow", function() {
								swal("Deleted!", "Reseller has been deleted!", "success");
							});
						}
						
					}
					else{
						swal("Oops...", "Something went wrong!", "error");
					}
				}
			});
      
    } else {
      swal("Cancelled", "Reseller has not been deleted!", "error");
    }
	});});
	$('#generatepass').click(function(){
	var inputfieldid = $(this).attr('data-input-id');
	var base_url = $('#baseurl').val();
		$.ajax({
		type: "POST",
		url: base_url+"reseller/generate_pass",
		//data: "reseller_id="+reseller_id+"&status="+status_bit,
		//dataType: "json",
		success: function(msg)
			{	
				$('#'+inputfieldid).val(msg);
				//$(function($) {$('#password').pwstrength(); });
				$('#pwindicator').addClass('pw-very-strong');
				$('#pwindicator .label').html('Very Strong');
				//$('#confirmpassword').val(msg);
			}
		});
	});
	$('#generate_primary_id').click(function(){
		var base_url = $('#baseurl').val();
		$.ajax({
		type: "POST",
		url: base_url+"reseller/generate_primary_id",
		//data: "reseller_id="+reseller_id+"&status="+status_bit,
		//dataType: "json",
		success: function(msg)
			{	
				$("input[name=oa_id]").val(msg);
				
			}
		});
	});
	$('#general_info_id').click(function(){
		var base_url = $('#baseurl').val();
		$.ajax({
		type: "POST",
		url: base_url+"reseller/generate_general_id",
		//data: "reseller_id="+reseller_id+"&status="+status_bit,
		//dataType: "json",
		success: function(msg)
			{	
				$("input[name=gi_id]").val(msg);
				
			}
		});
	});
	$('#invoice_email').click(function(){
		var ischeck = $(this).is(":checked")
		if(ischeck == true){
			$('#invoice_email_field').removeAttr('disabled','disabled');
		}
		else{
			$('#invoice_email_field').prop('disabled','disabled');
		}
		
	});
	$('#sameas').click(function(){
		var ischeck = $(this).is(":checked")
		if(ischeck == true){
			general_email = $("input[name=gi_email]").val();
			general_phone = $("input[name=gi_phone]").val();
			general_address = $("textarea[name=gi_address]").val();
			$("input[name=bi_email]").val(general_email);
			$("input[name=bi_phone]").val(general_phone);
			$("textarea[name=bi_address]").val(general_address);
		}
		else{
			general_email = $("input[name=gi_email]").val();
			general_phone = $("input[name=gi_phone]").val();
			general_address = $("textarea[name=gi_address]").val();
			
			billing_email = $("input[name=bi_email]").val();
			billing_phone = $("input[name=bi_phone]").val();
			billing_address = $("textarea[name=bi_address]").val();
			if(general_email == billing_email){
				$("input[name=bi_email]").val('');
			}
			if(general_phone == billing_phone){
				$("input[name=bi_phone]").val('');
			}
			if(general_address == billing_address){
				$("textarea[name=bi_address]").val('');
			}
			
		}
		
	});
	$('.btn-approve-reseller').click(function(){
	var reseller_id = $(this).attr('data-id');
	var status_bit = $(this).attr('data-bit');
	var delete_row_bit = $(this).attr('data-deleterow');
	var base_url = $('#baseurl').val();
	
	swal({
		title: "Are you sure?",
		text: "You are going to Approve Reseller!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#DD6B55',
		confirmButtonText: 'Yes, Approve it!',
		cancelButtonText: "No, cancel plx!",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm){
    if (isConfirm){
			$.ajax({
			type: "POST",
			url: base_url+"reseller/change_reseller_status",
			data: "reseller_id="+reseller_id+"&status="+status_bit,
			//dataType: "json",
			success: function(msg)
				{	
					if(msg==1)
					{
						if(delete_row_bit == 0){
							$( ".btn-approve-reseller" ).fadeOut( "slow");
							$( ".btn-reject-reseller" ).fadeOut( "slow");
							swal("Approved!", "Reseller has been Approved!", "success");
						}else{
							$( "#row-"+reseller_id ).fadeOut( "slow", function() {
								swal("Approved!", "Reseller has been Approved!", "success");
							});
						}
					}
					else{
						swal("Oops...", "Something went wrong!", "error");
					}
				}
			});
      
    } else {
      swal("Cancelled", "Reseller has not been Approved!", "error");
    }
	});});
	$('.btn-reject-reseller').click(function(){
	var reseller_id = $(this).attr('data-id');
	var status_bit = $(this).attr('data-bit');
	var delete_row_bit = $(this).attr('data-deleterow');
	var base_url = $('#baseurl').val();
	
	swal({
		title: "Are you sure?",
		text: "You are going to Reject Reseller!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#DD6B55',
		confirmButtonText: 'Yes, Reject it!',
		cancelButtonText: "No, cancel plx!",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm){
    if (isConfirm){
			$.ajax({
			type: "POST",
			url: base_url+"reseller/change_reseller_status",
			data: "reseller_id="+reseller_id+"&status="+status_bit,
			//dataType: "json",
			success: function(msg)
				{	
					if(msg==1)
					{
						if(delete_row_bit == 0){
							$( ".btn-approve-reseller" ).fadeOut( "slow");
							$( ".btn-reject-reseller" ).fadeOut( "slow");
							swal("Approved!", "Reseller has been Approved!", "success");
						}else{
							$( "#row-"+reseller_id ).fadeOut( "slow", function() {
								swal("Approved!", "Reseller has been Rejected!", "success");
							});
						}
					}
					else{
						swal("Oops...", "Something went wrong!", "error");
					}
				}
			});
      
    } else {
      swal("Cancelled", "Reseller has not been Rejected!", "error");
    }
	});});
});

