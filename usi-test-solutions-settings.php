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
require_once(plugin_dir_path(__DIR__) . 'usi-wordpress-solutions/usi-wordpress-solutions-popup-iframe.php');
require_once(plugin_dir_path(__DIR__) . 'usi-wordpress-solutions/usi-wordpress-solutions-settings.php');
require_once(plugin_dir_path(__DIR__) . 'usi-wordpress-solutions/usi-wordpress-solutions-updates.php');
require_once(plugin_dir_path(__DIR__) . 'usi-wordpress-solutions/usi-wordpress-solutions-versions.php');

class USI_Test_Solutions_Settings extends USI_WordPress_Solutions_Settings {

   const VERSION = '1.0.2 (2020-11-02)';

   protected $is_tabbed = true;

   function __construct() {

      parent::__construct(
         array(
            'name' => USI_Test_Solutions::NAME, 
            'prefix' => USI_Test_Solutions::PREFIX, 
            'text_domain' => USI_Test_Solutions::TEXTDOMAIN,
            'options' => USI_Test_Solutions::$options,
            'capabilities' => USI_Test_Solutions::$capabilities,
            'file' => str_replace('-settings', '', __FILE__), // Plugin main file, this initializes capabilities on plugin activation;
         )
      );

   } // __construct();

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

      USI_WordPress_Solutions_Popup_Iframe::build(
         array(
            'close'  => __('Close', USI_Test_Solutions::TEXTDOMAIN),
            'height' => '640px',
            'id'     => 'usi-popup-php-info',
            'width'  => '980px',
         )
      );

      $phpinfo_anchor = USI_WordPress_Solutions_Popup_Iframe::link(
         array(
            'id'     => 'usi-popup-php-info',
            'iframe' => str_replace('-test-', '-wordpress-', plugins_url(null, __FILE__) . '/usi-wordpress-solutions-phpinfo-scan.php'),
            'link'   => array('text' => 'phpinfo()'),
            'tip'    => __('Display PHP information', USI_Test_Solutions::TEXTDOMAIN),
            'title'  => 'phpinfo()',
         )
      );

      USI_WordPress_Solutions_Popup_Iframe::build(
         array(
            'close'   => __('Close', USI_Test_Solutions::TEXTDOMAIN),
            'height' => '500px',
            'id'     => 'usi-popup-version',
            'width'  => '500px',
         )
      );

      $version1_anchor = USI_WordPress_Solutions_Popup_Iframe::link(
         array(
            'id'     => 'usi-popup-version',
            'iframe' => str_replace('-test-', '-wordpress-', plugins_url(null, __FILE__) . '/usi-wordpress-solutions-versions-scan.php?') . urlencode(__DIR__),
            'link'   => array('text' => 'Version ' . USI_Test_Solutions::VERSION),
            'tip'    => __('Display detailed version information', USI_Test_Solutions::TEXTDOMAIN),
            'title'  => 'Test-Solutions &nbsp; &nbsp; ' . __('Version', USI_Test_Solutions::TEXTDOMAIN) . ' ' . USI_Test_Solutions::VERSION,
         )
      );

      $version2_anchor = USI_WordPress_Solutions_Popup_Iframe::link(
         array(
            'id'     => 'usi-popup-version',
            'iframe' => str_replace('-test-', '-wordpress-', plugins_url(null, __FILE__) . '/usi-wordpress-solutions-versions-scan.php?') . urlencode(str_replace('-test-', '-wordpress-', __DIR__)),
            'link'   => array('text' => 'Version ' . USI_WordPress_Solutions::VERSION),
            'tip'    => __('Display detailed version information', USI_WordPress_Solutions::TEXTDOMAIN),
            'title'  => 'WiordPress-Solutions &nbsp; &nbsp; ' . __('Version', USI_Test_Solutions::TEXTDOMAIN) . ' ' . USI_Test_Solutions::VERSION,
         )
      );

      $sections = array(
         'preferences' => array(
            'header_callback' => array($this, 'config_section_header_preferences'),
            'label' => 'Preferences',
            'localize_labels' => 'yes',
            'localize_notes' => 3, // <p class="description">__()</p>;
            'settings' => array(
               'best-university' => array(
                  'type' => 'text', 
                  'label' => 'Best university in the USA',
                  'notes' => 'Enter the name of the best university east of all points west. Defaults to Lehigh University.',
               ),
               'phpinfo' => array(
                  'type' => 'html', 
                  'html' => $phpinfo_anchor,
                  'label' => 'Information',
               ),
               'version1' => array(
                  'type' => 'html', 
                  'html' => $version1_anchor,
                  'label' => 'Test Solutions',
               ),
               'version2' => array(
                  'type' => 'html', 
                  'html' => $version2_anchor,
                  'label' => 'WordPress Solutions',
               ),
            ),
         ), // preferences;

         'capabilities' => new USI_WordPress_Solutions_Capabilities($this),

         'updates' => new USI_WordPress_Solutions_Updates($this),

      );

      return($sections);

   } // sections();

   function config_section_header_preferences() {
      echo '<p>' . __('General description of preferences.', USI_Test_Solutions::TEXTDOMAIN) . '</p>' . PHP_EOL;
   } // config_section_header_preferences();

} // Class USI_Test_Solutions_Settings;

new USI_Test_Solutions_Settings();

// --------------------------------------------------------------------------------------------------------------------------- // ?>