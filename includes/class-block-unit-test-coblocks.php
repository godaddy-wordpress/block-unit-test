<?php
/**
 * Unit testing for CoBlocks, if the plugin is activated.
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
 * Main Block_Unit_Test_CoBlocks Class
 *
 * @since 1.0.3
 */
class Block_Unit_Test_CoBlocks {

	/**
	 * The class instance.
	 *
	 * @var Block_Unit_Test_CoBlocks
	 */
	private static $instance;

	/**
	 * Registers the class.
	 */
	public static function register() {
		if ( null === self::$instance ) {
			self::$instance = new Block_Unit_Test_CoBlocks();
		}
	}

	/**
	 * The Constructor.
	 */
	private function __construct() {
		add_action( 'admin_init', array( $this, 'create_coblocks_unit_test_page' ) );
		add_action( 'admin_init', array( $this, 'update_coblocks_unit_test_page' ) );
	}

	/**
	 * Creates a page for the CoBlocks to be rendered on.
	 */
	public function create_coblocks_unit_test_page() {

		$title = apply_filters( 'block_unit_test_coblocks_title', 'CoBlocks Unit Test ' );

		// Do not create the post if it's already present.
		if ( post_exists( $title ) ) {
			return;
		}

		// Create the Block Unit Test page.
		wp_insert_post(
			array(
				'post_title'     => $title,
				'post_content'   => $this->coblocks_content(),
				'post_status'    => 'draft',
				'post_author'    => 1,
				'post_type'      => 'page',
				'comment_status' => 'closed',
			)
		);
	}

	/**
	 * Updates the CoBlocks page upon plugin updates.
	 */
	public function update_coblocks_unit_test_page() {

		$title = apply_filters( 'block_unit_test_coblocks_title', 'CoBlocks Unit Test ' );
		$post  = get_page_by_title( $title, OBJECT, 'page' );

		// Return if the page does not exist.
		if ( ! post_exists( $title ) ) {
			return;
		}

		// Return if the update transient does not exist.
		if ( ! get_transient( 'block_unit_test_updated' ) ) {
			return;
		}

		// Update the post with the latest content update.
		wp_update_post(
			array(
				'ID'           => $post->ID,
				'post_content' => $this->coblocks_content(),
			)
		);

		// Delete the transient.
		delete_transient( 'block_unit_test_updated' );
	}

