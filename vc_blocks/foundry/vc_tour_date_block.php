<?php 

/**
 * The Shortcode
 */
function ebor_tour_date_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'date' => '',
				'button_text' => '',
				'button_url' => ''
			), $atts 
		) 
	);
	
	$output = '
		<ul class="tour-date">
			<li>
				<div class="overflow-hidden mb16">
				
					<div class="col-sm-4">
						<h4 class="uppercase pt8">'. $date .'</h4>
					</div>
					
					<div class="col-sm-4">
						'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
					</div>
				
					<div class="col-sm-4 text-right">
						<a class="btn btn-sm btn-white mt8" href="'. esc_url($button_url) .'" target="_blank">'. $button_text .'</a>
					</div>
					
				</div>
				<hr class="fade-half mb0">
			</li>
		</ul>
	';
	
	return $output;
}
add_shortcode( 'foundry_tour_date', 'ebor_tour_date_shortcode' );

/**
 * The VC Functions
 */
function ebor_tour_date_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Tour Date", 'foundry'),
			"base" => "foundry_tour_date",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Date", 'foundry'),
					"param_name" => "date",
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Block Content", 'foundry'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Text", 'foundry'),
					"param_name" => "button_text"
				),
				array(
					"type" => "textfield",
					"heading" => __("Button URL", 'foundry'),
					"param_name" => "button_url",
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_tour_date_shortcode_vc' );