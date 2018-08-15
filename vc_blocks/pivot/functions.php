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

if(!( function_exists('ebor_vc_add_attr') )){
	function ebor_vc_add_attr(){
		/**
		 * Add background atrributes to VC Rows
		 */
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Background Style",
			'param_name' => 'background_style',
			'value' => array_flip(array(
				'pivot-normal' => 'Standard Settings',
				'full' => 'Fullwidth Section',
				'light-wrapper' => 'Light Background',
				'dark-wrapper' => 'Dark Background',
				'bg-primary' => 'Primary Highlight Colour Background',
				'bg-secondary-1' => 'Secondary Highlight Colour Background',
				'bg-secondary-2 ' => 'Secondary Highlight 2 Colour Background',
				'image' => 'Parallax Background Image (Full Width)',
				'image-left' => 'Image Left, Content on Right',
				'image-right' => 'Image Right, Content on Left'
			)),
			'description' => "Choose Background Style For This Row"
		);
		vc_add_param('vc_row', $attributes);
		
		/**
		 * Add smooth scroll
		 */
		$attributes = array(
			'type' => 'textfield',
			'heading' => "Single Page Scroll ID",
			'param_name' => 'single_link',
			'value' => '',
			'description' => "Enter a lowercase scroll id to link the menu to, no spaces or special characters."
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
		
		foreach( $team_cats as $cat ){
			$final_team_cats[$cat->name] = $cat->term_id;
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific Team Category?",
			'param_name' => 'filter',
			'value' => $final_team_cats
		);
		vc_add_param('pivot_team', $attributes);
		
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
		
		foreach( $portfolio_cats as $cat ){
			$final_portfolio_cats[$cat->name] = $cat->term_id;
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific Portfolio Category?",
			'param_name' => 'filter',
			'value' => $final_portfolio_cats
		);
		vc_add_param('pivot_portfolio', $attributes);
		
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
		
		foreach( $testimonial_cats as $cat ){
			$final_testimonial_cats[$cat->name] = $cat->term_id;
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific testimonial Category?",
			'param_name' => 'filter',
			'value' => $final_testimonial_cats
		);
		vc_add_param('pivot_testimonial_carousel', $attributes);
		
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
		
		foreach( $client_cats as $cat ){
			$final_client_cats[$cat->name] = $cat->term_id;
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific client Category?",
			'param_name' => 'filter',
			'value' => $final_client_cats
		);
		vc_add_param('pivot_clients', $attributes);
		
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
		
		foreach( $blog_cats as $cat ){
			$final_blog_cats[$cat->name] = $cat->term_id;
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific Blog Category?",
			'param_name' => 'filter',
			'value' => $final_blog_cats
		);
		vc_add_param('pivot_blog', $attributes);
	}
	add_action('init', 'ebor_vc_add_attr', 999);
}