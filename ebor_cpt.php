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

                             <br />
                             <hr />
                             <br />
                             
                             <label><b>Enter the URL slug you want to use for this post type. DO-NOT: use numbers, spaces, capital letters or special characters.</b><br /><br />
                             <input type="text" size="30" name="ebor_framework_cpt_display_options[careers_slug]" value="<?php echo $displays['careers_slug']; ?>" placeholder="careers" /><br />
                              <br />e.g Entering 'careers' will result in www.website.com/careers becoming the URL to your careers.<br />
                              <b>If you change this setting, be sure to visit <a href="options-permalink.php">Your Permalink Settings</a> & click the 'save changes' button to refresh & re-write your permalinks.</b></label>
 
                              <br />
                              <hr />
                              <br />

                            <label><b>Enter the URL slug you want to use for this post type. DO-NOT: use numbers, spaces, capital letters or special characters.</b><br /><br />
                            <input type="text" size="30" name="ebor_framework_cpt_display_options[case_studies_slug]" value="<?php echo $displays['case_studies_slug']; ?>" placeholder="case-studies" /><br />
                             <br />e.g Entering 'case-studies' will result in www.website.com/case-studies becoming the URL to your case studies.<br />
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
        'name' => __( 'Ebor Mega Menu', 'ebor' ),
        'singular_name' => __( 'Ebor Mega Menu Item', 'ebor' ),
        'add_new' => __( 'Add New', 'ebor' ),
        'add_new_item' => __( 'Add New Ebor Mega Menu Item', 'ebor' ),
        'edit_item' => __( 'Edit Ebor Mega Menu Item', 'ebor' ),
        'new_item' => __( 'New Ebor Mega Menu Item', 'ebor' ),
        'view_item' => __( 'View Ebor Mega Menu Item', 'ebor' ),
        'search_items' => __( 'Search Ebor Mega Menu Items', 'ebor' ),
        'not_found' => __( 'No Ebor Mega Menu Items found', 'ebor' ),
        'not_found_in_trash' => __( 'No Ebor Mega Menu Items found in Trash', 'ebor' ),
        'parent_item_colon' => __( 'Parent Ebor Mega Menu Item:', 'ebor' ),
        'menu_name' => __( 'Ebor Mega Menu', 'ebor' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-menu',
        'description' => __('Mega Menus entries for the theme.', 'ebor'),
        'supports' => array( 'title', 'editor', 'author' ),
        'public' => true,
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

    register_post_type( 'mega_menu', apply_filters( 'ebor_cpt_init', $args, "mega_menu") ); 
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
        'supports' => array( 'title', 'editor', 'thumbnail', 'post-formats', 'comments', 'author' ),
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

    register_post_type( 'portfolio', apply_filters( 'ebor_cpt_init', $args, "portfolio") ); 
    register_taxonomy_for_object_type( 'post_format', 'portfolio' );
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
        'supports' => array( 'title', 'thumbnail', 'editor', 'author' ),
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

    register_post_type( 'team', apply_filters( 'ebor_cpt_init', $args, "team" ) ); 
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
        'supports' => array( 'title', 'thumbnail', 'author' ),
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

    register_post_type( 'client', apply_filters( 'ebor_cpt_init', $args, "client") ); 
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
        'supports' => array( 'title', 'editor', 'author' ),
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

    register_post_type( 'testimonial', apply_filters( 'ebor_cpt_init', $args, "testimonial") ); 
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
        'name' => __( 'FAQs', 'ebor' ),
        'singular_name' => __( 'FAQ', 'ebor' ),
        'add_new' => __( 'Add New', 'ebor' ),
        'add_new_item' => __( 'Add New FAQ', 'ebor' ),
        'edit_item' => __( 'Edit FAQ', 'ebor' ),
        'new_item' => __( 'New FAQ', 'ebor' ),
        'view_item' => __( 'View FAQ', 'ebor' ),
        'search_items' => __( 'Search FAQs', 'ebor' ),
        'not_found' => __( 'No faqs found', 'ebor' ),
        'not_found_in_trash' => __( 'No FAQs found in Trash', 'ebor' ),
        'parent_item_colon' => __( 'Parent FAQ:', 'ebor' ),
        'menu_name' => __( 'FAQs', 'ebor' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __('FAQ Entries.', 'ebor'),
        'supports' => array( 'title', 'editor', 'author' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'faq', apply_filters( 'ebor_cpt_init', $args, "faq") ); 
}

function ebor_framework_create_faq_taxonomies(){
    
    $labels = array(
        'name' => _x( 'FAQ Categories','ebor' ),
        'singular_name' => _x( 'FAQ Category','ebor' ),
        'search_items' =>  __( 'Search FAQ Categories','ebor' ),
        'all_items' => __( 'All FAQ Categories','ebor' ),
        'parent_item' => __( 'Parent FAQ Category','ebor' ),
        'parent_item_colon' => __( 'Parent FAQ Category:','ebor' ),
        'edit_item' => __( 'Edit FAQ Category','ebor' ), 
        'update_item' => __( 'Update FAQ Category','ebor' ),
        'add_new_item' => __( 'Add New FAQ Category','ebor' ),
        'new_item_name' => __( 'New FAQ Category Name','ebor' ),
        'menu_name' => __( 'FAQ Categories','ebor' ),
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

function ebor_framework_register_menu() {

    $labels = array( 
        'name' => __( 'Menu Items', 'ebor' ),
        'singular_name' => __( 'Menu Item', 'ebor' ),
        'add_new' => __( 'Add New', 'ebor' ),
        'add_new_item' => __( 'Add New Menu Item', 'ebor' ),
        'edit_item' => __( 'Edit Menu Item', 'ebor' ),
        'new_item' => __( 'New Menu Item', 'ebor' ),
        'view_item' => __( 'View Menu Item', 'ebor' ),
        'search_items' => __( 'Search Menu Items', 'ebor' ),
        'not_found' => __( 'No Menu Items found', 'ebor' ),
        'not_found_in_trash' => __( 'No Menu Items found in Trash', 'ebor' ),
        'parent_item_colon' => __( 'Parent Menu Item:', 'ebor' ),
        'menu_name' => __( 'Menu Items', 'ebor' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __('Menu Item Entries.', 'ebor'),
        'supports' => array( 'title', 'editor', 'author' ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-carrot',
        'show_in_nav_menus' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => false,
        'can_export' => true,
        'rewrite' => false,
        'capability_type' => 'post'
    );

    register_post_type( 'menu', apply_filters( 'ebor_cpt_init', $args, "menu") ); 
}

function ebor_framework_create_menu_taxonomies(){
    
    $labels = array(
        'name' => _x( 'Menu Item Categories','ebor' ),
        'singular_name' => _x( 'Menu Item Category','ebor' ),
        'search_items' =>  __( 'Search Menu Item Categories','ebor' ),
        'all_items' => __( 'All Menu Item Categories','ebor' ),
        'parent_item' => __( 'Parent Menu Item Category','ebor' ),
        'parent_item_colon' => __( 'Parent Menu Item Category:','ebor' ),
        'edit_item' => __( 'Edit Menu Item Category','ebor' ), 
        'update_item' => __( 'Update Menu Item Category','ebor' ),
        'add_new_item' => __( 'Add New Menu Item Category','ebor' ),
        'new_item_name' => __( 'New Menu Item Category Name','ebor' ),
        'menu_name' => __( 'Menu Item Categories','ebor' ),
    ); 
        
    register_taxonomy('menu_category', array('menu'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => false,
        'rewrite' => false,
    ));
  
}

function ebor_framework_register_class() {

    $labels = array( 
        'name' => __( 'Classes', 'ebor' ),
        'singular_name' => __( 'Class', 'ebor' ),
        'add_new' => __( 'Add New', 'ebor' ),
        'add_new_item' => __( 'Add New Class', 'ebor' ),
        'edit_item' => __( 'Edit Class', 'ebor' ),
        'new_item' => __( 'New Class', 'ebor' ),
        'view_item' => __( 'View Class', 'ebor' ),
        'search_items' => __( 'Search Classes', 'ebor' ),
        'not_found' => __( 'No Classes found', 'ebor' ),
        'not_found_in_trash' => __( 'No Classes found in Trash', 'ebor' ),
        'parent_item_colon' => __( 'Parent Classes:', 'ebor' ),
        'menu_name' => __( 'Classes', 'ebor' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __('Class Entries.', 'ebor'),
        'supports' => array( 'title', 'editor', 'thumbnail', 'author' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 'slug' => 'classes' ),
        'capability_type' => 'post'
    );

    register_post_type( 'class', apply_filters( 'ebor_cpt_init', $args, "class") ); 
}

function ebor_framework_create_class_taxonomies(){
    
    $labels = array(
        'name' => _x( 'Class Categories','ebor' ),
        'singular_name' => _x( 'Class Category','ebor' ),
        'search_items' =>  __( 'Search Class Categories','ebor' ),
        'all_items' => __( 'All Class Categories','ebor' ),
        'parent_item' => __( 'Parent Class Category','ebor' ),
        'parent_item_colon' => __( 'Parent Class Category:','ebor' ),
        'edit_item' => __( 'Edit Class Category','ebor' ), 
        'update_item' => __( 'Update Class Category','ebor' ),
        'add_new_item' => __( 'Add New Class Category','ebor' ),
        'new_item_name' => __( 'New Class Category Name','ebor' ),
        'menu_name' => __( 'Class Categories','ebor' ),
    ); 
        
    register_taxonomy('class_category', array('class'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => false,
        'rewrite' => false,
    ));
  
}

function ebor_framework_register_service() {

    $labels = array( 
        'name' => __( 'Services', 'ebor' ),
        'singular_name' => __( 'Service', 'ebor' ),
        'add_new' => __( 'Add New', 'ebor' ),
        'add_new_item' => __( 'Add New Service', 'ebor' ),
        'edit_item' => __( 'Edit Service', 'ebor' ),
        'new_item' => __( 'New Service', 'ebor' ),
        'view_item' => __( 'View Service', 'ebor' ),
        'search_items' => __( 'Search Services', 'ebor' ),
        'not_found' => __( 'No Services found', 'ebor' ),
        'not_found_in_trash' => __( 'No Services found in Trash', 'ebor' ),
        'parent_item_colon' => __( 'Parent Service:', 'ebor' ),
        'menu_name' => __( 'Services', 'ebor' ),
    );
     
     $args = array( 
         'labels' => $labels,
         'hierarchical' => false,
         'description' => __('Service entries.', 'ebor'),
         'supports' => array( 'title', 'thumbnail', 'editor', 'excerpt', 'author' ),
         'taxonomies' => array( 'service_category' ),
         'public' => true,
         'show_ui' => true,
         'show_in_menu' => true,
         'menu_position' => 5,
         'menu_icon' => 'dashicons-shield-alt',
         
         'show_in_nav_menus' => true,
         'publicly_queryable' => true,
         'exclude_from_search' => false,
         'has_archive' => true,
         'query_var' => true,
         'can_export' => true,
         'rewrite' => array( 'slug' => 'services' ),
         'capability_type' => 'post'
     );

    register_post_type( 'service', apply_filters( 'ebor_cpt_init', $args, "service") ); 
}

function ebor_framework_create_service_taxonomies(){
    
    $labels = array(
        'name' => _x( 'Service Categories','ebor' ),
        'singular_name' => _x( 'Service Category','ebor' ),
        'search_items' =>  __( 'Search Service Categories','ebor' ),
        'all_items' => __( 'All Service Categories','ebor' ),
        'parent_item' => __( 'Parent Service Category','ebor' ),
        'parent_item_colon' => __( 'Parent Service Category:','ebor' ),
        'edit_item' => __( 'Edit Service Category','ebor' ), 
        'update_item' => __( 'Update Service Category','ebor' ),
        'add_new_item' => __( 'Add New Service Category','ebor' ),
        'new_item_name' => __( 'New Service Category Name','ebor' ),
        'menu_name' => __( 'Service Categories','ebor' ),
    ); 
        
    register_taxonomy('service_category', array('service'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => true,
    ));
  
}

function ebor_framework_register_case_study() {

$displays = get_option('ebor_framework_cpt_display_options');

if( $displays['case_studies_slug'] ){ $slug = $displays['case_studies_slug']; } else { $slug = 'case-studies'; }

    $labels = array( 
        'name' => __( 'Case Studies', 'ebor' ),
        'singular_name' => __( 'Case Study', 'ebor' ),
        'add_new' => __( 'Add New', 'ebor' ),
        'add_new_item' => __( 'Add New Case Study', 'ebor' ),
        'edit_item' => __( 'Edit Case Study', 'ebor' ),
        'new_item' => __( 'New Case Study', 'ebor' ),
        'view_item' => __( 'View Case Study', 'ebor' ),
        'search_items' => __( 'Search Case Studies', 'ebor' ),
        'not_found' => __( 'No Case Studies found', 'ebor' ),
        'not_found_in_trash' => __( 'No Case Studies found in Trash', 'ebor' ),
        'parent_item_colon' => __( 'Parent Case Study:', 'ebor' ),
        'menu_name' => __( 'Case Studies', 'ebor' ),
    );
     
     $args = array( 
         'labels' => $labels,
         'hierarchical' => false,
         'description' => __('Case Study entries.', 'ebor'),
         'supports' => array( 'title', 'thumbnail', 'editor', 'excerpt', 'author' ),
         'taxonomies' => array( 'case_study_category' ),
         'public' => true,
         'show_ui' => true,
         'show_in_menu' => true,
         'menu_position' => 5,
         'menu_icon' => 'dashicons-chart-area',
         
         'show_in_nav_menus' => true,
         'publicly_queryable' => true,
         'exclude_from_search' => false,
         'has_archive' => true,
         'query_var' => true,
         'can_export' => true,
         'rewrite' => array( 'slug' => $slug ),
         'capability_type' => 'post'
     );

     register_post_type( 'case_study', apply_filters( 'ebor_cpt_init', $args, "case_study") ); 
}

function ebor_framework_create_case_study_taxonomies(){
    
    $labels = array(
        'name' => _x( 'Case Study Categories','ebor' ),
        'singular_name' => _x( 'Case Study Category','ebor' ),
        'search_items' =>  __( 'Search Case Study Categories','ebor' ),
        'all_items' => __( 'All Case Study Categories','ebor' ),
        'parent_item' => __( 'Parent Case Study Category','ebor' ),
        'parent_item_colon' => __( 'Parent Case Study Category:','ebor' ),
        'edit_item' => __( 'Edit Case Study Category','ebor' ), 
        'update_item' => __( 'Update Case Study Category','ebor' ),
        'add_new_item' => __( 'Add New Case Study Category','ebor' ),
        'new_item_name' => __( 'New Case Study Category Name','ebor' ),
        'menu_name' => __( 'Case Study Categories','ebor' ),
    ); 
        
    register_taxonomy('case_study_category', array('case_study'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => true,
    ));
  
}

function ebor_framework_register_career() {
	
	$displays = get_option('ebor_framework_cpt_display_options');
	
	if( $displays['careers_slug'] ){ $slug = $displays['careers_slug']; } else { $slug = 'careers'; }

    $labels = array( 
        'name' => __( 'Careers', 'stackwordpresstheme' ),
        'singular_name' => __( 'Career', 'stackwordpresstheme' ),
        'add_new' => __( 'Add New', 'stackwordpresstheme' ),
        'add_new_item' => __( 'Add New Career', 'stackwordpresstheme' ),
        'edit_item' => __( 'Edit Career', 'stackwordpresstheme' ),
        'new_item' => __( 'New Career', 'stackwordpresstheme' ),
        'view_item' => __( 'View Career', 'stackwordpresstheme' ),
        'search_items' => __( 'Searchs', 'stackwordpresstheme' ),
        'not_found' => __( 'No Careers found', 'stackwordpresstheme' ),
        'not_found_in_trash' => __( 'No Careers found in Trash', 'stackwordpresstheme' ),
        'parent_item_colon' => __( 'Parent Career:', 'stackwordpresstheme' ),
        'menu_name' => __( 'Careers', 'stackwordpresstheme' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __('Career Member entries for the ebor Theme.', 'stackwordpresstheme'),
        'supports' => array( 'title', 'thumbnail', 'editor' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 'slug' => $slug ),
        'capability_type' => 'post'
    );

    register_post_type( 'career', apply_filters( 'ebor_cpt_init', $args, "career") ); 
}

function ebor_framework_create_career_taxonomies(){
	
	$labels = array(
		'name' => __( 'Career Categories','stackwordpresstheme' ),
		'singular_name' => __( 'Career Category','stackwordpresstheme' ),
		'search_items' =>  __( 'Search Career Categories','stackwordpresstheme' ),
		'all_items' => __( 'All Career Categories','stackwordpresstheme' ),
		'parent_item' => __( 'Parent Career Category','stackwordpresstheme' ),
		'parent_item_colon' => __( 'Parent Career Category:','stackwordpresstheme' ),
		'edit_item' => __( 'Edit Career Category','stackwordpresstheme' ), 
		'update_item' => __( 'Update Career Category','stackwordpresstheme' ),
		'add_new_item' => __( 'Add New Career Category','stackwordpresstheme' ),
		'new_item_name' => __( 'New Career Category Name','stackwordpresstheme' ),
		'menu_name' => __( 'Career Categories','stackwordpresstheme' ),
	); 
		
	register_taxonomy('career_category', array('career'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
	));
  
}