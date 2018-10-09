<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bussiness_Epic
 */
global $business_epic_header_image,$business_epic_header_style;
$business_epic_header_image = get_header_image();

if( $business_epic_header_image ){
	$business_epic_header_style = $business_epic_header_image;

} else{

	$business_epic_header_style = '';
}

$business_epic_breadcrump_option = business_epic_get_option('business_epic_breadcrumb_setting_option');
$business_epic_hide_breadcrump_option = business_epic_get_option('business_epic_hide_breadcrumb_front_page_option');
$business_epic_designlayout = get_post_meta(get_the_ID(), 'business_epic_sidebar_layout', true  );


if( ($business_epic_hide_breadcrump_option== 1 && is_front_page()) || !is_front_page())
{

get_header(); ?>

	<!-- Start inner pager banner page -->
	<div id="" class="ample-inner-banner" style="background-image: url(<?php echo esc_url($business_epic_header_style); ?>);">
		<div class="container">
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title();?></h1>
			</header>
		</div>
	</div>
	<!-- End inner pager banner page -->

	<!-- Start breadcrumb section -->
<?php
if ($business_epic_breadcrump_option == "enable") {
	?>
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumb-trail breadcrumbs" arial-label="Breadcrumbs" role="navigation">
				<ol class="breadcrumb trail-items">
				<?php	business_epic_breadcrumb_trail(); ?>
				</ol>
			</div>
		</div>
	</div>
	<?php } } ?>
	<!-- End breadcrumb section -->

	<!-- Start innerpage content site -->
	<div id="content" class="site-content single-ample-page">
	<div class="container  clearfix">
	<div class="row">
	<!-- Start primary content area -->
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">




			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

		    <aside id="sidebar-primary" class="widget-area sidebar" role="complementary">
				<section  class="widget ">
				   <?php get_sidebar();?>
					</section>
			</aside>

	</div>
	</div>
	</div>

<?php

get_footer();
