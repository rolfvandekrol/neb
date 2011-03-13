----------------------------------------------------
    What Mothership can do for you.
----------------------------------------------------
The mothershop theme is a basetheme for the modern markup enthuthiast.
a theme to clean up & make it quicker an easier to develop themes, less crap more awesome ;)

To use the changed markup add this line to you theme
base theme = mothership 
when thats done pink unicorns will indeed spring out of your site in pure happiness


CSS files & classes 
----------------------------------------------------
* Remove css files from the drupal core
Drupal core comes with a lot of css, that you might not need.
Mothership comes with options of how to clean you css safely without destroing drupals functionality.

- TODO remove files

- TODO BAT naming of drupalcore css files motherships splitting of css files from core.
Today its only the system module the follows the naming convention for css files.
This is offcouse an epic fail, but no fear the mothership will fix this.


* Remove classes from the markup you dont need like.
- body tag: the  front, logged in, layout in the body tag
- node
- fields (field, field-items, label, type, )
- block. removes / add an id, remove the block, remove anything but the .contextual-links-region class

* Removes the block-system div wrapper 

IMAGES in CORE
----------------------------------------------------
*remove images adds them as css instead
-Feed icon
-Ical icon
-file fields types icons

LIBARIES
----------------------------------------------------
* adds modernizr support
modernizr 1.6 is added outta the box

* selectivizr support
yay no more ie hell *coughs*

adding support for apple-touch icons
drop em in /themefolder/apple-touch-icon.png

Support for modules:
----------------------------------------------------
blocktheme

TODO
----------------------------------------------------
remove classes from tpl's
region.tpl (region class)
block

* Remove images from the markup!
- tables selected are defined in the css, instead of hardcoded with an image down in the /misc folder


----------------------------------------------------