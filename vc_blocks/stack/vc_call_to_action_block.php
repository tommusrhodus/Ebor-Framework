<?php 

/**
 * The Shortcode
 */
function ebor_call_to_action_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'intro' => '',
				'middle' => '',
				'button_text' => '',
				'button_url' => '',
				'custom_css_class' => '',
				'layout' => 'default',
				'button_target' => '_self'
			), $atts 
		) 
	);
	
	if( 'default' == $layout ){
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' cta cta--horizontal text-center-xs row">
			    <div class="col-sm-4">
			        <h4>'. do_shortcode( $intro ) .'</h4>  
			    </div>
			    <div class="col-sm-5">
			        <p class="lead">'. do_shortcode( $middle ) .'</p>
			    </div>
			    <div class="col-sm-3 text-right text-center-xs">
			        <a class="btn btn--primary type--uppercase" href="'. esc_url($button_url) .'" target="'. esc_attr( $button_target ) .'"><span class="btn__text">'. $button_text .'</span></a>
			    </div>
			</div>
		';
	
	} elseif( 'bordered' == $layout ){
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' cta cta-1 cta--horizontal boxed boxed--border text-center-xs">
			    <div class="col-md-3 col-md-offset-1">
			        <h4>'. do_shortcode( $intro ) .'</h4>
			    </div>
			    <div class="col-md-4">
			        <p class="lead">'. do_shortcode( $middle ) .'</p>
			    </div>
			    <div class="col-md-4 text-center">
			        <a class="btn btn--primary type--uppercase" href="'. esc_url($button_url) .'" target="'. esc_attr( $button_target ) .'"><span class="btn__text">'. $button_text .'</span></a>
			    </div>
			</div>
		';
		
	} elseif( 'button' == $layout ){
	
		$output = '
			<section class="'. esc_attr($custom_css_class) .' bg--primary unpad cta cta-2">
				<a href="'. esc_url($button_url) .'" target="'. esc_attr( $button_target ) .'">
					<div class="container">
						<div class="row">
							<div class="col-sm-12 text-center">
								<h2>'. $button_text .'</h2>
							</div>
						</div><!--end of row-->
					</div><!--end of container-->
				</a>
			</section>
		';
	
	}  elseif( 'button-label' == $layout ){
	
		$output = '
			<div class="'. esc_attr($custom_css_class) .'">
				<a class="btn btn--primary type--uppercase" href="'. $button_url .'" target="'. esc_attr( $button_target ) .'">
				    <span class="btn__text">
				        '. $button_text .'
				    </span>
				    <span class="label">'. $intro .'</span>
				</a>
			</div>
		';
		
	}
	
	return $output;
}
add_shortcode( 'stack_call_to_action', 'ebor_call_to_action_shortcode' );

/**
 * The VC Functions
 */
function ebor_call_to_action_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Call To Action", 'stackwordpresstheme'),
			"base" => "stack_call_to_action",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Intro Text", 'stackwordpresstheme'),
					"param_name" => "intro",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Middle Text", 'stackwordpresstheme'),
					"param_name" => "middle",
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
					"type"       => "textfield",
					"heading"    => esc_html__("Button Target", 'stackwordpresstheme'),
					"param_name" => "button_target",
					'value'      => '_self',
					'description' => 'Default is <code>_self</code> use <code>_blank</code> to open in a new window'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display Type", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => array(
						'3 Columns' => 'default',
						'3 Columns Bordered' => 'bordered',
						'Huge Button' => 'button',
						'Button & Label' => 'button-label'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=E32Mc2nqGcU">Video Tutorial</a></div>',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_call_to_action_shortcode_vc' );