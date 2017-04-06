$(document).ready(function() {
	var pdfUploadingErrorMessage=$('#pdf_uploading_error').attr('error_message');
	if(pdfUploadingErrorMessage){
		swal({
			title: 'Uploading Failed',
			text: '<h4>' + pdfUploadingErrorMessage + '</h4>',
			html: true,
			type: "error"
		});
	}
	$('#company_list').change(function(){
		var baseURL = $('#base_url').val();
		var companyId = $(this).val();
		$.ajax({
			type: "POST",
			url: baseURL + "avatar/get_vat_for_company",
			data: "company_id=" + companyId,
			success: function(respondingMessage){
				$('#vat').val(respondingMessage);
			}
		});
	});
	var initCompany=$('#company_list').val();
	$('#company_list').val(initCompany).trigger('change');
});
