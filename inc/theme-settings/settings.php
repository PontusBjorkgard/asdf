<?php
require get_template_directory() . '/inc/theme-settings/settings-class.php';
add_action( 'admin_enqueue_scripts', 'asdf_admin_styles_fn' );
function asdf_admin_styles_fn() {
  wp_enqueue_style('asdf-admin-css', get_stylesheet_directory_URI() . '/inc/theme-settings/settings-style.css');
}


$page = new OptionsPage( array(
  'name' => 'Asdf settings',
  'menu-name' => 'Asdf',
  'slug' => 'asdf-admin',
	'sections' => array( 'Main' )
));

$page->options[] = array(
	'option_name' => 'Theme style',
	'option_section' => 'main',
	'type' => 'text'
);

$navigation = new Subpage( $page, array(
  'name'        =>  'Navigation Settings',
  'menu-name'   =>  'Navigation',
  'slug'        => 'asdf-admin-navigation',
  'sections'    =>  array( 'Layout' )
));

$navigation->options[] = array(
  'option_name'     => 'Main Navigation Layout',
	'option_section'  => 'layout',
	'type'            => 'radio',
  'htmlclass'       => 'asdf-option-radio big',
	'values'          => array( 'navigation-horizontal', 'navigation-vertical' )
);

/*
$navbarPage = new SubPage( $page, array(
  'name' => 'Navbar settings',
  'menu-name' => 'Navbar',
  'slug' => 'pampas-admin-nav',
	'sections' => array( 'Layout', 'Colors' )
));

$navbarPage->options[] = array(
	'option_name' => 'Navbar layout',
	'option_section' => 'layout',
	'type' => 'checkbox',
	'values' => array( 'Align left', 'Center' )
);
*/

//$navbarPage->create_settings();

$page->hook_create_settings();
$navigation->hook_create_settings();
