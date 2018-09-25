<?php 

/**
 * The Shortcode
 */
function ebor_contact_form_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'subtitle' => '',
				'small' => '',
				'background' => '',
				'image' => '',
				'form' => ''
			), $atts 
		) 
	);
	
	$output = '<div class="row"><article class="col-md-6 dark-bg text-center contact-dual-panel"><div id="contact-form-wrap"><div class="contact-item pad-common">';
	$output .= do_shortcode('[contact-form-7 id="'. $form .'"]');
	$output .= '</div></div></article>';
	
	$output .= '<article class="col-md-6 text-center white-bg contact-dual-panel"><div class="valign">';
	      
	if($title)
		$output .= '<h1 class="email-heading color font2"><span>'. htmlspecialchars_decode($title) .'</span></h1>' . ebor_expose_seperator(3);
		
	if($subtitle)
		$output .= '<h6 class="dark font3">'. htmlspecialchars_decode($subtitle) .'</h6>';
		
	if($small)
		$output .= '<h6 class="dark font2">'. htmlspecialchars_decode($small) .'</h6>';
		
	$output .= '</div></article></div>';
	
	return $output;

}
add_shortcode( 'expose_contact_form', 'ebor_contact_form_shortcode' );

/**
 * The VC Functions
 */
function ebor_contact_form_shortcode_vc() {
	$args = array(
		'post_type' => 'wpcf7_contact_form',
		'posts_per_page' => -1
	); 
	$posts = get_posts( $args );
	$contact_forms = false;
	foreach($posts as $cf){
		$contact_forms[$cf->ID] = $cf->post_title;
	}
	
	vc_map( 
		array(
			"icon" => 'expose-vc-block',
			"name" => __("Contact Form", 'expose'),
			"base" => "expose_contact_form",
			"category" => __('Expose WP Theme', 'expose'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'expose'),
					"param_name" => "title",
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'expose'),
					"param_name" => "subtitle",
				),
				array(
					"type" => "textfield",
					"heading" => __("Small Text", 'expose'),
					"param_name" => "small",
				),
				array(
					"type" => "dropdown",
					"heading" => __("Contact Form", 'Expose'),
					"param_name" => "form",
					"value" => array_flip($contact_forms)
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_contact_form_shortcode_vc' );