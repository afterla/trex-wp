<?php
/**
 *
 * @package WordPress
 */
if (!session_id()) session_start();
$comparador = $_SESSION['comparador'];

$parent_id = get_query_var( 'parent', null );
$page_url = get_permalink($post);

if(!$parent_id){
	$args = array(
		'post_type'   => 'page', 
		'post_status' => 'publish', 
		'numberposts' => 10,
		'meta_query' => array(
			array(
				'key' => 'grupos_$_productos', // name of custom field
				'value' => '"'. $post->ID .'"',
				'compare' => 'LIKE'
			)
		)
	);

	$pages = new WP_Query( $args );
	if( $pages->have_posts() )
	while ( $pages->have_posts() ){
		$pages->the_post();
		wp_redirect($page_url.'?parent='.$post->ID);
	}
	wp_reset_query();
}

$page_url .= '?parent='.$parent_id;
$view = get_query_var('view');

if($view=='comparar' && !isset($comparador)){
	$image = get_field('imagen', $post);
	if(empty($image)) $image = get_field('url_imagen', $post);
	$url = get_permalink( $post );
	$_SESSION['comparador'][$post->ID]=array('url'=>$url, 'title'=>$post->post_title, 'image'=>$image.'?$cc-s$', 'post'=>$post);
//	header('location: '.$page_url);
//	exit;
}

$parent = get_post( $parent_id );
$parent_title=$parent->post_title;
$post_title = $post->post_title;

$specs = get_field('specification', $post);
$benefits = get_field('benefit', $post);

?>
<section class="seccion_promociones">

<?php get_template_part( 'template-parts/navigation/banner', 'productos' ); ?>

  <div class="container">
	<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>


<div class="caja">
	<h3><?php if($parent_id) echo $parent_title; ?></h3>
	<h1><?php echo $post_title; ?></h1>
	<div class="producto_detalle">
		<ul class="producto_menu">
			<li class="principal">
				<a href="<?php echo $page_url; ?>#ancla" class="full"></a>
				<div class="ico">
					<img src="<?php echo TEMPLATE_URL; ?>/images/producto-menu-ico1.png">
				</div>
				<span>Principal</span>
			</li>
		<?php if($specs){ ?>
			<li class="informacion">
				<a href="<?php echo $page_url; ?>&view=informacion#ancla" class="full"></a>
				<div class="ico">
					<img src="<?php echo TEMPLATE_URL; ?>/images/producto-menu-ico2.png">
				</div>
				<span>Información Técnica</span>
			</li>
		<?php } ?>
		<?php if($benefits){ ?>
			<li class="beneficios">
				<a href="<?php echo $page_url; ?>&view=beneficios#ancla" class="full"></a>
				<div class="ico">
					<img src="<?php echo TEMPLATE_URL; ?>/images/producto-menu-ico3.png">
				</div>
				<span>Beneficios</span>
			</li>
		<?php } ?>
			<li class="comparar">
				<a href="<?php echo $page_url; ?>&view=comparar#ancla" class="full"></a>
				<div class="ico">
					<img src="<?php echo TEMPLATE_URL; ?>/images/producto-menu-ico4.png">
				</div>
				<span>Comparar</span>
			</li>
			<li class="cotizar">
				<a href="<?php echo WEB_URL; ?>/cotizador/?id=<?php echo $post->ID; ?>&parent=<?php echo $parent_id;?>" class="full"></a>
				<div class="ico">
					<img src="<?php echo TEMPLATE_URL; ?>/images/producto-menu-ico5.png">
				</div>
				<span>Cotizar</span>
			</li>
		</ul> 

	<?php
		switch ($view) {
			case 'informacion':
			case 'beneficios':
			case 'comparar':
			case 'videos':
			case 'videos360':
				get_template_part( 'template-parts/partials/producto', $view );
				break;
			default:
				get_template_part( 'template-parts/partials/producto', 'home' );
				break;
		}
	?>

	</div>
	<script>var page_url='<?php echo $page_url?>';</script>

  </div>
</section>