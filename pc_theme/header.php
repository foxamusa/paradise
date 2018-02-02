<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pardise_CLub_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pc_theme' ); ?></a>

    <header id="masthead" class="site-header">
		<?php 
			if ( is_front_page() && is_active_sidebar( 'header-widget' ) ) : ?>
            <div id="header-widget-area" class="hw-widget widget-area" role="complementary">
                <!-- <i class="play-header-video vid-paused"></i> -->

                <?php dynamic_sidebar( 'header-widget' ); ?>
            </div>

		<?php endif; ?>
        <div class="master-head">
    <!--        <div class="main-mute-btn volume-off"></div> -->
            <div class="container">
                <div class="row">
                    <div class="site-branding col-xs-4 col-md-1"> <!-- col-md-2 -->
                        <div class="logo">
							<?php the_custom_logo(); ?>
                        </div>
                    </div><!-- .site-branding -->
                    <nav id="site-navigation" class="main-navigation col-xs-8 col-md-10">
								<?php if (is_user_logged_in()){ ?>
									<div class="user-avatar">
										<a href="/my-account"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
									</div>
								<?php } ?>
                        <button class="menu-toggle" aria-controls="primary-menu"
                                aria-expanded="false"></button>
						<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						) );
						?>
                    </nav><!-- #site-navigation -->
                    <nav id="site-navigation-pc" class="main-navigation-pc col-xs-8 col-md-11">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						) );
						?>
                    </nav><!-- #site-navigation -->
					<?php if (is_user_logged_in()){ ?>
					<div class="user-avatar desc">
						<a href="/my-account"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
					</div>
					<?php } ?>
                </div>
            </div>
        </div>
    </header><!-- #masthead -->

    <div id="content" class="site-content">
