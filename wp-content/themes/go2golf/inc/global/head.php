<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

<link href="//www.google-analytics.com" rel="dns-prefetch">

<meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="description" content="<?php bloginfo('description'); ?>">

<!-- IE stuff -->
<!--[if lt IE 9]>
<link rel="stylesheet" href="<?php echo getThemePath(); ?>/dist/css/ie.css">
<![endif]-->

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?php echo getBasePath(); ?>/favicon.ico" rel="shortcut icon">

<link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

<?php wp_head(); ?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PD92CDK');</script>
<!-- End Google Tag Manager -->

<!-- Make our theme path accessible in Javascript -->
<script>var getThemePath = '<?php echo getThemePath(); ?>';</script>

</head>