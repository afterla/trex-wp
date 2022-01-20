<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage ferreyros
 * @since 1.0
 */

 /*----------------------------
-- DEFINICION DE CONSTANTES --
----------------------------*/

$web_url      = get_bloginfo('url');
$template_url = get_bloginfo('template_url');
//$current_url = get_permalink();

define('WEB_URL', $web_url);
define('TEMPLATE_URL', $template_url);
//define('CURRENT_URL', $current_url);

 /**
 * Theme setup and custom theme supports.
 */
require get_template_directory() . '/inc/setup.php';

 /**
 * Register Admin Panel.
 */
//require get_template_directory() . '/inc/admin-panel.php';

 /**
 * Register Shortcodes.
 */
require get_template_directory() . '/inc/shortcodes.php';

 /**
 * Register widget area.
 */
require get_template_directory() . '/inc/rest-api.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Load parameters library.
 */
require get_template_directory() . '/inc/parameters.php';

/**
 * Load utilities library.
 */
require get_template_directory() . '/inc/utilities.php';

/**
 * Custom Menú
 */
require get_template_directory() . '/inc/custom-menu.php';

/**
 * ACF Options.
 */
require get_template_directory() . '/inc/acf-options.php';


 /**
 * Contact Forms 7 EventsBefore.
 */
require get_template_directory() . '/inc/contact-forms-before.php';
