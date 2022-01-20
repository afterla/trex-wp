<?php
/**
 * Template Name: Plantilla Interna - Talleres Ciudad
 *
 * @package WordPress
 */

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;

$args = array(
	'post_parent' => $post->post_parent,
	'post_type'   => 'page', 
	'post_status' => 'publish', 
	'numberposts' => 30,
	'orderby'	=> 'menu_order',
	'order'		=> 'ASC'
);
$pages = get_posts( $args );

$subtitulo = get_field('subtitulo', $post);
$descripcion = get_field('descripcion', $post);
$imagen_principal = get_field('imagen_principal', $post);
$sumilla = get_field('sumilla', $post);
$galeria = get_field('galeria', $post);

//the_post();
get_header();

?>
<section>
<?php get_template_part( 'template-parts/navigation/banner', 'talleres' ); ?>

<div class="container">
<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

	<div class="caja">

		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $page_title; ?></h1>

		<div class="combo">
			<select name="ciudad" id="ciudad">
			<option value="<?php echo get_permalink($post->post_parent);?>">Más Provincias</option>
		<?php foreach($pages as $page){ ?>
			<option value="<?php echo get_permalink($page);?>"><?php echo $page->post_title;?></option>
		<?php } ?>
			</select>
		</div>

		<div class="talleres">
			<div class="talleres_interna">
				<div class="row padd-8">
					<div class="col-md-12 titulo">
						<?php echo $subtitulo;?>
					</div>
					<div class="col-md-6 richtext">
						<?php echo $descripcion;?>
					</div>
				<?php if($imagen_principal){?>
					<div class="col-md-6">
						<img src="<?php echo $imagen_principal;?>">
						<div class="txt">
							<?php echo $sumilla;?>
						</div>
					</div>
				<?php }?>
				</div>
			</div>

		<?php if($galeria){ ?>
			<div class="display_detalle">
				
				<div class="contenedor_fotos">
					<div class="tit">Galería de Fotos</div>
						<div class="galeria_de_fotos jssor_box">
						    <div id="slider1_container" class="slider_container " style="position: relative; top: 0px; left: 0px; width: 1010px; height: 513px; background: #191919; overflow: hidden;">			        
						        <!-- Slides Container -->
						        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1010px; height: 513px; overflow: hidden;">

								<?php
								foreach($galeria as $foto){
									$imagen = $foto['imagen'];
									$thumb = $foto['thumb'];
								?>
								    <div>
								        <img u="image" src="<?php echo $imagen; ?>" />
								        <img u="thumb" src="<?php echo $thumb; ?>" />
								    </div>
								<?php } ?>
						            
						        </div>
						        
						        <span u="arrowleft" class="jssora05l" >
						        </span>
						        <span u="arrowright" class="jssora05r">
						        </span>

						        <div u="thumbnavigator" class="jssort01" style="left: 0px; bottom: 0px;">
						            <!-- Thumbnail Item Skin Begin -->
						            <div u="slides" style="cursor: default;">
						                <div u="prototype" class="p">
						                    <div class=w><div u="thumbnailtemplate" class="t"></div></div>
						                    <div class=c></div>
						                </div>
						            </div>
						            <!-- Thumbnail Item Skin End -->
						        </div>
						    </div>
						</div>
					</div>
				</div>
		<?php } ?>


			</div>
	</div>

</div>
</section>

<script type="text/javascript">
$(function(){
	$('#ciudad').change(function(){
		location.href=$(this).val();
	});
});
</script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/js/jssor.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/js/jssor.slider.js"></script>

<?php get_footer();
