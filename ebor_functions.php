<?php 

function ebor_framework_functions_backfill(){
	
	if(!( function_exists('ebor_get_portfolio_layouts') )){
		function ebor_get_portfolio_layouts(){
			return array('Please Switch to a TommusRhodus Theme for this feature' => 'Please Switch to a TommusRhodus Theme for this feature');	
		}
	}
	
	if(!( function_exists('ebor_get_testimonial_layouts') )){
		function ebor_get_testimonial_layouts(){
			return array('Please Switch to a TommusRhodus Theme for this feature' => 'Please Switch to a TommusRhodus Theme for this feature');	
		}
	}
	
	if(!( function_exists('ebor_get_blog_layouts') )){
		function ebor_get_blog_layouts(){
			return array('Please Switch to a TommusRhodus Theme for this feature' => 'Please Switch to a TommusRhodus Theme for this feature');	
		}
	}
	
	if(!( function_exists('ebor_get_team_layouts') )){
		function ebor_get_team_layouts(){
			return array('Please Switch to a TommusRhodus Theme for this feature' => 'Please Switch to a TommusRhodus Theme for this feature');	
		}
	}
	
	if(!( function_exists('ebor_get_shop_layouts') )){
		function ebor_get_shop_layouts(){
			return array('Please Switch to a TommusRhodus Theme for this feature' => 'Please Switch to a TommusRhodus Theme for this feature');	
		}
	}
	
	if(!( function_exists('ebor_get_testimonial_layouts') )){
		function ebor_get_testimonial_layouts(){
			return array('Please Switch to a TommusRhodus Theme for this feature' => 'Please Switch to a TommusRhodus Theme for this feature');	
		}
	}
	
}
add_action('after_setup_theme', 'ebor_framework_functions_backfill', 1);

function ebor_is_woocommerce() {
    if( function_exists( "is_woocommerce" ) && is_woocommerce())
    	return true;
    	
    $woocommerce_keys = array ( 
			"woocommerce_shop_page_id" ,
            "woocommerce_terms_page_id" ,
            "woocommerce_cart_page_id" ,
            "woocommerce_checkout_page_id" ,
            "woocommerce_pay_page_id" ,
            "woocommerce_thanks_page_id" ,
            "woocommerce_myaccount_page_id" ,
            "woocommerce_edit_address_page_id" ,
            "woocommerce_view_order_page_id" ,
            "woocommerce_change_password_page_id" ,
            "woocommerce_logout_page_id" ,
            "woocommerce_lost_password_page_id" 
     );
    foreach ( $woocommerce_keys as $wc_page_id ) {
        if ( get_the_ID () == get_option ( $wc_page_id , 0 ) )
                return true ;
    }
    return false;
}

/**
 * Portfolio taxonomy terms output.
 *
 * Checks that terms exist in the portfolio-category taxonomy, then returns a comma seperated string of results.
 * @todo Allow for taxonomy input for differing taxonmoies through the same function.
 * @since 1.0.0
 * @return string
 */
if(!( function_exists('ebor_the_terms') )){
	function ebor_the_terms( $cat, $sep, $value, $args = array() ) {
		
		global $post;
		
		$terms = get_the_terms($post->ID, $cat, '', $sep, '');
		
		if( is_array($terms) ) {
			foreach( $terms as $term ){
				$args[] = $value;	
			}
			$terms = array_map('_simple_cb', $terms, $args);
			return implode( $sep, $terms);
		}
		
	}
}

/**
 * ebor sanitize title
 * A replacement function for WordPress santize_title which breaks in Russian and other languages.
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_sanitize_title') )){
	function ebor_sanitize_title($string){
		$string = strtolower(str_replace(' ', '-', $string)); // Replaces all spaces with hyphens.
		$string = preg_replace('/[^A-Za-z\-]/', '', $string); // Removes special chars.
		return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
	}
}

/**
 * Term name return
 *
 * Returns the Pretty Name of a term array
 * @param $t - the term array object
 * @since 1.0.0
 * @return string
 */
if(!( function_exists('_simple_cb') )){
	function _simple_cb($t, $v) { 
		if( 'slug' == $v ){
			return $t->slug;
		} elseif( 'link' == $v ){
			return '<a href="'.get_term_link( $t, 'portfolio_category' ).'">'.$t->name.'</a>';
		} else { 
			return $t->name; 
		}
	}
}

if(!( function_exists('ebor_add_post_thumbnail_column') )){
	function ebor_add_post_thumbnail_column($cols){
	  $cols['ebor_post_thumb'] = __('Featured Image','ebor');
	  return $cols;
	}
}
add_filter('manage_posts_columns', 'ebor_add_post_thumbnail_column', 5);
add_filter('manage_pages_columns', 'ebor_add_post_thumbnail_column', 5);


if(!( function_exists('ebor_display_post_thumbnail_column') )){
	function ebor_display_post_thumbnail_column($col, $id){
	  switch($col){
	    case 'ebor_post_thumb':
	      if( function_exists('the_post_thumbnail') )
	        echo the_post_thumbnail( 'thumbnail' );
	      else
	        echo 'Not supported in theme';
	      break;
	  }
	}
}
add_action('manage_posts_custom_column', 'ebor_display_post_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'ebor_display_post_thumbnail_column', 5, 2);

/**
 * HEX to RGB Converter
 *
 * Converts a HEX input to an RGB array.
 * @param $hex - the inputted HEX code, can be full or shorthand, #ffffff or #fff
 * @since 1.0.0
 * @return string
 * @author tommusrhodus
 */
if(!( function_exists('ebor_hex2rgb') )){
	function ebor_hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);
	
	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
}

add_filter( 'widget_text', 'do_shortcode' );

/* Revolution Slider Error Message Tweak */
function tommusrhodus_revslider_missing_message( $output, $tag ) {
	if ( 'rev_slider' !== $tag ) {
		return $output;
	}
	if (strpos($output, 'not found.') !== false) {
		$output = str_replace('not found.', 'not found. <a style="color: white;" target="_blank" href="'. esc_url('https://www.tommusrhodus.com/how-to-import-revolution-slider-demo-data/') .'"><strong>Click here</strong></a> to learn how to import your demo sliders.', $output);
	}
	return $output;
}
add_filter('do_shortcode_tag', 'tommusrhodus_revslider_missing_message', 10, 2);