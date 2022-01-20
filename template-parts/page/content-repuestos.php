<?php

$url_parts_cat = get_field('url_parts_cat', $post);
$imagen_parts_cat = get_field('imagen_parts_cat', $post);
$banner_cajas = get_field('banner_cajas', $post);

?>
	<div class="caja">
		<div class="texto">
			<?php echo $post->post_content; ?>
		</div>
		<div class="lista_tipo_uno">
			<div class="row padd-8">
				<div class="col-sm-12 col-lg-6 padd-8">
					<article>
						<div class="imagen">
							<a href="<?php echo $url_parts_cat ?>" target="_blank" class="full"></a>
							<img src="<?php echo $imagen_parts_cat ?>" alt="Ferreyros">	
						</div>
					</article>
				</div>
				<div class="col-sm-12 col-lg-6 padd-8">
					<div class="row">
					<?php
					foreach($banner_cajas as $caja){
						$pagina = $caja['pagina'];
						$promocion  = $caja['ancho_doble'];
						$cols = $promocion ? 12: 6;
						$imagen = $promocion ? $caja['imagen_promocion'] : $caja['imagen_caja'];
						$resumen = $caja['resumen'];
					?>
						<div class="col-sm-12 col-lg-<?php echo $cols;?> padd-8">
							<article>
								<div class="imagen">
									<a href="<?php echo get_permalink($pagina); ?>" class="full"></a>
									<img src="<?php echo $imagen; ?>" alt="Ferreyros">
									<div class="velo">
										<h3><span><?php echo $pagina->post_title;?></span></h3>
										<div class="texto richtext">
											<?php echo $resumen; ?>
										</div>
									</div>
								</div>
								<div class="parrafo">
									<?php echo $resumen; ?>
								</div>
							</article>
						</div>
					<?php } ?>
					</div>
				</div>


			</div>
		</div>
	</div>
