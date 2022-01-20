<?php

$page_url=get_permalink($post);

$index = intval(get_query_var('id'));
$videos = get_field('videos', $post);
?>
<div class="talleres">

<div class="display_detalle">
	<div class="titulo">
		Videos
	</div>
	<div class="btn_regresar">
		<a href="<?php echo $page_url?>" class="full"></a>
		Regresar
	</div>
	<div class="video_principal">
		<div class="contendor_video">
			<?php echo $videos[$index]['embed'];?>
		</div>
	</div>
	<div class="descripcion">
		Arrastre el mouse de izquierda a derecha y de arriba hacia abajo en el video, para vivir la experiencia en 360°
	</div>

	<div class="listado_de_botones">
		<div class="row padd-8">
		<?php
		$k=0;
		foreach($videos as $video){
			$titulo = $video['titulo'];
			$poster = $video['poster'];
			$embed = $video['embed'];
		?>
			<div class="col-md-3">
				<article>
					<a class="full" href="<?php echo $page_url?>?view=videos&id=<?php echo $k++;?>"></a>
					<div class="imagen">
						<div class="velo"></div>
						<img src="<?php echo $poster; ?>">
					</div>
					<div class="caja">
						<span><?php echo $titulo; ?></span>
					</div>
				</article>
			</div>
		<?php }?>
		</div>
	</div>

</div>

</div>