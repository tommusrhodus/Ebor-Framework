<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class ebor_wp_import extends WP_Import
{
	function set_menus()
	{
		global $ebor_config;
		//get all registered menu locations
		$locations   = get_theme_mod('nav_menu_locations');
		
		//get all created menus
		$ebor_menus  = wp_get_nav_menus();
		
		if(!empty($ebor_menus) && !empty($ebor_config['nav_menus']))
		{
			foreach($ebor_menus as $ebor_menu)
			{
				//check if we got a menu that corresponds to the Menu name array ($ebor_config['nav_menus']) we have set in functions.php
				if(is_object($ebor_menu) && in_array($ebor_menu->name, $ebor_config['nav_menus']))
				{
					$key = array_search($ebor_menu->name, $ebor_config['nav_menus']);
					if($key)
					{
						//if we have found a menu with the correct menu name apply the id to the menu location
						$locations[$key] = $ebor_menu->term_id;
					}
				}
			}
		}
		//update the theme
		set_theme_mod( 'nav_menu_locations', $locations);
	}
}