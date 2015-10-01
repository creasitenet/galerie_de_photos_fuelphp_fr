
    <!-- Photos -->
    <?php if(isset($pictures)): ?>

        <?php foreach($pictures as $e): ?>
            <div class="col-sm-3">            
                <div id="picture_<?php echo $e->id; ?>">
                <div class="picture">

                    <!-- Bouton de suppression -->
                    <div class="inpicture">
                        <a href="upload/getAjaxDelete/<?php echo $e->id; ?>"><i class="fa fa-times bntsup"></i></a>                       
                    </div>
                    <img src="<?php echo $e->uri(); ?>" class="image image-responsive" />
                    
                </div>
                </div>   
            </div> 
        <?php endforeach; ?>                     
           
    <?php endif; ?>
    <!-- //Photos -->
