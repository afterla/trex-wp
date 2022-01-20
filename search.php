<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage ferreyros
 * @since 1.0
 * @version 1.0
 */

//$exclude_post = $wpdb->get_col("select ID from $wpdb->posts where post_name in ('contacto', 'mapa-de-sitio', 'results')");

$args = array(
        'post_type'      => array('page','producto','promocion','noticia','evento','articulo'),
//      'post__not_in' 	 => $exclude_post,
        's' => $s,
        'post_status'    => 'publish',
        'orderby' => 'post_date',
        'order'   => 'DESC',
        'posts_per_page' => 10,
        'paged'          => $paged,
    );

$tmp_query = $wp_query;
$wp_query = new WP_Query( $args );
$founds = $wp_query->found_posts;


//the_post();
get_header();

?>
<link rel="stylesheet" href="<?php echo TEMPLATE_URL;?>/css/custom-pagenavi.css" />
<section class="seccion_nosotros">

<div class="container">

	<div class="caja">

		<h1>Resultados de la búsqueda</h1>
		<div class="seccion_resultados">
		<?php
		if($founds > 0){
		?>
			<div class="coincidencias">
				Se ha encontrado <?php echo '<strong>'.$founds.'</strong> ' . ($founds>1? 'coincidencias.': 'coincidencia.'); ?>
			</div>
		<ul class="lista_resultados">
			<?php
			$i=0;
			while ( $wp_query->have_posts() ) {
			$wp_query->the_post();

			$info = get_post_title_info($post);
			$post_type=$post->post_type;
			$titulo = $post->post_title;
			$fecha = get_the_date( 'j \d\e F \d\e\l Y', $post);
			$resumen = get_extract_search($post->post_content);
			$imagen = null;

			if($post->post_type == 'producto'){
				$imagen = get_field('imagen', $producto);
				if(empty($imagen)){
					$imagen = get_field('url_imagen', $producto);	
					if(!empty($imagen)) $imagen .= '?$cc-s$';
				} 
			}
			?>
			<li>
			<?php if(isset($imagen) && !empty($imagen)){ ?>
				<div class="imagen">
					<img src="<?php echo $imagen?>">
				</div>
			<?php }?>
				<div class="titulo"><?php echo $titulo;?></div>
				<a href="<?php echo $info['url'];?>"><?php echo $info['url'];?></a>
				<div class="texto">
					<?php echo $resumen;?>
				</div>
				<div class="clear"></div>
			</li>
			<?php
			}
				wp_reset_postdata();
			?>
		</ul>

			<?php get_pagination($tmp_query) ?>

		<?php } else { ?>
			<div class="no_resultados">
				<div class="box">
					<div class="lupa">
						<img src="<?php echo TEMPLATE_URL?>/images/lupa2.png">
					</div>
					No se encontraron resultados
				</div>					
			</div>
		<?php } ?>
		</div>

	</div>

</div>
</section>

<?php

get_footer();
