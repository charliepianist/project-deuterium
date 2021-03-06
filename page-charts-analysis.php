<?php /*Template Name: Charts/Analysis **Backend** */ ?>
<!--  Last Published: Tue Apr 10 2018 01:20:11 GMT+0000 (UTC)  -->
<!DOCTYPE html>
<html data-wf-page="5acbb34e9ed369cd3a1146da" data-wf-site="5a7fa1f338edac00018725fb">
<?php get_header(); ?>
<?php if(is_user_logged_in()): 

  //check if user has subscription
  $o_user_id = get_current_user_id(); 
  if(get_user_meta($o_user_id, 'subscription_type', true) === 'classic' || current_user_can('administrator')): ?>
          <div class="_3_container w-container">
            <h1 class="heading">Charts &amp; Analysis</h1>
              <p class="paragraph_privacy1">Our analysis includes charts along with an analysis on upcoming catalysts, balance sheets, technical analysis, and a potential course of action.<span class="text-span-3"><br></span></p>

            <?php          
              $o_args = array(
              'post_type' => 'chart-analysis',
              'orderby' => 'date',
              'posts_per_page' => 2,
            );
              query_posts($o_args);
              //query for chart/analysis most recent 2
            ?>
            <div class="_3_wlr1 w-row">
            <?php while(have_posts()): the_post(); ?>
              <div class="w-col w-col-6">
              <h1 class="_3_chartname"><?php echo strip_tags(get_the_taxonomies(0, array(
                  'template' => '% %l',
                ))['tickers']); ?> (<?php echo get_the_date('m/d');?>)
              </h1>
              <?php echo o_filter_charts_analysis(get_the_content_with_formatting(), get_the_permalink());?>
              </div>
            <?php endwhile; ?>
            </div>

            <?php get_template_part('parts/tickers-archive'); ?>
          </div>
      <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
<?php else: //BASIC SUBSCRIPTION ?>

  <div class="_3_container w-container">
    <h1 class="heading">Charts &amp; Analysis</h1>
    <p class="paragraph_privacy1">Access all of analyses and charts, as well as our ticker archive by <a href="<?php echo site_url('pricing');?>" style="color: #fff;">purchasing a subscription</a>! Our analysis includes charts along with an analysis on upcoming catalysts, balance sheets, technical analysis, and a potential course of action.<span class="text-span-3"><br></span></p>
    <?php
      $o_args = array(
      'post_type' => 'basic-chart-analysis',
      'orderby' => 'date',
      'posts_per_page' => 2,
    );
      query_posts($o_args);
      //query for chart/analysis most recent 2
    ?>
    <div class="_3_wlr1 w-row">
    <?php while(have_posts()): the_post(); ?>
      <div class="w-col w-col-6">
      <h1 class="_3_chartname"><?php echo strip_tags(get_the_taxonomies(0, array(
          'template' => '% %l',
        ))['tickers']); ?> (<?php echo get_the_date('m/d');?>)
      </h1>
      <?php echo o_filter_charts_analysis(get_the_content_with_formatting(), get_the_permalink());?>
      </div>
    <?php endwhile; ?>
    </div>
  </div>

<?php 
endif;
else: //NOT LOGGED IN?>
  <?php get_template_part('parts/login/not-logged-in-error'); ?>
<?php endif; ?>
<?php get_footer(); ?>