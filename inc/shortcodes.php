<?php
//[TEMPLATE_URL]
function template_url_func( $atts ){
	return get_bloginfo('template_url');
}
add_shortcode( 'TEMPLATE_URL', 'template_url_func');

function mycustom_wpcf7_form_elements( $form ) {
$form = do_shortcode( $form );

	return $form;
}
add_filter( 'wpcf7_form_elements', 'mycustom_wpcf7_form_elements' );
