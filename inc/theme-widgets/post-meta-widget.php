<?php

/**
 * Adds Foo_Widget widget.
 */
class Post_Meta_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'post_meta_widget', // Base ID
			esc_html__( 'Post Meta', 'asdf' ), // Name
			array( 'description' => esc_html__( 'Display post meta', 'asdf' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		global $post;
		if ( $instance['post_author'] ) { echo "<span class='text-sm'>".get_the_author_meta( 'display_name', $post->post_author )."</span>"; }
		if ( $instance['post_title'] ) { echo "<h1>$post->post_title</h1>"; }
		if ( $instance['post_excerpt'] ) { echo "<h5>$post->post_excerpt</h1>"; }

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 */
	public function form( $instance ) {
		$widget_title = ! empty( $instance['widget_title'] ) ? $instance['widget_title'] : esc_html__( 'New title', 'asdf' );

		$post_title = ! empty( $instance['post_title'] ) ? $instance['post_title'] : '';
		$post_author = ! empty( $instance['post_author'] ) ? $instance['post_author'] : '';
		$post_excerpt = ! empty( $instance['post_excerpt'] ) ? $instance['post_excerpt'] : '';
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>"><?php esc_attr_e( 'Title:', 'asdf' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>">
		</p>

		<input type="checkbox" value="1" name="<?php echo esc_attr( $this->get_field_name( 'post_title' ) ); ?>" <?php checked( $post_title, '1'); ?>>
		<input type="checkbox" value="1" name="<?php echo esc_attr( $this->get_field_name( 'post_author' ) ); ?>" <?php checked( $post_author, '1'); ?>>
		<input type="checkbox" value="1" name="<?php echo esc_attr( $this->get_field_name( 'post_excerpt' ) ); ?>" <?php checked( $post_excerpt, '1'); ?>>

		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['widget_title'] = ( ! empty( $new_instance['widget_title'] ) ) ? sanitize_text_field( $new_instance['widget_title'] ) : '';

		$instance['post_title'] = ( ! empty( $new_instance['post_title'] ) ) ? sanitize_text_field( $new_instance['post_title'] ) : '';
		$instance['post_author'] = ( ! empty( $new_instance['post_author'] ) ) ? sanitize_text_field( $new_instance['post_author'] ) : '';
		$instance['post_excerpt'] = ( ! empty( $new_instance['post_excerpt'] ) ) ? sanitize_text_field( $new_instance['post_excerpt'] ) : '';
		return $instance;
	}

} // class Foo_Widget


function register_foo_widget() {
    register_widget( 'Post_Meta_Widget' );
}
add_action( 'widgets_init', 'register_foo_widget' );
