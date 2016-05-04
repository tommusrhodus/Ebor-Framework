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
				'text' => '',
				'currency' => '$',
				'amount' => '3',
				'duration' => 'year',
				'button_text' => 'Select Plan',
				'button_url' => '',
				'highlight' => ''
			), $atts 
		) 
	);
	
	$lines = explode( ',', $text );
	
	$output = '
		<div class="pricing panel '. esc_attr($highlight) .'">
		  <div class="panel-heading">
		    <h3 class="panel-title">'. htmlspecialchars_decode($title) .' <span class="panel-desc">'. htmlspecialchars_decode($subtitle) .'</span></h3>
		    <div class="price"> 
		    	<span class="price-currency">'. htmlspecialchars_decode($currency) .'</span> 
		    	<span class="price-value">'. htmlspecialchars_decode($amount) .'</span> 
		    	<span class="price-duration">'. htmlspecialchars_decode($duration) .'</span>
		    </div>
		  </div>
		  <div class="panel-body">
		    <table class="table">
	';
	
	if( is_array($lines) ){
		foreach($lines as $key => $line){
			$output .= '
				<tr>
				  <td>'. htmlspecialchars_decode($line) .' </td>
				</tr>
			';
		}
	}
		    
	$output .= '</table>
		  </div>
		  <div class="panel-footer"> 
		  	<a href="'. esc_url($button_url) .'" class="btn" role="button">'. htmlspecialchars_decode($button_text) .'</a>
		  </div>
		</div>
	';
	
	return $output;
}
add_shortcode( 'ryla_pricing_table', 'ebor_pricing_table_shortcode' );

/**
 * The VC Functions
 */
function ebor_pricing_table_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'ryla-vc-block',
			"name" => esc_html__("Pricing Table", 'ryla'),
			"base" => "ryla_pricing_table",
			"category" => esc_html__('ryla WP Theme', 'ryla'),
			'description' => 'Add a pricing table to the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'ryla'),
					"param_name" => "title"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", 'ryla'),
					"param_name" => "subtitle"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Currency", 'ryla'),
					"param_name" => "currency",
					"value" => '$',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Amount", 'ryla'),
					"param_name" => "amount",
					"value" => '3',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Duration", 'ryla'),
					"param_name" => "duration",
					"value" => 'Year',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Highlight this Pricing Table?", 'ryla'),
					"description" => esc_html__("Type 'active' for highlight, can also be used for custom classes if needed.", 'ryla'),
					"param_name" => "highlight",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'ryla'),
					"param_name" => "button_text",
					"value" => 'Select Plan',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button URL", 'ryla'),
					"param_name" => "button_url"
				),
				array(
					"type" => "exploded_textarea",
					"heading" => esc_html__("Pricing details, one per line", 'ryla'),
					"param_name" => "text"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_pricing_table_shortcode_vc' );