<?php

// Set-up Action and Filter Hooks
register_uninstall_hook(__FILE__, 'ebor_framework_cpt_delete_plugin_options');
add_action('admin_init', 'ebor_framework_cpt_init' );
add_action('admin_menu', 'ebor_framework_cpt_add_options_page');
//RUN ON THEME ACTIVATION
register_activation_hook( __FILE__, 'ebor_framework_cpt_activation' );

// Delete options table entries ONLY when plugin deactivated AND deleted
function ebor_framework_cpt_delete_plugin_options() {
	delete_option('ebor_framework_cpt_display_options');
}

// Flush rewrite rules on activation
function ebor_framework_cpt_activation() {
	flush_rewrite_rules(true);
}

// Init plugin options to white list our options
function ebor_framework_cpt_init(){
	register_setting( 'ebor_framework_cpt_plugin_display_options', 'ebor_framework_cpt_display_options', 'ebor_framework_cpt_validate_display_options' );
}

// Add menu page
if(!( function_exists('ebor_framework_cpt_add_options_page') )){
	function ebor_framework_cpt_add_options_page(){
		$theme = wp_get_theme();
		add_options_page( $theme->get( 'Name' ) . ' Post Type Options', $theme->get( 'Name' ) . ' Post Type Options', 'manage_options', __FILE__, 'ebor_framework_cpt_render_form');
	}
}

// Render the Plugin options form
function ebor_framework_cpt_render_form() { 
	$theme = wp_get_theme();
?>
	
	<div class="wrap">
	
		<!-- Display Plugin Icon, Header, and Description -->
		<?php screen_icon('ebor-cpt'); ?>
		<h2><?php echo $theme->get( 'Name' ) . __(' Custom Post Type Settings','ebor'); ?></h2>
		<b>When you make any changes in this plugin, be sure to visit <a href="options-permalink.php">Your Permalink Settings</a> & click the 'save changes' button to refresh & re-write your permalinks, otherwise your changes will not take effect properly.</b>
		
		<div class="wrap">
		
			<!-- Beginning of the Plugin Options Form -->
			<form method="post" action="options.php">
				<?php settings_fields('ebor_framework_cpt_plugin_display_options'); ?>
				<?php $displays = get_option('ebor_framework_cpt_display_options'); ?>
				
				<table class="form-table">
				<!-- Checkbox Buttons -->
					<tr valign="top">
						<th scope="row">Register Post Types</th>
						<td>

							<label><b>Enter the URL slug you want to use for this post type. DO-NOT: use numbers, spaces, capital letters or special characters.</b><br /><br />
							<input type="text" size="30" name="ebor_framework_cpt_display_options[portfolio_slug]" value="<?php echo $displays['portfolio_slug']; ?>" placeholder="portfolio" /><br />
							 <br />e.g Entering 'portfolio' will result in www.website.com/portfolio becoming the URL to your portfolio.<br />
							 <b>If you change this setting, be sure to visit <a href="options-permalink.php">Your Permalink Settings</a> & click the 'save changes' button to refresh & re-write your permalinks.</b></label>
							 
							 <br />
							 <hr />
							 <br />

							<label><b>Enter the URL slug you want to use for this post type. DO-NOT: use numbers, spaces, capital letters or special characters.</b><br /><br />
							<input type="text" size="30" name="ebor_framework_cpt_display_options[team_slug]" value="<?php echo $displays['team_slug']; ?>" placeholder="team" /><br />
							 <br />e.g Entering 'team' will result in www.website.com/team becoming the URL to your team.<br />
							 <b>If you change this setting, be sure to visit <a href="options-permalink.php">Your Permalink Settings</a> & click the 'save changes' button to refresh & re-write your permalinks.</b></label>
							 
						</td>
					</tr>
				</table>
				
				<?php submit_button('Save Options'); ?>
				
			</form>
		
		</div>

	</div>
<?php 
}

/**
 * Validate inputs for post type options form
 */
