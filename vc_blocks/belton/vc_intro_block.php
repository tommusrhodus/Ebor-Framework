<?php 

/**
 * The Shortcode
 */
function ebor_intro_shortcode( $atts, $content = null ) {
	global $wp_query, $post;
	
	extract( 
		shortcode_atts( 
			array(
				'image'        		=> '',
				'height'       		=> 'full-height',
				'content_placement' => 'left',
				'content_vertical_placement' => 'child',
				'caption' 			=> '',
				'color' 			=> '#000000',
				'content_color'		=> 'white-text',
				'overlay_opacity'	=> '0.3'
			), $atts 
		) 
	);

	$bg_image = wp_get_attachment_image_src($image, 'full');
	$colour_output = ( $color ) ? 'style="background-color: '. $color .'; opacity: '.$overlay_opacity.'"' : '';

	if($content_placement == 'left') {
		$column_class = 'col-lg-4 col-md-6 col-md-offset-1';
	} elseif($content_placement == 'left-wide') {
		$column_class = 'col-lg-6 col-md-6 col-md-offset-1';
	} elseif($content_placement == 'center') {
		$column_class = 'col-md-6 col-md-offset-3 centered';
	} elseif($content_placement == 'right') {
		$column_class = 'col-lg-3 col-lg-offset-8 col-md-5 col-sm-offset-6 col-sm-6';
	}
	

	$output = '
		<div class="full-width intro">
			<div class="full-height '.esc_attr($height).'">
				<div class="custom-caption">'. wp_kses_post($caption) .'</div>
				<div class="fixed">
					<figure class="background-image parallax parallax-banner" style="background-image: url('.esc_url($bg_image[0]).');"></figure>
				</div>
				<div class="full-height-wrapper '.esc_attr($content_color).'">
					<div class="parent">
						<div class="'.esc_attr($content_vertical_placement).'">
							<div class="container">
								<div class="animatedblock delay2 animatedUp">
									<div class="'.esc_attr($column_class).'">
										<div class="banner-textblock">
											'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="overlay" '.$colour_output.'></div>
				</div>
			</div>
		</div>
	';
	
	return $output;
}
add_shortcode( 'belton_intro', 'ebor_intro_shortcode' );

/**
 * The VC Functions
 */
function ebor_intro_shortcode_vc() {
	vc_map( 
		array(
			"icon"        => 'belton-vc-block',
			"name"        => esc_html__( "Intro", 'belton' ),
			"base"        => "belton_intro",
			"category"    => esc_html__( 'belton WP Theme', 'belton' ),
			'description' => 'A large hero/page intro area.',
			"params"      => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Background Image", 'belton'),
					"param_name" => "image"
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Intro Size", 'belton'),
					"param_name" => "height",
					"value" => array(
						'Fullheight' => 'full-height',
						'Max 600px Tall' => 'not-completely-full',
					)
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Intro Content", 'belton'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Content Placement", 'belton'),
					"param_name" => "content_placement",
					"value" => array(
						'Left' => 'left',
						'Left Wide (50% Width)' => 'left-wide',
						'Center' => 'center',
						'Right' => 'right',
					)
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Content Vertical Placement", 'belton'),
					"param_name" => "content_vertical_placement",
					"value" => array(
						'Middle' => 'child',
						'Bottom' => 'bottom',
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Caption (Appears lower left corner)", 'belton'),
					"param_name" => "caption"
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Image Overlay Colour", 'belton'),
					"param_name" => "color",
					'description' => 'Leave blank for default colour, make selection for custom colour',
					'value' => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Overlay Opactiy (0.0 for no overlay to 1.0 for solid colour)", 'belton'),
					"param_name" => "overlay_opacity"
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Content Colour", 'belton'),
					"param_name" => "content_color",
					"value" => array(
						'White Text' => 'white-text',
						'Dark Text' => 'dark-text',
					)
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_intro_shortcode_vc');