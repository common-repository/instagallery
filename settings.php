<?php

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

Best experience with monospaced font! (
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

if(!class_exists('Instagallery_Settings'))
{
	class Instagallery_Settings
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// register actions
		    add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));
		} // END public function __construct
		
        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
        	// register your plugin's settings
        	register_setting('Instagallery-group', 'Instagallery_username');
        	register_setting('Instagallery-group', 'Instagallery_client_id');
			register_setting('Instagallery-group', 'Instagallery_show_header');
			register_setting('Instagallery-group', 'Instagallery_show_divider');
			register_setting('Instagallery-group', 'Instagallery_max_images');
			
        	
        	// add your settings section
        	add_settings_section(
        	    'Instagallery-section', 
        	    'General Settings', 
        	    array(&$this, 'settings_section_Instagallery'), 
        	    'Instagallery'
        	);
        	
        	// add your setting's fields
            add_settings_field(
                'Instagallery_username', 
                'Username', 
                array(&$this, 'settings_field_input_text'), 
                'Instagallery', 
                'Instagallery-section',
                array(
                    'field' => 'Instagallery_username',
                    'width' => '200'
                )
            );
			
            add_settings_field(
                'Instagallery_client_id', 
                'Client Id', 
                array(&$this, 'settings_field_input_text'), 
                'Instagallery', 
                'Instagallery-section',
                array(
                    'field' => 'Instagallery_client_id',
                    'width' => '300'
                    
                )
            );
			
			
			add_settings_field(  
			    'Instagallery_show_header',  
			    'Show Header',  
			     array(&$this, 'settings_field_input_checkbox'), 
			    'Instagallery',  
			    'Instagallery-section',
			     array(
                    'field' => 'Instagallery_show_header',
                    'label' => 'hide/show header username'
                 )
			);
			
				
			add_settings_field(  
			    'Instagallery_show_divider',  
			    'Show divider',  
			     array(&$this, 'settings_field_input_checkbox'), 
			    'Instagallery',  
			    'Instagallery-section',
			     array(
                    'field' => 'Instagallery_show_divider',
                    'label' => 'hide/show divider image'
            	)
			);
			
			
			add_settings_field(  
			    'Instagallery_max_images',  
			    'Images Limit',  
			     array(&$this, 'settings_field_select'), 
			    'Instagallery',  
			    'Instagallery-section',
			     array(
                    'field' => 'Instagallery_max_images',
                    'label' => 'How many images show?',
                    'selectValues' => array (1,2,3,4,5,6,7,8,9,10)
            	)
			);

			
            // Possibly do additional admin_init tasks
        } // END public static function activate
        
        public function settings_field_select($args) {
			$field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
		    $label = $args['label'];	
			$selectValues = $args['selectValues'];
			
			$html = sprintf('<select id="%s" name="%s">',$field, $field);
			
			
			
			for ($i=0; $i < count($selectValues); $i++) {
				
				$checked = FALSE;
				
				if ($selectValues[$i] == $value)
				{
					$checked = TRUE;
				}
				
				$html = $html . '<option  value="'. $selectValues[$i] .'"' .  selected( 1, $checked, false ) . '>'. $selectValues[$i] ."</option>";	
			}
			
			$html = $html . sprintf('</select><label for="%s">%s</label>', $field, $label);
			
			echo $html;
			
		}
        
        public function settings_field_input_checkbox($args) {
		    $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
		    $label = $args['label'];
			$checked = FALSE;
			if ($value == 1)
			{
				$checked = TRUE;
			}
		    echo sprintf( '<input type="checkbox" id="%s" name="%s" value="1"' . checked( 1, $checked, false ) . '/><label for="%s">%s</label>', $field, $field, $field, $label);
		    //$html .= '<label for="checkbox_example">This is an example of a checkbox</label>';
		
		    //echo $html;
		
		}
        
        public function settings_section_Instagallery()
        {
            // Think of this as help text for the section.
            echo  'This plugin lets you display your own Instagram last photos with likes and link instagram single photo. Actually do not need OAuth access token,'
            	. ' but this plugin uses official Instagram API and you must create a client id from here <a href="http://instagram.com/developer/clients/manage/">http://instagram.com/developer/clients/manage</a>'
		. '<br />You must write the short tag [instagallery] in the post or the page where you want show your instgrams lastest photos.<br />'
		. '<strong>Shortcode Samples:</strong> [instagallery]'
		. '<br />Please use YOUR username. If you want to use photos of another user, you must first ask him for permission.';
		}
        
        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_text($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field); 
            // echo a proper input type="text" 
            echo sprintf('<input type="text" name="%s" id="%s" value="%s" style="width:%spx" />', $field, $field, $value, $args['width']);
        } // END public function settings_field_input_text($args)
        
        /**
         * add a menu
         */		
        public function add_menu()
        {
        	
        	
            // Add a page to manage this plugin's settings
        	add_options_page(
        	    'Instagallery', 
        	    'Instagallery', 
        	    'manage_options', 
        	    'Instagallery', 
        	    array(&$this, 'plugin_settings_page')
				
				
        	);
        } // END public function add_menu()
    
        /**
         * Menu Callback
         */		
        public function plugin_settings_page()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
        	// Render the settings template
        	include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
        } // END public function plugin_settings_page()
    } // END class Instagallery_Settings
} // END if(!class_exists('Instagallery_Settings'))
