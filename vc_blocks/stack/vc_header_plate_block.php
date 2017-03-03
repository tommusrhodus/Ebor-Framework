<?php 

/**
 * The Shortcode
 */
function ebor_header_plate_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'text' => '',
				'image' => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	ob_start();
?>
	
	<div class="text-center <?php echo esc_attr($custom_css_class); ?>">
	
		<div class="heading-block">
		    <a href="<?php echo esc_url(home_url('/')); ?>">
		    	<?php echo wp_get_attachment_image( $image, 'large', 0, array('class' => 'image--sm') ); ?>
		    </a>
		</div>
		<h6 class="type--uppercase"><?php echo esc_html($text); ?></h6>
		
		<?php get_template_part('inc/content-header', 'social'); ?>
	
	</div>
	
<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_shortcode( 'stack_header_plate', 'ebor_header_plate_shortcode' );

/**
 * The VC Functions
 */
function ebor_header_plate_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Header Plate", 'stackwordpresstheme'),
			"base" => "stack_header_plate",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Logo", 'stackwordpresstheme'),
					"param_name" => "image"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", 'stackwordpresstheme'),
					"param_name" => "text"
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
add_action( 'vc_before_init', 'ebor_header_plate_shortcode_vc' );