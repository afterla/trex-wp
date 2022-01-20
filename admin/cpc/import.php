<?php

function importar_cpc($imp){
global $wpdb;

	$args = array(
		'post_type'   => 'producto', 
		'post_status' => 'publish', 
		'numberposts' => 1000,
		'orderby'	=> 'ID',
		'order'		=> 'ASC'
	);

	$products = get_posts( $args );

	$log=array();
	foreach($products as $post){
		$product=$post->post_title;

		if(in_array('spec', $imp)){
			$specs = $wpdb->get_results( "SELECT `id`, `title`, `name`, `value_text`, `value_metric`, `unit_metric` FROM cpc_specification WHERE `product`='$product' ORDER BY id" );
			$category = null;
			$specification=array();
			foreach ($specs as $spec) {
				$value=!empty($spec->value_text)? $spec->value_text: $spec->value_metric.' '.$spec->unit_metric;
				$detail[] = array('name'=>$spec->name, 'value'=>$value);

				if($category!=$spec->title){
					$category = $spec->title;
					$specification[] = array('category'=>$category, 'detail'=>$detail);
					$detail = array();
				}
			}
			if(count($specification)>0){
				if(update_field('specification', $specification, $post)) $log[$product] = true;
			}
		}

		if(in_array('benf', $imp)){
			$benfs = $wpdb->get_results( "SELECT `description`, `level` FROM cpc_equipment WHERE `product`='$product' ORDER BY id" );
			$value = null;
			$benefit=array(); $i=0;
			foreach ($benfs as $benf) {
				if($benf->level=='1'){
					$name = $benf->description;
				}
				else{
					$value .= $benf->description."\n";
				}

				$i++;
				if(!isset($benfs[$i]) || $benfs[$i]->level=='1'){
					$benefit[] = array('name'=>$name, 'value'=>$value);
					$value = null;
				}
			}
			if(count($benefit)>0){
				if(update_field('benefit', $benefit, $post)) $log[$product] = true;
			}
		}

		if(in_array('media', $imp)){
			$mkts = $wpdb->get_results( "SELECT `type`, `title`, `mediaSourceUrl` FROM cpc_marketing WHERE `product`='$product' AND (`type`='video' OR `type`='spinsetinterior' OR `type`='spinsetexterior' OR `type`='image') AND `mediaSourceUrl`<>'' ORDER BY id;" );
			$gallery=array();
			$video=array();
			$video360=array();
			foreach ($mkts as $mkt) {
				switch ($mkt->type) {
					case 'spinsetexterior':
					case 'spinsetinterior':
						$video360[] = array('name'=>$mkt->title, 'url'=>$mkt->mediaSourceUrl);
						break;
					case 'video':
						$video[] = array('name'=>$mkt->title, 'url'=>$mkt->mediaSourceUrl);
						break;
					case 'image':
						$gallery[] = array('url'=>$mkt->mediaSourceUrl);
						break;
				}
			}
			if(count($gallery)>0){
				update_field('url_imagen', $gallery[0]['url'], $post);
				if(update_field('gallery', $gallery, $post)) $log[$product] = true;
			}
			if(count($video)>0){
				if(update_field('video', $video, $post)) $log[$product] = true;
			}
			if(count($video360)>0){
				if(update_field('video360', $video360, $post)) $log[$product] = true;
			}
		}

	}

	return $log;
}

if ($_POST['submit'] && isset($_POST['imp'])) {
	$ins=importar_cpc($_POST['imp']);
}
?>
<h1>Importar Productos CPC</h1>

<?php if(isset($ins)){?>
<div id="message" class="updated notice notice-success is-dismissible"><p>Se han importado <?php echo count($ins);?> registros.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Descartar este aviso.</span></button></div>
<?php }
else{ ?>

<form name="cpc-specification" method="post" action="admin.php?page=cpc_import">
<table class="form-table">
	<tbody>
	<tr>
		<td>
			<label><input name="imp[]" type="checkbox" aria-describedby="tagline-description" value="spec" class="regular-text">
			Importar Especificaciones</label>
			<p class="description" id="tagline-description">Contenido de la tabla cpc_specification.</p></td>
	</tr>
	<tr>
		<td>
			<label><input name="imp[]" type="checkbox" aria-describedby="tagline-description" value="benf" class="regular-text">
			Importar Beneficios</label>
			<p class="description" id="tagline-description">Contenido de la tabla cpc_equipment.</p></td>
	</tr>
	<tr>
		<td>
			<label><input name="imp[]" type="checkbox" aria-describedby="tagline-description" value="media" class="regular-text">
			Importar Multimedia</label>
			<p class="description" id="tagline-description">Galería de Fotos, Videos, Videos 360.</p></td>
	</tr>
	</tbody>
</table>

<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Importar datos"></p>

</form>
<?php } ?>

