=== Block Unit Test for Gutenberg ===
Author URI: https://richtabor.com
Plugin URI: https://richtabor.com/gutenberg-block-unit-test/
Contributors: richtabor, coblocks, thatplugincompany, themebeans
Tags: blocks, gutenberg, editor, page builder, gutenberg blocks
Requires at least: 4.7.0
Tested up to: @@pkg.tested_up_to
Requires PHP: 5.2.4
Stable tag: @@pkg.version
License: GPL-3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

The Block Unit Test WordPress plugin helps WordPress theme authors prepare for Gutenberg.

== Description ==

The [Block Unit Test plugin](https://richtabor.com/gutenberg-block-unit-test/) is a development tool to help folks make better WordPress themes by preparing for the upcoming Gutenberg block editor.

If you’re familiar with the WordPress Theme Unit Test, the Block Unit Test plugin is essentially same kind of test — but for core Gutenberg blocks. The plugin will create a single page with all the core blocks added, including mulitple variations of blocks.

Using the Block Unit Test plugin, WordPress theme authors can check the styling of each block and make the necessary fixes to fully support the new editor.

This plugin is created and maintained by [Rich Tabor](https://richtabor.com?utm_medium=wp.org&utm_source=wordpressorg&utm_campaign=readme&utm_content=block-unit-test) of [ThemeBeans](https://themebeans.com?utm_medium=wp.org&utm_source=wordpressorg&utm_campaign=readme&utm_content=block-unit-test).

= Built with developers in mind =

Extensible, adaptable, and open source — the Block Unit Test plugin is created with theme developers in mind. There are opportunities for developers at all levels to get involved.

[Click here](https://github.com/thatplugincompany/block-unit-test) to contribute to the plugin.

== Installation ==

1. Upload the `block-unit-test` folder to your `/wp-content/plugins/` directory or alternatively upload the block-unit-test.zip file via the plugin page of WordPress by clicking 'Add New' and selecting the zip from your computer.
2. Install and activate the Gutenberg WordPress plugin.
3. Activate the Block Unit Test WordPress plugin through the 'Plugins' menu in WordPress.
4. Navigate to the newly created "Block Unit Test" page.
5. Start testing!

== Frequently Asked Questions ==

= How do I start using Gutenberg? =
To get the full experience of the next-generation WordPress block editor,  you'll need a Gutenberg-ready WordPress theme, like [Tabor](https://themebeans.com/themes/tabor?utm_medium=block-unit-test&utm_source=readme&utm_campaign=readme&utm_content=tabor). Then install the [Gutenberg](https://wordpress.org/plugins/gutenberg/) WordPress plugin. That's it! 💥

= Should I use Gutenberg on my live site? =
The new block editor is still very much in active development and is not recommended for production websites just yet.

= How do I prepare my WordPress theme for Gutenberg =
The Block Unit Test is a great starting point, but if you want more tips and techniques, check out [my blog](https://richtabor.com/articles/?utm_medium=block-unit-test&utm_source=readme&utm_campaign=readme&utm_content=my-blog) my blog on WordPress design and development.

= How do I add my theme's styling to the Gutenberg editor =
I recently published an article covering [how to add WordPress theme styles to Gutenberg](https://richtabor.com/add-wordpress-theme-styles-to-gutenberg/?utm_medium=block-unit-test&utm_source=readme&utm_campaign=readme&utm_content=how-to-add-wordpress-theme-styling-to-gutenberg), which is a great place to start.

== Changelog ==

= 1.0.5, November 03, 2018 =
* Tweak: Update the CoBlocks and Gutenberg unit tests

= 1.0.4, August 23, 2018 =
* Tweak: Update the CoBlocks unit test

= 1.0.3, August 22, 2018 =
* New: Suggest running a unit test for CoBlocks
* New: Add a CoBlocks unit test if the plugin is activated
* New: Add the Archives block to the unit test
* New: Add styles for the core Separator block
* New: Add more tests for various column counts

= 1.0.2, July 13, 2018 =
* New: Automagically update the contents of the Block Unit Test page upon plugin update
* New: Add captions to image, gallery and video blocks
* Tweak: Add heading levels to heading blocks

= 1.0.1, June 29, 2018 =
* Fix: Resolve undefined variable

= 1.0.0, June 12, 2018 =
* Initial release on WordPress.org. Enjoy!