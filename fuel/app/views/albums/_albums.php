<?php if(isset($albums)): ?>
    <br />
    <?php foreach ($albums as $album): ?>

        <a href="album/<?php  echo $album->slug; ?>/<?php echo $album->id; ?>">
        <div class="col-sm-4">
        
        <div class="titre">
            <?php echo $album->titre; ?>
        </p>
        <div class="albums">
                
                <div class="photo">
                    <img src="<?php echo $album->photo_url(); ?>" class="image image-responsive">
                </div>
                <div class="nombre"><?php echo count($album->photos); ?></div>
               
        </div>        
        </div>
        </a>
    
    <?php endforeach; ?>

<?php endif; ?>