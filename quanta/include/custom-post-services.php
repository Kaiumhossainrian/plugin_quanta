<?php 
class TpServicesPost 
{
	function __construct() {
		add_action( 'init', array( $this, 'register_custom_post_type' ) );
		add_action( 'init', array( $this, 'create_cat' ) );
		add_filter( 'template_include', array( $this, 'services_template_include' ) );
	}
	
	public function services_template_include( $template ) {
		if ( is_singular( 'services' ) ) {
			return $this->get_template( 'single-services.php');
		}
		return $template;
	}
	
	public function get_template( $template ) {
		if ( $theme_file = locate_template( array( $template ) ) ) {
			$file = $theme_file;
		} 
		else {
			$file = QUANTA_ADDONS_DIR . '/include/template/'. $template;
		}
		return apply_filters( __FUNCTION__, $file, $template );
	}
	
	
	public function register_custom_post_type() {
		// $medidove_mem_slug = get_theme_mod('medidove_mem_slug','member'); 
		$labels = array(
			'name'                  => esc_html_x( 'Services', 'Post Type General Name', 'quanta' ),
			'singular_name'         => esc_html_x( 'Service', 'Post Type Singular Name', 'quanta' ),
			'menu_name'             => esc_html__( 'Service', 'quanta' ),
			'name_admin_bar'        => esc_html__( 'Service', 'quanta' ),
			'archives'              => esc_html__( 'Item Archives', 'quanta' ),
			'parent_item_colon'     => esc_html__( 'Parent Item:', 'quanta' ),
			'all_items'             => esc_html__( 'All Items', 'quanta' ),
			'add_new_item'          => esc_html__( 'Add New Service', 'quanta' ),
			'add_new'               => esc_html__( 'Add New', 'quanta' ),
			'new_item'              => esc_html__( 'New Item', 'quanta' ),
			'edit_item'             => esc_html__( 'Edit Item', 'quanta' ),
			'update_item'           => esc_html__( 'Update Item', 'quanta' ),
			'view_item'             => esc_html__( 'View Item', 'quanta' ),
			'search_items'          => esc_html__( 'Search Item', 'quanta' ),
			'not_found'             => esc_html__( 'Not found', 'quanta' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'quanta' ),
			'featured_image'        => esc_html__( 'Featured Image', 'quanta' ),
			'set_featured_image'    => esc_html__( 'Set featured image', 'quanta' ),
			'remove_featured_image' => esc_html__( 'Remove featured image', 'quanta' ),
			'use_featured_image'    => esc_html__( 'Use as featured image', 'quanta' ),
			'inserbt_into_item'     => esc_html__( 'Insert into item', 'quanta' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'quanta' ),
			'items_list'            => esc_html__( 'Items list', 'quanta' ),
			'items_list_navigation' => esc_html__( 'Items list navigation', 'quanta' ),
			'filter_items_list'     => esc_html__( 'Filter items list', 'quanta' ),
		);

		$args   = array(
			'label'                 => esc_html__( 'Service', 'quanta' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'   			=> 'dashicons-shield',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);

		register_post_type( 'services', $args );
	}
	
	public function create_cat() {
		$labels = array(
			'name'                       => esc_html_x( 'Service Categories', 'Taxonomy General Name', 'quanta' ),
			'singular_name'              => esc_html_x( 'Service Categories', 'Taxonomy Singular Name', 'quanta' ),
			'menu_name'                  => esc_html__( 'Service Categories', 'quanta' ),
			'all_items'                  => esc_html__( 'All Service Category', 'quanta' ),
			'parent_item'                => esc_html__( 'Parent Item', 'quanta' ),
			'parent_item_colon'          => esc_html__( 'Parent Item:', 'quanta' ),
			'new_item_name'              => esc_html__( 'New Service Category Name', 'quanta' ),
			'add_new_item'               => esc_html__( 'Add New Service Category', 'quanta' ),
			'edit_item'                  => esc_html__( 'Edit Service Category', 'quanta' ),
			'update_item'                => esc_html__( 'Update Service Category', 'quanta' ),
			'view_item'                  => esc_html__( 'View Service Category', 'quanta' ),
			'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'quanta' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove items', 'quanta' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'quanta' ),
			'popular_items'              => esc_html__( 'Popular Service Category', 'quanta' ),
			'search_items'               => esc_html__( 'Search Service Category', 'quanta' ),
			'not_found'                  => esc_html__( 'Not Found', 'quanta' ),
			'no_terms'                   => esc_html__( 'No Service Category', 'quanta' ),
			'items_list'                 => esc_html__( 'Service Category list', 'quanta' ),
			'items_list_navigation'      => esc_html__( 'Service Category list navigation', 'quanta' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);

		register_taxonomy('services-cat','services', $args );
	}

}

new TpServicesPost();