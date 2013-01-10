<!DOCTYPE html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width" />
<html>
  <head>
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
  <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700|Chivo:400,900,400italic,900italic' rel='stylesheet' type='text/css'>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/prefixfree.min.js" charset="utf-8"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/custom.js" charset="utf-8"></script>
  <!--[if lt IE 9]><script src="<?php bloginfo('template_url'); ?>/js/html5.js" charset="utf-8"></script><![endif]-->
  <title><?php
  /*
   * Print the <title> tag based on what is being viewed.
   */
  global $page, $paged;
  
  wp_title( '|', true, 'right' );
  
  // Add the blog name.
  bloginfo( 'name' );
  
  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    echo " | $site_description";
  
  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 )
    echo ' | ' . sprintf( __( 'Page %s', 'bnb' ), max( $paged, $page ) );
  
  ?></title>
  <?php wp_head(); ?>
  </head>
  <body>
    <div id="page">
    <header>
      <div class="wrapper">
      <hgroup>
        <h1><?php echo get_bloginfo( 'name' ); ?></h1>
        <h2><?php bloginfo( 'description' ); ?></h2>
        <a href="<?php bloginfo('home'); ?>" id="logo"><img src="<?php bloginfo('template_url'); ?>/images/bnb_logo.png" /></a>
      </hgroup>
      <nav><?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?></nav>
      <ul id="social">
        <li><a href="http://pinterest.com/brixandbitter/" title="Brix and Bitter on Pintrest"><img src="<?php bloginfo('template_url'); ?>/images/pintrest.png" alt="Brix and Bitter on Pintrest" /></a></li>
        <li><a href="http://twitter.com/brixandbitter" title="Brix and Bitter on Twitter"><img src="<?php bloginfo('template_url'); ?>/images/twitter.png" alt="Brix and Bitter on Twitter" /></a></li>
        <li><a href="https://www.facebook.com/pages/Brix-Bitter/426999590692709?ref=hl" title="Brix and Bitter on Facebook"><img src="<?php bloginfo('template_url'); ?>/images/facebook.png" alt="Brix and Bitter on Facebook" /></a></li>
        <li><a href="http://instagram.com/brixandbitter/" title="Brix and Bitter on Instagram"><img src="<?php bloginfo('template_url'); ?>/images/instagram.png" alt="Brix and Bitter on Instagram" /></a></li>
      </ul><!-- /#social -->
      </div><!-- /.wrapper -->
    </header>