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

if(!( function_exists('ebor_custom_css_classes_for_vc_row_and_vc_column') )){
	function ebor_custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
		if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
			$class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', 'col-sm-$1', $class_string );
		}
		return $class_string; // Important: you should always return modified or original $class_string
	}
	add_filter( 'vc_shortcodes_css_class', 'ebor_custom_css_classes_for_vc_row_and_vc_column', 10, 2 );
}

/**
 * Add additional functions to certain blocks.
 * vc_map runs before custom post types and taxonomies are created, so this function is used
 * to add custom taxonomy selectors to VC blocks, a little annoying, but works perfectly.
 */
if(!( function_exists('ebor_vc_add_att') )){
	function ebor_vc_add_attr(){
		$attributes = array(
			"type" => "textfield",
			"heading" => __("ID Name", 'meetup'),
			"param_name" => "scroll_id",
			"description" => __('Used for scrolling links, can also be used for styling.', 'meetup')
		);
		vc_add_param('vc_row', $attributes);
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Background Style",
			'param_name' => 'background_style',
			'value' => array_flip(array(
				'normal' => 'Standard Section',
				'full' => 'Fullwidth Section',
				'parallax' => 'Parallax Background Image (Full Width)',
				'video' => 'Video Background (Full Width)',
				'image-left' => 'Image Left, Content on Right',
				'image-right' => 'Image Right, Content on Left',
				'map' => 'Map Right, Content on Left'
			)),
			'description' => "Choose Background Layout For This Row"
		);
		vc_add_param('vc_row', $attributes);
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Background Color",
			'param_name' => 'color_style',
			'value' => array_flip(array(
				'light-wrapper' => 'Light Wrapper',
				'dark-wrapper' => 'Grey Wrapper',
				'background-dark' => 'Black Wrapper',
				'primary-bg' => 'Highlight Colour Wrapper'
			)),
			'description' => "Choose Background Layout For This Row"
		);
		vc_add_param('vc_row', $attributes);
		
		$attributes = array(
			"type" => "textfield",
			"heading" => __("Self Hosted Video Background?, .webm extension", 'meetup'),
			"param_name" => "webm",
			"value" => '',
			"description" => __('Please fill all extensions', 'meetup')
		);
		vc_add_param('vc_row', $attributes);
		
		$attributes = array(
			"type" => "textfield",
			"heading" => __("Self Hosted Video Background?, .mp4 extension", 'meetup'),
			"param_name" => "mpfour",
			"value" => '',
			"description" => __('Please fill all extensions', 'meetup')
		);
		vc_add_param('vc_row', $attributes);
		
		$attributes = array(
			"type" => "textfield",
			"heading" => __("Self Hosted Video Background?, .ogv extension", 'meetup'),
			"param_name" => "ogv",
			"value" => '',
			"description" => __('Please fill all extensions', 'meetup')
		);
		vc_add_param('vc_row', $attributes);
		
		$attributes = array(
			"type" => "textarea_raw_html",
			"heading" => __("Map iFrame", 'meetup'),
			"param_name" => "map",
			"value" => '',
			"description" => ''
		);
		vc_add_param('vc_row', $attributes);
		
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
		vc_add_param('meetup_team', $attributes);
		
		/**
		 * Add client category selectors
		 */
		$client_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'client_category'
		);
		$client_cats = get_categories( $client_args );
		$final_client_cats = array( 'Show all categories' => 'all' );
		
		if( taxonomy_exists('client_category') ){
			if( is_array($client_cats) ){
				foreach( $client_cats as $cat ){
					$final_client_cats[$cat->name] = $cat->term_id;
				}
			}
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific client Category?",
			'param_name' => 'filter',
			'value' => $final_client_cats
		);
		vc_add_param('meetup_clients', $attributes);
		
		/**
		 * Add testimonial category selectors
		 */
		$testimonial_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'testimonial_category'
		);
		$testimonial_cats = get_categories( $testimonial_args );
		$final_testimonial_cats = array( 'Show all categories' => 'all' );
		
		if( taxonomy_exists('testimonial_category') ){
			if( is_array($testimonial_cats) ){
				foreach( $testimonial_cats as $cat ){
					$final_testimonial_cats[$cat->name] = $cat->term_id;
				}
			}
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific testimonial Category?",
			'param_name' => 'filter',
			'value' => $final_testimonial_cats
		);
		vc_add_param('meetup_testimonial_carousel', $attributes);
		
		/**
		 * Add faq category selectors
		 */
		$faq_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'faq_category'
		);
		$faq_cats = get_categories( $faq_args );
		$final_faq_cats = array( 'Show all categories' => 'all' );
		
		if( taxonomy_exists('faq_category') ){
			if( is_array($faq_cats) ){
				foreach( $faq_cats as $cat ){
					$final_faq_cats[$cat->name] = $cat->term_id;
				}
			}
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific FAQ Category?",
			'param_name' => 'filter',
			'value' => $final_faq_cats
		);
		vc_add_param('meetup_faq', $attributes);
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
		
		if( is_archive() )
			return $template;
			
		if(!( isset($post->post_content) ) || is_search() )
			return $template;
			
		if( has_shortcode($post->post_content, 'vc_row') ){
			$new_template = locate_template( array( 'page_visual_composer.php' ) );
			if (!( '' == $new_template )){
				return $new_template;
			}
		}
		return $template;
	}
	add_filter( 'template_include', 'ebor_vc_page_template', 99 );
}

