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
	'choices'          => array( 'navigation-horizontal', 'navigation-vertical' )
);

$navigation->options[] = array(
  'option_name'     => 'Microwidgets',
  'option_slug'     => 'list-test',
	'option_section'  => 'layout',
	'type'            => 'sortable',
  'htmlclass'       => 'asdf-option-radio big',
);


/*
*     Layout options page
*/

$posttypes = array( 'post' );
foreach ( get_post_types( array('_builtin' => false) ) as $post_type) {
  $posttypes[] = $post_type;
}
$layoutPage = new Subpage( $page, array(
  'name'        => 'Layout Settings',
  'menu-name'   => 'Layout',
  'slug'        => 'asdf-admin-layout',
  'sections'    =>  $posttypes
));

$layoutPage->options[] = array(
  'option_name'     => 'Container width',
  'option_slug'     => 'post-single-container-width',
  'option_section'  => 'post',
  'type'            => 'radio',
  'htmlclass'       => 'asdf-radio',
  'description'     => 'Width of the main container',
  'choices'         =>  array( 'container', 'container-fluid' ),
  'choices_labels'   =>  array( 'Normal', 'Fullwdidth' )
);

$layoutPage->options[] = array(
  'option_name'     => 'Number of columns',
  'option_slug'     => 'post-column-quantity',
  'option_section'  => 'post',
  'type'            => 'select',
  'htmlclass'       => 'asdf-number',
  'description'     => 'Number of columns per row',
  'choices'         =>  array( 'col-12', 'col-6', 'col-4' ),
  'choices_labels'   =>  array( '1', '2', '3' )
);





$page->hook_create_settings();
$navigation->hook_create_settings();
$layoutPage->hook_create_settings();
