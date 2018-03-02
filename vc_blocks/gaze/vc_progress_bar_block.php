<?php 

/**
 * The Shortcode
 */
function ebor_progress_bar_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'            => '',
				'amount'           => '40',
				'layout'           => 'bar',
				'icon'             => '',
				'background_color' => '#1abcb0',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	if( 'bar' == $layout ){
		
		$style = ( $background_color ) ? 'style="background-color:'. $background_color .';"' : '';
		
		$output = '
			<div class="progress-bars '. $custom_css_class .'">
			
				<h6>'. $title .' <span>'. (int)$amount .'%</span></h6>
				
				<div class="progress meter">
					<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="'. (int)$amount .'" class="progress-bar" role="progressbar" '. $style .'>
						<span class="sr-only">'. (int)$amount .'% Complete</span>
					</div>
				</div>
			
			</div>
		';
		
	} else {
		
		
		$output = '
			<div class="pie-chart text-center mb-40 '. $custom_css_class .'">
				<div class="chart" data-percent="'. (int)$amount .'" data-bar-color="'. $background_color .'">
		';
		
		if( $icon ){
			$output .= '<i class="'. $icon .'"></i>';
		} else {
			$output .= '<span class="percent">'. (int)$amount .'%</span>';
		}
		
		$output .= '
				</div>
				<h6 class="text-center mt-20">'. $title .'</h6>
			</div>
		';
		
	}
	
	return $output;
}
add_shortcode( 'gaze_progress_bar_block', 'ebor_progress_bar_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_progress_bar_block_shortcode_vc() {
	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Progress Bar", 'gaze' ),
			"base"        => "gaze_progress_bar_block",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			'description' => 'Coloured bars for demonstrating your progresss.',
			"params"      => array(
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__( "Display type", 'gaze' ),
					"param_name" => "layout",
					"value"      => array(
						'Progress Bar'             => 'bar',
						'Progress Bar Circle'      => 'circle'
					)
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Progress Title", 'gaze' ),
					"param_name" => "title",
					'holder'     => 'div'
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__("Progress Amount", 'gaze'),
					"param_name"  => "amount",
					'description' => 'Use a value between 0 - 100 only.',
					'value'       => '40'
				),
				array(
					"type"        => "colorpicker",
					"heading"     => esc_html__("Background Colour", 'gaze'),
					"param_name"  => "background_color",
					'description' => 'Leave blank for default colour, make selection for custom colour',
					'value'       => '#1abcb0'
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Icon", 'gaze' ),
					"param_name" => "icon",
					'holder'     => 'div'
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__("Extra CSS Class Name", 'gaze'),
					"param_name"  => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_progress_bar_block_shortcode_vc' );