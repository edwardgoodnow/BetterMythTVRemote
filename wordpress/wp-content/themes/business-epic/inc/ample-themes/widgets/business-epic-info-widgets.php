<?php
if (!class_exists('Business_Epic_Info_Widget')) {
    class Business_Epic_Info_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'iconFirst' => 'fa-home',
                'sub_titleFirst' => '',
                'titleFirst' => '',

                'iconSecond' => 'fa-phone',
                'sub_titleSecond' => '',
                'titleSecond' => '',

                'iconThird' => 'fa-envelope',
                'sub_titleThird' => '',
                'titleThird' => '',

            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'business_epic-info-widget',
                esc_html__('Business info Widget', 'business-epic'),
                array('sub_title' => esc_html__('business info Section', 'business-epic'))
            );
        }

        public function form($instance)
        {
            $instance = wp_parse_args((array )$instance, $this->defaults());

            $counters = array('First', 'Second', 'Third');
            $i = 0;

            foreach ($counters as $countervalue) {

                $title = esc_attr($instance['title' . $countervalue]);
                $sub_title = esc_attr($instance['sub_title' . $countervalue]);
                $icon = esc_attr($instance['icon' . $countervalue])

                ?>
                <p>
                    <label
                        for="<?php echo esc_attr($this->get_field_id('icon' . $countervalue)); ?>"><?php echo esc_html('Icon ' . $countervalue, 'business-epic'); ?>
                    </label><br/>
                    <small>
                        <?php
                        esc_html_e('Font Awesome Icon Used in Widgets', 'business-epic');
                        printf(__('%1$sRefer here%2$s for icon class. For example: %3$sfa-desktop%4$s', 'business-epic'), '<br /><a href="' . esc_url('http://fontawesome.io/cheatsheet/') . '" target="_blank">', '</a>', "<code>", "</code>");
                        ?>
                    </small>
                    <strong>
                        <input type="text" name="<?php echo esc_attr($this->get_field_name('icon' . $countervalue)); ?>"
                               class="widefat"
                               id="<?php echo esc_attr($this->get_field_id('icon' . $countervalue)); ?>"
                               value="<?php echo $icon; ?>">
                    </strong>
                </p>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id('title' . $countervalue)); ?>">
                        <?php echo esc_html('Title ' . $countervalue, 'business-epic'); ?>
                    </label><br/>
                    <input type="text" name="<?php echo esc_attr($this->get_field_name('title' . $countervalue)); ?>"
                           class="widefat"
                           id="<?php echo esc_attr($this->get_field_id('title' . $countervalue)); ?>"
                           value="<?php echo $title; ?>">
                </p>

                <p>
                    <label for="<?php echo esc_attr($this->get_field_id('sub_title' . $countervalue)); ?>">
                        <?php echo esc_html('Sub-title ' . $countervalue, 'business-epic'); ?>
                    </label><br/>
                    <input type="text"
                           name="<?php echo esc_attr($this->get_field_name('sub_title' . $countervalue)); ?>"
                           class="widefat"
                           id="<?php echo esc_attr($this->get_field_id('sub_title' . $countervalue)); ?>"
                           value="<?php echo $sub_title; ?>">
                </p>
                <?php
                $i++;
            }
            ?>


            <hr>
            <?php
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $counter = array('First', 'Second', 'Third');
            foreach ($counter as $counter_value) {

                $instance['title' . $counter_value] = sanitize_text_field($new_instance['title' . $counter_value]);

                $instance['sub_title' . $counter_value] = sanitize_text_field($new_instance['sub_title' . $counter_value]);
                $instance['icon' . $counter_value] = sanitize_text_field($new_instance['icon' . $counter_value]);
            }


            return $instance;

        }

        public function widget($args, $instance)
        {
            if (!empty($instance)) {
                $instance = wp_parse_args((array)$instance, $this->defaults());
                echo $args['before_widget'];
                ?>
                
                <div class="container">
                    <div class="row">
                        <?php
                        $count = 0;
                        $counter = array('First', 'Second', 'Third');
                        foreach ($counter as $counter_value) {
                            $title = esc_attr($instance['title' . $counter_value]);
                            $sub_title = esc_attr($instance['sub_title' . $counter_value]);
                            $icon = esc_attr($instance['icon' . $counter_value]);


                            if (!empty($icon) && !empty($sub_title) && !empty($title)) {
                                $count = $count + 1;
                            }
                        }

                        foreach ($counter as $counter_value) {


                            $title = esc_attr($instance['title' . $counter_value]);
                            $sub_title = esc_attr($instance['sub_title' . $counter_value]);
                            $icon = esc_attr($instance['icon' . $counter_value]);

                            ?>
                            <div class="col-xs-12 col-sm-4 wow slideInRight text-left" data-wow-duration="2s">
                                <div id="text-1" class="widget-area widget-footer-top">
                                    <i class="fa <?php echo $icon; ?>" aria-hidden="true"></i>
                                    <h4 class="footer-top-widget-title"><?php echo $title; ?></h4>
                                    <p><?php echo $sub_title; ?></p>
                                </div>
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>




                <?php
                echo $args['after_widget'];
            }

        }

    }
}

add_action('widgets_init', 'business_epic_info_widget');
function business_epic_info_widget()
{
    register_widget('Business_Epic_Info_Widget');

}
