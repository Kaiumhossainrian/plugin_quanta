<?php
namespace Quanta\Widgets;

use Elementor\Widget_Base;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Box_Shadow;
use Quanta\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * quanta
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Team_Details extends Widget_Base {

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
		return 'team-details';
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
		return __( 'Team Details', 'quanta' );
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

    protected static function get_profile_names()
    {
        return [
            '500px' => esc_html__('500px', 'quanta'),
            'apple' => esc_html__('Apple', 'quanta'),
            'behance' => esc_html__('Behance', 'quanta'),
            'bitbucket' => esc_html__('BitBucket', 'quanta'),
            'codepen' => esc_html__('CodePen', 'quanta'),
            'delicious' => esc_html__('Delicious', 'quanta'),
            'deviantart' => esc_html__('DeviantArt', 'quanta'),
            'digg' => esc_html__('Digg', 'quanta'),
            'dribbble' => esc_html__('Dribbble', 'quanta'),
            'email' => esc_html__('Email', 'quanta'),
            'facebook' => esc_html__('Facebook', 'quanta'),
            'flickr' => esc_html__('Flicker', 'quanta'),
            'foursquare' => esc_html__('FourSquare', 'quanta'),
            'github' => esc_html__('Github', 'quanta'),
            'houzz' => esc_html__('Houzz', 'quanta'),
            'instagram' => esc_html__('Instagram', 'quanta'),
            'jsfiddle' => esc_html__('JS Fiddle', 'quanta'),
            'linkedin' => esc_html__('LinkedIn', 'quanta'),
            'medium' => esc_html__('Medium', 'quanta'),
            'pinterest' => esc_html__('Pinterest', 'quanta'),
            'product-hunt' => esc_html__('Product Hunt', 'quanta'),
            'reddit' => esc_html__('Reddit', 'quanta'),
            'slideshare' => esc_html__('Slide Share', 'quanta'),
            'snapchat' => esc_html__('Snapchat', 'quanta'),
            'soundcloud' => esc_html__('SoundCloud', 'quanta'),
            'spotify' => esc_html__('Spotify', 'quanta'),
            'stack-overflow' => esc_html__('StackOverflow', 'quanta'),
            'tripadvisor' => esc_html__('TripAdvisor', 'quanta'),
            'tumblr' => esc_html__('Tumblr', 'quanta'),
            'twitch' => esc_html__('Twitch', 'quanta'),
            'twitter' => esc_html__('Twitter', 'quanta'),
            'vimeo' => esc_html__('Vimeo', 'quanta'),
            'vk' => esc_html__('VK', 'quanta'),
            'website' => esc_html__('Website', 'quanta'),
            'whatsapp' => esc_html__('WhatsApp', 'quanta'),
            'wordpress' => esc_html__('WordPress', 'quanta'),
            'xing' => esc_html__('Xing', 'quanta'),
            'yelp' => esc_html__('Yelp', 'quanta'),
            'youtube' => esc_html__('YouTube', 'quanta'),
        ];
    }


	protected function register_controls() {

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

        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'quanta'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'quanta'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_profile_names()
            ]
        );

        $repeater->add_control(
            'link', [
                'label' => esc_html__('Profile Link', 'quanta'),
                'placeholder' => esc_html__('Add your profile link', 'quanta'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'https://facebook.com/'],
                        'name' => 'facebook'
                    ],
                    [
                        'link' => ['url' => 'https://linkedin.com/'],
                        'name' => 'linkedin'
                    ],
                    [
                        'link' => ['url' => 'https://twitter.com/'],
                        'name' => 'twitter'
                    ]
                ],
            ]
        );

        $this->add_control(
            'show_profiles',
            [
                'label' => esc_html__('Show Profiles', 'quanta'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'quanta'),
                'label_off' => esc_html__('Hide', 'quanta'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'style_transfer' => true,
            ]
        );


        $this->end_controls_section();


        // Skill
        $this->start_controls_section(
            'tp_progress_bar',
            [
                'label' => esc_html__('Skill Bar', 'quanta'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Name', 'quanta' ),
                'default' => esc_html__( 'Design', 'quanta' ),
                'placeholder' => esc_html__( 'Type a skill name', 'quanta' ),
            ]
        );

        $repeater->add_control(
            'level',
            [
                'label' => esc_html__( 'Level (Out Of 100)', 'quanta' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                    'size' => 95
                ],
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $repeater->add_control(
            'want_customize',
            [
                'label' => esc_html__( 'Want To Customize?', 'quanta' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'quanta' ),
                'label_off' => esc_html__( 'No', 'quanta' ),
                'return_value' => 'yes',
                'description' => esc_html__( 'You can customize this skill bar color from here or customize from Style tab', 'quanta' ),
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'quanta' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .title' => 'color: {{VALUE}};',
                ],
                'condition' => ['want_customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'percentage_color',
            [
                'label' => esc_html__( 'Percentage label Color', 'quanta' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .percentage' => 'color: {{VALUE}};',
                ],
                'condition' => ['want_customize' => 'yes'],
                'style_transfer' => true,
            ]
        );


        $repeater->add_group_control(
            Group_Control_TPBGGradient::get_type(),
            [
                'name' => 'level_color',
                'label' => esc_html__('Level Color', 'quanta'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .progress-bar',
                'condition' => ['want_customize' => 'yes'],
            ]
        );

        $repeater->add_control(
            'base_color',
            [
                'label' => esc_html__( 'Base Color', 'quanta' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .progress' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['want_customize' => 'yes'],
            ]
        );

        $this->add_control(
            'skills',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print((name || level.size) ? (name || "Skill") + " - " + level.size + level.unit : "Skill - 0%") #>',
                'default' => [
                    [
                        'name' => 'Design',
                        'level' => ['size' => 95, 'unit' => '%']
                    ],
                    [
                        'name' => 'UX',
                        'level' => ['size' => 85, 'unit' => '%']
                    ]
                ]
            ]
        );
        $this->add_control(
            'view',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__( 'Layout', 'quanta' ),
                'separator' => 'before',
                'default' => 'progress-bar--1',
                'options' => [
                    'progress-bar--2' => esc_html__( 'Thin', 'quanta' ),
                    'progress-bar--1' => esc_html__( 'Normal', 'quanta' ),
                    'progress-bar--3' => esc_html__( 'Bold', 'quanta' ),
                ],
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

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'team-details-title text-uppercase mb-10');

		?>

        <section class="volunteersSection">
          <div class="container">
            <div class="row">
              <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>  
              <div class="col-lg-5 col-md-6">
                <div class="team-details-img">
                    <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                </div>
              </div>
              <?php endif; ?>

              <div class="col-lg-7 col-md-6">
                <div class="team-details-content pt-40">

                    <?php if ( !empty($settings['tp_section_title_show']) ) : ?>
                    <?php
                        if ( !empty($settings['tp_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_title' ] )
                                );
                        endif;
                    ?>
                    <?php if ( !empty($settings['tp_sub_title']) ) : ?>    
                    <span class="team-designation">
                        <?php echo tp_kses( $settings['tp_sub_title'] ); ?>
                    </span>
                    <?php endif; ?>

                    <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                        <div class="team-icon mt-15 mb-30">
                            <?php
                            foreach ($settings['profiles'] as $profile) :
                                $icon = $profile['name'];
                                $url = esc_url($profile['link']['url']);

                                printf('<a target="_blank" rel="noopener"  href="%s" class="elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a>',
                                    $url,
                                    esc_attr($profile['_id']),
                                    esc_attr($icon)
                                );
                            endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                        <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                    <?php endif; ?>

                    <?php endif; ?>

                    <div class="row">
                      <div class="col-lg-9">
                         <div class="featureBlock__donation__progress">
                            <?php foreach ( $settings['skills'] as $index => $skill ) : ?>
                            <div class="featureBlock__donation__bar mb-15 <?php echo esc_attr( $settings['view'] ); ?> elementor-repeater-item-<?php echo $skill['_id']; ?>">
                              <label><?php echo esc_html( $skill['name'] ); ?></label>
                              <span class="featureBlock__donation__text skill-bar" data-width="<?php echo esc_attr( $skill['level']['size'] ); ?>%"><?php echo esc_attr( $skill['level']['size'] ); ?>%</span>
                              <div class="featureBlock__donation__line">
                                <span class="skill-bars">
                                <span class="skill-bars__line skill-bar" data-width="<?php echo esc_attr( $skill['level']['size'] ); ?>%"></span>
                                </span>
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
        </section>

		<?php
	}

}

$widgets_manager->register( new TP_Team_Details() );