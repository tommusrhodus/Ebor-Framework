<?php 

/**
 * The Shortcode
 */
function ebor_image_lightbox_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'            => '',
				'description'      => '',
				'link'             => '',
				'embed'            => '',
				'image'            => '',
				'lightbox'         => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$url   = ( $lightbox ) ? wp_get_attachment_image_src( $lightbox, 'full' ) : wp_get_attachment_image_src( $image, 'full' );
	$class = ( $embed ) ? 'single-video-lightbox' : 'lightbox-img';
	
	if( $embed ){
		$url[0] = $embed;
	}
	
	$output = '
		<div class="'. $custom_css_class .' work-item hover-1 hover-trigger">
			<div class="work-container">
				<div class="work-img">
				
					'. wp_get_attachment_image( $image, 'large' ) .'
					
					<div class="hover-overlay" data-overlay="5">
					
						<div class="project-icons">
						
							<a href="'. esc_url( $url[0] ) .'" class="'. esc_attr( $class ) .'">
								<i class="ui-search"></i>
							</a>
	';
	
	if( $link ){
		$output .= '
							<a href="'. esc_url( $link ) .'">
								<i class="ui-link"></i>
							</a>
		';
	}
	
	$output .= '
						</div>
						
						<div class="work-description">
							<h3>'. $title .'</h3>
							<span>'. $description .'</span>
						</div>
						
					</div> 
					            
				</div>
			</div> 
		</div>
	';

	return $output;
}
add_shortcode( 'gaze_image_lightbox_block', 'ebor_image_lightbox_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_image_lightbox_block_shortcode_vc() {

	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Image Lightbox", 'gaze' ),
			"base"        => "gaze_image_lightbox_block",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			'description' => 'An image with link & lighbox options.',
			"params"      => array(
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Title", 'gaze' ),
					"param_name" => "title",
					'holder'     => 'div'
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Description", 'gaze' ),
					"param_name" => "description",
					'holder'     => 'div'
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Link", 'gaze' ),
					"param_name" => "link"
				),
				array(
					"type"       => "attach_image",
					"heading"    => esc_html__( "Initial Image", 'gaze' ),
					"param_name" => "image"
				),
				array(
					"type"        => "attach_image",
					"heading"     => esc_html__( "Image in Lightbox (optionak)", 'gaze' ),
					'description' => 'If this option is left blank, the lightbox will use the image set above.',
					"param_name"  => "lightbox"
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Video Embed", 'gaze' ),
					'description' => 'If this option is filled the lightbox will display a video from YouTube/Vimeo instead of an image.',
					"param_name"  => "embed"
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
add_action( 'vc_before_init', 'ebor_image_lightbox_block_shortcode_vc' );