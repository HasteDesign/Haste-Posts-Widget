<?php
/*
*
* Widget display options.
*
*/      
 
// Widget Title
$title = isset( $instance['title'] ) ? esc_attr($instance['title']) : '';

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

// Outputs the options form on admin    
?>

<!-- Title -->
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Widget Title', 'haste-posts-widget' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<h3><?php _e('Posts selection options', 'haste-posts-widget')?></h3>

<!-- Post Type -->
<p>
	<label for="<?php echo $this->get_field_id('post_type'); ?>">Post type:</label>
	<select id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>"  class="widefat">
	<?php
	$args = array(
		   'public'   => true,
	);
									
	$post_type_options = get_post_types( $args , 'objects' );
	
	foreach ( $post_type_options as $post_type_option )
	{
		echo '<option value="' . $post_type_option->name . '" id="post-type-' . $post_type_option->labels->name . '"';
		if ( $post_type_option->name == $post_type ) echo ' selected';
		echo '>' . $post_type_option->labels->name . '</option>';
	}
	?>
	</select>
	<span class="description"><?php _e( 'Choose a post type.', 'haste-posts-widget' ); ?></span>
</p>

<!-- Taxonomy -->
<p>
   <label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>">Taxonomy:</label>
   <select id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>"  class="widefat">
		<option value="nenhum" <?php if( $taxonomy === 'nenhum' ){ echo " selected disabled"; } ?> > -- <?php _e('None', 'haste-posts-widget'); ?> -- </option>
		<?php 
		$args =	array( 'public'   => true );
									
		$taxonomy_options = get_taxonomies( $args , 'objects' );
		
		foreach ($taxonomy_options as $taxonomy_option) 
		{
			echo '<option value="' . $taxonomy_option->name . '" id=" tax-' . $taxonomy_option->labels->name . '"';
			if ( $taxonomy_option->name == $taxonomy ) echo ' selected';
			echo '>' . $taxonomy_option->labels->name . '</option>';
		}
		?>
   </select>
   <span class="description"><?php _e( 'Choose a taxonomy.', 'haste-posts-widget'  ); ?></span>
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'taxonomy_field' ); ?>"><?php _e( 'Taxonomy terms selected by:', 'haste-posts-widget' ); ?></label>
	<select name="<?php echo $this->get_field_name( 'taxonomy_field' ); ?>" id="<?php echo $this->get_field_id( 'taxonomy_field' ); ?>" class="widefat">
		<option value="0" <?php if ( '0' == $taxonomy_field ) echo ' selected'; ?>> -- <?php _e( 'None', 'haste-posts-widget' ); ?> -- </option>
		<option value="slug" id="tax_field_slug" <?php if ( 'slug' == $taxonomy_field ) echo ' selected'; ?>> <?php _e( 'Term slug', 'haste-posts-widget' ); ?> </option>
		<option value="ID" id="tax_field_id" <?php if ( 'ID' == $taxonomy_field ) echo ' selected'; ?>> <?php _e( 'Term ID', 'haste-posts-widget' ); ?> </option>
	</select>
	<span class="description"><?php _e( 'Choose the mode of term selection.', 'haste-posts-widget' ); ?></span>
</p>

<!-- Terms -->
<p>
	<label for="<?php echo $this->get_field_id( 'terms' ); ?>"><?php _e( 'Taxonomy terms', 'haste-posts-widget' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'terms' ); ?>" name="<?php echo $this->get_field_name( 'terms' ); ?>" type="text" value="<?php echo $terms; ?>" />
	<span class="description"><?php _e( 'List the terms you want to retrieve posts from, separated by commas. Terms must belong to the taxonomy above.', 'haste-posts-widget' ); ?></span>
</p>

<!-- Posts Per Page -->
<p>
	<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>"><?php _e( 'Number of posts to show', 'haste-posts-widget' ); ?></label>
	<input class="widefat" type="number" min="-1" step="1" value="<?php echo $posts_per_page; ?>" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>"/>
	<span class="description"><?php _e( 'Set how many posts do you want to display. Use -1 to show all posts that matches the query.', 'haste-posts-widget' ); ?></span>
