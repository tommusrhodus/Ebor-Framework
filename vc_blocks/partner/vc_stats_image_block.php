<?php 

/**
 * The Shortcode
 */
function ebor_stats_image_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'class' => '',
				'title' => ''
			), $atts 
		) 
	);

	$output = '
		<div class="boxed imagebg text-center stat-simple '. esc_attr($class) .'" data-overlay="7">
			<div class="background-image-holder">
				'. wp_get_attachment_image( $image, 'large' ) .'
			</div>
			<span class="h1 color--white">
				'. $title .'
			</span>
			'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
		</div>
	';

	return $output;
}
add_shortcode( 'partner_stats_image_block', 'ebor_stats_image_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_stats_image_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
			"name" => esc_html__("Stats Image", 'partner'),
			"base" => "partner_stats_image_block",
			"category" => esc_html__('partner WP Theme', 'partner'),
			'description' => 'Show your stats over an image.',
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Background Image", 'partner'),
					"param_name" => "image"
				),
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
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Additional Class", 'partner'),
					"param_name" => "class",
					'description' => 'Add an additional class if you need, hint, enter <code>bg--primary</code> for an alternate view.'
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_stats_image_block_shortcode_vc' );