<?php 

/**
 * The Shortcode
 */
function ebor_social_feed_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'layout' => 'instagram'
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
					    userId: 1215763826,
					    accessToken: \'1215763826.f1627ea.512d3a9b334a4c91ac2e83d4f4d9b291\',
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
					        id: \'51789731@N07\',
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
						
						jQuery.jribbble.setToken(\'f739579ebb235a0e0456abbb6381e7f8a0d92ff198796ae8deed27c64d6debeb\');
						
						jQuery.jribbble.users(\'gustavholtz\').shots({per_page: 6}).then(function(shots) {
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
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_social_feed_block_shortcode_vc' );