<?php 

/**
 * The Shortcode
 */
function ebor_modal_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'button_text' => '',
				'autoshow' => '',
				'cookie' => '',
				'exit' => '',
				'custom_css_class' => '',
				'layout' => 'basic',
				'image' => '',
				'show_trigger' => 'yes',
				'btn_class' => ''
			), $atts 
		) 
	);
	
	$autoshow = ( $autoshow ) ? 'data-autoshow="'. (int) $autoshow .'"' : false;
	$cookie = ( $cookie ) ? 'data-cookie="'. $cookie .'"' : false;
	$exit = ( $exit ) ? 'data-show-on-exit="'. $exit .'"' : false;
	
	if( 'basic' == $layout ){
		
		$modal_content = '
			<div class="modal-content">
				<div class="boxed boxed--lg">
					'. do_shortcode(htmlspecialchars_decode($content)) .'
				</div>
			</div>
		';	
		
	} elseif( 'image-left' == $layout ) {
		
		$modal_content = '
			<div class="modal-content">
				<section class="imageblock feature-large bg--white border--round ">
				    <div class="imageblock__content col-md-5 col-sm-3 pos-left">
				        <div class="background-image-holder">
				            '. wp_get_attachment_image( $image, 'full' ) .'
				        </div>
				    </div>
				    <div class="container">
				        <div class="row">
				            <div class="col-md-5 col-md-push-6 col-sm-7 col-sm-push-4">
				                '. do_shortcode(htmlspecialchars_decode($content)) .'
				            </div>
				        </div><!--end of row-->
				    </div><!--end of container-->
				</section>
			</div>
		';	
		
	} elseif( 'image-right' == $layout ) {
		
		$modal_content = '
			<div class="modal-content">
				<section class="imageblock feature-large bg--white border--round ">
				    <div class="imageblock__content col-md-5 col-sm-3 pos-right">
				        <div class="background-image-holder">
				            '. wp_get_attachment_image( $image, 'full' ) .'
				        </div>
				    </div>
				    <div class="container">
				        <div class="row">
				            <div class="col-md-5 col-md-push-1 col-sm-7 col-sm-push-1">
				                '. do_shortcode(htmlspecialchars_decode($content)) .'
				            </div>
				        </div><!--end of row-->
				    </div><!--end of container-->
				</section>
			</div>
		';	
		
	} elseif( 'narrow' == $layout ) {
	
		$modal_content = '
			<div class="modal-content">
				<section class="unpad ">
				    <div class="container modal-container-narrow">
				        <div class="row">
				            <div class="col-xs-12">
			                    <div class="feature feature-1 text-center">
			                        '. wp_get_attachment_image( $image, 'full' ) .'
			                        <div class="feature__body boxed boxed--lg boxed--border">
			                            <div class="modal-close modal-close-cross"></div>
			                            '. do_shortcode(htmlspecialchars_decode($content)) .'
			                        </div>
			                    </div><!--end feature-->
			                </div>
				        </div><!--end of row-->
				    </div><!--end of container-->
				</section>
			</div>
		';
	
	} elseif( 'image-background' == $layout ) {
	
		$modal_content = '
			<div class="modal-content">
			    <section class="cover height-60 imagebg border--round" data-overlay="2">
			        <div class="modal-close modal-close-cross"></div>
			        <div class="background-image-holder">
			            '. wp_get_attachment_image( $image, 'full' ) .'
			        </div>
			        <div class="container pos-vertical-center">
			            <div class="row">
			                <div class="col-sm-7 col-md-5 col-md-offset-1 col-sm-offset-1">
			                    '. do_shortcode(htmlspecialchars_decode($content)) .'
			                </div>
			            </div><!--end of row-->
			        </div><!--end of container-->
			    </section>
			</div>
		';
		
	}
	
	$trigger = ( 'yes' == $show_trigger ) ? '<a class="btn '. $btn_class .' modal-trigger" href="#">'. $button_text .'</a>' : false;
	
	$output = '
		<div class="modal-instance '. esc_attr($custom_css_class) .'">
			'. $trigger .'
			<div class="modal-container" '. $autoshow .' '. $cookie .' '. $exit .'>
				'. $modal_content .'
			</div>
		</div><!--end of modal instance-->
	';

	return $output;
}
add_shortcode( 'stack_modal', 'ebor_modal_shortcode' );

/**
 * The VC Functions
 */
function ebor_modal_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Modal", 'stackwordpresstheme'),
			"base" => "stack_modal",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			'as_parent'               => array('except' => 'stack_tabs_content'),
			'content_element'         => true,
			'show_settings_on_create' => true,
			"js_view" => 'VcColumnView',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Modal Layout", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => array(
						'Basic Modal' => 'basic',
						'Image Left & Content Right' => 'image-left',
						'Image Right & Content Left' => 'image-right',
						'Image Top' => 'narrow',
						'Image Background' => 'image-background'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Show trigger Button?", 'stackwordpresstheme'),
					"param_name" => "show_trigger",
					"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Button Display Type", 'stackwordpresstheme'),
					"param_name" => "btn_class",
					"value" => array(
						'Outline Button' => '',
						'Standard Button' => 'btn--primary',
						'Outline Button Uppercase' => 'type--uppercase',
						'Standard Button Uppercase' => 'btn--primary type--uppercase'
					),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'stackwordpresstheme'),
					"param_name" => "button_text",
					"description" => 'Modal trigger button text',
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Block Image", 'stackwordpresstheme'),
					"param_name" => "image"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Autoshow Counter", 'stackwordpresstheme'),
					"param_name" => "autoshow",
					"description" => 'Autoshow timer, use milliseconds to create a countdown for the modal to show on page load. NUMERIC ONLY. E.g: 5000',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Cookie Name", 'stackwordpresstheme'),
					"param_name" => "cookie",
					"description" => 'Leave blank in most cases, set a unique name if you want a modal to show only once per user.',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Exit element class", 'stackwordpresstheme'),
					"param_name" => "exit",
					"description" => 'Enter the CSS class of an element if you wish to show this modal whenever a users mouse leaves that element. Use sparingly.',
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
add_action( 'vc_before_init', 'ebor_modal_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_modal extends WPBakeryShortCodesContainer {}
}