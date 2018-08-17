<?php 

/**
 * The Shortcode
 */
function ebor_pricing_card_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'text' => '',
				'currency' => '$',
				'amount' => '3',
				'button_url' => '',
				'detail' => '',
				'feature' => 'no'
			), $atts 
		) 
	);
	
	$lines = explode( ',', $text );
	
	ob_start();
?>

	<a href="<?php echo esc_url($button_url); ?>">
		<div class="pricing-option <?php echo esc_attr($feature); ?>">
	
			<div class="dot"></div>
	
			<div class="col-md-6 text-center">
				<span class="dollar"><?php echo htmlspecialchars_decode($currency); ?></span>
				<span class="price"><?php echo htmlspecialchars_decode($amount); ?></span>
				<span class="type"><?php echo htmlspecialchars_decode($detail); ?></span>
			</div>
	
			<div class="col-md-6">
				<span class="plan-title"><?php echo htmlspecialchars_decode($title); ?></span>
				<ul>
					<?php 
						foreach( $lines as $line ){
							echo '<li>' . htmlspecialchars_decode($line) . '</li>';
						}
					?>
				</ul>
			</div>
		</div>
	</a>
			
<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_shortcode( 'meetup_pricing_card', 'ebor_pricing_card_shortcode' );

/**
 * The VC Functions
 */
function ebor_pricing_card_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'meetup-vc-block',
			"name" => __("Pricing Card", 'meetup'),
			"base" => "meetup_pricing_card",
			"category" => __('Meetup - WP Theme', 'meetup'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __("Feature this pricing table?", 'meetup'),
					"param_name" => "feature",
					"value" => array(
						'No' => 'no',
						'Yes' => 'emphasis'
					),
				),
				array(
					"type" => "textfield",
					"heading" => __("Card URL", 'meetup'),
					"param_name" => "button_url",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Currency", 'meetup'),
					"param_name" => "currency",
					"value" => '$',
				),
				array(
					"type" => "textfield",
					"heading" => __("Amount", 'meetup'),
					"param_name" => "amount",
					"value" => '3',
				),
				array(
					"type" => "textfield",
					"heading" => __("Pricing Detail", 'meetup'),
					"param_name" => "detail",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", 'meetup'),
					"param_name" => "title",
					"value" => '',
				),
				array(
					"type" => "exploded_textarea",
					"heading" => __("Pricing details, one per line", 'meetup'),
					"param_name" => "text",
					"value" => '',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_pricing_card_shortcode_vc' );