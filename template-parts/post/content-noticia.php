<?php
/**
 *
 * @package WordPress
 */

$post_title = $post->post_title;
$post_content = $post->post_content;
$post_date = strtotime($post->post_date);
$imagen = get_field('imagen', $post);
$relacionados = get_field('relacionados', $post);

?>
<section class="seccion_novedades">

<?php get_template_part( 'template-parts/navigation/banner', 'novedades' ); ?>

  <div class="container">
	<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

	<div class="caja content_mineria_ilegal">
		<h3>Novedades</h3>
		<h1>Noticias</h1>
		<div class="noticia_detalle">
			<div class="row">
				<div class="col-md-8">
					<article>
						<div class="titular">
							<div class="fecha">
								<?php echo date('d', $post_date);?>
								<span><?php echo get_Mes($post_date, true);?></span>
							</div>
							<?php echo $post_title; ?>
						</div>

					<?php if ($imagen){ ?>
						<div class="imagen_principal">
							<img src="<?php echo $imagen; ?>">
						</div>
					<?php } ?>

						<div class="texto richtext">
							<?php echo $post_content; ?>
						</div>

						<div class="btn_regresar">
							<a href="<?php echo WEB_URL;?>/novedades/noticias/" class="full"></a>
							Regresar
						</div>
					</article>					
				</div>

			<?php
			if($relacionados){
			?>
				<div class="col-md-4">
					<aside>
						<div class="titulo">
							Más Noticias
						</div>
						<ul class="mas_noticias">
					<?php
					foreach($relacionados as $noticia){
					?>
							<li>
								<a href="<?php echo get_permalink($noticia);?>">
									<?php echo $noticia->post_title;?>
								</a>
							</li>
					<?php } ?>
						</ul>
					</aside>
				</div>
			<?php } ?>
			</div>
		</div>

	</div>

  </div>
</section>