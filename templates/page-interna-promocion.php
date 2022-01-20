<?php
/**
 * Template Name: Página Interna - Promociones
 *
 * @package WordPress
 */

$ancestors = get_ancestors( $post->ID, 'page', 'post_type' );
$args = array(
	'post_parent' => $ancestors[1],
	'post_type'   => 'page', 
	'post_status' => 'publish',
	'numberposts' => 10,
	'orderby'	=> 'menu_order',
	'order'		=> 'ASC'
);
$parents = get_posts( $args );
$parent = get_post( $post->post_parent );

$args = array(
	'post_parent' => $post->post_parent,
	'post_type' => 'page',
	'post_status' => 'publish',
	'numberposts' => 10,
	'orderby'	=> 'menu_order',
	'order'		=> 'ASC'
);
$pages = get_posts( $args );

$args = array(
	'post_parent' => $post->ID,
	'post_type' => 'page',
	'post_status' => 'publish',
	'numberposts' => 10,
	'orderby'	=> 'menu_order',
	'order'		=> 'ASC'
);
$childs = get_posts( $args );

$banners = get_field('banners', $post);
if(!$banners) $banners = get_field('banners', $parent);
$promociones = get_field('promociones', $post);

//the_post();
get_header();

?>
		<section class="seccion_promociones seccion_promopciones_lista">
		<?php if($banners){?>
			<div class="banner banner_promociones">
				<ul class="slider_promociones">
				<?php foreach($banners as $banner){
					$img = $banner['imagen'];
					$lnk = $banner['link'];
				?>
					<li>
						<a href="<?php echo $lnk; ?>"><img src="<?php echo $img; ?>"></a>		
					</li>
				<?php
					}
				?>
				</ul>
			</div>
		<?php }?>
			<div class="white_zone">
				<div id="ancla"></div>
				<div class="container container_promociones_superior">
					
					<div class="barra_interna_menu menu_promociones">
						<ul class="menu_interno">
					<?php
						foreach ($parents as $page) {
						$activo = $page->ID==$parent->ID? 'class="activo"': null;
					?>
							<li <?php echo $activo; ?>>
							<a href="<?php echo get_permalink($page); ?>" class="full"></a>
								<?php echo $page->post_title; ?>
							</li>
					<?php
						}
					?>
						</ul>
						<div class="clear"></div>
					</div>
					<div class="barra_interna_menu submenu menu_promociones">
						<ul class="menu_interno">
					<?php
						foreach ($pages as $page) {
						$activo = $page->ID==$post->ID? 'class="activo"': null;
					?>
							<li <?php echo $activo; ?>>
								<a href="<?php echo get_permalink($page); ?>" class="full"></a>
								<?php echo $page->post_title; ?>
							</li>
					<?php
						}
					?>
						</ul>
						
						<div class="clear"></div>
					</div>
				</div>
				<div class="cross_line"></div>
				<div class="container">
					<div class="contendor_secciones_promociones">
						<ul class="lista_promociones">
					<?php
						foreach ($promociones as $promo) {
							$imagen = get_field('imagen', $promo);
					?>
							<li>
								<a href="<?php echo get_permalink($promo); ?>?parent=<?php echo $post->ID; ?>" class="full"></a>
								<?php if($imagen){ ?>
									<img src="<?php echo $imagen; ?>">
								<?php } ?>
								<div class="caption">
									<?php echo $promo->post_title; ?>
									<!--<div class="precio">
										s/ 12.90
									</div>-->
								</div>
							</li>
					<?php
						}
					?>
						</ul>
					</div>
				</div>
			</div>		
		</section>

<?php get_footer();
