<?php 

/**
 * The Shortcode
 */
function ebor_instagram_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);
	
	$output = '<div class="social social-3">
			<div class="row v-align-children">
				<div class="col-sm-6">
					<div class="instafeed" data-user-name="'. esc_attr(strtolower($title)) .'">
						<ul></ul>
					</div>
				</div>
				
				<div class="col-sm-6 text-center">
					<div class="insta-title">
						<h6>Insta</h6>
						<i class="icon icon-instagram"></i>
						<h6>Gram</h6>
					</div>
					'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				</div>
			</div>
		</div>';
	
	return $output;
}
add_shortcode( 'launchkit_instagram', 'ebor_instagram_shortcode' );

/**
 * The VC Functions
 */
function ebor_instagram_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
			"name" => __("Instagram Feed", 'launchkit'),
			"base" => "launchkit_instagram",
			"category" => __('LaunchKit WP Theme', 'launchkit'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Instagram Username", 'launchkit'),
					"param_name" => "title",
					"value" => '',
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content Under Feed", 'launchkit'),
					"param_name" => "content",
					"value" => '',
					"description" => '',
					'holder' => 'div'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_instagram_shortcode_vc' );