<?php echo Form::open(array("class"=>"form")); ?>
	<fieldset>

        <div class="form-group margin-bottom-20">
            <label>Titre</label>
            <div class="controls">
                <?php echo Form::input('titre',  Input::post('titre', isset($album) ? $album->titre : ''), 
                array('class' => 'form-control input-lg', 'placeholder'=>"Titre de l'album")); ?>
            </div>
        </div>

        <div class="form-group margin-bottom-20">
            <div class="form-controls">
                <?php echo Form::submit('submit', 'ENREGISTRER', array('class' => 'btn btn-success btn-lg')); ?>
            </div>
   		</div>
		
	</fieldset>
<?php echo Form::close(); ?>