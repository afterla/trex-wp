<?php
/**
 * Template Name: Plantilla Enlace Externo
 *
 * @package WordPress
 */

$url = get_field('url', $post);

if ( $url ) {

	wp_redirect($url, 301 );
	exit;
}
?>
