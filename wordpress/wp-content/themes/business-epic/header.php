<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bussiness_Epic
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
    <meta name="keywords" content="best, penny auction, auction software,  penny auction software, penny auction script, online auction software, auction website software, create an auction website, auction script, php auction platform, real estate auction software, automotive auction software, Quibids, Dealdash, OrangeBidz, clone, NodeJS, CodeIgniter"/>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'business-epic') ?></a>
    <a href="#" class="scrollup"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>
    <header id="masthead" class="site-header" role="banner">
        <!-- Start Top header Section -->
        <?php
        /**
         * The template for displaying all pages.
         *
         * This is the template that displays all pages by default.
         * Please note that this is the WordPress construct of pages
         * and that other 'pages' on your WordPress site may use a
         * different template.
         *
         * @link https://codex.wordpress.org/Template_Hierarchy
         *
         * @subpackage Business Epic
         */
        // retrieving Customizer Value
        ?>
        <!-- End Top header Section -->
        <!-- Start logo and menu Section -->
        <div class="main-header">
            <div class="container">
                <!-- Start Site title Section -->
                <div class="site-branding">
                    <h1 class="site-title">
                        <!-- <img src="images/logo.png" alt=""> -->
                        <?php
                        //if (has_custom_logo()) { ?>
                           
                        <?php //} else {
                        if (is_front_page() && is_home()) : ?>
                            
                        <?php else : ?>
                            <p class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>"
                                   rel="home"><img src="/wp-content/themes/logo.png" /></a>
                            </p>
                            <?php
                        endif;
                        ?>
                    </h1>
                    <?php
                     $section_option = business_epic_get_option('business_epic_top_header_section');
       // if ($section_option == 'show') {
            $mobile_icon = business_epic_get_option('business_epic_top_header_section_phone_number_icon');
            $mobile_value = business_epic_get_option('business_epic_top_header_phone_no');
            $email_icon = business_epic_get_option('business_epic_email_icon');
            $email_value = business_epic_get_option('business_epic_top_header_email');
            $social_menu = business_epic_get_option('business_epic_social_link_hide_option');
            ?>
            <div class="top-header">
                <div class="container">
                    <div class="row">


                        <!-- Start top contact info Section -->
                        <div class="col-xs-12 col-sm-6">
                            <div class="top-header-contact-info">

                                <?php
                                 $description = get_bloginfo('description', 'display');
                    if ($description || is_customize_preview()) : ?>
                        <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                        <?php
                    endif;
                                // echo  $mobile_icon;
                                if (!empty($mobile_value)) {
                                    ?>
                                    <a class="top-phone" href="<?php echo esc_url('tel:' . $mobile_value) ?>"><i
                                            class="fa  <?php echo esc_attr($mobile_icon); ?>"></i><?php echo esc_html($mobile_value); ?>
                                    </a>

                                <?php }

                                if (!empty($email_value)) {
                                    ?>
                                    <a class="top-email" href="<?php echo esc_url('mailto:' . $email_value); ?>"><i
                                            class="fa <?php echo esc_attr($email_icon); ?>"></i> <?php echo esc_html($email_value); ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- End top contact info Section -->


                        <!-- Start top social icon Section -->
                        <div class="col-xs-12 col-sm-6">
                            <div class="header-search">
                                <p class="search-btn"><i class="fa fa-search" aria-hidden="true"></i></p>
                                <?php get_search_form(); ?>
                            </div>

                            <?php
                            if ($social_menu == 1) {

                                ?>
                                <div class="top-header-socialicon">

                                    <?php
                                    if (has_nav_menu('social-link')) {
                                        wp_nav_menu(array('theme_location' => 'social-link', 'menu_class' => 'menu', 'menu_id' => 'menu-social-menu'));

                                    }
                                    ?>

                                </div>

                            <?php } 
                           
                            
                            ?>
                        </div>
                        <!-- End top social icon Section -->


                    </div>
                </div>
            </div>
        <?php // }
                    
                    //} ?>
                </div>
                <!-- End Site title Section -->
                <!-- Start Menu Section -->
                <div class="menu">
                    <!--<nav id="site-navigation" class="main-navigation" role="navigation"> -->
                    <div class="nav-wrapper">
                        <!-- for toogle menu -->
                        <div class="visible-xs visible-sm  clearfix"><span id="showbutton" class="clearfix"><img
                                    class="img-responsive grow"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/button.png" alt=""/></span>
                        </div>
                        <div class=""></div>

                        <nav class="column-12 im-hiding">
                            <div class="clearfix">
                                <?php
                                if (has_nav_menu('primary')) {
                                    wp_nav_menu(array(
                                            'theme_location' => 'primary',
                                            'menu_class' => 'main-nav',
                                            'depth' => 4,

                                        )
                                    );
                                }
                                ?>
                        </nav>
                        <script>
                          jQuery(document).ready(function(){ 
                             jQuery('.main-nav a').each(function(){     
                                loc = window.location.href;
                                if($(this).attr('href') == loc){
                                  $(this).parent().addClass('active');
                                }
                             })  
                         })
                        </script>   
                        <!-- / main nav -->
                    </div>
                    <!-- </nav> -->
                </div>
                <!-- End Menu Section -->
                <h2>Test Drive The newest, Best Penny Auction Software, free for ten days</h2>
            </div>
        </div>
        <!-- End logo and menu Section -->
    </header>
