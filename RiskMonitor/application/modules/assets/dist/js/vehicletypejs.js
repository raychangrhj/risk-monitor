$(document).ready(function() {
	$(function() {
		$('.active_de_vehicletype').bootstrapToggle({
		  on: 'Active',
		  off: 'DeActive',
		  size: 'large',
		  height: 18,
		  width: 70,
		});
	});
	$('.active_de_vehicletype').change(function(){
	var thiss = $(this);
	var type_id = $(this).attr('data-id');
	var base_url = $('#baseurl').val();
	if(this.checked) 
	{
		var status = 1;
		var msgtxt = "You are going to Active the Vehicle Type";
	}
	else{
		var status = 0;
		var msgtxt = "You are going to DeActive the Vehicle Type";
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
			url: base_url+"vehicletype/change_vehicletype_status",
			data: "type_id="+type_id+"&status="+status,
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
	
	$('#vehicletypemail').blur(function() {
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
			url: base_url+"vehicletype/check_email_exists",
			data: "level_id="+level_id+"&email="+email+"&user_id="+user_id,
			//dataType: "json",
			success: function(msg)
				{	
					if(msg==1)
					{
						$('#vehicletypemail').after('<span class="help-block form-error">Email Already Exists.</span>');
						$('.email_exists_loader').hide();
					}
					else{
						$('.email_exists_loader').hide();
					}
				}
			});
	});
	$('#individual_btn_vehicletype').click(function(){
		if($("#indi_check").is(':checked')){
		
			$(".associate_unio").removeClass('hide_associate_dropdown');
			$(".associate_unio").fadeIn();  // checked
		}else{
			$(".associate_unio").removeClass('hide_associate_dropdown');
			$(".associate_unio").fadeOut();  // unchecked
		}
		
	});
	$('.deletevehicletype').click(function(){
	var type_id = $(this).attr('data-id');
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
			url: base_url+"vehicletype/delete_vehicletype",
			data: "type_id="+type_id,
			//dataType: "json",
			success: function(msg)
				{	
					if(msg==1)
					{
						if(redirect_bit == 1){
							swal("Deleted!", "Booking Office has been deleted!", "success");
							setTimeout(function(){
							  window.location.replace(base_url+"vehicletype/manage_vehicletype");
							}, 2000);

							
						}
						else
						{
							$( "#row-"+type_id ).fadeOut( "slow", function() {
								swal("Deleted!", "Vehicle Type has been deleted!", "success");
							});
						}
						
					}
					else{
						swal("Oops...", "Something went wrong!", "error");
					}
				}
			});
      
    } else {
      swal("Cancelled", "Vehicle Type has not been deleted!", "error");
    }
	});});
	$('#generatepass_vehicletype').click(function(){
	var inputfieldid = $(this).attr('data-input-id');
	var base_url = $('#baseurl').val();
		$.ajax({
		type: "POST",
		url: base_url+"vehicletype/generate_pass",
		//data: "type_id="+type_id+"&status="+status_bit,
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
	$('#generate_primary_type_id').click(function(){
		var base_url = $('#baseurl').val();
		$.ajax({
		type: "POST",
		url: base_url+"vehicletype/generate_primary_id",
		//data: "type_id="+type_id+"&status="+status_bit,
		//dataType: "json",
		success: function(msg)
			{	
				$("input[name=oa_id]").val(msg);
				
			}
		});
	});
	$('#general_info_type_id').click(function(){
		var base_url = $('#baseurl').val();
		$.ajax({
		type: "POST",
		url: base_url+"vehicletype/generate_general_id",
		//data: "type_id="+type_id+"&status="+status_bit,
		//dataType: "json",
		success: function(msg)
			{	
				//alert(msg);
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
		
	
	
	$('#multiselect_comp').multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		maxHeight: 200,
		numberDisplayed: 10,
		onChange: function(element, checked) {
			var b = '';
			$("#multiselect_comp option:selected").each(function() {
				//alert($(this).text());
				b += '<ol>'+$(this).text()+'</ol>';
			});
			//alert(b);
			
			$('.selected_val').html(b);
	  
      }
	});
	
	
	//alert ('hello'); 
	$( ".avtar_val" ).change(function() {
		var avatar_id=$(this).val();
		var base_url = $('#baseurl').val();
		
		$.ajax({
			type: "POST",
			url: base_url+"vehicletype/view_avatar",
			data: "avatar="+avatar_id,
			//dataType: "json",
			success: function(msg)
				{
					//alert(msg);
					$('.car_avatar').html(msg);	
				//alert(msg);
				}
			});
 
  	});
	
	
});

