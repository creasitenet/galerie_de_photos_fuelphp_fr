<h3>Ajouter un Album
	<span class="pull-right">
	<?php echo Html::anchor('albums', '<i class="fa fa-chevron-left"></i> RETOUR', array('class' => 'btn btn-default btn-sm')); ?>
	</span>
</h3>

<?php echo render('albums/_form'); ?>