<?php
	/**
	*
    * Display widget options.
    *
	**/      
        
     /*
	  * Query args / widget options
	  */  
	   
        // Título do Widget
		$title = isset( $instance['title'] ) ? esc_attr($instance['title']) : '';
		
		// Query
		$post_type      = isset( $instance['post_type'] ) ? esc_attr( $instance['post_type'] ) : '';
		$taxonomy       = isset( $instance['taxonomy'] ) ? esc_attr($instance['taxonomy']) : '';
		$taxonomy_field = isset( $instance['taxonomy_field'] ) ? esc_attr($instance['taxonomy_field']) : '';
		$terms          = isset( $instance['terms'] ) ? esc_attr($instance['terms']) : '';
		$posts_per_page = isset( $instance['posts_per_page'] ) ? esc_attr($instance['posts_per_page']) : '';
		$order          = isset( $instance['order'] ) ? esc_attr($instance['order']) : '';
		$order_by       = isset( $instance['order_by'] ) ? esc_attr($instance['order_by']) : '';
        
		// Aparência
		$show_title     = isset( $instance['show_title'] ) ? esc_attr($instance['show_title']) : '';
		$show_thumb     = isset( $instance['show_thumb'] ) ? esc_attr($instance['show_thumb']) : '';
		$show_date  	= isset( $instance['show_date'] ) ? esc_attr($instance['show_date']) : '';
		$show_author   	= isset( $instance['show_author'] ) ? esc_attr($instance['show_author']) : '';
		$show_taxonomy	= isset( $instance['show_taxonomy'] ) ? esc_attr($instance['show_taxonomy']) : '';
		$show_excerpt   = isset( $instance['show_excerpt'] ) ? esc_attr($instance['show_excerpt']) : '';
		$show_read_more = isset( $instance['show_read_more'] ) ? esc_attr($instance['show_read_more']) : '';
		$read_more_text = isset( $instance['read_more_text'] ) ? esc_attr($instance['read_more_text']) : '';
		$show_comment_count = isset( $instance['show_comment_count'] ) ? esc_attr($instance['show_comment_count']) : '';
        
		echo $taxonomy;
		        // outputs the options form on admin    
            // $custom_query = esc_attr($instance['custom_query']);
            // $show_thumb = esc_attr($instance['show_thumb']);
            // $show_excerpt = esc_attr($instance['show_excerpt']);
            ?>
        
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
        	
        	<h3><?php _e('Posts selection options', 'hd_post_widget')?></h3>
		
            <p>
               <label for="<?php echo $this->get_field_id('post_type'); ?>">Post type:</label>
			   <select id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>"  class="widefat">
			   <?php $args = array(
							   'public'   => true,
							);
												
					$post_type_options = get_post_types( $args , 'objects' );
					foreach ($post_type_options as $post_type_option) {
						echo '<option value="' . $post_type_option->name . '" id="post-type-' . $post_type_option->labels->name;
				        if ( $post_type_option->name == $instance['post_type']) echo ' selected="selected"';
				        echo '">' . $post_type_option->labels->name . '</option>';
			        } ?>
		       </select>
               <span class="description"><?php _e('Choose a post type.'); ?></span>
			</p>
			
            <p>
               <label for="<?php echo $this->get_field_id('taxonomy'); ?>">Taxonomy:</label>
			   <select id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>"  class="widefat">
                    <option value="nenhum" <?php if( $taxonomy === 'nenhum' ){ echo "selected disabled"; } ?> > -- <?php _e('None'); ?> -- </option>
			   <?php $args = array(
							   'public'   => true,
							);
												
					$taxonomy_options = get_taxonomies( $args , 'objects' );
					foreach ($taxonomy_options as $taxonomy_option) {
						echo '<option value="' . $taxonomy_option->name . '" id=" tax-' . $taxonomy_option->labels->name . '"';
				        if ( $taxonomy_option->name == $instance['taxonomy']) echo ' selected';
				        echo '>' . $taxonomy_option->labels->name . '</option>';
			        } ?>
		       </select>
               <span class="description"><?php _e('Choose a taxonomy.'); ?></span>
			</p>
			
			

            <p>
                <label for="<?php echo $this->get_field_id('taxonomy_field'); ?>"><?php _e('Taxonomy terms selected by:'); ?></label>
				<select name="<?php echo $this->get_field_name('taxonomy_field'); ?>" id="<?php echo $this->get_field_id('taxonomy_field'); ?>" class="widefat">
                    <option value="0" <?php if ( '0' == $instance['taxonomy_field']) echo ' selected="selected"'; ?>> -- <?php _e('None'); ?> -- </option>
					<option value="slug" id="tax_field_slug" <?php if ( 'slug' == $instance['taxonomy_field']) echo ' selected="selected"'; ?>> <?php _e('Term slug'); ?> </option>
					<option value="ID" id="tax_field_id" <?php if ( 'ID' == $instance['taxonomy_field']) echo ' selected="selected"'; ?>> <?php _e('Term ID'); ?> </option>
				</select>
                <span class="description"><?php _e('Choose the mode of term selection.'); ?></span>
			</p>
			
            <p>
                <label for="<?php echo $this->get_field_id('terms'); ?>"><?php _e('Taxonomy terms'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('terms'); ?>" name="<?php echo $this->get_field_name('terms'); ?>" type="text" value="<?php echo $terms; ?>" />
                <span class="description"><?php _e('List the terms you want to retrieve posts from, separated by commas. Terms must belong to the taxonomy above.'); ?></span>
            </p>
 
            <p>
                <label for="<?php echo $this->get_field_id('posts_per_page'); ?>"><?php _e('Number of posts to show'); ?></label>
                <input class="widefat" type="number" min="-1" step="1" value="<?php echo $instance['posts_per_page']; ?>" id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>"/>
                <span class="description"><?php _e('Set how many posts do you want to display. Use -1 to show all posts that matches the query.'); ?></span>
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order'); ?></label>
				<select name="<?php echo $this->get_field_name('order'); ?>" id="<?php echo $this->get_field_id('order'); ?>" class="widefat">
					<option value="DESC" id="order_desc" <?php if ( 'DESC' == $instance['order']) echo ' selected="selected"'; ?>> <?php _e('Descending '); ?> </option>
					<option value="ASC" id="order_asc"  <?php if ( 'ASC' == $instance['order']) echo ' selected="selected"'; ?>> <?php _e('Ascending '); ?> </option>
				</select>
                <span class="description"><?php _e('Choose the order the posts will appear.'); ?></span>
			</p>
            
            <p>
                <label for="<?php echo $this->get_field_id('order_by'); ?>"><?php _e('Order by'); ?></label>
				<select name="<?php echo $this->get_field_name('order_by'); ?>" id="<?php echo $this->get_field_id('order_by'); ?>" class="widefat">
					<option value="date" id="order_by_date" <?php if ( 'date' == $instance['order_by']) echo ' selected="selected"'; ?>> <?php _e('Date '); ?> </option>
					<option value="none" id="order_by_none" <?php if ( 'none' == $instance['order_by']) echo ' selected="selected"'; ?>> <?php _e('None'); ?> </option>
					<option value="ID" id="order_by_ID" <?php if ( 'ID' == $instance['order_by']) echo ' selected="selected"'; ?>> <?php _e('ID'); ?> </option>
					<option value="author" id="order_by_author" <?php if ( 'author' == $instance['order_by']) echo ' selected="selected"'; ?>> <?php _e('Author'); ?> </option>
					<option value="title" id="order_by_title" <?php if ( 'title' == $instance['order_by']) echo ' selected="selected"'; ?>> <?php _e('Title'); ?> </option>
					<option value="type" id="order_by_type" <?php if ( 'type' == $instance['order_by']) echo ' selected="selected"'; ?>> <?php _e('Post type'); ?> </option>
					<option value="name" id="order_by_name" <?php if ( 'name' == $instance['order_by']) echo ' selected="selected"'; ?>> <?php _e('Slug'); ?> </option>
					<option value="modified" id="order_by_modified" <?php if ( 'modified' == $instance['order_by']) echo ' selected="selected"'; ?>> <?php _e('Last modified'); ?> </option>
					<option value="parent" id="order_by_parent" <?php if ( 'parent' == $instance['order_by']) echo ' selected="selected"'; ?>> <?php _e('Parent page/post'); ?> </option>
					<option value="rand" id="order_by_rand" <?php if ( 'rand' == $instance['order_by']) echo ' selected="selected"'; ?>> <?php _e('Random'); ?> </option>
					<option value="comment_count" id="order_by_comment_count" <?php if ( 'comment_count' == $instance['order_by']) echo ' selected="selected"'; ?>> <?php _e('Comment count'); ?> </option>
					<option value="menu_order" id="order_by_menu_order" <?php if ( 'menu_order' == $instance['order_by']) echo ' selected="selected"'; ?>> <?php _e('Order field value'); ?> </option>
				</select>
                <span class="description"><?php _e('Choose the order the posts will appear.'); ?></span>
			</p>             
            
            

        	<h3><?php _e('Posts display options', 'hd_post_widget')?></h3>
            <p>
                <input id="<?php echo $this->get_field_id('show_title'); ?>" name="<?php echo $this->get_field_name('show_title'); ?>" type="checkbox" value="1" <?php checked( '1', $show_title ); ?>/>
                <label for="<?php echo $this->get_field_id('show_title'); ?>"><?php _e('Display posts title'); ?></label>
            </p>
            <p>
                <input id="<?php echo $this->get_field_id('show_thumb'); ?>" name="<?php echo $this->get_field_name('show_thumb'); ?>" type="checkbox" value="1" <?php checked( '1', $show_thumb ); ?>/>
                <label for="<?php echo $this->get_field_id('show_thumb'); ?>"><?php _e('Display post thumbnail'); ?></label>
            </p>
            <p>
                <input id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" type="checkbox" value="1" <?php checked( '1', $show_date ); ?>/>
                <label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e('Display post date'); ?></label>
            </p>
            <p>
                <input id="<?php echo $this->get_field_id('show_author'); ?>" name="<?php echo $this->get_field_name('show_author'); ?>" type="checkbox" value="1" <?php checked( '1', $show_author ); ?>/>
                <label for="<?php echo $this->get_field_id('show_author'); ?>"><?php _e('Display post author'); ?></label>
            </p>
            <p>
                <input id="<?php echo $this->get_field_id('show_taxonomy'); ?>" name="<?php echo $this->get_field_name('show_taxonomy'); ?>" type="checkbox" value="1" <?php checked( '1', $show_taxonomy ); ?>/>
                <label for="<?php echo $this->get_field_id('show_taxonomy'); ?>"><?php _e('Display post taxonomy'); ?></label>
            </p>
            <p>
                <input id="<?php echo $this->get_field_id('show_excerpt'); ?>" name="<?php echo $this->get_field_name('show_excerpt'); ?>" type="checkbox" value="1" <?php checked( '1', $show_excerpt ); ?>/>
                <label for="<?php echo $this->get_field_id('show_excerpt'); ?>"><?php _e('Display post excerpt'); ?></label>
            </p>  
            <p>
                <input id="<?php echo $this->get_field_id('show_read_more'); ?>" name="<?php echo $this->get_field_name('show_read_more'); ?>" type="checkbox" value="1" <?php checked( '1', $show_read_more ); ?>/>
                <label for="<?php echo $this->get_field_id('show_read_more'); ?>"><?php _e('Display a "read more" button'); ?></label>
            </p>  
            <p>
                <label for="<?php echo $this->get_field_id('read_more_text'); ?>"><?php _e('Read more text'); ?></label>
                <input class="widefat"  id="<?php echo $this->get_field_id('read_more_text'); ?>" name="<?php echo $this->get_field_name('read_more_text'); ?>" type="text" value="<?php echo $instance['read_more_text'] == __('Read more &raquo;') ? _e('Read more &raquo;') :  $instance['read_more_text'] ?>"/>
            </p>  
            <p>
                <input id="<?php echo $this->get_field_id('show_comment_count'); ?>" name="<?php echo $this->get_field_name('show_comment_count'); ?>" type="checkbox" value="1" <?php checked( '1', $show_comment_count ); ?>/>
                <label for="<?php echo $this->get_field_id('show_comment_count'); ?>"><?php _e('Display a comment count'); ?></label>
            </p>  
