<?php
/**
 * The header for our theme.
 *
 * @package _bluetick
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <link rel="stylesheet" href="https://use.typekit.net/ddk6lsr.css">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">    
  <script src="https://kit.fontawesome.com/1a87f052ac.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,700|Libre+Baskerville:400,400i" rel="stylesheet">

  <script type="text/javascript"> 
        var is_mobile = false; 
        var is_tablet = false;  
        var template_path = "<?php echo get_template_directory_uri(); ?>";
    </script>

	<?php wp_head(); ?>

  <?php

        if (is_mobile())
        {
            echo '<script> is_mobile = true; </script>';
        }
        if (is_tablet())
        {
            echo '<script> is_tablet = true; </script>';
        }


    ?>
    
    <!--[if IE]>
        <script src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body <?php body_class(); ?>>

<header class="site-header" role="banner">    
    <div class="container">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"><?php get_template_part('img/inline', 'bluetick.svg'); ?></a>
    </div>
</header>

<div class="content-wrapper"> 
