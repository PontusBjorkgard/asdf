<?php
require get_template_directory() . '/inc/theme-settings/media-uploader/media-uploader.php';

require get_template_directory() . '/inc/theme-settings/settings-class.php';

require get_template_directory() . '/inc/theme-settings/settings-instantiation.php';

require get_template_directory() . '/inc/theme-settings/settings-implementation.php';


add_action( 'admin_enqueue_scripts', 'asdf_admin_scripts_fn' );
function asdf_admin_scripts_fn() {
  wp_enqueue_style('asdf-admin-css', get_stylesheet_directory_URI() . '/inc/theme-settings/settings-style.css');
  wp_enqueue_script('402-media-file-uploader-js', get_stylesheet_directory_URI() . '/inc/theme-settings/media-uploader/media-uploader.js', array('jquery'), '1.0', true);
  wp_enqueue_media();
}


//customizer test

function mytheme_customize_register( $wp_customize ) {

  $posttypes = get_post_types();
  $wp_customize->add_section( $posttypes[0] , array(
   'title'      => __( 'Visible Section Name', 'mytheme' ),
   'priority'   => 30,
 ));

$wp_customize->add_setting( 'setting_id', array(
  'type' => 'theme_mod', // or 'option'
  'capability' => 'edit_theme_options',
  'theme_supports' => '', // Rarely needed.
  'default' => '',
  'transport' => 'refresh', // or postMessage
  'sanitize_callback' => '',
  'sanitize_js_callback' => '', // Basically to_json.
) );

$wp_customize->add_control( 'setting_id', array(
  'type' => 'date',
  'priority' => 10, // Within the section.
  'section' => 'mytheme_new_section_name', // Required, core or custom.
  'label' => __( 'Date' ),
  'description' => __( 'This is a date control with a red border.' ),
  'input_attrs' => array(
    'class' => 'my-custom-class-for-js',
    'style' => 'border: 1px solid #900',
    'placeholder' => __( 'mm/dd/yyyy' ),
  ),
  'active_callback' => 'is_front_page',
) );
}
add_action( 'customize_register', 'mytheme_customize_register' );
