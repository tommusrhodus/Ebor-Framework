<?php 

/**
 * The Shortcode
 */
function ebor_lightbox_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'            => '',
				'image'            => '',
				'lightbox_image'   => '',
				'custom_css_class' => '',
				'layout'           => 'basic',
				'video'            => ''
			), $atts 
		) 
	);
	
	$src[0] = '';
	
	if( 'basic' == $layout ){
		
		$src = wp_get_attachment_image_src($lightbox_image, 'full');
		
		$output = '
			<div class="'. $custom_css_class .' light-gallery">
				<figure class="overlay overlay1">
					<a href="'. $src[0] .'" class="lightbox-this"></a> 
					'. wp_get_attachment_image($image, 'large') .'
					<figcaption>
						<h5 class="from-top mb-0">'. $title .'</h5>
					</figcaption>
				</figure>
			</div>
		';
	
	} elseif( 'vimeo' == $layout ){
		
		$output = '
			<div class="'. $custom_css_class .' light-gallery">
				<figure class="overlay overlay1">
					<a href="'. $video .'" class="lightbox-this"></a> 
					'. wp_get_attachment_image($image, 'large') .'
					<figcaption>
						<h5 class="from-top mb-0">'. $title .'</h5>
					</figcaption>
				</figure>
			</div>
		';
	
	} elseif( 'youtube' == $layout ){
		
		$output = '
			<div class="'. $custom_css_class .' light-gallery">
				<figure class="overlay overlay1">
					<a href="'. $video .'" class="lightbox-this"></a> 
					'. wp_get_attachment_image($image, 'large') .'
					<figcaption>
						<h5 class="from-top mb-0">'. $title .'</h5>
					</figcaption>
				</figure>
			</div>
		';
	
	} elseif( 'map' == $layout ){
		
		$output = '
			<div class="'. $custom_css_class .' light-gallery">
				<figure class="overlay overlay1">
					<a href="" class="lightbox-this" data-iframe="true" id="google-map" data-src="'. $video .'"></a>
					'. wp_get_attachment_image($image, 'large') .'
					<figcaption>
						<h5 class="from-top mb-0">'. $title .'</h5>
					</figcaption>
				</figure>
			</div>
		';
	
	} elseif( 'caption' == $layout ){
		
		$src  = wp_get_attachment_image_src($lightbox_image, 'full');
		$rand = wp_rand(0, 10000);
		
		$output = '
			<div class="'. $custom_css_class .' light-gallery">
				<figure class="overlay overlay1">
					<a href="'. $src[0] .'" data-sub-html="#caption'. $rand .'" class="lightbox-this"></a> 
					'. wp_get_attachment_image($image, 'large') .'
					<figcaption>
						<h5 class="from-top mb-0">'. $title .'</h5>
					</figcaption>
				</figure>
				<div id="caption'. $rand .'" class="hidden">'. $content .'</div>
			</div>
		';
	
	}

	return $output;
}
add_shortcode( 'creatink_lightbox_block', 'ebor_lightbox_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_lightbox_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
			"name" => esc_html__("Lightbox", 'creatink'),
			"base" => "creatink_lightbox_block",
			"category" => esc_html__('creatink WP Theme', 'creatink'),
			'description' => 'lightbox elements for lightboxs.',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display type", 'creatink'),
					"param_name" => "layout",
					"value" => array(
						'Image' => 'basic',
						'Vimeo Video' => 'vimeo',
						'YouTube Video' => 'youtube',
						'Google Map' => 'map',
						'Image & Caption' => 'caption'
					)
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Initial Image", 'creatink'),
					"param_name" => "image"
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Image in Lightbox", 'creatink'),
					"param_name" => "lightbox_image"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Hover Title", 'creatink'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Video / Google Maps iFrame URL", 'creatink'),
					"param_name" => "video",
					'holder' => 'div'
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'creatink'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'creatink'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_lightbox_block_shortcode_vc' );