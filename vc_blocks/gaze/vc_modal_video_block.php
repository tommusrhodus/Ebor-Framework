<?php 

/**
 * The Shortcode
 */
function ebor_modal_video_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'            => 'https://www.youtube.com/watch?v=nVzVohG304A?autoplay=1',
				'image'            => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="'. $custom_css_class.' video-box animated-bottom">
			'. wp_get_attachment_image( $image, 'large' ) .'
			<a href="'. esc_url( $title ) .'" class="play-btn single-video-lightbox">
				<svg class="svg-circle"><circle cx="41" cy="41" r="40" stroke-width="2"></circle><circle cx="41" cy="41" r="34"></circle></svg>
			</a>
		</div>
	';
	
	return $output;
}
add_shortcode( 'gaze_modal_video_block', 'ebor_modal_video_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_modal_video_block_shortcode_vc() {
	
	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Modal Video", 'gaze' ),
			"base"        => "gaze_modal_video_block",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			'description' => 'modal elements for modals.',
			"params"      => array(
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Video URL", 'gaze' ),
					"param_name" => "title",
					'holder'     => 'div',
					'value'      => 'https://www.youtube.com/watch?v=nVzVohG304A?autoplay=1'
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
add_action( 'vc_before_init', 'ebor_modal_video_block_shortcode_vc' );