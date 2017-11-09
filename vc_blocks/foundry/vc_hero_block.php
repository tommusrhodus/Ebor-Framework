<?php 

/**
 * The Shortcode
 */
function ebor_hero_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'image' => '',
				'layout' => 'intro-social',
				'embed' => '',
				'button_text' => '',
				'button_url' => '',
				'shortcode' => 'None',
				'parallax' => 'parallax'
			), $atts 
		) 
	);
	
	if( 'intro-app' == $layout ){
		
		$output = '
			<section class="bg-primary pb0 hero-header">
	            <div class="container pt80">
	            
	                <div class="row mb24 mb-xs-0">
	                    <div class="col-sm-10 col-sm-offset-1 text-center">
	                        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
	                    </div>
	                </div>
	    ';
		
		if( !( 'None' == $shortcode ) ){
			$output .= '
	            <div class="row mb80 mb-xs-24">
	                <div class="col-sm-6 col-sm-offset-3">
							'. do_shortcode('[contact-form-7 id="'. $shortcode .'"]') .'
	                </div>
	            </div>
		    ';
		}
	
		$output .= '
	                <div class="row">
	                    '. wp_get_attachment_image( $image, 'full' ) .'
	                </div>
	
	            </div>
	        </section>
		';
	
	} elseif( 'intro-social' == $layout ){
		
		$output = '
			<section class="cover fullscreen '. $parallax .' overlay image-bg hero-header">
			    <div class="background-image-holder">
			        '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			    </div>
			    <div class="container v-align-transform">
			        <div class="row">
			            <div class="col-sm-12 text-center">
			                '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			            </div>
			        </div>
			    </div>
			    <div class="align-bottom text-center">
			        <ul class="list-inline social-list mb24">
			            '. ebor_header_social_items() .'
			        </ul>
			    </div>
			</section>
		';
		
	} elseif( 'intro-left' == $layout ) {
		
		$output = '
			<section class="cover fullscreen image-slider slider-all-controls controls-inside '. $parallax .' hero-header">
			    <ul class="slides">
			        <li class="overlay image-bg">
			            <div class="background-image-holder">
			                '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			            </div>
			            <div class="container v-align-transform">
			                <div class="row">
			                    <div class="col-md-6 col-sm-8">
			                       '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			                    </div>
			                </div>
			            </div>
			        </li>
			    </ul>
			</section>
		';
		
	} elseif( 'intro-left-half' == $layout ) {
		
		$output = '
			<section class="image-bg overlay pt240 pb240 pt-xs-180 pb-xs-180 hero-header">
                <div class="background-image-holder fadeIn">
                    '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
                        </div>
                    </div>
                </div>
            </section>
		';
		
	} elseif( 'intro-form' == $layout ) {
		
		$output = '
			<section class="cover fullscreen image-slider slider-all-controls controls-inside '. $parallax .' hero-header">
			    <ul class="slides">
			        <li class="overlay image-bg">
			            <div class="background-image-holder">
			                '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			            </div>
			            <div class="container v-align-transform">
			                <div class="row">
			                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center">
			                        '. wpautop(do_shortcode(htmlspecialchars_decode($content)));
			                        
        if( !( 'None' == $shortcode ) ){
        	$output .= do_shortcode('[contact-form-7 id="'. $shortcode .'"]');
        }
			                        
		$output .= '
			                    </div>
			                </div>
			            </div>
			        </li>
			    </ul>
			</section>
		';
		
	} elseif( 'intro-button' == $layout ) {
		
		$output = '
			<section class="fullscreen image-bg background-multiply '. $parallax .' hero-header">
			    <div class="background-image-holder">
			        '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			    </div>
			    <div class="container v-align-transform">
			        <div class="row">
			            <div class="col-sm-12 text-center">
			                '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			            </div>
			        </div>
			    </div>
			    <div class="align-bottom text-center">
			        <a class="btn btn-white mb32" href="'. esc_url($button_url) .'">'. $button_text .'</a>
			        <ul class="list-inline social-list mb24">
			            '. ebor_header_social_items() .'
			        </ul>
			    </div>
			</section>
		';
	
	} elseif( 'intro-button-alt' == $layout ) {
		
		$output = '
			<section class="fullscreen image-bg overlay '. $parallax .' hero-header">
			    <div class="background-image-holder">
			        '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			    </div>
			    <div class="container v-align-transform">
			        <div class="row">
			            <div class="col-sm-12 text-center">
			                '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			            </div>
			        </div>
			    </div>
			    <div class="align-bottom text-center">
			        <a class="btn btn-filled btn-lg mb32 mt-xs-40" href="'. esc_url($button_url) .'">'. $button_text .'</a>
			    </div>
			</section>
		';
		
	} elseif( 'intro-bottom-left' == $layout ) {
		
		$output = '
			<section class="cover fullscreen image-slider slider-all-controls controls-inside '. $parallax .' hero-header">
			    <ul class="slides">
			        <li class="overlay image-bg">
			            <div class="background-image-holder">
			                '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			            </div>
			            <div class="align-bottom">
			                <div class="row">
			                    <div class="col-md-4 col-sm-6">
			                        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			                        <hr>
			                        <ul class="list-inline social-list mb8">
			                            '. ebor_header_social_items() .'
			                        </ul>
			                    </div>
			                </div>
			            </div>
			        </li>
			    </ul>
			</section>
		';
		
	} elseif( 'intro-video-top' == $layout ) {
		
		$output = '
			<section class="cover fullscreen image-slider slider-all-controls controls-inside '. $parallax .' hero-header">
			    <ul class="slides">
			        <li class="overlay">
			            <div class="background-image-holder">
			                '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			            </div>
			            <div class="container v-align-transform">
			                <div class="row">
			                    <div class="col-sm-12 text-center">
			                        <div class="modal-video-container mb24">
			                            <div class="play-button large inline"></div>
			                            <div class="modal-video">
			                                <i class="ti-close close-iframe"></i>
			                                '. wp_oembed_get($embed) .'
			                            </div>
			                        </div>
			                        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			                    </div>
			                </div>
			            </div>
			        </li>
			    </ul>
			</section>
		';
		
	} elseif( 'intro-centered' == $layout ) {
		
		$output = '
			<section class="cover fullscreen image-slider slider-arrow-controls controls-inside '. $parallax .' hero-header">
			    <ul class="slides">
			        <li class="overlay image-bg">
			            <div class="background-image-holder">
			                '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			            </div>
			            <div class="container v-align-transform">
			                <div class="row">
			                    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
			                        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			                    </div>
			                </div>
			            </div>
			        </li>
			    </ul>
			</section>
		';
		
	} elseif( 'intro-centered-social' == $layout ) {
		
		$output = '
			<section class="pt240 pb240 '. $parallax .' image-bg overlay bg-light hero-header">
			    <div class="background-image-holder">
			        '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			    </div>
			    <div class="container">
			        <div class="row">
			            <div class="col-sm-12 text-center">
			                '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			            </div>
			        </div>
			   </div>
			    <div class="align-bottom text-center">
			        <ul class="list-inline social-list mb24">
			            '. ebor_header_social_items() .'
			        </ul>
			    </div>
			</section>
		';
		
	} elseif( 'intro-video-bottom' == $layout ) {
		
		$output = '
			<section class="cover fullscreen image-slider slider-arrow-controls controls-inside '. $parallax .' hero-header">
			    <ul class="slides">
			        <li class="overlay image-bg">
			            <div class="background-image-holder">
			                '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			            </div>
			            <div class="container v-align-transform">
			                <div class="row">
			                    <div class="col-sm-12 text-center">
			                        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			                        <div class="modal-video-container">
			                            <div class="play-button inline"></div>
			                            <div class="modal-video">
			                                <i class="ti-close close-iframe"></i>
			                                '. wp_oembed_get($embed) .'
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </li>
			    </ul>
			</section>
		';
		
	} elseif( 'intro-video-bottom-left' == $layout ) {
		
		$output = '
			<section class="cover fullscreen image-slider slider-arrow-controls controls-inside '. $parallax .' hero-header">
			    <ul class="slides">
			        <li class="overlay image-bg">
			            <div class="background-image-holder">
			                '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			            </div>
			            <div class="container v-align-transform">
			                <div class="row">
			                    <div class="col-md-6 col-sm-12">
			                        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			                        <div class="modal-video-container">
			                            <div class="play-button inline"></div>
			                            <div class="modal-video">
			                                <i class="ti-close close-iframe"></i>
			                                '. wp_oembed_get($embed) .'
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </li>
			    </ul>
			</section>
		';
		
	} elseif( 'intro-left-dark' == $layout ) {
		
		$output = '
			<section class="cover fullscreen image-slider slider-arrow-controls controls-inside '. $parallax .' hero-header">
			    <ul class="slides">
			        <li class="overlay image-bg bg-light">
			            <div class="background-image-holder">
			                '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			            </div>
			            <div class="container v-align-transform">
			                <div class="row">
			                    <div class="col-md-6 col-sm-8">
			                        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			                    </div>
			                </div>
			            </div>
			        </li>
			    </ul>
			</section>
		';
		
	} elseif( 'intro-everything' == $layout ) {
		
		$output = '
			<section class="fullscreen cover '. $parallax .' image-bg overlay hero-header">
			    <div class="background-image-holder">
			        '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			    </div>
			    <div class="container v-align-transform">
			        <div class="row">
			            <div class="col-sm-12 text-center">
			                '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			                <div class="modal-video-container mb0">
			                    <div class="play-button inline large mt-xs-0"></div>
			                    <div class="modal-video">
			                        <i class="ti-close close-iframe"></i>
			                        '. wp_oembed_get($embed) .'
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			    <div class="align-bottom text-center hidden-xs">
			        <a class="btn btn-white mb32" href="'. esc_url($button_url) .'">'. $button_text .'</a>
			        <ul class="list-inline social-list mb24">
			            '. ebor_header_social_items() .'
			        </ul>
			    </div>
			</section>
		';
		
	} elseif( 'intro-video-right' == $layout ) {
		
		$output = '
			<section class="pt120 pb120 image-bg overlay hero-header">
			    <div class="background-image-holder">
			        '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			    </div>
			    <div class="container">
			        <div class="row v-align-children">
			            <div class="col-sm-8 mb-xs-80">
			                '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			            </div>
			            <div class="col-sm-4 text-center text-left-xs">
			                <div class="modal-video-container">
			                    <div class="play-button large inline"></div>
			                    <div class="modal-video">
			                        <i class="ti-close close-iframe"></i>
			                        '. wp_oembed_get($embed) .'
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</section>
		';
		
	}
	
	return $output;
}
add_shortcode( 'foundry_hero', 'ebor_hero_shortcode' );

