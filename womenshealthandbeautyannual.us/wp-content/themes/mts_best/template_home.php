<?php
/**
 * Template Name: Home Page
 */
?>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php get_header(); ?>
<div id="page" class="<?php mts_single_page_class(); ?>">
	
    <div class="home-content-main">
    <div class="home-content-inner container-div">
    
    <div class="home-top-heading">
    <?php dynamic_sidebar('Home Top Heading Sidebar'); ?>
    </div>
    
    <div class="home-content-details-main clearfix">
    
    <div class="home-content-details-l">
		<div id="content_box" >
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
					<div class="single_page">
						<div class="post-content box mark-links entry-content">
							<?php if (!empty($mts_options['mts_social_buttons_on_pages']) && isset($mts_options['mts_social_button_position']) && $mts_options['mts_social_button_position'] == 'top') mts_social_buttons(); ?>
							<?php the_content(); ?>
							<?php wp_link_pages(array('before' => '<div class="pagination">', 'after' => '</div>', 'link_before'  => '<span class="current"><span class="currenttext">', 'link_after' => '</span></span>', 'next_or_number' => 'next_and_number', 'nextpagelink' => __('Next','best'), 'previouspagelink' => __('Previous','best'), 'pagelink' => '%','echo' => 1 )); ?>

							<?php if (!empty($mts_options['mts_social_buttons_on_pages']) && isset($mts_options['mts_social_button_position']) && $mts_options['mts_social_button_position'] !== 'top') mts_social_buttons(); ?>

						</div><!--.post-content box mark-links-->
					</div>
				</div>
			<?php endwhile; ?>
		</div>
        </div>
        
        <div class="home-content-details-m">
        <?php dynamic_sidebar('Home Middle Content Sidebar'); ?>
        </div>
        
        <div class="home-content-details-r">
        <?php dynamic_sidebar('Home Right Content Sidebar'); ?>
        </div>
        
        
        </div>
        
        </div>
        </div>
<?php get_footer(); ?>