<?php

/*
*     Main options
*/
$page = new OptionsPage( array(
  'name' => 'Asdf settings',
  'menu-name' => 'Asdf',
  'slug' => 'asdf-admin',
	'sections' => array( 'Main' )
));


/*
*     Navigation options page
*/
$navigation = new Subpage( $page, array(
  'name'        =>  'Navigation Settings',
  'menu-name'   =>  'Navigation',
  'slug'        => 'asdf-admin-navigation',
  'sections'    =>  array( 'Layout' )
));

/*
*     Navigation options
*/
$navigation->options[] = array(
  'option_name'     => 'Main Navigation Layout',
  'option_slug'     => 'main-navigation-layout',
	'option_section'  => 'layout',
	'type'            => 'radio',
  'htmlclass'       => 'asdf-option-radio big',
	'values'          => array( 'navigation-horizontal', 'navigation-vertical' )
);



$page->hook_create_settings();
$navigation->hook_create_settings();
