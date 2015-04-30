<?php
/**
* 
* Front-end display of the widget.
*
**/         
	   
// Widget Title
$title = apply_filters( 'widget_title', $instance['title'] );

// Query Arguments
$post_type      = isset( $instance['post_type'] ) 				? esc_attr( $instance['post_type'] ) : '';
$taxonomy       = isset( $instance['taxonomy'] ) 				? esc_attr( $instance['taxonomy']) : '';
$taxonomy_field = isset( $instance['taxonomy_field'] ) 			? esc_attr( $instance['taxonomy_field']) : '';
$terms          = isset( $instance['terms'] ) 					? esc_attr( $instance['terms']) : '';
$posts_per_page = isset( $instance['posts_per_page'] ) 			? esc_attr( $instance['posts_per_page']) : '';
$order          = isset( $instance['order'] ) 					? esc_attr( $instance['order']) : '';
$order_by       = isset( $instance['order_by'] ) 				? esc_attr( $instance['order_by']) : '';

// Appearence Arguments
$show_title     = isset( $instance['show_title'] ) 				? esc_attr( $instance['show_title']) : '';
$show_thumb     = isset( $instance['show_thumb'] ) 				? esc_attr( $instance['show_thumb']) : '';
$thumb_size     = isset( $instance['thumb_size'] ) 				? esc_attr( $instance['thumb_size']) : '';
$show_date  	= isset( $instance['show_date'] ) 				? esc_attr( $instance['show_date']) : '';
$show_author   	= isset( $instance['show_author'] ) 			? esc_attr( $instance['show_author']) : '';
$show_taxonomy	= isset( $instance['show_taxonomy'] ) 			? esc_attr( $instance['show_taxonomy']) : '';
$show_excerpt   = isset( $instance['show_excerpt'] ) 			? esc_attr( $instance['show_excerpt']) : '';
$show_read_more = isset( $instance['show_read_more'] ) 			? esc_attr( $instance['show_read_more']) : '';
$read_more_text = isset( $instance['read_more_text'] ) 			? esc_attr( $instance['read_more_text']) : '';
$show_comment_count = isset( $instance['show_comment_count'] ) 	? esc_attr( $instance['show_comment_count']) : '';
 
$custom_query;
$tax_query = array();

$base_query = array(
	'post_type' => $post_type,
	'posts_per_page' => $posts_per_page,
	'order' => $order,
	'orderby' => $order_by 
 );

if( $taxonomy != 'nenhum' && $taxonomy_field != 0 ) 
{
	$tax_query = 	array( 'tax_query' => 
						array(
							array(
								'taxonomy' => $taxonomy,
								'field'    => $taxonomy_field,      // id or slug
								'terms'    => $terms,               // break in a array
							),
						),
					);
}
				
if ( !empty( $instance['taxonomy'] )) 
{
	$custom_query = array_merge(  $base_query ,  $tax_query ); 
				 
} 
else 
{
	$custom_query = $base_query ; 	
}

/*
 * Posts loop/template
 */

echo $args['before_widget'];
if ( ! empty( $title ) ) {
	echo $args['before_title'] . $title . $args['after_title'];
}
echo '<ul class="hd-post-list">';
// Puxa a query
$widget_query = new WP_Query( $custom_query );
// The Loop
if ( $widget_query->have_posts() ) : while ( $widget_query->have_posts() ) : $widget_query->the_post();

	echo '<li ';
	post_class('hd-post') ;
	echo '>';
	if ( $show_thumb == true ) {
		echo '<div class="hd-thumb">';
		the_post_thumbnail( $thumb_size, array('class' => 'hd-thumb-image'));
		echo '</div>';
	}
	if ( $show_title == true ) {
		echo '<h4 class="hd-entry-title entry-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a>';
		if ( $show_comment_count == true ) {
			echo '<span class="hd-comment-count badge">' . wp_count_comments()->total_comments . '</span>';
		}
		echo'</h4>' ;
	} else if ( $show_comment_count == true ) {
		echo '<span class="hd-comment-count badge">' . wp_count_comments()->total_comments . '</span>';
	}
	if ( $show_taxonomy == true || $show_date == true || $show_author == true ) {
		echo '<div class="hd-meta">';
		if ( $show_date == true ) {
			echo '<p class="hd-date">' . get_the_date() . '</p>';
		}
		if ( $show_author == true ) {
			echo '<p class="hd-author">' . get_the_author() . '</p>';
		}
		if ( $show_taxonomy == true && $taxonomy != 'nenhum' ) {
			echo '<p class="hd-taxonomy">' . get_the_term_list( get_the_ID(), $taxonomy, '', ', ' ). '</p>';
		}
		echo '</div>';
	}
	if ( $show_excerpt == true ) {
		echo '<p class="hd-excerpt">' . get_the_excerpt() . '</p>';
	}
	if ( $show_read_more == true ) {
		echo '<a class="hd-read-more-button btn btn-default" href="' . get_permalink() . '" title="'.get_the_title(). '">'. $read_more_text .'</a>';
	}
	echo '</li>';

endwhile;
endif;

wp_reset_postdata();

echo '</ul>';
echo $args['after_widget'];
?>