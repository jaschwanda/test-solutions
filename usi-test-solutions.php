<?php // ------------------------------------------------------------------------------------------------------------------------ //

defined('ABSPATH') or die('Accesss not allowed.');

/* 
Author:            Jim Schwanda
Author URI:        https://www.usi2solve.com/leader
Description:       The Test-Solutions plugin is a starting point template for WordPress plugin development. The Test-Solutions plugin is developed and maintained by Universal Solutions.
Donate link:       https://www.usi2solve.com/donate/test-solutions
License:           GPL-3.0
License URI:       https://github.com/jaschwanda/test-solutions/blob/master/LICENSE.md
Plugin Name:       Test-Solutions
Plugin URI:        https://github.com/jaschwanda/test-solutions
Requires at least: 5.0
Requires PHP:      5.6.25
Tested up to:      5.3.2
Text Domain:       usi-test-solutions
Version:           1.0.1
*/

/*
Test-Solutions is free software: you can redistribute it and/or modify it under the terms of the GNU General Public 
License as published by the Free Software Foundation, either version 3 of the License, or any later version.
 
Test-Solutions is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied 
warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License along with Test-Solutions. If not, see 
https://github.com/jaschwanda/test-solutions/blob/master/LICENSE.md

Copyright (c) 2020 by Jim Schwanda.
*/

final class USI_Test_Solutions {

   const VERSION = '1.0.1 (2020-07-22)';

   const NAME       = 'Test-Solutions';
   const PREFIX     = 'usi-test';
   const TEXTDOMAIN = 'usi-test-solutions';

   public static $options = array();

   public static $capabilities = array(
      'change-values' => 'Change Values|administrator',
   );

   function __construct() {

      if (empty(USI_Test_Solutions::$options)) {
         $defaults['preferences']['best-university'] = 'Lehigh University';
         USI_Test_Solutions::$options = get_option(self::PREFIX . '-options', $defaults);
      }


      if (is_admin()) {

         global $pagenow;
         if ('admin.php' == $pagenow) {
         }

         if (!defined('WP_UNINSTALL_PLUGIN')) {
            add_action('init', 'add_thickbox');
            require_once('usi-test-solutions-settings.php'); 
            if (!empty(USI_Test_Solutions::$options['updates']['git-update'])) {
               require_once(plugin_dir_path(__DIR__) . 'usi-wordpress-solutions/usi-wordpress-solutions-update.php');
               new USI_WordPress_Solutions_Update(__FILE__, 'jaschwanda', 'test-solutions');
            }
         }

      }

   } // __construct();

   static function action_admin_notices() {
      global $pagenow;
      if ('plugins.php' == $pagenow) {
        $text = sprintf(
           __('The %s plugin is required for the %s plugin to run properly.', self::TEXTDOMAIN), 
           '<b>WordPress-Solutions</b>',
           '<b>Test-Solutions</b>'
        );
        echo '<div class="notice notice-warning is-dismissible"><p>' . $text . '</p></div>';
      }
   } // action_admin_notices();

} // Class USI_Test_Solutions;

new USI_Test_Solutions();

// --------------------------------------------------------------------------------------------------------------------------- // ?>