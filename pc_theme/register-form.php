<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
global $wpdb;$current_user;
if(is_user_logged_in())
{
	wp_redirect(get_site_url(),301);
	exit;
}

?>
<script>
jQuery(document).ready(function($)
{
});
</script>


<div class="tml tml-register tml-register_form " id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'register' ); ?>
	<?php $template->the_errors(); ?>
	<form class="tmlregistrationform" name="registerform" id="registerform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'register', 'login_post' ); ?>" method="post">
		<?php if ( 'email' != $theme_my_login->get_option( 'login_type' ) ) : ?>
		<p class="tml-user-login-wrap">
			<label for="user_login<?php $template->the_instance(); ?>">
			<input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_login' ); ?>" placeholder="<?php _e( 'Username*', 'theme-my-login' ); ?>" size="20" /></label> 
		</p>
		<?php endif; ?>
		<p class="tml-first-name-wrap">
			<label for="first_name<?php $template->the_instance(); ?>">
			<input type="text" name="first_name" id="first_name<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'first_name' ); ?>" placeholder="<?php _e( 'First Name*', 'theme-my-login' ); ?>" size="20" /></label> 
		</p>
		<p class="tml-last-name-wrap">
			<label for="last_name<?php $template->the_instance(); ?>">
			<input type="text" name="last_name" id="last_name<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'last_name' ); ?>" placeholder="<?php _e( 'Last Name*', 'theme-my-login' ); ?>" size="20" /></label> 
		</p>
		<p class="tml-phone-wrap">
			<label for="phone<?php $template->the_instance(); ?>">
			<input type="text" name="phone" id="phone<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'phone' ); ?>" placeholder="<?php _e( 'Phone Number*', 'theme-my-login' ); ?>" size="20" /></label> 
		</p>
		<p class="tml-age-wrap">
			<label for="age<?php $template->the_instance(); ?>">
			<input type="text" name="age" id="age<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'age' ); ?>" placeholder="<?php _e( 'Age (Optional)', 'theme-my-login' ); ?>" size="20" /></label> 
		</p>
		
		<p class="tml-user-email-wrap">
			<label for="user_email<?php $template->the_instance(); ?>"></label> 
			<input type="text" name="user_email" id="user_email<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_email' ); ?>" placeholder="<?php _e( 'E-mail*', 'theme-my-login' ); ?>" size="20" /></label>
		</p>

		<?php do_action( 'register_form' ); ?>
		
		<p class="tml-registration-confirmation" id="reg_passmail<?php $template->the_instance(); ?>"><?php echo apply_filters( 'tml_register_passmail_template_message', __( 'Registration confirmation will be e-mailed to you.', 'theme-my-login' ) ); ?></p>
		
		<?php $template->the_action_links( array( 'register' => false ) ); ?>
		
		<p class="tml-submit-wrap">
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Register', 'theme-my-login' ); ?>" />
			<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'register' ); ?>" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="action" value="register" />
		</p>
		<div class="customloader"></div>
	</form>
	
</div>
