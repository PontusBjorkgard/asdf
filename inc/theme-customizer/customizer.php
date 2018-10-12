<?php


require get_template_directory() . '/inc/theme-customizer/customizer-styles.php';


// Customizer sections init
function themeslug_customize_register( $wp_customize ) {

  $wp_customize->add_panel( 'colors', array(
   'title' => __( 'Colors' ),
   'description' => __( 'Customize colors' ),
   'priority' => 160,
   'capability' => 'edit_theme_options',
  ));

     $wp_customize->add_section( 'bg-colors', array(
      'title' => __( 'Background colors' ),
      'description' => __( 'Customize bg colors' ),
      'panel'   =>'colors',
      'capability' => 'edit_theme_options',
      ));

         $wp_customize->add_setting( 'background-footer', array(
         'type' => 'theme_mod', // or 'option'
         'capability' => 'edit_theme_options',
         'theme_supports' => '', // Rarely needed.
         'default' => '',
         'transport' => 'refresh', // or postMessage
         'sanitize_callback' => '',
         'sanitize_js_callback' => '', // Basically to_json.
        ));

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background-footer', array(
         'type' => 'color',
         'priority' => 10, // Within the section.
         'section' => 'bg-colors', // Required, core or custom.
         'label' => __( 'Footer BG color' ),
         'description' => __( 'Footer background color' ),
         'active_callback' => 'is_front_page',
       )));

        $wp_customize->add_setting( 'background-navbar', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'theme_supports' => '', // Rarely needed.
        'default' => '',
        'transport' => 'refresh', // or postMessage
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background-navbar', array(
        'type' => 'color',
        'priority' => 10, // Within the section.
        'section' => 'bg-colors', // Required, core or custom.
        'label' => __( 'Navbar BG color' ),
        'description' => __( 'Navbar background color' ),
        'active_callback' => 'is_front_page',
      )));

        $wp_customize->add_setting( 'background-page', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'theme_supports' => '', // Rarely needed.
        'default' => '',
        'transport' => 'refresh', // or postMessage
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background-page', array(
        'type' => 'color',
        'priority' => 10, // Within the section.
        'section' => 'bg-colors', // Required, core or custom.
        'label' => __( 'Page BG color' ),
        'description' => __( 'Page background color' ),
        'active_callback' => 'is_front_page',
      )));

      $wp_customize->add_setting( 'background-branding', array(
      'type' => 'theme_mod', // or 'option'
      'capability' => 'edit_theme_options',
      'default' => 'black',
      'transport' => 'refresh', // or postMessage
      'sanitize_callback' => '',
      'sanitize_js_callback' => '', // Basically to_json.
      ) );

      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background-branding', array(
      'type' => 'color',
      'priority' => 10, // Within the section.
      'section' => 'bg-colors', // Required, core or custom.
      'label' => __( 'branding BG color' ),
      'description' => __( 'Branding background color' ),
      'active_callback' => 'is_front_page',
    )));

    $wp_customize->add_section( 'text-colors', array(
     'title' => __( 'Text colors' ),
     'description' => __( 'Customize text colors' ),
     'panel'   =>'colors',
     'capability' => 'edit_theme_options',
     ));
         $wp_customize->add_setting( 'color-p', array(
         'type' => 'theme_mod', // or 'option'
         'capability' => 'edit_theme_options',
         'theme_supports' => '', // Rarely needed.
         'default' => 'black',
         'transport' => 'refresh', // or postMessage
         'sanitize_callback' => '',
         'sanitize_js_callback' => '', // Basically to_json.
        ));

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color-p', array(
         'type' => 'color',
         'priority' => 10, // Within the section.
         'section' => 'text-colors', // Required, core or custom.
         'label' => __( 'P color' ),
         'description' => __( 'P color' ),
         'active_callback' => 'is_front_page',
       )));





       //Post type specific
       $wp_customize->add_panel( 'post-type', array(
        'title' => __( 'Post types' ),
        'description' => __( '' ),
        'priority' => 160,
        'capability' => 'edit_theme_options',
       ));

       $post_types = array( get_post_type_object( 'post' ) );

       // Get custom post types as objects. Returns associative array
       $custom_types = get_post_types( array( 'public' => true, '_builtin' => false ), 'objects');

       // Add $custom_types associative array to $post_types numeric array
       foreach ($custom_types as $type ) {
         $post_types[] = $type;
       }

       for( $i = 0; $i < sizeof($post_types); $i++ ) {
         $wp_customize->add_section( $post_types[$i]->name, array(
          'title' => $post_types[$i]->label,
          'description' => __( 'Customize bg colors' ),
          'panel'   =>'post-type',
          'capability' => 'edit_theme_options',
          ));

          $wp_customize->add_setting( $post_types[$i]->name .'-post-thumbnail' );

          $wp_customize->add_control( $post_types[$i]->name .'-post-thumbnail', array(
            'label' => __('Show thumbnail in ') . $post_types[$i]->name,
            'type' => 'checkbox',
            'priority' => 10, // Within the section.
            'section' => $post_types[$i]->name
          ));

        }


}
add_action( 'customize_register', 'themeslug_customize_register' );






 ?>
