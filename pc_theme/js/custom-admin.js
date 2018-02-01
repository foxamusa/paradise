/*!
 * CustomAdminJs
 * by Technocrats Horizons Team
 *
 * More info:
 * http://technocratshorizons.com/
 */
jQuery(document).ready(function($) 
{
	jQuery.validator.addMethod("numbersonly", function(value, element) 
	{
		return this.optional(element) || /^[0-9," "]+$/i.test(value);
	}, "Numbers only please");
	
	/******************Admin Edit Girls Vote Count Start**************/
	jQuery(document).on('click', 'a.editgirslpoints', function(e)
	{
		e.preventDefault();
		jQuery(".customadminmodalresponse").html('');
		var dataUserID = jQuery(this).attr('data-user-id');
		jQuery('.customadminloader').html('<div class="loader"><img class="loader" src="'+loaderImage+'"/></div>').fadeIn();	
		jQuery.ajax
		({	
			type: 'POST',
			url: ajaxurl,
			data: 
			{ 
				'action': 'girlsvoteseditbyadmin',
				'dataUserID': dataUserID,
			},
			success: function(data)
			{
				jQuery('.loader').remove();
				jQuery(".customadminmodalresponse").append(data);
				jQuery(".customadminmodalresponse").find("#mymodalvotesedit").modal("toggle");
				jQuery(".customadminmodalresponse").find("#mymodalvotesedit").modal({backdrop: 'static', keyboard: false});
			},
			error: function(err)
			{
				console.log(err);
				jQuery(".customadminloader").html("");
			}
		});
	});
	
	/************************Edit Enquiry By Admin Validatoin Start**********/
	jQuery( document ).delegate('button.updatevotebutton', 'click', function(e) 
	{
		e.preventDefault();
		var checkForm = jQuery('form#editvotebyadmincustomform');
		checkForm.validate
		({
			onfocusout: function(element) 
			{
			this.element(element);
			},
			errorClass: 'customErrorClass',
			rules: 
			{
				girlvotescount: 
				{
					required: true,
					number: true,
					numbersonly :true,
				}
			},
			messages: 
			{
				girlvotescount: 
				{
					required: 'Please enter vote count',
					number:"Please enter only numeric value",
					numbersonly : "Cannot use operators",
				}
			}, 
			errorElement: "div",
			errorPlacement: function(error, element) 
			{
				 element.after(error);
			}
		});
		if (checkForm.valid()) 
		{
			dataUserID = jQuery("form#editvotebyadmincustomform #hiddenUserID").val();
			var girlsVotesCount = jQuery("form#editvotebyadmincustomform #girlvotescount").val();
			jQuery('.resendenquiryloader').html('<div class="loader"><img class="loader" src="'+loaderImage+'"/></div>').fadeIn();	
			jQuery.ajax
			({	
				type: 'POST',
				dataType: 'json',
				url: ajaxurl,
				data: 
				{ 
					'action': 'girlsvoteseditbyadminconfirmed',
					'dataUserID': dataUserID,
					'girlsVotesCount': girlsVotesCount
				},
				success: function(data)
				{
					jQuery('.loader').remove();
					if (data.voteStatus == true)
					{
						jQuery('form.editvotebyadmincustomform .result .error').text(data.message).css('color','#4f8a10');
						jQuery("form.editvotebyadmincustomform input").prop("disabled", true);
						jQuery("form.editvotebyadmincustomform button").prop("disabled", true);	
						//jQuery("#adminallenquiries").DataTable().ajax.reload();
						location.reload();
					}
					else
					{
						jQuery('form.editvotebyadmincustomform .result .error').text(data.message);
					}
				}
			});
		}
	});
});

jQuery( window ).load(function() 
{
	/******************Admin Check One Girls Row Wise**************/
	jQuery('.img_list').each(function()
	{
		var dataImageID = jQuery(this).attr('id');
		var dataUserID = jQuery(this).attr('data-user-id');
		jQuery("#"+dataImageID).find('img').imgCheckbox
		({
			"radio": true,
			onclick: function(el)
			{
				var isChecked = el.hasClass("imgChked"),
				dataImageName = el.children()[0];
				jQuery('.customadminloader').html('<div class="loader"><img class="loader" src="'+loaderImage+'"/></div>').fadeIn();
				jQuery.ajax
				({	
					type: 'POST',
					url: ajaxurl,
					data: 
					{ 
						'action': 'girlspictureselectedbyadmin',
						'dataUserID': dataUserID,
						'dataImageName': dataImageName.name,
					},
					success: function(data)
					{
						jQuery('.loader').remove();
						jQuery(".customadminmodalresponse").append(data);
						jQuery(".customadminmodalresponse").find("#mymodalimageselect").modal("toggle");
						jQuery(".customadminmodalresponse").find("#mymodalimageselect").modal({backdrop: 'static', keyboard: false});
					},
					error: function(err)
					{
						console.log(err);
						jQuery(".customadminloader").html("");
					}
				});
			}
		});
	});
	
	if(jQuery(".girlsimageclickableselect").hasClass("customimagecheckforparent")) 
	{
		jQuery('.customimagecheckforparent').closest('li').find('span').addClass('imgChked');
	}
});