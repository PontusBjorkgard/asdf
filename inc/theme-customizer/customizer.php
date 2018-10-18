<?php

//Controls JS API
function enqueue_customizer_controls_js() {
    wp_enqueue_script( 'asdf_customizer_control', get_template_directory_uri() . '/inc/theme-customizer/customizer-controls.js', array( 'customize-controls', 'jquery' ), null, true );
}
add_action( 'customize_controls_enqueue_scripts', 'enqueue_customizer_controls_js' );

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
       )));





       //Post type specific
       $wp_customize->add_panel( 'singles', array(
        'title' => __( 'Singles' ),
        'description' => __( '' ),
        'capability' => 'edit_theme_options',
       ));

       $wp_customize->add_panel( 'archives', array(
        'title' => __( 'Archives' ),
        'description' => __( '' ),
        'capability' => 'edit_theme_options',
       ));

       $post_types = array( get_post_type_object( 'post' ) );
       $custom_types = get_post_types( array( 'public' => true, '_builtin' => false ), 'objects');
       // Add $custom_types associative array to $post_types numeric array
       foreach ($custom_types as $type ) {
         $post_types[] = $type;
       }

       $elements = array( 'thumbnail', 'date', 'author', 'comment', 'title', 'categories', 'content', 'readmore', 'tags' );
       for( $i = 0; $i < sizeof($post_types); $i++ ) {




         //Single settings
         $wp_customize->add_section( $post_types[$i]->name . '-single', array(
          'title' => $post_types[$i]->label,
          'description' => __( 'Visible elements in ' ) . $post_types[$i]->label,
          'panel'   =>'singles',
          'capability' => 'edit_theme_options',
          ));

          // Banner
          $wp_customize->add_setting( $post_types[$i]->name . '-single-banner-type' );
          $wp_customize->add_control( $post_types[$i]->name . '-single-banner-type', array(
           'type'  => 'radio',
           'choices' => array(
             'featured-image-banner' => __( 'Featured Image Banner', 'asdf' ),
             'custom-banner'    => __( 'Custom Banner', 'asdf' ),
             'no-banner' => __( 'No banner', 'asdf' )
           ),
           'label' => __( 'Banner type' ),
           'description' => __( 'Banner type' ),

           'section' => $post_types[$i]->name . '-single',
          ));

          $wp_customize->add_setting( $post_types[$i]->name . '-single-custom-banner' );
          $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $post_types[$i]->name . '-single-custom-banner', array(
           'section' => $post_types[$i]->name . '-single',
           'label' => __( 'Banner image' ),
           'description' => __( 'Banner image' ),
          )));


          $wp_customize->add_setting( $post_types[$i]->name . '-single-banner-height' );
          $wp_customize->add_control( $post_types[$i]->name . '-single-banner-height', array(
           'type'  => 'text',
           'label' => __( 'Banner height' ),
           'description' => __( 'Banner height' ),
           'section' => $post_types[$i]->name . '-single',
          ));

        // elements
         for ($y = 0; $y < sizeof($elements); $y++ ) {
           $wp_customize->add_setting( $post_types[$i]->name . '-single-' . $elements[$y] . '-active' );
           $wp_customize->add_control( $post_types[$i]->name . '-single-' . $elements[$y] . '-active', array(
             'label' => $elements[$y],
             'type' => 'checkbox',
             'section' => $post_types[$i]->name . '-single'
           ));
         }


          //Archive settings
          $wp_customize->add_section( $post_types[$i]->name . '-archive', array(
           'title' => $post_types[$i]->label,
           'description' => __( 'Visible elements in ' ) . $post_types[$i]->label,
           'panel'   =>'archives',
           'capability' => 'edit_theme_options',
           ));

           // Banner
           $wp_customize->add_setting( $post_types[$i]->name . '-archive-banner-type' );
           $wp_customize->add_control( $post_types[$i]->name . '-archive-banner-type', array(
            'type'  => 'radio',
            'choices' => array(
              'custom-banner'    => __( 'Custom Banner', 'asdf' ),
              'no-banner' => __( 'No banner', 'asdf' )
            ),
            'label' => __( 'Banner type' ),
            'description' => __( 'Banner type' ),
            'section' => $post_types[$i]->name . '-archive',
           ));

           $wp_customize->add_setting( $post_types[$i]->name . '-archive-custom-banner' );
           $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $post_types[$i]->name . '-archive-custom-banner', array(
            'section' => $post_types[$i]->name . '-archive',
            'label' => __( 'Banner image' ),
            'description' => __( 'Banner image' ),
           )));

           $wp_customize->add_setting( $post_types[$i]->name . '-archive-banner-height' );
           $wp_customize->add_control( $post_types[$i]->name . '-archive-banner-height', array(
            'type'  => 'text',
            'label' => __( 'Banner height' ),
            'description' => __( 'Banner height' ),
            'section' => $post_types[$i]->name . '-archive',
           ));


          //elements
          for ($y = 0; $y < sizeof($elements); $y++ ) {
            $wp_customize->add_setting( $post_types[$i]->name . '-archive-' . $elements[$y] . '-active' );
            $wp_customize->add_control( $post_types[$i]->name . '-archive-' . $elements[$y] . '-active', array(
              'label' => $elements[$y],
              'type' => 'checkbox',
              'section' => $post_types[$i]->name . '-archive'
            ));
          }


        }

}
add_action( 'customize_register', 'themeslug_customize_register' );






 ?>
