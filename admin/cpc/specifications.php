<?php
global $wpdb;

$id = $_REQUEST['id'];
$product = $_REQUEST['product'];
$title = $_REQUEST['title'];
$name = $_REQUEST['name'];
$value_text = $_REQUEST['value_text'];
$value_metric = $_REQUEST['value_metric'];
$unit_metric = $_REQUEST['unit_metric'];

if(!empty($id) && !empty($product)){
	$results = $wpdb->get_results( "SELECT `id`, `title`, `name`, `value_text`, `value_metric`, `unit_metric` FROM cpc_specification WHERE `product`='$product' AND `id`='$id' LIMIT 0, 1");

	if(count($results)>0){
		$spec = $results[0];
		$id = $spec->id;
		$title = $spec->title;
		$name = $spec->name;
		$value_text = $spec->value_text;
		$value_metric = $spec->value_metric;
		$unit_metric = $spec->unit_metric;
	}
}

$filter = 'admin.php?page=cpc_admin&product='.$product;

wp_enqueue_style('EasyAutocomplete', TEMPLATE_URL.'/js/EasyAutocomplete/easy-autocomplete.min.css' );
wp_enqueue_style('EasyAutocomplete', TEMPLATE_URL.'/js/EasyAutocomplete/easy-autocomplete.themes.min.css' );
wp_enqueue_script('jquery', '//code.jquery.com/jquery-1.11.2.min.js');
wp_enqueue_script('EasyAutocomplete', TEMPLATE_URL.'/js/EasyAutocomplete/jquery.easy-autocomplete.min.js');

?>
<!-- Using jQuery with a CDN -->
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

<div class="wrap">
<h1>CPC Admin Products</h1>

<form name="cpc-specification" method="post" action="admin.php?page=cpc_specification">
<input type="hidden" name="id" value="<?php echo $id;?>">

<table class="form-table">

<tbody>
<tr>
<th scope="row"><label for="product">Producto</label></th>
	<td><input name="product" type="text" id="product" aria-describedby="tagline-description" value="<?php echo $product;?>" class="regular-text">
	<p class="description" id="tagline-description">Ingrese el nombre del producto nuevo o seleccionelo de la lista.</p></td>
</tr>
<tr>
	<th scope="row"><label for="title">Categoría</label></th>
	<td><input name="title" type="text" id="title" aria-describedby="tagline-description" value="<?php echo $title;?>" class="regular-text">
	<p class="description" id="tagline-description">Categoría o grupo de especificaciones.</p></td>
</tr>
<tr>
	<th scope="row"><label for="name">Nombre</label></th>
	<td><input name="name" type="text" id="name" aria-describedby="tagline-description" value="<?php echo $name;?>" class="regular-text">
	<p class="description" id="tagline-description">Nombre de la especificación.</p></td>
</tr>
<tr>
	<th scope="row"><label for="value_text">Valor</label></th>
	<td><input name="value_text" type="text" id="value_text" aria-describedby="tagline-description" value="<?php echo $value_text;?>" class="regular-text"></td>
</tr>
<tr>
	<th scope="row"><label for="value_metric">Valor Numérico</label></th>
	<td><input name="value_metric" type="text" id="value_metric" aria-describedby="tagline-description" value="<?php echo $value_metric;?>" class="regular-text"></td>
</tr>
<tr>
	<th scope="row"><label for="unit_metric">Unidad métrica</label></th>
	<td><input name="unit_metric" type="text" id="unit_metric" aria-describedby="tagline-description" value="<?php echo $unit_metric;?>" class="regular-text"></td>
</tr>
</tbody>
</table>
<p class="submit">
	<input type="submit" name="submit" id="submit" class="button button-primary" value="Guardar cambios">
	<input type="button" name="cancel" id="cancel" class="button button-primary" value="Cancelar" onclick="location.href='<?php echo $filter;?>'">
	<input type="hidden" name="action" value="save">
</p>
</form>
</div>

<script>
jQuery(function($){
	var options = {
		url: "<?php echo WEB_URL;?>/wp-json/cpc_admin/v1/product/list",
		list: {
			match: {
				enabled: true
			},
			maxNumberOfElements: 15,
		}
	};

	$("#product").easyAutocomplete(options);
});
</script>