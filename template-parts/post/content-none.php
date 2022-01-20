<section class="seccion_novedades">

<?php get_template_part( 'template-parts/navigation/banner', 'top' ); ?>

  <div class="container">
	<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

	<div class="caja content_mineria_ilegal">
		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $post_title; ?></h1>
		<div class="texto">
			<?php echo $post_content; ?>
		</div>
	</div>
  </div>
</section>