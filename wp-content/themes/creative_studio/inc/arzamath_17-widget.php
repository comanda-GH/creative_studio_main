<?php
/**
 * Created by PhpStorm.
 * User: rb
 * Date: 12.12.14
 * Time: 19:22
 */

class Arzamath_Widget extends WP_Widget {

    function Arzamath_Widget() {
        // Instantiate the parent object
        parent::__construct(
            'arzamath_widget', // Base ID
            __('Widget Title', 'text_domain'), // Name
            array( 'description' => __( 'A Foo Widget', 'text_domain' ), ) // Args
        );
    }

    function widget( $args, $instance ) {
        // Widget output
        extract( $args );
        $title = apply_filters('widget_title', $instance['title'] );
        $name = $instance['name'];
        $show_info = isset( $instance['show_info'] ) ? $instance['show_info'] : false;

        echo $before_widget;

// Display the widget title
        if ( $title )
            echo $before_title . $title . $after_title;

//Display the name
        if ( $name )
            printf( '<p>' . __('Hey their Sailor! My name is %1$s.', 'example') . '</p>', $name );

        if ( $show_info )
            printf( $name );
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        // Save widget options
        $instance = $old_instance;

        //Strip tags from title and name to remove HTML
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['name'] = strip_tags( $new_instance['name'] );
        $instance['show_info'] = $new_instance['show_info'];
        return $instance;
    }

    function form( $instance ) {
        // Output admin widget options form
//Set up some default widget settings.
$defaults = array( 'title' => __('Example', 'example'), 'name' => __('Bilal Shaheen', 'example'), 'show_info' => true );
$instance = wp_parse_args( (array) $instance, $defaults );
// Widget Title: Text Input?>
<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
</p>

//Text Input
<p>
    <label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Your Name:', 'example'); ?></label>
    <input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" style="width:100%;" />
</p>
// Checkbox
<p>
    <input class="checkbox" type="checkbox" <?php checked( $instance['show_info'], true ); ?> id="<?php echo $this->get_field_id( 'show_info' ); ?>" name="<?php echo $this->get_field_name( 'show_info' ); ?>" />
    <label for="<?php echo $this->get_field_id( 'show_info' ); ?>"><?php _e('Display info publicly?', 'example'); ?></label>
</p>
   <?php }
}

function register_arzamath_17_widgets() {
    register_widget( 'Arzamath_Widget' );
}

add_action( 'widgets_init', 'register_arzamath_17_widgets' );
