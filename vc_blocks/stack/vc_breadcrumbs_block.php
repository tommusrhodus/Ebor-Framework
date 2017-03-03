<?php 

/**
 * The Shortcode
 */
function ebor_breadcrumbs_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	if( $image ){
		
		$output = '
			<section class="'. $custom_css_class .' imagebg parallax" data-overlay="4">
				<div class="background-image-holder">
					'. wp_get_attachment_image( $image, 'full' ) .'
				</div>
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<h1>'. get_the_title() .'</h1>
							'. ebor_breadcrumbs() .'
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
			</section>
		';
		
	} else {
		
		$output = '
			<section class="space--sm '. $custom_css_class .'">
			    <div class="container">
			        <div class="row">
			            <div class="col-sm-12"><h1>'. get_the_title() .'</h1> '. ebor_breadcrumbs() .'<hr></div>
			        </div><!--end of row-->
			    </div><!--end of container-->
			</section>
		';
	
	}
	
	return $output;
}
add_shortcode( 'stack_breadcrumbs', 'ebor_breadcrumbs_shortcode' );

/**
 * The VC Functions
 */
function ebor_breadcrumbs_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Breadcrumbs", 'stackwordpresstheme'),
			"base" => "stack_breadcrumbs",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Header Background Image", 'stackwordpresstheme'),
					"param_name" => "image"
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
add_action( 'vc_before_init', 'ebor_breadcrumbs_shortcode_vc' );