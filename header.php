<?php
/**
 * The header for Golpo theme.
 * 
 * User Profile: https://profiles.wordpress.org/fahimmurshed
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Golpo
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="masthead" class="site-header" role="banner">
		<div class="container">
		<div class="row">
			<div class="col-sm main-menu">
			<div class="container">
			<nav class="navbar navbar-expand-md navbar-dark bg-transparent" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-golpo-navbar-collapse" aria-controls="bs-golpo-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

			<?php
			wp_nav_menu( array(
				'theme_location'	=> 'primary',
				'depth'				=>  5, // 1 = with dropdowns, 0 = no dropdowns.
				'container'			=> 'div',
				'container_class'	=> 'collapse navbar-collapse',
				'container_id'		=> 'bs-golpo-navbar-collapse',
				'menu_class'		=> 'navbar-nav mr-auto',
				'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
				'walker'			=> new WP_Bootstrap_Navwalker()
			) );?>
			</nav>
			</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm">
				<div class="site-branding text-center">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					<?php
					if ( function_exists( 'the_custom_logo' ) ) {
						the_custom_logo();
					}
					?>
				</div><!-- .site-branding -->
			</div>
		</div>
	</div>
	</header><!-- #masthead -->