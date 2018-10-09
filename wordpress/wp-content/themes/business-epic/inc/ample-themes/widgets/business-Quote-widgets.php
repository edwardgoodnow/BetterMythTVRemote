<?php
if (!class_exists('Business_Quote_Widget')) {
    class Business_Quote_Widget extends WP_Widget
    {
        private function defaults()
        {
            $defaults = array(
                'title' => '',
                'button-text1' => esc_html__('button1', 'business-epic'),
                'button-text-link1' => '#',
                'button-text2' => esc_html__('button2', 'business-epic'),
                'button-text-link2' => '#',
                'image'=>'',
            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'business-epic-quote-widget',
                esc_html__('Business Quote Widget', 'business-epic'),
                array('description' => esc_html__('Business Quote Section', 'business-epic'))
            );
        }
        public function form($instance)
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $title = esc_attr( $instance['title']  );
            $button_text1 = esc_attr( $instance['button-text1'] );
            $button_text_link1 = esc_url( $instance['button-text-link1'] );
            $button_text2 = esc_attr( $instance['button-text2'] );
            $button_text_link2 = esc_url( $instance['button-text-link2'] );
            $image = esc_url($instance['image']);

            ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'business-epic'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" value="<?php echo $title?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'button-text1' ) ); ?>"><?php esc_html_e('Button Text1', 'business-epic'); ?></label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('button-text1')); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id('button-text1')); ?>" value="<?php echo $button_text1; ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'button-text-link1' ) ); ?>">
                    <?php esc_html_e('Button Link1', 'business-epic'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('button-text-link1')); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id('button-text-link1')); ?>" value="<?php echo $button_text_link1; ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'button-text2' ) ); ?>"><?php esc_html_e('Button Text2', 'business-epic'); ?></label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('button-text2')); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id('button-text2')); ?>" value="<?php echo $button_text2; ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'button-text-link2' ) ); ?>">
                    <?php esc_html_e('Button Link2', 'business-epic'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('button-text-link2')); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id('button-text-link2')); ?>" value="<?php echo $button_text_link2; ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('image')); ?>">
                    <?php esc_html_e('Image Size[1300 X 630]', 'business-epic'); ?>
                </label>
                <br/>
                <?php
                if (!empty($image)) :
                    echo '<img class="custom_media_image widefat" src="' . $image . '"/><br />';
                endif;
                ?>
                <input type="text" class="widefat custom_media_url"
                       name="<?php echo esc_attr($this->get_field_name('image')); ?>"
                       id="<?php echo esc_attr($this->get_field_id('image')); ?>" value="<?php echo $image; ?>">
                <input type="button" class="button button-primary custom_media_button" id="custom_media_button"
                       name="<?php echo esc_attr($this->get_field_name('image')); ?>"
                       value="<?php esc_attr_e('Upload Image', 'business-epic') ?>"/>
            </p>
            <?php
        }
        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['button-text1'] = sanitize_text_field( $new_instance['button-text1']);
            $instance['button-text-link1'] = esc_url_raw( $new_instance['button-text-link1']);
            $instance['button-text2'] = sanitize_text_field( $new_instance['button-text2']);
            $instance['button-text-link2'] = esc_url_raw( $new_instance['button-text-link2']);
            $instance['image'] = esc_url_raw($new_instance['image']);
            return $instance;
        }
        public function widget($args, $instance)
        {

            if (!empty($instance)) {
                $instance = wp_parse_args((array )$instance, $this->defaults());
                $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html($instance['title']) : '', $instance, $this->id_base);
                $button_text1 = esc_html($instance['button-text1']);
                $button_text_link1 = esc_url($instance['button-text-link1']);
                $button_text2 = esc_html($instance['button-text2']);
                $button_text_link2 = esc_url($instance['button-text-link2']);
                $image = esc_url($instance['image']);
                echo $args['before_widget'];
                ?>
                <section id="ample-business-theme-meetbutton" class="widget widget-ample-business-theme-meetbutton"
                         style="background-image: url(<?php echo $image;?>);">
                    <div class="container">
                        <div class="meet-button-content wow fadeInDown" data-wow-duration="2s">
                            <div class="main-title">
                                <h2 class="widget-title whitetext"><?php echo $title;?></h2>
                            </div>
                            <div class="meet-counter-button">
                                <a id="parallex-team" href="<?php echo $button_text_link1; ?> " class="paralex-btn"><?php echo $button_text1;?></a>
                                <a id="parallex-counter" href="<?php echo $button_text_link2; ?>" class="paralex-btn"><?php echo $button_text2;?></a>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                echo $args['after_widget'];
            }
        }
    }
}
add_action('widgets_init', 'business_quote_widget');
function business_quote_widget()
{
    register_widget('Business_Quote_Widget');

}

