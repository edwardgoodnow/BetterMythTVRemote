<?php

/**
 * Slider  options
 * @param null
 * @return array $business_epic_slider_option
 *
 */
if (!function_exists('business_epic_slider_option')) :
    function business_epic_slider_option()
    {
        $business_epic_slider_option = array(
            'show' => esc_html__('Show', 'business-epic'),
            'hide' => esc_html__('Hide', 'business-epic')
        );
        return apply_filters('business_epic_slider_option', $business_epic_slider_option);
    }
endif;