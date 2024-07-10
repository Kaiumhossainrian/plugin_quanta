<?php
/**
 * Quanta Featured Posts
 *
 * @author      wprealizer
 * @category    Widgets
 * @package     Quanta/Widgets
 * @version     1.0.0
 * @extends     WP_Widget
 */

class QUANTA_Featured_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct('quanta-featured-posts', 'Quanta Featured Post', array(
            'description' => 'Featured Post Widget by wprealizer'
        ));
    }

    public function widget($args, $instance) {
        extract($args);
        extract($instance);
        echo $before_widget;
        if (!empty($instance['title'])) {
            echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
        }

        $category = !empty($instance['category']) ? $instance['category'] : '';

        $query_args = array(
            'post_type' => 'post',
            'meta_key' => 'featured',
            'meta_value' => '1',
            'posts_per_page' => 1,
        );

        if (!empty($category)) {
            $query_args['cat'] = $category;
        }

        $q = new WP_Query($query_args);

        if ($q->have_posts()):
            while ($q->have_posts()): $q->the_post();
                $categories = get_the_category();
                $category = $categories ? $categories[0] : false;
        ?>
        <div class="editors-pick-post">
            <div class="feature-img-wrap relative">
                <div class="feature-img relative">
                    <div class="overlay overlay-bg"></div>
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('thumbnail', array('class' => 'img-fluid')); ?>
                    <?php endif; ?>
                </div>
                <?php if ($category): ?>
                <ul class="tags">
                    <li><a href="<?php echo get_category_link($category->term_id); ?>"><?php echo esc_html($category->name); ?></a></li>
                </ul>
                <?php endif; ?>
            </div>
            <div class="details">
                <a href="<?php the_permalink(); ?>">
                    <h4 class="mt-20"><?php the_title(); ?></h4>
                </a>
                <ul class="meta">
                    <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><span class="lnr lnr-user"></span><?php the_author(); ?></a></li>
                    <li><a href="#"><span class="lnr lnr-calendar-full"></span><?php the_time(get_option('date_format')); ?></a></li>
                    <li><a href="#"><span class="lnr lnr-bubble"></span><?php comments_number(); ?></a></li>
                </ul>
                <p class="excert">
                    <?php echo get_the_excerpt(); ?>
                </p>
            </div>
        </div>
        <?php
            endwhile;
        endif;
        wp_reset_query();

        echo $after_widget;
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat">
        </p>
    <?php
    }

      public function update($new_instance, $old_instance) {
         $instance = $old_instance;
         $instance['title'] = strip_tags($new_instance['title']);
         return $instance;
      }
}

add_action('widgets_init', function() {
    register_widget('QUANTA_Featured_Widget');
});
