
    <?php if(isset($photos)): ?>         
        <?php foreach ($photos as $photo): ?>
                <div id="photo_<?php echo $photo->id; ?>" class="col-sm-4">
                <div class="photo">

                    <!-- Bouton de suppression -->
                    <div class="inphoto">
                        <a href="upload/supprimer_photo/<?php echo $photo->id; ?>"><i class="fa fa-times bntsup"></i></a>                       
                    </div>

                    <img src="<?php echo $photo->url(); ?>" class="image image-responsive" />
                    
                </div>
                </div>
        <?php endforeach; ?>
    <?php endif; ?>