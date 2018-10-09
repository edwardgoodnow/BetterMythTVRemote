<?php
/**
 * Business Epic default theme options.
 *
 * 
 * @subpackage Business Epic
 */

if ( !function_exists('business_epic_get_default_theme_options' ) ) :

    /**
     * Get default theme options.
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function business_epic_get_default_theme_options()
    {

        $default = array();

        // Homepage Slider Section
        $default['business_epic_homepage_slider_option'] = 'hide';
        $default['business_epic_slider_cat_id'] = 0;
        $default['business_epic_no_of_slider'] = 3;
        $default['business_epic_slider_get_started_txt'] = esc_html__('Get Started!', 'business-epic');
        $default['business_epic_slider_get_started_link'] = '#';

        // footer copyright.
        $default['business_epic_copyright'] = esc_html__('Copyright All Rights Reserved', 'business-epic');

        // Home Page Top header Info.
        $default['business_epic_top_header_section'] = 'hide';
        $default['business_epic_top_header_section_phone_number_icon'] = 'fa-phone';
        $default['business_epic_top_header_phone_no'] = '';
        $default['business_epic_email_icon'] = 'fa-envelope-o';
        $default['business_epic_top_header_email'] = '';
        $default['business_epic_social_link_hide_option'] = 0;

        // Blog.
        $default['business_epic_sidebar_layout_option'] = 'right-sidebar';
        $default['business_epic_blog_title_option'] = esc_html__('Latest Blog', 'business-epic');
        $default['business_epic_blog_excerpt_option'] = 'excerpt';
        $default['business_epic_description_length_option'] = 40;
        $default['business_epic_exclude_cat_blog_archive_option'] = '';
        

        // Details page.
        $default['business_epic_show_feature_image_single_option'] = 'show';

        // Color Option.
        $default['business_epic_primary_color'] = '#61b9ed';
        $default['business_epic_top_header_background_color'] = '#61b9ed';
        $default['business_epic_top_footer_background_color'] = '#444444';
        $default['business_epic_bottom_footer_background_color'] = '#444444';
        $default['business_epic_front_page_hide_option'] = 0;
        $default['business_epic_breadcrumb_setting_option'] = 'enable';
        $default['business_epic_post_search_placeholder_option'] = esc_html__('Search', 'business-epic');
        $default['business_epic_hide_breadcrumb_front_page_option'] = 0;
        $default['business_epic_color_reset_option'] = 'do-not-reset';

        // Pass through filter.
        $default = apply_filters( 'business_epic_get_default_theme_options', $default );
        return $default;
    }
endif;
