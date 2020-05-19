<?php
/**
 * Suggest CoBlocks for unit testing.
 *
 * @package   @@pkg.title
 * @author    @@pkg.author
 * @license   @@pkg.license
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Notice Class
 *
 * @since 1.0.3
 */
class Block_Unit_Test_Suggest_CoBlocks {

	/**
	 * Plugin Path.
	 *
	 * @var string $plugin_path
	 */
	public $plugin_path;

	/**
	 * CoBlocks check.
	 *
	 * @var string $has_coblocks
	 */
	public $has_coblocks;

	/**
	 * CoBlocks base.
	 *
	 * @var string $coblocks_base
	 */
	public $coblocks_base;

	/**
	 * Setup the activation class.
	 *
	 * @param string|string $plugin_path Path relative to the plugin.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function __construct( $plugin_path ) {

		// We need plugin.php.
		require_once ABSPATH . 'wp-admin/includes/plugin.php';

		$plugins = get_plugins();

		// Set the plugin directory.
		$plugin_path       = array_filter( explode( '/', $plugin_path ) );
		$this->plugin_path = end( $plugin_path );

		// Check if Login Designer is installed.
		foreach ( $plugins as $plugin_path => $plugin ) {
			if ( 'CoBlocks' === $plugin['Name'] ) {
				$this->has_coblocks  = true;
				$this->coblocks_base = $plugin_path;
				break;
			}
		}
	}

	/**
	 * Process the notice.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function run() {
		add_action( 'admin_init', array( 'PAnD', 'init' ) );
		add_action( 'admin_notices', array( $this, 'notice' ) );
	}

	/**
	 * Display notice if Login Designer is not installed or activated.
	 *
	 * @access public
	 */
	public function notice() {

		if ( ! PAnD::is_admin_notice_active( 'dismiss-coblocks-21' ) ) {
			return;
		}

		// Array of allowed HTML.
		$allowed_html_array = array(
			'a' => array(
				'href'   => array(),
				'target' => array(),
			),
		);

		if ( $this->has_coblocks ) {
			$url  = esc_url( wp_nonce_url( admin_url( 'plugins.php?action=activate&plugin=' . $this->coblocks_base ), 'activate-plugin_' . $this->coblocks_base ) );
			$link = '<a href="' . $url . '">' . esc_html__( 'activate CoBlocks &rarr;', '@@textdomain' ) . '</a>';
		} else {
			$url  = esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=coblocks' ), 'install-plugin_coblocks' ) );
			$link = '<a href="' . $url . '">' . esc_html__( 'install CoBlocks &rarr;', '@@textdomain' ) . '</a>';
		}

		$coblocks = '<a href="https://coblocks.com" target="_blank">CoBlocks</a>';

		// translators: %1$s is a placeholder for a link to the CoBlocks website. %2$s is a placeholder for the activate or install CoBlocks link.
		echo '<div data-dismissible="dismiss-coblocks-21" class="notice notice-info is-dismissible"><p>Block Unit Test' . wp_kses( sprintf( __( ' suggests performing a unit test for %1$s. To run the additional unit test, %2$s', '@@textdomain' ), $coblocks, $link ), $allowed_html_array ) . '</p></div>';
	}
}
