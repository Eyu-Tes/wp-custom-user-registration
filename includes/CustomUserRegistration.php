<?php


class CustomUserRegistration
{
    public function __construct()
    {
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
