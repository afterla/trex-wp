<?php

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;

$video = get_field('video', $post);
$subtitulo = get_field('subtitulo', $post);
$texto = get_field('texto', $post);
$bloque_gris = get_field('bloque_gris', $post);
$cuadros = get_field('cuadros', $post);
$formulario = get_field('formulario', $post);

?>
	<div class="caja">
		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $page_title; ?></h1>

		<div class="soporte_al_cliente">
			<div class="row padd-8">
				<div class="col-md-6">
					<div class="row padd-8">
						<div class="video">
							<div class="contenedor_video">
							<?php echo get_url_youtube($video, 560, 135);?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="subtitulo">
						<?php echo $subtitulo;?>
					</div>
					
					<div class="texto">
						<?php echo $texto;?>
					</div>
					<div class="caja_gris">
						<?php echo $bloque_gris;?>
					</div>
				</div>
			</div>
			<br><br>
			<div class="row padd-8">
			<?php if($cuadros){
				foreach($cuadros as $cuadro){
					$titulo = $cuadro['titulo'];
					$imagen = $cuadro['imagen'];
					$resumen = $cuadro['resumen'];
					$documento = $cuadro['documento'];
			?>
				<div class="col-md-6">
					<article>
						<div class="row padd-8">
							<div class="col-sm-6">
								<img src="<?php echo $imagen?>" class="imagen" />
							</div>
							<div class="col-sm-6">
								<div class="titulo">
									<?php echo $titulo?>
								</div>
								<div class="texto">
									<?php echo $resumen?>
								</div>
								<?php if($documento){?>
								<div class="vermas">
									<a href="<?php echo $documento?>" target="_blank" class="full"></a>
									Ver Más
								</div>
								<?php }?>
							</div>
						</div>
					</article>
				</div>
			<?php
				}
			}?>

			<?php if( $formulario ){?>
				<div class="btn_adquiere">
					<a href="<?php echo $formulario;?>" class="full"></a>
					Adquiere tu Plan Ahora
				</div>
			<?php }?>

			</div>

		</div>
	</div>
