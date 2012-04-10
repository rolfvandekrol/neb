<?php print $wrapper_prefix; 

if (!empty($title)): ?><h3><?php print $title; ?></h3><?php endif; 

print $list_type_prefix; 
foreach ($rows as $id => $row): ?>
  <li <?php if($classes_array[$id]) { print 'class="' .$classes_array[$id] . '"';} ?>><?php print $row; ?></li>
<?php endforeach; 

print $list_type_suffix . $wrapper_suffix; ?>