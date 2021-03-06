<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://outliers.org.za
 * @since      1.0.0
 *
 * @package    Network_Partners
 * @subpackage Network_Partners/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Network_Partners
 * @subpackage Network_Partners/admin
 * @author     Do Action Outliers <laura@outliers.org.za>
 */
class Network_Partners_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Network_Partners_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Network_Partners_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/network-partners-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Network_Partners_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Network_Partners_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/network-partners-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Alter the default write your story placeholder text for network partners post type.
	 *
	 * @param string $text
	 * @param WP_Post $post
	 * @return string
	 */
	public function write_your_story_placeholder( $text, $post ) {
		if ( 'network_partners' !== get_post_type( $post ) ) {
			return $text;
		}

		return __( 'Detailed network partner description here, use the fields below for entering details about the network partner.', 'network-partners' );
	}

	/**
	 * Alter the default placeholder text for the network partners title field.
	 *
	 * @param string $text
	 * @param WP_Post $post
	 * @return string
	 */
	public function enter_title_here_placeholder( $text, $post ) {
		if ( 'network_partners' !== get_post_type( $post ) ) {
			return $text;
		}

		return __( 'Network partner name', 'network-partners' );
	}

}
