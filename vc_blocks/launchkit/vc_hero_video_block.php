<?php 

/**
 * The Shortcode
 */
function ebor_hero_video_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'mpfour' => '',
				'ogv' => '',
				'webm' => '',
				'shortcode' => 'None',
				'alt_shortcode' => '',
				'layout' => 'modal',
				'photo' => ''
			), $atts 
		) 
	);
	
	$output = false;
	
	ob_start();
	
	//images
	$attachments = explode(',', $image);
	$images = explode(',', $photo);
	
	if(is_array($attachments)) :
?>
	
	<section class="header header-5 parallax">
		<div class="background-image-holder">
			<?php echo wp_get_attachment_image( $attachments[0], 'full', 0, array('class' => 'background-image') ); ?>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center ebor-slider-content">
					<?php echo wpautop(do_shortcode(htmlspecialchars_decode($content))); ?>
				</div>
			</div>
		</div>
		
		<?php if( $webm && $mpfour && $ogv ) : ?>
		
			<?php if(!( 'modal' == $layout )) : ?>
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<div class="local-video-container">
								<div class="background-image-holder fadeIn">
									<?php echo wp_get_attachment_image( $images[0], 'full', 0, array('class' => 'background-image') ); ?>
								</div>
								<video controls="">
									<source src="<?php echo $webm; ?>" type="video/webm">
									<source src="<?php echo $mpfour; ?>" type="video/mp4">
									<source src="<?php echo $ogv; ?>" type="video/ogg">	
								</video>
								<div class="play-button"></div>
							</div>
						</div>
					</div>
				</div>
			<?php else : ?>
				<div class="modal-video-container">
					<div class="play-button large"></div>
					<div class="modal-video">
						<video controls="">
							<source src="<?php echo $webm; ?>" type="video/webm">
							<source src="<?php echo $mpfour; ?>" type="video/mp4">
							<source src="<?php echo $ogv; ?>" type="video/ogg">	
						</video>
					</div>
				</div>
			<?php endif; ?>
			
			
		<?php endif; ?>
		
		<?php if( !( 'None' == $shortcode ) && '' == $alt_shortcode ) : ?>
			<div class="form-holder">
				<?php echo do_shortcode('[contact-form-7 id="'. $shortcode .'"]'); ?>
			</div>	
		<?php endif; ?>
		
		<?php if( $alt_shortcode ) : ?>
			<div class="form-holder">
				<?php echo do_shortcode(htmlspecialchars_decode(rawurldecode(base64_decode($alt_shortcode)))); ?>
			</div>
		<?php endif; ?>
				
	</section>

<?php
	endif;
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'launchkit_hero_video', 'ebor_hero_video_shortcode' );

/**
 * The VC Functions
 */
function ebor_hero_video_shortcode_vc() {
	
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
			"icon" => 'launchkit-vc-block',
			"name" => __("Hero Call To Action Video", 'launchkit'),
			"base" => "launchkit_hero_video",
			"category" => __('LaunchKit WP Theme', 'launchkit'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("Header Background Image", 'launchkit'),
					"param_name" => "image"
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content", 'launchkit'),
					"param_name" => "content",
					"value" => '',
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video Background?, .webm extension", 'launchkit'),
					"param_name" => "webm",
					"value" => '',
					"description" => __('Please fill all extensions', 'launchkit')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video Background?, .mp4 extension", 'launchkit'),
					"param_name" => "mpfour",
					"value" => '',
					"description" => __('Please fill all extensions', 'launchkit')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video Background?, .ogv extension", 'launchkit'),
					"param_name" => "ogv",
					"value" => '',
					"description" => __('Please fill all extensions', 'launchkit')
				),
				array(
					"type" => "attach_image",
					"heading" => __("Non Modal Video Background Image", 'launchkit'),
					"param_name" => "photo"
				),
				array(
					"type" => "dropdown",
					"heading" => __("Video Area Layout", 'launchkit'),
					"param_name" => "layout",
					'value' => array(
						'Video in Modal Popup' => 'modal',
						'Video in Header' => 'local'
					)
				),
				array(
					"type" => "dropdown",
					"heading" => __("Contact Form 7 Form", 'launchkit'),
					"param_name" => "shortcode",
					"description" => __('Enter a Contact Form 7 Shortcode if required.', 'launchkit'),
					'value' => $forms
				),
				array(
					"type" => "textarea_raw_html",
					"heading" => __("Alternate Shortcode or HTML", 'launchkit'),
					"param_name" => "alt_shortcode",
					'description' => 'Use this area for an alternate form shortcode or Raw HTML. Note this option will override the contact form 7 option if used.'
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_hero_video_shortcode_vc' );