<?php
namespace Quanta;

use Quanta\PageSettings\Page_Settings;
use Elementor\Controls_Manager;


/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class TP_Core_Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Add Category
	 */

    public function tp_core_elementor_category($manager)
    {
        $manager->add_category(
            'quanta',
            array(
                'title' => esc_html__('TP Addons', 'quanta'),
                'icon' => 'eicon-banner',
            )
        );
    }

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'quanta', plugins_url( '/assets/js/hello-world.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'editor_scripts_as_a_module' ], 10, 2 );

		wp_enqueue_script(
			'quanta-editor',
			plugins_url( '/assets/js/editor/editor.js', __FILE__ ),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}


	/**
	 * tp_enqueue_editor_scripts
	 */
    function tp_enqueue_editor_scripts()
    {
        wp_enqueue_style('tp-element-addons-editor', QUANTA_ADDONS_URL . 'assets/css/editor.css', null, '1.0');
    }

    



	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'quanta-editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		// Its is now safe to include Widgets files
		foreach($this->quanta_widget_list() as $widget_file_name){
			require_once( QUANTA_ELEMENTS_PATH . "/{$widget_file_name}.php" );
		}

		// Charitable_Campaign
		if ( function_exists( 'tutor' ) ) {
			foreach($this->quanta_widget_list_tutor() as $widget_file_name){
				require_once( QUANTA_ELEMENTS_PATH . "/{$widget_file_name}.php" );
			}
		}
	}

	public function quanta_widget_list() {
		return [
			'slider',
			'heading',
			'hero-banner',
			'pricing',
			'campaign',
			'features',
			'advanced-tab',
			'team',
			'team-details',
			'cta',
			'fact',
			'about',
			'brand',
			'services',
			'process',
			'testimonial',
			'portfolio',
			// 'portfolio-post',
			'blog-post',
			'contact-form',
			'contact-info',
			// 'skill',
			'iconbox',
			// 'gallery-tab',
			'big-text',
			'live-donation',
			'tp-btn',
			'stories',
			'mission',
			'events',
			'faq',
			'video-popup',
			'category',
			'info-list-box',
			'app-download',
			'hello-world',
			'inline-editing'
		];
	}

	// quanta_widget_list_campaign
	public function quanta_widget_list_tutor() {
		return [
			'tutor-course',
		];
	}

	/**
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 *
	 * @since 1.2.1
	 * @access private
	 */
	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/manager.php' );
		new Page_Settings();
	}


	/**
	 * Register controls
	 *
	 * @param Controls_Manager $controls_Manager
	 */

    public function register_controls(Controls_Manager $controls_Manager)
    {
        include_once(QUANTA_ADDONS_DIR . '/controls/tpgradient.php');
        $tpgradient = 'Quanta\Elementor\Controls\Group_Control_TPGradient';
        $controls_Manager->add_group_control($tpgradient::get_type(), new $tpgradient());

        include_once(QUANTA_ADDONS_DIR . '/controls/tpbggradient.php');
        $tpbggradient = 'Quanta\Elementor\Controls\Group_Control_TPBGGradient';
        $controls_Manager->add_group_control($tpbggradient::get_type(), new $tpbggradient());
    }


    

    public function tp_add_custom_icons_tab($tabs = array()){



    // 	// echo "<pre>";
    // 	// print_r($custom_font_icons);

        // $tabs['tp-feather-icons'] = array(
        //     'name' => 'tp-feather-icons',
        //     'label' => esc_html__('TP - Feather Icons', 'quanta'),
        //     'labelIcon' => 'tp-icon',
        //     'prefix' => '',
        //     'displayPrefix' => 'tp',
        //     'url' => QUANTA_ADDONS_URL . 'assets/css/feather.css',
        //     'icons' => include_once(QUANTA_ADDONS_DIR . '/include/icons/feather-fonts.php'),
        //     'ver' => '1.0.0',
        // ); 


        // $tabs['tp-fontawesome-icons'] = array(
        //     'name' => 'tp-fontawesome-icons',
        //     'label' => esc_html__('TP - Fontawesome Pro Light', 'quanta'),
        //     'labelIcon' => 'tp-icon',
        //     'prefix' => 'fa-',
        //     'displayPrefix' => 'fal',
        //     'url' => QUANTA_ADDONS_URL . 'assets/css/fontawesome-all.min.css',
        //     'icons' => include_once(QUANTA_ADDONS_DIR . '/include/icons/fa-light-fonts.php'),
        //     'ver' => '1.0.0',
        // );    


        // return $tabs;



        // Append new icons
        $feather_icons = array(
            'feather-activity',
            'feather-airplay',
            'feather-alert-circle',
            'feather-alert-octagon',
            'feather-alert-triangle',
            'feather-align-center',
            'feather-align-justify',
            'feather-align-left',
            'feather-align-right',
        );

        $tabs['tp-feather-icons'] = array(
            'name' => 'tp-feather-icons',
            'label' => esc_html__('TP - Feather Icons', 'quanta'),
            'labelIcon' => 'tp-icon',
            'prefix' => '',
            'displayPrefix' => 'tp',
            'url' => QUANTA_ADDONS_URL . 'assets/css/feather.css',
            'icons' => $feather_icons,
            'ver' => '1.0.0',
        ); 

        $feather_icons = array(
	        'angle-up',
	        'check',
	        'times',
	        'calendar',
	        'language',
	        'shopping-cart',
	        'bars',
	        'search',
	        'map-marker',
	        'arrow-right',
	        'arrow-left',
	        'arrow-up',
	        'arrow-down',
	        'angle-right',
	        'angle-left',
	        'angle-up',
	        'angle-down',
	        'phone',
	        'users',
	        'user',
	        'map-marked-alt',
	        'trophy-alt',
	        'envelope',
	        'marker',
	        'globe',
	        'broom',
	        'home',
	        'bed',
	        'chair',
	        'bath',
	        'tree',
	        'laptop-code',
	        'cube',
	        'cog',
	        'play',
	        'trophy-alt',
	        'heart',
	        'truck',
	        'user-circle',
	        'map-marker-alt',
	        'comments',
	         'award',
	        'bell',
	        'book-alt',
	        'book-open',
	        'book-reader',
	        'graduation-cap',
	        'laptop-code',
	        'music',
	        'ruler-triangle',
	        'user-graduate',
	        'microscope',
	        'glasses-alt',
	        'theater-masks',
	        'atom'
        );

        $tabs['tp-fontawesome-icons'] = array(
            'name' => 'tp-fontawesome-icons',
            'label' => esc_html__('TP - Fontawesome Pro Light', 'quanta'),
            'labelIcon' => 'tp-icon',
            'prefix' => 'fa-',
            'displayPrefix' => 'fal',
            'url' => QUANTA_ADDONS_URL . 'assets/css/fontawesome-all.min.css',
            'icons' => $feather_icons,
            'ver' => '1.0.0',
        );        

        return $tabs;
    }


	// campaign_template_fun
	public function campaign_template_fun( $campaign_template ) {

	    if ( ( get_post_type() == 'campaign' ) && is_single() ) {
	        $campaign_template_file_path = __DIR__ . '/include/template/single-campaign.php';
	        $campaign_template           = $campaign_template_file_path;
	    }
	    if ( ( get_post_type() == 'tribe_events' ) && is_single() ) {
	        $campaign_template_file_path = __DIR__ . '/include/template/single-event.php';
	        $campaign_template           = $campaign_template_file_path;
	    }

	    if ( ! $campaign_template ) {
	        return $campaign_template;
	    }
	    return $campaign_template;
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );

		add_action('elementor/elements/categories_registered', [$this, 'tp_core_elementor_category']);

		// Register custom controls
	    add_action('elementor/controls/controls_registered', [$this, 'register_controls']);

	    add_filter('elementor/icons_manager/additional_tabs', [$this, 'tp_add_custom_icons_tab']);

	    // $this->tp_add_custom_icons_tab();

	    add_action('elementor/editor/after_enqueue_scripts', [$this, 'tp_enqueue_editor_scripts'] );

	    add_filter( 'template_include', [ $this, 'campaign_template_fun' ], 99 );

		$this->add_page_settings_controls();

	}


}

// Instantiate Plugin Class
TP_Core_Plugin::instance();