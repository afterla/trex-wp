<?php
// ==== ASSETS ==== //

// Now that you have efficiently generated scripts and stylesheets for your theme, how should they be integrated?
// This file walks you through the approach I use but you are free to do this any way you like

// Enqueue front-end scripts and styles
function theme_enqueue_scripts() {
    global $ver_num; // define global variable for the version number
    $ver_num = mt_rand();
    wp_register_style( 'style', get_stylesheet_directory_uri() . '/style.css',  array(), $ver_num, 'all' );
    wp_enqueue_style( 'style' );

    wp_enqueue_script( 'jquery' );

    wp_register_script( 'script', get_stylesheet_directory_uri() . '/assets/js/script.js', [ 'jquery' ], $ver_num, true );
    wp_enqueue_script( 'script' );
    wp_localize_script( 'script', 'jsVars',
        array(
			'baseUrl' => get_bloginfo( 'url' ),
			'ajax_url' => admin_url( 'admin-ajax.php' )
        )
    );
}

add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
