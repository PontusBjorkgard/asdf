<?php

// get_theme mod based on post type/view
function asdf_get_theme_mod( $option ) {
  return get_theme_mod( get_post_type() . '-' . get_view() . '-' . $option);
}


//ASDF dynamic stylesheet
function asdf_customized_styles() {

  $background_colors = array(
    'footer#colophon'   =>  get_theme_mod('background-footer'),
    'nav#main-navigation' => get_theme_mod('background-navbar'),
    'div#page' => get_theme_mod('background-page'),
    'div.footer-branding' => get_theme_mod('background-branding')
  );

  $text_colors = array(
    'p'   =>  get_theme_mod('color-p')
  );

  //Posttype specific elements
  $post_type_elements = array(
    '.post-thumbnail' => asdf_get_theme_mod( 'thumbnail-active' ),
    '.posted-on' => asdf_get_theme_mod( 'date-active' ),
    '.posted-by' => asdf_get_theme_mod( 'author-active' ),
    '.comments-link' => asdf_get_theme_mod( 'comment-active' ),
    '.entry-title' => asdf_get_theme_mod( 'title-active' ),
    '.entry-meta' => asdf_get_theme_mod( 'categories-active' ),
    '.entry-content > p' => asdf_get_theme_mod( 'content-active' ),
    '.readmore' => asdf_get_theme_mod( 'readmore-active' ),
  );

  //Banner styles
  $featured_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full' )[0];
  $banner_img = asdf_get_theme_mod( 'custom-banner' );

  $banner_styles = array(
    'background-image'  => 'url(' . $bg = asdf_get_theme_mod( 'banner-type' ) == 'custom-banner' ? $banner_img . ')' : $featured_img . ')',
    'min-height'  => asdf_get_theme_mod( 'banner-height' ),
    'display'     => $display = asdf_get_theme_mod( 'banner-type' ) == 'no-banner' ? 'none;' : 'flex'
  );

  $css = '<style type="text/css">';

  foreach ( $background_colors as $div => $value ) {
    $css .= "$div { background-color: $value ;}";
  }

  foreach ( $text_colors as $div => $value ) {
    $css .= "$div { color: $value ;}";
  }

  //post type specific. Hides element if returns false
  foreach ( $post_type_elements as $div => $value ) {
    if ( !$value ) {
      $css .= "$div { display: none;}";
    }
  }

  //Banner styles
  $css .= ".asdf-banner {";
  foreach ( $banner_styles as $property => $value ) {
     $css .= "$property: $value;" ;
  }
  $css .= "}";
  $css .='</style>';
  echo $css;
}
add_action( 'wp_head', 'asdf_customized_styles' );
?>
