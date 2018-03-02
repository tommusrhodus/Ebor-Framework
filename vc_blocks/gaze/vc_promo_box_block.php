<?php 

/**
 * The Shortcode
 */
function ebor_promo_box_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'            => '',
				'url'              => '',
				'image'            => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="promo-banners '. $custom_css_class .'">
			<div class="promo-banner">
				<a href="'. $url .'">
					
					'. wp_get_attachment_image( $image, 'large' ) .'
					
					<div class="promo-inner valign">
						<h2 class="uppercase">'. $title .'</h2>
					</div>
					
				</a>                        
			</div>
		</div>
	';

	return $output;
}
add_shortcode( 'gaze_promo_box_block', 'ebor_promo_box_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_promo_box_block_shortcode_vc() {
	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Promo Box", 'gaze' ),
			"base"        => "gaze_promo_box_block",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			'description' => 'promo_box timer to a specific day',
			"params"      => array(
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Title", 'gaze' ),
					"param_name" => "title",
					'holder'     => 'div'
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Link URL", 'gaze' ),
					"param_name" => "url"
				),
				array(
					"type"       => "attach_image",
					"heading"    => esc_html__( "Background Image", 'gaze' ),
					"param_name" => "image"
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__("Extra CSS Class Name", 'gaze'),
					"param_name"  => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_promo_box_block_shortcode_vc' );