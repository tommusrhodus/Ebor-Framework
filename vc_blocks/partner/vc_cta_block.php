<?php 

/**
 * The Shortcode
 */
function ebor_call_to_action_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'url' => '',
				'button_text' => '',
				'target' => '_blank'
			), $atts 
		) 
	);
	
	$output = '
		<div class="cta-text-basic row">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12">
						<hr>
					</div>
				</div><!--end of row-->
				<div class="row">
					<div class="col-md-9 col-sm-8">
						<h3>'. $title .'</h3>
					</div>
					<div class="col-md-3 col-sm-4 text-right text-left-xs">
						<a href="'. esc_url($url) .'" class="btn" target="'. esc_attr($target) .'">
							<span class="btn__text">
								'. $button_text.'
							</span>
							<i class="ion-arrow-right-c"></i>
						</a>
					</div>
				</div><!--end of row-->
			</div><!--end of container-->
		</div>
	';

	return $output;
}
add_shortcode( 'partner_call_to_action_block', 'ebor_call_to_action_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_call_to_action_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
			"name" => esc_html__("Call To Action", 'partner'),
			"base" => "partner_call_to_action_block",
			"category" => esc_html__('partner WP Theme', 'partner'),
			'description' => 'Simple text and a button to grab attention',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'partner'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button URL", 'partner'),
					"param_name" => "url"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'partner'),
					"param_name" => "button_text"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Target", 'partner'),
					"param_name" => "target",
					'value' => '_blank',
					'description' => 'For details, see here: http://www.w3schools.com/tags/att_link_target.asp'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_call_to_action_block_shortcode_vc' );