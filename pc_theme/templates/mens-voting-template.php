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
	// $roles_type = array('mens', 'administrator'); 
	if($getUserInfo)
	{
		if(!in_array('mens', $getUserInfo->roles) && !in_array('administrator', $getUserInfo->roles))
		{	
			
			$redirection = 1;
		}

		$checkAlreadyVoted = get_user_meta($current_user->ID,'men_already_voted',true);
		// pt($checkAlreadyVoted);
		// die();

		if($checkAlreadyVoted)
		{
			$redirection = 1;
		} else {
			// pt($checkAlreadyVoted);
			$customer_orders = wc_get_orders( $args = array(
			'numberposts' => -1,
			'meta_key'    => '_customer_user',
			'meta_value'  => get_current_user_id(),
			'post_status' => array( 'wc-pending', 'wc-processing', 'wc-on-hold', 'wc-completed' ),
			) );
			$valuetoShow = '';
			
			$customer_orders_count = count( $customer_orders );
			$is_admin = is_role_admin();

			if($is_admin){
				$customer_orders_count = 1;
			}

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
$girlsUserQuery = new WP_User_Query( $girlsUserQueryArgs ); ?> 

<div id="pl-17" class="panel-layout">
	<div id="pg-17-0" class="panel-grid panel-has-style">
		<div class="siteorigin-panels-stretch panel-row-style panel-row-style-for-17-0" data-stretch-type="full" style="margin-left: 0px; margin-right: 0px; padding-left: 0px; padding-right: 0px; border-left: 0px; border-right: 0px;">
			<div id="pgc-17-0-0" class="panel-grid-cell">
				<div id="panel-17-0-0-0" class="so-panel widget widget_sow-editor panel-first-child panel-last-child" data-index="0">
					<div class="cover-video panel-widget-style panel-widget-style-for-17-0-0-0">
						<div class="so-widget-sow-editor so-widget-sow-editor-base">
							<div class="siteorigin-widget-tinymce textwidget">
								<div class="men-voting header">
									<div class="cover-video panel-widget-style panel-widget-style-for-17-0-0-0">
										<div class="so-widget-sow-editor so-widget-sow-editor-base">
											<div class="siteorigin-widget-tinymce textwidget">
												<div class="cover-new_root_17R">
													<span class="video_root_Bc- video_cover_r51" style="width:100%;height:694px;"><br>
														<span class="video_wrapper_2RW"><br>
															<video src="https://player.vimeo.com/external/132847237.hd.mp4?s=a841aa2f063068d1766d0f45498ee0d0315df6aa&amp;profile_id=113" width="100%" height="600px" autoplay="" loop="" muted=""><br>
															</video>
														</span>
														<br>
													</span>
													<div class="cover-new_slogan_3yU">
														<!-- <h2>TYTSub tyt sub tyt --> 
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- header video -->

	<div id="pg-17-0" class="panel-grid panel-has-style">
		<div class="siteorigin-panels-stretch panel-row-style panel-row-style-for-17-0" data-stretch-type="full" style="margin-left: 0px; margin-right: 0px; padding-left: 0px; padding-right: 0px; border-left: 0px; border-right: 0px;">
			<div id="pgc-17-0-0" class="panel-grid-cell">
				<div id="panel-17-0-0-0" class="so-panel widget widget_sow-editor panel-first-child panel-last-child" data-index="0">
					<div class="cover-video panel-widget-style panel-widget-style-for-17-0-0-0">
						<div class="so-widget-sow-editor so-widget-sow-editor-base">
							<div class="siteorigin-widget-tinymce textwidget">
								<div class="men-voting header">
									maine page
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- body panel -->

</div> <!-- end pl-17 -->
<?php if ( ! empty( $girlsUserQuery->results ) ) { ?>
<?php } else { ?>
	<div class="no-response-info">No Girls Found</div>
<?php } ?>

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