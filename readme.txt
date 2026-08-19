=== Bhaskar Maintenance Mode ===
Contributors: vrushabhbhaskar
Plugin URI: https://cheekybhaskar.wordpress.com/my-plugins/
Tags: maintenance, maintenance mode, 503
Requires at least: 5.8
Requires PHP: 7.4
Tested up to: 7.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A lightweight WordPress maintenance mode plugin.

== Description ==

Bhaskar Maintenance Mode allows administrators to temporarily hide the public website while continuing to access the normal website and WordPress dashboard.

Visitors receive a proper HTTP 503 response while maintenance mode is active.

== Features ==

* Simple ON/OFF maintenance mode.
* Administrators can continue viewing the normal website.
* WordPress dashboard remains accessible to administrators.
* WordPress login remains accessible.
* HTTP 503 response.
* Retry-After response header.
* Custom visitor message.
* Uses the site's WordPress Site Logo when available.
* Lightweight and dependency-free.

== Installation ==

1. Upload the `simple-maintenance-mode` folder to `/wp-content/plugins/`.
2. Activate the plugin.
3. Go to Settings > Maintenance Mode.
4. Enable maintenance mode.
5. Save the settings.

== Usage ==

When maintenance mode is active, normal visitors see the maintenance page.

Administrators with the `manage_options` capability can continue viewing the normal website.

Other users are shown the maintenance page while maintenance mode is active.

The standard WordPress login page remains accessible so administrators can authenticate.

== License ==

This plugin is licensed under the GPLv2 or later.
