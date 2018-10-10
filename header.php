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


	<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4"> <?php single_post_title(); ?></h1>
  </div>
</div>

	<div id="content" class="<?php echo asdf_get_option( 'container-width' ) ?>">
		<div class="row">
			<div id="primary" class="col">
				<main id="main" class="site-main">
