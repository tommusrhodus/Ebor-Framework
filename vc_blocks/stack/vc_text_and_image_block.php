<?php 

/**
 * The Shortcode
 */
function ebor_text_image_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'layout' => 'left',
				'custom_css_class' => '',
				'background' => 'bg--secondary'
			), $atts 
		) 
	);
	
	if( 'left' == $layout ){
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' imageblock switchable feature-large '. $background .' space--sm">
			    <div class="imageblock__content col-md-6 col-sm-4 pos-right">
			        <div class="background-image-holder">
			            '. wp_get_attachment_image( $image, 'full' ) .'
			        </div>
			    </div>
			    <div class="container">
			        <div class="row">
			            <div class="col-md-5 col-sm-7">
			                '. do_shortcode($content) .'
			            </div>
			        </div><!--end of row-->
			    </div><!--end of container-->
			</section>
		';
		
	} elseif( 'right' == $layout ){
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' imageblock switchable switchable--switch '. $background .' feature-large space--sm">
			    <div class="imageblock__content col-md-6 col-sm-4 pos-right">
			        <div class="background-image-holder">
			            '. wp_get_attachment_image( $image, 'full' ) .'
			        </div>
			    </div>
			    <div class="container">
			        <div class="row">
			            <div class="col-md-5 col-sm-7">
			                '. do_shortcode($content) .'
			            </div>
			        </div><!--end of row-->
			    </div><!--end of container-->
			</section>
		';
			
	} elseif( 'overlay' == $layout ){
	
		$output = '
			<section class="'. esc_attr($custom_css_class) .' '. $background .' switchable switchable--switch">
			    <div class="container">
			        <div class="row">
			            <div class="col-sm-12">
			                <div class="height-50 imagebg border--round box-shadow-wide" data-overlay="3">
			                    <div class="background-image-holder">'. wp_get_attachment_image( $image, 'full' ) .'</div>
			                    <div class="pos-vertical-center col-sm-6 boxed boxed--lg bg--none">
			                        '. do_shortcode($content) .'
			                    </div>
			                </div>
			            </div>
			        </div><!--end of row-->
			    </div><!--end of container-->
			</section>
		';
		
	} elseif( 'inline-left' == $layout ){
	
		$output = '
			<section class="'. esc_attr($custom_css_class) .' switchable feature-large">
			    <div class="container">
			        <div class="row">
			            <div class="col-sm-6">
			                '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'border--round box-shadow-wide') ) .'
			            </div>
			            <div class="col-sm-6 col-md-5">
			                <div class="mt--2">
			                    '. do_shortcode($content) .'
			                </div>
			            </div>
			        </div><!--end of row-->
			    </div><!--end of container-->
			</section>
		';
	
	} elseif( 'inline-right' == $layout ){
	
		$output = '
			<section class="'. esc_attr($custom_css_class) .' '. $background .' switchable feature-large">
			    <div class="container">
			        <div class="row">
			            <div class="col-sm-6 col-md-5">
			                <div class="mt--2">
			                    '. do_shortcode($content) .'
			                </div>
			            </div>
			            <div class="col-sm-5 col-sm-offset-1">
			                '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'border--round box-shadow-wide') ) .'
			            </div>
			        </div><!--end of row-->
			    </div><!--end of container-->
			</section>
		';
	
	} elseif( 'left-small' == $layout ){
	
		$output = '
			<section class="'. esc_attr($custom_css_class) .' '. $background .' space--xs imageblock switchable feature-large">
			    <div class="imageblock__content col-md-5 col-sm-4 pos-right">
			        <div class="background-image-holder">'. wp_get_attachment_image( $image, 'full' ) .'</div>
			    </div>
			    <div class="container">
			        <div class="row">
			            <div class="col-md-5 col-sm-7">'. do_shortcode($content) .'</div>
			        </div><!--end of row-->
			    </div><!--end of container-->
			</section>
		';
		
	} elseif( 'left-smaller' == $layout ){
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' '. $background .' imageblock switchable feature-large">
			    <div class="imageblock__content col-md-4 col-sm-3 pos-right">
			        <div class="background-image-holder">'. wp_get_attachment_image( $image, 'full' ) .'</div>
			    </div>
			    <div class="container">
			        <div class="row">
			            <div class="col-md-7 col-sm-8">'. do_shortcode($content) .'</div>
			        </div><!--end of row-->
			    </div><!--end of container-->
			</section>
		';
			
	} elseif( 'right-small' == $layout ){
	
		$output = '
			<section class="'. esc_attr($custom_css_class) .' '. $background .' switchable--switch space--xs imageblock switchable feature-large">
			    <div class="imageblock__content col-md-5 col-sm-4 pos-right">
			        <div class="background-image-holder">'. wp_get_attachment_image( $image, 'full' ) .'</div>
			    </div>
			    <div class="container">
			        <div class="row">
			            <div class="col-md-5 col-sm-7">'. do_shortcode($content) .'</div>
			        </div><!--end of row-->
			    </div><!--end of container-->
			</section>
		';
		
	} elseif( 'right-smaller' == $layout ){
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' '. $background .' switchable--switch imageblock switchable feature-large">
			    <div class="imageblock__content col-md-4 col-sm-3 pos-right">
			        <div class="background-image-holder">'. wp_get_attachment_image( $image, 'full' ) .'</div>
			    </div>
			    <div class="container">
			        <div class="row">
			            <div class="col-md-7 col-sm-8">'. do_shortcode($content) .'</div>
			        </div><!--end of row-->
			    </div><!--end of container-->
			</section>
		';
			
	}
	
	return $output;
}
add_shortcode( 'stack_text_image', 'ebor_text_image_shortcode' );

/**
 * The VC Functions
 */
function ebor_text_image_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'                    => esc_html__( 'Text + Image' , 'stackwordpresstheme' ),
		    'base'                    => 'stack_text_image',
		    'description'             => esc_html__( 'Create fancy images & text', 'stackwordpresstheme' ),
		    'as_parent'               => array('except' => 'stack_tabs_content'),
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'params' => array(
		    	array(
		    		"type" => "attach_image",
		    		"heading" => esc_html__("Block Image", 'stackwordpresstheme'),
		    		"param_name" => "image"
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Image & Text Display Type", 'stackwordpresstheme'),
		    		"param_name" => "layout",
		    		"value" => array(
		    			'Image Left 50/50' => 'left',
		    			'Image Left 33/66' => 'left-small',
		    			'Image Left 25/75' => 'left-smaller',
		    			'Image Right 50/50' => 'right',
		    			'Image Right 33/66' => 'right-small',
		    			'Image Right 25/75' => 'right-smaller',
		    			'Text Overlaid on Image' => 'overlay',
		    			'Inline Image Left' => 'inline-left',
		    			'Inline Image Right' => 'inline-right'
		    		)
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Background Colour", 'stackwordpresstheme'),
		    		"param_name" => "background",
		    		"value" => array(
		    			'Secondary Colour' => 'bg--secondary',
		    			'None' => 'regular-background',
		    			'Primary Colour' => 'bg--primary',
		    			'Primary 1 Colour' => 'bg--primary-1',
		    			'Primary 2 Colour' => 'bg--primary-2',
		    			'Dark Colour' => 'bg--dark',
		    			'Image Background' => 'imagebg'
		    		),
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
add_action( 'vc_before_init', 'ebor_text_image_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_text_image extends WPBakeryShortCodesContainer {}
}