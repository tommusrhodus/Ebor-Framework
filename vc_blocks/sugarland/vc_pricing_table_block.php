<?php 

/**
 * The Shortcode
 */
function ebor_pricing_table_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'       => '',
				'text'        => '',
				'currency'    => '$',
				'amount'      => '3',
				'button_text' => 'Sign Up',
				'button_url'  => '',
				'css_class'   => ''
			), $atts 
		) 
	);
	
	$lines = explode(',', $text);
	
	$output = '
		<figure class="price-table '. esc_attr($css_class) .'">
			<div class="heading">
				<h4>'. htmlspecialchars_decode($title) .'</h4>
			</div>
			<p class="price">
				<span>'. htmlspecialchars_decode($currency) .'</span>'. htmlspecialchars_decode($amount) .'</p>
			<p>
	';
	
	if( is_array($lines) ){
		foreach($lines as $key => $line){
			$output .= '<span class="price-details">'. htmlspecialchars_decode($line) .'</span>';
		}
	}

	$output .= '
			</p>
			<a href="'. esc_url($button_url) .'" class="button full-color"><i class="fa fa-shopping-cart"></i> '. htmlspecialchars_decode($button_text) .'</a>
		</figure>
	';
	
	return $output;
}
add_shortcode( 'sugarland_pricing_table', 'ebor_pricing_table_shortcode' );

/**
 * The VC Functions
 */
function ebor_pricing_table_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'sugarland-vc-block',
			"name" => esc_html__("Pricing Table", 'sugarland'),
			"base" => "sugarland_pricing_table",
			"category" => esc_html__('sugarland WP Theme', 'sugarland'),
			'description' => 'Add a pricing table to the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'sugarland'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Currency", 'sugarland'),
					"param_name" => "currency",
					"value" => '$',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Amount", 'sugarland'),
					"param_name" => "amount",
					"value" => '3',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'sugarland'),
					"param_name" => "button_text",
					"value" => 'Select Plan',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button URL", 'sugarland'),
					"param_name" => "button_url"
				),
				array(
					"type" => "exploded_textarea",
					"heading" => esc_html__("Pricing details, one per line", 'sugarland'),
					"param_name" => "text"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("CSS Class", 'sugarland'),
					"param_name" => "css_class",
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_pricing_table_shortcode_vc' );