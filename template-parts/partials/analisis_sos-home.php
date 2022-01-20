<?php

global $page_url;

$texto_intro = get_field('texto_intro', $post);
$descripcion = get_field('descripcion', $post);
//$imagen_lateral = get_field('imagen_lateral', $post);
$galeria = get_field('galeria', $post);
$videos = get_field('videos', $post);
$caracteristicas = get_field('caracteristicas', $post);

?>
		<div class="row padd-8">
			<div class="col-md-9">
				<div class="caja_gris">
					<?php echo $texto_intro;?>
				</div>
				<div class="texto">
					<?php echo $descripcion;?>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row padd-8">
					<div class="col-md-12">
					<?php if($galeria){?>
						<div class="imagen_over">
							<a href="<?php echo $page_url?>?view=galeria" class="full"></a>
							<img src="<?php echo TEMPLATE_URL;?>/images/servicios-analisis-img2.jpg" alt="Fotos SOS">
							<div class="velo">
								<div class="center">
									<div class="ico">
										<img src="<?php echo TEMPLATE_URL;?>/images/ico-camara.png">
									</div>
									Fotos
								</div>
							</div>
						</div>
						<br>
					<?php }?>
					<?php if($videos){?>
						<div class="imagen_over">
							<a href="<?php echo $page_url?>?view=videos" class="full"></a>
							<img src="<?php echo TEMPLATE_URL;?>/images/servicios-analisis-img2.jpg" alt="Videos SOS">
							<div class="velo">
								<div class="center">
									<div class="ico">
										<img src="<?php echo TEMPLATE_URL;?>/images/ico-video.png">
									</div>
									Videos
								</div>
							</div>
						</div>
						<br>
					<?php }?>
					</div>
				</div>
			</div>
		</div>
		<br><br>

	<?php
	$k=0;
	if($caracteristicas){ ?>
		<div class="caja_pestanas">
			<div class="row padd-8">
				<div class="col-md-3">
					<ul class="lista_pestanas">
					<?php
						foreach($caracteristicas as $topic){
							$titulo = $topic['titulo'];
							$icono = $topic['icono'];
					?>

						<li class="<?php if($k++==0) echo 'activo'; ?>">
							<div class="ico ico_aceite" style="background-image: url(<?php echo $icono;?>);"></div>
							<span><?php echo $titulo;?></span>
						</li>
					<?php } ?>
					</ul>
				</div>
				<div class="col-md-9">
					<ul class="lista_detalle">
					<?php
						foreach($caracteristicas as $topic){
							$descripcion = $topic['descripcion'];
					?>
						<li>
							<div class="caja_gris">
								<?php echo $descripcion;?>
							</div>
						</li>
					<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	<?php } ?>

		<div class="row"></div>