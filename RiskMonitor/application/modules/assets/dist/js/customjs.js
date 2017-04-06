$(document).ready(function() {
	$(function($) {$('#password').pwstrength(); });
	$( "#reset_form" ).submit(function( event ) {
		$('#reset_form input').each( function() {
			var sd = $(this).hasClass("error");
			if(sd == true){
				$(this).focus();
				
				event.preventDefault();
				return false;
			}
		});
	});
	$( "#validation_form" ).submit(function( event ) {
		$('#validation_form input').each( function() {
			var sd = $(this).hasClass("error");
			if(sd == true){
				$(this).focus();
				
				event.preventDefault();
				return false;
			}
		});
	});
	$('.input-group.date').datepicker({
		format: "mm-dd-yyyy",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        todayHighlight: true
    });
    (function($, window) {
        var dev = '.dev'; //window.location.hash.indexOf('dev') > -1 ? '.dev' : '';
    
        // setup datepicker
        $("#datepicker").datepicker();
    
        // Add a new validator
        $.formUtils.addValidator({
            name : 'even_number',
            validatorFunction : function(value, $el, config, language, $form) {
                return parseInt(value, 10) % 2 === 0;
            },
            borderColorOnError : '',
            errorMessage : 'You have to give an even number',
            errorMessageKey: 'badEvenNumber'
        });
    
        window.applyValidation = function(validateOnBlur, forms, messagePosition, xtraModule) {
            if( !forms )
                forms = 'form';
            if( !messagePosition )
                messagePosition = 'top';
    
            $.validate({
                form : forms,
                language : {
                    requiredFields: 'Du måste bocka för denna'
                },
                validateOnBlur : validateOnBlur,
                errorMessagePosition : messagePosition,
                scrollToTopOnError : true,
                lang : 'en',
                sanitizeAll : 'trim', // only used on form C
               // borderColorOnError : 'purple',
                modules : 'security'+dev+', location'+dev+', sweden'+dev+', file'+dev+', uk'+dev+' , brazil'+dev +( xtraModule ? ','+xtraModule:''),
                onModulesLoaded: function() {
                    $('#country-suggestions').suggestCountry();
                    $('#swedish-county-suggestions').suggestSwedishCounty();
                    $('#passwordd').displayPasswordStrength();
                },
                onValidate : function($f) {
    
                    console.log('about to validate form '+$f.attr('id'));
    
                    var $callbackInput = $('#callback');
                    if( $callbackInput.val() == 1 ) {
                        return {
                            element : $callbackInput,
                            message : 'This validation was made in a callback'
                        };
                    }
                },
                onError : function($form) {
                    /*alert('Invalid '+$form.attr('id'));*/
					return false;
                },
                onSuccess : function($form) {
                   /* alert('Valid '+$form.attr('id'));*/
                    return true;
                }
            });
        };
    
        $('#text-area').restrictLength($('#max-len'));
    
        window.applyValidation(true, '#validation_form', 'top');
        window.applyValidation(false, '#form-b', 'element');
        window.applyValidation(true, '#form-c', $('#error-container'), 'sanitize'+dev);
        window.applyValidation(true, '#form-d', 'element', 'html5'+dev);
        window.applyValidation(true, '#form-e');
    
        // Load one module outside $.validate() even though you do not have to
        $.formUtils.loadModules('date'+dev+'.js', false, false);
    
        $('input')
            .on('beforeValidation', function() {
                console.log('About to validate input "'+this.name+'"');
            })
            .on('validation', function(evt, isValid) {
                var validationResult = '';
                if( isValid === null ) {
                    validationResult = 'not validated';
                } else if( isValid ) {
                    validationResult = 'VALID';
                } else {
                    validationResult = 'INVALID';
                }
                console.log('Input '+this.name+' is '+validationResult);
            });
    
    })(jQuery, window);
	$('#dataTables').DataTable({
    	responsive: true,
		aoColumnDefs: [
		  {
			 bSortable: false,
			 aTargets: [ -1 ]
		  }
		]
    });
	$('#registermail').blur(function() {
		$('.email_exists_loader').show();
		var level_id = $('#level_id').val();
		var base_url = $('#baseurl').val();
		var email = $(this).val();
		$.ajax({
			type: "POST",
			url: base_url+"register/check_email_exists",
			data: "level_id="+level_id+"&email="+email,
			//dataType: "json",
			success: function(msg)
				{	
					if(msg==1)
					{
						$('#registermail').after('<span class="help-block form-error">Email Already Exists.</span>');
						$('.email_exists_loader').hide();
					}
					else{
						$('.email_exists_loader').hide();
					}
				}
			});
	});
$(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});
	
});


