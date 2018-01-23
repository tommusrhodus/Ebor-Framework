<?php 

/**
 * The Shortcode
 */
function ebor_social_feed_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'layout'       => 'instagram',
				'insta_id'     => '1215763826',
				'insta_access' => '1215763826.f1627ea.512d3a9b334a4c91ac2e83d4f4d9b291',
				'flickr_id'    => '51789731@N07',
				'drib_id'      => 'gustavholtz',
				'drib_access'  => 'f739579ebb235a0e0456abbb6381e7f8a0d92ff198796ae8deed27c64d6debeb'
			), $atts 
		) 
	);
	
	if( 'instagram' == $layout ){
		
		$output = '
			<div class="tiles tiles-s">
				<div id="instafeed" class="items row"></div>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					var instagramFeed2 = new Instafeed({
					    target: \'instafeed\',
					    get: \'user\',
					    limit: 6,
					    userId: '. $insta_id .',
					    accessToken: \''. $insta_access .'\',
					    resolution: \'low_resolution\',
					    template: \'<div class="item col-xs-6 col-sm-4 col-md-2"><figure class="overlay overlay1"><a href="{{link}}" target="_blank"></a><img src="{{image}}" /><figcaption><i class="et-link from-top icon-xs"></i></figcaption></figure></div>\',
					    after: function() {
					        jQuery(\'#instafeed figure.overlay\').prepend(\'<span class="bg"></span>\');
					    }
					});
					jQuery(\'#instafeed\').each(function() {
					    instagramFeed2.run();
					});
				});
			</script>
		';	
		
	} elseif( 'flickr' == $layout ){
		
		$output = '
			<div class="tiles tiles-s">
				<div class="flickr-feed items row"> </div>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery(\'.flickr-feed\').dcFlickr({
					    limit: 6,
					    q: {
					        id: \''. $flickr_id .'\',
					        lang: \'en-us\',
					        format: \'json\',
					        jsoncallback: \'?\'
					    },
						onLoad : function() {
							jQuery(\'.flickr-feed figure.overlay\').prepend(\'<span class="bg"></span>\');
						}
					});
				});
			</script>
		';	
		
	} elseif( 'dribbble' == $layout ){
		
		$output = '
			<div class="tiles tiles-s">
				<div class="dribbble-feed items row"></div>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					if( jQuery(\'.dribbble-feed\').length ){
						
						jQuery.jribbble.setToken(\''. $drib_access .'\');
						
						jQuery.jribbble.users(\''. $drib_id .'\').shots({per_page: 6}).then(function(shots) {
						  var html = [];
						  
						  shots.forEach(function(shot) {
						    html.push(\'<div class="item col-xs-6 col-sm-4 col-md-2"><figure class="overlay overlay1"><a href="\' + shot.html_url + \'" target="_blank"></a>\');
						    html.push(\'<img src="\' + shot.images.normal + \'">\');
						    html.push(\'<figcaption><i class="et-link from-top icon-xs"></i></figcaption></figure></div>\');
						  });
						  
						  jQuery(\'.dribbble-feed\').html(html.join(\'\'));
						  jQuery(\'.dribbble-feed figure.overlay\').prepend(\'<span class="bg"></span>\');
						});
						
					}
				});
			</script>
		';	
		
	}

	return $output;
}
add_shortcode( 'creatink_social_feed_block', 'ebor_social_feed_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_social_feed_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
			"name" => esc_html__("Social Feeds", 'creatink'),
			"base" => "creatink_social_feed_block",
			"category" => esc_html__('creatink WP Theme', 'creatink'),
			'description' => 'social_feed elements for social_feeds.',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Social Feed", 'creatink'),
					"param_name" => "layout",
					'description' => 'Please visit "appearance => social options" to enter the required API Keys for this block to function.',
					"value" => array(
						'Instagram' => 'instagram',
						'Flickr'    => 'flickr',
						'Dribbble'  => 'dribbble'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Instagram Numeric User ID", 'malefic'),
					"param_name" => "insta_id"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Instagram Access Token", 'malefic'),
					"param_name" => "insta_access",
					'description' => 'This is the Instagram block, it will grab your latest Instagram images. For this to work, the block requires you enter a numeric ID in the correct field, and also an access token in the correct field.<br /><br />
					To set up an access token, please follow <a href="https://tommusrhodus.ticksy.com/article/7566" target="_blank">these instructions</a> carefully<br /><br />
					Once you have an access token, visit the following URL (replacing ACCESS-TOKEN with your own numeric token) and the last parameter on the resulting screen will be your numeric user ID: <code>https://api.instagram.com/v1/users/self/?access_token=ACCESS-TOKEN</code>'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Flickr Numeric User ID", 'malefic'),
					"param_name" => "flickr_id",
					'description' => '<code>IMPORTANT NOTE:</code> This is the Flickr block, it will grab your latest Flickr images. For this to work, the block requires you enter a numeric ID in the correct field. Please grab your numeric Flickr ID from here: <a href="http://idgettr.com/" target="_blank">http://idgettr.com/</a>'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Dribbble Numeric User ID", 'malefic'),
					"param_name" => "drib_id"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Dribbble Access Token", 'malefic'),
					"param_name" => "drib_access",
					'description' => 'To fetch your own Dribbble Shots, first register an application <a href="https://dribbble.com/account/applications/new" target="_blank">here</a>. Then add your ID and access token to the fields above.'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_social_feed_block_shortcode_vc' );