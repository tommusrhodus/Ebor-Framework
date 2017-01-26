<?php 

/**
 * The Shortcode
 */
function ebor_fact_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'icon' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="text-center facts">
		
			<div class="icon-large"> 
				<i class="'. esc_attr($icon) .'"></i> 
			</div>
			
			'. htmlspecialchars_decode($content) .'
		
		</div>
	';

	return $output;
}
add_shortcode( 'malory_fact_block', 'ebor_fact_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_fact_block_shortcode_vc() {
	
	$icons = array_keys(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_keys(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'malory-vc-block',
			"name" => esc_html__("Fact Counter", 'malory'),
			"base" => "malory_fact_block",
			"category" => esc_html__('malory WP Theme', 'malory'),
			'description' => 'Counter elements for facts.',
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'malory'),
					"param_name" => "icon",
					"value" => $icons,
					'description' => 'view all icons here: http://ionicons.com'
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Title & Description", 'malory'),
					"param_name" => "content",
					'holder' => 'div'
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_fact_block_shortcode_vc' );