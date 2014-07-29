<?php
/**
 * The template for displaying the header
 *
 * @package WordPress
 * @subpackage FiWi_Starter_Kit
 * @since FiWi Starter Kit 1.0
 */
?>
<!doctype html>

<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?> id="returnTop"><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. --> 

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    
    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <title><?php bloginfo('name') ?> &raquo; <?php is_front_page() ? bloginfo('description') : wp_title('|', true, 'right'); ?></title>
    
    <meta name="description" content="<?php bloginfo('description') ?>" />
    <meta name="author" content="Findsome &amp; Winmore" />
    <!-- Google will often use this as its description of your page/site. Make it good. -->
    
    <meta name="google-site-verification" content="" />
    <!-- Speaking of Google, don't forget to set your site up: http://google.com/webmasters -->

    <meta name="Copyright" content="<?php echo date('Y'); ?>" />

   <meta name="viewport" content="width=device-width, initial-scale=1"/>
   <meta name="apple-mobile-web-app-capable" content="yes" /> 
   <meta name="apple-touch-fullscreen" content="yes" />


    <link rel="shortcut icon" href="assets/img/favicons/favicon.png" />
    <link rel="apple-touch-icon" href="assets/img/favicons/apple-touch-icon-precomposed.png" />

	<?php 

        /*
         * Wordpress Head
         */
    
        wp_head(); 

    ?>
</head>

<body <?php body_class() ?>>
<!--[if lt IE 8]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
