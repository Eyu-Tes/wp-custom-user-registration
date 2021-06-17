<?php
function load_assets()
{
	$uri = plugin_dir_url(CR_PLUGIN_FILE);

	wp_enqueue_style('bs_style', $uri.'assets/css/bootstrap.min.css' );
	wp_enqueue_style('style', $uri.'assets/css/style.css' );
	wp_enqueue_script('popper_script', $uri.'assets/js/popper.min.js', false, false, true);
	wp_enqueue_script('bs_script', $uri.'assets/js/bootstrap.min.js', array('jquery'), false, true );
	wp_enqueue_script('script', $uri.'assets/js/script.js', false, false, true );
}
