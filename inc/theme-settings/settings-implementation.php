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
*  Custom blog article classes based on layout
*/
add_filter( 'post_class', 'asdf_article_classes' );
function asdf_article_classes( $classes ) {

  return $classes;
}
