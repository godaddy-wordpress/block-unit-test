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

			<!-- wp:spacer {"height":50} -->
			<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Accordions', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:coblocks/accordion {"title":"Accordion Title"} -->
			<div class="wp-block-coblocks-accordion"><details><summary class="wp-block-coblocks-accordion__title"><p>Accordion Title</p></summary><div class="wp-block-coblocks-accordion__content"><p class="wp-block-coblocks-accordion__text">Etiam porta sem malesuada magna mollis euismod. Nullam quis risus eget urna mollis ornare vel eu leo. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p></div></details></div>
			<!-- /wp:coblocks/accordion -->

			<!-- wp:coblocks/accordion {"title":"Accordion Title"} -->
			<div class="wp-block-coblocks-accordion"><details><summary class="wp-block-coblocks-accordion__title"><p>Accordion Title</p></summary><div class="wp-block-coblocks-accordion__content"><p class="wp-block-coblocks-accordion__text">Etiam porta sem malesuada magna mollis euismod. Nullam quis risus eget urna mollis ornare vel eu leo. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p></div></details></div>
			<!-- /wp:coblocks/accordion -->

			<!-- wp:spacer {"height":50} -->
			<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Alerts', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:coblocks/alert {"title":["Default Alert"],"value":["Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo."],"customTextColor":"#383d41","customTitleColor":"#383d41","customBackgroundColor":"#e2e3e5","customBorderColor":"#d6d8db"} -->
			<div class="wp-block-coblocks-alert is-default-alert alignundefined has-background" style="background-color:#e2e3e5;border-color:#d6d8db"><p class="wp-block-coblocks-alert__title has-text-color" style="color:#383d41">Default Alert</p><p class="wp-block-coblocks-alert__text has-text-color" style="color:#383d41">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo.</p></div>
			<!-- /wp:coblocks/alert -->

			<!-- wp:coblocks/alert {"title":["Info Alert"],"value":["Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo."],"customTextColor":"#004085","customTitleColor":"#004085","customBackgroundColor":"#cce5ff","customBorderColor":"#b8daff","type":"info"} -->
			<div class="wp-block-coblocks-alert is-info-alert alignundefined has-background" style="background-color:#cce5ff;border-color:#b8daff"><p class="wp-block-coblocks-alert__title has-text-color" style="color:#004085">Info Alert</p><p class="wp-block-coblocks-alert__text has-text-color" style="color:#004085">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo.</p></div>
			<!-- /wp:coblocks/alert -->

			<!-- wp:coblocks/alert {"title":["Success Alert"],"value":["Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo."],"customTextColor":"#155724","customTitleColor":"#155724","customBackgroundColor":"#d4edda","customBorderColor":"#c3e6cb","type":"success"} -->
			<div class="wp-block-coblocks-alert is-success-alert alignundefined has-background" style="background-color:#d4edda;border-color:#c3e6cb"><p class="wp-block-coblocks-alert__title has-text-color" style="color:#155724">Success Alert</p><p class="wp-block-coblocks-alert__text has-text-color" style="color:#155724">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo.</p></div>
			<!-- /wp:coblocks/alert -->

			<!-- wp:coblocks/alert {"title":["Warning Alert"],"value":["Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo."],"customTextColor":"#856404","customTitleColor":"#856404","customBackgroundColor":"#fff3cd","customBorderColor":"#ffeeba","type":"warning"} -->
			<div class="wp-block-coblocks-alert is-warning-alert alignundefined has-background" style="background-color:#fff3cd;border-color:#ffeeba"><p class="wp-block-coblocks-alert__title has-text-color" style="color:#856404">Warning Alert</p><p class="wp-block-coblocks-alert__text has-text-color" style="color:#856404">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo.</p></div>
			<!-- /wp:coblocks/alert -->

			<!-- wp:coblocks/alert {"title":["Error Alert"],"value":["Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo."],"customTextColor":"#721c24","customTitleColor":"#721c24","customBackgroundColor":"#f8d7da","customBorderColor":"#f5c6cb","type":"error"} -->
			<div class="wp-block-coblocks-alert is-error-alert alignundefined has-background" style="background-color:#f8d7da;border-color:#f5c6cb"><p class="wp-block-coblocks-alert__title has-text-color" style="color:#721c24">Error Alert</p><p class="wp-block-coblocks-alert__text has-text-color" style="color:#721c24">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo.</p></div>
			<!-- /wp:coblocks/alert -->

			<!-- wp:spacer {"height":50} -->
			<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Highlighted Text', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:coblocks/highlight -->
			<p class="wp-block-coblocks-highlight"><mark class="wp-block-coblocks-highlight__content">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Curabitur blandit tempus porttitor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. </mark></p>
			<!-- /wp:coblocks/highlight -->

			<!-- wp:spacer {"height":50} -->
			<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Social Sharing', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:coblocks/social {"space":6} /-->

			<!-- wp:spacer {"height":50} -->
			<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Click to Tweet', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:coblocks/click-to-tweet {"url":"http://block-unit-test.dev/410-2/","via":"richard_tabor"} -->
			<blockquote class="wp-block-coblocks-click-to-tweet"><p class="wp-block-coblocks-click-to-tweet__text">Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec id elit non mi porta gravida at eget metus.</p><a class="wp-block-coblocks-click-to-tweet__twitter-btn" href="http://twitter.com/share?&amp;text=Integer%20posuere%20erat%20a%20ante%20venenatis%20dapibus%20posuere%20velit%20aliquet.%20Donec%20id%20elit%20non%20mi%20porta%20gravida%20at%20eget%20metus.&amp;url=http://block-unit-test.dev/410-2/&amp;via=richard_tabor" target="_blank">Click to Tweet</a></blockquote>
			<!-- /wp:coblocks/click-to-tweet -->

			<!-- wp:spacer {"height":50} -->
			<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Author Profile', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:coblocks/author {"buttonUrl":"https://richtabor.com","imgId":415,"name":["Rich Tabor"]} -->
			<div class="wp-block-coblocks-author"><div class="wp-block-coblocks-author__avatar"><img class="wp-block-coblocks-author__avatar-img" src="' . esc_url( $url . '/avatar.jpg' ) . '" alt="avatar"/></div><div class="wp-block-coblocks-author__content"><div class="wp-block-coblocks-author__content-name"><h3>Rich Tabor</h3></div><div class="wp-block-coblocks-author__content-biography"><p>Founder at <a href="https://themebeans.com">ThemeBeans</a> + Avid Marketing Fanatic and Writing Enthusiast.</p></div><a class="wp-block-coblocks-author__content-button" href="https://richtabor.com">Follow</a></div></div>
			<!-- /wp:coblocks/author -->
			';
		return apply_filters( 'block_unit_test_coblocks_content', $content );
	}
}
Block_Unit_Test_CoBlocks::register();
