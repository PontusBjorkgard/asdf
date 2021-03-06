<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package asdf
 */

?>
		</div><!-- .row -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer container-fluid">
		<div class="footer-widgets row">
			<?php dynamic_sidebar( 'footer' ); ?>
		</div> <!-- footer-widgets -->
		<div class="footer-branding row">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'asdf' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'asdf' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'asdf' ), 'asdf', '<a href="http://underscores.me/">Pontus Björkgård</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
