<?php
$comparador = $_SESSION['comparador'];

$product = $post->post_title;
$parent_id = get_query_var( 'parent', null );
$page_url = get_permalink($post).'?parent='.$parent_id;

$cids = array_keys($comparador);
$cols = count($comparador);

?>
<div class="contenedor seccion_comparar">
	<table class="comparador_imagenes">
		<tr>
			<th></th>
		<?php
		$i=0;
		foreach($comparador as $item){
			$id=$cids[$i++];
		?>
			<td>
				<div class="close" rel="<?php echo $id;?>"></div>
				<div class="imagen">
					<img src="<?php echo $item['image'];?>">
				</div>
				<div class="nombre">
					<?php echo $item['title'];?>
				</div>
				<div class="cotizar">
					<a href="<?php echo WEB_URL.'/cotizador/?id='.$id;?>&parent=<?php echo $parent_id;?>" class="full"></a>
					Cotizar
				</div>
			</td>
		<?php }?>
		<?php for($i=count($comparador); $i<3; $i++){ ?>
			<td>
				<div class="imagen">
					<a href="<?php echo get_permalink($parent_id);?>?add=true"><img src="<?php echo TEMPLATE_URL;?>/images/btn-comparar.jpg"></a>
				</div>
			</td>
		<?php }?>
		</tr>
	</table>
<?php
if($cids){
	$specs = get_field('specification', $comparador[$cids[0]]['post']);
?>
	<ul class="acordion">
	<?php
	if($specs){
		foreach($specs as $spec){
			$category=$spec['category'];
			$details =$spec['detail']
	?>
			<li>
				<div class="titulo"><?php echo $category; ?></div>
				<div class="contenido">
					<table cellspacing="0" cellpadding="0" border="0" align="center">
			<?php 
				foreach($details as $item){
					$value1 = $item['value'];
					$value2 = null;
					$value3 = null;

					if($cols>1){
						$value2 = get_product_spec($comparador[$cids[1]]['post'], $category, $item['name']);
					}
					if($cols>2){
						$value3 = get_product_spec($comparador[$cids[2]]['post'], $category, $item['name']);
					}
			?>
					<tr class="table_row_label">
						<th colspan="<?php echo $cols;?>"><?php echo $item['name']; ?></th>
					</tr>
					<tr class="table_row_data">
						<th class="th_label"><?php echo $item['name']; ?></th>
						<td><?php echo $value1; ?></td>
						<td><?php echo $value2; ?></td>
						<td><?php echo $value3; ?></td>
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
<?php } ?>
	</div>

<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>/js/comparador.js"></script>
