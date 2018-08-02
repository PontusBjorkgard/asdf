<?php
require get_template_directory() . '/inc/theme-settings/settings-class.php';



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
	'type'            => 'checkbox',
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

$page->create_settings();
$navigation->create_settings();
