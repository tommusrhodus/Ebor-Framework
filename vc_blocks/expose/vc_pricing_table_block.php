<?php 

/**
 * The Shortcode
 */
function ebor_pricing_table_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'text' => '',
				'currency' => '$',
				'amount' => '3',
				'button_text' => 'Sign Me Up',
				'button_url' => '',
				'detail' => '/mo',
			), $atts 
		) 
	);
	
	$lines = explode( ',', $text );
	
	$output = '<article class="add-min-top-half text-center">
					<div class="pricing-container silver-bg">
						<div class="pricing-header">
							<h2 class="black">'. htmlspecialchars_decode($title) .'</h2>
							<div class="pricing">
								<p class="dark"><span>'. htmlspecialchars_decode($currency) .'</span>'. htmlspecialchars_decode($amount) .'</p>
							</div>
							<h4 class="dark">'. htmlspecialchars_decode($detail) .'</h4>
						</div>
						<div class="pricing-features">
							<div class="each">';
							
							foreach($lines as $line){
								$output .= '<h2>'. htmlspecialchars_decode($line) .'</h2>';
							}
	
				$output .= '</div>
							<a href="'. esc_url($button_url) .'" class="btn btn-expose btn-expose-dark custom-pricing-btn-style"><span>'. htmlspecialchars_decode($button_text) .'</span></a>
						</div>
					</div>
				</article>';

	return $output;
}
add_shortcode( 'expose_pricing_table', 'ebor_pricing_table_shortcode' );

/**
 * The VC Functions
 */
function ebor_pricing_table_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'expose-vc-block',
			"name" => __("Pricing Table", 'expose'),
			"base" => "expose_pricing_table",
			"category" => __('Expose WP Theme', 'expose'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'expose'),
					"param_name" => "title",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Currency", 'expose'),
					"param_name" => "currency",
					"value" => '$',
				),
				array(
					"type" => "textfield",
					"heading" => __("Amount", 'expose'),
					"param_name" => "amount",
					"value" => '3',
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Text", 'expose'),
					"param_name" => "button_text",
					"value" => 'Sign me up',
				),
				array(
					"type" => "textfield",
					"heading" => __("Button URL", 'expose'),
					"param_name" => "button_url",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Small Detail", 'expose'),
					"param_name" => "detail",
					"value" => '/mo',
				),
				array(
					"type" => "exploded_textarea",
					"heading" => __("Pricing details, one per line", 'expose'),
					"param_name" => "text",
					"value" => '',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_pricing_table_shortcode_vc' );