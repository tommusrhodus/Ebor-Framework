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
				'subtitle'         => '',
				'button_text'      => 'Buy Now',
				'button_url'       => '',
			), $atts 
		) 
	);

	$lines       = explode( ',', $text );
	$final_lines = '<tr><td><i class="fa fa-check-square-o"></i></td><td>'. implode( '</td></tr><tr><td><i class="fa fa-check-square-o"></i></td><td>', $lines ) . '</td></tr>';
	
	$output = '
		<table class="table">
			<thead>
				<tr class="bolder-border">
					<th colspan="2"><h5>'. htmlspecialchars_decode($title) .'</h5>
					<span class="price">'. htmlspecialchars_decode($currency) .''. htmlspecialchars_decode($amount) .'</span>
					<p class="details">'. htmlspecialchars_decode($subtitle) .'</p></th>
				</tr>
			</thead>

			<tbody>
				'. $final_lines .'
			
			<tr>
			<td colspan="2"><a href="'. esc_url($button_url) .'" title="" class="button"><i class="fa fa-shopping-cart"></i> '. htmlspecialchars_decode($button_text) .'</a></td>
			</tr>
			</tbody>
		</table>
	';
	
	return $output;
}
add_shortcode( 'belton_pricing_table', 'ebor_pricing_table_shortcode' );

/**
 * The VC Functions
 */
function ebor_pricing_table_shortcode_vc() {
	
	vc_map( 
		array(
			"icon"        => 'belton-vc-block',
			"name"        => esc_html__( "Pricing Table", 'belton' ),
			"base"        => "belton_pricing_table",
			"category"    => esc_html__( 'Belton WP Theme', 'belton' ),
			'description' => 'Add a pricing table to the page.',
			"params"      => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'belton'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Currency", 'belton'),
					"param_name" => "currency",
					"value" => '$',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Amount", 'belton'),
					"param_name" => "amount",
					"value" => '3',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle (displays beside price)", 'belton'),
					"param_name" => "subtitle",
					"value" => 'Year',
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__("Button Text", 'belton'),
					"param_name" => "button_text",
					"value"      => 'Buy Npw',
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__("Button URL", 'belton'),
					"param_name" => "button_url"
				),
				array(
					"type"       => "exploded_textarea",
					"heading"    => esc_html__("Pricing details, one per line", 'belton'),
					"param_name" => "text"
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_pricing_table_shortcode_vc' );