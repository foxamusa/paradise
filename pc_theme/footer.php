<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pardise_CLub_Theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info col-md-4">
			All rights &copy; <a href="/">Concord Pacific</a>
		</div><!-- .site-info -->
		<div class="site-info col-md-4 col-xs-12 text-center">
			<a href="#" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			<a href="#" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
			<a href="#" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->


<!--link href="<?php echo get_template_directory_uri() ?>/photouploader/jquery.fileuploader.css" media="all" rel="stylesheet">
<script src="<?php echo get_template_directory_uri() ?>/photouploader/jquery.fileuploader.min.js" type="text/javascript"></script-->
<script>
var loaderImage = "<?php echo get_template_directory_uri().'/img/loaderRed.gif'; ?>";
var wordpressAjaxUrl = "<?php echo get_template_directory_uri().'/customajax.php'; ?>";
var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
var thankyouUrl = "<?php echo get_site_url().'/voting-thank-page' ?>";
</script>
<?php wp_footer(); ?>
</body>
</html>