<?php


require_once 'load-assets.php';

class CustomUserRegistration
{
    public function __construct()
    {
        // load static assets
        add_action( 'wp_enqueue_scripts', 'load_assets' );
        // Register a new shortcode: [wp_cur]
        add_shortcode( 'wp_cur', array($this, 'cur_shortcode') );
        // hide admin bar from front end
        add_filter('show_admin_bar', '__return_false');
    }

    function cur_shortcode(): bool|string
    {
        ob_start();
        echo "shortcode content here...";
        return ob_get_clean();
    }
}
