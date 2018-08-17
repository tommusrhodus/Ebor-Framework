<?php 

/**
 * The Shortcode
 */
function ebor_hero_slider_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'shortcode' => ''
			), $atts 
		) 
	);
	
	$output = false;
	
	ob_start();
	
	//images
	$attachments = explode(',', $image);
	$class = ($shortcode) ? 'col-md-6 col-sm-6' : 'col-md-12 col-sm-12';
	
	if(is_array($attachments)) :
?>

	<section class="hero-slider register-header">
		<ul class="slides">
			
			<?php foreach( $attachments as $attachment ) : ?>
			
				<li class="hero-slide">
					<div class="background-image-holder parallax-background">
						<?php echo wp_get_attachment_image( $attachment, 'full', 0, array('class' => 'background-image') ); ?>
					</div>
				
					<div class="container">
						<div class="row">
						
							<div class="<?php echo esc_attr($class); ?>">
								<?php echo wpautop(do_shortcode(htmlspecialchars_decode($content))); ?>
							</div>
							
							<?php if($shortcode): ?>
								<div class="col-md-5 col-md-offset-1 col-sm-6">
									<?php echo do_shortcode(htmlspecialchars_decode(rawurldecode(base64_decode( $shortcode )))); ?>
								</div>
							<?php endif; ?>
							
						</div><!--end of row-->
					</div><!--end of container-->
				</li>
			
			<?php endforeach; ?>
	
		</ul>
	</section>

<?php
	endif;
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'meetup_hero_slider', 'ebor_hero_slider_shortcode' );

/**
 * The VC Functions
 */
function ebor_hero_slider_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'meetup-vc-block',
			"name" => __("Hero Slider", 'meetup'),
			"base" => "meetup_hero_slider",
			"category" => __('Meetup - WP Theme', 'meetup'),
			"params" => array(
				array(
					"type" => "attach_images",
					"heading" => __("Slider Images", 'meetup'),
					"param_name" => "image",
					"value" => '',
					"description" => __('Add images to show in the slider, always add an image for the background', 'meetup')
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content", 'meetup'),
					"param_name" => "content",
					"value" => '',
					'holder' => 'div'
				),
				array(
					"type" => "textarea_raw_html",
					"heading" => __("Shortcodes, buttons etc.", 'meetup'),
					"param_name" => "shortcode",
					"value" => '',
					"description" => ''
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_hero_slider_shortcode_vc' );