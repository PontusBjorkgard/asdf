<?php
/*
*     filters applied:
*       'body_class'       -> <body> header.php
*       'post_class'       -> <article> template-parts/content-*.php
*       'container_class'  -> <div id="content"> header.php
*
*/


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
*  Custom article classes based on post type specific settings
*/
add_filter( 'post_class', 'asdf_article_classes' );
function asdf_article_classes( $classes ) {

  $post_type = get_post_type();

  $classes[] = get_option( $post_type . '-column-quantity' );
  return $classes;
}

/*
*  Custom container classes based on post type specific settings
*/
add_filter( 'container_class', 'asdf_container_classes' );
function asdf_container_classes( $classes ) {

  $post_type = get_post_type();

  $classes[] = get_option( $post_type . '-container-width' );
  return $classes;
}

//PONT I HESA

function asdf_class( $div ) {
  if ( is_single() ) {
    echo get_option( get_post_type() . '-single-' . $div . '-width');
  }
  else {
    echo get_option( get_post_type() . '-archive-' . $div . '-width');
  }
}



//custom div classes test

if ( !function_exists( 'asdf_container_class' ) ):

  function asdf_container_class() {
    $classes = apply_filters( 'container_class', $class = array() );
     echo 'class="' . join(' ', $classes ) .'"';
  }
endif;
