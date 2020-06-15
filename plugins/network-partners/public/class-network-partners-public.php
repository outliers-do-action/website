<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://outliers.org.za
 * @since      1.0.0
 *
 * @package    Network_Partners
 * @subpackage Network_Partners/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Network_Partners
 * @subpackage Network_Partners/public
 * @author     Do Action Outliers <laura@outliers.org.za>
 */
class Network_Partners_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/network-partners-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/network-partners-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'google-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyC0hcru137zwanoghuzO5F42AK29-_7-X0', null, null, true );

		wp_localize_script(
			$this->plugin_name,
			'networkPartnersVars',
			[
				'markerIcon' => plugin_dir_url( __FILE__ ) . 'images/outliers-marker.png',
			]
		);

	}

	/**
	 * Register Network Partners post type
	 *
	 * @return void
	 */
	public function network_partners_post_type() {
		$labels = array(
			'name'                  => _x( 'Network Partners', 'Post Type General Name', 'network-partners' ),
			'singular_name'         => _x( 'Network Partner', 'Post Type Singular Name', 'network-partners' ),
			'menu_name'             => __( 'Network Partners', 'network-partners' ),
			'name_admin_bar'        => __( 'Network Partner', 'network-partners' ),
			'archives'              => __( 'Network Partner Archives', 'network-partners' ),
			'attributes'            => __( 'Network Partner Attributes', 'network-partners' ),
			'parent_item_colon'     => __( 'Parent Item:', 'network-partners' ),
			'all_items'             => __( 'All Network Partners', 'network-partners' ),
			'add_new_item'          => __( 'Add New Network Partner', 'network-partners' ),
			'add_new'               => __( 'Add New', 'network-partners' ),
			'new_item'              => __( 'New Network Partner', 'network-partners' ),
			'edit_item'             => __( 'Edit Network Partner', 'network-partners' ),
			'update_item'           => __( 'Update Network Partner', 'network-partners' ),
			'view_item'             => __( 'View Network Partner', 'network-partners' ),
			'view_items'            => __( 'View Network Partners', 'network-partners' ),
			'search_items'          => __( 'Search Network Partner', 'network-partners' ),
			'not_found'             => __( 'Not found', 'network-partners' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'network-partners' ),
			'featured_image'        => __( 'Featured Image', 'network-partners' ),
			'set_featured_image'    => __( 'Set featured image', 'network-partners' ),
			'remove_featured_image' => __( 'Remove featured image', 'network-partners' ),
			'use_featured_image'    => __( 'Use as featured image', 'network-partners' ),
			'insert_into_item'      => __( 'Insert into network partner', 'network-partners' ),
			'uploaded_to_this_item' => __( 'Uploaded to this network partner', 'network-partners' ),
			'items_list'            => __( 'Network Partners list', 'network-partners' ),
			'items_list_navigation' => __( 'Network Partners list navigation', 'network-partners' ),
			'filter_items_list'     => __( 'Filter network partners list', 'network-partners' ),
		);
		$rewrite = array(
			'slug'                  => 'network-partner',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);
		$args = array(
			'label'                 => __( 'Network Partner', 'network-partners' ),
			'description'           => __( 'Network partners', 'network-partners' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-groups',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
		);
		register_post_type( 'network_partners', $args );
	}

	/**
	 * Setup an API key for ACF google maps.
	 *
	 * @param array $api
	 * @return void
	 */
	public function acf_google_maps_key( $api ) {
		$api['key'] = 'AIzaSyC0hcru137zwanoghuzO5F42AK29-_7-X0';
		return $api;
	}

	/**
	 * Change the link of network partners to external one if available.
	 *
	 * @param sting $link
	 * @param WP_Post $post
	 * @param bool $leavename
	 * @return void
	 */
	public function link_to_external( $link, $post, $leavename ) {
		
		// Make sure we are on the right custom post type.
		if ( 'network_partners' !== get_post_type( $post ) || is_admin() ) {
			return $link;
		}

		if ( ! function_exists( 'get_field' ) ) {
			return $link;
		}

		if ( ! empty( get_field( 'url', $post->ID ) ) ) {
			return get_field( 'url', $post->ID );
		}
		// Don't link anywhere if no value is assigned.
		return '#';
	}

	/**
	 * Shortcode to display a map with all network partners.
	 *
	 * @param array $atts
	 * @return string
	 */
	public function google_maps_shortcode( $atts = [] ) {
		ob_start();
		// Setup args for retrieving all network partners.
		$args = array(
			'post_type'      => 'network_partners',
			'posts_per_page' => -1,
		);
		$the_query = new WP_Query( $args );

		echo '<div class=\'acf-map\'>';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			
			// Get all the fields ready to build the placemarker.
			$location = get_field( 'location' );
			$description = get_field( 'short_description' );
			$url = get_field( 'url' );

			if ( ! empty( $location ) ) {
			?>
				<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
					<div class="marker-container">
						<?php
						if ( ! empty( $url ) ) {
						?>
							<div class="marker-img-container"><a href="<?php echo esc_url_raw( $url ); ?>" rel="bookmark" target="_blank"><?php the_post_thumbnail( 'thumbnail', [ 'class' => 'skip-lazy' ] ); ?></a></div>
							<div class="marker-content-container">
								<a href="<?php echo esc_url_raw( $url ); ?>" rel="bookmark" target="_blank"><h4><?php the_title(); ?></h4></a>
						<?php
						} else {
						?>
							<div class="marker-img-container"><?php the_post_thumbnail( 'thumbnail', [ 'class' => 'skip-lazy' ] ); ?></div>
							<div class="marker-content-container">
								<h4><?php the_title(); ?></h4>
						<?php
						}
						?>
							<p class="address"><?php esc_html_e( $location['address'] ); ?></p>
							<p class="description"><?php echo $description; ?></p>
						</div>
					</div>
				</div>
			<?php
			}
		}
		echo '</div>';
		return ob_get_clean();
	}

}
