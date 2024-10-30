<?php
/*
Plugin Name: Instagallery
Plugin URI: http://wordpress.org/plugins/instagallery/
Description: Show your instagram recent images. This plugin use official Instagram API you must create a client id from <a href="here http://instagram.com/developer/clients/manage/">http://instagram.com/developer/clients/manage</a>
Version: 1.0
Author: evilripper
Author URI: http://www.evilripper.net
License: GPLv3
*/

/*
Instagallery is a wordpress plugin to show your last photos uploaded on instagram
Copyright (C) 2014  http://www.evilripper.net (email : gigarimini@gmail.com)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

Best experience with monospaced font! (:
	       /\
	      /||;		
             ;||||;
           ;||||; |;
         ;|||||'   |;
        ;|||||;     ;.
       ,|||||'  O o  ;           1O1\
       ||||||;       ;          O101O1\
       ;|||||;       ;         0101O1O1\
      ,;||||||;     ;'         / O1O1O11\
    ;|||||||||`. ,,,;.        /  / 1O10O1\
  .';|||||||||||||||||;,     /  /     01O1\
 ,||||||;||||||;;;;||||;,   /  /        110\
;`||||||`'||||||;;;||||| ,#/  /          1O1|
|`|||||||`;||||||;;||| ;||#  /            1O1
||`|||||||`;|||||||| ;||||# /              11O
`|`|||||||`;|||||| ;||||||#/               1OO
 |||`|||||||`;; ;|||||||||##                11
 ||||`|||||||`;||||||||;|||#                OO
 `|||||`||||||||||||;'`|;||#                1
  `|||||`||||||||;' /  / `|#
   ||||||`|||||;'  /  /   `#
Reaper modded by www.evilripper.net (C) 2014
Power by scite, eclipse, aptana and php! 
 
*/

if(!class_exists('Instagallery'))
{
	class Instagallery
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// Initialize InstagramApi
			require_once(sprintf("%s/InstagalleryApi.php", dirname(__FILE__)));
        	// Initialize Settings
            require_once(sprintf("%s/settings.php", dirname(__FILE__)));
            $Instagallery_Settings = new Instagallery_Settings();
        	//ShortCode
        	add_shortcode( 'instagallery', array( $this, 'getInstagalleryRecent' ));
			//Style and script 
			add_action( 'wp_enqueue_scripts', array($this,'theme_name_scripts') );
            // Register custom post types
            //require_once(sprintf("%s/post-types/post_type_template.php", dirname(__FILE__)));
            //$Post_Type_Template = new Post_Type_Template();
		} 	// END public function __construct
	    
		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
			//DEFAULT VALUES
			add_option('Instagallery_show_header', 1);
			add_option('Instagallery_show_divider', 1);
			add_option('Instagallery_max_images', 5);
			// Do nothing
		} // END public static function activate
	
		/**
		 * Deactivate the plugin
		 */		
		public static function deactivate()
		{
			//delete_option('Instagallery_username');
			//delete_option('Instagallery_client_id');
			//delete_option('Instagallery_show_header');
			//delete_option('Instagallery_show_divider');
			//delete_option('Instagallery_max_images');
		} // END public static function deactivate
		
		function getInstagalleryRecent( $attributes ) {
		    //return "Something from a shortcode function.";
		    $instaUsername = get_option("Instagallery_username");
			$instaClientId = get_option("Instagallery_client_id");
			//return "aaaaaaaaaaaaaaaaa";
			$instapi = new InstagalleryApi($instaClientId, $instaUsername);
			$instapi -> MaxDisplayedImages = get_option("Instagallery_max_images");;
			$instapi -> showHeader = get_option("Instagallery_show_header");;
			$instapi -> showImageDivider = get_option("Instagallery_show_divider");;
			return $instapi->getHtmlGallery();
		    
		}
		
		function theme_name_scripts() {
			wp_enqueue_style( 'style-name', plugins_url('Instagallery.css', __FILE__) );
			//wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
		}
		
	} // END class Instagallery
} // END if(!class_exists('Instagallery'))

if(class_exists('Instagallery'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('Instagallery', 'activate'));
	register_deactivation_hook(__FILE__, array('Instagallery', 'deactivate'));

	// instantiate the plugin class
	$Instagallery = new Instagallery();
	
    // Add a link to the settings page onto the plugin page
    if(isset($Instagallery))
    {
        // Add the settings link to the plugins page
        function Instagallery_plugin_settings_link($links)
        { 
            $settings_link = '<a href="options-general.php?page=Instagallery">Settings</a>'; 
            array_unshift($links, $settings_link); 
            return $links; 
        }

        $plugin = plugin_basename(__FILE__); 
        add_filter("plugin_action_links_$plugin", 'Instagallery_plugin_settings_link');
    }
}