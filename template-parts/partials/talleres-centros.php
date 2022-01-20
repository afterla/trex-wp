<?php

$talleres = get_field('talleres', $post);
$images   = get_field('images', $post);
$videos360 = get_field('videos360', $post);
$galeria  = get_field('galeria', $post);
$videos   = get_field('videos', $post);

$icono_360 = get_field('icono_360', $post);
$icono_fotos = get_field('icono_fotos', $post);
$icono_videos = get_field('icono_videos', $post);

if(!$icono_360) $icono_360 = TEMPLATE_URL.'/images/servicios-analisis-img2.jpg';
if(!$icono_fotos) $icono_fotos = TEMPLATE_URL.'/images/servicios-analisis-img2.jpg';
if(!$icono_videos) $icono_videos = TEMPLATE_URL.'/images/servicios-analisis-img2.jpg';
?>
<div class="row padd-8">
	<?php
	if($talleres){
		foreach($talleres as $taller){
			$titulo = $taller['titulo'];
			$imagen = $taller['imagen'];
			$detalle = $taller['detalle'];
		?>
		<div class="col-md-6">
			<div class="ciudad">
				<?php echo $titulo; ?>
			</div>
		<?php if($imagen){ ?>
			<img src="<?php echo $imagen;?>" alt="Ferreyros" class="img100">
		<?php } ?>
			<ul class="lista_items">
			<?php
			if($detalle){
				foreach($detalle as $det){
					$parrafo = $det['parrafo'];
			?>
				<li><?php echo $parrafo;?></li>
			<?php }
			} ?>
			</ul>

		</div>
	<?php }
	} ?>

</div>

<?php if($videos360 || $galeria || $videos){ ?>
	<div class="row padd-8">
		<div class="col-md-6">
			<div class="row padd-8">

		<?php if($videos360){ ?>
				<div class="col-md-4">
					<div class="imagen_over small">
						<a href="<?php echo $page_url; ?>?view=videos360" class="full"></a>
						<img src="<?php echo $icono_360?>" alt="Valores">
						<div class="velo">
							<div class="center">
								<div class="ico img360">
									<img src="<?php echo TEMPLATE_URL; ?>/images/ico-360.png">
								</div>
							</div>
						</div>
					</div>
				</div>
		<?php } ?>
		<?php if($galeria){ ?>
				<div class="col-md-4">
					<div class="imagen_over small">
						<a href="<?php echo $page_url; ?>?view=galeria" class="full"></a>
						<img src="<?php echo $icono_fotos?>" alt="Valores">
						<div class="velo">
							<div class="center">
								<div class="ico">
									<img src="<?php echo TEMPLATE_URL; ?>/images/ico-camara.png">
								</div>
								Fotos
							</div>
						</div>
					</div>
				</div>
		<?php } ?>
		<?php if($videos){ ?>
				<div class="col-md-4">
					<div class="imagen_over small">
						<a href="<?php echo $page_url; ?>?view=videos" class="full"></a>
						<img src="<?php echo $icono_videos?>" alt="Valores">
						<div class="velo">
							<div class="center">
								<div class="ico">
									<img src="<?php echo TEMPLATE_URL; ?>/images/ico-video.png">
								</div>
								Videos
							</div>
						</div>
					</div>
				</div>
		<?php } ?>

			</div>
		</div>
		<div class="col-md-3"></div>
		<div class="col-md-3"></div>
	</div>
<?php } ?>