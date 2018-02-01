jQuery(document).ready(function($) 
{	
	jQuery.validator.addMethod("noSpace", function(value, element) 
	{ 
		return value.indexOf(" ") < 0 && value != ""; 
	}, "Please enter without any whitespaces");
	
	var nospace = 'Please enter without any whitespaces';
	var firstname = 'Please enter your first name';
	var lastname = 'Please enter your last name';
	var phone = 'Please enter your phone number';
	var age = 'Please enter your age';
	var agerange = 'Please enter your age range between 10 and 80';
	var userlogin = 'Please enter username';
	var userloginexists = 'This user name already exists, please pick another';
	var emailaddress = 'Please enter your email address';
	var emailaddressvalid = 'Please enter valid email address';
	var useremailexists = 'This email address already exists, please pick another';
	var password1 = 'Please enter your password';
	var password2 = 'Please enter your confirm password';
	var password1minlength = 'Password must be 6 characters long';
	var password2minlength = 'Confirm password must be 6 characters long';
	var passwordnotmatching = 'Password and Confirm password must be equal';
	var bcity = 'Please enter your city';
	var bcountry = 'Please select your country';
	
	
	/***********TML Registration*****************/
	jQuery('form.tmlregistrationform').validate
	({
		onfocusout: function(element) 
		{
			this.element(element);
		},
		focusInvalid: false,
		invalidHandler: function(form, validator) 
		{
			if (!validator.numberOfInvalids())
			   return;
			var top_to_list = parseFloat($(validator.errorList[0].element).offset().top)-150;
			$('html, body').animate({
			   scrollTop:top_to_list
			}, 1000);
		},
		errorClass: 'customErrorClass',
		rules: 
		{
			first_name: 
			{
				required: true,
			},
			last_name: 
			{
				required: true,
			},
			phone: 
			{
				required: true,
			},
			age: 
			{
				//required: true,
				range: [10, 80],
			},
			user_login: 
			{
				required: true,
				noSpace: true,
				remote: 
				{
                    url: wordpressAjaxUrl,
					type: "post",
					data: 
					{
						'action' : 'userlogincheck'
					}
                }
			},
			user_email: 
			{
				required: true,
				email: true,
				remote: 
				{
                    url: wordpressAjaxUrl,
					type: "post",
					data: 
					{
						'action' : 'useremailcheck'
					}
                }
			},
			pass1: 
			{
				required: true,
				minlength: 6,
			},
			pass2: 
			{
				required: true,
				minlength: 6,
				equalTo: "#pass1",
			},
		},
		messages:
		{
			first_name: 
			{
				required: firstname,
			},
			last_name: 
			{
				required: lastname,
			},
			phone: 
			{
				required: phone,
			},
			age: 
			{
				//required: age,
				range : agerange,
			},
			user_login: 
			{
				required: userlogin,
				nospace : nospace,
				remote : userloginexists,
			},
			user_email: 
			{
				required: emailaddress,
				email: emailaddressvalid,
				remote : useremailexists,
			},
			pass1: 
			{
				required: password1,
				minlength: password1minlength,
			},
			pass2: 
			{
				required: password2,
				minlength: password2minlength,
				equalTo: passwordnotmatching,
			},
		},
		errorElement: "div",
		errorPlacement: function(error, element) 
		{
			element.after(error);
		},
		submitHandler: function(form) 
		{
			jQuery('.customloader').html('<div class="myparadiseloader"><img class="myparadiseloader" src="'+loaderImage+'"/></div>').fadeIn();
			form.submit(); 
		}
	});
	
	/***********TML Girls Registration*****************/
	jQuery('form.tmlregistrationformforgirls').validate
	({
		onfocusout: function(element) 
		{
			this.element(element);
		},
		focusInvalid: false,
		invalidHandler: function(form, validator) 
		{
			if (!validator.numberOfInvalids())
			   return;
			var top_to_list = parseFloat($(validator.errorList[0].element).offset().top)-150;
			$('html, body').animate({
			   scrollTop:top_to_list
			}, 1000);
		},
		errorClass: 'customErrorClass',
		rules: 
		{
			"girlsReg[first_name]": 
			{
				required: true,
			},
			"girlsReg[last_name]": 
			{
				required: true,
			},
			"girlsReg[phone]": 
			{
				required: true,
			},
			"girlsReg[age]": 
			{
				required: true,
				range: [10, 80],
			},
			"girlsReg[city]": 
			{
				required: true,
			},
			"girlsReg[billing_country]": 
			{
				required: true,
				minlength: 1,
			},
			"girlsReg[user_login]": 
			{
				required: true,
				noSpace: true,
				remote: 
				{
                    url: wordpressAjaxUrl,
					type: "post",
					data: 
					{
						'action' : 'userlogincheck'
					}
                }
			},
			"girlsReg[user_email]": 
			{
				required: true,
				email: true,
				remote: 
				{
                    url: wordpressAjaxUrl,
					type: "post",
					data: 
					{
						'action' : 'useremailcheck'
					}
                }
			},
			"girlsReg[pass1]": 
			{
				required: true,
				minlength: 6,
			},
			"girlsReg[pass2]": 
			{
				required: true,
				minlength: 6,
				equalTo: "#pass1",
			},
		},
		messages:
		{
			"girlsReg[first_name]": 
			{
				required: firstname,
			},
			"girlsReg[last_name]": 
			{
				required: lastname,
			},
			"girlsReg[phone]": 
			{
				required: phone,
			},
			"girlsReg[age]": 
			{
				required: age,
				range : agerange,
			},
			"girlsReg[city]": 
			{
				required: bcity,
			},
			"girlsReg[billing_country]": 
			{
				required: bcountry,
			},
			"girlsReg[user_login]": 
			{
				required: userlogin,
				nospace : nospace,
				remote : userloginexists,
			},
			"girlsReg[user_email]":  
			{
				required: emailaddress,
				email: emailaddressvalid,
				remote : useremailexists,
			},
			"girlsReg[pass1]": 
			{
				required: password1,
				minlength: password1minlength,
			},
			"girlsReg[pass2]": 
			{
				required: password2,
				minlength: password2minlength,
				equalTo: passwordnotmatching,
			},
		},
		errorElement: "div",
		errorPlacement: function(error, element) 
		{
			element.after(error);
		},
		submitHandler: function(form) 
		{
			var checkListPhotosItems = jQuery('.tml-user-photos-wrap').find('.fileuploader-items-list li').length;
			var checkListVideosItems = jQuery('.tml-user-videos-wrap').find('.fileuploader-items-list li').length;
			if(checkListPhotosItems < 5)
			{
				jQuery('.uploadgirlphotoserror').modal('show');
				jQuery('.uploadgirlphotoserror').modal({backdrop: 'static', keyboard: false});
	        }
			else if(checkListVideosItems < 5)
			{
				jQuery('.uploadgirlvideoserror').modal('show');
				jQuery('.uploadgirlvideoserror').modal({backdrop: 'static', keyboard: false});
	        }
			else
			{
				jQuery("input").removeAttr("disabled");
				jQuery('.customloader').html('<div class="myparadiseloader"><img class="myparadiseloader" src="'+loaderImage+'"/></div>').fadeIn();
				form.submit(); 
			}
		}
	});
	
	/***************Girl Multiple Photos ********/
	jQuery('input[name="girlsphotos"]').fileuploader
	({
		addMore: true,
		extensions: ['jpg', 'jpeg', 'png', 'gif'],
		listInput: true,
		dialogs: 
		{
            alert: function(text) 
			{
                return alert(text);
            },
            confirm: function(text, callback) 
			{	
				jQuery('.uploadphotosremovealterbox').modal('show');
				jQuery('.uploadphotosremovealterbox').modal({backdrop: 'static', keyboard: false})
				.one('click', '#girlsphotosconfirmremove', function(e) 
				{
					callback()
				});
            }
        }
	});
	
	/***************Girl Multiple Videos ********/
	jQuery('input[name="girlsvideos"]').fileuploader
	({
		addMore: true,
		//extensions: ['jpg', 'jpeg', 'png', 'gif'],
		listInput: true,
		dialogs: 
		{
            alert: function(text) 
			{
                return alert(text);
            },
            confirm: function(text, callback) 
			{	
				jQuery('.uploadvideosremovealterbox').modal('show');
				jQuery('.uploadvideosremovealterbox').modal({backdrop: 'static', keyboard: false})
				.one('click', '#girlsvideosconfirmremove', function(e) 
				{
					callback()
				});
            }
        }
	});
	
	jQuery('form#registerformgirls').find('.tml-user-photos-wrap .fileuploader-input-button').prepend('<i class="fa fa-camera" aria-hidden="true"></i>&nbsp;&nbsp;');
	jQuery('form#registerformgirls').find('.tml-user-videos-wrap .fileuploader-input-button').prepend('<i class="fa fa-video-camera" aria-hidden="true"></i>&nbsp;&nbsp;');
	
	/******Rooms Variations Carousel Images************/
	jQuery('.room_attribute_carousel').owlCarousel
	({
		loop:true,
		margin:10,
		nav:true,
		autoplay:true,
		navText: 
		[
			'<svg class="carousel-slider-nav-icon" width="48" height="48"><use xlink:href="#icon-arrow-left"></use></svg>',
			'<svg class="carousel-slider-nav-icon" width="48" height="48"><use xlink:href="#icon-arrow-right"></use></svg>'
		],
		responsive:
		{
			1000:
			{
				items:1
			}
		}
	});
	
	/*********Custom OnClick Variaton Book Button For Rooms On Modal************/
	jQuery(document).on("click",".custombooknowclick",function(event)
	{
		event.preventDefault();
        var getProductID = jQuery(this).attr('data-product-id');
		var getVariationID = jQuery(this).attr('data-variation-id');
		var getVariationSlug = jQuery(this).attr('data-slug');
		var getVariationName = jQuery(this).attr('data-var-name');
		jQuery("select#pa_room-type").val(getVariationSlug);
        jQuery('select#pa_room-type').trigger('change');
		jQuery("#myModalShowEmailMessages").modal("toggle");
		jQuery("#myModalShowEmailMessages").modal({backdrop: 'static', keyboard: false});
		jQuery("#myModalShowEmailMessages").find('.custompopupheading').text(getVariationName);
    }); 
	
	/*********Vote Now Click Function********/
	jQuery( document ).on('click','.votingthisgirl', function(e) 
	{
		e.preventDefault();
		var dataGirlID = jQuery(this).attr('data-girl-ID');
		if(dataGirlID)
		{
			jQuery('.customloader').html('<div class="myparadiseloader"><img class="myparadiseloader" src="'+loaderImage+'"/></div>').fadeIn();
			jQuery(".customparkingremovephotosmodalresponse").html('');
			jQuery.ajax
			({	
				type: 'POST',
				url: ajaxurl,
				data: 
				{ 
					'action': 'mensvotesforgirls',
					'dataGirlID': dataGirlID,
				},
				success: function(data)
				{
					jQuery('.myparadiseloader').remove();
					jQuery(".customparkingremovephotosmodalresponse").append(data);
					jQuery(".customparkingremovephotosmodalresponse").find("#mymodalvotesforgirls").modal("toggle");
					jQuery(".customparkingremovephotosmodalresponse").find("#mymodalvotesforgirls").modal({backdrop: 'static', keyboard: false})
					.one('click', '#mensvotesforgirlsconfirmed', function(e) 
					{
						jQuery('.customloader').html('<div class="myparadiseloader"><img class="myparadiseloader" src="'+loaderImage+'"/></div>').fadeIn();
						jQuery.ajax
						({	
							type: 'POST',
							url: ajaxurl,
							data: 
							{ 
								'action': 'mensvotesforgirlsconfirmed',
								'dataGirlID': dataGirlID,
							},
							success: function(data)
							{
								jQuery('.myparadiseloader').remove();
								jQuery(".customparkingremovephotosmodalresponse").append(data);
								jQuery(".customparkingremovephotosmodalresponse").find("#mymodalvotesforgirlsconfirmed").modal("toggle");
								jQuery(".customparkingremovephotosmodalresponse").find("#mymodalvotesforgirlsconfirmed").modal({backdrop: 'static', keyboard: false})
								.one('click', '.redirectafterclose', function(e) 
								{
									jQuery('.customloader').html('<div class="myparadiseloader"><img class="myparadiseloader" src="'+loaderImage+'"/></div>').fadeIn();
									window.location.href = thankyouUrl;
								});
							},
							error: function(err)
							{
								console.log(err);
								jQuery(".myparadiseloader").html("");
							}
						});
					});	
				},
				error: function(err)
				{
					alert('asdafasdsafd');
					console.log(err);
					jQuery(".myparadiseloader").html("");
				}
			});
		}
	});
});