</p>

<!-- Order -->
<p>
	<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order', 'haste-posts-widget' ); ?></label>
	<select name="<?php echo $this->get_field_name( 'order' ); ?>" id="<?php echo $this->get_field_id( 'order' ); ?>" class="widefat">
		<option value="DESC" id="order_desc" <?php if ( 'DESC' == $order ) echo ' selected'; ?>> <?php _e( 'Descending ', 'haste-posts-widget' ); ?> </option>
		<option value="ASC" id="order_asc"  <?php if ( 'ASC' == $order ) echo ' selected'; ?>> <?php _e( 'Ascending ', 'haste-posts-widget' ); ?> </option>
	</select>
	<span class="description"><?php _e( 'Choose the order the posts will appear.' ); ?></span>
</p>

<!-- Order By -->
<p>
	<label for="<?php echo $this->get_field_id( 'order_by' ); ?>"><?php _e( 'Order by', 'haste-posts-widget' ); ?></label>
	<select name="<?php echo $this->get_field_name( 'order_by' ); ?>" id="<?php echo $this->get_field_id( 'order_by' ); ?>" class="widefat">
		<!-- Date -->
		<option value="date" id="order_by_date" <?php if ( 'date' == $order_by ) echo ' selected'; ?>> <?php _e( 'Date ', 'haste-posts-widget' ); ?> </option>
		<!-- None -->
		<option value="none" id="order_by_none" <?php if ( 'none' == $order_by ) echo ' selected'; ?>> <?php _e( 'None', 'haste-posts-widget' ); ?> </option>
		<!-- ID -->
		<option value="ID" id="order_by_ID" <?php if ( 'ID' == $order_by) echo ' selected'; ?>> <?php _e( 'ID', 'haste-posts-widget' ); ?> </option>
		<!-- Author -->
		<option value="author" id="order_by_author" <?php if ( 'author' == $order_by ) echo ' selected'; ?>> <?php _e( 'Author', 'haste-posts-widget' ); ?> </option>
		<!-- Title -->
		<option value="title" id="order_by_title" <?php if ( 'title' == $order_by ) echo ' selected'; ?>> <?php _e( 'Title', 'haste-posts-widget' ); ?> </option>
		<!-- Type -->
		<option value="type" id="order_by_type" <?php if ( 'type' == $order_by ) echo ' selected'; ?>> <?php _e( 'Post type', 'haste-posts-widget' ); ?> </option>
		<!-- Name -->
		<option value="name" id="order_by_name" <?php if ( 'name' == $order_by ) echo ' selected'; ?>> <?php _e( 'Slug', 'haste-posts-widget' ); ?> </option>
		<!-- Last Modified -->
		<option value="modified" id="order_by_modified" <?php if ( 'modified' == $order_by ) echo ' selected'; ?>> <?php _e( 'Last modified', 'haste-posts-widget' ); ?> </option>
		<!-- Parent -->
		<option value="parent" id="order_by_parent" <?php if ( 'parent' == $order_by ) echo ' selected'; ?>> <?php _e( 'Parent page/post', 'haste-posts-widget' ); ?> </option>
		<!-- Random -->
		<option value="rand" id="order_by_rand" <?php if ( 'rand' == $order_by ) echo ' selected'; ?>> <?php _e( 'Random', 'haste-posts-widget' ); ?> </option>
		<!-- Comments -->
		<option value="comment_count" id="order_by_comment_count" <?php if ( 'comment_count' == $order_by ) echo ' selected'; ?>> <?php _e( 'Comment count', 'haste-posts-widget' ); ?> </option>
		<!-- Menu Order -->
		<option value="menu_order" id="order_by_menu_order" <?php if ( 'menu_order' == $order_by ) echo ' selected'; ?>> <?php _e( 'Order field value', 'haste-posts-widget' ); ?> </option>
	</select>
	<span class="description"><?php _e( 'Choose the order the posts will appear.', 'haste-posts-widget' ); ?></span>
