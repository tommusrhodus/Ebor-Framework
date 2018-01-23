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
				'layout'           => 'circle',
				'text_color'       => '',
				'background_color' => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$rand = wp_rand(0, 10000);
	$style_output = $output = '';
	
	if( 'circle' == $layout ){
		
		if( $text_color || $background_color ){
			$output .= '
				<style>
					.progressbar.custom-progressbar-'. $rand .' svg path:last-child {
					    stroke: '. $background_color.'
					}
					.circle.custom-progressbar-'. $rand .' .progressbar-text {
					    color: '. $text_color .' !important
					}
				</style>
			';
		}
		
		$output .= '
			<div class="'. $custom_css_class .'">
				<div class="progressbar custom-progressbar-'. $rand .' circle full-circle" data-value="'. (int)$amount .'"></div>
				'. $content .'
			</div>
		';
	
	} elseif( 'semi-circle' == $layout ){
		
		if( $text_color || $background_color ){
			$output .= '
				<style>
					.progressbar.custom-progressbar-'. $rand .' svg path:last-child {
					    stroke: '. $background_color.'
					}
					.circle.custom-progressbar-'. $rand .' .progressbar-text {
					    color: '. $text_color .' !important
					}
				</style>
			';
		}
		
		$output .= '
			<div class="'. $custom_css_class .'">
				<div class="progressbar custom-progressbar-'. $rand .' circle semi-circle" data-value="'. (int)$amount .'"></div>
				'. $content .'
			</div>
		';
	
	} elseif( 'bar' == $layout ){
		
		if( $text_color || $background_color ){
			$output .= '
				<style>
					.progressbar.custom-progressbar-'. $rand .' svg path:last-child {
					    stroke: '. $background_color .';
					}
				</style>
			';
		}
		
		$output .= '
			<ul class="progress-list">
				<li>
					<p>'. $title .'</p>
					<div class="progressbar custom-progressbar-'. $rand .' line" data-value="'. (int)$amount .'"></div>
				</li>
			</ul>
		';
		
	} else {
		
		if( $text_color || $background_color ){
			$output .= '
				<style>
					.progressbar.border.custom-progressbar-'. $rand .' svg path:last-child {
					    stroke: '. $background_color .';
					}
					.progressbar.border.custom-progressbar-'. $rand .' {
						border-color: '. $background_color .';
					}
				</style>
			';
		}
		
		$output .= '
			<ul class="progress-list">
				<li>
					<p>'. $title .'</p>
					<div class="progressbar custom-progressbar-'. $rand .' line border" data-value="'. (int)$amount .'"></div>
				</li>
			</ul>
		';
		
	}
	
	return $output;
}
add_shortcode( 'creatink_progress_bar_block', 'ebor_progress_bar_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_progress_bar_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
			"name" => esc_html__("Progress Bar", 'creatink'),
			"base" => "creatink_progress_bar_block",
			"category" => esc_html__('creatink WP Theme', 'creatink'),
			'description' => 'Coloured bars for demonstrating your progresss.',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display type", 'creatink'),
					"param_name" => "layout",
					"value" => array(
						'Progress Bar Circle'      => 'circle',
						'Progress Bar Semi Circle' => 'semi-circle',
						'Progress Bar'             => 'bar',
						'Progress Bar Bordered'    => 'bar-bordered'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Progress Title", 'creatink'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Progress Amount", 'creatink'),
					"param_name" => "amount",
					'description' => 'Use a value between 0 - 100 only.',
					'value' => '40'
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Text Colour", 'creatink'),
					"param_name" => "text_color",
					'description' => 'Leave blank for default colour, make selection for custom colour',
					'value' => ''
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Background Colour", 'creatink'),
					"param_name" => "background_color",
					'description' => 'Leave blank for default colour, make selection for custom colour',
					'value' => ''
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'creatink'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'creatink'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_progress_bar_block_shortcode_vc' );