# Simple Maintenance Mode — Testing

This document records the functional tests performed before distributing Simple Maintenance Mode.

## 1. Activation Notice

* [ ] Activate the plugin.
* [ ] Verify the post-activation notice appears on the Plugins page.
* [ ] Verify the notice contains a link to Settings → Maintenance Mode.
* [ ] Click the link and verify the settings page opens correctly.
* [ ] Return to the Plugins page.
* [ ] Refresh the page.
* [ ] Verify the activation notice does not appear again.

## 2. Maintenance Mode

* [ ] Open Settings → Maintenance Mode.
* [ ] Verify maintenance mode is initially OFF.
* [ ] Enable maintenance mode and save the settings.
* [ ] Verify the administrator maintenance notice appears.
* [ ] Open the public website as a non-administrator.
* [ ] Verify the maintenance page is displayed.
* [ ] Verify administrators can still access the normal website.
* [ ] Verify the standard WordPress login page remains accessible.

## 3. HTTP Response

* [ ] Verify the maintenance page returns HTTP `503 Service Unavailable`.
* [ ] Verify the response contains `Retry-After: 3600`.
* [ ] Verify cache-control headers prevent the maintenance response from being cached.

## 4. Visitor Message

* [ ] Enter a custom visitor message.
* [ ] Save the settings.
* [ ] Verify the custom message appears on the maintenance page.
* [ ] Enter HTML or JavaScript such as `<script>alert('XSS')</script>`.
* [ ] Verify the content is displayed as text and is not executed.

## 5. Site Logo and Fallback

* [ ] Verify the site's WordPress Site Logo is displayed when available.
* [ ] Temporarily remove or unset the site's Site Logo.
* [ ] Verify the maintenance page displays the fallback icon instead.
* [ ] Restore the Site Logo.

## 6. Settings Persistence

* [ ] Enable maintenance mode.
* [ ] Configure a custom visitor message.
* [ ] Deactivate the plugin.
* [ ] Reactivate the plugin.
* [ ] Verify the maintenance mode state is preserved.
* [ ] Verify the visitor message is preserved.
* [ ] Delete the plugin.
* [ ] Verify the plugin's stored settings are removed.

## 7. Security and Access

* [ ] Verify users without `manage_options` cannot bypass maintenance mode.
* [ ] Verify administrators retain access to the normal website.
* [ ] Verify the settings page requires the `manage_options` capability.
* [ ] Verify the visitor message is sanitized before storage.
* [ ] Verify the visitor message is escaped when rendered.

## Test Result

All currently implemented functional tests have passed.

Last tested: August 2026.
