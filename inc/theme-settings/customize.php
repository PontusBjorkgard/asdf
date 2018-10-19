<?php

// PONT I HESA
add_action('customize_register','my_customize_register');
function my_customize_register( $wp_customize ) {

  $wp_customize->add_panel( 'exempel-panel', array(
    'title' => 'Exempel Panel', 'priority' => 1 ));

  $wp_customize->add_section( 'exempel-section', array(
    'title' => 'Exempel Sektion',
    'panel' => 'exempel-panel' ));

  $wp_customize->add_setting( 'exempel-setting' );

  $wp_customize->add_control( 'exempel-setting', array(
    'label'   => 'Exempel Inställning',
    'section' => 'exempel-section' ));
}
