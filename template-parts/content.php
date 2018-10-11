<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package asdf
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<?php asdf_post_thumbnail(); ?>

	<header class="entry-header">
		<?php
		asdf_posted_by();
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

			?>
	</header><!-- .entry-header -->

	<div class="entry-meta">
		<?php
		asdf_posted_in();
		asdf_posted_on();
		?>
	</div><!-- .entry-meta -->

	<div class="entry-content">
		<?php
		asdf_the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'asdf' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php asdf_posted_in('tags'); ?>
		<?php asdf_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
