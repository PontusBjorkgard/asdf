<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package asdf
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'asdf' ); ?></a>

	<header id="masthead" class="site-header">
		<nav id="main-navigation" class="navbar navbar-light bg-light main-navigation"> <!-- Bootstrap nav container Start -->
			<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
				?>
				<img src="<?php echo $image[0]; ?>" height="100">
			</a>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				));
			?>
		</nav> <!-- #main-navigation -->


	</header> <!-- #masthead -->

	<?php asdf_hero() ?>

	<div id="content" <?php asdf_container_class(); ?>>
		<div class="row">
			<div id="primary" <?php asdf_sidebar_active( 'primary' ) ?> >
				<main id="main" class="site-main">
