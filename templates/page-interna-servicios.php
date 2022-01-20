<?php
/**
 * Template Name: Plantilla Interna - Servicios
 *
 * @package WordPress
 */

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;
$subtitulo = get_field( 'subtitulo', $post );
$imagen_cuadro = get_field( 'imagen_cuadro', $post );
$imagen_estilo = get_field( 'imagen_estilo', $post );


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

					<?php echo $post->post_content; ?>

				</div>

							
			</div>
		</div>
	</div>

</div>
</section>

<?php get_footer();
