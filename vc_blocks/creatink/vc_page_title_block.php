<?php 

/**
 * The Shortcode
 */
function ebor_page_title_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type'  => 'gray',
				'title' => '',
				'description' => ''
			), $atts 
		) 
	);
	
	$output = ebor_page_title($type, $title, $description);
	
	return $output;
}
add_shortcode( 'creatink_page_title_block', 'ebor_page_title_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_page_title_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
			"name" => esc_html__("Page Title Bar", 'creatink'),
			"base" => "creatink_page_title_block",
			"category" => esc_html__('creatink WP Theme', 'creatink'),
			'description' => 'Page title bar & breadcrumbs',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Page Title", 'creatink'),
					"param_name" => "title"
				),
				array(
					'type' => 'dropdown',
					'heading' => "Display Type",
					'param_name' => 'type',
					'value' => array(
						'Gray Title'  => 'gray',
						'Dark Title'  => 'dark',
						'Color Title' => 'color',
						'Gradient Title' => 'gradient',
						'Pattern Title' => 'pattern', 
						'Image Title' => 'image',
						'Detailed Title' => 'detailed'
					),
					'description' => "Choose a display style for this page title."
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Description", 'creatink'),
					"param_name" => "description"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_page_title_block_shortcode_vc' );