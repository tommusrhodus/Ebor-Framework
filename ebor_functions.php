<?php 

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
	        echo the_post_thumbnail( 'admin-list-thumb' );
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

/**
 * Add an additional link to the theme options on the dashboard
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_framework_add_customize_page_link') )){
	function ebor_framework_add_customize_page_link() {
		$theme = wp_get_theme();
		add_dashboard_page( $theme->get( 'Name' ) . ' Theme Options', $theme->get( 'Name' ) . ' Theme Options', 'edit_theme_options', 'customize.php' );
		add_dashboard_page( $theme->get( 'Name' ) . ' Theme Readme', $theme->get( 'Name' ) . ' Theme Readme', 'edit_theme_options', 'themes.php?page=ebor_framework-getting-started' );
	}
	add_action ('admin_menu', 'ebor_framework_add_customize_page_link');
}

/**
 * Ebor Load Favicons
 * Prints Custom Favicons to wp_head()
 * @since 1.0.0
 * @author TommusRhodus
 */
if(!( function_exists('ebor_framework_load_favicons') )){
	function ebor_framework_load_favicons() {
		if ( get_option('144_favicon') !=='' )
			echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="' . get_option('144_favicon') . '">';
		
		if ( get_option('114_favicon') !=='' )
			echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="' . get_option('114_favicon') . '">';
			
		if ( get_option('72_favicon') !=='' )
			echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="' . get_option('72_favicon') . '">';
			
		if ( get_option('mobile_favicon') !=='' )
			echo '<link rel="apple-touch-icon-precomposed" href="' . get_option('mobile_favicon') . '">';
			
		if ( get_option('custom_favicon') !=='' )
			echo '<link rel="shortcut icon" href="' . get_option('custom_favicon') . '">';
	}
	add_action('wp_head', 'ebor_framework_load_favicons');
}

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 * @since 1.0.0
 * @author _s theme
 */
if(!( function_exists('ebor_framework_wp_title') )){
	function ebor_framework_wp_title( $title, $sep ) {
		global $page, $paged;
	
		if ( is_feed() )
			return $title;
	
		// Add the blog name
		$title .= get_bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title .= " $sep $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			$title .= " $sep " . sprintf( __( 'Page %s', 'ebor-framework' ), max( $paged, $page ) );
	
		return $title;
	}
	add_filter( 'wp_title', 'ebor_framework_wp_title', 10, 2 );
}

add_filter('widget_text', 'do_shortcode');