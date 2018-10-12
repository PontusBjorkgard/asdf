<?php
// Media uploader
require get_template_directory() . '/inc/theme-settings/media-uploader/media-uploader.php';

//Settings API Class
require get_template_directory() . '/inc/theme-settings/settings-class.php';

// Instantiation of Settings page objects
require get_template_directory() . '/inc/theme-settings/settings-instantiation.php';

// Implementation of settings
require get_template_directory() . '/inc/theme-settings/settings-implementation.php';


add_action( 'admin_enqueue_scripts', 'asdf_admin_scripts_fn' );
function asdf_admin_scripts_fn() {
  wp_enqueue_style('asdf-admin-css', get_stylesheet_directory_URI() . '/inc/theme-settings/settings-style.css');
  wp_enqueue_script('402-media-file-uploader-js', get_stylesheet_directory_URI() . '/inc/theme-settings/media-uploader/media-uploader.js', array('jquery'), '1.0', true);
  wp_enqueue_media();
}
