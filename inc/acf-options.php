<?php

/*-----------------------
-- PAGINAS DE OPCIONES --
-----------------------*/

if( function_exists('acf_add_options_sub_page') ){

	acf_add_options_page();
	acf_set_options_page_title( 'Opciones');

	//acf_add_options_sub_page(array(
	//	'title'      => 'Home Page',
	//	'capability' => 'edit_others_posts',
	//));

	// acf_add_options_sub_page(array(
	// 	'title'      => 'Pie de página',
	// 	'capability' => 'edit_others_posts',
	// ));

}


/*
//Add custom fields to 'diplomatura' api rest
register_rest_field( 'diplomatura', 'metadata', array(
    'get_callback' => function ( $data ) {
        return get_post_meta( $data['id'], '', '' );
    }, ));
*/