/**
 * The VC Functions
 */
function ebor_hero_shortcode_vc() {
	
	$icons = ebor_get_icons();
	
	$args = array(
		'post_type' => 'wpcf7_contact_form',
		'posts_per_page' => -1
	);
	$form_options = get_posts( $args );
	$forms[0] = 'None';
	
	foreach( $form_options as $form_option ){
		$forms[$form_option->post_title] = $form_option->ID;
	}
	
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Hero Header", 'foundry'),
			"base" => "foundry_hero",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __("Icon Box Display Type", 'foundry'),
					"param_name" => "layout",
					"value" => array(
						'Hero Social' => 'intro-social',
						'Hero Left Align Text' => 'intro-left',
						'Hero Left Align Text (HalfHeight)' => 'intro-left-half',
						'Hero Left Align Dark Text' => 'intro-left-dark',
						'Hero Contact Form' => 'intro-form',
						'Hero Call To Action' => 'intro-button',
						'Hero Call To Action Alternate' => 'intro-button-alt',
						'Hero Bottom Left Text' => 'intro-bottom-left',
						'Hero Video Modal Top' => 'intro-video-top',
						'Hero Video Modal Right' => 'intro-video-right',
						'Hero Video Modal Bottom' => 'intro-video-bottom',
						'Hero Video Modal Bottom, Text Left' => 'intro-video-bottom-left',
						'Hero Centered Text' => 'intro-centered',
						'Hero Centered Text & Social' => 'intro-centered-social',
						'Hero Application Header' => 'intro-app',
						'Hero Video, Call to Action & Social' => 'intro-everything'
					)
				),
				array(
					"type" => "attach_image",
					"heading" => __("Slide Image", 'foundry'),
					"param_name" => "image"
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Block Content", 'foundry'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Video Embed", 'foundry'),
					"param_name" => "embed",
					'description' => 'Enter link to video <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F">(Note: read more about available formats at WordPress codex page).</a>'
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Text", 'foundry'),
					"param_name" => "button_text"
				),
				array(
					"type" => "textfield",
					"heading" => __("Button URL", 'foundry'),
					"param_name" => "button_url"
				),
				array(
					"type" => "dropdown",
					"heading" => __("Contact Form 7 Form", 'foundry'),
					"param_name" => "shortcode",
					"description" => __('Enter a Contact Form 7 Shortcode if required.', 'foundry'),
					'value' => $forms
				),
				array(
					"type" => "dropdown",
					"heading" => __("Use Parallax Scrolling on this element?", 'foundry'),
					"param_name" => "parallax",
					"value" => array(
						'Parallax On' => 'parallax',
						'Parallax Off' => 'parallax-off'
					),
					'description' => 'Parallax scrolling works best when this element is at the top of a page, if it isn\'t, turn this off so the element displays at its best.'
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_hero_shortcode_vc' );