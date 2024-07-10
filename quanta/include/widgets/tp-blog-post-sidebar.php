<?php
	/**
	 * Quanta Sidebar Posts
	 *
	 *
	 * @author 		wprealizer
	 * @category 	Widgets
	 * @package 	Quanta/Widgets
	 * @version 	1.0.0
	 * @extends 	WP_Widget
	*/

Class TP_Post_Sidebar_Widget extends WP_Widget{

	public function __construct(){
		parent::__construct('tp-latest-posts', 'Quanta Sidebar Posts', array(
			'description'	=> 'Latest Blog Post Widget by wprealizer'
		));
	}


	public function widget($args, $instance){
		extract($args);
		extract($instance);

 		echo $before_widget;
 		if($instance['title']):
 		echo $before_title; ?>
 			<?php echo apply_filters( 'widget_title', $instance['title'] ); ?>
 		<?php echo $after_title; ?>
 		<?php endif; ?>

		
		<div class="editors-pick-post">
			<div class="post-lists">
				<?php
				$q = new WP_Query( array(
					'post_type'     => 'post',
					'posts_per_page'=> ($instance['count']) ? $instance['count'] : '3',
					'order'			=> ($instance['posts_order']) ? $instance['posts_order'] : 'DESC',
					'orderby' => 'date'
				));

				if( $q->have_posts() ):
				while( $q->have_posts() ):$q->the_post();
				?>

				<div class="single-post d-flex flex-row">
					<?php if(has_post_thumbnail()): ?>
					<div class="thumb">
						<?php the_post_thumbnail( 'thumbnail' ) ?>
					</div>
					<?php endif; ?>
					<div class="detail">
						<a href="<?php the_permalink(); ?>"><h6><?php print wp_trim_words(get_the_title(), 5, ''); ?></h6></a>
						<ul class="meta">
						<li><a href="#"><span class="lnr lnr-calendar-full"></span><?php the_time( get_option('date_format') ); ?></a></li>
						<li><a href="#"><span class="lnr lnr-bubble"></span><?php comments_number();?></a></li>
						</ul>
					</div>
				</div>
				<?php endwhile; endif; wp_reset_query(); ?>
			</div>
		</div>

		<?php echo $after_widget; ?>

		<?php
	}



	public function form($instance){
		$count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( '3', 'quanta' );
		$posts_order = ! empty( $instance['posts_order'] ) ? $instance['posts_order'] : esc_html__( 'DESC', 'quanta' );
		$choose_style = ! empty( $instance['choose_style'] ) ? $instance['choose_style'] : esc_html__( 'style_1', 'quanta' );
	?>

		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">How many posts you want to show ?</label>
			<input type="number" name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr( $count ); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('posts_order'); ?>">Posts Order</label>
			<select name="<?php echo $this->get_field_name('posts_order'); ?>" id="<?php echo $this->get_field_id('posts_order'); ?>" class="widefat">
				<option value="" disabled="disabled">Select Post Order</option>
				<option value="ASC" <?php if($posts_order === 'ASC'){ echo 'selected="selected"'; } ?>>ASC</option>
				<option value="DESC" <?php if($posts_order === 'DESC'){ echo 'selected="selected"'; } ?>>DESC</option>
			</select>
		</p>

	<?php }


}

add_action('widgets_init', function(){
	register_widget('TP_Post_Sidebar_Widget');
});
