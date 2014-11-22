		<!-- Alertes -->
        <div id="alertes"> 
                <?php if (Session::get_flash('success')): ?>
                    <div class="alert alert-success alert-dismissable fade in">                                
                        <button class="close" data-dismiss="alert">×</button>
                        <p><?php echo implode('</p><p>', (array) Session::get_flash('success')); ?></p>
                    </div>
                <?php endif; ?>

                <?php if (Session::get_flash('error')): ?>
                    <div class="alert alert-danger alert-dismissable fade in">
                        <button class="close" data-dismiss="alert">×</button>
                        <p><strong><?php echo implode('</p><p>', (array) Session::get_flash('error')); ?></strong></p>
                    </div>
                <?php endif; ?>
        </div>
        <!-- // Alertes -->