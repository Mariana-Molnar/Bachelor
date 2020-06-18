<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package creativeboost
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'cfood'); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="header-block">
				<nav id="site-navigation" class=" row main-navigation desktop-menu">
					<?php
					wp_nav_menu([
						'theme_location' => 'left-menu',
						'menu_id'        => 'left-menu',
					]);
					?>

					<div class="site-branding">
						<?php
						the_custom_logo();
						if (is_front_page()) :
							?>
							<a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
						<?php
						endif; ?>
					</div><!-- .site-branding -->

					<?php
					wp_nav_menu([
						'theme_location' => 'right-menu',
						'menu_id'        => 'right-menu',
					]);
					?>

				</nav><!-- #site-navigation -->

				<div class="site-branding mobile-logo">
					<?php the_custom_logo(); ?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation mobile-menu">

					<?php
					wp_nav_menu([
						'theme_location' => 'primary',
						'menu_id'        => 'primary',
					]);
					?>
				</nav>

				<div class="hamburger-menu">
					<span></span>
				</div>
			</div>
		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
