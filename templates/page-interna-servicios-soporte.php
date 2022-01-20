<?php
/**
 * Template Name: Plantilla Interna - Servicios Soporte
 *
 * @package WordPress
 */

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;
$subtitulo = get_field( 'subtitulo', $post );
$componentes = get_field( 'componentes', $post );

//the_post();
get_header();

?>
<section>
<?php get_template_part( 'template-parts/navigation/banner', 'top' ); ?>

<div class="container">
<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

	<div class="caja">
		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $page_title; ?></h1>
		<div class="opciones_de_reparacion">
			<div class="row padd-8">
				<div class="col-md-12">							
					<div class="subtitulo">
						<p><?php echo $subtitulo; ?></p>
					</div>
					<div class="btn_regresar">
						<a href="<?php echo get_permalink($parent);?>" class="full"></a>
						Regresar
					</div>
					<div class="clear"></div>

				<?php if($componentes){ ?>
					<div class="caja_soporte">
						<div class="row padd-0">

						<?php
						$i=0;
						foreach($componentes as $comp){
							$first=$i++==0?'class="first"':null;
						?>
							<div class="col-md-2">
								<article <?php echo $first?>>
									<div class="titular">
										<?php echo $comp['titulo']; ?>
									</div>
									<div class="imagen">
										<img src="<?php echo $comp['imagen']; ?>">
									</div>
								</article>
							</div>

						<?php } ?>

						</div>
					</div>
				<?php } ?>


				</div>

							
			</div>
		</div>
	</div>

</div>
</section>

<?php get_footer();
