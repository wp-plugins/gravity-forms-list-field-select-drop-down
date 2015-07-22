=== Drop Down Options in List Fields for Gravity Forms ===
Contributors: ovann86
Donate link: http://www.itsupportguides.com/
Tags: Gravity Forms
Requires at least: 4.0
Tested up to: 4.2.2
Stable tag: 1.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Gives the ability to add drop down (select) fields inside of a list field column

== Description ==

Adds the ability to make the [Gravity Forms](http://www.gravityforms.com/ "Gravity Forms website") list field have a drop down (select) field inside of a list field column.

**Disclaimer**

*Gravity Forms is a trademark of Rocketgenius, Inc.*

*This plugins is provided “as is” without warranty of any kind, expressed or implied. The author shall not be liable for any damages, including but not limited to, direct, indirect, special, incidental or consequential damages or losses that occur out of the use or inability to use the plugin.*

== Installation ==

1. Install plugin from WordPress administration or upload folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in the WordPress administration
1. Open the Gravity Forms 'Forms' menu
1. Open the forms editor for the form you want to change
1. Add or open an existing list field
1. With multiple columns enabled you will see a 'Drop down fields' section - here you can choose which columns are drop down fields.
1. When checked, an 'Options' field appears - enter the options for the drop down list in the field, comma separated. E.g. Mr,Mrs

== Frequently Asked Questions ==

**How do I add a blank or empty option**

If you want to add a blank or empty option half way through simply enter two commas in the options, for example:

`Option 1,,Option 2`

If you want the options of 'Option 1' and 'Option 2' but want the default option to be blank or empty you would enter:

`,Option 1,Option 2`

== Screenshots ==

1. Shows the drop down options in the forms editor.
2. Shows a list field that has drop down fields added to two columns - Title and Option.

== Changelog ==

= 1.1 =
* Improvement: Remove blank first option to match Gravity Forms Drop Down field behaviour.
* Maintenance: Rename JavaScript function name and update jQuery target to avoid conflicts with other plugins.
* Maintenance: change plugin name from 'Gravity Forms - List Field Drop Down' to 'Drop Down Options in List Fields for Gravity Forms'.

= 1.0 =
* First public release.

== Upgrade Notice ==

= 1.0 =
First public release.