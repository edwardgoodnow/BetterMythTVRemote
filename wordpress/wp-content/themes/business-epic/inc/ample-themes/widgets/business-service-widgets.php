<?php
if (!class_exists('Business_Epic_Service_Widget')) {
    class Business_Epic_Service_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'cat_id' => 0,
                'title' => esc_html__('Our Services', 'business-epic'),
                'sub-title' => '',

            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'business-service-widget',
                esc_html__('Business Service Widget', 'business-epic'),
                array('description' => esc_html__('Business Service Section', 'business-epic'))
            );
        }
        public function form( $instance )
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $catid = absint( $instance['cat_id'] );
            $title = esc_attr( $instance['title'] );
            $subtitle =  esc_attr( $instance['sub-title'] );
            ?>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'business-epic'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" value="<?php echo $title; ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('sub-title') ); ?>">
                    <?php esc_html_e( 'Sub Title', 'business-epic'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('sub-title')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('sub-title')); ?>" value="<?php echo $subtitle; ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('cat_id') ); ?>">
                    <?php esc_html_e('Select Category', 'business-epic'); ?>
                </label><br/>
                <?php
                $business_con_dropown_cat = array(
                    'show_option_none' => esc_html__('Select Category ', 'business-epic'),
                    'orderby' => 'name',
                    'order' => 'asc',
                    'show_count' => 1,
                    'hide_empty' => 1,
                    'echo' => 1,
                    'selected' => $catid,
                    'hierarchical' => 1,
                    'name' => esc_attr( $this->get_field_name('cat_id') ),
                    'id' => esc_attr( $this->get_field_name('cat_id') ),
                    'class' => 'widefat',
                    'taxonomy' => 'category',
                    'hide_if_empty' => false,
                );
                wp_dropdown_categories( $business_con_dropown_cat );
                ?>
            </p>
            <hr>
            <?php
        }
        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['cat_id'] = (isset($new_instance['cat_id'])) ? absint($new_instance['cat_id']) : '';
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['sub-title'] = sanitize_text_field($new_instance['sub-title']);
            return $instance;

        }
        public function widget($args, $instance)
        {

            if (!empty($instance)) {
                $instance = wp_parse_args((array )$instance, $this->defaults());
                $catid = absint($instance['cat_id']);
                $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html($instance['title']) : '', $instance, $this->id_base);
                $subtitle = esc_html($instance['sub-title']);
                echo $args['before_widget'];
                ?>
                <section id="ample-business-theme-service" class="widget widget-ample-business-theme-service">
                    <div class="container">
                        <div class="main-title wow fadeInDown" data-wow-duration="2s">
                        <h2 class="widget-title"><?php echo $title; ?></h2>
                            <p><?php echo $subtitle; ?></p>
                        </div>
                        <div class="row">
                            <?php
                            $idvalue = array();
                            if (!empty($catid)) {
                                $i = 0;
                                $sticky = get_option('sticky_posts');
                                $home_services_section = array(
                                    'cat' => $catid,
                                    'posts_per_page' => 6,
                                    'ignore_sticky_posts' => true,
                                    'post__not_in' => $sticky,
                                    'order' => 'ASC'
                                );
                                $home_services_section_query = new WP_Query($home_services_section);
                                if ($home_services_section_query->have_posts()) {
                                    while ($home_services_section_query->have_posts()) {
                                        $home_services_section_query->the_post();
                                        $icon = get_post_meta(get_the_ID(), 'business_epic_icon', true);
                                        $idvalue[] = get_the_ID();
                                        ?>

                                        <!-- Start single service item -->
                                        <div class="col-xs-12 col-sm-6 col-md-4 ">
                                            <div class="service-item wow fadeInUp">
                                                <div class="service-icon">
                                                    <i class="fa <?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
                                                    <div></div>
                                                </div>
                                                <h3 class="widget-inner-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                                                <p><?php echo esc_html(wp_trim_words(get_the_content(), 20)); ?></p>
                                            </div>
                                        </div>
                                        <!-- End single service item -->
                                        <?php
                                        $i++;
                                    }
                                    wp_reset_postdata();
                                }
                            } ?>


                        </div>
                    </div>
                </section>


                <?php
                echo $args['after_widget'];
            }
        }
    }
}
add_action('widgets_init', 'business_epic_service_widget');
function business_epic_service_widget()
{
    register_widget('Business_Epic_Service_Widget');

}

