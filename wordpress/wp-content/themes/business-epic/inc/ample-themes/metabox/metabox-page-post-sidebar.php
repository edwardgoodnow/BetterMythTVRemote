<?php
/**
 * Business Epic sidebar layout options
 *
 * @since Business Epic  1.0.0
 *
 * @param null
 * @return array
 *
 */
if (!function_exists('business_epic_sidebar_layout_options')) :
    function business_epic_sidebar_layout_options() {
        $business_epic_sidebar_layout_options = array(
            'default-sidebar' => array(
                'value' => 'default-sidebar',
                'thumbnail' => get_template_directory_uri() . '/inc/ample-themes/metabox/images/default-sidebar.png'
            ),
            'left-sidebar' => array(
                'value' => 'left-sidebar',
                'thumbnail' => get_template_directory_uri() . '/inc/ample-themes/metabox/images/left-sidebar.png'
            ),
            'right-sidebar' => array(
                'value' => 'right-sidebar',
                'thumbnail' => get_template_directory_uri() . '/inc/ample-themes/metabox/images/right-sidebar.png'
            ),
            'no-sidebar' => array(
                'value' => 'no-sidebar',
                'thumbnail' => get_template_directory_uri() . '/inc/ample-themes/metabox/images/no-sidebar.png'
            )
        );
        return apply_filters('business_epic_sidebar_layout_options', $business_epic_sidebar_layout_options);
    }
endif;

/**
 * Custom Metabox
 *
 * @since Business Epic  1.0.2
 *
 * @param null
 * @return void
 *
 */
if (!function_exists('business_epic__add_metabox')):
    function business_epic_add_metabox()
    {
        add_meta_box(
            'business_epic_sidebar_layout', // $id
            esc_html__('Sidebar Layout', 'business-epic'), // $title
            'business_epic_sidebar_layout_callback', // $callback
            'post', // $page
            'normal', // $context
            'low'
        ); // $priority

        add_meta_box(
            'business_epic_sidebar_layout', // $id
            __('Sidebar Layout', 'business-epic'), // $title
            'business_epic_sidebar_layout_callback', // $callback
            'page', // $page
            'normal', // $context
            'low'
        ); // $priority
    }
endif;
add_action('add_meta_boxes', 'business_epic_add_metabox');


/**
 * Callback function for metabox
 *
 * @since business epic  1.0.0
 *
 * @param null
 * @return void
 *
 */
if (!function_exists('business_epic_sidebar_layout_callback')) :
    function business_epic_sidebar_layout_callback()
    {
        global $post;
        $business_epic_sidebar_layout_options = business_epic_sidebar_layout_options();
        $business_epic_sidebar_layout = 'default-sidebar';
        $business_epic_sidebar_meta_layout = get_post_meta( $post->ID, 'business_epic_sidebar_layout', true);
        if ( !empty( $business_epic_sidebar_meta_layout ) ) {
            $business_epic_sidebar_layout = $business_epic_sidebar_meta_layout;
        }
        wp_nonce_field(basename(__FILE__), 'business_epic_sidebar_layout_nonce');
        ?>

        <table class="form-table page-meta-box">
            <tr>
                <td colspan="4"><h4><?php esc_html_e('Choose Sidebar Template', 'business-epic'); ?></h4></td>
            </tr>
            <tr>
                <td>
                    <?php
                    foreach ($business_epic_sidebar_layout_options as $field) {
                        ?>
                        <div class="hide-radio radio-image-wrapper qc_radio_button">
                            <input id="<?php echo $field['value']; ?>" type="radio"
                                   name="business_epic_sidebar_layout"
                                   value="<?php echo $field['value']; ?>" <?php checked($field['value'], $business_epic_sidebar_layout); ?>/>
                            <label class="description" for="<?php echo $field['value']; ?>">
                                <img src="<?php echo esc_url($field['thumbnail']); ?>" alt=""/>
                            </label>
                        </div>
                    <?php } // end foreach
                    ?>
                    <div class="clear"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <em class="f13"><?php esc_html_e('You can set up the sidebar content', 'business-epic'); ?>
                        <a href="<?php echo esc_url( admin_url('/widgets.php')); ?>">
                            <?php esc_html_e('here', 'business-epic'); ?>
                        </a>
                    </em>
                </td>
            </tr>

        </table>

    <?php }
endif;

/**
 * save the custom metabox data
 * @hooked to save_post hook
 *
 * @since business epic  1.0.0
 *
 * @param null
 * @return void
 *
 */
if (!function_exists('business_epic_save_sidebar_layout')) :
    function business_epic_save_sidebar_layout( $post_id )
    {

        /*
          * A Guide to Writing Secure Themes – Part 4: Securing Post Meta
          *https://make.wordpress.org/themes/2015/06/09/a-guide-to-writing-secure-themes-part-4-securing-post-meta/
          * */
        if (
            !isset($_POST['business_epic_sidebar_layout_nonce']) ||
            !wp_verify_nonce($_POST['business_epic_sidebar_layout_nonce'], basename(__FILE__)) || /*Protecting against unwanted requests*/
            (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || /*Dealing with autosaves*/
            !current_user_can('edit_post', $post_id)/*Verifying access rights*/
        ) {
            return;
        }

        //Execute this saving function
        if ( isset( $_POST['business_epic_sidebar_layout'] ) ) {
            $old = get_post_meta( $post_id, 'business_epic_sidebar_layout', true);
            $new = sanitize_text_field ($_POST['business_epic_sidebar_layout'] );
            if ( $new && $new != $old ) {
                update_post_meta($post_id, 'business_epic_sidebar_layout', $new);
            } elseif ( '' == $new && $old ) {
                delete_post_meta( $post_id, 'business_epic_sidebar_layout', $old);
            }
        }
    }
endif;
add_action('save_post', 'business_epic_save_sidebar_layout');

