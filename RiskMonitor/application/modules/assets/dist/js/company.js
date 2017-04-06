$(document).ready(function(){
	$('.add_company').click(function(){
		var baseURL = $('#base_url').val();
		var userType = $('#user_type').val();
		switch(userType){
			case 'AMB':
				var companyListContent="<option value='AMB'>AMB User</option><option value='SUPER_ADMIN'>Super Admin</option>";break;
			case 'SUPER_ADMIN':
				var companyListContent="<option value='ADMIN'>Admin</option>";break;
			case 'ADMIN':
				var companyListContent="<option value='SUB_ADMIN'>Sub Admin</option><option value='USER'>User</option>";break;
			case 'SUB_ADMIN':
				var companyListContent="<option value='USER'>User</option>";break;
		}
		$.sweetModal({
			title: 'Enter New Company',
			width: '600',
			content: "<h4> Company Type = <select id='company_type'>" + companyListContent + "</select> <p><p> Company Name = <input id='company_name' /> <p><p> Address = <input id='address'> <p><p> VAT = <input id='vat' /> <p><p> Zipcode = <input id='zip_code'> <p><p> Website = <input id='website'> </h4>",
			buttons: {
				cancel: {
					label: 'Cancel',
					classes: 'redB'
				},
				updateCompany: {
					label: 'Update Company',
					classes: 'greenB',
					action: function() {
						var companyType = $('#company_type').val();
						var companyName = $('#company_name').val();
						var address = $('#address').val();
						var vat = $('#vat').val();
						var zipCode = $('#zip_code').val();
						var website = $('#website').val();
						$.ajax({
							type: 'POST',
							url: baseURL + 'profile/add_company',
							data: 'company_type=' + companyType + '&company_name=' + companyName + '&address=' + address + '&vat=' + vat + '&zip_code=' + zipCode + '&website=' + website,
							success: function(respondingMessage){
								location.reload();
							}
						});
					}
				}
			}
		});
	});
	
	$('.update_company').click(function(){
		var companyId = $(this).attr('data-id');
		var baseURL = $('#base_url').val();
		var companyNameLabel = '#company_name_' + companyId;
		var addressLabel = '#address_' + companyId;
		var vatLabel = '#vat_' + companyId;
		var zipCodeLabel = '#zip_code_' + companyId;
		var websiteLabel = '#website_' + companyId;
		$.sweetModal({
			title: 'Enter New Company',
			width: '600',
			content: "<h4> Company Name = <input id='company_name' value='" + $(companyNameLabel).html() + "' /> <p><p> Address = <input id='address' value='" + $(addressLabel).html() + "' /> <p><p> VAT = <input id='vat' value='" + $(vatLabel).html() + "' /> <p><p> ZipCode = <input id='zip_code' value='" + $(zipCodeLabel).html() + "' /> <p><p> Website = <input id='website' value='" + $(websiteLabel).html() + "' /> </h4>",
			buttons: {
				cancel: {
					label: 'Cancel',
					classes: 'redB'
				},
				updateCompany: {
					label: 'Update Company',
					classes: 'greenB',
					action: function() {
						var companyType = $('#company_type').val();
						var companyName = $('#company_name').val();
						var address = $('#address').val();
						var vat = $('#vat').val();
						var zipCode = $('#zip_code').val();
						var website = $('#website').val();
						$.ajax({
							type: "POST",
							url: baseURL + "profile/update_company",
							data: 'company_id=' + companyId + '&company_name=' + companyName + '&address=' + address + '&vat=' + vat + '&zip_code=' + zipCode + '&website=' + website,
							success: function(respondingMessage){
								$(companyNameLabel).html(companyName);
								$(addressLabel).html(address);
								$(vatLabel).html(vat);
								$(zipCodeLabel).html(zipCode);
								$(websiteLabel).html(website);
								swal("Updated Successfully");
							}
						});
					}
				}
			}
		});
	});
	
	$('.delete_company').click(function(){
		var baseURL = $('#base_url').val();
		var companyId = $(this).attr('data-id');
		var rowNo = $(this).attr('row_no');
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
					url: baseURL + "profile/delete_company",
					data: "company_id=" + companyId,
					success: function(respondingMessage){
						var rowId = '#table_row_' + rowNo;
						$(rowId).remove();
						swal('Success', 'Deleted successfully', 'success');
					}
				});
			}
		});
	});
});
