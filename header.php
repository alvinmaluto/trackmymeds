<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="p:domain_verify" content="093352a2d1a177b702a58838f2ed4259"/>
    <title><?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="all">
    <link href='http://fonts.googleapis.com/css?family=Maven+Pro:400,500,900,700' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
</head>
<body <?php body_class( $class ); ?>>
<header>
    <div id="header-inner">
        <!-- <a href="<?php bloginfo('url'); ?>">
            <h1><?php bloginfo('name'); ?></h1>
        </a> -->
        <a class="logo" href="<?php bloginfo('url'); ?>">
            <img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="logo" width="180px" height="29px"></a>
    </div>

    <nav>
    <ul id="nav-inner">
    <!-- new menu goes here -->
    <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
    </ul>
</nav>
</header>
