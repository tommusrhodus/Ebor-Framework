<?php 

/**
 * The Shortcode
 */
function ebor_fact_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'icon' => '',
				'counter' => '7518',
				'description' => 'Shots Taken'
			), $atts 
		) 
	);
	
	$output = '
		<div class="text-center facts">
			<div class="icon mb-20"> 
				<i class="'. esc_attr($icon) .'"></i>
			</div>
			<span class="fcounter">'. wp_kses_post($counter) .'</span>
			<p>'. wp_kses_post($description) .'</p>
		</div>
	';
	return $output;
}
add_shortcode( 'malefic_fact_block', 'ebor_fact_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_fact_block_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_values(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'malefic-vc-block',
			"name" => esc_html__("Fact Counter", 'malefic'),
			"base" => "malefic_fact_block",
			"category" => esc_html__('malefic WP Theme', 'malefic'),
			'description' => 'Counter elements for facts.',
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'malefic'),
					"param_name" => "icon",
					"value" => $icons
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Counter Text", 'malefic'),
					"param_name" => "counter",
					'value' => '7518'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Description Text", 'malefic'),
					"param_name" => "description",
					'value' => 'Shots Taken',
					'holder' => 'div'
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_fact_block_shortcode_vc' );