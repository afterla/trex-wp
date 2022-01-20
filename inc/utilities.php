<?php
/*------------------------------------------------
-- DECLARA VARIABLES TIPO REQUEST PERMITIDAS --
------------------------------------------------*/

function get_Mes($date, $short=false){
$meses = array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');

$mes=$meses[date('m', $date)];

return $short? substr($mes, 0, 3): $mes;
}

function get_Dia($date, $short=false){
$dias = array('01'=>'Lunes','02'=>'Martes','03'=>'Miercoles','04'=>'Jueves','05'=>'Viernes','06'=>'Sábado','07'=>'Domingo');

$dia=$dias[date('m', $date)];

return $short? substr($dia, 0, 3): $dia;
}

function get_url_youtube($source, $width=527, $height=295){

return preg_replace("/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "<iframe u=\"image\" width=\"$width\" height=\"$height\" src=\"//www.youtube.com/embed/$2\" frameborder=\"0\" allowfullscreen></iframe>", $source);
}

function add_query_vars_filter( $vars ){
  $vars[] = 'category';
  $vars[] = 'keyword';
  $vars[] = 'parent';
  $vars[] = 'location';
  $vars[] = 'promo';
  $vars[] = 'view';
  $vars[] = 'add';
  $vars[] = 'id';

  $vars[] = 'utm_campaign';
  $vars[] = 'utm_source';
  $vars[] = 'utm_medium';
  $vars[] = 'utm_content';

  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

/*------------------------------------------------
-- MODIFICACIÓN DEL EDITOR DE TEXTO ENRIQUECIDO --
------------------------------------------------*/
//Remove the format dropdown select and text color selector
function myplugin_tinymce_buttons( $buttons ) {
	$remove = array( 'hr', 'forecolor' );
	return array_diff( $buttons, $remove );
}

//remove_filter( 'the_content', 'wpautop' );
//remove_filter( 'the_excerpt', 'wpautop' );

/*----------------------------------
-- CALIDAD DEL REZISE DE IMAGENES --
----------------------------------*/
function optimizar_calidad_jpg( $quality ) { return 100; }
add_filter( 'jpeg_quality', 'optimizar_calidad_jpg' );


function get_product_features($product, $max=4){
  $specs = get_field('specification', $product);
  $features = array();

  if(!$specs) return null;

  $k=0;
  foreach($specs as $spec){
      $detail = $spec['detail'];
      foreach ($detail as $item) {
        $flag = $item['flag'];
        if($flag){
          if($k++>=$max) break;
          $features[]=$item;
        }
    }
  }

  if( count($features)>0 ) return $features;

  $k=0;
  foreach($specs as $spec){
    if($spec['category']=='Motor' || $spec['category']=='Transmisión'){
      $detail = $spec['detail'];
      foreach ($detail as $item) {
        if($k++>=$max) break;
        $features[]=$item;
      }
    }
  }

return $features;
}

function get_product_spec($product, $category, $name){
  $specs = get_field('specification', $product);

  foreach($specs as $spec){
    if(trim($spec['category'])==trim($category)){
      $detail = $spec['detail'];
      foreach ($detail as $item) {
        if(trim($item['name'])==trim($name)){
          return $item['value'];
        }
      }      
    }
  }

return null;
}

function get_post_by_slug($slug){
    $posts = get_posts(array(
            'name' => $slug,
            'posts_per_page' => 1,
            'post_type' => 'page',
            'post_status' => 'publish'
    ));

    if(! $posts ) {
        null;
    }

    return $posts[0];
}

/**
 * Replace a {TEMPLATE_URL} for every post page.
 *
 * @uses is_single()
 */
function template_url_filter( $content ) {

	$content=str_replace('{TEMPLATE_URL}', TEMPLATE_URL, $content);

    // Returns the content.
    return $content;
}
add_filter( 'the_content', 'template_url_filter', 20 );

function callback($buffer) {
    // You can modify $buffer here, and then return the updated code
    return $buffer;
}
function buffer_start() { ob_start("callback"); }
function buffer_end() { ob_end_flush(); }
// Add hooks for output buffering
add_action('init', 'buffer_start');
add_action('wp_footer', 'buffer_end');

// filter
function my_posts_where( $where ) {
  
  $where = str_replace("meta_key = 'grupos_$", "meta_key LIKE 'grupos_%", $where);

  return $where;
}
add_filter('posts_where', 'my_posts_where');


// Validate ruc format.
add_filter( 'wpcf7_validate_text', 'custom_ruc_validation_filter', 10, 2);
add_filter( 'wpcf7_validate_text*', 'custom_ruc_validation_filter', 10, 2);

function custom_ruc_validation_filter( $result, $tag ) {
    if ( 'RUC' == $tag->name ) {
        $ruc = isset( $_POST['RUC'] ) ? trim( $_POST['RUC'] ) : '';
 
        if ( !empty($ruc) && !validateRuc($ruc) ){
            $result->invalidate( $tag, "El RUC ingresado no es válido" );
        }
    }
 
    return $result;
}


function validateRuc($value)
{
    $value = trim((string)$value);
    if (is_numeric($value)) {
        if (($valuelength = strlen($value)) == 11){
            $sum = 0;
            $x = 6;
            for ($i = 0; $i < $valuelength - 1; $i++){
                if ( $i == 4 ) {
                    $x = 8;
                }
                $digit = charAt($value, $i) - '0';
                $x--;
                if ( $i==0 ) {
                    $sum += ($digit*$x);
                } else {
                    $sum += ($digit*$x);
                }
            }
            $diff = $sum % 11;
            $diff = 11 - $diff;
            if ($diff >= 10) {
                $diff = $diff - 10;
            }
            if ($diff == charAt($value, $valuelength - 1 ) - '0') {
                return true;
            }
            return false; 
        }
    }
    return false;
}
function validateDni($value)
{
    if (is_numeric($value)) {
        return strlen($value) == 8;
    }
    return false;
}
function charAt($string, $index){
    if($index < mb_strlen($string)){
        return mb_substr($string, $index, 1);
    }
    else{
        return -1;
    }
}

/**
 * Move comment field to bottom on form.
 *
 * @uses is_single()
 */
function wpb_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );

