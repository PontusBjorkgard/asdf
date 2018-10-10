<?php
add_action( 'init', function() {
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
        'description'     => 'Layout main navigfation',
      	'choices'          => array( 'navigation-horizontal', 'navigation-vertical' )
      );



      /*
      *     Layout options pages
      */

      // Default post type
      $post_types = array( get_post_type_object( 'post' ) );

      // Get custom post types as objects. Returns associative array
      $custom_types = get_post_types( array( '_builtin' => false ), 'objects');

      // Add $custom_types associative array to $post_types numeric array
      foreach ($custom_types as $type ) {
        $post_types[] = $type;
      }

      // adds the names of the post types to the $sections array as strings
      $sections = array();
      for ($i=0; $i < sizeof($post_types); $i++) {
        $sections[] =  $post_types[$i]->name;
      }

      // init Layoutpage with a section per post type
      $layoutPage = new Subpage( $page, array(
        'name'        => 'Layout Settings',
        'menu-name'   => 'Layout',
        'slug'        => 'asdf-admin-layout',
        'sections'    =>  $sections
      ));

      // loop through $post_types to create a setting per post type and add to post type specific section
      for( $i = 0; $i < sizeof($post_types); $i++ ) {

        // SINGLE
        $layoutPage->options[] = array(
            'option_name'     => $post_types[$i]->name.' single container width',
            'option_slug'     => $post_types[$i]->name.'-single-container-width',
            'option_section'  =>  $post_types[$i]->name,
            'type'            => 'radio',
            'htmlclass'       => 'asdf-radio',
            'description'     => 'Width of the main container',
            'choices'         =>  array( 'container', 'container-fluid' ),
            'choices_labels'   =>  array( 'Normal', 'Fullwdidth' )
          );


            $layoutPage->options[] = array(
                'option_name'     => $post_types[$i]->name.' single activate sidebar',
                'option_slug'     => $post_types[$i]->name.'-single-sidebar-active',
                'option_section'  =>  $post_types[$i]->name,
                'type'            => 'radio',
                'htmlclass'       => 'asdf-radio',
                'description'     => 'Activate sidebar?',
                'choices'         =>  array( 'true', 'false' ),
                'choices_labels'   =>  array( 'Sidebar', 'No sidebar' )
              );

              //Archive
              $layoutPage->options[] = array(
                  'option_name'     => $post_types[$i]->name.' archive container width',
                  'option_slug'     => $post_types[$i]->name.'-archive-container-width',
                  'option_section'  =>  $post_types[$i]->name,
                  'type'            => 'radio',
                  'htmlclass'       => 'asdf-radio',
                  'description'     => 'Width of the main container',
                  'choices'         =>  array( 'container', 'container-fluid' ),
                  'choices_labels'   =>  array( 'Normal', 'Fullwdidth' )
                );

            $layoutPage->options[] = array(
                'option_name'     => $post_types[$i]->name.' archive activate sidebar',
                'option_slug'     => $post_types[$i]->name.'-archive-sidebar-active',
                'option_section'  =>  $post_types[$i]->name,
                'type'            => 'radio',
                'htmlclass'       => 'asdf-radio',
                'description'     => 'Activate sidebar?',
                'choices'         =>  array( 'true', 'false' ),
                'choices_labels'   =>  array( 'Sidebar', 'No sidebar' )
                );

                $layoutPage->options[] = array(
                  'option_name'     => $post_types[$i]->name.' number of columns',
                  'option_slug'     => $post_types[$i]->name.'-archive-column-quantity',
                  'option_section'  => $post_types[$i]->name,
                  'type'            => 'select',
                  'htmlclass'       => 'asdf-number',
                  'description'     => 'Number of columns per row',
                  'choices'         =>  array( 'col-12', 'col-6', 'col-4' ),
                  'choices_labels'   =>  array( '1', '2', '3' )
                );
       }



      /*
        $layoutPage->options[] = array(
          'option_name'     => 'Container width',
          'option_slug'     => $posttype.'-container-width',
          'option_section'  => $posttype,
          'type'            => 'radio',
          'htmlclass'       => 'asdf-radio',
          'description'     => 'Width of the main container',
          'choices'         =>  array( 'container', 'container-fluid' ),
          'choices_labels'   =>  array( 'Normal', 'Fullwdidth' )
        );

        */


//dddd

      $page->hook_create_settings();
      $navigation->hook_create_settings();
      $layoutPage->hook_create_settings();
});
