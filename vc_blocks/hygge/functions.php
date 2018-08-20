<?php 

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if( function_exists('vc_set_as_theme') ){
	function ebor_vcSetAsTheme() {
		vc_set_as_theme(true);
	}
	add_action( 'vc_before_init', 'ebor_vcSetAsTheme' );
}

if(!( function_exists('ebor_custom_css_classes_for_vc_row_and_vc_column') )){
	function ebor_custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
		if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
			$class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', 'col-md-$1', $class_string );
		}
		return $class_string; // Important: you should always return modified or original $class_string
	}
	add_filter( 'vc_shortcodes_css_class', 'ebor_custom_css_classes_for_vc_row_and_vc_column', 10, 2 );
}

if(!( function_exists('ebor_icons_settings_field') )){
	function ebor_icons_settings_field( $settings, $value ) {
		
		$icons = $settings['value'];
		
		$output = '<a href="#" id="ebor-icon-toggle" class="button button-primary button-large">Show/Hide Icons</a><div class="ebor-icons"><div class="ebor-icons-wrapper">';
		foreach( $icons as $icon ){
			$active = ( $value == $icon) ? ' active' : '';
			$output .= '<i class="icon '. $icon . $active .'" data-icon-class="'. $icon .'"></i>';
		}
		$output .= '</div><input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ebor-icon-value ' .
		esc_attr( $settings['param_name'] ) . ' ' .
		esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />' . '</div>';
		
	   return $output;
	}
	vc_add_shortcode_param( 'ebor_icons', 'ebor_icons_settings_field' );
}

/**
 * Add additional functions to certain blocks.
 * vc_map runs before custom post types and taxonomies are created, so this function is used
 * to add custom taxonomy selectors to VC blocks, a little annoying, but works perfectly.
 */
if(!( function_exists('ebor_vc_add_att') )){
	function ebor_vc_add_attr(){
		
		vc_remove_param('vc_row', 'full_width');
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Section Layout",
			'param_name' => 'hygge_layout',
			'value' => array_flip(array(
				'light-wrapper' => 'Grey Background',
				'white-wrapper' => 'White Background',
				'inverse-wrapper' => 'Black Background',
				'color-wrapper inverse-wrapper' => 'Highlight Colour Background',
				'half' => 'Half Image, Half Text',
				'full' => 'Full Width',
				'light-wrapper no-bottom-border' => 'Grey Background (No Bottom Border)',
				'white-wrapper no-bottom-border' => 'White Background (No Bottom Border)',
				'inverse-wrapper no-bottom-border' => 'Black Background (No Bottom Border)',
				'color-wrapper inverse-wrapper no-bottom-border' => 'Highlight Colour Background (No Bottom Border)',
			)),
			'description' => "Choose a Background For This Row"
		);
		vc_add_param('vc_row', $attributes);
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Section Padding",
			'param_name' => 'hygge_padding',
			'value' => array_flip(array(
				'normal-padding'    => 'Regular Padding',
				'bp0'               => 'No Bottom Padding',
				'large-padding'     => 'Large Padding'
 			)),
		);
		vc_add_param('vc_row', $attributes);
		
		$attributes = array(
			"type" => "textfield",
			"heading" => __("Self Hosted Video Background?, .webm extension", 'hygge'),
			"param_name" => "hygge_webm",
			"value" => '',
			"description" => __('Please fill all extensions', 'hygge')
		);
		vc_add_param('vc_row', $attributes);
		
		$attributes = array(
			"type" => "textfield",
			"heading" => __("Self Hosted Video Background?, .mp4 extension", 'hygge'),
			"param_name" => "hygge_mp4",
			"value" => '',
			"description" => __('Please fill all extensions', 'hygge')
		);
		vc_add_param('vc_row', $attributes);
		
		vc_remove_param('vc_row', 'video_bg');
		vc_remove_param('vc_row', 'video_bg_url');
		vc_remove_param('vc_row', 'video_bg_parallax');

		/**
		 * Add portfolio category selectors
		 */
		$portfolio_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'portfolio_category'
		);
		$portfolio_cats = get_categories( $portfolio_args );
		$final_portfolio_cats = array( 'Show all categories' => 'all' );
		
		if( is_array($portfolio_cats) ){
			foreach( $portfolio_cats as $cat ){
				$final_portfolio_cats[$cat->name] = $cat->term_id;
			}
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific Portfolio Category?",
			'param_name' => 'filter',
			'value' => $final_portfolio_cats
		);
		vc_add_param('hygge_portfolio', $attributes);
		
		/**
		 * Add team category selectors
		 */
		$team_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'team_category'
		);
		$team_cats = get_categories( $team_args );
		$final_team_cats = array( 'Show all categories' => 'all' );
		
		if( taxonomy_exists('team_category') ){
			if( is_array($team_cats) ){
				foreach( $team_cats as $cat ){
					$final_team_cats[$cat->name] = $cat->term_id;
				}
			}
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific Team Category?",
			'param_name' => 'filter',
			'value' => $final_team_cats
		);
		vc_add_param('hygge_team', $attributes);
		
		/**
		 * Add blog category selectors
		 */
		$blog_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'category'
		);
		$blog_cats = get_categories( $blog_args );
		$final_blog_cats = array( 'Show all categories' => 'all' );
		
		if( is_array($blog_cats) ){
			foreach( $blog_cats as $cat ){
				$final_blog_cats[$cat->name] = $cat->term_id;
			}
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific blog Category?",
			'param_name' => 'filter',
			'value' => $final_blog_cats
		);
		vc_add_param('hygge_blog', $attributes);
		
	}
	add_action('init', 'ebor_vc_add_attr', 999);
}

/**
 * Redirect page template if vc_row shortcode is found in the page.
 * This lets us use a dedicated page template for Visual Composer pages
 * without the need for on page checks, or custom page templates.
 * 
 * It's buyer-proof basically.
 */
if(!( function_exists('ebor_vc_page_template') )){
	function ebor_vc_page_template( $template ){
		global $post;
		
		if( is_archive() || is_404() )
			return $template;
		
		if(!( isset($post->post_content) ) || is_search())
			return $template;
			
		if( has_shortcode($post->post_content, 'vc_row') ){
			
			$new_template = locate_template( array( 'page_visual_composer.php' ) );
			
			if( 'portfolio' == $post->post_type )
				$new_template = locate_template( array( 'page_visual_composer_portfolio.php' ) );
				
			if (!( '' == $new_template )){
				return $new_template;
			}
			
		}
		return $template;
	}
	add_filter( 'template_include', 'ebor_vc_page_template', 99 );
}

