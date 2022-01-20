<?php

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;

$calendario = get_field('calendario', $post);
?>
<div class="caja">
	<h3><?php echo $parent_title;?></h3>
	<h1><?php echo $page_title;?></h1>

	<div class="calendario_de_capacitaciones">
		<ul class="owl-carousel lista_fechas">

			<?php
			foreach($calendario as $item){
				$mes = $item['mes'];
				$fechas = $item['fechas'];
			?>
				<li class="item_fecha">
					<div class="fecha">
						<?php echo $mes;?>
					</div>
					<ul class="lista_eventos">
					<?php
					foreach($fechas as $item){
						$dia = $item['dia'];
						$titulo = $item['titulo'];
						$dias = $item['dias'];
						$ciudad = $item['ciudad'];
					?>
						<li>
							<div class="fecha">
								<?php echo str_pad($dia,2,"0",STR_PAD_LEFT); ?>
							</div>
							<span><?php echo $titulo; ?></span> <br>
							Dias del evento: <?php echo $dias; ?> <br>
							Ciudad: <?php echo $ciudad; ?> <br>
						</li>
					<?php } ?>
					</ul>
				</li>
			<?php } ?>

		</ul>
	</div>

</div>
