<?php

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;
$imagen = get_field('imagen', $post);
$timeline1 = get_field('timeline1', $post);
$timeline2 = get_field('timeline2', $post);

?>

	<div class="caja content_historia">
		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $page_title; ?></h1>
		<div class="caja_pasos">

	<?php if($timeline1){?>
			<ul class="center_line">
			<?php
				foreach ($timeline1 as $item) {
					$titulo = $item['titulo'];
					$resumen = $item['resumen'];
			?>
				<li>								
					<div class="fecha">
						<?php echo $titulo; ?>
					</div>
					<div class="texto richtext">
						<?php echo $resumen; ?>
					</div>
				</li>
			<?php } ?>
			</ul>
	<?php } ?>

	<?php if($timeline2){?>
			<div class="titulo">
				El Hito Ferreycorp
			</div>

			<ul class="center_line ferreycorp">
			<?php
				foreach ($timeline2 as $item) {
					$titulo = $item['titulo'];
					$resumen = $item['resumen'];
			?>
				<li>
					<div class="fecha">
						<?php echo $titulo; ?>
					</div>
					<div class="texto richtext">
						<?php echo $resumen; ?>
					</div>
				</li>
			<?php } ?>
			</ul>
	<?php } ?>

		</div>
	</div>
