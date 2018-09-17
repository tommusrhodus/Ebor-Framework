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

/**
 * Add additional functions to certain blocks.
 * vc_map runs before custom post types and taxonomies are created, so this function is used
 * to add custom taxonomy selectors to VC blocks, a little annoying, but works perfectly.
 */
if(!( function_exists('ebor_vc_add_att') )){
	function ebor_vc_add_attr(){
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Section Layout",
			'param_name' => 'layout',
			'value' => array_flip(array(
				'standard' => 'Standard Row',
				'full' => 'Fullwidth Row',
			)),
			'description' => "Choose Layout For This Row"
		);
		vc_add_param('vc_row', $attributes);

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
		
		if( taxonomy_exists('portfolio_category') ){
			if( is_array($portfolio_cats) ){
				foreach( $portfolio_cats as $cat ){
					$final_portfolio_cats[$cat->name] = $cat->term_id;
				}
			}
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific Portfolio Category?",
			'param_name' => 'filter',
			'value' => $final_portfolio_cats
		);
		vc_add_param('huntington_portfolio', $attributes);
		
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
		
		if( is_archive() || is_home() )
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