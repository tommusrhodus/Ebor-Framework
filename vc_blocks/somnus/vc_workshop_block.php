<?php 

/**
 * The Shortcode
 */
function somnus_workshop_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'subtitle' => '',
				'button_text' => '',
				'button_url' => ''
			), $atts 
		) 
	);
	
	$output = '
		<ul class="mb0 workshop">
			<li class="overflow-hidden text-center-sm">
				<div class="col-md-2 col-md-offset-1 mb24">
					<span class="title mb16">'. $title .'</span>
					<span>'. $subtitle .'</span>
				</div>
	
				<div class="col-md-6 mb24">
					'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				</div>
	
				<div class="col-md-3">
					<a class="btn" href="'. esc_url($button_url) .'">'. $button_text .'</a>
				</div>
			</li>
		</ul>
	';
	
	return $output;
}
add_shortcode( 'somnus_workshop', 'somnus_workshop_shortcode' );

/**
 * The VC Functions
 */
function somnus_workshop_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'somnus-vc-block',
			"name" => esc_html__("Workshop", 'somnus'),
			"base" => "somnus_workshop",
			"category" => esc_html__('Somnus WP Theme', 'somnus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'somnus'),
					"param_name" => "title"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", 'somnus'),
					"param_name" => "subtitle"
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'somnus'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'somnus'),
					"param_name" => "button_text",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button URL", 'somnus'),
					"param_name" => "button_url"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'somnus_workshop_shortcode_vc' );