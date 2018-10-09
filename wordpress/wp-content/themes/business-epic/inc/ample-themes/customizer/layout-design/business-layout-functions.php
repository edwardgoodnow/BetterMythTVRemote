<?php
if (!function_exists('business_epic_sidebar_layout')) :
    function business_epic_sidebar_layout()
    {
        $business_epic_sidebar_layout = array(
            'right-sidebar' => esc_html__('Right Sidebar', 'business-epic'),
            'left-sidebar' => esc_html__('Left Sidebar', 'business-epic'),
            'no-sidebar' => esc_html__('No Sidebar', 'business-epic'),
        );
        return apply_filters('business_epic_sidebar_layout', $business_epic_sidebar_layout);
    }
endif;

/**
 * Blog/Archive Description Option
 *
 * @since Business Epic 1.0.0
 *
 *
 * 
 * @param null
 * @return array $business_epic_blog_excerpt
 *
 */
if (!function_exists('business_epic_blog_excerpt')) :
    function business_epic_blog_excerpt()
    {
        $business_epic_blog_excerpt = array(
            'excerpt' => esc_html__('Excerpt', 'business-epic'),
            'content' => esc_html__('Content', 'business-epic'),

        );
        return apply_filters('business_epic_blog_excerpt', $business_epic_blog_excerpt);
    }
endif;

/**
 * Show/Hide Feature Image  options
 *
 * @since Business Epic 1.0.0
 *
 * @param null
 * @return array $business_epic_show_feature_image_option
 *
 */
if (!function_exists('business_epic_show_feature_image_option')) :
    function business_epic_show_feature_image_option()
    {
        $business_epic_show_feature_image_option = array(
            'show' => esc_html__('Show', 'business-epic'),
            'hide' => esc_html__('Hide', 'business-epic')
        );
        return apply_filters('business_epic_show_feature_image_option', $business_epic_show_feature_image_option);
    }
endif;
