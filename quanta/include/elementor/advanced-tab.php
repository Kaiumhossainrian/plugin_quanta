<?php
namespace Quanta\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * quanta
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Advanced_Tab extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'advanced-tab';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Advanced Tab', 'quanta' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'tp-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'quanta' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'quanta' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'quanta'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'quanta'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'quanta'),
                    'layout-2' => esc_html__('Layout 2', 'quanta'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
            '_section_price_tabs',
            [
                'label' => __('Advanced Tabs', 'quanta'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Title', 'quanta'),
                'default' => __('Tab Title', 'quanta'),
                'placeholder' => __('Type Tab Title', 'quanta'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'active_tab',
            [
                'label' => __('Is Active Tab?', 'quanta'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'quanta'),
                'label_off' => __('No', 'quanta'),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $repeater->add_control(
            'template',
            [
                'label' => __('Section Template', 'quanta'),
                'placeholder' => __('Select a section template for as tab content', 'quanta'),
  
                'type' => Controls_Manager::SELECT2,
                'options' => get_elementor_templates()
            ]
        );

        $this->add_control(
            'tabs',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'default' => [
                    [
                        'title' => 'Tab 1',
                    ],
                    [
                        'title' => 'Tab 2',
                    ]
                ]
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'quanta' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'quanta' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'quanta' ),
					'uppercase' => __( 'UPPERCASE', 'quanta' ),
					'lowercase' => __( 'lowercase', 'quanta' ),
					'capitalize' => __( 'Capitalize', 'quanta' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		?>


		<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>

	    <section class="feature" id="tp-features">
	      <div class="container">
	        <div class="row">
	          <div class="col-12">
	            <div class="featureTab">
	              <ul class="nav nav-tabs" id="myTab" role="tablist">
	              	<?php foreach ($settings['tabs'] as $key => $tab):
                        $active = ($key == 0) ? 'active' : '';
                    ?>
	                <li class="nav-item" role="presentation">
	                  <button class="nav-link <?php echo esc_attr($active); ?>" id="home-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#home-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="home-<?php echo esc_attr($key); ?>" aria-selected="true"><?php echo tp_kses($tab['title']); ?></button>
	                </li>
	                <?php endforeach; ?>
	              </ul>
	              <div class="tab-content" id="myTabContent">
					<?php foreach ($settings['tabs'] as $key => $tab):
                        $active = ($key == 0) ? 'show active' : '';
                    ?>
	                <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="home-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="home-tab-<?php echo esc_attr($key); ?>">
	                  <div class="featureTab__box pt-90">
	                    <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>
	                  </div>
	                </div>
	                <?php endforeach; ?>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	    </section>


		<?php else: 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
			$this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
		?>
		<div class="mvv">
	        <div class="container">
	          <div class="row">
	            <div class="col-12">
	              <div class="mvvTabs">
	                <div class="mvvTabs__wrapper d-flex align-items-start">
	                  <div class="nav nav-pills mb-30" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<?php foreach ($settings['tabs'] as $key => $tab):
                        	$active = ($key == 0) ? 'active' : '';
                        ?>
	                    <button class="mvvTabs__button nav-link <?php echo esc_attr($active); ?>" id="v-pills-home-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="pill" data-bs-target="#v-pills-home-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="v-pills-home-<?php echo esc_attr($key); ?>" aria-selected="true"><?php echo tp_kses($tab['title']); ?></button>
	                    <?php endforeach; ?>
	                  </div>
	                  <div class="tab-content mb-30" id="v-pills-tabContent">
						<?php foreach ($settings['tabs'] as $key => $tab):
                            $active = ($key == 0) ? 'show active' : '';
                        ?>
	                    <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="v-pills-home-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="v-pills-home-tab-<?php echo esc_attr($key); ?>">
	                      <div class="mvvTabs__content">
	                        <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>
	                      </div>
	                    </div>
	                    <?php endforeach; ?>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	    </div>

	    <?php endif; ?>

		<?php
	}

}
$widgets_manager->register( new TP_Advanced_Tab() );