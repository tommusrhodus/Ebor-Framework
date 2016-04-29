<?php 

/**
 * The Shortcode
 */
function ebor_pricing_table_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'fine_text' => '',
				'amount' => '3',
				'currency' => '',
				'detail' => '',
				'button_text' => 'Select Plan',
				'button_url' => '',
				'layout' => 'basic',
				'background_class' => 'bg--white'
			), $atts 
		) 
	);
	
	if( 'basic' == $layout ){
		
		$output = '
			<div class="pricing-option boxed text-center '. esc_attr($background_class) .'">
				<h6>'. htmlspecialchars_decode($title) .'</h6>
				<div class="pricing-option__price">
					<span>'. htmlspecialchars_decode($currency) .'</span>
					<span class="h1">'. htmlspecialchars_decode($amount) .'</span>
					<span>'. htmlspecialchars_decode($detail) .'</span>
				</div>
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				<a href="'. esc_url($button_url) .'" class="btn">
					<span class="btn__text">
						'. htmlspecialchars_decode($button_text) .'
					</span>
					<i class="ion-android-checkmark-circle"></i>
				</a>
				<div>
					<span class="type--fine-print">
						'. htmlspecialchars_decode($fine_text) .'
					</span>
				</div>
			</div>
	    ';
	    
	} elseif( 'detailed' == $layout ) {
		
		$output = '
			<div class="pricing-option boxed '. esc_attr($background_class) .'">
				<h4>'. htmlspecialchars_decode($title) .'</h4>
				<hr>
				<div class="col-sm-7">
					'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				</div>
				<div class="col-sm-5 text-center text-left-xs">
					<div class="pricing-option__price">
						<span>'. htmlspecialchars_decode($currency) .'</span>
						<span class="h1">'. htmlspecialchars_decode($amount) .'</span>
						<span>'. htmlspecialchars_decode($detail) .'</span>
					</div>
					<a href="'. esc_url($button_url) .'" class="btn">
						<span class="btn__text">
							'. htmlspecialchars_decode($button_text) .'
						</span>
						<i class="ion-android-checkmark-circle"></i>
					</a>
					<div>
						<span class="type--fine-print">
							'. htmlspecialchars_decode($fine_text) .'
						</span>
					</div>
				</div>
			</div>
		';
		
	} else {
		
		$output = '
			'. do_shortcode(htmlspecialchars_decode($content)) .'
			<div class="pricing-option boxed boxed--sm text-center '. esc_attr($background_class) .'">
				<h6>'. htmlspecialchars_decode($title) .'</h6>
				<div class="pricing-option__price">
					<span>'. htmlspecialchars_decode($currency) .'</span>
					<span class="h1">'. htmlspecialchars_decode($amount) .'</span>
					<span>'. htmlspecialchars_decode($detail) .'</span>
				</div>
				<a href="'. esc_url($button_url) .'" class="btn">
					<span class="btn__text">
						'. htmlspecialchars_decode($button_text) .'
					</span>
					<i class="ion-android-checkmark-circle"></i>
				</a>
				<div>
					<span class="type--fine-print">
						'. htmlspecialchars_decode($fine_text) .'
					</span>
				</div>
			</div>
		';	
		
	}
	
	return $output;
}
add_shortcode( 'partner_pricing_table', 'ebor_pricing_table_shortcode' );

/**
 * The VC Functions
 */
function ebor_pricing_table_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
			"name" => esc_html__("Pricing Table", 'partner'),
			"base" => "partner_pricing_table",
			"category" => esc_html__('partner WP Theme', 'partner'),
			'description' => 'Add a pricing table to the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'partner'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Amount", 'partner'),
					"param_name" => "amount",
					"value" => '3',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Currency", 'partner'),
					"param_name" => "currency",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Detail", 'partner'),
					"param_name" => "detail",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'partner'),
					"param_name" => "button_text",
					"value" => 'Select Plan',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button URL", 'partner'),
					"param_name" => "button_url",
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display type", 'partner'),
					"param_name" => "layout",
					"value" => array(
						'Basic' => 'basic',
						'Image' => 'image',
						'Detailed' => 'detailed'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Fine Text", 'partner'),
					"param_name" => "fine_text",
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Table Content", 'partner'),
					"param_name" => "content"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Background Class", 'partner'),
					"param_name" => "background_class",
					'value' => 'bg--white',
					'description' => 'Use bg--white for white, and bg--primary-1 for colour.'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_pricing_table_shortcode_vc' );