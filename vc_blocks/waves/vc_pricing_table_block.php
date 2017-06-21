<?php 

/**
 * The Shortcode
 */
function ebor_pricing_table_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'subtitle' => '',
				'hover_text' => '',
				'text' => '',
				'currency' => '$',
				'amount' => '3',
				'button_text' => 'Sign Up',
				'button_url' => ''
			), $atts 
		) 
	);
	
	$output = '
		<section class="pricing-table">
			<h3>'. $title .'<span>'. $subtitle .'</span></h3>
			<h2>
				<span class="price"><sup>'. $currency .'</sup>'. $amount .'</span>
				<span class="deets">'. $hover_text .'</span>
			</h2>
			'. do_shortcode(htmlspecialchars_decode($content)) .'
			<a href="'. esc_url($button_url) .'" class="btn btn-primary">'. $button_text .'</a>
		</section>
	';
	
	return $output;
}
add_shortcode( 'waves_pricing_table', 'ebor_pricing_table_shortcode' );

/**
 * The VC Functions
 */
function ebor_pricing_table_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'waves-vc-block',
			"name" => esc_html__("Pricing Table", 'waves'),
			"base" => "waves_pricing_table",
			"category" => esc_html__('waves WP Theme', 'waves'),
			'description' => 'Add a pricing table to the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'waves'),
					"param_name" => "title"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", 'waves'),
					"param_name" => "subtitle"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Hover Text", 'waves'),
					"param_name" => "hover_text"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Currency", 'waves'),
					"param_name" => "currency",
					"value" => '$',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Amount", 'waves'),
					"param_name" => "amount",
					"value" => '3',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'waves'),
					"param_name" => "button_text",
					"value" => 'Select Plan',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button URL", 'waves'),
					"param_name" => "button_url"
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'waves'),
					"param_name" => "content",
					'holder' => 'div'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_pricing_table_shortcode_vc' );