<?php

//Filters
/*
*   Custom body classes
*/
add_filter( 'body_class', 'asdf_body_classes' );
function asdf_body_classes( $classes ) {

    //Main navigation style classes
    $classes[] = get_option( 'main-navigation-layout');

    return $classes;
}

/*
*  Custom article classes based on post type specific settings
*/
add_filter( 'post_class', 'asdf_article_classes' );
function asdf_article_classes( $classes ) {

  if ( is_single() || is_singular() ) {
    $classes[] = 'col-12';
  }
  else {
    $classes[] = asdf_get_option( 'column-quantity' );
  }


  return $classes;
}


// Implementation functions
/*
*  Returns archive if archive and single if single
*/
function get_view() {
  if ( is_archive() || is_home() ) { return 'archive'; }
  else                { return 'single';  }
}

/*
*  Returns option in format posttype-view-$option
*/
function asdf_get_option( $option ) {
  if ( !is_page() ) {
    if ( get_option( get_post_type() . '-' . get_view() . '-' . $option) ) {
      return get_option( get_post_type() . '-' . get_view() . '-' . $option);
    }
    else { return; }
  }
  else {
    return;
  }



}
