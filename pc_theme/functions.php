<?php
/**
 * Pardise CLub Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Pardise_CLub_Theme
 */

if ( ! function_exists( 'pc_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pc_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Pardise CLub Theme, use a find and replace
		 * to change 'pc_theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pc_theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'pc_theme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'pc_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'pc_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pc_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pc_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'pc_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pc_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'pc_theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'pc_theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'pc_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pc_theme_scripts() {

	/*********Jquery Min for Validation and Popup********/
	//wp_enqueue_script( 'jquery-custom-min', get_template_directory_uri() . '/js/jquery.min.js', array(), '20151215', false );
	
	wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css');
		
	wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array(jquery));
	
	wp_enqueue_style( 'pc_theme-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'mxax_css', get_template_directory_uri() . '/css/mx_style.css' );
	wp_enqueue_script( 'mxax-script', get_template_directory_uri() . '/js/mxax.js');
	
	wp_enqueue_style( 'tech-custom-css', get_template_directory_uri() . '/css/custom.css' );
	wp_enqueue_style( 'mx-google-fonts', 'https://fonts.googleapis.com/css?family=Libre+Baskerville:400,400i,700|Montserrat:400,800&amp;subset=latin-ext' ); 
																							
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	
	wp_enqueue_script( 'pc_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'pc_theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	
	/******File Uploader Scripts**********/
	wp_enqueue_style( 'tech-custom-fileuploader-css', get_template_directory_uri() . '/photouploader/jquery.fileuploader.css' );
	wp_enqueue_script( 'tech-custom-fileuploader-js', get_template_directory_uri() . '/photouploader/jquery.fileuploader.min.js', array(), '20151215', true );
	
	/*********Jquery Validator Script********/
	wp_enqueue_script( 'jquery-validator-custom', get_template_directory_uri() . '/js/jquery.validate.min.js', array(), '20151215', true );
	
	/******Owl Carousel Scripts**********/
	wp_enqueue_style( 'tech-custom-owl-css', get_template_directory_uri() . '/owlcarousel/css/owl.carousel.min.css' );
	wp_enqueue_style( 'tech-custom-owl-theme-css', get_template_directory_uri() . '/owlcarousel/css/owl.theme.default.min.css' );
	wp_enqueue_script( 'tech-custom-owl-js', get_template_directory_uri() . '/owlcarousel/js/owl.carousel.min.js', array(), '20151215', true );

	/*******Tech Custom JS ******/
	wp_enqueue_script( 'tech-custom-js', get_template_directory_uri() . '/js/custom.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
//	if ( is_front_page() ) {
//		wp_enqueue_script( 'mxaxhome', get_template_directory_uri() . '/js/mxax_home.js', array('jquery'), true);
//	};
}
add_action( 'wp_enqueue_scripts', 'pc_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function wpb_widgets_init() {
	register_sidebar( array(
		'name' => 'Header Widget',
		'id' => 'header-widget',
		'before_widget' => '<section class="hw-widget">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="hw-title">',
		'after_title' => '</h2>',
	) );

}
add_action( 'widgets_init', 'wpb_widgets_init' );

//Hide title

function wpb_hidetitle_class($classes) {
	if ( is_home() || is_front_page()  ) :
		$classes[] = 'hidetitle';
		return $classes;
	endif;
	return $classes;
}
add_filter('post_class', 'wpb_hidetitle_class');


function sow_carousel_register_image_sizes_two(){
//	add_image_size('sow-carousel-default', 272, 182, true);
	add_image_size('sow-carousel-default-bigger', 500, 410, true);
}
add_action('init', 'sow_carousel_register_image_sizes_two');

/******************Redirect to TML Registration *******************/
add_filter('pmpro_register_redirect', '__return_false');

/********BackEnd Registration Error Fields***********/
add_filter( 'registration_errors', 'rp_checking_cutom_reg_errors' );
function rp_checking_cutom_reg_errors( $errors ) 
{
	if ( empty( $_POST['first_name'] ) )
		$errors->add( 'empty_first_name', '<strong>ERROR</strong>: Please enter your first name' );
	else if ( empty( $_POST['last_name'] ) )
		$errors->add( 'empty_last_name', '<strong>ERROR</strong>: Please enter your last name' );
	else if ( empty( $_POST['phone'] ) )
		$errors->add( 'empty_phone', '<strong>ERROR</strong>: Please enter your phone number' );
	return $errors;
}

/********BackEnd Registration Update User Fields***********/
add_action( 'user_register', 'rp_updating_user_meta_after_registration' );
function rp_updating_user_meta_after_registration( $user_id ) 
{
	if ( !empty( $_POST['first_name'] ) )
		update_user_meta( $user_id, 'first_name', $_POST['first_name'] );
		update_user_meta( $user_id, 'billing_first_name', $_POST['first_name'] );
		update_user_meta( $user_id, 'pmpro_bfirstname', $_POST['first_name'] );
	if ( !empty( $_POST['last_name'] ) )
		update_user_meta( $user_id, 'last_name', $_POST['last_name'] );
		update_user_meta( $user_id, 'billing_last_name', $_POST['last_name'] );
		update_user_meta( $user_id, 'pmpro_blastname', $_POST['last_name'] );
	if ( !empty( $_POST['phone'] ) )
		update_user_meta( $user_id, 'phone', $_POST['phone'] );
		update_user_meta( $user_id, 'billing_phone', $_POST['phone'] );
		update_user_meta( $user_id, 'pmpro_bphone', $_POST['phone'] );
	if ( !empty( $_POST['age'] ) )
		update_user_meta( $user_id, 'age', $_POST['age'] );
	$setUserRole = new WP_User( $user_id );
	$setUserRole->set_role( 'mens');
}

/********After Registration Auto Login User***********/
/* add_action( 'user_register', 'rp_auto_login_new_user' );
function rp_auto_login_new_user( $user_id ) 
{
	wp_set_current_user($user_id);
	wp_set_auth_cookie($user_id);
	wp_redirect( site_url().'/membership-levels',301);
	wp_new_user_notification();
	exit;
} */

/* add_action( 'edit_user_profile', array( 'PMPro_Approvals', 'show_user_profile_statusCustom' ) );
add_action( 'show_user_profile', array( 'PMPro_Approvals', 'show_user_profile_statusCustom' ) );
function show_user_profile_statusCustom($user)
{
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	if(!empty($_REQUEST['deny']))
	{
		PMPro_Approvals::denyMember(intval($_REQUEST['deny']), $level_id);
		update_user_meta($user->ID,'hellotesting','dddddd');
	}
} */

/****Redirect unregistered users from shop, product, category pages to login page****/
add_action("template_redirect","rp_custom_redirect");
function rp_custom_redirect() 
{
	global $current_user,$woocommerce;
	if( ( is_shop() || is_product() || is_product_category() || is_cart() || is_checkout() ) && ! is_user_logged_in() ) 
	{
		wp_redirect( wp_login_url() );
		exit();
	}
	elseif( ( is_cart() || is_checkout()) && is_user_logged_in() && !$current_user->membership_level->ID) 
	{
		wp_redirect( get_site_url().'/product-category/upcoming-destinations/' );
		exit();
	}
	elseif( ( is_cart() || is_checkout()) && is_user_logged_in() && $current_user->membership_level->ID) 
	{
		$getUserMembeshipLevelID = $current_user->membership_level->ID;
		$getMembershipMeta = "pmpro_approval_$getUserMembeshipLevelID";
		$getMembershipStatus = get_user_meta($current_user->ID,$getMembershipMeta,true);
		if($getMembershipStatus)
		{
			$membershipStatus = $getMembershipStatus['status'];
			if($membershipStatus == 'pending' || $membershipStatus == 'denied')
			{
				wp_redirect( get_site_url().'/product-category/upcoming-destinations/' );
				exit();
			}
		}
		if(isset($_GET['key']) && $_GET['key'] != '')
		{
			$customer_orders = wc_get_orders( $args = array(
			'numberposts' => -1,
			'meta_key'    => '_customer_user',
			'meta_value'  => get_current_user_id(),
			'post_status' => array( 'wc-pending', 'wc-processing', 'wc-on-hold', 'wc-completed' ),
			) );
			$customer_orders_count = count( $customer_orders );
			if(empty($customer_orders_count) || $customer_orders_count == 0 )
			{
				wp_redirect( get_site_url().'/product-category/upcoming-destinations/' );
				exit();
			}
		}
		else
		{
			$customer_orders = wc_get_orders( $args = array(
			'numberposts' => -1,
			'meta_key'    => '_customer_user',
			'meta_value'  => get_current_user_id(),
			'post_status' => array( 'wc-pending', 'wc-processing', 'wc-on-hold', 'wc-completed' ),
			) );
			$customer_orders_count = count( $customer_orders );
			if( ! empty($customer_orders_count) || $customer_orders_count > 0 )
			{
				wp_redirect( get_site_url().'/product-category/upcoming-destinations/' );
				exit();
			}
		}
	}
	elseif( ( is_page(316) || is_page(318) || is_page(439)) && is_user_logged_in()) 
	{
		wp_redirect( get_site_url().'/product-category/upcoming-destinations/' );
		exit();
	}
	elseif( ( is_shop() && is_user_logged_in()) || ( is_shop() && !is_user_logged_in()))
	{
		wp_redirect( get_site_url().'/product-category/upcoming-destinations/' );
		exit();
	}
	
}

/******Restrict logged in user with no subscription to view events but cannot buy*******/
add_filter('woocommerce_get_price_html', 'rp_bbloomer_show_price_logged');
function rp_bbloomer_show_price_logged($price)
{
	global $current_user;
	if(is_user_logged_in() && function_exists('pmpro_hasMembershipLevel') && pmpro_hasMembershipLevel())
	{	
		return $price;
	}
	else
	{
		add_action( 'woocommerce_single_product_summary', 'rp_bbloomer_print_login_to_see', 31 );
		add_action( 'woocommerce_after_shop_loop_item', 'rp_bbloomer_print_login_to_see', 11 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	}
} 
function rp_bbloomer_print_login_to_see() 
{
	global $current_user;
	if(is_user_logged_in())
	{
		$getCurrentUserID = $current_user->ID;
		$getUserInfo = get_userdata($getCurrentUserID);
		if(!in_array("girls",$getUserInfo->roles))
		{
			echo '<a href="' . get_site_url().'/membership-account' . '">' . __('View Membership', 'theme_name') . '</a>';
		}
	}
	else
	{
		echo '<a href="' . wp_login_url() . '">' . __('Login to see prices', 'theme_name') . '</a>';
	}
}

/*****Deactivate Wordfence Plugin from My LocalHost*******/
add_action( 'admin_init', 'rp_deactivate_wordfence_plugin_on_condition' );
function rp_deactivate_wordfence_plugin_on_condition() 
{
	if($_SERVER['SERVER_NAME'] == 'localhost')
	{
		if ( is_plugin_active('wordfence/wordfence.php') ) 
		{
			deactivate_plugins('wordfence/wordfence.php');    
		}
	}
}

/*****Custom Print Function to Output with Pre******/
function pt($data)
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

/*********Adding, Saving, and Showing Text Input For Woocommerce Variations**********/
add_action( 'woocommerce_product_after_variable_attributes', 'rp_variation_settings_fields', 10, 3 );
add_action( 'woocommerce_save_product_variation', 'rp_save_variation_settings_fields', 10, 2 );
function rp_variation_settings_fields( $loop, $variation_data, $variation ) 
{
	woocommerce_wp_text_input
	( 
		array( 
			'id'          => '_text_field[' . $variation->ID . ']', 
			'label'       => __( 'Additional Text Field', 'woocommerce' ), 
			'placeholder' => '',
			'description' => __( 'Enter the custom value here.', 'woocommerce' ),
			'value'       => get_post_meta( $variation->ID, '_text_field', true )
		)
	);
}
function rp_save_variation_settings_fields( $post_id ) 
{
	$text_field = $_POST['_text_field'][ $post_id ];
	if( ! empty( $text_field ) ) 
	{
		update_post_meta( $post_id, '_text_field', esc_attr( $text_field ) );
	}
}

add_filter( 'woocommerce_available_variation', 'rp_load_variation_settings_fields' );
function rp_load_variation_settings_fields( $variations ) 
{
	$variations['_text_field'] = get_post_meta( $variations[ 'variation_id' ], '_text_field', true );
	return $variations;
}

/********Custom Girls Registration Template***********/
define('RP_URL', get_template_directory());
define('RP_FILE_PATH', dirname(__FILE__));
$uploadBaseDirectory = wp_upload_dir()['basedir'];
$uploadBaseUrl = wp_upload_dir()['baseurl'];
define('RP_FILE_PATH_GIRLS_DIR',$uploadBaseDirectory);
define('RP_FILE_PATH_GIRLS_URL',$uploadBaseUrl);
add_shortcode('rp_custom_girls_registration_template','rp_custom_girls_registration_template_fun');
function rp_custom_girls_registration_template_fun()
{
	include_once RP_FILE_PATH.'/templates/girls-registration-template.php'; 
}

/******Custom Girl Registratoin Emails**********/
function prepareGirlsRegEmails($addedUserID,$isSetUserEmail,$isSetDisplayName)
{
	$adminEmail = get_option( 'admin_email' );
	//$adminEmail = 'democoder001@gmail.com';
	$getSiteUrl = get_site_url();
	$emailSubject = 'Registration Successfully';
	$adminEmailSubject = 'New User Registration';
	 
	$emailMessage = 'WELCOME to Paradise Club'
		
	."<br /><br />Thanks $isSetDisplayName for registering in our site $getSiteUrl"
		
	.'<br /><br /><strong>Email Address:</strong> '.$isSetUserEmail

	.'<br /> <br />Kind Regards <br />Paradise Club';
	
	$adminEmailMessage = "New user $isSetDisplayName have registerd in your site $getSiteUrl"
		
	.'<br /><br /><strong>Email Address:</strong> '.$isSetUserEmail

	.'<br /> <br />Kind Regards <br />Paradise Club';
		
	wp_mail($isSetUserEmail, $emailSubject, $emailMessage);
	wp_mail($adminEmail, $adminEmailSubject, $adminEmailMessage);
}

/********Custom Mens Voting Template***********/
add_shortcode('rp_custom_voting_template','rp_custom_voting_template_fun');
function rp_custom_voting_template_fun()
{
	include_once RP_FILE_PATH.'/templates/mens-voting-template.php'; 
}

/********Custom Mens Voting Thank you Template***********/
add_shortcode('rp_custom_voting_thankyou_template','rp_custom_voting_thankyou_template_fun');
function rp_custom_voting_thankyou_template_fun()
{
	include_once RP_FILE_PATH.'/templates/mens-voting-thankyou-template.php'; 
}
 
/*******Admin Dashboard Shows Girls Registrations***********/
add_action('admin_menu', 'rp_allgirlsregistrations');
function rp_allgirlsregistrations() 
{
    add_menu_page( 'View Girls', 'View Girls', 'administrator', 'all-girls-registered', 'allgirlsregisteredfunc', 'dashicons-welcome-view-site', '50');
}
function allgirlsregisteredfunc()
{ 
	include_once RP_FILE_PATH.'/templates/admin-view-registered-girls.php';
}

/******Admin Dashboard Load DataTable Css and Js************/
add_action('admin_enqueue_scripts', 'rp_load_admin_scripts_fun');
function rp_load_admin_scripts_fun()
{
	wp_enqueue_style( 'custom-admin-css', get_template_directory_uri() . '/css/custom-admin.css');
	wp_enqueue_style( 'font-awesome-admin-min-css', get_template_directory_uri() . '/css/font-awesome.css');
	wp_enqueue_style( 'jQuery-dataTableAdmin-css', get_template_directory_uri() . '/datatable/css/jquery.dataTables.css');
	wp_enqueue_script( 'jQuery-dataTableAdmin-Js', get_template_directory_uri() . '/datatable/js/jquery.dataTables.js');
	wp_enqueue_script( 'jQuery-Admin-Validate-Js', get_template_directory_uri() . '/js/jquery.validate.min.js');
	wp_enqueue_script( 'jQuery-Admin-ImgCheckBox-Js', get_template_directory_uri() . '/js/jquery.imgcheckbox.js');
	wp_enqueue_script( 'custom-admin-js', get_template_directory_uri() . '/js/custom-admin.js');
}

/*******************Admin Dashboard Add Loader Image Start**************/
add_action('admin_head','rp_admin_custom_loader_image_fun');
function rp_admin_custom_loader_image_fun()
{	?>
	<script>
	var loaderImage = "<?php echo get_template_directory_uri().'/img/loaderRed.gif'; ?>";
	var wordpressAjaxUrl = "<?php echo get_template_directory_uri().'/customajax.php'; ?>";
	</script>
	<?php 
}

/*********Admin Dashbard Girls Votes Edit Ajax Function Start**********/
add_action( 'wp_ajax_girlsvoteseditbyadmin', 'rp_girlsvoteseditbyadminfunction' );
add_action( 'wp_ajax_nopriv_girlsvoteseditbyadmin', 'rp_girlsvoteseditbyadminfunction' );
function rp_girlsvoteseditbyadminfunction()
{ 
	if( @$_POST['action'] == 'girlsvoteseditbyadmin') 
	{
		global $wpdb;
		$dataUserID = $_POST['dataUserID'];
		$getVoteMessage = '';
		$getUserInfo = get_userdata($dataUserID);
		$errorComing = '';
		if($getUserInfo)
		{
			if(in_array("girls",$getUserInfo->roles))
			{
				$getUserVoteCount = get_user_meta($dataUserID,'admin_set_votes_count',true);
				echo '<div data-user-id="'.$dataUserID.'" class="modal fade emailverified enrolement-popup resend" id="mymodalvotesedit" role="dialog" data-backdrop="static" data-keyboard="false">
					<div class="modal-dialog mycustompopupstyle">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Edit Vote Count?</h4>
							</div>
							<div class="modal-body">
								<form name="editvotebyadmincustomform" id="editvotebyadmincustomform" class="editvotebyadmincustomform" action="#" method="post">
									<div class="resendenquiryloader"></div>
										<div class="result text-center">
											<span class="error"></span>
										</div>		
										<div class="form-group text-area-last">
											<div class="positionrelative">
												<label>Vote Counts <span class="customred">*</span></label>
												<input type="hidden" name="hiddenUserID" id="hiddenUserID" value='.$dataUserID.' />
												<input class="form-control" type="text" name="girlvotescount" id="girlvotescount" value="'.$getUserVoteCount.'" />
											</div> 
										</div>
										<div class="button-section text-left enquirymargintop">
											<button class="btn save-btns updatevotebutton">Update</button>
										</div>
								</form>
							</div>
						</div>
					</div>
				</div>';
			}
			else
			{
				$errorComing = 1;
			}
		}
		else
		{
			$errorComing = 1;
		}
		if($errorComing == 1)
		{
			echo '<div class="modal fade emailverified enrolement-popup resend" id="mymodalvotesedit" role="dialog" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog mycustompopupstyle">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Vote Edit Status ?</h4>
						</div>
						<div class="modal-body">
							<center><p><b>Something Went Wrong..!!</b></p></center>
						</div>
					</div>
				</div>
			</div>';
		}
	}
	die();
}

/*********Admin Dashbard Girls Votes Edit Confirmed Ajax Function Start**********/
add_action( 'wp_ajax_girlsvoteseditbyadminconfirmed', 'rp_girlsvoteseditbyadminconfirmedfunc' );
add_action( 'wp_ajax_nopriv_girlsvoteseditbyadminconfirmed', 'rp_girlsvoteseditbyadminconfirmedfunc' );
function rp_girlsvoteseditbyadminconfirmedfunc()
{ 
	if( @$_POST['action'] == 'girlsvoteseditbyadminconfirmed') 
	{
		global $wpdb;
		$dataUserID = $_POST['dataUserID'];
		$getUserInfo = get_userdata($dataUserID);
		$dataVotesCount = esc_attr($_POST['girlsVotesCount']);
		if(in_array("girls",$getUserInfo->roles))
		{
			if($dataVotesCount !='')
			{
				update_user_meta($dataUserID,'admin_set_votes_count',$dataVotesCount);
				echo json_encode(array('voteStatus'=>true, 'message'=>__('Votes count successfully changed.!!')));
			}
			else
			{
				echo json_encode(array('voteStatus'=>false, 'message'=>__('Input field is blank')));	
			}
		}
		else
		{
			echo json_encode(array('voteStatus'=>false, 'message'=>__('Something went wrong')));	
		}
	}
	die();
}

/*********Admin Dashbard Girls Select Picture Ajax Function Start**********/
add_action( 'wp_ajax_girlspictureselectedbyadmin', 'rp_girlspictureselectedbyadminfunction' );
add_action( 'wp_ajax_nopriv_rp_girlspictureselectedbyadmin', 'rp_girlspictureselectedbyadminfunction' );
function rp_girlspictureselectedbyadminfunction()
{ 
	if( @$_POST['action'] == 'girlspictureselectedbyadmin') 
	{
		global $wpdb;
		$dataUserID = $_POST['dataUserID'];
		$dataImageName = $_POST['dataImageName'];
		$getSelectedPic = '';
		$getUserInfo = get_userdata($dataUserID);
		$errorComing = '';
		$finalValue = '';
		$finalMessage = '';
		if($getUserInfo)
		{
			if(in_array("girls",$getUserInfo->roles))
			{
				$getSelectedPic = get_user_meta($dataUserID,'admin_set_girls_picture',true);
				$getGirlsPictures = get_user_meta($dataUserID,'girls_photos',true);
				if($getGirlsPictures)
				{
					$girlsPhotosDecode = json_decode($getGirlsPictures);
					if($girlsPhotosDecode)
					{
						if(in_array($dataImageName,$girlsPhotosDecode))
						{
							$finalValue = 1;
							$finalMessage = 'Picture Selected Successfully';
							update_user_meta($dataUserID,'admin_set_girls_picture',$dataImageName);
						}
						else
						{
							$finalValue = 1;
							$finalMessage = 'Error - Not found this image in the list';
						}
					}
					else
					{
						$finalValue = 1;
						$finalMessage = 'Error - Not found this image in the list';
					}
				}
				else
				{
					$finalValue = 1;
					$finalMessage = 'Error - Not found this image in the list';
				}
			}
			else
			{
				$finalValue = 1;
				$finalMessage = 'Error - Wrong user role';
			}
		}
		else
		{
			$finalValue = 1;
			$finalMessage = 'Error - No user data found';
		}
		if($finalValue == 1)
		{
			echo '<div class="modal fade emailverified enrolement-popup resend" id="mymodalimageselect" role="dialog" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog mycustompopupstyle">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Picture Selected Status</h4>
						</div>
						<div class="modal-body">
							<center><p><b>'.$finalMessage.'</b></p></center>
						</div>
					</div>
				</div>
			</div>';
		}
	}
	die;
}	

/********Add Action Wp Head & Footer Footer for loading effects********/
add_action('wp_head','rp_load_loading_effects_head');
function rp_load_loading_effects_head()
{ 
	global $current_user;
	if(is_user_logged_in())
	{
		$customer_orders = wc_get_orders( $args = array(
		'numberposts' => -1,
		'meta_key'    => '_customer_user',
		'meta_value'  => get_current_user_id(),
		'post_status' => array( 'wc-pending', 'wc-processing', 'wc-on-hold', 'wc-completed' ),
		) );
		$customer_orders_count = count( $customer_orders );
		if( ! empty($customer_orders_count) || $customer_orders_count > 0 )
		{ ?>
			<style>
			li.onlyafterpurchase{display:block;}
			</style>
		<?php
		}
	}
	if(is_page('voting'))
	{ ?>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/loadingeffects/css/default.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/loadingeffects/css/component.css" />
		<script src="<?php echo get_template_directory_uri() ?>/loadingeffects/js/modernizr.custom.js"></script>
		<?php
	}
}

add_action('wp_footer','rp_load_loading_effects_foot');
function rp_load_loading_effects_foot()
{ 
	if(is_page('voting'))
	{ ?>
		<script src="<?php echo get_template_directory_uri() ?>/loadingeffects/js/masonry.pkgd.min.js"></script>
		<script src="<?php echo get_template_directory_uri() ?>/loadingeffects/js/imagesloaded.js"></script>
		<script src="<?php echo get_template_directory_uri() ?>/loadingeffects/js/classie.js"></script>
		<script src="<?php echo get_template_directory_uri() ?>/loadingeffects/js/AnimOnScroll.js"></script>
		<script>
			new AnimOnScroll( document.getElementById( 'grid' ), 
			{
				minDuration : 0.4,
				maxDuration : 0.7,
				viewportFactor : 0.2
			});
		</script>
		<?php
	}
}
/*Add class-category to body */

add_filter( 'body_class', 'bbloomer_wc_product_cats_css_body_class' );
 
function bbloomer_wc_product_cats_css_body_class( $classes ){
  if( is_singular( 'product' ) )
  {
    $custom_terms = get_the_terms(0, 'product_cat');
    if ($custom_terms) {
      foreach ($custom_terms as $custom_term) {
        $classes[] = 'product_cat_' . $custom_term->term_id;
      }
    }
  }
  return $classes;
}
/*add text after title in loop on category page woocommerce*/
add_action( 'woocommerce_after_shop_loop_item_title', 'add_text_in_loop' );
function add_text_in_loop (){
		echo ("<div class='description'>");
		echo the_excerpt();
		echo("</div>");
}
/**
 * Change text strings
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function my_text_strings( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'Related products' :
			$translated_text = __( 'Related destinations', 'woocommerce' );
			break;
		}
	return $translated_text;
}
add_filter( 'gettext', 'my_text_strings', 20, 3 );

/******Woocommerce only one product in cart and check if tour already purchased*******/
add_filter( 'woocommerce_add_to_cart_validation', 'rp_bbloomer_only_one_in_cart', 99, 2 );
function rp_bbloomer_only_one_in_cart( $passed, $added_product_id ) 
{
	global $woocommerce, $current_user;
	$woocommerce->cart->empty_cart();
	wc_add_notice( 'Product added to cart!', 'notice' );
	
	if(is_user_logged_in())
	{
		$getUserMembeshipLevelID = $current_user->membership_level->ID;
		$getMembershipMeta = "pmpro_approval_$getUserMembeshipLevelID";
		$getMembershipStatus = get_user_meta($current_user->ID,$getMembershipMeta,true);
		if($getMembershipStatus)
		{
			$membershipStatus = $getMembershipStatus['status'];
			if($membershipStatus == 'pending')
			{
				wc_add_notice( 'Your membership status in pending', 'error' );
				$passed = false;
			}
			elseif($membershipStatus == 'denied')
			{
				wc_add_notice( 'Your membership status in denied', 'error' );
				$passed = false;
			}
		}
	}
	
	$customer_orders = wc_get_orders( $args = array(
	'numberposts' => -1,
	'meta_key'    => '_customer_user',
	'meta_value'  => get_current_user_id(),
	'post_status' => array( 'wc-pending', 'wc-processing', 'wc-on-hold', 'wc-completed' ),
	) );
	$customer_orders_count = count( $customer_orders );
	if( ! empty($customer_orders_count) || $customer_orders_count > 0 )
	{
		wc_add_notice( 'You are not allowed yet to add any product in cart', 'error' );
		$passed = false;
	}
	return $passed;
}

/****Mens Votes for girls ajax function start*******/
add_action( 'wp_ajax_mensvotesforgirls', 'mensvotesforgirlsfunc' );
add_action( 'wp_ajax_nopriv_mensvotesforgirls', 'mensvotesforgirlsfunc' );
function mensvotesforgirlsfunc()
{ 
	if( @$_POST['action'] == 'mensvotesforgirls') 
	{
		global $wpdb, $current_user;
		$getMenID = $current_user->ID;
		$getMenInfo = get_userdata($getMenID);
		$dataGirlID = $_POST['dataGirlID'];
		$getGirlInfo = get_userdata($dataGirlID);
		if($getGirlInfo && $getMenInfo)
		{
			if(in_array("girls",$getGirlInfo->roles) && in_array("mens",$getMenInfo->roles))
			{
				$checkAlreadyVoted = get_user_meta($current_user->ID,'men_already_voted',true);
				if($checkAlreadyVoted)
				{
					$errorComing = 1;
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
						$errorComing = 1;
					}
					else
					{
						echo '<div class="modal fade emailverified enrolement-popup resend" id="mymodalvotesforgirls" role="dialog" data-backdrop="static" data-keyboard="false">
							<div class="modal-dialog mycustompopupstyle">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Vote Status ?</h4>
									</div>
									<div class="modal-body">
										<center><p><b>Are you sure you want to vote for this girl ?</b></p></center>
									</div>
									 <div class="modal-footer">
										<button type="button" class="btn btn-default" id="mensvotesforgirlsconfirmed" data-dismiss="modal">Yes</button>
										<button type="button" class="btn btn-primary" id="modal-btn-no" data-dismiss="modal">No</button>
									</div>
							</div>
						</div>';
					}
				}
			}
			else
			{
				$errorComing = 1;
			}
		}
		else
		{
			$errorComing = 1;
		}
		if($errorComing == 1)
		{
			echo '<div class="modal fade emailverified enrolement-popup resend" id="mymodalvotesforgirls" role="dialog" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog mycustompopupstyle">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Vote Status ?</h4>
						</div>
						<div class="modal-body">
							<center><p><b>Something Went Wrong..!!</b></p></center>
						</div>
					</div>
				</div>
			</div>';
		}
	}
	die;
}

add_action( 'wp_ajax_mensvotesforgirlsconfirmed', 'mensvotesforgirlsconfirmedfunc' );
add_action( 'wp_ajax_nopriv_mensvotesforgirlsconfirmed', 'mensvotesforgirlsconfirmedfunc' );
function mensvotesforgirlsconfirmedfunc()
{ 
	if( @$_POST['action'] == 'mensvotesforgirlsconfirmed') 
	{
		global $wpdb, $current_user;
		$getMenID = $current_user->ID;
		$getMenInfo = get_userdata($getMenID);
		$dataGirlID = $_POST['dataGirlID'];
		$getGirlInfo = get_userdata($dataGirlID);
		if($getGirlInfo && $getMenInfo)
		{
			if(in_array("girls",$getGirlInfo->roles) && in_array("mens",$getMenInfo->roles))
			{
				$checkAlreadyVoted = get_user_meta($current_user->ID,'men_already_voted',true);
				if($checkAlreadyVoted)
				{
					$errorComing = 1;
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
						$errorComing = 1;
					}
					else
					{
						update_user_meta($current_user->ID,'men_already_voted',$dataGirlID);
						prepareMensEmailAfterVoting($current_user->ID,$dataGirlID);
						echo '<div class="modal fade emailverified enrolement-popup resend" id="mymodalvotesforgirlsconfirmed" role="dialog" data-backdrop="static" data-keyboard="false">
							<div class="modal-dialog mycustompopupstyle">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close redirectafterclose" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Vote Status ?</h4>
									</div>
									<div class="modal-body">
										<center><p><b>Successfully voted for this girl</b></p></center>
									</div>
							</div>
						</div>';
					}
				}
			}
			else
			{
				$errorComing = 1;
			}
		}
		else
		{
			$errorComing = 1;
		}
		if($errorComing == 1)
		{
			echo '<div class="modal fade emailverified enrolement-popup resend" id="mymodalvotesforgirls" role="dialog" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog mycustompopupstyle">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Vote Status ?</h4>
						</div>
						<div class="modal-body">
							<center><p><b>Something Went Wrong..!!</b></p></center>
						</div>
					</div>
				</div>
			</div>';
		}
	}
	die;
}

/*****Email Send to Men after Successfully Vote******/
function prepareMensEmailAfterVoting($dataMenID,$dataGirlID)
{
	$getSiteUrl = get_site_url();
	$getMenInfo = get_userdata( $dataMenID );
	$getMenDisplayName = $getMenInfo->display_name;
	$getMenEmail = $getMenInfo->user_email;
	$getGirlInfo = get_userdata( $dataGirlID );
	$getGirlDisplayName = $getGirlInfo->display_name;
	$emailSubject = 'Thanks for voting';
	$emailMessage = "Thanks $getMenDisplayName for voting, Girl $getGirlDisplayName will go with you."
	
	.'<br /> <br />Kind Regards <br />Paradise Club';
	
	wp_mail($getMenEmail, $emailSubject, $emailMessage);
}

/******trim zeros from  price*****/
 add_filter( 'woocommerce_price_trim_zeros', '__return_true' );
