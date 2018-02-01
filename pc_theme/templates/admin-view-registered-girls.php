<?php ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/bootstrap/css/bootstrap.css'?>" />
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/bootstrap/js/bootstrap.js'?>"></script>
<div style="height:30px;"></div>
<?php 
$noInquiryMessage = "No Girls Found.";
?>
<script>
jQuery(document).ready(function() 
{
	jQuery('#adminallenquiries').DataTable
	({
		"bProcessing": true,
		"ajax":
		{
			url :"<?php echo get_template_directory_uri();?>/templates/admin-view-ajax.php?actionfor=viewregisteredgirls",
			type: "post",
		},
		"aoColumns": [
			{ mData: 'Date Registered' },
			{ mData: 'User Email' },
			{ mData: 'Display Name' },
			{ mData: 'Pictures' } ,
			{ mData: 'Number of Votes' },
			{ mData: 'Action' }
		],
		"deferRender": true,
		"order": [[ 0, "desc" ]],
		"language": 
		{
			"sLengthMenu": "Show _MENU_ Girls",
			"zeroRecords": "<?php echo $noInquiryMessage; ?>",
			"infoEmpty": "",
			"info": "Showing _START_ to _END_ of _MAX_  Girls",
			"infoFiltered": "(filtered from _MAX_ total Girls)"
		},
		/* "fnDrawCallback": function( oSettings ) 
		{
			if(jQuery("img").hasClass("customimagecheckforparent")) 
			{
				alert('sdddd');
				jQuery(this).closest('li').addClass('HelloWorldHelloWorld');
				//jQuery(this).closest('li').find('span').addClass('imgChked');
			}
			else
			{
				alert('dddddd');
			}
		} */
	});
});
</script>
						
<div class="primery_table">
	<div class="table-responsive mycustomdatatableclass">
		<div class="customadminloader"></div>
		<div class="customadminmodalresponse"></div>
		<table class="table display tab12" id="adminallenquiries" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Date Registered</th>
					<th>User Email</th>
					<th>Display Name</th>
					<th>Pictures</th>
					<th>Number of Votes</th>
					<th>Action</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Date Registered</th>
					<th>User Email</th>
					<th>Display Name</th>
					<th>Pictures</th>
					<th>Number of Votes</th>
					<th>Action</th>
				</tr>
			</tfoot>
		</table>
	</div>	
</div>