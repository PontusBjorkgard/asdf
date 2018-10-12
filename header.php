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
		<nav id="main-navigation" class="navbar navbar-light main-navigation"> <!-- Bootstrap nav container Start -->

			<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$image = wp_get_attachment_image_src( $custom_logo_id , 'asdf-logo' );
					?>
					<img src="<?php echo $image[0]; ?>" height="100">
			</a>
			<div class="desktop-nav">
				<?php
						wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
						));
				?>
			</div>
			<!-- mobile nav -->

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
	    		<span class="navbar-toggler-icon"></span>
	  		</button>
				<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
				<?php
				wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
				));
				?>
			</div>



		</nav> <!-- #main-navigation -->
	</header> <!-- #masthead -->

	<?php
	//banner
	get_template_part( 'template-parts/banner' );
	?>

	<div id="content" class="<?php echo asdf_get_option( 'container-width' ) ?>">
		<div class="row">
			<div id="primary" class="col">
				<main id="main" class="site-main row">
