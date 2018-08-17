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
	
	$output = '<section class="instagram preserve-3d">
	
	<div class="instafeed" data-user-name="'. esc_attr($title) .'" data-method="getUserFeed">
				<ul></ul>
			</div>
	
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div>
							<i class="icon social_instagram text-white"></i>
							'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
						</div>
					</div>
				</div><!--end of row-->
			</div>
			
		</section>';
	
	return $output;
}
add_shortcode( 'meetup_instagram', 'ebor_instagram_shortcode' );

/**
 * The VC Functions
 */
function ebor_instagram_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'meetup-vc-block',
			"name" => __("Instagram Feed", 'meetup'),
			"base" => "meetup_instagram",
			"category" => __('Meetup - WP Theme', 'meetup'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Instagram Username", 'meetup'),
					"param_name" => "title",
					"value" => '',
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content Under Feed", 'meetup'),
					"param_name" => "content",
					"value" => '',
					"description" => '',
					'holder' => 'div'
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_instagram_shortcode_vc' );