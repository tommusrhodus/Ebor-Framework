<?php 

/**
 * The Shortcode
 */
function ebor_instagram_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'token' => '',
				'count' => '10',
				'banner_label' => 'Follow me @ Instagram',
				'layout' => 'standard',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$output    = '';
	$cache_key = 'tommus-instagram-' . md5( $token . $count );
	$result    = get_transient( $cache_key );
	
	if( false === $result ){
	
		$request = wp_remote_get( 'https://api.instagram.com/v1/users/self/media/recent/?access_token='. $token .'&count=' . $count );
		
		if( is_wp_error( $request ) ){
		
			$ttl    = 300; //300 = 5 mins
			$result = $request;
			
		} else {
			
			$body   = $request['body'];
			$result = json_decode( $body );
			$ttl    = 3600; //3600 = 1 hour
			
		}
		
		set_transient( $cache_key, $result, $ttl );
		
	}
	
	if(!( false === $result )){
		
		if( 'standard' == $layout ){
		
			$output .= '<div class="tiles tiles-s '. esc_attr( $custom_css_class ).'"><div id="instafeed" class="items row">';
			
			foreach( $result->data as $image ) {
				$output .= '
					<div class="item col-1-5">
						<figure class="overlay overlay3">
							<a href="'. $image->link .'" target="_blank">
							
								<span class="bg"></span>
								
								<img src="'. $image->images->low_resolution->url.'" alt="'. $image->caption->text .'" />
								
								<figcaption class="d-flex">
									<div class="align-self-center mx-auto">
										<i class="fa fa-instagram"></i>
									</div>
								</figcaption>
								
							</a>
						</figure>
					</div>
				';
			}
					
			$output .= '</div></div>';
		
		} elseif( 'row' == $layout ){
		
			$output .= '<div class="tiles tiles-s '. esc_attr( $custom_css_class ).'"><div id="instafeed2" class="items row">';
			
			foreach( $result->data as $image ) {
				$output .= '
					<div class="item col-6 col-sm-4 col-md-2">
						<figure class="overlay overlay3">
							<a href="'. $image->link .'" target="_blank">
							
								<span class="bg"></span>
								
								<img src="'. $image->images->low_resolution->url.'" alt="'. $image->caption->text .'" />
								
								<figcaption class="d-flex">
									<div class="align-self-center mx-auto">
										<i class="fa fa-instagram"></i>
									</div>
								</figcaption>
								
							</a>
						</figure>
					</div>
				';
			}
					
			$output .= '</div></div>';
		
		} elseif( 'carousel' == $layout ){
		
			$output .= '<div class="swiper-container-wrapper '. esc_attr( $custom_css_class ).'"><div class="swiper-container swiper-instagram"><div id="instafeed3" class="swiper-wrapper">';
			
			foreach( $result->data as $image ) {
				$output .= '
					<div class="swiper-slide">
						<figure class="overlay overlay3">
							<a href="'. $image->link .'" target="_blank">
								
								<span class="bg"></span>
								
								<img src="'. $image->images->low_resolution->url.'" alt="'. $image->caption->text .'" />
								
								<figcaption class="d-flex">
									<div class="align-self-center mx-auto">
										<i class="fa fa-instagram"></i>
									</div>
								</figcaption>
								
							</a>
						</figure>
					</div>
				';
			}
					
			$output .= '</div></div><div class="swiper-pagination gap-large swiper-instagram-pagination"></div></div>';
		
		} elseif( 'widget' == $layout ){
		
			$output .= '<div class="tiles tiles-s '. esc_attr( $custom_css_class ).'"><div id="instafeed2" class="items row">';
			
			foreach( $result->data as $image ) {
				$output .= '
					<div class="item col-6 col-sm-4">
						<figure class="overlay overlay3">
							<a href="'. $image->link .'" target="_blank">
							
								<span class="bg"></span>
								
								<img src="'. $image->images->low_resolution->url.'" alt="'. $image->caption->text .'" />
								
								<figcaption class="d-flex">
									<div class="align-self-center mx-auto">
										<i class="fa fa-instagram"></i>
									</div>
								</figcaption>
								
							</a>
						</figure>
					</div>
				';
			}
					
			$output .= '</div></div>';
		
		} elseif( 'carousel-banner' == $layout ){

			$output .= '<div class="instagram-wrapper '. esc_attr( $custom_css_class ).'"><div class="swiper-container-wrapper"><div class="swiper-container swiper-instagram2"><div id="instafeed4" class="swiper-wrapper">';
			
			foreach( $result->data as $image ) {
				$output .= '
					<div class="swiper-slide">
						<figure class="overlay overlay3">
							<a href="'. $image->link .'" target="_blank">
								
								<span class="bg"></span>
								
								<img src="'. $image->images->low_resolution->url.'" alt="'. $image->caption->text .'" />
								
								<figcaption class="d-flex">
									<div class="align-self-center mx-auto">
										<i class="fa fa-instagram"></i>
									</div>
								</figcaption>
								
							</a>
						</figure>
					</div>
				';
			}
					
			$output .= '</div></div><a href="https://www.instagram.com/'. $result->data[0]->user->username .'/" target="_blank" class="btn btn-full btn-instagram-banner">'. $banner_label .'</a></div></div>';
		
		}
		
	}
	
	return $output;
}
add_shortcode( 'brailie_instagram_block', 'ebor_instagram_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_instagram_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
			"name" => esc_html__("Instagram Feed", 'brailie'),
			"base" => "brailie_instagram_block",
			"category" => esc_html__('brailie WP Theme', 'brailie'),
			'description' => 'A swiper of Instagram images.',
			"params" => array(
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__("Display type", 'brailie'),
					"param_name" => "layout",
					"value"      => array(
						'Standard (5 Items to Row)' => 'standard',
						'Row (6 Items to Row)'      => 'row',
						'Carousel'                  => 'carousel',
						'Widget (3 Items to Row)'   => 'widget',
						'Carousel with Bottom Banner' => 'carousel-banner'    
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Access Token", 'brailie'),
					"param_name" => "token",
					'description' => 'This is the Instagram block, it will grab your latest Instagram images. For this to work, the block requires you enter a numeric ID in the correct field, and also an access token in the correct field.<br /><br />
					To set up an access token, please follow <a href="https://tommusrhodus.ticksy.com/article/7566" target="_blank">these instructions</a> carefully<br /><br />
					Once you have an access token, visit the following URL (replacing ACCESS-TOKEN with your own numeric token) and the last parameter on the resulting screen will be your numeric user ID: <code>https://api.instagram.com/v1/users/self/?access_token=ACCESS-TOKEN</code>'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Image Count", 'brailie'),
					"param_name" => "count",
					'value' => '10'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Banner Label", 'brailie'),
					"param_name" => "banner_label",
					'value' => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_instagram_block_shortcode_vc' );