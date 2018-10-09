<?php
//=============================================================
// Color reset
//=============================================================
if ( ! function_exists( 'business_epic_reset_colors' ) ) :

    function business_epic_reset_colors($data) {

        set_theme_mod('business_epic_top_header_background_color','#61b9ed');

        set_theme_mod('business_epic_top_footer_background_color','#1A1E21');

        set_theme_mod('business_epic_bottom_footer_background_color','#444444');

        set_theme_mod('business_epic_primary_color','#61b9ed');

        set_theme_mod('business_epic_color_reset_option','do-not-reset');

    }

endif;
add_action( 'business_epic_colors_reset','business_epic_reset_colors', 10 );

