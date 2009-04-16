<?php // krumo($node);	?>	
<?php // krumo($node->content);	?>	
<?php // print_r(get_defined_vars());  ?> 
<?php //print $FIELD_NAME_rendered ?>
<?php if ($page == 0){ ?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes ?>">

	<?php if($node->title){	?>	
    <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
	<?php } ?>

	<?php if ($node->picture) { ;?>
    <?php print theme('imagecache', 'preset_namespace', $node->picture, $alt, $title, $attributes); ?>
	<?php } ?>
	
	<?php print theme('username', $node); ?>

	<?php print format_date($node->created, 'custom', "j F Y") ?> 

	<?php  print $content;?>	
	<a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print t('read more') ?>

  <?php if ($links){ ?>
    <?php print $links; ?>
  <?php }; ?>
	  
</div>
	
<?php }else{ 
//Content
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes ?> clearfix">
	<h1><?php print $title;?></h1>
		
  <?php if ($submitted){ ?>
  	<?php if ($picture) { ;?>
  		<?php print $picture; ?>  
	  <?php } ?>

	  <?php print theme('username', $node); ?>

		<?php print format_date($node->created, 'custom', "j F Y") ?> 
  <?php } ?>

	<?php if (count($taxonomy)){ ?>
   	<?php print $terms ?> 
	<?php } ?>




	<?php print $content ?>

	<?php print $node_region_two;?>	

	<?php print $node_region_one;?>
		
	<?php if ($links){ ?>
    <?php  print $links; ?>
	<?php } ?>
</div>
<?php } ?>