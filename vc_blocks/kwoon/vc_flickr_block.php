<?php 

/**
 * The Shortcode
 */
function ebor_flickr_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'id' => '',
				'token' => ''
			), $atts 
		) 
	);

	$output = '
		<div class="flickr-feed owl-flickr"> </div>	
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery(".flickr-feed").dcFlickr({
				    limit: 15,
				    q: {
				        id: "'. esc_js($id) .'",
				        lang: "en-us",
				        format: "json",
				        jsoncallback: "?"
				    },
				    onLoad: function() {
				        jQuery(".owl-flickr").owlCarousel({
				            loop: false,
				            margin: 10,
				            nav: true,
				            navText: ["", ""],
				            dots: false,
				            items: 7,
				            responsive: {
				                0: {
				                    items: 3
				                },
				                700: {
				                    items: 5
				                },
				                1000: {
				                    items: 7
				                }
				            }
				        })
				    }
				});
			});
		</script>
	';
	
	return $output;
}
add_shortcode( 'kwoon_flickr_block', 'ebor_flickr_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_flickr_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("Flickr Feed", 'kwoon'),
			"base" => "kwoon_flickr_block",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			'description' => 'A swiper of flickr images.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Numeric User ID", 'kwoon'),
					"param_name" => "id",
					'description' => '<code>IMPORTANT NOTE:</code> This is the Flickr block, it will grab your latest Flickr images. For this to work, the block requires you enter a numeric ID in the correct field. Please grab your numeric Flickr ID from here: <a href="http://idgettr.com/" target="_blank">http://idgettr.com/</a>'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_flickr_block_shortcode_vc' );