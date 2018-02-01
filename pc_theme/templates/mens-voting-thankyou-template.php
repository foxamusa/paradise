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
		if(!$checkAlreadyVoted)
		{
			$redirection = 1;
		}
	}
}
if($redirection ==1)
{
	wp_redirect( get_site_url().'/product-category/upcoming-destinations/' );
	exit();
} ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php
		echo "You will received an email regarding the girl which will go with you.";
		?>

	</main><!-- #main -->
</div><!-- #primary -->
