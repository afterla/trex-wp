<?php
/*--------------------------------
-- Custom REST-API --
--------------------------------*/

if (!session_id()) session_start();


/**
 * @return lista de productos post_type.
 */
function admin_product_list(){
	$args = array(
		'post_type'   => 'producto', 
		'post_status' => 'publish', 
		'numberposts' => 1000,
		'orderby'	=> 'post_title',
		'order'		=> 'ASC'
	);
	$results = get_posts( $args );

	$products=array();
	foreach($results as $res){
		$products[]=$res->post_title;
	}

return $products;
}

/**
 * @return lista de modalidades del cotizador.
 */
function cotizador_modalidad_list( ) {
 
$modalidad = array();
if( $post = get_page_by_path('productos/nuevos') ) $modalidad[] = array( 'id'=>$post->ID, 'name'=>$post->post_title, 'type'=>'producto' );
if( $post = get_page_by_path('productos/usados') ) $modalidad[] = array( 'id'=>$post->ID, 'name'=>$post->post_title, 'type'=>'producto' );
if( $post = get_page_by_path('productos/alquiler') ) $modalidad[] = array( 'id'=>$post->ID, 'name'=>$post->post_title, 'type'=>'producto' );
if( $post = get_page_by_path('promociones') ) $modalidad[] = array( 'id'=>$post->ID, 'name'=>$post->post_title, 'type'=>'promocion' );
//$modalidad[] = array( 'id'=>'postventa', 'name'=>'Servicio Post-venta', 'type'=>'postventa' );

return $modalidad;
}

/**
 * @return lista de marcas del cotizador.
 */
function cotizador_marca_list( ) {

$marcas = array();
$terms = get_terms('marca', array('hide_empty' => 0));
foreach ($terms as $obj) {
	$marcas[] = array( 'id'=>$obj->term_id, 'name'=>$obj->name );
}

return $marcas;
}

/**
 * @return lista de familias del cotizador.
 */
function cotizador_familia_list( $params ) {

$parent_id = $params['id'];

$args = array(
	'post_parent' => $parent_id,
	'post_type'   => 'page', 
	'post_status' => 'publish', 
	'numberposts' => 30,
	'orderby'	=> 'menu_order',
	'order'		=> 'ASC'
);
$posts = get_posts( $args );

$familias = array();
foreach ($posts as $grp) {
	$args = array(
		'post_parent' => $grp->ID,
		'post_type'   => 'page', 
		'post_status' => 'publish', 
		'numberposts' => 30,
		'orderby'	=> 'menu_order',
		'order'		=> 'ASC'
	);

	$items = get_posts( $args );
	if(count($items)>0){
		$familias[] = array( 'id'=>$grp->ID, 'name'=>$grp->post_title, 'group'=>true );
		foreach ($items as $obj) {
			$familias[] = array( 'id'=>$obj->ID, 'name'=>$obj->post_title, 'group'=>false );
		}
	}
}

return $familias; 
}

/**
 * @return lista de modelos del cotizador.
 */
function cotizador_modelo_list( $params ) {

$parent_id = $params['id'];
$marca_id = $params['marca'];

$args = array(
	'post_parent' => $parent_id,
	'post_type'   => 'page', 
	'post_status' => 'publish', 
	'numberposts' => 30,
	'orderby'	=> 'menu_order',
	'order'		=> 'ASC'
);
$posts = get_posts( $args );

$modelos = array();
foreach ($posts as $obj) {
	$grupos=get_field('grupos', $obj);
	if($grupos){
		foreach($grupos as $grupo){
			$marca = $grupo['marca'];
			if($marca == $marca_id){
				$productos = $grupo['productos'];
				foreach($productos as $prod){
				
					$modelos[] = array( 'id'=>$prod->ID, 'name'=>$prod->post_title );
				}
			}
		}
	}
}

return $modelos;
}

/**
 * @return lista de promociones del cotizador.
 */
function cotizador_promocion_list( $params ) {

$post_id = $params['id'];
$page = get_post($post_id);

$promociones = array();
if($page){
	$cats = get_field('categorias', $page);
	foreach($cats as $cat){
		$promos = $cat['promociones'];
		if(!$promos) continue;
		foreach($promos as $promo){
			$promociones[] = array( 'id'=>$promo->ID, 'name'=>$promo->post_title );
		}
	}
}

return $promociones;
}


/**
 * @return sesion con la lista de productos comparados.
 */
function comparador_list( ) {
 
  return $_SESSION['comparador'];
}

