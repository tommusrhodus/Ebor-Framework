<?php 

/**
 * The Shortcode
 */
function ebor_pricing_table_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'            => '',
				'text'             => '',
				'currency'         => '$',
				'amount'           => '3',
				'duration'         => 'year',
				'button_text'      => 'Sign Up',
				'button_url'       => '',
				'layout'           => 'white-box',
				'custom_css_class' => ''
			), $atts 
		) 
	);

	$lines       = explode( ',', $text );
	$final_lines = '<li>'. implode( '</li><li>', $lines ) . '</li>';
	$class       = ( 'best' == $custom_css_class ) ? 'btn-color' : 'btn-dark'; 
	
	if( 'minimal' == $layout ){
		
		$output = '
			<div class="pricing-tables style-2 '. $custom_css_class .'">       
				<div class="pricing-table">
					
					<div class="pricing-title">
						<h3>'. $title .'</h3>                  
					</div>
					
					<div class="pricing-price">
						<span class="pricing-currency">'. htmlspecialchars_decode($currency) .'</span>
						<span>'. htmlspecialchars_decode($amount) .'</span>  
					</div>
					
					<div class="pricing-features">
						<p>'. $text .'</p>
					</div>                
					
					<div class="pricing-button">
						<a href="'. esc_url($button_url) .'" class="btn btn-lg btn-color"><span>'. htmlspecialchars_decode($button_text) .'</span></a>
					</div>
				
				</div>
			</div>
		';
		
	} else {
	
		$output = '
			<div class="pricing-table '. $custom_css_class .'">
			
				<div class="pricing-title"><h3>'. htmlspecialchars_decode($title) .'</h3></div>
				
				<div class="pricing-price">
					<span class="pricing-currency">'. htmlspecialchars_decode($currency) .'</span>
					<span>'. htmlspecialchars_decode($amount) .'</span>
					<span class="pricing-term">'. htmlspecialchars_decode($duration) .'</span>
				</div>
				
				<div class="pricing-features">
					<ul>'. $final_lines .'</ul>
				</div>                
				
				<div class="pricing-button">
					<a href="'. esc_url($button_url) .'" class="btn btn-md '. $class .'"><span>'. htmlspecialchars_decode($button_text) .'</span></a>
				</div>
			
			</div>
		';
	
	}
	
	return $output;
}
add_shortcode( 'gaze_pricing_table', 'ebor_pricing_table_shortcode' );

/**
 * The VC Functions
 */
function ebor_pricing_table_shortcode_vc() {
	
	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Pricing Table", 'gaze' ),
			"base"        => "gaze_pricing_table",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			'description' => 'Add a pricing table to the page.',
			"params"      => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'gaze'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Currency", 'gaze'),
					"param_name" => "currency",
					"value" => '$',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Amount", 'gaze'),
					"param_name" => "amount",
					"value" => '3',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Duration", 'gaze'),
					"param_name" => "duration",
					"value" => 'Year',
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__("Button Text", 'gaze'),
					"param_name" => "button_text",
					"value"      => 'Select Plan',
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__("Button URL", 'gaze'),
					"param_name" => "button_url"
				),
				array(
					"type"       => "exploded_textarea",
					"heading"    => esc_html__("Pricing details, one per line", 'gaze'),
					"param_name" => "text"
				),
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__("Display type", 'gaze'),
					"param_name" => "layout",
					"value"      => array(
						'White Boxed Table' => 'white-box',
						'Minimal Table'     => 'minimal'
					)
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
add_action( 'vc_before_init', 'ebor_pricing_table_shortcode_vc' );