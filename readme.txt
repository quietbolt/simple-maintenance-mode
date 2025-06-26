=== Simple Maintenance Mode by Quiet Bolt ===
Contributors: quietbolt
Author URI: https://github.com/quietbolt
Tags: maintenance, maintenance mode, site offline, simple maintenance, under construction
Requires at least: 5.0
Tested up to: 6.5
Requires PHP: 7.2
Stable tag: 1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A clean, lightweight WordPress plugin to enable Maintenance Mode with editable title, message, and icon display.

== Description ==

**Simple Maintenance Mode by Quiet Bolt** lets you quickly activate a maintenance screen for all visitors while you're working on your site — no complex settings or themes required.

**Features:**

* Enable or disable maintenance mode
* Custom page title and message
* Optional 🔧 icon with the title
* Clean, centered display
* Lightweight and easy to use
* Returns a 503 Service Unavailable header
* Logged-in administrators bypass the maintenance screen

== Installation ==

1. Upload the plugin folder `simple-maintenance-mode` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to **Maintenance** in the admin sidebar to configure the plugin.
4. Enable maintenance mode and customize the title and message.

== Frequently Asked Questions ==

= Can I change the icon? =
Not yet — you can toggle the default 🔧 icon on or off. A custom icon option is planned.

= Will search engines see the maintenance page? =
No. The plugin sends a `503 Service Unavailable` header so that search engines recognize the downtime as temporary.

= Who can see the normal site? =
Only logged-in administrators. Other visitors will see the maintenance message.

== Screenshots ==

1. The default maintenance mode screen shown to users
2. Settings panel in the WordPress admin area

== Changelog ==

= 1.0 =
* Initial stable release
* Editable title, message, and icon toggle
* 503 response support
* Admin-only bypass

== Upgrade Notice ==

= 1.0 =
First stable version.
