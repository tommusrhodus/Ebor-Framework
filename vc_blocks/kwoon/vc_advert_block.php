<?php 

/**
 * The Shortcode
 */
function ebor_advert_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'title' => '',
				'subtitle' => '',
				'link' => '',
				'placement' => 'bottom-left'
			), $atts 
		) 
	);
	
	$output = '
		<div class="caption-overlay">
		
			<figure>
				<a href="'. esc_url($link) .'">
					'. wp_get_attachment_image($image, 'full') .'
				</a>
			</figure>
			
			<div class="caption '. esc_attr($placement) .'">
				<div class="title">
					<h3 class="main-title light-layer">'. $title .'</h3>
				</div>
				<div class="title">
					<h3 class="main-title light-layer"><strong>'. $subtitle .'</strong></h3>
				</div>
			</div>
		
		</div>
	';

	return $output;
}
add_shortcode( 'kwoon_advert_block', 'ebor_advert_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_advert_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("Shop Advert", 'kwoon'),
			"base" => "kwoon_advert_block",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			'description' => 'Add an advert with link and caption.',
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("Background Image", 'kwoon'),
					"param_name" => "image"
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", 'kwoon'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'kwoon'),
					"param_name" => "subtitle"
				),
				array(
					"type" => "textfield",
					"heading" => __("Enter URL to link block", 'kwoon'),
					"param_name" => "link"
				),
				array(
					"type" => "dropdown",
					"heading" => __("Caption Location", 'kwoon'),
					"param_name" => "placement",
					"value" => array(
						'Bottom Left' => 'bottom-left',
						'Bottom Right' => 'bottom-right',
						'Top Left' => 'top-left',
						'Top Right' => 'top-right'
					)
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_advert_block_shortcode_vc' );