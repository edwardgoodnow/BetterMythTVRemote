<?php
/**
 * Breadcrumb  display option options
 * @param null
 * @return array $business_epic_show_breadcrumb_option
 *
 */
if (!function_exists('business_epic_show_breadcrumb_option')) :
    function business_epic_show_breadcrumb_option()
    {
        $business_epic_show_breadcrumb_option = array(
            'enable' => esc_html__('Enable', 'business-epic'),
            'disable' => esc_html__('Disable', 'business-epic')
        );
        return apply_filters('business_epic_show_breadcrumb_option', $business_epic_show_breadcrumb_option);
    }
endif;


/**
 * Reset Option
 *
 *
 * @param null
 * @return array $business_epic_reset_option
 *
 */
if (!function_exists('business_epic_reset_option')) :
    function business_epic_reset_option()
    {
        $business_epic_reset_option = array(
            'do-not-reset' => esc_html__('Do Not Reset', 'business-epic'),
            'reset-all' => esc_html__('Reset All', 'business-epic'),
        );
        return apply_filters('business_epic_reset_option', $business_epic_reset_option);
    }
endif;



/**
 * Sanitize Multiple Category
 * =====================================
 */

if ( !function_exists('business_epic_sanitize_multiple_category') ) :

    function business_epic_sanitize_multiple_category( $values )
    {

        $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

        return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
    }

endif;
