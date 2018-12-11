<?php 

/**
 * The Shortcode
 */
function ebor_counter_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'icon'             => '',
				'title'            => '',
				'description'      => '',
				'custom_css_class' => '',
				'layout'           => 'basic',
				'color'            => ''
			), $atts 
		) 
	);
	
	if( 'basic' == $layout ){
	
		$output = '
			<div class="'. $custom_css_class .' counter text-center">
				<div class="icon fs-54 icon-color color-dark mb-15"> 
					<i class="fa '. $icon .'" style="color: '. $color .'"></i> 
				</div>
				<h3 class="value">'. $title .'</h3>
				<p class="text-uppercase">'. $description .'</p>
			</div>
		';
	
	} elseif( 'boxed-color' == $layout ){
		
		$colour_output = ( $color ) ? 'style="background-color: '. $color .';"' : '';
		
		$output = '
			<div class="'. $custom_css_class .' counter text-center">
				<div class="box box-bg rounded inverse-text" '. $colour_output .'>
					<div class="icon fs-54 icon-color color-dark mb-15"> 
						<i class="fa '. $icon .'"></i> 
					</div>
					<h3 class="value">'. $title .'</h3>
					<p class="text-uppercase">'. $description .'</p>
				</div>
			</div>
		';
	
	}  elseif( 'border' == $layout ){
	
		$output = '
			<div class="'. $custom_css_class .' counter text-center">
				<div class="box box-border">
					<div class="icon fs-54 icon-color color-dark mb-15"> 
						<i class="fa '. $icon .'" style="color: '. $color .'"></i> 
					</div>
					<h3 class="value">'. $title .'</h3>
					<p class="text-uppercase">'. $description .'</p>
				</div>
			</div>
		';
	
	}

	return $output;
}
add_shortcode( 'brailie_counter_block', 'ebor_counter_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_counter_block_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('brailie_get_icons') ){
		$icons = array_values(brailie_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
			"name" => esc_html__("Counter", 'brailie'),
			"base" => "brailie_counter_block",
			"category" => esc_html__('brailie WP Theme', 'brailie'),
			'description' => 'Counter elements for counters.',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display type", 'brailie'),
					"param_name" => "layout",
					"value" => array(
						'Basic' => 'basic',
						'Boxed Background Color' => 'boxed-color',
						'Border' => 'border'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Number To Count To", 'brailie'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Description Text", 'brailie'),
					"param_name" => "description",
					'holder' => 'div'
				),
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'brailie'),
					"param_name" => "icon",
					"value" => $icons
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Icon Colour", 'brailie'),
					"param_name" => "color",
					'description' => 'Leave blank for default colour, make selection for custom colour',
					'value' => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'brailie'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_counter_block_shortcode_vc' );