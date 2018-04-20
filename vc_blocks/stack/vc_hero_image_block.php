<?php 

/**
 * The Shortcode
 */
function ebor_hero_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'layout' => 'light-image-left',
				'opacity' => '',
				'height' => '',
				'custom_css_class' => '',
				'id' => '',
				'title' => '',
				'subtitle' => ''
			), $atts 
		) 
	);
	
	$id = ( $id ) ? 'id="'. esc_attr($id) .'"' : false;
	$footer = false;
	
	if( $title || $subtitle ){
		$footer = '
			<div class="pos-absolute pos-bottom col-xs-12">
	            <div class="container">
	                <div class="row">
	                    <div class="col-xs-12 text-left">
	                        <div class="text-block">
	                            <h5>'. $title .'</h5>
	                            <span>'. $subtitle .'</span>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
		';	
	}
	
	if( 'light-image-left' == $layout ) {
		
		$output = '
			<section class="imagebg image--light cover cover-blocks bg--secondary '. esc_attr($custom_css_class) .'" '. $id .'>
				<div class="background-image-holder">'. wp_get_attachment_image( $image, 'full' ) .'</div>
				<div class="container">
					<div class="row">
						<div class="col-sm-6 col-md-5">
							<div>'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
				'. $footer .'
			</section>
		';
		
	} elseif( 'dark-image' == $layout ) {
		
		$opacity = ( '' == $opacity ) ? '3' : $opacity;
		
		$output = '
			<section class="imagebg parallax '. esc_attr($custom_css_class) .'" data-overlay="'. $opacity .'" '. $id .'>
				<div class="background-image-holder">'. wp_get_attachment_image( $image, 'full' ) .'</div>
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="cta">
								'. do_shortcode(htmlspecialchars_decode($content)) .'
							</div>
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
				'. $footer .'
			</section>
		';
		
	} elseif( 'rounded-edges' == $layout ) {
		
		$opacity = ( '' == $opacity ) ? '3' : $opacity;
		$height = ( '' == $height ) ? '60' : $height;
	
		$output = '
			<div class="imagebg height-'. $height .' border--round '. esc_attr($custom_css_class) .'" data-overlay="'. $opacity .'" '. $id .'>
				<div class="background-image-holder">'. wp_get_attachment_image( $image, 'full' ) .'</div>
				<div class="container pos-vertical-center">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
					</div>
				</div>
				'. $footer .'
			</div>
		';
		
	} elseif( 'fullscreen' == $layout ) {
		
		$opacity = ( '' == $opacity ) ? '7' : $opacity;
		$height = ( '' == $height ) ? '100' : $height;
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' cover height-'. $height .' imagebg text-center" data-overlay="'. $opacity .'" '. $id .'>
			    <div class="background-image-holder">
			        '. wp_get_attachment_image( $image, 'full' ) .'
			    </div>
			    <div class="container pos-vertical-center">
			        <div class="row">
			            <div class="col-sm-12">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
			        </div><!--end of row-->
			    </div><!--end of container-->
			    '. $footer .'
			</section>
		';
		
	} elseif( '80-form' == $layout ) {
		
		$opacity = ( '' == $opacity ) ? '5' : $opacity;
		$height = ( '' == $height ) ? '80' : $height;
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' cover height-'. $height .' imagebg" data-overlay="'. $opacity .'" '. $id .'>
				<div class="background-image-holder">
					'. wp_get_attachment_image( $image, 'full' ) .'
				</div>
				<div class="container pos-vertical-center">
					<div class="row">
						<div class="col-sm-12">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
					</div><!--end of row-->
				</div><!--end of container-->
				'. $footer .'
			</section>
		';
		
	} elseif( 'top-left-text' == $layout ){
		
		$opacity = ( '' == $opacity ) ? '3' : $opacity;
		$height = ( '' == $height ) ? '80' : $height;
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' imagebg height-'. $height .' parallax" data-overlay="'. $opacity .'" '. $id .'>
				<div class="background-image-holder background--top">
					'. wp_get_attachment_image( $image, 'full' ) .'
				</div>
				<div class="container">
					<div class="row">
						<div class="col-sm-12">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
					</div><!--end of row-->
				</div><!--end of container-->
				'. $footer .'
			</section>
		';	
		
	} elseif( 'boxed-right-text' == $layout ){
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' imagebg" '. $id .'>
				<div class="background-image-holder">
					'. wp_get_attachment_image( $image, 'full' ) .'
				</div>
				<div class="container">
					<div class="row">
						<div class="col-sm-7 col-md-5 col-sm-offset-5 col-md-offset-7">
							<div class="boxed boxed--lg border--round bg--white">
								<div class="col-md-10 col-md-offset-1 col-sm-12">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
							</div>
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
				'. $footer .'
			</section>
		';
			
	} elseif( 'boxed-left-text' == $layout ){
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' imagebg" '. $id .'>
				<div class="background-image-holder">
					'. wp_get_attachment_image( $image, 'full' ) .'
				</div>
				<div class="container">
					<div class="row">
						<div class="col-sm-7 col-md-5">
							<div class="boxed boxed--lg border--round bg--white">
								<div class="col-md-10 col-md-offset-1 col-sm-12">
									'. do_shortcode(htmlspecialchars_decode($content)) .'
								</div>
							</div>
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
				'. $footer .'
			</section>
		';
			
	} elseif( 'half' == $layout ){
		
		$opacity = ( '' == $opacity ) ? '2' : $opacity;
		$height = ( '' == $height ) ? '50' : $height;
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' switchable switchable--switch imagebg height-'. $height .'" data-overlay="'. $opacity .'" '. $id .'>
			    <div class="background-image-holder">'. wp_get_attachment_image( $image, 'full' ) .'</div>
			    <div class="container pos-vertical-center">
			        <div class="row">
			            <div class="col-sm-6">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
			        </div><!--end of row-->
			    </div><!--end of container-->
			    '. $footer .'
			</section>
		';	
		
	} elseif( 'parallax' == $layout ){
		
		$opacity = ( '' == $opacity ) ? '4' : $opacity;
		$height = ( '' == $height ) ? '90' : $height;
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' cover height-'. $height .' imagebg parallax" data-overlay="'. $opacity .'" '. $id .'>
				<div class="background-image-holder">
					'. wp_get_attachment_image( $image, 'full' ) .'
				</div>
				<div class="container pos-vertical-center">
					<div class="row">
						<div class="col-sm-12">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
					</div><!--end of row-->
				</div><!--end of container-->
				'. $footer .'
			</section>
		';	
		
	} elseif( 'parallax-thin' == $layout ){
		
		$opacity = ( '' == $opacity ) ? '9' : $opacity;
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' imagebg parallax" data-scrim-top="'. $opacity .'" '. $id .'>
				<div class="background-image-holder">
					'. wp_get_attachment_image( $image, 'full' ) .'
				</div>
				<div class="container">
			        <div class="row">
			            <div class="col-sm-12">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
			        </div><!--end of row-->
			    </div><!--end of container-->
			    '. $footer .'
			</section>
		';	
		
	}

	return $output;
}
add_shortcode( 'stack_hero', 'ebor_hero_shortcode' );

