<?php
if (!class_exists('Business_Epic_Testimonials_Widget')) {
    class Business_Epic_Testimonials_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'cat_id' => 0,
                'title' => esc_html__('WHAT OUR CLIENT SAYS', 'business-epic'),
                'image' => '',

            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'business-testimonials-widget',
                esc_html__('Business Testimonials Widget', 'business-epic'),
                array('description' => esc_html__('Business Testimonials Section', 'business-epic'))
            );
        }
        public function form($instance)
        {
            $instance = wp_parse_args((array )$instance, $this->defaults());
            $catid = absint($instance['cat_id']);
            $title = esc_attr($instance['title']);
            $image = esc_url($instance['image']);

            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'business-epic'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" class="widefat"
                       id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo $title; ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('cat_id')); ?>">
                    <?php esc_html_e('Select Category', 'business-epic'); ?>
                </label><br/>
                <?php
                $better_con_dropown_cat = array(
                    'show_option_none' => esc_html__('Select Categories ', 'business-epic'),
                    'orderby' => 'name',
                    'order' => 'asc',
                    'show_count' => 1,
                    'hide_empty' => 1,
                    'echo' => 1,
                    'selected' => $catid,
                    'hierarchical' => 1,
                    'name' => esc_attr($this->get_field_name('cat_id')),
                    'id' => esc_attr($this->get_field_name('cat_id')),
                    'class' => 'widefat',
                    'taxonomy' => 'category',
                    'hide_if_empty' => false,
                );
                wp_dropdown_categories($better_con_dropown_cat);
                ?>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('image')); ?>">
                    <?php esc_html_e('Image Size[1300 X 650]', 'business-epic'); ?>
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
            $instance['cat_id'] = (isset($new_instance['cat_id'])) ? absint($new_instance['cat_id']) : '';
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['image'] = esc_url_raw($new_instance['image']);


            return $instance;

        }
public function widget($args, $instance)
{

if (!empty($instance)) {
    $instance = wp_parse_args((array )$instance, $this->defaults());
    echo $args['before_widget'];
    $catid = absint($instance['cat_id']);
    $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html($instance['title']) : '', $instance, $this->id_base);
    $image = esc_url($instance['image']);
    $sticky = get_option('sticky_posts');
    $home_testimonials_section = array(
        'ignore_sticky_posts' => true,
        'post__not_in' => $sticky,
        'cat' => $catid,
        'posts_per_page' => -1,
        'order' => 'DESC'
    );
    echo $args['before_widget'];
    ?>
    <section id="ample-business-theme-testimonial" class="widget widget-ample-business-theme-testimonial"
             style="background-image: url(<?php echo $image;?>);">
        <div class="container">
            <div class="main-title wow fadeInDown" data-wow-duration="2s"
                 style="visibility: visible; animation-duration: 2s; animation-name: fadeInDown;">
                <h2 class="widget-title whitetext"><?php echo $title; ?></h2>
            </div>
            <div class="col-xs-12 col-sm-10 col-xs-offset-0 col-sm-offset-1">
                <div id="owl-demo2" class="owl-carousel owl-theme">
    <?php
    $i = 0;
    if (!empty($catid)) {
        $i = 0;
        $sticky = get_option('sticky_posts');
        $home_testimonials_section = array(
            'cat' => $catid,
            'posts_per_page' => 3,
            'ignore_sticky_posts' => true,
            'post__not_in' => $sticky,
            'order' => 'ASC'
        );
    }

        $home_testimonials_section_query = new WP_Query($home_testimonials_section);

        if ($home_testimonials_section_query->have_posts()) {
            while ($home_testimonials_section_query->have_posts()) {
                $home_testimonials_section_query->the_post();
                ?>
                <div class="item">
                    <div class="testimonial-details">
                        <p class="whitetext"><?php echo esc_html(wp_trim_words(get_the_content(), 30)); ?></p>
                        <h2 class="clientname"><?php the_title(); ?></h2>
                        <div class="testimonial-img">
                            <?php
                            if (has_post_thumbnail()) {
                                $image_id = get_post_thumbnail_id();
                                $image_url = wp_get_attachment_image_src($image_id, 'medium', true);
                                ?>
                                <img src="<?php echo esc_url($image_url[0]); ?>"
                                     class="img-responsive">
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
                $i++;
            }
            wp_reset_postdata();
        }

            ?>

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
add_action('widgets_init', 'business_epic_testimonials_widget');
function business_epic_testimonials_widget()
{
    register_widget('Business_Epic_Testimonials_Widget');

}