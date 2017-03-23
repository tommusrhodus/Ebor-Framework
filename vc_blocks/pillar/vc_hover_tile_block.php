<?php 

/**
 * The Shortcode
 */
function ebor_hover_tile_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'type' => 'top,left',
				'link' => '#',
				'title' => '',
				'subtitle' => ''
			), $atts 
		) 
	);
	
	$output = '
		<a href="'. esc_url($link) .'">
			<div class="hover-element hover-element-1 bg--primary" data-title-position="'. $type .'">
				<div class="hover-element__initial">
					'. wp_get_attachment_image( $image, 'large' ) .'
				</div>
				<div class="hover-element__reveal" data-overlay="9">
					<div class="boxed">
						<h5>'. htmlspecialchars_decode($title) .'</h5>
						<span><em>'. htmlspecialchars_decode($subtitle) .'</em></span>
					</div>
				</div>
			</div><!--end hover element-->
		</a>
	';
	
	return $output;
}
add_shortcode( 'pillar_hover_tile', 'ebor_hover_tile_shortcode' );

/**
 * The VC Functions
 */
function ebor_hover_tile_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pillar-vc-block',
			"name" => esc_html__("Hover Tiles", 'pillar'),
			"base" => "pillar_hover_tile",
			"category" => esc_html__('pillar WP Theme', 'pillar'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Block Image", 'pillar'),
					"param_name" => "image"
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display Type", 'pillar'),
					"param_name" => "type",
					"value" => array(
						'Top Left' => 'top,left',
						'Top Right' => 'top,right',
						'Center Left' => 'center,left',
						'Center Right' => 'center,right',
						'Bottom Left' => 'bottom,left',
						'Bottom Right' => 'bottom,right',
						'Centered' => 'top,center',
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'pillar'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", 'pillar'),
					"param_name" => "subtitle",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("URL for block", 'pillar'),
					"param_name" => "link",
	            	'description' => '<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=O-1kRSALF9E">Video Tutorial</a></div>'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_hover_tile_shortcode_vc' );