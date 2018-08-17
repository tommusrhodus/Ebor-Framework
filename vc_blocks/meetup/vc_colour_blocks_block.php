<?php 

/**
 * The Shortcode
 */
function ebor_colour_blocks_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title1' => '',
				'content1' => '',
				'title2' => '',
				'content2' => '',
				'icon1' => '',
				'icon2' => '',
				'link1' => '',
				'link2' => '',
			), $atts 
		) 
	);
	
	if($icon1 == 'none')
		$icon1 = false;
		
	if($icon2 == 'none')
		$icon2 = false;
	
	$output = '<section class="color-blocks">
		<div class="color-block block-left col-md-6 col-sm-12"></div>
		<div class="color-block block-right col-md-6 col-sm-12"></div>
		
		<div class="container">
			<div class="row">
			
				<a href="'. esc_url($link1) .'" class="block-content">
					<div class="col-md-2 col-sm-4 text-center">
						<i class="icon '. $icon1 .'"></i>
					</div>
				
					<div class="col-md-4 col-sm-8">
						<h1>'. htmlspecialchars_decode($title1) .'</h1>
						'. wpautop(do_shortcode(htmlspecialchars_decode($content1))) .'
					</div>
				</a>
				
				<a href="'. esc_url($link2) .'" class="block-content">
					<div class="col-md-2 col-sm-4 text-center">
						<i class="icon '. $icon2 .'"></i>
					</div>
				
					<div class="col-md-4 col-sm-8">
						<h1>'. htmlspecialchars_decode($title2) .'</h1>
						'. wpautop(do_shortcode(htmlspecialchars_decode($content2))) .'
					</div>
				</a>
				
			</div>
		</div><!--end of container-->
	</section>';
	
	return $output;
}
add_shortcode( 'meetup_colour_blocks', 'ebor_colour_blocks_shortcode' );

/**
 * The VC Functions
 */
function ebor_colour_blocks_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'meetup-vc-block',
			"name" => __("Colour Blocks", 'meetup'),
			"base" => "meetup_colour_blocks",
			"category" => __('Meetup - WP Theme', 'meetup'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title 1", 'meetup'),
					"param_name" => "title1",
				),
				array(
					"type" => "textarea",
					"heading" => __("Content 1", 'meetup'),
					"param_name" => "content1",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Link 1", 'meetup'),
					"param_name" => "link1",
				),
				array(
					"type" => "ebor_icons",
					"heading" => __("Icon 1", 'meetup'),
					"param_name" => "icon1",
					"value" => array_values(ebor_get_icons()),
				),
				array(
					"type" => "textfield",
					"heading" => __("Title 2", 'meetup'),
					"param_name" => "title2",
				),
				array(
					"type" => "textarea",
					"heading" => __("Content 2", 'meetup'),
					"param_name" => "content2",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Link 2", 'meetup'),
					"param_name" => "link2",
				),
				array(
					"type" => "ebor_icons",
					"heading" => __("Icon 2", 'meetup'),
					"param_name" => "icon2",
					"value" => array_values(ebor_get_icons()),
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_colour_blocks_shortcode_vc' );