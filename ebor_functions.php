<?php 

/**
 * Portfolio taxonomy terms output.
 *
 * Checks that terms exist in the portfolio-category taxonomy, then returns a comma seperated string of results.
 * @todo Allow for taxonomy input for differing taxonmoies through the same function.
 * @since 1.0.0
 * @return string
 */
if(!( function_exists('ebor_the_simple_terms') )){
	function ebor_the_simple_terms() {
	global $post;
		if( get_the_terms($post->ID,'portfolio-category') !='' ) {
			$terms = get_the_terms($post->ID,'portfolio-category','',', ','');
			$terms = array_map('_simple_cb', $terms);
			return implode(', ', $terms);
		}
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
	function _simple_cb($t) {  return $t->name; }
}

/**
 * Portfolio taxonomy terms output.
 *
 * Checks that terms exist in the portfolio-category taxonomy, then returns a space seperated string of results.
 * @todo Allow for taxonomy input for differing taxonmoies through the same function.
 * @since 1.0.0
 * @return string
 */
if(!( function_exists('ebor_the_isotope_terms') )){
	function ebor_the_isotope_terms() {
	global $post;
		if( get_the_terms($post->ID,'portfolio-category') ) {
			$terms = get_the_terms($post->ID,'portfolio-category','','','');
			$terms = array_map('_isotope_cb', $terms);
			return implode(' ', $terms);
		}
	}
}

/**
 * Term Slug Return
 *
 * Returns the slug of a term array
 * @param $t - the term array object
 * @since 1.0.0
 * @return string
 */
if(!( function_exists('_isotope_cb') )){
	function _isotope_cb($t) {  return $t->slug; }
}


/**
 * Portfolio taxonomy terms output.
 *
 * Checks that terms exist in the portfolio-category taxonomy, then returns a comma seperated string of results.
 * @todo Allow for taxonomy input for differing taxonmoies through the same function.
 * @since 1.0.0
 * @return string
 */
if(!( function_exists('ebor_the_simple_terms_links') )){
	function ebor_the_simple_terms_links() {
	global $post;
		if( get_the_terms($post->ID,'portfolio-category') ) {
			$terms = get_the_terms($post->ID,'portfolio-category','',', ','');
			$terms = array_map('_simple_link', $terms);
			return implode(', ', $terms);
		}
	}
}

add_action('login_head','ebor_custom_admin');
function ebor_custom_admin(){
	if( get_option('custom_login_logo') )
		echo '<style type="text/css">
				.login h1 a { 
					background-image: url("'.get_option('custom_login_logo').'"); 
					background-size: auto 80px;
					width: 100%; 
				} 
			</style>';
}

if(!( function_exists('ebor_framework_custom_css') )){
	function ebor_framework_custom_css(){
		echo '<style type="text/css">'. get_option('custom_css') .'</style>';
	}
	add_action('wp_head','ebor_framework_custom_css', 200);
}

/**
 * Term name return
 *
 * Returns the Pretty Name of a term array
 * @param $t - the term array object
 * @since 1.0.0
 * @return string
 */
if(!( function_exists('_simple_link') )){
	function _simple_link($t) {  return '<a href="'.get_term_link( $t, 'portfolio-category' ).'">'.$t->name.'</a>'; }
}

if(!( function_exists('ebor_add_post_thumbnail_column') )){
	function ebor_add_post_thumbnail_column($cols){
		$cols['ebor_post_thumb'] = __('Featured Image','ebor');
		return $cols;
	}
	add_filter('manage_posts_columns', 'ebor_add_post_thumbnail_column', 5);
	add_filter('manage_pages_columns', 'ebor_add_post_thumbnail_column', 5);
}

if(!( function_exists('ebor_display_post_thumbnail_column') )){
	function ebor_display_post_thumbnail_column($col, $id){
		if( $col == 'ebor_post_thumb' ){
			if( function_exists('the_post_thumbnail') )
				echo the_post_thumbnail( 'admin-list-thumb' );
		} else {
			echo 'Not supported in theme';
		}
	}
	add_action('manage_posts_custom_column', 'ebor_display_post_thumbnail_column', 5, 2);
	add_action('manage_pages_custom_column', 'ebor_display_post_thumbnail_column', 5, 2);
}

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

/**
 * Medium rare nav walker.
 * 
 * This nav walker is for themes by tommusrhodus and medium rare.
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
class ebor_framework_medium_rare_bootstrap_navwalker extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children && $depth == 0 ){
				$class_names .= ' dropdown';
			} elseif ( $args->has_children ){
				$class_names .= ' dropdown-submenu';
			}

			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
				$atts['data-toggle']	= 'dropdown';
				$atts['class']			= 'dropdown-toggle js-activated';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */
			if ( ! empty( $item->attr_title ) )
				$item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
			else
				$item_output .= '<a'. $attributes .'>';

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ( $args->has_children && 0 === $depth ) ? '</a>' : '</a>';
			$item_output .= $args->after;
			
			/**
			 * Check if menu item object is a mega menu object.
			 * If it is, display the mega menu content.
			 * Otherwise render elements as normal
			 */
			if( $item->object == 'mega_menu' ) {
				$output .= '<div class="yamm-content row">' . do_shortcode(get_post_field('post_content', $item->object_id)) . '</div>';
			} else {
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}

		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo $fb_output;
		}
	}
}