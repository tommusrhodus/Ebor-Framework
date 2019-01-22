<?php 

/**
 * The Shortcode
 */
function ebor_instagram_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'method' => 'getUserFeed'
			), $atts 
		) 
	);
	
	$output = '
		<section class="gallery gallery-2 overlay">
			<div class="instafeed" data-user-name="'. esc_attr($title) .'" data-method="getUserFeed">
				<ul></ul>
			</div>
		
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
					</div>
				</div>
			</div>
		</section>
	';
	
	return $output;
}
add_shortcode( 'union_instagram', 'ebor_instagram_shortcode' );

/**
 * The VC Functions
 */
function ebor_instagram_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'union-vc-block',
			"name" => __("Instagram Feed", 'union'),
			"base" => "union_instagram",
			"category" => __('Union WP Theme', 'union'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Instagram Username", 'union'),
					"param_name" => "title"
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content Under Feed", 'union'),
					"param_name" => "content",
					'holder' => 'div'
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_instagram_shortcode_vc' );