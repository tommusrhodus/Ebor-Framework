<?php 

if(!( function_exists('ebor_tooltip') )){
	function ebor_tooltip( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'location' => 'top',
			'title' => 'Tooltip on top',
			'link' => '#'
		), $atts));	
		
		return '<a href="'. esc_url($link) .'" title="'. $title .'" data-rel="tooltip" data-placement="' . $location . '">' . $content . '</a>';
	}
	add_shortcode('tooltip', 'ebor_tooltip');
}

if(!( function_exists('ebor_button') )){
	//Button [button link='google.com' size='large' color='blue' target='blank']Link Text[/button]
	function ebor_button( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'link' => '',
			'size' => '',
			'color' => 'green',
			'target' => ''
		), $atts));
		if($size == 'large') $size = 'btn-large';
		if($target == 'blank') $target = 'target="_blank"';
	    return '<a href="' . esc_url($link) . '" '.$target.' class="btn '.$size.' btn-'.$color.'">' . htmlspecialchars_decode($content) . '</a>';
	}
	add_shortcode('button', 'ebor_button');
}

if(!( function_exists('ebor_dropcap') )){
	//DROPCAP [dropcap]Content[/dropcap]
	function ebor_dropcap( $atts, $content = null ) {
	   return '<span class="dropcap">' . do_shortcode($content) . '</span>';
	}
	add_shortcode('dropcap', 'ebor_dropcap');
}

if(!( function_exists('ebor_blockquote') )){
	//BLOCKQUOTE [blockquote author='John Doe']Content[/blockquote]
	function ebor_blockquote( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'author' => ''
		), $atts));
	   return '<blockquote>' . do_shortcode($content) . '<small>'.$author.'</small></blockquote>';
	}
	add_shortcode('blockquote', 'ebor_blockquote');
}