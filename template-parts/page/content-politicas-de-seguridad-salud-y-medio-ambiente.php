<?php

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;

$link_politicas = get_field('link_politicas', $post);
$resumen = get_field('resumen', $post);

?>
	<div class="caja content_politicas">
		<h1>Políticas de seguridad, salud y medio ambiente</h1>						
		<div class="row padd-8">						
			<div class="col-12">							
				<div class="texto richtext">
					<?php echo $resumen; ?>
					<br><br>
					<p><strong>Descargue la Política Integrada de Seguridad, Salud y Medio Ambiente:</strong></p>
				</div>
				<div class="btn">
					<a href="<?php echo $link_politicas; ?>" target="_blank" class="full"></a>
					descargar politicas
				</div>
				<br>
				<br>
				<br>
			</div>
		</div>
	</div>
