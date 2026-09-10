<?php
$js = $js ?? array();
?>
</div>

<?php foreach ( $js as $archivo ) : ?>
	<script src="<?= base_url() ?>static/js/<?= $archivo ?>.js"></script>
<?php endforeach; ?>

</body>
</html>