function get_target($url){
  $tar = !empty($url) && !strstr($url, WEB_URL)? '_blank': '_self';
  return $tar;
}

function get_extract($texto, $limit = 25) {
	$texto = trim(strip_tags($texto));
	$excerpt = explode(' ', $texto, $limit);
	if(count($excerpt) >= $limit){
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'... <span class="bticon-vermas"></span>';
	}else{
		$excerpt = implode(" ",$excerpt).'';
	}
	$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
	return $excerpt;
}

function get_extract_search($texto) {
  $texto = trim(strip_tags($texto));
  $excerpt = explode(' ', $texto, 60);
  if(count($excerpt) >= $limit){
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  }else{
    $excerpt = implode(" ",$excerpt).'';
  }
  $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
  return $excerpt;
}

function get_fulltext($texto) {
  $texto = trim(strip_tags($texto));
  $excerpt = explode(' ', $texto, $limit);
  if(count($excerpt) > 0){
    array_pop($excerpt);
    $excerpt = $texto.' <span class="bticon-vermas active"></span>';
  }
  $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
  return $excerpt;
}

function get_top_parents($post_id){

  $parents = get_post_ancestors( $post_id );
  sort($parents);

  return $parents;
}

function get_top_parent_id($parent_id, $level=1){

	$parents = get_post_ancestors( $parent_id );

	return $parents[count($parents)-$level];
}

function get_pagination($tmp_query){
global $wp_query;

	wp_pagenavi();
	$wp_query = $tmp_query;	
}

