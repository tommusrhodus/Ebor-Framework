<?php 

/**
 * The Shortcode
 */
function ebor_media_player_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'              => '',
				'media_player_image' => '',
				'custom_css_class'   => '',
				'layout'             => 'html5',
				'mp4'                => '',
				'webm'               => ''
			), $atts 
		) 
	);
	
	$src[0] = '';
	
	if( 'html5' == $layout ){
		
		$src = wp_get_attachment_image_src($media_player_image, 'full');
		
		$output = '
			<div class="wpb_content_element">
				<video class="js-player" poster="'. $src[0] .'" controls>
					<source src="'. $mp4 .'" type="video/mp4">
					<source src="'. $webm .'" type="video/webm">
				</video>
			</div>
		';
	
	} elseif( 'audio' == $layout ){
	
		$output = '
			<audio class="wpb_content_element js-player" controls>
				<source src="'. $mp4 .'" type="audio/mp3">
			</audio>
		';
	
	}

	return $output;
}
add_shortcode( 'brailie_media_player_block', 'ebor_media_player_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_media_player_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
			"name" => esc_html__("Media Player", 'brailie'),
			"base" => "brailie_media_player_block",
			"category" => esc_html__('brailie WP Theme', 'brailie'),
			'description' => 'media_player elements for media_players.',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display type", 'brailie'),
					"param_name" => "layout",
					"value" => array(
						'Local Video' => 'html5',
						'Local Audio' => 'audio'
					)
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Poster Image", 'brailie'),
					"param_name" => "media_player_image"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__(".mp4 Video File URL / .mp3 Audio File URL", 'brailie'),
					"param_name" => "mp4"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__(".webm Video File URL", 'brailie'),
					"param_name" => "webm"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'brailie'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_media_player_block_shortcode_vc' );