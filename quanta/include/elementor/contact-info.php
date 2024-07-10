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
class TP_Contact_Info extends Widget_Base {

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
		return 'contact-info';
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
		return __( 'Contact Info', 'quanta' );
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


    protected static function get_profile_names()
    {
        return [
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

        // Service group
        $this->start_controls_section(
            '_TP_contact_info',
            [
                'label' => esc_html__('Portfolio List', 'quanta'),
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
                    'style_3' => __( 'Style 3', 'quanta' ),
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
                    'default' => 'fa fa-star',
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
            'tp_title', [
                'label' => esc_html__('Title', 'quanta'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'quanta'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_description',
            [
                'label' => esc_html__('Description', 'quanta'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );         

        $repeater->add_control(
            'tp_contact_link',
            [
                'label' => esc_html__('Description CTA', 'quanta'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Phone and Email',
                'label_block' => true,
            ]
        ); 

        $this->add_control(
            'tp_list',
            [
                'label' => esc_html__('Services - List', 'quanta'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_title' => esc_html__('united states', 'quanta'),
                    ],
                    [
                        'tp_title' => esc_html__('south Africa', 'quanta')
                    ],
                    [
                        'tp_title' => esc_html__('United Kingdom', 'quanta')
                    ]
                ],
                'title_field' => '{{{ tp_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_align',
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
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-post-thumb',
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


        <div class="contact__info white-bg p-relative z-index-1">
            <div class="contact__info-inner white-bg">
               <ul>
                <?php foreach ($settings['tp_list'] as $item) : ?>
                  <li>
                     <div class="contact__info-item d-flex align-items-start mb-35">
                        <div class="contact__info-icon mr-15">
                            <?php if($item['tp_features_icon_type'] !== 'image') : ?>
                                <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                                    <span class="contact_info_icon"><?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?></span>
                                <?php endif; ?>   
                            <?php else : ?>
                                <span class="contact_info_icon">
                                    <?php if (!empty($item['tp_features_image']['url'])): ?>
                                    <img src="<?php echo $item['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>  
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="contact__info-text">
                           <h4><?php echo tp_kses($item['tp_title' ]); ?></h4>
                        <?php if (!empty($item['tp_description' ])): ?>
                        <p><?php echo tp_kses($item['tp_description']); ?></p>
                        <?php endif; ?>

                        </div>
                     </div>
                  </li>
                <?php endforeach; ?>
               </ul>


                <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                    <div class="contact__social pl-30">
                        <h4><?php echo esc_html__('Follow Us','quanta'); ?></h4>
                        <ul>
                        <?php
                        foreach ($settings['profiles'] as $profile) :
                            $icon = $profile['name'];
                            $url = esc_url($profile['link']['url']);

                            printf('<li><a target="_blank" rel="noopener"  href="%s" class="elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a></li>',
                                $url,
                                esc_attr($profile['_id']),
                                esc_attr($icon)
                            );
                        endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php 
	}
}

$widgets_manager->register( new TP_Contact_Info() );