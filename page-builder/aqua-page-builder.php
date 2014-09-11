<?php

/**
 * Ebor Page Builder
 * 
 * Welcome to ebor page builder, a fork of aqua page builder: https://github.com/syamilmj/Aqua-Page-Builder
 * 
 * @since 1.0.0
 * @author Tom Rhodes & syamilmj
 */
 
//definitions
if(!defined('AQPB_PATH')) define( 'AQPB_PATH', plugin_dir_path(__FILE__) );
if(!defined('AQPB_DIR')) define( 'AQPB_DIR', plugin_dir_url(__FILE__) );

function aqpb_get_version() {
	$version = EBOR_FRAMEWORK_VERSION;
	return $version;
}

//required functions & classes
require_once(AQPB_PATH . 'functions/aqpb_config.php');
require_once(AQPB_PATH . 'classes/class-aq-page-builder.php');
require_once(AQPB_PATH . 'classes/class-aq-block.php');
require_once(AQPB_PATH . 'functions/aqpb_functions.php');

//fire up page builder
$aqpb_config = aq_page_builder_config();
$aq_page_builder = new AQ_Page_Builder($aqpb_config);
if(!is_network_admin()) $aq_page_builder->init();
