<?php if(theme_get_setting('mothership_html5')){  ?>
<!DOCTYPE html>
<html <?php print $modernizr; ?> lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>
<?php }else{ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html <?php print $modernizr; ?> xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>
<?php } ?>

<?php print $mothership_poorthemers_helper; ?>

<head profile="<?php print $grddl_profile; ?>">
  <?php print $head; ?>
  <?php print $appletouchicon; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <?php print $selectivizr; ?>
</head>

<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>

  <?php print $page_top; //stuff from modules always render first ?>

  <?php print $page_header; // comes from template.php preprocess page?>
  <?php print $page; // uses the page.tpl ?>
  <?php print $page_footer;  // comes from template.php preprocess page ?>

  <?php print $page_bottom; //stuff from modules always render last ?>
</body>
</html>