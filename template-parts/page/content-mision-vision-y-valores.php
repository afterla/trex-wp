<?php

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;

$cajas = get_field('cajas', $post);
$imagen_principal = get_field('imagen_principal', $post);
$imagen_lateral = get_field('imagen_lateral', $post);
$cols = $imagen_lateral? 9: 12;
?>
	<div class="caja content_mision">
		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $page_title; ?></h1>
		<div class="row">
			<div class="col-md-<?php echo $cols;?>">
			<?php foreach( $cajas as $item ){ ?>
				<div class="row mision_box">
					<div class="col-md-2"><?php echo $item['titulo'];?></div>
					<div class="col-md-10">
						<?php echo $item['resumen'];?>
					</div>
				</div>
			<?php } ?>

				<img src="<?php echo $imagen_principal;?>" alt="<?php echo $page_title;?>" class="valores_img">
			</div>
		<?php if( $imagen_lateral ){ ?>
			<div class="col-md-3">
			<img src="<?php echo $imagen_lateral;?>" alt="Valores">
			</div>
		<?php } ?>
		</div>
	</div>
