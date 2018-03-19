<?php 

/**
 * The Shortcode
 */
function ebor_icon_and_text_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'icon'             => '',
				'layout'           => 'top-basic',
				'link'             => '#',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	if( 'top-basic' == $layout ){
		
		$output = '
			<div class="'. $custom_css_class .' service-item-box text-center mb-40">
			
				<a href="'. esc_url( $link ) .'" class="icon-holder hi-icon">
					<i class="'. esc_attr( $icon ) .'"></i>
				</a>
				
				<div class="service-text">'. do_shortcode( $content ) .'</div>
			
			</div> 
		';
		
	} elseif( 'top-color' == $layout ){
		
		$output = '
			<div class="'. $custom_css_class .' service-item-box style-2 mb-40">
			
				<a href="'. esc_url( $link ) .'" class="icon-holder">
					<i class="'. esc_attr( $icon ) .'"></i>
				</a>
				
				<div class="service-text">'. do_shortcode( $content ) .'</div>
			
			</div> 
		';
		
	} elseif( 'top-color-centered' == $layout ){
		
		$output = '
			<div class="'. $custom_css_class .' service-item-box style-5 text-center mb-40">
			
				<a href="'. esc_url( $link ) .'">
					<i class="'. esc_attr( $icon ) .'"></i>
				</a>
				
				<div class="service-text">'. do_shortcode( $content ) .'</div>
			
			</div> 
		';
		
	} elseif( 'side-background' == $layout ){
		
		$output = '
			<div class="'. $custom_css_class .' service-item-box style-3 mb-40">
			
				<a href="'. esc_url( $link ) .'" class="icon-holder">
					<i class="'. esc_attr( $icon ) .'"></i>
				</a>
				
				<div class="service-text">'. do_shortcode( $content ) .'</div>
			
			</div> 
		';
		
	} elseif( 'side-color' == $layout ){
		
		$output = '
			<div class="'. $custom_css_class .' service-item-box style-4 mb-40">
			
				<a href="'. esc_url( $link ) .'" class="icon-holder">
					<i class="'. esc_attr( $icon ) .'"></i>
				</a>
				
				<div class="service-text">'. do_shortcode( $content ) .'</div>
			
			</div> 
		';
		
	} elseif( 'top-arrow' == $layout ){
		
		$output = '
			<div class="'. $custom_css_class .' service-item-box arrow-next text-center style-5 mb-40">
			
				<a href="'. esc_url( $link ) .'" class="icon-holder">
					<i class="'. esc_attr( $icon ) .'"></i>
				</a>
				
				<div class="service-text">'. do_shortcode( $content ) .'</div>
			
			</div> 
		';
		
	} elseif( 'side-tiny' == $layout){
		
		$output = '
			<div class="'. $custom_css_class .' contact-item">
			
				<div class="contact-icon">
					<i class="'. esc_attr( $icon ) .'"></i>
				</div>
				
				'. do_shortcode( $content ) .'
			
			</div>
		';
		
	} else {
		
		$output = '
			<div class="'. $custom_css_class .' service-item-box style-6 mb-40">
			
				<a href="'. esc_url( $link ) .'" class="icon-holder">
					<i class="'. esc_attr( $icon ) .'"></i>
				</a>
				
				<div class="service-text">'. do_shortcode( $content ) .'</div>
			
			</div> 
		';
		
	}
	
	return $output;
}
add_shortcode( 'gaze_icon_and_text_block', 'ebor_icon_and_text_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_and_text_block_shortcode_vc() {
	
	$icons = array_keys(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_keys(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon"     => 'gaze-vc-block',
			"name"     => esc_html__( "Icon and Text", 'gaze' ),
			"base"     => "gaze_icon_and_text_block",
			"category" => esc_html__( 'Gaze WP Theme', 'gaze' ),
			"params"   => array(
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__( "Display type", 'gaze' ),
					"param_name" => "layout",
					'holder'     => 'div',
					"value"      => array(
						'Top Icon Grey Background'   => 'top-basic',
						'Top Icon Color'             => 'top-color',
						'Top Icon Color Centered'	 => 'top-color-centered',
						'Side Icon Color Background' => 'side-background',
						'Side Icon Color'            => 'side-color',
						'Top Icon Arrow'             => 'top-arrow',
						'Side Icon Black'            => 'side-black',
						'Side Icon Tiny'             => 'side-tiny'
					)
				),
				array(
					"type"       => "ebor_icons",
					"heading"    => esc_html__( "Icon", 'gaze' ),
					"param_name" => "icon",
					"value"      => $icons
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Link", 'gaze' ),
					"param_name" => "link",
					'value'      => '#'
				),
				array(
					"type"       => "textarea_html",
					"heading"    => esc_html__( "Block Content", 'gaze' ),
					"param_name" => "content",
					'holder'     => 'div'
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Extra CSS Class Name", 'gaze' ),
					"param_name"  => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_icon_and_text_block_shortcode_vc' );