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
				'button_text' => 'Select Plan',
				'button_url' => ''
			), $atts 
		) 
	);
	
	$lines = explode( ',', $text );
	
	$output = '
		<div class="pricing panel">
		  <div class="panel-heading">
		    <h3 class="panel-title">'. htmlspecialchars_decode($title) .'</h3>
		    <div class="price"> 
		    	<span class="price-currency">'. htmlspecialchars_decode($currency) .'</span> 
		    	<span class="price-value">'. htmlspecialchars_decode($amount) .'</span> 
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
add_shortcode( 'lydia_pricing_table', 'ebor_pricing_table_shortcode' );

/**
 * The VC Functions
 */
function ebor_pricing_table_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lydia-vc-block',
			"name" => esc_html__("Pricing Table", 'lydia'),
			"base" => "lydia_pricing_table",
			"category" => esc_html__('Lydia WP Theme', 'lydia'),
			'description' => 'Add a pricing table to the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'lydia'),
					"param_name" => "title"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Currency", 'lydia'),
					"param_name" => "currency",
					"value" => '$',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Amount", 'lydia'),
					"param_name" => "amount",
					"value" => '3',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'lydia'),
					"param_name" => "button_text",
					"value" => 'Select Plan',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button URL", 'lydia'),
					"param_name" => "button_url"
				),
				array(
					"type" => "exploded_textarea",
					"heading" => esc_html__("Pricing details, one per line", 'lydia'),
					"param_name" => "text"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_pricing_table_shortcode_vc' );