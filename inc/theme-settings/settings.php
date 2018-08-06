<?php

require get_template_directory() . '/inc/theme-settings/settings-class.php';

require get_template_directory() . '/inc/theme-settings/settings-instantiation.php';

require get_template_directory() . '/inc/theme-settings/settings-implementation.php';

add_action( 'admin_enqueue_scripts', 'asdf_admin_styles_fn' );
function asdf_admin_styles_fn() {
  wp_enqueue_style('asdf-admin-css', get_stylesheet_directory_URI() . '/inc/theme-settings/settings-style.css');
}
