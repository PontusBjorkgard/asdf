<?php
/*
*   Custom body classes
*/
add_filter( 'body_class', 'asdf_body_classes' );
function asdf_body_classes( $classes ) {

    /*
    *   Main navigation style classes
    */
    $classes[] = get_option( 'main-navigation-layout');
    $classes[] = '';
    $classes[] = '';


  	return $classes;
}

/*
*  Custom article classes based on post type specific layout
*/
add_filter( 'post_class', 'asdf_article_classes' );
function asdf_article_classes( $classes ) {

  $post_type = get_post_type();

  $classes[] = get_option( $post_type . '-column-quantity' );
  return $classes;
}


//custom div classes test

if ( !function_exists( 'asdf_container_classes' ) ):

  function asdf_container_classes() {
    $postType = get_post_type();
    $classes = array();
    $classes[] = get_option( 'post-col-quantity');

    echo 'class="' . join(' ', $classes ) . '"';
  }
endif;
