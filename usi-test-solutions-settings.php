<?php // ------------------------------------------------------------------------------------------------------------------------ //

defined('ABSPATH') or die('Accesss not allowed.');

/*
Test-Solutions is free software: you can redistribute it and/or modify it under the terms of the GNU General Public 
License as published by the Free Software Foundation, either version 3 of the License, or any later version.
 
Test-Solutions is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied 
warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License along with Test-Solutions. If not, see 
https://github.com/jaschwanda/test-solutions/blob/master/LICENSE.md

Copyright (c) 2020 by Jim Schwanda.
*/

require_once(plugin_dir_path(__DIR__) . 'usi-wordpress-solutions/usi-wordpress-solutions-capabilities.php');
require_once(plugin_dir_path(__DIR__) . 'usi-wordpress-solutions/usi-wordpress-solutions-settings.php');
require_once(plugin_dir_path(__DIR__) . 'usi-wordpress-solutions/usi-wordpress-solutions-updates.php');
require_once(plugin_dir_path(__DIR__) . 'usi-wordpress-solutions/usi-wordpress-solutions-versions.php');

class USI_Test_Solutions_Settings extends USI_WordPress_Solutions_Settings {

   const VERSION = '1.0.0 (1957-08-10)';

   protected $is_tabbed = true;

   function __construct() {

      parent::__construct(
         USI_Test_Solutions::NAME, 
         USI_Test_Solutions::PREFIX, 
         USI_Test_Solutions::TEXTDOMAIN,
         USI_Test_Solutions::$options
      );

   } // __construct();

   function config_section_header_preferences() {
      echo '<p>' . __('General description of preferences.', USI_Test_Solutions::TEXTDOMAIN) . '</p>' . PHP_EOL;
   } // config_section_header_preferences();

   function fields_sanitize($input) {
      return($input);
   } // fields_sanitize();

   function filter_plugin_row_meta($links, $file) {
      if (false !== strpos($file, USI_Test_Solutions::TEXTDOMAIN)) {
         $links[0] = USI_WordPress_Solutions_Versions::link(
            $links[0], 
            USI_Test_Solutions::NAME, // Title;
            USI_Test_Solutions::VERSION, // Version;
            USI_Test_Solutions::TEXTDOMAIN, // Text domain;
            __DIR__ // Folder containing plugin or theme;
         );
         $links[] = '<a href="https://www.usi2solve.com/donate/test-solutions" target="_blank">' . 
            __('Donate', USI_Test_Solutions::TEXTDOMAIN) . '</a>';
      }
      return($links);
   } // filter_plugin_row_meta();

   function sections() {

      $sections = array(
         'preferences' => array(
            'header_callback' => array($this, 'config_section_header_preferences'),
            'label' => 'Preferences',
            'settings' => array(
               'best-university' => array(
                  'type' => 'text', 
                  'label' => 'Best university in the USA',
                  'notes' => 'Enter the name of the best university east of all points west. Defaults to Lehigh University.',
               ),
            ),
         ), // preferences;

         'capabilities' => USI_WordPress_Solutions_Capabilities::section(
            USI_Test_Solutions::NAME, 
            USI_Test_Solutions::PREFIX, 
            USI_Test_Solutions::TEXTDOMAIN,
            USI_Test_Solutions::$capabilities,
            USI_Test_Solutions::$options
         ), // capabilities;

         'updates' => USI_WordPress_Solutions_Updates::section(
            USI_Test_Solutions::TEXTDOMAIN
         ), // updates;

      );

      foreach ($sections as $name => & $section) {
         foreach ($section['settings'] as $name => & $setting) {
            if (!empty($setting['label'])) $setting['label'] = __($setting['label'], USI_Test_Solutions::TEXTDOMAIN);
            if (!empty($setting['notes'])) $setting['notes'] = '<p class="description">' . 
               __($setting['notes'], USI_Test_Solutions::TEXTDOMAIN) . '</p>';
         }
      }
      unset($setting);

      return($sections);

   } // sections();

} // Class USI_Test_Solutions_Settings;

new USI_Test_Solutions_Settings();

// --------------------------------------------------------------------------------------------------------------------------- // ?>