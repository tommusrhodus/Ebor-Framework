<?php 

/**
 * The Shortcode
 */
function ebor_pricing_table_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'subtitle' => '',
				'text' => '',
				'currency' => '$',
				'amount' => '3',
				'duration' => 'year',
				'button_text' => 'Sign Up',
				'button_url' => '',
				'icon' => '',
				'layout' => 'white-box',
				'color' => ''
			), $atts 
		) 
	);
	
	$icon_color = $button_color = '';
	$lines = explode( ',', $text );
	
	if( 'white-box' == $layout ){
		
		if( $color ){
			$icon_color = 'style="color: '. $color.'"';	
			$button_color = 'style="background-color: '. $color.'"';	
		}
	
		$output = '
			<div class="pricing panel box box-bg bg-white">
			
				<div class="panel-heading">
		';
		
		if( $icon ){
			$output .= '
				<div class="icon icon-color icon-m" '. $icon_color .'>
					<i class="'. esc_attr($icon) .'"></i>
				</div>
			';
		}
		
		$output .= '			
					<h3 class="panel-title color-dark">
						'. htmlspecialchars_decode($title) .' 
						<span class="meta panel-desc">'. htmlspecialchars_decode($subtitle) .'</span>
					</h3>
					
					<div class="price color-dark"> 
						<span class="price-currency">'. htmlspecialchars_decode($currency) .'</span> 
						<span class="price-value">'. htmlspecialchars_decode($amount) .'</span> 
						<span class="price-duration">'. htmlspecialchars_decode($duration) .'</span>
					</div>
					
				</div><!--/.panel-heading -->
				
				<div class="panel-body">
					<table class="table">';
				
		if( is_array($lines) ){
			foreach($lines as $key => $line){
				$output .= '
					<tr>
					  <td>'. htmlspecialchars_decode($line) .' </td>
					</tr>
				';
			}
		}
				
		$output .= '
				</table>
				</div><!--/.panel-body -->
				
				<div class="panel-footer"> 
					<a href="'. esc_url($button_url) .'" class="btn btn-rounded" role="button" '. $button_color .'>'. htmlspecialchars_decode($button_text) .'</a>
				</div>
			
			</div><!--/.pricing --> 
		';
	
	} elseif( 'color-box' == $layout ){
		
		if( $color ){
			$button_color = 'style="background-color: '. $color.'"';	
		}
	
		$output = '
			<div class="pricing panel box box-bg inverse-text" '. $button_color .'>
			
				<div class="panel-heading">
		';
		
		if( $icon ){
			$output .= '
				<div class="icon icon-color icon-m">
					<i class="'. esc_attr($icon) .'"></i>
				</div>
			';
		}
		
		$output .= '			
					<h3 class="panel-title color-dark pb-0">'. htmlspecialchars_decode($title) .'</h3>
					
					<div class="price color-dark"> 
						<span class="price-currency">'. htmlspecialchars_decode($currency) .'</span> 
						<span class="price-value">'. htmlspecialchars_decode($amount) .'</span> 
						<span class="price-duration">'. htmlspecialchars_decode($duration) .'</span>
					</div>
					
				</div><!--/.panel-heading -->
				
				<div class="panel-body">
					<table class="table">';
				
		if( is_array($lines) ){
			foreach($lines as $key => $line){
				$output .= '
					<tr>
					  <td>'. htmlspecialchars_decode($line) .' </td>
					</tr>
				';
			}
		}
				
		$output .= '
				</table>
				</div><!--/.panel-body -->
				
				<div class="panel-footer"> 
					<a href="'. esc_url($button_url) .'" class="btn btn-rounded btn-border btn-white" role="button">'. htmlspecialchars_decode($button_text) .'</a>
				</div>
			
			</div><!--/.pricing --> 
		';
			
	} else {
		
		$output = '
			<div class="pricing panel box border">
			
				<div class="panel-heading">
		';
		
		if( $icon ){
			$output .= '
				<div class="icon icon-color icon-m">
					<i class="'. esc_attr($icon) .'"></i>
				</div>
			';
		}
		
		$output .= '			
					<h3 class="panel-title color-dark pb-0">'. htmlspecialchars_decode($title) .'</h3>
					
					<div class="price color-dark"> 
						<span class="price-currency">'. htmlspecialchars_decode($currency) .'</span> 
						<span class="price-value">'. htmlspecialchars_decode($amount) .'</span> 
						<span class="price-duration">'. htmlspecialchars_decode($duration) .'</span>
					</div>
					
				</div><!--/.panel-heading -->
				
				<div class="panel-body">
					<table class="table">';
				
		if( is_array($lines) ){
			foreach($lines as $key => $line){
				$output .= '
					<tr>
					  <td>'. htmlspecialchars_decode($line) .' </td>
					</tr>
				';
			}
		}
				
		$output .= '
				</table>
				</div><!--/.panel-body -->
				
				<div class="panel-footer"> 
					<a href="'. esc_url($button_url) .'" class="btn btn-rounded" role="button">'. htmlspecialchars_decode($button_text) .'</a>
				</div>
			
			</div><!--/.pricing --> 
		';
			
	}
	
	return $output;
}
add_shortcode( 'creatink_pricing_table', 'ebor_pricing_table_shortcode' );

/**
 * The VC Functions
 */
function ebor_pricing_table_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_values(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
			"name" => esc_html__("Pricing Table", 'creatink'),
			"base" => "creatink_pricing_table",
			"category" => esc_html__('creatink WP Theme', 'creatink'),
			'description' => 'Add a pricing table to the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'creatink'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", 'creatink'),
					"param_name" => "subtitle"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Currency", 'creatink'),
					"param_name" => "currency",
					"value" => '$',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Amount", 'creatink'),
					"param_name" => "amount",
					"value" => '3',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Duration", 'creatink'),
					"param_name" => "duration",
					"value" => 'Year',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'creatink'),
					"param_name" => "button_text",
					"value" => 'Select Plan',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button URL", 'creatink'),
					"param_name" => "button_url"
				),
				array(
					"type" => "exploded_textarea",
					"heading" => esc_html__("Pricing details, one per line", 'creatink'),
					"param_name" => "text"
				),
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'creatink'),
					"param_name" => "icon",
					"value" => $icons
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Icon Colour", 'creatink'),
					"param_name" => "color",
					'description' => 'Leave blank for default colour, make selection for custom colour',
					'value' => ''
				),
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__("Display type", 'creatink'),
					"param_name" => "layout",
					"value"      => array(
						'White Boxed Table' => 'white-box',
						'Color Boxed Table' => 'color-box',
						'Bordered Table'    => 'border-box'
					)
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_pricing_table_shortcode_vc' );