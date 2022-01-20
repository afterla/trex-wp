<?php

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;
$subtitulo = get_field('subtitulo', $post);
$contenido = get_field('contenido', $post);

$acceso_salud = get_field('acceso_salud', $post);
$acceso_soporte = get_field('acceso_soporte', $post);
$acceso_cobertura = get_field('acceso_cobertura', $post);

$topicos = get_field('topicos', $post);

?>
				<div class="caja">
					<h3><?php echo $parent_title;?></h3>
 					<h1><?php echo $page_title;?></h1>					
					<div class="opciones_de_reparacion">
						<div class="row padd-8">
							<div class="col-md-6 padd-8">							
								<div class="subtitulo">
									<p><?php echo $subtitulo; ?></p>
								</div>
								<div class="texto">
									<?php echo $contenido; ?>
								</div>
							</div>

							<div class="col-md-3">
							
							<?php if($acceso_salud){ ?>
								<article class="cuadro">
									<a href="<?php echo $acceso_salud['link']; ?>" class="full"></a>
									<div class="ico">
										
										<img src="<?php echo $acceso_salud['imagen_icono']; ?>">
									</div>
									<?php echo $acceso_salud['titulo']; ?>
									<div class="ver_cuadro">
										Ver cuadro aquí
									</div>
								</article>
							<?php } ?>
							<?php if($acceso_soporte){ ?>
								<article class="soporte">
									<a href="<?php echo $acceso_soporte['link']; ?>" class="full"></a>
									<?php echo $acceso_soporte['titulo']; ?>
									<div class="ver_cuadro">
										Ver cuadro aquí
									</div>
								</article>
							<?php } ?>
							</div>
							<div class="col-md-3">
							<?php if($acceso_cobertura){ ?>
								<article class="covertura">
									<a href="<?php echo $acceso_cobertura['link']; ?>" class="full"></a>
									<div class="ico">
										<img src="<?php echo $acceso_cobertura['imagen_icono']; ?>">
									</div>
									<?php echo $acceso_cobertura['titulo']; ?>
									<div class="ver_grafico">										
										Ver cuadro aquí
									</div>
								</article>
							<?php } ?>
							</div>					
						</div>
					</div>


				<?php if($topicos){ ?>
					<div class="opciones_de_reparacion_lista">
						<div class="row padd-8">
						<?php foreach($topicos as $topic){ ?>
							<div class="col-md-3">
								<article>
									<div class='titulo'>
										<div class="ico">
											<img src="<?php echo $topic['imagen_icono']; ?>">
										</div>
										<?php echo $topic['titulo']; ?>
									</div>
									<div class="subtitulo">
										<?php echo $topic['subtitulo']; ?>
									</div>
									<div class="texto">
										<?php echo $topic['resumen']; ?>
									</div>
								<!--
									<div class="links">
										<a href="#">Plan Económico</a> |
										<a href="#">Plan Media vida</a>
									</div>
								-->
								</article>
							</div>
						<?php } ?>

						</div>
					</div>
				<?php } ?>

				</div>

