<?php

/**
 * The Shortcode
 */
function ebor_toggles_shortcode( $atts, $content = null ) {
	global $ebor_type;
	$ebor_type = false;
	
	extract( 
		shortcode_atts( 
			array(
				'type' => 'standard'
			), $atts 
		) 
	);
	
	$ebor_type = $type;
	
	if( 'standard' == $type ) :
	?>
		
		<ul class="accordion"><?php echo do_shortcode($content); ?></ul>
		
	<?php else : ?>
		
		<div class="expanding-list">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
				
					<ul class="expanding-ul">
						
						<?php foreach( $tabs as $key => $tab ) : ?>
							<li>
								<div class="title">
									<i class="icon icon-pencil"></i>
									<span><?php echo wp_specialchars_decode($tab['title'], ENT_QUOTES); ?></span>
								</div>
								
								<div class="text-content">
									<?php echo wpautop(do_shortcode(wp_specialchars_decode($tab['content'], ENT_QUOTES))); ?>
								</div>
							</li>
						<?php endforeach; ?>
						
					</ul>
					
				</div>
			</div>
		</div>
	
	<?php 
		endif;

	return $output;
}
add_shortcode( 'pivot_toggles', 'ebor_toggles_shortcode' );

/**
 * The Shortcode
 */
function ebor_toggles_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);
	
	if( 'standard' == $ebor_type ){
		$output = '
			<li <?php echo ( 1 == $key) ? 'class="active"' : ''; ?>>
				<div class="title"><span>'. wp_specialchars_decode($title, ENT_QUOTES) .'</span></div>
				<div class="text">
					'. wpautop(do_shortcode(wp_specialchars_decode($content, ENT_QUOTES))) .'
				</div>
			</li>
		';
	}
	
	$output = '<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" class="panel-toggle '. esc_attr($active) .'" data-parent="#accordion-'. $rand .'" href="#collapse-'. $rand .'-'. esc_attr($ebor_toggles_count) .'">'. wp_specialchars_decode($title, ENT_QUOTES) .'</a>
						</h4>
					</div>
					<div id="collapse-'. $rand .'-'. esc_attr($ebor_toggles_count) .'" class="panel-collapse collapse '. esc_attr($in) .'">
						<div class="panel-body">'. wpautop(do_shortcode(wp_specialchars_decode($content, ENT_QUOTES))) .'</div>
					</div>
			   </div>';

	return $output;
}
add_shortcode( 'pivot_toggles_content', 'ebor_toggles_content_shortcode' );

// Parent Element
function ebor_toggles_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
		    'name'                    => __( 'Toggles' , 'pivot' ),
		    'base'                    => 'pivot_toggles',
		    'description'             => __( 'Create Accordion Content', 'pivot' ),
		    'as_parent'               => array('only' => 'pivot_toggles_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => __('pivot WP Theme', 'pivot'),
		    'params'          => array(
		    	array(
		    		"type" => "dropdown",
		    		"heading" => __("Display type", 'pivot'),
		    		"param_name" => "type",
		    		"value" => array_flip(array(
		    			'' => 'Standard',
		    			'bordered' => 'Bordered'
		    		))
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_toggles_shortcode_vc' );

// Nested Element
function ebor_toggles_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
		    'name'            => __('Toggles Content', 'pivot'),
		    'base'            => 'pivot_toggles_content',
		    'description'     => __( 'Toggle Content Element', 'pivot' ),
		    "category" => __('pivot WP Theme', 'pivot'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'pivot_toggles'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Title", 'pivot'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Block Content", 'pivot'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_toggles_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_pivot_toggles extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_pivot_toggles_content extends WPBakeryShortCode {}
}