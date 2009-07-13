----------------------------------------
  Mothership info
----------------------------------------
The mothership theme is the über "clean up this html that drupal provides" theme - so if you wanna make any sense of this them use it as a parent theme!

The basic idea is to use this theme before other "theme systemes" (zen, basic, studio, 960)
To implement this just add: base theme = mothership in you .info file, and youre ready to look at the source yet again without getting overwhelmed by a ton of .classes and markup.

The only thing this theme does is to clean up and remove html & classes that I dont think is necessary, and by that creating a cleaner html code.

Mothership will remove some of the flexibility that cck & views provides out of the box, so please be aware of this!

If youre not a html nerd that gets high by looking at html and enjoying the cleaner code, well then this theme is NOT for you.

----------------------------------------
change the CCK output 
----------------------------------------
file: content-field.tpl.php

----------------------------------------
change views output
----------------------------------------



----------------------------------------
  Theme settings: modify CSS Classes
----------------------------------------

In the Theme-specific settings its possible to remove some or all of the css classes that drupal normally adds to the tpls:

page.tpl modifies the <?php print $body_classes;?> which is normaly added to the <body>
this will not remove: 
  logged -in class
  front status
  page-[NODETYPE]
  sidebar status

node.tpl modifies the <?php print $classes ?> normal this is added to the outer <div>

block.tpl  modifies the <?php print $classes ?> normal this is added to the outer <div>

comments.tpl  modifies the <?php print $classes ?> normal this is added to the outer <div>


----------------------------------------
  Theme settings: Sneaky Features
----------------------------------------
Add 2 regions to nodes:
  this feature will add 2 regions to your node.tpl.
	  <?php print $node_region_two;?>	
	  <?php print $node_region_one;?>


----------------------------------------
  Subtheme settings
----------------------------------------
To remove classes from a subtheme you need to do a little bit of fiddeling with the theme settings:
copy the "_copy_to_your_subtheme_theme-settings.php" file into your subtheme folder and rename the file to "theme-settings.php" 
The settings are now enabled (this is a clean copy & paste from the zen theme btw)

----------------------------------------
  links to ref material
----------------------------------------
cck theming
http://drupal.org/node/62462

views formatters
http://views-help.doc.logrus.com/help/views/api-plugins
