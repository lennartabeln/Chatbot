<?php
/**
 * Plugin Name: Custom Heading and Paragraph Widget
 * Description: A simple widget that displays a heading and a paragraph.
 * Version: 1.0
 * Author: Your Name
 */

// Register the widget
function custom_heading_paragraph_widget() {
    register_widget( 'Custom_Heading_Paragraph_Widget' );
}
add_action( 'widgets_init', 'custom_heading_paragraph_widget' );

// Create the widget class
class Custom_Heading_Paragraph_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'custom_heading_paragraph_widget',
            'Custom Heading and Paragraph Widget',
            array( 'description' => 'Displays a heading and a paragraph' )
        );
    }

    public function widget( $args, $instance ) {
        // Output the widget content
        echo $args['before_widget'];
        echo '<h2>' . esc_html( $instance['title'] ) . '</h2>';
        echo '<p>' . esc_html( $instance['content'] ) . '</p>';
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        // Widget settings form
        $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $content = isset( $instance['content'] ) ? $instance['content'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Heading:</label>
            <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'content' ); ?>">Paragraph:</label>
            <textarea id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" class="widefat"><?php echo esc_textarea( $content ); ?></textarea>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        // Save widget settings
        $instance = array();
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['content'] = sanitize_textarea_field( $new_instance['content'] );
        return $instance;
    }
}
