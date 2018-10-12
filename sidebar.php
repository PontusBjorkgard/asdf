<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package asdf
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

if ( asdf_get_option( 'sidebar-active' ) ):
?>
<aside id="secondary" class="col-3">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
<?php endif; ?>
