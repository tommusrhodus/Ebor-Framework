<?php 

/**
 * The Shortcode
 */
function ebor_stats_simple_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);

	$output = '
		<div class="boxed boxed--border text-center stat-simple">
			<span class="h1">
				'. $title .'
			</span>
			'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
		</div>
	';

	return $output;
}
add_shortcode( 'partner_stats_simple_block', 'ebor_stats_simple_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_stats_simple_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
			"name" => esc_html__("Stats Simple", 'partner'),
			"base" => "partner_stats_simple_block",
			"category" => esc_html__('partner WP Theme', 'partner'),
			'description' => 'Show your stats in a small bordered box',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'partner'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Content", 'partner'),
					"param_name" => "content",
					'holder' => 'div'
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_stats_simple_block_shortcode_vc' );