<h2>Galerie - FuelPHP 1.7.3</h2>

<div class="form">
<fieldset>

    <?php 
    // Ajout du css pour l'upload
    echo Asset::css('fileupload/jquery.fileupload.css');
    // Ajout du js pour l'upload
    echo Asset::js('fileupload/jquery.fileupload.js');
    echo Asset::js('fileupload/fileupload_init.js');
    ?>
    
    <form action="#" method="post" enctype="multipart/form-data">
        <div id="fileupload">
            <div id="fileupload_loader"></div>
            <span class="message">Glissez vos photos ici (ou cliquez) <br /><small> 1mo 1024x1024px</small></span>
            <center><input class="file-upload" type="file" name="fileup" /></center>
        </div>
    </form>
    
</fieldset>
<div class="clearfix"></div>
</div>

<div id='pictures'>
	<div class="row">
    <?php if(isset($pictures)): ?>    
        <?php //echo render('galerie/_pictures'); ?>
        <?php include('_pictures.php'); ?>
    <?php endif; ?>
    </div>
</div>