/**
 * The VC Functions
 */
function ebor_hero_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Hero Header (Image)", 'stackwordpresstheme'),
			"base" => "stack_hero",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			'as_parent'               => array('except' => 'stack_tabs_content'),
			'content_element'         => true,
			'show_settings_on_create' => true,
			"js_view" => 'VcColumnView',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Hero Header Display Type", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => array(
						'Intro Hero, Dark Text, Left Column Text (Light Background Images)' => 'light-image-left',
						'Intro Hero, Light Text, Center Column Text (Dark Background Images)' => 'dark-image',
						'Mid Page Hero, Rounded Edges' => 'rounded-edges',
						'Fullscreen Image & Text (Simple & Minimal)' => 'fullscreen',
						'80% Height, Great For Text & A Contact Form' => '80-form',
						'80% Height, Parallax Background Image, Top left text' => 'top-left-text',
						'80% Height, Text column on RIGHT, boxed against image' => 'boxed-right-text',
						'80% Height, Text column on LEFT, boxed against image' => 'boxed-left-text',
						'50% Height, Left Column Text' => 'half',
						'90% Height, Parallax Background Image, Centered Text' => 'parallax',
						'Parallax Background Image, Gradient Scrim Overlay' => 'parallax-thin'
					)
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Hero Header Background Image", 'stackwordpresstheme'),
					"param_name" => "image"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Image Overlay Opacity", 'stackwordpresstheme'),
					"param_name" => "opacity",
					"description" => 'Leave blank for header option default opacity, enter 1 (light overlay) to 9 (dark overlay) to customize.',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Hero Height", 'stackwordpresstheme'),
					"param_name" => "height",
					"description" => 'Leave blank for default height, enter 10, 20, 30, 40, 50, 60, 70, 80, 90 or 100 for custom height (percentage of window height)',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'stackwordpresstheme'),
					"param_name" => "title",
					"description" => 'Adds a title for your header in the bottom left corner, perhaps for an image credit.',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", 'stackwordpresstheme'),
					"param_name" => "subtitle",
					"description" => 'Adds a subtitle for your header in the bottom left corner, perhaps for an image credit.',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=yoWmatY3jNU">Video Tutorial</a></div>',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_hero_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_hero extends WPBakeryShortCodesContainer {}
}