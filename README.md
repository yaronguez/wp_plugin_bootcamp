# WP Plugin BootCamp
This repo is used for the WordCamp San Diego Plugin BootCamp Presentation on 2015-03-28.

It will show you how to migrate functionality from a WordPress Theme into a WordPress Plugin.


## Setup
* Clone this repo
* Checkout the step_0 branch:
`````git checkout step_0`````
* Create a local DB and import the MySQL dump in ````sql_dumps````
* Update `````wp-config-sample.php`````
 * Update your DB name / username / password
 * Update the SALT
 * Optional, recommended for running local on OS X, add ````define('FS_METHOD', 'direct');````
* Set up your local server (XAMPP, DesktopServer, MAMP etc)
 * Setup host name as bootcamp.dev


## Steps
### Step 0
**Branch:** step_0  
This is the starting point of the tutorial.  We have a 2015 child theme with all of its logic in ````functions.php```` and all of its styling in ````style.css````. 

* Custom Post Type: ````books````
* Custom Taxonomy: ````genres````
* Custom Fields (with CMB2):
 * ````author````
 * ````amazon```` (url)
* Custom Shortcode: ````[display_book slug="(slug)"]````
* Templates:
 * ````single-books.php````
 * ````content-single-books.php````
 * ````archive-books.php````
 * ````content-archive-books.php````
 * ````taxonomy-genres.php````

### Step 2
**Branch:** step_2
This branch uses an Object Oriented Design approach to a plugin.  It utilizes the WordPress Plugin Boilerplate 3, http://wppb.io/,
by Tom McFarlin and company.  The custom post type, taxonomy, shortcode and metabox have been moved into the plugin under the
admin and public classes. The styles have been moved into the public stylesheet as well.  The template files are still in the
theme folder.

### Step 3
**Branch:** step_3
This branch migrates the template files ````single-books.php```` and ````archive-books.php```` into the plugin and out of the theme
while allowing theme authors and users to override this markup to better suit their theme by copying the templates back into
their theme folder.  It then replaces the built in ````get_template_part()```` method with one that checks the plugin first
allowing us to migrate ````content-single-books.php```` and ````content-archive-books.php```` into the plugin as well.

### Step 4
**Branch:** step_4
This branch adds an admin options page using a refactored CMB2 snippet and uses it to modify the CSS of the books page via a static
helper method.

### Step 5
**Branch:** step_5  
This branch reorganizes all the classes into single responsibility classes:
* Public Classes
 * ````WP_Plugin_Bootcamp_Post_Types````
 * ````WP_Plugin_Bootcamp_Post_Routing````
 * ````WP_Plugin_Bootcamp_Post_Scripts````
 * ````WP_Plugin_Bootcamp_Post_Shortcodes````
* Admin Classes
 * ````WP_Plugin_Bootcamp_Metaboxes````
 * ````WP_Plugin_Bootcamp_Settings````