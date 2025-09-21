<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="header-top">
            <div class="container">
                <div class="header-content">
                    <div class="site-branding">
                        <?php if (has_custom_logo()) : ?>
                            <div class="logo-wrapper">
                                <?php the_custom_logo(); ?>
                            </div>
                        <?php else : ?>
                            <div class="site-title-wrapper">
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title">
                                    <span class="site-icon">🎬</span>
                                    <?php bloginfo('name'); ?>
                                </a>
                                <p class="site-description"><?php bloginfo('description'); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="header-actions">
                        <div class="header-search">
                            <?php get_search_form(); ?>
                        </div>
                        
                        <button class="mobile-menu-toggle" aria-label="Toggle mobile menu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- <nav class="main-navigation">
            <div class="container">
                <div class="nav-wrapper">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'nav-menu',
                        'container'      => false,
                        'fallback_cb'    => 'default_nav_menu',
                    ));
                    ?>
                    
                    <div class="nav-social">
                        <a href="#" class="social-link" title="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="social-link" title="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="social-link" title="TikTok"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
        </nav> -->
    </header>

    <main class="site-main">
