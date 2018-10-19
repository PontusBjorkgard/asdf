<?php


add_action('admin_enqueue_scripts', function() {
	wp_enqueue_script( 'jquery-ui-sortable' );

});


/**
 * Adds Foo_Widget widget.
 */
class Foo_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'foo_widget', // Base ID
			esc_html__( 'Widget Title', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'A Foo Widget', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		global $post;
		if ( $instance['post_title'] ) { echo $post->post_title; }
		if ( $instance['post_author'] ) { echo $post->post_author; }

		//echo $instance['content'];
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
    $content = ! empty( $instance['content'] ) ? $instance['content'] : esc_html__( 'New content', 'text_domain' );

		$post_title = ! empty( $instance['post_title'] ) ? $instance['post_title'] : '';
		$post_author = ! empty( $instance['post_author'] ) ? $instance['post_author'] : '';
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

    <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>"><?php esc_attr_e( 'Content:', 'text_domain' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'content' ) ); ?>" type="text" value="<?php echo esc_attr( $content); ?>">
		</p>

		<input type="checkbox" value="1" name="<?php echo esc_attr( $this->get_field_name( 'post_title' ) ); ?>" <?php checked( $post_title, '1'); ?>>
		<input type="checkbox" value="1" name="<?php echo esc_attr( $this->get_field_name( 'post_author' ) ); ?>" <?php checked( $post_author, '1'); ?>>

	<!-- <ul id="test-<?php// echo $this->get_field_id( 'element-list' ); ?>">
			<li id="element_title">Title</li>
			<li id="element_date">Date</li>
			<li id="element_category">Category</li>
			<li id="element_author">Author</li>
		</ul>
		<input type="text" id="<?php// echo esc_attr( $this->get_field_id( 'elements' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'content' ) ); ?>" value="<?php echo esc_attr( $element_string); ?>"  >


	<script type="text/javascript">
	jQuery( function($) {
	    $( "#test-<?php// echo $this->get_field_id( 'element-list' ); ?>" ).sortable();

			$( "#test-<?php// echo $this->get_field_id( 'element-list' ); ?> li" ).droppable({
        drop: function( ) {
						setTimeout( function() {
							var order = $("#test-<?php //echo $this->get_field_id( 'element-list' ); ?>").sortable("toArray").toString();

							$("#<?php //echo $this->get_field_id( 'elements' ); ?>").val(order);
						}, 500);

        }
    });
	  });
	</script> -->

		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		$instance['post_title'] = ( ! empty( $new_instance['post_title'] ) ) ? sanitize_text_field( $new_instance['post_title'] ) : '';
		$instance['post_author'] = ( ! empty( $new_instance['post_author'] ) ) ? sanitize_text_field( $new_instance['post_author'] ) : '';
		return $instance;
	}

} // class Foo_Widget


function register_foo_widget() {
    register_widget( 'Foo_Widget' );
}
add_action( 'widgets_init', 'register_foo_widget' );
