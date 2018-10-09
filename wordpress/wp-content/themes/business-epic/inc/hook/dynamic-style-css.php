<?php
/**
 * Dynamic css
 *
 * @package Ample Themes
 * @subpackage Business Epic
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('business_epic_dynamic_css') ):
    function business_epic_dynamic_css(){

        $business_epic_top_header_color = esc_attr( business_epic_get_option('business_epic_top_header_background_color') );

        $business_epic_top_footer_color = esc_attr( business_epic_get_option('business_epic_top_footer_background_color') );


        $business_epic_primary_color = esc_attr( business_epic_get_option('business_epic_primary_color') );
        
        $business_epic_bottom_footer_color = esc_attr( business_epic_get_option('business_epic_bottom_footer_background_color') );




        $custom_css = '';


        /*====================Dynamic Css =====================*/
        $custom_css .= ".top-header{
         background-color: " . $business_epic_top_header_color . ";}
    ";

        $custom_css .= ".ample-business-topfooter{
         background-color: " . $business_epic_top_footer_color . ";}
    ";

            $custom_css .= ".post-content a.continue-link, .service-icon .fa , h5.clientname,.main-header .site-title a, .leavecomment a,.widget-inner-title a:hover,
             .main-header .site-title a, .read-more-background:hover, .service-icon .fa, .feature-item .feature-item-icon, .widget-inner-title a:hover, .our-team-item-content .team-title:hover, h5.clientname, .view-more, .posted-on a:hover, .posted-by a:hover, .blog-details .entry-header .entry-title a:hover, .leavecomment a, .main-nav li:hover > a, .middle-footer .widget-area ul li a:hover, .widget-recentpost ul li a:hover, .widget-archives ul li a:hover, .widget-categories ul li a:hover, article.post .entry-header .entry-title a:hover, article.post .entry-meta .posted-on a:hover, article.post .entry-meta .posted-by a:hover, article.post .entry-meta .category-tag a:hover, .article-readmore:hover, .authur-title a:hover, .contact-page-content ul li .fa, .team-title a{
    
           color: " . $business_epic_primary_color . ";}
    ";

        $custom_css .= ".post-rating, .service-icon div, .widget-ample-business-theme-counter, .portfolioFilter .current, .portfolioFilter a:hover, .paralex-btn:hover, .view-more:hover, .features-slider .owl-theme .owl-controls .owl-page.active span, .widget-ample-business-theme-testimonial .owl-theme .owl-controls .owl-page.active span, .read-more-background, .widget-ample-business-theme-testimonial, .widget-ample-business-theme-meetbutton, .footer-tags a:hover, .ample-inner-banner, .breadcrumbs, .widget-search .search-submit:hover, .posts-navigation .nav-previous, .posts-navigation .nav-next, .pagination-blog .pagination > .active > a, .pagination-blog .pagination > li > a:hover, .scrollup ,.widget_search .search-submit ,posts-navigation .nav-previous,.posts-navigation .nav-next
    
 {
    
           background-color: " . $business_epic_primary_color . ";}
           
    ";
        $custom_css .= ".error404 .content-area .search-form .search-submit , #home-page-widget-area .widget-footer-top{
           background: " . $business_epic_primary_color . ";}
           
    ";
        $custom_css .= ".error404 .content-area .search-form .search-submit,.nav-previous a, .nav-next a,.nav-previous a:hover,.nav-next a:hover{
           background: " . $business_epic_primary_color . ";}
           
    ";
        $custom_css .= ".site-footer.bottom-footer{
           background: " . $business_epic_bottom_footer_color . ";}
           
    ";


        /*------------------------------------------------------------------------------------------------- */

        /*custom css*/


        wp_add_inline_style('business-epic-style', $custom_css);

    }
endif;
add_action('wp_enqueue_scripts', 'business_epic_dynamic_css', 99);