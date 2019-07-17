<?php 

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if( function_exists('vc_set_as_theme') ){
	function somnus_vcSetAsTheme() {
		vc_set_as_theme(true);
	}
	add_action( 'vc_before_init', 'somnus_vcSetAsTheme' );
}

if(!( function_exists('somnus_custom_css_classes_for_vc_row_and_vc_column') )){
	function somnus_custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
		if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
			$class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', 'col-md-$1', $class_string );
		}
		return $class_string;
	}
	add_filter( 'vc_shortcodes_css_class', 'somnus_custom_css_classes_for_vc_row_and_vc_column', 10, 2 );
}

/**
 * Add additional functions to certain blocks.
 * vc_map runs before custom post types and taxonomies are created, so this function is used
 * to add custom taxonomy selectors to VC blocks, a little annoying, but works perfectly.
 */
if(!( function_exists('somnus_vc_add_att') )){
	function somnus_vc_add_attr(){
		
		$args = array(
			'post_type' => 'wpcf7_contact_form',
			'posts_per_page' => -1
		);
		$form_options = get_posts( $args );
		$forms[0] = 'None';
		
		if( is_array($form_options) ){
			foreach( $form_options as $form_option ){
				$forms[$form_option->post_title] = $form_option->ID;
			}
		}
		
		$attributes = array(
			"type" => "textarea_html",
			"heading" => esc_html__("Block Content", 'somnus'),
			"param_name" => "content",
			'holder' => 'div'
		);
		vc_add_param('vc_gmaps', $attributes);
		
		$attributes = array(
			"type" => "dropdown",
			"heading" => esc_html__("Contact Form 7 Form", 'somnus'),
			"param_name" => "form",
			"description" => esc_html__('Enter a Contact Form 7 Shortcode if required.', 'somnus'),
			'value' => $forms
		);
		vc_add_param('vc_gmaps', $attributes);

		vc_remove_param('vc_gmaps', 'title');
		vc_remove_param('vc_gmaps', 'size');
		vc_remove_param('vc_gmaps', 'el_class');

		/**
		 * Add class category selectors
		 */
		$blog_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'class_category'
		);
		$blog_cats = get_categories( $blog_args );
		$final_blog_cats = array( 'Show all categories' => 'all' );
		
		if( is_array($blog_cats) ){
			foreach( $blog_cats as $cat ){
				$final_blog_cats[$cat->name] = $cat->slug;
			}
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific Class Category?",
			'param_name' => 'filter',
			'value' => $final_blog_cats
		);
		vc_add_param('somnus_timetable', $attributes);

		/**
		 * Add team category selectors
		 */
		$blog_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'team_category'
		);
		$blog_cats = get_categories( $blog_args );
		$final_blog_cats = array( 'Show all categories' => 'all' );
		
		if( is_array($blog_cats) ){
			foreach( $blog_cats as $cat ){
				$final_blog_cats[$cat->name] = $cat->slug;
			}
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific Team Category?",
			'param_name' => 'filter',
			'value' => $final_blog_cats
		);
		vc_add_param('somnus_team', $attributes);
		
	}
	add_action('init', 'somnus_vc_add_attr', 999);
}

/**
 * Redirect page template if vc_row shortcode is found in the page.
 * This lets us use a dedicated page template for Visual Composer pages
 * without the need for on page checks, or custom page templates.
 * 
 * It's buyer-proof basically.
 */
if(!( function_exists('somnus_vc_page_template') )){
	function somnus_vc_page_template( $template ){
		global $post;
		
		if( is_archive() || is_404() )
			return $template;
		
		if(!( isset($post->post_content) ) || is_search())
			return $template;
			
		if( has_shortcode($post->post_content, 'vc_row') ){
			$new_template = locate_template( array( 'page_visual_composer.php' ) );
			if (!( '' == $new_template )){
				return $new_template;
			}
		}
		return $template;
	}
	add_filter( 'template_include', 'somnus_vc_page_template', 99 );
}