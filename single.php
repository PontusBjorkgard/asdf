<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package asdf
 */

get_header();
?>

	<div id="primary" class="content-area col">
		<main id="main" class="site-main">
<?php asdf_class( 'container' ) ?>
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

// PONT I HESA
$sidebar = true;
if ( $sidebar ) {
	get_sidebar();
}

get_footer();
