<?php 

/**
 * The Shortcode
 */
function ebor_video_modal_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'layout' => 'basic',
				'button_text' => '',
				'text' => '',
				'embed' => '',
				'custom_css_class' => '',
				'image' => '',
				'result' => ''
			), $atts 
		) 
	);
	
	if(!( '' == $embed )){
		
		$cache_key = 'tr-oembed-' . md5($embed);
		
		//Bail early on result
		if( $result = get_transient($cache_key) ) {
		    //$result now has the iFrame
		} else {
		
			//Cache is empty, resolve oEmbed
			$result = wp_oembed_get($embed, array('height' => '300', 'autoplay' => 'true'));
			
			//Cache 4 hours for standard and 5 min for failed
			$ttl = $result ? 14400 : 300;
			
			set_transient($cache_key, $result, $ttl);
			
		}
	
	}
	
	if( 'basic' == $layout ){
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' text-center">
				<div class="modal-instance">
					<a class="btn type--uppercase modal-trigger" href="#">&#9654; '. $button_text .'</a>
					<div class="modal-container">
						<div class="modal-content bg-dark" data-width="60%" data-height="60%">
							'. $result .'
						</div><!--end of modal-content-->
					</div><!--end of modal-container-->
				</div><!--end of modal instance-->
				<span class="block--xs">'. $text .'</span>
			</div>
		';
		
	} elseif( 'lozenge' == $layout ){
	
		$output = '
			<div class="'. esc_attr($custom_css_class) .' video video-1 boxed boxed--lg imagebg text-center-xs" data-overlay="2">
				<div class="background-image-holder">
					'. wp_get_attachment_image( $image, 'full' ) .'
				</div>
				<div class="modal-instance">
					<div class="video-play-icon video-play-icon--sm modal-trigger"></div>
					<div class="modal-container">
						<div class="modal-content bg-dark" data-width="60%" data-height="60%">
							'. $result .'
						</div><!--end of modal-content-->
					</div><!--end of modal-container-->
				</div><!--end of modal instance-->
				<h2>'. $text .'</h2>
			</div><!--end video-->
		';
	
	}  elseif( 'play' == $layout ){
	
		$output = '
			<div class="'. esc_attr($custom_css_class) .' video video-1 text-center">
				<div class="modal-instance">
					<div class="video-play-icon video-play-icon--sm modal-trigger box-shadow"></div>
					<div class="modal-container">
						<div class="modal-content bg-dark" data-width="60%" data-height="60%">
							'. $result .'
						</div><!--end of modal-content-->
					</div><!--end of modal-container-->
				</div><!--end of modal instance-->
				<h2>'. $text .'</h2>	
			</div>
		';
	
	}  elseif( 'play-small' == $layout ){
	
		$output = '
			<div class="'. esc_attr($custom_css_class) .' modal-instance block">
			    <div class="video-play-icon video-play-icon--sm modal-trigger"></div>
			    <span><strong>'. $button_text .'</strong>&nbsp;&nbsp;&nbsp;'. $text .'</span>
			    <div class="modal-container">
			        <div class="modal-content bg-dark" data-width="60%" data-height="60%">
			            '. $result .'
			        </div><!--end of modal-content-->
			    </div><!--end of modal-container-->
			</div><!--end of modal instance-->
		';
		
	} elseif( 'play-tiny' == $layout ){
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' modal-instance block">
                <div class="video-play-icon video-play-icon--xs modal-trigger bg--primary"></div>
                <span>'. $button_text .'</span>
                <div class="modal-container">
                    <div class="modal-content bg-dark" data-width="60%" data-height="60%">
                        '. $result .'
                    </div><!--end of modal-content-->
                </div><!--end of modal-container-->
            </div>
		';	
		
	} elseif( 'play-giant' == $layout ){
		
		$output = '
			<div class="modal-instance block">
                <div class="video-play-icon modal-trigger"></div>
                <div class="modal-container">
                    <div class="modal-content bg-dark" data-width="60%" data-height="60%">
                        '. $result .'
                    </div><!--end of modal-content-->
                </div><!--end of modal-container-->
            </div>
		';	
		
	}

	return $output;
}
add_shortcode( 'stack_video_modal', 'ebor_video_modal_shortcode' );

/**
 * The VC Functions
 */
function ebor_video_modal_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Video Modals", 'stackwordpresstheme'),
			"base" => "stack_video_modal",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Video Display Type", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => array(
						'Basic Button' => 'basic',
						'Play Button' => 'play',
						'Play Button Small' => 'play-small',
						'Play Button Tiny' => 'play-tiny',
						'Play Button Giant' => 'play-giant',
						'Image Background Lozenge' => 'lozenge'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'stackwordpresstheme'),
					"param_name" => "button_text"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Text", 'stackwordpresstheme'),
					"param_name" => "text"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Video Embed", 'stackwordpresstheme'),
					"param_name" => "embed",
					'description' => 'Enter link to video <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F">(Note: read more about available formats at WordPress codex page).</a>'
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Video Placeholder Image", 'stackwordpresstheme'),
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
add_action( 'vc_before_init', 'ebor_video_modal_shortcode_vc' );