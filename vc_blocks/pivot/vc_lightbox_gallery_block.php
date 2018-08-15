<?php 

/**
 * The Shortcode
 */
function ebor_lightbox_gallery_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'slides' => ''
			), $atts 
		) 
	);
	
	$slides = explode(',', $slides);
	
	if( is_array($slides) ) :
	
	$output = '<div class="image-gallery lightbox-gallery-mrv">';
		
		foreach( $slides as $id ){
			$output .= '<div class="col-sm-4 lightbox-thumbnail-mrv">
				<div class="image-holder" data-scroll-reveal="enter bottom and move 30px">';
				
					$item = get_post($id); 
					$image = wp_get_attachment_image_src($id, 'full');
					
					$output .= '<a href="'. $image[0] .'" class="lightbox-link-mrv" data-lightbox="true" data-title="'. $item->post_title .'">
						<div class="background-image-holder">
							'. wp_get_attachment_image($id, 'large', false, array('class' => 'background-image lightbox-image')) .'
						</div>
					</a>
					
				</div>
			</div>';
		}
	
	$output .= '</div>';
	
	else :
	
		$output = '';
		
	endif;
	
	return $output;
}
add_shortcode( 'pivot_lightbox_gallery', 'ebor_lightbox_gallery_shortcode' );

/**
 * The VC Functions
 */
function ebor_lightbox_gallery_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
			"name" => __("Pivot - Lightbox Gallery", 'pivot'),
			"base" => "pivot_lightbox_gallery",
			"category" => __('Pivot - Misc', 'pivot'),
			"params" => array(
				array(
					"type" => "attach_images",
					"heading" => __("Slider Images", 'pivot'),
					"param_name" => "slides",
					"value" => '',
					"description" => __('Add images to show in the slider', 'pivot')
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_lightbox_gallery_shortcode_vc' );