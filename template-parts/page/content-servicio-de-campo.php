<?php

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;

$widget = get_field('widget', $post);
$imagen_chica = get_field('imagen_chica', $post);
$imagen_vertical = get_field('imagen_vertical', $post);

?>
	<div class="caja">
		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $page_title; ?></h1>

		<div class="row">
			<div class="col-md-6">
				<div class="texto">
					<?php echo $post->post_content?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row padd-8">
					<div class="col-md-6">
					<?php if($widget){ ?>
						<article class="cuadro_ingresa">
							<a href="<?php echo $widget['url']?>" target="_blank" class="full"></a>
							<div class="ico">										
								<img src="<?php echo $widget['icono']?>">
							</div>
							<?php echo $widget['texto']?>
							<div class="ver_cuadro">										
								Ingresa aquí
							</div>
						</article>
					<?php } ?>
						<img src="<?php echo $imagen_chica;?>" alt="Valores">
						<br>
					</div>
					<div class="col-md-6">
						<img src="<?php echo $imagen_vertical;?>" alt="Valores">
					</div>
				</div>
			</div>
		</div>
	</div>
