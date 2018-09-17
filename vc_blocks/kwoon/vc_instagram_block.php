<?php 

/**
 * The Shortcode
 */
function ebor_instagram_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'id' => '',
				'token' => ''
			), $atts 
		) 
	);

	$output = '
		<div id="instafeed"></div>	
		<script type="text/javascript">
			jQuery(document).ready(function(){
				var instagramFeed = new Instafeed({
				    get: \'user\',
				    userId: '. esc_js($id) .',
				    accessToken: \''. esc_js($token) .'\',
				    resolution: \'low_resolution\',
				    template: \'<div class="item"><figure class="frame"><img src="{{image}}" /><a href="{{link}}" class="link-out" target="_blank"><i class="icon-link"></i></a></figure></div>\',
				    after: function () {
				       jQuery(\'#instafeed\').owlCarousel({
				           loop: false,
				           margin: 10,
				           nav: true,
				           navText: ["", ""],
				           dots: false,
				           responsive: {
				               0: {
				                   items: 2
				               },
				               768: {
				                   items: 4
				               },
				               1000: {
				                   items: 5
				               }
				           },
				           success: function(response){
				           	response.data.forEach(function(e){
				           		e.images.thumbnail = {
				           			url: e.images.thumbnail.url,
				           			width: 600,
				           			height: 600
				           		};
				           	});
				           }
				       })					    }
				});
				jQuery(\'#instafeed\').each(function() {
				    instagramFeed.run();
				});
			});
		</script>
	';
	
	return $output;
}
add_shortcode( 'kwoon_instagram_block', 'ebor_instagram_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_instagram_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("Instagram Feed", 'kwoon'),
			"base" => "kwoon_instagram_block",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			'description' => 'A swiper of Instagram images.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Numeric User ID", 'kwoon'),
					"param_name" => "id"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Access Token", 'kwoon'),
					"param_name" => "token",
					'description' => 'This is the Instagram block, it will grab your latest Instagram images. For this to work, the block requires you enter a numeric ID in the correct field, and also an access token in the correct field.<br /><br />
					To set up an access token, please follow <a href="https://tommusrhodus.ticksy.com/article/7566" target="_blank">these instructions</a> carefully<br /><br />
					Once you have an access token, visit the following URL (replacing ACCESS-TOKEN with your own numeric token) and the last parameter on the resulting screen will be your numeric user ID: <code>https://api.instagram.com/v1/users/self/?access_token=ACCESS-TOKEN</code>'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_instagram_block_shortcode_vc' );