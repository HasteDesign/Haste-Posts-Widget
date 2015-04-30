<?php
/*
Plugin Name: Haste Posts Widget
Plugin URI: http://hastedesign.com.br/
Description: A simple plugin to show posts in your sidebars.
Author: Anyssa Ferreira, Allyson Souza
Version: 1.0.0
Author URI: http://hastedesign.com.br/
Text Domain: haste-posts-widget
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class haste_posts_widget extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    public function __construct()
	{
		// Load plugin text domain.
		/*
		add_action( 'plugins_loaded', array(
			 &$this,
			'load_plugin_textdomain' 
		) );
		*/
	
        // widget actual processes
        parent::__construct(
            'haste_posts_widget', // Base ID
            'Haste Posts Widget', // Name
            array( 'description' => __( 'Display query-selected posts on sidebar.', 'haste-posts-widget' ), ) // Args
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
    public function widget( $args, $instance )
	{
        include( plugin_dir_path( __FILE__ ) . 'widget-display.php');
    }
    
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance )
	{
		include( plugin_dir_path( __FILE__ ) . 'widget-options.php');
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
    public function update( $new_instance, $old_instance )
	{
        // processes widget options to be saved
        
        $instance = $old_instance;
		
        $instance['title'] = 				strip_tags( $new_instance['title'] );
        $instance['post_type'] = 			strip_tags( $new_instance['post_type'] );
        $instance['taxonomy'] = 			strip_tags(	$new_instance['taxonomy'] );
        $instance['taxonomy_field'] = 		strip_tags(	$new_instance['taxonomy_field'] );
        $instance['terms'] = 				strip_tags(	$new_instance['terms'] );
        $instance['posts_per_page'] = 		strip_tags(	$new_instance['posts_per_page'] );
        $instance['order'] = 				strip_tags(	$new_instance['order'] );
        $instance['order_by'] = 			strip_tags(	$new_instance['order_by'] );
        $instance['show_title'] =			strip_tags(	$new_instance['show_title'] );
        $instance['show_thumb'] = 			strip_tags(	$new_instance['show_thumb'] );
		$instance['thumb_size'] = 			strip_tags(	$new_instance['thumb_size'] );
        $instance['show_date'] = 			strip_tags(	$new_instance['show_date'] );
        $instance['show_author'] = 			strip_tags(	$new_instance['show_author'] );
        $instance['show_taxonomy'] = 		strip_tags(	$new_instance['show_taxonomy'] );
        $instance['show_excerpt'] = 		strip_tags(	$new_instance['show_excerpt'] );
        $instance['show_read_more'] = 		strip_tags(	$new_instance['show_read_more'] );
        $instance['read_more_text'] = 		strip_tags(	$new_instance['read_more_text'] );
        $instance['show_comment_count'] = 	strip_tags(	$new_instance['show_comment_count'] );

        return $instance;
    }
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("haste_posts_widget");'));

/*
 * Load plugin textdomain.
 *
 * @since 1.0
 * 
 */
function haste_posts_widget_textdomain()
{
	load_plugin_textdomain( 'haste-posts-widget', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

add_action( 'plugins_loaded', 'haste_posts_widget_textdomain' );

/*
 * Load widget styles.
 *
 * @since 1.0
 * 
 */
function haste_posts_widget_styles()
{
	wp_enqueue_style( 'hd_post_widget_default_skin', plugins_url( 'css/default.css', __FILE__ ) );
}

// enqueue widget styles
add_action( 'wp_enqueue_scripts', 'haste_posts_widget_styles' );