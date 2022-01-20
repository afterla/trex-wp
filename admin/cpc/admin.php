<?php
global $wpdb;

$product = $_REQUEST['product'];
$action = $_POST['action'];
$specs = $_POST['specs'];

if($action == 'trash' && $product!=null){
	foreach($specs as $spec){
		$wpdb->delete( 'cpc_specification', array( 'product' => $product, 'id' => $spec ) );
	}
}

$args = array(
	'post_type'   => 'producto', 
	'post_status' => 'publish', 
	'numberposts' => 1000,
	'orderby'	=> 'post_title',
	'order'		=> 'ASC'
);
$products = get_posts( $args );

$results = $wpdb->get_results( "SELECT `id`, `title`, `name`, `value_text` FROM cpc_specification WHERE `product`='$product' ORDER BY id");

wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css' );
wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js', array('jquery') );
$filter = 'admin.php?page=cpc_specification&product='.$product;

?>

<div class="wrap">
<h1>CPC Admin Products</h1>

<form name="cpc-filter" method="post" action="admin.php?page=cpc_admin">

	<div class="tablenav top">

		<div class="alignleft actions bulkactions">
			<label for="bulk-action-selector-top" class="screen-reader-text">Selecciona acción en lote</label>
			<select name="action" id="bulk-action-selector-top">
				<option value="">Acciones en lote</option>
				<option value="trash">Eliminar Items</option>
			</select>
			<input type="submit" name="doaction" id="doaction" class="button action" value="Aplicar">
		</div>
		<div class="alignleft actions">
			<label for="filter-by-date" class="screen-reader-text">Filtrar por Producto</label>
			<select name="product" id="product" onchange="this.form.submit();">
				<option value="">Filtrar por Producto</option>
			<?php foreach($products as $prod){?>
			<?php $selected = ($prod->post_title == $product)? 'selected="true"': null; ?>
				<option value="<?php echo $prod->post_title;?>" <?php echo $selected;?>><?php echo $prod->post_title;?></option>
			<?php }?>
			</select>
			<input type="submit" name="filter_action" id="post-query-submit" class="button" value="Filtrar">
		</div>
		<br class="clear">
	</div>

	<table class="wp-list-table widefat fixed striped">
		<thead>
		<tr>
			<td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all">Seleccionar todos</label><input id="cb-select-all" type="checkbox"></td>
			<th scope="col" id='name' class='manage-column column-name column-primary'>Nombre</th>
			<th scope="col" id='name' class='manage-column column-name column-primary'>Título</th>
			<th scope="col" id='count' class='manage-column column-count'>Valor</th>
		</tr>
		</thead>
		<tbody id="the-list">
		<?php foreach($results as $spec){?>
			<tr>
				<th scope="row" class="check-column">
					<label class="screen-reader-text" for="cb-select-<?php echo $spec->id;?>">Elige <?php echo $spec->name;?></label>
					<input id="cb-select-<?php echo $spec->id;?>" type="checkbox" name="specs[]" value="<?php echo $spec->id;?>">
					<div class="locked-indicator">
						<span class="locked-indicator-icon" aria-hidden="true"></span>
						<span class="screen-reader-text">“<?php echo $spec->name;?>” está bloqueado</span>
					</div>
				</th>
				<td class='nombre column-name has-row-actions column-primary' data-colname="Nombre">
					<a class='row-title' href="<?php echo $filter.'&id='.$spec->id;?>"><?php echo $spec->name;?></a>
					<button type="button" class="toggle-row"><span class="screen-reader-text"><?php echo $spec->name;?></span></button>
				</td>
				<td class='titulo column-name has-row-actions column-primary' data-colname="Título">
					<a class='row-title' href="<?php echo $filter.'&id='.$spec->id;?>"><?php echo $spec->title;?></a>
					<button type="button" class="toggle-row"><span class="screen-reader-text"><?php echo $spec->title;?></span></button>
				</td>
				<td class='valor column-count' data-colname="Valor">
					<a class='row-title' href="<?php echo $filter.'&id='.$spec->id;?>"><?php echo $spec->value_text;?></a>
				</td>
			</tr>
		<?php }?>
		</tbody>
	</table>

<p class="submit"><input type="button" name="add_new" id="add_new" class="button button-primary" value="Nueva Especificación" onclick="location.href='<?php echo $filter;?>'"></p>

</form>
</div>
<script>
jQuery(function($){
	$('#product').select2();
});
</script>