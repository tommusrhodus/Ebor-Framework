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
				'icon' => 'none'
			), $atts 
		) 
	);
	
	$lines = explode( ',', $text );
	
	$output = '<div class="price">';
	
	if(!( 'none' == $icon ))				
		$output .= '<i class="ion-'. esc_attr($icon) .' color"></i>';
	
	$output .= '<h5 class="font2 whitegray-bg black ">'. htmlspecialchars_decode($title) .'</h5>
					<div class="price-specs">
					<h1 class="font1 color">'. htmlspecialchars_decode($currency) . htmlspecialchars_decode($amount) .'</h1>';
	
	foreach($lines as $line){
		$output .= htmlspecialchars_decode($line) .'</br>';
	}
	
	$output .= '</div>
				<div class="pricing-button">
					<a href="'. esc_url($button_url) .'" class="btn btn-uber btn-uber-color">'. htmlspecialchars_decode($button_text) .'</a>
				</div>
			</div>';

	return $output;
}
add_shortcode( 'uber_pricing_table', 'ebor_pricing_table_shortcode' );

/**
 * The VC Functions
 */
function ebor_pricing_table_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'uber-vc-block',
			"name" => __("Pricing Table", 'uber'),
			'description' => __('Adds a pricing table with extra details', 'uber'),
			"base" => "uber_pricing_table",
			"category" => __('Uber - WP Theme', 'uber'),
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => __("Pricing Table Icon", 'uber'),
					"param_name" => "icon",
					"value" => ebor_get_icons(),
					'description' => 'view all icons here: http://ionicons.com'
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", 'uber'),
					"param_name" => "title",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Currency", 'uber'),
					"param_name" => "currency",
					"value" => '$',
				),
				array(
					"type" => "textfield",
					"heading" => __("Amount", 'uber'),
					"param_name" => "amount",
					"value" => '3',
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Text", 'uber'),
					"param_name" => "button_text",
					"value" => 'Sign me up',
				),
				array(
					"type" => "textfield",
					"heading" => __("Button URL", 'uber'),
					"param_name" => "button_url",
					"value" => '',
				),
				array(
					"type" => "exploded_textarea",
					"heading" => __("Pricing details, one per line", 'uber'),
					"param_name" => "text",
					"value" => '',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_pricing_table_shortcode_vc' );