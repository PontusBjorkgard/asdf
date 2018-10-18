<?php

function asdf_metaboxes() {

  // Page width
  add_meta_box(
    'page_settings',
    __( 'Page Settings', 'asdf' ),
    'asdf_metabox_fn',
    'page',
    'normal'
  );

  add_meta_box(
    'page_header',
    __( 'Header', 'asdf' ),
    'asdf_metabox_header_fn',
    'page',
    'normal'
  );

}
add_action('add_meta_boxes', 'asdf_metaboxes');

function asdf_metabox_fn( $post ) {

  $page_fullwidth = get_post_meta( $post->ID, '_page_fullwidth', true );
  $page_sidebar   = get_post_meta( $post->ID, '_page_sidebar', true );

  // FUllwidth
  echo '<h5> Fullwidth Page </h5>';
  echo '<input type="hidden"   value="container" name="page_fullwidth" />';
  echo '<input type="checkbox" value="container-fluid" name="page_fullwidth"  ' . checked( $page_fullwidth, 'container-fluid', false) . ' />';

  //Sidebar
  echo '<h5> Activate sidebar </h5>';
  echo '<input type="hidden"   value="0" name="page_sidebar" />';
  echo '<input type="checkbox" value="1" name="page_sidebar"  ' . checked( $page_sidebar, 1, false) . ' />';

}

function asdf_metabox_header_fn( $post) {

  $page_header   = get_post_meta( $post->ID, '_page_header', true );
  //Header type
  echo '<h5> Activate header </h5>';
  echo '<input type="hidden"   value="0" name="page_header" />';
  echo '<input type="checkbox" value="1" name="page_header"  ' . checked( $page_header, 1, false) . ' />';


}

function asdf_save_postdata($post_id) {

    $asdf_meta = array(
      'page_fullwidth' => '_page_fullwidth',
      'page_sidebar'   => '_page_sidebar',
      'page_header'   => '_page_header',
    );

    foreach( $asdf_meta as $name => $metakey) {

      if (array_key_exists( $name, $_POST )) {
          update_post_meta(
              $post_id,
              $metakey,
              $_POST[$name]
          );
      }

    }

}
add_action('save_post', 'asdf_save_postdata');

function asdf_get_meta( $key ) {
  global $post;
  if (is_page()) {
    return get_post_meta( $post->ID, $key, true );
  }
  else { return; }
}
