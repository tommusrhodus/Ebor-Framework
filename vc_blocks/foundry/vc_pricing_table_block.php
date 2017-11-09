<?php 

/**
 * The Shortcode
 */
function ebor_pricing_table_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'small' => '',
				'amount' => '$3',
				'button_text' => 'Select Plan',
				'button_url' => '',
				'layout' => 'basic'
			), $atts 
		) 
	);
	
	if( 'basic' == $layout ){
		$output = '
			<div class="pricing-table pt-1 text-center">
		        <H5 class="uppercase">'. htmlspecialchars_decode($title) .'</H5>
		        <span class="price">'. htmlspecialchars_decode($amount) .'</span>
		        <p class="lead">'. htmlspecialchars_decode($small) .'</p>
		        <a class="btn btn-filled btn-lg" href="'. esc_url($button_url) .'">'. htmlspecialchars_decode($button_text) .'</a>
		        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
		    </div>
	    ';
	} elseif( 'boxed' == $layout ) {
		$output = '
		    <div class="pricing-table pt-1 text-center boxed">
		        <H5 class="uppercase">'. htmlspecialchars_decode($title) .'</H5>
		        <span class="price">'. htmlspecialchars_decode($amount) .'</span>
		        <p class="lead">'. htmlspecialchars_decode($small) .'</p>
		        <a class="btn btn-filled btn-lg" href="'. esc_url($button_url) .'">'. htmlspecialchars_decode($button_text) .'</a>
		        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
		    </div>
	    ';
	} else {
		$output = '
			<div class="pricing-table pt-1 text-center emphasis">
			    <H5 class="uppercase">'. htmlspecialchars_decode($title) .'</H5>
			    <span class="price">'. htmlspecialchars_decode($amount) .'</span>
			    <p class="lead">'. htmlspecialchars_decode($small) .'</p>
			    <a class="btn btn-white btn-lg" href="'. esc_url($button_url) .'">'. htmlspecialchars_decode($button_text) .'</a>
			    '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			</div>
		';
	}
	
	return $output;
}
add_shortcode( 'foundry_pricing_table', 'ebor_pricing_table_shortcode' );

/**
 * The VC Functions
 */
function ebor_pricing_table_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Pricing Table", 'foundry'),
			"base" => "foundry_pricing_table",
			"category" => __('Foundry WP Theme', 'foundry'),
			'description' => 'Add a pricing table to the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'foundry'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Amount", 'foundry'),
					"param_name" => "amount",
					"value" => '$3',
				),
				array(
					"type" => "textfield",
					"heading" => __("Small Text", 'foundry'),
					"param_name" => "small",
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Text", 'foundry'),
					"param_name" => "button_text",
					"value" => 'Select Plan',
				),
				array(
					"type" => "textfield",
					"heading" => __("Button URL", 'foundry'),
					"param_name" => "button_url",
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'foundry'),
					"param_name" => "layout",
					"value" => array(
						'Basic Background' => 'basic',
						'Boxed Background' => 'boxed',
						'Emphasis Background' => 'emphasis'
					)
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Table Content", 'foundry'),
					"param_name" => "content"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_pricing_table_shortcode_vc' );