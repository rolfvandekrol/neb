----------------------------------------------------
    Mothership 
    Fixing everything that is wrong (tm)
    
----------------------------------------------------
The mothershop theme is a basetheme for the modern markup enthuthiast.
The themes main function is to clean up & make it quicker an easier to develop themes by removing (or give the opertunity to remove) markup from drupal. 
By removing classes & markup from drupal a themer gets better working conditions & dont have to use to much time to digh through the dirt of divitis & class overload, that can be very frustrating. 
The markup is basically simpler to read & Quicker to execute for the enduser.
To put it in other words: "Less crap - More awesome"

Drupal 7 version
----------------------------------------------------
Drupal 7 is a total rewrite of the original drupal6 theme. The main reason for the drupal6 version was to get some sanity & a lot of fixes into the the theme layer.

Drupal7 is a much better starting point so a lot of the fixes that came with the drupal6 version is now 
removed. So If it aint broke dont fixe it, thats the reason to start almost all over.


* Cleaning up the markup
All images / icons are now added as css files, so its easy for a theme to remove or change a given icon on apage

*Cleaning up the CSS. 
Mothership rewrites & follows the naming convention that is set by the system theme (but rest of core dosnt follow) 
So a total cleanup of all drupal cores css files was needed :(
This gives the mothership & quick and painless way of removing all the css that is not needed for drupal to work.
you can change this in the theme settings for you theme if you use mothership as a base theme

* Removing css classes from standard templates.
Why add a class if we dont needs it? - mothership gives you settings to remove the classes you dont need in the html, page, region, block, node & field tpl's

* Simpel developertools
- adds a list of all suggeste theme hooks in a html comment.
- rebuild theme registry


Installation
----------------------------------------------------
the Mothership theme is a basetheme that you can build you themes upon, to include all the awesomeness from the mothership
add this line to your .into file 
base theme = mothership 
pink unicorns will indeed spring out of your site in pure happiness.


* Installing external libaries
Mothership comes with the option of adding modernizr & scriptalizr javascript libraries to your base theme.
Both of these libraries needs to be downloaded. none of them are GPL 2.0 so we cant package them on drupal.org.

Download:
  http://www.modernizr.com/
  http://www.scriptalizer.com/

after downloading the libraries place them in the mothership/lib folder:
  mothership/lib/modernizr.js
  mothership/lib/selectivizr.js

You can add them to you theme easy through your theme settings


Settings
----------------------------------------------------
Alot of the magick around the mothership is the oppertunity to cleanup the huge amount of classes & markup, that drupal comes packing with almost all this can be changed in the your themes settings. 


CSS files & classes 
----------------------------------------------------
* Remove css files from the drupal core
Drupal core comes with a lot of css, that you might not need.
Mothership comes with options of how to clean you css safely without destroing drupals functionality.

- TODO remove css files

- TODO BAT naming of drupalcore css files motherships splitting of css files from core.
Today its only the system module the follows the naming convention for css files.
This is offcouse an epic fail, but no fear the mothership will fix this.


* Remove classes from the markup you dont need like.
- body tag: the  front, logged in, layout in the body tag
- node
- fields (field, field-items, label, type, )
- block. removes / add an id, remove the block, remove anything but the .contextual-links-region class

* views
views list can now remove the name & id classes from a view
views the classes can be renamed to the more generic .odd / .even count-$number 
row- is now removable

 - removes the outer div around a list - i cant see a reason for this to be hear, unless you wanna add another class


<img> in core moved to css classes for easier access
----------------------------------------------------
-Feed icon
-Ical icon
-file fields types icons
-table sorting ascending /decending 
the new classes are defined in css/mothership.css

LIBARIES
----------------------------------------------------
* adds modernizr support
modernizr 1.6 is added outta the box

* selectivizr support
yay no more ie hell *coughs*


adding support for apple-touch icons


Support for modules:
----------------------------------------------------
blocktheme
views

TODO
----------------------------------------------------
remove classes from tpl's
region.tpl (region class)

block


----------------------------------------------------