/**
 * @param ID del producto a agregar.
 * @return bool|null Indica si el producto fue agregado a la sesion.
 */
function comparador_add( $params ) {
global $wpdb;

	$id = $params['id'];

	if(isset($_SESSION['comparador'][$id]) || (isset($_SESSION['comparador']) && count($_SESSION['comparador'])>2)){

		return false;
	}

	$product = get_post( $id );
	if ( $product ) {
		$image = get_field('imagen', $product);
		$url = get_permalink( $product );
		if(!$image) $image = get_field('url_imagen', $product);

		$_SESSION['comparador'][$id]=array('url'=>$url, 'title'=>$product->post_title, 'image'=>$image.'?$cc-s$', 'post'=>$product);
	
		return true;
	}

 
  return false;
}

/**
 * @param ID del producto a agregar.
 * @return bool|null Indica si el producto fue agregado a la sesion.
 */
function comparador_del( $params ) {

	$id = $params['id'];

	if(isset($_SESSION['comparador'][$id])){
		unset($_SESSION['comparador'][$id]);
		if(count($_SESSION['comparador'])==0) unset($_SESSION['comparador']);

		return count($_SESSION['comparador']);
	}

	return false;
}

/**
 * @param ID del producto a agregar.
 * @return bool|null Indica si el producto fue agregado a la sesion.
 */
function comparador_clear( ) {

	if(isset($_SESSION['comparador'])){
		unset($_SESSION['comparador']);
		return true;
	}

	return false;
}


/**
 * @return lista de eventos.
 */
function eventos_list( $params ) {

	$tipo = $params['tipo'];

	$args = array(
		'post_type'   => 'evento', 
		'post_status' => 'publish', 
		'numberposts' => -1,
		'orderby'	=> 'menu_order',
		'order'		=> 'ASC'
	);

	switch ($tipo) {
		case '2': //lista de eventos pasados
			$args['meta_query']	= array(
					'key'	 	=> 'fecha_inicio',
					'value'	  	=> date('Ymd'),
					'compare' 	=> '<',
			);
			break;
		default: //lista de eventos vigentes
			$args['meta_query']	= array(
					'key'	 	=> 'fecha_inicio',
					'value'	  	=> date('Ymd'),
					'compare' 	=> '>=',
			);
			break;
	}

	$args['orderby'] = 'meta_value';
	$args['order'] = 'DESC';

	$posts = get_posts( $args );

	$eventos = array();
	foreach ($posts as $post) {
		//$grupos=get_field('grupos', $post);
		$eventos[] = array( 'id'=>$post->ID, 'name'=>$post->post_title );
	}

	return $eventos;
}

/**
 * @return detalle del evento.
 */
function eventos_item( $params ) {

	$id = $params['id'];

	$post = get_post( $id );

	$evento = array();
	if($post){
		$evento = array( 'id'=>$post->ID, 'name'=>$post->post_title );
	}

	return $evento;
}

/**
 * @return categorias de promociones.
 */
function promociones_cat_list() {

	$page = get_page_by_path('promociones');
	$list = array();

	if($page!=null){
		$categorias = get_field('categorias', $page);
		foreach ($categorias as $key=>$post) {
			$list[] = array( 'id'=>$key, 'titulo'=>$post['titulo'] );
		}
	}

	return $list;
}

/**
 * @return lista de promociones.
 */
function promociones_list( $params ) {

	$cat = $params['cat'];

	$page = get_page_by_path('promociones');
	$list = array();

	if($page!=null){
		$categorias = get_field('categorias', $page);
		$promociones = $categorias[$cat]['promociones'];
		if($promociones){
			foreach ($promociones as $post) {
				$titulo = $post->post_title;
				$descripcion= $post->post_content;
				$imagen = get_field('imagen_caja', $post);
				$resumen= get_field('resumen', $post);
				$url= get_permalink($post);

				$list[] = array( 'id'=>$post->ID, 'titulo'=>$post->post_title, 'resumen'=> $resumen, 'imagen'=>$imagen, 'url'=> $url );
			}			
		}
	}

	return $list;
}

/**
 * @return detalle de la promocion.
 */
function promociones_item( $params ) {

	$id = $params['id'];

	$post = get_post( $id );

	$item = array();
	if($post){
		$titulo = $post->post_title;
		$descripcion= $post->post_content;
		$imagen = get_field('imagen_caja', $post);
		$resumen= get_field('resumen', $post);
		$estilos_css= get_field('estilos_css', $post);
		$url= get_permalink($post);

		$item = array( 'id'=>$post->ID, 'titulo'=>$post->post_title, 'resumen'=>$resumen, 'descripcion'=>$descripcion, 'estilos_css'=>$estilos_css, 'imagen'=>$imagen, 'url'=> $url );
	}

	return $item;
}

