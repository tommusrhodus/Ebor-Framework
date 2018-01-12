<?php 

/**
 * The Shortcode
 */
function ebor_instagram_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'id' => '',
				'token' => '',
				'button_text' => 'Follow me @ Instagram',
				'button_url' => ''
			), $atts 
		) 
	);
	
	ob_start();
?>
	
	<div class="tiles tiles-s instagram">
	  <div id="instafeed" class="items row row-offset-0"></div>
	</div>
	
	<script type="text/javascript">
		jQuery(document).ready(function($){
			
			/*-----------------------------------------------------------------------------------*/
			/*	INSTAGRAM
			/*-----------------------------------------------------------------------------------*/
			var instagramFeed = new Instafeed({
			    target: 'instafeed',
			    get: 'user',
			    limit: 12,
			    userId: <?php echo esc_js($id); ?>,
			    accessToken: '<?php echo esc_js($token); ?>',
			    resolution: 'low_resolution',
			    template: '<div class="item col-xs-6 col-sm-3 col-md-2"><figure class="overlay icon-overlay instagram"><a href="{{link}}" target="_blank"><img src="{{image}}" /></a></figure></div>',
			    after: function() {
			        $('#instafeed figure.overlay a').prepend('<span class="over"><span></span></span>');
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
			});
			$('#instafeed').each(function() {
			    instagramFeed.run();
			});

		});
	</script>
	
<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'malefic_instagram_block', 'ebor_instagram_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_instagram_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'malefic-vc-block',
			"name" => esc_html__("Instagram Feed", 'malefic'),
			"base" => "malefic_instagram_block",
			"category" => esc_html__('malefic WP Theme', 'malefic'),
			'description' => 'A swiper of Instagram images.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Numeric User ID", 'malefic'),
					"param_name" => "id"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Access Token", 'malefic'),
					"param_name" => "token",
					'description' => 'This is the Instagram block, it will grab your latest Instagram images. For this to work, the block requires you enter a numeric ID in the correct field, and also an access token in the correct field.<br /><br />
					To set up an access token, please follow <a href="https://tommusrhodus.ticksy.com/article/7566" target="_blank">these instructions</a> carefully<br /><br />
					Once you have an access token, visit the following URL (replacing ACCESS-TOKEN with your own numeric token) and the last parameter on the resulting screen will be your numeric user ID: <code>https://api.instagram.com/v1/users/self/?access_token=ACCESS-TOKEN</code>'
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_instagram_block_shortcode_vc' );