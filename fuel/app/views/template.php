<!DOCTYPE html>
<!-- Creasitenet -->
<!-- Edouard Boissel -->
<!-- Réalisation de sites internet -->

<!-- 
/***********************************/
Auteur du site : Creasitenet 
URL : http://www.creasitenet.com
Contact: creasitenet@creasitenet.com
/***********************************/
-->

<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Galerie - FuelPHP 1.7.3</title>
    <meta name="description" content="Todo sous FulPHP" />
    <meta name="keywords" content="Todo, liste de tâches" />
    <link rel="icon" type="image/ico" href="<?php Uri::base(); ?>assets/img/favicon.ico" />
    <link rel="shortcut icon" type="image/ico" href="<?php Uri::base(); ?>assets/img/favicon.ico" />
    <base href="<?php echo Uri::base(); ?>" />

    <!-- CSS -->        
        <!-- Bootstrap // Variante slate --> 
        <?php echo Asset::css('bootstrap/css/bootstrap.min.css'); ?>
       
        <!-- Plugins css  -->
        <?php echo Asset::css('font-awesome/css/font-awesome.min.css'); ?>
        <?php echo Asset::css('growl/jquery.growl.css'); ?>

        <!-- Customs  -->
        <?php echo Asset::css('app.css'); ?>
        
        <!-- Js -->
        <?php echo Asset::js('jquery/jquery.min.js'); ?>
     
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

</head>
<body>

    <!-- Wrapper-->
	<div class="wrapper">	
    
    	<a href="https://github.com/creasitenet/galerie_de_photos_fuelphp_fr" target="_blank">
	        <img style="position: absolute; top: 0; right: 0; border: 0; z-index: 1;" src="https://camo.githubusercontent.com/365986a132ccd6a44c23a9169022c0b5c890c387/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f7265645f6161303030302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png">
	    </a>
                          
        <?php echo render('_header'); ?>
        <?php echo render('_notifications'); ?>	
			           	              	
		<div class="container content">				
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">				
					<?php echo $content; ?>
				</div>
			</div>		
		</div>
            
        <?php echo render('_footer'); ?>
				
	</div>
    <!-- // Wrapper-->

	<?php echo render('_notifications_growl'); ?> 
    
    <!-- Js --> 
    <!-- Bootstrap -->   
    <?php echo Asset::js('bootstrap/js/bootstrap.min.js'); ?>
    <!-- Plugins -->
    <?php echo Asset::js('growl/jquery.growl.js'); ?>
    <!-- Customs --> 
    <?php echo Asset::js('app.js'); ?>


</body>
</html>

 
