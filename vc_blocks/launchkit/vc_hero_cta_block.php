<?php 

/**
 * The Shortcode
 */
function ebor_hero_cta_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'shortcode' => 'None',
				'alt_shortcode' => ''
			), $atts 
		) 
	);
	
	ob_start();
	
	$attachments = explode(',', $image);
	
	if(!( is_array( $attachments ) )){
		$attachments[0] = false;
	}
?>
	
	<div class="header header-1 fixed-header">
	
		<div class="background-image-holder">
			<?php echo wp_get_attachment_image( $attachments[0], 'full', 0, array('class' => 'background-image') ); ?>
		</div>

		<div class="container">
			<div class="row v-align-children">
				
				<div class="col-md-6 header-content">
					<?php echo wpautop(do_shortcode(htmlspecialchars_decode($content))); ?>
				</div>
				
				<?php if( !( 'None' == $shortcode ) && '' == $alt_shortcode ) : ?>
					<div class="col-md-6">
						<div class="inner">
							<?php echo do_shortcode('[contact-form-7 id="'. $shortcode .'"]'); ?>
						</div>
					</div>
				<?php endif; ?>
				
				<?php if( $alt_shortcode ) : ?>
					<div class="col-md-6">
						<div class="inner">
							<?php echo do_shortcode(htmlspecialchars_decode(rawurldecode(base64_decode($alt_shortcode)))); ?>
						</div>
					</div>
				<?php endif; ?>
				
			</div>
		</div>
	
	</div>
	
<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'launchkit_hero_cta', 'ebor_hero_cta_shortcode' );

/**
 * The VC Functions
 */
function ebor_hero_cta_shortcode_vc() {
	
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
			"name" => __("Hero Call To Action", 'launchkit'),
			"base" => "launchkit_hero_cta",
			"category" => __('LaunchKit WP Theme', 'launchkit'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("Background Image", 'launchkit'),
					"param_name" => "image",
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content", 'launchkit'),
					"param_name" => "content",
					"value" => '',
					'holder' => 'div'
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
add_action( 'vc_before_init', 'ebor_hero_cta_shortcode_vc' );