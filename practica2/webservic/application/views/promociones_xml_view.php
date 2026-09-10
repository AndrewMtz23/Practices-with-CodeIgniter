<?= '<?xml version="1.0" encoding="utf-8" ?>' ?>
<promociones>
<?php
foreach ( $promociones as $row ) :
?>
	<promocion>
	<?php
	foreach( $row as $campo => $valor ) :
	?>
		<<?= $campo ?>><?= $valor ?></<?= $campo ?>>
	<?php
	endforeach;
	?>
	</promocion>
<?php
endforeach;
?>
</promociones>
