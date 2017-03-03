<?php 

/**
 * The Shortcode
 */
function ebor_slider_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'timing' => '7000',
				'custom_css_class' => '',
				'arrows' => 'true',
				'paging' => 'false',
				'autoplay' => 'true',
				'column' => '12',
				'layout' => 'normal'
			), $atts 
		) 
	);
	
	$image = explode(',', $image);
	$rand = wp_rand(0, 10000);
	
	$output = '
		<div class="'. esc_attr($custom_css_class) .' slider" data-arrows="'. $arrows .'" data-paging="'. $paging .'" data-autoplay="'. $autoplay .'" data-timing="'. (int) esc_attr($timing) .'">
			<ul class="slides">
	';
	
	if( 'lightbox' == $layout ){
		
		foreach ($image as $id){
			$src = wp_get_attachment_image_src( $id, 'full' );
			$output .= '
				<li class="col-sm-'. (int) $column .'">
					<a href="'. $src[0] .'" data-lightbox="Gallery '. $rand .'">
						'. wp_get_attachment_image($id, 'full') .'
					</a>
				</li>
			';
		}
		
	} else {
		
		foreach ($image as $id){
			$output .= '
				<li class="col-sm-'. (int) $column .'">
					'. wp_get_attachment_image($id, 'full') .'
				</li>
			';
		}
		
	}		
	
	$output .= '
			</ul>
		</div>
	';
		
	return $output;
}
add_shortcode( 'stack_slider', 'ebor_slider_shortcode' );

/**
 * The VC Functions
 */
function ebor_slider_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Image Slider", 'stackwordpresstheme'),
			"base" => "stack_slider",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "attach_images",
					"heading" => esc_html__("slider Images", 'stackwordpresstheme'),
					"param_name" => "image"
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Show navigation arrows?", 'stackwordpresstheme'),
					"param_name" => "arrows",
					"value" => array(
						'Yes' => 'true',
						'No' => 'false'
					)
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Show navigation dots?", 'stackwordpresstheme'),
					"param_name" => "paging",
					"value" => array(
						'No' => 'false',
						'Yes' => 'true'
					)
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Autoplay slides?", 'stackwordpresstheme'),
					"param_name" => "autoplay",
					"value" => array(
						'Yes' => 'true',
						'No' => 'false'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Autoplay Timer (ms)", 'stackwordpresstheme'),
					"param_name" => "timing",
					'value' => '7000'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Image Column Width", 'stackwordpresstheme'),
					"param_name" => "column",
					"description" => 'Enter column width for images, 1 to 12, 12 for full width, 6 for half width etc.',
					'value' => '12'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display Type", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => array(
						'Regular Slider' => 'normal',
						'Slides Linked To Lightbox' => 'lightbox'
					)
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
add_action( 'vc_before_init', 'ebor_slider_shortcode_vc' );