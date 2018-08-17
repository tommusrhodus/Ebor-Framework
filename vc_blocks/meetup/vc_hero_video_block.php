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
			), $atts 
		) 
	);
	
	$output = false;
	
	ob_start();
	
	//images
	$attachments = explode(',', $image);
	
	if(is_array($attachments)) :
?>

	<section class="hero-slider">
		<ul class="slides">
			<li class="video-header hero-slide">
				<div class="background-image-holder parallax-background">
					<?php echo wp_get_attachment_image( $attachments[0], 'full', 0, array('class' => 'background-image') ); ?>
				</div>
				
				<div class="video-wrapper">
					<video autoplay muted loop>
						<source src="<?php echo $webm; ?>" type="video/webm">
						<source src="<?php echo $mpfour; ?>" type="video/mp4">
						<source src="<?php echo $ogv; ?>" type="video/ogg">	
					</video>
				</div>
			
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center">
							<?php echo wpautop(do_shortcode(htmlspecialchars_decode($content))); ?>
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
			</li>
		</ul>
	</section>

<?php
	endif;
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'meetup_hero_video', 'ebor_hero_video_shortcode' );

/**
 * The VC Functions
 */
function ebor_hero_video_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'meetup-vc-block',
			"name" => __("Video Header", 'meetup'),
			"base" => "meetup_hero_video",
			"category" => __('Meetup - WP Theme', 'meetup'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("Fallback Image", 'meetup'),
					"param_name" => "image",
					"value" => '',
					"description" => __('Add a fallback image for mobile devices (required)', 'meetup')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video Background?, .webm extension", 'meetup'),
					"param_name" => "webm",
					"value" => '',
					"description" => __('Please fill all extensions', 'meetup')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video Background?, .mp4 extension", 'meetup'),
					"param_name" => "mpfour",
					"value" => '',
					"description" => __('Please fill all extensions', 'meetup')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video Background?, .ogv extension", 'meetup'),
					"param_name" => "ogv",
					"value" => '',
					"description" => __('Please fill all extensions', 'meetup')
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content", 'meetup'),
					"param_name" => "content",
					"value" => '',
					'holder' => 'div'
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_hero_video_shortcode_vc' );