<?php 

/**
 * The Shortcode
 */
function ebor_page_header_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'layout' => 'slider',
				'image' => '',
				'mpfour' => '',
				'ogv' => '',
				'webm' => '',
				'small' => '',
				'big' => '',
				'sub' => '',
				'shortcode' => '',
				'youtube' => '',
				'blog_posts' => 0,
				'map' => ''
			), $atts 
		) 
	);
	
	$shortcode = $content;
	
	ob_start();
	?>
	<div class="aq-block-aq_page_header_block">
	<?php include( locate_template('page-header/content-header-' . $layout . '.php') ); ?>
	</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'pivot_page_header', 'ebor_page_header_shortcode' );

/**
 * The VC Functions
 */
function ebor_page_header_shortcode_vc() {
	
	$header_options = array(
		'slider',
		'video',
		'simple',
		'simple-centered',
		'product',
		'resume',
		'personal',
		'logo',
		'fullscreen-single',
		'map',
		'form',
		'call-to-action'
	);
	
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
			"name" => __("Pivot - Page Header", 'pivot'),
			"base" => "pivot_page_header",
			"category" => __('Pivot - Misc', 'pivot'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'pivot'),
					"param_name" => "layout",
					"value" => $header_options,
					"description" => ''
				),
				array(
					"type" => "attach_images",
					"heading" => __("Slider Images", 'pivot'),
					"param_name" => "image",
					"value" => '',
					"description" => __('Add images to show in the slider, always add an image for the background', 'pivot')
				),
				array(
					"type" => "dropdown",
					"heading" => __("Fullscreen type - show blog posts?", 'pivot'),
					"param_name" => "blog_posts",
					"value" => array(
						'No',
						'Yes'
					),
				),
				array(
					"type" => "textfield",
					"heading" => __("Video Embed Background?", 'pivot'),
					"param_name" => "youtube",
					"value" => '',
					"description" => __('<a href="http://codex.wordpress.org/Embeds" target="_blank">List of Acceptable Services Here</a>', 'pivot')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video Background?, .webm extension", 'pivot'),
					"param_name" => "webm",
					"value" => '',
					"description" => __('Please fill all extensions', 'pivot')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video Background?, .mp4 extension", 'pivot'),
					"param_name" => "mpfour",
					"value" => '',
					"description" => __('Please fill all extensions', 'pivot')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video Background?, .ogv extension", 'pivot'),
					"param_name" => "ogv",
					"value" => '',
					"description" => __('Please fill all extensions', 'pivot')
				),
				array(
					"type" => "textfield",
					"heading" => __("Small Text", 'pivot'),
					"param_name" => "small",
					"value" => '',
					"description" => ''
				),
				array(
					"type" => "textarea",
					"heading" => __("Big Text", 'pivot'),
					"param_name" => "big"
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle Text", 'pivot'),
					"param_name" => "sub",
					"value" => '',
					"description" => ''
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Shortcodes, buttons etc.", 'pivot'),
					"param_name" => "content",
					"value" => '',
					"description" => ''
				),
				array(
					"type" => "textarea_raw_html",
					"heading" => __("Map iFrame", 'pivot'),
					"param_name" => "map"
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_page_header_shortcode_vc' );