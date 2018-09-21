<?php 

/**
 * The Shortcode
 */
function ebor_flickr_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'id' => ''
			), $atts 
		) 
	);
	
	ob_start();
?>

	<div class="image-grid col5">
		<div class="items-wrapper">
			  <div class="flickr-feed"> </div>
		</div>
	</div>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('.flickr-feed').dcFlickr({
			    limit: 10,
			    q: {
			        id: '<?php echo esc_js($id); ?>',
			        lang: 'en-us',
			        format: 'json',
			        jsoncallback: '?'
			    },
			    onLoad: function() {
			        jQuery('.flickr-feed .item .icon-overlay a').prepend('<span class="icn-more"></span>');
			    }
			});
		});
	</script>
	
<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'lydia_flickr_block', 'ebor_flickr_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_flickr_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lydia-vc-block',
			"name" => esc_html__("Flickr Feed", 'lydia'),
			"base" => "lydia_flickr_block",
			"category" => esc_html__('Lydia WP Theme', 'lydia'),
			'description' => 'A swiper of flickr images.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Numeric User ID", 'lydia'),
					"param_name" => "id",
					'description' => 'This is the flickr block, it will grab your latest flickr images. For this to work, the block requires you enter a numeric ID in the correct field, and also an access token in the correct field. Please grab your numeric flickr ID & Access Token from here: <a href="https://flickr.com/oauth/authorize/?client_id=467ede5a6b9b48ae8e03f4e2582aeeb3&redirect_uri=http://instafeedjs.com&response_type=token" target="_blank">Get User ID & Token</a>'
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_flickr_block_shortcode_vc' );