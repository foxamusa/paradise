<?php
global $wpdb,$current_user,$woocommerce,$order_id;
$redirection = '';
if(!is_user_logged_in())
{
	$redirection = 1;
}
elseif(is_user_logged_in())
{
	$getUserInfo = get_userdata($current_user->ID);
	if($getUserInfo)
	{
		if(!in_array("mens",$getUserInfo->roles))
		{
			$redirection = 1;
		}
		$checkAlreadyVoted = get_user_meta($current_user->ID,'men_already_voted',true);
		if($checkAlreadyVoted)
		{
			$redirection = 1;
		}
		else
		{
			$customer_orders = wc_get_orders( $args = array(
			'numberposts' => -1,
			'meta_key'    => '_customer_user',
			'meta_value'  => get_current_user_id(),
			'post_status' => array( 'wc-pending', 'wc-processing', 'wc-on-hold', 'wc-completed' ),
			) );
			$valuetoShow = '';
			$customer_orders_count = count( $customer_orders );
			if(empty($customer_orders_count))
			{
				$redirection = 1;
			}
		}
	}
}
if($redirection ==1)
{
	wp_redirect( get_site_url().'/product-category/upcoming-destinations/' );
	exit();
}
$girlsUserQueryArgs = array
(
	'orderby'    => 'ID',
	'order'    => 'DESC',
	'role' => 'girls', 
	'meta_query' => array
		(
			array
			(
				array(
				'key'     => 'admin_set_girls_picture',
				'value'   => ' ',
				'compare' => '!='
				),
			)
		)
);
$girlsUserQuery = new WP_User_Query( $girlsUserQueryArgs );
if ( ! empty( $girlsUserQuery->results ) ) 
{
	echo '<div class="container">
			<div class="customloader"></div>
			<div class="customparkingremovephotosmodalresponse"></div>
			<ul class="grid effect-3 customulgridclass" id="grid">';
			foreach($girlsUserQuery->results as $girlsUserQueryValue)
			{
				$getUserDisplayName = $girlsUserQueryValue->data->display_name;
				$getUserID = $girlsUserQueryValue->ID;
				$getUserVoteCount = get_user_meta($getUserID,'admin_set_votes_count',true);
				$getGirlsPicture = get_user_meta($getUserID,'admin_set_girls_picture',true);
				$girlsPhotosURL = RP_FILE_PATH_GIRLS_URL.'/users/girlsphotos/' . $getGirlsPicture;
				if($girlsPhotosURL)
				{
					?>
					<li>
						<a href="<?php echo $girlsPhotosURL; ?>">
							<img src="<?php echo $girlsPhotosURL; ?>">
						</a>
						<div class="internaldetail">
							<span class="fullwidthspan"><?php echo $getUserDisplayName;?></span>	
							<span class="halfwidthspan"><i data-girl-ID="<?php echo $getUserID; ?>" title="Vote" class="fa fa-thumbs-up votingthisgirl" aria-hidden="true"></i></span>
							<span class="halfwidthspan textalginright"><?php echo $getUserVoteCount;?></span>
						</div>
					</li>
					<?php 
				}
			}
			echo '</ul>';
		echo '</div>';
}
else	
{
	echo "No Girls Found";
}
?>
<!--div class="container">
	<ul class="grid effect-3 customulgridclass" id="grid">
		<li>
			<a href="http://drbl.in/fWMM">
				<img src="http://localhost/renewed_paradise/wp-content/themes/pc_theme/uploads/girlsphotos/6.jpg">
			</a>
			<div class="internaldetail">
				<span class="fullwidthspan">Samantha Jones</span>	
				<span class="halfwidthspan"><i class="fa fa-thumbs-up votingthisgirl" aria-hidden="true"></i></span>
				<span class="halfwidthspan textalginright">1983</span>
			</div>
		</li>
		<li>
			<a href="http://drbl.in/fWMM">
				<img src="http://localhost/renewed_paradise/wp-content/themes/pc_theme/uploads/girlsphotos/3.jpg">
			</a>
			<div class="internaldetail">
				<span class="fullwidthspan">Samantha Jones</span>	
				<span class="halfwidthspan"><i class="fa fa-thumbs-up votingthisgirl" aria-hidden="true"></i></span>
				<span class="halfwidthspan textalginright">1983</span>
			</div>
		</li>
	</ul>
</div-->