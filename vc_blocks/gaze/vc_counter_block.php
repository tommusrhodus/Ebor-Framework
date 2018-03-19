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
				'layout'           => 'big'
			), $atts 
		) 
	);
	
	if( 'big' == $layout ){
	
		if( $icon ){
		
			$output = '
				<div class="'. $custom_css_class .' statistic text-center with-icon mt-mdm-40">
					<i class="'. $icon .'"></i>
					<span class="statistic-timer" data-from="0" data-to="'. $title .'">&nbsp;</span>
					<h5 class="counter-text">'. $description .'</h5>
				</div>
			';
		
		} else {
			
			$output = '
				<div class="'. $custom_css_class .' statistic text-center mt-mdm-40">
					<span class="statistic-timer" data-from="0" data-to="'. $title .'">&nbsp;</span>
					<h5 class="counter-text">'. $description .'</h5>
				</div>
			';
			
		}
	
	} else {
	
		$output = '
			<div class="statistic statistic-1 text-center">
				<h5 class="counter-text">'. $description .'</h5>
				<span class="statistic-timer" data-from="0" data-to="'. $title .'">'. $title .'</span>
			</div>
		';
	
	}

	return $output;
}
add_shortcode( 'gaze_counter_block', 'ebor_counter_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_counter_block_shortcode_vc() {
	
	$icons = array_keys(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_keys(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Counter", 'gaze' ),
			"base"        => "gaze_counter_block",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			'description' => 'Counter elements for counters.',
			"params"      => array(
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Number to count to", 'gaze' ),
					"param_name" => "title",
					'holder'     => 'div'
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Description", 'gaze' ),
					"param_name" => "description",
					'holder'     => 'div'
				),
				array(
					"type"       => "ebor_icons",
					"heading"    => esc_html__( "Icon", 'gaze' ),
					"param_name" => "icon",
					"value"      => $icons
				),
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__( "Display type", 'gaze' ),
					"param_name" => "layout",
					'holder'     => 'div',
					"value"      => array(
						'Chunky Text'   => 'big',
						'Small Text'    => 'small'
					)
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__("Extra CSS Class Name", 'gaze'),
					"param_name"  => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_counter_block_shortcode_vc' );