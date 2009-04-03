<?php
// $Id$
/**
 * @file views-view-grid.tpl.php
 * Default simple view template to display a rows in a grid.
 *
 * - $rows contains a nested array of rows. Each row contains an array of
 *   columns.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)) : ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<table class="grid">
  <tbody>
    <?php foreach ($rows as $row_number => $columns): ?>
      <?php
//      $row_class = 'row-' . ($row_number + 1);
        $row_class = '';
        $row_number + 1;
        $row_class .= '';
        if ($row_number == 0) {
//         $row_class .= ' first';
        }
        elseif (count($rows) == ($row_number + 1)) {
//         $row_class .= ' last';
        }

        $row_class .= ' ' . ($row_number % 2 ? 'even' : 'odd');
      
      ?>
      <tr class="<?php print $row_class; ?>">
        <?php foreach ($columns as $column_number => $item): ?>
          <?php 
            $odd_even ="";
            $odd_even .= ' ' . ($column_number % 2 ? 'even' : 'odd');  
          ?>
          <td>
          <?php /* <td class="<?php print 'col-'. ($column_number + 1). ' '.$odd_even ; ?>"> */ ?>
            
            <?php print $item; ?>
          </td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
