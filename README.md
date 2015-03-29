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
* Login with
 * username: admin-wppb
 * password: Va3Ax3KBp3

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

