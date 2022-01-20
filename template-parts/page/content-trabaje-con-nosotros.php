<?php

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;

$subtitulo = get_field('subtitulo', $post);
$url_video = get_field('url_video', $post);
$link_oportunidades = get_field('link_oportunidades', $post);
$link_becarios = get_field('link_becarios', $post);
$descripcion = get_field('descripcion', $post);
$sumilla = get_field('sumilla', $post);

?>
	<div class="caja content_trabaje_con_nosotros">
		<h1>Trabaje con Nosotros</h1>
		<div class="row padd-8">
			<div class="col-md-6">
				<div class="contenedor_video">
					<?php echo $url_video;?>
				</div>
			</div>
			<div class="col-md-6">

				<div class="titulo">
					<?php echo $subtitulo?>
				</div>
				<div class="texto">
					<?php echo $descripcion?>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="btn">
							<a href="<?php echo $link_oportunidades; ?>" target="_blank" class="full"></a>
							Oportunidades Laborales
						</div>
					</div>
					<div class="col-md-6">
						<div class="btn">
							<a href="<?php echo $link_becarios; ?>" target="_blank" class="full"></a>
							Site de Becarios <br>
							<span>Becarios Gran Minería</span>
						</div>
					</div>
				</div>
				<div class="texto">
					<strong><?php echo $sumilla?></strong>
				</div>
			</div>
		</div>
	</div>
