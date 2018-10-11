<?php
/*
*     filters applied:
*       'body_class'       -> <body> header.php
*       'post_class'       -> <article> template-parts/content-*.php
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


  	return $classes;
}

/*
*  Custom article classes based on post type specific settings
*/
add_filter( 'post_class', 'asdf_article_classes' );
function asdf_article_classes( $classes ) {

  $classes[] = asdf_get_option( 'column-quantity' );

  return $classes;
}

/*
*  Returns archive if archive and single if single
*/
function get_view() {
  if ( is_archive() || is_home() ) { return 'archive'; }
  else                { return 'single';  }
}


function asdf_get_option( $option ) {
  return get_option( get_post_type() . '-' . get_view() . '-' . $option);
}
