
<h3>Modifier l'album 
	<span class="pull-right">
    <?php echo Html::anchor('albums', '<i class="fa fa-chevron-left"></i> RETOUR', array('class' => 'btn btn-default btn-sm')); ?>
    </span>
	<small><br /><?php echo $album->titre; ?></small>
</h3>

<?php echo render('albums/_form'); ?>

<!-- photos -->
<br />
<h4>&nbsp;Photos</h4>
<div class="form">
<fieldset>

    <?php 
    // Ajout du css pour l'upload
    echo Asset::css('fileupload/jquery.fileupload.css');
    // Ajout du js pour l'upload
    echo Asset::js('fileupload/jquery.fileupload.js');
    echo Asset::js('fileupload/fileupload_init.js');
    // Enregistrer l'album_id dans la session session
    Session::set('upload_id', $album->id);
    ?>
    
    <form action="#" method="post" enctype="multipart/form-data">
        <div id="fileupload">
            <div id="fileupload_loader"></div>
            <span class="message">Glissez vos photos ici (ou cliquez) <br /><small> 1mo 1024x1024px</small></span>
            <center><input class="file-upload" type="file" name="fileup" /></center>
        </div>
    </form>
    
    <div id='photos'>
    <?php if(isset($photos)): ?>    
        <?php echo render('albums/_modifier_photos'); ?>
    <?php endif; ?>
    </div>

</fieldset>
<div class="spacer"></div>
</div>
<!-- // photos -->