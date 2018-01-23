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
				<div class="icon icon-l icon-color color-dark mb-15"> 
					<i class="'. $icon .'"></i> 
				</div>
				<h3 class="value">'. $title .'</h3>
				<p class="text-uppercase">'. $description .'</p>
			</div>
		';
	
	} elseif( 'boxed-color' == $layout ){
		
		$colour_output = ( $color ) ? 'style="background-color: '. $color .';"' : '';
		
		$output = '
			<div class="'. $custom_css_class .' counter text-center">
				<div class="box box-bg inverse-text" '. $colour_output .'>
					<div class="icon icon-l mb-15"> 
						<i class="'. $icon .'"></i> 
					</div>
					<h3 class="value">'. $title .'</h3>
					<p class="text-uppercase">'. $description .'</p>
				</div>
			</div>
		';
	
	}  elseif( 'disc' == $layout ){
		
		$rand = wp_rand(0, 10000);
		$colour_output = ( $color ) ? '<style>.custom-disc-'. $rand .':after { background-color: rgba('. ebor_hex2rgb($color) .', 0.7); }</style>' : '';
		
		$output = '
			'. $colour_output .'
			<div class="'. $custom_css_class .' counter discs text-center inverse-text">
				<div class="disc custom-disc-'. $rand .'">
					<div class="text">';
					
		if( $icon ){
			$output .= '
				<div class="icon icon-l mb-15"> 
					<i class="'. $icon .'"></i> 
				</div>
			';
		}
		
		if( $title ){
			$output .= '<h3 class="value">'. $title .'</h3>';
		}
		
		$output .= '
						<p>'. $description .'</p>
					</div>
				</div>
			</div>
		';
	
	} else {	
		
		$colour_output = ( $color ) ? 'style="color: '. $color .';"' : '';
		
		$output = '
			<div class="'. $custom_css_class .' counter text-center">
				<div class="box box-bg bg-white">
					<div class="icon icon-l icon-color mb-15" '. $colour_output .'> 
						<i class="'. $icon .'"></i> 
					</div>
					<h3 class="value">'. $title .'</h3>
					<p class="text-uppercase">'. $description .'</p>
				</div>
			</div>
		';
		
	}

	return $output;
}
add_shortcode( 'creatink_counter_block', 'ebor_counter_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_counter_block_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_values(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
			"name" => esc_html__("Counter", 'creatink'),
			"base" => "creatink_counter_block",
			"category" => esc_html__('creatink WP Theme', 'creatink'),
			'description' => 'Counter elements for counters.',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display type", 'creatink'),
					"param_name" => "layout",
					"value" => array(
						'Basic' => 'basic',
						'Boxed' => 'boxed',
						'Boxed Background Color' => 'boxed-color',
						'Disc'  => 'disc'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Number To Count To", 'creatink'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Description Text", 'creatink'),
					"param_name" => "description",
					'holder' => 'div'
				),
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'creatink'),
					"param_name" => "icon",
					"value" => $icons
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Icon Colour", 'creatink'),
					"param_name" => "color",
					'description' => 'Leave blank for default colour, make selection for custom colour',
					'value' => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'creatink'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_counter_block_shortcode_vc' );