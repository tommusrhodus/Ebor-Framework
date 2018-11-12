<?php 

/**
 * The Shortcode
 */
function ebor_gallery_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts(
			array(
				'image' => ''
			), $atts 
		) 
	);
	
	ob_start();
	
	$attachments = explode(',', $image);
	
	if( $attachments[0] && $attachments[1] && $attachments[2] ) :	
?>

	<div class="text-center">
		<ul class="hover-gallery text-center" speed="2000">
			<li>
				<?php echo wp_get_attachment_image( $attachments[0], 'full' ); ?>
			</li>
			<li class="active">
				<?php echo wp_get_attachment_image( $attachments[1], 'full' ); ?>
			</li>
			<li>
				<?php echo wp_get_attachment_image( $attachments[2], 'full' ); ?>
			</li>
		</ul>
	</div>
	
<?php
	endif;
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'launchkit_gallery', 'ebor_gallery_shortcode' );

/**
 * The VC Functions
 */
function ebor_gallery_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
			"name" => __("Hover Gallery", 'launchkit'),
			"base" => "launchkit_gallery",
			"category" => __('LaunchKit WP Theme', 'launchkit'),
			"params" => array(
				array(
					"type" => "attach_images",
					"heading" => __("Gallery Images (Use 3)", 'launchkit'),
					"param_name" => "image",
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_gallery_shortcode_vc' );