<?php

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


  //Posttype specific
  $post_type_elements = array(
    '.post-thumbnail' => get_theme_mod( get_post_type() . '-post-thumbnail')
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
  $css .='</style>';
  echo $css;
}
add_action( 'wp_head', 'asdf_customized_styles' );
?>
