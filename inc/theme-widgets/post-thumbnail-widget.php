<?php

/**
 * Adds Foo_Widget widget.
 */
class Post_Thumbnail_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'post_thumbnail_widget', // Base ID
			esc_html__( 'Post Thumbnail', 'asdf' ), // Name
			array( 'description' => esc_html__( 'Display post thumbnail', 'asdf' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		global $post;
    the_post_thumbnail( 'header-thumb' );

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 */
	public function form( $instance ) {
		$widget_title = ! empty( $instance['widget_title'] ) ? $instance['widget_title'] : esc_html__( 'New title', 'asdf' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>"><?php esc_attr_e( 'Title:', 'asdf' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>">
		</p>

		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
	  $instance['widget_title'] = ( ! empty( $new_instance['widget_title'] ) ) ? sanitize_text_field( $new_instance['widget_title'] ) : '';
		return $instance;
	}

} // class Foo_Widget


function register_thumbnail_widget() {
    register_widget( 'Post_Thumbnail_Widget' );
}
add_action( 'widgets_init', 'register_thumbnail_widget' );
