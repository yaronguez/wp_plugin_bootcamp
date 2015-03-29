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

### Step 1
**Branch:** step_1  
This step takes the 2015 child theme functions and templates and breaks them out into a simple plugin using a similar structure to [Bill Erickson's Core Functionality plugin](https://github.com/billerickson/Core-Functionality). 

Some basic principles of this approach include the following:

* WordPress plugin header
* prefixing your functions
* definitions and calling your plugin directory
* organizing your plugin files
* Conditionally including template files

### Step 2
**Branch:** step_2  
This branch uses an Object Oriented Design approach to a plugin.  It utilizes the WordPress Plugin Boilerplate 3, http://wppb.io/,
by Tom McFarlin and company.  The custom post type, taxonomy, shortcode and metabox have been moved into the plugin under the
admin and public classes. The styles have been moved into the public stylesheet as well.  The template files are still in the
theme folder.

