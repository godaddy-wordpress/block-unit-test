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

			<!-- wp:spacer {"height":20} -->
			<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Accordions', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Donec id elit non mi porta gravida at eget metus. Donec ullamcorper nulla non metus auctor fringilla. Donec ullamcorper nulla non metus auctor fringilla.<br></p>
			<!-- /wp:paragraph -->

			<!-- wp:coblocks/accordion -->
			<div class="wp-block-coblocks-accordion"><!-- wp:coblocks/accordion-item {"title":"This is a demo accordion"} -->
			<div class="wp-block-coblocks-accordion-item"><details><summary class="wp-block-coblocks-accordion-item__title">This is a demo accordion</summary><div class="wp-block-coblocks-accordion-item__content"><!-- wp:paragraph {"placeholder":"Add content..."} -->
			<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Curabitur blandit tempus porttitor. Donec id elit non mi porta gravida at eget metus.</p>
			<!-- /wp:paragraph --></div></details></div>
			<!-- /wp:coblocks/accordion-item -->

			<!-- wp:coblocks/accordion-item {"title":"This is a demo accordion"} -->
			<div class="wp-block-coblocks-accordion-item"><details><summary class="wp-block-coblocks-accordion-item__title">This is a demo accordion</summary><div class="wp-block-coblocks-accordion-item__content"><!-- wp:paragraph {"placeholder":"Add content..."} -->
			<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Curabitur blandit tempus porttitor. Donec id elit non mi porta gravida at eget metus.</p>
			<!-- /wp:paragraph --></div></details></div>
			<!-- /wp:coblocks/accordion-item --></div>
			<!-- /wp:coblocks/accordion -->

			<!-- wp:paragraph -->
			<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum.</p>
			<!-- /wp:paragraph -->

			<!-- wp:spacer {"height":20} -->
			<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Media Card', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:coblocks/media-card {"coblocks":{"id":"11594821909"}} -->
			<div class="wp-block-coblocks-media-card alignwide coblocks-media-card-11594821909 is-style-left has-no-media is-stacked-on-mobile"><div class="wp-block-coblocks-media-card__inner has-no-padding"><div class="wp-block-coblocks-media-card__wrapper"><figure class="wp-block-coblocks-media-card__media"></figure><div class="wp-block-coblocks-media-card__content"><!-- wp:coblocks/row {"columns":1,"layout":"100","paddingSize":"huge","hasMarginControl":false,"hasAlignmentControls":false,"hasStackedControl":false,"customBackgroundColor":"#FFFFFF","coblocks":{"id":"11594821992"}} -->
			<div class="wp-block-coblocks-row coblocks-row-11594821992" data-columns="1" data-layout="100" style="background-color:#FFFFFF"><div class="wp-block-coblocks-row__inner has-background has-medium-gutter has-padding has-huge-padding has-no-margin is-stacked-on-mobile" style="background-color:#FFFFFF"><!-- wp:coblocks/column {"width":"100","coblocks":{"id":"1159482215"}} -->
			<div class="wp-block-coblocks-column coblocks-column-1159482215" style="width:100%"><div class="wp-block-coblocks-column__inner has-no-padding has-no-margin"><!-- wp:heading {"level":3,"placeholder":"Add heading..."} -->
			<h3>Media Card</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"placeholder":"Add content..."} -->
			<p>Replace this text with descriptive copy to go along with the card image. Then add more blocks to this card, such as buttons, lists or images.</p>
			<!-- /wp:paragraph --></div></div>
			<!-- /wp:coblocks/column --></div></div>
			<!-- /wp:coblocks/row --></div></div></div></div>
			<!-- /wp:coblocks/media-card -->

			<!-- wp:spacer {"height":20} -->
			<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Alerts', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.</p>
			<!-- /wp:paragraph -->

			<!-- wp:coblocks/alert {"title":"This is an alert","backgroundColor":"","textColor":"","customTextColor":"#154a28","customBackgroundColor":"#D0EAC4","type":"success"} -->
			<div class="wp-block-coblocks-alert is-success-alert has-text-color has-background" style="background-color:#D0EAC4;color:#154a28"><p class="wp-block-coblocks-alert__title">This is an alert</p><p class="wp-block-coblocks-alert__text">Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Curabitur blandit tempus porttitor. Donec id elit non mi porta gravida at eget metus.</p></div>
			<!-- /wp:coblocks/alert -->

			<!-- wp:paragraph -->
			<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean lacinia bibendum.<br></p>
			<!-- /wp:paragraph -->

			<!-- wp:coblocks/highlight -->
			<p class="wp-block-coblocks-highlight"><mark class="wp-block-coblocks-highlight__content">This is an example of a highlight block.</mark></p>
			<!-- /wp:coblocks/highlight -->

			<!-- wp:spacer {"height":20} -->
			<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Pricing Tables', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:coblocks/pricing-table -->
			<div class="wp-block-coblocks-pricing-table has-2-columns has-center-content" style="text-align:center"><div class="wp-block-coblocks-pricing-table__inner"><!-- wp:coblocks/pricing-table-item -->
			<div class="wp-block-coblocks-pricing-table-item"><span class="wp-block-coblocks-pricing-table-item__title">Lite</span><div class="wp-block-coblocks-pricing-table-item__price-wrapper"><span class="wp-block-coblocks-pricing-table-item__currency">$</span><span class="wp-block-coblocks-pricing-table-item__amount">19</span></div><ul class="wp-block-coblocks-pricing-table-item__features"><li>Feature one</li><li>Feature two</li><li>Feature three</li><li>Feature four</li></ul><!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link">Buy Now</a></div>
			<!-- /wp:button --></div>
			<!-- /wp:coblocks/pricing-table-item -->

			<!-- wp:coblocks/pricing-table-item {"backgroundColor":"secondary","textColor":"white"} -->
			<div class="wp-block-coblocks-pricing-table-item has-background has-secondary-background-color has-text-color has-white-color"><span class="wp-block-coblocks-pricing-table-item__title">Pro</span><div class="wp-block-coblocks-pricing-table-item__price-wrapper"><span class="wp-block-coblocks-pricing-table-item__currency">$</span><span class="wp-block-coblocks-pricing-table-item__amount">99</span></div><ul class="wp-block-coblocks-pricing-table-item__features"><li>Feature one<br/>Feature two<br/>Feature three<br/>Feature four</li></ul><!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link">Buy Now</a></div>
			<!-- /wp:button --></div>
			<!-- /wp:coblocks/pricing-table-item --></div></div>
			<!-- /wp:coblocks/pricing-table -->

			<!-- wp:spacer {"height":41} -->
			<div style="height:41px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Click to Tweet', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.</p>
			<!-- /wp:paragraph -->

			<!-- wp:coblocks/click-to-tweet {"url":"http://block-unit-test.dev/coblocks-unit-test/"} -->
			<blockquote class="wp-block-coblocks-click-to-tweet"><p class="wp-block-coblocks-click-to-tweet__text">Here is the CoBlocks Click to Tweet block. </p><a class="wp-block-coblocks-click-to-tweet__twitter-btn" href="http://twitter.com/share?&amp;text=Here%20is%20the%20CoBlocks%20Click%20to%20Tweet%20block.%20&amp;url=http://block-unit-test.dev/coblocks-unit-test/" target="_blank" rel="noopener noreferrer">Tweet</a></blockquote>
			<!-- /wp:coblocks/click-to-tweet -->

			<!-- wp:paragraph -->
			<p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
			<!-- /wp:paragraph -->

			<!-- wp:spacer {"height":20} -->
			<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Author Profile', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:coblocks/author {"name":"Rich Tabor"} -->
			<div class="wp-block-coblocks-author"><div class="wp-block-coblocks-author__avatar"><img class="wp-block-coblocks-author__avatar-img" src="' . esc_url( $url . '/avatar.jpg' ) . '" alt="avatar"/></div><div class="wp-block-coblocks-author__content"><p class="wp-block-coblocks-author__heading">Written by...</p><span class="wp-block-coblocks-author__name">Rich Tabor</span><p class="wp-block-coblocks-author__biography"><a href="https://richtabor.com/">Rich Tabor</a> is recognized as one of the top leaders in this post-Gutenberg era of WordPress. His design chops have topped the 2018 Automattic Design Awards and led him to co-found <a href="https://coblocks.com/">CoBlocks</a>, a top-notch set of page builder blocks and tools for Gutenberg.</p><!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link">Follow</a></div>
			<!-- /wp:button --></div></div>
			<!-- /wp:coblocks/author -->

			<!-- wp:spacer {"height":20} -->
			<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Social Sharing', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Donec id elit non mi porta gravida at eget metus. Donec ullamcorper nulla non metus auctor fringilla. Donec ullamcorper nulla non metus auctor fringilla.</p>
			<!-- /wp:paragraph -->

			<!-- wp:coblocks/social {"space":6} /-->

			<!-- wp:spacer {"height":20} -->
			<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Shape Divider', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:coblocks/shape-divider {"justAdded":false,"coblocks":{"id":"11595047829"}} -->
			<div class="wp-block-coblocks-shape-divider alignfull coblocks-shape-divider-11595047829 mb-0 mt-0" style="color:#111" aria-hidden="true"><div class="wp-block-coblocks-shape-divider__svg-wrapper" style="height:100px"><svg class="divider--wavy" height="100%" viewbox="0 0 100 10" width="100%" xmlns="http://www.w3.org/2000/svg" preserveaspectratio="none"><path d="m42.19.65c2.26-.25 5.15.04 7.55.53 2.36.49 7.09 2.35 10.05 3.57 7.58 3.22 13.37 4.45 19.26 4.97 2.36.21 4.87.35 10.34-.25s10.62-2.56 10.62-2.56v-6.91h-100.01v3.03s7.2 3.26 15.84 3.05c3.92-.07 9.28-.67 13.4-2.24 2.12-.81 5.22-1.82 7.97-2.42 2.72-.63 3.95-.67 4.98-.77z" fill-rule="evenodd" transform="matrix(1 0 0 -1 0 10)"></path></svg></div><div class="wp-block-coblocks-shape-divider__alt-wrapper" style="height:50px"></div></div>
			<!-- /wp:coblocks/shape-divider -->

			<!-- wp:coblocks/shape-divider {"verticalFlip":true,"justAdded":false,"coblocks":{"id":"11595047829"}} -->
			<div class="wp-block-coblocks-shape-divider alignfull coblocks-shape-divider-11595047829 is-vertically-flipped mb-0 mt-0" style="color:#111" aria-hidden="true"><div class="wp-block-coblocks-shape-divider__svg-wrapper" style="height:100px"><svg class="divider--wavy" height="100%" viewbox="0 0 100 10" width="100%" xmlns="http://www.w3.org/2000/svg" preserveaspectratio="none"><path d="m42.19.65c2.26-.25 5.15.04 7.55.53 2.36.49 7.09 2.35 10.05 3.57 7.58 3.22 13.37 4.45 19.26 4.97 2.36.21 4.87.35 10.34-.25s10.62-2.56 10.62-2.56v-6.91h-100.01v3.03s7.2 3.26 15.84 3.05c3.92-.07 9.28-.67 13.4-2.24 2.12-.81 5.22-1.82 7.97-2.42 2.72-.63 3.95-.67 4.98-.77z" fill-rule="evenodd" transform="matrix(1 0 0 -1 0 10)"></path></svg></div><div class="wp-block-coblocks-shape-divider__alt-wrapper" style="height:50px"></div></div>
			<!-- /wp:coblocks/shape-divider -->

			<!-- wp:spacer {"height":20} -->
			<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading -->
			<h2>' . esc_html__( 'Features', '@@textdomain' ) . '</h2>
			<!-- /wp:heading -->

			<!-- wp:coblocks/features {"coblocks":{"id":"11595152647"}} -->
			<div class="wp-block-coblocks-features coblocks-features-11595152647" data-columns="2"><div class="wp-block-coblocks-features__inner has-no-padding has-no-margin has-large-gutter has-center-content"><!-- wp:coblocks/feature {"coblocks":{"id":"11595152702"}} -->
			<div class="wp-block-coblocks-feature coblocks-feature-11595152702"><div class="wp-block-coblocks-feature__inner has-no-padding"><!-- wp:coblocks/icon {"icon":"device_hub","iconRand":false,"hasContentAlign":false} -->
			<div class="wp-block-coblocks-icon"><div class="wp-block-coblocks-icon__inner" style="height:60px;width:60px"><svg height="20" viewbox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path d="m15.5555556 14.4444444-4.4444445-4.4444444v-3.53333333c1.2888889-.46666667 2.2222222-1.68888889 2.2222222-3.13333334 0-1.84444444-1.4888889-3.33333333-3.3333333-3.33333333-1.84444444 0-3.33333333 1.48888889-3.33333333 3.33333333 0 1.44444445.93333333 2.66666667 2.22222222 3.13333334v3.53333333l-4.44444445 4.4444444h-4.44444444v5.5555556h5.55555556v-3.3888889l4.44444444-4.6666667 4.4444444 4.6666667v3.3888889h5.5555556v-5.5555556z" fill-rule="evenodd"></path></svg></div></div>
			<!-- /wp:coblocks/icon -->

			<!-- wp:heading {"level":4,"placeholder":"Add feature title..."} -->
			<h4>Feature Title</h4>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"placeholder":"Add feature content"} -->
			<p>This is a feature block that you can use to highlight features.</p>
			<!-- /wp:paragraph --></div></div>
			<!-- /wp:coblocks/feature -->

			<!-- wp:coblocks/feature {"coblocks":{"id":"11595152713"}} -->
			<div class="wp-block-coblocks-feature coblocks-feature-11595152713"><div class="wp-block-coblocks-feature__inner has-no-padding"><!-- wp:coblocks/icon {"icon":"gesture","iconRand":false,"hasContentAlign":false} -->
			<div class="wp-block-coblocks-icon"><div class="wp-block-coblocks-icon__inner" style="height:60px;width:60px"><svg height="20" viewbox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path d="m1.92731278 4.32703003c.77092511-.7897664 1.54185022-1.50166852 1.88325991-1.3570634.55066079.22246941 0 1.14571746-.33039648 1.69076752-.2753304.46718576-3.14977973 4.32703003-3.14977973 7.01890985 0 1.4238043.52863436 2.6028922 1.47577092 3.3147943.82599119.6229143 1.91629956.8120133 2.90748899.5116796 1.17841409-.3448276 2.14757709-1.5572859 3.37004405-3.0812013 1.33259912-1.6573971 3.11674006-3.82647389 4.49339206-3.82647389 1.7951542 0 1.8171806 1.12347053 1.938326 1.99110119-4.1629956.7119022-5.92511013 4.0823137-5.92511013 5.9733037s1.58590313 3.4371524 3.53524233 3.4371524c1.7951541 0 4.7246696-1.4794216 5.1651982-6.785317h2.7092511v-2.7808676h-2.7202643c-.1651983-1.83537269-1.2004405-4.67185767-4.438326-4.67185767-2.4779736 0-4.60352424 2.12458287-5.44052864 3.15906563-.63876652.81201335-2.26872247 2.75862064-2.52202643 3.02558394-.2753304.3337042-.74889868.9343716-1.22246696.9343716-.49559472 0-.79295155-.9232481-.39647578-2.1357064.38546256-1.21245826 1.54185022-3.18131254 2.03744494-3.9154616.85903084-1.26807564 1.43171806-2.13570634 1.43171806-3.64849833 0-2.4137931-1.8061674-3.18131257-2.76431718-3.18131257-1.45374449 0-2.72026432 1.11234705-2.99559471 1.39043382-.39647577.40044493-.72687225.73414905-.969163 1.03448275zm10.23127752 12.96996667c-.3414097 0-.814978-.2892103-.814978-.8008899 0-.6674082.8039648-2.4471635 3.160793-3.0700779-.3303965 2.9922136-1.5748899 3.8709678-2.345815 3.8709678z"></path></svg></div></div>
			<!-- /wp:coblocks/icon -->

			<!-- wp:heading {"level":4,"placeholder":"Add feature title..."} -->
			<h4>Feature Title</h4>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"placeholder":"Add feature content"} -->
			<p>This is a feature block that you can use to highlight features.</p>
			<!-- /wp:paragraph --></div></div>
			<!-- /wp:coblocks/feature --></div></div>
			<!-- /wp:coblocks/features -->

			';
		return apply_filters( 'block_unit_test_coblocks_content', $content );
	}
}
Block_Unit_Test_CoBlocks::register();
