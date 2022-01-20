 <?php

$specs = get_field('specification', $post);

if($specs){
?>
	<div class="contenedor seccion_informacion">
		<ul class="acordion">
	<?php
		foreach($specs as $spec){
			$category=$spec['category'];
			$details =$spec['detail'];

			if($details){
	?>
			<li>
				<div class="titulo"><?php echo $category; ?></div>
				<div class="contenido">
					<table cellspacing="0" cellpadding="0" border="0" align="center">
			<?php
				foreach($details as $item){
			?>
					<tr>
						<td><?php echo $item['name']; ?></td>
						<td><?php echo $item['value']; ?></td>
					</tr>
			<?php
				}
			?>
					</table>
				</div>
			</li>
		<?php
				}
			}
		?>
		</ul>
	</div>
<?php
}