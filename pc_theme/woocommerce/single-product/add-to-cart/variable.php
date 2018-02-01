<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $current_user;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); 
$customer_orders = wc_get_orders( $args = array(
'numberposts' => -1,
'meta_key'    => '_customer_user',
'meta_value'  => get_current_user_id(),
'post_status' => array( 'wc-pending', 'wc-processing', 'wc-on-hold', 'wc-completed' ),
) );
$valuetoShow = '';
$dynamicButtonCondName = '';
$customer_orders_count = count( $customer_orders );
if( ! empty($customer_orders_count) || $customer_orders_count > 0 )
{
	$valuetoShow = 1;
	$dynamicButtonCondName = 'Already Purchased';
}
$getUserMembeshipLevelID = $current_user->membership_level->ID;
$getMembershipMeta = "pmpro_approval_$getUserMembeshipLevelID";
$getMembershipStatus = get_user_meta($current_user->ID,$getMembershipMeta,true);
if($getMembershipStatus)
{
	$membershipStatus = $getMembershipStatus['status'];
	if($membershipStatus == 'pending')
	{
		$valuetoShow = 1;
		$dynamicButtonCondName = 'Approval Pending';
	}
	if($membershipStatus == 'denied')
	{
		$valuetoShow = 1;
		$dynamicButtonCondName = 'Membership Denied';
	}
}
?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ) ?>">
	<?php
	$product_variations = $product->get_available_variations();
	if ( !empty( $product_variations ) ) 
	{
		?>
		<div class="woocommerce-variation single_variation1">
		<style type="text/css">
			#id-<?php echo get_the_ID();?> .carousel-slider-nav-icon {
				fill: #f1f1f1
			}
			#id-<?php echo get_the_ID();?> .carousel-slider-nav-icon:hover {
				fill: #ff0000
			}
			#id-<?php echo get_the_ID();?> .owl-prev,
			#id-<?php echo get_the_ID();?> .owl-next,
			#id-<?php echo get_the_ID();?> .carousel-slider-nav-icon {
				height: 32px;
				width: 32px;
				padding: inherit;
				background: none;
				margin-top:-10px;
			}
			#id-<?php echo get_the_ID();?>.arrows-outside .owl-prev {
				left: -32px
			}
			#id-<?php echo get_the_ID();?>.arrows-outside .owl-next {
				right: -32px
			}
		
			#id-<?php echo get_the_ID();?> .owl-dots .owl-dot span {
				background-color: #dedede;
				width: 10px;
				height: 10px;
			}
			#id-<?php echo get_the_ID();?> .owl-dots .owl-dot.active span,
			#id-<?php echo get_the_ID();?> .owl-dots .owl-dot:hover span {
				background-color: #ff0000
			}
			</style>
			<?php
			foreach($product_variations as $key=>$product_variation) 
			{
				//pt($product_variation);
				$product_attribute_variationSlug = $product_variation['attributes']['attribute_pa_room-type'];
				$product_attribute_variationID = $product_variation['variation_id'];
				$product_attribute_name = $product_variation['attributes']['attribute_pa_room-type'];
				$product_attribute_image = $product_variation['image']['thumb_src'];
				$product_attribute_desc = $product_variation['variation_description'];
				$product_attribute_desc = $product_variation['variation_description'];
				$product_attribute_adult_price = $product_variation['price_html'];
				$product_attribute_child_price = $product_variation['_child_price'];
				$product_attribute_infant_price = $product_variation['_infant_price'];
				
				echo '<div class="custominternalvariations">';
				foreach($product_variation['attributes'] as $key => $val ) 
				{
					$val = str_replace(array('-','_'), ' ', $val);
					echo '<h1>'.$val.'</h1>';
				} ?>
				<div class="woocommerce-variation-description-custom">
					<?php echo $product_attribute_desc; ?>
				</div>
				<div class="product-variation-image product-variation-<?php echo $product_attribute_name ?>" id="product-variation-<?php echo $product_variation['variation_id']; ?>" data-attribute="<?php echo $product_attribute_name ?>">
					<?php 
					$product_attribute_images = $product_variation['jck_additional_images'];
					if($product_attribute_images)
					{
						echo '<div id="id-'.get_the_ID().'" class="room_attribute_carousel owl-carousel owl-theme carousel-slider arrows-inside arrows-visible-hover dots-hidden dots-center dots-square owl-loaded owl-drag">';
						foreach($product_attribute_images as $product_attribute_imagesValue)
						{
							$product_attribute_imagesValueLarge = $product_attribute_imagesValue['large'][0];
							$product_attribute_imagesValueSingle = $product_attribute_imagesValue['single'][0];
							$product_attribute_imagesValueThumb = $product_attribute_imagesValue['thumb'][0];
							 ?>
							<div class="carousel-slider__item">
								<a href="<?php echo $product_attribute_imagesValueLarge; ?>" class="magnific-popup imagepositionabsolute">
									<img class="" data-src="<?php echo $product_attribute_imagesValueSingle;?>" src="<?php echo $product_attribute_imagesValueSingle;?>" style="opacity: 1;" />
								</a>
							</div>
							<?php 								
						}
						echo '</div>';
					}
					else
					{	
						?>
						<img src="<?php echo wc_placeholder_img_src();?>" />
						<?php
					}					
					?>
				</div>
				<br />
				<?php
				if($valuetoShow == 1)
				{	?>
					<a class="button alt" disabled><?php echo $dynamicButtonCondName;?></a>
					<?php
				}
				else
				{ ?>
					<a data-var-name="<?php echo $val; ?>" data-slug="<?php echo $product_attribute_variationSlug; ?>" data-product-id="<?php echo get_the_ID(); ?>" data-variation-id="<?php echo $product_attribute_variationID; ?>" id="custombooknowclick" type="submit" class="custombooknowclick button">Book Now	</a>
					<?php
				}	?>
				<br /><br />
				</div>
				<?php 
			 } ?>
		</div>
		<?php 
	} ?>
	<?php 
	if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<tr>
						<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
						<td class="value">
							<?php
								$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( stripslashes( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) ) : $product->get_variation_default_attribute( $attribute_name );
								wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
								echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) : '';
							?>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		<div class="single_variation_wrap">
			<?php
				/**
				 * woocommerce_before_single_variation Hook.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				 ?>
				<div class="modal fade emailverified custommodal " id="myModalShowEmailMessages" role="dialog" >
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title custompopupheading">Book</h4>
							</div>
							<div class="modal-body">
								<p><?php 
								do_action( 'woocommerce_before_variations_form' ); 
								do_action( 'woocommerce_single_variation' ); ?></p>
							</div>
						</div>
					</div>
				</div>
				<?php
				/**
				 * woocommerce_after_single_variation Hook.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
		
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