function ebor_framework_cpt_validate_display_options($input) {
	
	if( get_option('ebor_framework_cpt_display_options') ){
		
		$displays = get_option('ebor_framework_cpt_display_options');
		
		foreach ($displays as $key => $value) {
			if(isset($input[$key])){
				$input[$key] = wp_filter_nohtml_kses($input[$key]);
			}
		}
	
	}
	return $input;
	
}

function ebor_framework_register_mega_menu() {

    $labels = array( 
        'name' => __( 'Ebor Mega Menu', 'zonya' ),
        'singular_name' => __( 'Ebor Mega Menu Item', 'zonya' ),
        'add_new' => __( 'Add New', 'zonya' ),
        'add_new_item' => __( 'Add New Ebor Mega Menu Item', 'zonya' ),
        'edit_item' => __( 'Edit Ebor Mega Menu Item', 'zonya' ),
        'new_item' => __( 'New Ebor Mega Menu Item', 'zonya' ),
        'view_item' => __( 'View Ebor Mega Menu Item', 'zonya' ),
        'search_items' => __( 'Search Ebor Mega Menu Items', 'zonya' ),
        'not_found' => __( 'No Ebor Mega Menu Items found', 'zonya' ),
        'not_found_in_trash' => __( 'No Ebor Mega Menu Items found in Trash', 'zonya' ),
        'parent_item_colon' => __( 'Parent Ebor Mega Menu Item:', 'zonya' ),
        'menu_name' => __( 'Ebor Mega Menu', 'zonya' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-menu',
        'description' => __('Mega Menus entries for Slowave.', 'zonya'),
        'supports' => array( 'title', 'editor' ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 40,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => false,
        'capability_type' => 'post'
    );

    register_post_type( 'mega_menu', $args );
}

function ebor_framework_register_portfolio() {

$displays = get_option('ebor_framework_cpt_display_options');

if( $displays['portfolio_slug'] ){ $slug = $displays['portfolio_slug']; } else { $slug = 'portfolio'; }

    $labels = array( 
        'name' => __( 'Portfolio', 'ebor' ),
        'singular_name' => __( 'Portfolio', 'ebor' ),
        'add_new' => __( 'Add New', 'ebor' ),
        'add_new_item' => __( 'Add New Portfolio', 'ebor' ),
        'edit_item' => __( 'Edit Portfolio', 'ebor' ),
        'new_item' => __( 'New Portfolio', 'ebor' ),
        'view_item' => __( 'View Portfolio', 'ebor' ),
        'search_items' => __( 'Search Portfolios', 'ebor' ),
        'not_found' => __( 'No portfolios found', 'ebor' ),
        'not_found_in_trash' => __( 'No portfolios found in Trash', 'ebor' ),
        'parent_item_colon' => __( 'Parent Portfolio:', 'ebor' ),
        'menu_name' => __( 'Portfolio', 'ebor' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __('Portfolio entries for the ebor Theme.', 'ebor'),
        'supports' => array( 'title', 'editor', 'thumbnail', 'post-formats', 'comments' ),
        'taxonomies' => array( 'portfolio-category' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-portfolio',
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 'slug' => $slug ),
        'capability_type' => 'post'
    );

    register_post_type( 'portfolio', $args );
}

function ebor_framework_create_portfolio_taxonomies(){
	$labels = array(
	    'name' => _x( 'Portfolio Categories','ebor' ),
	    'singular_name' => _x( 'Portfolio Category','ebor' ),
	    'search_items' =>  __( 'Search Portfolio Categories','ebor' ),
	    'all_items' => __( 'All Portfolio Categories','ebor' ),
	    'parent_item' => __( 'Parent Portfolio Category','ebor' ),
	    'parent_item_colon' => __( 'Parent Portfolio Category:','ebor' ),
	    'edit_item' => __( 'Edit Portfolio Category','ebor' ), 
	    'update_item' => __( 'Update Portfolio Category','ebor' ),
	    'add_new_item' => __( 'Add New Portfolio Category','ebor' ),
	    'new_item_name' => __( 'New Portfolio Category Name','ebor' ),
	    'menu_name' => __( 'Portfolio Categories','ebor' ),
	  ); 	
  register_taxonomy('portfolio_category', array('portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => true,
  ));
}

function ebor_framework_register_team() {

$displays = get_option('ebor_framework_cpt_display_options');

if( $displays['team_slug'] ){ $slug = $displays['team_slug']; } else { $slug = 'team'; }

    $labels = array( 
        'name' => __( 'Team Members', 'ebor' ),
        'singular_name' => __( 'Team Member', 'ebor' ),
        'add_new' => __( 'Add New', 'ebor' ),
        'add_new_item' => __( 'Add New Team Member', 'ebor' ),
        'edit_item' => __( 'Edit Team Member', 'ebor' ),
        'new_item' => __( 'New Team Member', 'ebor' ),
        'view_item' => __( 'View Team Member', 'ebor' ),
        'search_items' => __( 'Search Team Members', 'ebor' ),
        'not_found' => __( 'No Team Members found', 'ebor' ),
        'not_found_in_trash' => __( 'No Team Members found in Trash', 'ebor' ),
        'parent_item_colon' => __( 'Parent Team Member:', 'ebor' ),
        'menu_name' => __( 'Team Members', 'ebor' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __('Team Member entries for the ebor Theme.', 'ebor'),
        'supports' => array( 'title', 'thumbnail', 'editor' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-groups',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 'slug' => $slug ),
        'capability_type' => 'post'
    );

    register_post_type( 'team', $args );
}

function ebor_framework_create_team_taxonomies(){
	
	$labels = array(
		'name' => _x( 'Team Categories','ebor' ),
		'singular_name' => _x( 'Team Category','ebor' ),
		'search_items' =>  __( 'Search Team Categories','ebor' ),
		'all_items' => __( 'All Team Categories','ebor' ),
		'parent_item' => __( 'Parent Team Category','ebor' ),
		'parent_item_colon' => __( 'Parent Team Category:','ebor' ),
		'edit_item' => __( 'Edit Team Category','ebor' ), 
		'update_item' => __( 'Update Team Category','ebor' ),
		'add_new_item' => __( 'Add New Team Category','ebor' ),
		'new_item_name' => __( 'New Team Category Name','ebor' ),
		'menu_name' => __( 'Team Categories','ebor' ),
	); 
		
	register_taxonomy('team_category', array('team'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
	));
  
}

function ebor_framework_register_client() {

    $labels = array( 
        'name' => __( 'Clients', 'ebor' ),
        'singular_name' => __( 'Client', 'ebor' ),
        'add_new' => __( 'Add New', 'ebor' ),
        'add_new_item' => __( 'Add New Client', 'ebor' ),
        'edit_item' => __( 'Edit Client', 'ebor' ),
        'new_item' => __( 'New Client', 'ebor' ),
        'view_item' => __( 'View Client', 'ebor' ),
        'search_items' => __( 'Search Clients', 'ebor' ),
        'not_found' => __( 'No Clients found', 'ebor' ),
        'not_found_in_trash' => __( 'No Clients found in Trash', 'ebor' ),
        'parent_item_colon' => __( 'Parent Client:', 'ebor' ),
        'menu_name' => __( 'Clients', 'ebor' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __('Client entries.', 'ebor'),
        'supports' => array( 'title', 'thumbnail' ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-businessman',
        'show_in_nav_menus' => true,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => false,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'client', $args );
}

function ebor_framework_create_client_taxonomies(){
	
	$labels = array(
		'name' => _x( 'Client Categories','ebor' ),
		'singular_name' => _x( 'Client Category','ebor' ),
		'search_items' =>  __( 'Search Client Categories','ebor' ),
		'all_items' => __( 'All Client Categories','ebor' ),
		'parent_item' => __( 'Parent Client Category','ebor' ),
		'parent_item_colon' => __( 'Parent Client Category:','ebor' ),
		'edit_item' => __( 'Edit Client Category','ebor' ), 
		'update_item' => __( 'Update Client Category','ebor' ),
		'add_new_item' => __( 'Add New Client Category','ebor' ),
		'new_item_name' => __( 'New Client Category Name','ebor' ),
		'menu_name' => __( 'Client Categories','ebor' ),
	); 
		
	register_taxonomy('client_category', array('client'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
	));
  
}

function ebor_framework_register_testimonial() {

    $labels = array( 
        'name' => __( 'Testimonials', 'ebor' ),
        'singular_name' => __( 'Testimonial', 'ebor' ),
        'add_new' => __( 'Add New', 'ebor' ),
        'add_new_item' => __( 'Add New Testimonial', 'ebor' ),
        'edit_item' => __( 'Edit Testimonial', 'ebor' ),
        'new_item' => __( 'New Testimonial', 'ebor' ),
        'view_item' => __( 'View Testimonial', 'ebor' ),
        'search_items' => __( 'Search Testimonials', 'ebor' ),
        'not_found' => __( 'No Testimonials found', 'ebor' ),
        'not_found_in_trash' => __( 'No Testimonials found in Trash', 'ebor' ),
        'parent_item_colon' => __( 'Parent Testimonial:', 'ebor' ),
        'menu_name' => __( 'Testimonials', 'ebor' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __('Testimonial entries.', 'ebor'),
        'supports' => array( 'title', 'editor' ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-editor-quote',
        'show_in_nav_menus' => true,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => false,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'testimonial', $args );
}

function ebor_framework_create_testimonial_taxonomies(){
	
	$labels = array(
		'name' => _x( 'Testimonial Categories','ebor' ),
		'singular_name' => _x( 'Testimonial Category','ebor' ),
		'search_items' =>  __( 'Search Testimonial Categories','ebor' ),
		'all_items' => __( 'All Testimonial Categories','ebor' ),
		'parent_item' => __( 'Parent Testimonial Category','ebor' ),
		'parent_item_colon' => __( 'Parent Testimonial Category:','ebor' ),
		'edit_item' => __( 'Edit Testimonial Category','ebor' ), 
		'update_item' => __( 'Update Testimonial Category','ebor' ),
		'add_new_item' => __( 'Add New Testimonial Category','ebor' ),
		'new_item_name' => __( 'New Testimonial Category Name','ebor' ),
		'menu_name' => __( 'Testimonial Categories','ebor' ),
	); 
		
	register_taxonomy('testimonial_category', array('testimonial'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
	));
  
}

function ebor_framework_register_faq() {

    $labels = array( 
        'name' => __( 'faqs', 'ebor' ),
        'singular_name' => __( 'faq', 'ebor' ),
        'add_new' => __( 'Add New', 'ebor' ),
        'add_new_item' => __( 'Add New faq', 'ebor' ),
        'edit_item' => __( 'Edit faq', 'ebor' ),
        'new_item' => __( 'New faq', 'ebor' ),
        'view_item' => __( 'View faq', 'ebor' ),
        'search_items' => __( 'Search faqs', 'ebor' ),
        'not_found' => __( 'No faqs found', 'ebor' ),
        'not_found_in_trash' => __( 'No faqs found in Trash', 'ebor' ),
        'parent_item_colon' => __( 'Parent faq:', 'ebor' ),
        'menu_name' => __( 'faqs', 'ebor' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __('faq entries.', 'ebor'),
        'supports' => array( 'title', 'editor' ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-editor-quote',
        'show_in_nav_menus' => true,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => false,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'faq', $args );
}

function ebor_framework_create_faq_taxonomies(){
	
	$labels = array(
		'name' => _x( 'faq Categories','ebor' ),
		'singular_name' => _x( 'faq Category','ebor' ),
		'search_items' =>  __( 'Search faq Categories','ebor' ),
		'all_items' => __( 'All faq Categories','ebor' ),
		'parent_item' => __( 'Parent faq Category','ebor' ),
		'parent_item_colon' => __( 'Parent faq Category:','ebor' ),
		'edit_item' => __( 'Edit faq Category','ebor' ), 
		'update_item' => __( 'Update faq Category','ebor' ),
		'add_new_item' => __( 'Add New faq Category','ebor' ),
		'new_item_name' => __( 'New faq Category Name','ebor' ),
		'menu_name' => __( 'faq Categories','ebor' ),
	); 
		
	register_taxonomy('faq_category', array('faq'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
	));
  
}