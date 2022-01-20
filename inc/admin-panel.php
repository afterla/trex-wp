<?php
/*
@package cpc_cat
== Admin Page ==
*/

function cpc_add_admin_page(){

	add_menu_page('CPC Admin Page', 'Productos CPC', 'manage_options', 'cpc_import', 'cpc_import_page', 'dashicons-store', 42);
	//add_menu_page('CPC Admin Page', 'Productos CPC', 'manage_options', 'cpc_admin', 'cpc_admin_page', 'dashicons-store', 42);
	//add_submenu_page('cpc_admin', 'Specifications: Características', 'Specifications', 'manage_options', 'cpc_specification', 'cpc_specification_create_page');
	//add_submenu_page('cpc_admin', 'Importar Productos CPC', 'Importar CPC', 'manage_options', 'cpc_import', 'cpc_import_page');

}
add_action('admin_menu', 'cpc_add_admin_page');

function cpc_admin_page(){
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	require_once(get_template_directory().'/admin/cpc/admin.php');
}

function cpc_specification_create_page(){
global $wpdb;

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	$product = $_REQUEST['product'];
	$action = $_POST['action'];

	if( $action == 'save' && $product!=null ){

		$id = $_POST['id'];
		$title = $_POST['title'];
		$name = $_POST['name'];
		$value_text = $_POST['value_text'];
		$value_metric = $_POST['value_metric'];
		$unit_metric = $_POST['unit_metric'];

		$args = array(
			'post_type'   => 'producto', 
			'post_status' => 'publish', 
			'post_title' => '$product', 
		);
		$is_post = count(get_posts( $args )) > 0;

		if($id!=null && $is_post){
			$wpdb->update( 'cpc_specification', array('title'=>$title, 'name'=>$name, 'value_text'=>$value_text, 'value_metric'=>$value_metric, 'unit_metric'=>$unit_metric), array( 'product' => $product, 'id' => $id ));
		}
		else{
			if(!$is_post){
				$new_post = array(
					'post_title'    => wp_strip_all_tags( $product ),
					'post_type'  => 'producto',
					'post_status'   => 'publish',
					'post_author'   => get_current_user_id()
				);
				wp_insert_post( $new_post );
			}

			$id = $wpdb->get_var( "SELECT MAX(`id`) FROM cpc_specification WHERE `product`='$product'");
			$wpdb->insert( 'cpc_specification', array('product' => $product, 'id' => $id+1, 'title'=>$title, 'name'=>$name, 'value_text'=>$value_text, 'value_metric'=>$value_metric, 'unit_metric'=>$unit_metric) );
		}

		require_once(get_template_directory().'/admin/cpc/admin.php');
		exit;
	}

	require_once(get_template_directory().'/admin/cpc/specifications.php');
}

function cpc_marketing_create_page(){
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	require_once(get_template_directory().'/admin/cpc/marketing.php');
}

function cpc_import_page(){
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	require_once(get_template_directory().'/admin/cpc/import.php');
}
