<?php if(isset($album)): ?>
    
    <h3>
    <?php echo $album->titre; ?>
    <span class="pull-right">
        <a class="btn btn-primary btn-sm" href="albums/modifier/<?php echo $album->id; ?>">
        MODIFIER
        </a>
        &nbsp; 
        <a class="btn btn-danger btn-sm" href="albums/supprimer/<?php echo $album->id; ?>">
        SUPPRIMER
        </a>
    </span>
    </h3>

    <!-- Photos -->
    <?php if(isset($album->photos)): ?>

        <?php foreach ($album->photos as $photo): ?>
            <div class="col-sm-4">                       
                <div class="photo">
                    <img src="<?php echo $photo->url(); ?>" class="image image-responsive">
                </div>
            </div> 
        <?php endforeach; ?>                     
           
    <?php endif; ?>
    <!-- //Photos -->

    <div class="clearfix"></div>
    <br />
        <a class="btn btn-default btn-sm" href="albums">
        <i class="fa fa-chevron-left"></i> RETOUR
        </a>
        &nbsp; 
    </span>

<?php endif; ?>