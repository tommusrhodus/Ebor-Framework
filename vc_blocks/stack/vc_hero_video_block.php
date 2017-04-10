<?php 

/**
 * The Shortcode
 */
function ebor_hero_video_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'layout' => 'self-hosted',
				'opacity' => '',
				'height' => '',
				'custom_css_class' => '',
				'mpfour' => '',
				'webm' => '',
				'embed' => '',
				'start' => '0',
				'button_url' => '',
				'button_text' => ''
			), $atts 
		) 
	);
	
	if( 'self-hosted' == $layout ) {
		
		$opacity = ( '' == $opacity ) ? '4' : $opacity;
		$height = ( '' == $height ) ? '60' : $height;
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' imagebg videobg height-'. $height .' text-center" data-overlay="'. $opacity .'">
				
				<video autoplay loop muted>
					<source src="'. esc_url($webm) .'" type="video/webm">
					<source src="'. esc_url($mpfour) .'" type="video/mp4">
				</video>
					
				<div class="background-image-holder">
					'. wp_get_attachment_image( $image, 'full' ) .'
				</div>
				
				<div class="container pos-vertical-center">
					<div class="row">
						<div class="col-sm-12">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
					</div>
				</div>
		';
		
		if( $button_text ){
			$output .= '
				<div class="pos-bottom pos-absolute col-xs-12 text-center">
				    <a class="btn type--uppercase" href="'. esc_url($button_url) .'">
				        <span class="btn__text">'. esc_html($button_text) .'</span>
				    </a>
				</div>
			';
		}		
		
		$output .= '</section>';
	
	} elseif( 'youtube' == $layout ) {
		
		$opacity = ( '' == $opacity ) ? '4' : $opacity;
		$height = ( '' == $height ) ? '60' : $height;
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' imagebg videobg height-'. $height .' text-center" data-overlay="'. $opacity .'">
				
				<div class="youtube-background" data-video-url="'. esc_attr($embed) .'" data-start-at="'. $start .'"></div>
				
				<div class="background-image-holder">
					'. wp_get_attachment_image( $image, 'full' ) .'
				</div>
				
				<div class="container pos-vertical-center">
					<div class="row">
						<div class="col-sm-12">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
					</div>
				</div>
		';
		
		if( $button_text ){
			$output .= '
				<div class="pos-bottom pos-absolute col-xs-12 text-center">
				    <a class="btn type--uppercase" href="'. esc_url($button_url) .'">
				        <span class="btn__text">'. esc_html($button_text) .'</span>
				    </a>
				</div>
			';
		}		
		
		$output .= '</section>';
		
	} elseif( 'self-hosted-full' == $layout ) {
		
		$opacity = ( '' == $opacity ) ? '4' : $opacity;
		$height = ( '' == $height ) ? '100' : $height;
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' cover imagebg videobg height-'. $height .' text-center" data-overlay="'. $opacity .'">
				
				<video autoplay loop muted>
					<source src="'. esc_url($webm) .'" type="video/webm">
					<source src="'. esc_url($mpfour) .'" type="video/mp4">
				</video>
					
				<div class="background-image-holder">
					'. wp_get_attachment_image( $image, 'full' ) .'
				</div>
				
				<div class="container pos-vertical-center">
					<div class="row">
						<div class="col-sm-12">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
					</div>
				</div>
		';
		
		if( $button_text ){
			$output .= '
				<div class="pos-bottom pos-absolute col-xs-12 text-center">
				    <a class="btn type--uppercase" href="'. esc_url($button_url) .'">
				        <span class="btn__text">'. esc_html($button_text) .'</span>
				    </a>
				</div>
			';
		}		
		
		$output .= '</section>';
	
	} elseif( 'youtube-full' == $layout ) {
		
		$opacity = ( '' == $opacity ) ? '4' : $opacity;
		$height = ( '' == $height ) ? '100' : $height;
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' cover imagebg videobg height-'. $height .' text-center" data-overlay="'. $opacity .'">
				
				<div class="youtube-background" data-video-url="'. esc_attr($embed) .'" data-start-at="'. $start .'"></div>
				
				<div class="background-image-holder">
					'. wp_get_attachment_image( $image, 'full' ) .'
				</div>
				
				<div class="container pos-vertical-center">
					<div class="row">
						<div class="col-sm-12">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
					</div>
				</div>
		';
		
		if( $button_text ){
			$output .= '
				<div class="pos-bottom pos-absolute col-xs-12 text-center">
				    <a class="btn type--uppercase" href="'. esc_url($button_url) .'">
				        <span class="btn__text">'. esc_html($button_text) .'</span>
				    </a>
				</div>
			';
		}		
		
		$output .= '</section>';
		
	}

	return $output;
}
add_shortcode( 'stack_hero_video', 'ebor_hero_video_shortcode' );

/**
 * The VC Functions
 */
function ebor_hero_video_shortcode_vc() {

	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Hero Header (Video)", 'stackwordpresstheme'),
			"base" => "stack_hero_video",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			'as_parent'               => array('except' => 'stack_tabs_content'),
			'content_element'         => true,
			'show_settings_on_create' => true,
			"js_view" => 'VcColumnView',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("hero_video Header Display Type", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => array(
						'Self Hosted Video, Half Height, Centered Text' => 'self-hosted',
						'YouTube Video, Half Height, Centered Text' => 'youtube',
						'Self Hosted Video, Full Height, Centered Text' => 'self-hosted-full',
						'YouTube Video, Full Height, Centered Text' => 'youtube-full'
					)
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Fallback Background Image for Mobile Devices", 'stackwordpresstheme'),
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
					"heading" => esc_html__("Self Hosted Video .webm extension", 'stackwordpresstheme'),
					"param_name" => "webm",
					"description" => esc_html__('Please fill all extensions', 'stackwordpresstheme')
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Self Hosted Video .mp4 extension", 'stackwordpresstheme'),
					"param_name" => "mpfour",
					"description" => esc_html__('Please fill all extensions', 'stackwordpresstheme')
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Youtube Embed ID", 'stackwordpresstheme'),
					"param_name" => "embed",
					'description' => 'Enter only the ID of your youtube video, e.g: dmgomCutGqc'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Youtube Start Time", 'stackwordpresstheme'),
					"param_name" => "start",
					'description' => 'Numerical value to start the video playing from a particular point ie. a value of 10 would start the video 10 seconds in.'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'stackwordpresstheme'),
					"param_name" => "button_text"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button URL", 'stackwordpresstheme'),
					"param_name" => "button_url"
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
add_action( 'vc_before_init', 'ebor_hero_video_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_hero_video extends WPBakeryShortCodesContainer {}
}