<?php
/*
 * Plugin Name: Post Type Inspector
 * Plugin URI: https://github.com/hereswhatidid/post-type-inspector
 * Description: Inspect and modify existing post types and taxonomies via the WordPress backend.
 * Author: Gabe Shackle
 * Version: 1.0.0
 * Author URI: http://hereswhatidid.com/
 * License: GPL2+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Post_Type_Inspector {

	protected $version = '1.0.0';

	protected $slug = 'pti';

	protected $script_mode = 'min';

	protected $post_types = [];

	protected $taxonomies = [];

	protected $plugins_base = '';

	public function __construct() {
//		Check if in SCRIPT_DEBUG mode and display appropriate version
		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			$this->script_mode = 'dev';
		}

		$this->plugins_base = dirname( plugin_dir_path( __FILE__ ) );

		add_action( 'admin_menu', array( $this, 'add_menu_pages' ) );

		add_action( 'admin_init', array( $this, 'get_plugin_details' ) );

		add_action( 'registered_post_type', array( $this, 'get_registered_post_type' ), 10, 2 );
	}

	public function get_plugin_details() {
		$plugin_details = false;

		foreach( $this->post_types as $index => $post_type ) {
			if ( $post_type['source']['type'] === 'plugin' ) {
				$plugin_details = get_plugin_data( $post_type['source']['sourceUrl'] );
				$this->post_types[$index]['source']['pluginTitle'] = $plugin_details['Name'];
				$this->post_types[$index]['source']['pluginUrl'] = $plugin_details['PluginURI'];
				$this->post_types[$index]['source']['pluginVersion'] = $plugin_details['Version'];

			}
		}

		return $plugin_details;
	}

	public function get_post_type_source( $source ) {
		global $wp_version;
		if ( strpos( $source, $this->plugins_base ) !== false ) {
//			$plugin_data = get_plugin_data( $source );
			return array(
				'pluginTitle' => '',
				'pluginUrl' => '',
				'pluginVersion' => '',
				'sourceUrl' => $source,
				'type' => 'plugin'
			);
		} else {
			return array(
				'pluginTitle' => __( 'WordPress Core', $this->slug ),
				'pluginUrl' => 'http://wordpress.org/',
				'pluginVersion' => $wp_version,
				'sourceUrl' => $source,
				'type' => 'core'
			);
		}
	}

	public function get_registered_post_type( $post_type, $args ) {
		$callSource = debug_backtrace();

		$this->post_types[] = array(
			'label' => $args->label,
			'post_type' => $post_type,
			'options' => $args,
			'source' => $this->get_post_type_source( $callSource[3]['file'] )
		);
	}

	public function add_menu_pages() {
		$page = add_menu_page(
				__( 'Post Type Inspector', $this->slug ),
				__( 'Post Type Inspector', $this->slug ),
				'manage_options',
				$this->slug . '-options',
				array( $this, 'view_options_page' )
			);

		add_action( 'admin_print_scripts-' . $page, array( $this, 'enqueue_media' ) );
	}

	public function enqueue_media( $hook ) {

		wp_enqueue_style( $this->slug . '-styles', plugins_url( 'css/styles.' . $this->script_mode . '.css', __FILE__ ), array( ), $this->version );
		wp_enqueue_script( $this->slug . '-bootstrap', plugins_url( 'js/vendor/bootstrap.js', __FILE__ ), array( 'jquery' ), $this->version );
		wp_enqueue_script( $this->slug . '-angular', plugins_url( 'js/vendor/angular.js', __FILE__ ), array( 'jquery' ), $this->version );
		wp_enqueue_script( $this->slug . '-scripts', plugins_url( 'js/scripts.' . $this->script_mode . '.js', __FILE__ ), array( 'jquery', $this->slug . '-bootstrap', $this->slug . '-angular' ), $this->version );
		wp_localize_script( $this->slug . '-scripts', 'PTIBootstrapData', $this->post_types );
	}

	public function view_options_page() {
		require_once( 'views/post_types.php' );
	}
}

$PTI_Plugin = new Post_Type_Inspector();