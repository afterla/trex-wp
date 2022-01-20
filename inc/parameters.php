<?php

function get_categoria($post){

	if($post->post_type=='noticia'){
		$term = wp_get_object_terms($post->ID, 'category');
		return count($term)>0? $term[0]->name: $post->post_type;
	}
	else
	{
		return $post->post_type;
	}
}

function get_post_title_info($post){

	$info=array('tipo'=>null, 'parent'=>null, 'url'=>null);

	switch ($post->post_type) {
		case 'promocion':
			$info['tipo']='Promociones';
			$info['parent']='promociones';
			$info['url'] = get_permalink($post);
			break;
		case 'noticia':
			$info['tipo']='Noticias';
			$info['parent']='noticias';
			$info['url'] = get_permalink($post);
			break;
		case 'evento':
			$info['tipo']='Eventos';
			$info['parent']='proximos-eventos';
			$info['url'] = get_permalink($post);
			break;
		case 'articulo':
			$info['tipo']='Artículos de Interés';
			$info['parent']='articulos-de-interes';
			$info['url'] = get_permalink($post);
			break;
		default:
			$info['tipo']=$post->post_title;
			$info['parent']=null;
			$info['url'] = get_permalink($post);
			break;
	}

return $info;
}

function get_str_fechas($arr){

$buffer=null;

	foreach($arr as $item){
		if(!empty($buffer)) $buffer .= ', ';

		$fecha = $item['fecha'];
		$buffer .= date('d M', strtotime($fecha));
	}
return $buffer;
}