/**
 * @return lista de noticias homepage.
 */
function noticias_home() {


	$args = array(
		'post_type'   => 'noticia', 
		'post_status' => 'publish', 
		'numberposts' => 3,
		'orderby'	=> 'post_date',
		'order'		=> 'DESC'
	);

	$args['orderby'] = 'meta_value';
	$args['order'] = 'DESC';

	$posts = get_posts( $args );

	$list = array();
	foreach ($posts as $post) {
		$list[] = array( 'id'=>$post->ID, 'titulo'=>$post->post_title );
	}

	return $list;
}

/**
 * @return lista de noticias.
 */
function noticias_list() {

	$args = array(
		'post_type'   => 'noticia', 
		'post_status' => 'publish', 
		'numberposts' => -1,
		'orderby'	=> 'post_date',
		'order'		=> 'DESC'
	);

	$args['orderby'] = 'meta_value';
	$args['order'] = 'DESC';

	$posts = get_posts( $args );

	$list = array();
	foreach ($posts as $post) {
		$list[] = array( 'id'=>$post->ID, 'titulo'=>$post->post_title, 'resumen'=>substr(strip_tags($post->post_content), 0, 200 ).'...' );
	}

	return $list;
}


/**
 * @return detalle del evento.
 */
function noticias_item( $params ) {

	$id = $params['id'];

	$post = get_post( $id );

	$item = array();
	if($post){
		$item = array( 'id'=>$post->ID, 'titulo'=>$post->post_title, 'descripcion'=>$post->post_content, 'fecha'=>date_i18n('j \d\e F, Y', strtotime($post->post_date)), 'url'=>get_permalink($post) );
	}

	return $item;
}

/**
 * REST-API routes
 *
 */
add_action( 'rest_api_init', function () {

  register_rest_route( 'cpc_admin/v1', '/product/list', array(
    'methods' => 'GET',
    'callback' => 'admin_product_list',
  ) );

  register_rest_route( 'cotizador/v1', '/modalidad/list', array(
    'methods' => 'GET',
    'callback' => 'cotizador_modalidad_list',
  ) );

  register_rest_route( 'cotizador/v1', '/marca/list', array(
    'methods' => 'GET',
    'callback' => 'cotizador_marca_list',
  ) );

  register_rest_route( 'cotizador/v1', '/familia/list/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'cotizador_familia_list',
  ) );

  register_rest_route( 'cotizador/v1', '/promocion/list/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'cotizador_promocion_list',
  ) );

  register_rest_route( 'cotizador/v1', '/modelo/list/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'cotizador_modelo_list',
  ) );

  register_rest_route( 'comparador/v1', '/list', array(
    'methods' => 'GET',
    'callback' => 'comparador_list',
  ) );

  register_rest_route( 'comparador/v1', '/add/(?P<id>\d+)', array(
    'methods' => 'POST',
    'callback' => 'comparador_add',
  ) );

  register_rest_route( 'comparador/v1', '/del/(?P<id>\d+)', array(
    'methods' => 'POST',
    'callback' => 'comparador_del',
  ) );

  register_rest_route( 'comparador/v1', '/del/', array(
    'methods' => 'POST',
    'callback' => 'comparador_clear',
  ) );

  register_rest_route( 'eventos/v1', '/list/(?P<tipo>\d+)', array(
    'methods' => 'GET',
    'callback' => 'eventos_list',
  ) );

  register_rest_route( 'eventos/v1', '/item/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'eventos_item',
  ) );

  register_rest_route( 'promociones/v1', '/categories/', array(
    'methods' => 'GET',
    'callback' => 'promociones_cat_list',
  ) );

  register_rest_route( 'promociones/v1', '/list/(?P<cat>\d+)', array(
    'methods' => 'GET',
    'callback' => 'promociones_list',
  ) );

  register_rest_route( 'promociones/v1', '/item/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'promociones_item',
  ) );

  register_rest_route( 'noticias/v1', '/home/', array(
    'methods' => 'GET',
    'callback' => 'noticias_home',
  ) );

  register_rest_route( 'noticias/v1', '/list/', array(
    'methods' => 'GET',
    'callback' => 'noticias_list',
  ) );

  register_rest_route( 'noticias/v1', '/item/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'noticias_item',
  ) );

} );
