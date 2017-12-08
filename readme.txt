=== WP Church Center ===
Contributors: jordesign, wpchurchteam
Requires at least: 4.7
Tested up to: 4.9
Stable tag: 1.2.9
License: GPL2

Create a 'Next Steps' hub for your church using WordPress! Setup in minutes, mobile first & responsive & designed to integrate with your existing WordPress site!

== Description ==
WP Church Center enables churches to set up a central hub of next steps for their members. 
Unlimited cards to inform your members and make it easy for them to get involved, signup, or find out more.

Features include:
- 4 layout options (grid, small card, list, and card views)
- Colour customization options
- Header and footer customization options
- Cards utilise and display any kind of WordPress content
- Mobile first and fully responsive
- Works as standalone site, or as part of your existing WordPress site

Check out a demo at [http://wpchurch.center/hub/](http://wpchurch.center/hub/)

== Installation ==
1). Download the plugin

2). Install the plugin by either:
extracting the .zip file and uploading the entire wp-church-center folder to the /wp-content/plugins/ directory of our web server.
go to Plugins > Add New in the WordPress Admin and upload the .zip file.

3). Activate the Plugin. You should see a 'Cards' menu item.
You'll need to set up some settings for your centre in the 'Church Center' section of the Customizer (Appearance > Customizer). These will allow you to alter the appearance of your hub - editing the header, footer and other details of how things look.

4). If you're having 'page not found' issues when trying to view single cards - try saving your permalinks under Settings > Permalinks.



Add/Edit Cards in the same way you would with any other content
Add a page which uses the 'Church Center Homepage' template

== Screenshots ==
1. Editing Settings in the Customizer
2. Editing a card
3. An example card

== Changelog ==

v1.2.9
- UPDATED: Introduce new style for selecting Card Type.
- UPDATED: Add filters to the single card so we can change it addons?

v1.2.8
- BUG: make addon scripts exempt from being disabled

v1.2.7
- Add extra actions and filters to allow addons to change card behaviours
- Manually include WordPress' Media management scripts

v1.2.6
- Add filter for Card Link

v1.2.5
- UPDATED: Tested up to WP 4.9
- UPDATED: Add filter to allow for new PCO giving plugin
- UPDATED: Update to v5.x of Advanced Custom Fields

v1.2.4
- UPDATED: Updated Advanced Custom Fields to v4.4.12
- BUG FIX: Return footer to desktop view of Card home page
- BUG FIX: Only include <p> tag for Subtitle if there is one
- BUG FIX: Fix permalink refresh on activation
- FEATURE: Add FitVids.js to make sure videos maintain aspect ratio

v1.2.3
- BUG FIX: Logos no longer stretch out of shape in header (thanks @maco)
- BUG FIX: Remove anonymous functions that choke old PHP versions
- BUG FIX: specific list styles to allow for DIVI
- BUG FIX: Add class and styling to <html> for when weird styles are applied in some themes
- BUG FIX: Now an option to set a title on the 'church website' link in the menu
- BUG FIX: More robust styling for 'cards' view on small screens

v1.2.2
- CHANGED: Start using a version number on our stylesheet and scripts to get around aggressive caching
- BUG FIX: Make sure stylesheet for MediaElement isn't disabled

v1.2.1
- FEATURE: Added option to have a custom URL on the site logo
- CHANGED: More specific classes on header (.wpccHeader) & footer (.wpccFooter) for more robust styling
- BUG: External links now open in new tab if option is selected
- BUG: Disappearing toolbar buttons now show correctly

v1.2
- FEATURE: Add architecture to allow for WPCC Addons
- FEATURE: Add new 'External Link' card type
- FEATURE: More robust menu button for small screens

v1.1.2
- FEATURE/BUG FIX: Use CDN version of icons
- FEATURE: Add option for maximum number of columns on Small Card view
- FEATURE: More robust type styles on cards

v1.1.1
- BUG FIX: Fix error on Twitter card image

v1.1
- FEATURE: Add drag-and-drop sorting
- FEATURE: Add option for scroll direction on small screens
- FEATURE: Add new 'Small Card' layout
- FEATURE: Add a whole suite of new design/layout options for more variety
- FEATURE: Add link to "Center home" in admin menu
- BUG FIX: Fix undefined_constant error that sometimes appears
- BUG FIX: More robust styles to override custom themes
- BUG FIX: Escape all the html (and urls) so things are secure
- BUG FIX: Use a variable for our image field - so it works on older PHP versions
- BUG FIX: Lots of small tweaks and bug fixes 


v1.0.3
- BUG FIX: remove hover background behind menu items
- BUG FIX: Use a variable for our image field - so it works on older PHP versions
- BUG FIX: Make body BG more specific so it overrides installed theme
- BUG FIX: Simplify permalinks so they always work.

v1.0.2
- FEATURE: Flush rewrite rules on plugin activation/deactivation
- FEATURE: Add styles for card view when 'swiping' isn't used.
- BUG FIX: Fix Instagram link
- BUG FIX: Default colours for social icons
- BUG FIX: More robust menu styles to allow for longer text
- BUG FIX: tidy up theme switcher
- BUG FIX: WPCC javascript not loading when scripts disabled



v1.0.1
- BUG FIX: Include ACF later to avoid conflict with themes using ACF Pro
- BUG FIX: More robust OG & Twitter meta tags
- Tweaks to logo & header styling
- Make card header shorter on mobile screens
- Tidy up ReadMe.txt


v1.0 First release of core plugin