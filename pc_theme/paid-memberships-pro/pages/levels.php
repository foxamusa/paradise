<?php 
global $wpdb, $pmpro_msg, $pmpro_msgt, $current_user;

if(is_user_logged_in())
{
	$getCurrentUserID = $current_user->ID;
	$getUserInfo = get_userdata($getCurrentUserID);
	if(in_array("girls",$getUserInfo->roles))
	{
		wp_redirect( get_site_url().'/product-category/upcoming-destinations/' );
		exit();
	}
}

$pmpro_levels = pmpro_getAllLevels(false, true);
$pmpro_level_order = pmpro_getOption('level_order');

if(!empty($pmpro_level_order))
{
	$order = explode(',',$pmpro_level_order);

	//reorder array
	$reordered_levels = array();
	foreach($order as $level_id) {
		foreach($pmpro_levels as $key=>$level) {
			if($level_id == $level->id)
				$reordered_levels[] = $pmpro_levels[$key];
		}
	}

	$pmpro_levels = $reordered_levels;
}

$pmpro_levels = apply_filters("pmpro_levels_array", $pmpro_levels);

if($pmpro_msg)
{
?>
<div class="pmpro_message <?php echo $pmpro_msgt?>"><?php echo $pmpro_msg?></div>
<?php
}
?>
<div class="member-levels">
	<?php	
	$count = 0;
	foreach($pmpro_levels as $level)
	{
	  if(isset($current_user->membership_level->ID))
		  $current_level = ($current_user->membership_level->ID == $level->id);
	  else
		  $current_level = false;
	?>
	<div class="member-level <?php if($current_level == $level) { ?> active<?php } ?>">
		<table>
		</tbody>
			<tr>
				<td class="level-name">
					<?php echo $current_level ? "<strong>{$level->name}</strong>" : $level->name?>
				</td>
			</tr>	
			<tr>
				<td class="level-description">
					<?php echo $current_level ? "<strong>{$level->description}</strong>" : $level->description?>
				</td>
			</tr>	
			<tr>
				<td class="price-level">
						<?php 
				if(pmpro_isLevelFree($level))
					$cost_text = "<strong>" . __("Free", 'paid-memberships-pro' ) . "</strong>";
				else
					$cost_text = pmpro_getLevelCost($level, true, true); 
				$expiration_text = pmpro_getLevelExpiration($level);
				if(!empty($cost_text) && !empty($expiration_text))
					echo $cost_text . "<br />" . $expiration_text;
				elseif(!empty($cost_text))
					echo $cost_text;
				elseif(!empty($expiration_text))
					echo $expiration_text;
			?>
				</td>
			</tr>	
			<tr>
				<td class="level-select">
					<?php if(empty($current_user->membership_level->ID)) { ?>
						<a class="mx-level-button" href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('Buy Memebrship', 'paid-memberships-pro' );?></a>
					<?php } elseif ( !$current_level ) { ?>                	
						<a class="mx-level-button" href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('Buy Memebrship', 'paid-memberships-pro' );?></a>
					<?php } elseif($current_level) { ?>      
						
						<?php
							//if it's a one-time-payment level, offer a link to renew				
							if( pmpro_isLevelExpiringSoon( $current_user->membership_level) && $current_user->membership_level->allow_signups ) {
								?>
									<a class="mx-level-button" href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('Renew', 'paid-memberships-pro' );?></a>
								<?php
							} else {
								?>
									<a class="disabled mx-level-button" href="<?php echo pmpro_url("account")?>"><?php _e('Your&nbsp;Level', 'paid-memberships-pro' );?></a>
								<?php
							}
						?>
						
					<?php } ?>
				</td>
			</tr>
		</tbody>	
		</table>
		
		<nav id="nav-below" class="navigation" role="navigation">
			<div class="nav-previous custom-nav">
				<?php if(!empty($current_user->membership_level->ID)) { ?>
					<a href="<?php echo pmpro_url("account")?>" id="pmpro_levels-return-account"><?php _e('&larr; Return to Your Account', 'paid-memberships-pro' );?></a>
				<?php } else { ?>
					<a href="<?php echo home_url()?>" id="pmpro_levels-return-home"><?php _e('Return to Home', 'paid-memberships-pro' );?></a>
				<?php } ?>
			</div>
		</nav>	
	</div>
    	<?php } ?>
</div>

