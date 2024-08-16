<?php
/*
Plugin Name: Custom Maintenance Mode
Description: A simple plugin to enable maintenance mode with customizable messages.
Version: 1.0
Author: Rabindra Pantha
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Autoload dependencies using Composer
require __DIR__ . '/vendor/autoload.php';

// Initialize the plugin
function cmm_initialize_plugin() {
    $plugin = new \RP\WordPress\CustomMaintenanceMode\Plugin();
    $plugin->run();
}
add_action('plugins_loaded', 'cmm_initialize_plugin');
