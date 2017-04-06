$(document).ready(function(){
	$(function(){
		$('.active_inactive').bootstrapToggle({
		  on: 'Active',
		  off: 'Inactive',
		  size: 'large',
		  height: 18,
		  width: 70
		});
	});
	
	$('.active_inactive').change(function(){
		var thiss = $(this);
		var userId = $(this).attr('data-id');
		var baseURL = $('#base_url').val();
		if(this.checked){
			var activeStatus = 1;
			var message = "You are going to activate the user";
		}else{
			var activeStatus = 0;
			var message = "You are going to deactivate the user";
		}
		swal({
			title: "Are you sure?",
			text: message,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#DD6B55',
			confirmButtonText: 'Yes!',
			cancelButtonText: "No",
			closeOnConfirm: false
		}, function(isConfirm){
			if(isConfirm){
				$.ajax({
					type: "POST",
					url: baseURL + "profile/update_active_status",
					data: "user_id=" + userId + "&active_status=" + activeStatus,
					success: function(respondingMessage){
						swal("Success", "Status has been changed!", "success");
					}
				});
			}else{
				if(activeStatus == 0){
					thiss.prop('checked', true).change();
				}else{
					thiss.prop('checked', false).change();
				}
			}
		});
    });
	
	$('.add_credits').click(function(){
		var userId = $(this).attr('data-id');
		var baseURL = $('#base_url').val();
		$.ajax({
			type: "POST",
			url: baseURL + "profile/get_credits",
			data: "user_id=" + userId,
			success: function(currentCredits){
				$.sweetModal({
					title: 'Add Credits To Admin',
					width: '400',
					content: "<h4>Current Credits = <label id='current_credits'>" + currentCredits + "</label><p><p>New Credits = <input type='number' id='new_credits' value='1' min='" + (-Number(currentCredits)) + "' /></h4>",
					buttons: {
						cancel: {
							label: 'Cancel',
							classes: 'redB '
						},
						addCredits: {
							label: 'Add Credits',
							classes: 'greenB ',
							action: function() {
								var newCredits = $('#new_credits').val();
								$.ajax({
									type: "POST",
									url: baseURL + "profile/add_credits",
									data: "user_id=" + userId + "&current_credits=" + currentCredits + "&new_credits=" + newCredits,
									success: function(respondingMessage){
										var creditsLabel = '#credits_label_' + userId;
										$(creditsLabel).val(respondingMessage);
										swal(newCredits + ' Credits are added for the Admin');
									}
								});
							}
						}
					}
				});
			}
		});
	});
	
	$('.delete_pdf').click(function(){
		var baseURL = $('#base_url').val();
		var rowNo = $(this).attr('row_no');
		var fileName = $(this).attr('file_name');
		swal({
			title: "Are you sure?",
			text: "Do you want to delete?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#DD6B55',
			confirmButtonText: 'Yes!',
			cancelButtonText: "No",
			closeOnConfirm: false
		}, function(isConfirm){
			if(isConfirm){
				$.ajax({
					type: "POST",
					url: baseURL + "avatar/delete_pdf",
					data: "file_name=" + fileName,
					success: function(respondingMessage){
						var rowId = '#table_row_' + rowNo;
						$(rowId).remove();
						swal('Success', fileName + '  deleted successfully', 'success');
					}
				});
			}
		});
	});
	
	$('.transfer_button').click(function(){
		var baseURL = $('#base_url').val();
		var targetUserId = $('#target_user_id').val();
		var removable=$('#target_user_id').attr('removable');
		var userCount = $('#user_count').val();
		var userIdList = '';
		var userIds = Array();
		for(i=0;i<userCount;i++){
			var checkBoxId = '#check_' + i;
			if($(checkBoxId).is(':checked')){
				userIdList += $(checkBoxId).attr('user_id') + '#';
				userIds.push('#table_row_' + i);
			}
		}
		if(userIds.length == 0)return;
		swal({
			title: "Are you sure?",
			text: "Do you want to transfer?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#DD6B55',
			confirmButtonText: 'Yes!',
			cancelButtonText: "No",
			closeOnConfirm: false
		}, function(isConfirm){
			if(isConfirm){
				$.ajax({
					type: "POST",
					url: baseURL + "profile/transfer_user",
					data: 'target_user_id=' + targetUserId + "&user_id_list=" + userIdList,
					success: function(respondingMessage){
						if(removable=='true'){
							for(i=0;i<userIds.length;i++){
								$(userIds[i]).remove();
							}
						}
						swal('Success', 'Transfered successfully', 'success');
					}
				});
			}
		});
	});
	
	$('#user_type').change(function(){
		var baseURL = $('#base_url').val();
		var userType = $(this).val();
		$.ajax({
			type: 'POST',
			url: baseURL + 'profile/get_company_list',
			data: 'user_type=' + userType,
			success: function(respondingMessage){
				$('#company_id').empty();
				var companyList=respondingMessage.split('@@');
				for(var i=1;i<companyList.length;i++){
					var companyInfo=companyList[i].split('##');
					$('#company_id').append($('<option></option>').attr('value', companyInfo[0]).text(companyInfo[1]));
				}
				var initCompany=$('#company_id').val();
				$('#company_id').val(initCompany).trigger('change');
			}
		});
	});
	
	$('#company_id').change(function(){
		var baseURL = $('#base_url').val();
		var companyId = $(this).val();
		$.ajax({
			type: "POST",
			url: baseURL + "profile/get_company_info",
			data: "company_id=" + companyId,
			success: function(respondingMessage){
				var companyInfo=respondingMessage.split('##');
				$('#address').val(companyInfo[0]);
				$('#vat').val(companyInfo[1]);
				$('#zip_code').val(companyInfo[2]);
				$('#website').val(companyInfo[3]);
			}
		});
	});
	
	var userType=$('#user_type').val();
	$('#user_type').val(userType).trigger('change');
	
	var initCompany=$('#company_id').val();
	$('#company_id').val(initCompany).trigger('change');
});
