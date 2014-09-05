<?php
/*
Plugin Name: Haste Design Posts Widget
Plugin URI: http://hastedesign.com.br/
Description: Um plugin simples para exibir posts na sidebar.
Author: Anyssa Ferreira, Allyson Souza - Haste Design
Version: 2.0
Author URI: http://hastedesign.com.br/
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class HD_post_widget extends WP_Widget {
    
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        // widget actual processes
        parent::__construct(
            'hd_post_widget', // Base ID
            'Haste Design Posts Widget', // Name
            array( 'description' => __( 'Display query-selected posts on sidebar.', 'hastedesign' ), ) // Args
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
        
        include_once( plugin_dir_path( __FILE__ ) . 'widget-display.php');
        
    }
    
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
    	
		include_once( plugin_dir_path( __FILE__ ) . 'widget-options.php');

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
        // processes widget options to be saved
        
        $instance = $old_instance;
		
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['post_type'] = strip_tags($new_instance['post_type']);
        $instance['taxonomy'] = strip_tags($new_instance['taxonomy']);
        $instance['taxonomy_field'] = strip_tags($new_instance['taxonomy_field']);
        $instance['terms'] = strip_tags($new_instance['terms']);
        $instance['posts_per_page'] = strip_tags($new_instance['posts_per_page']);
        $instance['order'] = strip_tags($new_instance['order']);
        $instance['order_by'] = strip_tags($new_instance['order_by']);
        $instance['show_title'] = strip_tags($new_instance['show_title']);
        $instance['show_thumb'] = strip_tags($new_instance['show_thumb']);
        $instance['show_date'] = strip_tags($new_instance['show_date']);
        $instance['show_author'] = strip_tags($new_instance['show_author']);
        $instance['show_taxonomy'] = strip_tags($new_instance['show_taxonomy']);
        $instance['show_excerpt'] = strip_tags($new_instance['show_excerpt']);
        $instance['show_read_more'] = strip_tags($new_instance['show_read_more']);
        $instance['read_more_text'] = strip_tags($new_instance['read_more_text']);
        $instance['show_comment_count'] = strip_tags($new_instance['show_comment_count']);

        return $instance;
    }
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("HD_post_widget");'));

/*
 * Load widget styles.
 *
 * @since 2.0
 * 
 */
function hd_post_widget_styles() {
	wp_enqueue_style( 'hd_post_widget_default_skin', plugins_url( 'css/default.css', __FILE__ ) );
}

// enqueue widget styles
add_action( 'wp_enqueue_scripts', 'hd_post_widget_styles' );
	
/*
 * Load plugin textdomain.
 *
 * @since 2.0
 * 
 */
function hd_load_textdomain() {
  load_plugin_textdomain( 'hd_post_widget', false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' ); 
}
