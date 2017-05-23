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
				'button_text' => 'Sign Up',
				'button_url' => '',
				'icon' => ''
			), $atts 
		) 
	);
	
	$lines = explode(',', $text);
	
	$output = '
		<div class="pricing panel">
		
			<div class="panel-heading">
				<div class="icon icon-m">
					<i class="'. esc_attr($icon) .'"></i>
				</div>
				<h3 class="panel-title">'. htmlspecialchars_decode($title) .' <span class="panel-desc">'. htmlspecialchars_decode($subtitle) .'</span></h3>
				<div class="price"> 
					<span class="price-currency">'. htmlspecialchars_decode($currency) .'</span> 
					<span class="price-value">'. htmlspecialchars_decode($amount) .'</span> 
					<span class="price-duration">'. htmlspecialchars_decode($duration) .'</span>
				</div>
			</div><!--/.panel-heading -->
			
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
	
	$output .= '
				</table>
			</div><!--/.panel-body -->
			
			<div class="panel-footer"> 
				<a href="'. esc_url($button_url) .'" class="btn" role="button">'. htmlspecialchars_decode($button_text) .'</a>
			</div>
		
		</div>
	';
	
	return $output;
}
add_shortcode( 'malefic_pricing_table', 'ebor_pricing_table_shortcode' );

/**
 * The VC Functions
 */
function ebor_pricing_table_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_values(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'malefic-vc-block',
			"name" => esc_html__("Pricing Table", 'malefic'),
			"base" => "malefic_pricing_table",
			"category" => esc_html__('malefic WP Theme', 'malefic'),
			'description' => 'Add a pricing table to the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'malefic'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", 'malefic'),
					"param_name" => "subtitle"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Currency", 'malefic'),
					"param_name" => "currency",
					"value" => '$',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Amount", 'malefic'),
					"param_name" => "amount",
					"value" => '3',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Duration", 'malefic'),
					"param_name" => "duration",
					"value" => 'Year',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'malefic'),
					"param_name" => "button_text",
					"value" => 'Select Plan',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button URL", 'malefic'),
					"param_name" => "button_url"
				),
				array(
					"type" => "exploded_textarea",
					"heading" => esc_html__("Pricing details, one per line", 'malefic'),
					"param_name" => "text"
				),
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'malefic'),
					"param_name" => "icon",
					"value" => $icons
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_pricing_table_shortcode_vc' );