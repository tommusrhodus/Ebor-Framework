<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

// Load Importer API
require_once ABSPATH . 'wp-admin/includes/import.php';
$ebor_error = false;
$import_filepath = trailingslashit( get_template_directory() ) . "admin/demo-data.xml";

//check if wp_importer, the base importer class is available, otherwise include it
if ( !class_exists( 'WP_Importer' ) ) {
	$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	if ( file_exists( $class_wp_importer ) ){
		require_once($class_wp_importer);
	} else {
		$ebor_error = true;
	}
}

//check if the wp import class is available, this class handles the wordpress XML files. If not include it
//make sure to exclude the init function at the end of the file in kriesi_importer
if ( !class_exists( 'WP_Import' ) ) {
	require_once('wordpress-importer.php');
}

if($ebor_error !== false) {

	echo "The Auto importing script could not be loaded. please use the wordpress importer and import the XML file that is located in your themes folder manually.";
	
} else {

	if ( class_exists( 'WP_Import' )) {
		include_once('ebor-import-class.php');
	}

	if(!is_file($import_filepath)) {
	
		echo "The XML file containing the dummy content is not available or could not be read in <pre>".get_template_directory() ."</pre><br/> You might want to try to set the file permission to chmod 777.<br/>If this doesn't work please use the wordpress importer and import the XML file (should be located in your themes folder: dummy.xml) manually <a href='/wp-admin/import.php'>here.</a>";
	} else {
		$wp_import = new ebor_wp_import();
		$wp_import->fetch_attachments = true;
		$wp_import->import($import_filepath);
	}
}