<?php

/*
  Plugin Name: WP Custom User Registration
  Description: A custom wordpress user registration plugin.
  Version: 1.0
  Author: Eyoab Tesfaye
*/

defined('ABSPATH') || exit;

if (!defined('CR_PLUGIN_FILE')) {
    define('CR_PLUGIN_FILE', __FILE__);
}

if ( ! class_exists( 'CustomUserRegistration', false ) ) {
    require_once dirname( CR_PLUGIN_FILE ) . '/includes/CustomUserRegistration.php';
}

function CUR(): CustomUserRegistration {
    return new CustomUserRegistration();
}

CUR();
