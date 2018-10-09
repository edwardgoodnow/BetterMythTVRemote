<?php
/**
 * Business Epic Header Info Section
 *
 */
$wp_customize->add_section(
    'business_epic_top_header_info_section',
    array(
        'priority' => 6,
        'capability' => 'edit_theme_options',
        'title' => esc_html__('Top Header Info', 'business-epic'),
    )
);

$wp_customize->add_setting(
    'business_epic_top_header_section',
    array(
        'default' => $default['business_epic_top_header_section'],
        'sanitize_callback' => 'business_epic_sanitize_select',
    )
);

$hide_show_top_header_option = business_epic_slider_option();
$wp_customize->add_control(
    'business_epic_top_header_section',
    array(
        'type' => 'radio',
        'label' => esc_html__('Top Header Info Option', 'business-epic'),
        'description' => esc_html__('Show/hide Option for Top Header Info Section.', 'business-epic'),
        'section' => 'business_epic_top_header_info_section',
        'choices' => $hide_show_top_header_option,
        'priority' => 5
    )
);

/**
 * Field for Font Awesome Icon
 *
 */
$wp_customize->add_setting(
    'business_epic_top_header_section_phone_number_icon',
    array(
        'default' => $default['business_epic_top_header_section_phone_number_icon'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'business_epic_top_header_section_phone_number_icon',
    array(
        'type' => 'text',
        'description' => esc_html__('Insert Font Awesome Class Name', 'business-epic'),
        'section' => 'business_epic_top_header_info_section',
        'priority' => 6
    )
);

/**
 * Field for Top Header Phone Number
 *
 */
$wp_customize->add_setting(
    'business_epic_top_header_phone_no',
    array(
        'default' => $default['business_epic_top_header_phone_no'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'business_epic_top_header_phone_no',
    array(
        'type' => 'text',
        'label' => esc_html__('Phone Number', 'business-epic'),
        'section' => 'business_epic_top_header_info_section',
        'priority' => 8
    )
);

/**
 * Field for Fonsome Icon
 *
 */
$wp_customize->add_setting(
    'business_epic_email_icon',
    array(
        'default' => $default['business_epic_email_icon'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'business_epic_email_icon',
    array(
        'type' => 'text',
        'description' => esc_html__('Insert Font Awesome Class Name', 'business-epic'),
        'section' => 'business_epic_top_header_info_section',
        'priority' => 8
    )
);

/**
 * Field for Top Header Email Address
 *
 */
$wp_customize->add_setting(
    'business_epic_top_header_email',
    array(
        'default' => $default['business_epic_top_header_email'],
        'sanitize_callback' => 'sanitize_email',
    )
);
$wp_customize->add_control(
    'business_epic_top_header_email',
    array(
        'type' => 'email',
        'label' => esc_html__('Email Address', 'business-epic'),
        'section' => 'business_epic_top_header_info_section',
        'priority' => 8
    )
);


/**
 *   Show/Hide Social Link
 */
$wp_customize->add_setting(
    'business_epic_social_link_hide_option',
    array(
        'default' => $default['business_epic_social_link_hide_option'],
        'sanitize_callback' => 'business_epic_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_epic_social_link_hide_option',
    array(
        'label' => esc_html__('Hide/Show Social Menu', 'business-epic'),
        'section' => 'business_epic_top_header_info_section',
        'type' => 'checkbox',
        'priority' => 10
    )
);