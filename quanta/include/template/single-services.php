<?php 
/** 
 * The main template file
 *
 * @package  WordPress
 * @subpackage  quanta
 */
get_header(); 

$post_column = is_active_sidebar( 'services-sidebar' ) ? 8 : 10;
$post_column_center = is_active_sidebar( 'services-sidebar' ) ? '' : 'justify-content-center';

?>


    <section class="stories pt-130 pb-100">
      <div class="container">
        <?php if( have_posts() ) : while( have_posts() ) : the_post();
            $project_details_image = function_exists('get_field') ? get_field('project_details_image') : '';
            $project_info_repeater = function_exists('get_field') ? get_field('project_info_repeater') : '';
          ?>
        <div class="row <?php echo esc_attr($post_column_center); ?>">
          <?php if ( is_active_sidebar('services-sidebar') ): ?>  
          <div class="col-lg-4 mb-30">
            <?php dynamic_sidebar( 'services-sidebar' ); ?>
          </div>
          <?php endif; ?>
          <div class="col-lg-<?php echo esc_attr($post_column); ?> mb-30">
            <div class="innerWrapper service-details-wrapper">
              <div class="donationDetails storiesDetails">
                <div class="donationDetails__header mb-45">
                  <figure class="thumb mb-45">
                    <?php the_post_thumbnail(); ?>
                  </figure>
                </div>
                <h4 class="donationDetails__heading mb-25"><?php the_title(); ?></h4>

                <div class="services__details__content">
                    <?php the_content(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php 
            endwhile; wp_reset_query();
            endif; 
        ?>
      </div>
    </section>


<?php get_footer();  ?>