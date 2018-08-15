<?php 

/**
 * The Shortcode
 */
function ebor_instagram_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'method' => 'getUserFeed'
			), $atts 
		) 
	);
	
	$output = '<div class="instagram-feed">
		<div class="container">
			<div class="row text-center">
				<div><span class="alt-font">Insta <i class="icon social_instagram"></i> Gram</span></div>
			</div><!--end of row-->
		</div><!--end of container-->
		
		<div class="instafeed" data-user-name="'. $title .'" data-method="getUserFeed">
			<ul></ul>
		</div>
	</div>';
	
	return $output;
}
add_shortcode( 'pivot_instagram', 'ebor_instagram_shortcode' );

/**
 * The VC Functions
 */
function ebor_instagram_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
			"name" => __("Pivot - Instagram", 'pivot'),
			"base" => "pivot_instagram",
			"category" => __('Pivot - Social', 'pivot'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Instagram Username", 'pivot'),
					"param_name" => "title",
					"value" => '',
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_instagram_shortcode_vc' );