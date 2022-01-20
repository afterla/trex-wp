<?php

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;

$grupo = get_field('grupo', $post);
$imagen_reconocimientos = get_field('imagen_reconocimientos', $post);
$url_externa = get_field('url_externa', $post);

?>

<div class="caja content_reconocimientos">
	<h3><?php echo $parent_title; ?></h3>
	<h1><?php echo $page_title; ?></h1>

	<?php if($grupo){?>
		<?php
			foreach ($grupo as $item) {
				$titulo = $item['titulo'];
				$subtitulo = $item['subtitulo'];
				$orientacion = $item['orientacion'];
				$reconocimientos = $item['reconocimientos'];
		?>
					<div class="row rubro">
 						<div class="col-md-3">
 							<div class="titulo">
 								<?php echo $titulo?>
 							</div>
 							<div class="texto">
 								<?php echo $subtitulo?>
 							</div>
 						</div>
 						<div class="col-md-9">
						<?php if($orientacion=='horizontal'){?>
							<div class="row">
							<?php
								foreach ($reconocimientos as $item) {
									$imagen = $item['imagen'];
									$resumen = $item['resumen'];
							?>
								<div class="col-md-2">
									<article>
										<img src="<?php echo $imagen?>">
										<?php echo $resumen?>
									</article>
								</div>
							<?php } ?>
							</div>
						<?php }else{?>
							<?php
								foreach ($reconocimientos as $item) {
									$imagen = $item['imagen'];
									$resumen = $item['resumen'];
							?>
							<div class="row">
								<div class="col-md-2">
									<article>
										<img src="<?php echo $imagen?>">
									</article>
								</div>
								<div class="col-md-8">
									<?php echo $resumen?>
								</div>
							</div>
							<?php } ?>
						<?php }?>
 						</div>
 					</div>
		<?php } ?>
	<?php } ?>

	<div class="row area_final">
		<div class="col-md-3">
			<div class="titulo">
				<span>Reconocimientos</span> <br>
				Ferreycorp <br><br>
			</div>
			<div class="btn">
				<a href="<?php echo $url_externa?>" target="_blank" class="full"></a>
				Ver Reconocimientos
			</div>						
		</div>
		<div class="col-md-9">
		<div class="row">
			<div class="col-md-4">
				<img src="<?php echo $imagen_reconocimientos?>" style="max-width:255px;">
			</div>
		</div>
		</div>
	</div>

</div>


