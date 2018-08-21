<?php
/**
 * Uninstall @@pkg.title.
 *
 * @package   @@pkg.title
 * @author    @@pkg.author
 * @license   @@pkg.license
 */

// Exit if accessed directly.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Load the main plugin file.
require_once 'class-block-unit-test.php';

// Pull the Block Unit Test page.
$title = apply_filters( 'block_unit_test_title', 'Block Unit Test ' );
$page  = get_page_by_title( $title, OBJECT, 'page' );

wp_trash_post( $page->ID );

// Clear any cached data that has been removed.
wp_cache_flush();
