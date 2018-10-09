<?php
global $business_epic_header_image,$business_epic_header_style;
$business_epic_header_image = get_header_image();

if( $business_epic_header_image ){
	$business_epic_header_style = $business_epic_header_image;

} else{

	$business_epic_header_style = '';
}
$blog_page_title = business_epic_get_option('business_epic_blog_title_option');
$business_epic_breadcrump_option = business_epic_get_option('business_epic_breadcrumb_setting_option');

get_header();
?>
<div id="" class="ample-inner-banner" style="background-image: url(<?php echo esc_url($business_epic_header_style);?>);">
	<div class="container">
			<div class="entry-title">
				<header class="page-header">
					<h1><?php echo esc_html($blog_page_title); ?></h1>
				</header><!-- .page-header -->
			</div>
	</div>
</div>
<?php
$business_epic_hide_front_page_content = business_epic_get_option('business_epic_front_page_hide_option');
//if(!is_home()) {
    $business_epic_slider_section_option = business_epic_get_option('business_epic_homepage_slider_option');
   // if ($business_epic_slider_section_option != 'hide') {

        $business_epic_slider_section_cat_id = business_epic_get_option('business_epic_slider_cat_id');

        $business_epic_get_started_text = business_epic_get_option('business_epic_slider_get_started_txt');

        $business_epic_get_started_text_link = business_epic_get_option('business_epic_slider_get_started_link');

        $business_epic_slider_category = get_category($business_epic_slider_section_cat_id);

       // if (!empty($business_epic_slider_section_cat_id)) {
            $count = $business_epic_slider_category->category_count;
            $no_of_slider = business_epic_get_option('business_epic_no_of_slider');

            if ($count > 0 && $no_of_slider > 0) {
                ?>
                <!-- Start Featured Slider -->
                <div class="features-slider">
                    <div id="owl-demo1" class="owl-carousel owl-theme">


                        <?php
                        $i = 0;
                        if (!empty($business_epic_slider_section_cat_id)) {
                            $business_epic_home_slider_section = array('cat' => $business_epic_slider_section_cat_id, 'posts_per_page' => $no_of_slider);
                            $business_epic_home_slider_section_query = new WP_Query($business_epic_home_slider_section);
                            if ($business_epic_home_slider_section_query->have_posts()) {
                                while ($business_epic_home_slider_section_query->have_posts()) {
                                    $business_epic_home_slider_section_query->the_post();
                                    ?>
                                    <div class="item">


                                        <?php if (has_post_thumbnail()) {
                                            $image_id = get_post_thumbnail_id();
                                            $image_url = wp_get_attachment_image_src($image_id, 'full', true); ?>
                                            <img src="<?php echo esc_url($image_url[0]); ?>" class="img-responsive"
                                                 alt="<?php the_title_attribute(); ?>">
                                        <?php } ?>
                                        <div class="slider-overlay"></div>
                                        <div class="slider-content wow slideInDown text-left" data-wow-duration="2s">
                                            <div class="container">
                                                <h3 class="banner-title"><?php the_title() ?></h3>
                                                <div class="banner-caption">
                                                    <?php
                                                    if(has_excerpt()) {
                                                          the_excerpt();
                                                    }
                                                     else{
                                                      ?>
                                                       <p> <?php echo esc_html(wp_trim_words(get_the_content(), 10)); ?></p>
                                                    <?php
                                                    } ?></div>
                                                <div class="know-more">
                                                <a href="<?php the_permalink() ?>" class="read-more-background know"><?php  esc_html_e('Know More','business-epic');?></a>
                                                <?php
                                                if (!empty($business_epic_get_started_text)) {
                                                    ?>
                                                    <a href="<?php echo esc_url($business_epic_get_started_text_link); ?>"
                                                       class="read-more-background"><?php echo esc_html($business_epic_get_started_text) ?></a>
                                                <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    $i++;
                                }

                            }
                            wp_reset_postdata();
                        }
                        ?>


                    </div>
                </div>
                <?php
            }
       // }
   // }


    ?>
    <!-- End Featured Slider -->

    <!-- Start Home Page widget Area -->
    <div id="home-page-widget-area" class="widget">

        <?php dynamic_sidebar('homepage_widgets'); ?>

    </div>
    <!-- End Home Page widget Area -->


    <?php
  // }

    if ('posts' == get_option('show_on_front')) {

      include(get_home_template());
   } else {
     if (1 != $business_epic_hide_front_page_content) {
        include(get_page_template());
    }
    }
get_footer();
?>  

