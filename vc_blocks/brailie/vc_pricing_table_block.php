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
				'duration' => 'year',
				'button_text' => 'Sign Up',
				'button_url' => '',
				'icon' => '',
				'layout' => 'basic',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$lines = explode( ',', $text );
	$title_class = 'pb-0';

	$output = '
		<div class="pricing panel '. $layout .' '. esc_attr( $custom_css_class ) .'">
		  <div class="panel-heading">
	';
	
	if( $icon ){
		$output .= '
			<div class="icon icon-color color-default fs-48">
				<i class="fa '. esc_attr($icon) .'"></i>
			</div>
		';
		$title_class = 'pb-20';
	}
	
	$output .= '			
				<h4 class="panel-title color-dark '. $title_class .'">'. htmlspecialchars_decode($title) .'</h4>
				
				<div class="price color-dark"> 
					<span class="price-currency">'. htmlspecialchars_decode($currency) .'</span> 
					<span class="price-value">'. htmlspecialchars_decode($amount) .'</span> 
					<span class="price-duration">'. htmlspecialchars_decode($duration) .'</span>
				</div>
				
			</div><!--/.panel-heading -->
			
			<div class="panel-body">
				<table class="table">';
			
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
				<a href="'. esc_url($button_url) .'" class="btn btn-full-rounded" role="button">'. htmlspecialchars_decode($button_text) .'</a>
			</div>
		
		</div><!--/.pricing --> 
	';
	
	return $output;
}
add_shortcode( 'brailie_pricing_table', 'ebor_pricing_table_shortcode' );

/**
 * The VC Functions
 */
function ebor_pricing_table_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('brailie_get_icons') ){
		$icons = array_values(brailie_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
			"name" => esc_html__("Pricing Table", 'brailie'),
			"base" => "brailie_pricing_table",
			"category" => esc_html__('brailie WP Theme', 'brailie'),
			'description' => 'Add a pricing table to the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'brailie'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Currency", 'brailie'),
					"param_name" => "currency",
					"value" => '$',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Amount", 'brailie'),
					"param_name" => "amount",
					"value" => '3',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Duration", 'brailie'),
					"param_name" => "duration",
					"value" => 'Year',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'brailie'),
					"param_name" => "button_text",
					"value" => 'Select Plan',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button URL", 'brailie'),
					"param_name" => "button_url"
				),
				array(
					"type" => "exploded_textarea",
					"heading" => esc_html__("Pricing details, one per line", 'brailie'),
					"param_name" => "text"
				),
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'brailie'),
					"param_name" => "icon",
					"value" => $icons
				),
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__("Display type", 'brailie'),
					"param_name" => "layout",
					"value"      => array(
						'Basic' => 'basic',
						'Boxed' => 'box box-border'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'brailie'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_pricing_table_shortcode_vc' );