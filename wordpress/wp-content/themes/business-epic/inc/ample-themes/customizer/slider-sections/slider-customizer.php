<?php
/**
 * HomePage Settings Panel on customizer
 */
$wp_customize->add_panel(
    'business_epic_homepage_settings_panel',
    array(
        'priority' => 5,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__('HomePage Slider Settings', 'business-epic'),
    )
);

/*-------------------------------------------------------------------------------------------------*/
/**
 * Slider Section
 *
 */
$wp_customize->add_section(
    'business_epic_slider_section',
    array(
        'title' => esc_html__('Slider Section', 'business-epic'),
        'panel' => 'business_epic_homepage_settings_panel',
        'priority' => 6,
    )
);

/**
 * Show/Hide option for Homepage Slider Section
 *
 */

$wp_customize->add_setting(
    'business_epic_homepage_slider_option',
    array(
        'default' => $default['business_epic_homepage_slider_option'],
        'sanitize_callback' => 'business_epic_sanitize_select',
    )
);
$hide_show_option = business_epic_slider_option();
$wp_customize->add_control(
    'business_epic_homepage_slider_option',
    array(
        'type' => 'radio',
        'label' => esc_html__('Slider Option', 'business-epic'),
        'description' => esc_html__('Show/hide option for homepage Slider Section.', 'business-epic'),
        'section' => 'business_epic_slider_section',
        'choices' => $hide_show_option,
        'priority' => 7
    )
);

/**
 * Dropdown available category for homepage slider
 *
 */


$wp_customize->add_setting(
    'business_epic_slider_cat_id',
    array(
        'default' => $default['business_epic_slider_cat_id'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(new business_epic_Customize_Category_Control(
        $wp_customize,
        'business_epic_slider_cat_id',
        array(
            'label' => esc_html__('Slider Category', 'business-epic'),
            'description' => esc_html__('Select Category for Homepage Slider Section', 'business-epic'),
            'section' => 'business_epic_slider_section',
            'priority' => 8,

        )
    )
);
/**
 * Field for no of posts to display..
 *
 */
$wp_customize->add_setting(
    'business_epic_no_of_slider',
    array(
        'default' => $default['business_epic_no_of_slider'],
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'business_epic_no_of_slider',
    array(
        'type' => 'number',
        'label' => esc_html__('No of Slider', 'business-epic'),
        'section' => 'business_epic_slider_section',
        'priority' => 10
    )
);


/**
 * Field for Get Started button text
 *
 */
$wp_customize->add_setting(
    'business_epic_slider_get_started_txt',
    array(
        'default' => $default['business_epic_slider_get_started_txt'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'business_epic_slider_get_started_txt',
    array(
        'type' => 'text',
        'label' => esc_html__('Get Started Button', 'business-epic'),
        'section' => 'business_epic_slider_section',
        'priority' => 11
    )
);

/**
 * Field for Get Started button Link
 *
 */
$wp_customize->add_setting(
    'business_epic_slider_get_started_link',
    array(
        'default' => $default['business_epic_slider_get_started_link'],
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    'business_epic_slider_get_started_link',
    array(
        'type' => 'url',
        'label' => esc_html__('Get Started Button Link', 'business-epic'),
        'description' => esc_html__('Use full url link', 'business-epic'),
        'section' => 'business_epic_slider_section',
        'priority' => 20
    )
);

/*----------------------------------------------------------------------------------------------*/
	