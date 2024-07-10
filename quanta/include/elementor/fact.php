<?php
namespace Quanta\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * quanta
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Fact extends Widget_Base {

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
		return 'tp-fact';
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
		return __( 'Fact', 'quanta' );
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
                    'layout-3' => esc_html__('Layout 3', 'quanta'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Service group
        $this->start_controls_section(
            'tp_fact',
            [
                'label' => esc_html__('Fact List', 'quanta'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'quanta' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'quanta' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'quanta' ),
                    'style_2' => __( 'Style 2', 'quanta' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_fact_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'quanta'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'quanta'),
                    'icon' => esc_html__('Icon', 'quanta'),
                ],
            ]
        );

        $repeater->add_control(
            'tp_fact_image',
            [
                'label' => esc_html__('Upload Icon Image', 'quanta'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_fact_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_fact_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_fact_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_fact_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_fact_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_fact_number', [
                'label' => esc_html__('Number', 'quanta'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('17', 'quanta'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_fact_title',
            [
                'label' => esc_html__('Title', 'quanta'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Food', 'quanta'),
                'label_block' => true,
            ]
        );         
        $repeater->add_control(
            'tp_fact_description',
            [
                'label' => esc_html__('Description', 'quanta'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        ); 

        $this->add_control(
            'tp_fact_list',
            [
                'label' => esc_html__('Services - List', 'quanta'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_fact_title' => esc_html__('Business Stratagy', 'quanta'),
                    ],
                    [
                        'tp_fact_title' => esc_html__('Website Development', 'quanta')
                    ],
                    [
                        'tp_fact_title' => esc_html__('Marketing & Reporting', 'quanta')
                    ],
                    [
                        'tp_fact_title' => esc_html__('Happy Client', 'quanta')
                    ]
                ],
                'title_field' => '{{{ tp_fact_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_fact_align',
            [
                'label' => esc_html__( 'Alignment', 'quanta' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'quanta' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'quanta' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'quanta' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();

        // tp_fact_columns_section
        $this->start_controls_section(
            'tp_fact_columns_section',
            [
                'label' => esc_html__('Fact - Columns', 'quanta'),
            ]
        );

        $this->add_control(
            'tp_col_for_desktop',
            [
                'label' => esc_html__( 'Columns for Desktop', 'quanta' ),
                'description' => esc_html__( 'Screen width equal to or greater than 992px', 'quanta' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'quanta' ),
                    6 => esc_html__( '2 Columns', 'quanta' ),
                    4 => esc_html__( '3 Columns', 'quanta' ),
                    3 => esc_html__( '4 Columns', 'quanta' ),
                    2 => esc_html__( '6 Columns', 'quanta' ),
                    1 => esc_html__( '12 Columns', 'quanta' ),
                ],
                'separator' => 'before',
                'default' => '4',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_col_for_laptop',
            [
                'label' => esc_html__( 'Columns for Laptop', 'quanta' ),
                'description' => esc_html__( 'Screen width equal to or greater than 768px', 'quanta' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'quanta' ),
                    6 => esc_html__( '2 Columns', 'quanta' ),
                    4 => esc_html__( '3 Columns', 'quanta' ),
                    3 => esc_html__( '4 Columns', 'quanta' ),
                    2 => esc_html__( '6 Columns', 'quanta' ),
                    1 => esc_html__( '12 Columns', 'quanta' ),
                ],
                'separator' => 'before',
                'default' => '4',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_col_for_tablet',
            [
                'label' => esc_html__( 'Columns for Tablet', 'quanta' ),
                'description' => esc_html__( 'Screen width equal to or greater than 576px', 'quanta' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'quanta' ),
                    6 => esc_html__( '2 Columns', 'quanta' ),
                    4 => esc_html__( '3 Columns', 'quanta' ),
                    3 => esc_html__( '4 Columns', 'quanta' ),
                    2 => esc_html__( '6 Columns', 'quanta' ),
                    1 => esc_html__( '12 Columns', 'quanta' ),
                ],
                'separator' => 'before',
                'default' => '6',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_col_for_mobile',
            [
                'label' => esc_html__( 'Columns for Mobile', 'quanta' ),
                'description' => esc_html__( 'Screen width less than 576px', 'quanta' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'quanta' ),
                    6 => esc_html__( '2 Columns', 'quanta' ),
                    4 => esc_html__( '3 Columns', 'quanta' ),
                    3 => esc_html__( '4 Columns', 'quanta' ),
                    5 => esc_html__( '5 Columns (For Carousel Item)', 'quanta' ),
                    2 => esc_html__( '6 Columns', 'quanta' ),
                    1 => esc_html__( '12 Columns', 'quanta' ),
                ],
                'separator' => 'before',
                'default' => '12',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

// TAB_STYLE
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


        // style tab here
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Title / Content', 'tocore' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Content Padding', 'tocore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .tp-el-content',
                'exclude' => [
                    'image'
                ]
            ]
        );

        // Title
        $this->add_control(
            '_heading_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'tocore' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'tocore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'tocore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .tp-el-title',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        // Subtitle    
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Subtitle', 'tocore' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __( 'Bottom Spacing', 'tocore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Text Color', 'tocore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .tp-el-subtitle',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        // description
        $this->add_control(
            '_content_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'tocore' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'tocore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Text Color', 'tocore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .tp-el-content p',
                'scheme' => Typography::TYPOGRAPHY_4,
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

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>
            <section class="services__style__two">
                <div class="container">
                    <?php if ( !empty($settings['tp_section_title_show']) ) : ?>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8">
                            <div class="section__title text-center">
                                <?php if ( !empty($settings['tp_sub_title']) ) : ?>
                                <span class="sub-title tp-el-subtitle"><?php echo tp_kses( $settings['tp_sub_title'] ); ?></span>
                                <?php endif; ?>

                                <?php
                                if ( !empty($settings['tp_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_title' ] )
                                        );
                                endif;
                                ?>

                                <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                                <p class="desc"><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="services__style__two__wrap">
                        <div class="row gx-0">
                            <?php foreach ($settings['tp_fact_list'] as $item) : 
                                // Link
                                if ('2' == $item['tp_fact_link_type']) {
                                    $link = get_permalink($item['tp_fact_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['tp_fact_link']['url']) ? $item['tp_fact_link']['url'] : '';
                                    $target = !empty($item['tp_fact_link']['is_external']) ? '_blank' : '';
                                    $rel = !empty($item['tp_fact_link']['nofollow']) ? 'nofollow' : '';
                                }

                            ?>
                            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                                <div class="services__style__two__item">
                                    <div class="services__style__two__icon">
                                        <?php if($item['tp_fact_icon_type'] !== 'image') : ?>
                                            <?php if (!empty($item['tp_fact_icon']) || !empty($item['tp_fact_selected_icon']['value'])) : ?>
                                                <div class="icon">
                                                    <?php tp_render_icon($item, 'tp_fact_icon', 'tp_fact_selected_icon'); ?>
                                                </div>
                                            <?php endif; ?>   
                                        <?php else : ?>
                                            <div class="icon">
                                                <?php if (!empty($item['tp_fact_image']['url'])): ?>
                                                <img src="<?php echo $item['tp_fact_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_fact_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?>  
                                            </div>
                                        <?php endif; ?>                                     
                                    </div>
                                    <div class="services__style__two__content">
                                        <?php if (!empty($item['tp_fact_title' ])): ?>
                                        <h3 class="title">
                                            <?php if ($item['tp_fact_link_switcher'] == 'yes') : ?>
                                            <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_fact_title' ]); ?></a>
                                            <?php else : ?>
                                                <?php echo tp_kses($item['tp_fact_title' ]); ?>
                                            <?php endif; ?>
                                        </h3>
                                        <?php endif; ?> 

                                        <?php if (!empty($item['tp_fact_description' ])): ?>
                                        <p><?php echo tp_kses($item['tp_fact_description']); ?></p>
                                        <?php endif; ?>

                                        <?php if (!empty($link)) : ?>
                                            <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="services__btn"><i class="far fa-long-arrow-right"></i></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
		<?php else: ?>	

         <section class="counter__area">
            <div class="container">
               <div class="counter__inner grey-bg-2ss">
                  <div class="row">
                    <?php foreach ($settings['tp_fact_list'] as $key => $item) : 
                        $border_none = ($key == 3) ? '' : 'counter__item-border';
                    ?>
                     <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                        <div class="counter__item d-flex align-items-start tp-el-content <?php echo esc_attr($border_none); ?>">
                           <div class="counter__icon mr-15">
                            <?php if($item['tp_fact_icon_type'] !== 'image') : ?>
                                <?php if (!empty($item['tp_fact_icon']) || !empty($item['tp_fact_selected_icon']['value'])) : ?>
                                    <div class="c-icon">
                                        <?php tp_render_icon($item, 'tp_fact_icon', 'tp_fact_selected_icon'); ?>
                                    </div>
                                <?php endif; ?>   
                            <?php else : ?>
                                <div class="c-icon">
                                    <?php if (!empty($item['tp_fact_image']['url'])): ?>
                                    <img src="<?php echo $item['tp_fact_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_fact_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>  
                                </div>
                            <?php endif; ?>  
                           </div>
                           <div class="counter__content">
                            <?php if (!empty($item['tp_fact_title' ])): ?>
                            <h3 class="tp-el-title"><?php echo tp_kses($item['tp_fact_title' ]); ?></h3>
                            <?php endif; ?>
                            <?php if (!empty($item['tp_fact_number' ])): ?>
                              <h4 class="tp-el-subtitle"><span class="counter"><?php echo tp_kses($item['tp_fact_number' ]); ?></span>+</h4>
                            <?php endif; ?>
                            <?php if (!empty($item['tp_fact_description' ])): ?>
                                <p><?php echo tp_kses($item['tp_fact_description']); ?></p>
                            <?php endif; ?>
                           </div>
                        </div>
                     </div>
                     <?php endforeach; ?>
                  </div>
               </div>
            </div>
         </section>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Fact() );