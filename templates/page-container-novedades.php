<?php
/**
 * Template Name: Plantilla Contenedora - Novedades
 *
 * @package WordPress
 */
$keyword=get_query_var('keyword');
$categoria=get_query_var('categoria');

$post_type=get_field('post_type', $post);
$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;

$args = array(
	'post_type'   => $post_type, 
	'post_status' => 'publish', 
	'posts_per_page' => 9,
	'paged'          => $paged,
);

if($post_type=='evento'){
	$args['meta_query']	= array(
			'key'	 	=> 'fecha_inicio',
			'value'	  	=> date('Ymd'),
			'compare' 	=> '>=',
	);

	$args['orderby'] = 'meta_value';
	$args['order'] = 'DESC';
}
else{
	$args['orderby'] = 'post_date';
	$args['order'] = 'DESC';
}

//aditional filters
if(!empty($keyword)) $args['s']=$keyword;
if(!empty($categoria)){
	$args['meta_key'] = 'categoria';
	$args['meta_value'] = $categoria;
}

// the_post();
get_header();
?>
<section>
<?php get_template_part( 'template-parts/navigation/banner', 'top' ); ?>

<div class="container">
<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

	<div class="caja">
		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $page_title; ?></h1>
	
		<div class="lista_noticias">
			<div class="row">

	<?php
		$tmp_query = $wp_query;
		$wp_query = new WP_Query( $args );

		if($wp_query->found_posts > 0){
			while ( $wp_query->have_posts() ) {
				$wp_query->the_post();

				$title = $post->post_title;
				$resumen = get_field('resumen', $post);
				$img = get_field('imagen_cajas', $post);
				$url = get_permalink($post);

				if($post_type=='evento'){
					$fecha_ini = get_field('fecha_inicio', $post);
					$fecha_fin = get_field('fecha_fin', $post);
					if(!empty($fecha_fin)){
						$fecha = 'Del '.date_i18n('d \d\e F', strtotime($fecha_ini)).' al '.date_i18n('d \d\e F \d\e Y', strtotime($fecha_fin));
					}
					else{
						$fecha = date_i18n('d \d\e F \d\e Y', strtotime($fecha_ini));
					}
				}
				else{
					$fecha = date_i18n('d \d\e F \d\e Y', strtotime($post->post_date));
				}
			?>
				<div class="col-md-4 alturaMatch">
					<article>
						<a href="<?php echo $url ?>" class="full"></a>
					<?php if ($img){ ?>
						<img src="<?php echo $img ?>" alt="Noticia">
					<?php } ?>
						<div class="titulo">
							<?php echo $title ?>
						</div>
						<div class="fecha">
							<?php echo $fecha;?>
						</div>
						<div class="texto">
							<?php echo $resumen ?>
						</div>
					</article>
				</div>
		<?php
			}
			wp_reset_postdata();
		}
		else
		{
			echo '<p><strong>No se han encontrado resultados.</strong></p>';
		}
		?>
			</div>

			<div class="row">
				<?php get_pagination($tmp_query) ?>
			</div>

		</div>

	</div>

</div>
</section>
<?php

get_footer();
