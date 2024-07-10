<?php
namespace Quanta\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * quanta
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_About extends Widget_Base {

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
		return 'about';
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
		return __( 'About', 'quanta' );
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
                    'layout-4' => esc_html__('Layout 4', 'quanta'),
                    'layout-5' => esc_html__('Layout 5', 'quanta'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // tp_section_title
        $this->start_controls_section(
            'tp_section_title',
            [
                'label' => esc_html__('Title & Content', 'quanta'),
            ]
        );

        $this->add_control(
            'tp_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'quanta' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'quanta' ),
                'label_off' => esc_html__( 'Hide', 'quanta' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_sub_title',
            [
                'label' => esc_html__('Sub Title', 'quanta'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Sub Title', 'quanta'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'quanta'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_title',
            [
                'label' => esc_html__('Title', 'quanta'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Title Here', 'quanta'),
                'placeholder' => esc_html__('Type Heading Text', 'quanta'),
                'label_block' => true,
            ]
        );       

        $this->add_control(
            'tp_desctiption',
            [
                'label' => esc_html__('Description', 'quanta'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('TP section description here', 'quanta'),
                'placeholder' => esc_html__('Type section description here', 'quanta'),
            ]
        );

        $this->add_control(
            'tp_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'quanta'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'quanta'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'quanta'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'quanta'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'quanta'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'quanta'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'quanta'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'tp_align',
            [
                'label' => esc_html__('Alignment', 'quanta'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'quanta'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'quanta'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'quanta'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );
        $this->end_controls_section();

        // Features group
        $this->start_controls_section(
            'tp_features',
            [
                'label' => esc_html__('Features List', 'quanta'),
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
            'tp_features_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'quanta'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'quanta'),
                    'icon' => esc_html__('Icon', 'quanta'),
                ],
            ]
        );

        $repeater->add_control(
            'tp_features_image',
            [
                'label' => esc_html__('Upload Icon Image', 'quanta'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_features_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_features_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa-solid fa-check',
                    'condition' => [
                        'tp_features_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_features_selected_icon',
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
                        'tp_features_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_features_title', [
                'label' => esc_html__('Title', 'quanta'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'quanta'),
                'label_block' => true,
            ]
        );
     
        $this->add_control(
            'tp_features_list',
            [
                'label' => esc_html__('Services - List', 'quanta'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_features_title' => esc_html__('Discover', 'quanta'),
                    ],
                    [
                        'tp_features_title' => esc_html__('Define', 'quanta')
                    ],
                    [
                        'tp_features_title' => esc_html__('Develop', 'quanta')
                    ]
                ],
                'title_field' => '{{{ tp_features_title }}}',
            ]
        );
        $this->end_controls_section();


		$this->start_controls_section(
            '_tp_icon',
            [
                'label' => esc_html__('Icon', 'quanta'),
                'condition' => [
                    'tp_design_style' => 'layout-5'
                ],
            ]
        );
        $this->add_control(
            'tp_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'quanta'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'quanta'),
                    'icon' => esc_html__('Icon', 'quanta'),
                ],
            ]
        );

        $this->add_control(
            'tp_icon_image',
            [
                'label' => esc_html__('Upload Image', 'quanta'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_icon_type' => 'image'
                ]

            ]
        );
        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_selected_icon',
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
                        'tp_icon_type' => 'icon'
                    ]
                ]
            );
        }
        $this->end_controls_section();

        // tp_btn_button_group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'quanta'),
            ]
        );

        $this->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'quanta' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'quanta' ),
                'label_off' => esc_html__( 'Hide', 'quanta' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_btn_text',
            [
                'label' => esc_html__('Button Text', 'quanta'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'quanta'),
                'title' => esc_html__('Enter button text', 'quanta'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'quanta'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__('Button link', 'quanta'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'quanta'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'tp_btn_link_type' => '1',
                    'tp_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'quanta'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_button_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'quanta'),
            ]
        );
        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__( 'Choose Image', 'quanta' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_image_2',
            [
                'label' => esc_html__( 'Choose Image 2', 'quanta' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_image_3',
            [
                'label' => esc_html__( 'Choose Image 3', 'quanta' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->add_control(
            'tp_image_overlap',
            [
                'label' => esc_html__('Image overlap to top?', 'quanta'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'quanta'),
                'label_off' => esc_html__('No', 'quanta'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'tp_image_height',
            [
                'label' => esc_html__( 'Image Height', 'quanta' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tp_image_overlap_x',
            [
                'label' => esc_html__( 'Image overlap position', 'quanta' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'tp_image_overlap' => 'yes',
                ),
            ]
        );
        $this->end_controls_section();


        // _section_exp_info
        $this->start_controls_section(
            '_section_exp_info',
            [
                'label' => __('Experience Info', 'quanta'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => ['layout-2','layout-5'],
                ],
            ]
        );

        $this->add_control(
            'exp_num',
            [
                'label' => __('Number', 'quanta'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('1998', 'quanta'),
                'placeholder' => __('Type number Here', 'quanta'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'exp_title',
            [
                'label' => __('Title', 'quanta'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('..Since..', 'quanta'),
                'placeholder' => __('Type your text', 'quanta'),
                'dynamic' => [
                    'active' => true,
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
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big');

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', ' btn btn--styleOne btn--secondary it-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', ' btn btn--styleOne btn--secondary it-btn');
                }
            }

        ?>

        <section class="about">
          <div class="container">
            <div class="row align-items-center justify-content-between">
              <div class="col-lg-6 mb-30">
                <div class="aboutContent aboutContent--style2">
                  <!-- Section Heading/Title -->
                  <div class="sectionTitle mb-20">
                    <?php if ( !empty($settings['tp_sub_title']) ) : ?>    
                    <span class="sectionTitle__small">
                        <i class="fa-solid fa-heart btn__icon"></i><?php echo tp_kses( $settings['tp_sub_title'] ); ?>
                    </span>
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
                  </div>
                  <!-- Section Heading/Title End -->
                    <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                        <p class="aboutContent__text"><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                    <?php endif; ?>

                    <?php if ( !empty($settings['tp_short_desctiption']) ) : ?>
                    <span class="aboutContent__quote"><?php echo tp_kses( $settings['tp_short_desctiption'] ); ?></span>
                    <?php endif; ?>

                    <?php if (!empty($settings['tp_btn_text'])) : ?>
                    <div class="tp-hero-btn">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                            <span class="btn__text"><?php echo $settings['tp_btn_text']; ?></span> 
                            <i class="fa-solid fa-heart btn__icon"></i>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
              </div>
              <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
              <div class="col-lg-5">
                <div class="aboutThumb">
                  <div class="aboutThumb__text">
                    <?php if (!empty($settings['exp_title'])) : ?>
                    <span class="aboutThumb__text__title"><?php echo tp_kses($settings['exp_title']); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($settings['exp_num'])) : ?>
                    <span class="aboutThumb__text__year"><?php echo tp_kses($settings['exp_num']); ?></span>
                    <?php endif; ?>
                  </div>
                  <figure class="aboutThumb__figure m-0">
                    <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                  </figure>
                </div>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </section>

        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'btn btn--styleOne btn--primary it-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'btn btn--styleOne btn--primary it-btn');
                }
            }
        ?>

        <section class="fact fact--layout1 position-relative">
          <div class="container">
            <div class="volunteer">
              <div class="container">
                <div class="row align-items-center">
                  <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>  
                  <div class="col-lg-6 mb-30">
                    <div class="volunteerUser">
                      <div class="volunteerUser__box">
                        <div class="volunteerUser__thumb">
                          <img class="hero__figure__thumbs" src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        </div>
                        <div class="volunteerUser__profile">
                          <ul>
                            <li>
                              <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/image/users/volunteer-user1.jpg" alt="Gainioz"></a>
                            </li>
                            <li>
                              <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/image/users/volunteer-user2.jpg" alt="Gainioz"></a>
                            </li>
                            <li>
                              <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/image/users/volunteer-user3.jpg" alt="Gainioz"></a>
                            </li>
                            <li>
                              <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/image/users/volunteer-user4.jpg" alt="Gainioz"></a>
                            </li>
                            <li>
                              <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/image/users/volunteer-user5.jpg" alt="Gainioz"></a>
                            </li>
                            <li>
                              <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/image/users/volunteer-user6.jpg" alt="Gainioz"></a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="col-lg-6 mb-30">
                    <div class="aboutContent aboutContent--style3">
                       <?php if ( !empty($settings['tp_section_title_show']) ) : ?> 
                      <!-- Section Heading/Title -->
                      <div class="sectionTitle mb-20">
                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>    
                        <span class="sectionTitle__small">
                            <i class="fa-solid fa-heart btn__icon"></i><?php echo tp_kses( $settings['tp_sub_title'] ); ?>
                        </span>
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
                      </div>
                      <!-- Section Heading/Title End -->
                    <?php if ( !empty($settings['tp_short_desctiption']) ) : ?>
                    <span class="aboutContent__quote text-uppercase"><?php echo tp_kses( $settings['tp_short_desctiption'] ); ?></span>
                    <?php endif; ?>
                    <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                        <p class="aboutContent__text"><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                    <?php endif; ?>
                    <?php endif; ?>

                    <?php if (!empty($settings['tp_btn_text'])) : ?>
                    <div class="aboutContent__buttons">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                            <span class="btn__text"><?php echo $settings['tp_btn_text']; ?></span> 
                            <i class="fa-solid fa-heart btn__icon"></i>
                        </a>
                    </div>
                    <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'btn btn--styleOne btn--secondary it-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'btn btn--styleOne btn--secondary it-btn');
                }
            }
        ?>

        <section class="joinSection position-relative overflow-hidden">
          <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>    
          <div class="joinSectionThumb d-none d-lg-block">
            <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
          </div>
          <?php endif; ?>
          <div class="container">
            <div class="row justify-content-end">
              <div class="col-lg-6">
                <div class="joinContent">
                  <?php if ( !empty($settings['tp_section_title_show']) ) : ?>   
                  <div class="row justify-content-end">
                    <div class="col-10">
                      <!-- Section Heading/Title -->
                      <div class="sectionTitle mb-20">
                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>    
                        <span class="sectionTitle__small justify-content-end">
                            <i class="fa-solid fa-heart btn__icon"></i><?php echo tp_kses( $settings['tp_sub_title'] ); ?>
                        </span>
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
                      </div>
                      <!-- Section Heading/Title End -->
                    </div>
                  </div>

                  <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                    <p class="joinContent__text"><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                  <?php endif; ?>
                  <?php endif; ?>

                    <?php if (!empty($settings['tp_btn_text'])) : ?>
                    <div class="aboutContent__buttonss">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                            <span class="btn__text"><?php echo $settings['tp_btn_text']; ?></span> 
                            <i class="fa-solid fa-heart btn__icon"></i>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </section>

        <?php elseif ( $settings['tp_design_style']  == 'layout-5' ): 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'btn btn--styleOne btn--primary it-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'btn btn--styleOne btn--primary it-btn');
                }
            }
        ?>

        <section class="about gray-bg about--style3">
          <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>    
          <div class="aboutThumb3 d-none d-lg-block">
            <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
          </div>
          <?php endif; ?>
          <div class="container">
            <div class="row align-items-end justify-content-between">
              <div class="col-lg-6 mb-30">
                <div class="aboutContent aboutContent--style2">
                  <!-- Section Heading/Title -->
                  <?php if ( !empty($settings['tp_section_title_show']) ) : ?>
                  <div class="sectionTitle mb-20">
                    <?php if ( !empty($settings['tp_sub_title']) ) : ?>    
                    <span class="sectionTitle__small">
                        <i class="fa-solid fa-heart btn__icon"></i><?php echo tp_kses( $settings['tp_sub_title'] ); ?>
                    </span>
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
                  </div>
                  <!-- Section Heading/Title End -->
                  <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                    <p class="aboutContent__text"><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                  <?php endif; ?>
                  <?php endif; ?>

                  <?php if ( !empty($settings['tp_short_desctiption']) ) : ?>
                    <span class="aboutContent__quote"><?php echo tp_kses( $settings['tp_short_desctiption'] ); ?></span>
                  <?php endif; ?>


                    <?php if (!empty($settings['tp_btn_text'])) : ?>
                    <div class="aboutContent__buttons">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                            <span class="btn__text"><?php echo $settings['tp_btn_text']; ?></span> 
                            <i class="fa-solid fa-heart btn__icon"></i>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="aboutThumb aboutThumb--style3">
                  <div class="aboutThumb__text d-none d-lg-block">
                    <?php if (!empty($settings['exp_title'])) : ?>
                    <span class="aboutThumb__text__title"><?php echo tp_kses($settings['exp_title']); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($settings['exp_num'])) : ?>
                    <span class="aboutThumb__text__year"><?php echo tp_kses($settings['exp_num']); ?></span>
                    <?php endif; ?>
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

            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }            

            if ( !empty($settings['tp_image_3']['url']) ) {
                $tp_image_3 = !empty($settings['tp_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_image_3']['id'], $settings['tp_image_size_size']) : $settings['tp_image_3']['url'];
                $tp_image_3_alt = get_post_meta($settings["tp_image_3"]["id"], "_wp_attachment_image_alt", true);
            }

			$this->add_render_attribute('title_args', 'class', 'section__title');

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-btn-2');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-btn-2');
                }
            }
		?>	

         <section class="about__area p-relative">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-7 col-xl-7 col-lg-7">
                     <div class="about__thumb-wrapper d-sm-flex mr-20 p-relative">
                        <div class="about__shape">
                           <img class="about__shape-1 d-none d-sm-block" src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about-shape-1.png" alt="img">
                           <img class="about__shape-2 d-none d-sm-block" src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about-shape-2.png" alt="img">
                           <img class="about__shape-3" src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about-shape-3.png" alt="img">
                        </div>
                        <div class="about__thumb-left mr-10">
                            <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
                           <div class="about__thumb-1 mb-10">
                             <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                           </div>
                           <?php endif; ?>
                           <?php if ($settings['tp_image_2']['url'] || $settings['tp_image_2']['id']) : ?>
                           <div class="about__thumb-1 mb-10 text-end">
                              <img src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
                           </div>
                           <?php endif; ?>
                        </div>
                        <?php if ($settings['tp_image_3']['url'] || $settings['tp_image_3']['id']) : ?>
                        <div class="about__thumb-2 mb-10">
                           <img src="<?php echo esc_url($tp_image_3); ?>" alt="<?php echo esc_attr($tp_image_3_alt); ?>">
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
                  <div class="col-xxl-5 col-xl-5 col-lg-5">
                     <div class="about__content pl-70 pr-25">
                        <?php if ( !empty($settings['tp_section_title_show']) ) : ?>

                        <div class="section__title-wrapper mb-15">
                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>    
                        <span class="section__title-pre">
                            <?php echo tp_kses( $settings['tp_sub_title'] ); ?>
                        </span>
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
                        </div>

                        <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                        <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                        <?php endif; ?>

                        <?php endif; ?>

                        <div class="about__list mb-40">
                           <ul>
                              <?php foreach ($settings['tp_features_list'] as $item) : ?>
                              <li>
                                <?php if($item['tp_features_icon_type'] !== 'image') : ?>
                                    <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                                        <span><?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?></span>
                                    <?php endif; ?>   
                                <?php else : ?>
                                    <span class="keyFeatureBlock__icon">
                                        <?php if (!empty($item['tp_features_image']['url'])): ?>
                                        <img class="light" src="<?php echo $item['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>  
                                    </span>
                                <?php endif; ?> 
                                <?php echo tp_kses($item['tp_features_title' ]); ?>
                                </li>
                              <?php endforeach; ?> 
                           </ul>
                        </div>

                        <?php if (!empty($settings['tp_btn_text'])) : ?>
                        <div class="about__btn">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                                <?php echo $settings['tp_btn_text']; ?>
                            </a>
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_About() );