# WPChurch Center
A 'Next Steps' Hub WordPress plugin for churches

This is a WordPress plugin which enables an extra post-type and associated templates to run a set of 'Next Steps' for a church. Intended to be used as part of an existing site, or as a standalone site.


### NEW in Version 1.3: 

- Change or remove the /card/ slug in URLs
- Group Cards into categories
- Insert cards using the new [wpcc] shortcode.
- Set cards to be unlisted/hidden in the Center
- Have a separate Favicon for your Center
- Control SEO settings for your Center


### Features include:

- 4 layout options (grid, small card, list, and card views)
- Colour customization options
- Header and footer customization options
- Cards utilise and display any kind of WordPress content
- Mobile first and fully responsive
- Works as standalone site, or as part of your existing WordPress site



== Installation ==
1). Download the plugin

2). Install the plugin by either:
extracting the .zip file and uploading the entire wp-church-center folder to the /wp-content/plugins/ directory of our web server.
go to Plugins > Add New in the WordPress Admin and upload the .zip file.

3). Activate the Plugin. You should see a 'Cards' menu item.
You'll need to set up some settings for your centre in the 'Church Center' section of the Customizer (Appearance > Customizer). These will allow you to alter the appearance of your hub - editing the header, footer and other details of how things look.

4). If you're having 'page not found' issues when trying to view single cards - try saving your permalinks under Settings > Permalinks.

5). Add/Edit Cards in the same way you would with any other content

6). You can add your 'Center' to any page using the `[wpcc]` shortcode. It supports the following attributes to adjust the display: `[wpcc count=10 card_group='your_card_group_slug' layout="small_card"]

### Displaying 

== Frequently Asked Questions ==

== Screenshots ==
1. Editing Settings in the Customizer
2. Editing a card
3. An example card

== Changelog ==
v1.3.3
- FEATURE: Allow custom 'back' link on cards
- FEATURE: Set up default view for 'Card Group' taxonomy pages
- BUG: No PHP notice when cards are empty

v1.3.2
- Fix bug with card links

v1.3.1
- Checks for compatability with WordPress 5.4

v1.3
- FEATURE: You can use a custom slug in the URL instead of "/card/"
- FEATURE: Cards can now be grouped in a 'Card Group' taxonomy
- FEATURE: Cards can now be 'unlisted' so they don't show in card lists or grids
- FEATURE: You can now add a Favicon for your center
- UPDATED: Update bundled ACF version to 5.7.9
- UPDATED: Moved Customizer settings and Added SEO area
- UPDATED: Ensure social icons work with FontAwesome 5
- BUG: Fix Vertical scroll for cards on small screens
- BUG: Tidy up styles for list view
- BUG: Fix incorrect display of footer on Card view.


v1.2.12
- UPDATED: updated bundled version of ACF to support WordPress 5.0

v1.2.11
- UPDATED: More robust styles for the mobile menu
- UPDATED: Tidy up php files to remove additional headers
- 

v1.2.10
- BUG: Make sure admin bar can be hidden
- BUG: Make sure the_content() never displays within cards
- BUG: Ensure that iframes and images with captions are contained by the card
- UPDATED: Set up card title and single titles to be filtered by plugins
- UPDATED: Better title styles for Small Cards
- UPDATED: Change the filtering of content and titles on the single-card views
- UPDATED: Add filters to OG:tags and Twitter tags 

v1.2.9
- UPDATED: Higher priority for our custom 'single' template so it overides some themes with 'builder' templates
- UPDATED: Introduce new style for selecting Card Type.
- UPDATED: Add filters to the single card so we can change it with addons?
- UPDATED: Change the way we output content within the cards.
- UPDATED: Allow Cards to be Password Protected
- BUG: Stop changing the order on all taxonomies in the site
- BUG: Don't disable stylesheets in admin

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
