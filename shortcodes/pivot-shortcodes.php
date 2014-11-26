<?php 

if(!( function_exists('ebor_pivot_button') )){
	function ebor_pivot_button( $atts ){
		extract(shortcode_atts(array(
			'url' => '#',
		    'appearance' => 'btn-primary',
		    'target' => '_self',
		    'text' => 'Default Button Text'
		), $atts ));
		
		if( 'default' == $target )
			$target = '_self';
			
		return '<a href="'. esc_url($url) .'" class="btn '. $appearance .'" target="'. $target .'">'. htmlspecialchars_decode($text) .'</a>';
	}
	add_shortcode('pivot_button','ebor_pivot_button');
}

if(!( function_exists('ebor_pivot_icon') )){
	function ebor_pivot_icon( $atts ){
		extract(shortcode_atts(array(
			'icon' => '',
			'size' => ''
		), $atts ));
		return '<i class="icon '. $icon.' '. $size .'"></i>';
	}
	add_shortcode('pivot_icon','ebor_pivot_icon');
}

if(!( function_exists('ebor_pivot_skill') )){
	function ebor_pivot_skill( $atts ){
		extract(shortcode_atts(array(
			'icon' => '',
			'title' => ''
		), $atts ));
		return '<div class="col-sm-4"><i class="icon '. $icon .' text-white"></i><h2 class="text-white">'. htmlspecialchars_decode($title) .'</h2></div>';
	}
	add_shortcode('pivot_skill','ebor_pivot_skill');
}

if(!( function_exists('ebor_pivot_countdown') )){
	function ebor_pivot_countdown( $atts ){
		extract(shortcode_atts(array(
			'date' => '2016/02/02',
		), $atts ));
		return '<div class="countdown" data-date="'. $date .'"></div>';
	}
	add_shortcode('pivot_countdown','ebor_pivot_countdown');
}