</p>             

<!-- Display Options -->
<h3><?php _e( 'Posts display options', 'haste-posts-widget' )?></h3>
<p>
	<input id="<?php echo $this->get_field_id( 'show_title' ); ?>" name="<?php echo $this->get_field_name( 'show_title' ); ?>" type="checkbox" value="1" <?php checked( '1', $show_title ); ?>/>
	<label for="<?php echo $this->get_field_id( 'show_title' ); ?>"><?php _e( 'Display posts title', 'haste-posts-widget' ); ?></label>
</p>
<p>
	<input id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" type="checkbox" value="1" <?php checked( '1', $show_thumb ); ?>/>
	<label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php _e( 'Display post thumbnail', 'haste-posts-widget' ); ?></label>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'thumb_size' ); ?>"><?php _e( 'Featured Image Size [Default is thumbnail]', 'haste-posts-widget' ); ?></label>
	<input class="widefat"  id="<?php echo $this->get_field_id( 'thumb_size' ); ?>" name="<?php echo $this->get_field_name( 'thumb_size' ); ?>" type="text" value="<?php echo $thumb_size == $thumb_size ? $thumb_size :  'thumbnail'; ?>"/>
</p>
<p>
	<input id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" type="checkbox" value="1" <?php checked( '1', $show_date ); ?>/>
	<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date', 'haste-posts-widget' ); ?></label>
</p>
<p>
	<input id="<?php echo $this->get_field_id( 'show_author' ); ?>" name="<?php echo $this->get_field_name( 'show_author' ); ?>" type="checkbox" value="1" <?php checked( '1', $show_author ); ?>/>
	<label for="<?php echo $this->get_field_id( 'show_author' ); ?>"><?php _e( 'Display post author', 'haste-posts-widget' ); ?></label>
</p>
<p>
	<input id="<?php echo $this->get_field_id( 'show_taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'show_taxonomy' ); ?>" type="checkbox" value="1" <?php checked( '1', $show_taxonomy ); ?>/>
	<label for="<?php echo $this->get_field_id( 'show_taxonomy' ); ?>"><?php _e( 'Display post taxonomy', 'haste-posts-widget' ); ?></label>
</p>
<p>
	<input id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" type="checkbox" value="1" <?php checked( '1', $show_excerpt ); ?>/>
	<label for="<?php echo $this->get_field_id( 'show_excerpt' ); ?>"><?php _e( 'Display post excerpt', 'haste-posts-widget' ); ?></label>
</p>  
<p>
	<input id="<?php echo $this->get_field_id( 'show_read_more' ); ?>" name="<?php echo $this->get_field_name( 'show_read_more' ); ?>" type="checkbox" value="1" <?php checked( '1', $show_read_more ); ?>/>
	<label for="<?php echo $this->get_field_id( 'show_read_more' ); ?>"><?php _e( 'Display a "read more" button', 'haste-posts-widget' ); ?></label>
</p>  
<p>
	<label for="<?php echo $this->get_field_id( 'read_more_text' ); ?>"><?php _e( 'Read more text', 'haste-posts-widget' ); ?></label>
	<input class="widefat"  id="<?php echo $this->get_field_id( 'read_more_text' ); ?>" name="<?php echo $this->get_field_name( 'read_more_text' ); ?>" type="text" value="<?php echo $read_more_text == __('Read more &raquo;') ? $read_more_text : _e('Read more &raquo;', 'haste-posts-widget') ; ?>"/>
</p>  
<p>
	<input id="<?php echo $this->get_field_id( 'show_comment_count' ); ?>" name="<?php echo $this->get_field_name('show_comment_count'); ?>" type="checkbox" value="1" <?php checked( '1', $show_comment_count ); ?>/>
	<label for="<?php echo $this->get_field_id( 'show_comment_count' ); ?>"><?php _e( 'Display a comment count', 'haste-posts-widget' ); ?></label>
</p>  