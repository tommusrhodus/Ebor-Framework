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
	
	ob_start();
?>

	<div class="image-grid col5">
		<div class="items-wrapper">
			<div id="instafeed" class="isotope items" data-limit="5"></div>
		</div>
	</div>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
			var instagramFeed = new Instafeed({
			    get: 'user',
			    limit: 10,
			    userId: <?php echo esc_js($id); ?>,
			    accessToken: '<?php echo esc_js($token); ?>',
			    resolution: 'low_resolution',
			    template: '<div class="item"><figure class="icon-overlay"><a href="{{link}}"><img src="{{image}}" /></a></figure></div>',
			    after: function() {
			        jQuery('#instafeed .item .icon-overlay a').prepend('<span class="icn-more"></span>');
			        var $portfoliogrid = jQuery('.image-grid .isotope');
			        $portfoliogrid.isotope({
			            itemSelector: '.item',
			            transitionDuration: '0.7s',
			            masonry: {
			                columnWidth: $portfoliogrid.width() / 12
			            },
			            layoutMode: 'masonry'
			        });
			        jQuery(window).resize(function() {
			            $portfoliogrid.isotope({
			                masonry: {
			                    columnWidth: $portfoliogrid.width() / 12
			                }
			            });
			        });
			        $portfoliogrid.imagesLoaded(function() {
			            $portfoliogrid.isotope('layout');
			        });
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
			jQuery('#instafeed').each(function() {
			    instagramFeed.run();
			});
		});
	</script>
	
<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'lydia_instagram_block', 'ebor_instagram_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_instagram_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lydia-vc-block',
			"name" => esc_html__("Instagram Feed", 'lydia'),
			"base" => "lydia_instagram_block",
			"category" => esc_html__('Lydia WP Theme', 'lydia'),
			'description' => 'A swiper of Instagram images.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Numeric User ID", 'lydia'),
					"param_name" => "id"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Access Token", 'lydia'),
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