<?php

$grupos = get_field( 'grupos', $post );

?>
<div class="caja">
	<div class="texto">
		<?php echo $post->post_content; ?>
	</div>

<?php
foreach($grupos as $group){
	$categoria = $group['categoria'];
	$pages = $group['pages'];
?>
	<h5><?php echo $categoria; ?></h5>
	<div class="lista_tipo_uno">
		<div class="row padd-8">

			<?php foreach($pages as $page){

				$title = $page->post_title;
				$resumen = get_field('resumen', $page);
				$img = get_field('imagen', $page);
				$url = get_permalink($page);
			?>
			<div class="col-sm-6 col-lg-3">
				<article>
					<div class="imagen">
						<a href="<?php echo $url; ?>" <?php echo $target; ?> class="full"></a>
						<img src="<?php echo $img; ?>" alt="<?php echo $title;?>">
						<div class="velo">
							<h3><span><?php echo $title;?></span></h3>
							<div class="texto">
								<?php echo $resumen;?>
							</div>
						</div>
					</div>
					<div class="parrafo">
						<?php echo $resumen; ?>
					</div>
				</article>
			</div>
			<?php }?>

		</div>
	</div>
<?php
}
?>

</div>
