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

  // Get the post type
  $post_type = get_post_type();

  // add classes based on settings. Different settings for single and archive
  if ( is_single() ) {
    $classes[] = get_option( $post_type . 'single-container-width' );
  }
  else {
    $classes[] = get_option( $post_type . 'archive-container-width' );
  }

  return $classes;
}



//custom div classes test

if ( !function_exists( 'asdf_container_class' ) ):

  function asdf_container_class() {
    $classes = apply_filters( 'container_class', $class = array() );
     echo 'class="' . join(' ', $classes ) .'"';
  }
endif;

if (!function_exists( 'asdf_sidebar_active' ) ):

  function asdf_sidebar_active( $area ) {
    $post_type = get_post_type();

    if ( get_option( $post_type . '-sidebar-active' ) == 'true' ) {
      if ( $area == 'widget' ) {
        echo 'class="widget-area col-3"';
      }
      elseif ( $area == 'primary' ) {
        echo 'class="content-area col-9"';
      }
      else {
        return;
      }
    }

    elseif ( get_option( $post_type . '-sidebar-active' ) == 'false' ) {
      if ( $area == 'widget' ) {
        echo 'style="display:none;"';
      }
      elseif ( $area == 'primary' ) {
        echo 'class="content-area col-12"';
      }
      else {
        return;
      }
    }
  }
endif;
