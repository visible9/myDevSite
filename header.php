<?php
/**
 * Header.
 */

use theme\ThemeNavigation;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Set up Meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="<?php bloginfo('charset'); ?>">

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <!-- Remove Microsoft Edge's & Safari phone-email styling -->
    <meta name="format-detection" content="telephone=no,email=no,url=no">

    <?php wp_head(); ?>
</head>

<body <?php body_class('no-outline base-theme'); ?>>
<?php wp_body_open(); ?>

<!-- <div class="preloader">
    <div class="preloader__icon"></div>
</div> -->

<!-- BEGIN of header -->
<header class="header is-root-container">
    <div class="header-inner">
        <div class="logo">
            <?php show_custom_logo(); ?>
        </div>
        <?php if (has_nav_menu('header-menu')) { ?>
            <div class="main-menu-container">
                <div class="title-bar">
                    <button class="menu-icon" type="button" aria-label="Menu">
                        <span></span>
                    </button>
                </div>
                <nav class="top-bar" id="main-menu">
                    <?php wp_nav_menu([
                        'theme_location' => 'header-menu',
                        'menu_class' => 'menu header-menu',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'walker' => new ThemeNavigation(),
                    ]); ?>
                </nav>
            </div>
        <?php } ?>
    </div>
</header>
<!-- END of header -->