	/**
	 * Content for the test page.
	 */
	public function coblocks_content() {

		// Retrieve the asset URLs.
		$url = untrailingslashit( plugins_url( '/assets/images', dirname( __FILE__ ) ) );

		$content = '';

		$content .= '
			<!-- wp:paragraph -->
			<p><a href="https://coblocks.com/?utm_medium=wp.org&amp;utm_source=wordpressorg&amp;utm_campaign=readme&amp;utm_content=coblocks">CoBlocks</a> is a collection of page builder Gutenberg blocks for content marketers, built by <a href="https://richtabor.com">Rich Tabor</a> from <a href="https://themebeans.com/?utm_medium=wp.org&amp;utm_source=wordpressorg&amp;utm_campaign=readme&amp;utm_content=coblocks">ThemeBeans</a>. If you are a fan, consider <a href="https://wordpress.org/plugins/coblocks/#reviews">leaving a review</a> on WordPress.org. 🙏</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Accordions', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Donec id elit non mi porta gravida at eget metus. Donec ullamcorper nulla non metus auctor fringilla. Donec ullamcorper nulla non metus auctor fringilla.<br></p>
			<!-- /wp:paragraph -->

			<!-- wp:coblocks/accordion -->
			<div class="wp-block-coblocks-accordion"><!-- wp:coblocks/accordion-item {"title":"This is an example of the CoBlocks accordion","open":true} -->
			<div class="wp-block-coblocks-accordion-item wp-block-coblocks-accordion-item--open"><details open><summary class="wp-block-coblocks-accordion-item__title">This is an example of the CoBlocks accordion</summary><div class="wp-block-coblocks-accordion-item__content"><p class="wp-block-coblocks-accordion-item__text">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam id dolor id nibh ultricies vehicula ut id elit.</p></div></details></div>
			<!-- /wp:coblocks/accordion-item -->

			<!-- wp:coblocks/accordion-item {"title":"This is a second example of the CoBlocks accordion"} -->
			<div class="wp-block-coblocks-accordion-item"><details><summary class="wp-block-coblocks-accordion-item__title">This is a second example of the CoBlocks accordion</summary><div class="wp-block-coblocks-accordion-item__content"><p class="wp-block-coblocks-accordion-item__text">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. </p></div></details></div>
			<!-- /wp:coblocks/accordion-item --></div>
			<!-- /wp:coblocks/accordion -->

			<!-- wp:paragraph -->
			<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum.</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Alerts', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.</p>
			<!-- /wp:paragraph -->

			<!-- wp:coblocks/alert {"title":"Alert title","backgroundColor":"","borderColor":"","textColor":"","customTextColor":"#383d41","customTitleColor":"#383d41","customBackgroundColor":"#e2e3e5","customBorderColor":"#d6d8db","titleColor":""} -->
			<div class="wp-block-coblocks-alert is-default-alert alignundefined has-background" style="background-color:#e2e3e5;border-color:#d6d8db;text-align:left"><p class="wp-block-coblocks-alert__title has-text-color" style="color:#383d41">Alert title</p><p class="wp-block-coblocks-alert__text has-text-color" style="color:#383d41">This is a CoBlocks alert right here. Donec ullamcorper nulla non metus auctor fringilla. Aenean lacinia bibendum nulla sed consectetur.</p></div>
			<!-- /wp:coblocks/alert -->

			<!-- wp:paragraph -->
			<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean lacinia bibendum.<br></p>
			<!-- /wp:paragraph -->

			<!-- wp:coblocks/highlight -->
			<p class="wp-block-coblocks-highlight"><mark class="wp-block-coblocks-highlight__content">This is a highlighted text block. Dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Curabitur blandit tempus porttitor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</mark></p>
			<!-- /wp:coblocks/highlight -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Click to Tweet', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.</p>
			<!-- /wp:paragraph -->

			<!-- wp:coblocks/click-to-tweet {"url":"http://block-unit-test.dev/coblocks-unit-test/","via":"richard_tabor"} -->
			<blockquote class="wp-block-coblocks-click-to-tweet"><p class="wp-block-coblocks-click-to-tweet__text">Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec id elit non mi porta gravida at eget metus.</p><a class="wp-block-coblocks-click-to-tweet__twitter-btn" href="http://twitter.com/share?&amp;text=Integer%20posuere%20erat%20a%20ante%20venenatis%20dapibus%20posuere%20velit%20aliquet.%20Donec%20id%20elit%20non%20mi%20porta%20gravida%20at%20eget%20metus.&amp;url=http://block-unit-test.dev/coblocks-unit-test/&amp;via=richard_tabor" target="_blank">Click to Tweet</a></blockquote>
			<!-- /wp:coblocks/click-to-tweet -->

			<!-- wp:paragraph -->
			<p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Author Profile', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:coblocks/author {"name":"Rich Tabor","imgId":9} -->
			<div class="wp-block-coblocks-author"><div class="wp-block-coblocks-author__avatar"><img class="wp-block-coblocks-author__avatar-img" src="' . esc_url( $url . '/avatar.jpg' ) . '" alt="avatar"/></div><div class="wp-block-coblocks-author__content"><p class="wp-block-coblocks-author__heading">Written by...</p><h3 class="wp-block-coblocks-author__name">Rich Tabor</h3><p class="wp-block-coblocks-author__biography">I’m Rich Tabor, and I’ve always had a knack for creating stuff:  has websites, themes, psd freebies, and the like.</p><!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link" href="https://richtabor.com">Follow</a></div>
			<!-- /wp:button --></div></div>
			<!-- /wp:coblocks/author -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Social Sharing', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Donec id elit non mi porta gravida at eget metus. Donec ullamcorper nulla non metus auctor fringilla. Donec ullamcorper nulla non metus auctor fringilla.</p>
			<!-- /wp:paragraph -->

			<!-- wp:coblocks/social {"space":6} /-->
			';
		return apply_filters( 'block_unit_test_coblocks_content', $content );
	}
}
Block_Unit_Test_CoBlocks::register();
