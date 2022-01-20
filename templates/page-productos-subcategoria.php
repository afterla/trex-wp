<?php
/**
 * Template Name: Plantilla Productos - Subcategoría
 *
 * @package WordPress
 */

global $wpdb;

if (!session_id()) session_start();

$parent = get_post( $post->post_parent );
$addItem = get_query_var( 'add', null );

$parent_title=$parent->post_title;
$page_title = $post->post_title;
$page_url = get_permalink($post);

$grupos=get_field('grupos', $post);

if(isset($_SESSION['comparador']) && !$addItem){
	unset($_SESSION['comparador']);
}

$cids = isset($_SESSION['comparador'])? array_keys($_SESSION['comparador']): array();

get_header();

?>
<section>
<?php get_template_part( 'template-parts/navigation/banner', 'top' ); ?>

<div class="container">
<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

<div class="caja">	
	<h3><?php echo $parent_title; ?></h3>
	<h1><?php echo $page_title; ?></h1>
	<div class="lista_productos">

	<?php
	if($grupos){
		foreach($grupos as $grupo){
			$marca = $grupo['marca'];
			$productos = $grupo['productos'];
			$term = get_term( $marca );
			$logo = get_field( 'imagen', $term);

			if(!$productos) continue;
	?>
		<div class="grupo">
			<div class="logo">
				<img src="<?php echo $logo; ?>">
			</div>
			<div class="row padd-8">
		<?php

			foreach($productos as $producto){
				$id = $producto->ID;
				$title = $producto->post_title;
				$url = get_permalink($producto).'?parent='.$post->ID;
				$imagen = get_field('imagen', $producto);
				$features= get_product_features($producto);
				if(empty($imagen)) $imagen = get_field('url_imagen', $producto);

				$checked = in_array($id, $cids)? 'checked="true"': null;
		?>
				<div class="col-sm-6 col-lg-3 alturaMatch">
					<article>
						<div class="caja_producto">
							<a href="<?php echo $url; ?>" class="full"></a>
							<div class="imagen">
							<?php if($imagen){ ?>
								<img src="<?php echo $imagen; ?>?$cc-s$" id="img_<?php echo $id;?>" alt="Imagen del Producto">
							<?php } ?>
							</div>
							<h3 id="prod_<?php echo $id;?>"><span><?php echo $title;?></span></h3>
						<?php
							if($features){
						?>
							<div class="datos">
							<?php
								foreach($features as $feature){
									echo '<strong>'.$feature['name'].'</strong> '.$feature['value'].'<br>';
								}
							?>
							</div>
						<?php
							}
						?>
						</div>
						<div class="comparar">
							<a href="#">Comparar</a>
							<div class="campo_check" rel="<?php echo $producto->ID;?>">
								<input type="checkbox" id="chk_<?php echo $producto->ID;?>" <?php echo $checked;?>>	
							</div>
						</div>
					</article>
				</div>
		<?php
			}
		?>
			</div>
		</div>
	<?php
			}
		}
	?>

	</div>
</div>
</div>
</section>

<div class="comparador" parent="<?php echo $post->ID; ?>">
	<div class="container">
		<div class="row padd-8"></div>
	</div>
</div>

<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>/js/comparador.js"></script>
<script type="text/javascript"> $(function(){ Comparar_list(); });</script>

<?php

get_footer();
