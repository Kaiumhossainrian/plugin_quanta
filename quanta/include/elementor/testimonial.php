<?php
namespace Quanta\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * quanta
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Testimonial extends Widget_Base {

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
		return 'testimonial';
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
		return __( 'Testimonial', 'quanta' );
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


        // _tp_image
        $this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'quanta'),
                'condition' => [
                    'tp_design_style' => 'layout-2'
                ],
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

        // Review group
        $this->start_controls_section(
            'review_list',
            [
                'label' => esc_html__( 'Review List', 'quanta' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'reviewer_image',
            [
                'label' => esc_html__( 'Reviewer Image', 'quanta' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $repeater->add_control(
            'reviewer_name', [
                'label' => esc_html__( 'Reviewer Name', 'quanta' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'quanta' ),
                'label_block' => true,
            ]
        );        

        $repeater->add_control(
            'review_sub', [
                'label' => esc_html__( 'Reviewe Subject', 'quanta' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Code Quality!' , 'quanta' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'reviewer_title', [
                'label' => esc_html__( 'Reviewer Title', 'quanta' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '- CEO at YES Germany' , 'quanta' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'review_content',
            [
                'label' => esc_html__( 'Review Content', 'quanta' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__( 'Type your review content here', 'quanta' ),
            ]
        );

        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__( 'Review List', 'quanta' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'quanta' ),
                        'reviewer_title' => esc_html__( '- CEO at YES Germany', 'quanta' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'quanta' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'quanta' ),
                        'reviewer_title' => esc_html__( '- CEO at YES Germany', 'quanta' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'quanta' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'quanta' ),
                        'reviewer_title' => esc_html__( '- CEO at YES Germany', 'quanta' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'quanta' ),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'default' => 'thumbnail',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();
		

        // _section_logo_list
        $this->start_controls_section(
            '_section_logo_list',
            [
                'label' => __('Logo List', 'quanta'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $repeater = new Repeater();

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
            'image_light',
            [
                'label' => __('Image', 'quanta'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'logo_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print("Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'about_logo_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
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
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>
        <section class="review position-relative overflow-hidden">
          <div class="container">
            <div class="row">
              <?php if ( !empty($settings['tp_section_title_show']) ) : ?>  
              <div class="col-lg-6">
                <!-- Section Heading/Title -->
                <div class="sectionTitle mb-65">
                    <?php if ( !empty($settings['tp_sub_title']) ) : ?>  
                    <span class="sectionTitle__small">
                    <i class="fa-solid fa-heart btn__icon"></i>
                    Testimonial
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

                    <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                    <p class="desc"><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                    <?php endif; ?>
                </div>
                <!-- Section Heading/Title End -->
                <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
                <div class="reviewMap mb-50">
                  <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                </div>
                <?php endif; ?>
              </div>
              <?php endif; ?>
              <div class="col-lg-6">
                <div class="row">
                    <?php foreach ($settings['reviews_list'] as $index => $item) : 
                        if ( !empty($item['reviewer_image']['url']) ) {
                            $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                            $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                    ?>
                  <div class="col-lg-6 col-md-6">
                    <div class="reviewblock reviewblock--style2">
                      <div class="reviewblock__content">
                        <div class="reviewblock__author">
                          <?php if ( !empty($tp_reviewer_image) ) : ?>   
                          <div class="reviewblock__authorImage">
                            <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                          </div>
                          <?php endif; ?>

                          <?php if ( !empty($item['reviewer_name']) ) : ?> 
                          <h3 class="reviewblock__authorName"><?php echo tp_kses($item['reviewer_name']); ?></h3>
                          <?php endif; ?>
                          <?php if ( !empty($item['review_content']) ) : ?>
                          <p class="reviewblock__authorSpeech"><?php echo tp_kses($item['review_content']); ?></p>
                          <?php endif; ?>
                          <?php if ( !empty($item['reviewer_title']) ) : ?>
                          <span class="reviewblock__authorDes"><?php echo tp_kses($item['reviewer_title']); ?></span>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </section>

        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
        ?>
        <section class="review review--layout2 position-relative overflow-hidden">
          <div class="container-fluid p-0">
            <div class="row justify-content-center">
              <?php if ( !empty($settings['tp_section_title_show']) ) : ?>  
              <div class="col-lg-6">
                <!-- Section Heading/Title -->
                <div class="sectionTitle mb-65">
                    <?php if ( !empty($settings['tp_sub_title']) ) : ?>  
                    <span class="sectionTitle__small">
                    <i class="fa-solid fa-heart btn__icon"></i>
                    Testimonial
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

                    <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                    <p class="desc"><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                    <?php endif; ?>
                </div>
                <!-- Section Heading/Title End -->
                <div class="reviewMap mb-50">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/image/map/map-thumb.png" alt="Gainioz Map">
                </div>
              </div>
              <?php endif; ?>
            </div>

            <div class="testi-slider-active2 swiper-container row g-0">
              <div class="swiper-wrapper">
                <?php foreach ($settings['reviews_list'] as $index => $item) : 
                    if ( !empty($item['reviewer_image']['url']) ) {
                        $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                        $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                ?>
                <div class="swiper-slide col-6">
                  <div class="review__box mb-30">
                    <div class="reviewblock reviewblock--style3 text-center">
                      <div class="reviewblock__content">
                        <div class="reviewblock__author">
                          <?php if ( !empty($tp_reviewer_image) ) : ?>    
                          <img class="reviewblock__author__image" src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                          <?php endif; ?>

                          <?php if ( !empty($item['reviewer_name']) ) : ?>
                          <span class="reviewblock__author__name d-block mb-25"><?php echo tp_kses($item['reviewer_name']); ?></span>
                          <?php endif; ?>
                          <br>
                          <?php if ( !empty($item['reviewer_title']) ) : ?>
                          <span class="reviewblock__authorDes"><?php echo tp_kses($item['reviewer_title']); ?></span>
                          <?php endif; ?>
                        </div>
                        <span class="reviewblock__quoteIcon__one">
                        <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M21.75 10.9951H18V7.99512C18 6.35449 19.3125 4.99512 21 4.99512H21.375C21.9844 4.99512 22.5 4.52637 22.5 3.87012V1.62012C22.5 1.01074 21.9844 0.495117 21.375 0.495117H21C16.8281 0.495117 13.5 3.87012 13.5 7.99512V19.2451C13.5 20.5107 14.4844 21.4951 15.75 21.4951H21.75C22.9688 21.4951 24 20.5107 24 19.2451V13.2451C24 12.0264 22.9688 10.9951 21.75 10.9951ZM8.25 10.9951H4.5V7.99512C4.5 6.35449 5.8125 4.99512 7.5 4.99512H7.875C8.48438 4.99512 9 4.52637 9 3.87012V1.62012C9 1.01074 8.48438 0.495117 7.875 0.495117H7.5C3.32812 0.495117 0 3.87012 0 7.99512V19.2451C0 20.5107 0.984375 21.4951 2.25 21.4951H8.25C9.46875 21.4951 10.5 20.5107 10.5 19.2451V13.2451C10.5 12.0264 9.46875 10.9951 8.25 10.9951Z"
                            fill="#EB9309" />
                        </svg>
                      </span>
                        <?php if ( !empty($item['review_content']) ) : ?>
                        <h4 class="reviewblock__qotes">“ <?php echo tp_kses($item['review_content']); ?> “</h4>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
              <div class="it-pagination"></div>
            </div>
          </div>
        </section>

		<?php else: 
			$this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
		?>

         <section class="testimonial__area fix pb-70">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="testimonial__slider">
                        <div class="testimonial__active owl-carousel">
                            <?php foreach ($settings['reviews_list'] as $index => $item) : 
                                if ( !empty($item['reviewer_image']['url']) ) {
                                    $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                    $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                          <div class="testimonial__item transition-3 text-center white-bg">
                            <?php if ( !empty($tp_reviewer_image) ) : ?>
                            <div class="testimonial__avater">   
                                <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                            </div>
                            <?php endif; ?>

                             <div class="testimonial__text">
                                <?php if ( !empty($item['review_sub']) ) : ?>
                                <h4><?php echo tp_kses($item['review_sub']); ?></h4>
                                <?php endif; ?>

                                <?php if ( !empty($item['review_content']) ) : ?>
                                <p><?php echo tp_kses($item['review_content']); ?></p>
                                <?php endif; ?>

                             </div>
                             <div class="testimonial__avater-info mb-5">
                                <?php if ( !empty($item['reviewer_name']) ) : ?>
                                <h3><?php echo tp_kses($item['reviewer_name']); ?></h3>
                                <?php endif; ?>
                                <?php if ( !empty($item['reviewer_title']) ) : ?>
                                <span><?php echo tp_kses($item['reviewer_title']); ?></span>
                                <?php endif; ?>
                             </div>
                             <div class="testimonial__rating">
                                <ul>
                                   <li>
                                      <a href="#"><i class="fa-solid fa-star"></i></a>
                                   </li>
                                   <li>
                                      <a href="#"><i class="fa-solid fa-star"></i></a>
                                   </li>
                                   <li>
                                      <a href="#"><i class="fa-solid fa-star"></i></a>
                                   </li>
                                   <li>
                                      <a href="#"><i class="fa-solid fa-star"></i></a>
                                   </li>
                                   <li>
                                      <a href="#"><i class="fa-solid fa-star"></i></a>
                                   </li>
                                </ul>
                             </div>
                          </div>
                          <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Testimonial() );