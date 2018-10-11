<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package asdf
 */



//Posted on
if ( ! function_exists( 'asdf_posted_on' ) ) :

	function asdf_posted_on( $type = '') {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( $type === 'modified' ) {
				if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
					$time_string = '<time class="updated" datetime="%3$s">%4$s</time>';
				}
		}
		else {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);
		echo '<span class="posted-on">' . $time_string . '</span>'; // WPCS: XSS OK.
	}
endif;



//Posted by
if ( ! function_exists( 'asdf_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function asdf_posted_by() {
		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'asdf' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;


// Get tags or cats
function asdf_posted_in( $type = '' ) {
	if ( 'page' !== get_post_type() ) {

		if ( $type === 'tags') {
			$tags_list = get_the_tag_list();
			if ( $tags_list ) {
				echo $tags_list;
			}
		}
		else {
			$categories_list = get_the_category_list();
			if ( $categories_list ) {
				echo $categories_list;
			}
		}
	}
}



// The content
if ( ! function_exists( 'asdf_the_content' ) ) :
		function asdf_the_content() {

			if (is_singular()) {
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'asdf' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );
			}

			else {
				the_excerpt();
			}



		}
endif;



// Entry footer
if ( ! function_exists( 'asdf_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function asdf_entry_footer() {
		// Hide category and tag text for pages.


		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'asdf' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'asdf' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;



// Thumbnail
if ( ! function_exists( 'asdf_post_thumbnail' ) ) :

	function asdf_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'asdf-full'  ); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'asdf-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;
