<?php
/*--------------------------------
-- Custom nenus --
--------------------------------*/

function in_menu($menu_items, $k){

	$items = array();
	for($i=$k+1; $i<$k+10; $i++) {
		if(!isset($menu_items[$i]) || $menu_items[$i]->menu_item_parent==0) break;
		$items[]=$menu_items[$i]->object_id;
	}

	return $items;
}

function get_menu_prod($post_id, $class=null){

	$args = array(
		'post_parent' => $post_id,
		'post_type'   => 'page', 
		'post_status' => 'publish', 
		'numberposts' => 30,
		'orderby'	=> 'menu_order',
		'order'		=> 'ASC'
	);
	$pages = get_posts( $args );
	$menu = null;

	if($pages){
		$menu .= '<ul class="'.$class.'">';
		foreach($pages as $page){
			$menu .= '<li>';
			$url = get_permalink($page);
			if($class == 'ultra_menu'){
				$menu .= '<div class="menu_nieto"><a href="'.$url.'" class="full"></a>'.$page->post_title.'</div>';
				$menu .= get_menu_prod($page->ID, 'last_menu');
			}
			else{
				$imagen = get_field('imagen_menu', $page);
				$menu  .='<a href="'.$url.'">'.$page->post_title.'</a>';
				if($imagen) $menu .= '<img src="'.$imagen.'" alt="'.$page->post_title.'">';
			}
			$menu .= '</li>';
		}
		$menu .= '</ul>';
	}

	return $menu;
}

function custom_menu_main() {
global $post;

	if (($locations = get_nav_menu_locations()) && isset($locations['main'])) {
		$menu = wp_get_nav_menu_object($locations['main']);
		$menu_items = wp_get_nav_menu_items($menu->term_id);
		$page_url= empty($_GET['s'])? get_permalink(): null;
		$activo=$page_url == '/'? 'activo': null;

		//var_dump($menu_items);

		$menu_list = '<ul class="menu">' ."\n";
		foreach ((array) $menu_items as $k => $menu_item) {

			$title 	= $menu_item->title;
			$url 	= $menu_item->url;
			$class  = $menu_item->classes[0];
			$next_parent = $menu_items[ $k+1 ]->menu_item_parent;
			$target = in_array('external', $menu_item->classes)? 'target="_blank"': null;

			if( !$menu_item->menu_item_parent ){
				$div_class  = $class;
				$div_class .= ($post->post_parent==$menu_item->object_id || in_array($post->post_parent, in_menu($menu_items, $k)))? ' on activo': null;
				$div_class .= $next_parent==0 ? ' conlink': null;
				$menu_list .= "\t". '<li class="'. $div_class.'">' ."\n";
				$menu_list .= "\t\t". '<div class="menu_padre"><a href="'. $url .'" '.$target.' class="full"></a><span>'. $title . '</span></div>' ."\n";
				if($next_parent)
					$menu_list .= "\t\t".'<div class="contenedor_sub_menu"><ul class="sub_menu">' ."\n";
				else 
					$menu_list .= "\t\t".'<div><ul>' ."\n";
			}
			else{
				$menu_list .= "\t\t". '<li>' ."\n";
				$menu_list .= "\t\t\t". '<div class="menu_hijo"><a href="'. $url .'" '.$target.' class="full"></a>'.
				'<span>'. $title . '</span></div>' ."\n";

				if($class == 'menu_prod' && $menu_item->object == 'page'){
					//Menu Productos
					$menu_list .= get_menu_prod($menu_item->object_id, 'ultra_menu');
				}

				$menu_list .= "\t\t".'</li>' ."\n";
			}


			if( !$next_parent ){
				$menu_list .= "\t\t". '</ul></div>' ."\n";
				$menu_list .= "\t". '</li>' ."\n";
			}

		}
		$menu_list .= "\t". '</ul>' ."\n";

	}
	else {
		$menu_list = '<!-- no menu defined -->';
	}
	return $menu_list;
}

function custom_menu_header() {

	$locations = get_nav_menu_locations();

	if (isset($locations['header'])) {
		$menu = wp_get_nav_menu_object($locations['header']);
		$menu_items = wp_get_nav_menu_items($menu->term_id);

		$menu_list = '<div class="botonera">' ."\n";
		foreach ((array) $menu_items as $mkey => $menu_item) {

			$title 	= $menu_item->title;
			$url 	= $menu_item->url;
			$class  = $menu_item->classes[0];

			$menu_list .= "\t". '<a href="'. $url .'" '.$target.'>'. $title . '</a>' ."\n";

		}
		$menu_list .= "\t". '</div>' ."\n";

	}
	else {
		$menu_list = '<!-- no menu defined -->';
	}

	return $menu_list;
}

function custom_menu_footer() {

	$locations = get_nav_menu_locations();

	if (isset($locations['footer'])) {
		$menu = wp_get_nav_menu_object($locations['footer']);
		$menu_items = wp_get_nav_menu_items($menu->term_id);

		$menu_list = '<ul class="footer_menu">' ."\n";
		foreach ((array) $menu_items as $mkey => $menu_item) {

			$title 	= $menu_item->title;
			$url 	= $menu_item->url;
			$class  = $menu_item->classes[0];

		//	$menu_list .= "\t". '<li><a href="'. $url .'" '.$target.'>'. $title . '</a></li>' ."\n";

		}

		$menu_list .= "\t". '</ul>' ."\n";
	}
	else {
		$menu_list = '<!-- no menu defined -->';
	}

	return $menu_list;
}

function get_object_link($item){
	$link=(object) array('url'=>get_permalink($item), 'target'=>$item->target, 'icon'=>null);

	if(get_page_template_slug($item->ID)=='page_enlace_externo.php'){
		$link->target='_blank';
		$link->icon='<img alt="" src="'.TEMPLATE_URL.'/images/icono-link.png">';
	}

return $link;
}

