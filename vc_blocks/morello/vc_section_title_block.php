<?php 

/**
 * The Shortcode
 */
function ebor_section_title_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'subtitle' => '',
				'layout' => 'text-left'
			), $atts 
		) 
	);
	
	$class = ( 'text-center' == $layout ) ? 'thin' : false;
	
	$output = '
		<div class="section-title '. esc_attr($layout) .'">
			<h2>'. esc_html($title) .'</h2>
			<p class="lead '. esc_attr($class) .'">'. esc_html($subtitle) .'</p>
		</div><!-- /.section-title -->
	';
	
	return $output;
}
add_shortcode( 'morello_section_title_block', 'ebor_section_title_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_section_title_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'morello-vc-block',
			"name" => esc_html__("Section Title", 'morello'),
			"base" => "morello_section_title_block",
			"category" => esc_html__('morello WP Theme', 'morello'),
			'description' => 'Beautiful, Simple Title Text',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'morello'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", 'morello'),
					"param_name" => "subtitle"
				),
				array(
					'type' => 'dropdown',
					"heading" => esc_html__("Layout", 'morello'),
					'param_name' => 'layout',
					'value' => array(
						'Left Align' => 'text-left',
						'Center Align' => 'text-center'
					)
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_section_title_block_shortcode_vc' );