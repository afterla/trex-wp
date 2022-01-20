 <?php

$benefits = get_field('benefit', $post);
?>
<div class="contenedor seccion_beneficios">
	<div class="row padd-8">
			<div class="caja_texto richtext">
			<?php
			if($benefits){
				foreach($benefits as $benf){
					$name=$benf['name'];
					$list=explode("\n", $benf['value']);
					echo '<span class="titulo">'.$name.'</span>'."\n";
					
					echo '<ul>';
					foreach($list as $val){
						if(!empty($val)) echo '<li>'.$val.'</li>'."\n";
					}
					echo '</ul>';
				}
			}
			?>
			</div>
				
	</div>
</div>
