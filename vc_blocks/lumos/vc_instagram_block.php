<?php 

/**
 * The Shortcode
 */
function ebor_instagram_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'id' => '',
				'token' => ''
			), $atts 
		) 
	);
	
	$output = false;
	
	if($title)
		$output = '<h3 class="section-title">'. htmlspecialchars_decode($title) .'</h3>';
		
	$output .= '<div class="swiper-wrapper ins"> 
					<a class="arrow-left btn" href="#"></a> 
					<a class="arrow-right btn" href="#"></a>
					<div class="ebor-swiper-container instagram">
						<div id="instafeed" class="swiper"> </div>
					</div>
				</div>
				
				<script type="text/javascript">
				jQuery(document).ready(function(){
					var instagramFeed = new Instafeed({
					    get: \'user\',
					    userId: '. esc_js($id) .',
					    accessToken: \''. esc_js($token) .'\',
					    resolution: \'low_resolution\',
					    template: \'<div class="item"><figure class="frame"><img src="{{image}}" /><a href="{{link}}" class="ins-link" target="_blank"><i class="icon-link"></i></a></figure></div>\',
					    after: function () {
					        jQuery(\'.ebor-swiper-container.instagram\').each(function(){
								  var mySwiper = new Swiper (this, {
								     grabCursor: true,
								    slidesPerView: \'auto\',
								    wrapperClass: \'swiper\',
								    slideClass: \'item\',
								    offsetPxBefore: 0,
								     offsetPxAfter: 0
								  });
								
								  var $swipers = jQuery(this);
								
								  $swipers.siblings(\'.arrow-left\').click(function(){
									mySwiper.slideTo(mySwiper.activeIndex-1);
								return false;
								});
								$swipers.siblings(\'.arrow-right\').click(function(){
									mySwiper.slideTo(mySwiper.activeIndex+1);
								return false;
								});
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
					jQuery(\'#instafeed\').each(function() {
					    instagramFeed.run();
					});
				});
				</script>';
	
	return $output;
}
add_shortcode( 'lumos_instagram_block', 'ebor_instagram_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_instagram_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lumos-vc-block',
			"name" => __("Instagram Feed", 'lumos'),
			"base" => "lumos_instagram_block",
			"category" => __('lumos WP Theme', 'lumos'),
			'description' => 'A swiper of Instagram images.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'lumos'),
					"param_name" => "title"
				),
				array(
					"type" => "textfield",
					"heading" => __("Numeric User ID", 'lumos'),
					"param_name" => "id"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Access Token", 'lumos'),
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