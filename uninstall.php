<?php // ------------------------------------------------------------------------------------------------------------------------ //

/*
Test-Solutions is free software: you can redistribute it and/or modify it under the terms of the GNU General Public 
License as published by the Free Software Foundation, either version 3 of the License, or any later version.
 
Test-Solutions is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied 
warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License along with Test-Solutions. If not, see 
https://github.com/jaschwanda/test-solutions/blob/master/LICENSE.md

Copyright (c) 2020 by Jim Schwanda.
*/

if (!defined('WP_UNINSTALL_PLUGIN')) exit;

require_once(plugin_dir_path(__DIR__) . 'usi-wordpress-solutions/usi-wordpress-solutions-uninstall.php');

require_once('usi-test-solutions.php');

final class USI_Test_Solutions_Uninstall {

   const VERSION = '1.0.0 (1957-08-10)';

   private function __construct() {
   } // __construct();

   static function uninstall() {

      // global $wpdb;

      // $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}USI_Tests");

   } // uninstall();

} // Class USI_Test_Solutions_Uninstall;

USI_WordPress_Solutions_Uninstall::uninstall(USI_Test_Solutions::PREFIX);

USI_Test_Solutions_Uninstall::uninstall();

// --------------------------------------------------------------------------------------------------------------------------- // ?>