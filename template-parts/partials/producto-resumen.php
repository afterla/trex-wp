<?php

$product = $post->post_title;
$features= get_product_features($post);

//Custom Fields
$resumen = get_field('resumen', $post);
$url_brochure = get_field('url_brochure', $post);


$marcas = get_the_terms($post, 'marca');
$logo = $marcas? get_field( 'imagen', $marcas[0]): null;
?>
					<!--
					<div class="logo">
						<img src="<?php echo $logo; ?>">
					</div>
					-->
					<div class="texto richtext">
						<?php echo $resumen; ?>
					</div>
				<?php
					if($features){
				?>
					<ul class="detalle">
					<?php
						foreach($features as $feat){
					?>
						<li><?php echo $feat['name'].': '.$feat['value']; ?></li>
					<?php
						}
					?>
					</ul>
				<?php
					}
				?>
				<?php
					if($url_brochure){
				?>
					<div class="btn_descarga">
						<a href="<?php echo $url_brochure; ?>" target="_blank" class="full">Descargar Ficha Técnica
						
						<div class="right">
							<span>Descargar Ficha Técnica</span>
						</div>
						</a>
					</div>
				<?php
					}
				?>
